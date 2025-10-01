
<div class="row ">
	<div class="col-12 col-md-12">
		<div class="card card-base mb-3">
			<div class="card-header">
				Configurações Principais
			</div>
			<div class="card-body">

				<div class="row">
					<div class="col-12 col-md-3">
						<div class="form-group">
							<label class="form-label" for="crit_nota_min">Nota Mínima</label>
							<input type="text" name="crit_nota_min" id="crit_nota_min" class="form-control" value="<?php echo((isset($rs_dados_evcob->crit_nota_min) ? $rs_dados_evcob->crit_nota_min : ""));?>" />
						</div>
					</div>
					<div class="col-12 col-md-4">

						<div class="form-group">
							<label class="form-label" for="crit_nota_min">Forma de Avaliação</label>
							<div class="d-flex" style="gap: 30px; margin-top: 5px;">
								<div class="form-check my-1" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="radio" name="evcob_tipo_cad" id="evcob_tipocad_pf" class="custom-control-input" value="Avaliacao-Geral" />
										<label class="custom-control-label m-0" for="evcob_tipo_cad_pf">Avaliação Geral</label>
									</div>
								</div>
								<div class="form-check my-1" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="radio" name="evcob_tipo_cad" id="evcob_tipo_cad_pj" class="custom-control-input" value="Avaliacao-Especifica" />
										<label class="custom-control-label m-0" for="evcob_tipo_cad_pj">Avaliação Específica</label>
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

	
<div class="row ">
	<div class="col-12 col-md-4">
		<div class="card card-base mb-3">
			<div class="card-header">
				Critérios a serem avaliados
			</div>
			<div class="card-body">

				<div class="table-box table-responsive">
					<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
						<thead>
							<tr class="fw-bolder text-muted">
								<th style="width:40px;">&nbsp;</th>
								<th>Título</th>
							</tr>
						</thead>
						<tbody>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
								</td>
								<td>
									Técnica 
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2">
								</td>
								<td>
									Interpretação
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
								</td>
								<td>
									Criatividade
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
								</td>
								<td>
									Harmonia
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2">
								</td>
								<td>
									Figurino
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
								</td>
								<td>
									Impacto Artístico
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>

		<div class="card card-base mb-3">
			<div class="card-header">
				Premiações Especiais
			</div>
			<div class="card-body">

				<div class="table-box table-responsive">
					<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
						<thead>
							<tr class="fw-bolder text-muted">
								<th style="width:40px;">&nbsp;</th>
								<th>Título</th>
							</tr>
						</thead>
						<tbody>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
								</td>
								<td>
									Melhor Bailarino 
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2">
								</td>
								<td>
									Melhor Grupo
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
								</td>
								<td>
									Melhor Dupla (DUO)
								</td>
							</tr>
							<tr class="trRow">
								<td class="text-center">
									<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
								</td>
								<td>
									Melhor Coreografia
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
	<div class="col-12 col-md-8">

		<div class="row ">
			<div class="col-12 col-md-12">
				<div class="card card-base mb-3">
					<div class="card-header">
						Jurados selecionados
					</div>
					<div class="card-body">

						<div class="">
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
									<thead>
										<tr class="fw-bolder text-muted">
											<th style="width:40px;">&nbsp;</th>
											<th>Nome</th>
											<th style="width: 40% !important;">Critérios</th>
											<th class="text-center" style="width: 90px;">Ações</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center" style="vertical-align: middle;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-2">
														<img src="assets/media/avatar-11.jpg" alt="">
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="<?php echo(painel_url('workshops/form/1')); ?>" class="text-dark fw-bolder text-hover-primary ">Ana Cláudia Carvalho</a>
													</div>
												</div>
											</td>
											<td style="vertical-align: middle;">
												<div class="">
													<span class="text-dark text-hover-primary d-block">Técnica</span>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_criterios" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<img src="assets/svg/edit.svg" style="width: 16px;">
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-center" style="vertical-align: middle;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2">
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-2">
														<img src="assets/media/avatar-04.jpg" alt="">
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="<?php echo(painel_url('workshops/form/1')); ?>" class="text-dark fw-bolder text-hover-primary ">Jefferson Prodit</a>
													</div>
												</div>
											</td>
											<td style="vertical-align: middle;">
												<div class="">
													<span class="text-dark text-hover-primary d-block">Técnica, Figurino</span>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_criterios" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<img src="assets/svg/edit.svg" style="width: 16px;">
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-center" style="vertical-align: middle;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-2">
														<img src="assets/media/avatar-05.jpg" alt="">
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="<?php echo(painel_url('workshops/form/1')); ?>" class="text-dark fw-bolder text-hover-primary ">Angela Cortez Villas</a>
													</div>
												</div>
											</td>
											<td style="vertical-align: middle;">
												<div class="">
													<span class="text-dark text-hover-primary d-block">Criatividade, Harmonia</span>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_criterios" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<img src="assets/svg/edit.svg" style="width: 16px;">
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-center" style="vertical-align: middle;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-2">
														<img src="assets/media/150-17.jpg" alt="">
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="<?php echo(painel_url('workshops/form/1')); ?>" class="text-dark fw-bolder text-hover-primary ">Maurício Sertozi Figueiredo</a>
													</div>
												</div>
											</td>
											<td style="vertical-align: middle;">
												<div class="">
													<span class="text-dark text-hover-primary d-block">Impacto Artístico</span>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_criterios" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<img src="assets/svg/edit.svg" style="width: 16px;">
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-center" style="vertical-align: middle;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-2">
														<img src="assets/media/150-19.jpg" alt="">
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="<?php echo(painel_url('workshops/form/1')); ?>" class="text-dark fw-bolder text-hover-primary ">Glória Caprezi Andreato</a>
													</div>
												</div>
											</td>
											<td style="vertical-align: middle;">
												<div class="">
													<span class="text-dark text-hover-primary d-block">Interpretação</span>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_criterios" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<img src="assets/svg/edit.svg" style="width: 16px;">
													</a>
												</div>
											</td>
										</tr>
									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>


