
/**
 * --------------------------------------------------------
 * ini : INICIAL
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 3, // COREOGRAFIAS 
		substep: 1,
		lista_coreografos : LIST_COREOGRAFOS,
		lista_formatos : LIST_FORMATOS,
		lista_categorias : LIST_CATEGORIAS,
		//evcfg_seletiva : RS_EVCFG_SELETIVA,
		//evcfg_max_por_grupo : RS_EVCFG_MAX_GRUPO,
		evcfg_config_limites : RS_EVCFG_CONFIG_LIMITES,
		lista_corf_cadastradas : LIST_CORF_CADASTRADAS,
		fields : {
			event_hashkey : STR_EVENT_HASHKEY,
			grp_id : '',
			grp_hashkey : '',

			// Step 3
			corgf_hashkey : '',
			corgf_titulo : '',
			corgf_coreografo : [],
			corgf_musica : '',
			corgf_compositor : '',
			corgf_observacao : '',
			corgf_modl_id : '',
			corgf_formt_id : '',
			corgf_categ_id : '',
			corgf_evcfg_seletiva : '',

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
		participantesEncontrados : [],
		elencoSelecionado : [],
		error : {
			// Step 3
			corgf_titulo : '',
			corgf_coreografo : '',
			corgf_musica : '',
			corgf_compositor : '',
			corgf_observacao : '',
			corgf_modl_id : '',
			corgf_formt_id : '',
			corgf_categ_id : '',
			corgf_evcfg_seletiva : '',
		},

		arrSelectUnicCor : [],

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
		GravarCoreografias : function(){
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
			if(this.ValidateFormGravarCoreografia()){
				/*
				VALIDACOES
				*/
				//console.log( JSON.stringify(vue.fields, null, 4) );
				//return false;
				vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
				let form = this.formData(vue.fields);
				axios.post(this.urlPost +'inscricoes/ajaxform/SALVAR-ELENCO-COREOGRAFIA', form).then(function(response){
					//vue.loading.active = false;
					let respData = response.data;
					console.log('respData', respData);
					if( respData.error_num == '0' ){
						//setTimeout(() => {
						//	vue.step = next;
						//}, 4000);
						return false;
					}
				});
			}else{
				console.log('error gravar coreografia');
				//alert('deu erro');
				return false;
			}
			return false;
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
			let elencoSelecionado = vue.elencoSelecionado;


			//console.log('partc_id', partc_id);
			console.log( vue.fields.coreografia_elenco );

			let participantes = vue.fields.participantes_elenco;
			let idsProcurados = vue.fields.coreografia_elenco;
			let partCor = participantes.filter(participante => idsProcurados.includes(participante.partc_id));

			//console.log('encontrados');
			//console.log( participantesEncontrados );

			elencoSelecionado.push(...partCor);
			console.log('selecionado bailarinos');
			console.log( elencoSelecionado );

			//vue.fields.coreografia_elenco_all = participantesEncontrados;
			vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
		},
		handleCheckboxChangeCor : function( jsonDADOS ){
			let partcID = jsonDADOS.partc_id;
			console.log( partcID );
			
			console.log( vue.elencoSelecionado );

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

			console.log( vue.arrSelectUnicCor );
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;



			//let itemEncontrado = participantes.find(item => item.partc_id === partcID);
			//if (itemEncontrado) {
			//	//let valorPartcHashKey = itemEncontrado.partc_hashkey;
			//	// se encontrar : remover
			//	
			//	
			//	arrSelectUnic.push({ 
			//		partc_documento : itemEncontrado.partc_documento,
			//		partc_id : itemEncontrado.partc_id,
			//		partc_nome : itemEncontrado.partc_nome,
			//	});
			//	vue.elencoSelecionado.push(...arrSelectUnic);

			//}else{

			//}

			//console.log( vue.elencoSelecionado );


			//let elencoSelecionado = vue.elencoSelecionado;
			//let arrSelectUnic = [];

			//let participantes = vue.lista_coreografos;
			//let idsProcurados = vue.fields.corgf_coreografo;

			////vue.fields.coreografia_elenco_all = vue.participantesEncontrados;
			////let itemEncontrado = participantes.filter(participante => idsProcurados.includes(participante.partc_id));
			//let itemEncontrado = participantes.find(item => idsProcurados.includes(item.partc_id));
			//if (itemEncontrado) {
			//	console.log('itemEncontrado');
			//	console.log( itemEncontrado );

			//	//let valorPartcHashKey = itemEncontrado.partc_hashkey;
			//	arrSelectUnic.push({ 
			//		partc_documento : itemEncontrado.partc_documento,
			//		partc_id : itemEncontrado.partc_id,
			//		partc_nome : itemEncontrado.partc_nome,
			//	});
			//	console.log('selecionado unico');
			//	console.log( arrSelectUnic );
			//}
			
			////arrSelectUnic.push({ 
			////	partc_documento : partCor.partc_documento,
			////	partc_id : partCor.partc_id,
			////	partc_nome : partCor.partc_nome,
			////});
			////elencoSelecionado.push(...partCor);

			//console.log('selecionado coreografos');
			//console.log( elencoSelecionado );

			//vue.fields.coreografia_elenco_all = participantesEncontrados;
			//vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
		},
		handleCheckboxChangeElenc : function(jsonDADOS, $event){
			//alert('entrou aqui');
			let partcID = jsonDADOS.partc_id;

			let formatos = vue.lista_formatos;
			let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);
			
			let qtdElencoBailarinoSelect = vue.fields.coreografia_elenco.length;
			if( qtdElencoBailarinoSelect > formtEncontrado.formt_max_partic ){
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você já selecionou o número máximo de <br>participantes para o formato escolhido.',
					confirmButtonText: 'Fechar',
					confirmButtonColor: "#0b8e8e",
				});
				//const indice = vue.fields.coreografia_elenco.indexOf(mk);
				const indice = vue.fields.coreografia_elenco.findIndex(item => item.partc_id === partcID);
				vue.fields.coreografia_elenco.splice(indice, 1);
				$event.target.checked = false;
			}

			let participantes = vue.fields.participantes_elenco;
			let itemEncontrado = [];

			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			if (index === -1 && event.target.checked) {
				itemEncontrado = participantes.find(item => item.partc_id === partcID);
				// Adiciona a opção ao array se não estiver presente
				vue.arrSelectUnicCor.push({ 
					partc_documento: itemEncontrado.partc_documento, 
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome
				});
			} else if (index !== -1 && !event.target.checked) {
				// Remove a opção do array se estiver presente
				vue.arrSelectUnicCor.splice(index, 1);
			}

			//console.log( vue.arrSelectUnicCor );
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;
		},
		handleCheckboxChangeElenc_BACKUP : function( jsonDADOS, event ){
			let partcID = jsonDADOS.partc_id;
			//event.preventDefault();

			let formatos = vue.lista_formatos;
			let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);

			console.log('formatos', formatos );
			console.log('NUMERO MAXIMO DE PARTICIPANTES', formtEncontrado.formt_max_partic );
			console.log('corgf_formt_id', vue.fields.corgf_formt_id );
			
			let qtdElencoBailarinoSelect = vue.fields.coreografia_elenco.length;
			if( qtdElencoBailarinoSelect > formtEncontrado.formt_max_partic ){
				//Swal.fire({
				//	title: 'Atenção!',
				//	icon: 'warning',
				//	html:
				//		'Você já selecionou o número máximo de participantes.',
				//	confirmButtonText: 'Fechar',
				//	confirmButtonColor: "#0b8e8e",
				//});

				let refID = 'ID'+ partcID;

				//var checkbox = document.getElementById(refID);
				//checkbox.checked = false;

				$("#"+ refID).prop("checked", false);
				//$("#IDS13").prop("checked", false);


				//let refID = 'ID'+ partcID;
				//console.log('refID', refID);
				//this.$refs[refID].checked = false;

				//event.target.checked = false;
				//event.stopPropagation();
				return false;
			}



			let participantes = vue.fields.participantes_elenco;
			//let arrSelect = vue.elencoSelecionado;
			//let arrSelectUnic = [];
			let itemEncontrado = [];

			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			if (index === -1 && event.target.checked) {
				itemEncontrado = participantes.find(item => item.partc_id === partcID);

				// Adiciona a opção ao array se não estiver presente
				vue.arrSelectUnicCor.push({ 
					partc_documento: itemEncontrado.partc_documento, // Substitua com o valor real
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome // Substitua com o valor real
				});
			//} else {
			} else if (index !== -1 && !event.target.checked) {
				// Remove a opção do array se estiver presente
				vue.arrSelectUnicCor.splice(index, 1);
			}


			//const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);






			console.log( '----------------- ini elenco' );
			console.log( vue.fields.coreografia_elenco.length );
			console.log( '----------------- end elenco' );

			//console.log( vue.arrSelectUnicCor );
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;
		},
		excluirCoreografia : function( jsonDADOS ){
			console.log('corgf_hashkey', jsonDADOS.hashkey );
			let hashKeyToRemove = jsonDADOS.hashkey;
			let arrSelect = vue.lista_corf_cadastradas;
			let itemEncontrado = arrSelect.find(item => item.corgf_hashkey === hashKeyToRemove);

			if (itemEncontrado) {
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você deseja realmente excluir este registro?<br>'+
						'['+ hashKeyToRemove +']<br>'+
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
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						var form = new FormData();
						form.append('corgf_hashkey', hashKeyToRemove);
						axios.post(vue.urlPost +'inscricoes/ajaxform/EXCLUIR-COREOGRAFIA', form).then(function(response){
							let respData = response.data;
							if( respData.error_num == '0' ){
								arrSelect = arrSelect.filter(item => item.corgf_hashkey !== hashKeyToRemove);
								vue.lista_corf_cadastradas = arrSelect;
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
		loadEditCoreografia : function( jsonDADOS ){
			console.log('corgf_hashkey', jsonDADOS.hashkey );
			let hashKeyToRemove = jsonDADOS.hashkey;
			let arrSelect = vue.lista_corf_cadastradas;
			let itemEncontrado = arrSelect.find(item => item.corgf_hashkey === hashKeyToRemove);
			if (itemEncontrado) {
				// ------------------------------------------------------
				var form = new FormData();
				form.append('corgf_hashkey', hashKeyToRemove);
				axios.post(vue.urlPost +'inscricoes/ajaxform/LOAD-EDIT-COREOGRAFIA', form).then(function(response){
					let respData = response.data;
					if( respData.error_num == '0' ){
						vue.fields.corgf_hashkey = respData.dados.corgf_hashkey;
						vue.fields.corgf_coreografo = [];
						vue.fields.corgf_titulo = respData.dados.corgf_titulo;
						//corgf_coreografo = [];
						vue.fields.corgf_musica = respData.dados.corgf_musica;
						vue.fields.corgf_compositor = respData.dados.corgf_compositor;
						vue.fields.corgf_observacao = respData.dados.corgf_observacao;
						vue.fields.corgf_modl_id = respData.dados.modl_id;
						vue.fields.corgf_formt_id = respData.dados.formt_id;
						vue.fields.corgf_categ_id = respData.dados.categ_id;
						vue.fields.corgf_evcfg_seletiva = respData.dados.corgf_linkvideo;

						console.log( 'coreografos' );
						console.log( 'coreografos',  respData.coreografos );


						console.log( respData.dados.elenco_selecionado );
						vue.fields.coreografia_elenco_all = respData.elenco_selecionado;

						return false;
					}
				});
				// ------------------------------------------------------
			}
		},
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
