
/**
 * --------------------------------------------------------
 * ini : INICIAL
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 1,
		substep: 1,
		show_form: 0,		// SE NÃO EXISTIR GRUPOS CADASTRADOS, DEVE-SE MOSTRAR O FORMULÁRIO DIRETO
		fields : {
			event_hashkey : STR_EVENT_HASHKEY,
			grp_id : '',
			grp_hashkey : '',
			
			// Step 1
			grp_titulo : '',
			grp_responsavel : '',
			grp_cpf : '',
			grp_telefone : '',
			grp_celular : '',
			grp_whatsapp : '',

			grp_sm_instagram : '',
			grp_sm_facebook : '',
			grp_sm_youtube : '',
			grp_sm_vimeo : '',

			grp_end_cep : '',
			grp_end_logradouro : '',
			grp_end_numero : '',
			grp_end_compl : '',
			grp_end_bairro : '',
			grp_end_cidade : '',
			grp_end_estado : '',

			grp_file_logotipo : '',
		},
		coreografos : [],
		selectedParticipants : [],
		error : {
			grp_id : '',
			grp_hashkey : '',

			// Step 1
			grp_titulo : '',
			grp_responsavel : '',
			grp_cpf : '',
			grp_telefone : '',
			grp_celular : '',
			grp_whatsapp : '',

			grp_sm_instagram : '',
			grp_sm_facebook : '',
			grp_sm_youtube : '',
			grp_sm_vimeo : '',

			grp_end_cep : '',
			grp_end_logradouro : '',
			grp_end_numero : '',
			grp_end_compl : '',
			grp_end_bairro : '',
			grp_end_cidade : '',
			grp_end_estado : '',

			grp_file_logotipo : '',
		},

		previewLogotipo : null,
		imageLogotipo : null,

		overlay : { active : false },
		loading : { active : false },

		partcBTNDisabled : false,
		corgfBTNDisabled : true,

		urlPost : SITE_URL,
		messageResult : '',
		//disabledButton : false,
	},

	methods : {
		showForm : function(show){
			vue.show_form = show;
		},
		salvarFormGrupo : function(){
			if(this.ValidateFormGravarGrupo()){
				//let form = this.formData(vue.fields);
				//console.log( JSON.stringify(vue.fields, null, 4) );
				////console.log('urlPost', this.urlPost );
				//return false;
				//vue.loading.active = true;

				const form = this.$refs.formFieldsInscricao;
				form.submit();

				return false;

				//axios.post(this.urlPost +'inscricoes/ajaxform/SALVAR-GRUPO', form).then(function(response){
				//	//vue.loading.active = false;
				//	let respData = response.data;
				//	//console.log('respData', respData);
				//	if( respData.error_num == '0' ){

				//		vue.fields.grp_id = respData.grp_id;
				//		vue.fields.grp_hashkey = respData.grp_hashkey;

				//		setTimeout(() => {
				//			vue.step = next;
				//		}, 1000);
				//		return false;
				//	}
				//});
			}else{
				console.log('error gravar grupo');
				//alert('deu erro');
				return false;
			}
		},
		formData : function(obj){
			var formData = new FormData();
			for(var key in obj){
				formData.append(key, obj[key]);
			}
			return formData;
		},
		ValidateFormGravarGrupo : function(){
			this.ResetErrorGravarGrupo();
			var error = 0;

			if(vue.fields.grp_titulo.length == 0){
				vue.error.grp_titulo = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_responsavel.length == 0){
				vue.error.grp_responsavel = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_cpf.length == 0){
				vue.error.grp_cpf = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_telefone.length == 0){
				vue.error.grp_telefone = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_celular.length == 0){
				vue.error.grp_celular = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_end_cep.length == 0){
				vue.error.grp_end_cep = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_end_logradouro.length == 0){
				vue.error.grp_end_logradouro = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_end_numero.length == 0){
				vue.error.grp_end_numero = "Obrigatório";
				error++;
			}
			if(vue.fields.grp_end_bairro.length == 0){
				vue.error.grp_end_bairro = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_end_cidade.length == 0){
				vue.error.grp_end_cidade = "Campo obrigatório";
				error++;
			}
			if(vue.fields.grp_end_estado.length == 0){
				vue.error.grp_end_estado = "Requerido";
				error++;
			}
			if(vue.fields.grp_file_logotipo.length == 0){
				vue.error.grp_file_logotipo = "Obrigatório";
				error++;
			}
			return (error === 0);
		},
		ResetFieldsGrupo : function(){
			vue.fields.grp_id = "";
			vue.fields.grp_hashkey = "";
			vue.fields.grp_titulo = "";
			vue.fields.grp_responsavel = "";
			vue.fields.grp_cpf = "";
			vue.fields.grp_telefone = "";
			vue.fields.grp_celular = "";

			vue.fields.grp_sm_instagram = "";
			vue.fields.grp_sm_facebook = "";
			vue.fields.grp_sm_youtube = "";
			vue.fields.grp_sm_vimeo = "";

			vue.fields.grp_end_cep = "";
			vue.fields.grp_end_logradouro = "";
			vue.fields.grp_end_numero = "";
			vue.fields.grp_end_bairro = "";
			vue.fields.grp_end_cidade = "";
			vue.fields.grp_end_estado = "";
		},
		ResetErrorGravarGrupo : function(){
			vue.error.grp_id = "";
			vue.error.grp_hashkey = "";
			vue.error.grp_titulo = "";
			vue.error.grp_responsavel = "";
			vue.error.grp_cpf = "";
			vue.error.grp_telefone = "";
			vue.error.grp_celular = "";

			vue.error.grp_end_cep = "";
			vue.error.grp_end_logradouro = "";
			vue.error.grp_end_numero = "";
			vue.error.grp_end_bairro = "";
			vue.error.grp_end_cidade = "";
			vue.error.grp_end_estado = "";
		},
		removeGrupo : function( jsonDADOS ){
			let grp_hashkey = jsonDADOS.hashkey;
			if(grp_hashkey.length != ""){
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você deseja realmente excluir este registro?<br>'+
						'Esta ação não poderá ser revertida.',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						var form = new FormData();
						form.append('grp_hashkey', grp_hashkey);

						axios.post(vue.urlPost +'inscricoes/ajaxform/EXCLUIR-GRUPO', form).then(function(response){
							let respData = response.data;
							if( respData.error_num == '0' ){
								Swal.fire({
									title: 'Atenção!',
									icon: 'success',
									html: respData.error_msg,
									confirmButtonText: 'Fechar',
									confirmButtonColor: "#0b8e8e",
								});

								//setTimeout(() => {
								//	window.location.reload();
								//}, 3000);

								var element = document.getElementById(grp_hashkey);
								if (element) {
									element.parentNode.removeChild(element);
								}

								//console.log('Valor partc_hashkey do item removido:', valorPartcHashKey);
								//console.log(valorPartcHashKey);

								//arrSelect = arrSelect.filter(item => item.partc_hashkey !== hashKeyToRemove);
								//vue.fields.participantes = arrSelect;

								//return false;
							}
						});
						// ------------------------------------------------------
					}
				});
			}
		},
		editarGrupo : function( jsonDADOS ){
			let grp_hashkey = jsonDADOS.hashkey;
			if(grp_hashkey.length != ""){
				// ------------------------------------------------------
				var form = new FormData();
				form.append('grp_hashkey', grp_hashkey);

				axios.post(vue.urlPost +'inscricoes/ajaxform/EDITAR-GRUPO', form).then(function(response){
					let respData = response.data;
					if( respData.error_num == '0' ){
						vue.show_form = 1;

						vue.fields.grp_hashkey = respData.dados.grp_hashkey;
						vue.fields.grp_titulo = respData.dados.grp_titulo;
						vue.fields.grp_responsavel = respData.dados.grp_responsavel;
						vue.fields.grp_cpf = respData.dados.grp_cpf;
						vue.fields.grp_telefone = respData.dados.grp_telefone;
						vue.fields.grp_celular = respData.dados.grp_celular;
						vue.fields.grp_whatsapp = respData.dados.grp_whatsapp;
						vue.fields.grp_sm_instagram = respData.dados.grp_sm_instagram;
						vue.fields.grp_sm_facebook = respData.dados.grp_sm_facebook;
						vue.fields.grp_sm_youtube = respData.dados.grp_sm_youtube;
						vue.fields.grp_sm_vimeo = respData.dados.grp_sm_vimeo;

						vue.fields.grp_end_cep = respData.dados.grp_end_cep;
						vue.fields.grp_end_logradouro = respData.dados.grp_end_logradouro;
						vue.fields.grp_end_numero = respData.dados.grp_end_numero;
						vue.fields.grp_end_compl = respData.dados.grp_end_compl;
						vue.fields.grp_end_bairro = respData.dados.grp_end_bairro;
						vue.fields.grp_end_cidade = respData.dados.grp_end_cidade;
						vue.fields.grp_end_estado = respData.dados.grp_end_estado;
						vue.fields.grp_file_logotipo = respData.dados.grp_logotipo;
					}
				});
				// ------------------------------------------------------
			}
		},
		InscreverGrupo : function( jsonDADOS ){
			let grp_hashkey = jsonDADOS.grp_hashkey;
			let event_hashkey = jsonDADOS.event_hashkey;
			if(grp_hashkey.length >= 1 && event_hashkey.length >= 1){
				// ------------------------------------------------------
				var form = new FormData();
				form.append('grp_hashkey', grp_hashkey);
				form.append('event_hashkey', event_hashkey);

				axios.post(vue.urlPost +'inscricoes/ajaxform/INSCREVER-GRUPO', form).then(function(response){
					let respData = response.data;
					if( respData.error_num == '0' ){
						Swal.fire({
							title: 'Atenção!',
							icon: 'success',
							html: respData.error_msg,
							confirmButtonText: 'Fechar',
							confirmButtonColor: "#0b8e8e",
						});
						setTimeout(() => {
							window.location.href = respData.redirect;
							//window.location.reload();
						}, 3500);
					}else{
						Swal.fire({
							title: 'Atenção!',
							icon: 'error',
							html: respData.error_msg,
							confirmButtonText: 'Fechar',
							confirmButtonColor: "#0b8e8e",
						});
					}
				});
				// ------------------------------------------------------
			}
		},
		blurCheckCEP : function(){
			let strDefault = vue.fields.grp_end_cep;
			strDefault = strDefault.replace(/\D/g, '');
			let strCEP = strDefault.trim();

			//let url = 'https://cdn.apicep.com/file/apicep/'+ strCEP +'.json';
			let url = 'https://viacep.com.br/ws/'+ strCEP +'/json/';
			fetch(url)
			.then((response) => {
				if (!response.ok) {
					throw new Error("Erro ao buscar o endereço");
				}
				return response.json();
			})
			.then((data) => {
				let respData = data;
				vue.fields.grp_end_logradouro = respData.logradouro;
				vue.fields.grp_end_bairro = respData.bairro;
				vue.fields.grp_end_cidade = respData.localidade;
				vue.fields.grp_end_estado = respData.uf;
			})
			.catch((error) => {
				console.error("Erro:", error);
			});
			/*
			let strDefault = vue.fields.grp_end_cep;
			strDefault = strDefault.replace(/\D/g, '');
			let strCEP = strDefault.trim();
			axios.get('https://api.postmon.com.br/v1/cep/'+ strCEP).then(function(response){
				if( response.data )
				{
					let respData = response.data;
					vue.fields.grp_end_logradouro = respData.logradouro;
					vue.fields.grp_end_bairro = respData.bairro;
					vue.fields.grp_end_cidade = respData.cidade;
					vue.fields.grp_end_estado = respData.estado;
				}
			}).catch((error) => {
				vue.fields.grp_end_logradouro = '';
				vue.fields.grp_end_bairro = '';
				vue.fields.grp_end_cidade = '';
				vue.fields.grp_end_estado = '';
			});
			*/
		},
		CancelarAcao : function(){
			this.ResetErrorGravarGrupo();
			this.ResetFieldsGrupo();
			vue.show_form = 0;
		},
		closeOverlay : function(){
			vue.messageResult = '';	
			vue.overlay.active = false;
		},
		blurField : function( event, type ){
			const value = event.target.value;
			if(value.length > 0){
				if(type == 'email'){
					if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( value )) {
						event.target.classList.remove('error');		
					}
				}else{
					event.target.classList.remove('error');	
				}
			}
		},
		calcularIdade : function( dataNascimento ){
			var partes = dataNascimento.split("/");
			var dia = parseInt(partes[0]);
			var mes = parseInt(partes[1]) - 1; // Meses em JavaScript são indexados a partir de 0
			var ano = parseInt(partes[2]);

			var hoje = new Date();
			var nascimento = new Date(ano, mes, dia);
			var idade = hoje.getFullYear() - nascimento.getFullYear();
			var mes = hoje.getMonth() - nascimento.getMonth();

			if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
				idade--;
			}

			return idade;
		},
		encontrarCategoria : function( idade ){
			let LISTA_CATEG = vue.lista_categorias;
			for (let categoria of LISTA_CATEG) {
				if (idade >= categoria.idade_min && idade <= categoria.idade_max) {
					return { id : categoria.id, titulo : categoria.titulo } ;
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
		encontrarFuncao : function( fnct_id ){
			let LISTA_FUNCOES = vue.lista_funcoes;
			for (let funcoes of LISTA_FUNCOES) {
				if (fnct_id == funcoes.func_id) {
					return { id : funcoes.func_id, titulo : funcoes.func_titulo } ;
				}
			}
			return 'error';
		},
		pickFile(event, refName, previewVariable, imageVariable, fieldVariable) {
			console.log('File picked');
			let input = this.$refs[refName];
			let file = input.files;
			if (file && file[0]) {
				var reader = new FileReader();
				reader.onload = (e) => {
					this[previewVariable] = e.target.result;
				};
				this[imageVariable] = input.files[0];
				//this.$emit('update:' + fieldVariable, this[imageVariable].name);
				vue.fields[fieldVariable] = this[imageVariable].name;
				reader.readAsDataURL(input.files[0]);
				this.$emit('input', file[0]);
			}
		},
		handleCheckboxChange : function(){
			//console.log('partc_id', partc_id);
			console.log( vue.fields.coreografia_elenco );

			let participantes = vue.fields.participantes_elenco;
			let idsProcurados = vue.fields.coreografia_elenco;
			const participantesEncontrados = participantes.filter(participante => idsProcurados.includes(participante.partc_id));

			console.log('encontrados');
			console.log( participantesEncontrados );

			vue.fields.coreografia_elenco_all = participantesEncontrados;
			vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
		}
	},

	//beforeMount() {
	//	// carregar assim que montar a tela
	//	setTimeout(() => {
	//		// Chame a função que deseja executar após 2 segundos
	//		this.loadCoreografos();
	//	}, 500);
	//},
	mounted: function (){
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
			onKeyPress: function(val, e, field, options) {
				field.mask(SPMaskBehavior.apply({}, arguments), options);
			}
		};
		$('.mask-phone').mask(SPMaskBehavior, spOptions);
		//$(".mask-cpf").mask('000.000.000-00', {placeholder: "___.___.___-__", clearIfNotMatch: true});
		$(".mask-cpf").mask('000.000.000-00', {placeholder: "___.___.___-__", clearIfNotMatch: true});
		$(".mask-date").mask('00/00/0000', {placeholder: "dd/mm/aaaa", clearIfNotMatch: true});
		$(".mask-cnpj").mask('00.000.000/0000-00', {placeholder: "__.___.___/____-__",clearIfNotMatch: true});

		$(".mask-cep").mask('00000-000', {placeholder: "_____-__", clearIfNotMatch: true});

		// Verifica se a API Clipboard é suportada pelo navegador
		function handlePasteEvent() {
			if (navigator.clipboard) {
				console.log('clipboard');

				// Obtém o conteúdo da área de transferência
				navigator.clipboard.readText().then(function (clipboardData) {
					// Verifica se a área de transferência não está vazia

					console.log('codigo copiado: '+ clipboardData );

					if (clipboardData.trim() !== '') {
						console.log('passou aqui: '+ clipboardData );

						// Limpa os campos antes de preenchê-los
						//clearFields();

						console.log('quant caracteres: '+ clipboardData.length);

						// Percorre cada caractere da área de transferência
						for (var i = 0; i < clipboardData.length; i++) {
							// Obtém o próximo caractere
							var caractere = clipboardData.charAt(i);

							console.log( 'caractere', caractere );

							// Obtém o ID do campo correspondente
							//this.$set(vue.fields, 'campo_' + (i + 1), caractere);

							if ((i + 1) == 1) { vue.$set(vue.fields, 'campo_1', caractere); }
							if ((i + 1) == 2) { vue.$set(vue.fields, 'campo_2', caractere); }
							if ((i + 1) == 3) { vue.$set(vue.fields, 'campo_3', caractere); }
							if ((i + 1) == 4) { vue.$set(vue.fields, 'campo_4', caractere); }
							if ((i + 1) == 5) { vue.$set(vue.fields, 'campo_5', caractere); }
							if ((i + 1) == 6) { vue.$set(vue.fields, 'campo_6', caractere); }

							//if( (i + 1) == 1){ this.fields.campo_1 = caractere; }
							//if( (i + 1) == 2){ this.fields.campo_2 = caractere; }
							//if( (i + 1) == 3){ this.fields.campo_3 = caractere; }
							//if( (i + 1) == 4){ this.fields.campo_4 = caractere; }
							//if( (i + 1) == 5){ this.fields.campo_5 = caractere; }
							//if( (i + 1) == 6){ this.fields.campo_6 = caractere; }

							//var campoId = 'campo_' + (i + 1);

							//vue.fields.campo_2

							// Preenche o campo correspondente com o caractere
							//document.getElementById(campoId).value = caractere;
						}

					} else {
						console.log('A área de transferência está vazia.');
					}
				}).catch(function (err) {
					// A área de transferência está vazia, não é um erro
					//console.error('Erro ao ler área de transferência:', err);
				});

			} else {
				console.error('A API Clipboard não é suportada pelo navegador.');
			}
		}

		// Função para limpar os campos
		//function clearFields() {
		//	for (var i = 1; i <= 10; i++) {
		//		var campoId = 'campo_' + i;
		//		document.getElementById(campoId).value = '';
		//	}
		//}

		// Adiciona um ouvinte de eventos para a tecla de colar
		document.addEventListener('paste', function (event) {
			// Chama a função de manipulação apenas quando o comando de colar é acionado
			//handlePasteEvent();
		});
	},

});
/**
 * --------------------------------------------------------
 * end : INICIAL
 * --------------------------------------------------------
**/	
