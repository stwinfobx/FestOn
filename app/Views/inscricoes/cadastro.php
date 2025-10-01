<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 

	$event_hashkey = (isset($rs_event->event_hashkey) ? $rs_event->event_hashkey : "");
	$event_titulo = (isset($rs_event->event_titulo) ? $rs_event->event_titulo : "");
?>
	<section class="pt-5 pb-4">
		<div class="container">
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(site_url('inscricoes/cadastro/'. $event_hashkey)); ?>" method="post" name="formFieldsLogin" id="formFieldsLogin" >

					<div class="row justify-content-center align-items-start">
						<div class="col-12 col-md-8">

							<?php if( !empty(session()->getFlashdata('msg_inscricoes_cadastro')) ){ ?>
								<div class="row">
									<div class="col-lg-12">
										<div class="alert alert-default alert-primary d-flex justify-content-between align-items-center" role="alert">
											<div class="d-flex align-items-center">
												<div style="margin-right: 10px;"><i class="fas fa-exclamation-triangle"></i></div>
												<div>
													<h4>Atenção!</h4>
													<?php echo( session()->getFlashdata('msg_inscricoes_cadastro') ); ?>
												</div>
											</div>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									</div>
								</div>
							<?php } ?>

							<div class="card card-default" style="border: 1.5px solid #e79c32 !important;">
								<div class="card-body">

									<div class="row justify-content-center">
										<div class="col-12 col-md-12">
											<h2 class="fw-bolder text-dark title-step mb-3" style="font-size: 1.5rem;">Informe seus dados para cadastro</h2>

											<div class="row">
												<div class="col-12 col-md-6">
													<div class="form-group">
														<label class="form-label" for="user_nome">Primeiro Nome</label>
														<input type="text" name="user_nome" id="user_nome" class="form-control" value="" />
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="form-group">
														<label class="form-label" for="user_sobrenome">Sobrenome</label>
														<input type="text" name="user_sobrenome" id="user_sobrenome" class="form-control" value="" />
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-12 col-md-12">
													<div class="form-group">
														<label class="form-label" for="user_email">E-mail</label>
														<input type="text" name="user_email" id="user_email" class="form-control" value="" />
													</div>
												</div>
											</div>											

											<div class="row">
												<div class="col-12 col-md-6">
													<div class="form-box">
														<div class="form-group"> 
															<label class="form-label" for="user_senha">Senha</label> 
															<div class="input-group">
																<input type="password" id="user_senha" name="user_senha" class="form-control txtSenha fieldPassword" required="" value="" autocomplete="off" maxlength="30" />
																<span class="input-group-text" id="basic-addon2">
																	<i class="fas fa-eye togglePassword2" style="cursor:pointer;"></i>
																</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="form-box">
														<div class="form-group"> 
															<label class="form-label" for="user_conf_senha">Confirme a senha</label> 
															<div class="input-group">
																<input type="password" id="user_conf_senha" name="user_conf_senha" class="form-control txtSenha fieldPassword" required="" value="" autocomplete="off" maxlength="30" />
																<span class="input-group-text" id="basic-addon2">
																	<i class="fas fa-eye togglePassword2" style="cursor:pointer;"></i>
																</span>
															</div>
														</div>
													</div>													
												</div>
											</div>

											<div class="row pt-2">
												<div class="col-12 col-md-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-primary">Cadastrar</button>
													</div>
												</div>
											</div>

										</div>
									</div>
			
								</div>
								<div class="card-footer" style="background-color: rgba(0,0,0,0); border:0;">
									<div class="d-grid">
										<a href="<?php echo(site_url('inscricoes/login/'. $event_hashkey)); ?>" class="btn btn-secondary shadow">Já tem cadastro? Clique aqui.</a>
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
		/*.box-featured{}*/
		/*.box-featured .item{ text-align: center; }*/
		/*.box-featured .item .itemIcon{*/
		/*	height: 120px;*/
		/*	width: 120px;*/
		/*	*/
		/*	border-radius: 50%;*/
		/*	cursor: pointer;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	/*border: 1px solid white;*/*/
		/*	margin-bottom: 10px;*/
		/*	display: flex;*/
		/*	justify-content: center;*/
		/*	align-items: center;*/
		/*}*/
		/*.box-featured .item .itemIcon:hover{*/
		/*	background: #ffffff;*/
		/*}*/
		/*.box-featured .item .itemIcon img{*/
		/*	max-width: 60%;*/
		/*}*/

		/*.card-destaque{*/
		/*	height: 140px;*/
		/*	background: #fff7f1;*/
		/*	/* border: 0px; */*/
		/*	border-radius: .5rem;*/
		/*	border: 1px solid #ffc08f;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	border: 1px solid white;*/
		/*}*/
		/*.card-plus{*/
		/*	height: 460px;*/
		/*	background: #fff7f1;*/
		/*	/* border: 0px; */*/
		/*	border-radius: .5rem;*/
		/*	border: 1px solid #ffc08f;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	border: 1px solid white;*/
		/*}*/
		/*.card-patrocinador{*/
		/*	height: 280px;*/
		/*	background: #d3d3d3;*/
		/*	/* border: 0px; */*/
		/*	border-radius: .5rem;*/
		/*	border: 3px solid #ffffff;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	border: 1px solid white;*/
		/*}*/
	</style>

	<style>
		/*.mb-ST { margin-bottom: 32px !important; }*/
		/*.btn-primary {*/
		/*	color: #fff;*/
		/*	background-color: var(--blue-poravo);*/
		/*	border-color: var(--blue-poravo);*/
		/*	border-radius: 24px;*/
		/*}*/
		/*.btn-secondary {*/
		/*	color: #fff;*/
		/*	border-radius: 24px;*/
		/*}*/
		/*.btn {*/
		/*	padding: 0.9rem 26px !important;*/
		/*}*/

		/*.form-control {*/
		/*	border: 1px solid #F2F2F2;*/
		/*	border-radius: 8px;*/
		/*	padding: 0.9rem !important;*/
		/*	background-color: #F2F2F2;*/
		/*}*/
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
			padding: 2px 8px;
			font-size: .8rem;
			color: red;
			border-radius: 5px;
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


	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<!-- VueJs -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<script>
		$(document).ready(function () {
		});
	</script>

	<script type="text/javascript" src="assets/vue/utils.js?t=<?= $time ?>"></script>
	<!-- <script type="text/javascript" src="assets/vue/inscricoes.js?t=<?= $time ?>"></script> -->

<?php $this->endSection('scripts'); ?>