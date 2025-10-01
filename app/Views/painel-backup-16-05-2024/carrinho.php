<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Pesquisar cliente
			</div>
		</div>
	</div>


	<?php 
	$attr_form = ['class' => '', 'id' => 'formEditRegistro', 'name' => 'formEditRegistro', 'csrf_id' => 'secucity' ];
	echo form_open( current_url(), $attr_form ); ?>
	<?php echo( csrf_field() ) ?>
	<div id="app">
		<div class="card card-default">
			<div class="card-header">

				<div class="row align-items-center">
					<div class="col-6">
						<h4 class="card-title">Procurar cliente</h4>
					</div>
					<div class="col-6">
						{{messageResult}}
					</div>
				</div>

			</div>
			<div class="card-body">

				<div class="box-content">
					<div class="row">
						<div class="col-12">

							<div class="row">
								<div class="col-12 col-md-12">
									<div class="form-group">
										<label class="form-label" for="descricao">Digite o nome do cliente para pesquisar</label>
										<input type="text" name="descricao" id="descricao" class="form-control" value="" v-model="fields.search" v-on:input="AutoComplete" />
									</div>
								</div>
							</div>
							<div>
								<div class="list_cart" v-for="(val, key) in list_clientes" >
									<a href="" :href="'<?php echo painel_url('carrinho/form'); ?>/'+val.id">{{val.nome}}</a>
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

	$cliente_id = ( isset($cliente_id) ? $cliente_id : 0);
?>
<?php $time = time(); ?>


<?php $this->section('headers'); ?>

	<style>
		.list_cart{
			margin: 3px 0;
		}
		.list_cart a{
			border: 1px solid #ebeced;
			padding: 8px;
			display: block;
			border-radius: 0.25rem;
			color: #000;
		}
		.list_cart a:hover{
			background-color: #edeeef;
			color: #000;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<script>
		let LIST_STATUS = [];
		let CLIENTE_ID = '<?php echo( $cliente_id ); ?>';
	</script>

	<!-- VueJs -->
	<script src="assets/vue/vue.min.js"></script>
	<script src="assets/vue/axios.min.js"></script>

	<script src="assets/vue/carrinho.js"></script>

<?php $this->endSection('scripts'); ?>