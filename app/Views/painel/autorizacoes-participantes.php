<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Lista de Autorizações por Evento e Grupos</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default mb-3">
							<div class="card-body p-0">
								<?php
								//$bsc_event_id = (int)(isset($bsc_event_id) ? $bsc_event_id : '');
								//print_r( $bsc_event_id );
								?>


								<!-- Pesquisa Avançada -->
								<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsFiltro" id="formFieldsFiltro">
									<div class="pb-3" style="border-bottom: 1px dashed #d7d7d7; margin-bottom: 2.5rem !important;">
										<h4 class="text-center mb-3">Pesquisa Avançada</h4>
										<div class="row align-items-end">
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label class="form-label" for="curso_titulo">Eventos</label>
													<select class="form-select" name="event_id" id="event_id">
														<option value="" translate="no">- selecione -</option>
														<?php
														$bsc_event_id = (int)(isset($bsc_event_id) ? $bsc_event_id : '');
														if( isset($rs_autorizacoes_event) ){
															foreach ($rs_autorizacoes_event->getResult() as $row) {
																$event_id = (int)$row->event_id;
																$event_titulo = $row->event_titulo;
																$selected = (($event_id == $bsc_event_id) ? 'selected' : ''); 
														?>
															<option value="<?php echo($event_id); ?>" <?php echo($selected); ?>><?php echo($event_titulo); ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-3">
												<div class="form-group">
													<div class="d-grid">
														<button type="submit" class="btn btn-success" value="Pesquisar">Pesquisar</button>
														<!-- <a href="<?php //echo(painel_url('autorizacoes-participacoes')); ?>" class="btn btn-success" value="Salvar">Pesquisar</a> -->
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6 d-none">
												<div class="row align-items-end d-none">
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="curso_dte_inicio">Início</label>
															<div class="position-relative d-flex align-items-center">
																<input type="text" name="curso_dte_inicio" id="curso_dte_inicio" class="form-control flatpickr_date" value="" style="padding-right: 3rem !important;" />
																<span class="position-absolute mx-4" style="right: 0;">
																	<img src="assets/svg/icon-calendar.svg" />
																</span>
															</div>
														</div>
													</div>
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="curso_dte_inicio">Término</label>
															<div class="position-relative d-flex align-items-center">
																<input type="text" name="curso_dte_inicio" id="curso_dte_inicio" class="form-control flatpickr_date" value="" style="padding-right: 3rem !important;" />
																<span class="position-absolute mx-4" style="right: 0;">
																	<img src="assets/svg/icon-calendar.svg" />
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</FORM>


								<?php
								//print '<pre>';
								//print_r($rs_list_autorizacoes);
								//print '</pre>';

								if( isset($rs_list_autorizacoes) ){
								?>
								<div class="row align-items-start">
									<div class="col-12 col-md-12">
										<!-- <h3>Lista de Autorizações por Evento e Grupos</h3> -->
										<table id="example3" class="display nowrap table table-striped table-bordered m-0" style="width: 100%; background-color: white; border-radius: 8px;">
											<thead>
												<tr>
													<td style="width: 30%;"><strong>Evento</strong></td>
													<td><strong>Grupo</strong></td>
												</tr>
											</thead>
											<tbody>
												<?php
												$count = 0;
												//foreach ($rs_list_autorizacoes->getResult() as $row) {
												foreach ($rs_list_autorizacoes as $keyAut => $valAut) {
													// Array ( [0] => stdClass Object ( [event_titulo] => Ballerina Dance Academy [grp_titulo] => Grupo 1 Relacionado a Bailarina Dance Academy [partc_nome] => Nome Teste Sem Documento [total_autorizacoes] => 5 [total_autorizacoes_checadas] => 4 ) )
													$grevt_hashkey = $valAut->grevt_hashkey;
													$event_id = $valAut->event_id;
													$event_hashkey = $valAut->event_hashkey;
													$event_titulo = $valAut->event_titulo;
													$grp_titulo = $valAut->grp_titulo;
													$participantes = $valAut->participantes;
													//$partc_nome = $row->partc_nome;
													//$total_autorizacoes = $row->total_autorizacoes;
													//$total_autorizacoes_checadas = $row->total_autorizacoes_checadas;
													//$partc_hashkey = $row->partc_hashkey;
													//$grevt_hashkey = $row->grevt_hashkey;

													//$link_autorizacoes = site_url( 'inscricoes/compliance/'. $grevt_hashkey .'/'. $partc_hashkey);

													$total_autorizacoes = 0;
													$total_autorizacoes_checadas = 0;
													//$link_autorizacoes = site_url( 'inscricoes/compliance/'. $grevt_hashkey);

													$id = "box_". $grevt_hashkey;
													$idAcc = "acc_". $grevt_hashkey;
												?>
												<tr>
													<td><?php echo($event_titulo); ?></td>
													<td>
														<div class="accordion accCoreografias" id="<?php echo($idAcc); ?>">
															<div class="accordion-items boxFields">
																<div class="accordion-headers">
																	<div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo($id); ?>" aria-expanded="false" aria-controls="<?php echo($id); ?>">
																		<div class="" style="color: #000000; font-weight: normal;"><?php echo($grp_titulo); ?></div>
																	</div>
																</div>
																<div id="<?php echo($id); ?>" class="accordion-collapse collapse" data-bs-parent="#<?php echo($idAcc); ?>">
																	<div class="accordion-body">
																		<table id="example3" class="display nowrap table table-striped table-bordered m-0" style="width: 100%; background-color: white; border-radius: 8px;">
																			<thead>
																				<tr>
																					<td><strong>Participante</strong></td>
																					<td class="text-center" style="width: 120px"><strong>Quant.</strong></td>
																					<td class="text-center" style="width: 120px;"><strong>Checados</strong></td>
																					<td class="text-center" style="width: 120px;"><strong>Ação</strong></td>
																				</tr>
																			</thead>
																			<tbody>
																			<?php
																			foreach ($participantes as $keyPartc => $valPartc) {
																				$partc_hashkey = $valPartc->partc_hashkey;
																				$partc_nome = $valPartc->partc_nome;
																				$partc_file_foto = $valPartc->partc_file_foto;
																				$total_autorizacoes = $valPartc->total_autorizacoes;
																				$total_autorizacoes_checadas = $valPartc->total_autorizacoes_checadas;
																				$link_autorizacoes = site_url( 'inscricoes/compliance/'. $grevt_hashkey .'/'. $partc_hashkey );

																				$checado = false;
																				$css_bg_checado = '';
																				if( $total_autorizacoes_checadas >= $total_autorizacoes ){
																					$css_bg_checado = 'background-color: #d4ffd4;';
																					$checado = true;
																				}
																			?>
																				<tr style="<?php echo($css_bg_checado); ?>">
																					<td>
																						<div class="d-flex align-items-center" style="gap:10px;">
																							<div class="symbol symbol-45px bg-img" style="width: 45px;height: 45px; border-radius: 50%; background-image:url(<?php echo(site_url('uploads/cadastros/'. $partc_file_foto)); ?>);">
																								<!-- <img src="assets/media/avatar-11.jpg" alt="" style="border-radius: 50%;"> -->
																							</div>
																							<div>
																								<?php echo($partc_nome); ?>
																							</div>
																						</div>
																					</td>
																					<td class="text-center"><?php echo($total_autorizacoes); ?></td>
																					<td class="text-center"><?php echo($total_autorizacoes_checadas); ?></td>
																					<td class="text-center">
																						<?php if( !$checado){ ?>
																						<div class="d-flex justify-content-center" style="gap: 0 10px;">
																							<div>
																								<a href="<?php echo($link_autorizacoes); ?>" target="_blank" class="btn btn-sm btn-ac btn-warning cmdReloadStatus disabled-link"><i class="las la-check-double"></i></a>
																							</div>
																							<div>
																								<a href="javascript:;" data-partchashkey="<?php echo($partc_hashkey); ?>" data-grevthashkey="<?php echo($grevt_hashkey); ?>" class="btn btn-sm btn-ac btn-dark cmdSendMail disabled-link"><i class="fas fa-envelope"></i></a>
																							</div>
																						</div>
																						<?php } ?>
																					</td>
																				</tr>
																			<?php
																			}
																			?>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</td>
													<!--
													<td><?php //echo($partc_nome); ?></td>
													<td class="text-center"><?php echo($total_autorizacoes); ?></td>
													<td class="text-center"><?php echo($total_autorizacoes_checadas); ?></td>
													<td class="text-center">
														<a href="<?php echo($link_autorizacoes); ?>" target="_blank" class="btn btn-sm btn-ac btn-warning cmdReloadStatus disabled-link"><i class="las la-check-double"></i></a>
													</td>
													-->
												</tr>
												<?php
												} // foreach
												?>
											</tbody>
										</table>
									</div>
								</div>
								<?php
								}
								?>

							</div>
						</div>

					</div>
				</div>


			</div>
		</div>
	</div>



<?php
	$this->endSection('content'); 
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.list_cart{
			margin: 3px 0;
		}
		.list_cart a{
			border: 1px solid #ebeced;
			padding: 8px;
			display: block;
			border-radius: 0.25rem;
			color: #000;
		}
		.list_cart a:hover{
			background-color: #edeeef;
			color: #000;
		}
	</style>
	<style>
		.table th {
			color: #303e67;
			font-weight: 500;
			vertical-align: middle;
			border-color: #4f4f4f;
			background-color: #f8f8f8;
		}
		.table-box {
			width: 100%;
			border: 1px solid  #f2f2f2;
			border-radius: 0.35rem !important;
			padding: 8px;
		}
		.table td {
			border-color: #dee2e6 !important;
			/*border-width: 1px !important;*/
			vertical-align: middle;
			min-height: 32px;
		}

		div.dataTables_wrapper div.dataTables_length select {
			width: auto;
			display: inline-block;
			padding-top: 0.25rem !important;
			padding-bottom: 0.25rem !important;
			padding-left: 0.5rem !important;
			padding: 0.375rem 2.25rem 0.375rem 0.75rem !important;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button {
			padding: 0 !important;
			margin-left: 2px !important;
			border: 0px solid transparent !important;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
			border: 0px solid #fff !important;
			background-color: #585858 !important;
			background-color: #ffffff !important;
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #ffffff));
			background: -webkit-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: -moz-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: -ms-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: -o-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: linear-gradient(to bottom, #ffffff 0%, #ffffff 100%);
			box-shadow: inset 0 0 3px #ffffff;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button:active {
			outline: none;
			background-color: #ffffff !important;
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #ffffff)) !important;
			background: -webkit-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: -moz-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: -ms-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: -o-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: linear-gradient(to bottom, #ffffff 0%, #ffffff 100%) !important;
			box-shadow: inset 0 0 3px #ffffff !important;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<style>
		.bg-img{
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;		
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



		.card.card-green{ border: 1px solid rgb(61 207 61 / 80%) !important; }
		.card.card-green .card-header{ background-color: #eeffed; }
		.card.card-green .body-color{ background-color: #eeffed; border-radius: .35rem !important; }
		.card.card-green .card-icon-circle{ background-color: #ffffff; border: 1px solid rgb(61 207 61 / 80%) !important; }

		.card.card-orange{ border: 1px solid rgb(255 196 128 / 80%) !important; }
		.card.card-orange .card-header{ background-color: #fffbd9; }
		.card.card-orange .body-color{ background-color: #fffbd9; border-radius: .35rem !important; }
		.card.card-orange .card-icon-circle{ background-color: #ffffff; border: 1px solid rgb(255 196 128 / 80%) !important; }

		.card.card-red{ border: 1px solid rgb(253 153 153 / 80%) !important; }
		.card.card-red .card-header{ background-color: #fff1f1; }
		.card.card-red .body-color{ background-color: #fff1f1; border-radius: .35rem !important; }
		.card.card-red .card-icon-circle{ background-color: #ffffff; border: 1px solid rgb(253 153 153 / 80%) !important; }

		.card.card-blue{ border: 1px solid rgb(136 185 227 / 80%) !important; }
		.card.card-blue .card-header{ background-color: #c8ecf7; }
		.card.card-blue .body-color{ background-color: #c8ecf7; border-radius: .35rem !important; }
		.card.card-blue .card-icon-circle{ background-color: #ffffff; border: 1px solid rgb(136 185 227 / 80%) !important; }

		.card.card-pink{ border: 1px solid rgb(225 105 162 / 80%) !important; }
		.card.card-pink .card-header{ background-color: #e7daf1; }
		.card.card-pink .body-color{ background-color: #e7daf1; border-radius: .35rem !important; }
		.card.card-pink .card-icon-circle{ background-color: #ffffff; border: 1px solid rgb(225 105 162 / 80%) !important; }

		.card-icon-circle {
			font-size: 28px;
			width: 52px;
			height: 52px;
			align-items: center;
			justify-content: center;
			display: flex;
			border-radius: 50%;
		}

		.card.card-indic{
			padding: 32px 16px;
			border: 0;
			background-color: #eee;
			text-align: center;		
		}
		.card.card-indic h4{ 
			margin: 0;
			margin-bottom: 10px;
			font-size: 1.2rem;
			font-weight: normal;		
		}
		.card.card-indic h3{ margin: 0; font-size: 1.5rem; }


		.card-indic-gen{ }
		.card-indic-gen .itemGen{ 
			width: 25%; 
			border: 1px dotted #FFFFFF; 
			border-radius: 4px; 
			margin-right: 4px; 
			padding: 12px 2px; 
		}
		.card-indic-gen .itemGen:last-child{ margin-right: 0px; }
		.card-indic-gen .itemGen .txt{ line-height: 1.1; }
		.card-indic-gen .itemGen h3{ margin-top: 4px; }


		.card.card-resultitens{
			height: auto;
			border-radius: 8px;
			border: 1px solid #dbdbdb;
			border: 1.5px solid #5356FB30 !important;
			background-color: #fafafa;
			/*padding: 16px;*/
			margin-bottom: 12px;
		}
		.card.card-resultitens.active{
			background-color: #e2fff3;
		}
		.card.card-resultitens .card-body{
			padding: 1rem 0rem !important;
		}

		.itemDots{
			position: relative;
			margin-right: 12px;		
		}
		.itemDots:not(:last-child):after {
			content: "\2022";
			margin-left: 12px;
			color: #6C6D70;
		}

		.list-grupo-info{}
		.list-grupo-info li{ display: flex; }
		.list-grupo-info li .label{ font-size: 1rem; font-weight: 600; }
		.list-grupo-info li .value{ padding-left:10px; font-size: 1rem; font-weight: lighter; }

		.list-partc{}
		.list-partc .item{ margin-bottom: 4px; }
		.list-partc .item span{ display: block; font-size: .6rem; color: gray; }

		.table-participantes td{ font-size: .75rem; }
		.table-participantes thead tr { background-color: #e8e8e8; }
		.table-participantes thead tr td{ font-weight: bold; }


		.accordion-button {
			font-size: .90rem;
			padding: .5rem 1rem;
			border-radius: 4px;
		}
		.accordion-body {
			padding: 2px 0;
		}
	</style>




	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/jquery.dataTables.css" rel="stylesheet">
	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<script>
		let LIST_CATEGORIA = [];
	</script>

	<script>
		//function converterData(data) {
		//	var partes = data.split("/");
		//	var dataFormatada = partes[2] + "-" + partes[1] + "-" + partes[0];
		//	return dataFormatada;
		//}

		//var dataBrasileira = "18/05/2023";
		//var dataAmericana = converterData(dataBrasileira);
		//console.log(dataAmericana); // Saída: 2023-05-18
		$(document).ready(function () {
			
			$(document).on('click', '.cmdFiltrar', function (e) {
				e.preventDefault();

				let $bsc_vendedor = $("#bsc_vendedor").val();
				let $bsc_cliente = $("#bsc_cliente").val();
				let $bsc_data_inicial = $("#bsc_data_inicial").val();
				let $bsc_data_final = $("#bsc_data_final").val();
				let $bsc_status = $("#bsc_status").val();

				let $url = '';
				if( $bsc_vendedor.length > 0 )	{ $url = $url +'/vendedor:'+ $bsc_vendedor; }
				if( $bsc_cliente.length > 0 )	{ $url = $url +'/cliente:'+ $bsc_cliente; }
				if( $bsc_data_inicial.length > 0 )	{ $url = $url +'/data_inicial:'+ ($bsc_data_inicial); }
				if( $bsc_data_final.length > 0 )	{ $url = $url +'/data_final:'+ ($bsc_data_final); }
				if( $bsc_status.length > 0 )	{ $url = $url +'/status:'+ $bsc_status; }

				//console.log( painel_url  +'historico/filtrar'+ $url );
				window.location.href = painel_url  +'historico/filtrar'+ $url;
				return false;
			});
			$(document).on('click', '.cmdUpdateStatus', function (e) {
				e.preventDefault();

				let $this = $(this);
				let $codigo = $this.data( "codigo" );
				let $msg = $( ".msg-email" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Confirme a alteração de status deste pedido.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							venda_id: $codigo
						};

						$msg.html('Aguarde. Estamos processando').show();
						$.ajax({
							url: painel_url  +'pedidos/ajaxform/ALTERAR-STATUS',
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
								//console.log('3 complete');
								//console.log(response);
							},
							success:function(response){
								console.log('2 success');
								console.log(response);
								$msg.html(response.error_msg).show();
							},
							error: function (jqXHR, textStatus, errorThrown) {
							}
						});
						// ------------------------------------------------------
					}
				});
			});
			$(document).on('click', '.cmdArquivarRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $codigo = $this.data( "codigo" );
				let $row = $this.closest( ".trRow" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Confirme o arquivamento deste pedido.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							codigo: $codigo
						};

						$.ajax({
							url: painel_url  +'historico/ajaxform/ARQUIVAR-REGISTRO',
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
							},
							error: function (jqXHR, textStatus, errorThrown) {
								console.log('4 error');
								console.log(errorThrown);
							}
						});
						// ------------------------------------------------------
					}
				});
			});
			$(document).on('click', '.cmdExcluirRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $hashkey = $this.data( "codigo" );
				let $row = $this.closest( ".trRow" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registros. <br>'+
						'Esta ação não poderá ser revertida.<br>'+
						'Deseja continuar assim mesmo?',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Desejo Excluir',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							curso_hashkey: $hashkey
						};

						$.ajax({
							url: painel_url  +'cursos/ajaxform/EXCLUIR-REGISTRO',
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
							},
							error: function (jqXHR, textStatus, errorThrown) {
								console.log('4 error');
								console.log(errorThrown);
							}
						});
						// ------------------------------------------------------
					}
				});
			});

			$(document).on('click', '.cmdSendMail', function (e) {
				e.preventDefault();

				let $this = $(this);
				let $partc_hashkey = $this.data( "partchashkey" );
				let $grevthashkey = $this.data( "grevthashkey" );
				//let $msg = $( ".msg-email" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Confirme o envio do email para validação das autorizações.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							partc_hashkey: $partc_hashkey,
							grevt_hashkey: $grevthashkey,
						};

						//$msg.html('Aguarde. Estamos processando').show();
						$.ajax({
							url: painel_url  +'particautorizacoes/ajaxform/REENVIAR-EMAIL-TERMOS',
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
								//console.log('3 complete');
								//console.log(response);
							},
							success:function(response){
								console.log('2 success');
								console.log(response);
								//$msg.html(response.error_msg).show();
							},
							error: function (jqXHR, textStatus, errorThrown) {
							}
						});
						// ------------------------------------------------------
					}
				});
			});

			var table = $('#example2').DataTable({
				"pageLength": 100,
				order: [[ 0, "desc" ]],
				responsive: true,
				searching: false,
				paging: true,
				pagingType: "full_numbers",
				fixedHeader: {
					header: true,
					footer: false
				},
				"language": {
					"search": "Procurar",
					"lengthMenu": "Mostrar _MENU_ registro por página",
					"zeroRecords": "Nothing found - sorry",
					"info": "Monstrando _PAGE_ de _PAGES_",
					"infoEmpty": "Sem registros disponíveis",
					"infoFiltered": "(filtered from _MAX_ total records)",
					"oPaginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
					},
				}
			});
			//new $.fn.dataTable.FixedHeader( table );
		});
	</script>


<?php $this->endSection('scripts'); ?>