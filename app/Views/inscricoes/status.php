<?php
$this->extend('templates/template_default');
$this->section('content');

$event_hashkey = (isset($rs_event->event_hashkey) ? $rs_event->event_hashkey : "");
$event_titulo = (isset($rs_event->event_titulo) ? $rs_event->event_titulo : "Status de Doações");

$grevt_id = (isset($rs_event->grp_id) ? $rs_event->grp_id : "");
$grp_hashkey = (isset($rs_event->grp_hashkey) ? $rs_event->grp_hashkey : "");
$evcfg_seletiva = (int)((isset($rs_event_config->evcfg_seletiva) ? $rs_event_config->evcfg_seletiva : "0"));
$evcfg_max_coreogf_grupo = (int)((isset($rs_event_config->evcfg_max_coreogf_grupo) ? $rs_event_config->evcfg_max_coreogf_grupo : "1"));
$evcfg_perm_bailarino_grupos = (int)((isset($rs_event_config->evcfg_perm_bailarino_grupos) ? $rs_event_config->evcfg_perm_bailarino_grupos : "1"));

$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
$evcfg_forma_cobranca_json = json_decode($evcfg_forma_cobranca);

$evcfg_doacao_entrega_forma = ((isset($rs_event_config->evcfg_doacao_entrega_forma) ? $rs_event_config->evcfg_doacao_entrega_forma : ""));
$evcfg_doacao_entrega_dte_ini = ((isset($rs_event_config->evcfg_doacao_entrega_dte_ini) ? $rs_event_config->evcfg_doacao_entrega_dte_ini : ""));
$evcfg_doacao_entrega_dte_fim = ((isset($rs_event_config->evcfg_doacao_entrega_dte_fim) ? $rs_event_config->evcfg_doacao_entrega_dte_fim : ""));

//print_debug( $rs_event_config, "150px" );
//print_debug( $evcfg_forma_cobranca, "150px" );
//var_dump( $evcfg_forma_cobranca_json );
//exit();

$doacoes_geral = (isset($doacoes_geral) ? $doacoes_geral : []);

$evcfg_config_limites = [
	'seletiva' => $evcfg_seletiva,
	'maximo_coreografias' => $evcfg_max_coreogf_grupo,
	'perm_bailarino_grupo' => $evcfg_perm_bailarino_grupos,
	'evcfg_forma_cobranca' => $evcfg_forma_cobranca_json,
];

$evcfg_config_infos = [
	'evcfg_doacao_entrega_forma' => $evcfg_doacao_entrega_forma,
	'evcfg_doacao_entrega_dte_ini' => $evcfg_doacao_entrega_dte_ini,
	'evcfg_doacao_entrega_dte_fim' => $evcfg_doacao_entrega_dte_fim,
	'evcfg_form_cobranca' => $evcfg_forma_cobranca_json,
];

