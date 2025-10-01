<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col">
				<h2 class="page-title">Grupos</h2>
			</div>
			<div class="col-auto">
				<?php 
					$w_data['etapa'] = '';
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
				<!-- <input type="text" name="grp_urlpage" id="grp_urlpage" class="form-control" value="<?php echo((isset($rs_dados->grp_urlpage) ? $rs_dados->grp_urlpage : ""));?>" /> -->

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<div class="card card-default">
							<div class="card-header-box">
								<div class="row align-items-center">
									<div class="col-12 col-md-6">
										
									</div>
									<div class="col-12 col-md-6">

										<div class="d-flex justify-content-end">
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('grupos')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
											<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
										</div>

									</div>
								</div>
							</div>
							<div class="card-body">

								<div class="row ">
									<div class="col-12 col-md-3">

										<div class="row mb-3">
											<div class="col-12">
												<?php 
													$path_folder_directory = (isset($path_folder_directory) ? $path_folder_directory : "");
													//print '<small>'. $path_folder_directory .'</small>';
													//$grp_urlpage = (isset($rs_dados->grp_urlpage) ? $rs_dados->grp_urlpage : "");
													//$path_file_view = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage;
													//$path_foto = (empty($partc_file_foto) ? '' : site_url("uploads/". $path_file_view ."/". $partc_file_foto));

													$grp_logotipo = (isset($rs_dados->grp_logotipo) ? $rs_dados->grp_logotipo : "");
													$path_file_view = site_url("uploads/". $path_folder_directory ."/". $grp_logotipo);
													$param_input_file = [
														'label_text' => 'Logomarca do Grupo',
														'input_file_name' => 'fileInputLogotipo',
														'input_file_value' => $grp_logotipo,
														'input_file_view' => $path_file_view,
													];
													$inputLogomarca = view('painel/componentes/input-file-avatar', $param_input_file);
													echo( $inputLogomarca );
												?>
											</div>
										</div>

										<div class="row">
											<div class="col-12">
												<?php 
													$user_ativo = (int)((isset($rs_edit->user_ativo) ? $rs_edit->user_ativo : "1")); 
													$ativo_s = ($user_ativo == "1" ? ' checked ' : '');
													$ativo_n = ($user_ativo != "1" ? ' checked ' : '');
												?>
												<div class="form-group">
													<div><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
													<div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="user_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
																<label class="custom-control-label" for="ativo_s">Sim</label>
															</div>
														</div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="user_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
																<label class="custom-control-label" for="ativo_n">Não</label>
															</div>
														</div>
													</div>
													<div><?php echo show_error($validation, 'user_ativo'); ?></div>
												</div>
											</div>
										</div>

									</div>
									<div class="col-12 col-md-9">

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="grp_titulo">Nome do Grupo</label>
													<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" value="<?php echo((isset($rs_dados->grp_titulo) ? $rs_dados->grp_titulo : ""));?>" />
												</div>
											</div>

										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="grp_responsavel">Responsável</label>
													<input type="text" name="grp_responsavel" id="grp_responsavel" class="form-control" value="<?php echo((isset($rs_dados->grp_responsavel) ? $rs_dados->grp_responsavel : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="grp_telefone">Telefone</label>
													<input type="text" name="grp_telefone" id="grp_telefone" class="form-control mask-phone" value="<?php echo((isset($rs_dados->grp_telefone) ? $rs_dados->grp_telefone : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="grp_celular">Celular</label>
													<input type="text" name="grp_celular" id="grp_celular" class="form-control mask-phone" value="<?php echo((isset($rs_dados->grp_celular) ? $rs_dados->grp_celular : ""));?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label class="form-label" for="grp_cpf">CPF</label>
													<input type="text" name="grp_cpf" id="grp_cpf" class="form-control mask-cpf" value="<?php echo((isset($rs_dados->grp_cpf) ? $rs_dados->grp_cpf : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label class="form-label" for="grp_email">E-mail</label>
													<input type="text" name="grp_email" id="grp_email" class="form-control" value="<?php echo((isset($rs_dados->grp_email) ? $rs_dados->grp_email : ""));?>" />
												</div>
											</div>
											<!-- <div class="col-12 col-md-4"> -->
											<!-- 	<div class="form-group"> -->
											<!-- 		<label class="form-label" for="grp_senha">Senha</label> -->
											<!-- 		<input type="password" name="grp_senha" id="grp_senha" class="form-control" value="" /> -->
											<!-- 	</div> -->
											<!-- </div> -->
										</div>





										<div class="mb-2 mt-4">
											<h2>Redes Sociais</h2>
										</div>

										<?php 
											$grp_redes_sociais = (isset($rs_dados->grp_redes_sociais) ? $rs_dados->grp_redes_sociais : '');
											$obj_redes_sociais = json_decode( $grp_redes_sociais );
											$grp_sm_instagram = (isset($obj_redes_sociais->instagram) ? $obj_redes_sociais->instagram : '');
											$grp_sm_facebook = (isset($obj_redes_sociais->facebook) ? $obj_redes_sociais->facebook : '');
											$grp_sm_youtube = (isset($obj_redes_sociais->youtube) ? $obj_redes_sociais->youtube : '');
											$grp_sm_vimeo = (isset($obj_redes_sociais->vimeo) ? $obj_redes_sociais->vimeo : '');
										?>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="grp_sm_instagram">Instagram</label>
													<input type="text" name="grp_sm_instagram" id="grp_sm_instagram" class="form-control" value="<?php echo($grp_sm_instagram);?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="grp_sm_facebook">Facebook</label>
													<input type="text" name="grp_sm_facebook" id="grp_sm_facebook" class="form-control" value="<?php echo($grp_sm_facebook);?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="grp_sm_youtube">YouTube</label>
													<input type="text" name="grp_sm_youtube" id="grp_sm_youtube" class="form-control" value="<?php echo($grp_sm_youtube);?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="grp_sm_vimeo">Vimeo</label>
													<input type="text" name="grp_sm_vimeo" id="grp_sm_vimeo" class="form-control" value="<?php echo($grp_sm_vimeo);?>" />
												</div>
											</div>
										</div>


										<div class="mb-2 mt-4">
											<h2>Endereço</h2>
										</div>
										<div class="row">
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="grp_end_cep">CEP</label>
													<input type="text" name="grp_end_cep" id="grp_end_cep" class="form-control mask-cep blurCheckCEP" value="<?php echo((isset($rs_dados->grp_end_cep) ? $rs_dados->grp_end_cep : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="grp_end_logradouro">Endereço</label>
													<input type="text" name="grp_end_logradouro" id="grp_end_logradouro" class="form-control" value="<?php echo((isset($rs_dados->grp_end_logradouro) ? $rs_dados->grp_end_logradouro : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="grp_end_numero">Número</label>
													<input type="text" name="grp_end_numero" id="grp_end_numero" class="form-control" value="<?php echo((isset($rs_dados->grp_end_numero) ? $rs_dados->grp_end_numero : ""));?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="grp_end_compl">Complemento</label>
													<input type="text" name="grp_end_compl" id="grp_end_compl" class="form-control" value="<?php echo((isset($rs_dados->grp_end_compl) ? $rs_dados->grp_end_compl : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-7">
												<div class="row">
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="grp_end_bairro">Bairro</label>
															<input type="text" name="grp_end_bairro" id="grp_end_bairro" class="form-control" value="<?php echo((isset($rs_dados->grp_end_bairro) ? $rs_dados->grp_end_bairro : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="grp_end_cidade">Cidade</label>
															<input type="text" name="grp_end_cidade" id="grp_end_cidade" class="form-control" value="<?php echo((isset($rs_dados->grp_end_cidade) ? $rs_dados->grp_end_cidade : ""));?>" />
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-2">
												<div class="form-group">
													<label class="form-label" for="grp_end_estado">Estado</label>
													<input type="text" name="grp_end_estado" id="grp_end_estado" class="form-control" value="<?php echo((isset($rs_dados->grp_end_estado) ? $rs_dados->grp_end_estado : ""));?>" />
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

	<script>
		//let LIST_PRODUTOS = [];
		//let LIST_STATUS = [];
		//let CLIENTE_ID = '<?php echo( $cliente_id ); ?>';
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
			$(document).on('blur', '.blurCheckCEP', function (e) {
				e.preventDefault();
				let $this = $(this);

				let strDefault = $this.val();
				strDefault = strDefault.replace(/\D/g, '');
				let strCEP = strDefault.trim();

				$.ajax({
					url: 'https://api.postmon.com.br/v1/cep/'+ strCEP,
					method:"GET",
					type: "GET",
					dataType: "json",
					//data: [],
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
						$('#grp_end_logradouro').val( response.logradouro );
						$('#grp_end_bairro').val( response.bairro );
						$('#grp_end_cidade').val( response.cidade );
						$('#grp_end_estado').val( response.estado );
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log('4 error');
						console.log(errorThrown);
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