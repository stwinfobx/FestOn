
/**
	// 097.734.659-50
 * --------------------------------------------------------
 * ini : INICIAL
 * --------------------------------------------------------
**/	
var vuePed = new Vue({
	el : "#app",

	data : {
		lista_status : LIST_STATUS,
		//inputField1: '',
		fields : { 
			search : '',
		},
		fieldpedido : { 
			pedidoid : '',
			observacao : '',
		},
		//error : {
		//	cad_categoria : '', 
		//	cad_cpf : '', 
		//},

		list_clientes : [],

		fieldsprod : { 
			search : '',
			quantidade : '',
			select : '',
			list_cart_produtos : [],
			valor_total : '',
			cliente_id : CLIENTE_ID,
			status_id : '',
			data_cobranca : '',
		},
		list_produtos : [],

		//box_msg_success: { active : false },

		urlPost : SITE_URL,
		messageResult : '',
		disabledButton : true,
		messageErrorResult : '',
	},

	methods : {
		AutoComplete : function(){ // use onkeyup
			if(vuePed.fields.search.length >= 2){
				//vue.loading.active = true;
				let form = this.formData(vuePed.fields);
				//console.log( JSON.stringify(vuePed.fields, null, 4) );
				//return false;

				axios.post(this.urlPost +'clientes/ajaxform/autocomplete', form).then(function(response){
					//vue.loading.active = false;
					//console.log('DATA', response.data );
					//list_clientes = response.data.clientes;

					const NewListClientes = response.data.clientes;
					vuePed.list_clientes.push( ...NewListClientes );

					//if( response.data ){
					//	let respData = response.data;
					//	if( respData.error_num == '0' ){
					//		vue.messageResult = respData.error_msg;	
					//		vue.overlay.active = true;
					//		setTimeout(() => {
					//			window.location.href = respData.redirect;
					//		}, 1000);
					//		return false;
					//	}else{
					//		vue.messageResult = respData.error_msg;	
					//		vue.overlay.active = true;								
					//	}
					//}
				});
				return false;
			}else{
				//vue.messageResult = "Por favor, preencha todos os campos corretamente.";	
				//vue.overlay.active = true;
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
		ValidateForm : function(){
			var error = 0;
			return (error === 0);
			if(this.fields.cad_categoria.length == 0){
				this.error.cad_categoria = "Campo requerido";
				error++;
			}
			if(this.fields.cad_categoria == 'null'){
				this.error.cad_categoria = "Campo requerido";
				error++;
			}			
			if(this.fields.cad_cpf.length == 0){
				this.error.cad_cpf = "Campo requerido";
				error++;
			}			
			return (error === 0);
		},
		ResetForm : function(){
			//this.fields.cad_categoria = "";
			//this.fields.cad_cpf = "";
		},
		ResetError : function(){
			this.error.cad_categoria = '';
			this.error.cad_cpf = '';
		},
		AutoCompleteProduto : function(){ // use onkeyup
			if(vuePed.fieldsprod.search.length >= 2){
				//vue.loading.active = true;
				let form = this.formData(vuePed.fieldsprod);
				//console.log( JSON.stringify(vuePed.fieldsprod, null, 4) );
				//return false;
				vuePed.list_produtos = [];
				axios.post(this.urlPost +'produtos/ajaxform/autocomplete', form).then(function(response){
					//vue.loading.active = false;
					//console.log('DATA', response.data );
					//list_clientes = response.data.clientes;

					const NewListProdutos = response.data.produtos;
					vuePed.list_produtos.push( ...NewListProdutos );
					//console.log( 'qtd prod', vuePed.list_produtos.length );
				});
				return false;
			}else{
				//vue.messageResult = "Por favor, preencha todos os campos corretamente.";	
				//vue.overlay.active = true;
				return false;
			}
		},
		SelectProduto : function( jsonDADOS ){ // use onkeyup
			console.log( jsonDADOS.id +' | '+ jsonDADOS.descricao +' | '+ vuePed.fieldsprod.quantidade );
			vuePed.fieldsprod.select = jsonDADOS;
			vuePed.fieldsprod.search = jsonDADOS.descricao;
			vuePed.list_produtos = [];
			vuePed.messageErrorResult = '';
		},
		AddProduto : function(  ){ // use onkeyup3
			let jsonDADOS = vuePed.fieldsprod.select;
			//console.log( jsonDADOS.id +' | '+ jsonDADOS.descricao +' | '+ vuePed.fieldsprod.quantidade );
			
			if(vuePed.fieldsprod.select.length == 0){
				vuePed.messageErrorResult = 'Selecione um produto';
				setTimeout(() => {
					vuePed.messageErrorResult = '';
				}, 1000);
				return false;
			}
			if(vuePed.fieldsprod.quantidade.length == 0){
				vuePed.messageErrorResult = 'Informe a quantidade';
				setTimeout(() => {
					vuePed.messageErrorResult = '';
				}, 1000);
				return false;
			}
			vuePed.fieldsprod.list_cart_produtos.push({
				id: jsonDADOS.id, 
				descricao: jsonDADOS.descricao,
				valor: jsonDADOS.valor,
				quantidade: vuePed.fieldsprod.quantidade,
				subtotal: (jsonDADOS.valor * vuePed.fieldsprod.quantidade) 
			});


			let cart_produto = [];
			cart_produto.push({
				id: jsonDADOS.id, 
				descricao: jsonDADOS.descricao,
				valor: jsonDADOS.valor,
				quantidade: vuePed.fieldsprod.quantidade,
				subtotal: (jsonDADOS.valor * vuePed.fieldsprod.quantidade) 
			});

			let form = this.formData();
			form.append ('produto', JSON.stringify(cart_produto));
			axios.post(this.urlPost +'carrinho/ajaxform/add-produto-carrinho', form).then(function(response){
				//vue.loading.active = false;
				if( response.data ){
					let respData = response.data;
					console.log( respData );
					//if( respData.error_num == '0' ){
					//	vue.messageResult = respData.error_msg;	
					//	vue.overlay.active = true;
					//	setTimeout(() => {
					//		window.location.href = respData.redirect;
					//	}, 1000);
					//	return false;
					//}else{
					//	//vue.messageResult = respData.error_msg;	
					//	//vue.overlay.active = true;
					//}
				}
			});

			vuePed.AtualizaValores();

			vuePed.messageErrorResult = '';
			vuePed.list_produtos = [];
			vuePed.fieldsprod.search = '';
			vuePed.fieldsprod.quantidade = '';
			vuePed.fieldsprod.select = '';
		},
		ExcluirProduto : function(item){

			let cart = vuePed.fieldsprod.list_cart_produtos.indexOf(item);
			if(vuePed.fieldsprod.list_cart_produtos.length >= 1){
				let cartItem = vuePed.fieldsprod.list_cart_produtos[cart];
				let produto_id = cartItem.id; 
				let descricao = cartItem.descricao;

				let cart_produto = [];
				cart_produto.push({
					id: produto_id, 
					descricao: descricao,
				});

				let form = this.formData();
				form.append ('produto', JSON.stringify(cart_produto));
				axios.post(this.urlPost +'carrinho/ajaxform/remove-produto-carrinho', form).then(function(response){
					//vue.loading.active = false;
					if( response.data ){
						let respData = response.data;
						//console.log( respData );
						//if( respData.error_num == '0' ){
						//	vue.messageResult = respData.error_msg;	
						//	vue.overlay.active = true;
						//	setTimeout(() => {
						//		window.location.href = respData.redirect;
						//	}, 1000);
						//	return false;
						//}else{
						//	//vue.messageResult = respData.error_msg;	
						//	//vue.overlay.active = true;
						//}
					}
				});

				vuePed.fieldsprod.list_cart_produtos.splice(vuePed.fieldsprod.list_cart_produtos.indexOf(item), 1);
			}

			vuePed.AtualizaValores();
		},
		AtualizaValores : function(){
			if(vuePed.fieldsprod.list_cart_produtos.length == 0){
				vuePed.disabledButton = true;
			}else{
				vuePed.disabledButton = false;

				let bills = vuePed.fieldsprod.list_cart_produtos;
				var res = bills.map(bill => bill.subtotal).reduce((acc, amount) => acc + amount);
				//console.log(res);
				vuePed.fieldsprod.valor_total = res; 
			}
		},
		SendFormPedido : function(){
			console.log( JSON.stringify(vuePed.fieldsprod, null, 4) );
			//return false;
			//if(this.ValidateForm()){
				//vue.loading.active = true;
				let form = this.formData(vuePed.fieldsprod);
				//let form = vueMC.formData(vueMC.fcupom);

				//console.log('fcupom', JSON.stringify(vueMC.fcupom) );
				//console.log('vlr_total',  );
				//return false;

				//form.append ('valores', JSON.stringify(vueMC.fcupom.vlr_total));
				form.append ('produtos', JSON.stringify(vuePed.fieldsprod.list_cart_produtos));

				axios.post(this.urlPost +'carrinho/ajaxform/finalizar-pedido', form).then(function(response){
					//vue.loading.active = false;
					if( response.data ){
						let respData = response.data;
						console.log( respData );
						//if( respData.error_num == '0' ){
						//	vue.messageResult = respData.error_msg;	
						//	vue.overlay.active = true;
						//	setTimeout(() => {
						//		window.location.href = respData.redirect;
						//	}, 1000);
						//	return false;
						//}else{
						//	//vue.messageResult = respData.error_msg;	
						//	//vue.overlay.active = true;
						//}

						vuePed.messageErrorResult = '';
						vuePed.list_produtos = [];
						vuePed.fieldsprod.list_cart_produtos = [];
						vuePed.fieldsprod.status_id = '';
						vuePed.fieldsprod.data_cobranca = '';
						vuePed.fieldsprod.search = '';
						vuePed.fieldsprod.quantidade = '';
						vuePed.fieldsprod.select = '';
					}
				});
				return false;
			//}else{
			//	vue.messageResult = "Por favor, preencha todos os campos corretamente.";	
			//	vue.overlay.active = true;
			//	return false;
			//}
		},

		//DeletarPedido : function(pedidoid){

		//	console.log( pedidoid );
		//	return false;

		//	let form = this.formData();
		//	form.append ('pedidoid', pedidoid);
		//	//console.log( vuePed.fieldpedido );
		//	//console.log( JSON.stringify(this.fieldpedido, null, 4) );
		//	//return false;

		//	axios.post(this.urlPost +'pedidos/ajaxform/DELETAR-PEDIDO', form).then(function(response){
		//		if( response.data ){
		//			let respData = response.data;
		//			console.log( 'foi' );
		//			console.log( respData );
		//		}
		//	});
		//},

		SalvarObservacao : function(  ){
			vuePed.messageResult = '';

			let form = this.formData(this.fieldpedido);
			//console.log( vuePed.fieldpedido );
			//console.log( JSON.stringify(this.fieldpedido, null, 4) );
			//return false;
			axios.post(this.urlPost +'pedidos/ajaxform/SALVAR-OBSERVACAO', form).then(function(response){
				if( response.data ){
					let respData = response.data;
					if( respData.error_num == '0' ){
						vuePed.messageResult = respData.error_msg;
					}else{
						vuePed.messageResult = respData.error_msg;	
					}
					setTimeout(() => { 
						vuePed.messageResult = '';
					}, 2000);
				}
			});
		},
		closeOverlay : function(){
			vue.messageResult = '';	
			vue.overlay.active = false;
		},
		formatPrice(value) {
			var formatter = new Intl.NumberFormat('en-US', {
				style: 'currency',
				currency: 'PHP',
				minimumFractionDigits: 2
			});
			return formatter.format(value);
		},
		triggerAutoload() {
			const autoloadFields = document.querySelectorAll('[autoload]');
			autoloadFields.forEach((field) => {
				const modelName = field.getAttribute('v-model');
				const value = field.value; // Obter o valor do campo
				if (modelName) {
					const [model, property] = modelName.split('.');
					if (property) {
						if (this[model]) { 
							if (field.tagName.toLowerCase() === 'input') {
								this[model][property] = value;
							} else if (field.tagName.toLowerCase() === 'textarea') {
								this[model][property] = field.innerHTML; // Usar field.innerHTML para campos <textarea>
							}
						}
					} else {
						this[model] = value;
					}
				}
			});
		}
		//triggerAutoload() {
		//  const autoloadFields = document.querySelectorAll('[autoload]');
		//  autoloadFields.forEach((field) => {
		//	const modelName = field.getAttribute('v-model');
		//	const value = field.getAttribute('value');
		//	if (modelName) {
		//		const [model, property] = modelName.split('.');
		//		if (property) {
		//			if (this[model]) { this[model][property] = value; }
		//		} else {
		//			this[model] = value;
		//		}
		//	}
		//  });
		//}
	},

	mounted: function (){
		//console.log( this.fieldpedido.pedidoid );
		//this.triggerAutoload();

		//const autoloadFields = document.querySelectorAll('[autoload]');
		//autoloadFields.forEach((field) => {
		//	const event = new Event('input', { bubbles: true });
		//	field.dispatchEvent(event);
		//});

		//const inputField1 = document.querySelector('input[type="text"]');
		//const event = new Event('input', { bubbles: true });
		//inputField1.dispatchEvent(event);


		//console.log('carregar slider');
		//const carousel = $("#carousel").waterwheelCarousel({
		//	flankingItems: 3,
		//	activeClassName: 'itemAtivo',
		//});
	},
	beforeMount() {
	   // carregar assim que montar a tela
	   this.triggerAutoload();
	},
	filters: {
		toCurrency: function (value) {
			let val = (value / 1).toFixed(2).replace(".", ",");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
	}
});

Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
  //let val = (value / 1).toFixed(2).replace(".", ",");
  //return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");


	value = parseFloat((value/100)).toFixed(2);
	return (new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value));
    //var formatter = new Intl.NumberFormat('en-US', {
    //    style: 'currency',
    //    currency: 'USD'
    //});
    //return formatter.format(value);
});
/**
 * --------------------------------------------------------
 * end : INICIAL
 * --------------------------------------------------------
**/	
