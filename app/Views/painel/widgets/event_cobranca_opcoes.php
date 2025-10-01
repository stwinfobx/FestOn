<?php 
	$evcob_area_cobranca = ((isset($evcob_area_cobranca) ? $evcob_area_cobranca : "")); 
	$aFLD = '';

	if( $evcob_area_cobranca == "workshop" ){ 
		$aFLD = "work_"; 
		if( isset($rs_dados_evcob_work) ){
			$rs_dados_cob = $rs_dados_evcob_work;
		}
	}else{
		if( isset($rs_dados_evcob) ){
			$rs_dados_cob = $rs_dados_evcob;
		}
	}
?>
<div class="areaCobranca">

	<?php 
	$boxDadosCobrancaInfos = 'active';
	if( $evcob_area_cobranca == "workshop" ){ 
		$mesma_config = (isset($mesma_config) ? $mesma_config : "");
		$mesma_config = (int)(empty($mesma_config) ? '1' : $mesma_config);
		$boxDadosCobrancaInfos = '';
	?>
	<fieldset class="mb-4" style="padding: 15px; background-color: #f8f9fa !important;">
		<div class="row align-items-center">
			<div class="col-12 col-md-6 text-end">
				<span style="font-weight: bold;">Utilizar as mesmas configurações inseridas em Mostra Competitiva?</span>
			</div>
			<div class="col-12 col-md-6">
				<div class="d-flex" style="gap: 30px">
					<div class="form-check my-1" style="padding-left: 0 !important;">
						<div class="custom-control custom-radio">
							<input type="radio" name="mesma_config" id="mesma_config_s" class="custom-control-input changeMescaConfig" value="1" <?php echo($mesma_config == '1'? 'checked' : ''); ?> />
							<label class="custom-control-label m-0" for="mesma_config_s">Sim</label>
						</div>
					</div>
					<div class="form-check my-1" style="padding-left: 0 !important;">
						<div class="custom-control custom-radio">
							<input type="radio" name="mesma_config" id="mesma_config_n" class="custom-control-input changeMescaConfig" value="0" <?php echo($mesma_config == '0'? 'checked' : ''); ?> />
							<label class="custom-control-label m-0" for="mesma_config_n">Não</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
	<?php } ?>	

	<div class="boxDadosCobrancaInfos <?php echo($boxDadosCobrancaInfos); ?>">
		<div class="row">
			<div class="col-12 col-md-3">
				<div class="card card-base mb-3">
					<div class="card-header">
						Tipo de Cobrança
					</div>
					<div class="card-body">
						<input type="hidden" name="<?php echo($aFLD); ?>evcob_area_cobranca" id="<?php echo($aFLD); ?>evcob_area_cobranca" class="form-control" value="<?php echo($evcob_area_cobranca);?>" />
						
						<?php 
							$evcob_tipo_cobranca = ((isset($rs_dados_cob->evcob_tipo_cobranca) ? $rs_dados_cob->evcob_tipo_cobranca : "")); 
						?>
						<div class="form-group">
							<div>
								<?php 
									foreach ($listTipoCobranca as $keyFC => $valFC) {
										$label = $valFC['label'];
										$value = $valFC['value'];
										$checked = (($evcob_tipo_cobranca == $value) ? 'checked' : '');
								?>
								<div class="form-check my-1" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="radio" name="<?php echo($aFLD); ?>evcob_tipo_cobranca" id="<?php echo($aFLD); ?>evcob_tipo_cobranca_<?php echo($value)?>" class="custom-control-input changeTipoCobranca" value="<?php echo($value)?>" <?php echo($checked)?> />
										<label class="custom-control-label m-0" for="<?php echo($aFLD); ?>evcob_tipo_cobranca_<?php echo($value)?>"><?php echo($label)?></label>
									</div>
								</div>
								<?php 
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-9">

				<!-- Informações do titular -->
				<fieldset class="">
					<legend>Informações do titular</legend>

					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-label" for="evcob_titular">Titular da Conta</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_titular" id="<?php echo($aFLD); ?>evcob_titular" class="form-control" value="<?php echo((isset($rs_dados_cob->evcob_titular) ? $rs_dados_cob->evcob_titular : ""));?>" />
							</div>
						</div>
					</div>

					<?php 
						$evcob_tipo_cad = ((isset($rs_dados_cob->evcob_tipo_cad) ? $rs_dados_cob->evcob_tipo_cad : "")); 
					?>
					<div class="row">
						<div class="col-4 align-self-center">
							<div class="d-flex" style="gap: 30px">
								<div class="form-check my-1" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="radio" name="<?php echo($aFLD); ?>evcob_tipo_cad" id="<?php echo($aFLD); ?>evcob_tipocad_pf" class="custom-control-input changeTipoCad" value="PF" <?php echo($evcob_tipo_cad != 'PJ'? 'checked' : ''); ?> />
										<label class="custom-control-label m-0" for="<?php echo($aFLD); ?>evcob_tipocad_pf">P. Física</label>
									</div>
								</div>
								<div class="form-check my-1" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="radio" name="<?php echo($aFLD); ?>evcob_tipo_cad" id="<?php echo($aFLD); ?>evcob_tipo_cad_pj" class="custom-control-input changeTipoCad" value="PJ" <?php echo($evcob_tipo_cad == 'PJ'? 'checked' : ''); ?> />
										<label class="custom-control-label m-0" for="<?php echo($aFLD); ?>evcob_tipo_cad_pj">P. Jurídica</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-8">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label class="form-label" for="evcob_cpf">CPF do Titular</label>
										<input type="text" name="<?php echo($aFLD); ?>evcob_cpf" id="<?php echo($aFLD); ?>evcob_cpf" class="form-control mask-cpf evcob_cpf" value="<?php echo((isset($rs_dados_cob->evcob_cpf) ? $rs_dados_cob->evcob_cpf : ""));?>" <?php echo($evcob_tipo_cad != 'PJ'? '' : 'disabled'); ?> />
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label class="form-label" for="evcob_cnpj">CNPJ do Titular</label>
										<input type="text" name="<?php echo($aFLD); ?>evcob_cnpj" id="<?php echo($aFLD); ?>evcob_cnpj" class="form-control mask-cnpj evcob_cnpj" value="<?php echo((isset($rs_dados_cob->evcob_cnpj) ? $rs_dados_cob->evcob_cnpj : ""));?>" <?php echo($evcob_tipo_cad != 'PJ'? 'disabled' : ''); ?> />
									</div>
								</div>
							</div>

						</div>
					</div>
				</fieldset>

				<!-- Mercado Pago -->
				<?php 
					$evcob_credenciais_mp = ((isset($rs_dados_cob->evcob_credenciais_mp) ? $rs_dados_cob->evcob_credenciais_mp : "")); 
					$evcob_mp_json = json_decode($evcob_credenciais_mp);
					$mp_email = isset($evcob_mp_json->email) ? $evcob_mp_json->email : '';
					$mp_sandbox_key = isset($evcob_mp_json->sandbox_key) ? $evcob_mp_json->sandbox_key : '';
					$mp_sandbox_token = isset($evcob_mp_json->sandbox_token) ? $evcob_mp_json->sandbox_token : '';
					$mp_app_key = isset($evcob_mp_json->app_key) ? $evcob_mp_json->app_key : '';
					$mp_app_token = isset($evcob_mp_json->app_token) ? $evcob_mp_json->app_token : '';

					$evcob_config_mp = ((isset($rs_dados_cob->evcob_config_mp) ? $rs_dados_cob->evcob_config_mp : "")); 
					$evcob_cfg_mp_json = json_decode($evcob_config_mp);

					$mp_parcelas = (int)isset($evcob_cfg_mp_json->parcelas) ? $evcob_cfg_mp_json->parcelas : '';
					$mp_prazo_boleto = (int)isset($evcob_cfg_mp_json->prazo_boleto) ? $evcob_cfg_mp_json->prazo_boleto : '';
					$mp_metodos = isset($evcob_cfg_mp_json->metodos) ? $evcob_cfg_mp_json->metodos : [];
					//print_r( $mp_metodos );
				?>
				<fieldset id="boxCobr_mercado_pago" class="mt-4 boxFieldCobr <?php echo($evcob_tipo_cobranca == "mercado_pago" ? 'active' : '') ?>">
					<legend>Mercado Pago</legend>
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="evcob_chave_pix">E-mail</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_credenciais_mp[email]" id="<?php echo($aFLD); ?>evcob_credenciais_mp_email" class="form-control" value="<?php echo($mp_email); ?>" />
							</div>
						</div>
					</div>

					<div class="row pt-4">
						<div class="col-12">
							<strong>CREDENCIAIS DE PRODUÇÃO</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="form-label" for="evcob_chave_pix">Public Key</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_credenciais_mp[app_key]" id="<?php echo($aFLD); ?>evcob_credenciais_mp_app_key" class="form-control" value="<?php echo($mp_app_key); ?>" />
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label" for="evcob_chave_pix">Access Token</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_credenciais_mp[app_token]" id="<?php echo($aFLD); ?>evcob_credenciais_mp_app_token" class="form-control" value="<?php echo($mp_app_token); ?>" />
							</div>
						</div>
					</div>

					<div class="row pt-4">
						<div class="col-12">
							<strong>CREDENCIAIS DE TESTE</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="form-label" for="evcob_chave_pix">Public Key</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_credenciais_mp[sandbox_key]" id="<?php echo($aFLD); ?>evcob_credenciais_mp_sandbox_key" class="form-control" value="<?php echo($mp_sandbox_key);?>" />
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label" for="evcob_chave_pix">Access Token</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_credenciais_mp[sandbox_token]" id="<?php echo($aFLD); ?>evcob_credenciais_mp_sandbox_token" class="form-control" value="<?php echo($mp_sandbox_token);?>" />
							</div>
						</div>
					</div>

					<div class="row pt-4">
						<div class="col-12">
							<strong>CONFIGURAÇÕES</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<?php
							$limite_parcelas = 12;
							?>
							<div class="form-group">
								<label class="form-label" for="evcob_config_mp_parcelas">Limite de Parcelas</label>
								<select class="form-select" name="<?php echo($aFLD); ?>evcob_config_mp[parcelas]" id="<?php echo($aFLD); ?>evcob_config_mp_parcelas">
									<?php for ($xParc = 1; $xParc <= $limite_parcelas; $xParc++) {
                                        $selected = $mp_parcelas === $xParc ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $xParc; ?>" <?php echo $selected; ?> translate="no"><?php echo $xParc; ?></option>
                                    <?php } ?>
								</select>
							</div>
						</div>
						<div class="col-3">
							<?php
							$prazo_boletos = [
								"5" => '05 dias' ,
								"8" => '08 dias',
								"10" => '10 dias',
								"15" => '15 dias',
								"20" => '20 dias',
								"30" => '30 dias',
							];
							?>
							<div class="form-group">
								<label class="form-label" for="evcob_config_mp_prazo_boleto">Prazo pagto do boleto</label>
								<select class="form-select" name="<?php echo($aFLD); ?>evcob_config_mp[prazo_boleto]" id="<?php echo($aFLD); ?>evcob_config_mp_prazo_boleto">
								<?php
								foreach ($prazo_boletos as $keyPB => $valPB) {
									$selected = (($mp_prazo_boleto == $keyPB) ? 'selected' : '');
								?>
									<option value="<?php echo($keyPB); ?>" <?php echo($selected); ?> translate="no"><?php echo($valPB); ?></option>
								<?php
								}
								?>
								</select>
							</div>
						</div>
						<div class="col-12">
							<?php
							$metodos = [
								"bank_transfer" => "PIX",
								//"atm" => "Auto Atendimento",
								"credit_card" => "Cartão de Crédito",
								"debit_card" => "Débito",
								"ticket" => "Boleto",
							];
							?>
							<div class="form-group">
								<label class="form-label" for="evcob_chave_pix">Métodos de pagamentos aceitos</label>
								<div class="d-flex" style="gap: 20px">
								<?php
								foreach ($metodos as $keyMT => $valMT) {
									$checked = (in_array($keyMT, $mp_metodos) ? "checked" : "");
								?>
									<div class="">
										<div class="form-check" style="padding-left: 0 !important;">
											<div class="custom-control custom-radio">
												<input type="checkbox" name="<?php echo($aFLD); ?>evcob_config_mp[metodos][]" id="<?php echo($aFLD); ?>evcob_config_mp_metodos_<?php echo($keyMT)?>" class="custom-control-input" value="<?php echo($keyMT)?>" <?php echo($checked)?> />
												<label class="custom-control-label" for="evcob_config_mp_metodos_<?php echo($keyMT)?>"><?php echo($valMT)?></label>
											</div>
										</div>
									</div>
								<?php
								}
								?>
								</div>
							</div>
						</div>
					</div>
				</fieldset>


				<!-- Depósito em conta -->
				<fieldset id="boxCobr_deposito_conta" class="mt-4 boxFieldCobr <?php echo($evcob_tipo_cobranca == "deposito_conta" ? 'active' : '') ?>">
					<legend>Depósito em conta</legend>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-label" for="evcob_banco">Banco</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_banco" id="<?php echo($aFLD); ?>evcob_banco" class="form-control" value="<?php echo((isset($rs_dados_cob->evcob_banco) ? $rs_dados_cob->evcob_banco : ""));?>" />
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-label" for="evcob_agencia">Agência</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_agencia" id="<?php echo($aFLD); ?>evcob_agencia" class="form-control" value="<?php echo((isset($rs_dados_cob->evcob_agencia) ? $rs_dados_cob->evcob_agencia : ""));?>" />
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="form-label" for="evcob_conta_num">Conta Corrente</label>
								<input type="text" name="<?php echo($aFLD); ?>evcob_conta_num" id="<?php echo($aFLD); ?>evcob_conta_num" class="form-control" value="<?php echo((isset($rs_dados_cob->evcob_conta_num) ? $rs_dados_cob->evcob_conta_num : ""));?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<label class="form-label" for="evcob_informacoes">Outras informações bancárias</label>
								<textarea type="text" name="<?php echo($aFLD); ?>evcob_informacoes" id="<?php echo($aFLD); ?>evcob_informacoes" class="form-control" style="height: 100px !important;"><?php echo((isset($rs_dados_cob->evcob_informacoes) ? $rs_dados_cob->evcob_informacoes : ""));?></textarea>
							</div>
						</div>
					</div>
				</fieldset>


				<!-- Informações para doações -->
				<fieldset id="boxCobr_doacao" class="mt-4 boxFieldCobr doacao <?php echo($evcob_tipo_cobranca == "doacao" ? 'active' : '') ?>">
					<legend>Informações para doações</legend>
					<div class="row">
						<div class="col-12 col-md-12">
							<div class="form-group">
								<textarea type="text" name="<?php echo($aFLD); ?>evcob_info_doacao" id="<?php echo($aFLD); ?>evcob_info_doacao" class="form-control" style="height: 150px !important;"><?php echo((isset($rs_dados_cob->evcob_info_doacao) ? $rs_dados_cob->evcob_info_doacao : ""));?></textarea>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
	</div>
	
</div>


<?php $this->section('scripts'); ?>

	<script>
	</script>

<?php $this->endSection('scripts'); ?>