<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
	
	$aba_ativa = (isset($aba_ativa) ? $aba_ativa : ''); 
	$link_principal = (empty($aba_ativa) ? 'active' : '');	
	$link_inscricoes = (($aba_ativa == 'inscricoes') ? 'active' : '');
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Workshops</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsRegistro" id="formFieldsRegistro" enctype="multipart/form-data">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default">
							<div class="card-header-box">
								<div class="row align-items-center">
									<div class="col-12 col-md-6">
										
									</div>
									<div class="col-12 col-md-6">

										<div class="d-flex justify-content-end">
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('workshops')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
											<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
										</div>

									</div>
								</div>
							</div>
							<div class="card-body">

								<ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link <?php echo($link_principal); ?>" id="link-principal" data-bs-toggle="tab" href="#tb-principal" role="tab" aria-controls="tb-principal" aria-selected="<?php echo($link_principal == 'active' ? 'true' : 'false' ); ?>">Dados Principais</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link <?php echo($link_inscricoes); ?>" id="link-inscricoes" data-bs-toggle="tab" href="#tb-inscricoes" role="tab" aria-controls="tb-inscricoes" aria-selected="<?php echo($link_inscricoes == 'active' ? 'true' : 'false' ); ?>">Inscrições</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-valores" data-bs-toggle="tab" href="#tb-valores" role="tab" aria-controls="tb-valores" aria-selected="false">Valores</a>
									</li>									
									<li class="nav-item d-none" role="presentation">
										<a class="nav-link" id="link-cobrancas" data-bs-toggle="tab" href="#tb-cobrancas" role="tab" aria-controls="tb-cobrancas" aria-selected="false">Cobranças</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-autorizacoes" data-bs-toggle="tab" href="#tb-autorizacoes" role="tab" aria-controls="tb-autorizacoes" aria-selected="false">Termos e Autoriz.</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-pagamentos" data-bs-toggle="tab" href="#tb-pagamentos" role="tab" aria-controls="tb-pagamentos" aria-selected="false">Pagamentos</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-configuracoes" data-bs-toggle="tab" href="#tb-configuracoes" role="tab" aria-controls="tb-configuracoes" aria-selected="false">Configurações</a>
									</li>
								</ul>
								<div class="tab-content pt-3" id="ex1-content">
									
									<!-- PRINCIPAL -->
									<div class="tab-pane fade show <?php echo($link_principal); ?>" id="tb-principal" role="tabpanel" aria-labelledby="link-principal">
										<?php 
											$include = view('painel/widgets/workshop-form-principal', []);
											echo( $include );
										?>
									</div>

									<!-- INSCRIÇÕES -->
									<div class="tab-pane fade show <?php echo($link_inscricoes); ?>" id="tb-inscricoes" role="tabpanel" aria-labelledby="link-inscricoes">
										<?php 
											$include = view('painel/widgets/workshop-form-inscricoes', []);
											echo( $include );
										?>
									</div>
									
									<!-- VALORES -->
									<div class="tab-pane fade show" id="tb-valores" role="tabpanel" aria-labelledby="link-valores">
										<?php 
											$include = view('painel/widgets/workshop-form-valores', []);
											echo( $include );
										?>
									</div>									

									<!-- COBRANCA -->
									<div class="tab-pane fade d-none" id="tb-cobrancas" role="tabpanel" aria-labelledby="link-cobrancas">
										<?php 
											$include = view('painel/widgets/workshop-form-cobrancas', []);
											echo( $include );
										?>
									</div>

									<!-- TERMOS E AUTORIZAÇÕES -->
									<div class="tab-pane fade " id="tb-autorizacoes" role="tabpanel" aria-labelledby="link-autorizacoes">
										<?php 
											$include = view('painel/widgets/workshop-form-autorizacoes', []);
											echo( $include );
										?>
									</div>

									<!-- PAGAMENTOS -->
									<div class="tab-pane fade" id="tb-pagamentos" role="tabpanel" aria-labelledby="link-pagamentos">
										<?php 
											$include = view('painel/widgets/workshop-form-pagamentos', []);
											echo( $include );
										?>
									</div>

									<!-- CONFIGURAÇÕES -->
									<div class="tab-pane fade" id="tb-configuracoes" role="tabpanel" aria-labelledby="link-configuracoes">
										<?php 
											$include = view('painel/widgets/workshop-form-configuracoes', []);
											echo( $include );
										?>
									</div>

								</div>

							</div>
						</div>

					</div>
				</div>

				</FORM>

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

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="assets/plugins/flatpickr/flatpickr-locale-br.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- Styles -->
	<link href="assets/plugins/jquery-filer/css/jquery-filer.css" rel="stylesheet">
	<link href="assets/plugins/jquery-filer/css/themes/jquery-filer-dragdropbox-theme.css" rel="stylesheet">
	
	<style>
		.box-img-principal{
			border:1px solid #e2e2e2; 
			border-radius: .25rem; 
			padding: 8px;
			box-shadow: 0 4px 10px 1px rgb(223 223 223 / 6%), 0 1px 4px rgb(0 0 0 / 4%) !important;
		}
		/* 
			PLUGIN DE UPLOAD DE ARQUIVOS 
		*/
		.jFiler-input-dragDrop.fileUnico {
			width: 100% !important;
			padding: 35px 20px !important;
			font-family: "Product Sans", sans-serif !important;
			background: #FAFAFA !important;
			border-radius: 30px !important;
			border: 1.5px solid #5356FB30 !important;
			margin: 0 !important;
			height: 200px !important;
		}
		.jFiler-input-dragDrop:hover{ background-color: #e0e8f5 !important; }
		.jFiler-input-dragDrop .jFiler-input-flex{
			display: flex !important;
			justify-content: center !important;
			align-items: center !important;
			flex-direction: column !important;
		}
		.jFiler-input-flex .jFiler-input-item{ margin: 0 5px !important; }
		.jFiler-input-flex .jFiler-input-item .jFiler-input-text h3 { font-size: 1rem !important; }

		.jFiler-items-grid .jFiler-item .jFiler-item-container {
			border-radius: 0.25rem !important;
			border-radius: 30px !important;
			margin: 0 !important;
			padding: 0 !important;
			height: 100% !important;
			background: #fff;
			background: #FAFAFA !important;
			-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			-moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			box-shadow: 0 4px 10px 1px rgb(223 223 223 / 6%), 0 1px 4px rgb(0 0 0 / 4%) !important;
		}

		/* 100 / 6 = 16.66667 */
		.grid-tile-wrapper.fileUnico {
			display: grid;
			grid-gap: 15px;
			grid-template-columns: repeat(auto-fit, minmax(calc(100% - 0px), calc(100% - 0px)));
			grid-auto-rows: 200px;
			grid-auto-flow: dense;
		}
		.grid-tile-item {
			grid-column: span 1;
			grid-row: span 1;
		}
		.jFiler-items-grid .jFiler-item .jFiler-item-container .jFiler-item-thumb {
			position: relative;
			width: 100% !important;
			height: 145px;
			min-height: 115px;
			overflow: hidden;
			border: 0px solid #e1e1e1;
			border-radius: 0.25rem;
			border-radius: 30px !important;
			border-bottom-left-radius: .25rem !important;
			border-bottom-right-radius: .25rem !important;
		}
	</style>

	<script src="assets/plugins/jquery-filer/js/jquery-filer.js" type="text/javascript"></script>
	<script src="assets/js/jquery-filer-custom.js" type="text/javascript"></script>



	<script>
		//let LIST_PRODUTOS = [];
		//let LIST_STATUS = [];
		//let CLIENTE_ID = '<?php echo( $cliente_id ); ?>';
	</script>

	<!-- VueJs -->
	<!-- <script src="assets/vue/vue.min.js"></script> -->
	<!-- <script src="assets/vue/axios.min.js"></script> -->
	<!-- <script src="assets/vue/carrinho.js"></script> -->


	<script>
		let LIST_CATEGORIA = [];
	</script>

	<script>
		$('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y"
		});
		$('.flatpickr_hour').flatpickr({
			"locale": "pt",
			enableTime: true,
			noCalendar: true,
			dateFormat:"H:i"
		});

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

			var table = $('#example2').DataTable({
				"pageLength": 100,
				order: [[ 0, "desc" ]],
				responsive: true,
				searching: true,
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

<?php $this->endSection('scripts'); ?>