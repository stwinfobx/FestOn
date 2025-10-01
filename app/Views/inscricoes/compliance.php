<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 

	$event_titulo = (isset($rs_grupo_evt->event_titulo) ? $rs_grupo_evt->event_titulo : '');
	$cad_nome = (isset($rs_participante->cad_nome) ? $rs_participante->cad_nome : '');
	$partc_email = (isset($rs_participante->partc_email) ? $rs_participante->partc_email : '');
	
	$partc_file_foto = (isset($rs_participante->partc_file_foto) ? $rs_participante->partc_file_foto : '');

	//$path_folder_grupo = (isset($path_folder_grupo) ? $path_folder_grupo : "");
	//$partc_file_foto = (isset($rs_dados->partc_file_foto) ? $rs_dados->partc_file_foto : "");
	//$path_file_view = site_url("uploads/". $path_folder_grupo ."/". $partc_file_foto);
	$path_file_view = site_url("uploads/cadastros/". $partc_file_foto);
	// http://localhost/ja-feston/dev/public/index.php//uploads/cadastros/participante_1723663284_de2b51baacdd56d2c786.jpg

	$cad_documento = (isset($rs_participante->cad_documento) ? $rs_participante->cad_documento : '');
	$categ_titulo = (isset($rs_participante->categ_titulo) ? $rs_participante->categ_titulo : '');
	$func_titulo = (isset($rs_participante->func_titulo) ? $rs_participante->func_titulo : '');

	$grevt_hashkey = (isset($grevt_hashkey) ? $grevt_hashkey : '');
	$partc_hashkey = (isset($partc_hashkey) ? $partc_hashkey : '');

	$rs_autorizados = (isset($rs_autorizados) ? $rs_autorizados : []);
	//CAD.cad_nome, CAD.cad_documento, CAD.cad_genero, CAD.cad_dte_nascto, CAD.cad_file_foto
	
	$fields = [
		'cad_nome' => $cad_nome,
		'cad_email' => $partc_email,
		'cad_documento' => $cad_documento,
		'cad_dte_nascto' => 'Data de Nascimento',
		'event_titulo' => $event_titulo,
		'grp_titulo' => 'Título do Grupo',
	];
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Compliance > <?php echo($event_titulo) ?></h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsCompliance" id="formFieldsCompliance" ref="formFieldsCompliance">

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

											<div class="d-flex flex-column">
												<div class="naveg-steps">
													<div class="naveg-steps-numbers">
														<div class="naveg-steps-item current">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check"></i>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Termos e Autorizações</h3>
																<div class="steps-desc">Configurações</div>
															</div>
														</div>

													</div>
												</div>
											</div>

										</div>
										<div class="col-12 col-md-9">

											<div class="content-step current justify-content-center align-items-center flex-column h-100">
												<div class="container">
													<div class="row justify-content-center">
														<div class="col-11 col-md-12">

															<div class="row">
																<div class="col-12 col-md-12">

																	<div class="card card-users oRDUsr">
																		<div class="card-body p-0">
																			<div class="item mb-2">
																				<div class="row justify-content-center align-items-center">
																					<div class="col-12 col-md-auto">
																						<div>
																							<div class="bg-img-avatar full photo" style="background-image: url('<?php echo($path_file_view) ?>');">
																								<!-- avatar -->
																							</div>
																						</div>
																					</div>
																					<div class="col-12 col-md">
																						<div class="row justify-content-between align-items-center">
																							<div class="col-auto">
																								<h4 class="mb-2 text-uppercase" style="color: rgb(255, 255, 255) !important;"><?php echo($cad_nome) ?></h4>
																							</div>
																							<div class="col-auto">
																								<span class="label text-uppercase"><?php echo($categ_titulo) ?></span>
																								<span class="label text-uppercase"><?php echo($func_titulo) ?></span>
																							</div>
																						</div>
																						<div class="box-address justify-content-center">
																							<div class="mb-2" style="width: 130px;">
																								<label class="local">idade</label>
																								<label class="address">21 anos</label>
																							</div>
																							<div class="mb-2" style="width: 250px;">
																								<label class="local">CPF</label>
																								<label class="address"><?php echo($cad_documento) ?></label>
																							</div>
																							<div class="mb-2" style="width: 100%;">
																								<label class="local">E-mail</label>
																								<label class="address"><?php echo($partc_email) ?></label>
																							</div>
																						</div>
																					</div>
																				</div> 
																			</div>
																		</div>
																	</div>

																</div>
															</div>

															<div class="content-itens boxFields mt-3">
																<div class="box-text-autorizacoes">
																	<?php
																	if( isset($rs_autorizacoes) ){
																		foreach ($rs_autorizacoes as $keyParent => $valParent ) {
																			$titulo = $valParent['titulo'];
																			$dados_itens = $valParent['dados'];
																	?>
																	<div class="table-box table-responsive">
																		<h3><?php echo($titulo); ?></h3>
																		<table class="display table table-striped table-bordered" style="width:100%">
																			<tbody>
																			<?php
																				$count = 0;
																				foreach ($dados_itens as $row) {
																					$count++;
																					$autz_id = ($row->autz_id);
																					$autz_hashkey = ($row->autz_hashkey);
																					$autz_titulo = $row->autz_titulo;
																					$autz_descricao = $row->autz_descricao;
																					$autz_descricao_full = $row->autz_descricao_full;
																					$modalContentID = "modalContentID-". $autz_id;

																					$autz_descricao_full = parseTemplate($autz_descricao_full, $fields);

																					$arr_infos_modal = array(
																						"autz_grupo" => $titulo,
																						"autz_titulo" => $autz_titulo,
																						"autz_hashkey" => $autz_hashkey,
																						"grevt_hashkey" => $grevt_hashkey,
																						"partc_hashkey" => $partc_hashkey,
																						"autz_descricao_full" => nl2br($autz_descricao_full),
																					);
																				?>
																					<tr class="trRow rowAceite" :class="{ active: verificar_participante('<?php echo($autz_hashkey); ?>') }">
																						<td class="text-center" style="width:70px;">
																							<div v-show="verificar_participante('<?php echo($autz_hashkey); ?>')">
																								<i class="IconChecked far fa-check-circle"></i>
																							</div>
																							<div style="color: #d1d1d1; cursor: pointer;" v-show="verificar_participante('<?php echo($autz_hashkey); ?>')==false" v-on:click='open_autorizacao_detalhe(<?php echo( json_encode($arr_infos_modal) ); ?>)'>
																								<i class="IconChecked far fa-square"></i>
																							</div>
																						</td>
																						<td>
																							<a href="javascript:;" v-on:click='open_autorizacao_detalhe(<?php echo( json_encode($arr_infos_modal) ); ?>)'><?php echo($autz_descricao); ?></a>
																							<div id="<?php echo($modalContentID); ?>" class="d-none mt-4 mb-4">
																								<p><?php echo(nl2br($autz_descricao_full)); ?></p>
																							</div>
																							<div v-show="verificar_participante('<?php echo($autz_hashkey); ?>')==true">
																								<div class="d-flex justify-content-end" style="font-size: .85rem; gap:10px;">
																									<div style="background-color: #00af7c; padding: 1px 10px; color: #FFFFFF;">aceite em: {{ verificar_data('<?php echo($autz_hashkey); ?>') }}</div>
																								</div>
																							</div>
																						</td>
																					</tr>
																				<?php
																				}
																			?>
																			</tbody>
																		</table>
																	</div>
																	<?php
																		}
																	}
																	?>
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
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.rowAceite{}
		.rowAceite.active{ background-color: #e5ffe5; }
		.IconChecked{ font-size: 1.5rem; color: rgb(209, 209, 209); }
		.rowAceite.active .IconChecked{ color: #00b37f; }


		.accCoreografias{}
		.accCoreografias .accordion-button{ 
			padding: 0 !important; 
			background-color: #FFFFFF !important; 
			box-shadow: none !important;
		}
		.accCoreografias .accordion-button:focus{
			box-shadow: none !important;
		}


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



<?php $this->section('modals'); ?>

	<div class="modal fade" tabindex="-1" id="modal_autorizacoes">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Termos e Autorizações do Festival</h5>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
						<span class="svg-icon svg-icon-2x"></span>
					</div>
				</div>
				<div class="modal-body" style="max-height: 70vh; overflow: auto;">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modal_autorizacoes_full" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						<!-- titulo da autorização -->
					</h5>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
						<span class="svg-icon svg-icon-2x"></span>
					</div>
				</div>
				<div class="modal-body" style="min-height:70vh; max-height: 70vh; overflow: auto; line-height: 1.2;">
					<!-- descrição completa da autorização -->
					<h4 class="modal-titulo" style="font-weight: bold;"></h4>
					<div class="pt-3 modal-descricao"></div>
				</div>
				<div class="modal-footer">
					<div class="d-flex justify-content-center w-100">
						<div class="btnModalAceito" style="margin: 0 10px;">
							<button type="button" class="btn btn-primary" v-on:click='aceitar_autorizacao()'>Aceito</button>
						</div>
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php $this->endSection('modals'); ?>



<?php $this->section('scripts'); ?>

	<style>
		.box-text-autorizacoes{
			 line-height: 1.2;
		}
		.box-text-autorizacoes h3{
			 font-size: 1.25rem;
			 font-weight: 500;
		}
		.aut_check{ 
			height: 16px; 
			width: 16px;
		}
	</style>


	<!-- VueJs -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="assets/plugins/flatpickr/flatpickr-locale-br.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<script>
		let LIST_AUTORIZADOS = <?php echo( json_encode($rs_autorizados) ); ?>;
	</script>

	<script>
		$(document).ready(function () {
			  $('#modal_autorizacoes_full').on('show.bs.modal', function (e) {
				var triggerLink = $(e.relatedTarget); // O link que acionou o modal
				var contentId = triggerLink.data('content-text'); // Pega o valor de data-content-text
				var contentToLoad = $('#' + contentId).html(); // Pega o conteúdo da div com o ID correspondente
				var title = triggerLink.data('title'); // Pega o valor de data-title
				var modal = $(this);
				modal.find('.modal-body').html(contentToLoad); // Insere o conteúdo no corpo do modal
				modal.find('.modal-title').text(title); // Altera o título do modal
			  });
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
	<script type="text/javascript" src="assets/vue/inscricoes-compliance.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>