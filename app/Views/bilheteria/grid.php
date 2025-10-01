<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 

	$arr_legenda = (object)[
		(object)["color" => "#3a78c3", "legenda" => "Disponível", "icon" => "", "classe" => "seatDisponivel" ],
		(object)["color" => "#ffd633", "legenda" => "Selecionado", "icon" => "", "classe" => "seatSelecionado" ],
		(object)["color" => "#3a78c3", "legenda" => "Cadeirante", "icon" => '<i class="fas fa-wheelchair"></i>', "classe" => "seatCadeirante" ],
		(object)["color" => "#3a78c3", "legenda" => "Obeso", "icon" => '<i class="fas fa-arrows-alt-h"></i>', "classe" => "seatObeso" ],
		(object)["color" => "#70c870", "legenda" => "Ocupado", "icon" => '<i class="fas fa-user"></i>', "classe" => "seatOcupado" ],
		(object)["color" => "#ff9595", "legenda" => "Reservado", "icon" => "", "classe" => "seatReservado" ],
	];
	$arr_legenda = (object)[
		(object)["color" => "#3a78c3", "legenda" => "Disponível", "icon" => "", "classe" => "seatDisponivel" ],
		(object)["color" => "#ffa902", "legenda" => "Selecionado", "icon" => "", "classe" => "seatSelecionado" ],
		(object)["color" => "#3a78c3", "legenda" => "Cadeirante", "icon" => '<i class="fas fa-wheelchair"></i>', "classe" => "seatCadeirante" ],
		(object)["color" => "#3a78c3", "legenda" => "Obeso", "icon" => '<i class="fas fa-arrows-alt-h"></i>', "classe" => "seatObeso" ],
		(object)["color" => "#70c870", "legenda" => "Ocupado", "icon" => '<i class="fas fa-user"></i>', "classe" => "seatOcupado" ],
		(object)["color" => "#ff0000", "legenda" => "Reservado", "icon" => "", "classe" => "seatReservado" ],
	];
	//print_r( $arr_legenda );
	//exit();
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Bilheteria > Ballerina Dance Academy</h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsInscricao" id="formFieldsInscricao" ref="formFieldsInscricao" enctype="multipart/form-data">

					<div class="row">
						<div class="col-12 col-md-9">

							<div class="mb-4">
								<div class="card card-default">
									<div class="card-body">

										<div class="pb-3">
											<h3>Selecione os assentos para o evento no dia <strong>25.10.2024</strong></h3>
										</div>

										<div id="layoutContainer" class="layout-container">
											<div class="d-flex justify-content-center pb-3 front-palco">
												<div>Frente / Palco</div>
											</div>

											<div class="rowSeat">
												<div class="seatCol">I</div>
												<div class="seatClick seatNum seatReservado"><i class="fas fa-wheelchair"></i></div>
												<div class="seatClick seatNum seatReservado">2</div>
												<div class="seatClick seatNum seatReservado">3</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum seatReservado">4</div>
												<div class="seatClick seatNum seatReservado">5</div>
												<div class="seatClick seatNum seatReservado">6</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum seatReservado">7</div>
												<div class="seatClick seatNum seatReservado">8</div>
												<div class="seatClick seatNum seatReservado">9</div>
												<div class="seatCol left">I</div>
											</div>
											<div class="rowSeat">
												<div class="seatCol">A</div>
												<div class="seatClick seatNum "><i class="fas fa-wheelchair"></i></div>
												<div class="seatClick seatNum "><i class="fas fa-wheelchair"></i></div>
												<div class="seatClick seatNum ">3</div>
												<div class="seatClick seatNum seatSelect"><i class="fas fa-user"></i></div>
												<div class="seatClick seatNum "></div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">6</div>
												<div class="seatClick seatNum ">7</div>
												<div class="seatClick seatNum seatSelect"><i class="fas fa-user"></i></div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">9</div>
												<div class="seatClick seatNum ">10</div>
												<div class="seatClick seatNum ">11</div>
												<div class="seatClick seatNum "><i class="fas fa-wheelchair"></i></div>
												<div class="seatClick seatNum "><i class="fas fa-wheelchair"></i></div>
												<div class="seatCol left">A</div>
											</div>
											<div class="rowSeat">
												<div class="seatCol">B</div>
												<div class="seatClick seatNum ">1</div>
												<div class="seatClick seatNum ">2</div>
												<div class="seatClick seatNum ">3</div>
												<div class="seatClick seatNum ">4</div>
												<div class="seatClick seatNum ">5</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">6</div>
												<div class="seatClick seatNum ">7</div>
												<div class="seatClick seatNum ">8</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">9</div>
												<div class="seatClick seatNum ">10</div>
												<div class="seatClick seatNum ">11</div>
												<div class="seatClick seatNum ">12</div>
												<div class="seatClick seatNum ">13</div>
												<div class="seatCol left">B</div>
											</div>
											<div class="rowSeat">
												<div class="seatCol">C</div>
												<div class="seatClick seatNum "><i class="fas fa-arrows-alt-h"></i></div>
												<div class="seatClick seatNum "><i class="fas fa-arrows-alt-h"></i></div>
												<div class="seatClick seatNum ">3</div>
												<div class="seatClick seatNum ">4</div>
												<div class="seatClick seatNum ">5</div>
												<div class="seatClick seatNum ">6</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">7</div>
												<div class="seatClick seatNum ">8</div>
												<div class="seatClick seatNum ">9</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">10</div>
												<div class="seatClick seatNum ">11</div>
												<div class="seatClick seatNum ">12</div>
												<div class="seatClick seatNum ">13</div>
												<div class="seatClick seatNum "><i class="fas fa-arrows-alt-h"></i></div>
												<div class="seatClick seatNum "><i class="fas fa-arrows-alt-h"></i></div>
												<div class="seatCol left">C</div>
											</div>
											<div class="rowSeat">
												<div class="seatCol">D</div>
												<div class="seatClick seatNum ">1</div>
												<div class="seatClick seatNum ">2</div>
												<div class="seatClick seatNum ">3</div>
												<div class="seatClick seatNum seatSelecionado">4</div>
												<div class="seatClick seatNum seatSelecionado">5</div>
												<div class="seatClick seatNum ">6</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">7</div>
												<div class="seatClick seatNum ">8</div>
												<div class="seatClick seatNum ">9</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">10</div>
												<div class="seatClick seatNum ">11</div>
												<div class="seatClick seatNum ">12</div>
												<div class="seatClick seatNum ">13</div>
												<div class="seatClick seatNum ">14</div>
												<div class="seatClick seatNum ">15</div>
												<div class="seatCol left">D</div>
											</div>
											<div class="rowSeat">
												<div class="seatCol">E</div>
												<div class="seatClick seatNum ">1</div>
												<div class="seatClick seatNum ">2</div>
												<div class="seatClick seatNum ">3</div>
												<div class="seatClick seatNum seatReservado">4</div>
												<div class="seatClick seatNum ">5</div>
												<div class="seatClick seatNum ">6</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">7</div>
												<div class="seatClick seatNum ">8</div>
												<div class="seatClick seatNum ">9</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">10</div>
												<div class="seatClick seatNum ">11</div>
												<div class="seatClick seatNum ">12</div>
												<div class="seatClick seatNum ">13</div>
												<div class="seatClick seatNum ">14</div>
												<div class="seatClick seatNum ">15</div>
												<div class="seatCol left">E</div>
											</div>
											<div class="rowSeat">
												<div class="seatCol">F</div>
												<div class="seatClick seatNum ">1</div>
												<div class="seatClick seatNum ">2</div>
												<div class="seatClick seatNum ">3</div>
												<div class="seatClick seatNum ">4</div>
												<div class="seatClick seatNum ">5</div>
												<div class="seatClick seatNum ">6</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">7</div>
												<div class="seatClick seatNum ">8</div>
												<div class="seatClick seatNum ">9</div>
												<div class="seatEmpty"></div>
												<div class="seatClick seatNum ">10</div>
												<div class="seatClick seatNum ">11</div>
												<div class="seatClick seatNum ">12</div>
												<div class="seatClick seatNum ">13</div>
												<div class="seatClick seatNum ">14</div>
												<div class="seatClick seatNum ">15</div>
												<div class="seatCol left">F</div>
											</div>
											<div class="rowSeat">
												<div class="seatCol">M</div>
												<div class="seatClick seatNum ">1</div>
												<div class="seatClick seatNum ">2</div>
												<div class="seatClick seatNum ">3</div>
												<div class="seatClick seatNum ">4</div>
												<div class="seatClick seatNum ">5</div>
												<div class="seatClick seatNum ">6</div>
												<div class="seatClick seatNum ">7</div>
												<div class="seatClick seatNum ">8</div>
												<div class="seatClick seatNum ">9</div>
												<div class="seatClick seatNum ">10</div>
												<div class="seatClick seatNum ">11</div>
												<div class="seatClick seatNum ">12</div>
												<div class="seatClick seatNum ">13</div>
												<div class="seatClick seatNum ">14</div>
												<div class="seatClick seatNum ">15</div>
												<div class="seatClick seatNum ">16</div>
												<div class="seatClick seatNum ">17</div>
												<div class="seatClick seatNum ">18</div>
												<div class="seatClick seatNum ">19</div>
												<div class="seatCol left">M</div>
											</div>
										</div>
			
									</div>
								</div>
							</div>

						</div>
						<div class="col-12 col-md-3">
							
							<div class="mb-4" style="height: calc(100% - 1.5rem) !important;">
								<div class="card card-default h-100 mb-4">
									<div class="card-header text-center" style="background-color: #ffffff; padding: .5rem 0rem; border: 0;">
										<div class="card card-destaque" style="background-image: url('http://localhost/ja-feston/dev/public/files-upload/ballerina-dance-academy__banner__1701865173_2fMu.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 100px; border:0;"></div>
									</div>
									<div class="card-header text-center" style="background-color: #ffffff; padding: .5rem 0rem;">
										Resumo do Pedido
									</div>
									<div class="card-body" style="background-color: #ffffff; padding: .5rem 0rem;">
										
										<div class="d-flex justify-content-between" style="font-weight: 600;">
											<div>Assentos</div>
											<div>D4, D5</div>
										</div>

									</div>
									<div class="card-footer" style="background-color: #ffffff; padding: .5rem 0rem;">

										<div class="d-flex justify-content-between" style="line-height: 1.5; font-weight: 300;">
											<div>Itens</div>
											<div>2</div>
										</div>

										<div class="d-flex justify-content-between" style="line-height: 1.5; font-weight: 300;">
											<div>Total Taxas</div>
											<div>R$ 6,00</div>
										</div>
										
										<div class="d-flex justify-content-between" style="line-height: 1.5; font-weight: 600;">
											<div>Total</div>
											<div>R$ 120,00</div>
										</div>

										<div class="d-grid pt-4">
											<a href="javascript:;" class="btn btn-warning">CONTINUAR</a>
										</div>
									</div>
								</div>

								<div class="card card-workshop d-none">
									<div class="card-header text-center">
										<div class="workshops-avatar-bg" style="margin: 0 auto; background-image: url('assets/media/avatar-04.jpg');"></div>
									</div>
									<div class="card-body text-center">
										
										<div class="work-item pb-2">
											<h2 class="mb-1" style="font-size: 1.5rem; color: #FFF; font-weight: 600;">Jefferson Prodit</h2>
											<h4 class="mb-1" style="font-size: 1.0rem; color: 000; font-weight: 600;">Clássicos na Atualidade</h4>
										</div>
										
										<div style="padding: 1rem;">
											<div class="mb-3 pb-2 text-start bd-separar-left">
												<label style="font-size: .8rem; font-size: 0.8rem; display: block;">data e horário</label>
												<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">01.07.2024 11h30</p>
											</div>
											<div class="pb-2 text-start bd-separar-left">
												<label style="font-size: .8rem; font-size: 0.8rem; display: block;">local</label>
												<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">Rio de Janeiro</p>
											</div>
										</div>

									</div>
								</div>
							</div>
						
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-9">

							<div class="card card-default" style="padding: 8px 30px !important;">
								<div class="card-body">
									<h4 class="pb-2">Legenda dos Assentos</h4>

									<div class="d-flex flex-column flex-lg-row">
									<?php
										foreach ($arr_legenda as $key => $val) {
											// $arr[3] será atualizado com cada valor de $arr...
											//echo "{$chave} => {$valor} ";
											//print_r($arr);
											$legenda = $val->legenda;
											$classe = $val->classe;

											$bg = 'background-color: '. $val->color .' !important;';
											$border = 'border-color: '. $val->color .' !important;';
											$icon = $val->icon;
									?>
										<div class="rowSeatLegenda" style="margin-right:15px;">
											<a href="javascript:;" class="selectSeats" data-classe="<?php echo($classe); ?>"><div class="seatNum " style="<?php echo($bg); ?> <?php echo($border); ?>">
												<!-- <i class="fas fa-check"></i> -->
												<?php echo($icon); ?>
											</div></a>
											<div class="seatLegenda"><?php echo($legenda); ?></div>
										</div>
									<?php
										}
									?>
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
		.front-palco{
			color: gray;
		}
		.front-palco div{
			width: 100%;
			text-align: center;
			background-color: #e8e8e8;
			color: black;
			border-bottom: 2px solid #3a78c3;
		}
        .seatNum {
            width: 30px;
            height: 30px;
            margin: 3px;
            background-color: #3a78c3;
            border: 1px solid #3a78c3;
            /*display: inline-block;*/
            text-align: center;
            /*line-height: 30px;*/
			text-align: center;
			border-radius: 4px;
			font-weight: normal;
			box-shadow: 0px .2rem .5rem rgb(0 0 0 / 50%) !important;
			color: #FFFFFF;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: .65rem;
        }
        .seatNum.seatBlock {
            background-color: #ffbaba;
            border: 1px solid #ffbaba;
			color: #FFFFFF;
        }
        .seatNum.seatSelect {
            background-color: #70c870;
            border: 1px solid #70c870;
			color: #FFFFFF;
        }

		<?php
			foreach ($arr_legenda as $key => $val) {
				$legenda = $val->legenda;
				$classe = $val->classe;

				$bg = 'background-color: '. $val->color .' !important;';
				$border = 'border-color: '. $val->color .' !important;';

				echo('.seatNum.'. $classe .' { background-color: '. $val->color .'; border: 1px solid '. $val->color .'; }');
			}
		?>

		.seatClick{ cursor: pointer; }

		.rowSeatLegenda.active{
			/*border: 1px dashed #e6e6e6;*/
			border-radius: 4px;
			background-color: #e6e6e6;		
		}

		/*.selectSeats i{ display: block; }*/
		/*.selectSeats.active i{ display: block; }*/
        .seatEmpty {
            width: 30px;
            height: 30px;
            margin: 3px;
            /*display: inline-block;*/
        }
		.seatCol {
			width: 30px;
            margin: 3px 5px;
			text-align: center;
			/*padding-right: 10px;*/
		}

        .rowSeat {
            margin-bottom: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
        }
        .rowSeatLegenda {
            margin-bottom: 0px;
			display: flex;
			align-items: center;
			justify-content: start;
        }
        .rowSeatLegenda .seatNum {
            width: 20px;
            height: 20px;
            margin: 2px 3px;
			box-shadow: 0px .12rem .25rem rgb(0 0 0 / 50%) !important;
        }
		.seatLegenda {
			min-width: 60px;
			width: auto;
            margin: 3px;
			text-align: left;
			padding-left: 10px;
		}
        .layout-container {}
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
        function addColumn() {
            const columnName = document.getElementById('columnName').value;
            const columnSeats = document.getElementById('columnSeats').value;
            
            const columnDiv = document.createElement('div');
            columnDiv.className = 'rowSeat';
            columnDiv.innerHTML = `<div class="seatCol"><strong>${columnName}</strong>:</div>`;

            let seatNumber = 1;

            for (let char of columnSeats) {
                const seatDiv = document.createElement('div');
                if (char === 'X') {
                    seatDiv.className = 'seatNum';
                    seatDiv.textContent = seatNumber++;
                } else {
                    seatDiv.className = 'seatEmpty';
                }
                columnDiv.appendChild(seatDiv);
            }

            document.getElementById('layoutContainer').appendChild(columnDiv);

            // Clear input fields
            document.getElementById('layoutForm').reset();
        }
    </script>

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