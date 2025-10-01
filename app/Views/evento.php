<?php 
	$this->extend('templates/template_default');
	$this->section('content');
	
	$event_hashkey = (isset($rs_event->event_hashkey) ? $rs_event->event_hashkey : "");
	$event_titulo = (isset($rs_event->event_titulo) ? $rs_event->event_titulo : "");
	$event_data = (isset($rs_event->event_data) ? $rs_event->event_data : "");
	$event_banner = (isset($rs_event->event_banner) ? $rs_event->event_banner : "");
	$evento_banner = base_url($folder_upload) . $event_banner; 
	//$checked = (($event_encerrar_inscricoes == 1) ? 'checked' : '');

	$event_encerrar_inscricoes = (isset($rs_event->event_encerrar_inscricoes) ? $rs_event->event_encerrar_inscricoes : "");
?>
	<section class="pb-4 " style="position:relative; height: 80vh; border: 0px dotted red;">
		<!-- <div style="height: 100%; background-image:url('<?php echo($evento_banner); ?>');"></div> -->
		<div class="item-slider d-flex align-items-center" style="position:relative !important; border-bottom: 2px solid white;overflow: hidden;">
			<div class="image-fix-blur-SP" style="position:absolute !important; background-image:url('<?php echo($evento_banner); ?>');"></div>
			<div class="container" style="position: relative;">
				<div class="row justify-content-center align-items-center">
					<div class="col-12 col-md-11">
						<div class="text-center">
							<img src="<?php echo($evento_banner); ?>" class="img-fluid-evento" >
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php if( $event_encerrar_inscricoes == 1 ){ ?>
	<section class="pb-4" style="margin-top: -20px; position: relative;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-5 text-center">
					<h3>INSCRIÇÕES ENCERRADAS</h3>
				</div>
			</div>
		</div>
	</section>
	<?php }else{ ?>
	<section class="pb-4" style="margin-top: -20px; position: relative;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-5">
					<div class="d-grid">
						<a href="<?php echo( site_url('inscricoes/'. $event_hashkey) ); ?>" class="btn btn-primary text-center">INSCRIÇÕES</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>



	<section class="pt-4 pb-4">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-12">
					<div>
						<h1 style="font-weight: bold;"><?php echo( $event_titulo ); ?></h1>
					</div>
					<div><?php echo( $event_data ); ?></div>
					<div>localização</div>
					<hr class="linha">
				</div>
			</div>




			<div class="row justify-content-center">
				<div class="col-12 col-md-12">
					<?php
					if( isset($rs_dados_datas) ){
					?>
					<div class="row g-1 grid-event-datas">
						<?php
							$col = 0;
							foreach ($rs_dados_datas->getResult() as $rowEvDte) {
								$col++;
								$evdte_data = ($rowEvDte->evdte_data);
								$evdte_data = fct_formatdate($rowEvDte->evdte_data, 'd/m');
								$evdte_hrs_ini = ($rowEvDte->evdte_hrs_ini);

								$evdte_day_week = fct_formatdate($rowEvDte->evdte_data, 'd/m', '{semana}');
							?>
								<div class="col-auto">
									<div class="data-itens <?php echo( $col == 1 ? 'active' : '');?>">
										<h3><?php echo($evdte_data)?></h3>
										<p><?php echo($evdte_day_week)?></p>
										<h5><?php echo($evdte_hrs_ini)?></h5>
									</div>
								</div>
							<?php
							}
						?>
					</div>
					<?php
					}
					?>
				</div>
			</div>


			<div class="row justify-content-center pt-3">
				<div class="col-12 col-md-8">
					<p>Lorem ipsum dolor sit amet. Est aliquam commodi sed recusandae inventore aut aperiam incidunt. Sit autem molestiae aut fugit cupiditate aut quae consequatur qui accusamus nihil nam ducimus accusantium. </p><p>Est temporibus voluptatem ex consequatur illum aut voluptatem laborum sed alias iusto vel omnis similique sit omnis molestias sed commodi quidem. Sit consequatur perspiciatis qui iste nihil 33 quod voluptatem. </p><p>Et repudiandae voluptate qui numquam incidunt aut nisi soluta sed quaerat minima. Sit nisi nemo id vitae alias aut nihil veniam sed velit modi aut incidunt illum et quae Quis. Sit Quis atque est rerum placeat ex consequuntur necessitatibus aut excepturi debitis et saepe asperiores sit nisi corporis. Est deleniti asperiores id adipisci commodi qui similique doloremque qui provident placeat rem dolorem repudiandae aut voluptatem iste. </p>
				</div>
				<div class="col-12 col-md-4">

					<div class="card card-credenciamento mb-3 d-none" style="">
						<div class="card-header" style="">
							<img src="<?php echo($evento_banner); ?>" class="img-fluid" >
						</div>
						<div class="card-body">
							<div class="item text-center">
								<h3>Mostra Competitiva</h3>
							</div>

							<div class="item">
								<label>Grupo</label>
								<h4>NOME DO GRUPO</h4>
							</div>

							<div class="item">
								<label>Participante</label>
								<h4>NOME DO PARTICIPANTE</h4>
							</div>

							<div class="item">
								<label>Função</label>
								<h4>FUNÇÃO</h4>
							</div>

							<div class="item">

								<div class="row justify-content-center">
									<div class="col-12 col-md-8">
										<label>Categoria</label>
										<h4>CATEGORIA</h4>
									</div>
									<div class="col-12 col-md-4">
										<label>Idade</label>
										<h4>26</h4>
									</div>
								</div>
							</div>

							<div class="item text-center">
								<div class="row justify-content-center">
									<div class="col-12 col-md-6">

										<div class="personal-image">
											<label class="label">
												<input type="file" />
												<figure class="personal-figure">
													<div class="personal-avatar-bg" style="background-image: url('assets/media/icon-profile2.png');"></div>
												</figure>
											</label>
										</div>
									
									</div>
								</div>
							</div>

							<div class="text-center mb-2">
								<div class="row justify-content-center">
									<div class="col-12 col-md-4">
										<div><img src="assets/media/qrcode-credenciamento.png" class="img-fluid" ></div>
									</div>
								</div>
							</div>

							<div class="item text-center">
								<label>cpf</label>
								<h4>000.000.000-00</h4>
							</div>
						</div>
					</div>

					<!--<div class="card card-workshops mb-3" style="">
						<div class="card-header" style="">
							<h2>WORKSHOPS</h2>
							#<img src="<?php echo($evento_banner); ?>" class="img-fluid" >  
						</div>
						<div class="card-body">


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
							<a href="<?php echo($link_workshop); ?>" style="z-index: 99; position: relative;  display: block; width: 100%;">
							<div class="item">
								<div class="row justify-content-center align-items-center">
									<div class="col-12 col-md-auto">
										<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-04.jpg');"></div>
									</div>
									<div class="col-12 col-md">
										<h4><?php echo($curso_titulo); ?></h4>
										<label><?php echo($curso_nome_professor); ?></label>
										<label class="data">início em 01.07.2024</label>
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
							</a>
							<?php
								}
							}
							?>

							<a href="<?php echo(site_url('workshops')); ?>"><div class="item">
								<div class="row justify-content-center align-items-center">
									<div class="col-12 col-md-auto">
										<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg');"></div>
									</div>
									<div class="col-12 col-md">
										<h4>Um novo mundo na dança</h4>
										<label>Angela Cortez Villas</label>
										<label class="data">início em 15.10.2024</label>
										<div class="tag-vagas">30 vagas</div>
										<div class="box-address">
											<div>
												<label class="local">local</label>
												<label class="address">São Paulo</label>
											</div>
											<div class="tag-valor"><span>R$</span>42,70</div>
										</div>
									</div>
								</div>
							</div></a>

							<a href="<?php echo(site_url('workshops')); ?>"><div class="item">
								<div class="row justify-content-center align-items-center">
									<div class="col-12 col-md-auto">
										<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg');"></div>
									</div>
									<div class="col-12 col-md"> 
										<h4>Dança Contemporânea</h4>
										<label>Ana Cláudia Carvalho</label>
										<label class="data">início em 20.09.2024</label>
										<div class="box-address">
											<div>
												<label class="local">local</label>
												<label class="address">Rio de Janeiro</label>
											</div>
											<div class="tag-valor"><span>R$</span>35,00</div>
										</div>
									</div>
								</div>
							</div></a>

						</div>
					</div>-->





					<div class="card d-none">
						<div class="card-body">
							teste
							<div>
								<img src="assets/media/front-qrcode-credenciamento.jpeg" class="img-fluid" />
							</div>
						</div>
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
		.card.card-credenciamento{ background-color: #FFFFFF; border-color: #ffa902; }
		.card.card-credenciamento .card-header{ background-color: #ffa902; border-color: #ffa902; padding: 1rem 1rem; }
		.card.card-credenciamento .card-body h3{ font-weight: bold; font-size: 1.25rem; }
		.card.card-credenciamento .card-body .item{ margin-bottom: 0.5rem; }
		.card.card-credenciamento .card-body .item label{ font-size: .70rem; }
		.card.card-credenciamento .card-body .item h4{ font-size: .85rem; font-weight: bold; }
		
		.img-fluid-evento{
			max-height: 98%;
			border-radius: .5rem;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 2px solid white;
			/* width: 100%; */
			max-height: 70vh;
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
			border: 1px solid white;
			margin-bottom: 10px;
		}
		.box-featured .item .itemIcon:hover{
			background: #f0a234;
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
			height: 140px;
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
		.item-slider{
			height: 80vh;
			/*border: 1px dotted red;*/
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
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
		/*.image-fix-blur:before{*/
		/*	content: '';*/
		/*	position: absolute;*/
		/*	top: 0;*/
		/*	left: 0;*/
		/*	width: 100%;*/
		/*	height: 100%;*/
		/*	background-color: rgb(0 0 0 / 75%);*/
		/*}*/

		.image-fix-blur-SP{
			position: absolute;
			z-index: -1;
			bottom: -10%;
			top: -10%;
			left: -10%;
			right: -10%;
			filter: blur(24px);
			background-size: cover;
			/* background-repeat: repeat-y; */
		}
		.bg_slider{
			height: 60vh;
			/*background-image: url('http://localhost/ja-feston/dev-ci4/public/files-upload/tango-001__banner__1701865528_Zo4E.jpg');*/
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center right;		
		}


		.grid-event-datas{}
		.grid-event-datas .data-itens{
			position: relative;
			border: 1px solid #f49328;
			padding: 12px 6px;
			background-color: #f49328;
			min-width: 112px;
			text-align: center;
			cursor: pointer;
		}
		.grid-event-datas .data-itens:hover,
		.grid-event-datas .data-itens.active{
			border: 1px solid #15c57d;
			background-color: #15c57d;
		}
		.grid-event-datas .data-itens:hover:before,
		.grid-event-datas .data-itens.active:before{
			content: '';
			position: absolute;
			top: 100%;
			left: calc(50% - 15px);
			border-left: 15px solid transparent;
			border-right: 15px solid transparent;
			border-top: 10px solid var(--highlight-color, #15c57d);		
		}

		.grid-event-datas .data-itens p{
			color: #FFFFFF;
			margin: 0;
			padding: 0;
		}
		.grid-event-datas .data-itens h3{
			color: #FFFFFF;
			margin: 0;
			padding: 0;
		}
		.grid-event-datas .data-itens h5{
			color: #FFFFFF;
			margin: 0;
			padding: 0;
		}




		.personal-image {
			text-align: center;
		}
		.personal-image input[type="file"] {
			display: none;
		}
		.personal-figure {
			position: relative;
			width: 90px;
			height: 90px;
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
			width: 85px;
			height: 85px;
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


		.card.card-workshops{ background-color: transparent; border-color: #ffa902; border: none; }
		.card.card-workshops .card-header{ 
			padding: 0;
			background-color: transparent;
			border-bottom: 1px dashed #ffa902;
			/*background-color: #ffa902; border-color: #ffa902;*/
		}
		.card.card-workshops .card-header h2{ 
			font-weight: bold;	
		}
		.card.card-workshops .card-body h3{ font-weight: bold; font-size: 1.25rem; }
		.card.card-workshops .card-body { 
			padding: 1rem 0;
			display: flex;
			flex-direction: column;
		}
		.card.card-workshops .card-body a{
			color: #000 !important; text-decoration: none;
		}
		.card.card-workshops .card-body .item{ 
			position: relative;
			margin-bottom: 1.0rem;
			background-color: #ffa902;
			padding: 1rem;
			border-radius: 8px;	
			box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshops .card-body .item label{ display: block; font-size: .80rem; }
		.card.card-workshops .card-body .item label.data{ display: block; font-size: .70rem; }
		.card.card-workshops .card-body .item h4{ font-size: 1.0rem; font-weight: bold; }
		.card.card-workshops .tag-vagas{
			position: absolute;
			top: 5px;
			right: 5px;
			background-color: #FFF;
			font-size: .70rem;
			color: #000;
			padding: 4px;
			font-weight: bold;
			border-radius: 4px;		
		}
		.card.card-workshops .card-body .item .box-address{
			display: flex;
			justify-content: space-between;
			margin-top: 6px;
			padding-top: 6px;
			background-color: transparent;
			border-top: 1px dashed #FFFFFF;

		}
		.card.card-workshops .card-body .item .box-address .local{
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

	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<script>
	</script>

<?php $this->endSection('scripts'); ?>