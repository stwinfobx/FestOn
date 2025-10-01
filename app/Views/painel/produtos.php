<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Pesquisar produto
			</div>
		</div>
	</div>


	<div class="card card-default">
		<div class="card-header">

			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					<h4 class="card-title">Produtos</h4>
				</div>
				<div class="col-12 col-md-6">

					<div class="d-flex justify-content-end">
						<div style="margin-left: 5px;"><a href="<?php echo($link_form); ?>" class="btn btn-sm btn-primary">Novo Registro</a></div>
					</div>
					
				</div>
			</div>

		</div>
		<div class="card-body">

			<div class="box-content">
				<div class="row">
					<div class="col-12">

						<div class="table-box table-responsive">
							<table id="example2" class="display nowrap table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th class="text-center" style="width:100px;">#</th>
										<th>Descrição</th>
										<th style="width:150px">Valor</th>
										<th style="width:150px;">Valor de Custo</th>
										<th class="text-center" style="width:110px;">Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if( isset($rs_list) ){
										foreach ($rs_list->getResult() as $row) {
											$id = ($row->id);
											$descricao = ($row->descricao);
											
											//$valor = ($row->valor);
											$valor = 'R$ '. fct_to_money($row->valor, 2, "br");

											//$valor_custo = ($row->valor_custo);
											$valor_custo = 'R$ '. fct_to_money($row->valor_custo, 2, "br");
											//$css_status = (($user_ativo == 1) ? 'icon-ativo' : 'icon-inativo');
											
											$link_form = painel_url('produtos/form/') . $id; 
									?>
									<tr class="trRow">
										<td class="text-center"><?php echo($id); ?></td>
										<td>
											<a href="<?php echo($link_form); ?>"><?php echo($descricao); ?></a>
										</td>
										<td>
											<div><?php echo($valor); ?></div>
										</td>
										<td>
											<div><?php echo($valor_custo); ?></div>
										</td>
										<td class="text-center">
											<div class="d-flex justify-content-center">
												<div style="margin: 0 3px;">
													<a href="<?php echo($link_form); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-pen"></i></a>
												</div>
												<div style="margin: 0 3px;">
													<a href="javascript:;" class="btn btn-sm btn-ac btn-danger cmdDeleteRegistro" data-codigo="<?php echo($id); ?>"><i class="las la-trash"></i></a>
												</div>
											</div>
										</td>
									</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>

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
		.teste{}
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
		$(document).ready(function () {
			$(document).on('click', '.cmdDeleteRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $codigo = $this.data( "codigo" );
				let $row = $this.closest( ".trRow" );

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
							codigo: $codigo
						};

						//$msg.html('Aguarde. Estamos processando').show();
						$.ajax({
							url: painel_url  +'produtos/ajaxform/DELETAR-REGISTRO',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {
								//console.log('1 beforeSend');
								//console.log(response);
							},
							complete: function(response) { 
								//console.log('3 complete');
								//console.log(response);
							},
							success:function(response){
								//console.log('2 success');
								//console.log(response);
								$row.remove();
							},
							error: function (jqXHR, textStatus, errorThrown) {
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


			//$('#example').DataTable({
			//	columnDefs: [
			//		{
			//			// The `data` parameter refers to the data for the cell (defined by the
			//			// `data` option, which defaults to the column being worked with, in
			//			// this case `data: 0`.
			//			render: function (data, type, row) {
			//				return data + ' (' + row[3] + ')';
			//			},
			//			targets: 0,
			//		},
			//		{ visible: false, targets: [3] },
			//	],
			//});
			//$('#examplesss').DataTable({
			//	//processing: true,
			//	serverSide: true,
			//	ajax: {
			//		url: URL_SITE,
			//		type: 'POST',
			//	},
			//	columns: [
			//		{ data: 'first_name' },
			//		{ data: 'last_name' },
			//		{ data: 'position' },
			//		{ data: 'office' },
			//		{ data: 'start_date' },
			//		{ data: 'salary' },
			//	],
			//	columnDefs: [
			//		{
			//			// The `data` parameter refers to the data for the cell (defined by the
			//			// `data` option, which defaults to the column being worked with, in
			//			// this case `data: 0`.
			//			render: function (data, type, row) {
			//				return data + ' (' + row[3] + ')';
			//			},
			//			targets: 0,
			//		},
			//		{ visible: false, targets: [3] },
			//	],
			//});

			//var table = $('#example2').DataTable({
			//	ajax: URL_SITE,
			//	"pageLength": 100,
			//	order: [[0, 'desc']],
			//	columnDefs: [
			//		//{ orderable: false, target: 0, visible: false },
			//		{ orderable: true, className: 'reorder', targets: 0 },
			//		{ orderable: true, className: 'reorder', targets: 1 },
			//		{ orderable: true, className: 'reorder', targets: 2 },
			//		{ orderable: true, className: 'reorder', targets: 3 },
			//		{ orderable: false, targets: '_all' }
			//		//{
			//		//	targets: -1,
			//		//	data: null,
			//		//	defaultContent: '<div class="d-flex justify-content-center"><div style="margin: 0 3px;"><a href="" class="btn btn-sm btn-primary"><i class="las la-pen font-16"></i></a></div><div style="margin: 0 3px;"><a href="" class="btn btn-sm btn-danger"><i class="las la-trash font-16"></i></a></div></div>',
			//		//},
			//	],
			//	//columnDefs: [
			//	//	{
			//	//		targets: -1,
			//	//		data: null,
			//	//		defaultContent: '<button>Click!</button>',
			//	//	},
			//	//],
			//	"language": {
			//		"search": "Procurar",
			//		"lengthMenu": "Mostrar _MENU_ registro por página",
			//		"zeroRecords": "Nothing found - sorry",
			//		"info": "Monstrando _PAGE_ de _PAGES_",
			//		"infoEmpty": "Sem registros disponíveis",
			//		"infoFiltered": "(filtered from _MAX_ total records)",
			//		"oPaginate": {
			//			"sNext": "Próximo",
			//			"sPrevious": "Anterior",
			//			"sFirst": "Primeiro",
			//			"sLast": "Último"
			//		},
			//	}
			//});
		});
	</script>

<?php $this->endSection('scripts'); ?>