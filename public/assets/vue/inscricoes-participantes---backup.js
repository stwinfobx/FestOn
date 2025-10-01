
/**
 * --------------------------------------------------------
 * ini : INICIAL
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 2,
		substep: 1,
		lista_funcoes : LIST_FUNCOES,
		lista_categorias : LIST_CATEGORIAS,
		lista_func_obrigatoria : LIST_FUNC_OBRIGATORIA,
		formAcao : 'INSERT',
		fields : {
			event_hashkey : STR_EVENT_HASHKEY,
			grp_id : '',
			grp_hashkey : '',

			// Step 2
			partc_hashkey : '',
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

			tipo_conta : '',
			//cad_email : 'listasguardiao@gmail.com',
			codigo_para_validar : '',
			codigo_validacao : '',

			participantes : LIST_PARTICIPANTES,
			participantes_json : '',
			participantes_elenco : [],
			participantes_elenco_json : [],
		},
		coreografos : [],
		selectedParticipants : [],
		error : {
			// Step 2
			partc_documento : '',
			partc_nome : '',
			partc_nome_social : '',
			partc_genero : '',
			partc_dte_nascto : '',
			func_id : '',
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
		stepGravarParticipante : function( next ){
			let arrSelect = vue.fields.participantes;
			let allFound = true;
			for (let j = 0; j < vue.lista_func_obrigatoria.length; j++) {
				let funcIdExists = false;
				let codFund = parseInt(vue.lista_func_obrigatoria[j].func_id);
				for (let i = 0; i < arrSelect.length; i++) {
					let codPart = parseInt(arrSelect[i].func_id);
					if (codPart === codFund) { funcIdExists = true; break; }
				}
				if (!funcIdExists) { allFound = false; break; }
			}
			if (!allFound) {
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Para prosseguir com a inscrição,  <br />é obrigatório cadastrar pelo menos: <br />' +
						'<strong>01 Diretor(a)</strong>, <br />' +
						'<strong>01 Coreógrafo(a)</strong> <br />' +
						'<strong>01 Bailarino(a)</strong>',
					confirmButtonText: 'Fechar',
					confirmButtonColor: "#0b8e8e",
				});
				return false;
			}
			window.location.href = this.urlPost +'inscricoes/coreografias/'+ vue.fields.event_hashkey; 
		},
		saveParticipante : function(){
			if(this.ValidateFormGravarParticipante()){
				let arrSelect = vue.fields.participantes;
				let arrSelectUnic = [];
				//let arrSelect = [];

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

				let partcHashkey = fctRandomString(32);
				if( vue.fields.partc_hashkey.length == 0 ){
					vue.fields.partc_hashkey = partcHashkey;
				}

				arrSelectUnic.push({ 
					partc_hashkey : fctRandomString(32),
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
				vue.fields.participantes = arrSelect;
				vue.fields.participantes_json = JSON.stringify(arrSelectUnic);
				vue.ResetFieldsGravarParticipante();
				console.log( JSON.stringify(vue.fields, null, 4) );
				//console.log('urlPost', this.urlPost );
				
				return false;
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
		updateParticipante : function(){
			if(this.ValidateFormGravarParticipante()){
				console.log( JSON.stringify(vue.fields, null, 4) );
				//console.log('urlPost', this.urlPost );
				return false;
				let form = this.formData(vue.fields);
				//vue.ResetFieldsGravarParticipante();
				form.append('fileInputLogotipo', this.imageLogotipo);
				axios.post(this.urlPost +'inscricoes/ajaxform/UPDATE-PARTICIPANTE', form).then(function(response){
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
		removeParticipante : function( jsonDADOS ){
			console.log('partc_hashkey', jsonDADOS.hashkey );

			let hashKeyToRemove = jsonDADOS.hashkey

			console.log( 'hashKeyToRemove: ', hashKeyToRemove );
			let arrSelect = vue.fields.participantes;

			//let valuePartcHashKey = this.$refs.participanteItem[0].dataset.partcHashkey;
			//console.log( 'valuePartcHashKey: ', valuePartcHashKey );

			// Recuperar o valor partc_hashkey do item removido
			let itemEncontrado = arrSelect.find(item => item.partc_hashkey === hashKeyToRemove);
			if (itemEncontrado) {
				let valorPartcHashKey = itemEncontrado.partc_hashkey;

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você deseja realmente excluir este registro?<br>'+
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
						form.append('partc_hashkey', valorPartcHashKey);
						axios.post(vue.urlPost +'inscricoes/ajaxform/EXCLUIR-PARTICIPANTE', form).then(function(response){
							//vue.loading.active = false;
							let respData = response.data;
							//console.log('respData', respData);
							if( respData.error_num == '0' ){
								//setTimeout(() => {
								//	vue.step = next;
								//}, 4000);

								console.log('Valor partc_hashkey do item removido:', valorPartcHashKey);
								console.log(valorPartcHashKey);

								arrSelect = arrSelect.filter(item => item.partc_hashkey !== hashKeyToRemove);
								vue.fields.participantes = arrSelect;

								return false;
							}
						});
						// ------------------------------------------------------
					}
				});








			}

		},
		editarParticipante : function( jsonDADOS ){
			console.log('partc_hashkey', jsonDADOS.hashkey );

			let hashKeyToRemove = jsonDADOS.hashkey

			console.log( 'hashKeyToRemove: ', hashKeyToRemove );
			let arrSelect = vue.fields.participantes;

			// Recuperar o valor partc_hashkey do item removido
			let itemEncontrado = arrSelect.find(item => item.partc_hashkey === hashKeyToRemove);
			if (itemEncontrado) {
				vue.formAcao = 'UPDATE';


				let valorPartcHashKey = itemEncontrado.partc_hashkey;


				//let valorPartcHashKey = itemEncontrado.partc_hashkey;
				console.log( 'item encontrado' );
				console.log( itemEncontrado );

				vue.fields.partc_hashkey = itemEncontrado.partc_hashkey;
				vue.fields.partc_documento = itemEncontrado.partc_documento;
				vue.fields.partc_nome = itemEncontrado.partc_nome;
				vue.fields.partc_nome_social = itemEncontrado.partc_nome_social;
				vue.fields.partc_genero = itemEncontrado.partc_genero;
				vue.fields.partc_dte_nascto = itemEncontrado.partc_dte_nascto;
				vue.fields.func_id = itemEncontrado.func_id;
				//vue.fields.func_titulo = itemEncontrado.func_titulo;
				//vue.fields.partc_file_foto = itemEncontrado.partc_nome;
				//vue.fields.partc_file_doc_frente = itemEncontrado.partc_nome;
				//vue.fields.partc_file_doc_verso = itemEncontrado.partc_nome;

				/*
				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você deseja realmente excluir este registro?<br>'+
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
						form.append('partc_hashkey', valorPartcHashKey);
						axios.post(vue.urlPost +'inscricoes/ajaxform/EXCLUIR-PARTICIPANTE', form).then(function(response){
							//vue.loading.active = false;
							let respData = response.data;
							//console.log('respData', respData);
							if( respData.error_num == '0' ){
								//setTimeout(() => {
								//	vue.step = next;
								//}, 4000);

								console.log('Valor partc_hashkey do item removido:', valorPartcHashKey);
								console.log(valorPartcHashKey);

								arrSelect = arrSelect.filter(item => item.partc_hashkey !== hashKeyToRemove);
								vue.fields.participantes = arrSelect;

								return false;
							}
						});
						// ------------------------------------------------------
					}
				});
				*/


			}

		},
		removeParticipante_OLD : function( hashKeyToRemove ){
			// Recuperando o elemento clicado
			let elementoClicado = event.target;

			// Verificando se o elemento clicado possui o atributo dataset
			if (elementoClicado.dataset) {
				// Recuperando o valor do atributo data-meudado
				let meuDado = elementoClicado.dataset.meudado;
				console.log('Valor do atributo data:', meuDado);
			}

			/*
			console.log( 'hashKeyToRemove: ', hashKeyToRemove );
			let arrSelect = vue.fields.participantes;


			let valuePartcHashKey = this.$refs.participanteItem[0].dataset.partcHashkey;
			console.log( 'valuePartcHashKey: ', valuePartcHashKey );

			// Recuperar o valor partc_hashkey do item removido
			let itemRemovido = arrSelect.find(item => item.partc_hashkey === hashKeyToRemove);
			if (itemRemovido) {


				let valorPartcHashKey = itemRemovido.partc_hashkey;
				console.log('Valor partc_hashkey do item removido:', valorPartcHashKey);
				console.log(valorPartcHashKey);

				arrSelect = arrSelect.filter(item => item.partc_hashkey !== hashKeyToRemove);
				vue.fields.participantes = arrSelect;
			}

			*/





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
