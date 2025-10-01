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
				Perfil
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
											<div style="margin-left: 5px;"><a href="<?php echo(painel_url('instituicoes')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
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
												<div class="card-photo d-flex justify-content-center align-items-center">
													logotipo
												</div>
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
												</div>
											</div>
										</div>

									</div>
									<div class="col-12 col-md-9">

										<div class="row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<label class="form-label" for="insti_nome">Nome da Instituição</label>
													<input type="text" name="insti_nome" id="insti_nome" class="form-control" value="<?php echo((isset($rs_dados->insti_nome) ? $rs_dados->insti_nome : ""));?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_email">E-mail</label>
													<input type="text" name="insti_email" id="insti_email" class="form-control" value="<?php echo((isset($rs_dados->insti_email) ? $rs_dados->insti_email : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_senha">Senha</label>
													<input type="password" name="insti_senha" id="insti_senha" class="form-control" value="" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label class="form-label" for="insti_telefone">Telefone</label>
													<input type="text" name="insti_telefone" id="insti_telefone" class="form-control mask-phone" value="<?php echo((isset($rs_dados->insti_telefone) ? $rs_dados->insti_telefone : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label class="form-label" for="insti_celular">Celular</label>
													<input type="text" name="insti_celular" id="insti_celular" class="form-control mask-phone" value="<?php echo((isset($rs_dados->insti_celular) ? $rs_dados->insti_celular : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label class="form-label" for="insti_whatsapp">WhatsApp</label>
													<input type="text" name="insti_whatsapp" id="insti_whatsapp" class="form-control mask-phone" value="<?php echo((isset($rs_dados->insti_whatsapp) ? $rs_dados->insti_whatsapp : ""));?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">Diretor</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">Função</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">Diretor 2</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">Função</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
										</div>


										<div class="mb-2 mt-4">
											<h2>Redes Sociais</h2>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">Instagram</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">Facebook</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">YouTube</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="EMAIL">Vimeo</label>
													<input type="text" name="EMAIL" id="EMAIL" class="form-control" value="" />
												</div>
											</div>
										</div>


										<div class="mb-2 mt-4">
											<h2>Endereço</h2>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_end_logradouro">Endereço</label>
													<input type="text" name="insti_end_logradouro" id="insti_end_logradouro" class="form-control" value="<?php echo((isset($rs_dados->insti_end_logradouro) ? $rs_dados->insti_end_logradouro : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="insti_end_numero">Número</label>
													<input type="text" name="insti_end_numero" id="insti_end_numero" class="form-control" value="<?php echo((isset($rs_dados->insti_end_numero) ? $rs_dados->insti_end_numero : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="insti_end_compl">Complemento</label>
													<input type="text" name="insti_end_compl" id="insti_end_compl" class="form-control" value="<?php echo((isset($rs_dados->insti_end_compl) ? $rs_dados->insti_end_compl : ""));?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-md-3">
												<div class="form-group">
													<label class="form-label" for="insti_end_cep">CEP</label>
													<input type="text" name="insti_end_cep" id="insti_end_cep" class="form-control" value="<?php echo((isset($rs_dados->insti_end_cep) ? $rs_dados->insti_end_cep : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-7">
												<div class="row">
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="insti_end_bairro">Bairro</label>
															<input type="text" name="insti_end_bairro" id="insti_end_bairro" class="form-control" value="<?php echo((isset($rs_dados->insti_end_bairro) ? $rs_dados->insti_end_bairro : ""));?>" />
														</div>
													</div>
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label class="form-label" for="insti_end_cidade">Cidade</label>
															<input type="text" name="insti_end_cidade" id="insti_end_cidade" class="form-control" value="<?php echo((isset($rs_dados->insti_end_cidade) ? $rs_dados->insti_end_cidade : ""));?>" />
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-2">
												<div class="form-group">
													<label class="form-label" for="insti_end_estado">Estado</label>
													<input type="text" name="insti_end_estado" id="insti_end_estado" class="form-control" value="<?php echo((isset($rs_dados->insti_end_estado) ? $rs_dados->insti_end_estado : ""));?>" />
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

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<script>
		$(document).ready(function () {
		});
	</script>


<?php $this->endSection('scripts'); ?>