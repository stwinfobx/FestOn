<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Usuários : Responsáveis pelos Grupos</h2>
			</div>
		</div>
	</div>


	<?php echo( session()->getFlashdata('error') ); ?>


	<?php 
	$attr_form = ['class' => '', 'id' => 'formEditRegistro', 'name' => 'formEditRegistro', 'csrf_id' => 'secucity' ];
	echo form_open( current_url(), $attr_form ); ?>
	<?php echo( csrf_field() ) ?>
	<div class="card card-default">
		<div class="card-header d-none">

			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					<!-- <!-- <h4 class="card-title">Usuários : Responsáveis pelos Grupos : Gerenciamento</h4> --> -->
				</div>
				<div class="col-12 col-md-6">

					<div class="d-flex justify-content-end">
						<div style="margin-left: 5px;"><a href="<?php echo(painel_url('responsaveis')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
						<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
					</div>

				</div>
			</div>

		</div>
		<div class="card-header-box">
			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					
				</div>
				<div class="col-12 col-md-6">

					<div class="d-flex justify-content-end">
						<div style="margin-left: 5px;"><a href="<?php echo(painel_url('responsaveis')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
						<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
					</div>

				</div>
			</div>
		</div>
		<div class="card-body">

			<div class="box-content">
				<div class="row">
					<div class="col-md-3">

						<div class="card card-default mb-4 d-none">
							<div class="card-header">
								<h4 class="card-title">Configurações</h4>
							</div>
							<div class="card-body"></div>
						</div>

						<div class="row">
							<div class="col-12">
								<?php 
									$user_ativo = (int)((isset($rs_edit->user_ativo) ? $rs_edit->user_ativo : "1")); 
									$ativo_s = ($user_ativo == "1" ? ' checked ' : '');
									$ativo_n = ($user_ativo != "1" ? ' checked ' : '');
								?>
								<div class="form-group">
									<div><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
									<div>
										<div class="form-check-inline my-1">
											<div class="custom-control custom-radio">
												<input type="radio" name="user_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
												<label class="custom-control-label" for="ativo_s">Sim</label>
											</div>
										</div>
										<div class="form-check-inline my-1">
											<div class="custom-control custom-radio">
												<input type="radio" name="user_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
												<label class="custom-control-label" for="ativo_n">Não</label>
											</div>
										</div>
									</div>
									<div><?php echo show_error($validation, 'user_ativo'); ?></div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-md-9">

						<div class="row g-2">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label class="form-label" for="user_nome">Nome:</label>
									<input type="text" name="user_nome" id="user_nome" class="form-control" value="<?php echo( (isset($rs_dados->user_nome) ? $rs_dados->user_nome : "") ); ?>" />
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label class="form-label" for="user_sobrenome">SobreNome:</label>
									<input type="text" name="user_sobrenome" id="user_sobrenome" class="form-control" value="<?php echo( (isset($rs_dados->user_sobrenome) ? $rs_dados->user_sobrenome : "") ); ?>" />
									<div></div>
								</div>
							</div>
						</div>

						<div class="row g-2">
							<div class="col-12 col-md-8">
								<div class="form-group">
									<label class="form-label" for="user_email">Email:</label>
									<input type="text" name="user_email" id="user_email" class="form-control" value="<?php echo( (isset($rs_dados->user_email) ? $rs_dados->user_email : "") ); ?>" />
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="user_senha">Senha:</label>
									<input type="password" name="user_senha" id="user_senha" class="form-control" value="" />
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