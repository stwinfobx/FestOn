<?php $time = time(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo(base_url()); ?>/" />
	<title>Dança Carajás - Festival</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />

	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />

	<link rel="canonical" href="<?php echo(current_url()); ?>" />
	<link rel="shortcut icon" href="assets/media/favicon.png" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

	<link href="assets/line-awesome/css/line-awesome.min.css" rel="stylesheet" type="text/css" />

	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

	<?php $this->renderSection('headers'); ?>
</head>
<body>

	<?php
		//$m_ac = (isset($menu_active) ? $menu_active : ''); 

		//$session_id = (isset($session_id) ? $session_id : '');
		//$session_user_id = (int)(isset($session_user_id) ? $session_user_id : ''); 
		//$session_user_nome =(isset($session_user_nome) ? $session_user_nome : ''); 
		//$session_user_permissao = (int)(isset($session_user_permissao) ? $session_user_permissao : ''); 
		//$session_user_label_permissao = (isset($session_user_label_permissao) ? $session_user_label_permissao : '');
	?>

    <div class="l-navbar" id="nav-bar">
		<div class="bar-icon cmdOpenMenu"><i class="las la-bars"></i> Menu</div>
        <nav class="nav">
            <div> 
				<div class="d-flex" style="padding: 0rem 4.5rem;">
					<img src="assets/media/logotipo.png" class="img-fluid" />
				</div>

				<div class="nav_user d-none">
					<div>#<?php echo($session_user_id); ?> &nbsp;<?php echo($session_user_nome); ?></div>
					<div><small><?php echo($session_user_label_permissao); ?></small></div>
					<div style="inline-size: 90%; height: 16px; overflow: hidden; overflow-wrap: break-word; word-break: break-all;"><small>id: <?php echo( $session_id ); ?></small></div>
				</div>
                <div class="nav_list" style="padding-top:20px !important;"> 


					<a href="<?php echo(site_url('login')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Login</span></a>
					<a href="<?php echo(site_url('eventos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Eventos</span></a>
					<a href="<?php echo(site_url('generos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Gêneros</span></a>
					<a href="<?php echo(site_url('subgeneros')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">SubGêneros</span></a>
					<a href="<?php echo(site_url('categorias')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Categorias</span></a>
					<a href="<?php echo(site_url('grupos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Grupos</span></a>

					<br>
					
					
					<a href="<?php echo(site_url('perfil/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Perfil</span></a>
					<a href="<?php echo(site_url('apresentacoes/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Apresentações</span></a> 
					<a href="<?php echo(site_url('participantes/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Participantes</span></a>
					<a href="<?php echo(site_url('coreografias/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Coreografias</span></a>
					<a href="<?php echo(site_url('cursos/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Cursos</span></a>
					<a href="<?php echo(site_url('cursistas/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Cursistas</span></a>

					<br>
					<a href="<?php echo(site_url('ensaios/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Ensaios</span></a>
					



					<?php if( $session_user_permissao == "1"){ // administradores ?>
						<a href="<?php echo(site_url('dashboard')); ?>" class="nav_link <?php echo (($m_ac == "dashboard"?'active':'')); ?>"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
						<a href="<?php echo(site_url('usuarios')); ?>" class="nav_link <?php echo (($m_ac == "usuarios"?'active':'')); ?>"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Vendedores</span> </a> 
						<a href="<?php echo(site_url('produtos')); ?>" class="nav_link <?php echo (($m_ac == "produtos"?'active':'')); ?>"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Produtos</span> </a> 
						<a href="<?php echo(site_url('clientes')); ?>" class="nav_link <?php echo (($m_ac == "clientes"?'active':'')); ?>"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Clientes</span> </a> 
						<a href="<?php echo(site_url('pedidos')); ?>" class="nav_link <?php echo (($m_ac == "pedidos"?'active':'')); ?>"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Pedidos</span> </a> 
						<a href="<?php echo(site_url('historico')); ?>" class="nav_link <?php echo (($m_ac == "historico"?'active':'')); ?>"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Meu histórico</span> </a>
						<a href="<?php echo(site_url('configuracoes')); ?>" class="nav_link <?php echo (($m_ac == "configuracoes"?'active':'')); ?>"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Configurações</span> </a>
					<?php } ?>

					<?php if( $session_user_permissao == "2"){ // vendedores ?>
						<a href="<?php echo(site_url('dashboard')); ?>" class="nav_link <?php echo (($m_ac == "dashboard"?'active':'')); ?>"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
						<a href="<?php echo(site_url('clientes')); ?>" class="nav_link <?php echo (($m_ac == "clientes"?'active':'')); ?>"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Clientes</span> </a> 
						<a href="<?php echo(site_url('pedidos')); ?>" class="nav_link <?php echo (($m_ac == "pedidos"?'active':'')); ?>"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Pedidos</span> </a> 
						<a href="<?php echo(site_url('historico')); ?>" class="nav_link <?php echo (($m_ac == "historico"?'active':'')); ?>"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Meu histórico</span> </a> 
					<?php } ?>

				</div>
			</div> 
			<!-- <a href="<?php echo(site_url('logout')); ?>" class="nav_link" style="background-color: #875c30; color: white;"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Sair</span> </a> -->
        </nav>
    </div>

	<main>
		<div class="page-content">
			<div class="container-fluid">

			<div class="d-none">
				<?php
					echo('<h1>'. $session_user_id .'</h1>');
					echo('<h2>'. $session_user_nome .'</h2>');
				?>
			</div>
			<div class="d-none">
				<?php
					//$lastQuery = (isset($lastQuery) ? $lastQuery : '');
					//print('<pre>');
					//print_r( $lastQuery );
					//print('</pre>');
				?>
			</div>

			<?php 
				$this->renderSection('content');
			?>

			</div>
		</div>
		
	</main>


	<!-- <script src="assets/plugins/jQuery/jquery.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="assets/js/app_plugins.js"></script>


	<script>
		let SITE_URL = '<?php echo(site_url()); ?>/';	
	</script>


	<script>
	$(document).ready(function () {
		$(document).on('click', '.cmdOpenMenu', function (e) {
			e.preventDefault();

			let $navBar = $('#nav-bar');
			//let $navBar = $('#nav-bar');

			if( $navBar.hasClass( "show" ) ){
				$navBar.removeClass('show');
			}else{
				$navBar.addClass('show');
			}

			//let $bsc_vendedor = $("#bsc_vendedor").val();
			//let $bsc_cliente = $("#bsc_cliente").val();
			//let $bsc_data_inicial = $("#bsc_data_inicial").val();
			//let $bsc_data_final = $("#bsc_data_final").val();
			//let $bsc_status = $("#bsc_status").val();

			//let $url = '';
			//if( $bsc_vendedor.length > 0 )	{ $url = $url +'/vendedor:'+ $bsc_vendedor; }
			//if( $bsc_cliente.length > 0 )	{ $url = $url +'/cliente:'+ $bsc_cliente; }
			//if( $bsc_data_inicial.length > 0 )	{ $url = $url +'/data_inicial:'+ ($bsc_data_inicial); }
			//if( $bsc_data_final.length > 0 )	{ $url = $url +'/data_final:'+ ($bsc_data_final); }
			//if( $bsc_status.length > 0 )	{ $url = $url +'/status:'+ $bsc_status; }

			////console.log( SITE_URL  +'historico/filtrar'+ $url );
			//window.location.href = SITE_URL  +'historico/filtrar'+ $url;
			return false;
		});
	});
	</script>

	<?php $this->renderSection('scripts'); ?>

</body>
</html>