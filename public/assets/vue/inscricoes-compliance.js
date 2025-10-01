
/**
 * --------------------------------------------------------
 * ini : COREOGRAFIAS
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 1, // COMPLIANCE
		substep: 1,
		fields : {
			autz_titulo : '',
			autz_hashkey : '',
			grevt_hashkey : '',
			partc_hashkey : '',
		},
		error : {	
		},

		autorizacoes_aceitas : LIST_AUTORIZADOS,
		autorizacoes_aceitas_json : '',

		urlPost : SITE_URL,
		messageResult : '',
		//disabledButton : false,
	},
	methods : {
		open_autorizacao_detalhe : function( jsonDADOS, $event ){
			vue.fields.autz_titulo = jsonDADOS.autz_titulo;
			vue.fields.autz_hashkey = jsonDADOS.autz_hashkey;
			vue.fields.grevt_hashkey = jsonDADOS.grevt_hashkey;
			vue.fields.partc_hashkey = jsonDADOS.partc_hashkey;

			let autz_grupo = jsonDADOS.autz_grupo;
			let autz_descricao_full = jsonDADOS.autz_descricao_full;

			console.log( 'carregando dados da autorização: ' );
			console.log( 'autz_titulo', vue.fields.autz_titulo );
			console.log( 'autz_hashkey', vue.fields.autz_hashkey );
			console.log( 'grevt_hashkey', vue.fields.grevt_hashkey );
			console.log( 'partc_hashkey', vue.fields.partc_hashkey );
			
			let $modalAutorizacao = $('#modal_autorizacoes_full');
			let $modalAutGrupo = $modalAutorizacao.find('.modal-title');
			let $modalTitle = $modalAutorizacao.find('.modal-titulo');
			let $modalBody = $modalAutorizacao.find('.modal-descricao');
			let $btnModalAceito = $modalAutorizacao.find('.btnModalAceito');
			
			$modalAutGrupo.html( autz_grupo );
			$modalTitle.html( vue.fields.autz_titulo );
			$modalBody.html( autz_descricao_full );

			$btnModalAceito.removeClass('d-none');
			if( vue.verificar_participante( vue.fields.autz_hashkey ) ) {
				$btnModalAceito.addClass('d-none');
			}		

			var myModal = new bootstrap.Modal(document.getElementById('modal_autorizacoes_full'), {
				keyboard: false
			});
			myModal.show();
		},
		aceitar_autorizacao : function(){

			//var form = new FormData();
			//form.append('autorizacoes_aceitas', vue.autorizacoes_aceitas);
			let form = this.formData(vue.fields);
			axios.post(this.urlPost +'inscricoes/ajaxform/PARTICIPANTE-SALVAR-AUTORIZACOES', form).then(function(response){
				//vue.loading.active = false;
				let respData = response.data;

				if( respData.error_num == '1' ){
					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html: respData.error_msg,
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
					return false;
				}else{
					let arrSelect = vue.autorizacoes_aceitas;
					let arrSelectUnic = [];
					
					console.log( 'data: '+ vue.fields.ptcaut_data );

					arrSelectUnic.push({ 
						autz_titulo : vue.fields.autz_titulo,
						autz_hashkey : vue.fields.autz_hashkey,
						grevt_hashkey : vue.fields.grevt_hashkey,
						partc_hashkey : vue.fields.partc_hashkey,
						ptcaut_data : respData.ptcaut_data,
					});
					arrSelect.push(...arrSelectUnic);
					vue.autorizacoes_aceitas = arrSelect;
					vue.autorizacoes_aceitas_json = JSON.stringify(vue.autorizacoes_aceitas);
					
					
					console.log( vue.autorizacoes_aceitas );
				}
				
				$('#modal_autorizacoes_full').modal('hide');

				//var myModal = new bootstrap.Modal(document.getElementById('modal_autorizacoes_full'), {
				//	keyboard: false
				//});
				//myModal.hide();
			});

			console.log( vue.autorizacoes_aceitas );
		},
		verificar_participante( hashKeyToAutoriz ) {
			console.log( this.autorizacoes_aceitas );
			console.log( this.autorizacoes_aceitas.ptcaut_data );
			console.log('hashKeyToAutoriz:', hashKeyToAutoriz);
			let arrSelect = this.autorizacoes_aceitas;
			//vue.autorizacoes_aceitas_json = JSON.stringify(this.autorizacoes_aceitas);
			let itemEncontrado = arrSelect.find(item => item.autz_hashkey === hashKeyToAutoriz);
			if( itemEncontrado ){
				console.log('sim');	
			}else{
				console.log('nao');
			}
			return !!itemEncontrado;
		},
		verificar_data_OLD( hashKeyToAutoriz ) {
			//console.log( this.autorizacoes_aceitas );
			//console.log( this.autorizacoes_aceitas.ptcaut_data );
			console.log('hashKeyToAutoriz:', hashKeyToAutoriz);
			let arrSelect = this.autorizacoes_aceitas;
			//vue.autorizacoes_aceitas_json = JSON.stringify(this.autorizacoes_aceitas);
			let itemEncontrado = arrSelect.find(item => item.autz_hashkey === hashKeyToAutoriz);
			//console.log('itemEncontrado:', itemEncontrado);
			if( itemEncontrado ){
				return itemEncontrado.ptcaut_data;
				console.log('sim');	
			}
			//return !!itemEncontrado;
		},
		verificar_data( hashKeyToAutoriz ) {
			let arrSelect = this.autorizacoes_aceitas;
			let itemEncontrado = arrSelect.find(item => item.autz_hashkey === hashKeyToAutoriz);
			console.log( itemEncontrado );	
			//if( itemEncontrado ){
			//return itemEncontrado.ptcaut_data;
			return itemEncontrado ? itemEncontrado.ptcaut_data : 'Data não encontrada';
			//}
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
			//console.log( JSON.stringify(vue.fields, null, 4) );
			vue.fields.participantes_elenco_json = '';
			vue.fields.participantes_elenco = [];
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
							'Não existe participantes relacionados a esta categoria. '+ respData.error_num +' | '+ respData.error_msg,
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
				}
			});
		},
		selectFormato : function(){
			let formatos = vue.lista_formatos;
			let formtEncontrado = formatos.find(item => item.formt_id === vue.fields.corgf_formt_id);
			if( vue.evcfg_config_limites.envio_musica == 1){ 
				let tempoTotal = this.converterParaSegundos(formtEncontrado.formt_tempo_limit);
				vue.fields.corgf_tempo_max = this.converterParaMinutosESegundos(tempoTotal);

				// limpar o campo da musica
				vue.error.corgf_musica_file = "";
				vue.error.corgf_musica_msg = "";
				//vue.fields.corgf_musica_file = "";
				//vue.fields.corgf_tempo = "";

				// validar musica caso ela já tenha sido selecionada
				if( vue.fields.corgf_tempo > vue.fields.corgf_tempo_max ){
					//vue.fields.corgf_tempo = '';
					vue.error.corgf_musica_msg = "Música com tempo maior que o permitido.";
				}
			}
		},
		SalvarCoreografia : function(){
			if(this.ValidateFormGravarCoreografia()){
				/*
				VALIDACOES
				*/
				vue.fields.coreografia_elenco_json = JSON.stringify(vue.fields.coreografia_elenco_all);
				vue.fields.elenco_coreografos_json = JSON.stringify(vue.fields.elenco_coreografos);
				vue.fields.elenco_bailarinos_json = JSON.stringify(vue.fields.elenco_bailarinos);
				console.log( JSON.stringify(vue.fields, null, 4) );
				let form = this.formData(vue.fields);
				form.append('fileInputMusica', this.imageFileMusica);
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
				console.log( JSON.stringify(vue.error, null, 4) );
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
		clickItemCheckboxChangeCor : function( jsonDADOS, $event ){
			let partcID = jsonDADOS.partc_id;
			let participantes = vue.lista_coreografos;
			//let arrSelect = vue.elencoSelecionado;
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
				vue.selectedCoreografos.push(partcID);
			} else {
				// Remove a opção do array se estiver presente
				vue.arrSelectUnicCor.splice(index, 1);
				vue.selectedCoreografos = this.selectedCoreografos.filter(id => id !== partcID);
			}
			vue.fields.elenco_coreografos = vue.selectedCoreografos;
			//vue.fields.coreografia_elenco = vue.selectedItems;
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;
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

			// verifica se o item clicado já está na lista
			let jaSelecionado = vue.selectedBailarinos.includes(partcID);
			if( jaSelecionado == false ){
				console.log('jaSelecionado', jaSelecionado );
				let qtdElencoBailarinoSelect = vue.fields.elenco_bailarinos.length;
				console.log('quant', qtdElencoBailarinoSelect );
				console.log('max_part', formtEncontrado.formt_max_partic );
				if( qtdElencoBailarinoSelect >= formtEncontrado.formt_max_partic ){
					Swal.fire({
						title: 'Atenção!',
						icon: 'warning',
						html:
							'Você já selecionou o número máximo de <br>participantes para o formato escolhido.',
						confirmButtonText: 'Fechar',
						confirmButtonColor: "#0b8e8e",
					});
					return false;
					//const indice = vue.fields.coreografia_elenco.indexOf(mk);
					const indice = vue.fields.elenco_bailarinos.findIndex(item => item.partc_id === partcID);
					vue.fields.elenco_bailarinos.splice(indice, 1);
					$event.target.checked = false;
				}
			}

			let participantes = vue.fields.participantes_elenco;
			let itemEncontrado = [];

			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			//if (index === -1 && event.target.checked) {
			if (index === -1) {
				itemEncontrado = participantes.find(item => item.partc_id === partcID);
				// Adiciona a opção ao array se não estiver presente
				vue.arrSelectUnicCor.push({ 
					partc_documento: itemEncontrado.partc_documento, 
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome
				});
				vue.selectedBailarinos.push(partcID);
				vue.fields.elenco_bailarinos = vue.selectedBailarinos;
			//} else if (index !== -1 && !event.target.checked) {
			} else if (index !== -1) {
				// Remove a opção do array se estiver presente
				vue.arrSelectUnicCor.splice(index, 1);
				vue.selectedBailarinos = vue.selectedBailarinos.filter(id => id !== partcID);
				vue.fields.elenco_bailarinos = vue.selectedBailarinos;
			}

			//console.log( vue.arrSelectUnicCor );
			vue.fields.coreografia_elenco_all = vue.arrSelectUnicCor;
		},
		handleCheckboxChangeCoreogf : function(jsonDADOS, $event){
			//alert('entrou aqui');
			let partcID = jsonDADOS.partc_id;

			let participantes = vue.lista_coreografos;
			let itemEncontrado = [];

			const index = vue.arrSelectUnicCor.findIndex(item => item.partc_id === partcID);
			//if (index === -1 && event.target.checked) {
			if (index === -1) {
				itemEncontrado = participantes.find(item => item.partc_id === partcID);
				// Adiciona a opção ao array se não estiver presente
				vue.arrSelectUnicCor.push({ 
					partc_documento: itemEncontrado.partc_documento, 
					partc_id: partcID,
					partc_nome: itemEncontrado.partc_nome
				});
				vue.selectedCoreografos.push(partcID);
				vue.fields.elenco_coreografos = vue.selectedCoreografos;
			//} else if (index !== -1 && !event.target.checked) {
			} else if (index !== -1) {
				// Remove a opção do array se estiver presente
				vue.arrSelectUnicCor.splice(index, 1);
				vue.selectedCoreografos = vue.selectedCoreografos.filter(id => id !== partcID);
				vue.fields.elenco_coreografos = vue.selectedCoreografos;
			}

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
		loadEditCoreografia : function( jsonDADOS ){
			console.log('corgf_hashkey', jsonDADOS.hashkey );
			let hashKeyToRemove = jsonDADOS.hashkey;
			let arrSelect = vue.lista_corf_cadastradas;
			let itemEncontrado = arrSelect.find(item => item.corgf_hashkey === hashKeyToRemove);
			if (itemEncontrado) {
				vue.selectedItems = [];

				// ------------------------------------------------------
				var form = new FormData();
				form.append('corgf_hashkey', hashKeyToRemove);
				axios.post(vue.urlPost +'inscricoes/ajaxform/LOAD-EDIT-COREOGRAFIA', form).then(function(response){
					let respData = response.data;
					if( respData.error_num == '0' ){
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
		converterParaSegundos : function(tempo){
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
		converterParaMinutosESegundos : function(segundos){
			let minutos = Math.floor(segundos / 60);
			let segundosRestantes = segundos % 60;
			//return `${minutos}:${segundosRestantes}`;
			return `${minutos.toString().padStart(2, '0')}:${segundosRestantes.toString().padStart(2, '0')}`;
		},
		selecionarArquivo : function(event){
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
						if( vue.fields.corgf_tempo > vue.fields.corgf_tempo_max ){
							//vue.fields.corgf_tempo = '';
							vue.error.corgf_musica_msg = "Música com tempo maior que o permitido.";
							event.target.value = '';
						}else{
							vue.fields.corgf_musica_file = files[i].name;
							vue.imageFileMusica = files[i];
						}
					});
					audioElement.load();
				}else{
					vue.error.corgf_musica_msg = "Tipo de arquivo inválido. Permitido somente MP3.";
					event.target.value = '';
				}
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
	},

});
/**
 * --------------------------------------------------------
 * end : COREOGRAFIAS
 * --------------------------------------------------------
**/	
