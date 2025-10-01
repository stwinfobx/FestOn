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

	$event_id = (int)(isset($event_id) ? $event_id : 0);
	//print_debug( $arr_forma_cobr_selected, '80px');
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Eventos</h2>
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
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('eventos')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
											<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
										</div>

									</div>
								</div>
							</div>
							<div class="card-body">
								<ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" id="link-principal" data-bs-toggle="tab" href="#tb-principal" role="tab" aria-controls="tb-principal" aria-selected="true">Dados do Evento</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-config" data-bs-toggle="tab" href="#tb-config" role="tab" aria-controls="tb-config" aria-selected="false">Configurações</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-valores" data-bs-toggle="tab" href="#tb-valores" role="tab" aria-controls="tb-valores" aria-selected="false">Valores</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-cobranca" data-bs-toggle="tab" href="#tb-cobranca" role="tab" aria-controls="tb-cobranca" aria-selected="false">Cobrança</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-termos" data-bs-toggle="tab" href="#tb-termos" role="tab" aria-controls="tb-termos" aria-selected="false">Termos e Autoriz.</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-inicial" data-bs-toggle="tab" href="#tb-inicial" role="tab" aria-controls="tb-inicial" aria-selected="false">Inicial</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-order-apresent" data-bs-toggle="tab" href="#tb-order-apresent" role="tab" aria-controls="tb-order-apresent" aria-selected="false">Ordem Apresentações</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-jurados" data-bs-toggle="tab" href="#tb-link-jurados" role="tab" aria-controls="tb-link-jurados" aria-selected="false">Jurados</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-ensaios" data-bs-toggle="tab" href="#tb-link-ensaios" role="tab" aria-controls="tb-link-ensaios" aria-selected="false">Ensaios</a>
									</li>
								</ul>
								<div class="tab-content pt-3" id="ex1-content">
									<!-- PRINCIPAL -->
									<div class="tab-pane fade show active" id="tb-principal" role="tabpanel" aria-labelledby="link-principal">
										<div class="row ">
											<div class="col-12 col-md-3">

												<div class="row mb-3">
													<div class="col-12">
														<div class="" style="width: 85%;">
															<div class="text-center"><label class="form-label text-center">Banner do Evento.</label></div>
															<input type="file" name="file_banner" id="file_banner" class="form-control files">
														</div>
													</div>
												</div>
												<?php 
													$event_banner = (isset($rs_dados->event_banner) ? $rs_dados->event_banner : "");
													//$hide_input_banner = ( !empty($event_banner) ? '' : 'active' );
													if( !empty($event_banner) ){
												?>
												<div class="row mb-3 trRow">
													<div class="col-12">
														<div class="" style="width: 85%;">
															<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
															<div class="jFiler">
																<div class="jFiler-items jFiler-row ">
																	<div class="jFiler-items-list jFiler-items-grid grid-tile-wrapper fileUnico">
																		<?php 
																			//$event_banner = (isset($rs_dados->event_banner) ? $rs_dados->event_banner : "");

																			//$arq_original = "marcio.listas.misterlab.jpg";
																			$extension = '';
																			$posicao_ponto = strrpos($event_banner, ".");
																			if (!$posicao_ponto === false) {
																				$extension = substr($event_banner, $posicao_ponto + 1);
																				$extension = strtolower($extension);
																			}
																			//$extension	= strtolower(substr(strrchr($event_banner, "."),1));
																			//$download_file = admin_url('renderimage/download/files-upload/'. $event_banner );

																			$file_type = getMediaType($event_banner);
																			$rgb = text2Color( $extension );

																			$f_file_css = "f-file";
																			switch ($file_type){
																			case "image":
																				$f_file_css = "f-image";
																				$f_file_ext = '';
																				//$bg_image = paine_url('renderimage/view/files-upload/'. $event_banner );
																				//$bg_image = "background-image: url('". $bg_image ."')";
																				$bg_image = base_url($folder_upload .'/'. $event_banner );
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
																										<span class="jFiler-item-title"><b title="111-imoveis-wilden.pdf"><?php echo($event_banner); ?></b></span>
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

												<div class="row mb-3">
													<div class="col-12">
														<div class="" style="width: 85%;">
															<div class="text-center"><label class="form-label text-center">Regulamento (PDF)</label></div>
															<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
														</div>
													</div>
												</div>
												<?php 
													$event_regulamento = (isset($rs_dados->event_regulamento) ? $rs_dados->event_regulamento : "");
													//$hide_input_banner = ( !empty($event_banner) ? '' : 'active' );
													if( !empty($event_regulamento) ){
												?>
												<div class="row mb-3 trRow">
													<div class="col-12">
														<div class="" style="width: 85%;">
															<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
															<div class="jFiler">
																<div class="jFiler-items jFiler-row ">
																	<div class="jFiler-items-list jFiler-items-grid grid-tile-wrapper fileUnico">
																		<?php 
																			//$event_banner = (isset($rs_dados->event_banner) ? $rs_dados->event_banner : "");

																			//$arq_original = "marcio.listas.misterlab.jpg";
																			$extension = '';
																			$posicao_ponto = strrpos($event_regulamento, ".");
																			if (!$posicao_ponto === false) {
																				$extension = substr($event_regulamento, $posicao_ponto + 1);
																				$extension = strtolower($extension);
																			}
																			//$extension	= strtolower(substr(strrchr($event_regulamento, "."),1));
																			//$download_file = admin_url('renderimage/download/files-upload/'. $event_regulamento );

																			$file_type = getMediaType($event_regulamento);
																			$rgb = text2Color( $extension );

																			$f_file_css = "f-file";
																			switch ($file_type){
																			case "image":
																				$f_file_css = "f-image";
																				$f_file_ext = '';
																				//$bg_image = paine_url('renderimage/view/files-upload/'. $event_regulamento );
																				//$bg_image = "background-image: url('". $bg_image ."')";
																				$bg_image = base_url($folder_upload .'/'. $event_regulamento );
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
																			default : // arquivos
																				$f_file_css = "f-file";
																				$f_file_ext = 'f-file-ext-'. $extension;
																				$html_file_type = '<span class="jFiler-icon-file f-file f-file-ext-'. $extension .'" style="background-color: '. $rgb .';">.'. $extension .'</span>';
																			break;
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
																										<span class="jFiler-item-title"><b title="111-imoveis-wilden.pdf"><?php echo($event_regulamento); ?></b></span>
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
															$event_ativo = (int)((isset($rs_dados->event_ativo) ? $rs_dados->event_ativo : "1")); 
															$ativo_s = ($event_ativo == "1" ? ' checked ' : '');
															$ativo_n = ($event_ativo != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
																		<label class="custom-control-label" for="ativo_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
																		<label class="custom-control-label" for="ativo_n">Não</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

											</div>
											<div class="col-12 col-md-9">
												
												<div class="row justify-content-end">
													<div class="col-12 col-md-3 justify-content-end">
														<?php 
															$event_encerrar_inscricoes = (int)(isset($rs_dados->event_encerrar_inscricoes) ? $rs_dados->event_encerrar_inscricoes : "");
															$checked = (($event_encerrar_inscricoes == 1) ? 'checked' : '');
														?>
														<div class="d-flex justify-content-end">
															<div class="">
																<input id="event_encerrar_inscricoes" name="event_encerrar_inscricoes" type="checkbox" class="switch" value="1" <?php echo($checked); ?> />
																<label for="event_encerrar_inscricoes">Encerrar Inscrições?</label>
															</div>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_titulo">Nome do Evento</label>
															<input type="text" name="event_titulo" id="event_titulo" class="form-control" value="<?php echo((isset($rs_dados->event_titulo) ? $rs_dados->event_titulo : "")); ?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-5">

														<div class="row">
															<div class="col-12 col-md-12">
																<div class="form-group">
																	<label class="form-label" for="event_limit_coreografia">Limite de Coreografias</label>
																	<input type="text" name="event_limit_coreografia" id="event_limit_coreografia" class="form-control" value="<?php echo((isset($rs_dados->event_limit_coreografia) ? $rs_dados->event_limit_coreografia : ""));?>" />
																</div>
															</div>
															<div class="col-12 col-md-12">
																<div class="form-group">
																	<label class="form-label" for="event_limit_participantes">Limite de Participantes</label>
																	<input type="text" name="event_limit_participantes" id="event_limit_participantes" class="form-control" value="<?php echo((isset($rs_dados->event_limit_participantes) ? $rs_dados->event_limit_participantes : ""));?>" />
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-12 col-md-12">
																<?php 
																	$event_show_result_site = (int)((isset($rs_dados->event_show_result_site) ? $rs_dados->event_show_result_site : "1")); 
																	$show_result_s = ($event_show_result_site == "1" ? ' checked ' : '');
																	$show_result_n = ($event_show_result_site != "1" ? ' checked ' : '');
																?>
																<div class="form-group">
																	<div><label class="form-label">Exibir Resultado no Site?</label></div>
																	<div>
																		<div class="form-check-inline my-1">
																			<div class="custom-control custom-radio">
																				<input type="radio" name="event_show_result_site" id="show_result_s" class="custom-control-input" value="1" <?php echo($show_result_s)?> />
																				<label class="custom-control-label" for="show_result_s">Sim</label>
																			</div>
																		</div>
																		<div class="form-check-inline my-1">
																			<div class="custom-control custom-radio">
																				<input type="radio" name="event_show_result_site" id="show_result_n" class="custom-control-input" value="0" <?php echo($show_result_n)?> />
																				<label class="custom-control-label" for="show_result_n">Não</label>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-12 col-md-12">
																<?php 
																	$event_permite_votacao = (int)((isset($rs_dados->event_permite_votacao) ? $rs_dados->event_permite_votacao : "1")); 
																	$votacao_s = ($event_permite_votacao == "1" ? ' checked ' : '');
																	$votacao_n = ($event_permite_votacao != "1" ? ' checked ' : '');
																?>
																<div class="form-group">
																	<div><label class="form-label">Permitir Votação?</label></div>
																	<div>
																		<div class="form-check-inline my-1">
																			<div class="custom-control custom-radio">
																				<input type="radio" name="event_permite_votacao" id="votacao_s" class="custom-control-input" value="1" <?php echo($votacao_s)?> />
																				<label class="custom-control-label" for="votacao_s">Sim</label>
																			</div>
																		</div>
																		<div class="form-check-inline my-1">
																			<div class="custom-control custom-radio">
																				<input type="radio" name="event_permite_votacao" id="votacao_n" class="custom-control-input" value="0" <?php echo($votacao_n)?> />
																				<label class="custom-control-label" for="votacao_n">Não</label>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>

													</div>
													<div class="col-12 col-md-7">
														<div class="card card-base mb-3">
															<div class="card-header">
																Grade de Datas e Horários
															</div>
															<div class="card-body">
																<div class="row">
																	<div class="col-12 col-md-6">
																		<div class="form-group m-0">
																			<label class="form-label">Data do Evento</label>
																		</div>
																	</div>
																	<div class="col-12 col-md-5">
																		<div class="form-group m-0">
																			<label class="form-label">Horário Inicial</label>
																		</div>
																	</div>
																	<div class="col-12 col-md-1 text-center">
																		<div class="form-group m-0">
																			<label class="form-label">Ação</label>
																		</div>
																	</div>
																</div>
																<div id="BOX-CONTENT-DATA-EVENTOS">
																	<?php
																	if( isset($rs_dados_datas) ){
																	?>
																		<?php
																			$xCount = 0;
																			foreach ($rs_dados_datas->getResult() as $rowEvDte) {
																				$xCount++;
																				$evdte_id = (int)$rowEvDte->evdte_id;
																				$evdte_hashkey = ($rowEvDte->evdte_hashkey);
																				$evdte_data = ($rowEvDte->evdte_data);
																				$evdte_data = fct_formatdate($rowEvDte->evdte_data, 'd/m/Y');
																				$evdte_hrs_ini = ($rowEvDte->evdte_hrs_ini);
																			?>
																				<div class="row trRow">
																					<div class="col-12 col-md-6">
																						<div class="form-group">
																							<div class="position-relative d-flex align-items-center">
																								<input type="text" name="evdte_data[]" id="evdte_data_<?php echo($xCount)?>" class="form-control form-control-sm flatpickr_date" value="<?php echo($evdte_data)?>" style="padding-right: 3rem !important;" />
																								<span class="position-absolute mx-4" style="right: 0;">
																									<img src="assets/svg/icon-calendar.svg" />
																								</span>
																							</div>
																						</div>
																					</div>
																					<div class="col-12 col-md-5">
																						<div class="form-group">
																							<input type="text" name="evdte_hrs_ini[]" id="evdte_hrs_ini_<?php echo($xCount)?>" class="form-control form-control-sm flatpickr_hour" value="<?php echo($evdte_hrs_ini)?>" />
																						</div>
																					</div>
																					<div class="col-12 col-md-1 text-center align-self-center">
																						<a href="javascript:;" class="cmdDeletarData" data-hashkey="<?php echo($evdte_hashkey); ?>" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
																						<input type="hidden" name="evdte_id[]" id="evdte_id_<?php echo($xCount)?>" value="<?php echo($evdte_id)?>" />
																					</div>
																				</div>
																			<?php
																			}
																		?>
																	<?php
																	}
																	?>
																</div>

																<div class="d-flex justify-content-end">
																	<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovaData">Adicionar Nova Data</a></div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="row mt-3">
													<div class="col-12 col-md-12">

														<div class="card card-base mb-3">
															<div class="card-header">
																Grade de Datas e Horários de Ensaios
															</div>
															<div class="card-header" style="background-color: #e9e9e9; border-radius: 0;">
																<div>
																	<div class="row g-2 trRow">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<label class="form-label">Início de Agendamentos</label>
																				<div class="position-relative d-flex align-items-center">
																					<input type="text" name="evdte_dte_abert_ini" id="evdte_dte_abert_ini" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
																					<span class="position-absolute mx-2" style="right: 0;">
																						<img src="assets/svg/icon-calendar.svg" />
																					</span>
																				</div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<label class="form-label">Término de Agendamentos</label>
																				<div class="position-relative d-flex align-items-center">
																					<input type="text" name="evdte_dte_abert_end" id="evdte_dte_abert_end" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
																					<span class="position-absolute mx-2" style="right: 0;">
																						<img src="assets/svg/icon-calendar.svg" />
																					</span>
																				</div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<?php 
																				$event_multiplicado_ensaio = (isset($rs_dados->event_multiplicado_ensaio) ? $rs_dados->event_multiplicado_ensaio : "1");
																			?>
																			<div class="form-group">
																				<label class="form-label" for="event_multiplicado_ensaio">Multiplicador (tempo do ensaio)</label>
																				<input type="text" name="event_multiplicado_ensaio" id="event_multiplicado_ensaio" class="form-control text-center only-number" value="<?php echo($event_multiplicado_ensaio);?>" />
																			</div>
																		</div>
																	</div>
																</div>

																<div class="row">
																	<div class="col-12 col-md-12">
																		<?php 
																			$event_tipo_agend = (int)((isset($rs_dados->event_tipo_agend) ? $rs_dados->event_tipo_agend : "1")); 
																			$tipoagend_result_s = ($event_tipo_agend == "1" ? ' checked ' : '');
																			$tipoagend_result_n = ($event_tipo_agend != "1" ? ' checked ' : '');
																		?>
																		<div class="form-group">
																			<div><label class="form-label">Tipo de Agendamento</label></div>
																			<div>
																				<div class="form-check-inline my-1">
																					<div class="custom-control custom-radio">
																						<input type="radio" name="event_tipo_agend" id="tipoagend_result_s" class="custom-control-input" value="1" <?php echo($tipoagend_result_s)?> />
																						<label class="custom-control-label" for="tipoagend_result_s">Geral</label>
																					</div>
																				</div>
																				<div class="form-check-inline my-1">
																					<div class="custom-control custom-radio">
																						<input type="radio" name="event_tipo_agend" id="tipoagend_result_n" class="custom-control-input" value="0" <?php echo($tipoagend_result_n)?> />
																						<label class="custom-control-label" for="tipoagend_result_n">Multi Datas</label>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>

															</div>
															<div class="card-body">
																<div class="row g-2">
																	<div class="col-12 col-md-2">
																		<div class="form-group m-0">
																			<label class="form-label">Data do Ensaio</label>
																		</div>
																	</div>
																	<div class="col-12 col-md-4">
																		<div class="row g-2">
																			<div class="col-12 col-md-6">
																				<div class="form-group m-0">
																					<label class="form-label">Horário Inicial</label>
																				</div>
																			</div>
																			<div class="col-12 col-md-6">
																				<div class="form-group m-0">
																					<label class="form-label">Horário Final</label>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-12 col-md-5">
																		<div class="form-group m-0">
																			<label class="form-label">Categorias</label>
																		</div>
																	</div>
																	<div class="col-12 col-md-1 text-center">
																		<div class="form-group m-0">
																			<label class="form-label">Ação</label>
																		</div>
																	</div>
																</div>
																<div id="BOX-CONTENT-DATA-ENSAIOS">
																	<?php
																	if( isset($rs_dados_datas) ){
																	?>
																		<?php
																			$xCount = 0;
																			foreach ($rs_dados_datas->getResult() as $rowEvDte) {
																				$xCount++;
																				$evdte_id = (int)$rowEvDte->evdte_id;
																				$evdte_hashkey = ($rowEvDte->evdte_hashkey);
																				$evdte_data = ($rowEvDte->evdte_data);
																				$evdte_data = fct_formatdate($rowEvDte->evdte_data, 'd/m/Y');
																				$evdte_hrs_ini = ($rowEvDte->evdte_hrs_ini);
																			?>
																				<div class="row g-2 trRow">
																					<div class="col-12 col-md-2">
																						<div class="form-group">
																							<div class="position-relative d-flex align-items-center">
																								<input type="text" name="evdte_data[]" id="evdte_data_<?php echo($xCount)?>" class="form-control form-control-sm flatpickr_date" value="<?php echo($evdte_data)?>" style="padding-right: 3rem !important;" />
																								<span class="position-absolute mx-2" style="right: 0;">
																									<img src="assets/svg/icon-calendar.svg" />
																								</span>
																							</div>
																						</div>
																					</div>
																					<div class="col-12 col-md-4">
																						<div class="row g-2">
																							<div class="col-12 col-md-6">
																								<div class="form-group">
																									<input type="text" name="evdte_hrs_ini[]" id="evdte_hrs_ini_<?php echo($xCount)?>" class="form-control form-control-sm flatpickr_hour" value="<?php echo($evdte_hrs_ini)?>" />
																								</div>
																							</div>
																							<div class="col-12 col-md-6">
																								<div class="form-group">
																									<input type="text" name="evdte_hrs_end[]" id="evdte_hrs_end_<?php echo($xCount)?>" class="form-control form-control-sm flatpickr_hour" value="<?php echo($evdte_hrs_ini)?>" />
																								</div>
																							</div>
																						</div>
																					</div>
																					<div class="col-12 col-md-5">
																						<div class="form-group">
																							<select class="selectpicker" multiple data-size="12" data-style="btn-drop-custom" name="evdte_categ_[]" title="- selecione -" id="evdte_categ_<?php echo($xCount); ?>">
																								<option value="" translate="no">- selecione -</option>
																								<option value="" translate="no">Categoria 001</option>
																								<option value="" translate="no">Categoria 002</option>
																								<option value="" translate="no">Categoria 003</option>
																							</select>
																						</div>
																					</div>
																					<div class="col-12 col-md-1 text-center align-self-center">
																						<a href="javascript:;" class="cmdDeletarDteEnsaio" data-hashkey="<?php echo($evdte_hashkey); ?>" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
																						<input type="hidden" name="evdte_id[]" id="evdte_id_<?php echo($xCount)?>" value="<?php echo($evdte_id)?>" />
																					</div>
																				</div>
																			<?php
																			}
																		?>
																	<?php
																	}
																	?>
																</div>

																<div class="d-flex justify-content-end">
																	<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovaDteEnsaio">Adicionar Nova Data</a></div>
																</div>
															</div>
														</div>

													</div>
												</div>

											</div>
										</div>
									</div>

									<!-- CONFIG -->
									<div class="tab-pane fade" id="tb-config" role="tabpanel" aria-labelledby="link-config">
										<div class="row ">
											<div class="col-12 col-md-4">

												<div class="card card-base mb-3">
													<div class="card-header">
														Grid de Limites por Função
													</div>
													<div class="card-body">
														<div class="row g-2">
															<div class="col-12 col-md-7">
																<div class="form-group m-0">
																	<label class="form-label">Função</label>
																</div>
															</div>
															<div class="col-12 col-md-3">
																<div class="form-group m-0">
																	<label class="form-label">Limite</label>
																</div>
															</div>
															<div class="col-12 col-md-2 text-center">
																<div class="form-group m-0">
																	<label class="form-label">Ação</label>
																</div>
															</div>
														</div>
														<div id="BOX-CONTENT-GRID-FUNC-LIMITES">
															<?php 
																$evcfg_func_limites = (isset($rs_dados_config->evcfg_func_limites) ? $rs_dados_config->evcfg_func_limites : "");
																$evcfg_func_limites = json_decode($evcfg_func_limites);
																if( isset($evcfg_func_limites) ){ 
																	$xCount = 0;
																	foreach ($evcfg_func_limites as $key => $val) {
																		$xCount++;
																		$flimit_func_id = (int)(isset($val->func_id) ? $val->func_id : '');
																		$flimit_limite = (int)(isset($val->limite) ? $val->limite : '');
																		$flimit_hash = (isset($val->hashkey) ? $val->hashkey : '');
																?>
																<div class="row g-2 trRow">
																	<div class="col-12 col-md-7">
																		<div class="form-group">
																			<select class="form-select form-select-sm" name="flimit_func_id[]" id="flimit_func_id_<?php echo($xCount); ?>">
																				<option value="" translate="no">- selecione -</option>
																				<?php
																				if( isset($rs_funcoes)){
																					foreach ($rs_funcoes->getResult() as $row) {
																						$func_id = ($row->func_id);
																						$func_titulo = ($row->func_titulo);
																						$selected = (($func_id == $flimit_func_id) ? ' selected ' : '');
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
																			<input type="text" name="flimit_limite[]" id="flimit_limite_<?php echo($xCount); ?>" class="form-control form-control-sm mask-money" value="<?php echo($flimit_limite); ?>" />
																		</div>
																	</div>
																	<div class="col-12 col-md-2 text-center align-self-center">
																		<a href="javascript:;" class="cmdRemoverFuncLimite" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
																		<input type="hidden" name="flimit_hash[]" id="flimit_hash_<?php echo($xCount); ?>" value="<?php echo($flimit_hash); ?>"  class="form-control form-control-sm " />
																	</div>
																</div>
																<?php
																	}
																}
															?>
														</div>
														<div class="d-flex justify-content-end">
															<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovoFuncLimite">Add Novo Registro</a></div>
														</div>
													</div>
												</div>

											</div>
											<div class="col-12 col-md-8">

												<div class="row">
													<div class="col-12 col-md-3">
														<div class="form-group">
															<label class="form-label" for="evcfg_max_coreogf_grupo">Máximo de coreografias por grupo</label>
															<input type="text" name="evcfg_max_coreogf_grupo" id="evcfg_max_coreogf_grupo" class="form-control only-number" value="<?php echo((isset($rs_dados_config->evcfg_max_coreogf_grupo) ? $rs_dados_config->evcfg_max_coreogf_grupo : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-4">

														<div class="card p-2">
															<?php 
																$evcfg_seletiva = (int)(isset($rs_dados_config->evcfg_seletiva) ? $rs_dados_config->evcfg_seletiva : "0"); 
																$seletiva_s = ($evcfg_seletiva == "1" ? ' checked ' : '');
																$seletiva_n = ($evcfg_seletiva != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Seletiva?</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_seletiva" id="seletiva_s" class="custom-control-input" value="1" <?php echo($seletiva_s)?> />
																			<label class="custom-control-label" for="seletiva_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_seletiva" id="seletiva_n" class="custom-control-input" value="0" <?php echo($seletiva_n)?> />
																			<label class="custom-control-label" for="seletiva_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<div class="form-group">
																<label class="form-label" for="event_seletiva_taxa">Taxa seletiva</label>
																<input type="text" name="event_seletiva_taxa" id="event_seletiva_taxa" class="form-control mask-money" value="<?php echo((isset($rs_dados->event_seletiva_taxa) ? $rs_dados->event_seletiva_taxa : ""));?>" placeholder="0,00" />
															</div>

															<?php 
																$event_seletiva_result = (int)(isset($rs_dados_config->event_seletiva_result) ? $rs_dados_config->event_seletiva_result : "0"); 
																$exibe_seletiva_s = ($event_seletiva_result == "1" ? ' checked ' : '');
																$exibe_seletiva_n = ($event_seletiva_result != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Exibir Resultado da Seletiva?</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_seletiva_result" id="exibe_seletiva_s" class="custom-control-input" value="1" <?php echo($exibe_seletiva_s)?> />
																			<label class="custom-control-label" for="exibe_seletiva_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_seletiva_result" id="exibe_seletiva_n" class="custom-control-input" value="0" <?php echo($exibe_seletiva_n)?> />
																			<label class="custom-control-label" for="exibe_seletiva_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$evcfg_classificacao = (isset($rs_dados_config->evcfg_classificacao) ? $rs_dados_config->evcfg_classificacao : "geral");
																$evcfg_classificacao = (empty($evcfg_classificacao) ? 'geral' : $evcfg_classificacao);
																$evcfg_classificacao_geral = ($evcfg_classificacao == "geral" ? ' checked ' : '');
																$evcfg_classificacao_data = ($evcfg_classificacao == "data" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Classificação</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_classificacao" id="evcfg_classificacao_geral" class="custom-control-input" value="geral" <?php echo($evcfg_classificacao_geral)?> />
																			<label class="custom-control-label" for="evcfg_classificacao_geral">Geral</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_classificacao" id="evcfg_classificacao_data" class="custom-control-input" value="data" <?php echo($evcfg_classificacao_data)?> />
																			<label class="custom-control-label" for="evcfg_classificacao_data">Por Data</label>
																		</div>
																	</div>
																</div>
															</div>

														</div>

													</div>
													<div class="col-12 col-md-4">
														<?php 
															$evcfg_exigir_foto_doc = (int)(isset($rs_dados_config->evcfg_exigir_foto_doc) ? $rs_dados_config->evcfg_exigir_foto_doc : "0"); 
															$exigir_foto_doc_s = ($evcfg_exigir_foto_doc == "1" ? ' checked ' : '');
															$exigir_foto_doc_n = ($evcfg_exigir_foto_doc != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Exigir foto do documento</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="evcfg_exigir_foto_doc" id="exigir_foto_doc_s" class="custom-control-input" value="1" <?php echo($exigir_foto_doc_s)?> />
																		<label class="custom-control-label" for="exigir_foto_doc_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="evcfg_exigir_foto_doc" id="exigir_foto_doc_n" class="custom-control-input" value="0" <?php echo($exigir_foto_doc_n)?> />
																		<label class="custom-control-label" for="exigir_foto_doc_n">Não</label>
																	</div>
																</div>
															</div>
														</div>

														<?php 
															$evcfg_envio_musica = (int)(isset($rs_dados_config->evcfg_envio_musica) ? $rs_dados_config->evcfg_envio_musica : "0"); 
															$envio_musica_s = ($evcfg_envio_musica == "1" ? ' checked ' : '');
															$envio_musica_n = ($evcfg_envio_musica != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Envio de música</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="evcfg_envio_musica" id="envio_musica_s" class="custom-control-input" value="1" <?php echo($envio_musica_s)?> />
																		<label class="custom-control-label" for="envio_musica_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="evcfg_envio_musica" id="envio_musica_n" class="custom-control-input" value="0" <?php echo($envio_musica_n)?> />
																		<label class="custom-control-label" for="envio_musica_n">Não</label>
																	</div>
																</div>
															</div>
														</div>

														<?php 
															$evcfg_quesitos = (int)(isset($rs_dados_config->evcfg_quesitos) ? $rs_dados_config->evcfg_quesitos : "0"); 
															$evcfg_quesitos_s = ($evcfg_quesitos == "1" ? ' checked ' : '');
															$evcfg_quesitos_n = ($evcfg_quesitos != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Quesitos</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="evcfg_quesitos" id="evcfg_quesitos_s" class="custom-control-input" value="1" <?php echo($evcfg_quesitos_s)?> />
																		<label class="custom-control-label" for="evcfg_quesitos_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="evcfg_quesitos" id="evcfg_quesitos_n" class="custom-control-input" value="0" <?php echo($evcfg_quesitos_n)?> />
																		<label class="custom-control-label" for="evcfg_quesitos_n">Não</label>
																	</div>
																</div>
															</div>
														</div>

													</div>
													<div class="col-12 col-md-4">

														<div class="card p-2">

															<?php 
																$evcfg_show_agenda_site = (int)(isset($rs_dados_config->evcfg_show_agenda_site) ? $rs_dados_config->evcfg_show_agenda_site : "0"); 
																$evcfg_show_agenda_site_s = ($evcfg_show_agenda_site == "1" ? ' checked ' : '');
																$evcfg_show_agenda_site_n = ($evcfg_show_agenda_site != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Exibir agenda (no site)</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_show_agenda_site" id="evcfg_show_agenda_site_s" class="custom-control-input" value="1" <?php echo($evcfg_show_agenda_site_s)?> />
																			<label class="custom-control-label" for="evcfg_show_agenda_site_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_show_agenda_site" id="evcfg_show_agenda_site_n" class="custom-control-input" value="0" <?php echo($evcfg_show_agenda_site_n)?> />
																			<label class="custom-control-label" for="evcfg_show_agenda_site_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$evcfg_show_ordem_apres_site = (int)(isset($rs_dados_config->evcfg_show_ordem_apres_site) ? $rs_dados_config->evcfg_show_ordem_apres_site : "0"); 
																$evcfg_show_ordem_apres_site_s = ($evcfg_show_ordem_apres_site == "1" ? ' checked ' : '');
																$evcfg_show_ordem_apres_site_n = ($evcfg_show_ordem_apres_site != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Exibir ordem de apresentação (no site)</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_show_ordem_apres_site" id="evcfg_show_ordem_apres_site_s" class="custom-control-input" value="1" <?php echo($evcfg_show_ordem_apres_site_s)?> />
																			<label class="custom-control-label" for="evcfg_show_ordem_apres_site_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_show_ordem_apres_site" id="evcfg_show_ordem_apres_site_n" class="custom-control-input" value="0" <?php echo($evcfg_show_ordem_apres_site_n)?> />
																			<label class="custom-control-label" for="evcfg_show_ordem_apres_site_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$evcfg_show_ordem_ensaio_site = (int)(isset($rs_dados_config->evcfg_show_ordem_ensaio_site) ? $rs_dados_config->evcfg_show_ordem_ensaio_site : "0"); 
																$evcfg_show_ordem_ensaio_site_s = ($evcfg_show_ordem_ensaio_site == "1" ? ' checked ' : '');
																$evcfg_show_ordem_ensaio_site_n = ($evcfg_show_ordem_ensaio_site != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Exibir ordem de ensaio (no site)</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_show_ordem_ensaio_site" id="evcfg_show_ordem_ensaio_site_s" class="custom-control-input" value="1" <?php echo($evcfg_show_ordem_ensaio_site_s)?> />
																			<label class="custom-control-label" for="evcfg_show_ordem_ensaio_site_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_show_ordem_ensaio_site" id="evcfg_show_ordem_ensaio_site_n" class="custom-control-input" value="0" <?php echo($evcfg_show_ordem_ensaio_site_n)?> />
																			<label class="custom-control-label" for="evcfg_show_ordem_ensaio_site_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$evcfg_agrupar_ensaios = (isset($rs_dados_config->evcfg_agrupar_ensaios) ? $rs_dados_config->evcfg_agrupar_ensaios : ""); 
																$evcfg_agrupar_ensaios_sessao = ($evcfg_agrupar_ensaios == "sessao" ? ' checked ' : '');
																$evcfg_agrupar_ensaios_data = ($evcfg_agrupar_ensaios == "data" ? ' checked ' : '');
																$evcfg_agrupar_ensaios_geral = ($evcfg_agrupar_ensaios == "geral" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Agrupar ensaios</label></div>
																<div>
																	<div class="form-check-block my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_agrupar_ensaios" id="evcfg_agrupar_ensaios_sessao" class="custom-control-input" value="sessao" <?php echo($evcfg_agrupar_ensaios_sessao)?> />
																			<label class="custom-control-label" for="evcfg_agrupar_ensaios_sessao">Por sessão</label>
																		</div>
																	</div>
																	<div class="form-check-block my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_agrupar_ensaios" id="evcfg_agrupar_ensaios_data" class="custom-control-input" value="data" <?php echo($evcfg_agrupar_ensaios_data)?> />
																			<label class="custom-control-label" for="evcfg_agrupar_ensaios_data">Por data</label>
																		</div>
																	</div>
																	<div class="form-check-block my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_agrupar_ensaios" id="evcfg_agrupar_ensaios_geral" class="custom-control-input" value="geral" <?php echo($evcfg_agrupar_ensaios_geral)?> />
																			<label class="custom-control-label" for="evcfg_agrupar_ensaios_geral">Geral</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$evcfg_perm_bailarino_grupos = (int)(isset($rs_dados_config->evcfg_perm_bailarino_grupos) ? $rs_dados_config->evcfg_perm_bailarino_grupos : "0"); 
																$evcfg_perm_bailarino_grupos_s = ($evcfg_perm_bailarino_grupos == "1" ? ' checked ' : '');
																$evcfg_perm_bailarino_grupos_n = ($evcfg_perm_bailarino_grupos != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div>
																	<label class="form-label" style="line-height: 1.25;">Permitir que o bailarino dance por mais de um grupo</label>
																</div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_perm_bailarino_grupos" id="evcfg_perm_bailarino_grupos_s" class="custom-control-input" value="1" <?php echo($evcfg_perm_bailarino_grupos_s)?> />
																			<label class="custom-control-label" for="evcfg_perm_bailarino_grupos_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="evcfg_perm_bailarino_grupos" id="evcfg_perm_bailarino_grupos_n" class="custom-control-input" value="0" <?php echo($evcfg_perm_bailarino_grupos_n)?> />
																			<label class="custom-control-label" for="evcfg_perm_bailarino_grupos_n">Não</label>
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

									<!-- VALORES -->
									<div class="tab-pane fade" id="tb-valores" role="tabpanel" aria-labelledby="link-valores">

										<p>Cobrança que será feita pela instituição</p>
										<?php 
											$evcfg_forma_cobranca = ((isset($rs_dados_config->evcfg_forma_cobranca) ? $rs_dados_config->evcfg_forma_cobranca : "")); 
											//$cobrar_coreografia = ($event_forma_cobranca == "coreografia" ? ' checked ' : '');
											//$cobrar_participante = ($event_forma_cobranca == "participante" ? ' checked ' : '');
											//$cobrar_taxa_unica = ($event_forma_cobranca == "taxa_unica" ? ' checked ' : '');
											
											//print('<pre> evcfg_forma_cobranca');
											//print_r( json_decode($evcfg_forma_cobranca) );
											//print('</pre>');
											$arr_forma_cobr_selected = []; 
											if( !empty($evcfg_forma_cobranca) ){ $arr_forma_cobr_selected = json_decode($evcfg_forma_cobranca); }
											if( !is_array($arr_forma_cobr_selected) ){ $arr_forma_cobr_selected = []; }

											$evcfg_forma_cobranca_tipo = ((isset($rs_dados_config->evcfg_forma_cobranca_tipo) ? $rs_dados_config->evcfg_forma_cobranca_tipo : ""));
										?>
										<div class="row ">
											<div class="col-12 col-md-4">
												<div class="form-group d-flex flex-column align-items-start" style="gap:8px;">
													<div><label class="form-label">Forma de Cobrança</label></div>
													<?php 
														foreach ($listFormaCobrancaTipo as $keyFC => $valFC) {
															$label = $valFC['label'];
															$value = $valFC['value'];
															$checked = (($value == $evcfg_forma_cobranca_tipo) ? " checked " : "" );
													?>
													<div class="">
														<div class="form-check" style="padding-left: 0 !important;">
															<div class="custom-control custom-radio">
																<input type="radio" name="evcfg_forma_cobranca_tipo" id="evcfg_forma_cobranca_tipo_<?php echo($value)?>" class="custom-control-input rdoCobraTipo" value="<?php echo($value)?>" <?php echo($value)?> <?php echo($checked)?> />
																<label class="custom-control-label" for="evcfg_forma_cobranca_tipo_<?php echo($value)?>"><?php echo($label)?></label>
															</div>
														</div>
													</div>
													<?php 
														}
													?>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<?php 
												$checked_box = (($evcfg_forma_cobranca_tipo == 'monetaria') ? " active " : "" );
												?>											
												<div id="tipoCobraMonetaria" class="tipoCobraMonetaria <?php echo( $checked_box ); ?>">
													<div class="card card-base mb-3">
														<div class="card-body">
															<div class="form-group m-0 d-flex flex-column align-items-start" style="gap:8px;">
																<?php 
																	foreach ($listFormaCobranca as $keyFC => $valFC) {
																		$label = $valFC['label'];
																		$value = $valFC['value'];
																		$checked = ( in_array($value, $arr_forma_cobr_selected) ? " checked " : "" );
																?>
																<div class="">
																	<div class="form-check" style="padding-left: 0 !important;">
																		<div class="custom-control custom-radio">
																			<input type="checkbox" name="evcfg_forma_cobranca[]" id="evcfg_forma_cobranca_<?php echo($value)?>" class="custom-control-input rdoTipoCobraMoney" value="<?php echo($value)?>" <?php echo($value)?> <?php echo($checked)?> />
																			<label class="custom-control-label" for="evcfg_forma_cobranca_<?php echo($value)?>"><?php echo($label)?></label>
																		</div>
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

										<div class="row ">
											<div class="col-12 col-md-12">

												<?php
													$w_data['etapa'] = 'participantes';
													$w_data['arr_forma_cobr_selected'] = $arr_forma_cobr_selected;
													$include = view('painel/widgets/card-grid-valores-por-participantes', $w_data);
													echo( $include );
												?>

												<?php 
													$w_data['etapa'] = 'participantes';
													$w_data['arr_forma_cobr_selected'] = $arr_forma_cobr_selected;
													$include = view('painel/widgets/card-grid-valores-por-coreografias', $w_data);
													echo( $include );
												?>

												<?php 
													//var_dump( $arr_forma_cobr_selected );
													$w_data_doac['evcfg_forma_cobranca_tipo'] = $evcfg_forma_cobranca_tipo;
													// $checked = ( in_array($value, $arr_forma_cobr_selected) ? " checked " : "" );
													$include = view('painel/widgets/card-grid-quant-doacoes', $w_data_doac);
													echo( $include );
												?>

											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-4 d-none">
												<div class="card card-base mb-3">
													<div class="card-header">
														Amostra
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-12 col-md-12">
																<div class="form-group">
																	<label class="form-label" for="event_vlr_taxa_unic_amostra">Taxa única por participante</label>
																	<input type="text" name="event_vlr_taxa_unic_amostra" id="event_vlr_taxa_unic_amostra" class="form-control mask-money" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_amostra) ? $rs_dados->event_vlr_taxa_unic_amostra : ""));?>" />
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-5">

												<div class="card card-base mb-3">
													<div class="card-header">
														Taxa ECAD
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-12 col-md-12">
																<div class="form-group">
																	<label class="form-label" for="event_vlr_taxa_unic_amostra">Quando é cobrada esta taxa?</label>
																	<input type="text" name="event_vlr_taxa_unic_amostra" id="event_vlr_taxa_unic_amostra" class="form-control mask-money" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_amostra) ? $rs_dados->event_vlr_taxa_unic_amostra : ""));?>" />
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-5">

												<?php 
													$include = view('painel/widgets/card-grid-desc-por-participantes', []);
													echo( $include );
												?>

												<?php 
													$include = view('painel/widgets/card-grid-desc-por-coreografias', []);
													echo( $include );
												?>

												<div class="row mb-3">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_vlr_taxa_unic_amostra">Desconto progressivo por curso</label>
															<input type="text" name="event_vlr_taxa_unic_comp" id="event_vlr_taxa_unic_comp" class="form-control form-control-sm mask-money" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_comp) ? $rs_dados->event_vlr_taxa_unic_comp : ""));?>" />
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>

									<!-- COBRANCA -->
									<div class="tab-pane fade" id="tb-cobranca" role="tabpanel" aria-labelledby="link-cobranca">
										<div class="row mb-4">
											<div class="col-12">

												<div class="accordion accCobranca" id="accordionCobranca">
													<div class="accordion-items boxFields">
														<div class="accordion-headers">
															<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMostra" aria-expanded="false" aria-controls="collapseMostra">
																<h3 class="" style="color: #000000; font-weight: bold;">Mostra Competitiva</h3>
															</button>
														</div>
														<div id="collapseMostra" class="accordion-collapse collapse show" data-bs-parent="#accordionCobranca">
															<?php
																$w_data = [];
																$w_data['evcob_area_cobranca'] = 'mostra-competitiva';
																$include = view('painel/widgets/event_cobranca_opcoes', $w_data);
																echo( $include );
															?>
														</div>
													</div>
													<div class="accordion-items boxFields">
														<div class="accordion-headers">
															<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWorkShop" aria-expanded="true" aria-controls="collapseWorkShop">
																<h3 class="mb-2" style="color: #000000; font-weight: bold;">WorkShop</h3>
															</button>
														</div>
														<div id="collapseWorkShop" class="accordion-collapse collapse" data-bs-parent="#accordionCobranca">
															<?php
																$w_data = [];
																$w_data['evcob_area_cobranca'] = 'workshop';
																$include = view('painel/widgets/event_cobranca_opcoes', $w_data);
																echo( $include );
															?>
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>

									<!-- TERMOS E AUTORIZAÇÕES -->
									<div class="tab-pane fade" id="tb-termos" role="tabpanel" aria-labelledby="link-termos">
										<div class="row ">
											<div class="col-12 col-md-12">
												<div class="card card-base mb-3">
													<div class="card-header">
														Termos e Autorizações
													</div>
													<div class="card-body">
														<?php
														$event_autoriz_base = [];
														if( isset($rs_event_autoriz) ){
															$event_autoriz = $rs_event_autoriz->getResultArray();
															$event_autoriz_base = array_column($event_autoriz, 'autz_id');
														}
														
														//print '<pre>';
														//print_r( $event_autoriz );
														//print '</pre>';

														//print '<pre>';
														//print_r( $event_autoriz_base );
														//print '</pre>';

														if( isset($rs_autorizacoes) ){
														?>
														<div class="table-box table-responsive">
															<table class="display table table-striped table-bordered" style="width:100%">
																<!-- <thead> -->
																<!-- 	<tr> -->
																<!-- 		<th class="text-center" style="width:70px;">#</th> -->
																<!-- 		<th>Título</th> -->
																<!-- 	</tr> -->
																<!-- </thead> -->
																<tbody>
																<?php
																	$count = 0;
																	foreach ($rs_autorizacoes->getResult() as $row) {
																		$count++;
																		$autz_id = ($row->autz_id);
																		$autz_parent_id = (int)$row->autz_parent_id;
																		$autz_titulo_parent = $row->autz_titulo_parent;
																		$autz_hashkey = $row->autz_hashkey;
																		$autz_titulo = $row->autz_titulo;
																		$autz_descricao = $row->autz_descricao;
																		if($autz_parent_id == 0){
																			$autz_titulo = '';
																			$autz_titulo_parent = '<strong>'. ($row->autz_titulo) .'</strong>';
																		}else{
																			$autz_titulo_parent = '';
																		}

																		$checked = (in_array($autz_id, $event_autoriz_base) ? "checked " : ""); 
																	?>
																		<?php if( $autz_parent_id == 0 ){ ?>
																		<tr class="trRow">
																			<td colspan="2"><strong><?php echo($autz_titulo_parent); ?></strong></td>
																		</tr>
																		<?php } ?>
																		<?php if( $autz_parent_id > 0 ){ ?>
																		<tr class="trRow">
																			<td class="text-center" style="width:70px;">
																				<?php if( $autz_parent_id > 0 ){ ?>
																				<input type="checkbox" name="chkAutorizacao[]" id="chkAutorizacao_xx" value="<?php echo($autz_id); ?>" <?php echo($checked); ?> />
																				<?php } ?>
																			</td>
																			<td>
																				<?php echo($autz_descricao); ?>
																			</td>
																		</tr>
																		<?php } ?>
																	<?php
																	}
																?>
																</tbody>
															</table>
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

									<!-- INICIAL -->
									<div class="tab-pane fade" id="tb-inicial" role="tabpanel" aria-labelledby="link-inicial">
										<div class="row ">
											<div class="col-12 col-md-12">

												<div class="row">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_embed_video">Embed de vídeo</label>
															<input type="text" name="event_embed_video" id="event_embed_video" class="form-control" value="<?php echo((isset($rs_dados->event_embed_video) ? $rs_dados->event_embed_video : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_inicial_texto">Texto</label>
															<textarea type="text" name="event_inicial_texto" id="event_inicial_texto" class="form-control" style="height: 250px !important;"><?php echo((isset($rs_dados->event_inicial_texto) ? $rs_dados->event_inicial_texto : ""));?></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-- APRESENTACOES -->
									<div class="tab-pane fade" id="tb-order-apresent" role="tabpanel" aria-labelledby="link-order-apresent">
										<?php 
											$includeApresentacoes = view('painel/templates-parts/eventos-apresentacoes', []);
											echo( $includeApresentacoes );
										?>
									</div>

									<!-- JURADOS -->
									<div class="tab-pane fade" id="tb-link-jurados" role="tabpanel" aria-labelledby="link-jurados">
										<?php 
											$includeJuradosConfig = view('painel/templates-parts/eventos-jurados-config', []);
											echo( $includeJuradosConfig );
										?>
									</div>

									<!-- ENSAIOS -->
									<div class="tab-pane fade" id="tb-link-ensaios" role="tabpanel" aria-labelledby="link-ensaios">
										<?php 
											$includeEnsaios= view('painel/templates-parts/eventos-ensaios', []);
											echo( $includeEnsaios );
										?>
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
		.boxDadosCobrancaInfos{ display: none; }
		.boxDadosCobrancaInfos.active{ display: block; }
		
		.boxFieldCobr{ display: none; }
		.boxFieldCobr.active{ display: block; }

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
			/*border: 1px solid  #f2f2f2;*/
			/*border-radius: 0.35rem !important;*/
			/*padding: 8px;*/
			border: 0px solid  #f2f2f2;
			border-radius: 0 !important;
			padding: 0px;
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

		.boxFields {
			/*padding: 16px;*/
			/*border: 1px solid #f7f7f7;*/
			/*border-radius: 4px;*/
			/*box-shadow: 1px 1px 2px 0px rgb(0 0 0 / 25%);*/
			/*margin-bottom: 8px;*/
			margin-bottom: 4px;
		}
		.accCobranca{}
		.accCobranca .accordion-button{ 
			padding: 16px !important;
			background-color: #FFFFFF !important; 
			box-shadow: none !important;
			border-radius: 4px;
			background-color: #f8f9fa !important;
			background-color: rgb(231 243 255 / 20%) !important;
			border: 1.5px solid #5356FB30 !important;			
		}
		.accCobranca .accordion-button:focus{
			box-shadow: none !important;
		}		
		.accCobranca .accordion-button h3{ 
			font-size: 1.25rem !important;
			font-weight: normal !important;
			margin: 0 !important;
		}
		.accCobranca .accordion-collapse{
			padding: 16px;
			border: 1px solid #cfe2ff;
			margin-top: 1px;
			border-radius: 4px;
			border: 1.5px solid #5356FB30 !important;
		}
		.accordion-button:not(.collapsed) {
			color: var(--bs-accordion-active-color) !important;
			background-color: var(--bs-accordion-active-bg) !important;
			background-color: #f8f9fa !important;
			border: 1.5px solid #5356FB30 !important;
			/*box-shadow: inset 0 calc(-1* var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color) !important;*/
		}
		
		/*ul {*/
		/*  margin: 12px;*/
		/*  padding: 0;*/
		/*  list-style: none;*/
		/*  width: 100%;*/
		/*  max-width: 320px;*/
		/*}*/
		/*ul li {*/
		/*  margin: 16px 0;*/
		/*  position: relative;*/
		/*}*/

		/*html {*/
		/*  box-sizing: border-box;*/
		/*}*/

		/** {*/
		/*  box-sizing: inherit;*/
		/*}*/
		/**:before, *:after {*/
		/*  box-sizing: inherit;*/
		/*}*/

		/*body {*/
		/*  min-height: 100vh;*/
		/*  font-family: "Inter", Arial, sans-serif;*/
		/*  color: #8A91B4;*/
		/*  display: flex;*/
		/*  justify-content: center;*/
		/*  align-items: center;*/
		/*  background: #F6F8FF;*/
		/*}*/
		/*@media (max-width: 800px) {*/
		/*  body {*/
		/*	flex-direction: column;*/
		/*  }*/
		/*}*/
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

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>

	<style>
		.bootstrap-select>.dropdown-toggle {
			position: relative;
			width: 100%;
			text-align: right;
			white-space: nowrap;
			display: -webkit-inline-box;
			display: -webkit-inline-flex;
			display: -ms-inline-flexbox;
			display: inline-flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: justify;
			-webkit-justify-content: space-between;
			-ms-flex-pack: justify;
			justify-content: space-between;

			/* padding: 0.5rem 1.0rem !important; */
			background: #f8f9fa !important;
			background: #FAFAFA !important;
			color: #000000 !important;
			font-size: .90rem !important;
			border-radius: 8px !important;
			border: 1.5px solid #5356FB30 !important;
			/*height: calc(2.3em + 0.75rem + 2px) !important;*/
			height: calc(1.5em + 0.75rem + calc(1px * 2)) !important;
		}
		.bootstrap-select.show-tick .dropdown-menu li a span.text {
			margin-right: 34px;
			font-size: .95rem;
		}
		.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
			width: 220px;
			width: 100% !important;
		}
	</style>


	<style>
		.tipoCobraMonetaria{ display: none; }
		.tipoCobraMonetaria.active{ display: block; }
		.tipoCobraDoacao{ display: none; }
		.tipoCobraDoacao.active{ display: block; }
		
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

		fieldset {
			/* min-width: 0; */
			/* padding: 0; */
			/* margin: 0; */
			/* border: 0; */
			border: 1px solid gray;
			border-radius: 8px;
			margin-bottom: 15px;
			border: 1.5px solid #5356FB30 !important;
			padding: 5px 15px 15px 15px;
		}
		legend {
			/* border: 0; */
			/* padding: 0; */
			font-size: .8rem;
			font-weight: lighter;
			margin-top: -16px;
			background-color: #ffc107;
			padding: 0px 15px 0 15px;
			display: table;
			width: auto;
			color: #000000;
			border-radius: 4px;
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
		$('.selectpicker').selectpicker();

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

		$(document).on('change', '.rdoCobraTipo', function (e) {
			$('#tipoCobraMonetaria').removeClass('active');
			$('#tipoCobraDoacao').removeClass('active');
			if ($(this).is(':checked')) {
				if( $(this).val() == 'monetaria' ){
					$('#tipoCobraMonetaria').addClass('active');
				}
				if( $(this).val() == 'doacao' ){
					$('#tipoCobraDoacao').addClass('active');
					$('.boxConfigMoney').removeClass('active');
					$('.rdoTipoCobraMoney').prop('checked',false);
				}				
			}
		});	
		$(document).on('change', '.rdoTipoCobraMoney', function (e) {
			let $boxConfig = $('#boxConfig'+ $(this).val());
			if ($(this).is(':checked')) {
				if( $(this).val() == 'por_participante' ){
					$boxConfig.addClass('active');
				}
				if( $(this).val() == 'por_coreografia' ){
					$boxConfig.addClass('active');
				}				
			}else{
				if( $(this).val() == 'por_participante' ){
					$boxConfig.removeClass('active');
				}
				if( $(this).val() == 'por_coreografia' ){
					$boxConfig.removeClass('active');
				}	
			}
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


	<script id="mstcGridFuncLimites" type="text/x-jquery-tmpl">
		<div class="row g-2 {{trRow}}">
			<div class="col-12 col-md-7">
				<div class="form-group">
					<select class="form-select form-select-sm" name="flimit_func_id[]" id="flimit_func_id_{{item}}">
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
					<input type="text" name="flimit_limite[]" id="flimit_limite_{{item}}" class="form-control form-control-sm only-number" value="" />
				</div>
			</div>
			<div class="col-12 col-md-2 text-center align-self-center">
				<a href="javascript:;" class="cmdRemoverFuncLimite" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
				<input type="hidden" name="flimit_hash[]" id="flimit_hash_{{item}}" value=""  />
			</div>
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$(document).on('click', '.cmdAddNovoFuncLimite', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridFuncLimites").html();
			$('#BOX-CONTENT-GRID-FUNC-LIMITES').append(Mustache.render(template, templateData));

			//let $el = $('#BOX-CONTENT-GRID-FUNC-LIMITES'); 	
		});
		$(document).on('click', '.cmdDeletarValor', function (e) {
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
		$(document).on('click', '.cmdRemoverFuncLimite', function (e) {
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
					fct_count_item_grid_func_limites();
				}
			});
		});

		fct_count_item_grid_func_limites();
	});
	var fct_count_item_grid_func_limites = function(p, callback){
		let $box = $('#BOX-CONTENT-GRID-FUNC-LIMITES');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){ $( ".cmdAddNovoFuncLimite" ).trigger( "click" ); }
	}
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
			<div class="col-12 col-md-5">
				<div class="form-group">
					<input type="text" name="evdte_hrs_ini[]" id="evdte_hrs_ini_{{item}}" class="form-control form-control-sm flatpickr_hour" value="" />
				</div>
			</div>
			<div class="col-12 col-md-1 text-center align-self-center">
				<a href="javascript:;" class="cmdRemoverData" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
				<input type="hidden" name="evdte_id[]" id="evdte_id_{{item}}" value="0" />
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
						url: painel_url +'eventos/ajaxform/EXCLUIR-DATA-EVENTO',
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
							fct_count_item_grid_datas();
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
					'Você está prestes a remover este registro. <br />' +
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
					fct_count_item_grid_datas();
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
	var fct_count_item_grid_valores_old = function(p, callback){
		let $box = $('#BOX-CONTENT-DATA-EVENTOS');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovaData" ).trigger( "click" );	
		}
	}
	</script>





	<script id="mstcGridDataEnsaio" type="text/x-jquery-tmpl">
		<div class="row g-2 {{trRow}}">
			<div class="col-12 col-md-2">
				<div class="form-group">
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="evdte_data[]" id="evdte_data_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
						<span class="position-absolute mx-2" style="right: 0;">
							<img src="assets/svg/icon-calendar.svg" />
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="row g-2">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<input type="text" name="evdte_hrs_ini[]" id="evdte_hrs_ini_{{item}}" class="form-control form-control-sm flatpickr_hour" value="" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<input type="text" name="evdte_hrs_end[]" id="evdte_hrs_end_{{item}}" class="form-control form-control-sm flatpickr_hour" value="" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-5">
				<div class="form-group">
					<select class="selectpicker" multiple data-size="12" data-style="btn-drop-custom" name="evdte_categ_[]" title="- selecione -" id="evdte_categ_{{item}}">
						<option value="" translate="no">- selecione -</option>
						<option value="" translate="no">Categoria 001</option>
						<option value="" translate="no">Categoria 002</option>
						<option value="" translate="no">Categoria 003</option>
					</select>
				</div>
			</div>
			<div class="col-12 col-md-1 text-center align-self-center">
				<a href="javascript:;" class="cmdRemoverDteEnsaio" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
				<input type="hidden" name="evdte_id[]" id="evdte_id_{{item}}" value="0" />
			</div>	
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$.ajaxSetup({cache: false});

		$(document).on('click', '.cmdAddNovaDteEnsaio', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridDataEnsaio").html();
			$('#BOX-CONTENT-DATA-ENSAIOS').append(Mustache.render(template, templateData));

			let $el = $('#BOX-CONTENT-DATA-ENSAIOS'); 
			
			//$el.find('.js-select-multiple').select2();
			$el.find('.selectpicker').selectpicker();

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
		$(document).on('click', '.cmdDeletarDteEnsaio', function (e) {
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
						url: painel_url +'eventos/ajaxform/EXCLUIR-DATA-ENSAIO',
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
							fct_count_item_grid_datas();
						},
						error: function (jqXHR, textStatus, errorThrown) {
						}
					});
					// ------------------------------------------------------
				}
			});
		}); 
		$(document).on('click', '.cmdRemoverDteEnsaio', function (e) {
			let $this = $(this);
			let $row = $this.closest( ".trRow" );

			Swal.fire({
				title: 'Atenção!',
				icon: 'warning',
				html:
					'Você está prestes a remover este registro. <br />' +
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
					fct_count_item_grid_datas();
				}
			});
		});

		fct_count_item_grid_datas_ensaios();
	});
	var fct_count_item_grid_datas_ensaios = function(p, callback){
		let $box = $('#BOX-CONTENT-DATA-ENSAIOS');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovaDteEnsaio" ).trigger( "click" );	
		}
	}
	</script>

	<script>
	// ------------------------------------------------------
	// COBRANCA
	// ------------------------------------------------------
	$(document).ready(function(){
		// changeMescaConfig 
		$(document).on('change', '.changeMescaConfig', function (event) {
			let $this = $(this);
			let $area = $this.closest( ".areaCobranca" );
			let $box = $area.find('.boxDadosCobrancaInfos');
			$box.removeClass('active');
			if( $this.val() == '0' ){ $box.addClass('active'); }
		});		
		$(document).on('change', '.changeTipoCad', function (event) {
			let $this = $(this);
			let $area = $this.closest( ".areaCobranca" );
			let $evcob_cpf = $area.find('.evcob_cpf');
			let $evcob_cnpj = $area.find('.evcob_cnpj');
			if( $this.val() == 'PF' ){
				$evcob_cpf.prop( "disabled", false );
				$evcob_cnpj.val('').prop( "disabled", true );
				$evcob_cpf.focus();
			}
			if( $this.val() == 'PJ' ){
				$evcob_cpf.val('').prop( "disabled", true );
				$evcob_cnpj.prop( "disabled", false );
				$evcob_cnpj.focus();
			}			
		});
		$(document).on('blur', '.evcob_cpf', function (event) {
			let $area = $this.closest( ".areaCobranca" );
			fct_validar_cpf_cnpj({
				tipo: 'cpf',
				documento : $(this).val(),
				area : $area
			});
		});
		$(document).on('blur', '.evcob_cnpj', function (event) {
			fct_validar_cpf_cnpj({
				tipo: 'cnpj',
				documento : $(this).val()
			});
		});		
		$(document).on('change', '.changeTipoCobranca', function (event) {
			let $this = $(this);
			let $area = $this.closest( ".areaCobranca" );
			$area.find('.boxFieldCobr').removeClass('active');
			
			console.log( $area.find('#boxCobr_'+ $this.val()).html() );
			
			if ($this.prop('checked')) { $area.find('#boxCobr_'+ $this.val()).addClass('active'); }
		});
	});
	var fct_validar_cpf_cnpj = function(p, callback){
		let tipo = p.tipo;
		let documento = p.documento;
		let area = p.area;		
		//console.log('tipo: ', tipo);
		//console.log('documento: ', documento);

		// ------------------------------------------------------
		if( documento.length > 1 ){
			let $formData = {
				tipo: tipo,
				documento: documento
			};
			$.ajax({
				url: painel_url +'eventos/ajaxform/VALIDAR-CPF-CNPJ',
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

					if( tipo == "cpf"){ area.find('.evcob_cpf').val(''); }
					if( tipo == "cnpj"){ area.find('.evcob_cnpj').val(''); }

					if( response.error_num == '1' ){
						Swal.fire({
							title: 'Atenção!',
							icon: 'warning',
							html: response.error_msg,
							confirmButtonText: 'Fechar',
							confirmButtonColor: "#0b8e8e",
						});
					}

				},
				error: function (jqXHR, textStatus, errorThrown) {
				}
			});
		}
		// ------------------------------------------------------
	}	
	</script>	
	
	<script>
	$(document).ready(function(){
		$.ajaxSetup({cache: false});
		$('.mask-money').mask('#.##0,00', {reverse: true});
	});
	</script>
	
<?php $this->endSection('scripts'); ?>