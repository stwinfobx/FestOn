<!--
crsit_urlpage VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_nome VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_email VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_cpf VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_genero VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_dte_nascto DATE NULL DEFAULT NULL,
crsit_nacionalidade VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_estado VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_cidade VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_estilo_danca VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_anos_exper VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
crsit_nivel VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
-->

<?php 
	$crsit_nome = (isset($rs_cursista->crsit_nome) ? $rs_cursista->crsit_nome : ""); 
	$crsit_email = (isset($rs_cursista->crsit_email) ? $rs_cursista->crsit_email : ""); 
	$crsit_cpf = (isset($rs_cursista->crsit_cpf) ? $rs_cursista->crsit_cpf : ""); 

	$crsit_dte_nascto = (isset($rs_cursista->crsit_dte_nascto) ? $rs_cursista->crsit_dte_nascto : ""); 
	$crsit_dte_nascto = fct_formatdate($crsit_dte_nascto, 'd/m/Y');
?>
<div class="row ">
	<div class="col-12 col-md-12">

		<div class="row">
			<div class="col-12 col-md-3">
				<div class="form-group">
					<label class="form-label" for="crsit_cpf">CPF</label>
					<input type="text" name="crsit_cpf" id="crsit_cpf" class="form-control" value="<?php echo($crsit_cpf);?>" />
				</div>
			</div>
			<div class="col-12 col-md-9">
				<div class="form-group">
					<label class="form-label" for="crsit_nome">Nome Completo</label>
					<input type="text" name="crsit_nome" id="crsit_nome" class="form-control" value="<?php echo($crsit_nome);?>" />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-9">
				<div class="form-group">
					<label class="form-label" for="crsit_email">E-mail</label>
					<input type="text" name="crsit_email" id="crsit_email" class="form-control" value="<?php echo($crsit_email);?>" />
				</div>
			</div>
			<div class="col-12 col-md-3">
				<?php 
					$crsit_dte_nascto = (isset($rs_cursista->crsit_dte_nascto) ? $rs_cursista->crsit_dte_nascto : ""); 
					$crsit_dte_nascto = fct_formatdate($crsit_dte_nascto, 'd/m/Y');
				?>
				<div class="form-group">
					<label class="form-label" for="crsit_dte_nascto">Data de Nascimento</label>
					<div class="position-relative d-flex align-items-center">
						<input type="text" name="crsit_dte_nascto" id="crsit_dte_nascto" class="form-control flatpickr_date" value="<?php echo($crsit_dte_nascto);?>" style="padding-right: 3rem !important;" />
						<span class="position-absolute mx-4" style="right: 0;">
							<img src="assets/svg/icon-calendar.svg" />
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-3">
				<?php $crsit_genero = (isset($rs_cursista->crsit_genero) ? $rs_cursista->crsit_genero : "");?>
				<div class="form-group">
					<label class="form-label" for="crsit_genero">Gênero</label>
					<select class="form-select" name="crsit_genero" id="crsit_genero">
						<option value="" translate="no">- selecione -</option>
						<?php
						if( isset($arr_generos) ){
							foreach ($arr_generos as $key => $val) {
								$selected = (($crsit_genero == $val['value']) ? 'selected' : '');
						?>
							<option value="<?php echo($val['value']); ?>" <?php echo($selected ); ?> translate="no"><?php echo($val['label']); ?></option>
						<?php
							}
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<label class="form-label" for="crsit_nacionalidade">Nacionalidade</label>
					<input type="text" name="crsit_nacionalidade" id="crsit_nacionalidade" class="form-control" value="" />
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<label class="form-label" for="crsit_estado">Estado</label>
					<select class="form-select" name="crsit_estado" id="crsit_estado">
						<option value="" translate="no">- selecione -</option>
					</select>
				</div>
			</div>
			<div class="col-12 col-md-3">
				<div class="form-group">
					<label class="form-label" for="crsit_cidade">Cidade</label>
					<select class="form-select" name="crsit_cidade" id="crsit_cidade">
						<option value="" translate="no">- selecione -</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label class="form-label" for="crsit_estilo_danca">Estilo de Dança</label>
					<input type="text" name="crsit_estilo_danca" id="crsit_estilo_danca" class="form-control" value="" />
				</div>
			</div>
			<div class="col-12 col-md-2">
				<div class="form-group">
					<label class="form-label" for="crsit_anos_exper">Anos de Experiência</label>
					<input type="text" name="crsit_anos_exper" id="crsit_anos_exper" class="form-control" value="" />
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="form-group">
					<label class="form-label" for="crsit_nivel">Nível</label>
					<select class="form-select" name="crsit_nivel" id="crsit_nivel">
						<option value="" translate="no">- selecione -</option>
						<option value="iniciante">Iniciante</option>
						<option value="intermediario">Intermediário</option>
						<option value="avancado">Avançado</option>
					</select>
				</div>
			</div>
		</div>

	</div>
</div>



<div class="mt-4">
	<h4 class="text-center mb-3">Inscrições realizadas neste workshop</h4>
	<div class="table-responsive">
		<!--begin::Table-->
		<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
			<thead>
				<tr class="fw-bolder text-muted">
					<th>Nome / Nível</th>
					<th class="" style="width: 160px;">Local</th>
					<th class="" style="width: 140px;">Nível</th>
					<th class="" style="width: 90px;">Idade</th>
					<th class="text-center" style="width: 90px;">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if( isset($rs_cursistas) ){
					$count = 0;
					foreach ($rs_cursistas->getResult() as $row) {
						$count++;
						$crsit_id = ($row->crsit_id);
						$crsit_hashkey = ($row->crsit_hashkey);
						$crsit_nome = ($row->crsit_nome);
						$crsit_email = ($row->crsit_email);
						//$crsit_cpf = ($row->crsit_cpf);
						$crsit_dte_nascto = ($row->crsit_dte_nascto);
						$crsit_nivel = ($row->crsit_nivel);
						
						$crsit_dte_nascto = str_replace("0000-00-00", "", $crsit_dte_nascto);
						$crsit_idade = "";
						if( !empty($crsit_dte_nascto) ){ $crsit_idade = calcularIdade($crsit_dte_nascto); }

						//$curso_dte_inicio = fct_formatdate($row->curso_dte_inicio, 'd/m/Y');
						//$curso_hrs_inicio = ($row->curso_hrs_inicio);
						//$curso_dte_termino = fct_formatdate($row->curso_dte_termino, 'd/m/Y');
						//$curso_hrs_termino = ($row->curso_hrs_termino);

						$link_form = painel_url('workshops/form/1/inscricao/'. $crsit_id);
						//$linkGerarPDF = painel_url();
				?>			
				<tr>
					<td>
						<div class="d-flex align-items-center">
							<div class="d-flex justify-content-start flex-column">
								<a href="<?php echo($link_form); ?>" class="text-dark fw-bolder text-hover-primary "><?php echo($crsit_nome); ?></a>
								<span class="text-muted fw-bold text-muted d-block fs-7"><?php echo($crsit_email); ?></span>
							</div>
						</div>
					</td>
					<td>
						<span class="text-dark text-hover-primary d-block fs-7">Rio de Janeiro</span>
						<span class="text-muted text-muted d-block fs-7"></span>
					</td>
					<td>
						<span class="text-dark text-hover-primary d-block fs-7"><?php echo($crsit_nivel); ?></span>
					</td>
					<td class="">
						<span class="me-2 fs-7"><?php echo($crsit_idade); ?></span>
					</td>
					<td>
						<div class="d-flex justify-content-end flex-shrink-0">
							<a href="<?php echo($link_form); ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
								<img src="assets/svg/edit.svg" style="width: 16px;">
							</a>
						</div>
					</td>
				</tr>
				<?php
					}
				}
				?>
			</tbody>
			<!--end::Table body-->
		</table>
		<!--end::Table-->
	</div>
</div>
