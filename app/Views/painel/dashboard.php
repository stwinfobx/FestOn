<?php 
	$this->extend('painel/templates/template_painel');
	$this->section('content'); 
?>

	<div class="box-breadcrumb" style="visibility: hidden;">
		<div class="row">
			<div class="col-12">
				BreadCrumb
			</div>
		</div>
	</div>

	<div id="app">
		<div class="row align-items-start">
			<div class="col-12 col-md-3">
                DASHBOARD
			</div>
			<div class="col-12 col-md-9">

			</div>
		</div>
	</div>

 
<?php
	$this->endSection('content'); 
?>

<?php $time = time(); ?>
<?php $this->section('headers'); ?>

	<style>
		.list_cart{
			margin: 3px 0;
		}
		.list_cart a{
			border: 1px solid #ebeced;
			padding: 8px;
			display: block;
			border-radius: 0.25rem;
			color: #000;
		}
		.list_cart a:hover{
			background-color: #edeeef;
			color: #000;
		}
	</style>

<?php $this->endSection('headers'); ?>

<?php $this->section('scripts'); ?>

	<script>

	</script>

<?php $this->endSection('scripts'); ?>