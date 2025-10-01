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
										<a class="nav-link" id="link-inicial" data-bs-toggle="tab" href="#tb-inicial" role="tab" aria-controls="tb-inicial" aria-selected="false">Inicial</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-order-apresent" data-bs-toggle="tab" href="#tb-order-apresent" role="tab" aria-controls="tb-order-apresent" aria-selected="false">Ordem Apresentador</a>
									</li>
								</ul>
								<div class="tab-content" id="ex1-content">
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
																	<div class="col-12 col-md-6">
																		<div class="form-group m-0">
																			<label class="form-label">Horário Inicial</label>
																		</div>
																	</div>
																</div>

																<div id="BOX-CONTENT-DATA-EVENTOS"></div>

																<div class="d-flex justify-content-end">
																	<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovaData">Adicionar Nova Data</a></div>
																</div>
															</div>
														</div>

													</div>
												</div>

											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tb-config" role="tabpanel" aria-labelledby="link-config">
										<div class="row ">
											<div class="col-12 col-md-3">



											</div>
											<div class="col-12 col-md-9">

												<div class="row">
													<div class="col-12 col-md-3">
														<div class="form-group">
															<label class="form-label" for="event_max_diretores">Máximo de diretores</label>
															<input type="text" name="event_max_diretores" id="event_max_diretores" class="form-control" value="<?php echo((isset($rs_dados->event_max_diretores) ? $rs_dados->event_max_diretores : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-3">
														<div class="form-group">
															<label class="form-label" for="event_max_assistentes">Máximo de assistentes</label>
															<input type="text" name="event_max_assistentes" id="event_max_assistentes" class="form-control" value="<?php echo((isset($rs_dados->event_max_assistentes) ? $rs_dados->event_max_assistentes : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-3">
														<div class="form-group">
															<label class="form-label" for="event_max_coreografos">Máximo de coreógrafos</label>
															<input type="text" name="event_max_coreografos" id="event_max_coreografos" class="form-control" value="<?php echo((isset($rs_dados->event_max_coreografos) ? $rs_dados->event_max_coreografos : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-3">
														<div class="form-group">
															<label class="form-label" for="event_max_coreogf_grupo">Máximo de coreografias por grupo</label>
															<input type="text" name="event_max_coreogf_grupo" id="event_max_coreogf_grupo" class="form-control" value="<?php echo((isset($rs_dados->event_max_coreogf_grupo) ? $rs_dados->event_max_coreogf_grupo : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-4">

														<div class="card p-2">
															<?php 
																$event_seletiva = (int)((isset($rs_dados->event_seletiva) ? $rs_dados->event_seletiva : "0")); 
																$seletiva_s = ($event_seletiva == "1" ? ' checked ' : '');
																$seletiva_n = ($event_seletiva != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Seletiva?</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_seletiva" id="seletiva_s" class="custom-control-input" value="1" <?php echo($seletiva_s)?> />
																			<label class="custom-control-label" for="seletiva_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_seletiva" id="seletiva_n" class="custom-control-input" value="0" <?php echo($seletiva_n)?> />
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
																$event_seletiva_result = (int)((isset($rs_dados->event_seletiva_result) ? $rs_dados->event_seletiva_result : "0")); 
																$exibe_seletiva_s = ($event_seletiva_result == "1" ? ' checked ' : '');
																$exibe_seletiva_n = ($event_seletiva_result != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Seletiva?</label></div>
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
																$event_inscr_abertas = (int)((isset($rs_dados->event_inscr_abertas) ? $rs_dados->event_inscr_abertas : "0")); 
																$inscr_abertas_s = ($event_inscr_abertas == "1" ? ' checked ' : '');
																$inscr_abertas_n = ($event_inscr_abertas != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Inscrições abertas</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_s" class="custom-control-input" value="1" <?php echo($inscr_abertas_s)?> />
																			<label class="custom-control-label" for="inscr_abertas_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_n" class="custom-control-input" value="0" <?php echo($inscr_abertas_n)?> />
																			<label class="custom-control-label" for="inscr_abertas_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$event_exigir_documento = (int)((isset($rs_dados->event_exigir_documento) ? $rs_dados->event_exigir_documento : "0")); 
																$exigir_documento_s = ($event_exigir_documento == "1" ? ' checked ' : '');
																$exigir_documento_n = ($event_exigir_documento != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Classificação</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_exigir_documento" id="exigir_documento_s" class="custom-control-input" value="1" <?php echo($exigir_documento_s)?> />
																			<label class="custom-control-label" for="exigir_documento_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_exigir_documento" id="exigir_documento_n" class="custom-control-input" value="0" <?php echo($exigir_documento_n)?> />
																			<label class="custom-control-label" for="exigir_documento_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

														</div>

													</div>
													<div class="col-12 col-md-4">

														<?php 
															$event_cobrar = ((isset($rs_dados->event_cobrar) ? $rs_dados->event_cobrar : "")); 
															$cobrar_coreografia = ($event_cobrar == "coreografia" ? ' checked ' : '');
															$cobrar_participante = ($event_cobrar == "participante" ? ' checked ' : '');
															$cobrar_taxa_unica = ($event_cobrar == "taxa_unica" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Cobrar?</label></div>
															<div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_cobrar" id="cobrar_coreografia" class="custom-control-input" value="coreografia" <?php echo($cobrar_coreografia)?> />
																		<label class="custom-control-label m-0" for="cobrar_coreografia">Por coreografia</label>
																	</div>
																</div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_cobrar" id="cobrar_participante" class="custom-control-input" value="participante" <?php echo($cobrar_participante)?> />
																		<label class="custom-control-label m-0" for="cobrar_participante">Por participante</label>
																	</div>
																</div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_cobrar" id="cobrar_taxa_unica" class="custom-control-input" value="taxa_unica" <?php echo($cobrar_taxa_unica)?> />
																		<label class="custom-control-label" for="cobrar_taxa_unica">Taxa única por participante</label>
																	</div>
																</div>
															</div>
														</div>

														<?php 
															$event_exigir_foto = (int)((isset($rs_dados->event_exigir_foto) ? $rs_dados->event_exigir_foto : "0")); 
															$exigir_foto_s = ($event_exigir_foto == "1" ? ' checked ' : '');
															$exigir_foto_n = ($event_exigir_foto != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Exigir foto do participante</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_foto" id="exigir_foto_s" class="custom-control-input" value="1" <?php echo($exigir_foto_s)?> />
																		<label class="custom-control-label" for="exigir_foto_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_foto" id="exigir_foto_n" class="custom-control-input" value="0" <?php echo($exigir_foto_n)?> />
																		<label class="custom-control-label" for="exigir_foto_n">Não</label>
																	</div>
																</div>
															</div>
														</div>

														<?php 
															$event_exigir_documento = (int)((isset($rs_dados->event_exigir_documento) ? $rs_dados->event_exigir_documento : "0")); 
															$exigir_documento_s = ($event_exigir_documento == "1" ? ' checked ' : '');
															$exigir_documento_n = ($event_exigir_documento != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Exigir foto do documento</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_documento" id="exigir_documento_s" class="custom-control-input" value="1" <?php echo($exigir_documento_s)?> />
																		<label class="custom-control-label" for="exigir_documento_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_documento" id="exigir_documento_n" class="custom-control-input" value="0" <?php echo($exigir_documento_n)?> />
																		<label class="custom-control-label" for="exigir_documento_n">Não</label>
																	</div>
																</div>
															</div>
														</div>

														<?php 
															$event_exigir_documento = (int)((isset($rs_dados->event_exigir_documento) ? $rs_dados->event_exigir_documento : "0")); 
															$exigir_documento_s = ($event_exigir_documento == "1" ? ' checked ' : '');
															$exigir_documento_n = ($event_exigir_documento != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Envio de música</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_documento" id="exigir_documento_s" class="custom-control-input" value="1" <?php echo($exigir_documento_s)?> />
																		<label class="custom-control-label" for="exigir_documento_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_documento" id="exigir_documento_n" class="custom-control-input" value="0" <?php echo($exigir_documento_n)?> />
																		<label class="custom-control-label" for="exigir_documento_n">Não</label>
																	</div>
																</div>
															</div>
														</div>

														<?php 
															$event_exigir_documento = (int)((isset($rs_dados->event_exigir_documento) ? $rs_dados->event_exigir_documento : "0")); 
															$exigir_documento_s = ($event_exigir_documento == "1" ? ' checked ' : '');
															$exigir_documento_n = ($event_exigir_documento != "1" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div><label class="form-label">Quesitos</label></div>
															<div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_documento" id="exigir_documento_s" class="custom-control-input" value="1" <?php echo($exigir_documento_s)?> />
																		<label class="custom-control-label" for="exigir_documento_s">Sim</label>
																	</div>
																</div>
																<div class="form-check-inline my-1">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_exigir_documento" id="exigir_documento_n" class="custom-control-input" value="0" <?php echo($exigir_documento_n)?> />
																		<label class="custom-control-label" for="exigir_documento_n">Não</label>
																	</div>
																</div>
															</div>
														</div>

													</div>
													<div class="col-12 col-md-4">

														<div class="card p-2">

															<?php 
																$event_inscr_abertas = (int)((isset($rs_dados->event_inscr_abertas) ? $rs_dados->event_inscr_abertas : "0")); 
																$inscr_abertas_s = ($event_inscr_abertas == "1" ? ' checked ' : '');
																$inscr_abertas_n = ($event_inscr_abertas != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Exibir agenda (no site)</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_s" class="custom-control-input" value="1" <?php echo($inscr_abertas_s)?> />
																			<label class="custom-control-label" for="inscr_abertas_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_n" class="custom-control-input" value="0" <?php echo($inscr_abertas_n)?> />
																			<label class="custom-control-label" for="inscr_abertas_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$event_inscr_abertas = (int)((isset($rs_dados->event_inscr_abertas) ? $rs_dados->event_inscr_abertas : "0")); 
																$inscr_abertas_s = ($event_inscr_abertas == "1" ? ' checked ' : '');
																$inscr_abertas_n = ($event_inscr_abertas != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Exibir ordem de apresentação (no site)</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_s" class="custom-control-input" value="1" <?php echo($inscr_abertas_s)?> />
																			<label class="custom-control-label" for="inscr_abertas_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_n" class="custom-control-input" value="0" <?php echo($inscr_abertas_n)?> />
																			<label class="custom-control-label" for="inscr_abertas_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$event_inscr_abertas = (int)((isset($rs_dados->event_inscr_abertas) ? $rs_dados->event_inscr_abertas : "0")); 
																$inscr_abertas_s = ($event_inscr_abertas == "1" ? ' checked ' : '');
																$inscr_abertas_n = ($event_inscr_abertas != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Exibir ordem de ensaio (no site)</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_s" class="custom-control-input" value="1" <?php echo($inscr_abertas_s)?> />
																			<label class="custom-control-label" for="inscr_abertas_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_n" class="custom-control-input" value="0" <?php echo($inscr_abertas_n)?> />
																			<label class="custom-control-label" for="inscr_abertas_n">Não</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$event_inscr_abertas = (int)((isset($rs_dados->event_inscr_abertas) ? $rs_dados->event_inscr_abertas : "0")); 
																$inscr_abertas_s = ($event_inscr_abertas == "1" ? ' checked ' : '');
																$inscr_abertas_n = ($event_inscr_abertas != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div><label class="form-label">Agrupar ensaios</label></div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_s" class="custom-control-input" value="1" <?php echo($inscr_abertas_s)?> />
																			<label class="custom-control-label" for="inscr_abertas_s">Por sessão</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_n" class="custom-control-input" value="0" <?php echo($inscr_abertas_n)?> />
																			<label class="custom-control-label" for="inscr_abertas_n">Por data</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_n" class="custom-control-input" value="0" <?php echo($inscr_abertas_n)?> />
																			<label class="custom-control-label" for="inscr_abertas_n">Geral</label>
																		</div>
																	</div>
																</div>
															</div>

															<?php 
																$event_inscr_abertas = (int)((isset($rs_dados->event_inscr_abertas) ? $rs_dados->event_inscr_abertas : "0")); 
																$inscr_abertas_s = ($event_inscr_abertas == "1" ? ' checked ' : '');
																$inscr_abertas_n = ($event_inscr_abertas != "1" ? ' checked ' : '');
															?>
															<div class="form-group">
																<div>
																	<label class="form-label" style="line-height: 1.25;">Permitir que o bailarino dance<br>
																	por mais de um grupo</label>
																</div>
																<div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_s" class="custom-control-input" value="1" <?php echo($inscr_abertas_s)?> />
																			<label class="custom-control-label" for="inscr_abertas_s">Sim</label>
																		</div>
																	</div>
																	<div class="form-check-inline my-1">
																		<div class="custom-control custom-radio">
																			<input type="radio" name="event_inscr_abertas" id="inscr_abertas_n" class="custom-control-input" value="0" <?php echo($inscr_abertas_n)?> />
																			<label class="custom-control-label" for="inscr_abertas_n">Não</label>
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
									<div class="tab-pane fade" id="tb-valores" role="tabpanel" aria-labelledby="link-valores">
										<div class="row ">
											<div class="col-12 col-md-4">
												<div class="card card-base mb-3">
													<div class="card-header">
														Competição
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-12 col-md-12">
																<div class="form-group">
																	<label class="form-label" for="event_vlr_taxa_unic_comp">Taxa única por participante</label>
																	<input type="text" name="event_vlr_taxa_unic_comp" id="event_vlr_taxa_unic_comp" class="form-control mask-money" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_comp) ? $rs_dados->event_vlr_taxa_unic_comp : ""));?>" />
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-4">
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
											<div class="col-12 col-md-4">
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
										</div>

										<div class="row ">
											<div class="col-12 col-md-4">

												<div class="row mb-3">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_vlr_taxa_unic_amostra">Desconto progressivo por coreografia</label>
															<input type="text" name="event_vlr_taxa_unic_comp" id="event_vlr_taxa_unic_comp" class="form-control form-control-sm" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_comp) ? $rs_dados->event_vlr_taxa_unic_comp : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row mb-3">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_vlr_taxa_unic_amostra">Desconto progressivo por curso</label>
															<input type="text" name="event_vlr_taxa_unic_comp" id="event_vlr_taxa_unic_comp" class="form-control form-control-sm" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_comp) ? $rs_dados->event_vlr_taxa_unic_comp : ""));?>" />
														</div>
													</div>
												</div>

											</div>
											<div class="col-12 col-md-8">

												<div class="card card-base mb-3">
													<div class="card-header">
														Grid de Valores
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-12 col-md-4">
																<div class="form-group m-0">
																	<label class="form-label" for="event_vlr_taxa_unic_comp">Categoria</label>
																</div>
															</div>
															<div class="col-12 col-md-4">
																<div class="form-group m-0">
																	<label class="form-label" for="event_vlr_taxa_unic_comp">Desconto</label>
																</div>
															</div>
															<div class="col-12 col-md-4">
																<div class="form-group m-0">
																	<label class="form-label" for="event_vlr_taxa_unic_comp">Data limite</label>
																</div>
															</div>
														</div>
														<div id="BOX-CONTENT-GRID-VALORES"></div>
														<div class="d-flex justify-content-end">
															<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovoValor">Add Novo Valor</a></div>
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tb-cobranca" role="tabpanel" aria-labelledby="link-cobranca">
										<div class="row ">
											<div class="col-12 col-md-3">
												<div class="card card-base mb-3">
													<div class="card-header">
														Tipo de Cobrança
													</div>
													<div class="card-body">
														<?php 
															$event_cobrar = ((isset($rs_dados->event_cobrar) ? $rs_dados->event_cobrar : "")); 
															$cobrar_coreografia = ($event_cobrar == "coreografia" ? ' checked ' : '');
															$cobrar_participante = ($event_cobrar == "participante" ? ' checked ' : '');
															$cobrar_taxa_unica = ($event_cobrar == "taxa_unica" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_tipo_cobranca" id="event_tipo_cobr_deposito" class="custom-control-input" value="coreografia" <?php echo($cobrar_coreografia)?> />
																		<label class="custom-control-label m-0" for="event_tipo_cobr_deposito">Depósito em conta</label>
																	</div>
																</div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_tipo_cobranca" id="event_tipo_cobr_pix" class="custom-control-input" value="participante" <?php echo($cobrar_participante)?> />
																		<label class="custom-control-label m-0" for="event_tipo_cobr_pix">PIX</label>
																	</div>
																</div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_tipo_cobranca" id="event_tipo_cobr_livre" class="custom-control-input" value="taxa_unica" <?php echo($cobrar_taxa_unica)?> />
																		<label class="custom-control-label" for="event_tipo_cobr_livre">Livre Escolha</label>
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
															<label class="form-label" for="evcob_titular">Titular da Conta</label>
															<input type="text" name="evcob_titular" id="evcob_titular" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_titular) ? $rs_evcob->evcob_titular : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="evcob_cpf">CPF do Titular</label>
															<input type="text" name="evcob_cpf" id="evcob_cpf" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_cpf) ? $rs_evcob->evcob_cpf : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="evcob_chave_pix">Chave Pix</label>
															<input type="text" name="evcob_chave_pix" id="evcob_chave_pix" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_chave_pix) ? $rs_evcob->evcob_chave_pix : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-4">
														<div class="form-group">
															<label class="form-label" for="evcob_banco">Banco</label>
															<input type="text" name="evcob_banco" id="evcob_banco" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_banco) ? $rs_evcob->evcob_banco : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-4">
														<div class="form-group">
															<label class="form-label" for="evcob_agencia">Agência</label>
															<input type="text" name="evcob_agencia" id="evcob_agencia" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_agencia) ? $rs_evcob->evcob_agencia : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-4">
														<div class="form-group">
															<label class="form-label" for="evcob_conta_num">Conta Corrente</label>
															<input type="text" name="evcob_conta_num" id="evcob_conta_num" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_conta_num) ? $rs_evcob->evcob_conta_num : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="evcob_informacoes">Informações Bancárias</label>
															<textarea type="text" name="cursoevcob_informacoes_conteudo" id="evcob_informacoes" class="form-control" style="height: 250px !important;"><?php echo((isset($rs_evcob->evcob_informacoes) ? $rs_evcob->evcob_informacoes : ""));?></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tb-inicial" role="tabpanel" aria-labelledby="link-inicial">
										<div class="row ">
											<div class="col-12 col-md-3">

											</div>
											<div class="col-12 col-md-9">

												<div class="row">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_vlr_taxa_unic_amostra">Embed de vídeo</label>
															<input type="text" name="event_vlr_taxa_unic_amostra" id="event_vlr_taxa_unic_amostra" class="form-control mask-money" value="<?php echo((isset($rs_dados->event_vlr_taxa_unic_amostra) ? $rs_dados->event_vlr_taxa_unic_amostra : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="event_vlr_taxa_unic_amostra">Texto</label>
															<textarea type="text" name="curso_conteudo" id="curso_conteudo" class="form-control" style="height: 250px !important;"><?php echo((isset($rs_dados->curso_conteudo) ? $rs_dados->curso_conteudo : ""));?></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="tb-order-apresent" role="tabpanel" aria-labelledby="link-order-apresent">
										<div class="row ">
											<div class="col-12 col-md-3">

											</div>
											<div class="col-12 col-md-9">
												order
											</div>
										</div>
									</div>
								</div>

								<!-- ----------------------------------------- -->
	
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
					<select class="form-select form-select-sm" name="categ_id[]" id="categ_id_{{item}}">
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
					<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_{{item}}" class="form-control form-control-sm mask-money" value="" />
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="evvlr_data_limite[]" id="evvlr_data_limite_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
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