<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Inscrições > Meus Grupos</h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<div class="row align-items-start">
						<div class="col-12 col-md-5">

							<div class="card card-default">
								<div class="card-body">

									<div class="row ">
										<div class="col-12 col-md-12">

											<?php
											if( isset($rs_meus_grupos) ){
											?>
											<div class="table-box table-responsive">
												<table id="example2" class="display nowrap table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th>Nome do Grupo</th>
															<th>Responsável</th>
															<th>CPF do Responsável</th>
															<th>Status da Inscrição</th>
															<th>Ações</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$count = 0;
														foreach ($rs_meus_grupos->getResult() as $row) {
															$count++;
															$grp_id = ($row->grp_id);
															$grp_hashkey = ($row->grp_hashkey);
															$grp_titulo = ($row->grp_titulo);
															$grp_responsavel = ($row->grp_responsavel);
															$grp_cpf = ($row->grp_cpf);
															$grevt_hashkey = ($row->grevt_hashkey);
															$grevt_ativo = ($row->grevt_ativo);

															// Determinar status da inscrição
															$status_text = '';
															$status_class = '';
															if ($grevt_ativo == 2) {
																$status_text = 'INSCRIÇÃO CONCLUÍDA';
																$status_class = 'badge bg-success';
															} else if ($grevt_ativo == 1) {
																$status_text = 'EM ANDAMENTO';
																$status_class = 'badge bg-warning';
															} else {
																$status_text = 'PENDENTE';
																$status_class = 'badge bg-secondary';
															}

															$link_form = painel_url('grupos/form/'. $grp_id .'/params/grp:'. $grp_id);
															$link_status = site_url('inscricoes/status/'. $grevt_hashkey);
															$linkGerarPDF = painel_url();
														?>
															<tr class="trRow">
																<td>
																	<div style="line-height: 1.25"><?php echo($grp_titulo); ?></div>
																</td>
																<td>
																	<div style="line-height: 1.25"><?php echo($grp_responsavel); ?></div>
																</td>
																<td>
																	<div style="line-height: 1.25"><?php echo($grp_cpf); ?></div>
																</td>
																<td>
																	<span class="<?php echo($status_class); ?>"><?php echo($status_text); ?></span>
																</td>
																<td>
																	<div class="btn-group" role="group">
																		<?php if ($grevt_ativo != 2): ?>
																		<a href="<?php echo($link_form); ?>" class="btn btn-sm btn-primary" title="Continuar Inscrição">
																			<i class="fas fa-edit"></i> Continuar
																		</a>
																		<?php endif; ?>
																		<a href="<?php echo($link_status); ?>" class="btn btn-sm btn-info" title="Ver Status">
																			<i class="fas fa-eye"></i> Status
																		</a>
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
						<div class="col-12 col-md-7">

							<div class="card card-default">
								<div class="card-body">

									<div class="row ">
										<div class="col-12 col-md-12">

											Aqui iremos mostrar as informações de participantes e Coreografia de cada grupo 
											
										</div>
									</div>
		
								</div>
							</div>

						</div>
					</div>

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


	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<!-- VueJs -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<script>
	</script>

<?php $this->endSection('scripts'); ?>