?>
<section class="pt-3 pb-4">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h3>Inscrições > <?php echo ($event_titulo); ?></h3>
			</div>
		</div>
		<div class="row pt-3 pb-5">
			<div class="col-12 col-md-12">

				<FORM action="<?php echo (current_url()); ?>" method="post" name="formFieldsInscricao" id="formFieldsInscricao" ref="formFieldsInscricao" enctype="multipart/form-data">

					<div class="d-none">
						<input type="text" name="event_hashkey" id="event_hashkey" class="form-control" ref="event_hashkey" v-model="fields.event_hashkey" value="<?php echo ((isset($event_hashkey) ? $event_hashkey : "")); ?>" />
						<input type="text" name="grp_id" id="grp_id" class="form-control" ref="grp_id" v-model="fields.grp_id" value="<?php echo ((isset($grevt_id) ? $grevt_id : "")); ?>" />
						<input type="text" name="grp_hashkey" id="grp_hashkey" class="form-control" ref="grp_hashkey" v-model="fields.grp_hashkey" value="<?php echo ((isset($grp_hashkey) ? $grp_hashkey : "")); ?>" />
					</div>

					<div class="row align-items-start">
						<div class="col-12 col-md-12">

							<div class="card card-default">
								<div class="card-header-box" style="display:none !important;">
									<div class="row align-items-center">
										<div class="col-12 col-md-6">

										</div>
										<div class="col-12 col-md-6">

											<div class="d-flex justify-content-end">
												<div style="margin-left: 5px;"><a href="<?php echo (painel_url('grupos')); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
												<div style="margin-left: 5px;"><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
											</div>

										</div>
									</div>
								</div>
								<div class="card-body">

									<div class="row ">
										<div class="col-12 col-md-3">

											<?php
											$w_data['step'] = '5'; // STATUS
											$incMenuLateral = view('inscricoes/menu-lateral', $w_data);
											echo ($incMenuLateral);
											?>

										</div>
										<div class="col-12 col-md-9">

											<?php if (in_array("por_participante", $evcfg_forma_cobranca_json) || in_array("por_coreografia", $evcfg_forma_cobranca_json)) { ?>
												<div class="mb-3">
													<div class="row align-items-start">
														<div class="col-12 col-md-12">
															<div class="mb-3">
																<h2 class="fw-bolder text-dark title-step m-0">Status do Pagamento</h2>
															</div>
														</div>
													</div>
													<div>
														<?php //print_debug($rs_pedido, '180px'); 
														?>
													</div>
													<!-- PAGAMENTOS -->
													<div>
														<?php
														$ped_valor_total = (isset($rs_pedido->ped_valor_total) ? $rs_pedido->ped_valor_total : '');
														$pgto_status = (isset($rs_pedido->pgto_status) ? $rs_pedido->pgto_status : '');
														$pgto_referencia = (isset($rs_pedido->pgto_json) ? $rs_pedido->pgto_referencia : '');
														$pgto_code_checkout = (isset($rs_pedido->pgto_code_checkout) ? $rs_pedido->pgto_code_checkout : '');
														$pgto_init_point = (isset($rs_pedido->pgto_init_point) ? $rs_pedido->pgto_init_point : '');
														$pgto_json = (isset($rs_pedido->pgto_json) ? $rs_pedido->pgto_json : '');
														$jsonPGTO = json_decode($pgto_json);
														//print_debug($jsonPGTO, '180px'); 
														$payment_method_id = (isset($jsonPGTO->payment_method_id) ? $jsonPGTO->payment_method_id : '');
														$date_of_expiration = (isset($jsonPGTO->date_of_expiration) ? $jsonPGTO->date_of_expiration : '');
														$date_approved = (isset($jsonPGTO->date_approved) ? $jsonPGTO->date_approved : '');
														//$ticket_url = (isset($jsonPGTO->ticket_url) ? $jsonPGTO->ticket_url : '');

														$url_checkout = 'https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=' . $pgto_code_checkout;
														$url_checkout = (empty($pgto_init_point) ? $url_checkout : $pgto_init_point);

														$label_exibicao = "data de expiração";
														//$date_exibicao = fct_formatdate($date_of_expiration, 'd.m.Y');
														$dateTime = new DateTime($date_of_expiration);
														$date_exibicao = $dateTime->format("d.m.Y");
														if ($pgto_status == "approved") {
															$label_exibicao = "data de aprovação";
															//$date_exibicao = fct_formatdate($date_approved, 'd.m.Y');
															$dateTime = new DateTime($date_approved);
															$date_exibicao = $dateTime->format("d.m.Y");
														}
														if ($pgto_status == "cancelled") {
															$label_exibicao = "data de cancelamento";
															//$date_exibicao = fct_formatdate($date_of_expiration, 'd.m.Y');
															$dateTime = new DateTime($date_of_expiration);
															$date_exibicao = $dateTime->format("d.m.Y");
														}
														?>
														<div class="row justify-content-center mb-3">
															<div class="col-12 col-md-6">
																<div class="card statusPagamento <?php echo ($pgto_status); ?> mb-3">
																	<div class="card-header status" style="padding: .25rem 1rem;">
																		<div style="font-size: .85rem; font-weight: normal;">Status do pagamento</div>
																		<h3 class="m-0"><?php echo ($pgto_status); ?></h3>
																	</div>
																	<div class="card-header" style="padding: .5rem 1rem;">
																		Código de Identificação
																	</div>
																	<div class="card-body">
																		<div class="pb-2 pt-2">
																			<h3 class="m-0" style="font-weight: bold;"><?php echo ($pgto_referencia); ?></h3>
																		</div>
																	</div>
																	<?php if ($pgto_status != "approved") { ?>
																		<div class="card-footer">
																			<div class="pb-1 text-center" style="font-size: .85rem; font-weight: normal;">
																				Não fez o pagamento ainda?
																			</div>
																			<div class="d-grid">
																				<a href="<?php echo ($url_checkout); ?>" target="_blank" class="btn btn-primary">Efetuar Pagamento</a>
																			</div>
																		</div>
																	<?php } ?>

																</div>
															</div>
															<div class="col-12 col-md-6">

																<div class="row justify-content-center mb-3">
																	<div class="col-12 col-md-10">

																		<div class="card">
																			<div class="card-header">
																				Resumo
																			</div>
																			<div class="card-body">
																				<div>
																					<div style="font-size: .85rem; font-weight: normal;">valor total</div>
																					<h3 style="font-weight: bold;">R$ <?php echo (fct_to_money($ped_valor_total)); ?></h3>
																				</div>
																				<div>
																					<div style="font-size: .85rem; font-weight: normal;">método de pagamento</div>
																					<div style="font-size: 1.1rem; font-weight: bold;"><?php echo ($payment_method_id); ?></div>
																				</div>
																				<div>
																					<div style="font-size: .85rem; font-weight: normal;"><?php echo ($label_exibicao); ?></div>
																					<div style="font-size: .85rem; font-weight: bold;"><?php echo ($date_exibicao); ?></div>
																				</div>
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php } ?>

											<?php if (in_array("doacao", $evcfg_forma_cobranca_json)) { ?>
												<div class="mb-3">
													<div class="row align-items-start">
														<div class="col-12 col-md-12">
															<div class="mb-3">
																<h2 class="fw-bolder text-dark title-step m-0">Status de Inscrição</h2>
															</div>
														</div>
													</div>

													<!-- DOAÇÕES -->
													<div v-show="Object.keys(lista_doacoes_geral).length">
														<div class="row justify-content-center mb-3">
															<div class="col-12 col-md-12">
																<!-- <div style="padding: 12px; border-radius: 6px; background-color: rgb(221 221 221);"> -->

																<div class="table-box table-responsive redound">
																	<button style="background-color:#feb100;" class="p-2 rounded border-0 text-black"><strong>Aguardando Avaliação da Curadoria<strong></button>
																</div>
																<!-- <div class="table-box table-responsive">
																	<table id="example2" class="display nowrap table table-striped table-bordered m-0" style="width:100%">
																		<thead>
																			<tr>
																				<td>
																					<strong>Descrição</strong>
																				</td>
																				<td class="text-center">
																					<strong>Total</strong>
																				</td>
																			</tr>
																		</thead>
																		<tbody>
																			<tr v-for="(valueE, keyE, indexE) in lista_doacoes_geral">
																				<td>
																					<div>{{valueE.evvlr_txt_descr}}</div>
																				</td>
																				<td class="text-center">
																					<div v-show="valueE.evvlr_label == 'doacoes-por-participantes'">{{ (valueE.evvlr_quant) }}</div>
																					<div v-show="valueE.evvlr_label == 'doacoes-por-coreografias'">{{ (valueE.evvlr_quant) }}</div>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>

																<div class="mt-3 card-atencao" v-show="evcfg_config_infos.evcfg_doacao_entrega_forma == 'datas'">
																	<div><h3>Atenção!</h3></div>
																	<div class="pb-2"><strong>Prazo para entrega das doações</strong></div>
																	<div class="d-flex justify-content-start pb-2" style="gap: 20px;">
																		<div>
																			<div>
																				Data Inicial
																			</div>
																			<div>
																				<h3 class="m-0" style="color: #000000; font-size: 1.20rem;">{{evcfg_config_infos.evcfg_doacao_entrega_dte_ini | formatDate}}</h3>
																			</div>
																		</div>
																		<div>
																			<div>
																				Data Final
																			</div>
																			<div>
																				<h3 class="m-0" style="color: #000000; font-size: 1.20rem;">{{evcfg_config_infos.evcfg_doacao_entrega_dte_fim | formatDate}}</h3>
																			</div>
																		</div>
																	</div>
																</div> -->

																<!-- <div class="mt-3 card-atencao" v-show="evcfg_config_infos.evcfg_doacao_entrega_forma == 'credenciamento'">
																	<div><h3>Atenção!</h3></div>
																	<div><strong>As entregas das doações devem ser feitas no momento do credenciamento</strong></div>
																</div>
															</div> -->
															</div>
														</div>
													</div>
												</div>
											<?php } ?>


											<div class="row align-items-start">
												<div class="col-12 col-md-12">
													<div class="alert alert-warning" role="alert">
														O resultado dos grupos e coreografias aprovadas será divulgado até o dia 15 de outubro de 2025 no site oficial do festival (https://dancacarajas.com.br
														) e comunicado aos responsáveis via e-mail e/ou WhatsApp cadastrados no sistema de inscrição.
														<br />
														Além disso, os participantes poderão consultar o status da sua inscrição diretamente no sistema de inscrição, utilizando o login de acesso cadastrado.
													</div>
												</div>
											</div>

											<?php
											#rs_list_autorizacoes
											if (isset($rs_list_autorizacoess)) {
											?>
												<div class="row align-items-start">
													<div class="col-12 col-md-12">
														<div class="mb-3">
															<h2 class="fw-bolder text-dark title-step m-0">Status de Autorizações</h2>
														</div>

														<?php
														$count = 0;
														//foreach ($rs_list_autorizacoes->getResult() as $row) {
														foreach ($rs_list_autorizacoes as $keyAut => $valAut) {
															// Array ( [0] => stdClass Object ( [event_titulo] => Ballerina Dance Academy [grp_titulo] => Grupo 1 Relacionado a Bailarina Dance Academy [partc_nome] => Nome Teste Sem Documento [total_autorizacoes] => 5 [total_autorizacoes_checadas] => 4 ) )
															$grevt_hashkey = $valAut->grevt_hashkey;
															$event_id = $valAut->event_id;
															$event_hashkey = $valAut->event_hashkey;
															$event_titulo = $valAut->event_titulo;
															$grp_titulo = $valAut->grp_titulo;
															$participantes = $valAut->participantes;
															//$partc_nome = $row->partc_nome;
															//$total_autorizacoes = $row->total_autorizacoes;
															//$total_autorizacoes_checadas = $row->total_autorizacoes_checadas;
															//$partc_hashkey = $row->partc_hashkey;
															//$grevt_hashkey = $row->grevt_hashkey;

															//$link_autorizacoes = site_url( 'inscricoes/compliance/'. $grevt_hashkey .'/'. $partc_hashkey);

															$total_autorizacoes = 0;
															$total_autorizacoes_checadas = 0;
															//$link_autorizacoes = site_url( 'inscricoes/compliance/'. $grevt_hashkey);

															$id = "box_" . $grevt_hashkey;
															$idAcc = "acc_" . $grevt_hashkey;
														?>
															<div class="accordion accCoreografias" id="<?php echo ($idAcc); ?>">
																<div class="accordion-items boxFields">
																	<div class="accordion-headers">
																		<div class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo ($id); ?>" aria-expanded="false" aria-controls="<?php echo ($id); ?>">
																			<div class="" style="color: #000000; font-weight: normal;"><?php echo ($grp_titulo); ?></div>
																		</div>
																	</div>
																	<div id="<?php echo ($id); ?>" class="accordion-collapse collapse" data-bs-parent="#<?php echo ($idAcc); ?>">
																		<div class="accordion-body">
																			<table id="example3" class="display nowrap table table-striped table-bordered m-0" style="width: 100%; background-color: white; border-radius: 8px;">
																				<thead>
																					<tr>
																						<td><strong>Participante</strong></td>
																						<td class="text-center" style="width: 120px"><strong>Quant.</strong></td>
																						<td class="text-center" style="width: 120px;"><strong>Checados</strong></td>
																						<td class="text-center" style="width: 120px;"><strong>Ação</strong></td>
																					</tr>
																				</thead>
																				<tbody>
																					<?php
																					foreach ($participantes as $keyPartc => $valPartc) {
																						$partc_hashkey = $valPartc->partc_hashkey;
																						$partc_nome = $valPartc->partc_nome;
																						$partc_file_foto = $valPartc->partc_file_foto;
																						$total_autorizacoes = $valPartc->total_autorizacoes;
																						$total_autorizacoes_checadas = $valPartc->total_autorizacoes_checadas;

																						//$total_autorizacoes = 0;
																						//$total_autorizacoes_checadas = 0;

																						$link_autorizacoes = site_url('inscricoes/compliance/' . $grevt_hashkey . '/' . $partc_hashkey);

																						$checado = false;
																						$css_bg_checado = '';
																						if ($total_autorizacoes_checadas >= $total_autorizacoes) {
																							$css_bg_checado = 'background-color: #d4ffd4;';
																							$checado = true;
																						}
																					?>
																						<tr style="<?php echo ($css_bg_checado); ?>">
																							<td>
																								<div class="d-flex align-items-center" style="gap:10px;">
																									<div class="symbol symbol-45px bg-img" style="width: 45px;height: 45px; border-radius: 50%; background-size: cover; background-position: center center;background-image:url(<?php echo (site_url('uploads/cadastros/' . $partc_file_foto)); ?>);">
																										<!-- <img src="assets/media/avatar-11.jpg" alt="" style="border-radius: 50%;"> -->
																									</div>
																									<div>
																										<?php echo ($partc_nome); ?>
																									</div>
																								</div>
																							</td>
																							<td class="text-center"><?php echo ($total_autorizacoes); ?></td>
																							<td class="text-center"><?php echo ($total_autorizacoes_checadas); ?></td>
																							<td class="text-center">
																								<?php if (!$checado) { ?>
																									<div class="d-flex justify-content-center" style="gap: 0 10px;">
																										<div>
																											<a href="<?php echo ($link_autorizacoes); ?>" target="_blank" class="btn btn-sm btn-ac btn-warning cmdReloadStatus disabled-link"><i class="las la-check-double"></i></a>
																										</div>
																										<div>
																											<a href="javascript:;" data-partchashkey="<?php echo ($partc_hashkey); ?>" data-grevthashkey="<?php echo ($grevt_hashkey); ?>" class="btn btn-sm btn-ac btn-dark cmdSendMail disabled-link"><i class="fas fa-envelope"></i></a>
																										</div>
																									</div>
																								<?php } ?>
																							</td>
																						</tr>
																					<?php
																					}
																					?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</div>
														<?php
														} // foreach
														?>
													</div>
												</div>
											<?php
											}
											?>

											<!-- Botão Fechar -->
											<div class="row align-items-start mt-4">
												<div class="col-12 col-md-12">
													<div class="d-flex justify-content-center">
													<a href="<?php echo site_url('inscricoes/grupos/' . $grevt_id); ?>" class="btn btn-secondary btn-lg">
															<i class="fas fa-times"></i> Fechar
														</a>
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
	.card.statusPagamento {}

	.card.statusPagamento.pending {
		border-color: #feb100;
	}

	.card.statusPagamento.pending .card-header.status {
		background-color: #feb100;
		color: white;
	}

	.card.statusPagamento.cancelled {
		border-color: #f13f3f;
	}

	.card.statusPagamento.cancelled .card-header.status {
		background-color: #f13f3f;
		color: white;
	}

	.card.statusPagamento.approved {
		border-color: #00b37f;
	}

	.card.statusPagamento.approved .card-header.status {
		background-color: #00b37f;
		color: white;
	}

	.card-atencao {
		background-color: white;
		padding: 12px;
		border-radius: 4px;
	}

	.card-atencao h3 {
		font-size: 1.5rem;
		color: #feb100;
		line-height: 1;
	}

	.accordion-body {
		padding: .25rem 0rem;
	}

	.accordion-button {
		font-size: .90rem;
		padding: .5rem 1rem;
		border-radius: 4px;
		background-color: #e1e1e1;
	}

	.table {
		width: 100%;
		background-color: white;
		border-radius: 8px;
	}

	.table td {
		border-color: #dee2e6 !important;
		/* border-width: 1px !important; */
		vertical-align: middle;
		min-height: 32px;
	}

	.box-file-upload {
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

	.box-file-upload figure {
		cursor: pointer;
		margin: 0 !important;
		text-align: center;
	}

	.box-file-upload figure img {
		cursor: pointer;
		margin: 0 auto !important;
		width: 60% !important;
	}

	.box-file-upload .img-preview {
		/*padding: 0.5rem 1.0rem !important;*/
		width: 60%;
		height: calc(4.3em + 1.5rem + 2px) !important;
		background: #FAFAFA !important;
		border-top-left-radius: 30px;
		border-bottom-left-radius: 30px;
		/*border: 1.5px solid #e79c32 !important;*/
	}

	.box-file-upload .txt-click {
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

	.form-control-validate {
		font-size: 3rem;
		text-align: center;
		font-weight: bold;
	}

	.form-control-validate.error {
		border: 1px solid #f1416c;
	}

	.form-error {
		margin-top: 2px;
		background-color: #ffd8d8;
		padding: 2px 16px;
		font-size: .8rem;
		color: red;
		border-radius: 30px;
	}

	.text-error-validacao {
		color: #f1416c;
		margin-right: 16px;
	}


	.content-wrapper {
		min-height: 100vh;
		/*border: 1px dotted red;*/
	}

	.box-content-left {
		z-index: 1;
		position: fixed;
		width: 500px !important;
		background-color: rgba(245, 248, 250, .5) !important;
		box-shadow: 0 .1rem 1rem .25rem rgba(0, 0, 0, .05) !important;
		min-height: 100vh;
	}

	.box-content-right {
		width: calc(100% - 500px) !important;
		/*background-color: #f3f3f3;*/
		margin-left: 500px;
	}

	.naveg-logotipo {
		display: flex;
		/*justify-content: center;*/
		margin: 60px 0 30px 0;
	}

	.naveg-logotipo img {
		width: 200px !important;
	}

	.naveg-steps {
		display: flex;
		/* justify-content: center; */
		flex-direction: column;
		/* align-items: center; */
		margin: 0 auto;
	}

	.naveg-steps .naveg-steps-item {
		display: flex;
		margin: 30px 0;
		line-height: 1;
	}

	.naveg-steps .naveg-steps-item .steps-icon {
		transition: color .2s ease, background-color .2s ease;
		background-color: #04c8c8;
		background-color: #1fb7f0;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: color .2s ease, background-color .2s ease;
		width: 40px;
		height: 40px;
		border-radius: .475rem;
		background-color: #dcfdfd;
		background-color: rgb(31 183 240 / 20%);
		background-color: #e79c32;
		margin-right: 1.5rem;
	}

	.naveg-steps .naveg-steps-item.current .steps-icon {
		background-color: #04c8c8;
		background-color: #1fb7f0;
		background-color: #00b37f;
	}

	.naveg-steps .naveg-steps-item.current .steps-icon .stepper-check {
		color: #FFF;
	}

	.naveg-steps .naveg-steps-item .steps-icon .steps-checked {}

	.naveg-steps .naveg-steps-item .steps-icon .steps-number {
		font-size: 1.35rem;
		font-weight: 600;
		color: #04c8c8 !important;
		color: #FFFFFF !important;
	}

	.naveg-steps .naveg-steps-item.current .steps-icon .steps-number {
		color: #FFFFFF !important;
	}

	.naveg-steps .naveg-steps-item .steps-label {
		display: flex;
		flex-direction: column;
		justify-content: center;
	}

	.naveg-steps .naveg-steps-item .steps-label .steps-title {
		color: #3f4254;
		font-weight: 600;
		font-size: 1.25rem;
		margin-bottom: .3rem;
	}

	.naveg-steps .naveg-steps-item .steps-label .steps-desc {
		color: #b5b5c3;
	}

	.content-step {
		display: none;
	}

	.content-step.current {
		display: flex !important;
	}

	.content-itens {
		margin-top: 60px;
	}

	.content-itens .content-item-box {
		border-radius: 0.475rem;
		min-height: 130px;
		border-width: 1px;
		border-style: dashed;
		color: #04c8c8;
		border-color: #b5b5c3;
		background-color: rgb(255, 255, 255, 0) !important;
		padding: 1.75rem;
		cursor: pointer;
	}

	.content-itens .content-item-box.active {
		border-radius: 0.475rem;
		min-height: 130px;
		border-width: 1px;
		border-style: dashed;
		color: #04c8c8;
		border-color: #1fb7f0;
		background-color: rgb(31 183 240 / 10%) !important;
		padding: 1.75rem;
	}

	.content-actions {
		margin-top: 60px;
	}

	.svg-icon.svg-icon-3x svg {
		height: 3rem !important;
		width: 3rem !important;
	}


	.input-tempo-musica {
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

	.input-tempo-musica.error {
		background-color: #ff0000 !important;
		border-color: #ff0000 !important;
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

	.personal-figcaption>img {
		margin-top: 32.5px;
		width: 50px;
		height: 50px;
	}

	@media only screen and (max-width: 991px) {
		main {
			padding: 0 !important;
		}

		.naveg-steps .naveg-steps-numbers {
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

		.title-step {
			font-size: 1.5rem !important;
			text-align: center !important;
		}

		.box-content-left {
			position: relative !important;
			width: 100% !important;
			height: 100% !important;
			min-height: 10vh !important;
			margin-bottom: 30px !important;
		}

		.box-content-right {
			width: calc(100% - 0px) !important;
			margin-left: 0px !important;
		}

		.form-control-validate {
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

	.personal-figcaption-header>img {
		margin-top: 32.5px;
		width: 50px;
		height: 50px;
	}
</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

<style>
	.itemDots {
		position: relative;
	}

	.itemDots:not(:last-child):after {
		content: "\2022";
		margin-left: 12px;
		color: #FFFFFF;
	}
</style>

<!-- VueJs -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Sweet Alert -->
<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

<script>
	let RS_EVCFG_CONFIG_INFOS = <?php echo (json_encode($evcfg_config_infos)); ?>;

	let STR_EVENT_HASHKEY = '<?php echo ($event_hashkey); ?>';
	let LIST_DOACOES_GERAL = <?php echo (json_encode($doacoes_geral)); ?>;
</script>

<script>
	$(document).ready(function() {});
</script>

<script type="text/javascript" src="assets/vue/utils.js?t=<?= $time ?>"></script>
<script type="text/javascript" src="assets/vue/inscricoes-status.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>