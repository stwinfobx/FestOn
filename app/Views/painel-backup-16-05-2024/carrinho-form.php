<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Gerenciar pedido
			</div>
		</div>
	</div>


	<?php 
	$attr_form = ['class' => '', 'id' => 'formEditRegistro', 'name' => 'formEditRegistro', 'csrf_id' => 'secucity' ];
	echo form_open( current_url(), $attr_form ); ?>
	<?php echo( csrf_field() ) ?>
	<div id="app">

		<div class="row align-items-start">
			<div class="col-12 col-md-4">

				<div class="card card-default mb-4">
					<div class="card-header">

						<div class="row align-items-center">
							<div class="col-12">
								<h4 class="card-title" style="position: relative;" data-bs-toggle="collapse" href="#boxCollapseInfoCliente" role="button" aria-expanded="true" aria-controls="boxCollapseInfoCliente">Informações do Cliente 
									<div class="expand_caret caret"></div>
								</h4>
							</div>
						</div>

					</div>
					<div class="card-body collapse show" id="boxCollapseInfoCliente">

						<div class="box-content">
							<div class="row">
								<div class="col-12">

									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">Nome</div>
											<div class="txtInfos"><?php echo( (isset($rs_cliente->nome) ? $rs_cliente->nome : "") ); ?></div>
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">CNPJ</div>
											<?php echo( (isset($rs_cliente->cpf_cnpj) ? $rs_cliente->cpf_cnpj : "") ); ?>
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">E-mail</div>
											<?php echo( (isset($rs_cliente->email) ? $rs_cliente->email : "") ); ?>
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">Telefone</div>
											<?php echo( (isset($rs_cliente->telefones) ? $rs_cliente->telefones : "") ); ?>
										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
			<div class="col-12 col-md-8">

				<div class="card card-default mb-4">
					<div class="card-header">

						<div class="row align-items-center">
							<div class="col-12">
								<h4 class="card-title">Procurar produto</h4>
							</div>
						</div>

					</div>
					<div class="card-body">

						<div class="box-content">
							<div class="row">
								<div class="col-12">

									<div class="row gx-2 justify-content-end">
										<div class="col-8 col-md-8">
											<div class="form-group">
												<!-- <input type="text" name="descricao" id="descricao" class="form-control" value="" v-model="fieldsprod.search" v-on:keyup="AutoCompleteProduto" /> -->
												<select class="form-select" name="descricao" id="descricao" v-model="fieldsprod.produto">
													<option value="">- Selecione -</option>
													<option translate="no" v-for="(val, key) in lista_produtos" :value="{id: val.id, descricao: val.descricao, valor: val.valor}">{{val.descricao}}</option>
												</select>
											</div>
										</div>
										<div class="col-4 col-md-2">
											<div class="form-group">
												<input type="number" name="quantidade" id="quantidade" class="form-control only-number" min="0" value="" placeholder="00" v-model="fieldsprod.quantidade" />
											</div>
										</div>
										<div class="col-4 col-md-2">
											<div class="d-grid">
												<a href="javascript:;" class="btn btn-primary"v-on:click="AddProduto()">Adicionar</a>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 col-md-12">
											<transition name="fade">
												<p v-if="messageErrorResult.length">{{ messageErrorResult }}</p>
											</transition>
										</div>
									</div>
									<div class="d-none">
										{{ fieldsprod.select }}
									</div>

									<div class="" style="position:relative;" v-if="list_produtos.length">
										<div class="boxListProd">
											<div class="row">
												<div class="col-12 col-md-12" style="position:relative;">
													<div class="list_cart" v-for="(val, key) in list_produtos" >
														<a href="javascript:;" v-on:click="SelectProduto( {id: val.id, descricao: val.descricao, valor: val.valor} )">{{val.descricao}}</a>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="card card-default mt-3">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h4 class="card-title">Carrinho de compras</h4>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="box-content">
							<div class="gridBox" v-if="fieldsprod.list_cart_produtos.length > 0">
								<div v-for="item in fieldsprod.list_cart_produtos">
									<div class="row justify-content-end align-items-center mt-1 mb-1">
										<div class="col-12 col-md-6">
											<div>{{item.descricao}}</div>
										</div>
										<div class="col-2 col-md-1 text-center">
											<div>{{item.quantidade}}</div>
										</div>
										<div class="col-2 col-md-2 text-end">
											<div>{{ item.valor | toCurrency}} </div>	
										</div>
										<div class="col-2 col-md-2 text-end">
											<div>{{item.subtotal | toCurrency }}</div>
										</div>
										<div class="col-3 col-md-1 text-center">
											<div class="d-grid">
												<a href="javascript:;" class="btn btn-sm btn-ac btn-ac-delete" v-on:click="ExcluirProduto(item)"><i class="las la-trash font-16"></i></a>
											</div>
										</div>
										<div class="col-12"><div class="divisor"></div></div>
									</div>
								</div>
								<div class="mt-3 pt-2" v-if="fieldsprod.list_cart_produtos.length > 0" style="border-top: 1px solid #e3ebf6;">
									<div class="row justify-content-end align-items-center">
										<div class="col-4 col-md-2 text-end">
											<div class="vlrTotal"><strong>TOTAL</strong></div>
										</div>
										<div class="col-4 col-md-2 text-end">
											<div class="vlrTotal"><strong>{{fieldsprod.valor_total | toCurrency }}</strong></div>
										</div>
										<div class="col-1 col-md-1 text-end">
										</div>
									</div>
								</div>
							</div>
							<div v-if="fieldsprod.list_cart_produtos.length == 0">
								<p>nenhum produto adicionado</p>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="box-content">
							<div class="row">
								<div class="col-12 col-md-12">
									<div class="form-group">
										<div class="form-label">Observação</div>
										<textarea name="observacao" id="observacao" class="form-control" autoload v-model="fieldsprod.observacao" style="height: 120px;"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer" >
						<div class="row align-items-center">
							<div class="col-12 col-md-9">
								<div class="row align-items-center">
									<div class="col-6 col-md-4">
										<div class="form-group "> 
											<label class="form-control-placeholder" for="status_id">Status</label>
											<select translate="no" name="status_id" id="status_id" class="form-select txtStatus" v-model="fieldsprod.status_id" :disabled='fieldsprod.list_cart_produtos.length == 0 ? true :false'>
												<option translate="no" value="">-</option>
												<option translate="no" v-for="(row, value) in lista_status" :value="row.id">{{row.status}}</option>
											</select>
										</div>
									</div>
									<div class="col-6 col-md-4">
										<div class="form-group">
											<label>Data da cobrança:</label>
											<input type="date" name="data_cobranca" id="data_cobranca" class="form-control" value="" v-model="fieldsprod.data_cobranca" :disabled='fieldsprod.list_cart_produtos.length == 0 ? true :false' />
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-3">
								<div class="d-grid">
									<button type="button" class="btn btn-primary" v-on:click="SendFormPedido" :disabled='disabledButton'>Finalizar Compra</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
	<?php echo form_close(); ?>
	<!-- </FORM> -->


