										

<div class="row ">
	<div class="col-12 col-md-3">
		<div class="card card-base mb-3">
			<div class="card-header">
				Tipo de Cobrança
			</div>
			<div class="card-body">
				<div class="form-group">
					<div>
						<div class="form-check my-1" style="padding-left: 0 !important;">
							<div class="custom-control custom-radio">
								<input type="radio" name="evcob_tipo_cobranca" id="evcob_tipo_cobranca_deposito_conta" class="custom-control-input changeTipoCobranca" value="deposito_conta">
								<label class="custom-control-label m-0" for="evcob_tipo_cobranca_deposito_conta">Depósito em conta</label>
							</div>
						</div>
						<div class="form-check my-1" style="padding-left: 0 !important;">
							<div class="custom-control custom-radio">
								<input type="radio" name="evcob_tipo_cobranca" id="evcob_tipo_cobranca_mercado_pago" class="custom-control-input changeTipoCobranca" value="mercado_pago" checked="">
								<label class="custom-control-label m-0" for="evcob_tipo_cobranca_mercado_pago">Mercado Pago</label>
							</div>
						</div>
						<div class="form-check my-1" style="padding-left: 0 !important;">
							<div class="custom-control custom-radio">
								<input type="radio" name="evcob_tipo_cobranca" id="evcob_tipo_cobranca_doacao" class="custom-control-input changeTipoCobranca" value="doacao">
								<label class="custom-control-label m-0" for="evcob_tipo_cobranca_doacao">Doação</label>
							</div>
						</div>
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
						<input type="text" name="evcob_titular" id="evcob_titular" class="form-control" value="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4 align-self-center">
					<div class="d-flex" style="gap: 30px">
						<div class="form-check my-1" style="padding-left: 0 !important;">
							<div class="custom-control custom-radio">
								<input type="radio" name="evcob_tipo_cad" id="evcob_tipocad_pf" class="custom-control-input changeTipoCad" value="PF">
								<label class="custom-control-label m-0" for="evcob_tipo_cad_pf">P. Física</label>
							</div>
						</div>
						<div class="form-check my-1" style="padding-left: 0 !important;">
							<div class="custom-control custom-radio">
								<input type="radio" name="evcob_tipo_cad" id="evcob_tipo_cad_pj" class="custom-control-input changeTipoCad" value="PJ" checked="">
								<label class="custom-control-label m-0" for="evcob_tipo_cad_pj">P. Jurídica</label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-8">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="form-label" for="evcob_cpf">CPF do Titular</label>
								<input type="text" name="evcob_cpf" id="evcob_cpf" class="form-control mask-cpf" value="" disabled="" placeholder="___.___.___-__" maxlength="14">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label class="form-label" for="evcob_cnpj">CNPJ do Titular</label>
								<input type="text" name="evcob_cnpj" id="evcob_cnpj" class="form-control mask-cnpj" value="" placeholder="__.___.___/____-__" maxlength="18">
							</div>
						</div>
					</div>

				</div>
			</div>
		</fieldset>

		<!-- Mercado Pago -->
		<fieldset id="boxCobr_mercado_pago" class="mt-4 boxFieldCobr active">
			<legend>Mercado Pago</legend>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<label class="form-label" for="evcob_chave_pix">E-mail</label>
						<input type="text" name="evcob_credenciais_mp[email]" id="evcob_credenciais_mp_email" class="form-control" value="">
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
						<input type="text" name="evcob_credenciais_mp[app_key]" id="evcob_credenciais_mp_app_key" class="form-control" value="">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label class="form-label" for="evcob_chave_pix">Access Token</label>
						<input type="text" name="evcob_credenciais_mp[app_token]" id="evcob_credenciais_mp_app_token" class="form-control" value="">
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
						<input type="text" name="evcob_credenciais_mp[sandbox_key]" id="evcob_credenciais_mp_sandbox_key" class="form-control" value="">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label class="form-label" for="evcob_chave_pix">Access Token</label>
						<input type="text" name="evcob_credenciais_mp[sandbox_token]" id="evcob_credenciais_mp_sandbox_token" class="form-control" value="">
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
																				<div class="form-group">
						<label class="form-label" for="evcob_config_mp_parcelas">Limite de Parcelas</label>
						<select class="form-select" name="evcob_config_mp[parcelas]" id="evcob_config_mp_parcelas">
																									<option value="1" translate="no">1</option>
																									<option value="2" translate="no">2</option>
																									<option value="3" translate="no">3</option>
																									<option value="4" translate="no">4</option>
																									<option value="5" selected="" translate="no">5</option>
																									<option value="6" translate="no">6</option>
																									<option value="7" translate="no">7</option>
																									<option value="8" translate="no">8</option>
																									<option value="9" translate="no">9</option>
																									<option value="10" translate="no">10</option>
																									<option value="11" translate="no">11</option>
																									<option value="12" translate="no">12</option>
																							</select>
					</div>
				</div>
				<div class="col-3">
																				<div class="form-group">
						<label class="form-label" for="evcob_config_mp_prazo_boleto">Prazo pagto do boleto</label>
						<select class="form-select" name="evcob_config_mp[prazo_boleto]" id="evcob_config_mp_prazo_boleto">
																							<option value="5" translate="no">05 dias</option>
																							<option value="8" translate="no">08 dias</option>
																							<option value="10" translate="no">10 dias</option>
																							<option value="15" translate="no">15 dias</option>
																							<option value="20" translate="no">20 dias</option>
																							<option value="30" selected="" translate="no">30 dias</option>
																						</select>
					</div>
				</div>
				<div class="col-12">
																				<div class="form-group">
						<label class="form-label" for="evcob_chave_pix">Métodos de pagamentos aceitos</label>
						<div class="d-flex" style="gap: 20px">
																							<div class="">
								<div class="form-check" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="checkbox" name="evcob_config_mp[metodos][]" id="evcob_config_mp_metodos_bank_transfer" class="custom-control-input" value="bank_transfer" checked="">
										<label class="custom-control-label" for="evcob_config_mp_metodos_bank_transfer">PIX</label>
									</div>
								</div>
							</div>
																							<div class="">
								<div class="form-check" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="checkbox" name="evcob_config_mp[metodos][]" id="evcob_config_mp_metodos_credit_card" class="custom-control-input" value="credit_card" checked="">
										<label class="custom-control-label" for="evcob_config_mp_metodos_credit_card">Cartão de Crédito</label>
									</div>
								</div>
							</div>
																							<div class="">
								<div class="form-check" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="checkbox" name="evcob_config_mp[metodos][]" id="evcob_config_mp_metodos_debit_card" class="custom-control-input" value="debit_card" checked="">
										<label class="custom-control-label" for="evcob_config_mp_metodos_debit_card">Débito</label>
									</div>
								</div>
							</div>
																							<div class="">
								<div class="form-check" style="padding-left: 0 !important;">
									<div class="custom-control custom-radio">
										<input type="checkbox" name="evcob_config_mp[metodos][]" id="evcob_config_mp_metodos_ticket" class="custom-control-input" value="ticket" checked="">
										<label class="custom-control-label" for="evcob_config_mp_metodos_ticket">Boleto</label>
									</div>
								</div>
							</div>
																						</div>
					</div>
				</div>
			</div>


		</fieldset>


		<!-- Depósito em conta -->
		<fieldset id="boxCobr_deposito_conta" class="mt-4 boxFieldCobr ">
			<legend>Depósito em conta</legend>
			<div class="row">
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label class="form-label" for="evcob_banco">Banco</label>
						<input type="text" name="evcob_banco" id="evcob_banco" class="form-control" value="0183">
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label class="form-label" for="evcob_agencia">Agência</label>
						<input type="text" name="evcob_agencia" id="evcob_agencia" class="form-control" value="047">
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="form-group">
						<label class="form-label" for="evcob_conta_num">Conta Corrente</label>
						<input type="text" name="evcob_conta_num" id="evcob_conta_num" class="form-control" value="12345-6">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-12">
					<div class="form-group">
						<label class="form-label" for="evcob_informacoes">Outras informações bancárias</label>
						<textarea type="text" name="evcob_informacoes" id="evcob_informacoes" class="form-control" style="height: 100px !important;">Banco digital para investimento na Suiça para Nubbs</textarea>
					</div>
				</div>
			</div>
		</fieldset>


		<!-- Informações para doações -->
		<fieldset id="boxCobr_doacao" class="mt-4 boxFieldCobr doacao ">
			<legend>Informações para doações</legend>
			<div class="row">
				<div class="col-12 col-md-12">
					<div class="form-group">
						<textarea type="text" name="evcob_info_doacao" id="evcob_info_doacao" class="form-control" style="height: 150px !important;">Doação de 1 litro de leite por participante + 1 litro de leite por coreografia</textarea>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>

