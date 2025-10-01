<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Gerenciar cliente
			</div>
		</div>
	</div>


	<?php echo( session()->getFlashdata('error') ); ?>


	<div class="card card-default">
		<div class="card-header">

			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					<h4 class="card-title">Clientes : Informações</h4>
				</div>
				<div class="col-12 col-md-6">
					<div class="d-flex justify-content-end">
						<div style="margin-left: 5px;"><a href="<?php echo($link_list); ?>" class="btn btn-sm btn-warning">Voltar</a></div>

					</div>
				</div>
			</div>

		</div>
		<div class="card-body">

			<div class="box-content">
				<div class="row">
					<div class="col-md-3 d-none d-md-block">

						<div class="card card-default mb-4">
							<div class="card-header">
								<h4 class="card-title">Configurações</h4>
							</div>
							<div class="card-body">
								<!-- teste -->
							</div>
						</div>

					</div>
					<div class="col-md-9">

						<div class="row g-2">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="nome">Nome:</label>
									<input type="text" name="nome" id="nome" class="form-control" value="<?php echo( (isset($rs_edit->nome) ? $rs_edit->nome : "") ); ?>" readonly />
								</div>
							</div>
						</div>

						<div class="row g-2">
							<div class="col-12 col-md-8">
								<div class="form-group">
									<label class="form-label" for="email">Email:</label>
									<input type="text" name="email" id="email" class="form-control" value="<?php echo( (isset($rs_edit->email) ? $rs_edit->email : "") ); ?>" readonly />
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="telefones">Telefone:</label>
									<input type="text" name="telefones" id="telefones" class="form-control" value="<?php echo( (isset($rs_edit->telefones) ? $rs_edit->telefones : "") ); ?>" readonly />
								</div>
							</div>
						</div>

						<div class="row g-2">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="cpf_cnpj">CPF/CNPJ:</label>
									<input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control" value="<?php echo( (isset($rs_edit->cpf_cnpj) ? $rs_edit->cpf_cnpj : "") ); ?>" readonly />
								</div>
							</div>
						</div>

						<div class="row g-2">
							<div class="col-12 col-md-2">
								<div class="form-group">
									<label class="form-label" for="cep">CEP:</label>
									<input type="text" name="cep" id="cep" class="form-control" value="<?php echo( (isset($rs_edit->cep) ? $rs_edit->cep : "") ); ?>" readonly />
								</div>
							</div>
							<div class="col-12 col-md-7">
								<div class="form-group">
									<label class="form-label" for="endereco">Endereço:</label>
									<input type="text" name="endereco" id="endereco" class="form-control" value="<?php echo( (isset($rs_edit->endereco) ? $rs_edit->endereco : "") ); ?>" readonly />
								</div>
							</div>
							<div class="col-12 col-md-3">
								<div class="form-group">
									<label class="form-label" for="numero">Número:</label>
									<input type="text" name="numero" id="numero" class="form-control" value="<?php echo( (isset($rs_edit->numero) ? $rs_edit->numero : "") ); ?>" readonly />
								</div>
							</div>
						</div>

						<div class="row g-2">
							<div class="col-12 col-md-5">
								<div class="form-group">
									<label class="form-label" for="bairro">Bairro:</label>
									<input type="text" name="bairro" id="bairro" class="form-control" value="<?php echo( (isset($rs_edit->bairro) ? $rs_edit->bairro : "") ); ?>" readonly />
								</div>
							</div>
							<div class="col-9 col-md-5">
								<div class="form-group">
									<label class="form-label" for="cidade">Cidade:</label>
									<input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo( (isset($rs_edit->cidade) ? $rs_edit->cidade : "") ); ?>" readonly />
								</div>
							</div>
							<div class="col-3 col-md-2">
								<div class="form-group">
									<label class="form-label" for="estado">Estado</label>
									<input type="text" name="estado" id="estado" class="form-control" value="<?php echo( (isset($rs_edit->estado) ? $rs_edit->estado : "") ); ?>" readonly />
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