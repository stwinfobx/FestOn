
<?php 
$evcfg_forma_cobranca_tipo = (isset($evcfg_forma_cobranca_tipo) ? $evcfg_forma_cobranca_tipo : '');
$checked_box = (($evcfg_forma_cobranca_tipo == 'doacao') ? " active " : "" );
?>

<div id="tipoCobraDoacao" class="tipoCobraDoacao <?php echo( $checked_box ); ?>">
	<div class="card card-base TxtQtdDoacoes mb-3">
		<div class="card-header" style="background-color: #ffe093;">
			Grid quantidade de doações
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-md-auto" style="width: 70px !important;">
					<div class="form-group m-0 text-center">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Ativo</label>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group m-0">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Tipo</label>
					</div>
				</div>
				<div class="col-12 col-md-2">
					<div class="form-group m-0">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Quant</label>
					</div>
				</div>
				<div class="col-12 col-md">
					<div class="form-group m-0">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Descrição</label>
					</div>
				</div>
			</div>
			<div id="BOX-CONTENT-GRID-QTD-DOACOES">
				<?php
					//print '<pre>';
					//print_r( $listTipoCobrancaDoacoes );
					//print '<pre>';

					//print '<pre>';
					//print_r( $rs_event_quant_doacoes );
					//print '<pre>';

					if( isset($listTipoCobrancaDoacoes) ){ 
						$xCount = 0;
						foreach ($listTipoCobrancaDoacoes as $keyDoac => $valDoac ) {
							$xCount++;
							$arr_dados_edit = (isset($rs_event_quant_doacoes[$keyDoac]) ? $rs_event_quant_doacoes[$keyDoac] : []);
							$evvlr_quant = (isset($arr_dados_edit->evvlr_quant) ? $arr_dados_edit->evvlr_quant : '');
							$evvlr_txt_descr = (isset($arr_dados_edit->evvlr_txt_descr) ? $arr_dados_edit->evvlr_txt_descr : '');
							$evvlr_ativo = (int)(isset($arr_dados_edit->evvlr_ativo) ? $arr_dados_edit->evvlr_ativo : '');
							$checked = (($evvlr_ativo == 1) ? ' checked ' : '');
					?>
					<div class="row align-items-center">
						<div class="col-12 col-md-auto text-center" style="width: 70px !important;">
							<div class="form-group">
								<div class="form-check" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="checkbox" name="doacoesP_evvlr_ativo[<?php echo($keyDoac); ?>]" id="doacoesP_evvlr_ativo_<?php echo($xCount)?>" class="custom-control-input" value="1" <?php echo($checked)?> />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<input type="hidden" name="doacoesP_evvlr_label[]" id="doacoesP_evvlr_label_<?php echo($xCount); ?>" class="form-control form-control-sm" value="<?php echo($keyDoac); ?>" readonly  />
								<input type="text" name="doacoesP_evvlr_label_desc[]" id="doacoesP_evvlr_label_desc_<?php echo($xCount); ?>" class="form-control form-control-sm form-control-fake" value="<?php echo($valDoac); ?>" readonly />
							</div>
						</div>
						<div class="col-12 col-md-2">
							<div class="form-group">
								<input type="text" name="doacoesP_evvlr_quant[]" id="doacoesP_evvlr_quant_<?php echo($xCount); ?>" class="form-control form-control-sm only-number text-center" value="<?php echo($evvlr_quant); ?>" maxlength="3" />
							</div>
						</div>
						<div class="col-12 col-md">
							<div class="form-group">
								<input type="text" name="doacoesP_evvlr_txt_descr[]" id="doacoesP_evvlr_txt_descr_<?php echo($xCount); ?>" class="form-control form-control-sm" value="<?php echo($evvlr_txt_descr); ?>" />
							</div>
						</div>
					</div>
					<?php
						}
					}
				?>
			</div>
		</div>
		<div class="card-body">
			<div>
				<div class="form-group d-flex align-items-center" style="gap:20px;">
					<div><label class="form-label">Forma de Entrega das Doações</label></div>
				</div>
			</div>
			<div>
				<div class="form-group d-flex flex-column align-items-start" style="gap:10px;">
					<?php
					$evcfg_doacao_entrega_forma = (isset($rs_dados_config->evcfg_doacao_entrega_forma) ? $rs_dados_config->evcfg_doacao_entrega_forma : "");
					$boxContentDoacaoDatas = (($evcfg_doacao_entrega_forma == "datas") ? 'active' : '');
					if( isset($listDoacaoTipoEntrega) ){ 
						foreach ($listDoacaoTipoEntrega as $keyTipo => $valTipo ) {
							$value = $keyTipo;
							$label = $valTipo;
							$checked = (($evcfg_doacao_entrega_forma == $value) ? ' checked ' : '');	
					?>
					<div class="">
						<div class="form-check" style="padding-left: 0 !important;">
							<div class="custom-control custom-radio">
								<input type="radio" name="evcfg_doacao_entrega_forma" id="evcfg_doacao_entrega_forma_<?php echo($value); ?>" class="custom-control-input rdoFormaEntrega" value="<?php echo($value); ?>" <?php echo($checked); ?>  />
								<label class="custom-control-label" for="evcfg_doacao_entrega_forma_<?php echo($value); ?>"><?php echo($label); ?></label>
							</div>
						</div>
					</div>
					<?php
						}
					}
					?>
					<div id="boxContentDoacaoDatas" class="pt-2 boxContentDoacaoDatas <?php echo($boxContentDoacaoDatas); ?>">
						<?php
							$evcfg_doacao_entrega_dte_ini = (isset($rs_dados_config->evcfg_doacao_entrega_dte_ini) ? $rs_dados_config->evcfg_doacao_entrega_dte_ini : "");
							$evcfg_doacao_entrega_dte_ini = fct_formatdate($evcfg_doacao_entrega_dte_ini, 'd/m/Y');

							$evcfg_doacao_entrega_dte_fim = (isset($rs_dados_config->evcfg_doacao_entrega_dte_fim) ? $rs_dados_config->evcfg_doacao_entrega_dte_fim : "");
							$evcfg_doacao_entrega_dte_fim = fct_formatdate($evcfg_doacao_entrega_dte_fim, 'd/m/Y');
						?>
						<div class="row align-items-center">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label class="form-label" for="evcfg_doacao_entrega_dte_ini">Data Inicial</label>
									<div class="position-relative d-flex align-items-center">
										<input type="text" name="evcfg_doacao_entrega_dte_ini" id="evcfg_doacao_entrega_dte_ini" class="form-control form-control-sm flatpickr_date" value="<?php echo($evcfg_doacao_entrega_dte_ini); ?>" style="padding-right: 3rem !important;" />
										<span class="position-absolute mx-4" style="right: 0;"><img src="assets/svg/icon-calendar.svg" /></span>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<label class="form-label" for="evcfg_doacao_entrega_dte_fim">Data Final</label>
									<div class="position-relative d-flex align-items-center">
										<input type="text" name="evcfg_doacao_entrega_dte_fim" id="evcfg_doacao_entrega_dte_fim" class="form-control form-control-sm flatpickr_date" value="<?php echo($evcfg_doacao_entrega_dte_fim); ?>" style="padding-right: 3rem !important;" />
										<span class="position-absolute mx-4" style="right: 0;"><img src="assets/svg/icon-calendar.svg" /></span>
									</div>
								</div>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->section('scripts'); ?>
	
	<style>
	
	.form-control-fake{
		background-color: rgb(255,255,255, 0) !important;
		border: 0 !important;
		padding-left: 0 !important;
	}
	.card.card-base.TxtQtdDoacoes .card-header {
		border-radius: .4rem;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
		background-color: #ffe093;
	}
	.boxContentDoacaoDatas{ display: none; }
	.boxContentDoacaoDatas.active{ display: block; }
	</style>

	<script>
	$(document).ready(function(){
		$(document).on('change', '.rdoFormaEntrega', function (e) {
			$('#boxContentDoacaoDatas').removeClass('active');
			if ($(this).is(':checked')) {
				if( $(this).val() == 'datas' ){
					$('#boxContentDoacaoDatas').addClass('active');
				}
			}
		});
	});
	</script>

<?php $this->endSection('scripts'); ?>