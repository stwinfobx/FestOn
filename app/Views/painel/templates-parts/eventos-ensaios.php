
<div class="row ">
	<div class="col-12 col-md-12">
		<div class="card card-base mb-3">
			<div class="card-header">
				Informe qual o dia e horário deseja iniciar os ensaios
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label class="form-label" for="crit_nota_min">Data do Ensaio</label>
							<select class="form-select form-select-sm" name="ordeData[]" id="ordeData_1" style="border-radius: 8px !important;">
								<option value="" translate="no">- selecione -</option>
								<option value="" translate="no">15/07/2024</option>
								<option value="" translate="no">16/07/2024</option>
								<option value="" translate="no">17/07/2024</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label class="form-label">Hoário Inicial</label>
							<div class="position-relative d-flex align-items-center">
								<input type="text" name="evdte_dte_abert_ini" id="evdte_dte_abert_ini" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
								<span class="position-absolute mx-4" style="right: 0;">
									<img src="assets/svg/icon-calendar.svg" />
								</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">

					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="row ">
	<div class="col-12 col-md-12">
		<div class="card card-base mb-3">
			<div class="card-header">
				Coreografias
			</div>
			<div class="card-body">

				<div class="">
					<div class="table-responsive">
						<!--begin::Table-->
						<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
							<thead>
								<tr class="fw-bolder text-muted">
									<th style="width:120px;">Elenco</th>
									<th>Coreografia / Grupo</th>
									<th style="width:75px;">Tempo</th>
								</tr>
							</thead>
							<tbody>
								<tr data-id="1">
									<td>Elenco</td>
									<td>
										<div>Uma Flor Única</div>
										<div class="bold">CIA DE DANÇA VIOLET</div>
									</td>
									<td>02:00</td>
								</tr>
								<tr data-id="2">
									<td>Elenco</td>
									<td>
										<div>Liberdade</div>
										<div class="bold">COMPANHIA DE DANÇA TAILÂNCIA</div>
									</td>
									<td>04:00</td>
								</tr>
								<tr data-id="3">
									<td>Elenco</td>
									<td>
										<div>Minha Amiga</div>
										<div class="bold">LAGO DOS CISNES CIA</div>
									</td>
									<td>04:00</td>
								</tr>
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="row ">
	<div class="col-12 col-md-12">
		<div class="card card-base mb-3">
			<div class="card-header">
				Ensaios Confirmados
			</div>
			<div class="card-body">

				<div class="">
					<div class="table-responsive">
						<!--begin::Table-->
						<table id="sortable-table" class="draggable-zone-v2 table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
							<thead>
								<tr class="fw-bolder text-muted">
									<th style="width:40px;">&nbsp;</th>
									<th style="width:75px;">Ordem</th>
									<th style="width:115px; line-height: 1.3;">Apresentou<br>Confirmado</th>
									<th style="width:120px;">Elenco</th>
									<th>Coreografia / Grupo</th>
									<th style="width:75px;">Tempo</th>
									<th style="width:95px; line-height: 1.3;">Hora Inicio / Término</th>
								</tr>
							</thead>
							<tbody>
								<tr data-id="1">
									<td style="vertical-align: middle; font-size: 1rem; color: gray; cursor: move;">
										<i class="fas fa-bars"></i>
									</td>
									<td>
										<input type="text" name="ordem[]" id="ordem_xx" value="1" class="form-control form-control-sm" style="border-radius: 8px">
									</td>
									<td>
										<div class="status-tag-inativo">Não Apresentou</div>
										<div class="status-tag-inativo">Não Confirmado</div>
									</td>
									<td>Elenco</td>
									<td>
										<div>Uma Flor Única</div>
										<div class="bold">CIA DE DANÇA VIOLET</div>
									</td>
									<td>02:00</td>
									<td>
										13:00:00 <br>
										13:02:00
									</td>
								</tr>
								<tr data-id="2">
									<td style="vertical-align: middle; font-size: 1rem; color: gray; cursor: move;">
										<i class="fas fa-bars"></i>
									</td>
									<td>
										<input type="text" name="ordem[]" id="ordem_xx" value="2" class="form-control form-control-sm" style="border-radius: 8px">
									</td>
									<td>
										<div class="status-tag-ativo">Apresentou</div>
										<div class="status-tag-ativo">Confirmado</div>
									</td>
									<td>Elenco</td>
									<td>
										<div>Liberdade</div>
										<div class="bold">COMPANHIA DE DANÇA TAILÂNCIA</div>
									</td>
									<td>04:00</td>
									<td>
										13:04:00 <br>
										13:06:00
									</td>
								</tr>
								<tr data-id="3">
									<td style="vertical-align: middle; font-size: 1rem; color: gray; cursor: move;">
										<i class="fas fa-bars"></i>
									</td>
									<td>
										<input type="text" name="ordem[]" id="ordem_xx" value="3" class="form-control form-control-sm" style="border-radius: 8px">
									</td>
									<td>
										<div class="status-tag-inativo">Não Apresentou</div>
										<div class="status-tag-ativo">Confirmado</div>
									</td>
									<td>Elenco</td>
									<td>
										<div>Minha Amiga</div>
										<div class="bold">LAGO DOS CISNES CIA</div>
									</td>
									<td>04:00</td>
									<td>
										13:04:00 <br>
										13:06:00
									</td>
								</tr>
								<tr data-id="4">
									<td style="vertical-align: middle; font-size: 1rem; color: gray; cursor: move;">
										<i class="fas fa-bars"></i>
									</td>
									<td>
										<input type="text" name="ordem[]" id="ordem_xx" value="4" class="form-control form-control-sm" style="border-radius: 8px">
									</td>
									<td>
										<div class="status-tag-inativo">Não Apresentou</div>
										<div class="status-tag-inativo">Confirmado</div>
									</td>
									<td>Elenco</td>
									<td>
										<div>Ventos Brandos</div>
										<div class="bold">COMPANHIA DE DANÇA DA SERRA</div>
									</td>
									<td>04:00</td>
									<td>
										13:04:00 <br>
										13:06:00
									</td>
								</tr>
							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
				</div>

			</div>
		</div>
	</div>
