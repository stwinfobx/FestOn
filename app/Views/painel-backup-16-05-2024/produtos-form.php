<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Gerenciar produto
			</div>
		</div>
	</div>


	<?php echo( session()->getFlashdata('error') ); ?>


	<!-- <FORM action="<?php //echo(current_url()); ?>" method="POST" name="formEditRegistro" id="formEditRegistro" enctype="multipart/form-data"> -->
	<?php 
	$attr_form = ['class' => '', 'id' => 'formEditRegistro', 'name' => 'formEditRegistro', 'csrf_id' => 'secucity' ];
	echo form_open( current_url(), $attr_form ); ?>
	<?php echo( csrf_field() ) ?>
	<div class="card card-default">
		<div class="card-header">

			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					<h4 class="card-title">Produtos : Gerenciamento</h4>
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

						<div class="row">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="descricao">Título</label>
									<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo( (isset($rs_edit->descricao) ? $rs_edit->descricao : "") ); ?>" />
									<div></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="detalhes">Detalhes</label>
									<textarea name="detalhes" id="detalhes" class="form-control" style="height:60px !important;"><?php echo( (isset($rs_edit->detalhes) ? $rs_edit->detalhes : "") ); ?></textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="valor">Valor</label>
									<input type="text" name="valor" id="valor" class="form-control" value="<?php echo( (isset($rs_edit->valor) ? $rs_edit->valor : "") ); ?>" />
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="valor_custo">Valor de custo</label>
									<input type="text" name="valor_custo" id="valor_custo" class="form-control" value="<?php echo( (isset($rs_edit->valor_custo) ? $rs_edit->valor_custo : "") ); ?>" />
									<div></div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<label class="form-label" for="comissao">Comissão</label>
									<input type="text" name="comissao" id="comissao" class="form-control" value="<?php echo( (isset($rs_edit->comissao) ? $rs_edit->comissao : "") ); ?>" />
									<div></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label class="form-label" for="observacao">Observação</label>
									<textarea name="observacao" id="observacao" class="form-control" style="height:120px !important;"><?php echo( (isset($rs_edit->observacao) ? $rs_edit->observacao : "") ); ?></textarea>
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
?>


<?php $this->section('headers'); ?>

	<style>
		.teste{}
	</style>

<?php $this->endSection('headers'); ?>


<?php $time = time(); ?>
<?php $this->section('scripts'); ?>

	<script>
	</script>

<?php $this->endSection('scripts'); ?>