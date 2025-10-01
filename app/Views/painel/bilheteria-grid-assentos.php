<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

	//$vendedores_count = (isset($vendedores_count) ? $vendedores_count : 0);
	//$produtos_count = (isset($produtos_count) ? $produtos_count : 0);
	//$pedidos_count = (isset($pedidos_count) ? $pedidos_count : 0);

	//$session_id = (int)(isset($session_id) ? $session_id : ''); 
	//$session_nome =(isset($session_nome) ? $session_nome : ''); 
	//$session_permissao = (int)(isset($session_permissao) ? $session_permissao : ''); 
	//$session_label_permissao = (isset($session_label_permissao) ? $session_label_permissao : '');
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Gerenciamento de Grid de Assentos</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default mb-3">
							<div class="card-body p-0">
								<div class="row justify-content-center">
									<div class="col-12 col-md-3">
										<!-- <div> -->
										<!-- 	Informe a Coluna (A, B, C) -->
										<!-- </div> -->

										<!-- <div> -->
										<!-- 	Distribuia a colunas usando X e _ -->
										<!-- </div> -->

										<form id="layoutForm">
											<div class="pb-3">
												<label for="columnName" class="m-0">Fileira (informe A, B, C, etc ...):</label>
												<input type="text" id="columnName" name="columnName" required>
											</div>
											<div class="pb-3">
												<label for="columnSeats" class="m-0">Assentos (X para assento e _ para espaço):</label>
												<input type="text" id="columnSeats" name="columnSeats" required>
											</div>
											<button type="button" class="btn btn-sm btn-warning" onclick="addColumn()">Adicionar Fileira de Assentos</button>
										</form>

										<?php
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
												(object)["color" => "#ffd633", "legenda" => "Selecionado", "icon" => "", "classe" => "seatSelecionado" ],
												(object)["color" => "#ff0000", "legenda" => "Cadeirante", "icon" => '<i class="fas fa-wheelchair"></i>', "classe" => "seatCadeirante" ],
												(object)["color" => "#3a78c3", "legenda" => "Obeso", "icon" => '<i class="fas fa-arrows-alt-h"></i>', "classe" => "seatObeso" ],
												(object)["color" => "#ff0000", "legenda" => "Ocupado", "icon" => '<i class="fas fa-user"></i>', "classe" => "seatOcupado" ],
												(object)["color" => "#ff9595", "legenda" => "Reservado", "icon" => "", "classe" => "seatReservado" ],
											];
											//print_r( $arr_legenda );
											//exit();
										?>
										<div class="pt-5">
											<h4 class="pb-2">Legenda dos Assentos</h4>

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
												<div class="rowSeatLegenda">
													<a href="javascript:;" class="selectSeats" data-classe="<?php echo($classe); ?>"><div class="seatNum " style="<?php echo($bg); ?> <?php echo($border); ?>">
														<!-- <i class="fas fa-check"></i> -->
														<?php echo($icon); ?>
													</div></a>
													<div class="seatLegenda"><?php echo($legenda); ?></div>
												</div>
											<?php
												}
											?>
											<div class="pt-3" style="line-height: 1.25;">
												Selecione o tipo de assento conforma a legenda e em seguida selecione os assentos no grid
											</div>

											<!--
											<div class="rowSeatLegenda">
												<div class="seatClick seatNum  seatBlock">&nbsp;</div>
												<div class="seatLegenda">Reservado</div>
											</div>
											<div class="rowSeatLegenda">
												<div class="seatClick seatNum  seatSelect">&nbsp;</div>
												<div class="seatLegenda">Selecionado</div>
											</div>
											<div class="rowSeatLegenda">
												<div class="seatClick seatNum ">&nbsp;</div>
												<div class="seatLegenda">Livre</div>
											</div>
											-->
										</div>
									</div>
									<div class="col-12 col-md-9">

										<div class="card card-base mb-3">
											<div class="card-header text-center">
												Visualização do Grid
											</div>
											<div class="card-body">

												<div id="layoutContainer" class="layout-container">
													<div class="d-flex justify-content-center pb-3 front-palco">
														<div>Frente / Palco</div>
													</div>

													<div class="rowSeat">
														<div class="seatCol">I</div>
														<div class="seatClick seatNum seatBlock"><i class="fas fa-wheelchair"></i></div>
														<div class="seatClick seatNum seatBlock">2</div>
														<div class="seatClick seatNum  seatBlock">3</div>
														<div class="seatEmpty"></div>
														<div class="seatClick seatNum  seatBlock">4</div>
														<div class="seatClick seatNum  seatBlock">5</div>
														<div class="seatClick seatNum  seatBlock">6</div>
														<div class="seatEmpty"></div>
														<div class="seatClick seatNum  seatBlock">7</div>
														<div class="seatClick seatNum  seatBlock">8</div>
														<div class="seatClick seatNum  seatBlock">9</div>
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
														<div class="seatCol">B:</div>
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
													</div>
													<div class="rowSeat">
														<div class="seatCol">C:</div>
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
													</div>
													<div class="rowSeat">
														<div class="seatCol">D:</div>
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
													</div>
													<div class="rowSeat">
														<div class="seatCol">E:</div>
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
													</div>
													<div class="rowSeat">
														<div class="seatCol">F:</div>
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
													</div>
													<div class="rowSeat">
														<div class="seatCol">M:</div>
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
		</div>
	</div>



<?php
	$this->endSection('content'); 
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.list_cart{
			margin: 3px 0;
		}
		.list_cart a{
			border: 1px solid #ebeced;
			padding: 8px;
			display: block;
			border-radius: 0.25rem;
			color: #000;
		}
		.list_cart a:hover{
			background-color: #edeeef;
			color: #000;
		}
		.table th {
			color: #303e67;
			font-weight: 500;
			vertical-align: middle;
			border-color: #4f4f4f;
			background-color: #f8f8f8;
		}
		.table-box {
			width: 100%;
			border: 1px solid  #f2f2f2;
			border-radius: 0.35rem !important;
			padding: 8px;
		}
		.table td {
			border-color: #dee2e6 !important;
			/*border-width: 1px !important;*/
			vertical-align: top;
		}

		div.dataTables_wrapper div.dataTables_length select {
			width: auto;
			display: inline-block;
			padding-top: 0.25rem !important;
			padding-bottom: 0.25rem !important;
			padding-left: 0.5rem !important;
			padding: 0.375rem 2.25rem 0.375rem 0.75rem !important;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button {
			padding: 0 !important;
			margin-left: 2px !important;
			border: 0px solid transparent !important;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
			border: 0px solid #fff !important;
			background-color: #585858 !important;
			background-color: #ffffff !important;
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #ffffff));
			background: -webkit-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: -moz-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: -ms-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: -o-linear-gradient(top, #ffffff 0%, #ffffff 100%);
			background: linear-gradient(to bottom, #ffffff 0%, #ffffff 100%);
			box-shadow: inset 0 0 3px #ffffff;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button:active {
			outline: none;
			background-color: #ffffff !important;
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #ffffff)) !important;
			background: -webkit-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: -moz-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: -ms-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: -o-linear-gradient(top, #ffffff 0%, #ffffff 100%) !important;
			background: linear-gradient(to bottom, #ffffff 0%, #ffffff 100%) !important;
			box-shadow: inset 0 0 3px #ffffff !important;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<style>
		.front-palco{
			color: gray;
		}
		.front-palco div{
			width: 90%;
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

	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/jquery.dataTables.css" rel="stylesheet">
	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>

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