<?php $this->section('scripts'); ?>

	<style>
		.table th {
			padding: 0.15rem 0.5rem;
			border-bottom: 1px dashed black;
		}
		.symbol {
			display: inline-block;
			flex-shrink: 0;
			position: relative;
			border-radius: .475rem;
		}
		.symbol>img {
			width: 100%;
			flex-shrink: 0;
			display: inline-block;
			border-radius: .475rem;
		}
		.symbol.symbol-45px>img {
			width: 45px;
			height: 45px;
		}


		.card.card-counter .card-body{
			padding: 1rem 1rem !important;	
		}
	</style>

<?php $this->endSection('scripts'); ?>


<?php $this->section('modals'); ?>

	<div class="modal fade" tabindex="-1" id="modal_criterios">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Critérios específicos para jurados</h5>
					<a href="javascript:;" class="" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem; color: black;">
						<i class="far fa-times-circle"></i>
					</a>
				</div>
				<div class="modal-body" style="max-height: 70vh; overflow: auto;">

					<div class="card card-base">
						<div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e3ebf6; font-weight: bold;">
							Critérios a serem avaliados
						</div>
						<div class="card-body">

							<div class="table-box table-responsive">
								<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
									<tbody>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												Técnica 
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2">
											</td>
											<td>
												Interpretação
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												Criatividade
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												Harmonia
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2">
											</td>
											<td>
												Figurino
											</td>
										</tr>
										<tr class="trRow">
											<td class="text-center" style="width:70px;">
												<input type="checkbox" name="chkCriterios[]" id="chkCriterios_xx" value="2" checked="">
											</td>
											<td>
												Impacto Artístico
											</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>
					</div>

				</div>
				<div class="modal-footer">
					<div class="d-flex justify-content-center w-100">
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-primary" style="border-radius: 8px;">Continuar</button>
						</div>
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px;">Fechar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->endSection('modals'); ?>
