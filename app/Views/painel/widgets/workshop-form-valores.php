
<!-- VALORES -->
<?php 
	$evcfg_forma_cobranca = ((isset($rs_dados_config->evcfg_forma_cobranca) ? $rs_dados_config->evcfg_forma_cobranca : "")); 
	$arr_forma_cobr_selected = []; 
	if( !empty($evcfg_forma_cobranca) ){ $arr_forma_cobr_selected = json_decode($evcfg_forma_cobranca); }
	if( !is_array($arr_forma_cobr_selected) ){ $arr_forma_cobr_selected = []; }

	$evcfg_forma_cobranca_tipo = ((isset($rs_dados_config->evcfg_forma_cobranca_tipo) ? $rs_dados_config->evcfg_forma_cobranca_tipo : ""));
?>
<div class="row ">
	<div class="col-12 col-md-4">
		<div class="form-group d-flex flex-column align-items-start" style="gap:8px;">
			<div><label class="form-label">Forma de Cobrança</label></div>
			<div class="form-group d-flex align-items-start" style="gap:30px;">
			<?php 
				foreach ($listFormaCobrancaTipo as $keyFC => $valFC) {
					$label = $valFC['label'];
					$value = $valFC['value'];
					$checked = (($value == $evcfg_forma_cobranca_tipo) ? " checked " : "" );
			?>
			<div class="">
				<div class="form-check" style="padding-left: 0 !important;">
					<div class="custom-control custom-radio">
						<input type="radio" name="evcfg_forma_cobranca_tipo" id="evcfg_forma_cobranca_tipo_<?php echo($value)?>" class="custom-control-input rdoCobraTipo" value="<?php echo($value)?>" <?php echo($value)?> <?php echo($checked)?> />
						<label class="custom-control-label" for="evcfg_forma_cobranca_tipo_<?php echo($value)?>"><?php echo($label)?></label>
					</div>
				</div>
			</div>
			<?php 
				}
			?>
			</div>
		</div>
	</div>
</div>

<div class="row ">
	<div class="col-12 col-md-12">

		<?php
			$w_data['etapa'] = 'participantes';
			$w_data['arr_forma_cobr_selected'] = $arr_forma_cobr_selected;
			$include = view('painel/widgets/work-card-grid-valores-por-participantes', $w_data);
			echo( $include );
		?>

		<?php 
			//var_dump( $arr_forma_cobr_selected );
			$w_data_doac['evcfg_forma_cobranca_tipo'] = $evcfg_forma_cobranca_tipo;
			// $checked = ( in_array($value, $arr_forma_cobr_selected) ? " checked " : "" );
			$include = view('painel/widgets/work-card-grid-quant-doacoes', $w_data_doac);
			echo( $include );
		?>

	</div>
</div>

<div class="row">
	<div class="col-12 col-md-4 d-none">
		<div class="card card-base mb-3">
			<div class="card-header">
				Amostra
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label class="form-label" for="event_vlr_taxa_unic_amostra">Taxa única por participante</label>
							<input type="text" name="event_vlr_taxa_unic_amostra" id="event_vlr_taxa_unic_amostra" class="form-control mask-money" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_amostra) ? $rs_dados->event_vlr_taxa_unic_amostra : ""));?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-5">

	</div>
	<div class="col-12 col-md-5">

		<?php 
//			$include = view('painel/widgets/card-grid-desc-por-participantes', []);
//			echo( $include );
		?>

		<?php 
			//$include = view('painel/widgets/card-grid-desc-por-coreografias', []);
			//echo( $include );
		?>

		<div class="row mb-3 d-none">
			<div class="col-12 col-md-12">
				<div class="form-group">
					<label class="form-label" for="event_vlr_taxa_unic_amostra">Desconto progressivo por curso</label>
					<input type="text" name="event_vlr_taxa_unic_comp" id="event_vlr_taxa_unic_comp" class="form-control form-control-sm mask-money" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_comp) ? $rs_dados->event_vlr_taxa_unic_comp : ""));?>" />
				</div>
			</div>
		</div>

	</div>
</div>



<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.tipoCobrancaCurso{ display: none; }
		.tipoCobrancaCurso.active{ display: block; }
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<script>
	$(document).ready(function(){
		$(document).on('change', '.rdoCobraTipo', function (e) {
			$('#tipoCobraMonetaria').removeClass('active');
			$('#tipoCobraDoacao').removeClass('active');
			
			if ($(this).is(':checked')) {
				if( $(this).val() == 'monetaria' ){
					$('#tipoCobraMonetaria').addClass('active');
				}
				if( $(this).val() == 'doacao' ){
					$('#tipoCobraDoacao').addClass('active');
					//$('.boxConfigMoney').removeClass('active');
					//$('.rdoTipoCobraMoney').prop('checked',false);
				}				
			}
		});	
	});
	</script>

<?php $this->endSection('scripts'); ?>

