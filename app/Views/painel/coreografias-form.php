<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 


	$link_param = '';
	$_grp_hashkey = (isset($rs_params->grp) ? $rs_params->grp : "");
	if( !empty($_grp_hashkey) > 0 ){ $link_param =  '/params/grp:'. $_grp_hashkey; }
	$link_back_corgf = painel_url('coreografias/form/'. $link_param);
?>

	<div class="box-breadcrumb">
		<div class="row">
			<div class="col">
				<h2 class="page-title">Coreografias</h2>
			</div>
			<div class="col-auto">
				<?php 
					$w_data['etapa'] = 'coreografias';
					$inputFile = view('painel/widgets/etapas-cadastro', $w_data);
					echo( $inputFile );
				?>
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-12">

				<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsRegistro" id="formFieldsRegistro" enctype="multipart/form-data">

				<div class="row align-items-start">
					<div class="col-12 col-md-12">

						<?php
						if( isset($rs_corgf_list)){
						?>
							<!-- Lista de Coreografias -->
							<div class="card card-default mb-3">
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-12 col-md-12">
											<div class="table-box table-responsive">
												<table id="example2" class="display nowrap table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th class="text-center" style="width:110px;">Ação</th>
															<th style="width:50px;">ID</th>
															<th>Nome da Coreografia</th>
															<th>Modalidade</th>
															<th>Formato</th>
															<th>Cagtegoria</th>
														</tr>
													</thead>
													<tbody>
														<?php
															$count = 0;
															foreach ($rs_corgf_list as $row) {
																$count++;
																$corgf_id = ($row->corgf_id);
																$corgf_titulo = ($row->corgf_titulo);
																$corgf_hashkey = ($row->corgf_hashkey);
																$modl_titulo = ($row->modl_titulo);
																$formt_titulo = ($row->formt_titulo);
																$categ_titulo = ($row->categ_titulo);

																$_grp_hashkey = (isset($rs_params->grp) ? $rs_params->grp : "");
																if( !empty($_grp_hashkey) > 0 ){ $link_param =  '/params/grp:'. $_grp_hashkey; }

																$link_form = painel_url('coreografias/form/'. $corgf_id . $link_param);
														?>
														<tr class="trRow">
															<td class="text-center">
																<div class="d-flex justify-content-center">
																	<div style="margin: 0 3px;">
																		<a href="<?php echo($link_form); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-file-alt"></i></a>
																	</div>
																	<div style="margin: 0 3px;">
																		<a href="javascript:;" class="btn btn-sm btn-ac btn-danger cmdExcluirRegistro" data-hashkey="<?php echo($corgf_hashkey); ?>"><i class="las la-trash"></i></a>
																	</div>
																</div>
															</td>
															<td><?php echo($corgf_id); ?></td>
															<td>
																<div><strong><?php echo($corgf_titulo); ?></strong></div>
															</td>
															<td>
																<div><?php echo($modl_titulo); ?></div>
															</td>
															<td>
																<div><?php echo($formt_titulo); ?></div>
															</td>
															<td>
																<div><?php echo($categ_titulo); ?></div>
															</td>
														</tr>
														<?php
															} // foreach
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
						} // if isset : rs_corgf_list
						?>


						<?php
						if( isset($rs_dados) ){
						?>
							<div class="card card-default">
								<div class="card-header-box">
									<div class="row align-items-center">
										<div class="col-12 col-md-6">
											
										</div>
										<div class="col-12 col-md-6">

											<div class="d-flex justify-content-end" style="gap:5px;">
												<div><a href="<?php echo($link_back_corgf); ?>" class="btn btn-sm btn-warning">Voltar</a></div>
												<div><input type="submit" class="btn btn-sm btn-success" value="Salvar"></div>
											</div>

										</div>
									</div>
								</div>
								<div class="card-body">

									<div class="row ">
										<div class="col-12 col-md-12">

											<div class="row justify-content-start mb-2">
												<div class="col-12 col-md-3 justify-content-end">
													<?php 
														$corgf_ativo = (int)(isset($rs_dados->corgf_ativo) ? $rs_dados->corgf_ativo : "");
														$checked = (($corgf_ativo == 1) ? 'checked' : '');
													?>
													<div class="d-flex justify-content-start">
														<div class="">
															<input id="corgf_ativo" name="corgf_ativo" type="checkbox" class="switch" value="1" <?php echo($checked); ?> />
															<label for="corgf_ativo">Registro Ativo?</label>
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-12 col-md-6">
													<div class="form-group">
														<label class="form-label" for="corgf_titulo">Nome da Coreografia</label>
														<input type="text" name="corgf_titulo" id="corgf_titulo" class="form-control" value="<?php echo((isset($rs_dados->corgf_titulo) ? $rs_dados->corgf_titulo : ""));?>" />
													</div>
												</div>
												<div class="col-12 col-md-6">
													<?php 
														$_grp_id = (int)(isset($rs_dados->grp_id) ? $rs_dados->grp_id : "");
														//$_grp_id = (int)(isset($rs_params->grp) ? $rs_params->grp : $_grp_id);
														$disabled = (isset($rs_params->grp) ? 'disabled' : '');
													?>
													<div class="form-group">
														<label class="form-label" for="grp_id">Grupo</label>
														<select class="form-select" name="grp_id" id="grp_id" <?php echo($disabled); ?> >
															<option value="" translate="no">- selecione -</option>
															<?php
															if( isset($rs_grupos)){
																foreach ($rs_grupos->getResult() as $row) {
																	$grp_id = ($row->grp_id);
																	$grp_titulo = ($row->grp_titulo);
																	$selected = (($grp_id == $_grp_id) ? "selected" : "");
																?>
																	<option value="<?php echo($grp_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($grp_titulo); ?></option>
															<?php
																}
															}
															?>
														</select>
														<?php if($disabled == "disabled"){ ?>
															<input type="hidden" name="grp_id" id="grp_id" class="form-control" value="<?php echo($_grp_id);?>" />
														<?php } ?>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-12 col-md-4">
													<?php 
														$_modl_id = (int)(isset($rs_dados->modl_id) ? $rs_dados->modl_id : "");
													?>
													<div class="form-group">
														<label class="form-label" for="modl_id">Modalidade</label>
														<select class="form-select" name="modl_id" id="modl_id">
															<option value="" translate="no">- selecione -</option>
															<?php
															if( isset($rs_modalidades)){
																foreach ($rs_modalidades->getResult() as $row) {
																	$modl_id = ($row->modl_id);
																	$modl_titulo = ($row->modl_titulo);
																	$selected = (($modl_id == $_modl_id) ? "selected" : "");
																?>
																	<option value="<?php echo($modl_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($modl_titulo); ?></option>
															<?php
																}
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-12 col-md-4">
													<?php 
														$_formt_id = (int)(isset($rs_dados->formt_id) ? $rs_dados->formt_id : "");
													?>
													<div class="form-group">
														<label class="form-label" for="formt_id">Formato</label>
														<select class="form-select changeFormato" name="formt_id" id="formt_id">
															<option value="" translate="no">- selecione -</option>
															<?php
															if( isset($rs_formatos)){
																foreach ($rs_formatos->getResult() as $row) {
																	$formt_id = ($row->formt_id);
																	$formt_titulo = ($row->formt_titulo);
																	$selected = (($formt_id == $_formt_id) ? "selected" : "");
																?>
																	<option value="<?php echo($formt_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($formt_titulo); ?></option>
															<?php
																}
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-12 col-md-4">
													<?php 
														$_categ_id = (int)(isset($rs_dados->categ_id) ? $rs_dados->categ_id : "");
														//$_categ_id = (int)(isset($rs_params->grp) ? $rs_params->grp : $_grp_id);
														//$disabled = (isset($rs_params->grp) ? 'disabled' : '');
														$disabled = '';
													?>
													<div class="form-group">
														<label class="form-label" for="categ_id">Categoria</label>
														<select class="form-select" name="categ_id" id="categ_id" <?php echo($disabled); ?> >
															<option value="" translate="no">- selecione -</option>
															<?php
															if( isset($rs_categorias)){
																foreach ($rs_categorias->getResult() as $row) {
																	$categ_id = ($row->categ_id);
																	$categ_titulo = ($row->categ_titulo);
																	$selected = (($categ_id == $_categ_id) ? "selected" : "");
																?>
																	<option value="<?php echo($categ_id); ?>" <?php echo($selected); ?> translate="no"><?php echo($categ_titulo); ?></option>
															<?php
																}
															}
															?>
														</select>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-12 col-md-6">
													<div class="row">
														<div class="col-12 col-md-8">
															<div class="form-group">
																<div>
																	<label class="form-label">MP3 da Música <small style="color: #de700e;">(tempo máximo permitido)</small></label>
																	<input type="file" name="fileMusicaMP3" id="fileMusicaMP3" class="form-control files" accept=".mp3">
																</div>
															</div>
														</div>
														<div class="col-12 col-md-4">
															<div class="form-group">
																<label class="form-label" for="tempo_musica">Tempo</label>
																<input type="text" name="tempo_musica" id="tempo_musica" class="form-control input-tempo-musica" value="135" readonly="readonly" onfocus="this.blur();" />
															</div>
														</div>
													</div>
												</div>
												<div class="col-12 col-md-6">
													<div class="row">
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label class="form-label" for="corgf_musica">Música</label>
																<input type="text" name="corgf_musica" id="corgf_musica" class="form-control" value="<?php echo((isset($rs_dados->corgf_musica) ? $rs_dados->corgf_musica : ""));?>" />
															</div>
														</div>
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label class="form-label" for="corgf_compositor">Compositor</label>
																<input type="text" name="corgf_compositor" id="corgf_compositor" class="form-control" value="<?php echo((isset($rs_dados->corgf_compositor) ? $rs_dados->corgf_compositor : ""));?>" />
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-12 col-md-12">
													<div class="form-group">
														<label class="form-label" for="corgf_link_video">Link da Coreografia (Youtube)</label>
														<input type="text" name="corgf_link_video" id="corgf_link_video" class="form-control" value="<?php echo((isset($rs_dados->corgf_link_video) ? $rs_dados->corgf_link_video : ""));?>" />
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-12 col-md-12">
													<div class="form-group">
														<label class="form-label" for="corgf_observacao">Observação</label>
														<textarea type="text" name="corgf_observacao" id="corgf_observacao" class="form-control" style="height: 160px !important;"><?php echo((isset($rs_dados->corgf_observacao) ? $rs_dados->corgf_observacao : ""));?></textarea>
													</div>
												</div>
											</div>

										</div>
									</div>

								</div>
							</div>

							<!-- Relacionar Participantes -->
							<h2 class="page-title mt-3">Relacionar Participantes</h2>

							<div class="card card-default">
								<div class="card-body">
									<div class="row justify-content-center">
										<div class="col-12 col-md-9">
											<div class="form-group">
												<select class="form-select" name="participante" id="participante">
													<option value="" translate="no">- selecione um participante -</option>
													<?php
													if( isset($rs_participantes)){
														foreach ($rs_participantes->getResult() as $row) {
															$partc_id = ($row->partc_id);
															$insti_id = ($row->insti_id);
															$partc_nome = ($row->partc_nome);
														?>
															<option value="<?php echo($partc_id); ?>" translate="no"><?php echo($insti_id); ?> | <?php echo($partc_nome); ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>
											<h3>Número Máximo de Participantes: <span id="numero-maximo-participantes"></span></h3>
										</div>
										<div class="col-12 col-md-3">
											<div class="d-grid"><a href="javascript:;" class="btn btn-success">Adicionar</a></div>
										</div>
									</div>

									<div class="row justify-content-center mt-5">
										<div class="col-12 col-md-12">
											<div class="table-box table-responsive">
												<table id="example2" class="display nowrap table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th style="width:60px">Foto</th>
															<th>Nome do Participante</th>
															<th>CPF</th>
															<th>Função</th>
															<th class="text-center" style="width:110px;">Ações</th>
														</tr>
													</thead>
													<tbody>
													<?php
													if( isset($rs_partic_corgf)){
														foreach ($rs_partic_corgf->getResult() as $row) {
															$partc_id = ($row->partc_id);
															$partc_hashkey = ($row->partc_hashkey);
															$insti_id = ($row->insti_id);
															$partc_nome = ($row->partc_nome);
															$partc_documento = ($row->partc_documento);
															$func_titulo = ($row->func_titulo);

															$link_form = painel_url('participantes/form/'. $partc_id);
														?>
														<tr>
															<td>
																<div class="personal-image-header">
																	<label class="label">
																		<figure class="personal-figure-header">
																			<img src="assets/media/icon-profile2.png" class="personal-avatar-header" alt="avatar">
																		</figure>
																	</label>
																</div>
															</td>
															<td>
																<div><strong><?php echo($partc_nome); ?></strong></div>
															</td>
															<td>
																<div><?php echo($partc_documento); ?></div>
															</td>
															<td>
																<div><?php echo($func_titulo); ?></div>
															</td>
															<td>
																<div class="d-flex justify-content-center">
																	<div style="margin: 0 3px;">
																		<a href="<?php echo($link_form); ?>" class="btn btn-sm btn-ac btn-primary"><i class="las la-file-alt"></i></a>
																	</div>
																	<div style="margin: 0 3px;">
																		<a href="javascript:;" class="btn btn-sm btn-ac btn-danger" data-hashkey="<?php echo($partc_hashkey); ?>"><i class="las la-trash"></i></a>
																	</div>
																</div>
															</td>
														</tr>
													<?php
														}
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
						} // if isset : rs_dados
						?>


						<?php
						if( !isset($rs_dados) && !isset($rs_corgf_list) ){
						?>
						<div class="pt-5">
							<div class="alert alert-default alert-primary d-flex justify-content-center align-items-center" role="alert">
								<div class="text-center">
									<h4>Não não encontramos registros para exibição</h4>
								</div>
							</div>
						</div>
						<?php
						}
						?>

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
		.box-img-principal{
			border:1px solid #e2e2e2; 
			border-radius: .25rem; 
			padding: 8px;
			box-shadow: 0 4px 10px 1px rgb(223 223 223 / 6%), 0 1px 4px rgb(0 0 0 / 4%) !important;
		}
		/* 
			PLUGIN DE UPLOAD DE ARQUIVOS 
		*/
		.jFiler-input-dragDrop.fileUnico {
			width: 100% !important;
			padding: 20px !important;
			font-family: "Product Sans", sans-serif !important;
			background: #FAFAFA !important;
			border-radius: 30px !important;
			border: 1.5px solid #5356FB30 !important;
		}
		.jFiler-input-dragDrop:hover{ background-color: #e0e8f5 !important; }
		.jFiler-input-dragDrop .jFiler-input-flex{
			display: flex !important;
			justify-content: center !important;
			align-items: center !important;
			flex-direction: column !important;
		}
		.jFiler-input-flex .jFiler-input-item{ margin: 0 5px !important; }
		.jFiler-input-flex .jFiler-input-item .jFiler-input-text h3 { font-size: 1rem !important; }

		.jFiler-items-grid .jFiler-item .jFiler-item-container {
			border-radius: 0.25rem !important;
			border-radius: 30px !important;
			margin: 0 !important;
			padding: 0 !important;
			height: 100% !important;
			background: #fff;
			background: #FAFAFA !important;
			-webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			-moz-box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			box-shadow: 0px 0px 3px rgba(0,0,0,0.06);
			box-shadow: 0 4px 10px 1px rgb(223 223 223 / 6%), 0 1px 4px rgb(0 0 0 / 4%) !important;
		}

		/* 100 / 6 = 16.66667 */
		.grid-tile-wrapper.fileUnico {
			display: grid;
			grid-gap: 15px;
			grid-template-columns: repeat(auto-fit, minmax(calc(100% - 0px), calc(100% - 0px)));
			grid-auto-rows: 200px;
			grid-auto-flow: dense;
		}
		.grid-tile-item {
			grid-column: span 1;
			grid-row: span 1;
		}
		.jFiler-items-grid .jFiler-item .jFiler-item-container .jFiler-item-thumb {
			position: relative;
			width: 100% !important;
			height: 145px;
			min-height: 115px;
			overflow: hidden;
			border: 0px solid #e1e1e1;
			border-radius: 0.25rem;
			border-radius: 30px !important;
			border-bottom-left-radius: .25rem !important;
			border-bottom-right-radius: .25rem !important;
		}
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