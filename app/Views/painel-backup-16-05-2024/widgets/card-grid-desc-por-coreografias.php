

<div class="card card-base DescCoreogf mb-3">
	<div class="card-header">
		Grid desconto progressivo por número de coreografias
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-md-5">
				<div class="form-group m-0">
					<label class="form-label" for="event_vlr_taxa_unic_comp">A partir de</label>
				</div>
			</div>
			<div class="col-12 col-md-5">
				<div class="form-group m-0">
					<label class="form-label" for="event_vlr_taxa_unic_comp">Desconto %</label>
				</div>
			</div>
			<div class="col-12 col-md-1 text-center">
				<div class="form-group m-0">
					<label class="form-label">Ação</label>
				</div>
			</div>
		</div>
		<div id="BOX-CONTENT-GRID-DESC-COREOGF">
			<?php 
				if( isset($rs_dados_valores) ){ 
					$xCount = 0;
					foreach ($rs_dados_valores->getResult() as $rowEvVlr) {
						$xCount++;
						$evvlr_id = (int)$rowEvVlr->evvlr_id;
						$evvlr_hashkey = ($rowEvVlr->evvlr_hashkey); 
						$_func_id = (int)$rowEvVlr->func_id;
						$evvlr_valor = ($rowEvVlr->evvlr_valor); 
						$evvlr_vlr_desc = ($rowEvVlr->evvlr_vlr_desc); 
						$evvlr_data_limite = fct_formatdate($rowEvVlr->evvlr_data_limite, 'd/m/Y');
				?>
				<div class="row trRow">
					<div class="col-12 col-md-5">
						<div class="form-group">
							<input type="text" name="evvlr_valor[]" id="evvlr_valor_<?php echo($xCount); ?>" class="form-control form-control-sm only-number" value="<?php echo($evvlr_valor); ?>" />
						</div>
					</div>
					<div class="col-12 col-md-5">
						<div class="form-group">
							<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_<?php echo($xCount); ?>" class="form-control form-control-sm mask-money" value="<?php echo($evvlr_vlr_desc); ?>" />
						</div>
					</div>
					<div class="col-12 col-md-1 text-center align-self-center">
						<a href="javascript:;" class="cmdDeletarDescCoreogf" data-hashkey="<?php echo($evvlr_hashkey); ?>" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
						<input type="hidden" name="evvlr_id[]" id="evvlr_id_<?php echo($xCount); ?>" value="<?php echo($evvlr_id); ?>"  class="form-control form-control-sm " />
					</div>
				</div>
				<?php
					}
				}
			?>
		</div>
		<div class="d-flex justify-content-end">
			<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovoDescCoreogf">Add Novo Desconto</a></div>
		</div>
	</div>
</div>


<?php $this->section('scripts'); ?>
	
	<style>
	.card.card-base.DescCoreogf .card-header {
		border-radius: .4rem;
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
		background-color: #e0f1cf;
	}
	</style>

	<script id="mstcGridDescCoreogf" type="text/x-jquery-tmpl">
		<div class="row {{trRow}}">
			<div class="col-12 col-md-5">
				<div class="form-group">
					<input type="text" name="evvlr_quant[]" id="evvlr_quant_{{item}}" class="form-control form-control-sm only-number" value="" />
				</div>
			</div>
			<div class="col-12 col-md-5">
				<div class="form-group">
					<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_{{item}}" class="form-control form-control-sm mask-money" value="" />
				</div>
			</div>
			<div class="col-12 col-md-1 align-self-center">
				<a href="javascript:;" class="cmdRemoverDescCoreogf" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
				<input type="hidden" name="evvlr_id[]" id="evvlr_id_{{item}}" value="0" />
			</div>
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$(document).on('click', '.cmdAddNovoDescCoreogf', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridDescCoreogf").html();
			$('#BOX-CONTENT-GRID-DESC-COREOGF').append(Mustache.render(template, templateData));
			let $el = $('#BOX-CONTENT-GRID-DESC-COREOGF'); 	
			$el.find('.mask-money').mask('#.##0,00', {reverse: true});
			//$el.find(".mask-date-place").mask('00/00/0000', {placeholder: "dd/mm/yyyy", clearIfNotMatch: true});
			//$el.find('.mask-hours').mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});
		});
		$(document).on('click', '.cmdDeletarDescCoreogf', function (e) {
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
							fct_count_item_grid_valores();
						},
						error: function (jqXHR, textStatus, errorThrown) {
						}
					});
					// ------------------------------------------------------
				}
			});
		}); 
		$(document).on('click', '.cmdRemoverDescCoreogf', function (e) {
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
					fct_count_item_grid_DescCoreogf();
				}
			});
		});

		fct_count_item_grid_DescCoreogf();
	});
	var fct_count_item_grid_DescCoreogf = function(p, callback){
		let $box = $('#BOX-CONTENT-GRID-DESC-COREOGF');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){ $( ".cmdAddNovoDescCoreogf" ).trigger( "click" ); }
	}
	</script>

<?php $this->endSection('scripts'); ?>