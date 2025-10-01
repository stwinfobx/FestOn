<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 

	$event_hashkey = (isset($rs_event->event_hashkey) ? $rs_event->event_hashkey : "");
	$event_titulo = (isset($rs_event->event_titulo) ? $rs_event->event_titulo : "");

	$grevt_id = (isset($rs_event->grp_id) ? $rs_event->grp_id : "");
	$grp_hashkey = (isset($rs_event->grp_hashkey) ? $rs_event->grp_hashkey : "");

	//print_debug( $grevt_id, '150px' );
	//print_debug( $grp_hashkey, '150px' );
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Inscrições > <?php echo( $event_titulo ); ?></h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsCobranca" id="formFieldsCobranca" ref="formFieldsCobranca">
						<input type="text" name="event_hashkey" id="event_hashkey" class="form-control" ref="event_hashkey" v-model="fields.event_hashkey" value="<?php echo((isset($event_hashkey) ? $event_hashkey : ""));?>" />

						<input type="text" name="grp_id" id="grp_id" class="form-control" ref="grp_id" v-model="fields.grp_id" value="<?php echo((isset($grevt_id) ? $grevt_id : ""));?>" />
						<input type="text" name="grp_hashkey" id="grp_hashkey" class="form-control" ref="grp_hashkey" v-model="fields.grp_hashkey" value="<?php echo((isset($grp_hashkey) ? $grp_hashkey : ""));?>" />

					<div class="row align-items-start">
						<div class="col-12 col-md-12">

							<div class="card card-default">
								<div class="card-header-box" style="display:none !important;">
									<div class="row align-items-center">
										<div class="col-12 col-md-6">
											
										</div>
										<div class="col-12 col-md-6">

											<div class="d-flex justify-content-end">
												<div style="margin-left: 5px;"><a href="<?php echo(painel_url('grupos')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
												<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
											</div>

										</div>
									</div>
								</div>
								<div class="card-body">

									<div class="row ">
										<div class="col-12 col-md-3">

											<?php 
												$w_data['step'] = '4'; // DOAÇÕES
												$incMenuLateral = view('inscricoes/menu-lateral', $w_data);
												echo( $incMenuLateral );
											?>

										</div>
										<div class="col-12 col-md-9">

											<!-- Step 3 : DOAÇÕES -->
											<div class="h-100" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Doações</h2>
																	<input type="text" name="corgf_hashkey" id="corgf_hashkey" class="" v-model="fields.corgf_hashkey" value="" />
																</div>

																<?php 
																if( isset($rs_config_info_doacoes['doacoes-por-participantes']) ){
																	if( isset($rs_participantes_list) ){
																		$cfg_doacoes = $rs_config_info_doacoes['doacoes-por-participantes'];
																		$evvlr_quant = (isset($cfg_doacoes->evvlr_quant) ? $cfg_doacoes->evvlr_quant : '');
																		$evvlr_txt_descr = (isset($cfg_doacoes->evvlr_txt_descr) ? $cfg_doacoes->evvlr_txt_descr : '');
																		//$evvlr_ativo = (int)(isset($cfg_doacoes->evvlr_ativo) ? $cfg_doacoes->evvlr_ativo : '');
																?>
																<div>
																	<div class="row justify-content-center mb-3">
																		<div class="col-12 col-md-12">
																			<div style="padding: 12px; border-radius: 6px; background-color: rgb(221 221 221);">
																				
																				<div class="d-flex justify-content-between mb-2 pb-1">
																					<div>
																						<h3 style="color: #000000;">Resumo geral de doações por participantes</h3>
																					</div> 
																				</div>

																				<div class="table-box table-responsive">
																					<table id="example2" class="display nowrap table table-striped table-bordered m-0" style="width:100%">
																						<thead>
																							<tr>
																								<td>
																									<strong>Nome</strong>
																								</td>
																								<td>
																									<strong>CPF</strong>
																								</td>
																								<td>
																									<strong>Função</strong>
																								</td>
																								<td class="text-center">
																									<strong>Quant.</strong>
																								</td>
																							</tr>
																						</thead>
																						<tbody>
																							<?php
																								$count = 0;
																								foreach ($rs_participantes_list as $row) {
																									$count++;
																									$partc_nome = ($row->partc_nome);
																									$partc_documento = ($row->partc_documento);
																									$func_titulo = ($row->func_titulo);
																							?>
																							<tr>
																								<td>
																									<div><?php echo($partc_nome); ?></div>
																								</td>
																								<td>
																									<div><?php echo($partc_documento); ?></div>
																								</td>
																								<td>
																									<div><?php echo($func_titulo); ?></div>
																								</td>
																								<td class="text-center">
																									<div><?php echo($evvlr_quant); ?></div>
																								</td>
																							</tr>
																							<?php
																								}
																							?>
																						</tbody>
																					</table>
																				</div>

																				<div class="d-flex justify-content-start pt-3">
																					<div style="margin-right: 30px">
																						<label style="font-size: 0.7rem;">Descrição:</label>
																						<h3 style="color: #000000;"><?php echo( $evvlr_txt_descr ); ?></h3>
																					</div>
																					<div class="text-center">
																						<label style="font-size: 0.7rem;">Quantidade:</label>
																						<h3 style="color: #000000;"><?php echo( ($evvlr_quant * $count) ); ?></h3>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<?php 
																	} // if rs_participantes_list
																} // if rs_config_info_doacoes 
																?>


																<?php 
																if( isset($rs_config_info_doacoes['doacoes-por-coreografias']) ){
																	if( isset($rs_coreografias_list) ){
																		$cfg_doacoes = $rs_config_info_doacoes['doacoes-por-coreografias'];
																		$evvlr_quant = (isset($cfg_doacoes->evvlr_quant) ? $cfg_doacoes->evvlr_quant : '');
																		$evvlr_txt_descr = (isset($cfg_doacoes->evvlr_txt_descr) ? $cfg_doacoes->evvlr_txt_descr : '');
																		//$evvlr_ativo = (int)(isset($cfg_doacoes->evvlr_ativo) ? $cfg_doacoes->evvlr_ativo : '');
																?>
																<div>
																	<div class="row justify-content-center mb-3">
																		<div class="col-12 col-md-12">
																			<div style="padding: 12px; border-radius: 6px; background-color: rgb(221 221 221);">
																				
																				<div class="d-flex justify-content-between mb-2 pb-1">
																					<div>
																						<h3 style="color: #000000;">Resumo geral de doações por coreografias</h3>
																					</div> 
																				</div>

																				<div class="table-box table-responsive">
																					<table id="example2" class="display nowrap table table-striped table-bordered m-0" style="width:100%">
																						<thead>
																							<tr>
																								<td>
																									<strong>Título</strong>
																								</td>
																								<td>
																									<strong>Modalidade</strong>
																								</td>
																								<td>
																									<strong>Formato</strong>
																								</td>
																								<td>
																									<strong>Categoria</strong>
																								</td>
																								<td class="text-center">
																									<strong>Quant.</strong>
																								</td>
																							</tr>
																						</thead>
																						<tbody>
																							<?php
																								$count = 0;
																								foreach ($rs_coreografias_list as $row) {
																									$count++;
																									$corgf_titulo = ($row->corgf_titulo);
																									$modl_titulo = ($row->modl_titulo);
																									$formt_titulo = ($row->formt_titulo);
																									$categ_titulo = ($row->categ_titulo);
																							?>
																							<tr>
																								<td>
																									<div><?php echo($corgf_titulo); ?></div>
																								</td>
																								<td>
																									<div><?php echo($modl_titulo); ?></div>
																								</td>
																								<td>
																									<div><?php echo($formt_titulo); ?></div>
																								</td>
																								<td>
																									<div><?php echo($categ_titulo); ?></div>
																								</td>
																								<td class="text-center">
																									<div><?php echo($evvlr_quant); ?></div>
																								</td>
																							</tr>
																							<?php
																								}
																							?>
																						</tbody>
																					</table>
																				</div>

																				<div class="d-flex justify-content-start pt-3">
																					<div style="margin-right: 30px">
																						<label style="font-size: 0.7rem;">Descrição:</label>
																						<h3 style="color: #000000;"><?php echo( $evvlr_txt_descr ); ?></h3>
																					</div>
																					<div class="text-center">
																						<label style="font-size: 0.7rem;">Quantidade:</label>
																						<h3 style="color: #000000;"><?php echo( ($evvlr_quant * $count) ); ?></h3>
																					</div>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
																<?php 
																	} // if rs_coreografias_list 
																} // if rs_config_info_doacoes 
																?>

																<div class="content-actions">
																	<div class="row justify-content-between">
																		<div class="col-4 col-md-3">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-secondary" v-on:click="prevStep(2)">Anterior</a>
																			</div>
																		</div>
																		<div class="col-8 col-md-4">
																			<div class="d-grid">
																				<button type="button" class="btn btn-primary" v-on:click="SendNextDoacoes()" :disabled='btnDisabledContinue'>Continuar</button>
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
					</div>

					</FORM>

				</div>
				<div class="col-12 col-md-4">
				</div>
			</div>
		</div>
	</section>

