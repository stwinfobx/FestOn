<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>



	<section class="pb-4">
		<div>
			<div class="owl-carousel owl-theme">
				<?php
				if( isset($rs_anuncios) ){
					foreach ($rs_anuncios->getResult() as $row) {
						$anunc_id = (int)$row->anunc_id;
						$anunc_hashkey = ($row->anunc_hashkey);
						$anunc_urlpage = ($row->anunc_urlpage);
						$anunc_titulo = ($row->anunc_titulo);
						$anunc_subtitulo = ($row->anunc_subtitulo);
						$anunc_redirect = ($row->anunc_redirect);
						$anunc_file_banner = ($row->anunc_file_banner);
						//$link_evento = site_url('evento/'. $anunc_id .'/'. $anunc_urlpage);
						$anuncio_banner = base_url($folder_upload) . $anunc_file_banner; 
						$anuncio_banner = $folder_upload . $anunc_file_banner; 
				?>
					<div class="item-slider d-flex align-items-center">
						<div class="image-fix-blur" style="background-image:url('<?php echo($anuncio_banner); ?>');">
						</div>
						<div class="container" style="position: relative;">
							<div class="row align-items-center">
								<div class="col-12 col-md-4">
									<h2 style="font-size: 2.5rem; color: white; font-weight: 900;"><?php echo($anunc_titulo); ?></h2>
									<h3 class="pt-3 pb-3" style="font-size: 1.75rem; color: white; font-weight: lighter;"><?php echo($anunc_subtitulo); ?></h3>

									<?php if( !empty($anunc_redirect)){ ?>
									<div class="pt-3">
										<a href="<?php echo($anunc_redirect); ?>" class="btn btn-success" target="_blank">acessar</a>
									</div>
									<?php } ?>

								</div>
								<div class="col-12 col-md-8">
									<div style="padding: 0 30px; ">
										<img src="<?php echo($anuncio_banner); ?>" class="img-fluid" style="border-radius: .5rem;" />
									</div>
									<!-- <div class="bg_slider" style="border-radius: .5rem; background-image:url('http://localhost/ja-feston/dev-ci4/public/files-upload/tango-001__banner__1701865528_Zo4E.jpg');"> -->
									<!-- </div> -->
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
	</section>



	<section class="pb-4 pt-4 d-none">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Destaques</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-12">

					<div class="d-flex justify-content-between box-featured">
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon">
								<img src="assets/media/icons/ballet.png" class="img-fluid" />
							</div>
							<p><strong>Dança</strong></p>
						</div></a>
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon">
								<img src="assets/media/icons/theater.png" class="img-fluid" />
							</div>
							<p><strong>Teatro</strong></p>
						</div></a>
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon">
								<img src="assets/media/icons/music.png" class="img-fluid" />
							</div>
							<p><strong>Música</strong></p>
						</div></a>
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon"><img src="assets/media/icons/congresso.png" class="img-fluid" /></div>
							<p><strong>Congressos e seminários</strong></p>
						</div></a>
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon"><img src="assets/media/icons/music.png" class="img-fluid" /></div>
							<p><strong>Workshop</strong></p>
						</div></a>
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon"><img src="assets/media/icons/infantil.png" class="img-fluid" /></div>
							<p><strong>Infantil</strong></p>
						</div></a>
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon"><img src="assets/media/icons/gratuito.png" class="img-fluid" /></div>
							<p><strong>Gratuito</strong></p>
						</div></a>
						<a href="<?php echo(site_url('evento')); ?>"><div class="item">
							<div class="itemIcon"><img src="assets/media/icons/online.png" class="img-fluid" /></div>
							<p><strong>Online</p>
						</div></a>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Inscrições Abertas</h3>
				</div>
			</div>
			<div class="row">
				<?php
				if( isset($rs_eventos) ){
					foreach ($rs_eventos->getResult() as $row) {
						
						$event_id = (int)$row->event_id;
						$event_hashkey = ($row->event_hashkey);
						$event_urlpage = ($row->event_urlpage);
						$event_titulo = ($row->event_titulo);
						$event_banner = ($row->event_banner);
						$event_data = fct_formatdate($row->event_data, 'd/m/Y');
						$event_hrs_ini = ($row->event_hrs_ini);

						$link_evento = site_url('evento/'. $event_id .'/'. $event_urlpage);
						$evento_banner = base_url($folder_upload) . $event_banner; 
				?>
						<div class="col-12 col-md-3">
							<a href="<?php echo($link_evento); ?>">
							<div class="card card-destaque" style="background-image: url('<?php echo($evento_banner); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
							</div>
							</a>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</section>

	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Festivais</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-12">
				<?php
				if( isset($rs_festival) ){
					foreach ($rs_festival->getResult() as $row) {
						
						$event_id = (int)$row->event_id;
						$event_hashkey = ($row->event_hashkey);
						$event_urlpage = ($row->event_urlpage);
						$event_titulo = ($row->event_titulo);
						$event_banner = ($row->event_banner);
						$event_data = fct_formatdate($row->event_data, 'd/m/Y');
						$event_hrs_ini = ($row->event_hrs_ini);

						$link_evento = site_url('evento/'. $event_id .'-'. $event_urlpage);
						$evento_banner = base_url($folder_upload) . $event_banner; 
				?>
					<div class="card card-plus" style="background-image: url('<?php echo($evento_banner); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
						<div class="row">
							<div class="col-12 col-md-8">
							</div>
							<div class="col-12 col-md-4">
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
	</section>

	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Banner Patrocinado</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-12"> 
					<div class="card card-patrocinador" style="background-image: url('assets/media/banner_consumer-min.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
						<!-- banner patrocinador -->
					</div>
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
		.owl-nav{
			position: absolute;
			bottom: -20px;
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
		}
		.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
			color: black !important;
			font-size: 2rem !important;
			margin: 0 12px !important;
		}
		.item-slider{
			height: 80vh;
			/*border: 1px dotted red;*/
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
		}
		.box-featured{}
		.box-featured .item{ text-align: center; }
		.box-featured .item .itemIcon{
			height: 120px;
			width: 120px;
			
			border-radius: 50%;
			cursor: pointer;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			/*border: 1px solid white;*/
			margin-bottom: 10px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.box-featured .item .itemIcon:hover{
			background: #ffffff;
		}
		.box-featured .item .itemIcon img{
			max-width: 60%;
		}

		.card-destaque{
			height: 140px;
			background: #fff7f1;
			/* border: 0px; */
			border-radius: .5rem;
			border: 1px solid #ffc08f;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
		.card-plus{
			height: 460px;
			background: #fff7f1;
			/* border: 0px; */
			border-radius: .5rem;
			border: 1px solid #ffc08f;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
		.card-patrocinador{
			height: 280px;
			background: #d3d3d3;
			/* border: 0px; */
			border-radius: .5rem;
			border: 3px solid #ffffff;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}

		.image-fix-blur{
			z-index: -1;
			position: fixed;
			left: 0;
			width: 100%;
			height: 100%;
			filter: blur(12px);
			-webkit-filter: blur(12px);            
			/*background-image: url('../images/logo-evento.jpeg');*/
			background-position: center center;
			background-size: cover;
			background-repeat: no-repeat;	
		}
		.image-fix-blur:before{
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgb(0 0 0 / 75%);
		}
		.bg_slider{
			height: 60vh;
			/*background-image: url('http://localhost/ja-feston/dev-ci4/public/files-upload/tango-001__banner__1701865528_Zo4E.jpg');*/
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center right;		
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<link rel="stylesheet" href="assets/plugins/OwlCarousel2-2.3.4//dist/assets/owl.carousel.min.css" />
	<script src="assets/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>

	<script>
	$(document).ready(function(){
		//$('.owl-carousel').owlCarousel();
		$('.owl-carousel').owlCarousel({
			//loop:true,
			margin:10,
			nav:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			}
		})

	});
	</script>

<?php $this->endSection('scripts'); ?>