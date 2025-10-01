
/**
 * --------------------------------------------------------
 * ini : INICIAL
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 8,
		substep: 1,
		lista_funcoes : [],
		lista_categorias : [],
		lista_func_obrigatoria : [],
		fields : {
			event_hashkey : '',
			grp_id : '',
			grp_hashkey : '',
			
			// Step 1
			grp_titulo : '',
			grp_responsavel : '',
			grp_cpf : '',
			grp_telefone : '',
			grp_celular : '',

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

			// Step 2
			partc_documento : '',
			partc_nome : '',
			partc_nome_social : '',
			partc_genero : '',
			partc_dte_nascto : '',
			func_id : '',
			func_titulo : '',
			partc_file_foto : '',
			partc_file_doc_frente : '',
			partc_file_doc_verso : '',

			// Step 3
			corgf_titulo : '',
			corgf_coreografo : '',
			corgf_musica : '',
			corgf_compositor : '',
			corgf_observacao : '',
			corgf_modl_id : '',
			corgf_formt_id : '',
			corgf_categ_id : '',

			tipo_conta : '',
			//cad_email : 'listasguardiao@gmail.com',
			codigo_para_validar : '',
			codigo_validacao : '',

			clie_cpf : '',
			clie_cnpj : '',
			clie_nome_razao : '',
			clie_nome_responsavel : '',
			clie_whatsapp : '',

			campo_1 : '',
			campo_2 : '',
			campo_3 : '',
			campo_4 : '',
			campo_5 : '',
			campo_6 : '',

			participantes : [],
			participantes_json : '',
			participantes_elenco : [],
			participantes_elenco_json : [],

			coreografia_elenco : [],
			coreografia_elenco_all : [],
			coreografia_elenco_json : '',
		},
		coreografos : [],
		selectedParticipants : [],
		error : {
			// Step 1
			grp_titulo : '',
			grp_responsavel : '',
			grp_cpf : '',
			grp_telefone : '',
			grp_celular : '',

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

			// Step 2
			partc_documento : '',
			partc_nome : '',
			partc_nome_social : '',
			partc_genero : '',
			partc_dte_nascto : '',
			func_id : '',

			// Step 3
			corgf_titulo : '',
			corgf_coreografo : '',
			corgf_musica : '',
			corgf_compositor : '',
			corgf_observacao : '',
			corgf_modl_id : '',
			corgf_formt_id : '',
			corgf_categ_id : '',
		},

		count_timer : 60,
		codigo_error : 0,
		link_painel_poravo : '',

		previewLogotipo : null,
		imageLogotipo : null,

		preview : null,
		image : null,

		previewDocFrente : null,
		imageDocFrente : null,

		previewDocVerso : null,
		imageDocVerso : null,

		overlay : { active : false },
		loading : { active : false },

		partcBTNDisabled : false,
		corgfBTNDisabled : true,

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
		stepGravarGrupo : function( next ){
			if(this.ValidateFormGravarGrupo()){
				let form = this.formData(vue.fields);
				//console.log( JSON.stringify(vue.fields, null, 4) );
				////console.log('urlPost', this.urlPost );
				//return false;
				//vue.loading.active = true;
				axios.post(this.urlPost +'inscricoes/ajaxform/SALVAR-GRUPO', form).then(function(response){
					//vue.loading.active = false;
					let respData = response.data;
					//console.log('respData', respData);
					if( respData.error_num == '0' ){

						vue.fields.grp_id = respData.grp_id;
						vue.fields.grp_hashkey = respData.grp_hashkey;

						setTimeout(() => {
							vue.step = next;
						}, 1000);
						return false;
					}
				});
				return false;
			}else{
				console.log('error gravar grupo');
				//alert('deu erro');
				return false;
			}
		},
		stepGravarParticipante : function( next ){
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
		stepGravarCoreografia : function( next ){
			if(this.ValidateFormGravarCoreografia()){
				//let form = this.formData(vue.fields);
				//console.log( JSON.stringify(vue.fields, null, 4) );
				//console.log('urlPost', this.urlPost );
				////return false;

				const form = this.$refs.formFieldsInscricao
				form.submit();

				return false;
			}else{
				console.log('error gravar coreografia');
				//alert('deu erro');
				return false;
			}
		},
		addParticipante : function(){
			if(this.ValidateFormGravarParticipante()){
				let arrSelect = vue.fields.participantes;
				let arrSelectUnic = [];
				//let arrSelect = [];

				//console.log( arrSelect.length );
				//if( pDia ) 

				if( arrSelect.length > 0 ){
					// verificar se o item selecionado tem o mesmo horario do ja existente

					//const item = arrSelect.find(item => item.ident === pIdent);
					//console.log( 'item '+ item);

					//let existe = arrSelect.find(function(item) {
					//	return item.ident === pIdent;
					//});
					//if(typeof existe === 'object') {
					//	console.log( 'existe: '+ existe );
					//	return false;
					//}else{
					//	console.log( 'nao existe: ' );
					//}


					//I typeof element === "object" ? true : false;

					//if( existe === 'undefined' ){
						//console.log( 'nao existe: ');  	
					//}else{
						//console.log( 'existe: '+ existe );
					//}
				}
				let partc_idade = vue.calcularIdade( vue.fields.partc_dte_nascto );

				//const grp_hashkey = generateMD5Hash();
				//console.log(grp_hashkey);
				// 

				let arrFuncao = vue.encontrarFuncao( vue.fields.func_id );
				if( arrFuncao != 'error' ){
					vue.fields.func_id = arrFuncao.id;
					vue.fields.func_titulo = arrFuncao.titulo;
				}

				let arrCateg = vue.encontrarCategoria( partc_idade );
				if( arrCateg == 'error' ){
					//vue.partcBTNDisabled = true;
					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html:
							'Não existe nenhum categoria para esta faixa etária.',
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
					return false;
				}
				//vue.partcBTNDisabled = false;
				arrSelectUnic.push({ 
					partc_hashkey : CryptoJS.MD5("Message"),
					partc_documento : vue.fields.partc_documento,
					partc_nome : vue.fields.partc_nome,
					partc_nome_social : vue.fields.partc_nome_social,
					partc_genero : vue.fields.partc_genero,
					partc_dte_nascto : vue.fields.partc_dte_nascto,
					partc_idade: partc_idade,
					partc_categoria: arrCateg.titulo,
					categ_id: arrCateg.id,
					func_id : vue.fields.func_id,
					func_titulo : vue.fields.func_titulo,
					//partc_file_doc_frente : vue.fields.partc_file_doc_frente,
					//partc_file_doc_verso : vue.fields.partc_file_doc_verso,
					partc_file_foto : this.imageLogotipo,
					partc_file_foto_preview : this.previewLogotipo,
					//form.append('fileInputLogotipo', this.imageLogotipo);
					//fileInputLogotipo : this.imageLogotipo,
				});
				arrSelect.push(...arrSelectUnic);
				//arrSelecao.forEach((itemID) => {
					//console.log( itemID );
					////spanElement.classList.remove('chkactive');
					//const item = arrSelect.find(item => item.id === itemID);
					//console.log( 'item: '+ item );
					//arrSelect.push({ 
						//id : itemID,
						//data : pDia, 
						//sala : pSala,
						//horario : pHorario,
					//});
				//});
				vue.fields.participantes = arrSelect;
				vue.fields.participantes_json = JSON.stringify(arrSelectUnic);
				vue.ResetFieldsGravarParticipante();

				//console.log( JSON.stringify(vue.fields, null, 4) );
				////console.log('urlPost', this.urlPost );
				//return false;
				let form = this.formData(vue.fields);
				form.append('fileInputLogotipo', this.imageLogotipo);
				axios.post(this.urlPost +'inscricoes/ajaxform/SALVAR-PARTICIPANTE', form).then(function(response){
					//vue.loading.active = false;
					let respData = response.data;
					//console.log('respData', respData);
					if( respData.error_num == '0' ){
						//setTimeout(() => {
						//	vue.step = next;
						//}, 4000);
						return false;
					}
				});
			}
		},
		removeParticipante : function( hashKeyToRemove ){
			console.log( 'hashKeyToRemove: ', hashKeyToRemove );
			let arrSelect = vue.fields.participantes;
			arrSelect = arrSelect.filter(item => item.partc_hashkey !== hashKeyToRemove);
			vue.fields.participantes = arrSelect;
		},
		selectCategCoreografia : function(){
			let form = this.formData(vue.fields);
			axios.post(this.urlPost +'inscricoes/ajaxform/LIST-PARTICIPANTE-POR-CATEG', form).then(function(response){
				//vue.loading.active = false;
				let respData = response.data;
				//console.log('respData', respData);
				if( respData.error_num == '0' ){
					//setTimeout(() => {
					//	vue.step = next;
					//}, 4000);
					
					vue.fields.participantes_elenco_json = JSON.stringify(respData.participantes);
					vue.fields.participantes_elenco = respData.participantes;
					
					vue.corgfBTNDisabled = false;
					return false;
				}else{
					
					vue.fields.participantes_elenco_json = [];
					vue.fields.participantes_elenco = [];
					vue.corgfBTNDisabled = true;

					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html:
							'Não existe participantes relacionados a esta categoria.',
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
				}
			});
		},
		addNovaCoreografia : function(){

			/*
			VALIDACOES
			*/

			let form = this.formData(vue.fields);

			console.log( JSON.stringify(vue.fields, null, 4) );
			return false;

			axios.post(this.urlPost +'inscricoes/ajaxform/SALVAR-ELENCO-COREOGRAFIA', form).then(function(response){
				//vue.loading.active = false;
				let respData = response.data;
				//console.log('respData', respData);
				if( respData.error_num == '0' ){
					//setTimeout(() => {
					//	vue.step = next;
					//}, 4000);
					
					vue.fields.participantes_elenco_json = JSON.stringify(respData.participantes);
					vue.fields.participantes_elenco = respData.participantes;
					
					vue.corgfBTNDisabled = false;
					return false;
				}else{
					
					vue.fields.participantes_elenco_json = [];
					vue.fields.participantes_elenco = [];
					vue.corgfBTNDisabled = true;

					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html:
							'Não existe participantes relacionados a esta categoria.',
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
				}
			});

			console.log( vue.fields.coreografia_elenco );
			return false;


			//vue.fields.corgf_titulo = '';
			//vue.fields.corgf_coreografo = '';
			//vue.fields.corgf_musica = '';
			//vue.fields.corgf_compositor = '';
			//vue.fields.corgf_observacao = '';
			//vue.fields.corgf_modl_id = '';
			//vue.fields.corgf_formt_id = '';
			//vue.fields.corgf_categ_id = '';


		},
		setTipoConta : function( tipo ){
			vue.fields.tipo_conta = tipo;
		},
		criarCodigoValidacao : function( next, subNext ){
			if(this.ValidateFormST02()){
				let form = this.formData(vue.fields);
				console.log( JSON.stringify(vue.fields, null, 4) );
				console.log('urlPost', this.urlPost );
				//return false;

				axios.post(this.urlPost +'ajaxform/GERAR-CODIGO-VALIDACAO', form).then(function(response){
					//vue.loading.active = false;
					if( response.data ){
						let respData = response.data;
						console.log( 'respData', respData);

						if( respData.success == 'nao' ){
							vue.codigo_error = 1;
							vue.messageResult = respData.mensagem;
							return false
						}else{
							vue.codigo_error = 0;
							vue.messageResult = '';

							vue.fields.codigo_para_validar = respData.codigo_validacao; 

							vue.step = next;
							vue.substep = subNext;

							vue.contaCountTimer();
						}
						//if( respData.error_num == '0' ){
						//	//setTimeout(() => {
						//	//	window.location.href = respData.redirect;
						//	//}, 1000);
						//	return false;
						//}
					}
				});

				return false;
			}else{
				alert('deu erro');
				return false;
			}
		},
		validarCodigo : function( next, subNext ){
			let form = this.formData(vue.fields);
			form.append ('codigo_validar', vue.fields.campo_1 + vue.fields.campo_2 + vue.fields.campo_3 + vue.fields.campo_4 + vue.fields.campo_5 + vue.fields.campo_6 );
			//form.append ('reserva_hashkey', vue.reserva_hashkey);
			console.log( JSON.stringify(vue.fields, null, 4) );
			console.log('urlPost', this.urlPost );

			axios.post(this.urlPost +'ajaxform/VALIDAR-CODIGO-GERADO', form).then(function(response){
				console.log('respData', response.data);
				if( response.data ){
					let respData = response.data;
					//console.log('respData', respData);
					if( respData.success == 'nao' ){
						vue.codigo_error =  1;
					}else{
						vue.codigo_error = 0;
						vue.step = next;
						vue.substep = subNext;
					}
					return false;
				}
			});
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
		sendCodigoValidacao : function(){
			if( vue.count_timer == 0 ){
				//axios.post(this.urlPost +'ajaxform/REENVIAR-CODIGO-VALIDACAO', form).then(function(response){
				//	//vue.loading.active = false;
				//	if( response.data ){
				//		let respData = response.data;
				//		console.log( 'respData', respData);
				//	}
				//});
				vue.count_timer = 60;
				vue.contaCountTimer();
			}
		},
		contaCountTimer : function(){
			let segundos = vue.count_timer;
			var intervalo = setInterval(function() {
				segundos--;
				vue.count_timer = segundos;

				// Verificar se o contador chegou a zero
				if (segundos === 0) {
					clearInterval(intervalo); 
				}
			}, 1000); // 1000 milissegundos = 1 segundo
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

			return (error === 0);
		},
		ResetErrorGravarGrupo : function(){
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
			if(vue.fields.partc_genero.length == 0){
				vue.error.partc_genero = "Campo obrigatório";
				error++;
			}
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

		checkElencoParticipante : function(){

		},

		blurCheckCEP : function(){
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
		pickFileDocFrente : function(){
			let input = this.$refs.fileInputDocFrente
			let file = input.files
			if (file && file[0]) {
				var reader = new FileReader();
				reader.onload = (e) => {
					this.previewDocFrente = e.target.result;
				}
				this.imageDocFrente = input.files[0];
				reader.readAsDataURL(input.files[0]);
				this.$emit('input', file[0])
			}
		},
		pickFileDocVerso : function(){
			let input = this.$refs.fileInputDocVerso
			let file = input.files
			if (file && file[0]) {
				var reader = new FileReader();
				reader.onload = (e) => {
					this.previewDocVerso = e.target.result;
				}
				this.imageDocVerso = input.files[0];
				reader.readAsDataURL(input.files[0]);
				this.$emit('input', file[0])
			}
		},
		loadCoreografos : function(){
			//console.log( this.fields );

			//let event = this.fields.event_hashkey;
			////console.log( 'loadCoreografos', event );
			//	
			//if( this.step == 3 ){ // STEP COREOGRAFIA
			//	console.log( 'AQUI 1' );
			//	console.log( this.fields );	

			//	console.log( event );

			//	//this.coreografos = [{"partc_id":"5","partc_nome":"Jarbas de Oliveira","partc_documento":"595.864.040-21"},{"partc_id":"6","partc_nome":"Marcio Coreografo","partc_documento":"096.687.250-93"}];

			//	console.log( this.fields );	
			//	let form = this.formData(this.fields);
			//	axios.post(this.urlPost +'inscricoes/ajaxform/LIST-PARTICIPANTE-COREOGRAFOS', form).then(function(response){
			//		let respData = response.data;
			//		if( respData.error_num == '0' ){
			//			console.log( 'AQUI 2' );
			//			this.coreografos = respData.coreografos;
			//			console.log( this.coreografos );
			//			console.log( 'end 2 -------------------------------------------- ' );
			//			//return false;
			//		}else{
			//			console.log( 'AQUI 3' );
			//			this.coreografos = [];
			//		}
			//	});	
			//}
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
		document.addEventListener('DOMContentLoaded', () => {
			//this.loadCoreografos();
			//alert('carregou');

			console.log( this.fields );	
			let form = this.formData(this.fields);
			axios.post(this.urlPost +'inscricoes/ajaxform/LIST-PARTICIPANTE-COREOGRAFOS', form).then(function(response){
				let respData = response.data;
				if( respData.error_num == '0' ){
					console.log( 'AQUI 2' );
					this.coreografos = respData.coreografos;
					console.log( this.coreografos );
					console.log( 'end 2 -------------------------------------------- ' );
					//return false;

					alert('carregou');
				}else{
					console.log( 'AQUI 3' );
					this.coreografos = [];
				}
			});	

		});

		//if( this.step == 3 ){ // STEP COREOGRAFIA

		//	console.log( 'AQUI 1' );
		//	let form = this.formData(this.fields);
		//	axios.post(this.urlPost +'inscricoes/ajaxform/LIST-PARTICIPANTE-COREOGRAFOS', form).then(function(response){
		//		let respData = response.data;
		//		if( respData.error_num == '0' ){
		//			console.log( 'AQUI 2' );
		//			this.coreografos = respData.coreografos;
		//			console.log( this.coreografos );
		//			//return false;
		//		}else{
		//			console.log( 'AQUI 3' );
		//			this.coreografos = [];
		//		}
		//	});	
		//}

		//console.log( this.fields );
		//console.log( 'step', this.step );

		//console.log('Valor do campo:', this.fields.grp_titulo);

		//this.fields.grp_titulo = document.getElementById('grp_titulo').value;
        // Recupera o valor do campo após o Vue.js ser montado




		//this.fields.grp_titulo = this.$refs.grp_titulo.defaultValue;
		for (let fieldName in this.fields) {
			if (Object.prototype.hasOwnProperty.call(this.fields, fieldName)) {
				const fieldRef = this.$refs[fieldName];
				if (fieldRef) {
					this.fields[fieldName] = fieldRef.defaultValue;
				}
			}
		}


        //let campoTitulo = document.getElementById('grp_titulo');
        //this.fields.grp_titulo = campoTitulo.value;
		//console.log( campoTitulo.value );

        //campoTitulo.addEventListener('input', () => {
        //    this.fields.grp_titulo = campoTitulo.value;
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

	//computed: {
	//	elencoSelecionado() {

	//		//console.log( this.selectedParticipants );

	//		let participantes = this.fields.participantes_elenco;
	//		let idsProcurados = this.selectedParticipants;
	//		const participantesEncontrados = participantes.filter(participante => idsProcurados.includes(participante.partc_id));

	//		console.log('ewncontrados');
	//		console.log( participantesEncontrados );

	//		this.fields.coreografia_elenco = participantesEncontrados;

	//		//for (let elenc of this.selectedParticipants) {
	//		//	console.log( 'id', elenc );
	//		//}


	//		//arrSelectUnic.push({ 
	//		//	partc_hashkey : CryptoJS.MD5("Message"),
	//		//	partc_documento : vue.fields.partc_documento,
	//		//	partc_nome : vue.fields.partc_nome,
	//		//	partc_nome_social : vue.fields.partc_nome_social,
	//		//	partc_genero : vue.fields.partc_genero,
	//		//	partc_dte_nascto : vue.fields.partc_dte_nascto,
	//		//	partc_idade: partc_idade,
	//		//	partc_categoria: arrCateg.titulo,
	//		//	categ_id: arrCateg.id,
	//		//	func_id : vue.fields.func_id,
	//		//	func_titulo : vue.fields.func_titulo,
	//		//	//partc_file_doc_frente : vue.fields.partc_file_doc_frente,
	//		//	//partc_file_doc_verso : vue.fields.partc_file_doc_verso,
	//		//	partc_file_foto : this.imageLogotipo,
	//		//	partc_file_foto_preview : this.previewLogotipo,
	//		//	//form.append('fileInputLogotipo', this.imageLogotipo);
	//		//	//fileInputLogotipo : this.imageLogotipo,
	//		//});
	//		//arrSelect.push(...arrSelectUnic);




	//		return this.selectedParticipants.map(participant => {
	//			return {
	//				partc_id: participant.partc_id,
	//				partc_nome: participant.partc_nome,
	//				partc_documento: participant.partc_documento
	//			};
	//		});
	//	}
	//}


});
/**
 * --------------------------------------------------------
 * end : INICIAL
 * --------------------------------------------------------
**/	
