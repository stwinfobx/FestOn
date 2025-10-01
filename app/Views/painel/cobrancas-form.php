<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

	$arr_traducoes = [
		'bank_transfer' => 'Transferência Bancária',
		'ticket' => 'Boleto Bancário',
		'credit_card' => 'Cartão de Crédito',
		'debit_card' => 'Cartão de Débito',
		'approved' => 'Aprovado',
		'pending' => 'Pendente',
		'rejected' => 'Rejeitado',
		'cancelled' => 'Cancelado',
		'pix' => 'Pix',
		'accredited' => 'Pagamento Realizado',
		'pending_waiting_transfer' => 'Aguardando Transferência',
		'mercado-pago' => 'Mercado Pago',
	];

	$ped_status = (int)(isset($rs_pedido->ped_status) ? $rs_pedido->ped_status : "");
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col">
				<h2 class="page-title">Cobrança</h2>
			</div>
			<div class="col-auto">
				<?php 
					$w_data['etapa'] = 'cobrancas';
					$inputFile = view('painel/widgets/etapas-cadastro', $w_data);
					echo( $inputFile );
				?>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsRegistro" id="formFieldsRegistro" enctype="multipart/form-data">

				<?php
					//print_debug( $lista_de_coreografias );
					//exit();
				?>

				<?php
				if( !isset($rs_transacoes) ){
				?>

					<div class="pt-5">
						<div class="alert alert-default alert-primary d-flex justify-content-center align-items-center" role="alert">
							<div class="text-center">
								<h4>Não há cobranças relacionados a este grupo</h4>
							</div>
						</div>
					</div>

				<?php
				}else{ // else rs_transacoes
				?>

					<div class="mb-3" style="padding: 12px; border-radius: 6px; background-color: rgb(221, 221, 221);">
						<div class="row align-items-start mb-4">
							<div class="col-12 col-md-12">
								<h3 class="mb-3">Informações do Pagamento</h3>

								<div class="row align-items-start">
									<div class="col-12 col-md-3">

										<div class="">
											<div style="font-size: 0.75rem;">GateWay de pagamento</div>
											<div style="font-size: 20px; font-weight: 700;">
												<?php
													$ped_payment = (isset($rs_pedido->ped_payment) ? $rs_pedido->ped_payment : "");
													$ped_payment = ( isset($arr_traducoes[$ped_payment]) ? $arr_traducoes[$ped_payment] : $ped_payment );
													echo($ped_payment);
												?>
											</div>
										</div>

									</div>
									<div class="col-12 col-md-3">
									</div>
									<div class="col-12 col-md-3">
									</div>
								</div>
							</div>
						</div>

						<div class="row align-items-start">
							<div class="col-12 col-md-12">
								<h3>Transações</h3>
								<table id="example3" class="display nowrap table table-striped table-bordered m-0" style="width: 100%; background-color: white; border-radius: 8px;">
									<thead>
										<tr>
											<td style="width: 200px;"><strong>Código de Identificação</strong></td>
											<td style="width: 225px;"><strong>Status</strong></td>
											<td><strong>Método Pagto</strong></td>
											<td style="width: 200px;"><strong>Efetuar Pagamento</strong></td>
										</tr>
									</thead>
									<tbody>
								<?php
								if( isset($rs_transacoes) ){ 
									foreach ($rs_transacoes As $row ) {
										$pgto_referencia = $row->pgto_referencia;
										$pgto_code_checkout = $row->pgto_code_checkout;
										$css_pgto_status = $row->pgto_status;
										$pgto_status = $row->pgto_status;
										$pgto_status = ( isset($arr_traducoes[$pgto_status]) ? $arr_traducoes[$pgto_status] : $pgto_status );
										$pgto_json = json_decode($row->pgto_json);

										$link_segunda_via = site_url('inscricoes/pagamento/segunda-via/'. $pgto_code_checkout);

										//print_r( $row->pgto_json );
										//print_r( $pgto_json );
										/*
										{
											"external_reference":"YX8WRH-0001",
											"status":"approved",
											"status_detail":"accredited",
											"installments":1,
											"payment_type_id":"bank_transfer",
											"payment_method_id":"pix",
											"date_of_expiration":"2024-05-23T12:17:17.000-04:00"}
										*/

										$type_pagto = (isset($pgto_json->payment_type_id) ? $pgto_json->payment_type_id : '');
										$type_pagto = ( isset($arr_traducoes[$type_pagto]) ? $arr_traducoes[$type_pagto] : $type_pagto );
										$method_pagto = (isset($pgto_json->payment_method_id) ? $pgto_json->payment_method_id : '');
										$method_pagto = ( isset($arr_traducoes[$method_pagto]) ? $arr_traducoes[$method_pagto] : $method_pagto );
										$parcelas_pagto = (isset($pgto_json->installments) ? $pgto_json->installments : '');
										$vencto_pagto = (isset($pgto_json->date_of_expiration) ? $pgto_json->date_of_expiration : '');
										$lblVenctoPagto = "";
										if( !empty($vencto_pagto) ){
											$venctoPagto = new DateTime($vencto_pagto);
											$lblVenctoPagto = $venctoPagto->format('d/m/Y H:i');
										}

										$status_detail = (isset($pgto_json->status_detail) ? $pgto_json->status_detail : '');
										$css_status_detail = $status_detail;
										$status_detail = ( isset($arr_traducoes[$status_detail]) ? $arr_traducoes[$status_detail] : $status_detail );

										// campos para retorno:
										// - date_of_expiration --> vencimento do boleto
										// payment_type_id  --> identicação do tipo de pagamento feito
											// credit_card // ticket 
										//  installments --> parcelamento

										// Se o pedido estiver APROVADO
										// irá bloquear os demais botões 

										$disabled_link = (($ped_status == "approved") ? 'disabled-link' : ''); 
								?>
										<tr>
											<td><?php echo( $pgto_referencia ); ?></td>
											<td>
												<div class="d-flex justify-content-between align-items-center" style="gap: 4px;">
													<div class="d-flex flex-column" style="gap: 4px; width: calc(100% - 40px);">
														<div class="tagStatus <?php echo( $css_pgto_status ); ?>"><?php echo( $pgto_status ); ?></div>
														<div class="tagStatus <?php echo( $css_status_detail ); ?>"><?php echo( $status_detail ); ?></div>
													</div>
													<div>
														<a href="javascript:;" class="btn btn-sm btn-ac btn-warning cmdReloadStatus <?php echo( $disabled_link ); ?>"><i class="las la-sync"></i></a>
													</div>
												</div>
											</td> 
											<td>
												<div class="d-flex justify-content-between" style="gap:16px;">
													<div style="width: 50%;">
														<div><?php echo( $type_pagto ); ?></div>
														<div><?php echo( $method_pagto ); ?></div>
													</div>
													<div style="width: 50%;">
														<div><?php echo( !empty($parcelas_pagto) ? "Parcelas: ". $parcelas_pagto : "" ); ?></div>
														<div><?php echo( !empty($lblVenctoPagto) ? "Data: ". $lblVenctoPagto : "" ); ?></div>
													</div>
												</div>
											</td> 
											<td>
												<?php if( $css_pgto_status != "approved" ){ ?>
												<div>
													<a href="<?php echo( $link_segunda_via ); ?>" target="blank" class="btn btn-warning btn-sm <?php echo( $disabled_link ); ?>">Segunda-Via</a>
												</div>
												<?php } ?>
											</td> 
										</tr>
								<?php
									} // end foreach
								} // end if
								?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				<?php
				} // end if isset : rs_transacoes
				?>




				<?php
				if( isset($lista_de_coreografias) ){
				?>
				<div class="row align-items-start">
					<div class="col-12 col-md-12">
						<?php
						$total_geral = 0;
						foreach ($lista_de_coreografias['coreografias'] as $keyCor => $valCor ) {
							//print $valCor['corgf_id'];

							$elenco = $valCor['elenco'];
						?>
							<div class="mb-3" style="padding: 12px; border-radius: 6px; background-color: rgb(221, 221, 221);">
								<div class="pb-3">
									<div>
										<h3 class="m-0 p-0"><?php echo($valCor['corgf_titulo']); ?></h3>
									</div>
									<div class="d-flex" style="gap: 10px; font-size: 0.75rem;">
										<div class="itemDots"><?php echo($valCor['modl_titulo']); ?></div> 
										<div class="itemDots"><?php echo($valCor['formt_titulo']); ?></div> 
										<div class="itemDots"><?php echo($valCor['categ_titulo']); ?></div>
									</div>
								</div>

								<div>
									<table id="example3" class="display nowrap table table-striped table-bordered m-0" style="width: 100%; background-color: white; border-radius: 8px;">
										<thead>
											<tr>
												<td>
													<strong>Nome</strong>
												</td>
												<td><strong>Função</strong></td> 
												<td><strong>CPF</strong></td>
												<td class="text-end"><strong>Valor Unit.</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($elenco as $keyPartc => $valPartc ) {
												//[partc_id] => 10
												//[partc_hashkey] => VzNZwgeK87knCD9lAXpberPYqisTwJQN
												//[partc_nome] => Diretor 4 - alterar
												//[partc_documento] => 328.877.510-77
												//[func_id] => 3
												//[func_titulo] => Coreógrafo
												//[valor] => 12.00
												//[desconto] => 0.00
											?>
											<tr>
												<td><div><?php echo($valPartc['partc_nome']); ?></div></td> 
												<td><div><?php echo($valPartc['func_titulo']); ?></div></td> 
												<td><div><?php echo($valPartc['partc_documento']); ?></div></td>
												<td class="text-end"><div><?php echo($valPartc['valor']); ?></div></td>
											</tr>
											<?php
											} // end foreach
											?>
										</tbody>
									</table>
									<?php
										$valores_totais_por_participantes = (isset($valCor['valores_totais_por_participantes']) ? $valCor['valores_totais_por_participantes'] : '');
										$valor_por_coreografia = (isset($valCor['valor']) ? $valCor['valor'] : '');
										$valor_total_coreografia = (isset($valCor['valor_total_coreografia']) ? $valCor['valor_total_coreografia'] : '');

										$total_geral = $total_geral + $valor_total_coreografia;
									?>
									<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
										<div style="width: 300px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;">Valor total por participantes</h3>
										</div>
										<div style="width: 160px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;"><?php echo(fct_to_money($valores_totais_por_participantes)); ?></h3>
										</div>
									</div>

									<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
										<div style="width: 300px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;">Valor por coreografia</h3>
										</div>
										<div style="width: 160px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;"><?php echo(fct_to_money($valor_por_coreografia)); ?></h3>
										</div>
									</div>

									<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
										<div style="width: 300px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.5rem;">SubTotal</h3>
										</div>
										<div style="width: 160px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.5rem;"><?php echo(fct_to_money($valor_total_coreografia)); ?></h3>
										</div>
									</div>

								</div>
							</div>
						<?php
						}
						?>
						<div class="d-flex justify-content-end">
							<div>
								<label style="font-size: 0.9rem;">Total Geral</label> 
								<h3 style="color: rgb(0, 0, 0); font-size: 1.75rem;"><?php echo(fct_to_money($total_geral)); ?></h3>
							</div>
						</div>
					</div>
				</div>
				<?php
				} // end if : lista_de_coreografias
				?>

				</FORM>

			</div>
		</div>
	</div>



