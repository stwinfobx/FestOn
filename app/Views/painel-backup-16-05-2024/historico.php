<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

	$bsc_vendedor = (isset($rs_filtros->vendedor) ? $rs_filtros->vendedor : '');
	$bsc_cliente = (isset($rs_filtros->cliente) ? $rs_filtros->cliente : '');
	$bsc_data_inicial = (isset($rs_filtros->data_inicial) ? $rs_filtros->data_inicial : '');
	$bsc_data_final = (isset($rs_filtros->data_final) ? $rs_filtros->data_final : '');
	$bsc_status = (isset($rs_filtros->status) ? $rs_filtros->status : '');
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Pesquisar pedido
			</div>
		</div>
	</div>


	<div class="card card-default">
		<div class="card-header">

			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					<h4 class="card-title">Histórico</h4>
				</div>
				<div class="col-12 col-md-6">

					<div class="d-flex justify-content-end">
						<div style="margin-left: 5px;"><a href="<?php echo(painel_url('dashboard')); ?>" class="btn btn-sm btn-primary">Novo Registro</a></div>
					</div>

				</div>
			</div>

		</div>
		<div class="card-body">

			<div class="box-content">
				<div class="row">
					<div class="col-12">

						<?php 
						$attr_form = [
							'class' => '', 
							'id' => 'formFiltro', 
							'name' => 'formFiltro', 
							'csrf_id' => 'secucity',
							'method' => 'get'
						];
						echo form_open( current_url(), $attr_form ); ?>
						<?php echo( csrf_field() ) ?>
						<div class="table-box mb-4" style="background-color: #f2f2f2; padding: 16px;">
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label class="form-label" for="bsc_vendedor">Vendedor:</label>
										<select name="bsc_vendedor" id="bsc_vendedor" class="form-select">
											<option value="">-</option>
										<?php
										if( isset($rs_vendedor) ){
											foreach ($rs_vendedor as $row) {
												$id = ($row->id);
												$nome = ($row->nome);
												$selected = (($bsc_vendedor == $id) ? 'selected' : '');
										?>
											<option value="<?php echo($id); ?>" <?php echo($selected ); ?> ><?php echo($nome); ?></option>
										<?php
											}
										}
										?>
										</select>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label class="form-label" for="bsc_cliente">Cliente:</label>
										<select name="bsc_cliente" id="bsc_cliente" class="form-select">
											<option value="">-</option>
										<?php
										if( isset($rs_cliente) ){
											foreach ($rs_cliente as $row) {
												$id = ($row->id);
												$nome = ($row->nome);
												$selected = (($bsc_cliente == $id) ? 'selected' : '');
										?>
											<option value="<?php echo($id); ?>" <?php echo($selected ); ?> ><?php echo($nome); ?></option>
										<?php
											}
										}
										?>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label class="form-label" for="bsc_data_inicial">Data Inicial:</label>
										<input type="date" name="bsc_data_inicial" id="bsc_data_inicial" class="form-control" value="<?php echo( $bsc_data_inicial ); ?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label class="form-label" for="bsc_data_final">Data Final:</label>
										<input type="date" name="bsc_data_final" id="bsc_data_final" class="form-control" value="<?php echo( $bsc_data_final ); ?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label class="form-label" for="bsc_status">Status:</label>
										<select name="bsc_status" id="bsc_status" class="form-select">
											<option value="">-</option>
										<?php
										if( isset($rs_status) ){
											foreach ($rs_status as $row) {
												$id = ($row->id);
												$status = ($row->status);
												$selected = (($bsc_status == $id) ? 'selected' : '');
										?>
											<option value="<?php echo($id); ?>" <?php echo($selected ); ?> ><?php echo($status ); ?></option>
										<?php
											}
										}
										?>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12 col-md-4">
									<div class="d-grid">
										<a href="javascript:;" class="btn btn-sm btn-primary cmdFiltrar">Filtrar</a>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>

						<?php
						if( isset($rs_list) ){
						?>
						<div class="table-box table-responsive">
							<table id="example2" class="display nowrap table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="width:60px;">ID</th>
										<th>Nome</th>
										<th style="width:130px;">Valor</th>
										<th style="width:25%;">Detalhes</th>
										<th style="width:25%;">Venda</th>
										<th class="text-center" style="width:110px;">Ação</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$count = 0;
									foreach ($rs_list->getResult() as $row) {
										$count++;
										$id = ($row->id);

										$data_cobranca = fct_formatdate($row->data_cobranca, 'd/m/Y');
										$status = $row->status;

										$nome = $row->nome;
										$valor = 'R$ '. fct_to_money($row->vlrTotal, 2, "br");

										$status = $row->status;
										$label_status = $status;
										$alterar_status = '';
										if($status == "pendente"){ 
											$label_status = '<span class="text-danger">'. $status .'</span>'; 
											//$alterar_status = '<div><a href="javascript:;" data-codigo="'. $id .'" class="btn btn-sm btn-outline-secondary cmdUpdateStatus">alterar para pago</a></div>'; 
										}
										if($status == "pago"){ $label_status = '<span class="text-success">'. $status .'</span>'; }

										$qtditens = (int)$row->qtdItens;
										$label_itens = $qtditens .' '. (($qtditens > 1) ? 'itens' : 'item');

										$detalhes = '';
										$detalhes = '
											<div>'. $label_itens .'</div>
											<div>Venc: '. $data_cobranca .'</div>
											<div>'. $label_status .'</div> 
										'; 
										$link_detalhe = painel_url('pedidos/detalhes/'. $id);

										$usuario = $row->userNome;
										$observacao = $row->observacao;
										$data_venda = fct_formatdate($row->data, 'd/m/Y');
										$venda = '';
										if( !empty($usuario)){$venda .= '<div>'. $usuario .'</div>'; }
										$venda .= '<div>data: '. $data_venda .'</div>';
										if( !empty($observacao)){$venda .= '<div><strong>obs:</strong> '. $observacao .'</div>'; }
									?>
										<tr class="trRow">
											<td><?php echo($id); ?></td>
											<td><?php echo($nome); ?></td>
											<td><?php echo($valor); ?></td>
											<td>
												<?php echo($detalhes); ?>
												<?php echo($alterar_status); ?>
											</td>
											<td>
												<?php echo($venda); ?>
											</td>
											<td class="text-center">

												<?php if( $session_user_permissao == "1" ){ // administradores ?>
												<div class="d-flex justify-content-center">
													<div style="margin: 0 3px;">
														<a href="<?php echo($link_detalhe); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-file-alt"></i></a>
													</div>
													<div style="margin: 0 3px;">
														<a href="javascript:;" class="btn btn-sm btn-ac btn-danger cmdArquivarRegistro" data-codigo="<?php echo($id); ?>"><i class="las la-archive"></i></a>
													</div>
												</div>
												<?php } ?>

												<?php if( $session_user_permissao == "2" ){ // vendedores ?>
												<div class="d-flex justify-content-center">
													<div style="margin: 0 3px;">
														<a href="<?php echo($link_detalhe); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-file-alt"></i></a>
													</div>
												</div>
												<?php } ?>

											</td>
										</tr>
									<?php
									}
								?>
								</tbody>
								<tfoot style="display:none;">
									<tr>
										<th>ID</th>
										<th>Nome</th>
										<th style="width:120px;">Valor</th>
										<th style="width:200px;">Detalhes</th>
										<th style="width:200px;">Venda</th>
										<th class="text-center">Ação</th>
									</tr>
								</tfoot>
							</table>
						</div>

						<div class="row justify-content-center pt-4 pb-4">
							<div class="col-12 col-md-4">
								<div class="d-grid">
									<a href="<?php echo( $linkGerarPDF ); ?>" target="_blank" class="btn btn-sm btn-primary">Salvar em PDF</a>
								</div>
							</div>
						</div>
						<?php
						}else{
						?>
							<div class="table-box text-center" style="padding: 16px 8px;">
								<?php echo('Nenhum registro encontrado'); ?>
							</div>	
						<?php 
						} 
						?>

					</div>
				</div>
			</div>

		</div>
	</div>

