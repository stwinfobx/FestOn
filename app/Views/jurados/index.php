<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4" id="app">
		<div class="container">
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsAvaliacao" id="formFieldsAvaliacao" ref="formFieldsAvaliacao">

					<div class="row">
						<div class="col-12 col-md-4">

							<div class="card card-workshop mb-3 h-100" style="border-radius: 8px !important;">
								<div class="card-body text-center">
									<?php if ($coreografia_atual): ?>
									<div class="work-item pb-3">
										<h2 class="m-0" style="font-size: 1.5rem; color: #FFF; font-weight: 600;">
											<?php echo esc($coreografia_atual->corgf_titulo); ?>
										</h2>
									</div>

									<div class="work-item pt-2 pb-3">
										<label>Grupo</label>
										<h4><?php echo esc($coreografia_atual->grp_titulo); ?></h4>
									</div>

									<div class="work-item pt-2 pb-3">
										<label>Coreógrafo</label>
										<h4><?php echo esc($coreografia_atual->corgf_coreografo); ?></h4>
									</div>

									<div class="work-item pt-2 pb-3">
										<label>Formato</label>
										<h4><?php echo esc($coreografia_atual->formt_titulo ?: 'GRUPO'); ?></h4>
									</div>

									<div class="work-item pt-2 pb-3">
										<label>Modalidade</label>
										<h4><?php echo esc($coreografia_atual->modl_titulo ?: 'Dança Contemporânea'); ?></h4>
									</div>

									<div class="work-item pt-2 pb-2">
										<label>Categoria</label>
										<h4><?php echo esc($coreografia_atual->categ_titulo ?: 'Adulto'); ?></h4>
									</div>

									<?php if ($coreografia_atual->corgf_observacao): ?>
									<div class="work-item pt-2 pb-2">
										<label>Observações</label>
										<p style="font-size: 0.9rem; color: #FFF;"><?php echo esc($coreografia_atual->corgf_observacao); ?></p>
									</div>
									<?php endif; ?>
									<?php else: ?>
									<div class="work-item pb-3">
										<h4 style="color: #FFF;">Nenhuma coreografia encontrada</h4>
									</div>
									<?php endif; ?>
								</div>
							</div>

						</div>
						<div class="col-12 col-md-8">

							<div class="card card-default mb-4 h-100">
								<div class="card-body p-0">

									<div class="row">
										<div class="col-12 col-md-12">

											<div class="card card-workshops" >
												<div class="card-body">
													<div class="item" style="background-color: #9b9b9b;">
														<div class="row justify-content-center align-items-center">
                                                            <div class="col-12 col-md">
                                                                <h4>Jurados</h4>
                                                                <h2 style="color: white;">&nbsp;<?php echo esc($jurd_nome); ?></h2>
                                                            </div>
                                                            <div class="col-12 col-md-auto">
                                                                <div class="workshops-avatar-bg" style="background-image: url('<?php echo esc($jurd_foto_url); ?>');"></div>
                                                            </div>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>

									<div class="row">
										<div class="col-12 col-md-12">

											<?php if (!empty($criterios) && $coreografia_atual): ?>
											<?php 
												// Criar array de avaliações existentes para fácil acesso
												$avaliacoes_por_criterio = [];
												if (!empty($avaliacoes_existentes)) {
													foreach ($avaliacoes_existentes as $aval) {
														if (is_object($aval)) {
															$avaliacoes_por_criterio[$aval->crit_id] = $aval;
														}
													}
												}
											?>
											<?php foreach ($criterios as $criterio): ?>
											<div>
												<div class="row mb-2 g-2">
													<div class="col-12 col-md-2">
														<?php 
															$nota_existente = isset($avaliacoes_por_criterio[$criterio->crit_id]) 
																? $avaliacoes_por_criterio[$criterio->crit_id]->aval_nota 
																: '';
															$tem_nota = !empty($nota_existente);
														?>
														<input type="number" 
															   class="inputAval text-center" 
															   name="avaliacoes[<?php echo $criterio->crit_id; ?>]"
															   v-model="avaliacoes[<?php echo $criterio->crit_id; ?>]"
															   @input="validateAndUpdate($event, <?php echo $criterio->crit_id; ?>)"
															   :class="{'input-preenchido': avaliacoes[<?php echo $criterio->crit_id; ?>] != ''}"
															   min="0" 
															   max="10" 
															   step="0.1"
															   value="<?php echo $nota_existente; ?>"
															   placeholder="0-10"
															   onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46"
															   pattern="^(10|[0-9](\.[0-9])?)$" />
													</div>
													<div class="col-12 col-md-10">
														<div class="descrAval" 
															 :class="{'active': avaliacoes[<?php echo $criterio->crit_id; ?>] != ''}">
															<?php echo esc($criterio->crit_titulo); ?>
														</div>
													</div>
												</div>
											</div>
											<?php endforeach; ?>
											<?php else: ?>
											<div class="alert alert-warning">
												Nenhum critério de avaliação encontrado.
											</div>
											<?php endif; ?>

										</div>
									</div>

									<div class="row d-none" style="margin-top: 200px;">
										<div class="col-12 col-md-12">

											<!-- Step 1 -->
											<div class="h-100" v-show="step == 1" >
												<?php 
													$includeDetalhes = view('jurados/detalhes', []);
													echo( $includeDetalhes );
												?>
											</div>

											<!-- Step 2 -->
											<div class="h-100" v-show="step == 2" >
												<?php 
													//$includeInscricao = view('workshops/form-inscricao', []);
													//echo( $includeInscricao );
												?>
											</div>

											<!-- Step 3 -->
											<div class="h-100" v-show="step == 3" >
												<?php 
													//$includeCobranca = view('workshops/cobranca', []);
													//echo( $includeCobranca );
												?>
											</div>

											<!-- Step 4 -->
											<div class="h-100" v-show="step == 4" >
												<?php 
													//$includeConfirmacao = view('workshops/confirmacao', []);
													//echo( $includeConfirmacao );
												?>
											</div>

										</div>
									</div>
		
								</div>
							</div>

						</div>
					</div>



                    <!-- Navegação entre coreografias COM VÍDEO (mostrar mesmo com 1 item) -->
                    <?php if (!empty($coreografias_grupo) && count($coreografias_grupo) >= 1): ?>
					<div class="card card-workshops mt-3">
						<div class="card-body p-0">
							<div class="item" style="background-color: #28447a;">
								<div class="row justify-content-center align-items-center">
									<div class="col-12 text-center">
                                        <h4 style="color: white; margin-bottom: 15px;">Coreografias do Grupo</h4>

                                        <!-- Removido: listagem de grupos aqui. Avanço de grupo será feito no Concluir. -->
										
										<!-- VÍDEO DA COREOGRAFIA ATUAL -->
										<?php if (!empty($coreografia_atual->corgf_linkvideo)): ?>
                                        <div class="mb-3">
                                            <?php if (!empty($video_embed)): ?>
                                                <iframe width="100%" height="300" 
                                                        src="<?php echo $video_embed; ?>" 
                                                        frameborder="0" 
                                                        allowfullscreen
                                                        style="border-radius: .25rem; max-width: 700px;"></iframe>
                                            <?php else: ?>
                                                <div style="background:#eee;border-radius:.25rem;max-width:700px;margin:0 auto;padding:20px;color:#333;">
                                                    Sem vídeo disponível ou link inválido.
                                                </div>
                                            <?php endif; ?>
                                        </div>
										<?php endif; ?>
										
                                        <!-- Removido: botões por coreografia (pager abaixo já controla a navegação) -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<!-- Botões de ação -->
					<div class="row justify-content-center pt-4">
						<div class="col-12 col-md-6">
							<div class="d-grid">
								<button type="button" 
										@click="finalizarAvaliacao" 
										class="btn btn-lg btn-warning"
										:disabled="!botaoConcluirHabilitado"
										:class="{'btn-success': botaoConcluirHabilitado, 'btn-secondary': !botaoConcluirHabilitado}">
									CONCLUIR AVALIAÇÃO
								</button>
							</div>
						</div>
					</div>

					<div class="row justify-content-center pt-5">
						<div class="col-12 col-md-12">
                                            <div class="d-flex justify-content-center align-items-center d-order-exibicao">
                                                <?php if (!empty($pager_coreo) && (int)$pager_coreo['total'] >= 1): ?>
                                                    <?php if (!empty($pager_coreo['first'])): ?>
                                                        <a class="oxItem" href="<?php echo site_url('jurados/index/' . $pager_coreo['first']); ?>">
                                                            <i class="fas fa-angle-double-left"></i> Primeiro
                                                        </a>
                                                    <?php else: ?>
                                                        <div class="oxItem disabled"><i class="fas fa-angle-double-left"></i> Primeiro</div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($pager_coreo['prev'])): ?>
                                                        <a class="oxItem" href="<?php echo site_url('jurados/index/' . $pager_coreo['prev']); ?>">
                                                            <i class="fas fa-angle-left"></i> Anterior
                                                        </a>
                                                    <?php else: ?>
                                                        <div class="oxItem disabled"><i class="fas fa-angle-left"></i> Anterior</div>
                                                    <?php endif; ?>
                                                    <div class="oxItem active">
                                                        <?php echo (int)$pager_coreo['pos_atual']; ?> de <?php echo (int)$pager_coreo['total']; ?>
                                                    </div>
                                                    <?php if (!empty($pager_coreo['next'])): ?>
                                                        <a class="oxItem" href="<?php echo site_url('jurados/index/' . $pager_coreo['next']); ?>">
                                                            Próximo <i class="fas fa-angle-right"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <div class="oxItem disabled">Próximo <i class="fas fa-angle-right"></i></div>
                                                    <?php endif; ?>
                                                    <?php if (!empty($pager_coreo['last'])): ?>
                                                        <a class="oxItem" href="<?php echo site_url('jurados/index/' . $pager_coreo['last']); ?>">
                                                            Último <i class="fas fa-angle-double-right"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <div class="oxItem disabled">Último <i class="fas fa-angle-double-right"></i></div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
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
		.d-order-exibicao{}
		.d-order-exibicao .oxItem{ 
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 6px;
			height: 40px;
			width: auto;
			min-width: 70px;
			margin: 0 2px;
			padding: 2px 12px;
			background: #5e5e5e;
			border-radius: 4px;
			font-weight: normal;
			color: white;
		}
		.d-order-exibicao .oxItem.active{
			background: #ffa902;
			font-weight: 600;
		}
		.mic{
			position: relative;
			margin: 0px 8px;
			margin-right: 16px;
			width: 30px;
			height: 30px;
			background-color: red;
			color: white;
			border-radius: 50%;		
		}
		.mic:before{
			content: '';
			position: absolute;
			top: -4px;
			left: -4px;
			width: 38px;
			height: 38px;
			border: 2px solid rgb(255,255,255, 50%);
			border-radius: 50%; 
		}
		.inputAval{
			background-color: #dddddb;
			height: 50px;
			font-size: 2rem;
			border-radius: 4px;
			color: #28447a;
			height: 100%;
			width: 100%;
			padding: 4px 8px;
			font-weight: 900;
			border: none;
			transition: background-color 0.3s ease;
		}
		.inputAval:focus {
			outline: none;
			background-color: #fea802;
			color: white;
		}
		.inputAval.input-preenchido {
			background-color: #fea802;
			color: white;
		}
		.descrAval{
			padding: 4px 20px;
			background-color: #dddddb;
			height: 50px;
			font-size: 1.5rem;
			border-radius: 4px;
			color: black;	
			height: 100%;
			width: 100%;
			display: flex;
			align-items: center;
		}
		.descrAval.active{
			padding: 4px 20px;
			background-color: #fea802;
			height: 50px;
			font-size: 1.5rem;
			border-radius: 4px;
			color: white;	
			height: 100%;
			width: 100%;
			display: flex;
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

		.nomebailarino{ font-size: .8rem; line-height: 1.2; }


		.card.card-workshops{ background-color: transparent; border-color: #ffa902; border: none; }
		.card.card-workshops .card-header{ 
			padding: 0;
			background-color: transparent;
			border-bottom: 1px dashed #ffa902;
			/*background-color: #ffa902; border-color: #ffa902;*/
		}
		.card.card-workshops .card-header h2{ 
			font-weight: bold;	
		}
		.card.card-workshops .card-body h3{ font-weight: bold; font-size: 1.25rem; }
		.card.card-workshops .card-body { 
			padding: 1rem 0;
			display: flex;
			flex-direction: column;
		}
		.card.card-workshops .card-body a{
			color: #000 !important; text-decoration: none;
		}
		.card.card-workshops .card-body .item{ 
			position: relative;
			margin-bottom: 1.0rem;
			background-color: #ffa902;
			padding: 1rem;
			border-radius: 8px;	
			box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshops .card-body .item label{ display: block; font-size: .80rem; }
		.card.card-workshops .card-body .item label.data{ display: block; font-size: .70rem; }
		.card.card-workshops .card-body .item h4{ font-size: 1.0rem; font-weight: bold; }
		.card.card-workshops .tag-vagas{
			position: absolute;
			top: 5px;
			right: 5px;
			background-color: #FFF;
			font-size: .70rem;
			color: #000;
			padding: 4px;
			font-weight: bold;
			border-radius: 4px;		
		}
		.card.card-workshops .card-body .item .box-address{
			display: flex;
			justify-content: space-between;
			margin-top: 6px;
			padding-top: 6px;
			background-color: transparent;
			border-top: 1px dashed #FFFFFF;

		}
		.card.card-workshops .card-body .item .box-address .local{
			font-size: .70rem;
			color: white;
			line-height: 1;		
		}

		.card.card-workshops .card-body .item.itemModal {
			position: relative;
			margin-bottom: 1.0rem;
			background-color: transparent;
			padding: 1rem;
			border-radius: 8px;
			box-shadow: none; 
		}
		.modal-header {
			border-bottom: 0px solid #dee2e6;
			background-color: #ffa902;
		}
		.modal-title {
			font-weight: bold;
			color: white;
		}
		.modal-content {
			/*background-color: #faa602;*/
			border: 0px solid rgba(0, 0, 0, .2);
			border-radius: 8px;
			box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);
		}

		.modal-backdrop.show {
			opacity: .9;
		}
	</style>

	<style>
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

<?php $this->section('modals'); ?>

	<div class="modal fade" tabindex="-1" id="modal_premiacoes">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Premiações Especiais</h5>
					<a href="javascript:;" class="" data-bs-dismiss="modal" aria-label="Close" style="font-size: 1.5rem; color: black;">
						<i class="far fa-times-circle"></i>
					</a>
				</div>
				<div class="modal-body" style="max-height: 70vh; overflow: auto;">
					<div class="box-list-premiacoes">

						<div class="card card-workshops" style="">
							<div class="card-body p-0">

								<a href="<?php echo(site_url('workshops')); ?>"><div class="item">
									<div class="row justify-content-center align-items-center">
										<div class="col-12 col-md-auto">
											<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg');"></div>
										</div>
										<div class="col-12 col-md">
											<h4>Ana Paula Cardoso Santos Silva</h4>
											<!-- <label class="data">início em 15.10.2024</label> -->
											<div class="box-address justify-content-center pt-2">
												<div style="width: 60%;">
													<label class="local">Categoria</label>
													<label class="address">Adulto</label>
												</div>
												<div style="width: 40%;">
													<label class="local">idade</label>
													<label class="address">36 anos</label>
												</div>
											</div>
										</div>
									</div>
								</div></a>

							</div>
						</div>

						<div class="table-box table-responsive">
							<table class="display table table-striped table-bordered" style="width:100%">
								<tbody>
									<tr class="trRow">
										<td class="text-center" style="width:70px;">
											<input type="checkbox" name="chkAutorizacao[]" id="chkAutorizacao_xx" value="2" checked="">
										</td>
										<td>
											Melhor Bailarino 
										</td>
									</tr>
									<tr class="trRow">
										<td class="text-center" style="width:70px;">
											<input type="checkbox" name="chkAutorizacao[]" id="chkAutorizacao_xx" value="2">
										</td>
										<td>
											Melhor Grupo
										</td>
									</tr>
									<tr class="trRow">
										<td class="text-center" style="width:70px;">
											<input type="checkbox" name="chkAutorizacao[]" id="chkAutorizacao_xx" value="2" checked="">
										</td>
										<td>
											Melhor Dupla (DUO)
										</td>
									</tr>
									<tr class="trRow">
										<td class="text-center" style="width:70px;">
											<input type="checkbox" name="chkAutorizacao[]" id="chkAutorizacao_xx" value="2" checked="">
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
				<div class="modal-footer">
					<div class="d-flex justify-content-center w-100">
						<div style="margin: 0 10px;">
							<button type="button" class="btn btn-primary" style="border-radius: 8px;">Salvar</button>
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

<?php $this->section('scripts'); ?>

	<!-- VueJs -->
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="assets/plugins/flatpickr/flatpickr-locale-br.js"></script>

	<!-- Sweet Alert -->
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>

	<script>
	$(document).ready(function () {
		$('.flatpickr_date').flatpickr({
			"locale": "pt",
			dateFormat:"d/m/Y",
			allowInput: true
		});		
	});
	</script>

	<!-- Lodash para debounce -->
	<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
	
	<script type="text/javascript" src="assets/vue/utils.js?t=<?= $time ?>"></script>
	<script type="text/javascript" src="assets/vue/jurados-avaliacao.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>