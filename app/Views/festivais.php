<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Eventos Recentes</h3>
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
					<h3>Banner Patrocinador</h3>
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
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<script>
	</script>

<?php $this->endSection('scripts'); ?>