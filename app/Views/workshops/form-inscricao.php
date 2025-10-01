

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
									<label class="form-label" for="crsit_cpf">Documento (CPF) *</label>
									<input type="text" name="crsit_cpf" id="crsit_cpf" class="form-control mask-cpf" v-on:blur="getDadosCadastro" v-model="fields.crsit_cpf" ref="crsit_cpf" value="" />
									<div class="text-center mt-1 divError" style="line-height: 1; display:none;">
										<small style="color: red;">CPF já foi cadastro em outro grupo/companhia</small>
									</div>
								</div>
								<div class="form-error" v-if="error.crsit_cpf.length"><small>{{ error.crsit_cpf }}</small></div>
							</div>
						</div>
						<div class="col-12 col-md-9">
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_nome">Nome Completo *</label>
									<input type="text" name="crsit_nome" id="crsit_nome" v-model="fields.crsit_nome" ref="crsit_nome" class="form-control" value="" :disabled="fldReadonly" v-on:focus="focusField" v-bind:class="{fldReadonly: fldReadonly}" />
								</div>
								<div class="form-error" v-if="error.crsit_nome.length"><small>{{ error.crsit_nome }}</small></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_dte_nascto">Data de Nascimento *</label>
									<div class="position-relative d-flex align-items-center">
										<input type="text" name="crsit_dte_nascto" id="crsit_dte_nascto" class="form-control mask-date flatpickr_date" value="" style="padding-right: 3rem !important;" v-model="fields.crsit_dte_nascto" ref="crsit_dte_nascto" :disabled="fldReadonly" v-on:focus="focusField" v-bind:class="{fldReadonly: fldReadonly}" />
										<span class="position-absolute mx-4" style="right: 0;">
											<img src="assets/svg/icon-calendar.svg" />
										</span>
									</div>
								</div>
								<div class="form-error" v-if="error.crsit_dte_nascto.length"><small>{{ error.crsit_dte_nascto }}</small></div>
							</div>
						</div>
						<div class="col-12 col-md-9">
							<!-- genero -->
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_genero">Gênero *</label>
									<select class="form-select" name="crsit_genero" id="crsit_genero" v-model="fields.crsit_genero" ref="crsit_genero" :disabled="fldReadonly" v-on:focus="focusField" v-bind:class="{fldReadonly: fldReadonly}">
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
								<div class="form-error" v-if="error.crsit_genero.length"><small>{{ error.crsit_genero }}</small></div>
							</div>
						</div>					
					</div>

					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_email">E-mail</label>
									<input type="text" name="crsit_email" id="crsit_email" v-model="fields.crsit_email" ref="crsit_email" class="form-control" value="" />
									<div class="text-center mt-1 divError" style="line-height: 1; display:none;">
										<small style="color: red;">CPF já foi cadastro em outro grupo/companhia</small>
									</div>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-2">
							<!-- estado -->
							<div class="form-group">
								<div>
									<label class="form-label" for="uf_id">Estado *</label>
									<select class="form-select" name="uf_id" id="uf_id" ref="estadoSelect" v-model="fields.uf_id" v-on:change="selectEstados($event)">
										<option value="" translate="no">-</option>
										<option value="" translate="no" v-for="(value, key, index) in lista_estados" :value='value.uf_id'>{{value.uf_sigla}}</option>	
									</select>
								</div>
								<div class="form-error" v-if="error.uf_id.length"><small>{{ error.uf_id }}</small></div>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<!-- cidade -->
							<div class="form-group">
								<div>
									<label class="form-label" for="munc_id">Cidade *</label>
									<select class="form-select" name="munc_id" id="munc_id" v-model="fields.munc_id">
										<option value="" translate="no">- selecione -</option>
										<option value="" translate="no" v-for="(value, key, index) in lista_cidades" :value='value.munc_id'>{{value.munc_nome}}</option>	
									</select>
								</div>
								<div class="form-error" v-if="error.munc_id.length"><small>{{ error.munc_id }}</small></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-3">
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_anos_exper">Anos de Experiência *</label>
									<input type="text" name="crsit_anos_exper" id="crsit_anos_exper" class="form-control" v-model="fields.crsit_anos_exper" ref="crsit_anos_exper" value="" />
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>					
						<div class="col-12 col-md-9">
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_estilo_danca">Estilo de Dança</label>
									<input type="text" name="crsit_estilo_danca" id="crsit_estilo_danca" class="form-control" v-model="fields.crsit_estilo_danca" ref="crsit_estilo_danca" value="" />
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_funcao">Função *</label>
									<select class="form-select" name="crsit_funcao" id="crsit_funcao" v-model="fields.crsit_funcao" ref="crsit_funcao">
										<option value="" translate="no">- selecione -</option>
									</select>
								</div>
								<div class="form-error"><small></small></div>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<div>
									<label class="form-label" for="crsit_nivel">Nível *</label>
									<select class="form-select" name="crsit_nivel" id="crsit_nivel" v-model="fields.crsit_nivel" ref="crsit_nivel">
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
						<!-- <a href="javascript:;" class="btn btn-primary" v-on:click="salvarParticipante()">Continuar</a> -->
						<a href="javascript:;" class="btn btn-primary" style="border-radius: .25rem;" data-bs-toggle="modal" data-bs-target="#modal_premiacoes" >Continuar</a>
					</div>

					<!-- Gravar os dados no final, abrir a janela para finalizar ou adicionar outro curso. -->
					
				</div>
			</div>
		</div>

	</div>
</div>



