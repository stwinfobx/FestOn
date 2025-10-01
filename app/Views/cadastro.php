<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Cadastro</h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsCadastro" id="formFieldsCadastro" ref="formFieldsInscricao" enctype="multipart/form-data">
					<div class="row align-items-start">
						<div class="col-12 col-md-12">

							<div class="card card-default">
								<div class="card-header-box" style="display:none !important;">
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

											<div class="d-flex flex-column">
												<div class="naveg-steps">
													<div class="naveg-steps-numbers">
														<div class="naveg-steps-item" v-bind:class="{current: step >= 1}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 1"></i>
																<span class="steps-number" v-show="step == 1">1</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Dados Principais</h3>
																<div class="steps-desc">Configurações</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 2}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 2"></i>
																<span class="steps-number" v-show="step <= 2">2</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Cobrança</h3>
																<div class="steps-desc">Detalhes</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 3}">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 3"></i>
																<span class="steps-number" v-show="step <= 3">3</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Jurídico</h3>
																<div class="steps-desc">Detalhes</div>
															</div>
														</div>

													</div>
												</div>
											</div>

										</div>
										<div class="col-12 col-md-9">

											<!-- Step 1 -->
											<div class="h-100" v-show="step == 1" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-12 col-md-12">
																<div>
																	<div class="row">
																		<div class="col-12 col-md-9">
																			<h2 class="fw-bolder text-dark title-step">Informações Principais da Instituição</h2>
																			<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																		</div>
																		<div class="col-12 col-md-3 d-none">
																			<!--
																			<div class="personal-image">
																				<label class="label">
																					<input type="file" ref="fileInputLogotipo" name="fileLogotipo" v-on:change="pickFileLogotipo" />
																					<figure class="personal-figure">
																						<div v-if="previewLogotipo" class="personal-avatar-bg" v-bind:style="{ 'background-image': 'url(' + previewLogotipo + ')' }"></div>
																						<div v-else class="personal-avatar-bg" style="background-image: url('assets/media/logotipo.png');">
																							<img src="assets/media/logotipo.png" class="personal-avatar" alt="avatar">
																						</div>
																						<figcaption class="personal-figcaption">
																							<img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
																						</figcaption>
																					</figure>
																				</label>
																			</div>
																			<div class="text-center"><label class="form-label text-center">Logotipo</label></div>
																			-->
																		</div>
																	</div>
																</div>
																<div class="content-itens boxFields mt-3">

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_nome">Nome da Instituição</label>
																					<input type="text" name="insti_nome" id="insti_nome" class="form-control" ref="insti_nome" v-model="fields.insti_nome" value="<?php echo((isset($rs_group->insti_nome) ? $rs_group->insti_nome : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.insti_nome.length"><small>{{ error.insti_nome }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-5">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_cnpj">CNPJ</label>
																					<input type="text" name="insti_cnpj" id="insti_cnpj" class="form-control mask-cnpj" ref="insti_cnpj" v-model="fields.insti_cnpj" value="<?php echo((isset($rs_group->insti_cnpj) ? $rs_group->insti_cnpj : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_cnpj.length"><small>{{ error.insti_cnpj }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-1" style="position: relative;">
																			<div class="boxAbsAvatar">
																				<label for="fileInputLogotipo" style="display: block; width: 100%;">
																				<div class="d-flex justify-content-end">
																					<div class="label">
																						<div>logomarca da instituição</div>
																						<div class="form-error d-flex justify-content-end" v-if="error.insti_file_logotipo.length"><small>{{ error.insti_file_logotipo }}</small></div>
																					</div>
																					<div v-if="fields.insti_file_logotipo" class="bg-img-avatar full photo" v-bind:style="{ 'background-image': 'url(' + previewLogotipo + ')' }"></div>
																					<div v-else="">
																						<div v-if="fields.insti_file_logotipo" class="bg-img-avatar full photo" v-bind:style="{ 'background-image': 'url('+ urlPost +'/renderimage/view_avatar/'+ fields.insti_file_logotipo + ')' }"></div>
																						<div v-else="" class="bg-img-avatar full photo" style="background-image: url('assets/media/icon-profile2.png'); filter: grayscale(1);"></div>
																					</div>
																					<div class="d-none">
																						<input type="file" name="fileInputLogotipo" id="fileInputLogotipo" ref="fileInputLogotipo" @change="pickFile($event, 'fileInputLogotipo', 'previewLogotipo', 'imageLogotipo', 'insti_file_logotipo')" style="display: none;" />
																					</div>
																				</div>
																				</label>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_email">E-mail</label>
																					<input type="text" name="insti_email" id="insti_email" class="form-control" ref="insti_email" v-model="fields.insti_email" value="<?php echo((isset($rs_group->insti_email) ? $rs_group->insti_email : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_email.length"><small>{{ error.insti_email }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">

																			<div class="row">
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="insti_senha">Senha</label>
																							<input type="password" name="insti_senha" id="insti_senha" class="form-control" ref="insti_nome" v-model="fields.insti_senha" value="" /> 
																						</div>
																						<div class="form-error" v-if="error.insti_senha.length"><small>{{ error.insti_senha }}</small></div>
																					</div>
																				</div>
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="insti_senha_conf">Confirme a senha</label>
																							<input type="password" name="insti_senha_conf" id="insti_senha_conf" class="form-control" ref="insti_senha_conf" v-model="fields.insti_senha_conf" value="" />
																						</div>
																						<div class="form-error" v-if="error.insti_senha_conf.length"><small>{{ error.insti_senha_conf }}</small></div>
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_telefone">Telefone</label>
																					<input type="text" name="insti_telefone" id="insti_telefone" class="form-control mask-phone" ref="insti_telefone" v-model="fields.insti_telefone" value="<?php echo((isset($rs_group->insti_telefone) ? $rs_group->insti_telefone : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_telefone.length"><small>{{ error.insti_telefone }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_celular">Celular</label>
																					<input type="text" name="insti_celular" id="insti_celular" class="form-control mask-phone" ref="insti_celular" v-model="fields.insti_celular" value="<?php echo((isset($rs_group->insti_celular) ? $rs_group->insti_celular : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_celular.length"><small>{{ error.insti_celular }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_whatsapp">Whatsapp</label>
																					<input type="text" name="insti_whatsapp" id="insti_whatsapp" class="form-control mask-phone" ref="insti_whatsapp" v-model="fields.insti_whatsapp" value="<?php echo((isset($rs_group->insti_whatsapp) ? $rs_group->insti_whatsapp : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_whatsapp.length"><small>{{ error.insti_whatsapp }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_resp_nome">Nome do responsável legal</label>
																					<input type="text" name="insti_resp_nome" id="insti_resp_nome" class="form-control" ref="insti_resp_nome" v-model="fields.insti_resp_nome" value="<?php echo((isset($rs_group->insti_resp_nome) ? $rs_group->insti_resp_nome : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.insti_resp_nome.length"><small>{{ error.insti_resp_nome }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_resp_cpf">CPF do responsável legal</label>
																					<input type="text" name="insti_resp_cpf" id="insti_resp_cpf" class="form-control mask-cpf" ref="insti_resp_cpf" v-model="fields.insti_resp_cpf" value="<?php echo((isset($rs_group->insti_resp_cpf) ? $rs_group->insti_resp_cpf : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.insti_resp_cpf.length"><small>{{ error.insti_resp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row"> <!-- Upload do Cartão CNPJ -->
																		<div class="col-12 col-md-6">

																			<div class="form-group">
																				<div class="">
																					<label class="form-label text-center">Upload do Cartão CNPJ</label>
																				</div>
																				<div>
																					<label for="fileInputCartaoCNPJ" style="display: block; width: 100%;">
																						<div class="d-flex align-items-center form-control" style="border: 1.5px solid #e79c32 !important; height: 100%;">
																							<div style="border-right: 1.5px solid #e79c32 !important; padding-right: 0.5rem !important;"><i class="fas fa-file-upload" style="color: #e79c32;"></i></div>
																							<div style="padding-left: 0.5rem !important; color: gray; overflow: hidden;">
																								<span style="text-wrap: nowrap; font-size: .85rem;" class="" v-if="fields.insti_file_cartao_cnpj">{{fields.insti_file_cartao_cnpj}}</span>
																								<span v-else>Nenhum arquivo escolhido</span>
																							</div>
																							<div class="d-none">
																								<input type="file" name="fileInputCartaoCNPJ" id="fileInputCartaoCNPJ" ref="fileInputCartaoCNPJ" @change="pickFile($event, 'fileInputCartaoCNPJ', 'previewCartaoCNPJ', 'imageCartaoCNPJ', 'insti_file_cartao_cnpj')" style="display: none;" />
																							</div>
																						</div>
																					</label>
																				</div>
																				<div class="form-error" v-if="error.insti_file_cartao_cnpj.length"><small>{{ error.insti_file_cartao_cnpj }}</small></div>
																			</div>

																		</div>
																		<div class="col-12 col-md-6">

																			<div class="form-group">
																				<div class="">
																					<label class="form-label text-center">Upload Contrato Social</label>
																				</div>
																				<div>
																					<label for="fileInputContrSocial" style="display: block; width: 100%;">
																						<div class="d-flex align-items-center form-control" style="border: 1.5px solid #e79c32 !important; height: 100%;">
																							<div style="border-right: 1.5px solid #e79c32 !important; padding-right: 0.5rem !important;"><i class="fas fa-file-upload" style="color: #e79c32;"></i></div>
																							<div style="padding-left: 0.5rem !important; color: gray; overflow: hidden;">
																								<span style="text-wrap: nowrap; font-size: .85rem;" class="" v-if="fields.insti_file_contr_social">{{fields.insti_file_contr_social}}</span>
																								<span v-else>Nenhum arquivo escolhido</span>
																							</div>
																							<div class="d-none">
																								<input type="file" name="fileInputContrSocial" id="fileInputContrSocial" ref="fileInputContrSocial" @change="pickFile($event, 'fileInputContrSocial', 'previewContrSocial', 'imageContrSocial', 'insti_file_contr_social')" style="display: none;" />
																							</div>
																						</div>
																					</label>
																				</div>
																				<div class="form-error" v-if="error.insti_file_contr_social.length"><small>{{ error.insti_file_contr_social }}</small></div>
																			</div>

																		</div>
																	</div>

																	<div class="row"><!-- Upload RG do Responsável -->
																		<div class="col-12 col-md-6">

																			<div class="form-group">
																				<div class="">
																					<label class="form-label text-center">Upload RG do Responsável</label>
																				</div>
																				<div>
																					<label for="fileInputDocRG" style="display: block; width: 100%;">
																						<div class="d-flex align-items-center form-control" style="border: 1.5px solid #e79c32 !important; height: 100%;">
																							<div style="border-right: 1.5px solid #e79c32 !important; padding-right: 0.5rem !important;"><i class="fas fa-file-upload" style="color: #e79c32;"></i></div>
																							<div style="padding-left: 0.5rem !important; color: gray; overflow: hidden;">
																								<span style="text-wrap: nowrap; font-size: .85rem;" class="" v-if="fields.insti_file_doc_rg">{{fields.insti_file_doc_rg}}</span>
																								<span v-else>Nenhum arquivo escolhido</span>
																							</div>
																							<div class="d-none">
																								<input type="file" name="fileInputDocRG" id="fileInputDocRG" ref="fileInputDocRG" @change="pickFile($event, 'fileInputDocRG', 'previewDocRG', 'imageDocRG', 'insti_file_doc_rg')" style="display: none;" />
																							</div>
																						</div>
																					</label>
																				</div>
																				<div class="form-error" v-if="error.insti_file_doc_rg.length"><small>{{ error.insti_file_doc_rg }}</small></div>
																			</div>

																		</div>
																		<div class="col-12 col-md-6">

																			<div class="form-group">
																				<div class="">
																					<label class="form-label text-center">Upload CPF do Responsável</label>
																				</div>
																				<div>
																					<label for="fileInputDocCPF" style="display: block; width: 100%;">
																						<div class="d-flex align-items-center form-control" style="height: 100%;">
																							<div style="border-right: 1.5px solid #e79c32 !important; padding-right: 0.5rem !important;"><i class="fas fa-file-upload" style="color: #e79c32;"></i></div>
																							<div style="padding-left: 0.5rem !important; color: gray; overflow: hidden;">
																								<span style="text-wrap: nowrap; font-size: .85rem;" class="" v-if="fields.insti_file_doc_cpf">{{fields.insti_file_doc_cpf}}</span>
																								<span v-else>Nenhum arquivo escolhido</span>
																							</div>
																							<div class="d-none">
																								<input type="file" name="fileInputDocCPF" id="fileInputDocCPF" ref="fileInputDocCPF" @change="pickFile($event, 'fileInputDocCPF', 'previewDocCPF', 'imageDocCPF', 'insti_file_doc_cpf')" style="display: none;" />
																							</div>
																						</div>
																					</label>
																				</div>
																				<div class="form-error" v-if="error.insti_file_doc_cpf.length"><small>{{ error.insti_file_doc_cpf }}</small></div>
																			</div>

																		</div>
																	</div>


																	<?php 
																		$insti_redes_sociais = (isset($rs_group->insti_redes_sociais) ? $rs_group->insti_redes_sociais : '');
																		$obj_redes_sociais = json_decode( $insti_redes_sociais );
																		$insti_sm_instagram = (isset($obj_redes_sociais->instagram) ? $obj_redes_sociais->instagram : '');
																		$insti_sm_facebook = (isset($obj_redes_sociais->facebook) ? $obj_redes_sociais->facebook : '');
																		$insti_sm_youtube = (isset($obj_redes_sociais->youtube) ? $obj_redes_sociais->youtube : '');
																		$insti_sm_vimeo = (isset($obj_redes_sociais->vimeo) ? $obj_redes_sociais->vimeo : '');
																	?>
																	<div class="pt-4 pb-2">
																		<h3 class="">Redes Sociais</h3>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_sm_instagram">Instagram</label>
																					<input type="text" name="insti_sm_instagram" id="insti_sm_instagram" class="form-control" ref="insti_sm_instagram" v-model="fields.insti_sm_instagram" value="<?php echo($insti_sm_instagram);?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_sm_instagram.length"><small>{{ error.insti_sm_instagram }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_sm_facebook">Facebook</label>
																					<input type="text" name="insti_sm_facebook" id="insti_sm_facebook" class="form-control" ref="insti_sm_facebook" v-model="fields.insti_sm_facebook" value="<?php echo($insti_sm_facebook);?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_sm_facebook.length"><small>{{ error.insti_sm_facebook }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_sm_youtube">Youtube</label>
																					<input type="text" name="insti_sm_youtube" id="insti_sm_youtube" class="form-control" ref="insti_sm_youtube" v-model="fields.insti_sm_youtube" value="<?php echo($insti_sm_youtube);?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_sm_youtube.length"><small>{{ error.insti_sm_youtube }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_sm_vimeo">Vimeo</label>
																					<input type="text" name="insti_sm_vimeo" id="insti_sm_vimeo" class="form-control" ref="insti_sm_vimeo" v-model="fields.insti_sm_vimeo" value="<?php echo($insti_sm_vimeo);?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_sm_vimeo.length"><small>{{ error.insti_sm_vimeo }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="pt-4 pb-2">
																		<h3 class="">Endereço</h3>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_end_cep">CEP</label>
																					<input type="text" name="insti_end_cep" id="insti_end_cep" class="form-control mask-cep" ref="insti_end_cep" v-model="fields.insti_end_cep" v-on:blur="blurCheckCEP" value="<?php echo((isset($rs_group->insti_end_cep) ? $rs_group->insti_end_cep : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_end_cep.length"><small>{{ error.insti_end_cep }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-7">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_end_logradouro">Endereço</label>
																					<input type="text" name="insti_end_logradouro" id="insti_end_logradouro" class="form-control" ref="insti_end_logradouro" v-model="fields.insti_end_logradouro" value="<?php echo((isset($rs_group->insti_end_logradouro) ? $rs_group->insti_end_logradouro : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_end_logradouro.length"><small>{{ error.insti_end_logradouro }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-2">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_end_numero">Número</label>
																					<input type="text" name="insti_end_numero" id="insti_end_numero" class="form-control" ref="insti_end_numero" v-model="fields.insti_end_numero" value="<?php echo((isset($rs_group->insti_end_numero) ? $rs_group->insti_end_numero : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_end_numero.length"><small>{{ error.insti_end_numero }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_end_compl">Complemento</label>
																					<input type="text" name="insti_end_compl" id="insti_end_compl" class="form-control" ref="insti_end_compl" v-model="fields.insti_end_compl" value="<?php echo((isset($rs_group->insti_end_compl) ? $rs_group->insti_end_compl : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_end_compl.length"><small>{{ error.insti_end_compl }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-7">
																			<div class="row">
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="insti_end_bairro">Bairro</label>
																							<input type="text" name="insti_end_bairro" id="insti_end_bairro" class="form-control" ref="insti_end_bairro" v-model="fields.insti_end_bairro" value="<?php echo((isset($rs_group->insti_end_bairro) ? $rs_group->insti_end_bairro : ""));?>" />
																						</div>
																						<div class="form-error" v-if="error.insti_end_bairro.length"><small>{{ error.insti_end_bairro }}</small></div>
																					</div>
																				</div>
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="insti_end_cidade">Cidade</label>
																							<input type="text" name="insti_end_cidade" id="insti_end_cidade" class="form-control" ref="insti_end_cidade" v-model="fields.insti_end_cidade" value="<?php echo((isset($rs_group->insti_end_cidade) ? $rs_group->insti_end_cidade : ""));?>" />
																						</div>
																						<div class="form-error" v-if="error.insti_end_cidade.length"><small>{{ error.insti_end_cidade }}</small></div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-12 col-md-2">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="insti_end_estado">Estado</label>
																					<input type="text" name="insti_end_estado" id="insti_end_estado" class="form-control" ref="insti_end_estado" v-model="fields.insti_end_estado" value="<?php echo((isset($rs_group->insti_end_estado) ? $rs_group->insti_end_estado : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.insti_end_estado.length"><small>{{ error.insti_end_estado }}</small></div>
																			</div>
																		</div>
																	</div>





																</div>
																<div class="content-actions">
																	<div class="row justify-content-end">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="stepSalvarCadastro(2)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 2 -->
											<div class="h-100" v-show="step == 2" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações de Cobrança</h2>
																	<div class="text-muted fs-6 text-center text-md-start">Confira as informações e efetue o pagamento.</div>
																</div>
																<div class="content-itens">

																	<div class="row justify-content-between">
																		<div class="col-11 col-md-6">

																			<div class="card">
																				<div class="card-header">
																					Código de Identificação
																				</div>
																				<div class="card-body">
																					<div>
																						<h3>XTU245STU-2024</h3>
																					</div>
																				</div>
																			</div>

																			<div class="pt-4">
																				Para concluir e efetuar o pagamento através do Mercado Pago, clique no botão 'Efetuar Pagamento'. E siga as instruções que serão exibidas.
																			</div>

																		</div>
																		<div class="col-11 col-md-5">

																			<div class="card">
																				<div class="card-header">
																					Resumo
																				</div>
																				<div class="card-body">

																					<h3>R$ 1.200,00</h3>

																					<h4>desconto: R$ 100,00</h4>
																					
																					<div class="pt-3">
																						<h3>Total: R$ 1.100,00</h3>
																					</div>

																				</div>
																			</div>

																		</div>
																	</div>

																</div>
																<div class="content-actions">
																	<div class="row justify-content-between">
																		<div class="col-4 col-md-3">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-secondary" v-on:click="prevStep(1)">Anterior</a>
																			</div>
																		</div>
																		<div class="col-8 col-md-6">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary">Efetuar Pagamento</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 3 -->
											<div class="h-100" v-show="step == 3" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações Jurídicas</h2>
																	<div class="text-muted fs-6 text-center text-md-start">Confira as informações e efetue o pagamento.</div>
																</div>
																<div class="content-itens">

																</div>
																<div class="content-actions">
																	<div class="row justify-content-between">
																		<div class="col-4 col-md-3">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-secondary" v-on:click="prevStep(1)">Anterior</a>
																			</div>
																		</div>
																		<div class="col-8 col-md-6">

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
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.table-bordered>:not(caption)>* {
			border-color: #ffffff !important;
		}
		.table td {
			border-color: #ffffff !important;
		}
	</style>
	<style>
		.box-file-upload{
			/*padding: 0.5rem 1.0rem !important;*/
			/*background: #f8f9fa !important;*/
			/*background: #FAFAFA !important;*/
			/*color: #000000 !important;*/
			/*font-size: .90rem !important;*/
			/*height: calc(4.3em + 1.5rem + 2px) !important;*/
			/*border-radius: 30px !important;*/
			/*border: 1.5px solid #e79c32 !important;*/
			margin-bottom: 0.75rem;
			display: flex;
			/*gap: 1px;*/
		}
		.box-file-upload figure{ cursor: pointer; margin: 0 !important; text-align: center; }
		.box-file-upload figure img{ cursor: pointer; margin: 0 auto !important; width: 60% !important; }
		.box-file-upload .img-preview{
			/*padding: 0.5rem 1.0rem !important;*/
			width: 60%;
			height: calc(4.3em + 1.5rem + 2px) !important;
			background: #FAFAFA !important;
			border-top-left-radius: 30px;
			border-bottom-left-radius: 30px;
			/*border: 1.5px solid #e79c32 !important;*/
		}
		.box-file-upload .txt-click{
			position: relative;
			cursor: pointer;
			padding: 0.5rem 1.0rem !important;
			width: 40%;
			height: calc(4.3em + 1.5rem + 2px) !important;
			background: #e79c32 !important;
			border-top-right-radius: 30px;
			border-bottom-right-radius: 30px;
			/*border: 1.5px solid #e79c32 !important;*/
			/*border-left: 0px solid #e79c32 !important;*/
			font-size: .90rem !important;
			display: flex;
			justify-content: center;
			align-items: center;
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


		/*.box-featured{}*/
		/*.box-featured .item{ text-align: center; }*/
		/*.box-featured .item .itemIcon{*/
		/*	height: 120px;*/
		/*	width: 120px;*/
		/*	*/
		/*	border-radius: 50%;*/
		/*	cursor: pointer;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	/*border: 1px solid white;*/*/
		/*	margin-bottom: 10px;*/
		/*	display: flex;*/
		/*	justify-content: center;*/
		/*	align-items: center;*/
		/*}*/
		/*.box-featured .item .itemIcon:hover{*/
		/*	background: #ffffff;*/
		/*}*/
		/*.box-featured .item .itemIcon img{*/
		/*	max-width: 60%;*/
		/*}*/

		/*.card-destaque{*/
		/*	height: 140px;*/
		/*	background: #fff7f1;*/
		/*	/* border: 0px; */*/
		/*	border-radius: .5rem;*/
		/*	border: 1px solid #ffc08f;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	border: 1px solid white;*/
		/*}*/
		/*.card-plus{*/
		/*	height: 460px;*/
		/*	background: #fff7f1;*/
		/*	/* border: 0px; */*/
		/*	border-radius: .5rem;*/
		/*	border: 1px solid #ffc08f;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	border: 1px solid white;*/
		/*}*/
		/*.card-patrocinador{*/
		/*	height: 280px;*/
		/*	background: #d3d3d3;*/
		/*	/* border: 0px; */*/
		/*	border-radius: .5rem;*/
		/*	border: 3px solid #ffffff;*/
		/*	background: #e1e1e1;*/
		/*	box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);*/
		/*	border: 1px solid white;*/
		/*}*/
	</style>

	<style>
		/*.mb-ST { margin-bottom: 32px !important; }*/
		/*.btn-primary {*/
		/*	color: #fff;*/
		/*	background-color: var(--blue-poravo);*/
		/*	border-color: var(--blue-poravo);*/
		/*	border-radius: 24px;*/
		/*}*/
		/*.btn-secondary {*/
		/*	color: #fff;*/
		/*	border-radius: 24px;*/
		/*}*/
		/*.btn {*/
		/*	padding: 0.9rem 26px !important;*/
		/*}*/

		/*.form-control {*/
		/*	border: 1px solid #F2F2F2;*/
		/*	border-radius: 8px;*/
		/*	padding: 0.9rem !important;*/
		/*	background-color: #F2F2F2;*/
		/*}*/
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

<?php $this->section('scripts'); ?>

	<!-- VueJs -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="assets/plugins/flatpickr/flatpickr-locale-br.js"></script>
	<!-- <script src="assets/painel/js/custom/documentation/forms/flatpickr-locale-br.js"></script> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/hmac-md5.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/md5.min.js" integrity="sha512-ENWhXy+lET8kWcArT6ijA6HpVEALRmvzYBayGL6oFWl96exmq8Fjgxe2K6TAblHLP75Sa/a1YjHpIZRt+9hGOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<script>
		function converterParaMinutosESegundos(segundos) {
			var minutos = Math.floor(segundos / 60);
			var segundosRestantes = segundos % 60;
			return minutos +":"+ segundosRestantes;
		}

		$(document).ready(function () {
			var tempoTotal = 0;
			$(document).on('change', '#fileMusicaMP3', function (e) {
			//$("#fileMusicaMP3").change(function() {
				console.log('selecionou o arquivo');
				var quantidadeDeArquivos = this.files.length;
				for (var i = 0; i < quantidadeDeArquivos; i++) {
					var esteArquivo = this.files[i];
					fileB = URL.createObjectURL(esteArquivo);

					var audioElement2 = new Audio(fileB);
					audioElement2.setAttribute('src', fileB);
					audioElement2.onloadedmetadata = function(e) {
						tempoTotal = tempoTotal + parseInt(this.duration);

						console.log('tempo', tempoTotal);


						//$("#musicas").html("Músicas Carregadas: " + quantidadeDeArquivos + " (Tempo Total: " + converterParaMinutosESegundos(tempoTotal) + ")");
						//$("#musicas").html("Tempo: " + converterParaMinutosESegundos(tempoTotal));
						$("#tempo_musica").val(converterParaMinutosESegundos(tempoTotal));
					//alert("loadedmetadata" + tempoTotal);
					}
				}
				tempoTotal = 0;
			});
		});

		//var quantidadeDeArquivos = itemEl.length;
		//for (var i = 0; i < quantidadeDeArquivos; i++) {
		//	var esteArquivo = itemEl[i];
		//	fileB = URL.createObjectURL(esteArquivo);
		//	var audioElement2 = new Audio(fileB);
		//	audioElement2.setAttribute('src', fileB);
		//	audioElement2.onloadedmetadata = function(e) {
		//		tempoTotal = tempoTotal + parseInt(this.duration);
		//		//$("#musicas").html("Músicas Carregadas: " + quantidadeDeArquivos + " (Tempo Total: " + converterParaMinutosESegundos(tempoTotal) + ")");
		//		$("#tempo_musica").val(converterParaMinutosESegundos(tempoTotal));
		//		//alert("loadedmetadata" + tempoTotal);
		//		//console.log( converterParaMinutosESegundos(tempoTotal) );
		//	}
		//}
	</script>

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
	<script type="text/javascript" src="assets/vue/cadastro.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>