
<?php
	$curso_vagas = (int)(isset($rs_dados->curso_vagas) ? $rs_dados->curso_vagas : ""); 
	//echo((isset($rs_dados->curso_nome_professor) ? $rs_dados->curso_nome_professor : ""));
?>

<div class="row ">
	<div class="col-12 col-md-3">

		<div class="card card-principal mb-4">
			<div class="card-header">
				<h2 class="m-0">Resumo</h2>
			</div>
			<div class="card-body">

				<div class="mb-3">
					Total Vagas
					<h3><?php echo($curso_vagas)?></h3>
				</div>

				<div class="mb-3">
					Total de Inscrições
					<h3>030</h3>
				</div>

				<div class="d-flex flex-column w-100 me-2">
					<div class="d-flex flex-stack">
						<span class="text-muted me-2 fs-7">30%</span>
					</div>
					<div class="progress h-6px w-100">
						<div class="progress-bar bg-danger" role="progressbar" style="width: 30%; background-color: #f99141 !important;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-12">
				<div class="" style="width: 85%;">
					<div class="text-center"><label class="form-label text-center">Foto do Professor</label></div>
					<input type="file" name="curso_foto_professor" id="curso_foto_professor" class="form-control files">
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-12">
				<div class="" style="width: 85%;">
					<div class="text-center"><label class="form-label text-center">Template do Certificado</label></div>
					<input type="file" name="curso_template_certificado" id="curso_template_certificado" class="form-control files">
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-12">
				<div class="" style="width: 85%;">
					<div class="text-center"><label class="form-label text-center">Assinatura para o Certificado</label></div>
					<input type="file" name="curso_foto_assinatura" id="curso_foto_assinatura" class="form-control files">
				</div>
			</div>
		</div>

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

	</div>
	<div class="col-12 col-md-9">
	
		<div class="row">
			<div class="col-12 col-md-12">
				<?php 
					$_event_id = (int)(isset($rs_dados->event_id) ? $rs_dados->event_id : "");
				?>
				<div class="form-group">
					<label class="form-label" for="event_id">Evento Relacionado</label>
					<select class="form-select" name="event_id" id="event_id">
						<option value="" translate="no">- selecione -</option>
						<?php
						if( isset($rs_eventos)){
							foreach ($rs_eventos->getResult() as $row) {
								$event_id = ($row->event_id);
								$event_titulo = ($row->event_titulo);
								$selected = (($event_id == $_event_id) ? "selected" : "");
							?>
								<option value="<?php echo($event_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($event_titulo); ?></option>
						<?php
							}
						}
						?>
					</select>
				</div>				
			</div>
		</div>	

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="curso_titulo">Título do Curso</label>
					<input type="text" name="curso_titulo" id="curso_titulo" class="form-control" value="<?php echo((isset($rs_dados->curso_titulo) ? $rs_dados->curso_titulo : ""));?>" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="curso_nome_professor">Nome do Professor</label>
					<input type="text" name="curso_nome_professor" id="curso_nome_professor" class="form-control" value="<?php echo((isset($rs_dados->curso_nome_professor) ? $rs_dados->curso_nome_professor : ""));?>" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="curso_local">Local</label>
					<textarea type="text" name="curso_local" id="curso_local" class="form-control" style="height: 80px !important;"><?php echo((isset($rs_dados->curso_local) ? $rs_dados->curso_local : ""));?></textarea>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<label class="form-label" for="curso_vagas">Vagas</label>
							<input type="text" name="curso_vagas" id="curso_vagas" class="form-control only-number" maxlength="4" value="<?php echo((isset($rs_dados->curso_vagas) ? $rs_dados->curso_vagas : ""));?>" />
						</div>
					</div>
					<div class="col-12 col-md-4">
						<?php 
							$curso_valor = (isset($rs_dados->curso_valor) ? $rs_dados->curso_valor : "0"); 
							$curso_valor = fct_to_money($curso_valor);
						?>
						<div class="form-group">
							<label class="form-label" for="curso_valor">Valor</label>
							<input type="text" name="curso_valor" id="curso_valor" class="form-control mask-money" value="<?php echo($curso_valor);?>" />
						</div>
					</div>
					<div class="col-12 col-md-4">
						<?php 
							$curso_dte_limite_insc = (isset($rs_dados->curso_dte_limite_insc) ? $rs_dados->curso_dte_limite_insc : ""); 
							$curso_dte_limite_insc = fct_formatdate($curso_dte_limite_insc, 'd/m/Y');
						?>
						<div class="form-group">
							<label class="form-label" for="curso_dte_limite_insc">Data Limite para Inscrição</label>
							<div class="position-relative d-flex align-items-center">
								<input type="text" name="curso_dte_limite_insc" id="curso_dte_limite_insc" class="form-control form-control-sm flatpickr_date" value="<?php echo($curso_dte_limite_insc); ?>" style="padding-right: 3rem !important;" readonly="readonly">
								<span class="position-absolute mx-4" style="right: 0;">
									<img src="assets/svg/icon-calendar.svg">
								</span>
							</div>
						</div>						
					</div>					
				</div>
			</div>		
		</div>

		<div class="row mt-2">
			<div class="col-12 col-md-12">
				<?php
					$w_data = [];
					//$w_data['etapa'] = 'participantes';
					//$w_data['arr_forma_cobr_selected'] = $arr_forma_cobr_selected;
					$include = view('painel/widgets/workshop-card-grid-valores', $w_data);
					echo( $include );
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="curso_conteudo">Conteúdo</label>
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
	
	
	<script>
	$(document).ready(function(){
		$("#curso_dte_limite_insc").find('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",	
		});
	});
	</script>	
	

<?php $this->endSection('scripts'); ?>
