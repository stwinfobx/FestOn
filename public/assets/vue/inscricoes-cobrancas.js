
/**
 * --------------------------------------------------------
 * ini : COBRANCAS
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 4, // COBRANCAS 
		substep: 1,
		lista_coreografos : LIST_COREOGRAFOS,
		lista_formatos : LIST_FORMATOS,
		lista_categorias : LIST_CATEGORIAS,
		//evcfg_seletiva : RS_EVCFG_SELETIVA,
		//evcfg_max_por_grupo : RS_EVCFG_MAX_GRUPO,
		evcfg_config_limites : RS_EVCFG_CONFIG_LIMITES,
		evcfg_config_infos : RS_EVCFG_CONFIG_INFOS,	
		lista_corf_cadastradas : LIST_CORF_CADASTRADAS,
		lista_de_coreografias : LISTA_DE_COREOGRAFIAS,
		lista_elenco_geral : LIST_ELENCO_GERAL,
		lista_coreografia_geral : LIST_COREOGRAFIA_GERAL,
		fields : {
			event_hashkey : STR_EVENT_HASHKEY,
			grp_id : '',
			grp_hashkey : '',

			// Step 3
			corgf_hashkey : '',
			corgf_titulo : '',
			corgf_coreografo : [],
			corgf_musica : '',
			corgf_tempo : '',
			corgf_tempo_max : '',
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
			corgf_musica_file : '',
			corgf_tempo : '',
			corgf_tempo_max : '',
			corgf_compositor : '',
			corgf_observacao : '',
			corgf_modl_id : '',
			corgf_formt_id : '',
			corgf_categ_id : '',
			corgf_evcfg_seletiva : '',
		},

		arrSelectUnicCor : [],

		preview : null,
		image : null,

		overlay : { active : false },
		loading : { active : false },

		partcBTNDisabled : false,
		corgfBTNDisabled : true,
		btnDisabledContinue : false,
		editar_coreografia : 0,

		urlPost : SITE_URL,
		messageResult : '',
		//disabledButton : false,

		subtotais_part: [],
		subtotais: [],
		total_participantes: 0,
		total_coreografias: 0,
		total: 0
	},
	methods : {
		SendNextCobranca : function( next ){

			const form = this.$refs.formFieldsCobranca;
			form.submit();

			//SendNextCobranca
			return false;
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
		selectFormato : function(){
			let formatos = vue.lista_formatos;
			let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);
			let tempoTotal = this.converterParaSegundos(formtEncontrado.formt_tempo_limit);
			vue.fields.corgf_tempo_max = this.converterParaMinutosESegundos(tempoTotal);
			vue.error.corgf_musica_file = "";
			vue.fields.corgf_tempo = "";


			//let qtdElencoBailarinoSelect = vue.fields.coreografia_elenco.length;
			//if( qtdElencoBailarinoSelect > formtEncontrado.formt_max_partic ){
			//	Swal.fire({
			//		title: 'Atenção!',
			//		icon: 'warning',
			//		html:
			//			'Você já selecionou o número máximo de <br>participantes para o formato escolhido.',
			//		confirmButtonText: 'Fechar',
			//		confirmButtonColor: "#0b8e8e",
			//	});
			//	//const indice = vue.fields.coreografia_elenco.indexOf(mk);
			//	const indice = vue.fields.coreografia_elenco.findIndex(item => item.partc_id === partcID);
			//	vue.fields.coreografia_elenco.splice(indice, 1);
			//	$event.target.checked = false;
			//}
		},
		SalvarCoreografia : function(){
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

						window.location.reload();
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

			//console.log('coreografia_elenco', vue.fields.coreografia_elenco);
			//console.log('participantes', vue.fields.participantes_elenco);

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
						vue.fields.corgf_coreografo = respData.coreografos;

						vue.selectCategCoreografia();
						
						vue.fields.coreografia_elenco_all = respData.elenco_selecionado;
						vue.fields.coreografia_elenco = respData.coreografia_elenco;
						vue.arrSelectUnicCor = respData.elenco_selecionado;

						vue.corgfBTNDisabled = false;
						vue.editar_coreografia = 1;
						return false;
					}
				});
				// ------------------------------------------------------
			}
		},
		calcularValoresOLD : function( jsonDADOS ){
			this.total = 0;
			//this.subtotais_part.push();

			const lista = this.lista_elenco_geral;
			this.valoresParticipantes = lista.map(partic => {

				const valorParticipante = parseFloat(partic.valor);
				console.log( 'valorParticipante', valorParticipante );
				
				const subtotal = valorParticipante;
				console.log( '| subtotal', subtotal );
				
				////console.log( 'coreografia_valor', coreografia.valor );
				//const valorElenco = coreografia.elenco.reduce((acc, participante) => acc + parseFloat(participante.valor), 0);
				////console.log( '| valorElenco', valorElenco );
				//const subtotal = valorParticipante + valorElenco;

				////console.log( '| valorElenco', valorElenco );
				////console.log( '| valorParticipante', subtotal );
				////console.log( '| subtotais', this.subtotais );
				
				//this.subtotais_part.push(valorElenco);
				this.subtotais.push(subtotal);
				return subtotal;
			});

			/*
			const lista = this.lista_de_coreografias;
			this.valoresCoreografia = lista.coreografias.map(coreografia => {

				const valorCoreografia = parseFloat(coreografia.valor);
				//console.log( 'coreografia_valor', coreografia.valor );
				const valorElenco = coreografia.elenco.reduce((acc, participante) => acc + parseFloat(participante.valor), 0);
				//console.log( '| valorElenco', valorElenco );
				const subtotal = valorCoreografia + valorElenco;

				console.log( '| valorElenco', valorElenco );
				console.log( '| valorCoreografia', subtotal );
				console.log( '| subtotais', this.subtotais );
				
				this.subtotais_part.push(valorElenco);
				this.subtotais.push(subtotal);
				return subtotal;
			});
			this.total = this.subtotais.reduce((acc, subtotal) => acc + subtotal, 0);
			*/
		},
		calcularValores : function(){
			this.total_participantes = this.lista_elenco_geral.reduce((acc, item) => acc + parseFloat(item.valor), 0);	
			this.total_coreografias = this.lista_coreografia_geral.reduce((acc, item) => acc + parseFloat(item.valor), 0);
			this.total = this.total_participantes + this.total_coreografias;  
		}
	},

	mounted: function (){
		this.calcularValores();

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
	},

	filters: {
		formatNumber: function (value) {
			let val = (value / 1).toFixed(2).replace(".", ",");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		},
		formatPercent: function (value) {
			let val = (value / 1).toFixed(0).replace(".", ",");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+'%';
		},
		formatDate(date) {
			if (!date) return '';
			const [year, month, day] = date.split('-');
			return `${day}.${month}.${year}`;
		}		
	}

});
/**
 * --------------------------------------------------------
 * end : COREOGRAFIAS
 * --------------------------------------------------------
**/	
