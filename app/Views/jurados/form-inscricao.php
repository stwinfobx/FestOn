

<div class="content-step current justify-content-center align-items-center flex-column h-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-12">
				<div>
					<div class="row mb-3">
						<div class="col-12 col-md-9">
							<h2 class="fw-bolder text-dark title-step m-0">Inscrição</h2>
							<!-- <div class="text-muted fs-6 text-center text-md-start">Informe que irão integrar ao grupo.</div> -->
						</div>
						<div class="col-12 col-md-3">
						</div>
					</div>
				</div>
				<div class="content-itens" style="margin-top: 10px;">

					<div class="row">
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_documento">Documento (CPF) *</label>
									<input type="text" name="partc_documento" id="partc_documento" class="form-control mask-cpf cmdBlurDocumento" value="" />
									<div class="text-center mt-1 divError" style="line-height: 1; display:none;">
										<small style="color: red;">CPF já foi cadastro em outro grupo/companhia</small>
									</div>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-9">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_nome">Nome Completo *</label>
									<input type="text" name="partc_nome" id="partc_nome" class="form-control" value="" />
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-9">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_documento">E-mail</label>
									<input type="text" name="partc_documento" id="partc_documento" class="form-control mask-cpf cmdBlurDocumento" value="" />
									<div class="text-center mt-1 divError" style="line-height: 1; display:none;">
										<small style="color: red;">CPF já foi cadastro em outro grupo/companhia</small>
									</div>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_nome">Data de Nascimento *</label>
									<div class="position-relative d-flex align-items-center">
										<input type="text" name="partc_dte_nascto" id="partc_dte_nascto" class="form-control mask-date flatpickr_date" value="" style="padding-right: 3rem !important;" />
										<span class="position-absolute mx-4" style="right: 0;">
											<img src="assets/svg/icon-calendar.svg" />
										</span>
									</div>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_documento">Gênero</label>
									<select class="form-select" name="partc_genero" id="partc_genero">
										<option value="" translate="no">- selecione -</option>
									</select>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_nome">Nacionalidade *</label>
									<input type="text" name="partc_nome" id="partc_nome" class="form-control" value="" />
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_nome">Estado *</label>
									<select class="form-select" name="partc_genero" id="partc_genero">
										<option value="" translate="no">- selecione -</option>
									</select>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_nome">Cidade *</label>
									<select class="form-select" name="partc_genero" id="partc_genero">
										<option value="" translate="no">- selecione -</option>
									</select>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-5">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_documento">Estilo de Dnça</label>
									<input type="text" name="partc_documento" id="partc_documento" class="form-control" value="" />
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-2">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_nome">Anos de Experiência *</label>
									<input type="text" name="partc_nome" id="partc_nome" class="form-control" value="" />
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-5">
							<div class="form-group">
								<div>
									<label class="form-label" for="partc_nome">Nível *</label>
									<select class="form-select" name="partc_genero" id="partc_genero">
										<option value="" translate="no">- selecione -</option>
									</select>
								</div>
								<div class="form-error"><small></small></div>
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
						<a href="<?php //echo($link_retorna_grupos); ?>" class="btn btn-secondary">Anterior</a>
					</div>
				</div>
				<div class="col-8 col-md-6">
					<div class="d-grid">
						<a href="javascript:;" class="btn btn-primary">Continuar</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>



<?php $time = time(); ?>
<?php $this->section('headers'); ?>

<?php $this->endSection('headers'); ?>



<?php $this->section('scripts'); ?>
	
	<style>
		.form-error{ display: none; }
	</style>

<?php $this->endSection('scripts'); ?>
