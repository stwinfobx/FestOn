
<?php 
//var_dump( $arr_forma_cobr_selected ); 
$arr_forma_cobr_selected = (isset($arr_forma_cobr_selected) ? $arr_forma_cobr_selected : []); 
$checked_box = ( in_array('por_participante', $arr_forma_cobr_selected) ? " active " : "" );
?>

<div class="card card-base mb-3">
	<div class="card-header">
		Grade de Datas e Horários
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-md-5">
				<div class="form-group m-0">
					<label class="form-label">Data do Evento</label>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group m-0">
					<label class="form-label">Horário Inicial</label>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group m-0">
					<label class="form-label">Horário Término</label>
				</div>
			</div>
			<div class="col-12 col-md-1 text-center">
				<div class="form-group m-0">
					<label class="form-label">Ação</label>
				</div>
			</div>
		</div>
		<div id="BOX-CONTENT-WORKSHOP-DATAS">
			<?php
			if( isset($rs_workshops_datas) ){ 
				$xCount = 0;
				foreach ($rs_workshops_datas->getResult() as $rowWrkData) {
					$xCount++;
					$crsdte_id = (int)$rowWrkData->crsdte_id;
					$crsdte_hashkey = ($rowWrkData->crsdte_hashkey); 
					$crsdte_data = fct_formatdate($rowWrkData->crsdte_data, 'd/m/Y');
					$crsdte_hrs_ini = ($rowWrkData->crsdte_hrs_ini);
					$crsdte_hrs_end = ($rowWrkData->crsdte_hrs_end);
			?>		
			<div class="row trRow">
				<div class="col-12 col-md-5">
					<div class="form-group">
						<div class="position-relative d-flex align-items-center">
							<input type="text" name="crsdte_data[]" id="crsdte_data_<?php echo($xCount); ?>" class="form-control form-control-sm flatpickr_date flatpickr-input" value="<?php echo($crsdte_data); ?>" style="padding-right: 3rem !important;" readonly="readonly">
							<span class="position-absolute mx-4" style="right: 0;">
								<img src="assets/svg/icon-calendar.svg">
							</span>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<input type="text" name="crsdte_hrs_ini[]" id="crsdte_hrs_ini_<?php echo($xCount); ?>" class="form-control form-control-sm flatpickr_hour flatpickr-input" value="<?php echo($crsdte_hrs_ini); ?>" readonly="readonly">
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="form-group">
						<input type="text" name="crsdte_hrs_end[]" id="crsdte_hrs_end_<?php echo($xCount); ?>" class="form-control form-control-sm flatpickr_hour flatpickr-input" value="<?php echo($crsdte_hrs_end); ?>" readonly="readonly">
					</div>
				</div>
				<div class="col-12 col-md-1 text-center align-self-center">
					<a href="javascript:;" class="cmdRemoverData" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
					<input type="hidden" name="crsdte_id[]" id="crsdte_id_<?php echo($xCount); ?>" value="<?php echo($crsdte_id); ?>">
				</div>	
			</div>
			<?php
				}
			}
			?>			
		</div>
		<div class="d-flex justify-content-end">
			<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovoWorkshopData">Adicionar Nova Data</a></div>
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

	<script id="mstcGridWorkShopData" type="text/x-jquery-tmpl">
		<div class="row {{trRow}}">
			<div class="col-12 col-md-5">
				<div class="form-group">
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="crsdte_data[]" id="crsdte_data_{{item}}" class="form-control form-control-sm flatpickr_date flatpickr-input" value="" style="padding-right: 3rem !important;" readonly="readonly">
						<span class="position-absolute mx-4" style="right: 0;">
							<img src="assets/svg/icon-calendar.svg">
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<input type="text" name="crsdte_hrs_ini[]" id="crsdte_hrs_ini_{{item}}" class="form-control form-control-sm flatpickr_hour flatpickr-input" value="" readonly="readonly">
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<input type="text" name="crsdte_hrs_end[]" id="crsdte_hrs_end_{{item}}" class="form-control form-control-sm flatpickr_hour flatpickr-input" value="" readonly="readonly">
				</div>
			</div>
			<div class="col-12 col-md-1 text-center align-self-center">
				<a href="javascript:;" class="cmdRemoverDataWork" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
				<input type="hidden" name="crsdte_id[]" id="crsdte_id_{{item}}" value="0">
			</div>	
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$(document).on('click', '.cmdAddNovoWorkshopData', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridWorkShopData").html();
			$('#BOX-CONTENT-WORKSHOP-DATAS').append(Mustache.render(template, templateData));
			let $el = $('#BOX-CONTENT-WORKSHOP-DATAS'); 	

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
		$(document).on('click', '.cmdRemoverDataWork', function (e) {
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
					fct_count_item_grid_WorkshopData();
				}
			});
		});

		fct_count_item_grid_WorkshopData();
	});
	var fct_count_item_grid_WorkshopData = function(p, callback){
		let $box = $('#BOX-CONTENT-WORKSHOP-DATAS');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){ $( ".cmdAddNovoWorkshopData" ).trigger( "click" ); }
	}
	</script>

<?php $this->endSection('scripts'); ?>