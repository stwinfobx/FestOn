<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Gerenciar vendedor
			</div>
		</div>
	</div>


	<?php echo( session()->getFlashdata('error') ); ?>


	<?php 
	$attr_form = ['class' => '', 'id' => 'formEditRegistro', 'name' => 'formEditRegistro', 'csrf_id' => 'secucity' ];
	echo form_open( current_url(), $attr_form ); ?>
	<?php echo( csrf_field() ) ?>
	<div class="card card-default">
		<div class="card-header">

			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					<h4 class="card-title">Vendedores : Gerenciamento</h4>
				</div>
				<div class="col-12 col-md-6">

					<div class="d-flex justify-content-end">
						<div style="margin-left: 5px;"><a href="<?php echo($link_list); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
						<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
					</div>

				</div>
			</div>

		</div>
		<div class="card-body">

			<div class="box-content">
				<div class="row">
					<div class="col-md-3">

						<div class="card card-default mb-4">
							<div class="card-header">
								<h4 class="card-title">Configurações</h4>
							</div>
							<div class="card-body">

								<div class="row g-2">
									<div class="col-12">
										<?php
											$arr_permissao = [
												'1' => 'Administrador',
												'2' => 'Vendedor',
											];
											$permissao = (int)(isset($rs_edit->permissao) ? $rs_edit->permissao : "");
										?>
										<div class="form-group">
											<label class="form-label" for="permissao">Acesso:</label>
											<select class="form-select" name="permissao" id="permissao">
												<option value="0">- Selecione -</option>
												<?php
													foreach ($arr_permissao as $key => $val) {
														$selected = ($key == $permissao ? 'selected' : '');
														echo '<option value="'. $key .'" '. $selected .'>'. $val .'</option>';
													}
												?>
											</select>
										</div>
									</div>
								</div>

							</div>
						</div>

					</div>
					<div class="col-md-9">

						<div class="row g-2">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="nome">Nome:</label>
									<input type="text" name="nome" id="nome" class="form-control" value="<?php echo( (isset($rs_edit->nome) ? $rs_edit->nome : "") ); ?>" />
									<div></div>
								</div>
							</div>
						</div>

						<div class="row g-2">
							<div class="col-12 col-md-8">
								<div class="form-group">
									<label class="form-label" for="email">Email:</label>
									<input type="text" name="email" id="email" class="form-control" value="<?php echo( (isset($rs_edit->email) ? $rs_edit->email : "") ); ?>" />
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="celular">Celular:</label>
									<input type="text" name="celular" id="celular" class="form-control" value="<?php echo( (isset($rs_edit->celular) ? $rs_edit->celular : "") ); ?>" />
									<div></div>
								</div>
							</div>
						</div>

						<div class="row g-2">
							<div class="col-12 col-md-8">
								<div class="form-group">
									<label class="form-label" for="senha">Senha:</label>
									<input type="text" name="senha" id="senha" class="form-control" value="" />
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
	<?php echo form_close(); ?>


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