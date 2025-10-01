
<div class="content-step current justify-content-center align-items-center flex-column h-100">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-11 col-md-12">

				<div class="row mb-3">
					<div class="col-12 col-md-12">
						<h1>Clássicos na Atualidade</h1>	
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-4">

					</div>
					<div class="col-12 col-md-8">
						<div class="mb-3 pb-2 text-end bd-separar">
							<label style="font-size: .8rem; font-size: 0.8rem; line-height: 1; display: block;">local</label>
							<p class="m-0" style="font-size: 1rem;font-weight: bold; border-image-source: ">Rio de Janeiro</p>
						</div>
						<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida felis nisi, aliquet finibus nulla tempor ut. Nunc cursus augue interdum volutpat suscipit. Vivamus mollis eget libero viverra molestie. Quisque convallis velit eget metus ultrices, nec aliquam enim dictum. Proin ullamcorper tellus neque, vel porta mauris laoreet sed. Integer dapibus quis dui ac lacinia. Maecenas eget felis sed libero tincidunt blandit vitae non tortor. In iaculis risus id nunc commodo sollicitudin. Integer dignissim dapibus ipsum, quis ultricies dolor rutrum id. Donec scelerisque est a felis porta volutpat. Phasellus lectus risus, pretium et ligula et, cursus tincidunt ipsum. Etiam tincidunt dui sem, quis molestie nunc tempus sed.
						</p>

						<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras gravida felis nisi, aliquet finibus nulla tempor ut. Nunc cursus augue interdum volutpat suscipit. Vivamus mollis eget libero viverra molestie. Quisque convallis velit eget metus ultrices, nec aliquam enim dictum. Proin ullamcorper tellus neque, vel porta mauris laoreet sed. Integer dapibus quis dui ac lacinia. Maecenas eget felis sed libero tincidunt blandit vitae non tortor. In iaculis risus id nunc commodo sollicitudin. Integer dignissim dapibus ipsum, quis ultricies dolor rutrum id. Donec scelerisque est a felis porta volutpat. Phasellus lectus risus, pretium et ligula et, cursus tincidunt ipsum. Etiam tincidunt dui sem, quis molestie nunc tempus sed.
						</p>
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
		.card.card-workshop{
			background-color: #ffa902;
			border: none;
			box-shadow: 3px 3px 5px 0px rgb(0 0 0 / 37%);
		}
		.card.card-workshop .card-header{
			background-color: transparent;
			border: none;
			padding: 1.5rem 0 .5rem 0;
		}
		.card.card-workshop .card-body{
			background-color: transparent;
			border: none;
			padding: 1.0rem 0 1.5rem 0;
		}
		.work-item{
			position: relative;
		}
		.work-item:before{
			content: '';
			position: absolute;
			bottom: 4px;
			left: calc(50% - 60px);
			/*border-bottom: 1px solid white;*/
			width: 120px;
			/* margin: 0 auto; */
			border-bottom: 1px solid;
			border-image-slice: 1;
			border-width: 1px;
			border-image-source: linear-gradient(to left, rgb(255 255 255 / 0%), rgb(255 255 255), rgb(255 255 255 / 0%));
		}
		.card.card-workshop .card-body label{
			font-size: 0.9rem;
			color: white;
			line-height: 1;
			margin: 0;
		}
		.card.card-workshop .card-body label.vagas{
			margin-bottom: .5rem;
			background-color: #d6d6d6;
			padding: 8px 20px;
			border-radius: 30px;
			/* display: flex; */
			color: black;
			border: 1px solid #848484;
			font-size: .8rem;		
		}
		.card.card-workshop .card-body h3{
			/*line-height: 1;*/
		}
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
		.bd-separar{
			position: relative;	
		}
		.bd-separar:before{
			content: '';
			position: absolute;
			bottom: 0px;
			right: 0;
			/*border-bottom: 1px solid white;*/
			width: 60%;
			/* margin: 0 auto; */
			border-bottom: 1px solid;
			border-image-slice: 1;
			border-width: 1px;
			border-image-source: linear-gradient(to right, rgb(255 255 255 / 0%), rgb(238 158 2), rgb(251 166 2));
		}
	</style>

<?php $this->endSection('scripts'); ?>
