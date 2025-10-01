
<?php 
	$curso_titulo = (isset($rs_workshop->curso_titulo) ? $rs_workshop->curso_titulo : ''); 
	$curso_conteudo = (isset($rs_workshop->curso_conteudo) ? $rs_workshop->curso_conteudo : '');
	$curso_local = (isset($rs_workshop->curso_local) ? $rs_workshop->curso_local : '');
	$curso_nome_professor = (isset($rs_workshop->curso_nome_professor) ? $rs_workshop->curso_nome_professor : '');
	$curso_vagas = (int)(isset($rs_workshop->curso_vagas) ? $rs_workshop->curso_vagas : '');
	$curso_foto_professor = (isset($rs_workshop->curso_foto_professor) ? $rs_workshop->curso_foto_professor : '');
	
	// verificar se existe a imagem
	$foto = $folder_upload .'/workshops/'. $curso_foto_professor;
	if( !file_exists($foto) || empty($curso_foto_professor) ){	
		$foto = "assets/media/avatar-04.jpg"; 
	}
	
	$list_rs_estados = (isset($rs_estados) ? $rs_estados : []);	
?>

<div class="content-step current justify-content-center align-items-center flex-column h-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-11 col-md-12">

				<div class="row mb-3">
					<div class="col-12 col-md-12">
						<h1><?php echo($curso_titulo); ?></h1>	
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-4">
						<div class="card card-workshop">
							<div class="card-header text-center">
								<div class="workshops-avatar-bg" style="margin: 0 auto; background-image: url('<?php echo( $foto ); ?>');"></div>
							</div>
							<div class="card-body text-center">
								<div class="work-item pb-2">
									<h2 style="font-size: 1.5rem; color: #FFF; font-weight: 600;"><?php echo( $curso_nome_professor ); ?></h2>
								</div>

								<div class="pt-2 pb-2"> 
									<h3 class="m-0"><?php echo( $curso_vagas ); ?> vagas</h3>
									<label class="vagas"><?php echo( $quant_vagas_disponiveis ); ?> vagas disponíveis</label>
								</div>

								<div class="pt-2 pb-2">
									<h3 style="font-size: 2rem; color: #FFF; font-weight: 600;">R$ 60,00</h3>
								</div>
							</div>
						</div>
						<div class="pt-3 text-center">
							<div class="d-grid">
								<a href="javascript:;" class="btn btn-primary" style="border-radius: .25rem;" data-bs-toggle="modal" data-bs-target="#modal_premiacoes" >Quero Participar</a>
							</div>
						</div>						
					</div>
					<div class="col-12 col-md-8">
						<div class="mb-3 pb-2 text-end bd-separar">
							<label style="font-size: .8rem; font-size: 0.8rem; line-height: 1; display: block;">local</label>
							<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: "><?php echo( nl2br($curso_local) ); ?></p>
						</div>
						<div class="pb-3">
							<?php if( isset( $rs_workshops_datas )) { ?>
								<!-- <?php print_r( $rs_workshops_datas ); ?> -->
							<div class="row justify-content-start g-1 grid-event-datas">
								<?php
								$count = 0;
								foreach ($rs_workshops_datas->getResult() as $row) {
									$count++;
									//$curso_id = (int)$row->curso_id;
									//$curso_hashkey = ($row->curso_hashkey);
									$crsdte_data = fct_formatdate($row->crsdte_data, 'd/m');
									$crsdte_hrs_ini = ($row->crsdte_hrs_ini);
									$crsdte_hrs_ini = DateTime::createFromFormat('H:i:s', $row->crsdte_hrs_ini)->format('H:i');
									//$crsdte_hrs_ini = fct_formatdate($row->crsdte_hrs_ini, 'H:m');
									//$curso_nome_professor = ($row->curso_nome_professor);
									//$curso_local = ($row->curso_local);
									////$curso_titulo = ($row->curso_titulo);
									////$event_data = fct_formatdate($row->event_data, 'd/m/Y');
									//$link_form = painel_url('workshops/form/'. $curso_id);
								?>
								<div class="col-auto">
									<div class="data-itens active">
										<h3><?php echo($crsdte_data); ?></h3>
										<p>Sexta-feira</p>
										<h3><?php echo($crsdte_hrs_ini); ?></h3>
									</div>
								</div>
								<?php
								} // foreach
								?>
							</div>
							<?php } ?>
						</div>
						<?php echo( nl2br($curso_conteudo) ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
			border: 1px solid #ffa902;
			padding: 12px 6px;
			background-color: #ffa902;
			min-width: 112px;
			text-align: center;
			/*cursor: pointer;*/
			border-radius: 4px;
		}
		.grid-event-datas .data-itens:hover,
		.grid-event-datas .data-itens.active{
			border: 1px solid #ffa902;
			background-color: #ffa902;
		}
		/*.grid-event-datas .data-itens:hover:before,*/
		/*.grid-event-datas .data-itens.active:before{*/
		/*	content: '';*/
		/*	position: absolute;*/
		/*	top: 100%;*/
		/*	left: calc(50% - 15px);*/
		/*	border-left: 15px solid transparent;*/
		/*	border-right: 15px solid transparent;*/
		/*	border-top: 10px solid var(--highlight-color, #15c57d);		*/
		/*}*/

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
		.card.card-workshops .card-body .item.disabled{ 
			background-color: #cbcbcb;
			background-color: #ffb3b3;
			background-color: #ff7373;
			background-color: #bbbbbb;
			opacity: .5;
		}
		.card.card-workshops .card-body .item.disabled .workshops-avatar-bg{
			filter: grayscale(1) !important;
		}
		.card.card-workshops .card-body .item .mrVagasDisp{
			position: absolute;
			top: -6px;
			right: -6px;
			color: #626262;
			font-size: .70rem;
			display: flex;
			flex-direction: column;
			line-height: 1;
			align-items: center;
			justify-content: center;
			background-color: white;
			border-radius: 50%;
			padding: 6px;
			border: 3px solid #cbcbcb;
		}
		.card.card-workshops .card-body .item .mrVagasDisp span{ color: #000000; font-size: 1.25rem; font-weight: bold; }
		.card.card-workshops .card-body .item label{ display: block; font-size: .80rem; }
		.card.card-workshops .card-body .item label.data{ display: block; font-size: .70rem; }
		.card.card-workshops .card-body .item h4{ font-size: 1.0rem; font-weight: bold; padding-right: 24px; }
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




		.card.card-workshops .card-body .item-check{ 
			position: relative;
			margin-bottom: 1.0rem;
			background-color: #9cefa6;
			padding: .5rem 1rem;
			border-radius: 4px;	
			box-shadow: 1px 1px 4px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshops .card-body .item-check label{ display: block; font-size: .80rem; }
		.card.card-workshops .card-body .item-check label.data{ display: block; font-size: .70rem; }
		.card.card-workshops .card-body .item-check h4{ font-size: 0.85rem; font-weight: normal; }		



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
		
		.modal-header {
			border-bottom: 0px solid #dee2e6;
			background-color: #ffa902;
		}
		.modal-title {
			font-weight: bold;
			color: white;
		}
		.modal-content {
			/*background-color: #faa602;*/
			border: 0px solid rgba(0, 0, 0, .2);
			border-radius: 8px;
			box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);
		}		
	</style>

<?php $this->endSection('headers'); ?>


<?php $this->section('scripts'); ?>

	<script>
		let LIST_ESTADOS = <?php echo( json_encode($list_rs_estados) ); ?>;	
	</script>
	
<?php $this->endSection('scripts'); ?>
