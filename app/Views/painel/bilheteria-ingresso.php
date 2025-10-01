<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Ingresso</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default mb-3">
							<div class="card-body py-3">

								<div class="d-flex justify-content-end text-end">
									<div><a href="javascript:;"><img src="assets/images/impressora.png" style="max-height: 24px;" /> Imprimir Ingresso</a></div>
								</div>

								<!-- Logotipo -->
								<div class="container mb-3">
									<div class="row justify-content-between align-items-end">
										<div class="col-12 col-md-2">
											<img src="assets/media/logotipo.png" class="img-fluid" style="max-height: 90px;" />
										</div>
										<div class="col-12 col-md-6 text-end">
											<h3 class="m-0">Pedido Número: #000125564</h3>
										</div>
									</div>
								</div>

								<!-- VIA DO EVENTO -->
								<div class="card card-resultitens mb-4">
									<div class="card-body">
										<div class="d-flex ">

											<div class="container">
												<div class="row justify-content-between align-items-center mb-4">
													<div class="col-12 col-lg-12">
														<h3 class="mb-2" style="font-size: 28px;">Dança Contemporânea</h3>
														<h4>Ana Cláudia Carvalho</h4>
													</div>
												</div>
												<div class="row justify-content-between align-items-center mb-1">
													<div class="col-12 col-lg-9">
														<h5 style="font-weight: normal;">Centro Cultural Parauapebas, Rua 1 (Quadra Especial) S/N, Alvorá, Parauapebas, PA 68515-000, Brasil</h5>

														<div class="pt-4" style="line-height: 1.5">
															<h4 class="mb-1">Horários</h4>
															<div>Quarta-feira, 20 de setembro de 2023 às 08:00</div>
															<div>Domingo, 24 de setembro de 2023 às 20:00</div>
															<div>(Horário Padrão de Brasília Horário Brasil (Belém))</div>
														</div>

														<div class="row justify-content-between align-items-center mt-2">
															<div class="col-12 col-md-6">
																<div class="pt-4" style="line-height: 1.5">
																	<h5 class="mb-1">Informações do Pedido</h4>
																	<div>Pedido número: #000125564</div>
																	<div>Método de pagamento: Mercado Pago</div>
																	<!-- <div>Status</div> -->
																</div>
															</div>
															<div class="col-12 col-md-6">
																<div class="pt-4" style="line-height: 1.5">
																	<h5 class="mb-1">Informações do Comprador</h4>
																	<div>Lívia Regina de Castro Oliveira</div>
																	<div>CPF: 123.123.123-87</div>
																</div>
															</div>
														</div>

													</div>
													<div class="col-12 col-md-auto align-self-end"">
														<div class="d-flex flex-column text-center" style="padding: 10px 20px;">
															<div>
																<img src="assets/media/qrcode-credenciamento.png" class="img-fluid" style="max-height: 125px;">
															</div>
															<div style="font-weight: bold;">775890291912721160339001</div>
														</div>
													</div>
												</div>
												<div class="row justify-content-between align-items-center mb-1">
													<div class="col-12 col-lg-9">
														<div class="carditens-observacao mt-3">
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>

								<div class="" style="border-bottom: 2px dashed #a1a1a1;"></div>

								<!-- VIA DO INSCRITO -->
								<div class="card card-resultitens mt-4">
									<div class="card-body">
										<div class="d-flex ">

											<div class="container">
												<div class="row justify-content-between align-items-center mb-2">
													<div class="col-12 col-lg-12">
														<h3 class="mb-2" style="font-size: 28px;">Dança Contemporânea</h3>
														<h4>Ana Cláudia Carvalho</h4>
													</div>
												</div>
												<div class="row justify-content-between align-items-center mb-1">
													<div class="col-12 col-md-9">
														<h5 style="font-weight: normal;">Centro Cultural Parauapebas, Rua 1 (Quadra Especial) S/N, Alvorá, Parauapebas, PA 68515-000, Brasil</h5>

														<div class="pt-4" style="line-height: 1.5">
															<h4 class="mb-1">Horários</h4>
															<div>Quarta-feira, 20 de setembro de 2023 às 08:00</div>
															<div>Domingo, 24 de setembro de 2023 às 20:00</div>
															<div>(Horário Padrão de Brasília Horário Brasil (Belém))</div>
														</div>
													</div>
													<div class="col-12 col-md-auto">
														
														<div class="d-flex flex-column text-center" style="padding: 10px 20px;">
															<div>
																<img src="assets/media/qrcode-credenciamento.png" class="img-fluid" style="max-height: 125px;">
															</div>
															<div style="font-weight: bold;">775890291912721160339001</div>
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
			vertical-align: top;
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
			border: 2px solid #5356FB30 !important;
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
		.carditens-observacao{
			height: 150px;
			background-color: #FFFFFF;
			border: 2px solid gray;
			border-radius: 4px;
			border: 2px solid #5356FB30 !important;		
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