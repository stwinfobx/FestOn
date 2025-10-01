	<?php 
		//print($step);
	?>	

	<div class="d-flex flex-column">
		<div class="naveg-steps">
			<div class="naveg-steps-numbers">
				<div class="naveg-steps-item" v-bind:class="{current: step >= 1}">
					<div class="steps-icon">
						<i class="stepper-check fas fa-check" v-show="step > 1"></i>
						<span class="steps-number" v-show="step == 1">1</span>
					</div>
					<div class="steps-label">
						<h3 class="steps-title">Grupo</h3>
						<div class="steps-desc">Configurações</div>
					</div>
				</div>

				<div class="naveg-steps-item" v-bind:class="{current: step >= 2}">
					<div class="steps-icon">
						<i class="stepper-check fas fa-check" v-show="step > 2"></i>
						<span class="steps-number" v-show="step <= 2">2</span>
					</div>
					<div class="steps-label">
						<h3 class="steps-title">Participantes</h3>
						<div class="steps-desc">Informações</div>
					</div>
				</div>

				<div class="naveg-steps-item" v-bind:class="{current: step >= 3}">
					<div class="steps-icon">
						<i class="stepper-check fas fa-check" v-show="step > 3"></i>
						<span class="steps-number" v-show="step <= 3">3</span>
					</div>
					<div class="steps-label">
						<h3 class="steps-title">Coreografias</h3>
						<div class="steps-desc">Detalhes</div>
					</div>
				</div>

				<div class="naveg-steps-item" v-bind:class="{current: step >= 4}">
					<div class="steps-icon">
						<i class="stepper-check fas fa-check" v-show="step > 4"></i>
						<span class="steps-number" v-show="step <= 4">4</span>
					</div>
					<div class="steps-label">
						<h3 class="steps-title">Cobrança</h3>
						<div class="steps-desc">Detalhes</div>
					</div>
				</div>

				<div class="naveg-steps-item" v-bind:class="{current: step >= 5}">
					<div class="steps-icon">
						<i class="stepper-check fas fa-check" v-show="step > 5"></i>
						<span class="steps-number" v-show="step < 5">5</span>
					</div>
					<div class="steps-label">
						<h3 class="steps-title">Concluído</h3>
						<div class="steps-desc">Quando o pagamento for confirmado</div>
					</div>
				</div>

				<div class="naveg-steps-item" v-bind:class="{current: step >= 6}">
					<div class="steps-icon">
						<i class="stepper-check fas fa-check" v-show="step > 6"></i>
						<span class="steps-number" v-show="step < 6">6</span>
					</div>
					<div class="steps-label">
						<h3 class="steps-title">Relatórios</h3>
						<div class="steps-desc">Impressão de relatórios</div>
					</div>
				</div>
			</div>
		</div>
	</div>


