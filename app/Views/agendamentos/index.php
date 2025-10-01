<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<!-- <div class="row"> -->
			<!-- 	<div class="col-12 col-md-12"> -->
			<!-- 		<h3>Workshop > Clássicos na Atualidade</h3> -->
			<!-- 	</div> -->
			<!-- </div> -->
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsInscricao" id="formFieldsInscricao" ref="formFieldsInscricao" enctype="multipart/form-data">
					<div class="row">
						<div class="col-12 col-md-12">


							<!-- OCULTOS -->
							<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
							<div class="row d-none" style="margin-top: 200px;">
								<div class="col-12 col-md-12">

									<!-- Step 1 -->
									<div class="h-100" v-show="step == 1" >
										<?php 
											$includeDetalhes = view('jurados/detalhes', []);
											echo( $includeDetalhes );
										?>
									</div>

									<!-- Step 2 -->
									<div class="h-100" v-show="step == 2" >
										<?php 
											$includeInscricao = view('workshops/form-inscricao', []);
											echo( $includeInscricao );
										?>
									</div>

									<!-- Step 3 -->
									<div class="h-100" v-show="step == 3" >
										<?php 
											$includeCobranca = view('workshops/cobranca', []);
											echo( $includeCobranca );
										?>
									</div>

									<!-- Step 4 -->
									<div class="h-100" v-show="step == 4" >
										<?php 
											$includeConfirmacao = view('workshops/confirmacao', []);
											echo( $includeConfirmacao );
										?>
									</div>

								</div>
							</div>
							<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


							<div class="card card-workshops mb-4">
								<div class="card-body p-0">
									<div class="item" style="background-color: #9b9b9b;">
										<div class="row justify-content-center align-items-center">
											<div class="col-12 text-center">
												<h2 style="color: white;">Agendamentos</h2>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card card-default mb-4" style="padding: 24px !important;">
								<div class="card-body p-0">

									<div class="row align-items-center">
										<div class="col-3">
											<div class="form-group">
												<label class="form-label" for="event_multiplicado_ensaio">Data do Ensaio</label>
												<select name="" id="" class="form-select" value="" />
													<option>- selecione -</option>
													<option selected>18/07/2024</option>	
													<option>19/07/2024</option>
													<option>20/07/2024</option>
												</select>
											</div>
										</div>
										<div class="col-3">
											<div class="form-group">
												<label class="form-label" for="event_multiplicado_ensaio">Horário Desejado</label>
												<input type="text" name="event_multiplicado_ensaio" id="event_multiplicado_ensaio" class="form-control" value="" placeholder="00:00" />
											</div>
										</div>
										<div class="col-6">
											As reservas precisam ser feitas com pelo menos: <strong>01:30h</strong> de antecedência
										</div>
									</div>

								</div>
							</div>

							<!-- COREOGRAFIAS -->
							<div class="card card-default mb-4" style="padding: 24px !important;">
								<div class="card-body p-0">

									<!-- <h3>Coreografias</h3> -->

									<?php
										$arr_coreografias = [
											["titulo" => 'Core Número 1',  "cidade" => 'São Paulo', "estado" => 'SP', "tempo" => '05:00'],
											["titulo" => 'Core Número 2', "cidade" => 'São Paulo', "estado" => 'SP', "tempo" => '05:00'],
											["titulo" => 'Core Número 3', "cidade" => 'São Paulo', "estado" => 'SP', "tempo" => '05:00'],
											["titulo" => 'Core Número 4', "cidade" => 'São Paulo', "estado" => 'SP', "tempo" => '05:00'],
										];
									?>

									<div class="row">
										<div class="col-10">
											<?php
												foreach ($arr_coreografias as $key => $val) {
													$titulo = $val['titulo'];
													$cidade = $val['cidade'];
													$estado = $val['estado'];
													$tempo = $val['tempo'];
											?>
											<div class="apresentAgend" style="margin-bottom:1px; height: auto !important;">
												<div class="row align-items-center">
													<div class="col">
														<div class="row align-items-center">
															<div class="col-12 col-md-4 ">
																<div class="apresent-item text-start">
																	<h2 style="color: #000; font-weight: bold;"><?php echo($titulo) ?></h2>
																</div>
															</div>
															<div class="col-12 col-md-8 ">
																<div class="d-flex justify-content-around align-items-center">
																	<div class="apresent-item">
																		<h4><?php echo($cidade) ?></h4>
																	</div>
																	<div class="apresent-item">
																		<h4><?php echo($estado) ?></h4>
																	</div>
																	<div class="apresent-item">
																		<h4 style="color: #000; font-weight: bold;"><?php echo($tempo) ?></h4>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?
												}
											?>
										</div>
										<div class="col-2 text-center">
											<div class="h-100 d-flex align-items-center justify-content-center" style="background-color: #fea802; border-radius: 4px; padding: 10px;">
												<div>
													<h2 style="font-size: 1.5rem;">Tempo Total</h2>
													<h2 style="font-size: 2.0rem; font-weight: bold;">20:00</h2>
												</div>
											</div>
										</div>
									</div>

									<div class="row align-items-center mt-1">
										<div class="col-10"></div>
										<div class="col-2 text-center">
											<div class="d-grid">
												<a href="javascript:;" class="btn btn-warning" style="border-radius: 4px;" data-bs-toggle="modal" data-bs-target="#modal_agendamentos">Agendar</a>
											</div>
										</div>
									</div>


									<div class="apresentAgend mb-1" style="height: auto !important; opacity: .5; display: none;">
										<div class="row align-items-center">
											<div class="col-12 col-md-auto col-number ">
												<div class="number">1</div>
											</div>
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>
															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												
											</div>
										</div>
									</div>

									<div class="apresentAgend mb-1" style="height: auto !important; opacity: .5; display: none;">
										<div class="row align-items-center">
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Coreografia Número 2</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>
															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												
											</div>
										</div>
									</div>
		
								</div>
							</div>

							<!-- Sugestão para agendamento -->
							<div class="card card-default mb-4 d-none" style="padding: 24px !important;">
								<div class="card-body p-0">

									<h3>Sugestão para agendamento</h3>

									<div class="apresentAgend active" style="margin-bottom:1px; height: auto !important;">
										<div class="row align-items-center">
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around align-items-center">
															<div class="apresent-item">
																<h4>Rio de Janeiro</h4>
															</div>
															<div class="apresent-item">
																<h4>RJ</h4>
															</div>
															<div class="apresent-item">
																<h4>20:00</h4>
															</div>
															<div class="apresent-item">
																<h4 style="color: #000; font-weight: bold;">19:20 / 19:30</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentAgend active" style="margin-bottom:1px; height: auto !important;">
										<div class="row align-items-center">
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Vento Cativante</h2>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around align-items-center">
															<div class="apresent-item">
																<h4>Rio de Janeiro</h4>
															</div>
															<div class="apresent-item">
																<h4>RJ</h4>
															</div>
															<div class="apresent-item">
																<h4>20:00</h4>
															</div>
															<div class="apresent-item">
																<h4 style="color: #000; font-weight: bold;">17:30 / 17:50</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>

							<!-- Agendamentos Confirmados -->
							<div class="card card-default mb-4" style="padding: 24px !important;">
								<div class="card-body p-0">

									<h3>Agendamentos Confirmados</h3>

									<div class="apresentAgend" style="margin-bottom:1px; height: auto !important;">
										<div class="row align-items-center">
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribalta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around align-items-center">
															<div class="apresent-item">
																<h4>Rio de Janeiro</h4>
															</div>
															<div class="apresent-item">
																<h4>RJ</h4>
															</div>
															<div class="apresent-item">
																<h4>35:00</h4>
															</div>
															<div class="apresent-item">
																<h4 style="color: #000; font-weight: bold;">18:10 / 18:45</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentAgend" style="margin-bottom:1px; height: auto !important;">
										<div class="row align-items-center">
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Vento Cativante</h2>
															<h3>Companhia Alegre de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around align-items-center">
															<div class="apresent-item">
																<h4>Rio de Janeiro</h4>
															</div>
															<div class="apresent-item">
																<h4>RJ</h4>
															</div>
															<div class="apresent-item">
																<h4>20:00</h4>
															</div>
															<div class="apresent-item">
																<h4 style="color: #000; font-weight: bold;">19:00 / 19:20</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentAgend active" style="margin-bottom:1px; height: auto !important;">
										<div class="row align-items-center">
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Vento Cativante</h2>
															<h3>Companhia Alegre de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around align-items-center">
															<div class="apresent-item">
																<h4>Rio de Janeiro</h4>
															</div>
															<div class="apresent-item">
																<h4>RJ</h4>
															</div>
															<div class="apresent-item">
																<h4>20:00</h4>
															</div>
															<div class="apresent-item">
																<h4 style="color: #000; font-weight: bold;">19:20 / 19:30</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentAgend" style="margin-bottom:1px; height: auto !important;">
										<div class="row align-items-center">
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Gigantes Leves</h2>
															<h3>Companhia de Dança da Serra</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around align-items-center">
															<div class="apresent-item">
																<h4>Rio de Janeiro</h4>
															</div>
															<div class="apresent-item">
																<h4>RJ</h4>
															</div>
															<div class="apresent-item">
																<h4>30:00</h4>
															</div>
															<div class="apresent-item">
																<h4 style="color: #000; font-weight: bold;">19:30 / 20:00</h4>
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

	$rs_categorias = (isset($rs_categorias) ? $rs_categorias : []);
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>
	<style>
		.list-itens-agendamento{ margin: 30px; }
		.list-itens-agendamento ul{ list-style: none; margin: 0; padding: 0; }
		.list-itens-agendamento ul li{ 
			background-color: #cfcfcf;
			border-color: #cfcfcf;
			border-radius: .25rem;
			padding: 8px 16px;
			margin: 2px 0;
			cursor: pointer;
			display: flex;
			justify-content: space-between;
		}
		.list-itens-agendamento ul li.active,
		.list-itens-agendamento ul li:hover{ 
			background-color: #ffa902; 
			border-color: #ffa902;
		}


		.apresentAgend{
			padding: 8px 16px;
			background-color: #dddddb;
			height: 50px;
			border-radius: 4px;
			color: black;	
			height: 100%;
			width: 100%;
		}
		.apresentAgend.active{
			padding: 16px;
			background-color: #fea802;
			height: 50px;
			border-radius: 4px;
			color: white;	
			height: 100%;
			width: 100%;
		}
		.apresentAgend .apresent-item { position: relative; }
		.apresentAgend .apresent-item:before {
			display: none;
			content: '';
			position: absolute;
			bottom: 4px;
			left: calc(50% - 60px);
			/* border-bottom: 1px solid white; */
			width: 120px;
			/* margin: 0 auto; */
			border-bottom: 1px solid;
			border-image-slice: 1;
			border-width: 1px;
			border-image-source: linear-gradient(to left, rgb(255 255 255 / 0%), rgb(255 255 255), rgb(255 255 255 / 0%));
		}
		.col-number{ width: 80px; }
		.apresentAgend .number{ font-size: 2rem; color: #a4a4a4; font-weight: 600; margin: 0; }
		.apresentAgend .apresent-item h2 { font-size: 1.15rem; color: #a4a4a4; font-weight: 600; margin: 0; }
		.apresentAgend .apresent-item h3 { font-size: .85rem; color: #a4a4a4; font-weight: 300; margin: 0; }
		.apresentAgend .apresent-item label { font-size: 0.7rem; color: #a4a4a4; }
		.apresentAgend .apresent-item h4 { line-height: 1; font-size: .9rem; font-weight: 400; margin: 0; color: #a4a4a4; }
		.apresentAgend h5 { line-height: 1; font-size: .9rem; margin: 0; margin-bottom: 4px; color: #a4a4a4; }
		.apresentAgend.active .col-number{ width: 100px; }
		.apresentAgend.active .number{ font-size: 2.4rem; color: #000; font-weight: 600; margin: 0; }
		.apresentAgend.active h2{ color: #000; }
		.apresentAgend.active h3{ color: #000; }
		.apresentAgend.active h4{ color: #000; }


		.d-order-exibicao{}
		.d-order-exibicao .oxItem{ 
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 6px;
			height: 40px;
			width: auto;
			min-width: 70px;
			margin: 0 2px;
			padding: 2px 12px;
			background: #5e5e5e;
			border-radius: 4px;
			font-weight: normal;
			color: white;
		}
		.d-order-exibicao .oxItem.active{
			background: #ffa902;
			font-weight: 600;
		}
		.mic{
			position: relative;
			margin: 0px 8px;
			margin-right: 16px;
			width: 30px;
			height: 30px;
			background-color: red;
			color: white;
			border-radius: 50%;		
		}
		.mic:before{
			content: '';
			position: absolute;
			top: -4px;
			left: -4px;
			width: 38px;
			height: 38px;
			border: 2px solid rgb(255,255,255, 50%);
			border-radius: 50%; 
		}
		.inputAval{
			background-color: #dddddb;
			height: 50px;
			font-size: 2rem;
			border-radius: 4px;
			color: #28447a;
			height: 100%;
			width: 100%;
			padding: 4px 8px;
			font-weight: 900;
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

		.nomebailarino{ font-size: .8rem; line-height: 1.2; }


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

		.card.card-workshops .card-body .item.itemModal {
			position: relative;
			margin-bottom: 1.0rem;
			background-color: transparent;
			padding: 1rem;
			border-radius: 8px;
			box-shadow: none; 
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

		.modal-backdrop.show {
			opacity: .9;
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

	<div class="modal fade" tabindex="-1" id="modal_agendamentos">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Horários Disponíveis</h5>
					<a href="javascript:;" class="" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem; color: black;">
						<i class="far fa-times-circle"></i>
					</a>
				</div>
				<div class="modal-body" style="max-height: 70vh; overflow: auto;">
					<div class="box-list-premiacoes">

						<div class="list-itens-agendamento">
							<ul>
								<li>
									<div>
										<input type="checkbox" class="d-none" />
										<h4>das 17:00 às 17:20</h4>
									</div>
								</li>
								<li>
									<div>
										<input type="checkbox" class="d-none" />
										<h4>das 17:20 às 17:40</h4>
									</div>
								</li>
								<li class="active">
									<div>
										<input type="checkbox" class="d-none" />
										<h4>das 17:40 às 18:40</h4>
									</div>
									<div><i class="far fa-check-circle"></i></div>
								</li>
								<li>
									<div>
										<input type="checkbox" class="d-none" />
										<h4>das 19:20 às 19:30</h4>
									</div>
								</li>
							</ul>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<div class="d-flex justify-content-center w-100">
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-primary" style="border-radius: 8px;">Confirmar</button>
						</div>
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Fechar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->endSection('modals'); ?>

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
	$(document).ready(function () {
		$('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",
			allowInput: true
		});		
	});
	</script>

	<script type="text/javascript" src="assets/vue/utils.js?t=<?= $time ?>"></script>
	<script type="text/javascript" src="assets/vue/jurados.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>