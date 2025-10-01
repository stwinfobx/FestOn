/**
 * --------------------------------------------------------
 * ini : INICIAL // CDCONTEMP-2025/curso-de-danca-contemporanea
 * --------------------------------------------------------
**/	
var vue = new Vue({
	el : "#app",

	data : {
		step: 3,
		substep: 1,	
		lista_estados : LIST_ESTADOS,
		lista_cidades : [],		
		fields : {
			uf_id : '',
			munc_id : '',
			crsit_cpf : '',
			crsit_nome : '',
			crsit_email : '',
			crsit_genero : '',
			crsit_dte_nascto : '',
			crsit_anos_exper : '',
			crsit_nivel : '',
			crsit_estilo_danca : '',
			crsit_funcao : '',
		},
		error : {
			uf_id : '',
			munc_id : '',
			crsit_cpf : '',
			crsit_nome : '',
			crsit_email : '',
			crsit_genero : '',
			crsit_dte_nascto : '',
			crsit_anos_exper : '',
			crsit_nivel : '',
			crsit_estilo_danca : '',
			crsit_funcao : '',
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
			
		fldReadonly : false,		

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

		getDadosCadastro : function(){
			let cad_cpf = vue.fields.crsit_cpf;
			let form = new FormData();
			form.append('cad_cpf', cad_cpf);

			vue.fldReadonly = false;
			axios.post(this.urlPost +'inscricoes//ajaxform/LOAD-CADASTRO-AJAX', form).then(function(response){
				//console.log('respData', response.data);
				if( response.data ){
					let respData = response.data;
					if( respData.error_num == '0' ){
						vue.fldReadonly = true;
						vue.fields.crsit_nome = respData.dados.cad_nome;
						vue.fields.crsit_email = respData.dados.cad_email;
						vue.fields.crsit_genero = respData.dados.cad_genero;
						vue.fields.crsit_dte_nascto = respData.dados.cad_dte_nascto;
					}else{
						vue.fields.crsit_nome = '';
						vue.fields.crsit_email = '';
						vue.fields.crsit_genero = '';
						vue.fields.crsit_dte_nascto = '';
					}
				}
			});
		},
		salvarParticipante : function(){
			let form = this.formData(vue.fields);
			//form.append ('reserva_hashkey', vue.reserva_hashkey);
			console.log( JSON.stringify(vue.fields, null, 4) );
			console.log('urlPost', this.urlPost );
			//return false;
			//vue.fldReadonly = false;
			axios.post(this.urlPost +'workshops/ajaxform/SALVAR-INSCRICAO-DO-PARTICIPANTE', form).then(function(response){
				console.log('respData', response.data);
				if( response.data ){
					let respData = response.data;
					if( respData.error_num == '0' ){
						Swal.fire({
							title: 'Atenção!',
							icon: 'success',
							html: respData.error_msg,
							confirmButtonText: 'Fechar',
							confirmButtonColor: "#0b8e8e",
						});
					}else{
						Swal.fire({
							title: 'Atenção!',
							icon: 'warning',
							html: respData.error_msg,
							confirmButtonText: 'Fechar',
							confirmButtonColor: "#0b8e8e",
						});
					}
				}
			});
		},
		
		
		selectEstados : function(event){
			vue.fields.uf_id = event.target.value;
			vue.loadCidades( event.target.value );
		},
		loadCidades : function(uf_id){
			vue.fields.uf_id = uf_id;
			let form = this.formData(this.fields);
			vue.loading.active = true;
			axios.post(this.urlPost +'inscricoes/ajaxform/LISTA-CIDADES', form).then(function(response){
				setTimeout(() => {
					vue.loading.active = false;
					if( response.data ){
						let respData = response.data;
						if( respData.error_num == '0' ){
							vue.lista_cidades = respData.cidades;
							return false;
						}else{
							vue.lista_cidades = [];
						}
					}
				}, 400);
			});
		},
		formData : function(obj){
			var formData = new FormData();
			for(var key in obj){
				formData.append(key, obj[key]);
			}
			return formData;
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
		focusField : function( event ){
			if( vue.fldReadonly == true ){ event.target.blur(); }
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
		encontrarFuncao : function( fnct_id ){
			let LISTA_FUNCOES = vue.lista_funcoes;
			for (let funcoes of LISTA_FUNCOES) {
				if (fnct_id == funcoes.func_id) {
					return { id : funcoes.func_id, titulo : funcoes.func_titulo } ;
				}
			}
			return 'error';
		},
		removeWorkItem : function( event ){
			Swal.fire({
				title: 'Atenção!',
				icon: 'warning',
				html:
					'Você deseja realmente remover este curso da sua lista?<br>'+
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
					// ação confirmada
					const itemToRemove = event.target.closest(".item-check"); // Encontra o item mais próximo
					if (itemToRemove) {
						itemToRemove.remove(); // Remove do DOM
						Swal.fire("Removido!", "Curso removido com sucesso!", "success");
					}					
				}
			});
		},
		
	},
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
	},

});
/**
 * --------------------------------------------------------
 * end : INICIAL
 * --------------------------------------------------------
**/	
