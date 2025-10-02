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
			
			// Salva automaticamente (debounced)
			this.salvarAvaliacoesDebounced();
		},

		updateInputStyle(event, criterio_id) {
			// Método mantido para compatibilidade
			this.validateAndUpdate(event, criterio_id);
		},

		salvarAvaliacoes() {
			if (this.loading) return;
			
			this.loading = true;
			
			console.log('=== SALVANDO AVALIAÇÕES ===');
			console.log('Coreografia hashkey:', this.coreografia_hashkey);
			console.log('Avaliações atuais:', this.avaliacoes);
			
			const formData = new FormData();
			formData.append('corgf_hashkey', this.coreografia_hashkey);
			formData.append('avaliacoes', JSON.stringify(this.avaliacoes));
			
			// Adiciona cada avaliação individualmente (OBRIGATÓRIO)
			for (let criterio_id in this.avaliacoes) {
				const nota = this.avaliacoes[criterio_id];
				// Só envia se tiver valor válido
				if (nota !== '' && nota !== null && nota !== undefined && !isNaN(nota)) {
					formData.append(`avaliacoes[${criterio_id}]`, nota);
					console.log(`Enviando: criterio_id=${criterio_id}, nota=${nota}`);
				}
			}
			
			console.log('URL da requisição:', this.urlPost + 'jurados/ajaxform/SALVAR-AVALIACOES');
			
			axios.post(this.urlPost + 'jurados/ajaxform/SALVAR-AVALIACOES', formData)
				.then(response => {
					console.log('Resposta do servidor:', response.data);
					const respData = response.data;
					if (respData.error_num === '0') {
						// Sucesso - força atualização visual
						console.log('✅ Avaliações salvas automaticamente:', this.avaliacoes);
						this.atualizarEstiloInputs();
					} else {
						console.error('❌ Erro ao salvar avaliações:', respData.error_msg);
					}
				})
				.catch(error => {
					console.error('❌ Erro na requisição:', error);
					console.error('Detalhes do erro:', error.response);
				})
				.finally(() => {
					this.loading = false;
				});
		},

		// Função debounced para salvar avaliações
		salvarAvaliacoesDebounced: _.debounce(function() {
			this.salvarAvaliacoes();
		}, 1000),

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
			this.loading = true;
			
			const formData = new FormData();
			formData.append('corgf_hashkey', this.coreografia_hashkey);
			
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
			
			// Limpar avaliações existentes
			this.avaliacoes = {};
			
			// Inicializar avaliações com valores existentes dos inputs
			const inputs = document.querySelectorAll('input[name^="avaliacoes["]');
			console.log('Inputs encontrados:', inputs.length);
			
			inputs.forEach(input => {
				const matches = input.name.match(/avaliacoes\[(\d+)\]/);
				if (matches) {
					const criterio_id = matches[1];
					const valor = input.value || '';
					
					console.log(`Input: criterio_id=${criterio_id}, valor=${valor}`);
					
					// Força a atualização do Vue
					this.$set(this.avaliacoes, criterio_id, valor);
					
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
		
		// Inicializar avaliações com valores existentes
		this.inicializarAvaliacoes();
		
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