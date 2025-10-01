<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 

	$event_hashkey = (isset($rs_event->event_hashkey) ? $rs_event->event_hashkey : "");
	$event_titulo = (isset($rs_event->event_titulo) ? $rs_event->event_titulo : "");

	$grevt_id = (isset($rs_group->grevt_id) ? $rs_group->grevt_id : "");
	$grp_hashkey = (isset($rs_group->grp_hashkey) ? $rs_group->grp_hashkey : "");

	//print('<pre style="height: 140px; font-size: .65rem; line-height: 1.4;">');
	//print_r($rs_group);
	//print('</pre>');

	//$list_rs_categorias = (isset($rs_categorias) ? $rs_categorias->getResult() : []);
	$list_rs_func_obrig = (isset($list_rs_func_obrig) ? $list_rs_func_obrig : []);
	$list_rs_funcoes = (isset($rs_funcoes) ? $rs_funcoes->getResult() : []);
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-12">
					<h3>Cadastro de Equipe <?php //echo( $event_titulo ); ?></h3>
				</div>
			</div>
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsInscricao" id="formFieldsInscricao" ref="formFieldsInscricao" enctype="multipart/form-data">
						<input type="hidden" name="event_hashkey" id="event_hashkey" class="form-control" ref="event_hashkey" v-model="fields.event_hashkey" value="<?php echo((isset($event_hashkey) ? $event_hashkey : ""));?>" />

						<input type="hidden" name="grp_id" id="grp_id" class="form-control" ref="grp_id" v-model="fields.grp_id" value="<?php echo((isset($grevt_id) ? $grevt_id : ""));?>" />
						<input type="hidden" name="grp_hashkey" id="grp_hashkey" class="form-control" ref="grp_hashkey" v-model="fields.grp_hashkey" value="<?php echo((isset($grp_hashkey) ? $grp_hashkey : ""));?>" />

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
														<div class="naveg-steps-item" v-bind:class="{current: step >= 1}" v-on:click="nextStep(1)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 1"></i>
																<span class="steps-number" v-show="step == 1">1</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Informações Pessoais</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 2}" v-on:click="nextStep(2)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 2"></i>
																<span class="steps-number" v-show="step <= 2">2</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Informações Profissionais</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 3}" v-on:click="nextStep(3)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 3"></i>
																<span class="steps-number" v-show="step <= 3">3</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Informações de Pagamento</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 4}" v-on:click="nextStep(4)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 4"></i>
																<span class="steps-number" v-show="step <= 4">4</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Documentação</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 5}" v-on:click="nextStep(5)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 5"></i>
																<span class="steps-number" v-show="step <= 5">5</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Contato de Emergência</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 6}" v-on:click="nextStep(6)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 6"></i>
																<span class="steps-number" v-show="step <= 6">6</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Informações Adicionais</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 7}" v-on:click="nextStep(7)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 7"></i>
																<span class="steps-number" v-show="step <= 7">7</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Informações de Uniforme</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

														<div class="naveg-steps-item" v-bind:class="{current: step >= 8}" v-on:click="nextStep(8)">
															<div class="steps-icon">
																<i class="stepper-check fas fa-check" v-show="step > 8"></i>
																<span class="steps-number" v-show="step <= 8">8</span>
															</div>
															<div class="steps-label">
																<h3 class="steps-title">Contratos</h3>
																<div class="steps-desc">&nbsp;</div>
															</div>
														</div>

													</div>
												</div>
											</div>

										</div>
										<div class="col-12 col-md-9">

											<!-- Step 1 -->
											<div class="" v-show="step == 1" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações Pessoais</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">CPF</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control mask-cpf" ref="grp_cpf" value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Nome</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo" value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">E-mail</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo" value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Telefone</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control mask-phone" ref="grp_cpf" value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">RG</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Órgão Emissor do RG</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Data de Nascimento</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control mask-date" ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_telefone">Gênero</label>
																					<select class="form-select" name="corgf_formt_id" id="corgf_formt_id">
																						<option value="">- selecione -</option>
																						<option value="">Masculino</option>
																						<option value="">Feminino</option>
																						<option value="">Outro</option>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.grp_telefone.length"><small>{{ error.grp_telefone }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_celular">Nacionalidade</label>
																					<input type="text" name="grp_celular" id="grp_celular" class="form-control " ref="grp_celular" v-model="fields.grp_celular" value="<?php echo((isset($rs_group->grp_celular) ? $rs_group->grp_celular : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_celular.length"><small>{{ error.grp_celular }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_celular">Estado Civil</label>
																					<select class="form-select" name="corgf_formt_id" id="corgf_formt_id">
																						<option value="">- selecione -</option>
																						<option value="">Solteiro</option>
																						<option value="">Casado</option>
																						<option value="">Divorciado</option>
																						<option value="">Víuvo</option>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.grp_celular.length"><small>{{ error.grp_celular }}</small></div>
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
																					<label class="form-label" for="grp_end_cep">CEP</label>
																					<input type="text" name="grp_end_cep" id="grp_end_cep" class="form-control mask-cep" ref="grp_end_cep" v-model="fields.grp_end_cep" v-on:blur="blurCheckCEP" value="<?php echo((isset($rs_group->grp_end_cep) ? $rs_group->grp_end_cep : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_cep.length"><small>{{ error.grp_end_cep }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-7">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_logradouro">Endereço</label>
																					<input type="text" name="grp_end_logradouro" id="grp_end_logradouro" class="form-control" ref="grp_end_logradouro" v-model="fields.grp_end_logradouro" value="<?php echo((isset($rs_group->grp_end_logradouro) ? $rs_group->grp_end_logradouro : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_logradouro.length"><small>{{ error.grp_end_logradouro }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-2">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_numero">Número</label>
																					<input type="text" name="grp_end_numero" id="grp_end_numero" class="form-control" ref="grp_end_numero" v-model="fields.grp_end_numero" value="<?php echo((isset($rs_group->grp_end_numero) ? $rs_group->grp_end_numero : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_numero.length"><small>{{ error.grp_end_numero }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_compl">Complemento</label>
																					<input type="text" name="grp_end_compl" id="grp_end_compl" class="form-control" ref="grp_end_compl" v-model="fields.grp_end_compl" value="<?php echo((isset($rs_group->grp_end_compl) ? $rs_group->grp_end_compl : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_compl.length"><small>{{ error.grp_end_compl }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-7">
																			<div class="row">
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="grp_end_bairro">Bairro</label>
																							<input type="text" name="grp_end_bairro" id="grp_end_bairro" class="form-control" ref="grp_end_bairro" v-model="fields.grp_end_bairro" value="<?php echo((isset($rs_group->grp_end_bairro) ? $rs_group->grp_end_bairro : ""));?>" />
																						</div>
																						<div class="form-error" v-if="error.grp_end_bairro.length"><small>{{ error.grp_end_bairro }}</small></div>
																					</div>
																				</div>
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="grp_end_cidade">Cidade</label>
																							<input type="text" name="grp_end_cidade" id="grp_end_cidade" class="form-control" ref="grp_end_cidade" v-model="fields.grp_end_cidade" value="<?php echo((isset($rs_group->grp_end_cidade) ? $rs_group->grp_end_cidade : ""));?>" />
																						</div>
																						<div class="form-error" v-if="error.grp_end_cidade.length"><small>{{ error.grp_end_cidade }}</small></div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-12 col-md-2">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_estado">Estado</label>
																					<input type="text" name="grp_end_estado" id="grp_end_estado" class="form-control" ref="grp_end_estado" v-model="fields.grp_end_estado" value="<?php echo((isset($rs_group->grp_end_estado) ? $rs_group->grp_end_estado : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_estado.length"><small>{{ error.grp_end_estado }}</small></div>
																			</div>
																		</div>
																	</div>

																</div>
																<div class="content-actions">
																	<div class="row justify-content-between">
																		<div class="col-12 col-md-4">
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(2)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 2 Informações Profissionais -->
											<div class="" v-show="step == 2" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações Profissionais</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<!--
																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Prestação de Serviço</label>
																					<div>[] Diária -- carregará os campos para seleção de data, hor inicil, hor final</div>
																					<div>[] Mensal -- carregará os campos para seleção de período (calendário com data inicio e final)</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	-->

																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Cargo (campo não editável)</label>
																					<select class="form-select" name="corgf_formt_id" id="corgf_formt_id">
																						<option value="coordenador">Coordenador</option>
																						<option value="assistente">Assistente</option>
																						<option value="voluntario">Voluntário</option>
																						<option value="outro">Outro</option>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-8">
																			<div class="form-group">
																				<div><label class="form-label">Prestação de Serviço</label></div>
																				<div>
																					<div class="form-check-inline my-1">
																						<div class="custom-control custom-radio">
																							<input type="radio" name="event_tipo_servico" id="tipoagend_result_diaria" class="custom-control-input changeTipoPrestacao" value="diaria" checked />
																							<label class="custom-control-label" for="tipoagend_result_s">Diária</label>
																						</div>
																					</div>
																					<div class="form-check-inline my-1">
																						<div class="custom-control custom-radio">
																							<input type="radio" name="event_tipo_servico" id="tipoagend_result_mensal" class="custom-control-input changeTipoPrestacao" value="mensal" />
																							<label class="custom-control-label" for="tipoagend_result_n">Mensal</label>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-4">

																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Tipo de Equipe</label>
																					<select class="form-select" name="corgf_formt_id" id="corgf_formt_id">
																						<option value="coordenador">Direta</option>
																						<option value="assistente">Indireta</option>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>

																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Departamento/Setor</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>

																		</div>
																		<div class="col-12 col-md-8">

																			<div id="box-container-diaria" class="box-container-prest-servico active">
																				<div class="card card-base mb-3" style="border: 1.5px solid #e79c32 !important; background-color: #efefef; border-radius: 10px; box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);">
																					<div class="card-body">
																						<div class="row g-2">
																							<div class="col-12 col-md-4">
																								<div class="form-group m-0">
																									<label class="form-label">Data</label>
																								</div>
																							</div>
																							<div class="col-12 col-md-7">
																								<div class="row g-2">
																									<div class="col-12 col-md-6">
																										<div class="form-group m-0">
																											<label class="form-label">Horário Inicial</label>
																										</div>
																									</div>
																									<div class="col-12 col-md-6">
																										<div class="form-group m-0">
																											<label class="form-label">Horário Final</label>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-12 col-md-1 text-center">
																								<div class="form-group m-0">
																									<label class="form-label">Ação</label>
																								</div>
																							</div>
																						</div>
																						<div id="BOX-CONTENT-DATA-DIARIA">
																						</div>
																						<div class="d-flex justify-content-end">
																							<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovaDteDiaria">Adicionar Nova Data</a></div>
																						</div>
																					</div>
																				</div>
																			</div>

																			<div id="box-container-mensal" class="box-container-prest-servico">
																				<div class="card card-base mb-3" style="border: 1.5px solid #e79c32 !important; background-color: #efefef; border-radius: 10px; box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);">
																					<div class="card-body">
																						<div class="row g-2">
																							<div class="col-12 col-md-11">
																								<div class="row g-2">
																									<div class="col-12 col-md-6">
																										<div class="form-group m-0">
																											<label class="form-label">Data Início</label>
																										</div>
																									</div>
																									<div class="col-12 col-md-6">
																										<div class="form-group m-0">
																											<label class="form-label">Data Final</label>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-12 col-md-1 text-center">
																								<div class="form-group m-0">
																									<label class="form-label">Ação</label>
																								</div>
																							</div>
																						</div>
																						<div id="BOX-CONTENT-DATA-MENSAL">
																						</div>
																						<div class="d-flex justify-content-end">
																							<div style="margin-left: 5px;"><a href="javascript:;" class="btn btn-sm btn-warning cmdAddNovaDteMensal">Adicionar Nova Data</a></div>
																						</div>
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Experiência Prévia</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Formação Acadêmica</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Certificações e Treinamentos</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Idiomas</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Habilidades e Competências</label>
																					<textarea rows="4" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>"></textarea> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Atividades e Responsabilidades</label>
																					<textarea rows="4" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>"></textarea> 
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																</div>
																<div class="content-actions">
																	<div class="row justify-content-between">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(1)" >Voltar</a>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(3)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 3 Informações de Pagamento -->
											<div class="" v-show="step == 3" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações de Pagamento</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Salário</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-8">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Banco</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Agência</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Conta</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Tipo de Conta</label>
																					<select class="form-select" name="corgf_formt_id" id="corgf_formt_id">
																						<option value="">- selecione -</option>
																						<option value="">Conta Corrente</option>
																						<option value="">Poupança</option>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Informações Adicionais de Pagamento (PIX, etc.)</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Data de Pagamento</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-8">
																			<div class="" style="width: 100%;">
																				<div class="">
																					<label class="form-label text-center">Anexar Comprovante de Pagamento</label>
																				</div>
																				<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="content-actions">
																	<div class="row justify-content-end">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(4)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 4 Documentação -->
											<div class="" v-show="step == 4" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Documentação</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row mb-3">
																		<div class="col-12 col-md-12">
																			<div class="" style="width: 100%;">
																				<div class="">
																					<label class="form-label text-center">Documentos Pessoais (CPF, RG, Certidão de Nascimento ou Casamento)</label>
																				</div>
																				<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
																			</div>
																		</div>
																	</div>

																	<div class="row mb-3">
																		<div class="col-12 col-md-12">
																			<div class="" style="width: 100%;">
																				<div class="">
																					<label class="form-label text-center">Comprovante de Residência</label>
																				</div>
																				<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
																			</div>
																		</div>
																	</div>

																	<div class="row mb-3">
																		<div class="col-12 col-md-12">
																			<div class="" style="width: 100%;">
																				<div class="">
																					<label class="form-label text-center">Comprovante de Escolaridade</label>
																				</div>
																				<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
																			</div>
																		</div>
																	</div>

																	<div class="row mb-3">
																		<div class="col-12 col-md-12">
																			<div class="" style="width: 100%;">
																				<div class="">
																					<label class="form-label text-center">Certificados de Treinamento</label>
																				</div>
																				<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
																			</div>
																		</div>
																	</div>

																	<div class="row mb-3">
																		<div class="col-12 col-md-12">
																			<div class="" style="width: 100%;">
																				<div class="">
																					<label class="form-label text-center">Contrato de Trabalho (se aplicável)</label>
																				</div>
																				<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
																			</div>
																		</div>
																	</div>

																	<div class="row mb-3">
																		<div class="col-12 col-md-12">
																			<div class="" style="width: 100%;">
																				<div class="">
																					<label class="form-label text-center">Termos de Voluntariado (se aplicável)</label>
																				</div>
																				<input type="file" name="file_regulamento" id="file_regulamento" class="form-control files">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="content-actions">
																	<div class="row justify-content-end">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(5)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 5 Contato de Emergência -->
											<div class="" v-show="step == 5" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Contato de Emergência</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Nome</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Grau de Parentesco</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">E-mail</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Telefone</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control mask-phone" ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
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
																					<label class="form-label" for="grp_end_cep">CEP</label>
																					<input type="text" name="grp_end_cep" id="grp_end_cep" class="form-control mask-cep" ref="grp_end_cep" v-model="fields.grp_end_cep" v-on:blur="blurCheckCEP" value="<?php echo((isset($rs_group->grp_end_cep) ? $rs_group->grp_end_cep : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_cep.length"><small>{{ error.grp_end_cep }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-7">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_logradouro">Endereço</label>
																					<input type="text" name="grp_end_logradouro" id="grp_end_logradouro" class="form-control" ref="grp_end_logradouro" v-model="fields.grp_end_logradouro" value="<?php echo((isset($rs_group->grp_end_logradouro) ? $rs_group->grp_end_logradouro : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_logradouro.length"><small>{{ error.grp_end_logradouro }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-2">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_numero">Número</label>
																					<input type="text" name="grp_end_numero" id="grp_end_numero" class="form-control" ref="grp_end_numero" v-model="fields.grp_end_numero" value="<?php echo((isset($rs_group->grp_end_numero) ? $rs_group->grp_end_numero : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_numero.length"><small>{{ error.grp_end_numero }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-3">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_compl">Complemento</label>
																					<input type="text" name="grp_end_compl" id="grp_end_compl" class="form-control" ref="grp_end_compl" v-model="fields.grp_end_compl" value="<?php echo((isset($rs_group->grp_end_compl) ? $rs_group->grp_end_compl : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_compl.length"><small>{{ error.grp_end_compl }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-7">
																			<div class="row">
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="grp_end_bairro">Bairro</label>
																							<input type="text" name="grp_end_bairro" id="grp_end_bairro" class="form-control" ref="grp_end_bairro" v-model="fields.grp_end_bairro" value="<?php echo((isset($rs_group->grp_end_bairro) ? $rs_group->grp_end_bairro : ""));?>" />
																						</div>
																						<div class="form-error" v-if="error.grp_end_bairro.length"><small>{{ error.grp_end_bairro }}</small></div>
																					</div>
																				</div>
																				<div class="col-12 col-md-6">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="grp_end_cidade">Cidade</label>
																							<input type="text" name="grp_end_cidade" id="grp_end_cidade" class="form-control" ref="grp_end_cidade" v-model="fields.grp_end_cidade" value="<?php echo((isset($rs_group->grp_end_cidade) ? $rs_group->grp_end_cidade : ""));?>" />
																						</div>
																						<div class="form-error" v-if="error.grp_end_cidade.length"><small>{{ error.grp_end_cidade }}</small></div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-12 col-md-2">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_end_estado">Estado</label>
																					<input type="text" name="grp_end_estado" id="grp_end_estado" class="form-control" ref="grp_end_estado" v-model="fields.grp_end_estado" value="<?php echo((isset($rs_group->grp_end_estado) ? $rs_group->grp_end_estado : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_end_estado.length"><small>{{ error.grp_end_estado }}</small></div>
																			</div>
																		</div>
																	</div>

																</div>
																<div class="content-actions">
																	<div class="row justify-content-end">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(6)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 6 Informações Adicionais -->
											<div class="" v-show="step == 6" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações Adicionais</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_cpf">Restrição Alimentar</label>
																					<input type="text" name="grp_cpf" id="grp_cpf" class="form-control " ref="grp_cpf"  value="<?php echo((isset($rs_group->grp_cpf) ? $rs_group->grp_cpf : ""));?>" />
																				</div>
																				<div class="form-error" v-if="error.grp_cpf.length"><small>{{ error.grp_cpf }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Observações Gerais</label>
																					<textarea rows="4" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>"></textarea>
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Redes Sociais (LinkedIn, Instagram, Facebook, etc.)</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																	</div>

																</div>
																<div class="content-actions">
																	<div class="row justify-content-end">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(7)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 7 Informações de Uniforme -->
											<div class="" v-show="step == 7" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações de Uniforme</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Tamanho da Camiseta</label>
																					<select class="form-select" name="corgf_formt_id" id="corgf_formt_id">
																						<option value="pp">PP</option>
																						<option value="p">P</option>
																						<option value="m">M</option>
																						<option value="g">G</option>
																						<option value="gg">GG</option>
																						<option value="xg">XG</option>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Tamanho da Calça</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Tamanho da Sapato</label>
																					<input type="text" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>" /> 
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="grp_titulo">Necessidades Especiais</label>
																					<textarea rows="4" name="grp_titulo" id="grp_titulo" class="form-control" ref="grp_titulo"  value="<?php echo((isset($rs_group->grp_titulo) ? $rs_group->grp_titulo : ""));?>"></textarea>
																				</div>
																				<div class="form-error" v-if="error.grp_titulo.length"><small>{{ error.grp_titulo }}</small></div>
																			</div>
																		</div>
																	</div>

																</div>
																<div class="content-actions">
																	<div class="row justify-content-end">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(8)" >Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 8 Contratos -->
											<div class="" v-show="step == 8" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Contratos</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Selecione abaixo o tipo de cadastro que deseja efetuar.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row">
																		<div class="col-12 col-md-6">
																			<a href="javascript:;" class="link-contrato"><div class="mb-3 item-contrato">
																				<div class="status">
																					não assinado <i class="fas fa-exclamation-triangle"></i>
																				</div> 
																				<div>
																					<h3>Nome do Contrato 1</h3>
																					<p>clique para assinar o contrato</p>
																				</div>
																			</div></a>
																		</div>
																		<div class="col-11 col-md-6">
																			<a href="javascript:;" class="link-contrato"><div class="mb-3 item-contrato">
																				<div class="status">
																					não assinado <i class="fas fa-exclamation-triangle"></i>
																				</div> 
																				<div>
																					<h3>Nome do Contrato 2</h3>
																					<p>clique para assinar o contrato</p>
																				</div>
																			</div></a>
																		</div>
																		<div class="col-11 col-md-6">
																			<a href="javascript:;" class="link-contrato"><div class="mb-3 item-contrato active">
																				<div class="status">
																					assinado <i class="far fa-check-circle"></i>
																				</div> 
																				<div>
																					<h3>Nome do Contrato 3</h3>
																					<p>click para acessar o contrato</p>
																				</div>
																			</div></a>
																		</div>
																	</div>

																</div>
																<div class="content-actions">
																	<div class="row justify-content-end">
																		<div class="col-12 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="nextStep(6)" >Continuar</a>
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
											<div class="h-100" v-show="step == 21" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-12 col-md-12">
																<div>
																	<div class="row">
																		<div class="col-12 col-md-9">
																			<h2 class="fw-bolder text-dark title-step">Informações Profissionais</h2>
																			<!-- <div class="text-muted fs-6 text-center text-md-start">Informe que irão integrar ao grupo.</div> -->
																		</div>
																		<div class="col-12 col-md-3">
																			<div class="" v-if="previewLogotipo">
																				<div>file name: {{ imageLogotipo.name }}</div>
																				<div class="d-none">preview: {{ previewLogotipo }}</div>
																			</div>
																			<div class="personal-image">
																				<label class="label">
																					<input type="file" ref="fileInputLogotipo" v-on:change="pickFileLogotipo" />
																					<figure class="personal-figure">
																						<div v-if="previewLogotipo" class="personal-avatar-bg" v-bind:style="{ 'background-image': 'url(' + previewLogotipo + ')' }"></div>
																						<div v-else class="personal-avatar-bg" style="background-image: url('assets/media/icon-profile2.png');">
																							<!-- <img src="assets/media/icon-profile-default.png" class="personal-avatar" alt="avatar"> -->
																						</div>
																						<figcaption class="personal-figcaption">
																							<img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
																						</figcaption>
																					</figure>
																				</label>
																			</div>
																			<div class="text-center"><label class="form-label text-center">Foto do Participante</label></div>
																		</div>
																	</div>
																</div>
																<div class="content-itens" style="margin-top: 10px;">
																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="partc_documento">Documento (CPF) *</label>
																					<input type="text" name="partc_documento" id="partc_documento" class="form-control  cmdBlurDocumento" v-model="fields.partc_documento" value="" />
																					<div class="text-center mt-1 divError" style="line-height: 1; display:none;">
																						<small style="color: red;">CPF já foi cadastro em outro grupo/companhia</small>
																					</div>
																				</div>
																				<div class="form-error" v-if="error.partc_documento.length"><small>{{ error.partc_documento }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-8">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="partc_nome">Nome *</label>
																					<input type="text" name="partc_nome" id="partc_nome" class="form-control" v-model="fields.partc_nome" value="" />
																				</div>
																				<div class="form-error" v-if="error.partc_nome.length"><small>{{ error.partc_nome }}</small></div>
																			</div>
																		</div>
																	</div>

																	<div class="row">
																		<div class="col-12 col-md-4">
																			<!-- ini : imagem de documentos -->

																			<div>
																				<label class="form-label" for="partc_nome_social">Documento Frente *</label>
																				<div class="box-file-upload">
																					<div class="img-preview">
																						<div v-if="previewDocFrente" class="docto-avatar-bg" v-bind:style="{ 'background-image': 'url(' + previewDocFrente + ')' }">
																						</div>
																						<div v-else class="docto-avatar-bg">
																							<!-- <img src="https://avatars1.githubusercontent.com/u/11435231?s=460&v=4" class="personal-avatar" alt="avatar"> -->
																						</div>
																					</div>
																					<div class="txt-click">
																						<label>
																							<!-- clique aqui -->
																							<input type="file" ref="fileInputDocFrente" v-on:change="pickFileDocFrente" style="display: none;" />
																							<div class="d-none" v-if="previewDocFrente">
																								<div>file name: {{ imageDocFrente.name }}</div>
																								<div class="d-none">preview: {{ previewDocFrente }}</div>
																							</div>
																							<figure class="personal-figures">
																								<figcaption class="personal-figcaptions">
																									<img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
																								</figcaption>
																							</figure>
																						</label>

																					</div>
																				</div>
																			</div>

																			<div>
																				<label class="form-label" for="partc_nome_social">Documento Verso *</label>
																				<div class="box-file-upload">
																					<div class="img-preview">
																						<div v-if="previewDocVerso" class="docto-avatar-bg" v-bind:style="{ 'background-image': 'url(' + previewDocVerso + ')' }">
																						</div>
																						<div v-else class="docto-avatar-bg"></div>
																					</div>
																					<div class="txt-click">
																						<label>
																							<!-- clique aqui -->
																							<input type="file" ref="fileInputDocVerso" v-on:change="pickFileDocVerso" style="display: none;" />
																							<div class="d-none" v-if="previewDocVerso">
																								<div>file name: {{ imageDocVerso.name }}</div>
																								<div class="d-none">preview: {{ previewDocVerso }}</div>
																							</div>
																							<figure class="personal-figures">
																								<figcaption class="personal-figcaptions">
																									<img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
																								</figcaption>
																							</figure>
																						</label>

																					</div>
																				</div>
																			</div>

																			<!-- end : imagem de documentos -->
																		</div>
																		<div class="col-12 col-md-8">

																			<div class="row">
																				<div class="col-12 col-md-12">
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="partc_nome_social">Nome Social (não obrigatorio)</label>
																							<input type="text" name="partc_nome_social" id="partc_nome_social" class="form-control" v-model="fields.partc_nome_social" value="" />
																						</div>
																						<div class="form-error" v-if="error.partc_nome_social.length"><small>{{ error.partc_nome_social }}</small></div>
																					</div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-12 col-md-6">
																					<!-- genero -->
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="partc_genero">Gênero *</label>
																							<select class="form-select" name="partc_genero" id="partc_genero" v-model="fields.partc_genero">
																								<option value="" translate="no">- selecione -</option>
																								<?php
																								if( isset($arr_generos) ){
																									foreach ($arr_generos as $key => $val) {
																								?>
																									<option value="<?php echo($val['value']); ?>" translate="no"><?php echo($val['label']); ?></option>
																								<?php
																									}
																								}
																								?>
																							</select>
																						</div>
																						<div class="form-error" v-if="error.partc_nome_social.length"><small>{{ error.partc_nome_social }}</small></div>
																					</div>
																				</div>
																				<div class="col-12 col-md-6">
																					<!-- dte nascimento -->
																					<div class="form-group">
																						<div>
																							<label class="form-label" for="partc_dte_nascto">Data de Nascimento *</label>
																							<div class="position-relative d-flex align-items-center">
																								<input type="text" name="partc_dte_nascto" id="partc_dte_nascto" class="form-control mask-date flatpickr_date" v-model="fields.partc_dte_nascto" value="" style="padding-right: 3rem !important;" />
																								<span class="position-absolute mx-4" style="right: 0;">
																									<img src="assets/svg/icon-calendar.svg" />
																								</span>
																							</div>
																						</div>
																						<div class="form-error" v-if="error.partc_dte_nascto.length"><small>{{ error.partc_dte_nascto }}</small></div>
																					</div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-12 col-md-12">
																					<!-- funcao -->
																					<?php //$_func_id = (int)(isset($rs_dados->func_id) ? $rs_dados->func_id : "");?>
																					<div class="form-group">
																						<label class="form-label" for="func_id">Função *</label>
																						<select class="form-select" name="func_id" id="func_id" v-model="fields.func_id">
																							<option value="" translate="no">- selecione -</option>
																							<option value="" translate="no" v-for="(value, key, index) in lista_funcoes" :value='value.func_id'>{{value.func_titulo}}</option>	
																						</select>
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>
																</div>
																<div class="content-actions" style="margin-top: 15px;">
																	<div class="row justify-content-start">
																		<div class="col-8 col-md-6">
																			<div class="d-grid">
																				<button type="button" class="btn btn-warning" v-on:click="addParticipante()" :disabled='partcBTNDisabled'>Adicionar Novo Participante</button>
																			</div>
																		</div>
																	</div>
																</div>


															</div>
														</div>

														<!-- 
														{ 
															"partc_documento": "", 
															"partc_nome": "Márcio Lima", 
															"partc_nome_social": "", 
															"partc_genero": "", 
															"partc_dte_nascto": "", 
															"func_id": "", 
															"partc_file_doc_frente": "", 
															"partc_file_doc_verso": "", 
															"partc_file_foto": "" 
														} 
														-->

														<!-- {{fields.participantes}} -->
														<textarea type="text" name="lista_participantes" id="lista_participantes" class="form-control d-none" v-model="fields.participantes_json" style="height: 120px;"></textarea>

														<div class="row justify-content-center mt-5" v-show="fields.participantes.length > 0">
															<div class="col-12 col-md-12">
																<div style="padding: 12px; border-radius: 6px; background-color: rgb(221 221 221);">
																	<h3 style="color: #000000;">Participantes Adicionados</h3>
																	<div class="table-box table-responsive">
																		<table id="example2" class="display nowrap table table-striped table-bordered m-0" style="width:100%">
																			<thead>
																				<tr v-for="(value, key, index) in fields.participantes">
																					<td>
																						<div class="personal-image-header">
																							<label class="label">
																								<figure class="personal-figure-header">
																									<div v-if="previewLogotipo">
																										<img :src="value.partc_file_foto_preview" class="personal-avatar-header" alt="avatar">
																									</div>
																									<!-- <img src="assets/media/icon-profile2.png" class="personal-avatar-header" alt="avatar"> -->
																								</figure>
																							</label>
																						</div>																					
																					</td>
																					<td>
																						<div>{{value.partc_nome}}</div>
																						<div><small>cpf:</small> {{value.partc_documento}}</div>
																					</td>
																					<td>
																						<small>idade:</small> 
																						<strong>({{value.partc_idade}} anos)</strong> 
																						<!-- {{value.partc_dte_nascto}} partc_hashkey -->
																					</td>
																					<td>{{value.partc_categoria}}</td>
																					<td><!-- {{value.func_id}} -->{{value.func_titulo}}</td>
																					<td>
																						<a href="javascript:;" style="font-size: 1.25rem; color: red;" v-on:click="removeParticipante(value.partc_hashkey)"><i class="far fa-times-circle"></i></a>
																						&nbsp;
																						<a href="" style="font-size: 1.25rem; color: red;"><i class="fas fa-pencil"></i></a>
																					</td>
																				</tr>
																			</thead>
																		</table>
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
																		<a href="javascript:;" class="btn btn-primary" v-on:click="stepGravarParticipante(3)">Finalizar Cadastro de Participantes</a>
																	</div>

																	Só poderá prosseguir se tiver as seguintes funcoes adicionadas
																	- Diretor
																	- Bailarino
																	- Coreografo

																	Pelo menos 1 de cada
																	caso contrário não poderá finalizar.

																	Mostrar mensagem informativa no Modal para esclarecer
																</div>
															</div>
														</div>

													</div>
												</div>
											</div>

											<!-- Step 3 -->
											<div class="h-100" v-show="step == 31" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-11">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações de Pagamento</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Informe que irão integrar ao grupo.</div> -->
																</div>
																<div class="content-itens">
																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="corgf_titulo">Nome da Coreografia</label>
																					<input type="text" name="corgf_titulo" id="corgf_titulo" class="form-control" v-model="fields.corgf_titulo" value="" />
																				</div>
																				<div class="form-error" v-if="error.corgf_titulo.length"><small>{{ error.corgf_titulo }}</small></div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="corgf_modl_id">Modalidade</label>
																					<select class="form-select" name="corgf_modl_id" id="corgf_modl_id" v-model="fields.corgf_modl_id">
																						<option value="" translate="no">- selecione -</option>
																						<?php
																						if( isset($rs_modalidades)){
																							foreach ($rs_modalidades->getResult() as $row) {
																								$modl_id = ($row->modl_id);
																								$modl_titulo = ($row->modl_titulo);
																								$selected = '';
																							?>
																								<option value="<?php echo($modl_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($modl_titulo); ?></option>
																						<?php
																							}
																						}
																						?>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.corgf_modl_id.length"><small>{{ error.corgf_modl_id }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="corgf_formt_id">Formato</label>
																					<select class="form-select" name="corgf_formt_id" id="corgf_formt_id" v-model="fields.corgf_formt_id">
																						<option value="" translate="no">- selecione -</option>
																						<?php
																						if( isset($rs_formatos)){
																							foreach ($rs_formatos->getResult() as $row) {
																								$formt_id = ($row->formt_id);
																								$formt_titulo = ($row->formt_titulo);
																								$selected = '';
																							?>
																								<option value="<?php echo($formt_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($formt_titulo); ?></option>
																						<?php
																							}
																						}
																						?>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.corgf_formt_id.length"><small>{{ error.corgf_formt_id }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="corgf_categ_id">Categoria</label>
																					<select class="form-select" name="corgf_categ_id" id="corgf_categ_id" v-model="fields.corgf_categ_id" v-on:change="selectCategCoreografia()">
																						<option value="" translate="no">- selecione -</option>
																						<?php
																						if( isset($rs_categorias)){
																							foreach ($rs_categorias->getResult() as $row) {
																								$categ_id = ($row->categ_id);
																								$categ_titulo = ($row->categ_titulo);
																								$selected = '';
																							?>
																								<option value="<?php echo($categ_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($categ_titulo); ?></option>
																						<?php
																							}
																						}
																						?>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.corgf_categ_id.length"><small>{{ error.corgf_categ_id }}</small></div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="corgf_coreografo">Coreógrafo</label>
																					<select class="form-select" name="corgf_coreografo" id="corgf_coreografo" v-model="fields.corgf_coreografo">
																						<option value="" translate="no">- selecione -</option>
																						<option value="" translate="no" v-for="(value, key, index) in coreografos" :value='value.partc_id'>{{value.partc_nome}}</option>
																					</select>
																				</div>
																				<div class="form-error" v-if="error.corgf_coreografo.length"><small>{{ error.corgf_coreografo }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="corgf_musica">Música</label>
																					<input type="text" name="corgf_musica" id="corgf_musica" class="form-control" v-model="fields.corgf_musica" value="" />
																				</div>
																				<div class="form-error" v-if="error.corgf_musica.length"><small>{{ error.corgf_musica }}</small></div>
																			</div>
																		</div>
																		<div class="col-12 col-md-4">
																			<div class="form-group">
																				<div>
																					<label class="form-label" for="corgf_compositor">Compositor</label>
																					<input type="text" name="corgf_compositor" id="corgf_compositor" class="form-control" v-model="fields.corgf_compositor" value="" />
																				</div>
																				<div class="form-error" v-if="error.corgf_compositor.length"><small>{{ error.corgf_compositor }}</small></div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-12 col-md-6">
																			<div class="form-group">
																				<label class="form-label">MP3 da Música</label>
																				<input type="file" name="fileMusicaMP3" id="fileMusicaMP3" class="form-control files">
																			</div>
																		</div>
																		<div class="col-12 col-md-2">
																			<div class="form-group">
																				<label class="form-label" for="EMAIL">Tempo</label>
																				<input type="text" name="tempo_musica" id="tempo_musica" class="form-control input-tempo-musica" value="" readonly="readonly" onfocus="this.blur();" />
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-12 col-md-12">
																			<div class="form-group">
																				<label class="form-label" for="corgf_observacao">Observação</label>
																				<textarea type="text" name="corgf_observacao" id="corgf_observacao" class="form-control" style="height: 100px !important;" v-model="fields.corgf_observacao"></textarea>
																			</div>
																		</div>
																	</div>
																</div>

																<textarea type="text" name="lista_participantes" id="lista_participantes" class="form-control d-none" v-model="fields.participantes_elenco_json" style="height: 60px;"></textarea>

																<div class="row justify-content-center mt-2" v-show="fields.participantes_elenco.length > 0">
																	<div class="col-12 col-md-12">
																		<div style="padding: 12px; border-radius: 6px; background-color: rgb(243 243 243); border: 1px solid gray;">
																			<h3 style="color: #000000;">Selecione o elenco para esta coreografias</h3>
																			<div class="table-box table-responsive">
																				<table id="example2" class="display nowrap table table-striped table-bordered m-0" style="width:100%">
																					<thead>
																						<tr v-for="(value, key, index) in fields.participantes_elenco" :key="index">
																							<td class="text-center" style="width: 48px;">
																								<div><input type="checkbox" :value='value.partc_id' v-model="fields.coreografia_elenco" @change="handleCheckboxChange()"></div>
																							</td>
																							<td class="d-none">
																								<div class="personal-image-header" style="display:none;">
																									<label class="label">
																										<figure class="personal-figure-header">
																											<div v-if="previewLogotipo">
																												<img :src="value.partc_file_foto_preview" class="personal-avatar-header" alt="avatar">
																											</div>
																											<!-- <img src="assets/media/icon-profile2.png" class="personal-avatar-header" alt="avatar"> -->
																										</figure>
																									</label>
																								</div>																					
																							</td>
																							<td>
																								<div>{{index}} {{value.partc_nome}}</div>
																							</td>
																							<td>
																								<div><small>cpf:</small> {{value.partc_documento}}</div>
																							</td>
																							<td class="text-center" style="width: 48px;">
																								<a href="javascript:;" style="font-size: 1.25rem; color: red;" v-on:click="removeParticipante(value.partc_hashkey)"><i class="far fa-times-circle"></i></a>
																								<!-- &nbsp; -->
																								<!-- <a href="" style="font-size: 1.25rem; color: red;"><i class="fas fa-pencil"></i></a> -->
																							</td>
																						</tr>
																					</thead>
																				</table>
																			</div>
																		</div>
																	</div>
																</div>

																<textarea type="text" name="lista_participantes_elenco" id="lista_participantes_elenco" class="form-control d-none" v-model="fields.coreografia_elenco_json" style="height: 60px;"></textarea>
																
																<div class="row justify-content-center mt-2" v-show="fields.coreografia_elenco_all.length > 0">
																	<div class="col-12 col-md-12">
																		<div style="padding: 12px; border-radius: 6px; background-color: rgb(243 243 243); border: 1px solid gray;">
																			<h3 style="color: #000000;">Elenco Selecionado</h3>
																			<div class="table-box table-responsive">
																				<table id="example2" class="display nowrap table table-striped table-bordered m-0" style="width:100%">
																					<thead>
																						<tr v-for="(value, key, index) in fields.coreografia_elenco_all" :key="index">
																							<td>
																								<div>{{index}} {{value.partc_nome}}</div>
																							</td>
																							<td>
																								<div><small>cpf:</small> {{value.partc_documento}}</div>
																							</td>
																						</tr>
																					</thead>
																				</table>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="mt-3">
																	<button type="button" class="btn btn-warning" v-on:click="addNovaCoreografia" :disabled='corgfBTNDisabled'>Adicionar Nova Coreografia</button>
																	<!-- <a href="javascript:;" class="btn btn-warning" v-on:click="addNovaCoreografia()" :disabled='corgfBTNDisabled'>Adicionar Nova Coreografia</a> -->
																</div>

																<div class="content-actions">
																	<div class="row justify-content-between">
																		<div class="col-4 col-md-3">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-secondary" v-on:click="prevStep(2)">Anterior</a>
																			</div>
																		</div>
																		<div class="col-8 col-md-4">
																			<div class="d-grid">
																				<a href="javascript:;" class="btn btn-primary" v-on:click="stepGravarCoreografia(4)">Continuar</a>
																			</div>
																		</div>
																	</div>
																</div>

															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Step 4 -->
											<div class="h-100" v-show="step == 41" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Documentação</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Confira as informações e efetue o pagamento.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row justify-content-between">
																		<div class="col-11 col-md-7">

																			<div class="">
																				Lista de participantes e valores de cada item
																			</div>

																		</div>
																		<div class="col-11 col-md-5">

																			<div class="card mb-3">
																				<div class="card-header">
																					Código de Identificação
																				</div>
																				<div class="card-body">
																					<div>
																						<h3>XTU245STU-2024</h3>
																					</div>
																				</div>
																			</div>

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

											<!-- Step 5 -->
											<div class="h-100" v-show="step == 51" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Contato de Emergência</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Confira as informações e efetue o pagamento.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row justify-content-between">
																		<div class="col-11 col-md-7">

																			<div class="">
																				Lista de participantes e valores de cada item
																			</div>

																		</div>
																		<div class="col-11 col-md-5">

																			<div class="card mb-3">
																				<div class="card-header">
																					Código de Identificação
																				</div>
																				<div class="card-body">
																					<div>
																						<h3>XTU245STU-2024</h3>
																					</div>
																				</div>
																			</div>

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

											<!-- Step 6 -->
											<div class="h-100" v-show="step == 61" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações Adicionais</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Confira as informações e efetue o pagamento.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row justify-content-between">
																		<div class="col-11 col-md-7">

																			<div class="">
																				Lista de participantes e valores de cada item
																			</div>

																		</div>
																		<div class="col-11 col-md-5">

																			<div class="card mb-3">
																				<div class="card-header">
																					Código de Identificação
																				</div>
																				<div class="card-body">
																					<div>
																						<h3>XTU245STU-2024</h3>
																					</div>
																				</div>
																			</div>

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

											<!-- Step 7 -->
											<div class="h-100" v-show="step == 71" >
												<div class="content-step current justify-content-center align-items-center flex-column h-100">
													<div class="container">
														<div class="row justify-content-center">
															<div class="col-11 col-md-12">
																<div>
																	<h2 class="fw-bolder text-dark title-step">Informações de Uniforme</h2>
																	<!-- <div class="text-muted fs-6 text-center text-md-start">Confira as informações e efetue o pagamento.</div> -->
																</div>
																<div class="content-itens">

																	<div class="row justify-content-between">
																		<div class="col-11 col-md-7">

																			<div class="">
																				Lista de participantes e valores de cada item
																			</div>

																		</div>
																		<div class="col-11 col-md-5">

																			<div class="card mb-3">
																				<div class="card-header">
																					Código de Identificação
																				</div>
																				<div class="card-body">
																					<div>
																						<h3>XTU245STU-2024</h3>
																					</div>
																				</div>
																			</div>

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


	$rs_categorias = (isset($rs_categorias) ? $rs_categorias : []);
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

		.box-container-prest-servico{ display: none; }
		.box-container-prest-servico.active{ display: block; }

		.form-control[type=file] {
			overflow: hidden;
			height: calc(1.70em + 0.75rem + 2px) !important;
			border-radius: 10px !important;
			background: #e9ecef !important;
		}
		.item-contrato{
			position: relative;
			background-color: #dddddb;
			padding: 20px 16px; 
			border: 1px solid #dddddb; 
			border-radius: 4px;
			box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);
			color: #000;
		}
		.item-contrato.active{
			background-color: #ffa902;
			border: 1px solid #ffa902;
			color: #FFF;
		}
		.item-contrato.active h3{
		}
		.item-contrato .status{
			position: absolute; 
			top: 3px;
			right: 4px;
			font-size: .6rem;
			color: #FF0000;
		}
		.item-contrato .status i{ font-size: 1rem; }
		.item-contrato.active .status{ color: #FFF; }
		.item-contrato p{
			border-top: 1px dashed #FFF;
			font-size: .8rem;
			text-align: center;
			margin: 0;		
		}




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
			margin-bottom: 0rem;
		}
		.naveg-steps .naveg-steps-item .steps-label .steps-desc{ display: none; color: #b5b5c3; }

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

	<script>
	$(document).ready(function(){
		$.ajaxSetup({cache: false});
		$(document).on('change', '.changeTipoPrestacao', function (e) {
			let $this = $(this);
			let $value = $this.val();
			console.log( $value );
			let $box = $( "#box-container-"+ $value);
			$(".box-container-prest-servico").removeClass('active');
			$box.addClass('active');
		});
	});
	</script>

	<script id="mstcGridDataDiaria" type="text/x-jquery-tmpl">
		<div class="row g-2 {{trRow}}">
			<div class="col-12 col-md-4">
				<div class="form-group">
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="evdte_data[]" id="evdte_data_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
						<span class="position-absolute mx-2" style="right: 0;">
							<img src="assets/svg/icon-calendar.svg" />
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-7">
				<div class="row g-2">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<input type="text" name="evdte_hrs_ini[]" id="evdte_hrs_ini_{{item}}" class="form-control form-control-sm flatpickr_hour" value="" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<input type="text" name="evdte_hrs_end[]" id="evdte_hrs_end_{{item}}" class="form-control form-control-sm flatpickr_hour" value="" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-1 text-center align-self-center">
				<a href="javascript:;" class="cmdRemoverDteDiaria" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
				<input type="hidden" name="evdte_id[]" id="evdte_id_{{item}}" value="0" />
			</div>	
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$.ajaxSetup({cache: false});

		$(document).on('click', '.cmdAddNovaDteDiaria', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow' //BOX-CONTENT-DATA-DIARIA
			};
			let template = $("#mstcGridDataDiaria").html();
			$('#BOX-CONTENT-DATA-DIARIA').append(Mustache.render(template, templateData));

			let $el = $('#BOX-CONTENT-DATA-DIARIA'); 
			$el.find('.flatpickr_date').flatpickr({
				"locale": "pt",
				dateFormat:"d/m/Y",	
			});
			$el.find('.flatpickr_hour').flatpickr({
				"locale": "pt",
				enableTime: true,
				noCalendar: true,
				dateFormat:"H:i"
			});
		});
		$(document).on('click', '.cmdRemoverDteDiaria', function (e) {
			let $this = $(this);
			let $row = $this.closest( ".trRow" );

			Swal.fire({
				title: 'Atenção!',
				icon: 'warning',
				html:
					'Você está prestes a remover este registro. <br />' +
					'Esta ação não poderá ser revertida.',
				type: 'warning',
				showCancelButton: true,
				cancelButtonColor: "#AAAAAA",
				confirmButtonColor: "#E96565",
				//confirmButtonColor: '$danger',
				//cancelButtonColor: '$success',
				confirmButtonText: 'Apagar',
				cancelButtonText: 'Cancelar',
				reverseButtons: true
			}).then(function(result) {
				if (result.value) {
					$row.remove();
					fct_count_item_grid_datas_diaria();
				}
			});
		});

		fct_count_item_grid_datas_diaria();
	});
	var fct_count_item_grid_datas_diaria = function(p, callback){
		let $box = $('#BOX-CONTENT-DATA-DIARIA');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovaDteDiaria" ).trigger( "click" );	
		}
	}
	</script>






	<script id="mstcGridDataMensal" type="text/x-jquery-tmpl">
		<div class="row g-2 {{trRow}}">
			<div class="col-12 col-md-11">
				<div class="row g-2">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<div class="position-relative d-flex align-items-center">
								<input type="text" name="evdte_data[]" id="evdte_data_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
								<span class="position-absolute mx-2" style="right: 0;">
									<img src="assets/svg/icon-calendar.svg" />
								</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<div class="position-relative d-flex align-items-center">
								<input type="text" name="evdte_data[]" id="evdte_data_{{item}}" class="form-control form-control-sm flatpickr_date" value="" style="padding-right: 3rem !important;" />
								<span class="position-absolute mx-2" style="right: 0;">
									<img src="assets/svg/icon-calendar.svg" />
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-1 text-center align-self-center">
				<a href="javascript:;" class="cmdRemoverDteMensal" style="font-size: 1.25rem; color: red;"><i class="las la-times-circle"></i></a>
				<input type="hidden" name="evdte_id[]" id="evdte_id_{{item}}" value="0" />
			</div>	
		</div>
	</script>

	<script>
	$(document).ready(function(){
		$.ajaxSetup({cache: false});

		$(document).on('click', '.cmdAddNovaDteMensal', function (e) {
			let templateData = {
				item: 1,
				trRow: 'trRow'
			};
			let template = $("#mstcGridDataMensal").html();
			$('#BOX-CONTENT-DATA-MENSAL').append(Mustache.render(template, templateData));
			let $el = $('#BOX-CONTENT-DATA-MENSAL'); 
			$el.find('.flatpickr_date').flatpickr({
				"locale": "pt",
				dateFormat:"d/m/Y",	
			});
		});
		$(document).on('click', '.cmdRemoverDteMensal', function (e) {
			let $this = $(this);
			let $row = $this.closest( ".trRow" );

			Swal.fire({
				title: 'Atenção!',
				icon: 'warning',
				html:
					'Você está prestes a remover este registro. <br />' +
					'Esta ação não poderá ser revertida.',
				type: 'warning',
				showCancelButton: true,
				cancelButtonColor: "#AAAAAA",
				confirmButtonColor: "#E96565",
				//confirmButtonColor: '$danger',
				//cancelButtonColor: '$success',
				confirmButtonText: 'Apagar',
				cancelButtonText: 'Cancelar',
				reverseButtons: true
			}).then(function(result) {
				if (result.value) {
					$row.remove();
					fct_count_item_grid_datas_mensal();
				}
			});
		});

		fct_count_item_grid_datas_mensal();
	});
	var fct_count_item_grid_datas_mensal = function(p, callback){
		let $box = $('#BOX-CONTENT-DATA-MENSAL');
		let $qtdItem = $box.find('.trRow');
		if( $qtdItem.length == 0 ){
			$( ".cmdAddNovaDteMensal" ).trigger( "click" );	
		}
	}
	</script>










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
		//let STR_EVENT_HASHKEY = '<?php //echo( $event_hashkey ); ?>';
		//let LIST_FUNCOES = <?php //echo( json_encode($list_rs_funcoes) ); ?>;
		//let LIST_CATEGORIAS = <?php //echo( json_encode($list_rs_categorias) ); ?>;
		//let LIST_FUNC_OBRIGATORIA = <?php //echo( json_encode($list_rs_func_obrig) ); ?>;

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
	<script type="text/javascript" src="assets/vue/recursos-humanos.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>