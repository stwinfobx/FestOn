<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Detalhes do pedido
			</div>
		</div>
	</div>


	<?php 
	$attr_form = ['class' => '', 'id' => 'formEditRegistro', 'name' => 'formEditRegistro', 'csrf_id' => 'secucity' ];
	echo form_open( current_url(), $attr_form ); ?>
	<?php echo( csrf_field() ) ?>
	<div id="app">

		<div class="row align-items-start">
			<div class="col-4">

				<div class="card card-default">
					<div class="card-header">

						<div class="row align-items-center">
							<div class="col-6">
								<h4 class="card-title">Informações do cliente</h4>
							</div>
							<div class="col-6"></div>
						</div>

					</div>
					<div class="card-body">

						<div class="box-content">
							<div class="row">
								<div class="col-12">

									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">Nome</div>
											<div class="txtInfos"><?php echo( (isset($rs_pedido->cli_nome) ? $rs_pedido->cli_nome : '') ); ?></div>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">CNPJ</div>
											<div class="txtInfos"><?php echo( (isset($rs_pedido->cli_cpf_cnpj) ? $rs_pedido->cli_cpf_cnpj : '') ); ?></div>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">E-mail</div>
											<div class="txtInfos"><?php echo( (isset($rs_pedido->cli_email) ? $rs_pedido->cli_email : '') ); ?></div>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-12 col-md-12">
											<div class="form-label">Telefone</div>
											<div class="txtInfos"><?php echo( (isset($rs_pedido->cli_telefone) ? $rs_pedido->cli_telefone : '') ); ?></div>
										</div>
									</div>

								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
			<div class="col-8">

				<div class="card card-default">
					<div class="card-header">

						<div class="row align-items-center">
							<div class="col-6">
								<h4 class="card-title">Informações do pedido #<?php echo( (isset($rs_pedido->id) ? $rs_pedido->id : '') ); ?></h4>
							</div>
							<div class="col-6"></div>
						</div>

					</div>
					<div class="card-body">
						<div class="box-content">
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<div class="form-label">Número do Pedido</div>
									<div class="txtInfos"><?php echo( (isset($rs_pedido->id) ? $rs_pedido->id : '') ); ?></div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-12 col-md-6">
									<div class="form-label">Status</div>
									<div class="txtInfos"><?php echo( (isset($rs_pedido->status) ? $rs_pedido->status : '') ); ?></div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-label">Data de Cobrança</div>
									<div class="txtInfos"><?php echo( (isset($rs_pedido->data_cobranca) ? $rs_pedido->data_cobranca : '') ); ?></div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-12 col-md-12">
									<div class="form-label">Vendedor</div>
									<div class="txtInfos"><?php echo( (isset($rs_pedido->user_nome) ? $rs_pedido->user_nome : '') ); ?></div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-12 col-md-6">
									<div class="form-label">Telefone</div>
									<div class="txtInfos"><?php echo( (isset($rs_pedido->user_telefone) ? $rs_pedido->user_telefone : '') ); ?></div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-label">E-mail</div>
									<div class="txtInfos"><?php echo( (isset($rs_pedido->user_email) ? $rs_pedido->user_email : '') ); ?></div>
								</div>
							</div>

							<div class="row">
								<div class="col-12">

									<?php echo( (isset($rs_pedido->id) ? $rs_pedido->id : '') ); ?>
									<input autoload type="text" name="pedidoid" id="pedidoid" class="form-control" value="<?php echo( (isset($rs_pedido->id) ? $rs_pedido->id : '') ); ?>" v-model="fieldpedido.pedidoid" />

									<div class="row">
										<div class="col-12 col-md-12">
											<div class="form-group">
												<div class="form-label">Observação</div>
												<textarea name="observacao" id="observacao" class="form-control" autoload v-model="fieldpedido.observacao" style="height: 120px;"><?php echo( (isset($rs_pedido->observacao) ? $rs_pedido->observacao : '') ); ?></textarea>
											</div>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-12 col-md-6">
											<div class="d-grid">
												<a href="javascript:;" class="btn btn-sm btn-primary" v-on:click="SalvarObservacao()">Salvar</a>
											</div>
										</div>
									</div>

									<Transition>
									<div class="row justify-content-center pt-3" v-if="messageResult.length">
										<div class="col-12 col-md-6">
											<div class="d-grid">
												<div class="text-center">{{messageResult}}</div>
											</div>
										</div>
									</div>
									</Transition>

								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="card card-default mt-3">
					<div class="card-header">
						<div class="row align-items-center">
							<div class="col-6">
								<h4 class="card-title">Itens do pedido</h4>
							</div>
							<div class="col-6"></div>
						</div>
					</div>
					<div class="card-body">
						<div class="box-content">
							<div class="gridBox">								
								<?php
								if( isset($rs_itens) ){
									$count = 0;
									$total = 0;
									foreach ($rs_itens->getResult() as $row) {
										$count++;
										$id = ($row->id);
										$prod_descricao = ($row->prod_descricao);
										$qtd = ($row->qtd);
										$valor = ($row->valor);
										$subtotal = (($row->valor) * ($qtd)) ;
										$total = $total + $subtotal;
										$css_row = (($count > 1) ? 'border-top: 1px dashed #cecece;' : '');
								?>
								<div class="row justify-content-center align-items-center pt-2 <?php echo( (($count >= 2) ? 'mt-2' : '') ); ?>" style="<?php echo( $css_row ); ?>">
									<div class="col-3 col-md-6">
										<div><?php echo( $prod_descricao ); ?></div>
									</div>
									<div class="col-1 col-md-1 text-center">
										<div><?php echo( $qtd ); ?></div>
									</div>
									<div class="col-1 col-md-2 text-end">
										<div>R$ <?php echo( number_format($valor, 2, ',', '.') ); ?></div>	
									</div>
									<div class="col-1 col-md-2 text-end">
										<div>R$ <?php echo( number_format($subtotal, 2, ',', '.') ); ?></div>
									</div>
									<div class="col-12"><div class="divisor"></div></div>
								</div>
								<?php
									}
								}
								?>
							</div>
						</div>
					</div>
					<?php if( isset($rs_itens) ){ ?>
					<div class="card-body" style="background-color: #f7f8f9; border-top: 1px solid #e3ebf6;">
						<div class="box-content">
							<div class="gridBox">
								<div class="row justify-content-center align-items-center">
									<div class="col-1 col-md-7">
									</div>
									<div class="col-1 col-md-2 text-end">
										<div class="vlrTotal"><strong>TOTAL</strong></div>
									</div>
									<div class="col-1 col-md-2 text-end">
										<div class="vlrTotal"><strong>R$ <?php echo( number_format($total, 2, ',', '.') ); ?></strong></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<div class="card-footer" >
						<div class="row justify-content-center align-items-center">
							<div class="col-6">
								<div class="d-grid">
									<a href="<?php echo(painel_url('pedidos/gerar_pdf/'. (isset($rs_pedido->id) ? $rs_pedido->id : '') )); ?>" target="_blank" class="btn btn-primary">Salvar em PDF</a>
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

	$cliente_id = ( isset($cliente_id) ? $cliente_id : 0);
?>
<?php $time = time(); ?>


<?php $this->section('headers'); ?>

	<style>
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

	<script>
		let LIST_STATUS = <?php echo( $cfgStatus_json ); ?>;
		let CLIENTE_ID = '<?php echo( $cliente_id ); ?>';
	</script>

	<!-- VueJs -->
	<script src="assets/vue/vue.min.js"></script>
	<script src="assets/vue/axios.min.js"></script>

	<script src="assets/vue/pedidos.js"></script>

<?php $this->endSection('scripts'); ?>