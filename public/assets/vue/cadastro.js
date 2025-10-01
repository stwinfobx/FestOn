
/**
 * --------------------------------------------------------
 * ini : INICIAL
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 1,
		fields : {	
			insti_id : '',
			insti_hashkey : '',

			insti_nome : '',
			insti_cnpj : '',
			insti_email : '',
			insti_senha : '',
			insti_senha_conf : '',
			insti_telefone : '',
			insti_celular : '',
			insti_whatsapp : '',

			insti_resp_nome : '',
			insti_resp_cpf : '',

			insti_sm_instagram : '',
			insti_sm_facebook : '',
			insti_sm_youtube : '',
			insti_sm_vimeo : '',

			insti_end_cep : '',
			insti_end_logradouro : '',
			insti_end_numero : '',
			insti_end_compl : '',
			insti_end_bairro : '',
			insti_end_cidade : '',
			insti_end_estado : '',

			insti_file_logotipo : '',
			insti_file_cartao_cnpj : '',
			insti_file_contr_social : '',
			insti_file_doc_rg : '',
			insti_file_doc_cpf : '',
		},
		error : {
			insti_id : '',
			insti_hashkey : '',

			insti_nome : '',
			insti_cnpj : '',
			insti_email : '',
			insti_senha : '',
			insti_senha_conf : '',
			insti_telefone : '',
			insti_celular : '',
			insti_whatsapp : '',

			insti_resp_nome : '',
			insti_resp_cpf : '',

			insti_sm_instagram : '',
			insti_sm_facebook : '',
			insti_sm_youtube : '',
			insti_sm_vimeo : '',

			insti_end_cep : '',
			insti_end_logradouro : '',
			insti_end_numero : '',
			insti_end_compl : '',
			insti_end_bairro : '',
			insti_end_cidade : '',
			insti_end_estado : '',

			insti_file_logotipo : '',
			insti_file_cartao_cnpj : '',
			insti_file_contr_social : '',
			insti_file_doc_rg : '',
			insti_file_doc_cpf : '',
		},

		count_timer : 60,
		codigo_error : 0,
		link_painel_poravo : '',

		previewLogotipo : null,
		imageLogotipo : null,

		previewCartaoCNPJ : null,
		imageCartaoCNPJ : null,

		previewContrSocial : null,
		imageContrSocial : null,

		previewDocRG : null,
		imageDocRG : null,

		previewLDocCPF : null,
		imageDocCPF : null,

		overlay : { active : false },
		loading : { active : false },

		urlPost : SITE_URL,
		messageResult : '',
		//disabledButton : false,
	},

	methods : {
		prevStep : function( next ){
			vue.step = next;
			//vue.substep = subNext;
		},
		nextStep : function( next ){
			vue.step = next;
			//vue.substep = subNext;
		},
		stepSalvarCadastro : function( next ){
			if(this.ValidateFormSalvarCadastro()){
				let form = this.formData(vue.fields);
				form.append('fileInputLogotipo', this.imageLogotipo);
				form.append('fileInputCartaoCNPJ', this.imageCartaoCNPJ);
				form.append('fileInputContrSocial', this.imageContrSocial);
				form.append('fileInputDocRG', this.imageDocRG);
				form.append('fileInputDocCPF', this.imageDocCPF);

				//form.append('fileInputAssinatura1', this.imageAssinatura1);
				//form.append('fileInputAssinatura2', this.imageAssinatura2);
				//console.log( JSON.stringify(vue.fields, null, 4) );
				////console.log('urlPost', this.urlPost );
				//return false;
				//vue.loading.active = true;

				axios.post(this.urlPost +'cadastro/ajaxform/CADASTRAR-INSTITUICAO', form).then(function(response){
					//vue.loading.active = false;
					let respData = response.data;
					//console.log('respData', respData);
					if( respData.error_num == '0' ){

						vue.fields.insti_id = respData.insti_id;
						vue.fields.insti_hashkey = respData.insti_hashkey;

						setTimeout(() => {
							vue.step = next;
						}, 1000);
						return false;
					}else{
						//vue.partcBTNDisabled = true;
						Swal.fire({
							title: 'Atenção!',
							icon: 'warning',
							html: respData.error_msg,
							confirmButtonText: 'Fechar',
							confirmButtonColor: "#0b8e8e",
						});
						return false;
						//alert( respData.error_msg );
					}
				});
				return false;
			}else{
				console.log('error gravar grupo');
				//alert('deu erro');
				return false;
			}
		},
		concluirCadastro : function( next, subNext ){
			let form = this.formData(vue.fields);
			//form.append ('reserva_hashkey', vue.reserva_hashkey);
			console.log( JSON.stringify(vue.fields, null, 4) );
			console.log('urlPost', this.urlPost );

			axios.post(this.urlPost +'ajaxform/CONCLUIR-CADASTRO', form).then(function(response){
				console.log('respData', response.data);
				if( response.data ){
					let respData = response.data;
					//console.log('respData', respData);
					if( respData.success == 'nao' ){
						//vue.codigo_error =  1;
					}else{
						//vue.codigo_error = 0;
						vue.step = next;
						vue.substep = subNext;
						vue.link_painel_poravo = respData.redirect;
						console.log( respData.redirect );
					}
					return false;
				}
			});
		},
		formData : function(obj){
			var formData = new FormData();
			for(var key in obj){
				formData.append(key, obj[key]);
			}
			return formData;
		},
		ValidateForm : function(){
			var error = 0;
			if(vue.fieldsST01.nome.length == 0){
				vue.errorST01.nome = "Campo obrigatório";
				error++;
			}
			if(vue.fieldsST01.cpf.length == 0){
				vue.errorST01.cpf = "Campo obrigatório";
				error++;
			}			
			if(vue.fieldsST01.email.length == 0){
				error++; vue.errorST01.email = "Obrigatório";
			}else {
				if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( vue.fieldsST01.email )) {
					error++; vue.errorST01.email = "E-mail inválido";
				}
			}
			if(vue.fieldsST01.telefone.length == 0){
				vue.errorST01.telefone = "Campo obrigatório";
				error++;
			}
			//if(this.fieldsST01.convidados.length == 0){
			//	this.errorST01.convidados = "Campo obrigatório";
			//	error++;
			//}
			return (error === 0);
		},
		ValidateFormSalvarCadastro : function(){
			//this.ResetErrorGravarGrupo();
			var error = 0;
			//return (error === 0);

			if(vue.fields.insti_nome.length == 0){
				vue.error.insti_nome = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_cnpj.length == 0){
				vue.error.insti_cnpj = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_email.length == 0){
				vue.error.insti_email = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_senha.length == 0){
				vue.error.insti_senha = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_senha_conf.length == 0){
				vue.error.insti_senha_conf = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_senha != vue.fields.insti_senha_conf ){
				vue.error.insti_senha_conf = "As senhas devem ser iguais.";
				error++;
			}
			if(vue.fields.insti_celular.length == 0){
				vue.error.insti_celular = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_whatsapp.length == 0){
				vue.error.insti_whatsapp = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_resp_nome.length == 0){
				vue.error.insti_resp_nome = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_resp_cpf.length == 0){
				vue.error.insti_resp_cpf = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_file_logotipo.length == 0){
				vue.error.insti_file_logotipo = "Obrigatório";
				error++;
			}
			if(vue.fields.insti_file_cartao_cnpj.length == 0){
				vue.error.insti_file_cartao_cnpj = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_file_contr_social.length == 0){
				vue.error.insti_file_contr_social = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_file_doc_rg.length == 0){
				vue.error.insti_file_doc_rg = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_file_doc_cpf.length == 0){
				vue.error.insti_file_doc_cpf = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_end_cep.length == 0){
				vue.error.insti_end_cep = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_end_logradouro.length == 0){
				vue.error.insti_end_logradouro = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_end_numero.length == 0){
				vue.error.insti_end_numero = "Obrigatório";
				error++;
			}
			if(vue.fields.insti_end_bairro.length == 0){
				vue.error.insti_end_bairro = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_end_cidade.length == 0){
				vue.error.insti_end_cidade = "Campo obrigatório";
				error++;
			}
			if(vue.fields.insti_end_estado.length == 0){
				vue.error.insti_end_estado = "Requerido";
				error++;
			}

			return (error === 0);
		},
		ResetErrorGravarGrupo : function(){
			vue.error.insti_titulo = "";
			vue.error.insti_responsavel = "";
			vue.error.insti_cpf = "";
			vue.error.insti_telefone = "";
			vue.error.insti_celular = "";

			vue.error.insti_end_cep = "";
			vue.error.insti_end_logradouro = "";
			vue.error.insti_end_numero = "";
			vue.error.insti_end_bairro = "";
			vue.error.insti_end_cidade = "";
			vue.error.insti_end_estado = "";
		},
		ValidateFormGravarParticipante : function(){
			this.ResetErrorGravarParticipante();
			var error = 0;

			if(vue.fields.partc_documento.length == 0){
				vue.error.partc_documento = "Campo obrigatório";
				error++;
			}
			if(vue.fields.partc_nome.length == 0){
				vue.error.partc_nome = "Campo obrigatório";
				error++;
			}
			if(vue.fields.partc_nome_social.length == 0){
				vue.error.partc_nome_social = "Campo obrigatório";
				error++;
			}
			//if(vue.fields.partc_genero.length == 0){
			//	vue.error.partc_genero = "Campo obrigatório";
			//	error++;
			//}
			if(vue.fields.partc_dte_nascto.length == 0){
				vue.error.partc_dte_nascto = "Campo obrigatório";
				error++;
			}		
			return (error === 0);
		},
		ResetErrorGravarParticipante : function(){
			vue.error.partc_documento = "";
			vue.error.partc_nome = "";
			vue.error.partc_nome_social = "";
			vue.error.partc_genero = "";
			vue.error.partc_dte_nascto = "";
		},
		ResetFieldsGravarParticipante : function(){
			vue.fields.partc_documento = "";
			vue.fields.partc_nome = "";
			vue.fields.partc_nome_social = "";
			vue.fields.partc_genero = "";
			vue.fields.partc_dte_nascto = "";
		},
		ValidateFormGravarCoreografia : function(){
			this.ResetErrorGravarCoreografia();
			var error = 0;

			if(vue.fields.corgf_titulo.length == 0){
				vue.error.corgf_titulo = "Campo obrigatório";
				error++;
			}
			if(vue.fields.corgf_coreografo.length == 0){
				vue.error.corgf_coreografo = "Campo obrigatório";
				error++;
			}
			if(vue.fields.corgf_musica.length == 0){
				vue.error.corgf_musica = "Campo obrigatório";
				error++;
			}
			if(vue.fields.corgf_compositor.length == 0){
				vue.error.corgf_compositor = "Campo obrigatório";
				error++;
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

			return (error === 0);
		},
		ResetErrorGravarCoreografia : function(){
			vue.error.corgf_titulo = "";
			vue.error.corgf_coreografo = "";
			vue.error.corgf_musica = "";
			vue.error.corgf_compositor = "";
		},
		blurCheckCEP : function(){ 
			// 68458380
			// https://viacep.com.br/ws/04543120/json/
			// https://viacep.com.br/ws/68485380/json/ -- nao encontra
			// https://viacep.com.br/ws/05886410/json/

			// https://viacep.com.br/ws/68458380/json/ -- funcionando

			// https://brasilapi.com.br/api/cep/v1/04543120
			// https://brasilapi.com.br/api/cep/v1/68485380		---> este pesquisa por várias apis, mas nenhum encontra
			// https://brasilapi.com.br/api/cep/v1/68458380
			
			// https://api.postmon.com.br/v1/cep/68458380

			let strDefault = vue.fields.insti_end_cep;
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
				vue.fields.insti_end_logradouro = respData.logradouro;
				vue.fields.insti_end_bairro = respData.bairro;
				vue.fields.insti_end_cidade = respData.localidade;
				vue.fields.insti_end_estado = respData.uf;
			})
			.catch((error) => {
				console.error("Erro:", error);
			});

			//console.log( url );
			////try {
			//	const response = axios.get(url);
			//	console.log( response );
			//	//if (response.data.erro) {
			//	//	//this.erro = 'CEP não encontrado.';
			//	//	console.log( 'CEP não encontrado.' );
			//	//} else {
			//	//	//this.resultado = response.data;

			//	//	console.log( response.data );
			//	//}
			////} catch (error) {
			////	//this.erro = 'Erro ao buscar o CEP.';
			////	console.log( 'Erro ao buscar o CEP.' );
			////}

			/*
			let strDefault = vue.fields.insti_end_cep;
			strDefault = strDefault.replace(/\D/g, '');
			let strCEP = strDefault.trim();
			axios.get('https://api.postmon.com.br/v1/cep/'+ strCEP).then(function(response){
				if( response.data )
				{
					let respData = response.data;
					vue.fields.insti_end_logradouro = respData.logradouro;
					vue.fields.insti_end_bairro = respData.bairro;
					vue.fields.insti_end_cidade = respData.cidade;
					vue.fields.insti_end_estado = respData.estado;
				}
			}).catch((error) => {
				vue.fields.insti_end_logradouro = '';
				vue.fields.insti_end_bairro = '';
				vue.fields.insti_end_cidade = '';
				vue.fields.insti_end_estado = '';
			});
			*/
		},
		ResetForm : function(){
			vue.fieldsST01.nome = "";
			vue.fieldsST01.cpf = "";
			vue.fieldsST01.email = "";
			vue.fieldsST01.telefone = "";
			vue.fieldsST01.convidados = "";
		},
		ResetError : function(){
			vue.errorST01.nome = '';
			vue.errorST01.cpf = '';
			vue.errorST01.email = '';
			vue.errorST01.telefone = '';
			vue.errorST01.convidados = '';
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
					return categoria.titulo;
				}
			}

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
		pickFileLogotipo : function(){
			let input = this.$refs.fileInputLogotipo
			let file = input.files
			if (file && file[0]) {
				var reader = new FileReader();
				reader.onload = (e) => {
					this.previewLogotipo = e.target.result;
				}
				this.imageLogotipo = input.files[0];
				reader.readAsDataURL(input.files[0]);
				this.$emit('input', file[0])
			}
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
		}
	},

	mounted: function (){

		//console.log('Valor do campo:', this.fields.insti_titulo);

		//this.fields.insti_titulo = document.getElementById('insti_titulo').value;
        // Recupera o valor do campo após o Vue.js ser montado

		//this.fields.insti_titulo = this.$refs.insti_titulo.defaultValue;
		for (let fieldName in this.fields) {
			if (Object.prototype.hasOwnProperty.call(this.fields, fieldName)) {
				const fieldRef = this.$refs[fieldName];
				if (fieldRef) {
					this.fields[fieldName] = fieldRef.defaultValue;
				}
			}
		}


        //let campoTitulo = document.getElementById('insti_titulo');
        //this.fields.insti_titulo = campoTitulo.value;
		//console.log( campoTitulo.value );

        //campoTitulo.addEventListener('input', () => {
        //    this.fields.insti_titulo = campoTitulo.value;
        //});


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
