<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

	//$vendedores_count = (isset($vendedores_count) ? $vendedores_count : 0);
	//$produtos_count = (isset($produtos_count) ? $produtos_count : 0);
	//$pedidos_count = (isset($pedidos_count) ? $pedidos_count : 0);

	//$session_id = (int)(isset($session_id) ? $session_id : ''); 
	//$session_nome =(isset($session_nome) ? $session_nome : ''); 
	//$session_permissao = (int)(isset($session_permissao) ? $session_permissao : ''); 
	//$session_label_permissao = (isset($session_label_permissao) ? $session_label_permissao : '');
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Cursos</h2>
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
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('cursos')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
											<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
										</div>

									</div>
								</div>
							</div>
							<div class="card-body">

								<div class="row ">
									<div class="col-12 col-md-3">

										<div class="row mb-3">
											<div class="col-12">
												<div class="" style="width: 85%;">
													<div class="text-center"><label class="form-label text-center">Foto do professor</label></div>
													<input type="file" name="files" id="file_foto_professor" class="filer_input_photos_single">
												</div>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-12">
												<div class="" style="width: 85%;">
													<div class="text-center"><label class="form-label text-center">Assinatura</label></div>
													<input type="file" name="files" id="file_assinatura" class="filer_input_photos_single">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12">
												<?php 
													$user_ativo = (int)((isset($rs_edit->user_ativo) ? $rs_edit->user_ativo : "1")); 
													$ativo_s = ($user_ativo == "1" ? ' checked ' : '');
													$ativo_n = ($user_ativo != "1" ? ' checked ' : '');
												?>
												<div class="form-group">
													<div ><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
													<div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="user_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
																<label class="custom-control-label" for="ativo_s">Sim</label>
															</div>
														</div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="user_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
																<label class="custom-control-label" for="ativo_n">Não</label>
															</div>
														</div>
													</div>
													<div><?php echo show_error($validation, 'user_ativo'); ?></div>
												</div>
											</div>
										</div>

									</div>
									<div class="col-12 col-md-9">

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="curso_titulo">Título do Curso</label>
													<input type="text" name="curso_titulo" id="curso_titulo" class="form-control" value="<?php echo((isset($rs_dados->curso_titulo) ? $rs_dados->curso_titulo : ""));?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="curso_nome_professor">Nome do Professor</label>
													<input type="text" name="curso_nome_professor" id="curso_nome_professor" class="form-control" value="<?php echo((isset($rs_dados->curso_nome_professor) ? $rs_dados->curso_nome_professor : ""));?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="curso_local">Local</label>
													<input type="text" name="curso_local" id="curso_local" class="form-control" value="<?php echo((isset($rs_dados->curso_local) ? $rs_dados->curso_local : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="curso_vagas">Vagas</label>
													<input type="text" name="curso_vagas" id="curso_vagas" class="form-control" value="<?php echo((isset($rs_dados->curso_vagas) ? $rs_dados->curso_vagas : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<?php 
													$curso_valor = (isset($rs_dados->curso_valor) ? $rs_dados->curso_valor : "0"); 
													$curso_valor = fct_to_money($curso_valor);
												?>
												<div class="form-group">
													<label class="form-label" for="curso_valor">Valor</label>
													<input type="text" name="curso_valor" id="curso_valor" class="form-control mask-money" value="<?php echo($curso_valor);?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">

												<div class="row">
													<div class="col-12 col-md-6">
														<?php 
															$curso_dte_inicio = (isset($rs_dados->curso_dte_inicio) ? $rs_dados->curso_dte_inicio : ""); 
															$curso_dte_inicio = fct_formatdate($curso_dte_inicio, 'd/m/Y');
														?>
														<div class="form-group">
															<label class="form-label" for="curso_dte_inicio">Data de Início <?php echo($curso_dte_inicio);?></label>
															<div class="position-relative d-flex align-items-center">
																<input type="text" name="curso_dte_inicio" id="curso_dte_inicio" class="form-control flatpickr_date" value="<?php echo($curso_dte_inicio);?>" style="padding-right: 3rem !important;" />
																<span class="position-absolute mx-4" style="right: 0;">
																	<img src="assets/svg/icon-calendar.svg" />
																</span>
															</div>
														</div>
													</div>
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="curso_hrs_inicio">Horário de Início</label>
															<input type="text" name="curso_hrs_inicio" id="curso_hrs_inicio" class="form-control" value="<?php echo((isset($rs_dados->curso_hrs_inicio) ? $rs_dados->curso_hrs_inicio : ""));?>" />
														</div>
													</div>
												</div>

											</div>
											<div class="col-12 col-md-6">

												<div class="row">
													<div class="col-12 col-md-6">
														<?php 
															$curso_dte_termino = (isset($rs_dados->curso_dte_termino) ? $rs_dados->curso_dte_termino : ""); 
															$curso_dte_termino = fct_formatdate($curso_dte_termino, 'd/m/Y');
														?>
														<div class="form-group">
															<label class="form-label" for="curso_dte_termino">Data de Início</label>
															<div class="position-relative d-flex align-items-center">
																<input type="text" name="curso_dte_termino" id="curso_dte_termino" class="form-control flatpickr_date" value="<?php echo($curso_dte_termino);?>" style="padding-right: 3rem !important;" />
																<span class="position-absolute mx-4" style="right: 0;">
																	<img src="assets/svg/icon-calendar.svg" />
																</span>
															</div>
														</div>
													</div>
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="curso_hrs_termino">Horário de Término</label>
															<input type="text" name="curso_hrs_termino" id="curso_hrs_termino" class="form-control" value="<?php echo((isset($rs_dados->curso_hrs_termino) ? $rs_dados->curso_hrs_termino : ""));?>" />
														</div>
													</div>
												</div>

											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="curso_conteudo">Conteúdo</label>
													<textarea type="text" name="curso_conteudo" id="curso_conteudo" class="form-control" style="height: 250px !important;"><?php echo((isset($rs_dados->curso_conteudo) ? $rs_dados->curso_conteudo : ""));?></textarea>
												</div>
											</div>
										</div>

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


<?php $this->endSection('scripts'); ?>