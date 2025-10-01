<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				BreadCrumb
			</div>
		</div>
	</div>


	<div class="card card-default">
		<div class="card-header">

			<div class="row align-items-center">
				<div class="col-6">
					<h4 class="card-title">Produtos : Gerenciamento</h4>
				</div>
				<div class="col-6">
					
				</div>
			</div>

		</div>
		<div class="card-body">

			<div class="box-content">
				<div class="row">
					<div class="col-md-3">

						<div class="card card-default">
							<div class="card-header">
								<h4 class="card-title">Configurações</h4>
							</div>
							<div class="card-body">
								teste
							</div>
						</div>

					</div>
					<div class="col-md-9">

						<div class="row">
							<div class="col-12 col-md-8">
								<div class="form-group">
									<label class="form-label" for="user_name">Título</label>
									<input type="text" name="user_name" id="user_name" class="form-control" value="Danilo Guimarães Ferraz">
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="user_perfil">Perfil</label>
									<select class="form-select" id="user_perfil" name="user_perfil">
										<option value="">- selecione -</option>
										<option value="1" selected="">Depilador (a)</option>
										<option value="2">Consumidor final</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="user_name">Descrição</label>
									<input type="text" name="user_name" id="user_name" class="form-control" value="Danilo Guimarães Ferraz">
									<div></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="user_name">Valor</label>
									<input type="text" name="user_name" id="user_name" class="form-control" value="Danilo Guimarães Ferraz">
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="user_name">Valor de custo</label>
									<input type="text" name="user_name" id="user_name" class="form-control" value="Danilo Guimarães Ferraz">
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="user_name">Comissão</label>
									<input type="text" name="user_name" id="user_name" class="form-control" value="Danilo Guimarães Ferraz">
									<div></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="user_name">Observação</label>
									<textarea name="user_name" id="user_name" class="form-control" style="height:120px"></textarea>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>

<?php
	$this->endSection('content'); 
?>


<?php $this->section('headers'); ?>

	<style>
		.teste{}
	</style>

<?php $this->endSection('headers'); ?>


<?php $time = time(); ?>
<?php $this->section('scripts'); ?>

	<script>
		let LIST_CATEGORIA = [];
	</script>

<?php $this->endSection('scripts'); ?>