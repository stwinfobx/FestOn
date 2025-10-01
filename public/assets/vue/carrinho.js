
/**
 * --------------------------------------------------------
 * ini : INICIAL
 * --------------------------------------------------------
**/	
var vueCart = new Vue({
	el : "#app",

	data : {
		lista_produtos : LIST_PRODUTOS,
		lista_status : LIST_STATUS,
		fields : { 
			search : '',
		},
		//error : {
		//	cad_categoria : '', 
		//	cad_cpf : '', 
		//},

		list_clientes : [],

		fieldsprod : { 
			produto : '',
			quantidade : '',
			select : '',
			list_cart_produtos : [],
			valor_total : '',
			cliente_id : CLIENTE_ID,
			status_id : '',
			observacao : '',
			data_cobranca : '',
		},
		list_produtos : [],

		//box_msg_success: { active : false },

		urlPost : SITE_URL,
		messageResult : 'teste',
		disabledButton : true,
		messageErrorResult : '',
		timer : '',
	},

	methods : {
		AutoComplete : function(){ // use onkeyup
			if(vueCart.fields.search.length >= 2){

				clearTimeout(this.timer);

				this.timer = setTimeout(() => {
					this.ExecAutoComplete();
				}, 500);

				return false;
			}else{
				//vue.messageResult = "Por favor, preencha todos os campos corretamente.";	
				//vue.overlay.active = true;
				return false;
			}
		},
		ExecAutoComplete : function(){ // use onkeyup

			//vue.loading.active = true;
			let form = this.formData(vueCart.fields);
			//console.log( JSON.stringify(vueCart.fields, null, 4) );
			//return false;

			vueCart.list_clientes = [];
			axios.post(this.urlPost +'clientes/ajaxform/autocomplete', form).then(function(response){
				//vue.loading.active = false;
				//console.log('DATA', response.data );
				//list_clientes = response.data.clientes;

				const NewListClientes = response.data.clientes;
				vueCart.list_clientes.push( ...NewListClientes );

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

		},
		SendPreCadastro : function(){
			if(this.ValidateForm()){
				vueCart.loading.active = true;
				let form = this.formData(this.fields);
				axios.post(this.urlPost +'ajaxform/pre-cadastro', form).then(function(response){
					vue.loading.active = false;
					if( response.data ){
						let respData = response.data;
						if( respData.error_num == '0' ){
							vue.messageResult = respData.error_msg;	
							vue.overlay.active = true;
							setTimeout(() => {
								window.location.href = respData.redirect;
							}, 1000);
							return false;
						}else{
							vue.messageResult = respData.error_msg;	
							vue.overlay.active = true;								
						}
					}
				});
				return false;
			}else{
				vue.messageResult = "Por favor, preencha todos os campos corretamente.";	
				vue.overlay.active = true;					
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
			if(vueCart.fieldsprod.search.length >= 2){
				//vue.loading.active = true;
				let form = this.formData(vueCart.fieldsprod);
				//console.log( JSON.stringify(vueCart.fieldsprod, null, 4) );
				//return false;
				vueCart.list_produtos = [];
				axios.post(this.urlPost +'produtos/ajaxform/autocomplete', form).then(function(response){
					//vue.loading.active = false;
					//console.log('DATA', response.data );
					//list_clientes = response.data.clientes;

					const NewListProdutos = response.data.produtos;
					vueCart.list_produtos.push( ...NewListProdutos );
					//console.log( 'qtd prod', vueCart.list_produtos.length );
				});
				return false;
			}else{
				//vue.messageResult = "Por favor, preencha todos os campos corretamente.";	
				//vue.overlay.active = true;
				return false;
			}
		},
		SelectProduto : function( jsonDADOS ){ // use onkeyup
			console.log( jsonDADOS.id +' | '+ jsonDADOS.descricao +' | '+ vueCart.fieldsprod.quantidade );
			vueCart.fieldsprod.select = jsonDADOS;
			vueCart.fieldsprod.search = jsonDADOS.descricao;
			vueCart.list_produtos = [];
			vueCart.messageErrorResult = '';
		},
		AddProduto : function(  ){ // use onkeyup3
			//let jsonDADOS = vueCart.fieldsprod.select;
			//console.log( jsonDADOS.id +' | '+ jsonDADOS.descricao +' | '+ vueCart.fieldsprod.quantidade );

			//if(vueCart.fieldsprod.select.length == 0){
			//	vueCart.messageErrorResult = 'Selecione um produto';
			//	setTimeout(() => {
			//		vueCart.messageErrorResult = '';
			//	}, 1000);
			//	return false;
			//}

			let jsonDADOS = vueCart.fieldsprod.produto;
			if(vueCart.fieldsprod.produto.length == 0){
				vueCart.messageErrorResult = 'Selecione um produto';
				setTimeout(() => {
					vueCart.messageErrorResult = '';
				}, 1000);
				return false;
			}
			if(vueCart.fieldsprod.quantidade.length == 0){
				vueCart.messageErrorResult = 'Informe a quantidade';
				setTimeout(() => {
					vueCart.messageErrorResult = '';
				}, 1000);
				return false;
			}
			vueCart.fieldsprod.list_cart_produtos.push({
				id: jsonDADOS.id, 
				descricao: jsonDADOS.descricao,
				valor: jsonDADOS.valor,
				quantidade: vueCart.fieldsprod.quantidade,
				subtotal: (jsonDADOS.valor * vueCart.fieldsprod.quantidade) 
			});

			let cart_produto = [];
			cart_produto.push({
				id: jsonDADOS.id, 
				descricao: jsonDADOS.descricao,
				valor: jsonDADOS.valor,
				quantidade: vueCart.fieldsprod.quantidade,
				subtotal: (jsonDADOS.valor * vueCart.fieldsprod.quantidade) 
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

			vueCart.AtualizaValores();

			vueCart.messageErrorResult = '';
			vueCart.list_produtos = [];
			//vueCart.fieldsprod.search = '';
			vueCart.fieldsprod.produto = '';
			vueCart.fieldsprod.quantidade = '';
			vueCart.fieldsprod.select = '';
		},
		ExcluirProduto : function(item){

			let cart = vueCart.fieldsprod.list_cart_produtos.indexOf(item);
			if(vueCart.fieldsprod.list_cart_produtos.length >= 1){
				let cartItem = vueCart.fieldsprod.list_cart_produtos[cart];
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

				vueCart.fieldsprod.list_cart_produtos.splice(vueCart.fieldsprod.list_cart_produtos.indexOf(item), 1);
			}

			vueCart.AtualizaValores();
		},
		AtualizaValores : function(){
			if(vueCart.fieldsprod.list_cart_produtos.length == 0){
				vueCart.disabledButton = true;
			}else{
				vueCart.disabledButton = false;

				let bills = vueCart.fieldsprod.list_cart_produtos;
				var res = bills.map(bill => bill.subtotal).reduce((acc, amount) => acc + amount);
				//console.log(res);
				vueCart.fieldsprod.valor_total = res; 
			}
		},
		SendFormPedido : function(){
			console.log( JSON.stringify(vueCart.fieldsprod, null, 4) );
			//return false;
			//if(this.ValidateForm()){
				//vue.loading.active = true;
				let form = this.formData(vueCart.fieldsprod);
				//let form = vueMC.formData(vueMC.fcupom);

				//console.log('fcupom', JSON.stringify(vueMC.fcupom) );
				//console.log('vlr_total',  );
				//return false;

				//form.append ('valores', JSON.stringify(vueMC.fcupom.vlr_total));
				form.append ('produtos', JSON.stringify(vueCart.fieldsprod.list_cart_produtos));

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

						vueCart.messageErrorResult = '';
						vueCart.list_produtos = [];
						vueCart.fieldsprod.list_cart_produtos = [];
						vueCart.fieldsprod.status_id = '';
						vueCart.fieldsprod.data_cobranca = '';
						vueCart.fieldsprod.search = '';
						vueCart.fieldsprod.quantidade = '';
						vueCart.fieldsprod.select = '';
					}
				});
				return false;
			//}else{
			//	vue.messageResult = "Por favor, preencha todos os campos corretamente.";	
			//	vue.overlay.active = true;
			//	return false;
			//}
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