<?php
	$this->endSection('content'); 


	$rs_categorias = (isset($rs_categorias) ? $rs_categorias : []);
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.table-bordered>:not(caption)>* {
			border-color: #ffffff !important;
		}
		.table td {
			border-color: #ffffff !important;
		}
		.box-file-upload{
			/*padding: 0.5rem 1.0rem !important;*/
			/*background: #f8f9fa !important;*/
			/*background: #FAFAFA !important;*/
			/*color: #000000 !important;*/
			/*font-size: .90rem !important;*/
			/*height: calc(4.3em + 1.5rem + 2px) !important;*/
			/*border-radius: 30px !important;*/
			/*border: 1.5px solid #e79c32 !important;*/
			margin-bottom: 0.75rem;
			display: flex;
			/*gap: 1px;*/
		}
		.box-file-upload figure{ cursor: pointer; margin: 0 !important; text-align: center; }
		.box-file-upload figure img{ cursor: pointer; margin: 0 auto !important; width: 60% !important; }
		.box-file-upload .img-preview{
			/*padding: 0.5rem 1.0rem !important;*/
			width: 60%;
			height: calc(4.3em + 1.5rem + 2px) !important;
			background: #FAFAFA !important;
			border-top-left-radius: 30px;
			border-bottom-left-radius: 30px;
			/*border: 1.5px solid #e79c32 !important;*/
		}
		.box-file-upload .txt-click{
			position: relative;
			cursor: pointer;
			padding: 0.5rem 1.0rem !important;
			width: 40%;
			height: calc(4.3em + 1.5rem + 2px) !important;
			background: #e79c32 !important;
			border-top-right-radius: 30px;
			border-bottom-right-radius: 30px;
			/*border: 1.5px solid #e79c32 !important;*/
			/*border-left: 0px solid #e79c32 !important;*/
			font-size: .90rem !important;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.docto-avatar-bg {
			cursor: pointer;
			/*width: 100%;*/
			/*height: 100%;*/
			/*box-sizing: border-box;*/
			/*border-radius: 100%;*/
			background-size: cover;
			background-position: center;
			/*border: 4px solid #e79c32;*/
			/*box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);*/
			/*transition: all ease-in-out .3s;*/

			/*padding: 0.5rem 1.0rem !important;*/
			width: 100%;
			height: 100%;
			height: calc(4.3em + 1.5rem + 2px) !important;
			/*background: #FAFAFA !important;*/
			border-top-left-radius: 30px;
			border-bottom-left-radius: 30px;
			border: 1.5px solid #e79c32 !important;
			display: block;
		}
		.form-control-validate{
			font-size: 3rem;
			text-align: center;
			font-weight: bold;
		}
		.form-control-validate.error {
			border: 1px solid #f1416c;
		}

		.form-error{
			margin-top: 2px;
			background-color: #ffd8d8;
			padding: 2px 16px;
			font-size: .8rem;
			color: red;
			border-radius: 30px;
		}

		.text-error-validacao{
			color: #f1416c;
			margin-right: 16px;
		}


		.content-wrapper{
			min-height: 100vh;
			/*border: 1px dotted red;*/
		}
		.box-content-left{
			z-index: 1;
			position: fixed;
			width: 500px !important;
			background-color: rgba(245,248,250,.5)!important;
			box-shadow: 0 .1rem 1rem .25rem rgba(0,0,0,.05)!important;
			min-height: 100vh;
		}
		.box-content-right{
			width: calc(100% - 500px) !important;
			/*background-color: #f3f3f3;*/
			margin-left: 500px;
		}
		.naveg-logotipo{
			display: flex;
			/*justify-content: center;*/
			margin: 60px 0 30px 0;
		}
		.naveg-logotipo img{
			width: 200px !important;	
		}
		.naveg-steps{
			display: flex;
			/* justify-content: center; */
			flex-direction: column;
			/* align-items: center; */
			margin: 0 auto;
		}
		.naveg-steps .naveg-steps-item{
			display: flex;
			margin: 30px 0;
			line-height: 1;
		}
		.naveg-steps .naveg-steps-item .steps-icon{
			transition: color .2s ease,background-color .2s ease;
			background-color: #04c8c8;
			background-color: #1fb7f0;
			display: flex;
			align-items: center;
			justify-content: center;
			transition: color .2s ease,background-color .2s ease;
			width: 40px;
			height: 40px;
			border-radius: .475rem;
			background-color: #dcfdfd;
			background-color: rgb(31 183 240 / 20%);
			background-color: #e79c32;
			margin-right: 1.5rem;
		}
		.naveg-steps .naveg-steps-item.current .steps-icon{
			background-color: #04c8c8;
			background-color: #1fb7f0;
			background-color: #00b37f;
		}
		.naveg-steps .naveg-steps-item.current .steps-icon .stepper-check{ color: #FFF; }
		.naveg-steps .naveg-steps-item .steps-icon .steps-checked {
		}
		.naveg-steps .naveg-steps-item .steps-icon .steps-number {
			font-size: 1.35rem;
			font-weight: 600;
			color: #04c8c8 !important;
			color: #FFFFFF !important;
		}
		.naveg-steps .naveg-steps-item.current .steps-icon .steps-number {
			color: #FFFFFF !important;
		}
		.naveg-steps .naveg-steps-item .steps-label{
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.naveg-steps .naveg-steps-item .steps-label .steps-title{
			color: #3f4254;
			font-weight: 600;
			font-size: 1.25rem;
			margin-bottom: .3rem;
		}
		.naveg-steps .naveg-steps-item .steps-label .steps-desc{ color: #b5b5c3; }

		.content-step{ display:none; }
		.content-step.current{ display:flex !important; }
		.content-itens{ margin-top: 60px; }
		.content-itens .content-item-box{
			border-radius: 0.475rem;
			min-height: 130px;
			border-width: 1px;
			border-style: dashed;
			color: #04c8c8;
			border-color: #b5b5c3;
			background-color: rgb(255,255,255,0) !important;
			padding: 1.75rem;
			cursor: pointer;
		}
		.content-itens .content-item-box.active{
			border-radius: 0.475rem;
			min-height: 130px;
			border-width: 1px;
			border-style: dashed;
			color: #04c8c8;
			border-color: #1fb7f0;
			background-color: rgb(31 183 240 / 10%) !important;
			padding: 1.75rem;
		}
		.content-actions{
			margin-top: 60px;
		}

		.svg-icon.svg-icon-3x svg {
			height: 3rem!important;
			width: 3rem!important;
		}


		.input-tempo-musica{
			font-size: 2rem !important;
			padding: 0rem 1.0rem !important;
			line-height: 1 !important;
			height: 47.11px !important;
			font-weight: bold !important;
			text-align: center !important;	
			color: #ffffff !important;
			background-color: #f1790f !important;
			border-color: #f1790f !important;
		}
		.input-tempo-musica.error{
			background-color: #ff0000 !important;
			border-color: #ff0000 !important;
		}


		.personal-image {
			text-align: center;
		}
		.personal-image input[type="file"] {
			display: none;
		}
		.personal-figure {
			position: relative;
			width: 120px;
			height: 120px;
			margin: 0;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.personal-avatar {
			cursor: pointer;
			width: 100%;
			height: 100%;
			box-sizing: border-box;
			border-radius: 100%;
			background-color: #e79c32;
			border: 4px solid transparent;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
			transition: all ease-in-out .3s;
		}
		.personal-avatar:hover {
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
		}
		.personal-avatar-bg {
			cursor: pointer;
			width: 112px;
			height: 112px;
			box-sizing: border-box;
			border-radius: 100%;
			background-size: contain;
			background-position: center;
			border: 4px solid #e79c32;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
			transition: all ease-in-out .3s;
		}
		.personal-figcaption {
			cursor: pointer;
			position: absolute;
			top: 0px;
			width: inherit;
			height: inherit;
			border-radius: 100%;
			opacity: 0;
			background-color: rgba(0, 0, 0, 0);
			transition: all ease-in-out .3s;
		}
		.personal-figcaption:hover {
			opacity: 1;
			background-color: rgba(0, 0, 0, .5);
		}
		.personal-figcaption > img {
			margin-top: 32.5px;
			width: 50px;
			height: 50px;
		}

		@media only screen and (max-width: 991px){
			main { padding: 0 !important; }
			.naveg-steps .naveg-steps-numbers{
				display: flex !important;
			}
			.naveg-logotipo {
				display: block !important;
				text-align: center !important;
			}
			.naveg-steps .naveg-steps-item .steps-icon {
				width: 50px !important;
				height: 50px !important;
				margin-right: 1.5rem;
			}
			.naveg-steps .naveg-steps-item .steps-label {
				display: none !important;
			}
			.content-wrapper {
				margin-top: 0vh !important;
				min-height: 1vh !important;
				height: 100% !important;
				flex-direction: column !important;
			}
			.title-step{ font-size: 1.5rem !important; text-align: center !important; }
			.box-content-left{ 
				position: relative !important;
				width: 100% !important;
				height: 100% !important;
				min-height: 10vh !important;
				margin-bottom: 30px !important;
			}
			.box-content-right{
				width: calc(100% - 0px) !important;
				margin-left: 0px !important;
			}
			.form-control-validate{
				font-size: 2.5rem !important;
				padding: .5rem 0.1rem !important;
			}
		}

		.personal-image-header {
			text-align: center;
		}
		.personal-image-header label {
			margin: 0 !important;
		}
		.personal-figure-header {
			position: relative;
			width: 42px;
			height: 42px;
			margin: 0;
		}
		.personal-avatar-header {
			cursor: pointer;
			width: 100%;
			height: 100%;
			box-sizing: border-box;
			border-radius: 100%;
			background-color: #e79c32;
			border: 4px solid transparent;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
			transition: all ease-in-out .3s;
		}
		.personal-avatar-header:hover {
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
		}
		.personal-figcaption-header {
			cursor: pointer;
			position: absolute;
			top: 0px;
			width: inherit;
			height: inherit;
			border-radius: 100%;
			opacity: 0;
			background-color: rgba(0, 0, 0, 0);
			transition: all ease-in-out .3s;
		}
		.personal-figcaption-header:hover {
			opacity: 1;
			background-color: rgba(0, 0, 0, .5);
		}
		.personal-figcaption-header > img {
			margin-top: 32.5px;
			width: 50px;
			height: 50px;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<style>
		.itemDots {
			position: relative;
		}
		.itemDots:not(:last-child):after {
			content: "\2022";
			margin-left: 12px;
			color: #FFFFFF;
		}
	</style>

	<!-- VueJs -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="assets/plugins/flatpickr/flatpickr-locale-br.js"></script>
	<!-- <script src="assets/painel/js/custom/documentation/forms/flatpickr-locale-br.js"></script> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/hmac-md5.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/md5.min.js" integrity="sha512-ENWhXy+lET8kWcArT6ijA6HpVEALRmvzYBayGL6oFWl96exmq8Fjgxe2K6TAblHLP75Sa/a1YjHpIZRt+9hGOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->


	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<script>
		let STR_EVENT_HASHKEY = '<?php echo( $event_hashkey ); ?>';
		$(document).ready(function () {
		});
	</script>

	<script>
	$(document).ready(function () {
		$('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",
			allowInput: true
		});		
	});
	</script>

	<script type="text/javascript" src="assets/vue/utils.js?t=<?= $time ?>"></script>
	<script type="text/javascript" src="assets/vue/inscricoes-doacoes.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>