<?php
	$this->endSection('content');

	$cfgStatus_json = [];
	$cfgStatus_json = ( isset($rs_status) ? $cfgStatus_json = json_encode($rs_status) : $cfgStatus_json);

	$produtos_json = [];
	$produtos_json = ( isset($rs_produtos) ? $produtos_json = json_encode($rs_produtos) : $produtos_json);

	$cliente_id = ( isset($cliente_id) ? $cliente_id : 0);
?>
<?php $time = time(); ?>


<?php $this->section('headers'); ?>

	<style>
		.expand_caret {
			position: absolute;
			top: 0;
			right: 0;
			transform: scale(1.25);
			margin-left: 8px;
			margin-top: 0px;
			display: flex;
			height: 100%;
			align-items: center;
		}
		.expand_caret::after {
			display: inline-block;
			margin-left: 0.255em;
			vertical-align: 0.255em;
			content: "";
			border-top: 0.3em solid;
			border-right: 0.3em solid transparent;
			border-bottom: 0;
			border-left: 0.3em solid transparent;
		}
		.collapsed .expand_caret::after {
			transform: rotate(180deg) !important;
		}
		.fade-enter-active, .fade-leave-active {
			transition: opacity 1.5s;
		}
		.fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
			opacity: 0;
		}
		.list_cart{
			margin: 0px 0;
		}
		.list_cart a{
			display: block;
			border-bottom: 1px solid #ebeced;
			padding: 8px 0;
			color: #000;
		}
		.list_cart a:hover{
			background-color: #edeeef;
			color: #000;
		}
		.boxListProd{
			position: absolute;
			padding: 5px 10px;
			top: -8px;
			left: 0;
			z-index: 99;
			background-color: white;
			width: 100%;
			border: 1px solid gray;
			max-height: 300px;
			overflow-x: hidden;
			border: 1px solid #e3ebf6;
			border-radius: 0.25rem;
			box-shadow: 0 4px 10px 1px rgb(150 150 150 / 25%), 0 1px 4px rgb(168 168 168 / 28%) !important;	
		}
		.card.card-default .card-footer{
			background-color: rgb(224 224 224);
		}
		.txtInfos{
			font-size: 0.9rem;
			font-weight: bold;
		}
		.vlrTotal{
			font-size: 1.0rem;
			font-weight: bold;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<?php 
		//print '<pre>produtos';
		//print_r( $rs_produtos ); 
		//print '</pre>';
	?>

	<script>
		let LIST_PRODUTOS = <?php echo( $produtos_json ); ?>;
		let LIST_STATUS = <?php echo( $cfgStatus_json ); ?>;
		let CLIENTE_ID = '<?php echo( $cliente_id ); ?>';
	</script>

	<!-- VueJs -->
	<script src="assets/vue/vue.min.js"></script>
	<script src="assets/vue/axios.min.js"></script>

	<script src="assets/vue/carrinho.js"></script>

<?php $this->endSection('scripts'); ?>