
/**
 * --------------------------------------------------------
 * ini : COREOGRAFIAS
 * --------------------------------------------------------
**/

var vue = new Vue({
	el: "#app",

	data: {
		step: 3, // COREOGRAFIAS 
		substep: 1,
		link_redirect_participantes: LINK_REDIRECT_PARTICIPANTES,
		lista_coreografos: LIST_COREOGRAFOS,
		lista_modalidades: LIST_MODALIDADES,
		lista_formatos: LIST_FORMATOS,
		lista_categorias: LIST_CATEGORIAS,
		lista_categorias_all: LIST_CATEGORIAS_ALL,
		evcfg_config_limites: RS_EVCFG_CONFIG_LIMITES,
		lista_corf_cadastradas: LIST_CORF_CADASTRADAS,
		PATH_FOLDER_GRUPO: PATH_FOLDER_GRUPO,

		// Ordem das categorias para filtrar inferiores
		categoriasOrdem: [1, 2, 3, 4], // Substitua pelos IDs reais: Adulto, Juvenil, Infantil, Baby Class

		fields: {
			event_hashkey: STR_EVENT_HASHKEY,
			grp_id: '',
			grp_hashkey: '',

			// Step 3
			corgf_hashkey: '',
			corgf_titulo: '',
			corgf_coreografo: [],
			corgf_musica: '',
			corgf_musica_file: '',
			corgf_tempo: '',
			corgf_musica_msg: '',
			corgf_tempo_max: '',
			corgf_compositor: '',
			corgf_observacao: '',
			corgf_modl_id: '',
			corgf_formt_id: '',
			corgf_categ_id: '',
			corgf_evcfg_seletiva: '',

			participantes: [],
			participantes_json: '',
			participantes_elenco: [],
			participantes_elenco_json: [],
			participantes_inferiores: [],
			participantes_inferiores_json: [],

			coreografia_elenco: [],
			coreografia_elenco_all: [],
			coreografia_elenco_json: '',

			elenco_coreografos: [],
			elenco_bailarinos: [],

			elenco_coreografos_json: '',
			elenco_bailarinos_json: '',
		},

		coreografos: [],
		selectedParticipants: [],
		participantesEncontrados: [],
		elencoSelecionado: [],
		error: {
			// Step 3
			corgf_titulo: '',
			corgf_coreografo: '',
			corgf_musica: '',
			corgf_musica_file: '',
			corgf_tempo: '',
			corgf_musica_msg: '',
			corgf_tempo_max: '',
			corgf_compositor: '',
			corgf_observacao: '',
			corgf_modl_id: '',
			corgf_formt_id: '',
			corgf_categ_id: '',
			corgf_evcfg_seletiva: '',

			elenco_coreografos: '',
			elenco_bailarinos: '',
			elenco_coreografos_json: '',
			elenco_bailarinos_json: '',
		},

		arrSelectUnicCor: [],
		selectedItems: [],
		selectedCoreografos: [],
		selectedBailarinos: [],


		preview: null,
		image: null,

		previewFileMusica: null,
		imageFileMusica: null,

		overlay: { active: false },
		loading: { active: false },

		partcBTNDisabled: false,
		corgfBTNDisabled: true,
		btnDisabledContinue: true,
		editar_coreografia: 0,

		urlPost: SITE_URL,
		messageResult: '',
	},

	methods: {
		stepParticipantes: function (next) {
			window.location.href = vue.link_redirect_participantes;
		},
		SendNextCobranca: function (next) {
			return false;
		},
		SendNextSendMailOld: function () {
			const form = this.$refs.formFieldsInscricao;
			form.submit();
			return false;
		},
    SendNextSendMail: function () {
        // Verificação essencial: pelo menos uma coreografia cadastrada
        if (this.lista_corf_cadastradas.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Coreografia Obrigatória',
                text: 'Você precisa cadastrar pelo menos uma coreografia antes de continuar.',
                confirmButtonText: 'Entendi',
                confirmButtonColor: '#e79c32'
            });
            return false;
        }
    
        // Se tiver coreografias, submite o formulário
        const form = this.$refs.formFieldsInscricao;
        form.submit();
        return false;
    },
		stepGravarParticipante: function (next) {
			let arrSelect = vue.fields.participantes;
			let allFound = true;
			for (let j = 0; j < vue.lista_func_obrigatoria.length; j++) {
				let funcIdExists = false;
				for (let i = 0; i < arrSelect.length; i++) {
					if (arrSelect[i].func_id === vue.lista_func_obrigatoria[j].func_id) {
						funcIdExists = true; break;
					}
				}
				if (!funcIdExists) { allFound = false; break; }
			}
			if (!allFound) {
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Para prosseguir com a inscrição, é obrigatório cadastrar pelo menos: <br />' +
						'01 Diretor(a), <br />' +
						'01 Coreógrafo(a) <br />' +
						'01 Bailarino(a)',
					confirmButtonText: 'Fechar',
					confirmButtonColor: "#0b8e8e",
				});
				return false;
			}

			//// fazemos um loop nos participantes para verificar se existe todas funcoes obrigatorioas
			//let encontrou = false;
			//for (let i = 0; i < arrSelect.length; i++) {
			//	let found = false;


			//	console.log( 'func_id', arrSelect[i].func_id );
			//	//console.log( 'func_id', arrSelect[i].func_id );



			//	for (let j = 0; j < vue.lista_func_obrigatoria.length; j++) {
			//		if (arrSelect[i].func_id === vue.lista_func_obrigatoria[j].func_id) {
			//			found = true;
			//			break;
			//		}
			//	}
			//	if (!found) {
			//		console.log("O func_id não está na lista LIST_FUNC_OBRIGATORIA.");
			//		//console.log("O func_id", arrSelect[i].func_id, "não está na lista LIST_FUNC_OBRIGATORIA.");
			//		// Faça o que for necessário com o func_id que não foi encontrado
			//	}
			//}

			//let form = this.formData(vue.fields);
			//axios.post(this.urlPost +'inscricoes/ajaxform/LIST-PARTICIPANTE-COREOGRAFOS', form).then(function(response){
			//	let respData = response.data;
			//	if( respData.error_num == '0' ){
			//		vue.coreografos = respData.coreografos;
			//		return false;
			//	}else{
			//		vue.coreografos = [];
			//	}
			//});

			vue.step = next;
			return false;
			//if(this.ValidateFormGravarParticipante()){
			//	//const form = this.$refs.formFieldsInscricao
			//	//form.submit();
			//	//return false;


			//}else{
			//	console.log('error gravar participante');
			//	//alert('deu erro');
			//	return false;
			//}
		},
		GravarCoreografias: function () {
			if (this.ValidateFormGravarCoreografia()) {
				//let form = this.formData(vue.fields);
				//console.log( JSON.stringify(vue.fields, null, 4) );
				//console.log('urlPost', this.urlPost );
				////return false;
				const form = this.$refs.formFieldsInscricao
				form.submit();
				return false;
			} else {
				console.log('error gravar coreografia');
				//alert('deu erro');
				return false;
			}
		},
		selectCategCoreografia: function () {
			let form = this.formData(vue.fields);
			//console.log( JSON.stringify(vue.fields, null, 4) );
			vue.fields.participantes_elenco_json = '';
			vue.fields.participantes_elenco = [];
			axios.post(this.urlPost + 'inscricoes/ajaxform/LIST-PARTICIPANTE-POR-CATEG', form).then(function (response) {
				let respData = response.data;
				console.log('respData:', respData);
				if (respData.error_num == '0') {
					vue.fields.participantes_elenco_json = JSON.stringify(respData.participantes);
					vue.fields.participantes_elenco = respData.participantes;

					// ATENÇÃO: garante que a lista completa de participantes está disponível
					vue.fields.participantes_elenco_all = respData.participantes_all; // << precisa vir do backend
					console.log('participantes_elenco_all:', vue.fields.participantes_elenco_all);

					// Chama a função que carrega categorias inferiores
					vue.selectCategInferior();
					console.log('participantes_inferiores:', vue.fields.participantes_inferiores);
					vue.corgfBTNDisabled = false;
					return false;
				} else {
					vue.fields.participantes_elenco_json = [];
					vue.fields.participantes_elenco = [];
					vue.fields.participantes_inferiores = []; // limpar também
					vue.corgfBTNDisabled = true;

					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html: 'Não existe participantes relacionados a esta categoria. ' + respData.error_num + ' | ' + respData.error_msg,
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
				}
			});

		},
		selectFormato: function () {
			let formatos = vue.lista_formatos;
			let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);
			if (vue.evcfg_config_limites.envio_musica == 1) {
				let tempoTotal = this.converterParaSegundos(formtEncontrado.formt_tempo_limit);
				vue.fields.corgf_tempo_max = this.converterParaMinutosESegundos(tempoTotal);

				// limpar o campo da musica
				vue.error.corgf_musica_file = "";
				vue.error.corgf_musica_msg = "";
				//vue.fields.corgf_musica_file = "";
				//vue.fields.corgf_tempo = "";

				// validar musica caso ela já tenha sido selecionada
				if (vue.fields.corgf_tempo > vue.fields.corgf_tempo_max) {
					//vue.fields.corgf_tempo = '';
					vue.error.corgf_musica_msg = "Música com tempo maior que o permitido.";
				}
			}
		},
		SalvarCoreografia: function () {
			if (this.ValidateFormGravarCoreografia()) {
				/*
				VALIDACOES
				*/
				vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
				vue.fields.elenco_coreografos_json = JSON.stringify(vue.fields.elenco_coreografos);
				vue.fields.elenco_bailarinos_json = JSON.stringify(vue.fields.elenco_bailarinos);
				console.log(JSON.stringify(vue.fields, null, 4));
				let form = this.formData(vue.fields);
				form.append('fileInputMusica', this.imageFileMusica);
				axios.post(this.urlPost + 'inscricoes/ajaxform/SALVAR-ELENCO-COREOGRAFIA', form).then(function (response) {
					//vue.loading.active = false;
					let respData = response.data;
					console.log('respData', respData);
					if (respData.error_num == '0') {
						//setTimeout(() => {
						//	vue.step = next;
						//}, 4000);
						window.location.reload();
						return false;
					}
				});
			} else {
				console.log(JSON.stringify(vue.error, null, 4));
				console.log('error gravar coreografia');
				//alert('deu erro');
				return false;
			}
			return false;
		},
		formData: function (obj) {
			var formData = new FormData();
			for (var key in obj) {
				formData.append(key, obj[key]);
			}
			return formData;
		},
		ValidateForm: function () {
			var error = 0;
			if (vue.fieldsST01.nome.length == 0) {
				vue.errorST01.nome = "Campo obrigatório";
				error++;
			}
			if (vue.fieldsST01.cpf.length == 0) {
				vue.errorST01.cpf = "Campo obrigatório";
				error++;
			}
			if (vue.fieldsST01.email.length == 0) {
				error++; vue.errorST01.email = "Obrigatório";
			} else {
				if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(vue.fieldsST01.email)) {
					error++; vue.errorST01.email = "E-mail inválido";
				}
			}
			if (vue.fieldsST01.telefone.length == 0) {
				vue.errorST01.telefone = "Campo obrigatório";
				error++;
			}
			//if(this.fieldsST01.convidados.length == 0){
			//	this.errorST01.convidados = "Campo obrigatório";
			//	error++;
			//}
			return (error === 0);
		},
		ValidateFormGravarCoreografiaOld: function () {
			this.ResetErrorGravarCoreografia();
			var error = 0;

			if (vue.fields.corgf_titulo.length == 0) {
				vue.error.corgf_titulo = "Campo obrigatório";
				error++;
			}
			if (vue.evcfg_config_limites.envio_musica == 1) {
				if (vue.fields.corgf_musica.length == 0) {
					vue.error.corgf_musica = "Campo obrigatório";
					error++;
				}
				if (vue.fields.corgf_compositor.length == 0) {
					vue.error.corgf_compositor = "Campo obrigatório";
					error++;
				}
				if (vue.fields.corgf_musica_file.length == 0) {
					vue.error.corgf_musica_file = "Campo obrigatório";
					error++;
				}

			}
			if (vue.fields.corgf_modl_id.length == 0) {
				vue.error.corgf_modl_id = "Campo obrigatório";
				error++;
			}
			if (vue.fields.corgf_formt_id.length == 0) {
				vue.error.corgf_formt_id = "Campo obrigatório";
				error++;
			}
			if (vue.fields.corgf_categ_id.length == 0) {
				vue.error.corgf_categ_id = "Campo obrigatório";
				error++;
			}

			// verifica se tem 1 coreografo relacionado
			let qtdElencoCoreografosSelect = vue.fields.elenco_coreografos.length;
			if (qtdElencoCoreografosSelect == 0) {
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Selecione o mínimo de 1 <br>coreógrafo para o formato escolhido.',
					confirmButtonText: 'Fechar',
					confirmButtonColor: "#0b8e8e",
				});
				error++;
			}

			// verifica se a quantidade de bailarinos está dentro dos limites minimos e máximos
			let formatos = vue.lista_formatos;
			let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);
			let qtdElencoBailarinoSelect = vue.fields.elenco_bailarinos.length;
			if (qtdElencoBailarinoSelect < formtEncontrado.formt_min_partic) {
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Selecione o mínimo de ' + formtEncontrado.formt_min_partic + ' <br>participantes para o formato escolhido.',
					confirmButtonText: 'Fechar',
					confirmButtonColor: "#0b8e8e",
				});
				error++;
			}

			return (error === 0);
		},
		
		ValidateFormGravarCoreografia : function(){
    this.ResetErrorGravarCoreografia();
    var error = 0;

    if(vue.fields.corgf_titulo.length == 0){
        vue.error.corgf_titulo = "Campo obrigatório";
        error++;
    }
    if( vue.evcfg_config_limites.envio_musica == 1){ 
        if(vue.fields.corgf_musica.length == 0){
            vue.error.corgf_musica = "Campo obrigatório";
            error++;
        }
        if(vue.fields.corgf_compositor.length == 0){
            vue.error.corgf_compositor = "Campo obrigatório";
            error++;
        }
        if(vue.fields.corgf_musica_file.length == 0){
            vue.error.corgf_musica_file = "Campo obrigatório";
            error++;
        }
    }
    if(vue.fields.corgf_modl_id.length == 0){
        vue.error.corgf_modl_id = "Campo obrigatório";
        error++;
    }            
    if(vue.fields.corgf_formt_id.length == 0){
        vue.error.corgf_formt_id = "Campo obrigatório";
        error++;
    }
    if(vue.fields.corgf_categ_id.length == 0){
        vue.error.corgf_categ_id = "Campo obrigatório";
        error++;
    }

    // ⭐⭐ NOVA VALIDAÇÃO PARA LINK DO YOUTUBE (quando seletiva está ativa)
    if(vue.evcfg_config_limites.seletiva == 1){
        if(!vue.fields.corgf_evcfg_seletiva || vue.fields.corgf_evcfg_seletiva.length == 0){
            vue.error.corgf_evcfg_seletiva = "Link do YouTube é obrigatório para coreografias seletivas";
            error++;
        } else if (!this.validarLinkYouTube(vue.fields.corgf_evcfg_seletiva)) {
            vue.error.corgf_evcfg_seletiva = "Link do YouTube inválido. Use um link do YouTube válido (ex: https://www.youtube.com/watch?v=...)";
            error++;
        }
    }

    // verifica se tem 1 coreografo relacionado
    let qtdElencoCoreografosSelect = vue.fields.elenco_coreografos.length;
    if( qtdElencoCoreografosSelect == 0 ){
        Swal.fire({
            title: 'Atenção!',
            icon: 'warning',
            html:
                'Selecione o mínimo de 1 <br>coreógrafo para o formato escolhido.',
            confirmButtonText: 'Fechar',
            confirmButtonColor: "#0b8e8e",
        });
        error++;
    }

    // verifica se a quantidade de bailarinos está dentro dos limites minimos e máximos
    let formatos = vue.lista_formatos;
    let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);
    let qtdElencoBailarinoSelect = vue.fields.elenco_bailarinos.length;
    if( qtdElencoBailarinoSelect < formtEncontrado.formt_min_partic ){
        Swal.fire({
            title: 'Atenção!',
            icon: 'warning',
            html:
                'Selecione o mínimo de '+ formtEncontrado.formt_min_partic +' <br>participantes para o formato escolhido.',
            confirmButtonText: 'Fechar',
            confirmButtonColor: "#0b8e8e",
        });
        error++;
    }

    return (error === 0);
},

        validarLinkYouTube: function(url) {
    // Regex para validar links do YouTube (aceita youtube.com/watch?v= e youtu.be/)
    const regexYouTube = /^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
    return regexYouTube.test(url);
},
		
		ResetErrorGravarCoreografiaOld: function () {
			vue.error.corgf_titulo = "";
			vue.error.corgf_coreografo = "";
			vue.error.corgf_musica = "";
			vue.error.corgf_compositor = "";
		},
		
		ResetErrorGravarCoreografia : function(){
            vue.error.corgf_titulo = "";
            vue.error.corgf_coreografo = "";
            vue.error.corgf_musica = "";
            vue.error.corgf_compositor = "";
            vue.error.corgf_evcfg_seletiva = ""; // ⭐⭐ ADICIONAR ESTA LINHA
        },
		
		closeOverlay: function () {
			vue.messageResult = '';
			vue.overlay.active = false;
		},
		blurField: function (event, type) {
			const value = event.target.value;
			if (value.length > 0) {
				if (type == 'email') {
					if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
						event.target.classList.remove('error');
					}
				} else {
					event.target.classList.remove('error');
				}
			}
		},
		encontrarCategoria: function (idade) {
			let LISTA_CATEG = vue.lista_categorias;
			for (let categoria of LISTA_CATEG) {
				if (idade >= categoria.idade_min && idade <= categoria.idade_max) {
					return { id: categoria.id, titulo: categoria.titulo };
				}
			}

			return 'error';

			//let inicio = 0;
			//let LISTA_CATEG = vue.lista_categorias;
			//let fim = vue.lista_categorias.length - 1;

			//while (inicio <= fim) {
			//	let meio = Math.floor((inicio + fim) / 2);
			//	let categoria = LISTA_CATEG[meio];

			//	if (idade >= categoria.idade_min && idade <= categoria.idade_max) {
			//		return categoria;
			//	} else if (idade < categoria.idade_min) {
			//		fim = meio - 1;
			//	} else {
			//		inicio = meio + 1;
			//	}
			//}
			//return null; // Retorna null se a idade não se enquadrar em nenhuma categoria
		},
		encontrarFuncao: function (fnct_id) {
			let LISTA_FUNCOES = vue.lista_funcoes;
			for (let funcoes of LISTA_FUNCOES) {
				if (fnct_id == funcoes.func_id) {
					return { id: funcoes.func_id, titulo: funcoes.func_titulo };
				}
			}
			return 'error';
		},
		clickItemCheckboxChangeCor: function (jsonDADOS, $event) {
			let partcID = jsonDADOS.partc_id;
			let participantes = vue.lista_coreografos;

			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			if (index === -1) {
				let itemEncontrado = participantes.find(item => item.partc_id === partcID);
				if (!itemEncontrado) return; // evita undefined
				vue.arrSelectUnicCor.push({
					partc_documento: itemEncontrado.partc_documento,
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome
				});
				vue.selectedCoreografos.push(partcID);
			} else {
				vue.arrSelectUnicCor.splice(index, 1);
				vue.selectedCoreografos = vue.selectedCoreografos.filter(id => id !== partcID);
			}

			vue.fields.elenco_coreografos = [...vue.selectedCoreografos];
			// Para coreógrafos, não mexa no elenco_bailarinos
			vue.fields.coreografia_elenco_all = [...vue.arrSelectUnicCor];
		},
		handleCheckboxChange: function () {
			let elencoSelecionado = vue.elencoSelecionado;

			//console.log('partc_id', partc_id);
			console.log(vue.fields.coreografia_elenco);

			let participantes = vue.fields.participantes_elenco;
			let idsProcurados = vue.fields.coreografia_elenco;
			let partCor = participantes.filter(participante => idsProcurados.includes(participante.partc_id));

			//console.log('encontrados');
			//console.log( participantesEncontrados );

			elencoSelecionado.push(...partCor);
			console.log('selecionado bailarinos');
			console.log(elencoSelecionado);

			//vue.fields.coreografia_elenco_all = participantesEncontrados;
			vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
		},
		handleCheckboxChangeCor: function (jsonDADOS) {
			let partcID = jsonDADOS.partc_id;
			let participantes = vue.lista_coreografos;
			let arrSelect = vue.elencoSelecionado;
			let arrSelectUnic = [];

			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			if (index === -1) {
				let itemEncontrado = participantes.find(item => item.partc_id === partcID);

				// Adiciona a opção ao array se não estiver presente
				vue.arrSelectUnicCor.push({
					partc_documento: itemEncontrado.partc_documento, // Substitua com o valor real
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome // Substitua com o valor real
				});
			} else {
				// Remove a opção do array se estiver presente
				vue.arrSelectUnicCor.splice(index, 1);
			}
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;
		},
		handleCheckboxChangeElenc: function (jsonDADOS, $event) {
			let partcID = jsonDADOS.partc_id;

			let formatos = vue.lista_formatos;
			let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);

			let jaSelecionado = vue.selectedBailarinos.includes(partcID);

			// Verifica se participante é do bloco 4
			let participanteBloco4 = vue.fields.participantes_inferiores.find(p => p.partc_id === partcID);
			let participanteBloco3 = vue.fields.participantes_elenco.find(p => p.partc_id === partcID);

			if (!participanteBloco3 && !participanteBloco4) {
				console.warn('Participante não encontrado', partcID);
				return;
			}

			// Se participante do bloco 4, aplicar limite de 20%
			if (participanteBloco4 && !jaSelecionado) {
				let qtdBloco3Selecionados = vue.fields.participantes_elenco.filter(p => vue.selectedBailarinos.includes(p.partc_id)).length;
				let qtdBloco4Selecionados = vue.fields.participantes_inferiores.filter(p => vue.selectedBailarinos.includes(p.partc_id)).length;
				let maxBloco4 = Math.floor(qtdBloco3Selecionados * 0.2);

				if (qtdBloco4Selecionados >= maxBloco4) {
					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html: 'Você atingiu o limite de bailarinos mais jovens (20% do elenco principal).',
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
					$event.target.checked = false;
					return;
				}
			}

			// Verifica limite do formato (bloco 3 + bloco 4)
			let qtdElencoBailarinoSelect = vue.fields.elenco_bailarinos.length;
			if (!jaSelecionado && qtdElencoBailarinoSelect >= formtEncontrado.formt_max_partic) {
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html: 'Você já selecionou o número máximo de participantes para o formato escolhido.',
					confirmButtonText: 'Fechar',
					confirmButtonColor: "#0b8e8e",
				});
				$event.target.checked = false;
				return;
			}

			// Encontrar participante no array correto
			let itemEncontrado = participanteBloco3 || participanteBloco4;

			// Selecionar / deselecionar
			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			if (index === -1) {
				vue.arrSelectUnicCor.push({
					partc_documento: itemEncontrado.partc_documento,
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome
				});
				vue.selectedBailarinos.push(partcID);
			} else {
				vue.arrSelectUnicCor.splice(index, 1);
				vue.selectedBailarinos = vue.selectedBailarinos.filter(id => id !== partcID);
			}

			vue.fields.elenco_bailarinos = vue.selectedBailarinos;
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;
		},

		handleCheckboxChangeCoreogf: function (jsonDADOS, $event) {
			//alert('entrou aqui');
			let partcID = jsonDADOS.partc_id;

			let participantes = vue.lista_coreografos;
			let itemEncontrado = [];

			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			//if (index === -1 && event.target.checked) {
			if (index === -1) {
				itemEncontrado = participantes.find(item => item.partc_id === partcID);
				// Adiciona a opÃ§Ã£o ao array se nÃ£o estiver presente
				vue.arrSelectUnicCor.push({
					partc_documento: itemEncontrado.partc_documento,
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome
				});
				vue.selectedCoreografos.push(partcID);
				vue.fields.elenco_coreografos = vue.selectedCoreografos;
				//} else if (index !== -1 && !event.target.checked) {
			} else if (index !== -1) {
				// Remove a opÃ§Ã£o do array se estiver presente
				vue.arrSelectUnicCor.splice(index, 1);
				vue.selectedCoreografos = vue.selectedCoreografos.filter(id => id !== partcID);
				vue.fields.elenco_coreografos = vue.selectedCoreografos;
			}

			//console.log( vue.arrSelectUnicCor );
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;
		},
		excluirCoreografia: function (jsonDADOS) {
			console.log('corgf_hashkey', jsonDADOS.hashkey);
			let hashKeyToRemove = jsonDADOS.hashkey;
			let arrSelect = vue.lista_corf_cadastradas;
			let itemEncontrado = arrSelect.find(item => item.corgf_hashkey === hashKeyToRemove);

			if (itemEncontrado) {
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você deseja realmente excluir este registro?<br>' +
						'[' + hashKeyToRemove + ']<br>' +
						'Esta ação não poderá ser revertida.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function (result) {
					if (result.value) {
						// ------------------------------------------------------
						var form = new FormData();
						form.append('corgf_hashkey', hashKeyToRemove);
						axios.post(vue.urlPost + 'inscricoes/ajaxform/EXCLUIR-COREOGRAFIA', form).then(function (response) {
							let respData = response.data;
							if (respData.error_num == '0') {
								arrSelect = arrSelect.filter(item => item.corgf_hashkey !== hashKeyToRemove);
								vue.lista_corf_cadastradas = arrSelect;
								window.location.reload();
								return false;
							}
						});
						// ------------------------------------------------------
					}
				});
			}


			//console.log( 'hashKeyToRemove: ', hashKeyToRemove );
			//let arrSelect = vue.fields.participantes;
			//if(this.ValidateFormGravarCoreografia()){
			//	/*
			//	VALIDACOES
			//	*/
			//	//console.log( JSON.stringify(vue.fields, null, 4) );
			//	//return false;
			//	vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
			//	let form = this.formData(vue.fields);
			//	axios.post(this.urlPost +'inscricoes/ajaxform/SALVAR-ELENCO-COREOGRAFIA', form).then(function(response){
			//		//vue.loading.active = false;
			//		let respData = response.data;
			//		console.log('respData', respData);
			//		if( respData.error_num == '0' ){
			//			//setTimeout(() => {
			//			//	vue.step = next;
			//			//}, 4000);
			//			return false;
			//		}
			//	});
			//}else{
			//	console.log('error gravar coreografia');
			//	//alert('deu erro');
			//	return false;
			//}
			//return false;
		},
		loadEditCoreografia: function (jsonDADOS) {
			console.log('corgf_hashkey', jsonDADOS.hashkey);
			let hashKeyToRemove = jsonDADOS.hashkey;
			let arrSelect = vue.lista_corf_cadastradas;
			let itemEncontrado = arrSelect.find(item => item.corgf_hashkey === hashKeyToRemove);
			if (itemEncontrado) {
				vue.selectedItems = [];

				// ------------------------------------------------------
				var form = new FormData();
				form.append('corgf_hashkey', hashKeyToRemove);
				axios.post(vue.urlPost + 'inscricoes/ajaxform/LOAD-EDIT-COREOGRAFIA', form).then(function (response) {
					let respData = response.data;
					if (respData.error_num == '0') {
						vue.fields.corgf_hashkey = respData.dados.corgf_hashkey;
						vue.fields.corgf_coreografo = [];
						vue.fields.corgf_titulo = respData.dados.corgf_titulo;
						vue.fields.corgf_musica = respData.dados.corgf_musica;
						vue.fields.corgf_compositor = respData.dados.corgf_compositor;
						vue.fields.corgf_musica_file = respData.dados.corgf_musica_file;
						vue.fields.corgf_tempo = respData.dados.corgf_tempo;
						vue.fields.corgf_musica_msg = respData.dados.corgf_musica_msg;

						vue.fields.corgf_observacao = respData.dados.corgf_observacao;
						vue.fields.corgf_modl_id = respData.dados.modl_id;
						vue.fields.corgf_formt_id = respData.dados.formt_id;
						vue.fields.corgf_categ_id = respData.dados.categ_id;
						vue.fields.corgf_evcfg_seletiva = respData.dados.corgf_linkvideo;
						//vue.fields.corgf_coreografo = respData.coreografos;
						vue.fields.corgf_coreografo = [];

						vue.selectFormato();
						vue.selectCategCoreografia();

						vue.fields.coreografia_elenco_all = respData.elenco_selecionado;
						//vue.fields.coreografia_elenco = respData.coreografia_elenco;
						vue.arrSelectUnicCor = respData.elenco_selecionado;
						//vue.arrSelectUnicCor = respData.elenco_selecionado;

						respData.elenco_selecionado.forEach(item => {
							vue.selectedItems.push(item.partc_id);
						});
						vue.fields.coreografia_elenco = vue.selectedItems;

						// coreografos
						vue.selectedCoreografos = [];
						respData.elenco_coreografos.forEach(item => {
							vue.selectedCoreografos.push(item.partc_id);
						});
						vue.fields.elenco_coreografos = vue.selectedCoreografos;

						// bailarinos
						vue.selectedBailarinos = [];
						respData.elenco_bailarinos.forEach(item => {
							vue.selectedBailarinos.push(item.partc_id);
						});
						vue.fields.elenco_bailarinos = vue.selectedBailarinos;

						vue.corgfBTNDisabled = false;
						vue.editar_coreografia = 1;

						// mover para o topo
						window.scrollTo(0, 0);

						return false;
					}
				});
				// ------------------------------------------------------
			}
		},
		converterParaSegundos: function (tempo) {
			let partes = tempo.split(':');
			if (partes.length === 3) {
				let horas = parseInt(partes[0], 10);
				let minutos = parseInt(partes[1], 10);
				let segundos = parseInt(partes[2], 10);
				return `${horas * 3600 + minutos * 60 + segundos}`.padStart(2, '0');
			} else if (partes.length === 2) {
				let minutos = parseInt(partes[0], 10);
				let segundos = parseInt(partes[1], 10);
				return `${minutos * 60 + segundos}`.padStart(2, '0');
			}
			return '00'; // Se o formato for inválido, retorna '00' segundos.
		},
		converterParaMinutosESegundos: function (segundos) {
			let minutos = Math.floor(segundos / 60);
			let segundosRestantes = segundos % 60;
			//return `${minutos}:${segundosRestantes}`;
			return `${minutos.toString().padStart(2, '0')}:${segundosRestantes.toString().padStart(2, '0')}`;
		},
		selecionarArquivo: function (event) {
			vue.error.corgf_musica_msg = "";
			vue.fields.corgf_musica_file = "";
			let tempoTotal = 0;
			let files = event.target.files;
			for (let i = 0; i < files.length; i++) {
				if (files[i].type === 'audio/mpeg' || files[i].name.endsWith('.mp3')) {
					let audioElement = new Audio();
					audioElement.src = URL.createObjectURL(files[i]);
					audioElement.addEventListener('loadedmetadata', () => {
						tempoTotal += parseInt(audioElement.duration);
						vue.fields.corgf_tempo = this.converterParaMinutosESegundos(tempoTotal);
						if (vue.fields.corgf_tempo > vue.fields.corgf_tempo_max) {
							//vue.fields.corgf_tempo = '';
							vue.error.corgf_musica_msg = "Música com tempo maior que o permitido.";
							event.target.value = '';
						} else {
							vue.fields.corgf_musica_file = files[i].name;
							vue.imageFileMusica = files[i];
						}
					});
					audioElement.load();
				} else {
					vue.error.corgf_musica_msg = "Tipo de arquivo inválido. Permitido somente MP3.";
					event.target.value = '';
				}
			}
		},
		sendmail_autorizacoes: function () {
			//let form = this.formData(vue.fields);
			axios.post(this.urlPost + 'inscricoes/ajaxform/SENDMAIL-AUTORIZACOES', form).then(function (response) {

				if (respData.error_num == '1') {
					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html: respData.error_msg,
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
					return false;
				}

			});
		},

		selectCategInferior: function () {
			const categoriasOrdem = ['Adulto', 'Juvenil', 'Infantil', 'Baby Class'];

			// 1. Descobre o título da categoria escolhida (usando lista_categorias_all)
			let selecionadaObj = vue.lista_categorias_all.find(c => c.categ_id == vue.fields.corgf_categ_id);
			let selecionada = selecionadaObj ? selecionadaObj.categ_titulo : null;

			if (!selecionada) {
				vue.fields.participantes_inferiores = [];
				return;
			}

			// 2. Descobre quais categorias vêm abaixo
			let idx = categoriasOrdem.indexOf(selecionada);
			if (idx === -1) {
				vue.fields.participantes_inferiores = [];
				return;
			}
			let categoriasInferiores = categoriasOrdem.slice(idx + 1);

			// 3. Filtra do all
			vue.fields.participantes_inferiores = vue.fields.participantes_elenco_all.filter(p =>
				categoriasInferiores.includes(p.categ_titulo)
			);

			console.log("Categoria escolhida:", selecionada);
			console.log("Categorias inferiores:", categoriasInferiores);
			console.log("Participantes inferiores:", vue.fields.participantes_inferiores);
		}




	},



	//beforeMount() {
	//	// carregar assim que montar a tela
	//	setTimeout(() => {
	//		// Chame a função que deseja executar após 2 segundos
	//		this.loadCoreografos();
	//	}, 500);
	//},
	mounted: function () {
		//this.fields.grp_titulo = this.$refs.grp_titulo.defaultValue;
		for (let fieldName in this.fields) {
			if (Object.prototype.hasOwnProperty.call(this.fields, fieldName)) {
				const fieldRef = this.$refs[fieldName];
				if (fieldRef) {
					this.fields[fieldName] = fieldRef.defaultValue;
				}
			}
		}

		var SPMaskBehavior = function (val) {
			return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		},
			spOptions = {
				placeholder: "(__) ____-____",
				onKeyPress: function (val, e, field, options) {
					field.mask(SPMaskBehavior.apply({}, arguments), options);
				}
			};
		$('.mask-phone').mask(SPMaskBehavior, spOptions);
		//$(".mask-cpf").mask('000.000.000-00', {placeholder: "___.___.___-__", clearIfNotMatch: true});
		$(".mask-cpf").mask('000.000.000-00', { placeholder: "___.___.___-__", clearIfNotMatch: true });
		$(".mask-date").mask('00/00/0000', { placeholder: "dd/mm/aaaa", clearIfNotMatch: true });
		$(".mask-cnpj").mask('00.000.000/0000-00', { placeholder: "__.___.___/____-__", clearIfNotMatch: true });

		$(".mask-cep").mask('00000-000', { placeholder: "_____-__", clearIfNotMatch: true });
	},

});
/**
 * --------------------------------------------------------
 * end : COREOGRAFIAS
 * --------------------------------------------------------
**/
