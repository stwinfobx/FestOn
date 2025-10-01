<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col">
				<h2 class="page-title">Participantes</h2>
			</div>
			<div class="col-auto">
				<?php 
					$w_data['etapa'] = 'participantes';
					$inputFile = view('painel/widgets/etapas-cadastro', $w_data);
					echo( $inputFile );
				?>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<!-- <FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsRegistro" id="formFieldsRegistro" enctype="multipart/form-data"> -->
				<?php 
				$attr_form = ['class' => '', 'id' => 'formFieldsRegistro', 'name' => 'formFieldsRegistro', 'csrf_id' => 'secucity' ];
				echo form_open_multipart( current_url(), $attr_form ); ?>
				<?php echo( csrf_field() ) ?>

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default">
							<div class="card-header-box">
								<div class="row align-items-center">
									<div class="col-12 col-md-6">
										
									</div>
									<div class="col-12 col-md-6">

										<div class="d-flex justify-content-end">
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('participantes')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('coreografias')); ?>" class="btn btn-sm btn-warning">Finalizar</a></div>
										</div>

									</div>
								</div>
							</div>
							<div class="card-body">

								<div class="row">
									<div class="col-12 col-md-3">

										<div class="row mb-3">
											<div class="col-12">
												<div class="">
													<div class="text-center"><label class="form-label text-center">Foto do Participante</label></div>
													<input type="file" name="file_foto" id="file_foto" class="form-control files">
												</div>
												<div>
													<?php echo((isset($rs_dados->partc_file_foto) ? $rs_dados->partc_file_foto : ""));?>
												</div>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-12">
												<div class="">
													<div class="text-center"><label class="form-label text-center">Documento Frente</label></div>
													<input type="file" name="file_doc_frente" id="file_doc_frente" class="form-control files">
												</div>
												<div>
													<?php echo((isset($rs_dados->partc_file_doc_frente) ? $rs_dados->partc_file_doc_frente : ""));?>
												</div>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-12">
												<div class="">
													<div class="text-center"><label class="form-label text-center">Documento Verso</label></div>
													<input type="file" name="file_doc_verso" id="file_doc_verso" class="form-control files">
												</div>
												<div>
													<?php echo((isset($rs_dados->partc_file_doc_verso) ? $rs_dados->partc_file_doc_verso : ""));?>
												</div>
											</div>
										</div>

										<!--
										<div class="row mb-3">
											<div class="col-12">
												<div class="" style="width: 85%;">
													<div class="text-center"><label class="form-label text-center">Documento Frente</label></div>
													<input type="file" name="file_doc_frente" id="file_doc_frente" class="filer_input_photos_single">
												</div>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-12">
												<div class="" style="width: 85%;">
													<div class="text-center"><label class="form-label text-center">Documento Verso</label></div>
													<input type="file" name="file_doc_verso" id="file_doc_verso" class="filer_input_photos_single">
												</div>
											</div>
										</div>
										-->

										<div class="row">
											<div class="col-12">
												<?php 
													$partc_ativo = (int)((isset($rs_dados->partc_ativo) ? $rs_dados->partc_ativo : "1")); 
													$ativo_s = ($partc_ativo == "1" ? ' checked ' : '');
													$ativo_n = ($partc_ativo != "1" ? ' checked ' : '');
												?>
												<div class="form-group">
													<div><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
													<div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="partc_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
																<label class="custom-control-label" for="ativo_s">Sim</label>
															</div>
														</div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="partc_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
																<label class="custom-control-label" for="ativo_n">Não</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
									<div class="col-12 col-md-9">

										<div class="row">
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label class="form-label" for="partc_documento">Documento (CPF)</label>
													<input type="text" name="partc_documento" id="partc_documento" class="form-control mask-cpf cmdBlurDocumento" value="<?php echo((isset($rs_dados->partc_documento) ? $rs_dados->partc_documento : ""));?>" />
													<div class="text-center mt-1 divError" style="line-height: 1; display:none;">
														<small style="color: red;">CPF já foi cadastro em outro grupo/companhia</small>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label class="form-label" for="partc_nome">Nome</label>
													<input type="text" name="partc_nome" id="partc_nome" class="form-control" value="<?php echo((isset($rs_dados->partc_nome) ? $rs_dados->partc_nome : ""));?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="partc_nome_social">Nome Social</label>
													<input type="text" name="partc_nome_social" id="partc_nome_social" class="form-control" value="<?php echo((isset($rs_dados->partc_nome_social) ? $rs_dados->partc_nome_social : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<?php $partc_genero = (isset($rs_dados->partc_genero) ? $rs_dados->partc_genero : "");?>
												<div class="form-group">
													<label class="form-label" for="partc_genero">Gênero</label>
													<select class="form-select" name="partc_genero" id="partc_genero">
														<option value="" translate="no">- selecione -</option>
														<?php
														if( isset($arr_generos) ){
															foreach ($arr_generos as $key => $val) {
																$selected = (($partc_genero == $val['value']) ? 'selected' : '');
														?>
															<option value="<?php echo($val['value']); ?>" <?php echo($selected ); ?> translate="no"><?php echo($val['label']); ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-3">
												<?php 
													$partc_dte_nascto = (isset($rs_dados->partc_dte_nascto) ? $rs_dados->partc_dte_nascto : ""); 
													$partc_dte_nascto = fct_formatdate($partc_dte_nascto, 'd/m/Y');
												?>
												<div class="form-group">
													<label class="form-label" for="partc_dte_nascto">Data de Nascimento</label>
													<div class="position-relative d-flex align-items-center">
														<input type="text" name="partc_dte_nascto" id="partc_dte_nascto" class="form-control flatpickr_date" value="<?php echo($partc_dte_nascto);?>" style="padding-right: 3rem !important;" />
														<span class="position-absolute mx-4" style="right: 0;">
															<img src="assets/svg/icon-calendar.svg" />
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<?php 
													$_grp_id = (int)(isset($rs_dados->grp_id) ? $rs_dados->grp_id : "");
													$_grp_id = (int)(isset($rs_params->grp) ? $rs_params->grp : $_grp_id);
													$disabled = (isset($rs_params->grp) ? 'disabled' : '');
												?>
												<div class="form-group">
													<label class="form-label" for="grp_id">Grupo</label>
													<select class="form-select" name="grp_id" id="grp_id" <?php echo($disabled); ?> >
														<option value="" translate="no">- selecione -</option>
														<?php
														if( isset($rs_grupos)){
															foreach ($rs_grupos->getResult() as $row) {
																$grp_id = ($row->grp_id);
																$grp_titulo = ($row->grp_titulo);
																$selected = (($grp_id == $_grp_id) ? "selected" : "");
															?>
																<option value="<?php echo($grp_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($grp_titulo); ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<?php $_func_id = (int)(isset($rs_dados->func_id) ? $rs_dados->func_id : "");?>
												<div class="form-group">
													<label class="form-label" for="func_id">Função</label>
													<select class="form-select" name="func_id" id="func_id">
														<option value="" translate="no">- selecione -</option>
														<?php
														if( isset($rs_funcoes)){
															foreach ($rs_funcoes->getResult() as $row) {
																$func_id = ($row->func_id);
																$func_titulo = ($row->func_titulo);
																$selected = (($func_id == $_func_id) ? "selected" : "");
															?>
																<option value="<?php echo($func_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($func_titulo); ?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>

									</div>
								</div>

								<div class="row justify-content-center mt-5 ">
									<div class="col-12 col-md-4">
										<div class="d-grid w-100">
											<input type="submit" class="btn btn-sm btn-success" value="Salvar este cadastro">
										</div>
									</div>
								</div>

	
							</div>
						</div>

						<div class="card card-default mt-4">
							<div class="card-body">

								<div class="box-content">
									<div class="row">
										<div class="col-12">

											<?php
											if( isset($rs_list) ){
											?>
											<div class="table-box table-responsive">
												<table id="example2" class="display nowrap table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th class="text-center" style="width:110px;">Ação</th>
															<th style="width:50px;">ID</th>
															<th>Título / Grupo</th>
															<th class="text-center" style="width:90px;">Gênero</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$count = 0;
														foreach ($rs_list->getResult() as $row) {
															$count++;
															$partc_id = ($row->partc_id);
															$partc_hashkey = ($row->partc_hashkey);
															$partc_nome = ($row->partc_nome);
															$grp_titulo = ($row->grp_titulo);
															$partc_genero = ($row->partc_genero);

															$link_form = painel_url('participantes/form/'. $partc_id);
															$linkGerarPDF = painel_url();
														?>
															<tr class="trRow">
																<td class="text-center">
																	<div class="d-flex justify-content-center">
																		<div style="margin: 0 3px;">
																			<a href="<?php echo($link_form); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-file-alt"></i></a>
																		</div>
																		<div style="margin: 0 3px;">
																			<a href="javascript:;" class="btn btn-sm btn-ac btn-danger cmdExcluirRegistro" data-codigo="<?php echo($partc_hashkey); ?>"><i class="las la-trash"></i></a>
																		</div>
																	</div>
																</td>
																<td><?php echo($partc_id); ?></td>
																<td>
																	<div><strong><?php echo($partc_nome); ?></strong></div>
																	<div><?php echo($grp_titulo); ?></div>
																</td>
																<td class="text-center"><?php echo($partc_genero); ?></td>
															</tr>
														<?php
														}
													?>
													</tbody>
												</table>
											</div>

											<div class="row justify-content-center pt-4 pb-4 d-none">
												<div class="col-12 col-md-4">
													<div class="d-grid">
														<a href="<?php echo( $linkGerarPDF ); ?>" target="_blank" class="btn btn-sm btn-primary">Salvar em PDF</a>
													</div>
												</div>
											</div>
											<?php
											}else{
											?>
												<div class="table-box text-center" style="padding: 16px 8px;">
													<?php echo('Nenhum registro encontrado'); ?>
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

				<?php echo form_close(); ?>

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
	<!-- <script src="assets/painel/js/custom/documentation/forms/flatpickr-locale-br.js"></script> -->

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


		.divError{ display:none !important; }
		.divError.active{ display:block !important; }
	</style>

	<script src="assets/plugins/jquery-filer/js/jquery-filer.js" type="text/javascript"></script>
	<script src="assets/js/jquery-filer-custom.js" type="text/javascript"></script>

	<script>
	$(document).ready(function () {
		$('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",
			allowInput: true
		});
		$('.flatpickr_hour').flatpickr({
			"locale": "pt",
			enableTime: true,
			noCalendar: true,
			dateFormat:"H:i"
		});			
	});
	</script>


	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

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
							partc_hashkey: $hashkey
						};

						$.ajax({
							url: painel_url  +'participantes/ajaxform/EXCLUIR-REGISTRO',
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
			$(document).on('blur', '.cmdBlurDocumento', function (e) {
				e.preventDefault();
				let $partc_documento = $("#partc_documento").val();
				// ------------------------------------------------------
				let $formData = {
					partc_documento: $partc_documento
				};

				$.ajax({
					url: painel_url  +'participantes/ajaxform/VALIDAR-CPF',
					method:"POST",
					type: "POST",
					dataType: "json",
					data: $formData,
					crossDomain: true,
					beforeSend: function(response) {
						//console.log('1 beforeSend');
						//console.log(response);
					},
					complete: function(response) { 
						//console.log('3 complete');
						//console.log(response);
					},
					success:function(response){
						console.log('2 success');
						console.log(response);
						$(".divError").find('small').html('');
						$(".divError").removeClass('active');
						if( response.error_num == 1 ){
							$(".divError").find('small').html('CPF já foi cadastro em outro grupo/companhia..');
							$(".divError").addClass('active');
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						//console.log('4 error');
						//console.log(errorThrown);
					}
				});
				// ------------------------------------------------------
				return false;
			});
		});
	</script>


<?php $this->endSection('scripts'); ?>