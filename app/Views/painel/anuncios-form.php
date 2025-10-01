<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Anúncios</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

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
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('anuncios')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
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
													<div class="text-center"><label class="form-label text-center">Banner</label></div>
													<input type="file" name="file_banner" id="file_banner" class="form-control files">
												</div>
											</div>
										</div>
										<?php 
											$anunc_file_banner = (isset($rs_dados->anunc_file_banner) ? $rs_dados->anunc_file_banner : "");
											if( !empty($anunc_file_banner) ){
										?>
										<div class="row mb-3 trRow">
											<div class="col-12">
												<div class="" style="width: 85%;">
													<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
													<div class="jFiler">
														<div class="jFiler-items jFiler-row ">
															<div class="jFiler-items-list jFiler-items-grid grid-tile-wrapper fileUnico">
																<?php 
																	//$anunc_file_banner = (isset($rs_dados->anunc_file_banner) ? $rs_dados->anunc_file_banner : "");

																	//$arq_original = "marcio.listas.misterlab.jpg";
																	$extension = '';
																	$posicao_ponto = strrpos($anunc_file_banner, ".");
																	if (!$posicao_ponto === false) {
																		$extension = substr($anunc_file_banner, $posicao_ponto + 1);
																		$extension = strtolower($extension);
																	}
																	//$extension	= strtolower(substr(strrchr($anunc_file_banner, "."),1));
																	//$download_file = admin_url('renderimage/download/files-upload/'. $anunc_file_banner );

																	$file_type = getMediaType($anunc_file_banner);
																	$rgb = text2Color( $extension );

																	$f_file_css = "f-file";
																	switch ($file_type){
																	case "image":
																		$f_file_css = "f-image";
																		$f_file_ext = '';
																		//$bg_image = paine_url('renderimage/view/files-upload/'. $anunc_file_banner );
																		//$bg_image = "background-image: url('". $bg_image ."')";
																		$bg_image = base_url($folder_upload .'/'. $anunc_file_banner );
																		$html_file_type = '<img src="'. $bg_image .'" />';
																	break;
																	//case "video":
																	//	$f_file_css = "f-video";
																	//	$f_file_ext = '';
																	//	$html_file_type = '<span class="jFiler-icon-file f-video"><i class="icon-jfi-file-video"></i></span>';
																	//break;
																	//case "audio":
																	//	$f_file_css = "f-audio";
																	//	$f_file_ext = '';
																	//	$html_file_type = '<span class="jFiler-icon-file f-audio"><i class="icon-jfi-file-audio"></i></span>';
																	//break;
																	//default : // arquivos
																	//	$f_file_css = "f-file";
																	//	$f_file_ext = 'f-file-ext-'. $extension;
																	//	$html_file_type = '<span class="jFiler-icon-file f-file f-file-ext-'. $extension .'" style="background-color: '. $rgb .';">.'. $extension .'</span>';
																	//break;
																	}
																?>
																	<div class="jFiler-item grid-tile-item jFiler-no-thumbnail" style="">
																		<div class="jFiler-item-container">
																			<div class="jFiler-item-inner">
																				<div class="jFiler-item-thumb">
																					<div class="jFiler-item-status"></div>
																					<div class="jFiler-item-thumb-overlay">
																						<div class="jFiler-item-info">
																							<div style="display:table-cell;vertical-align: middle;">
																								<span class="jFiler-item-title"><b title="111-imoveis-wilden.pdf"><?php echo($anunc_file_banner); ?></b></span>
																								<span class="jFiler-item-others"><?php echo($file_type); ?></span>
																							</div>
																						</div>
																					</div>

																					<!--
																					Quando for Imagem, deve ser exibido como background
																					-->

																					<!-- <div class="jFiler-item-thumb-image"> -->
																					<!-- 	<span class="jFiler-icon-file f-video"><i class="icon-jfi-file-video"></i></span> -->
																					<!-- </div> -->
																					<!-- <div class="jFiler-item-thumb-image"> -->
																					<!-- 	<span class="jFiler-icon-file f-video " style="background-color: #f1bc6f;">.mp4</span> -->
																					<!-- </div> -->
																					<!-- <div class="jFiler-item-thumb-image"> -->
																					<!-- 	<span class="jFiler-icon-file f-audio"><i class="icon-jfi-file-audio"></i></span> -->
																					<!-- </div> -->

																					<div class="jFiler-item-thumb-image">
																						<?php echo($html_file_type); ?>
																					</div>
																				</div>
																				<div class="jFiler-item-assets jFiler-row">
																					<!-- <ul class="list-inline pull-left"> -->
																					<!-- 	<li> -->
																					<!-- 		<a href="<?php //echo($download_file); ?>" class="cmdDownloadFile" target="_blank"><i class="fas fa-download"></i> Download</a> -->
																					<!-- 	</li> -->
																					<!-- </ul> -->
																					<ul class="list-inline pull-right">
																						<li><a href="javascript:;" class="icon-jfi-trash cmdDeleteFile" data-hashkey="<?php //echo($arq_hashkey); ?>"></a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
															</div>
														</div>
													</div>
													<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
												</div>
											</div>
										</div>
										<?php 
											}
										?>

										<div class="row">
											<div class="col-12">
												<?php 
													$anunc_ativo = (int)((isset($rs_dados->anunc_ativo) ? $rs_dados->anunc_ativo : "1")); 
													$ativo_s = ($anunc_ativo == "1" ? ' checked ' : '');
													$ativo_n = ($anunc_ativo != "1" ? ' checked ' : '');
												?>
												<div class="form-group">
													<div><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
													<div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="anunc_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
																<label class="custom-control-label" for="ativo_s">Sim</label>
															</div>
														</div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="anunc_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
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
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="anunc_titulo">Título</label>
													<input type="text" name="anunc_titulo" id="anunc_titulo" class="form-control" value="<?php echo((isset($rs_dados->anunc_titulo) ? $rs_dados->anunc_titulo : "")); ?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="anunc_subtitulo">SubTítulo</label>
													<input type="text" name="anunc_subtitulo" id="anunc_subtitulo" class="form-control" value="<?php echo((isset($rs_dados->anunc_subtitulo) ? $rs_dados->anunc_subtitulo : "")); ?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="anunc_redirect">Link para redirecionamento</label>
													<input type="text" name="anunc_redirect" id="anunc_redirect" class="form-control" value="<?php echo((isset($rs_dados->anunc_redirect) ? $rs_dados->anunc_redirect : "")); ?>" />
												</div>
											</div>
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
		.boxInputFileBanner{ display: none; }
		.boxInputFileBanner.active{ display: block; }

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
			border-radius: 1rem !important;
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
			border-radius: 1rem !important;
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
			border-radius: 1rem !important;
			border-bottom-left-radius: .25rem !important;
			border-bottom-right-radius: .25rem !important;
		}
	</style>

	<script src="assets/plugins/jquery-filer/js/jquery-filer.js" type="text/javascript"></script>
	<script src="assets/js/jquery-filer-custom.js" type="text/javascript"></script>

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
		$('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",	
		});
		$('.flatpickr_date_multiple').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",
			mode: "multiple",
		});
		$('.flatpickr_hour').flatpickr({
			"locale": "pt",
			enableTime: true,
			noCalendar: true,
			dateFormat:"H:i"
		});

		$(document).on('click', '.cmdDeleteFile', function (event) {
			let $this = $(this);
			let $row = $this.closest( ".trRow" );
			let $hashkey = $this.data('hashkey');

			Swal.fire({
				title: 'Atenção!',
				icon: 'warning',
				html:
					'Você está prestes a excluir este registro. <br />' +
					'Esta ação não poderá ser revertida.',
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

					$('.boxInputFileBanner').addClass('active');
					$row.remove();

					/*
					// ------------------------------------------------------
					let formData = {
						arq_hashkey: $hashkey
					};
					//console.log('hash', SITE_URL_t  +'cadastros/ajaxform/EXCLUIR-CADASTRO/'+ $hashkey);
					//console.log($formData);
					//return false;
					$.ajax({
						url: SITE_URL +'cadastros/ajaxform/EXCLUIR-ARQUIVO',
						method:"POST",
						type: "POST",
						dataType: "json",
						data: formData,
						crossDomain: true,
						beforeSend: function(response) {
							console.log('1 beforeSend');
							console.log(response);
						},
						complete: function(response) { 
							//$("#DIV-LOADING").hide();
							console.log('3 complete');
							console.log(response);
						},
						success:function(response){
							console.log('2 success');
							console.log(response);

							$row.remove();
						},
						error: function (jqXHR, textStatus, errorThrown) {
						}
					});
					// ------------------------------------------------------
					*/
				}
			});
		});
	});
	</script>



	<script id="mstcGridDataEvento" type="text/x-jquery-tmpl">
		<div class="row {{trRow}}">
			<div class="col-12 col-md-6">
				<div class="form-group">
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="evdte_data[]" id="evdte_data_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
						<span class="position-absolute mx-4" style="right: 0;">
							<img src="assets/svg/icon-calendar.svg" />
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="form-group">
					<input type="text" name="evdte_hrs_ini[]" id="evdte_hrs_ini_{{item}}" class="form-control form-control-sm flatpickr_hour" value="" />
				</div>
			</div>
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$.ajaxSetup({cache: false});

		$(document).on('click', '.cmdAddNovaData', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridDataEvento").html();
			$('#BOX-CONTENT-DATA-EVENTOS').append(Mustache.render(template, templateData));

			let $el = $('#BOX-CONTENT-DATA-EVENTOS'); 	

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
			//$el.find(".mask-date-place").mask('00/00/0000', {placeholder: "dd/mm/yyyy", clearIfNotMatch: true});
			//$el.find('.mask-hours').mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});
		});
		$(document).on('click', '.cmdDeletarData', function (e) {
			return false;
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
						url: SITE_URL +'tarifarios/ajaxform/EXCLUIR-TARIFA',
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
							fct_count_item_agenda();
						},
						error: function (jqXHR, textStatus, errorThrown) {
						}
					});
					// ------------------------------------------------------
				}
			});
		}); 
		$(document).on('click', '.cmdRemoverData', function (e) {
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
					fct_count_item_agenda();
				}
			});
		});

		fct_count_item_grid_datas();
	});
	var fct_count_item_grid_datas = function(p, callback){
		let $box = $('#BOX-CONTENT-DATA-EVENTOS');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovaData" ).trigger( "click" );	
		}
	}
	var fct_count_item_grid_valores = function(p, callback){
		let $box = $('#BOX-CONTENT-DATA-EVENTOS');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovaData" ).trigger( "click" );	
		}
	}
	</script>




	<script id="mstcGridValorEvento" type="text/x-jquery-tmpl">
		<div class="row {{trRow}}">
			<div class="col-12 col-md-4">
				<div class="form-group">
					<select class="form-select form-select-sm" name="grp_id[]" id="grp_id_{{item}}">
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
			<div class="col-12 col-md-4">
				<div class="form-group">
					<input type="text" name="anunc_vlr_taxa_unic_comp[]" id="anunc_vlr_taxa_unic_comp__{{item}}" class="form-control form-control-sm mask-money" value="" />
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="curso_dte_inicio[]" id="curso_dte_inicio_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
						<span class="position-absolute mx-4" style="right: 0;">
							<img src="assets/svg/icon-calendar.svg" />
						</span>
					</div>
				</div>
			</div>
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$(document).on('click', '.cmdAddNovoValor', function (e) {
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
			//$el.find(".mask-date-place").mask('00/00/0000', {placeholder: "dd/mm/yyyy", clearIfNotMatch: true});
			//$el.find('.mask-hours').mask('00:00:00', {placeholder: "00:00:00", clearIfNotMatch: true});
		});
		$(document).on('click', '.cmdDeletarValor', function (e) {
			return false;
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
						url: SITE_URL +'tarifarios/ajaxform/EXCLUIR-TARIFA',
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
							fct_count_item_agenda();
						},
						error: function (jqXHR, textStatus, errorThrown) {
						}
					});
					// ------------------------------------------------------
				}
			});
		}); 
		$(document).on('click', '.cmdRemoverValor', function (e) {
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
					fct_count_item_agenda();
				}
			});
		});

		fct_count_item_grid_valores();
	});
	var fct_count_item_grid_valores = function(p, callback){
		let $box = $('#BOX-CONTENT-GRID-VALORES');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovoValor" ).trigger( "click" );	
		}
	}
	</script>

<?php $this->endSection('scripts'); ?>