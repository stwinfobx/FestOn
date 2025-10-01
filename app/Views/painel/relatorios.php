<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 

	$arr_traducoes = [
		'bank_transfer' => 'Transferência Bancária',
		'ticket' => 'Boleto Bancário',
		'credit_card' => 'Cartão de Crédito',
		'debit_card' => 'Cartão de Débito',
		'approved' => 'Aprovado',
		'pending' => 'Pendente',
		'rejected' => 'Rejeitado',
		'cancelled' => 'Cancelado',
		'pix' => 'Pix',
		'accredited' => 'Pagamento Realizado',
		'pending_waiting_transfer' => 'Aguardando Transferência',
		'mercado-pago' => 'Mercado Pago',
	];

	$ped_status = (int)(isset($rs_pedido->ped_status) ? $rs_pedido->ped_status : "");
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col">
				<h2 class="page-title">Relatórios</h2>
			</div>
			<div class="col-auto">
				<?php 
					$w_data['etapa'] = 'relatorios';
					$inputFile = view('painel/widgets/etapas-cadastro', $w_data);
					echo( $inputFile );
				?>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				
				<div id="CONTEUDO-PRA-IMPRESSAO">
					<div class="row align-items-start">
						<div class="col-12 col-md-12">

							<div class="mb-3">
								<?php
								$link_param_excel = painel_url('relatorios/excel');
								$_grp_hashkey = (isset($rs_params->grp) ? $rs_params->grp : "");
								if( !empty($_grp_hashkey) > 0 ){ $link_param_excel .=  '/params/grp:'. $_grp_hashkey; }
								?>
								<a href="<?php echo( $link_param_excel ); ?>" class="btn btn-warning">GERAR EXCEL</a>
							</div>

							<div class="card card-default mb-3">
								<div class="card-body p-0">

									<div class="row align-items-center">
										<div class="col-12 col-md-4">
											<!-- LOGO DO EVENTO -->
										</div>
										<div class="col-12 col-md-4">
											<h2 class="m-0">FICA DE INSCRIÇÃO</h2>
										</div>
										<div class="col-12 col-md-4">
											<!-- LOGO DA PLATAFORMA -->
										</div>
									</div>

								</div>
							</div>

							<div class="card card-default mb-3">
								<div class="card-body p-0">

									<?php
										$total_participantes = (isset($total_participantes) ? str_pad($total_participantes , 3 , '0' , STR_PAD_LEFT) : '');
										$total_coreografias = (isset($total_coreografias) ? str_pad($total_coreografias , 3 , '0' , STR_PAD_LEFT) : '');
										$status_inscricao = ''; // Confirmado
										$status_pagamento = ''; // Aprovado
									?>
									<h4 class="text-center mb-3">Indicacores</h4>
									<div class="row">
										<div class="col-12 col-md-2">
											<div class="card card-indic align-items-center h-100">
												<h4>Total de Participantes</h4>
												<h3><?php echo($total_participantes); ?></h3>
											</div>
										</div>
										<div class="col-12 col-md-2">
											<div class="card card-indic align-items-center h-100">
												<h4>Total de Coreografias</h4>
												<h3><?php echo($total_coreografias); ?></h3>
											</div>
										</div>
										<div class="col-12 col-md-4">
											<div class="card card-indic align-items-center h-100">
												<h4>Gênero</h4>
												<div class="d-flex card-indic-gen justify-content-around w-100">
													<div class="itemGen">
														<div class="txt">Masculino</div>
														<h3>00</h3>
													</div>
													<div class="itemGen">
														<div class="txt">Feminino</div>
														<h3>00</h3>
													</div>
													<div class="itemGen">
														<div class="txt">Trans</div>
														<h3>00</h3>
													</div>
													<div class="itemGen">
														<div class="txt">Prefiro não informar</div>
														<h3>00</h3>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12 col-md-2">
											<div class="card card-indic align-items-center h-100">
												<h4>Status de Inscrição</h4>
												<h3><?php echo($status_inscricao); ?></h3>
											</div>
										</div>
										<div class="col-12 col-md-2">
											<div class="card card-indic align-items-center h-100">
												<h4>Status de Pagamento</h4>
												<h3><?php echo($status_pagamento); ?></h3>
											</div>
										</div>
									</div>

								</div>
							</div>

							<div class="card card-default mb-3">
								<div class="card-body p-0">

									<?php
									//print_debug( $rs_event );

									$grp_titulo = (isset($rs_event->grp_titulo) ? $rs_event->grp_titulo : "");
									$grp_responsavel = (isset($rs_event->grp_responsavel) ? $rs_event->grp_responsavel : "");
									$grp_telefone = (isset($rs_event->grp_telefone) ? $rs_event->grp_telefone : "");
									$grp_celular = (isset($rs_event->grp_celular) ? $rs_event->grp_celular : "");
									$grp_cpf = (isset($rs_event->grp_cpf) ? $rs_event->grp_cpf : "");

									$grp_end_cep = (isset($rs_event->grp_end_cep) ? $rs_event->grp_end_cep : "");
									$grp_end_logradouro = (isset($rs_event->grp_end_logradouro) ? $rs_event->grp_end_logradouro : "");
									$grp_end_numero = (isset($rs_event->grp_end_numero) ? $rs_event->grp_end_numero : "");
									$grp_end_compl = (isset($rs_event->grp_end_compl) ? $rs_event->grp_end_compl : "");
									$grp_end_cidade = (isset($rs_event->grp_end_cidade) ? $rs_event->grp_end_cidade : "");
									$grp_end_estado = (isset($rs_event->grp_end_estado) ? $rs_event->grp_end_estado : "");

									$end_completo = $grp_end_logradouro;
									$end_completo .= ( !empty($grp_end_numero) ? ", ". $grp_end_numero : "" ) . ( !empty($grp_end_compl) ? " ". $grp_end_compl : "" );

									$end_cidade_uf = $grp_end_cidade;
									$end_cidade_uf .= ( !empty($grp_end_estado) ? "/". $grp_end_estado : "" );


									/*
									[grp_titulo] => Guardião Dance
									[grp_responsavel] => Márcio Lima
									[grp_telefone] => (11) 9481-9736
									[grp_celular] => (11) 9489-19736
									[grp_whatsapp] => 
									[grp_cpf] => 123.123.123-87
									[grp_end_cep] => 05886-410
									[grp_end_logradouro] => Rua Gingadinho
									[grp_end_numero] => 36
									[grp_end_compl] => 
									[grp_end_bairro] => Conjunto Habitacional Jardim São Bento
									[grp_end_cidade] => São Paulo
									[grp_end_estado] => SP
									*/
									?>

									<h4 class="text-center mb-3">Informações do Grupo</h4>
									<div class="row align-items-center">
										<div class="col-12 col-md-12">
											<ul class="list-grupo-info">
												<li>
													<div class="label">Nome do Grupo:</div>
													<div class="value"><?php echo($grp_titulo); ?></div>
												</li>
												<li>
													<div class="label">Registro Ativo:</div>
													<div class="value">Sim</div>
												</li>
												<li>
													<div class="label">Responsável:</div>
													<div class="value"><?php echo($grp_responsavel); ?></div>
												</li>
												<li>
													<div class="label">CPF do Responsável:</div>
													<div class="value"><?php echo($grp_cpf); ?></div>
												</li>
												<li>
													<div class="label">Telefone:</div>
													<div class="value"><?php echo($grp_telefone); ?></div>
												</li>
												<li>
													<div class="label">Celular:</div>
													<div class="value"><?php echo($grp_celular); ?></div>
												</li>
												<li>
													<div class="label">E-mail:</div>
													<div class="value">exemplo@dominio.com</div>
												</li>
												<li>
													<div class="label">Instagram:</div>
													<div class="value">@terceirogrupo</div>
												</li>
												<li>
													<div class="label">YouTube:</div>
													<div class="value">/terceirogrupo</div>
												</li>
												<li>
													<div class="label">Facebook:</div>
													<div class="value">/terceirogrupo</div>
												</li>
												<li>
													<div class="label">Vimeo:</div>
													<div class="value">/terceirogrupo</div>
												</li>
												<li>
													<div class="label">CEP:</div>
													<div class="value"><?php echo($grp_end_cep); ?></div>
												</li>
												<li>
													<div class="label">Endereço:</div>
													<div class="value"><?php echo($end_completo); ?></div>
												</li>
												<li>
													<div class="label">Cidade/Estado:</div>
													<div class="value"><?php echo($end_cidade_uf); ?></div>
												</li>
											</ul>
										</div>
									</div>

								</div>
							</div>



							<?php
							if( isset($rs_participantes_all) ){
							?>
							<div class="card card-default mb-3">
								<div class="card-body p-0">
									<?php
										//print_debug( $rs_participantes_all );
									?>
									<h4 class="text-center mb-3">Participantes</h4>
									<div class="row align-items-center">
										<div class="col-12 col-md-12">
											<div>
												<table id="example3" class="display nowrap table table-striped table-bordered table-participantes m-0 mb-4" style="width: 100%; background-color: white; border-radius: 8px;">
													<thead>
														<tr>
															<td>Nome Completo</td>
															<td>Nome Social</td>
															<td>CPF</td>
															<td>Gênero</td>
															<td>Dte Nascto</td>
															<td>Categoria</td>
															<td>Função</td>
															<td>Telefone</td>
															<td>Instagram</td>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach ($rs_participantes_all as $row) {
																$partc_id = ($row->partc_id);
																$partc_nome = ($row->partc_nome);
																$partc_documento = ($row->partc_documento);
																$func_titulo = ($row->func_titulo);
														?>
														<tr>
															<td><?php echo($partc_id); ?> <?php echo($partc_nome); ?></td>
															<td>Márcio Lima</td>
															<td><?php echo($partc_documento); ?></td>
															<td>Masculino</td>
															<td>28/05/2024</td>
															<td>Adulto</td>
															<td><?php echo($func_titulo); ?></td>
															<td>(11) 98765-1234 </td>
															<td>@marcio_lima</td>
														</tr>
														<?php
															}
														?>
													</tbody>
												</table>
											</div>

											<table id="example3" class="d-none nowrap table table-striped table-bordered m-0" style="width: 100%; background-color: white; border-radius: 8px;">
												<tbody>
													<tr>
														<td>
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>nome</span>
																	Márcio José de Lima
																</div>
																<div class="item">
																	<span>nome social</span>
																	Márcio Lima
																</div>
															</div>
														</td>
														<td style="width: 225px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>documento (cpf)</span>
																	123.123.123-87
																</div>
																<div class="item">
																	<span>gênero</span>
																	Masculino
																</div>
															</div>
														</td>
														<td>
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>data nascimento</span>
																	28/05/2024
																</div>
																<div class="item">
																	<span>categoria</span>
																	Adulto
																</div>
															</div>
														</td>
														<td style="width: 200px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>função</span>
																	Diretor
																</div>
																<div class="item">
																	<span>Telefone</span>
																	(11) 98765-1234 
																</div>
															</div>
														</td>
														<td style="width: 200px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>instagram</span>
																	/marcio_lima
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>nome</span>
																	Márcio José de Lima
																</div>
																<div class="item">
																	<span>nome social</span>
																	Márcio Lima
																</div>
															</div>
														</td>
														<td style="width: 225px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>documento (cpf)</span>
																	123.123.123-87
																</div>
																<div class="item">
																	<span>gênero</span>
																	Masculino
																</div>
															</div>
														</td>
														<td>
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>data nascimento</span>
																	28/05/2024
																</div>
																<div class="item">
																	<span>categoria</span>
																	Adulto
																</div>
															</div>
														</td>
														<td style="width: 200px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>função</span>
																	Diretor
																</div>
																<div class="item">
																	<span>Telefone</span>
																	(11) 98765-1234 
																</div>
															</div>
														</td>
														<td style="width: 200px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>instagram</span>
																	/marcio_lima
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>nome</span>
																	Márcio José de Lima
																</div>
																<div class="item">
																	<span>nome social</span>
																	Márcio Lima
																</div>
															</div>
														</td>
														<td style="width: 225px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>documento (cpf)</span>
																	123.123.123-87
																</div>
																<div class="item">
																	<span>gênero</span>
																	Masculino
																</div>
															</div>
														</td>
														<td>
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>data nascimento</span>
																	28/05/2024
																</div>
																<div class="item">
																	<span>categoria</span>
																	Adulto
																</div>
															</div>
														</td>
														<td style="width: 200px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>função</span>
																	Diretor
																</div>
																<div class="item">
																	<span>Telefone</span>
																	(11) 98765-1234 
																</div>
															</div>
														</td>
														<td style="width: 200px;">
															<div class="d-flex flex-column list-partc">
																<div class="item">
																	<span>instagram</span>
																	/marcio_lima
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>

										</div>
									</div>

								</div>
							</div>
							<?php
							} // end if isset : rs_participantes_all
							?>

							<?php
							if( isset($rs_coreografias_all) ){
							?>
							<div class="card card-default mb-3">
								<div class="card-body p-0">

									<?php
										//print_debug( $rs_coreografias_all );
									?>

									<h4 class="text-center mb-3">Coreografias</h4>
									<div class="row align-items-center">
										<div class="col-12 col-md-12">
											<!--
											Nome da Coreografia	
											Modalidade	
											Formato	
											Categoria	
											Música	
											Compositor	
											Tempo	
											Link da Coreografia (YouTube)	
											Observação	
											E-mail do Coreógrafo
											-->

											<div>
												<table id="example3" class="display nowrap table table-striped table-bordered table-participantes m-0 mb-4" style="width: 100%; background-color: white; border-radius: 8px;">
													<thead>
														<tr>
															<td>Nome da Coreografia</td>
															<td>Modalidade</td>
															<td>Formato</td>
															<td>Categoria</td>
															<td>Música</td>
															<td>Compositor</td>
															<td>Tempo</td>
															<td>Link Youtube</td>
															<td>Observação</td>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach ($rs_coreografias_all as $row) {
																$corgf_titulo = ($row->corgf_titulo);
																$corgf_musica = ($row->corgf_musica);
																$corgf_compositor = ($row->corgf_compositor);
																$corgf_tempo = ($row->corgf_tempo);
																$corgf_linkvideo = ($row->corgf_linkvideo);
																$modl_titulo = ($row->modl_titulo);
																$formt_titulo = ($row->formt_titulo);
																$categ_titulo = ($row->categ_titulo);

																/*
																[corgf_urlpage] => coreografia-2-alterado
																[corgf_titulo] => Coreografia 2 - alterado
																[corgf_coreografo] => 10
																[corgf_musica_file] => 
																[corgf_musica] => Música
																[corgf_compositor] => Compositor
																[corgf_tempo] => 0
																[corgf_observacao] => Coreografia Observação
																[corgf_linkvideo] => Coreografia 

																->select('MODL.modl_titulo')
																->select('FORMT.formt_titulo')
																->select('CATEG.categ_titulo')
																*/
														?>
														<tr>
															<td><?php echo($corgf_titulo); ?></td>
															<td><?php echo($modl_titulo); ?></td>
															<td><?php echo($formt_titulo); ?></td>
															<td><?php echo($categ_titulo); ?></td>
															<td><?php echo($corgf_musica); ?></td>
															<td><?php echo($corgf_compositor); ?></td>
															<td><?php echo($corgf_tempo); ?></td>
															<td>(11) 98765-1234 </td>
															<td><?php echo($corgf_linkvideo); ?></td>
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
							</div>
							<?php
							} // end if isset : rs_coreografias_all
							?>

						</div>
					</div>
				</div>














				<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsRegistro" id="formFieldsRegistro" enctype="multipart/form-data">

				
				<?php
				if( isset($lista_de_coreografias) ){
				?>
				<div class="row align-items-start">
					<div class="col-12 col-md-12">
						<?php
						$total_geral = 0;
						foreach ($lista_de_coreografias['coreografias'] as $keyCor => $valCor ) {
							//print $valCor['corgf_id'];

							$elenco = $valCor['elenco'];
						?>
							<div class="mb-3" style="padding: 12px; border-radius: 6px; background-color: rgb(221, 221, 221);">
								<div class="pb-3">
									<div>
										<h3 class="m-0 p-0"><?php echo($valCor['corgf_titulo']); ?></h3>
									</div>
									<div class="d-flex" style="gap: 10px; font-size: 0.75rem;">
										<div class="itemDots"><?php echo($valCor['modl_titulo']); ?></div> 
										<div class="itemDots"><?php echo($valCor['formt_titulo']); ?></div> 
										<div class="itemDots"><?php echo($valCor['categ_titulo']); ?></div>
									</div>
								</div>

								<div>
									<table id="example3" class="display nowrap table table-striped table-bordered m-0" style="width: 100%; background-color: white; border-radius: 8px;">
										<thead>
											<tr>
												<td>
													<strong>Nome</strong>
												</td>
												<td><strong>Função</strong></td> 
												<td><strong>CPF</strong></td>
												<td class="text-end"><strong>Valor Unit.</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach ($elenco as $keyPartc => $valPartc ) {
												//[partc_id] => 10
												//[partc_hashkey] => VzNZwgeK87knCD9lAXpberPYqisTwJQN
												//[partc_nome] => Diretor 4 - alterar
												//[partc_documento] => 328.877.510-77
												//[func_id] => 3
												//[func_titulo] => Coreógrafo
												//[valor] => 12.00
												//[desconto] => 0.00
											?>
											<tr>
												<td><div><?php echo($valPartc['partc_nome']); ?></div></td> 
												<td><div><?php echo($valPartc['func_titulo']); ?></div></td> 
												<td><div><?php echo($valPartc['partc_documento']); ?></div></td>
												<td class="text-end"><div><?php echo($valPartc['valor']); ?></div></td>
											</tr>
											<?php
											} // end foreach
											?>
										</tbody>
									</table>
									<?php
										$valores_totais_por_participantes = (isset($valCor['valores_totais_por_participantes']) ? $valCor['valores_totais_por_participantes'] : '');
										$valor_por_coreografia = (isset($valCor['valor']) ? $valCor['valor'] : '');
										$valor_total_coreografia = (isset($valCor['valor_total_coreografia']) ? $valCor['valor_total_coreografia'] : '');

										$total_geral = $total_geral + $valor_total_coreografia;
									?>
									<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
										<div style="width: 300px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;">Valor total por participantes</h3>
										</div>
										<div style="width: 160px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;"><?php echo(fct_to_money($valores_totais_por_participantes)); ?></h3>
										</div>
									</div>

									<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
										<div style="width: 300px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;">Valor por coreografia</h3>
										</div>
										<div style="width: 160px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.05rem;"><?php echo(fct_to_money($valor_por_coreografia)); ?></h3>
										</div>
									</div>

									<div class="d-flex justify-content-end pt-2" style="gap: 5px; border-bottom: 1px dotted white;">
										<div style="width: 300px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.5rem;">SubTotal</h3>
										</div>
										<div style="width: 160px;">
											<h3 class="text-end" style="color: rgb(0, 0, 0); font-size: 1.5rem;"><?php echo(fct_to_money($valor_total_coreografia)); ?></h3>
										</div>
									</div>

								</div>
							</div>
						<?php
						}
						?>
						<div class="d-flex justify-content-end">
							<div>
								<label style="font-size: 0.9rem;">Total Geral</label> 
								<h3 style="color: rgb(0, 0, 0); font-size: 1.75rem;"><?php echo(fct_to_money($total_geral)); ?></h3>
							</div>
						</div>
					</div>
				</div>
				<?php
				} // end if isset : lista_de_coreografias
				?>

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
		a.disabled-link {
			pointer-events: none;
			color: gray !important;
			text-decoration: none;
			opacity: .75;
			background-color: #CCC;
			color: gray !important;
			border: none !important;
		}
		.tagStatus{
			font-size: .75rem;
			color: black;
			border-radius: 4px;
			padding: 0px 8px;
			line-height: 16px;
			/*margin-bottom: 2px;*/
			background-color: #c3c3c3;
		}
		.tagStatus.approved{ background-color: #91ee91; }
		/*.tagStatus.accredited{*/
		/*	background-color: #c3c3c3;*/
		/*	color: white;*/
		/*}*/
		.tagStatus.pending{ background-color: #ffadad; }


		pre{ max-height: 250px !important;} 
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

	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/jquery.dataTables.css" rel="stylesheet">
	<link href="assets/plugins/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.min.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- Styles -->
	<link href="assets/plugins/jquery-filer/css/jquery-filer.css" rel="stylesheet">
	<link href="assets/plugins/jquery-filer/css/themes/jquery-filer-dragdropbox-theme.css" rel="stylesheet">
	
	<style>
		.card.card-indic{
			padding: 32px 16px;
			border: 0;
			background-color: #eee;
			text-align: center;		
		}
		.card.card-indic h4{ 
			margin: 0;
			margin-bottom: 10px;
			font-size: 1.2rem;
			font-weight: normal;		
		}
		.card.card-indic h3{ margin: 0; font-size: 1.5rem; }


		.card-indic-gen{ }
		.card-indic-gen .itemGen{ 
			width: 25%; 
			border: 1px dotted #FFFFFF; 
			border-radius: 4px; 
			margin-right: 4px; 
			padding: 12px 2px; 
		}
		.card-indic-gen .itemGen:last-child{ margin-right: 0px; }
		.card-indic-gen .itemGen .txt{ line-height: 1.1; }
		.card-indic-gen .itemGen h3{ margin-top: 4px; }



		.list-grupo-info{}
		.list-grupo-info li{ display: flex; }
		.list-grupo-info li .label{ font-size: 1rem; font-weight: 600; }
		.list-grupo-info li .value{ padding-left:10px; font-size: 1rem; font-weight: lighter; }

		.list-partc{}
		.list-partc .item{ margin-bottom: 4px; }
		.list-partc .item span{ display: block; font-size: .6rem; color: gray; }

		.table-participantes td{ font-size: .75rem; }
		.table-participantes thead tr { background-color: #e8e8e8; }
		.table-participantes thead tr td{ font-weight: bold; }
	</style>

	<script src="assets/plugins/jquery-filer/js/jquery-filer.js" type="text/javascript"></script>
	<script src="assets/js/jquery-filer-custom.js" type="text/javascript"></script>

	<script>
		//let LIST_PRODUTOS = [];
		//let LIST_STATUS = [];
		//let CLIENTE_ID = '<?php echo( $cliente_id ); ?>';
		function converterParaMinutosESegundosOLD(segundos) {
			var minutos = Math.floor(segundos / 60);
			var segundosRestantes = segundos % 60;
			return minutos + "min e " + segundosRestantes + "seg";
		}
		function converterParaMinutosESegundos(segundos) {
			var minutos = Math.floor(segundos / 60);
			var segundosRestantes = segundos % 60;
			return minutos +":"+ segundosRestantes;
		}
		var tempoTotal = 0;
		//$("#fileInputSelector").change(function() {
		//	var quantidadeDeArquivos = this.files.length;
		//	for (var i = 0; i < quantidadeDeArquivos; i++) {
		//		var esteArquivo = this.files[i];
		//		fileB = URL.createObjectURL(esteArquivo);

		//		var audioElement2 = new Audio(fileB);
		//		audioElement2.setAttribute('src', fileB);
		//		audioElement2.onloadedmetadata = function(e) {
		//			tempoTotal = tempoTotal + parseInt(this.duration);
		//			//$("#musicas").html("Músicas Carregadas: " + quantidadeDeArquivos + " (Tempo Total: " + converterParaMinutosESegundos(tempoTotal) + ")");
		//			//$("#musicas").html("Tempo: " + converterParaMinutosESegundos(tempoTotal));
		//			$("#tempo_musica").val(converterParaMinutosESegundos(tempoTotal));
		//		//alert("loadedmetadata" + tempoTotal);
		//		}
		//	}
		//	tempoTotal = 0;
		//});

	</script>

	<script>
		$(document).ready(function () {
			$(document).on('click', '.changeFormato', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $formt_id = $this.val();

				// ------------------------------------------------------
				let $formData = {
					formt_id: $formt_id
				};

				$.ajax({
					url: painel_url  +'coreografias/ajaxform/TEMPO-MUSICA-MAX-PARTIC',
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


						$("#tempo-maximo").html( response.formt_tempo_limit );
						$("#numero-maximo-participantes").html( response.formt_max_partic );
					},
					error: function (jqXHR, textStatus, errorThrown) {
					}
				});
				// ------------------------------------------------------
			});
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
			$(document).on('click', '.cmdExcluirRegistro', function (e) {
				e.preventDefault();
				let $this = $(this);
				let $hashkey = $this.data( "hashkey" );
				let $row = $this.closest( ".trRow" );

				Swal.fire({
					title: 'Atenção!',
					icon: 'warning',
					html:
						'Você está prestes a excluir este registros. <br>'+
						'Esta ação não poderá ser revertida.<br>'+
						'Deseja continuar assim mesmo?',
					type: 'warning',
					showCancelButton: true,
					cancelButtonColor: "#AAAAAA",
					confirmButtonColor: "#3c973e",
					//confirmButtonColor: '$danger',
					//cancelButtonColor: '$success',
					confirmButtonText: 'Sim! Desejo Excluir',
					cancelButtonText: 'Cancelar',
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						// ------------------------------------------------------
						let $formData = {
							corgf_hashkey: $hashkey
						};

						$.ajax({
							url: painel_url  +'coreografias/ajaxform/EXCLUIR-REGISTRO',
							method:"POST",
							type: "POST",
							dataType: "json",
							data: $formData,
							crossDomain: true,
							beforeSend: function(response) {},
							complete: function(response) { },
							success:function(response){
								$row.remove();
							},
							error: function (jqXHR, textStatus, errorThrown) {}
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