<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.card.card-credenciamento{ background-color: #FFFFFF; border-color: #ffa902; }
		.card.card-credenciamento .card-header{ background-color: #ffa902; border-color: #ffa902; padding: 1rem 1rem; }
		.card.card-credenciamento .card-body h3{ font-weight: bold; font-size: 1.25rem; }
		.card.card-credenciamento .card-body .item{ margin-bottom: 0.5rem; }
		.card.card-credenciamento .card-body .item label{ font-size: .70rem; }
		.card.card-credenciamento .card-body .item h4{ font-size: .85rem; font-weight: bold; }
		
		.img-fluid-evento{
			max-height: 98%;
			border-radius: .5rem;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 2px solid white;
			/* width: 100%; */
			max-height: 70vh;
		}
		.box-featured{}
		.box-featured .item{ text-align: center; }
		.box-featured .item .itemIcon{
			height: 120px;
			width: 120px;
			
			border-radius: 50%;
			cursor: pointer;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
			margin-bottom: 10px;
		}
		.box-featured .item .itemIcon:hover{
			background: #f0a234;
		}

		.card-destaque{
			height: 140px;
			background: #fff7f1;
			/* border: 0px; */
			border-radius: .5rem;
			border: 1px solid #ffc08f;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
		.card-plus{
			height: 140px;
			background: #fff7f1;
			/* border: 0px; */
			border-radius: .5rem;
			border: 1px solid #ffc08f;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
		.card-patrocinador{
			height: 280px;
			background: #d3d3d3;
			/* border: 0px; */
			border-radius: .5rem;
			border: 3px solid #ffffff;
			background: #e1e1e1;
			box-shadow: 5px 3px 5px 0px rgb(189 148 90 / 37%);
			border: 1px solid white;
		}
		.item-slider{
			height: 80vh;
			/*border: 1px dotted red;*/
			background-size: cover;
			background-position: center center;
			background-repeat: no-repeat;
		}
		.image-fix-blur{
			z-index: -1;
			position: fixed;
			left: 0;
			width: 100%;
			height: 100%;
			filter: blur(12px);
			-webkit-filter: blur(12px);            
			/*background-image: url('../images/logo-evento.jpeg');*/
			background-position: center center;
			background-size: cover;
			background-repeat: no-repeat;	
		}
		/*.image-fix-blur:before{*/
		/*	content: '';*/
		/*	position: absolute;*/
		/*	top: 0;*/
		/*	left: 0;*/
		/*	width: 100%;*/
		/*	height: 100%;*/
		/*	background-color: rgb(0 0 0 / 75%);*/
		/*}*/

		.image-fix-blur-SP{
			position: absolute;
			z-index: -1;
			bottom: -10%;
			top: -10%;
			left: -10%;
			right: -10%;
			filter: blur(24px);
			background-size: cover;
			/* background-repeat: repeat-y; */
		}
		.bg_slider{
			height: 60vh;
			/*background-image: url('http://localhost/ja-feston/dev-ci4/public/files-upload/tango-001__banner__1701865528_Zo4E.jpg');*/
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center right;		
		}


		.grid-event-datas{}
		.grid-event-datas .data-itens{
			position: relative;
			border: 1px solid #ffa902;
			padding: 12px 6px;
			background-color: #ffa902;
			min-width: 112px;
			text-align: center;
			/*cursor: pointer;*/
			border-radius: 4px;
		}
		.grid-event-datas .data-itens:hover,
		.grid-event-datas .data-itens.active{
			border: 1px solid #ffa902;
			background-color: #ffa902;
		}
		/*.grid-event-datas .data-itens:hover:before,*/
		/*.grid-event-datas .data-itens.active:before{*/
		/*	content: '';*/
		/*	position: absolute;*/
		/*	top: 100%;*/
		/*	left: calc(50% - 15px);*/
		/*	border-left: 15px solid transparent;*/
		/*	border-right: 15px solid transparent;*/
		/*	border-top: 10px solid var(--highlight-color, #15c57d);		*/
		/*}*/

		.grid-event-datas .data-itens p{
			color: #FFFFFF;
			margin: 0;
			padding: 0;
		}
		.grid-event-datas .data-itens h3{
			color: #FFFFFF;
			margin: 0;
			padding: 0;
		}
		.grid-event-datas .data-itens h5{
			color: #FFFFFF;
			margin: 0;
			padding: 0;
		}
		.personal-image {
			text-align: center;
		}
		.personal-image input[type="file"] {
			display: none;
		}
		.personal-figure {
			position: relative;
			width: 90px;
			height: 90px;
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
			width: 85px;
			height: 85px;
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
		.card.card-workshops .tag-valor{
			/*position: absolute;*/
			/*bottom: -5px;*/
			/*right: 5px;*/
			background-color: #fff0;
			font-size: 1.25rem;
			color: #fff;
			padding: 4px;
			font-weight: bold;
			border-radius: 4px;	
			line-height: 1;
		}
		.card.card-workshops .tag-valor span{
			font-size: .7rem;
			margin-right: 4px;
		}




		.card.card-workshops .card-body .item-check{ 
			position: relative;
			margin-bottom: 1.0rem;
			background-color: #9cefa6;
			padding: .5rem 1rem;
			border-radius: 4px;	
			box-shadow: 1px 1px 4px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshops .card-body .item-check label{ display: block; font-size: .80rem; }
		.card.card-workshops .card-body .item-check label.data{ display: block; font-size: .70rem; }
		.card.card-workshops .card-body .item-check h4{ font-size: 0.85rem; font-weight: normal; }		



		.workshops-avatar-bg {
			width: 85px;
			height: 85px;
			box-sizing: border-box;
			border-radius: 100%;
			background-size: contain;
			background-position: center;
			border: 4px solid #FFFFFF;
			box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
			transition: all ease-in-out .3s;
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
	</style>

<?php $this->endSection('headers'); ?>


<?php $this->section('scripts'); ?>
	
	<style>
		.form-error{ display: none; }
	</style>

<?php $this->endSection('scripts'); ?>
