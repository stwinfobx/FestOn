
<div class="content-step current justify-content-center align-items-center flex-column h-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-11 col-md-12">

				<div class="row mb-3">
					<div class="col-12 col-md-12">
						<h1>Pagamento</h1>	
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-8">
					
						<div class="d-none">
							<div class="mb-3 pb-2 text-start bd-separar-left">
								<label style="font-size: .8rem; font-size: 0.8rem; display: block;">workshop</label>
								<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">Clássicos na Atualidade</p>
							</div>

							<div class="mb-3 pb-2 text-start bd-separar-left">
								<label style="font-size: .8rem; font-size: 0.8rem; display: block;">professor</label>
								<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">Jefferson Prodit</p>
							</div>

							<div class="mb-3 pb-2 text-start bd-separar-left">
								<label style="font-size: .8rem; font-size: 0.8rem; display: block;">nome completo</label>
								<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">Verônica Trindade de Souza</p>
							</div>
							<div class="pt-3 text-start">
								<h3 style="font-size: 1.5rem; font-weight: 600; color: #000;">Por favor, efetue o pagamento via Mercado Pago</h3>
							</div>
						</div>
						
						<div class="card card-workshops-sidebar" style="">
							<div class="card-body p-0">
								<?php
								if( isset($rs_workshops)){
									foreach ($rs_workshops->getResult() as $row) {
										$curso_id = ($row->curso_id);
										$curso_hashkey = ($row->curso_hashkey);
										$curso_titulo = ($row->curso_titulo);
										$curso_nome_professor = ($row->curso_nome_professor);
										$curso_local = ($row->curso_local);
										$link_workshop = site_url('workshops');
								?>
								<div class="item-check">
									<div class="mr-close">
										<a href="javascript:;" v-on:click="removeWorkItem($event)" ><i class="far fa-times-circle"></i></a>
									</div>
									<div class="row g-3 justify-content-center align-items-center">
										<div class="col-12 col-md-auto">
											<div class="workshops-avatar" style="background-image: url('assets/media/avatar-04.jpg');"></div>
										</div>
										<div class="col-12 col-md">
											<h4><?php echo($curso_titulo); ?></h4>
											<label><?php echo($curso_nome_professor); ?></label>
											<label class="mt-2 data text-end">início em 01.07.2024</label>
										</div>
									</div>
									<div class="row g-3 justify-content-center align-items-center">
										<div class="col-12">
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
								<?php
									}
								}
								?>

							</div>
						</div>						
						
					</div>
					<div class="col-12 col-md-4">
						<div class="card card-workshop">
							<div class="card-header text-center">
								<div class="workshops-avatar-bg" style="margin: 0 auto; background-image: url('assets/media/credit-card.png');"></div>
							</div>
							<div class="card-body text-end" style="padding: 1.0rem;">
								
								<div class="work-item pb-2 d-none">
									<label style="color: #000;">código de referência</label>
									<h2 style="font-size: 1.5rem; color: #FFF; font-weight: 600;">REHYXD-0001</h2>
								</div>

								<div class="pt-2" style="line-height: 1;">
									<label style="color: #000;">Valor Total a Pagar</label>
									<h3 class="mb-1" style="font-size: 1.5rem; color: #FFF; font-weight: 600; text-decoration: line-through;">R$ 1.650,00</h3>
								</div>
								
								<div class="" style="line-height: 1;">
									<label style="color: #000;">Desconto</label>
									<h3 class="mb-1" style="font-size: 1.5rem; color: #FFF; font-weight: 600;">R$ 150,00</h3>
								</div>
								
								<div class="" style="line-height: 1;">
									<label style="color: #000;">Total com Desconto</label>
									<h3 class="mb-1" style="font-size: 2rem; color: #FFF; font-weight: 600;">R$ 1.500,00</h3>
								</div>								
							</div>
						</div>
						<div class="d-grid mt-2">
							<div class="form-group m-0">
								<div>
									<label class="form-label" for="crsit_nome">Tem cupom de desconto?</label>
									<div class="input-group cupom">
										<input type="text" name="cupom_codigo" id="cupom_codigo" placeholder="" aria-label="" aria-describedby="cupom_codigo" value="" autocomplete="off" class="form-control form-control-custom"> <span class="input-group-text input-group-custom"><a href="javascript:;" class="btn-cupom"><i class="fas fa-arrow-right"></i></a></span>
									</div>
									<div class="form-error"><small>{{ error.crsit_nome }}</small></div>
								</div>
							</div>
						</div>
						<div class="d-grid mt-2 ">
							<a href="javascript:;" class="btn btn-primary" style="border-radius: .25rem;">Efetuar Pagamento</a>
						</div>
					</div>
				</div>
				<div class="content-itens">
				
					<div class="row justify-content-center">
						<div class="col-12 col-md-10">	
						
							<div class="card card-workshop">
								<div class="card-body text-center">

									<div class="row justify-content-center align-items-center">
										<div class="col-12 col-md-4">
											<div class="workshops-avatar-bg" style="margin: 0 auto; background-image: url('assets/media/credit-card.png'); width: 120px; height: 120px;"></div>
										</div>
										<div class="col-12 col-md-8">
											<div class="work-item pb-2">
												<label style="color: #000;">código de referência</label>
												<h2 style="font-size: 1.5rem; color: #FFF; font-weight: 600;">REHYXD-0001</h2>
											</div>
											<div class="pt-2 pb-2">
												<label style="color: #000;">Valor Total a Pagar</label>
												<h3 style="font-size: 2rem; color: #FFF; font-weight: 600;">R$ 1.650,00</h3>
											</div>
										</div>
									</div>

								</div>
							</div>
							
						</div>
					</div>

				</div>
				<div class="content-actions">
					<div class="row justify-content-end">
						<div class="col-12 col-md-4">

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
		.btn-cupom {
			position: relative;
			color: #FFFFFF;
			background-color: #000000;
			background-color: #0d6efd;
			width: auto;
			padding: .75rem .75rem;
			border-radius: .375rem;
			text-decoration: none;
		}
		a.btn-cupom:hover {
			background-color: #0b5ed7;
			/*border-color: #0a58ca;*/
			color: #FFFFFF;
		}		
		/*.btn-cupom::before {*/
			/*position: relative;*/
			/*content: url(assets/svg/arrow-white-right.svg);*/
			/*position: absolute;*/
			/*top: 3px;*/
			/*left: 0;*/
			/*width: 100%;*/
			/* right: 0; */
			/*transition: all 0.5s;*/
			/*height: 100%;*/
			/*display: flex;*/
			/*align-items: center;*/
			/*justify-content: center;*/
		/*}*/
		.input-group.cupom .input-group-text {
			padding: 0 !important;
			background: #f8f9fa !important;
			background: #0d6efd !important;
			color: #000000 !important;
			font-size: .90rem !important;
			/* height: calc(2.3em + 0.75rem + 2px) !important; */
			border: 1.5px solid #5356FB30 !important;
			border: 1.5px solid #e79c32 !important;
			border: 1.5px solid #0d6efc !important;
			border-radius: 8px !important;
			border-top-left-radius: 0 !important;
			border-bottom-left-radius: 0 !important;			
		}
		.input-group.cupom .input-group-text:hover {
			background-color: #0b5ed7 !important;
		}
	</style>

<?php $this->endSection('headers'); ?>



<?php $this->section('scripts'); ?>
	
	<style>
		.form-error{ display: none; }

		.bd-separar-left{
			position: relative;	
		}
		.bd-separar-left:before{
			content: '';
			position: absolute;
			bottom: 0px;
			left: 0;
			/*border-bottom: 1px solid white;*/
			width: 60%;
			/* margin: 0 auto; */
			border-bottom: 1px solid;
			border-image-slice: 1;
			border-width: 1px;
			border-image-source: linear-gradient(to left, rgb(255 255 255 / 0%), rgb(238 158 2), rgb(251 166 2));
		}
	</style>

<?php $this->endSection('scripts'); ?>
