
	<div class="modal fade" tabindex="-1" id="modal_premiacoes">
		<div class="modal-dialog modal-md" style="max-width: 800px;">
			<div class="modal-content" style="padding-bottom: 6px;">
				<div class="modal-header">
					<h5 class="modal-title">Workshop</h5>
					<a href="javascript:;" class="" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem; color: black;">
						<i class="far fa-times-circle"></i>
					</a>
				</div>
				<div class="modal-body" style="max-height: 70vh; overflow: auto;">
					<div class="box-list-premiacoes pt-3">

						<div class="card card-workshops" style="">
							<div class="card-body p-0">
								
								<div id="itemCheckedModalMensagem" class="item-checked-modal ">
									<div class="row justify-content-center mb-5">
										<div class="col-12 col-md-6">

											<div class="item-checked">
												<div class="row justify-content-center align-items-center">
													<div class="col-12 col-md">
														<h2>Curso adicionado com sucesso!</h2>
													</div>
													<div class="col-12 col-md-2 text-center">
														<div class="icon">
															<i class="far fa-check-circle"></i>
														</div>
													</div>
												</div>

												<div class="row justify-content-center align-items-center">
													<div class="col-12 col-md-auto">
														<div class="workshops-avatar" style="background-image: url('assets/media/avatar-04.jpg');"></div>
													</div>
													<div class="col-12 col-md">
														<h4>Dança Cigana – Ritmo, Expressão e Cultura</h4>
														<label>Nome do Professor do Curso</label>
													</div>
												</div>

												<div class="row justify-content-center align-items-center">
													<div class="col-12">
														<label class="data">início em 01.07.2024</label>
														<div class="box-address" style="position: relative;">
															<div style="position: relative;">
																<label class="local">local</label>
																<label class="address">São Paulo</label>
															</div>
															<div class="tag-valor"><span>R$</span>60,00</div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>

									<div class="row justify-content-center">
										<div class="col-12 col-md-10">
											<div class="row justify-content-center mb-5">
												<div class="col-12 col-md-6">
													<div class="d-grid h-100">
														<a href="javascript:;" class="btn btn-warning mr-btn-center showListCursos" style="border-radius: 8px;">Deseja adicionar outros<br>
														cursos a esta compra</a>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="d-grid h-100">
														<a href="javascript:;" class="btn mr-btn-center success" style="border-radius: 8px;">Deseja finalizar esta compra</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div id="itemCheckedModalMensagem" class="item-checked-modal active">
									<div class="row">
										<div class="col-12 col-md-12">
											<h3>Cursos Disponíveis</h3>
										</div>
									</div>
									<div class="row">
										<?php
										if( isset($rs_workshops)){
											$xx = 0;
											foreach ($rs_workshops->getResult() as $row) {
												$curso_id = ($row->curso_id);
												$curso_hashkey = ($row->curso_hashkey);
												$curso_titulo = ($row->curso_titulo);
												$curso_nome_professor = ($row->curso_nome_professor);
												$curso_local = ($row->curso_local);
												$link_workshop = site_url('workshops');
												
												$xx++;
												$disabled = '';
												if( $xx == 1){ $disabled = 'disabled'; }
										?>
										<div class="col-12 col-md-6">
											<a href="<?php echo($link_workshop); ?>" style="z-index: 99; position: relative;  display: block; width: 100%;">
											<div class="item <?php echo($disabled); ?>">
												<div class="mrVagasDisp">
													<span>60</span>
													<div>Vagas</div>
												</div>
												<div class="row justify-content-center align-items-center">
													<div class="col-12 col-md-auto pe-1">
														<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-04.jpg');     width: 60px; height: 60px;"></div>
													</div>
													<div class="col-12 col-md ps-1">
														<h4><?php echo($curso_titulo); ?></h4>
														<label><?php echo($curso_nome_professor); ?></label>
													</div>
												</div>

												<div class="row justify-content-center align-items-center">
													<div class="col-12">
														<label class="data text-end">início em 01.07.2024</label>
														<div class="box-address" style="position: relative;">
															<div style="position: relative;">
																<label class="local">local</label>
																<label class="address"><?php echo($curso_local); ?></label>
															</div>
															<div class="tag-valor"><span>R$</span>60,00</div>
														</div>
													</div>
												</div>
											</div>
											</a>
										</div>
										<?php
											}
										}
										?>
									</div>

									<div class="row justify-content-center mt-3">
										<div class="col-12 col-md-10">
											<div class="row justify-content-center mb-1">
												<div class="col-12 col-md-6">
													<div class="d-grid">
														<a href="javascript:;" class="btn btn-primary" style="border-radius: 8px;">Deseja finalizar esta compra</a>
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


<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.item-checked-modal{ display: none; }
		.item-checked-modal.active{ display: block; }
	</style>

<?php $this->endSection('headers'); ?>


<?php $this->section('scripts'); ?>

	<script>

	</script>
	
<?php $this->endSection('scripts'); ?>