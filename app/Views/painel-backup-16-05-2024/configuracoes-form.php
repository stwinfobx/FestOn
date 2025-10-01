<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Configurações</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default">
							<div class="card-header-box">
								<div class="row align-items-center">
									<div class="col-12 col-md-6">
										
									</div>
									<div class="col-12 col-md-6">


									</div>
								</div>
							</div>
							<div class="card-body">
								<ul class="nav nav-tabs" id="ex1" role="tablist" style="border-bottom: 0 !important;">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" id="link-cobranca" data-bs-toggle="tab" href="#tb-cobranca" role="tab" aria-controls="tb-cobranca" aria-selected="true">Infos de Cobrança</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-valores" data-bs-toggle="tab" href="#tb-valores" role="tab" aria-controls="tb-valores" aria-selected="false">Valores</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="link-cupons" data-bs-toggle="tab" href="#tb-cupons" role="tab" aria-controls="tb-cupons" aria-selected="false">Cupons</a>
									</li>
								</ul>
								<div class="tab-content" id="ex1-content" style="margin-top: -3px;">

									<!-- COBRANCA -->
									<div class="tab-pane fade show active" id="tb-cobranca" role="tabpanel" aria-labelledby="link-cobranca">
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
															$cobrar_mercado_pago = ($event_cobrar == "mercado_pago" ? ' checked ' : '');
														?>
														<div class="form-group">
															<div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_tipo_cobranca" id="event_tipo_cobr_pix" class="custom-control-input" value="participante" <?php echo($cobrar_participante)?> />
																		<label class="custom-control-label m-0" for="event_tipo_cobr_pix">PIX</label>
																	</div>
																</div>
																<div class="form-check my-1" style="padding-left: 0 !important;">
																	<div class="custom-control custom-radio">
																		<input type="radio" name="event_tipo_cobranca" id="event_tipo_mercado_pago" class="custom-control-input" value="mercado_pago" <?php echo($cobrar_mercado_pago)?> />
																		<label class="custom-control-label" for="event_tipo_mercado_pago">Mercado Pago</label>
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
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="evcob_informacoes">Informações Bancárias</label>
															<textarea type="text" name="cursoevcob_informacoes_conteudo" id="evcob_informacoes" class="form-control" style="height: 80px !important;"><?php echo((isset($rs_evcob->evcob_informacoes) ? $rs_evcob->evcob_informacoes : ""));?></textarea>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-12">
														<div class="form-group">
															<label class="form-label" for="evcob_titular">Email do Mercado Pago</label>
															<input type="text" name="evcob_titular" id="evcob_titular" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_titular) ? $rs_evcob->evcob_titular : ""));?>" />
														</div>
													</div>
												</div>

												
												
												<div class="row">
													<div class="col-12 col-md-2">
														<div class="form-group">
															PRODUCAO
														</div>
													</div>
													<div class="col-12 col-md-5">
														<div class="form-group">
															<label class="form-label" for="evcob_titular">APP_PUBLIC_KEY</label>
															<input type="text" name="evcob_titular" id="evcob_titular" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_titular) ? $rs_evcob->evcob_titular : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-5">
														<div class="form-group">
															<label class="form-label" for="evcob_titular">APP_TOKEN</label>
															<input type="text" name="evcob_titular" id="evcob_titular" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_titular) ? $rs_evcob->evcob_titular : ""));?>" />
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-12 col-md-2">
														<div class="form-group">
															SANDBOX
														</div>
													</div>
													<div class="col-12 col-md-5">
														<div class="form-group">
															<label class="form-label" for="evcob_titular">SANDBOX PUBLIC_KEY</label>
															<input type="text" name="evcob_titular" id="evcob_titular" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_titular) ? $rs_evcob->evcob_titular : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-5">
														<div class="form-group">
															<label class="form-label" for="evcob_titular">SANDBOX TOKEN</label>
															<input type="text" name="evcob_titular" id="evcob_titular" class="form-control mask-money" value="<?php echo((isset($rs_evcob->evcob_titular) ? $rs_evcob->evcob_titular : ""));?>" />
														</div>
													</div>
												</div>


											</div>
										</div>
									</div>
									
									<?php
										$valores = (isset($rs_valor_setup->cfg_value) ? $rs_valor_setup->cfg_value : ''); 
										$json_valores = json_decode($valores);
										$cfg_categ = (isset($json_valores->categoria) ? $json_valores->categoria : '');
										$cfg_valor = (isset($json_valores->valor) ? $json_valores->valor : '');
										$cfg_valor = fct_to_money($cfg_valor);
										$cfg_valor_desc = (isset($json_valores->desconto) ? $json_valores->desconto : '');
										$cfg_valor_desc = fct_to_money($cfg_valor_desc);
										$cfg_dte_limite_desc = (isset($json_valores->data_limite) ? $json_valores->data_limite : '');
										$cfg_dte_limite_desc = fct_formatdate($cfg_dte_limite_desc, "d/m/Y");
									?>
									<!-- VALORES -->
									<div class="tab-pane fade " id="tb-valores" role="tabpanel" aria-labelledby="link-valores">
										<?php 
										$attr_form = ['class' => '', 'id' => 'formFieldsRegistro', 'name' => 'formFieldsRegistro', 'csrf_id' => 'security' ];
										echo form_open_multipart( current_url(), $attr_form ); ?>
										<?php echo( csrf_field() ) ?>

										<div class="row ">
											<div class="col-12 col-md-12">

												<div class="card card-base mb-3">
													<div class="card-header">
														Cobrança da plataforma
													</div>
													<div class="card-body">
														<div class="row">
															<div class="col-12 col-md-3">
																<div class="form-group m-0">
																	<label class="form-label">Categoria</label>
																</div>
															</div>
															<div class="col-12 col-md-3">
																<div class="form-group m-0">
																	<label class="form-label" for="event_vlr_taxa_unic_comp">Valor</label>
																</div>
															</div>
															<div class="col-12 col-md-3">
																<div class="form-group m-0">
																	<label class="form-label">Valor de desconto</label>
																</div>
															</div>
															<div class="col-12 col-md-3">
																<div class="form-group m-0">
																	<label class="form-label">Desconto válido até</label>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-12 col-md-3">
																<div class="form-group">
																	<select class="form-select form-select-sm" name="cfg_categ" id="cfg_categ">
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
																	<input type="text" name="cfg_valor" id="cfg_valor" class="form-control form-control-sm mask-money" value="<?php echo($cfg_valor); ?>" />
																</div>
															</div>
															<div class="col-12 col-md-3">
																<div class="form-group">
																	<input type="text" name="cfg_valor_desc" id="cfg_valor_desc" class="form-control form-control-sm mask-money" value="<?php echo($cfg_valor_desc); ?>" />
																</div>
															</div>
															<div class="col-12 col-md-3">
																<div class="form-group">
																	<div class="position-relative d-flex align-items-center">
																		<input type="text" name="cfg_dte_limite_desc" id="cfg_dte_limite_desc" class="form-control form-control-sm flatpickr_date mask-date" value="<?php echo($cfg_dte_limite_desc); ?>" style="padding-right: 3rem !important;" />
																		<span class="position-absolute mx-4" style="right: 0;">
																			<img src="assets/svg/icon-calendar.svg" />
																		</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="d-flex justify-content-end">
													<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar Valores de Cobrança"></div>
												</div>

											</div>
										</div>

										<?php echo form_close(); ?>
									</div>

									<!-- CUPONS -->
									<div class="tab-pane fade" id="tb-cupons" role="tabpanel" aria-labelledby="link-cupons">
										<?php 
										$attr_form = ['class' => '', 'id' => 'formFieldsRegistro', 'name' => 'formFieldsRegistro', 'csrf_id' => 'security' ];
										echo form_open_multipart( painel_url('configuracoes/cupons'), $attr_form ); ?>
										<?php echo( csrf_field() ) ?>

										<?php 
											$cupom_id = (int)(isset($rs_cupom->cupom_id) ? $rs_cupom->cupom_id : ''); 
										?>
										<input type="hidden" name="cupom_id" id="cupom_id" class="form-control form-control-sm" value="<?php echo ($cupom_id); ?>" />

										<div class="row ">
											<div class="col-12 col-md-12">

												<div class="card card-base mb-3">
													<div class="card-header">
														Cupons de desconto
													</div>
													<div class="card-body">

														<div class="row ">
															<div class="col-12 col-md-4">

																<div class="row">
																	<div class="col-12 col-md-6">
																		<?php 
																			$cupom_codigo = (isset($rs_cupom->cupom_codigo) ? $rs_cupom->cupom_codigo : ''); 
																		?>
																		<div class="form-group">
																			<label class="form-label">Identificação do cupom</label>
																			<input type="text" name="cupom_codigo" id="cupom_codigo" class="form-control form-control-sm" value="<?php echo ($cupom_codigo); ?>" />
																		</div>
																	</div>
																	<div class="col-12 col-md-6">
																		<?php 
																			$cupom_dte_termino = (isset($rs_cupom->cupom_dte_termino) ? $rs_cupom->cupom_dte_termino : ''); 
																			$cupom_dte_termino = fct_formatdate($cupom_dte_termino, 'd/m/Y');
																		?>
																		<div class="form-group">
																			<label class="form-label">Válido até</label>
																			<div class="position-relative d-flex align-items-center">
																				<input type="text" name="cupom_dte_termino" id="cupom_dte_termino" class="form-control form-control-sm flatpickr_date mask-date" value="<?php echo ($cupom_dte_termino); ?>" style="padding-right: 3rem !important;" />
																				<span class="position-absolute mx-4" style="right: 0;">
																					<img src="assets/svg/icon-calendar.svg" />
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="col-12 col-md-6">
																		<?php 
																			$cupom_valor_desc = (isset($rs_cupom->cupom_valor_desc) ? $rs_cupom->cupom_valor_desc : ''); 
																			$cupom_valor_desc = fct_to_money($cupom_valor_desc);
																		?>
																		<div class="form-group">
																			<label class="form-label">Valor bruto</label>
																			<input type="text" name="cupom_valor_desc" id="cupom_valor_desc" class="form-control form-control-sm mask-money" value="<?php echo ($cupom_valor_desc); ?>" />
																		</div>
																	</div>
																	<div class="col-12 col-md-6">
																		<?php 
																			$cupom_percentual = (isset($rs_cupom->cupom_percentual) ? $rs_cupom->cupom_percentual : '');
																			$cupom_percentual = fct_to_money($cupom_percentual);
																		?>
																		<div class="form-group">
																			<label class="form-label">Desconto percentual</label>
																			<input type="text" name="cupom_percentual" id="cupom_percentual" class="form-control form-control-sm mask-money" value="<?php echo ($cupom_percentual); ?>" />
																		</div>
																	</div>
																</div>

																<!-- <div class="d-flex justify-content-end"> -->
																<!-- 	<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovoCupom">Add Novo Valor</a></div> -->
																<!-- </div> -->
																<div class="d-flex justify-content-end">
																	<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar Cupom"></div>
																</div>
															
															</div>
															<div class="col-12 col-md-8">
																
																<?php
																if( isset($rs_cupons) ){
																?>
																<div class="table-box table-responsive">
																	<table id="example2" class="display nowrap table table-striped table-bordered" style="width:100%">
																		<thead>
																			<tr>
																				<th class="text-center" style="width:110px;">Ação</th>
																				<th style="width:50px;">ID</th>
																				<th>Cupom</th>
																				<th style="width:130px;">Valor</th>
																				<th style="width:130px;">Desc Percent</th>
																				<th style="width:130px;">Válido Até</th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php
																			$count = 0;
																			foreach ($rs_cupons->getResult() as $row) {
																				$count++;
																				$cupom_id = ($row->cupom_id);
																				$cupom_hashkey = ($row->cupom_hashkey);
																				$cupom_codigo = ($row->cupom_codigo);
																				$cupom_valor_desc = ($row->cupom_valor_desc);
																				$cupom_valor_desc = fct_to_money($cupom_valor_desc);
																				$cupom_percentual = ($row->cupom_percentual);
																				$cupom_percentual = fct_to_money($cupom_percentual);
																				$cupom_dte_termino = ($row->cupom_dte_termino);
																				$cupom_dte_termino = fct_formatdate($cupom_dte_termino, 'd/m/Y');
																				$link_form = painel_url('configuracoes/cupons/'. $cupom_id);
																			?>
																				<tr class="trRow">
																					<td class="text-center">
																						<div class="d-flex justify-content-center">
																							<div style="margin: 0 3px;">
																								<a href="<?php echo($link_form); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-file-alt"></i></a>
																							</div>
																							<div style="margin: 0 3px;">
																								<a href="javascript:;" class="btn btn-sm btn-ac btn-danger cmdExcluirCupom" data-hashkey="<?php echo($cupom_hashkey); ?>"><i class="las la-trash"></i></a>
																							</div>
																						</div>
																					</td>
																					<td><?php echo($cupom_id); ?></td>
																					<td style="line-height:1.25">
																						<div><strong><?php echo($cupom_codigo); ?></strong></div>
																					</td>
																					<td style="line-height:1.25">
																						<div><strong><?php echo($cupom_valor_desc); ?></strong></div>
																					</td>
																					<td style="line-height:1.25">
																						<div><strong><?php echo($cupom_percentual); ?></strong></div>
																					</td>
																					<td style="line-height:1.25">
																						<div><strong><?php echo($cupom_dte_termino); ?></strong></div>
																					</td>
																				</tr>
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
										</div>

										<?php echo form_close(); ?>
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
			allowInput: true
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

		$(document).on('click', '.cmdExcluirCupom', function (e) {
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
						cupom_hashkey: $hashkey
					};

					$.ajax({
						url: painel_url  +'configuracoes/ajaxform/EXCLUIR-CUPOM',
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
				allowInput: true
			});
			$el.find('.mask-money').mask('#.##0,00', {reverse: true});
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

		//fct_count_item_grid_valores();
	});
	var fct_count_item_grid_valores = function(p, callback){
		let $box = $('#BOX-CONTENT-GRID-VALORES');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovoValor" ).trigger( "click" );	
		}
	}
	</script>



	<script id="mstcGridCupom" type="text/x-jquery-tmpl">
		<div class="row {{trRow}}">
			<div class="col-12 col-md-3">
				<div class="form-group">
					<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_{{item}}" class="form-control form-control-sm" value="" />
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_{{item}}" class="form-control form-control-sm mask-money" value="" />
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<input type="text" name="evvlr_vlr_desc[]" id="evvlr_vlr_desc_{{item}}" class="form-control form-control-sm mask-money" value="" />
				</div>
			</div>
			<div class="col-12 col-md-3">
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
		$.ajaxSetup({cache: false});

		$(document).on('click', '.cmdAddNovoCupom', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridCupom").html();
			$('#BOX-CONTENT-GRID-CUPOM').append(Mustache.render(template, templateData));

			let $el = $('#BOX-CONTENT-GRID-CUPOM'); 	

			$el.find('.flatpickr_date').flatpickr({
				"locale": "pt",
				dateFormat:"d/m/Y",
				allowInput: true
			});
			$el.find('.mask-money').mask('#.##0,00', {reverse: true});
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

		fct_count_item_grid_cupom();
	});
	var fct_count_item_grid_cupom = function(p, callback){
		let $box = $('#BOX-CONTENT-GRID-CUPOM');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovoCupom" ).trigger( "click" );	
		}
	}
	</script>

<?php $this->endSection('scripts'); ?>