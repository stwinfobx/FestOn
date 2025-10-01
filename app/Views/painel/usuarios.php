<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Pesquisar vendedor
			</div>
		</div>
	</div>


	<div class="card card-default">
		<div class="card-header">

			<div class="row align-items-center">
				<div class="col-12 col-md-6">
					<h4 class="card-title">Vendedores</h4>
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
										<th style="width:60px;">ID</th>
										<th>Nome</th>
										<th style="width:250px">E-mail</th>
										<th style="width:110px;">Celular</th>
										<th class="text-center" style="width:110px;">Ações</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if( isset($rs_list) ){
										$nivel_acesso = (isset($nivel_acesso) ? $nivel_acesso : []); 
										foreach ($rs_list->getResult() as $row) {
											$id = ($row->id);
											$nome = ($row->nome);
											$email = ($row->email);
											$celular = ($row->celular);
											$permissao = ($row->permissao);
											$acesso = (isset($nivel_acesso[$permissao]) ? $nivel_acesso[$permissao] : '');

											$link_form = painel_url('usuarios/form/') . $id; 
											$link_hist = $link_historico .'/'. $id;
									?>
									<tr>
										<td class="text-center"><?php echo($id); ?></td>
										<td>
											<a href="<?php echo($link_form); ?>"><div><?php echo($nome); ?></div></a>
											<div><small><?php echo($acesso); ?></small></div>
										</td>
										<td>
											<div><?php echo($email); ?></div>
										</td>
										<td><?php echo($celular); ?></td>
										<td class="text-center">
											<div class="d-flex justify-content-center">
												<div style="margin: 0 3px;">
													<a href="<?php echo($link_form); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-pen"></i></a>
												</div>
												<div style="margin: 0 3px;">
													<a href="<?php echo($link_hist); ?>" class="btn btn-sm btn-ac btn-warning"><i class="las la-file-alt"></i></a>
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

	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/jquery.dataTables.css" rel="stylesheet">
	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

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
							url: painel_url  +'usuarios/ajaxform/DELETAR-REGISTRO',
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
								//$msg.html(response.error_msg).show();
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
		});
	</script>

<?php $this->endSection('scripts'); ?>