
<div class="content-step current justify-content-center align-items-center flex-column h-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-11 col-md-12">

				<div class="row mb-3">
					<div class="col-12 col-md-12">
						<h1>Inscrição Confirmada</h1>	
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-4 d-none">
						<!-- remover esta coluna -->
						<div class="card card-workshop d-none">
							<div class="card-header text-center">
								<div class="workshops-avatar-bg" style="margin: 0 auto; background-image: url('assets/media/avatar-04.jpg');"></div>
							</div>
							<div class="card-body text-center">
								
								<div class="work-item pb-2">
									<h2 class="mb-1" style="font-size: 1.5rem; color: #FFF; font-weight: 600;">Jefferson Prodit</h2>
									<h4 class="mb-1" style="font-size: 1.0rem; color: 000; font-weight: 600;">Clássicos na Atualidade</h4>
								</div>
								
								<div style="padding: 1rem;">
									<div class="mb-3 pb-2 text-start bd-separar-left">
										<label style="font-size: .8rem; font-size: 0.8rem; display: block;">data e horário</label>
										<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">01.07.2024 11h30</p>
									</div>
									<div class="pb-2 text-start bd-separar-left">
										<label style="font-size: .8rem; font-size: 0.8rem; display: block;">local</label>
										<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">Rio de Janeiro</p>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="mb-3 pb-2 text-start bd-separar-left">
							<label style="font-size: .8rem; font-size: 0.8rem; display: block;">nome completo</label>
							<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">Verônica Trindade de Souza</p>
						</div>
						<div class="mb-3 pb-2 text-start bd-separar-left">
							<label style="font-size: .8rem; font-size: 0.8rem; display: block;">e-mail</label>
							<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">veronica-trindade@hotmail.com</p>
						</div>
						<div class="mb-3 pb-2 text-start bd-separar-left">
							<label style="font-size: .8rem; font-size: 0.8rem; display: block;">telefone</label>
							<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">(21) 98764-0111</p>
						</div>

						<div style="background-color: #e2e2e2; padding: 1rem; border-radius: 8px; margin-top: 50px !important;">
							<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">INFORMAÇÕES SOBRE O PAGAMENTO</p>
							<div class="d-flex flex-column mt-3">
								<div class="d-flex justify-content-between">
									<div class="mb-3 pb-2 text-start bd-separar-left">
										<label style="font-size: .8rem; font-size: 0.8rem; display: block;">status</label>
										<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">PROCESSANDO PAGAMENTO</p>
									</div>
									<div class="mb-3 pb-2 text-start bd-separar-left">
										<h2 style="font-size: 1.5rem; font-weight: 600; color: #000;">R$ 60,00</h2>
									</div>
								</div>
								<div>
									<p>Seu pagamento está em processamento, o que pode levar entre 10 e 30 minutos. Após esse período, acesse sua área reservada ou clique no botão abaixo para verificar o status do pagamento.</p>
								</div>
								<div>
									<a href="" class="bt btn-sm btn-primary">Área do Participante</a>
								</div>
							</div>
						</div>
						
						<div style="background-color: #e2e2e2; padding: 1rem; border-radius: 8px; margin-top: 50px !important;">
							<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">INFORMAÇÕES SOBRE AS DOAÇÕES</p>
							<div class="d-flex flex-column mt-3">
								<div class="d-flex justify-content-between">
									<div class="mb-3 pb-2 text-start bd-separar-left">
										<label style="font-size: .8rem; font-size: 0.8rem; display: block;">informações para entrega</label>
										<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">PERÍODO</p>
									</div>
								</div>
								<div>
									<p>Seu pagamento está em processamento, o que pode levar entre 10 e 30 minutos. Após esse período, acesse sua área reservada ou clique no botão abaixo para verificar o status do pagamento.</p>
								</div>
								<div>
									<a href="" class="bt btn-sm btn-primary">Área do Participante</a>
								</div>
							</div>
						</div>						

						<div style="background-color: #e2e2e2; padding: 1rem; border-radius: 8px; margin-top: 20px !important;">
							<h3 style="color: #000">Agradecemos sua inscrição e estamos ansiosos para vê-lo(a) no workshop!</h3>
							<p>Se tiver alguma dúvida, entre em contato conosco pelo e-mail [E-mail de Contato] ou pelo telefone [Telefone de Contato].</p>
						</div>

					</div>
				</div>

				<div class="content-actions">
					<div class="row justify-content-end">
						<div class="col-12 col-md-4">
							<div class="d-grid">
								<a href="javascript:;" class="btn btn-primary" v-on:click="stepGravarGrupo(2)" >Voltar ao Início</a>
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
