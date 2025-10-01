

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
							<input type="hidden" name="doacoesP_evvlr_label[]" id="doacoesP_evvlr_label_<?php echo($xCount); ?>" class="form-control form-control-sm" value="<?php echo($keyDoac); ?>" readonly />
							<input type="text" name="doacoesP_evvlr_label_desc[]" id="doacoesP_evvlr_label_desc_<?php echo($xCount); ?>" class="form-control form-control-sm" value="<?php echo($valDoac); ?>" readonly />
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
</div>


<?php $this->section('scripts'); ?>
	
	<style>
	.card.card-base.TxtQtdDoacoes .card-header {
		border-radius: .4rem;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
		background-color: #ffe093;
	}
	</style>

	<script>
	$(document).ready(function(){
	});
	</script>

<?php $this->endSection('scripts'); ?>