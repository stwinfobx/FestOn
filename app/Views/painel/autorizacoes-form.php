<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				Termos e Autorizações
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsRegistro" id="formFieldsRegistro" enctype="multipart/form-data">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default">
							<div class="card-header-box">
								<div class="row align-items-center">
									<div class="col-12 col-md-6">
										
									</div>
									<div class="col-12 col-md-6">

										<div class="d-flex justify-content-end">
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('autorizacoes')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
											<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
										</div>

									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="row ">
									<div class="col-12 col-md-4">
										<div class="row">
											<div class="col-12">
												<?php 
													$autz_ativo = (int)((isset($rs_dados->autz_ativo) ? $rs_dados->autz_ativo : "1")); 
													$ativo_s = ($autz_ativo == "1" ? ' checked ' : '');
													$ativo_n = ($autz_ativo != "1" ? ' checked ' : '');
												?>
												<div class="form-group">
													<div><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
													<div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="autz_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
																<label class="custom-control-label" for="ativo_s">Sim</label>
															</div>
														</div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="autz_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
																<label class="custom-control-label" for="ativo_n">Não</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-8">

										<div class="row">
											<?php 
												$autz_parent_id = (int)(isset($rs_dados->autz_parent_id) ? $rs_dados->autz_parent_id : ""); 
											?>
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="autz_parent_id">Relacionar à</label>
													<select class="form-select" name="autz_parent_id" id="autz_parent_id">
														<option value="0" translate="no">- não relacionar -</option>
														<?php
														if( isset($rs_parent) ){
															foreach ($rs_parent as $row) {
																$autz_id = (int)$row->autz_id;
																$autz_titulo = $row->autz_titulo;
																$selected = (($autz_id == $autz_parent_id) ? 'selected' : '');
														?>
															<option value="<?php echo($autz_id);?>" <?php echo($selected);?> translate="no"><?php echo($autz_titulo);?></option>
														<?
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="autz_titulo">Título</label>
													<input type="text" name="autz_titulo" id="autz_titulo" class="form-control" value="<?php echo((isset($rs_dados->autz_titulo) ? $rs_dados->autz_titulo : ""));?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="autz_titulo">Descrição</label>
													<textarea type="text" name="autz_descricao" id="autz_descricao" class="form-control" style="height: 120px !important;"><?php echo((isset($rs_dados->autz_descricao) ? $rs_dados->autz_descricao : ""));?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row ">
									<div class="col-12 col-md-4">
										<div class="card card-base mb-3">
											<div class="card-header">
												Campos Dinâmicos
											</div>
											<div class="card-body">
												<div class="lista-campos">
													<?php
														$fields = [
															'cad_nome' => 'Nome Completo',
															//'cad_nome_social' => 'Nome Social',
															'cad_email' => 'E-mail',
															'cad_documento' => 'CPF',
															'cad_dte_nascto' => 'Data de Nascimento',
															'cad_estado' => 'Estado',
															'cad_cidade' => 'Cidade',
															'partc_telefone' => 'Telefone',
															'gene_titulo' => 'Gênero',
															'func_titulo' => 'Função',
															'event_titulo' => 'Nome do Evento',
															'grp_titulo' => 'Nome do Grupo',
														];
														foreach ($fields as $keyFld => $valFld) {
															echo('<a href="javascript:;" class="campo" data-tag="'. $keyFld .'">'. $valFld .'</a>');
														}
													?>												
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-8">
										<div class="card card-base mb-3">
											<div class="card-header">
												Descrição Completa
											</div>
											<div class="card-body">
												<div class="d-none">
													<textarea type="text" name="autz_descricao_full" id="autz_descricao_full" class="form-control" style="height: 350px !important;"><?php echo((isset($rs_dados->autz_descricao_full) ? $rs_dados->autz_descricao_full : ""));?></textarea>
												</div>
												<div id="autz_descricao_quill"></div>	
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
		</div>
	</div>



<?php
	$this->endSection('content'); 
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
        .lista-campos { width: 100%; border: 0px solid #ccc; }
        .campo { display: block; padding: 5px; margin: 5px 0; background: #007bff; color: white; text-align: center; cursor: pointer; text-decoration: none; }
        .editor-container { flex: 1; }
        .tag { display: inline-block; background: yellow; padding: 5px; border-radius: 3px; margin: 2px; }
        .tag .remove { margin-left: 5px; color: red; cursor: pointer; font-weight: bold; }
	
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

	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

	<script>
		//let LIST_PRODUTOS = [];
		//let LIST_STATUS = [];
	</script>

	<!-- VueJs -->
	<!-- <script src="assets/vue/vue.min.js"></script> -->
	<!-- <script src="assets/vue/axios.min.js"></script> -->
	<!-- <script src="assets/vue/carrinho.js"></script> -->


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
	
	<script>
		var quill = new Quill('#autz_descricao_quill', {
			theme: 'snow',
			//placeholder: 'Clique em um campo para adicionar...',
			modules: { toolbar: true }
		});

		// Adiciona a tag quando o link for clicado
		document.querySelectorAll('.campo').forEach(item => {
			item.addEventListener('click', function(event) {
				event.preventDefault(); // Evita que o link redirecione

				let tagName = this.dataset.tag;
				let range = quill.getSelection(); // Obtém a posição do cursor

				if (range) {
					let span = document.createElement('span');
					span.className = 'tag';
					span.innerHTML = ` {{${tagName}}} `;

					// Insere a tag no editor
					quill.clipboard.dangerouslyPasteHTML(range.index, span.outerHTML);
				}
			});
		});

        window.addEventListener("DOMContentLoaded", function() {
            var conteudo = document.getElementById("autz_descricao_full").value;
            quill.root.innerHTML = conteudo; // Insere o HTML dentro do editor
        });	

		document.getElementById("formFieldsRegistro").addEventListener("submit", function() {
			document.getElementById("autz_descricao_full").value = quill.root.innerHTML;
		});
	</script>	


<?php $this->endSection('scripts'); ?>