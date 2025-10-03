/**
 * --------------------------------------------------------
 * Sistema de Avaliação de Jurados - Vue.js
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

    data : {
        step: 1,
		avaliacoes: {},
		coreografia_hashkey: '',
		loading: false,
		urlPost: SITE_URL,
        jurado_id: typeof window.JURD_ID !== 'undefined' ? window.JURD_ID : '',
        grupo_coreos: Array.isArray(window.GROUP_COREOS) ? window.GROUP_COREOS : [],
	},

	computed: {
		todasNotasPreenchidas() {
			// Verifica se todas as avaliações foram preenchidas
			const criterios = Object.keys(this.avaliacoes);
			if (criterios.length === 0) return false;
			
			return criterios.every(criterio => {
				const nota = this.avaliacoes[criterio];
				return nota !== '' && nota !== null && nota !== undefined && !isNaN(nota) && nota >= 0;
			});
		},
		
		botaoConcluirHabilitado() {
			// O botão só fica habilitado se TODAS as notas estiverem preenchidas
			return this.todasNotasPreenchidas;
		}
	},

    methods: {
        storageKey() {
            return `jurado_${this.jurado_id}_corgf_${this.coreografia_hashkey}`;
        },

        salvarLocal() {
            try {
                const payload = {
                    avaliacoes: this.avaliacoes,
                    keys: Object.keys(this.avaliacoes),
                    ts: Date.now(),
                };
                localStorage.setItem(this.storageKey(), JSON.stringify(payload));
            } catch (e) {
                console.warn('Falha ao salvar no navegador:', e);
            }
        },

        carregarLocal() {
            try {
                const raw = localStorage.getItem(this.storageKey());
                if (!raw) return;
                const payload = JSON.parse(raw);
                if (payload && payload.avaliacoes) {
                    this.avaliacoes = payload.avaliacoes;
                }
            } catch (e) {
                console.warn('Falha ao carregar do navegador:', e);
            }
        },

        isNotaValida(v) {
            if (v === '' || v === null || v === undefined) return false;
            const n = parseFloat(v);
            if (isNaN(n)) return false;
            return n >= 0 && n <= 10;
        },

        isCoreografiaCompleta(hashkey) {
            try {
                const key = `jurado_${this.jurado_id}_corgf_${hashkey}`;
                const raw = localStorage.getItem(key);
                if (!raw) return false;
                const payload = JSON.parse(raw);
                const notas = payload && payload.avaliacoes ? payload.avaliacoes : {};
                const keys = payload && payload.keys ? payload.keys : Object.keys(notas);
                if (!keys || keys.length === 0) return false;
                // Todos os critérios presentes devem ser válidos 0-10
                for (let k of keys) {
                    const v = notas[k];
                    if (!this.isNotaValida(v)) return false;
                }
                return true;
            } catch (e) {
                return false;
            }
        },

        isGrupoCompleto() {
            if (!this.grupo_coreos || this.grupo_coreos.length === 0) return false;
            for (let hash of this.grupo_coreos) {
                if (!this.isCoreografiaCompleta(hash)) return false;
            }
            return true;
        },
        validateAndUpdate(event, criterio_id) {
			let valor = event.target.value;
			const elemento = event.target;
			
			// Validação rigorosa: apenas números de 0 a 10
			if (valor !== '') {
				const numero = parseFloat(valor);
				if (isNaN(numero) || numero < 0 || numero > 10) {
					// Se inválido, corrige para o valor anterior ou vazio
					valor = this.avaliacoes[criterio_id] || '';
					elemento.value = valor;
					
					// Alerta visual
					Swal.fire({
						title: 'Nota Inválida!',
						text: 'As notas devem ser de 0 a 10 apenas.',
						icon: 'warning',
						timer: 2000,
						showConfirmButton: false,
						toast: true,
						position: 'top-end'
					});
					return;
				}
			}
			
			// Remove classes existentes
			elemento.classList.remove('input-preenchido');
			
			// Adiciona classe se tiver valor válido
			if (valor !== '') {
				elemento.classList.add('input-preenchido');
			}
			
            // Atualiza o Vue data
			this.$set(this.avaliacoes, criterio_id, valor);
            // Salva imediatamente no navegador (não no servidor)
            this.salvarLocal();
		},

		updateInputStyle(event, criterio_id) {
			// Método mantido para compatibilidade
			this.validateAndUpdate(event, criterio_id);
		},

        // Removido: salvamento automático no servidor

		finalizarAvaliacao() {
			if (!this.todasNotasPreenchidas) {
				Swal.fire({
					title: 'Atenção!',
					text: 'Você precisa avaliar todas as coreografias antes de concluir.',
					icon: 'warning',
					confirmButtonText: 'OK',
					confirmButtonColor: '#ffa902'
				});
				return;
			}

			// Modal de confirmação
			Swal.fire({
				title: 'Concluir Avaliação',
				text: 'Você já analisou todas as notas? Deseja concluir?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Sim, concluir',
				cancelButtonText: 'Cancelar',
				confirmButtonColor: '#ffa902',
				cancelButtonColor: '#6c757d'
			}).then((result) => {
				if (result.isConfirmed) {
					this.executarFinalizacao();
				}
			});
		},

        executarFinalizacao() {
            // Bloqueia se o grupo (todas as coreografias) não estiver completo
            if (!this.isGrupoCompleto()) {
                Swal.fire({
                    title: 'Avaliação Incompleta',
                    html: '<p>Preencha todas as coreografias do grupo antes de concluir.</p>',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ffa902'
                });
                return;
            }
			this.loading = true;
			
			const formData = new FormData();
			formData.append('corgf_hashkey', this.coreografia_hashkey);
            formData.append('avaliacoes', JSON.stringify(this.avaliacoes));
			
			axios.post(this.urlPost + 'jurados/ajaxform/FINALIZAR-COREOGRAFIA', formData)
				.then(response => {
					const respData = response.data;
					if (respData.error_num === '0') {
						Swal.fire({
							title: 'Sucesso!',
							text: respData.error_msg,
							icon: 'success',
							confirmButtonText: 'OK',
							confirmButtonColor: '#ffa902'
						}).then(() => {
							if (respData.redirect_url && respData.redirect_url !== '') {
								// Força o redirecionamento
								console.log('Redirecionando para:', respData.redirect_url);
								window.location.href = respData.redirect_url;
							} else {
								// Sem mais grupos para avaliar
								Swal.fire({
									title: 'Avaliação Completa',
									text: 'Todas as avaliações foram finalizadas!',
									icon: 'success',
									confirmButtonText: 'OK',
									confirmButtonColor: '#ffa902'
								});
							}
						});
					} else {
						if (respData.error_msg.includes('avaliar todas as coreografias')) {
							this.mostrarValidacaoDetalhada();
						} else {
							Swal.fire({
								title: 'Erro!',
								text: respData.error_msg,
								icon: 'error',
								confirmButtonText: 'OK',
								confirmButtonColor: '#dc3545'
							});
						}
					}
				})
				.catch(error => {
					console.error('Erro na requisição:', error);
					Swal.fire({
						title: 'Erro!',
						text: 'Erro de conexão. Tente novamente.',
						icon: 'error',
						confirmButtonText: 'OK',
						confirmButtonColor: '#dc3545'
					});
				})
				.finally(() => {
					this.loading = false;
				});
		},

		mostrarValidacaoDetalhada() {
			let criteriosFaltantes = [];
			
			for (let criterio_id in this.avaliacoes) {
				const nota = this.avaliacoes[criterio_id];
				if (nota === '' || nota === null || nota === undefined || isNaN(nota)) {
					criteriosFaltantes.push(criterio_id);
				}
			}
			
			if (criteriosFaltantes.length > 0) {
				Swal.fire({
					title: 'Avaliação Incompleta',
					html: `<p>Você precisa avaliar todos os critérios antes de concluir.</p>
						   <p><strong>Critérios pendentes:</strong> ${criteriosFaltantes.length}</p>`,
					icon: 'warning',
					confirmButtonText: 'OK',
					confirmButtonColor: '#ffa902'
				});
			}
		},

		inicializarAvaliacoes() {
			console.log('=== INICIALIZANDO AVALIAÇÕES ===');
			
            // Não limpar: preservar o que veio do localStorage
            if (!this.avaliacoes || typeof this.avaliacoes !== 'object') {
                this.avaliacoes = {};
            }
			
			// Inicializar avaliações com valores existentes dos inputs
			const inputs = document.querySelectorAll('input[name^="avaliacoes["]');
			console.log('Inputs encontrados:', inputs.length);
			
			inputs.forEach(input => {
				const matches = input.name.match(/avaliacoes\[(\d+)\]/);
				if (matches) {
					const criterio_id = matches[1];
                    // Priorizar o valor salvo em localStorage
                    let valor = (this.avaliacoes && this.avaliacoes[criterio_id] !== undefined)
                        ? this.avaliacoes[criterio_id]
                        : (input.value || '');
					
					console.log(`Input: criterio_id=${criterio_id}, valor=${valor}`);
					
					// Força a atualização do Vue
					this.$set(this.avaliacoes, criterio_id, valor);
					
                    // Forçar o input a refletir o valor salvo
                    input.value = valor;

                    // Aplicar estilo se tiver valor válido
                    if (valor !== '' && valor !== null && valor !== undefined && !isNaN(valor) && valor >= 0) {
						input.classList.add('input-preenchido');
					} else {
						input.classList.remove('input-preenchido');
					}
				}
			});
			
			console.log('Avaliações inicializadas:', this.avaliacoes);
			console.log('Botão habilitado:', this.botaoConcluirHabilitado);
		},

        extrairCoreografiaHashkey() {
			// Extrair hashkey da URL atual
			const url = window.location.href;
            const matches = url.match(/jurados\/index\/([^\/?#]+)/);
			if (matches) {
				this.coreografia_hashkey = matches[1];
			}
		},

        atualizarEstiloInputs() {
			// Atualiza o estilo visual de todos os inputs baseado nas avaliações
			const inputs = document.querySelectorAll('input[name^="avaliacoes["]');
			inputs.forEach(input => {
				const matches = input.name.match(/avaliacoes\[(\d+)\]/);
				if (matches) {
					const criterio_id = matches[1];
					const nota = this.avaliacoes[criterio_id];
					
					// Remove classes existentes
					input.classList.remove('input-preenchido');
					
					// Adiciona classe se tiver valor válido
					if (nota !== '' && nota !== null && nota !== undefined && !isNaN(nota) && nota >= 0) {
						input.classList.add('input-preenchido');
					}
				}
			});
		}
	},

	mounted() {
		// Extrair hashkey da coreografia da URL
		this.extrairCoreografiaHashkey();
        // Carregar notas salvas para esta coreografia antes de inicializar
        this.carregarLocal();
		
		// Inicializar avaliações com valores existentes
		this.inicializarAvaliacoes();
        this.atualizarEstiloInputs();
		
		// Verificar mudanças nos inputs nativos
		const inputs = document.querySelectorAll('input[name^="avaliacoes["]');
		inputs.forEach(input => {
			input.addEventListener('input', (event) => {
				const matches = input.name.match(/avaliacoes\[(\d+)\]/);
				if (matches) {
					const criterio_id = matches[1];
					this.updateInputStyle(event, criterio_id);
				}
			});
		});

		console.log('Sistema de avaliação inicializado');
		console.log('Coreografia hashkey:', this.coreografia_hashkey);
		console.log('Avaliações iniciais:', this.avaliacoes);
	}
});

/**
 * --------------------------------------------------------
 * Fim do sistema de avaliação
 * --------------------------------------------------------
**/