</div>



<?php $this->section('scripts'); ?>
	
	<!-- <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.11/lib/draggable.bundle.js"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.11/lib/sortable.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

	<style>
		.bold{
			font-weight: 600;		
		}
		.status-tag-ativo{
			background-color: #32c932;
			border-radius: 4px;
			padding: 2px 6px;
			font-size: .65rem;
			color: white;
			margin: 2px 0;
		}
		.status-tag-inativo{
			background-color: #ed5353;
			border-radius: 4px;
			padding: 2px 6px;
			font-size: .65rem;
			color: white;
			margin: 2px 0;
		}
		.form-control.form-control-sm{
			height: calc(1.75em + 0.5rem + calc(var(--bs-border-width) * 2)) !important;
			border-radius: 8px !important;
		}

		.table th {
			padding: 0.15rem 0.5rem;
			border-bottom: 1px dashed black;
		}
		.symbol {
			display: inline-block;
			flex-shrink: 0;
			position: relative;
			border-radius: .475rem;
		}
		.symbol>img {
			width: 100%;
			flex-shrink: 0;
			display: inline-block;
			border-radius: .475rem;
		}
		.symbol.symbol-45px>img {
			width: 45px;
			height: 45px;
		}


		.card.card-counter .card-body{
			padding: 1rem 1rem !important;	
		}
	</style>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		var tbody = document.getElementById('sortable-table').getElementsByTagName('tbody')[0];
		new Sortable(tbody, {
			animation: 150,
			ghostClass: 'sortable-ghost',
			onEnd: function(evt) {
				var order = [];
				var rows = tbody.getElementsByTagName('tr');
				for (var i = 0; i < rows.length; i++) {
					order.push(rows[i].getAttribute('data-id'));
				}
				console.log('Nova ordem:', order);
			}
		});
	});
	$(document).ready(function(){
		$.ajaxSetup({cache: false});

		
		/*
		var containersV2 = document.querySelectorAll(".draggable-zone-v2");
		if (containersV2.length === 0) {
			return false;
		}
		var swappableV2 = new Sortable.default(containersV2, {
			draggable: ".draggable",
			handle: ".draggable .draggable-handle",
			mirror: {
				appendTo: "body",
				constrainDimensions: true
			}
		});
		swappableV2.on('sortable:stop', (event) => {
			//console.log('oldIndex: ', event.oldIndex);
			//console.log('newIndex: ', event.newIndex);
			//console.log('oldContainer: ', event.oldContainer);
			//console.log('newContainer: ', event.newContainer);

			// esperar 1 segundo para atualizar
			setTimeout(() => {
				let $box = $('#BOX-CONTENT-FILE-ORGANIZAR');
				var allOrderNumValues = [];
				$box.find('.draggable .orderNum').each(function() {
					var value = $(this).val();
					if (!allOrderNumValues.includes(value)) { allOrderNumValues.push(value); }
				});

				// ------------------------------------------------------
				let $formData = { allOrderNumValues: allOrderNumValues };
				$.ajax({
					url: PAINEL_URL  +'clientes/fornecedores/ajaxform/ORGANIZAR-GALERIA',
					method:"POST",
					type: "POST",
					dataType: "json",
					data: $formData,
					crossDomain: true,
					beforeSend: function(response) {},
					complete: function(response) { },
					success:function(response){},
					error: function (jqXHR, textStatus, errorThrown) {}
				});
				// ------------------------------------------------------
			}, 400);
		});
		*/
	});
	</script>


<?php $this->endSection('scripts'); ?>


<?php $this->section('modals'); ?>

	<div class="modal fade" tabindex="-1" id="modal_criterios">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Critérios específicos para jurados</h5>
					<a href="javascript:;" class="" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem; color: black;">
						<i class="far fa-times-circle"></i>
					</a>
				</div>
				<div class="modal-body" style="max-height: 70vh; overflow: auto;">

					<div class="card card-base">
						<div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e3ebf6; font-weight: bold;">
							Critérios a serem avaliados
						</div>
						<div class="card-body">

							<div class="table-box table-responsive">
								<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
									<tbody>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkEnsaios[]" id="chkEnsaios_xx" value="2" checked="">
											</td>
											<td>
												Técnica 
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkEnsaios[]" id="chkEnsaios_xx" value="2">
											</td>
											<td>
												Interpretação
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkEnsaios[]" id="chkEnsaios_xx" value="2" checked="">
											</td>
											<td>
												Criatividade
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkEnsaios[]" id="chkEnsaios_xx" value="2" checked="">
											</td>
											<td>
												Harmonia
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkEnsaios[]" id="chkEnsaios_xx" value="2">
											</td>
											<td>
												Figurino
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkEnsaios[]" id="chkEnsaios_xx" value="2" checked="">
											</td>
											<td>
												Impacto Artístico
											</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>
					</div>

				</div>
				<div class="modal-footer">
					<div class="d-flex justify-content-center w-100">
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-primary" style="border-radius: 8px;">Continuar</button>
						</div>
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Fechar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->endSection('modals'); ?>
