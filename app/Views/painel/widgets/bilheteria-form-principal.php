
									

<div class="row ">
	<div class="col-12 col-md-3">

		<div class="row">
			<div class="col-12">
				<?php 
					$user_ativo = (int)((isset($rs_edit->user_ativo) ? $rs_edit->user_ativo : "1")); 
					$ativo_s = ($user_ativo == "1" ? ' checked ' : '');
					$ativo_n = ($user_ativo != "1" ? ' checked ' : '');
				?>
				<div class="form-group">
					<div ><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
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

		<div class="row">
			<div class="col-12">
				<?php 
					$user_ativo = (int)((isset($rs_edit->user_ativo) ? $rs_edit->user_ativo : "1")); 
					$bolheteria_cupom_s = ($user_ativo == "1" ? ' checked ' : '');
					$bolheteria_cupom_n = ($user_ativo != "1" ? ' checked ' : '');
				?>
				<div class="form-group">
					<div ><label class="form-label" for="EMAIL">Permite cupom de desconto?</label></div>
					<div>
						<div class="form-check-inline my-1">
							<div class="custom-control custom-radio">
								<input type="radio" name="bolheteria_cupom" id="bolheteria_cupom_s" class="custom-control-input" value="1" <?php echo($bolheteria_cupom_s)?> />
								<label class="custom-control-label" for="ativo_s">Sim</label>
							</div>
						</div>
						<div class="form-check-inline my-1">
							<div class="custom-control custom-radio">
								<input type="radio" name="bolheteria_cupom" id="bolheteria_cupom_n" class="custom-control-input" value="0" <?php echo($bolheteria_cupom_n)?> />
								<label class="custom-control-label" for="ativo_n">Não</label>
							</div>
						</div>
					</div>
					<div><?php echo show_error($validation, 'user_ativo'); ?></div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-12 col-md-9">

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="curso_titulo">Título do Evento</label>
					<input type="text" name="curso_titulo" id="curso_titulo" class="form-control" value="<?php echo((isset($rs_dados->curso_titulo) ? $rs_dados->curso_titulo : ""));?>" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="curso_vagas">Capacidade Máxima</label>
					<input type="text" name="curso_vagas" id="curso_vagas" class="form-control only-number" value="<?php echo((isset($rs_dados->curso_vagas) ? $rs_dados->curso_vagas : ""));?>" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="curso_conteudo">Descrição</label>
					<textarea type="text" name="curso_conteudo" id="curso_conteudo" class="form-control" style="height: 250px !important;"><?php echo((isset($rs_dados->curso_conteudo) ? $rs_dados->curso_conteudo : ""));?></textarea>
				</div>
			</div>
		</div>

	</div>
</div>


<?php $this->section('scripts'); ?>

	<style>
		.card.card-principal{
			background-color: #fbfbfb;
			border-color: #f99141;
			border-width: 2px;
		}
		.card.card-principal .card-header {
			padding-top: 0.75rem;
			padding-bottom: 0.75rem;
			background-color: #f99141;
		}
		.card.card-principal .card-header h2{
			color: #FFF !important;
		}
		.card.card-principal .card-body{
			padding: 1.25rem 1rem 1.5rem 1rem !important;
		}
	</style>

<?php $this->endSection('scripts'); ?>
