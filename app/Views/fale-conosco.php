<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Fale Conosco</h3>
				</div>
			</div>
			<div class="row" style="padding-top: 60px; padding-bottom: 60px;">
				<div class="col-12 col-md-7">
					
					<div>
						<h3>Aqui iremos colocar dados para contato</h3>
					</div>
					<div class="pt-3">
						<p>e-mail: contato@jafeston.com.br</p>
					</div>

				</div>
				<div class="col-12 col-md-5">

					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-label" for="insti_nome">Seu nome</label>
								<input type="text" name="insti_nome" id="insti_nome" class="form-control" value="" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-label" for="insti_email">Seu e-mail</label>
								<input type="text" name="insti_email" id="insti_email" class="form-control" value="" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-label" for="insti_telefone">Telefone</label>
								<input type="text" name="insti_telefone" id="insti_telefone" class="form-control mask-phone" value="" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-label" for="insti_telefone">Mensagem</label>
								<textarea name="insti_telefone" id="insti_telefone" class="form-control" rows="8" /></textarea>
							</div>
						</div>
					</div>
					<div class="row pt-3">
						<div class="col-12 col-md-12">
							<div class="d-grid">
								<input type="submit" class="btn btn-primary" value="Enviar">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

<?php
	$this->endSection('content'); 
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.box-featured{}
		.box-featured .item{ text-align: center; }
		.box-featured .item .itemIcon{
			height: 120px;
			width: 120px;
			
			border-radius: 50%;
			cursor: pointer;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			/*border: 1px solid white;*/
			margin-bottom: 10px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.box-featured .item .itemIcon:hover{
			background: #ffffff;
		}
		.box-featured .item .itemIcon img{
			max-width: 60%;
		}

		.card-destaque{
			height: 140px;
			background: #fff7f1;
			/* border: 0px; */
			border-radius: .5rem;
			border: 1px solid #ffc08f;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
		.card-plus{
			height: 460px;
			background: #fff7f1;
			/* border: 0px; */
			border-radius: .5rem;
			border: 1px solid #ffc08f;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
		.card-patrocinador{
			height: 280px;
			background: #d3d3d3;
			/* border: 0px; */
			border-radius: .5rem;
			border: 3px solid #ffffff;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<script>
	</script>

<?php $this->endSection('scripts'); ?>