<?php
	$this->endSection('content'); 
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		a.disabled-link {
			pointer-events: none;
			color: gray !important;
			text-decoration: none;
			opacity: .75;
			background-color: #CCC;
			color: gray !important;
			border: none !important;
		}
		.tagStatus{
			font-size: .75rem;
			color: black;
			border-radius: 4px;
			padding: 0px 8px;
			line-height: 16px;
			/*margin-bottom: 2px;*/
			background-color: #c3c3c3;
		}
		.tagStatus.approved{ background-color: #91ee91; }
		/*.tagStatus.accredited{*/
		/*	background-color: #c3c3c3;*/
		/*	color: white;*/
		/*}*/
		.tagStatus.pending{ background-color: #ffadad; }


		pre{ max-height: 250px !important;} 
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
	</style>
	<style>
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

<?php $this->section('scripts'); ?>

	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/jquery.dataTables.css" rel="stylesheet">
	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- Styles -->
	<link href="assets/plugins/jquery-filer/css/jquery-filer.css" rel="stylesheet">
	<link href="assets/plugins/jquery-filer/css/themes/jquery-filer-dragdropbox-theme.css" rel="stylesheet">
	
	<style>
		.box-img-principal{
			border:1px solid #e2e2e2; 
			border-radius: .25rem; 
			padding: 8px;
			box-shadow: 0 4px 10px 1px rgb(223 223 223 / 6%), 0 1px 4px rgb(0 0 0 / 4%) !important;
		}
		/* 
			PLUGIN DE UPLOAD DE ARQUIVOS 
		*/
		.jFiler-input-dragDrop.fileUnico {
			width: 100% !important;
			padding: 20px !important;
			font-family: "Product Sans", sans-serif !important;
			background: #FAFAFA !important;
			border-radius: 30px !important;
			border: 1.5px solid #5356FB30 !important;
		}
		.jFiler-input-dragDrop:hover{ background-color: #e0e8f5 !important; }
		.jFiler-input-dragDrop .jFiler-input-flex{
			display: flex !important;
			justify-content: center !important;
			align-items: center !important;
			flex-direction: column !important;
		}
		.jFiler-input-flex .jFiler-input-item{ margin: 0 5px !important; }
		.jFiler-input-flex .jFiler-input-item .jFiler-input-text h3 { font-size: 1rem !important; }

		.jFiler-items-grid .jFiler-item .jFiler-item-container {
			border-radius: 0.25rem !important;
			border-radius: 30px !important;
			margin: 0 !important;
			padding: 0 !important;
			height: 100% !important;
			background: #fff;
			background: #FAFAFA !important;
			-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			-moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			box-shadow: 0 4px 10px 1px rgb(223 223 223 / 6%), 0 1px 4px rgb(0 0 0 / 4%) !important;
		}

		/* 100 / 6 = 16.66667 */
		.grid-tile-wrapper.fileUnico {
			display: grid;
			grid-gap: 15px;
			grid-template-columns: repeat(auto-fit, minmax(calc(100% - 0px), calc(100% - 0px)));
			grid-auto-rows: 200px;
			grid-auto-flow: dense;
		}
		.grid-tile-item {
			grid-column: span 1;
			grid-row: span 1;
		}
		.jFiler-items-grid .jFiler-item .jFiler-item-container .jFiler-item-thumb {
			position: relative;
			width: 100% !important;
			height: 145px;
			min-height: 115px;
			overflow: hidden;
			border: 0px solid #e1e1e1;
			border-radius: 0.25rem;
			border-radius: 30px !important;
			border-bottom-left-radius: .25rem !important;
			border-bottom-right-radius: .25rem !important;
		}
	</style>

	<script src="assets/plugins/jquery-filer/js/jquery-filer.js" type="text/javascript"></script>
	<script src="assets/js/jquery-filer-custom.js" type="text/javascript"></script>

	<script>
		//let LIST_PRODUTOS = [];
		//let LIST_STATUS = [];
		//let CLIENTE_ID = '<?php echo( $cliente_id ); ?>';
		function converterParaMinutosESegundosOLD(segundos) {
			var minutos = Math.floor(segundos / 60);
			var segundosRestantes = segundos % 60;
			return minutos + "min e " + segundosRestantes + "seg";
		}
		function converterParaMinutosESegundos(segundos) {
			var minutos = Math.floor(segundos / 60);
			var segundosRestantes = segundos % 60;
			return minutos +":"+ segundosRestantes;
		}
		var tempoTotal = 0;
		//$("#fileInputSelector").change(function() {
		//	var quantidadeDeArquivos = this.files.length;
		//	for (var i = 0; i < quantidadeDeArquivos; i++) {
		//		var esteArquivo = this.files[i];
		//		fileB = URL.createObjectURL(esteArquivo);

		//		var audioElement2 = new Audio(fileB);
		//		audioElement2.setAttribute('src', fileB);
		//		audioElement2.onloadedmetadata = function(e) {
		//			tempoTotal = tempoTotal + parseInt(this.duration);
		//			//$("#musicas").html("Músicas Carregadas: " + quantidadeDeArquivos + " (Tempo Total: " + converterParaMinutosESegundos(tempoTotal) + ")");
		//			//$("#musicas").html("Tempo: " + converterParaMinutosESegundos(tempoTotal));
		//			$("#tempo_musica").val(converterParaMinutosESegundos(tempoTotal));
		//		//alert("loadedmetadata" + tempoTotal);
		//		}
		//	}
		//	tempoTotal = 0;
		//});

	</script>

	<script>
		$(document).ready(function () {
			$(document).on('click', '.changeFormato', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $formt_id = $this.val();

				// ------------------------------------------------------
				let $formData = {
					formt_id: $formt_id
				};

				$.ajax({
					url: painel_url  +'coreografias/ajaxform/TEMPO-MUSICA-MAX-PARTIC',
					method:"POST",
					type: "POST",
					dataType: "json",
					data: $formData,
					crossDomain: true,
					beforeSend: function(response) {
						console.log('1 beforeSend');
						console.log(response);
					},
					complete: function(response) { 
						//console.log('3 complete');
						//console.log(response);
					},
					success:function(response){
						console.log('2 success');
						console.log(response);


						$("#tempo-maximo").html( response.formt_tempo_limit );
						$("#numero-maximo-participantes").html( response.formt_max_partic );
					},
					error: function (jqXHR, textStatus, errorThrown) {
					}
				});
				// ------------------------------------------------------
			});
			$(document).on('click', '.cmdFiltrar', function (e) {
				e.preventDefault();

				let $bsc_vendedor = $("#bsc_vendedor").val();
				let $bsc_cliente = $("#bsc_cliente").val();
				let $bsc_data_inicial = $("#bsc_data_inicial").val();
				let $bsc_data_final = $("#bsc_data_final").val();
				let $bsc_status = $("#bsc_status").val();

				let $url = '';
				if( $bsc_vendedor.length > 0 )	{ $url = $url +'/vendedor:'+ $bsc_vendedor; }
				if( $bsc_cliente.length > 0 )	{ $url = $url +'/cliente:'+ $bsc_cliente; }
				if( $bsc_data_inicial.length > 0 )	{ $url = $url +'/data_inicial:'+ ($bsc_data_inicial); }
				if( $bsc_data_final.length > 0 )	{ $url = $url +'/data_final:'+ ($bsc_data_final); }
				if( $bsc_status.length > 0 )	{ $url = $url +'/status:'+ $bsc_status; }

				//console.log( painel_url  +'historico/filtrar'+ $url );
				window.location.href = painel_url  +'historico/filtrar'+ $url;
				return false;
			});
			$(document).on('click', '.cmdUpdateStatus', function (e) {
				e.preventDefault();

				let $this = $(this);
				let $codigo = $this.data( "codigo" );
				let $msg = $( ".msg-email" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Confirme a alteração de status deste pedido.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							venda_id: $codigo
						};

						$msg.html('Aguarde. Estamos processando').show();
						$.ajax({
							url: painel_url  +'pedidos/ajaxform/ALTERAR-STATUS',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {
								console.log('1 beforeSend');
								console.log(response);
							},
							complete: function(response) { 
								//console.log('3 complete');
								//console.log(response);
							},
							success:function(response){
								console.log('2 success');
								console.log(response);
								$msg.html(response.error_msg).show();
							},
							error: function (jqXHR, textStatus, errorThrown) {
							}
						});
						// ------------------------------------------------------
					}
				});
			});
			$(document).on('click', '.cmdArquivarRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $codigo = $this.data( "codigo" );
				let $row = $this.closest( ".trRow" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Confirme o arquivamento deste pedido.',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Confirmo.',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							codigo: $codigo
						};

						$.ajax({
							url: painel_url  +'historico/ajaxform/ARQUIVAR-REGISTRO',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {
								console.log('1 beforeSend');
								console.log(response);
							},
							complete: function(response) { 
								console.log('3 complete');
								console.log(response);
							},
							success:function(response){
								console.log('2 success');
								console.log(response);
								$row.remove();
							},
							error: function (jqXHR, textStatus, errorThrown) {
								console.log('4 error');
								console.log(errorThrown);
							}
						});
						// ------------------------------------------------------
					}
				});
			});
			$(document).on('click', '.cmdExcluirRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $hashkey = $this.data( "hashkey" );
				let $row = $this.closest( ".trRow" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registros. <br>'+
						'Esta ação não poderá ser revertida.<br>'+
						'Deseja continuar assim mesmo?',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Desejo Excluir',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							corgf_hashkey: $hashkey
						};

						$.ajax({
							url: painel_url  +'coreografias/ajaxform/EXCLUIR-REGISTRO',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {},
							complete: function(response) { },
							success:function(response){
								$row.remove();
							},
							error: function (jqXHR, textStatus, errorThrown) {}
						});
						// ------------------------------------------------------
					}
				});
			});

			var table = $('#example2').DataTable({
				"pageLength": 100,
				order: [[ 0, "desc" ]],
				responsive: true,
				searching: true,
				paging: true,
				pagingType: "full_numbers",
				fixedHeader: {
					header: true,
					footer: false
				},
				"language": {
					"search": "Procurar",
					"lengthMenu": "Mostrar _MENU_ registro por página",
					"zeroRecords": "Nothing found - sorry",
					"info": "Monstrando _PAGE_ de _PAGES_",
					"infoEmpty": "Sem registros disponíveis",
					"infoFiltered": "(filtered from _MAX_ total records)",
					"oPaginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
					},
				}
			});
			//new $.fn.dataTable.FixedHeader( table );
		});
	</script>


<?php $this->endSection('scripts'); ?>