<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 

	$event_hashkey = (isset($rs_event->event_hashkey) ? $rs_event->event_hashkey : "");
	$event_titulo = (isset($rs_event->event_titulo) ? $rs_event->event_titulo : "");

	$grevt_id = (isset($rs_event->grp_id) ? $rs_event->grp_id : "");
	$grp_hashkey = (isset($rs_event->grp_hashkey) ? $rs_event->grp_hashkey : "");

	//print('<pre style="height: 140px; font-size: .65rem; line-height: 1.4;">');
	//print_r($rs_group);
	//print('</pre>');

	//$list_rs_categorias = (isset($rs_categorias) ? $rs_categorias->getResult() : []);
	//$list_rs_func_obrig = (isset($list_rs_func_obrig) ? $list_rs_func_obrig : []);
	//$list_rs_funcoes = (isset($rs_funcoes) ? $rs_funcoes->getResult() : []);

	$rs_corgf_cadastradas = (isset($rs_corgf_cadastradas) ? $rs_corgf_cadastradas->getResult() : []);
	$lista_de_coreografias = (isset($lista_de_coreografias) ? $lista_de_coreografias : []);

	$list_rs_formatos = (isset($rs_formatos) ? $rs_formatos : []);
	$list_rs_coreografos = (isset($rs_coreografos) ? $rs_coreografos : []);

	$evcfg_seletiva = (int)((isset($rs_event_config->evcfg_seletiva) ? $rs_event_config->evcfg_seletiva : "0"));
	$evcfg_max_coreogf_grupo = (int)((isset($rs_event_config->evcfg_max_coreogf_grupo) ? $rs_event_config->evcfg_max_coreogf_grupo : "1"));
	$evcfg_perm_bailarino_grupos = (int)((isset($rs_event_config->evcfg_perm_bailarino_grupos) ? $rs_event_config->evcfg_perm_bailarino_grupos : "1"));
	
	$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
	$evcfg_forma_cobranca_json = json_decode( $evcfg_forma_cobranca );

	$evcfg_config_limites = [
		'seletiva' => $evcfg_seletiva,
		'maximo_coreografias' => $evcfg_max_coreogf_grupo,
		'perm_bailarino_grupo' => $evcfg_perm_bailarino_grupos,
		'evcfg_forma_cobranca' => $evcfg_forma_cobranca_json,
	];

	$evcfg_config_infos = [
		'evcfg_form_cobranca' => $evcfg_forma_cobranca_json,
		'rs_valores_por_coreografias' => (isset($rs_valores_por_coreografias) ? $rs_valores_por_coreografias->getResult() : []),
		'rs_valores_por_participantes' => (isset($rs_valores_por_participantes) ? $rs_valores_por_participantes->getResult() : []),
	];

	
	$rs_event_valores = (isset($rs_event_valores) ? $rs_event_valores->getResult() : []);
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
												$w_data['step'] = '4'; // COBRANCAS
												$incMenuLateral = view('inscricoes/menu-lateral', $w_data);
												echo( $incMenuLateral );
											?>

										</div>
										<div class="col-12 col-md-9">

											<!-- Step 3 : COBRANCAS -->
											<div class="h-100" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Cobranças</h2>
																	<input type="text" name="corgf_hashkey" id="corgf_hashkey" class="" v-model="fields.corgf_hashkey" value="" />
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Informe que irão integrar ao grupo.</div> -->
																</div>

																<div class="mb-5">
																	<textarea style="padding: 10px;height:300px; width: 100%; overflow: auto; font-size: .7rem; line-height: 1.3; border: 2px solid red;">LISTA DE COREOGRAFIAS<?php 
																			print_r($lista_de_coreografias);
																		?></textarea>
																	<pre class="d-none" style="padding: 10px;height:200px; overflow: auto; font-size: .7rem; line-height: 1.3; border: 2px solid red;">
																		CONFIG
																		<?php 
																			print_r($evcfg_config_infos);	
																		?>
																	</pre>
																</div>

																<div v-show="lista_de_coreografias.coreografias.length > 0">
																	<div class="row justify-content-center mb-3" v-for="(coreografia, index) in lista_de_coreografias.coreografias" :key="coreografia.corgf_id">
																		<div class="col-12 col-md-12">
																			<div style="padding: 12px; border-radius: 6px; background-color: rgb(221 221 221);">
																				
																				<div class="d-flex justify-content-between mb-2 pb-1">
																					<div>
																						<label style="font-size: .8rem;">coreografia {{index}}</label>
																						<h3 style="color: #000000;">{{coreografia.corgf_titulo}}</h3>
																						<div class="d-flex" style="gap: 10px; font-size: .75rem;">
																							<div class="itemDots">{{coreografia.modl_titulo}} {{coreografia.modl_id}}</div>
																							<div class="itemDots">{{coreografia.formt_titulo}} {{coreografia.formt_id}}</div>
																							<div class="itemDots">{{coreografia.categ_titulo}} {{coreografia.categ_id}}</div>
																						</div>
																					</div> 
																					<div class="d-none" v-show="coreografia.por_coreografia == 1">   
																						<label style="font-size: .7rem;">valor</label>
																						<h3 style="color: #000000; font-size: 1.25rem;">R$ {{coreografia.valor | formatNumber}}</h3>
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
																									<strong>Função</strong>
																								</td>
																								<td>
																									<strong>CPF</strong>
																								</td>
																								<td class="text-end">
																									<strong>Valor Unit.</strong>
																								</td>
																							</tr>
																						</thead>
																						<tbody>
																							<tr v-for="(valueE, keyE, indexE) in coreografia.elenco">
																								<td>
																									<div>{{valueE.partc_nome}}</div>
																								</td>
																								<td>
																									<div>{{valueE.func_titulo}}</div>
																								</td>
																								<td>
																									<div>{{valueE.partc_documento}}</div>
																								</td>
																								<td class="text-end">
																									<!-- <div>R$ {{valueE.valor | formatNumber}}</div> -->
																									<div>{{valueE.valor}}</div>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</div>

																				<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
																					<div style="width:300px;">
																						<h3 class="text-end" style="color: #000000; font-size: 1.05rem;">Valor total por participantes</h3>
																					</div>
																					<div style="width:160px;">
																						<h3 class="text-end" style="color: #000000; font-size: 1.05rem;">R$ {{ subtotais_part[index] | formatNumber }}</h3>
																					</div>
																				</div>

																				<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
																					<div style="width:300px;">
																						<h3 class="text-end" style="color: #000000; font-size: 1.05rem;">Valor por coreografia</h3>
																					</div>
																					<div style="width:160px;">
																						<h3 class="text-end" style="color: #000000; font-size: 1.05rem;">R$ {{coreografia.valor | formatNumber}}</h3>
																					</div>
																				</div>

																				<div class="d-flex justify-content-end pt-2" style="gap: 5px;">
																					<div style="width:300px;">
																						<h3 class="text-end m-0" style="color: #000000; font-size: 1.5rem;">SubTotal</h3>
																					</div>
																					<div style="width:160px;">
																						<h3 class="text-end m-0" style="color: #000000; font-size: 1.5rem;">R$ {{ subtotais[index] | formatNumber }}</h3>
																					</div>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>

																<div class="d-flex justify-content-end">
																	<div>
																		<label style="font-size: .7rem;">Total Geral</label>
																		<h3 style="color: #000000;">R$ {{ total | formatNumber }}</h3>
																	</div>
																</div>

																<div class="content-actions">
																	<div class="row justify-content-between">
																		<div class="col-4 col-md-3">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-secondary" v-on:click="prevStep(2)">Anterior</a>
																			</div>
																		</div>
																		<div class="col-8 col-md-4">
																			<div class="d-grid">
																				<button type="button" class="btn btn-primary" v-on:click="SendNextCobranca()" :disabled='btnDisabledContinue'>Continuar</button>
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
		let LIST_COREOGRAFOS = <?php echo( json_encode($list_rs_coreografos) ); ?>;
		let LIST_FORMATOS = <?php echo( json_encode($list_rs_formatos) ); ?>;
		let LIST_CATEGORIAS = <?php echo( json_encode($list_rs_categorias) ); ?>;
		//let RS_EVCFG_SELETIVA = <?php echo( $evcfg_seletiva ); ?>;
		let RS_EVCFG_CONFIG_LIMITES = <?php echo( json_encode($evcfg_config_limites) ); ?>;
		let LIST_CORF_CADASTRADAS = <?php echo( json_encode($rs_corgf_cadastradas) ); ?>;
		let RS_EVCFG_CONFIG_INFOS = <?php echo( json_encode($evcfg_config_infos) ); ?>;
		let LISTA_DE_COREOGRAFIAS = <?php echo( json_encode($lista_de_coreografias) ); ?>;
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
	<script type="text/javascript" src="assets/vue/inscricoes-cobrancas.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>