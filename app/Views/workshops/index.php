<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Workshop > Clássicos na Atualidade</h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsInscricao" id="formFieldsInscricao" ref="formFieldsInscricao" enctype="multipart/form-data">

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
														<div class="naveg-steps-item" v-bind:class="{current: step >= 1}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 1"></i>
																<span class="steps-number" v-show="step == 1">1</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">WorkShop</h3>
																<div class="steps-desc">Detalhes</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 2}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 2"></i>
																<span class="steps-number" v-show="step <= 2">2</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Inscrições</h3>
																<div class="steps-desc">Faça sua inscrição</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 3}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 3"></i>
																<span class="steps-number" v-show="step <= 3">3</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Pagamento</h3>
																<div class="steps-desc">Detalhes</div>
															</div>
														</div>
														
														<div class="naveg-steps-item" v-bind:class="{current: step >= 3}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 3"></i>
																<span class="steps-number" v-show="step <= 3">3</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Doação</h3>
																<div class="steps-desc">Detalhes</div>
															</div>
														</div>														

														<div class="naveg-steps-item" v-bind:class="{current: step >= 4}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 4"></i>
																<span class="steps-number" v-show="step < 4">4</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Concluído</h3>
																<div class="steps-desc">Cadastro finalizado com sucesso</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div v-show="step <= 2">
												<div class="card card-workshops-sidebar" style="">
													<div class="card-body p-0">
													
														<h3>Cursos selecionados</h3>
														
														<?php
														if( isset($rs_workshops)){
															foreach ($rs_workshops->getResult() as $row) {
																$curso_id = ($row->curso_id);
																$curso_hashkey = ($row->curso_hashkey);
																$curso_titulo = ($row->curso_titulo);
																$curso_nome_professor = ($row->curso_nome_professor);
																$curso_local = ($row->curso_local);
																$link_workshop = site_url('workshops');
														?>
														<div class="item-check">
															<div class="mr-close">
																<a href="javascript:;" v-on:click="removeWorkItem($event)" ><i class="far fa-times-circle"></i></a>
															</div>
															<div class="row g-3 justify-content-center align-items-center">
																<div class="col-12 col-md-auto">
																	<div class="workshops-avatar" style="background-image: url('assets/media/avatar-04.jpg');"></div>
																</div>
																<div class="col-12 col-md">
																	<h4><?php echo($curso_titulo); ?></h4>
																	<label><?php echo($curso_nome_professor); ?></label>
																	<label class="mt-2 data text-end">início em 01.07.2024</label>
																</div>
															</div>
															<div class="row g-3 justify-content-center align-items-center">
																<div class="col-12">
																	<div class="box-address" style="position: relative;">
																		<div style="position: relative;">
																			<label class="local">local</label>
																			<label class="address"><?php echo($curso_local); ?></label>
																		</div>
																		<div class="tag-valor"><span>R$</span>60,00</div>
																	</div>
																</div>
															</div>														
														</div>
														<?php
															}
														}
														?>

													</div>
												</div>
											</div>

										</div>
										<div class="col-12 col-md-9">

											<!-- Step 1 -->
											<div class="" style="min-height: 100vh;" v-show="step == 1" >
												<?php 
													$includeDetalhes = view('workshops/detalhes', []);
													echo( $includeDetalhes );
												?>
											</div>

											<!-- Step 2 -->
											<div class="" style="min-height: 100vh;" v-show="step == 2" >
												<?php 
													$includeInscricao = view('workshops/form-inscricao', []);
													echo( $includeInscricao );
												?>
											</div>

											<!-- Step 3 -->
											<div class="" style="min-height: 100vh; height: auto !important;" v-show="step == 3" >
												<?php 
													$includeCobranca = view('workshops/cobranca', []);
													echo( $includeCobranca );
												?>
												<?php 
													//$includeDoacao = view('workshops/doacoes', []);
													//echo( $includeDoacao );
												?>												
											</div>

											<!-- Step 4 -->
											<div class="" style="min-height: 100vh;" v-show="step == 4" >
												<?php 
													$includeConfirmacao = view('workshops/confirmacao', []);
													echo( $includeConfirmacao );
												?>
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
		
		.card.card-workshops-sidebar{ background-color: transparent; border-color: #ffa902; border: none; }
		.card.card-workshops-sidebar .card-header{ 
			padding: 0;
			background-color: transparent;
			border-bottom: 1px dashed #ffa902;
			/*background-color: #ffa902; border-color: #ffa902;*/
		}
		.card.card-workshops-sidebar .card-header h2{ 
			font-weight: bold;	
		}
		.card.card-workshops-sidebar .card-body h3{ font-weight: bold; font-size: 1rem; }
		.card.card-workshops-sidebar .card-body { 
			padding: 1rem 0;
			display: flex;
			flex-direction: column;
		}
		.card.card-workshops-sidebar .card-body a{
			position: relative;
			color: #000 !important; text-decoration: none;
		}
		.card.card-workshops-sidebar .card-body .item-check{ 
			position: relative;
			margin-bottom: 0.5rem;
			background-color: #9cefa6;
			background-color: #cfcfcf;
			padding: .5rem .5rem;
			border-radius: 4px;	
			box-shadow: 1px 1px 4px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshops-sidebar .card-body .item-check .mr-close{ 
			position: absolute;
			top: 2px;
			right: 2px;
			color: red;
			font-size: 1.25rem;		
		}
		.card.card-workshops-sidebar .card-body .item-check label{ display: block; font-size: .80rem; line-height: 1.15; }
		.card.card-workshops-sidebar .card-body .item-check label.data{ display: block; font-size: .70rem; }
		.card.card-workshops-sidebar .card-body .item-check h4{ font-size: .85rem; font-weight: bold; line-height: 1.15; margin-bottom: 4px; }	
		.card.card-workshops-sidebar .card-body .item-check .box-address{
			display: flex;
			justify-content: space-between;
			margin-top: 6px;
			padding-top: 6px;
			background-color: transparent;
			border-top: 1px dashed #FFFFFF;

		}
		.card.card-workshops-sidebar .card-body .item-check .box-address .local{
			font-size: .70rem;
			color: white;
			line-height: 1;		
		}
		.card.card-workshops-sidebar .tag-valor{
			/*position: absolute;*/
			/*bottom: -5px;*/
			/*right: 5px;*/
			background-color: #fff0;
			font-size: 1.25rem;
			color: #000000;
			padding: 4px;
			font-weight: bold;
			border-radius: 4px;	
			line-height: 1;
		}
		.card.card-workshops-sidebar .tag-valor span{
			font-size: .7rem;
			margin-right: 4px;
		}
		.card.card-workshops-sidebar .card-body .workshops-avatar {
			width: 40px;
			height: 40px;
			box-sizing: border-box;
			border-radius: 100%;
			background-size: contain;
			background-position: center;
			border: 2px solid #FFFFFF;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
			transition: all ease-in-out .3s;
		}
		
		
		.mr-btn-center{
			line-height: 1.2;
			border-radius: 8px;
			display: flex;
			align-items: center;
			justify-content: center;			
		}
		.mr-btn-center.success{ background-color: #48cf7e; }
		
		.card.card-workshops .card-body .item-checked{ 
			position: relative;
			margin-bottom: 0.5rem;
			background-color: #9cefa6;
			background-color: #a9a9a9;
			padding: .5rem .5rem;
			border-radius: 4px;	
			box-shadow: 1px 1px 4px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshops .card-body .item-checked .icon i{ color: #FFFFFF; font-size: 2rem; }
		.card.card-workshops .card-body .item-checked label{ display: block; font-size: .80rem; line-height: 1.05; }
		.card.card-workshops .card-body .item-checked label.data{ display: block; font-size: .70rem; text-align: end; }
		.card.card-workshops .card-body .item-checked h2{ font-size: 1.25rem; font-weight: bold; line-height: 1.05; margin-bottom: 4px; }
		.card.card-workshops .card-body .item-checked h4{ font-size: .85rem; font-weight: bold; line-height: 1.05; margin-bottom: 4px; }	
		.card.card-workshops .card-body .item-checked .box-address{
			display: flex;
			justify-content: space-between;
			margin-top: 6px;
			padding-top: 6px;
			background-color: transparent;
			border-top: 1px dashed #FFFFFF;

		}
		.card.card-workshops .card-body .item-checked .box-address .local{
			font-size: .70rem;
			color: white;
			line-height: 1;		
		}
		.card.card-workshops .tag-valor{
			/*position: absolute;*/
			/*bottom: -5px;*/
			/*right: 5px;*/
			background-color: #fff0;
			font-size: 1.25rem;
			color: #fff;
			padding: 4px;
			font-weight: bold;
			border-radius: 4px;	
			line-height: 1;
		}
		.card.card-workshops .tag-valor span{
			font-size: .7rem;
			margin-right: 4px;
		}
		.card.card-workshops .card-body .item-checked .workshops-avatar {
			width: 60px;
			height: 60px;
			box-sizing: border-box;
			border-radius: 100%;
			background-size: contain;
			background-position: center;
			border: 2px solid #FFFFFF;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
			transition: all ease-in-out .3s;
		}		
		
		
		
	</style>

	<style>
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

	<?php 
	$includeModalInscricao = view('workshops/modal-inscricao', []);
	echo( $includeModalInscricao );
	?>

<?php $this->endSection('modals'); ?>


<?php $this->section('scripts'); ?>

	<style>
		.card.card-workshop{
			background-color: #ffa902;
			border: none;
			box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshop .card-header{
			background-color: transparent;
			border: none;
			padding: 1.5rem 0 .5rem 0;
		}
		.card.card-workshop .card-body{
			background-color: transparent;
			border: none;
			padding: 1.0rem 0 1.5rem 0;
		}
		.card.card-workshop .card-footer{
			background-color: transparent;
			border: none;
			padding: 0 !important;
		}		
		.work-item{
			position: relative;
		}
		.work-item:before{
			content: '';
			position: absolute;
			bottom: 4px;
			left: calc(50% - 60px);
			/*border-bottom: 1px solid white;*/
			width: 120px;
			/* margin: 0 auto; */
			border-bottom: 1px solid;
			border-image-slice: 1;
			border-width: 1px;
			border-image-source: linear-gradient(to left, rgb(255 255 255 / 0%), rgb(255 255 255), rgb(255 255 255 / 0%));
		}
		.card.card-workshop .card-body label{
			font-size: 0.9rem;
			color: white;
			line-height: 1;
			margin: 0;
		}
		.card.card-workshop .card-body label.vagas{
			margin-bottom: .5rem;
			background-color: #d6d6d6;
			padding: 8px 20px;
			border-radius: 30px;
			/* display: flex; */
			color: black;
			border: 1px solid #848484;
			font-size: .8rem;		
		}
		.card.card-workshop .card-body h3{
			/*line-height: 1;*/
		}
		.workshops-avatar-bg {
			width: 85px;
			height: 85px;
			box-sizing: border-box;
			border-radius: 100%;
			background-size: contain;
			background-position: center;
			border: 4px solid #FFFFFF;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
			transition: all ease-in-out .3s;
		}
		.bd-separar{
			position: relative;	
		}
		.bd-separar:before{
			content: '';
			position: absolute;
			bottom: 0px;
			right: 0;
			/*border-bottom: 1px solid white;*/
			width: 60%;
			/* margin: 0 auto; */
			border-bottom: 1px solid;
			border-image-slice: 1;
			border-width: 1px;
			border-image-source: linear-gradient(to right, rgb(255 255 255 / 0%), rgb(238 158 2), rgb(251 166 2));
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
	$(document).ready(function () {
		$('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",
			allowInput: true
		});		
	});
	</script>

	<script type="text/javascript" src="assets/vue/utils.js?t=<?= $time ?>"></script>
	<script type="text/javascript" src="assets/vue/workshops.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>