<?php 
	$this->extend('templates/template_default');
	$this->section('content'); 
?>
	<section class="pt-3 pb-4">
		<div class="container">
			<!-- <div class="row"> -->
			<!-- 	<div class="col-12 col-md-12"> -->
			<!-- 		<h3>Workshop > Clássicos na Atualidade</h3> -->
			<!-- 	</div> -->
			<!-- </div> -->
			<div class="row pt-3 pb-5">
				<div class="col-12 col-md-12">

					<FORM action="<?php echo(current_url()); ?>" method="post" name="formFieldsInscricao" id="formFieldsInscricao" ref="formFieldsInscricao" enctype="multipart/form-data">

					<div class="row">
						<div class="col-12 col-md-4 d-none">

							<div class="card card-workshop mb-3 h-100" style="border-radius: 8px !important;">
								<div class="card-header text-center" style="padding: 0 0 .5rem 0;">
									<img src="http://localhost/ja-feston/dev/public/files-upload/ballerina-dance-academy__banner__1701865173_2fMu.jpg" class="img-fluid-evento img-fluid" style="border-radius: .25rem; border-bottom-left-radius: 0; border-bottom-right-radius: 0;" />
								</div>
								<div class="card-body text-center">
									<div class="apresent-item pb-3">
										<h2 class="m-0" style="font-size: 1.5rem; color: #FFF; font-weight: 600;">Amor Eterno</h2>
										<h4 style="font-size: 1.0rem; color: #FFF; font-weight: 400;">Casa Ribanta de Dança</h4>
									</div>
									<div class="apresent-item pt-2 pb-3">
										<label>Coreógrafo</label>
										<h4>Nome do Coreógrafo</h4>
									</div>
									<div class="apresent-item pt-2 pb-3 d-none">
										<label>Formato</label>
										<h4>DUO</h4>
									</div>
									<div class="work-item pt-2 pb-3">
										<label>Formato</label>
										<h4>GRUPO</h4>
									</div>

									<div class="work-item pt-2 pb-3 d-none">
										<label>Bailarinos</label>
										<div class="d-flex justify-content-center">
											<div style="margin: 0 4px;"> 
												<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-04.jpg'); width: 60px; height: 60px;"></div>
											</div>
											<div style="margin: 0 4px;">
												<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 60px; height: 60px;"></div>
											</div>
										</div>
									</div>

									<div class="work-item pt-2 pb-3">
										<label>Modalidade</label>
										<h4>Dança Contemporânea</h4>
									</div>

									<div class="work-item pt-2 pb-2">
										<label>Categoria</label>
										<h4>Adulto</h4>
									</div>
								</div>
							</div>

						</div>
						<div class="col-12 col-md-12">

							<div class="card card-workshops mb-4">
								<div class="card-body p-0">
									<div class="item" style="background-color: #9b9b9b;">
										<div class="row justify-content-center align-items-center">
											<div class="col-12 text-center">
												<h2 style="color: white;">Apresentações</h2>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card card-default mb-4 h-100" style="padding: 24px !important;">
								<div class="card-body p-0">

									<div class="apresentGroup mb-2" style="height: auto !important; opacity: .5;">
										<div class="row align-items-center">
											<div class="col-12 col-md-auto col-number ">
												<div class="number">101</div>
											</div>
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>
															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												<!-- <div><h5>Bailarinos</h5></div> -->
												<div>
													<div class="d-flex justify-content-start align-items-center gap:3">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentGroup mb-2" style="height: auto !important; opacity: .5;">
										<div class="row align-items-center">
											<div class="col-12 col-md-auto col-number ">
												<div class="number">102</div>
											</div>
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>
															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												<!-- <div><h5>Bailarinos</h5></div> -->
												<div>
													<div class="d-flex justify-content-start align-items-center gap:3">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentGroup active mb-2" style="height: auto !important;">
										<div class="row ">
											<div class="col-12 col-md-auto col-number align-self-center">
												<div class="number">103</div>
											</div>
											<div class="col ">
												<div class="work-item pb-3 text-center">
													<h2 class="m-0" style="font-size: 1.5rem; color: #000; font-weight: 600;">Amor Eterno | Casa Ribanta de Dança</h2>
												</div>
												<div class="d-flex justify-content-around" style="gap: 50px">
													<div class="work-item pb-3">
														<div class="d-flex">
															<!-- <div> -->
															<!-- 	<div style="margin: 0 4px;">  -->
															<!-- 		<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div> -->
															<!-- 	</div> -->
															<!-- </div> -->
															<div>
																<label style="font-size: 0.8rem;">Coreógrafos</label>
																<h4 style="color: #000;">Nome do Coreógrafo</h4>
																<h4 style="color: #000;">Nome do Coreógrafo</h4>
															</div>
														</div>
													</div>
													<div class="work-item pb-3">
														<label style="font-size: 0.8rem;">Formato</label>
														<h4 style="color: #000;">DUO</h4>
													</div>
													<div class="work-item pb-3">
														<label style="font-size: 0.8rem;">Modalidade</label>
														<h4 style="color: #000;">Dança Contemporânea</h4>
													</div>
													<div class="work-item pb-2">
														<label style="font-size: 0.8rem;">Categoria</label>
														<h4 style="color: #000;">Adulto</h4>
													</div>
												</div>

											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												<div style="font-size: 1.3rem;">Bailarinos</div>
												<div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" bstyle="margin: 0 4px; ">
															Ana Paula Cardoso Santos Silva
														</div>
													</div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Luiza Florense Vieira
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentGroup mb-2" style="height: auto !important; opacity: .5;">
										<div class="row align-items-center">
											<div class="col-12 col-md-auto col-number ">
												<div class="number">104</div>
											</div>
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>
															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												<!-- <div><h5>Bailarinos</h5></div> -->
												<div>
													<div class="d-flex justify-content-start align-items-center gap:3">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentGroup mb-2" style="height: auto !important; opacity: .5;">
										<div class="row align-items-center">
											<div class="col-12 col-md-auto col-number ">
												<div class="number">105</div>
											</div>
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>
															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												<!-- <div><h5>Bailarinos</h5></div> -->
												<div>
													<div class="d-flex justify-content-start align-items-center gap:3">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentGroup mb-2" style="height: auto !important; opacity: .5;">
										<div class="row align-items-center">
											<div class="col-12 col-md-auto col-number ">
												<div class="number">106</div>
											</div>
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>
															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												<!-- <div><h5>Bailarinos</h5></div> -->
												<div>
													<div class="d-flex justify-content-start align-items-center gap:3">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="apresentGroup mb-2" style="height: auto !important; opacity: .5;">
										<div class="row align-items-center">
											<div class="col-12 col-md-auto col-number ">
												<div class="number">107</div>
											</div>
											<div class="col">
												<div class="row align-items-center">
													<div class="col-12 col-md-4 ">
														<div class="apresent-item text-start">
															<h2>Amor Eterno</h2>
															<h3>Casa Ribanta de Dança</h3>
														</div>
													</div>
													<div class="col-12 col-md-8 ">
														<div class="d-flex justify-content-around">
															<div class="apresent-item">
																<label>Coreógrafo</label>
																<h4>Nome do Coreógrafo</h4>

															</div>
															<div class="apresent-item">
																<label>Formato</label>
																<h4>DUO</h4>
															</div>
															<div class="apresent-item">
																<label>Modalidade</label>
																<h4>Dança Contemporânea</h4>
															</div>
															<div class="apresent-item">
																<label>Categoria</label>
																<h4>Adulto</h4>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-3" style="border-left: 1px dashed black;">
												<!-- <div><h5>Bailarinos</h5></div> -->
												<div>
													<div class="d-flex justify-content-start align-items-center gap:3">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
													</div>
												</div>
											</div>
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
													$includeInscricao = view('workshops/form-inscricao', []);
													echo( $includeInscricao );
												?>
											</div>

											<!-- Step 3 -->
											<div class="h-100" v-show="step == 3" >
												<?php 
													$includeCobranca = view('workshops/cobranca', []);
													echo( $includeCobranca );
												?>
											</div>

											<!-- Step 4 -->
											<div class="h-100" v-show="step == 4" >
												<?php 
													$includeConfirmacao = view('workshops/confirmacao', []);
													echo( $includeConfirmacao );
												?>
											</div>

										</div>
									</div>
		
								</div>
							</div>

						</div>
					</div>



					<div class="card card-workshops mt-5 d-none" >
						<div class="card-body p-0">
							<div class="item" style="background-color: #9b9b9b;">
								<div class="row justify-content-center align-items-center">
									<div class="col-12 text-center">
										<h2 style="color: white;">Indicações e Premiações Especiais</h2>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-0 mb-5 d-none">
						<div class="col-12 col-md-4">

							<div class="card card-default mb-4 h-100 " style="padding: 25px 20px !important;">
								<div class="card-body p-0">

									<div class="row justify-content-center">
										<div class="col-11 col-md-12">

											<div class="row mb-3">
												<div class="col-12 col-md-12">
													<h3>Coreógrafos</h3>	
												</div>
											</div>
											<div class="row">
												<div class="col-12 col-md-6">

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" bstyle="margin: 0 4px; ">
															Ana Paula Cardoso Santos Silva
														</div>
													</div>

												</div>
												<div class="col-12 col-md-6">

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Luiza Florense Vieira
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
		
								</div>
							</div>

						</div>
						<div class="col-12 col-md-8">

							<div class="card card-default mb-4 h-100" style="padding: 25px 20px !important;">
								<div class="card-body p-0">

									<div class="row justify-content-center">
										<div class="col-11 col-md-12">

											<div class="row mb-3">
												<div class="col-12 col-md-12">
													<h3>Bailarinos</h3>	
												</div>
											</div>
											<div class="row">
												<div class="col-12 col-md-4">

													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_premiacoes"><div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" bstyle="margin: 0 4px; ">
															Ana Paula Cardoso Santos Silva
														</div>
													</div></a>

													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_premiacoes"><div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Luiza Florense Vieira
														</div>
													</div></a>

													<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal_premiacoes"><div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-04.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Rômulo Gregório de Brito
														</div>
													</div></a>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Glória Cantidio Siqueira
														</div>
													</div>

												</div>
												<div class="col-12 col-md-4">

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Ana Paula Cardoso
														</div>
													</div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Luiza Florense Vieira
														</div>
													</div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-04.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Rômulo Gregório de Brito
														</div>
													</div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-04.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Etefano Silva Xavier
														</div>
													</div>

												</div>
												<div class="col-12 col-md-4">

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Ana Paula Cardoso
														</div>
													</div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-05.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Luiza Florense Vieira
														</div>
													</div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-04.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Rômulo Gregório de Brito
														</div>
													</div>

													<div class="d-flex justify-content-start align-items-center mb-1">
														<div style="margin: 0 4px;"> 
															<div class="workshops-avatar-bg" style="background-image: url('assets/media/avatar-11.jpg'); width: 45px; height: 45px;"></div>
														</div>
														<div class="nomebailarino" style="margin: 0 4px;">
															Ana Paula Cardoso
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

					<div class="row justify-content-center pt-4 d-none">
						<div class="col-12 col-md-4">
							<div class="d-grid">
								<a href="javascript:;" class="btn btn-lg btn-warning d-flex justify-content-center" style="background-color: #5e5e5e; border-color: #5e5e5e; color: #FFFFFF;">
									<div class="mic"><i class="fas fa-microphone"></i></div>
									<div>GRAVAR JUSTIFICATIVA</div>
								</a>
							</div>
						</div>
						<div class="col-12 col-md-1"></div>
						<div class="col-12 col-md-4">
							<div class="d-grid">
								<a href="javascript:;" class="btn btn-lg btn-warning">FINALIZAR AVALIAÇÃO</a>
							</div>
						</div>
					</div>

					<div class="row justify-content-center pt-5">
						<div class="col-12 col-md-12">
							<div class="d-flex justify-content-center align-items-center d-order-exibicao">
								<div class="oxItem"><i class="fas fa-angle-double-left"></i> Primeiro</div>
								<div class="oxItem"><i class="fas fa-angle-left"></i> Anterior</div>
								<div class="oxItem active">
									3
								</div>
								<div class="oxItem">Próximo <i class="fas fa-angle-right"></i></div>
								<div class="oxItem">Último <i class="fas fa-angle-double-right"></i></div>
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
		.apresentGroup{
			padding: 10px 16px;
			background-color: #dddddb;
			height: 50px;
			border-radius: 4px;
			color: black;	
			height: 100%;
			width: 100%;
		}
		.apresentGroup.active{
			padding: 16px;
			background-color: #fea802;
			height: 50px;
			border-radius: 4px;
			color: white;	
			height: 100%;
			width: 100%;
		}
		.apresentGroup .apresent-item { position: relative; }
		.apresentGroup .apresent-item:before {
			display: none;
			content: '';
			position: absolute;
			bottom: 4px;
			left: calc(50% - 60px);
			/* border-bottom: 1px solid white; */
			width: 120px;
			/* margin: 0 auto; */
			border-bottom: 1px solid;
			border-image-slice: 1;
			border-width: 1px;
			border-image-source: linear-gradient(to left, rgb(255 255 255 / 0%), rgb(255 255 255), rgb(255 255 255 / 0%));
		}
		.col-number{ width: 80px; }
		.apresentGroup .number{ font-size: 2rem; color: #a4a4a4; font-weight: 600; margin: 0; }
		.apresentGroup .apresent-item h2 { font-size: 1.3rem; color: #a4a4a4; font-weight: 600; margin: 0; }
		.apresentGroup .apresent-item h3 { font-size: 1rem; color: #a4a4a4; font-weight: 400; margin: 0; }
		.apresentGroup .apresent-item label { font-size: 0.7rem; color: #a4a4a4; }
		.apresentGroup .apresent-item h4 { line-height: 1; font-size: .9rem; font-weight: 400; margin: 0; color: #a4a4a4; }
		.apresentGroup h5 { line-height: 1; font-size: .9rem; margin: 0; margin-bottom: 4px; color: #a4a4a4; }
		.apresentGroup.active .col-number{ width: 100px; }
		.apresentGroup.active .number{ font-size: 2.4rem; color: #000; font-weight: 600; margin: 0; }


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

	<script type="text/javascript" src="assets/vue/utils.js?t=<?= $time ?>"></script>
	<script type="text/javascript" src="assets/vue/jurados.js?t=<?= $time ?>"></script>

<?php $this->endSection('scripts'); ?>