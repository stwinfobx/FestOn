<?php 
	$this->extend('templates/template_app');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row d-none">
				<div class="col-12 col-md-12">
					<h3>Bilheteria > Ballerina Dance Academy</h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsInscricao" id="formFieldsInscricao" ref="formFieldsInscricao" enctype="multipart/form-data">

					<div class="row justify-content-center">
						<div class="col-12 col-md-4">
							
							<div class="" style="margin: 0 auto; height: calc(100% - 1.5rem) !important; width: 95%;">
								<div class="card card-default h-100 mb-4" style="padding: 12px !important;">
									<div class="card-header text-center" style="background-color: #ffffff; padding: 0rem; border: 0;">
										<div class="card card-destaque" style="background-image: url('https://misterlab.com.br/jafeston/public/files-upload/ballerina-dance-academy__banner__1701865173_2fMu.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 124px; border:0;"></div>
									</div>
									<div class="card-header text-center" style="background-color: #ffffff; padding: .5rem 0rem;">
										Informações Detalhadas
									</div>
									<div class="card-body" style="background-color: #ffffff; padding: .5rem 0rem;">
										
										<div class="d-flex justify-content-between" style="font-weight: 400; margin-bottom: 6px;">
											<div>
												<small class="pTagDetalhe">evento</small>
												Ballerina Dance Academy
											</div>
										</div>
										<div class="d-flex justify-content-between" style="font-weight: 400; margin-bottom: 6px;">
											<div>
												<small class="pTagDetalhe">data/horário</small>
												25.10.2024 às 19h00
											</div>
										</div>

									</div>
									<div class="card-header text-center" style="background-color: #ffffff; padding: .5rem 0rem; border-bottom: 2px dashed #cfcfcf;">
										Selecione quem deseja validar
									</div>
									<div class="card-body" style="background-color: #ffffff; padding: .5rem 0rem;">
										<div class="d-flex justify-content-start pUserItem" style="font-weight: 600;">
											<div style="margin-right: 10px;"><input type="checkbox" class="checkbox" style="height: 21px;"></div>
											<div>Nome do Usuário 01</div>
										</div>
										<div class="d-flex justify-content-start pUserItem" style="font-weight: 600;">
											<div style="margin-right: 10px;"><input type="checkbox" class="checkbox" style="height: 21px;"></div>
											<div>Nome do Usuário 02</div>
										</div>
										<div class="d-flex justify-content-start pUserItem" style="font-weight: 600;">
											<div style="margin-right: 10px;"><input type="checkbox" class="checkbox" style="height: 21px;"></div>
											<div>Nome do Usuário 03</div>
										</div>
										<div class="d-flex justify-content-start pUserItem" style="font-weight: 600;">
											<div style="margin-right: 10px;"><input type="checkbox" class="checkbox" style="height: 21px;"></div>
											<div>Nome do Usuário 04</div>
										</div>
									</div>
									<div class="card-footer" style="background-color: #ffffff; padding: .5rem 0rem; border-top: 2px dashed #cfcfcf;">
										<div class="d-grid">
											<a href="javascript:;" class="btn btn-warning" style="border-radius: 4px;">CONTINUAR</a>
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
		.pTagDetalhe{
			display: block;
			font-weight: lighter;
			line-height: 1;
			color: #f0a234;
		}
		.pUserItem{
			margin: 6px 0;
		}
		.pUserItem .checkbox{
			width: 16px;
			height: 16px;
			margin: 0;
		}
	</style>

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

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

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
		let LIST_CATEGORIA = [];
	</script>

	<script>
		$(document).ready(function () {
			$(document).on('click', '.selectSeats', function (e) {
				let $this = $(this);
				let $classe = $this.data( "classe" );
				let $row = $this.closest( ".rowSeatLegenda" );

				console.log('classe', $classe);
				$('.rowSeatLegenda.active').removeClass('active');	
				$row.addClass('active');
			});

			$(document).on('click', '.seatClick', function (e) {
				let $this = $(this);
				let $classActive = $('.rowSeatLegenda.active .selectSeats').data( "classe" );
				console.log('classe', $classActive);
				$this.addClass($classActive);
			});
			
		});
	</script>

<?php $this->endSection('scripts'); ?>