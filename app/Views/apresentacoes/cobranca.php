
<div class="content-step current justify-content-center align-items-center flex-column h-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-11 col-md-12">

				<div class="row mb-3">
					<div class="col-12 col-md-12">
						<h1>Cobrança</h1>	
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-8">
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
					<div class="col-12 col-md-4">
						<div class="card card-workshop">
							<div class="card-header text-center">
								<div class="workshops-avatar-bg" style="margin: 0 auto; background-image: url('assets/media/credit-card.png');"></div>
							</div>
							<div class="card-body text-center">
								
								<div class="work-item pb-2">
									<label style="color: #000;">código de referência</label>
									<h2 style="font-size: 1.5rem; color: #FFF; font-weight: 600;">REHYXD-0001</h2>
								</div>

								<div class="pt-2 pb-2">
									<label style="color: #000;">valor</label>
									<h3 style="font-size: 2rem; color: #FFF; font-weight: 600;">R$ 60,00</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="content-itens">

				</div>
				<div class="content-actions">
					<div class="row justify-content-end">
						<div class="col-12 col-md-4">
							<div class="d-grid">
								<a href="javascript:;" class="btn btn-primary" v-on:click="stepGravarGrupo(2)" >Continuar</a>
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
