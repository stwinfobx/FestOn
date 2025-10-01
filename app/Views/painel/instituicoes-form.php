<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">Instituições</h2>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsRegistro" id="formFieldsRegistro" enctype="multipart/form-data">
					<input type="hidden" name="insti_urlpage_old" id="insti_urlpage_old" class="form-control" value="<?php echo((isset($rs_dados->insti_urlpage) ? $rs_dados->insti_urlpage : ""));?>" />

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
												<?php 
													$insti_urlpage = (isset($rs_dados->insti_urlpage) ? $rs_dados->insti_urlpage : "");
													//$path_file_view = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage;
													//$path_foto = (empty($partc_file_foto) ? '' : site_url("uploads/". $path_file_view ."/". $partc_file_foto));

													$insti_logotipo = (isset($rs_dados->insti_logotipo) ? $rs_dados->insti_logotipo : "");
													$path_file_view = site_url("uploads/instituicoes/". $insti_urlpage ."/documentacao/". $insti_logotipo);
													$param_input_file = [
														'label_text' => 'Logomarca da Instituição',
														'input_file_name' => 'fileInputLogotipo',
														'input_file_value' => $insti_logotipo,
														'input_file_view' => $path_file_view,
													];
													$inputLogotipo = view('painel/componentes/input-file-avatar', $param_input_file);
													echo( $inputLogotipo );
												?>
											</div>
										</div>

										<div class="row">
											<div class="col-12">
												<?php 
													$insti_ativo = (int)((isset($rs_dados->insti_ativo) ? $rs_dados->insti_ativo : "1")); 
													$ativo_s = ($insti_ativo == "1" ? ' checked ' : '');
													$ativo_n = ($insti_ativo != "1" ? ' checked ' : '');
												?>
												<div class="form-group">
													<div><label class="form-label" for="EMAIL">Registro Ativo?</label></div>
													<div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="insti_ativo" id="ativo_s" class="custom-control-input" value="1" <?php echo($ativo_s)?> />
																<label class="custom-control-label" for="ativo_s">Sim</label>
															</div>
														</div>
														<div class="form-check-inline my-1">
															<div class="custom-control custom-radio">
																<input type="radio" name="insti_ativo" id="ativo_n" class="custom-control-input" value="0" <?php echo($ativo_n)?> />
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
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_nome">Nome da Instituição</label>
													<input type="text" name="insti_nome" id="insti_nome" class="form-control" value="<?php echo((isset($rs_dados->insti_nome) ? $rs_dados->insti_nome : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_cnpj">CNPJ</label>
													<input type="text" name="insti_cnpj" id="insti_cnpj" class="form-control mask-cnpj" value="<?php echo((isset($rs_dados->insti_cnpj) ? $rs_dados->insti_cnpj : ""));?>" />
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
													<label class="form-label" for="insti_resp_nome">Nome do Responsável Legal</label>
													<input type="text" name="insti_resp_nome" id="insti_resp_nome" class="form-control" value="<?php echo((isset($rs_dados->insti_resp_nome) ? $rs_dados->insti_resp_nome : ""));?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_resp_cpf">CPF do Responsável Legal</label>
													<input type="text" name="insti_resp_cpf" id="insti_resp_cpf" class="form-control mask-cpf" value="<?php echo((isset($rs_dados->insti_resp_cpf) ? $rs_dados->insti_resp_cpf : ""));?>" />
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<?php 
													$insti_file_cartao_cnpj = (isset($rs_dados->insti_file_cartao_cnpj) ? $rs_dados->insti_file_cartao_cnpj : "");
													$param_input_file = [
														'label_text' => 'Upload do Cartão CNPJ',
														'input_file_name' => 'fileInputCartaoCNPJ',
														'input_file_value' => $insti_file_cartao_cnpj,
													];
													$inputCartaoCNPJ = view('painel/componentes/input-file', $param_input_file);
													echo( $inputCartaoCNPJ );
												?>
											</div>
											<div class="col-12 col-md-6">
												<?php 
													$insti_file_contr_social = (isset($rs_dados->insti_file_contr_social) ? $rs_dados->insti_file_contr_social : "");
													$param_input_file = [
														'label_text' => 'Upload Contrato Social',
														'input_file_name' => 'fileInputContrSocial',
														'input_file_value' => $insti_file_contr_social,
													];
													$inputContrSocial = view('painel/componentes/input-file', $param_input_file);
													echo( $inputContrSocial );
												?>
											</div>
										</div>

										<div class="row">
											<div class="col-12 col-md-6">
												<?php 
													$insti_file_doc_rg = (isset($rs_dados->insti_file_doc_rg) ? $rs_dados->insti_file_doc_rg : "");
													$param_input_file = [
														'label_text' => 'Upload RG do Responsável',
														'input_file_name' => 'fileInputDocRG',
														'input_file_value' => $insti_file_doc_rg,
													];
													$inputDocRG = view('painel/componentes/input-file', $param_input_file);
													echo( $inputDocRG );
												?>
											</div>
											<div class="col-12 col-md-6">
												<?php 
													$insti_file_doc_cpf = (isset($rs_dados->insti_file_doc_cpf) ? $rs_dados->insti_file_doc_cpf : "");
													$param_input_file = [
														'label_text' => 'Upload CPF do Responsável',
														'input_file_name' => 'fileInputDocCPF',
														'input_file_value' => $insti_file_doc_cpf,
													];
													$inputDocCPF = view('painel/componentes/input-file', $param_input_file);
													echo( $inputDocCPF );
												?>
											</div>
										</div>


										<?php 
											$insti_redes_sociais = (isset($rs_dados->insti_redes_sociais) ? $rs_dados->insti_redes_sociais : "");
											$_json = json_decode($insti_redes_sociais);
											$insti_redes_sociais_instagram = (isset($_json->instagram) ? $_json->instagram : '');
											$insti_redes_sociais_facebook = (isset($_json->facebook) ? $_json->facebook : '');
											$insti_redes_sociais_youtube = (isset($_json->youtube) ? $_json->youtube : '');
											$insti_redes_sociais_vimeo = (isset($_json->youtube) ? $_json->youtube : '');
										?>
										<div class="mb-2 mt-4">
											<h2>Redes Sociais</h2>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_redes_sociais_instagram">Instagram</label>
													<input type="text" name="insti_redes_sociais[instagram]" id="insti_redes_sociais_instagram" class="form-control" value="<?php echo( $insti_redes_sociais_instagram );?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_redes_sociais_facebook">Facebook</label>
													<input type="text" name="insti_redes_sociais[facebook]" id="insti_redes_sociais_facebook" class="form-control" value="<?php echo( $insti_redes_sociais_facebook );?>" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_redes_sociais_youtube">YouTube</label>
													<input type="text" name="insti_redes_sociais[youtube]" id="insti_redes_sociais_youtube" class="form-control" value="<?php echo( $insti_redes_sociais_youtube );?>" />
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label class="form-label" for="insti_redes_sociais_vimeo">Vimeo</label>
													<input type="text" name="insti_redes_sociais[vimeo]" id="insti_redes_sociais_vimeo" class="form-control" value="<?php echo( $insti_redes_sociais_vimeo );?>" />
												</div>
											</div>
										</div>

				
										<div class="AJAX-CONTENT-ENDERECO">
											<div class="mb-2 mt-4">
												<h2>Endereço</h2>
											</div>
											<div class="row">
												<div class="col-12 col-md-3">
													<div class="form-group">
														<label class="form-label" for="insti_end_cep">CEP</label>
														<input type="text" name="insti_end_cep" id="insti_end_cep" class="form-control mask-cep ajaxcep cmdbuscacep" value="<?php echo((isset($rs_dados->insti_end_cep) ? $rs_dados->insti_end_cep : ""));?>" />
													</div>
												</div>
												<div class="col-12 col-md-7">
													<div class="form-group">
														<label class="form-label" for="insti_end_logradouro">Endereço</label>
														<input type="text" name="insti_end_logradouro" id="insti_end_logradouro" class="form-control ajaxlogradouro" value="<?php echo((isset($rs_dados->insti_end_logradouro) ? $rs_dados->insti_end_logradouro : ""));?>" />
													</div>
												</div>
												<div class="col-12 col-md-2">
													<div class="form-group">
														<label class="form-label" for="insti_end_numero">Número</label>
														<input type="text" name="insti_end_numero" id="insti_end_numero" class="form-control ajaxnumero" value="<?php echo((isset($rs_dados->insti_end_numero) ? $rs_dados->insti_end_numero : ""));?>" />
													</div>
												</div>

											</div>
											<div class="row">
												<div class="col-12 col-md-3">
													<div class="form-group">
														<label class="form-label" for="insti_end_compl">Complemento</label>
														<input type="text" name="insti_end_compl" id="insti_end_compl" class="form-control ajaxcompl" value="<?php echo((isset($rs_dados->insti_end_compl) ? $rs_dados->insti_end_compl : ""));?>" />
													</div>
												</div>
												<div class="col-12 col-md-7">
													<div class="row">
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label class="form-label" for="insti_end_bairro">Bairro</label>
																<input type="text" name="insti_end_bairro" id="insti_end_bairro" class="form-control ajaxbairro" value="<?php echo((isset($rs_dados->insti_end_bairro) ? $rs_dados->insti_end_bairro : ""));?>" />
															</div>
														</div>
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label class="form-label" for="insti_end_cidade">Cidade</label>
																<input type="text" name="insti_end_cidade" id="insti_end_cidade" class="form-control ajaxcidade" value="<?php echo((isset($rs_dados->insti_end_cidade) ? $rs_dados->insti_end_cidade : ""));?>" />
															</div>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-2">
													<div class="form-group">
														<label class="form-label" for="insti_end_estado">Estado</label>
														<input type="text" name="insti_end_estado" id="insti_end_estado" class="form-control ajaxuf" value="<?php echo((isset($rs_dados->insti_end_estado) ? $rs_dados->insti_end_estado : ""));?>" />
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

		<?php if( !empty(session()->getFlashdata('msg_save')) ){ ?>
		Swal.fire({
			title: 'Atenção!',
			icon: 'success',
			html:
				'<?php echo( session()->getFlashdata("msg_save") ) ?>',
			confirmButtonText: 'Fechar',
			confirmButtonColor: "#18be4e",
		});
		<?php } /* end if : mensagem flash */  ?>

		$(document).on('blur', '.cmdbuscacep', function (event) {
			let $this = $(this);
			let $box = $this.closest( ".AJAX-CONTENT-ENDERECO" );
			let $cep = $this.val();
			$cep = $cep.replace(/\D/g, '');
			$cep = $cep.trim();

			let $url = 'https://viacep.com.br/ws/'+ $cep +'/json/';
			if( $cep.length > 0 ) {
				$.getJSON($url, function(data) {
					let respData = data;
					$box.find('.ajaxlogradouro').val(respData.logradouro);
					$box.find('.ajaxnumero').val('');
					$box.find('.ajaxcompl').val('');
					$box.find('.ajaxbairro').val(respData.bairro);
					$box.find('.ajaxcidade').val(respData.localidade);
					$box.find('.ajaxuf').val(respData.uf);
				})
				.done(function() {})
				.fail(function() { alert("Não encontramos o CEP Informado."); })
				.always(function() {});
			}
		});

	});
	</script>

<?php $this->endSection('scripts'); ?>