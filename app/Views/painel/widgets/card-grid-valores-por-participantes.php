
<?php 
//var_dump( $arr_forma_cobr_selected ); 
$checked_box = ( in_array('por_participante', $arr_forma_cobr_selected) ? " active " : "" );
?>
<div id="boxConfigpor_participante" class="boxConfigMoney <?php echo( $checked_box ); ?>">
	<div class="card card-base ValorEvento mb-3">
		<div class="card-header">
			Grid de valores por participantes
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-md-3">
					<div class="form-group m-0">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Função</label>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group m-0">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Valor</label>
					</div>
				</div>
				<div class="col-12 col-md-2">
					<div class="form-group m-0">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Desconto</label>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group m-0">
						<label class="form-label" for="event_vlr_taxa_unic_comp">Data limite para o desconto</label>
					</div>
				</div>
				<div class="col-12 col-md-1 text-center">
					<div class="form-group m-0">
						<label class="form-label">Ação</label>
					</div>
				</div>
			</div>
			<div id="BOX-CONTENT-GRID-VALORES">
				<?php 		
					if( isset($rs_valores_por_participantes) ){ 
						$xCount = 0;
						foreach ($rs_valores_por_participantes->getResult() as $rowEvVlr) {
							$xCount++;
							$evvlr_id = (int)$rowEvVlr->evvlr_id;
							$evvlr_hashkey = ($rowEvVlr->evvlr_hashkey); 
							$_func_id = (int)$rowEvVlr->func_id;
							$evvlr_valor = ($rowEvVlr->evvlr_valor);
							$evvlr_valor = fct_to_money($evvlr_valor, 2, 'br');
							
							$evvlr_vlr_desc = ($rowEvVlr->evvlr_vlr_desc); 
							$evvlr_data_limite = fct_formatdate($rowEvVlr->evvlr_data_limite, 'd/m/Y');
					?>
					<div class="row trRow">
						<div class="col-12 col-md-3">
							<div class="form-group">
								<select class="form-select form-select-sm" name="func_id[]" id="func_id_<?php echo($xCount); ?>">
									<option value="" translate="no">- selecione -</option>
									<?php
									if( isset($rs_funcoes)){
										foreach ($rs_funcoes->getResult() as $row) {
											$func_id = ($row->func_id);
											$func_titulo = ($row->func_titulo);
											$selected = (($func_id == $_func_id) ? ' selected ' : '');
										?>
											<option value="<?php echo($func_id); ?>" translate="no" <?php echo($selected); ?>><?php echo($func_titulo); ?></option>
										<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<input type="text" name="evvlr_valor[]" id="evvlr_valor_<?php echo($xCount); ?>" class="form-control form-control-sm mask-money" value="<?php echo($evvlr_valor); ?>" />
							</div>
						</div>
						<div class="col-12 col-md-2">
							<div class="form-group">
								<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_<?php echo($xCount); ?>" class="form-control form-control-sm mask-money" value="<?php echo($evvlr_vlr_desc); ?>" />
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div class="position-relative d-flex align-items-center">
									<input type="text" name="evvlr_data_limite[]" id="evvlr_data_limite_<?php echo($xCount); ?>" class="form-control form-control-sm flatpickr_date" value="<?php echo($evvlr_data_limite); ?>" style="padding-right: 3rem !important;" />
									<span class="position-absolute mx-4" style="right: 0;"><img src="assets/svg/icon-calendar.svg" /></span>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-1 text-center align-self-center">
							<a href="javascript:;" class="cmdDeletarValorEvento" data-hashkey="<?php echo($evvlr_hashkey); ?>" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
							<input type="hidden" name="evvlr_id[]" id="evvlr_id_<?php echo($xCount); ?>" value="<?php echo($evvlr_id); ?>"  class="form-control form-control-sm " />
						</div>
					</div>
					<?php
						}
					}
				?>
			</div>
			<div class="d-flex justify-content-end">
				<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovoValorEvento">Add Novo Valor</a></div>
			</div>
		</div>
	</div>
</div>


<?php $this->section('scripts'); ?>
	
	<style>
	.boxConfigMoney{ display: none; }
	.boxConfigMoney.active{ display: block; }
	.card.card-base.ValorEvento .card-header {
		border-radius: .4rem;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
		/*background-color: #cdf6f0;*/
	}
	</style>

	<script id="mstcGridValorEvento" type="text/x-jquery-tmpl">
		<div class="row {{trRow}}">
			<div class="col-12 col-md-3">
				<div class="form-group">
					<select class="form-select form-select-sm" name="func_id[]" id="func_id_{{item}}">
						<option value="" translate="no">- selecione -</option>
						<?php
						if( isset($rs_funcoes)){
							foreach ($rs_funcoes->getResult() as $row) {
								$func_id = ($row->func_id);
								$func_titulo = ($row->func_titulo);
							?>
								<option value="<?php echo($func_id); ?>" translate="no"><?php echo($func_titulo); ?></option>
						<?php
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<input type="text" name="evvlr_valor[]" id="evvlr_valor_{{item}}" class="form-control form-control-sm mask-money" value="" />
				</div>
			</div>
			<div class="col-12 col-md-2">
				<div class="form-group">
					<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_{{item}}" class="form-control form-control-sm mask-money" value="" />
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="evvlr_data_limite[]" id="evvlr_data_limite_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
						<span class="position-absolute mx-4" style="right: 0;">
							<img src="assets/svg/icon-calendar.svg" />
						</span>
						<input type="hidden" name="evvlr_id[]" id="evvlr_id_{{item}}" value="0" />
					</div>
				</div>
			</div>
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$(document).on('click', '.cmdAddNovoValorEvento', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridValorEvento").html();
			$('#BOX-CONTENT-GRID-VALORES').append(Mustache.render(template, templateData));
			let $el = $('#BOX-CONTENT-GRID-VALORES'); 	

			$el.find('.flatpickr_date').flatpickr({
				"locale": "pt",
				dateFormat:"d/m/Y",	
			});
			$el.find('.flatpickr_hour').flatpickr({
				"locale": "pt",
				enableTime: true,
				noCalendar: true,
				dateFormat:"H:i"
			});
			$el.find('.mask-money').mask('#.##0,00', {reverse: true});
			//$el.find(".mask-date-place").mask('00/00/0000', {placeholder: "dd/mm/yyyy", clearIfNotMatch: true});
			//$el.find('.mask-hours').mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});
		});
		$(document).on('click', '.cmdDeletarValorEvento', function (e) {
			let $this = $(this);
			let $hashkey = $this.data( "hashkey" );
			let $row = $this.closest( ".trRow" );

			Swal.fire({
				title: 'Atenção!',
				icon: 'warning',
				html:
					'Você está prestes a excluir este registro. <br />' +
					'Esta ação não poderá ser revertida.',
				type: 'warning',
				showCancelButton: true,
				cancelButtonColor: "#AAAAAA",
				confirmButtonColor: "#E96565",
				//confirmButtonColor: '$danger',
				//cancelButtonColor: '$success',
				confirmButtonText: 'Apagar',
				cancelButtonText: 'Cancelar',
				reverseButtons: true
			}).then(function(result) {
				if (result.value) {
					// ------------------------------------------------------
					let $formData = {
						hashkey: $hashkey,
					};
					$.ajax({
						url: painel_url +'eventos/ajaxform/EXCLUIR-VALOR-EVENTO',
						method:"POST",
						type: "POST",
						dataType: "json",
						data: $formData,
						crossDomain: true,
						beforeSend: function(response) {
							console.log('1 beforeSend');
							console.log(response);
						},
						complete: function(response) { 
							console.log('3 complete');
							console.log(response);
						},
						success:function(response){
							console.log('2 success');
							console.log(response);

							$row.remove();
							fct_count_item_grid_ValorEvento();
						},
						error: function (jqXHR, textStatus, errorThrown) {
						}
					});
					// ------------------------------------------------------
				}
			});
		}); 
		$(document).on('click', '.cmdRemoverValorEvento', function (e) {
			let $this = $(this);
			let $row = $this.closest( ".trRow" );

			Swal.fire({
				title: 'Atenção!',
				icon: 'warning',
				html:
					'Você está prestes a excluir este registro. <br />' +
					'Esta ação não poderá ser revertida.',
				type: 'warning',
				showCancelButton: true,
				cancelButtonColor: "#AAAAAA",
				confirmButtonColor: "#E96565",
				//confirmButtonColor: '$danger',
				//cancelButtonColor: '$success',
				confirmButtonText: 'Apagar',
				cancelButtonText: 'Cancelar',
				reverseButtons: true
			}).then(function(result) {
				if (result.value) {
					$row.remove();
					fct_count_item_grid_valores();
				}
			});
		});

		fct_count_item_grid_ValorEvento();
	});
	var fct_count_item_grid_ValorEvento = function(p, callback){
		let $box = $('#BOX-CONTENT-GRID-VALORES');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){ $( ".cmdAddNovoValorEvento" ).trigger( "click" ); }
	}
	</script>

<?php $this->endSection('scripts'); ?>