<?php
	$this->endSection('content'); 
?>


<?php $this->section('headers'); ?>

	<style>
	</style>

<?php $this->endSection('headers'); ?>


<?php $time = time(); ?>
<?php $this->section('scripts'); ?>

	<!-- <link href="assets/plugins/DataTables/datatables.min.css" rel="stylesheet"/> -->
	<!-- <script src="assets/plugins/DataTables/datatables.min.js"></script> -->
	<!-- <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"/> -->
	<!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->

	<!-- <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet"> -->

	<!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
	<!-- <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script> -->
	<!-- <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script> -->
	<!-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
	<!-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->

	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/jquery.dataTables.css" rel="stylesheet">
	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- <link href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/kt-2.9.0/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/sr-1.2.2/datatables.min.css" rel="stylesheet"/> -->
	<!--   -->
	<!-- <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.4/af-2.5.3/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/kt-2.9.0/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sb-1.4.2/sp-2.1.2/sl-1.6.2/sr-1.2.2/datatables.min.js"></script> -->

	<!-- <link href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.css" rel="stylesheet"/> -->
	<!-- <script src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.4/r-2.4.1/datatables.min.js"></script> -->

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
	</style>

	<script>
		let LIST_CATEGORIA = [];
	</script>

	<script>
		//function converterData(data) {
		//	var partes = data.split("/");
		//	var dataFormatada = partes[2] + "-" + partes[1] + "-" + partes[0];
		//	return dataFormatada;
		//}

		//var dataBrasileira = "18/05/2023";
		//var dataAmericana = converterData(dataBrasileira);
		//console.log(dataAmericana); // Saída: 2023-05-18
		$(document).ready(function () {
			
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