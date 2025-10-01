<?php $time = time(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo(base_url()); ?>/" />
	<title>JA FestOn</title>
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

	<link href="assets/css/reset.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

	<!-- choose one -->
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

	<?php $this->renderSection('headers'); ?>
</head>
<body>

	<?php
		$m_ac = (isset($menu_active) ? $menu_active : '');

		$session_id = (isset($session_id) ? $session_id : '');
		$session_user_id = (int)(isset($session_user_id) ? $session_user_id : ''); 
		$session_user_nome =(isset($session_user_nome) ? $session_user_nome : ''); 
		$session_user_permissao = (int)(isset($session_user_permissao) ? $session_user_permissao : ''); 
		$session_user_label_permissao = (isset($session_user_label_permissao) ? $session_user_label_permissao : '');
	?>

    <!--
	<div class="l-navbar" id="nav-bar" style="height: 100% !important;">
		<div class="bar-icon cmdOpenMenu"><i class="las la-bars"></i> Menu</div>
        <nav class="nav" style="overflow: scroll !important; height: 100% !important; scrollbar-width: none;">
            <div> 
				<div class="d-flex" style="padding: 0rem 4.5rem;">
					<img src="assets/media/logotipo.png" class="img-fluid" />
				</div>

				<div class="nav_user d-none">

				</div>
                <div class="nav_list" style="padding-top:20px !important;"> 

					<a href="<?php echo(site_url('login')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Login</span></a>
					<a href="<?php echo(site_url('eventos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Eventos</span></a>
					<a href="<?php echo(site_url('generos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Gêneros</span></a>
					<a href="<?php echo(site_url('subgeneros')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">SubGêneros</span></a>
					<a href="<?php echo(site_url('categorias')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Categorias</span></a>
					<a href="<?php echo(site_url('grupos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Grupos</span></a>

					<a href="<?php echo(site_url('cursos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Cursos</span></a>
					<a href="<?php echo(site_url('cursistas')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Cursistas</span></a>
					<a href="<?php echo(site_url('participantes')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Participantes</span></a>

					<a href="<?php echo(site_url('coreografias')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Coreografias</span></a>
					<a href="<?php echo(site_url('instituicoes')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Instituições</span></a>

					<br>
					
					<a href="<?php echo(site_url('perfil/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Perfil</span></a>
					<a href="<?php echo(site_url('apresentacoes/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Apresentações</span></a> 
					
					
					
					

					<br>
					<a href="<?php echo(site_url('ensaios/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Ensaios</span></a>

				</div>
			</div> 
        </nav>
    </div>
	-->

	<div class="nftmax-smenu">
		<div class="admin-menu">
            <div> 
				<div class="d-flex" style="padding: 0rem 4.5rem;">
					<img src="assets/media/logotipo.png" class="img-fluid" />
				</div>
                <div class="nav_list" style="padding-top:20px !important;"> 

					<a href="<?php echo(site_url('login')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Login</span></a>
					<a href="<?php echo(site_url('eventos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Eventos</span></a>
					<a href="<?php echo(site_url('generos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Modalidade</span></a>
					<a href="<?php echo(site_url('subgeneros')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Formato</span></a>
					<a href="<?php echo(site_url('categorias')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Categorias</span></a>
					<a href="<?php echo(site_url('grupos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Grupos</span></a>
					<a href="<?php echo(site_url('funcoes')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Funções</span></a>

					<a href="<?php echo(site_url('cursos')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Cursos</span></a>
					<a href="<?php echo(site_url('cursistas')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Cursistas</span></a>
					<a href="<?php echo(site_url('participantes')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Participantes</span></a>

					<a href="<?php echo(site_url('coreografias')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Coreografias</span></a>
					<a href="<?php echo(site_url('instituicoes')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Instituições</span></a>

					<br>
					<a href="<?php echo(site_url('perfil/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Perfil</span></a>
					<a href="<?php echo(site_url('apresentacoes/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Apresentações</span></a> 

					<br>
					<a href="<?php echo(site_url('ensaios/form')); ?>" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Ensaios</span></a>
				</div>
			</div> 
		</div>
	</div>

	<main>
		<div class="page-content" style="padding-top: 0; margin-top: 0;">
			<div class="container-fluid" style="border-bottom: 1px solid  #f2f2f2; padding-bottom: 8px; margin-bottom: 12px;">
				<div class="row justify-content-end align-items-start">
					<div class="col-12 col-md-9">

					</div>
					<div class="col-12 col-md-3">
						<div class="d-flex align-items-center">
							<div style="padding-right: 12px;">
								<img src="assets/media/icon-usuario.png" style="width: 40px;" />
							</div>
							<div>
								<?php
									echo('<h4>'. $session_user_id .' | '.$session_user_nome .'</h4>');
								?>
								<div class="pt-1" style="line-height:1"><a href="<?php echo(site_url('logout')); ?>" style="line-height:1">Sair</a></div>
							</div>
						</div>
					</div>
				</div>
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


	<style>
		/*======================================
			Theme Default
		========================================*/
		.l-navbar .nav{
			  -ms-overflow-style: none;  /* IE and Edge */
			  scrollbar-width: none;  /* Firefox */
		}

		.nftmax-smenu {
			position: fixed;
			left: 0;
			z-index: 6000;
			height: 100%;
			transition: all 0.3s ease;
			transition: all 0.4s;
			width: 250px;
			transform: translateX(0%);
			box-shadow: 0 9px 95px 0 #0000000d;
		}
		.admin-menu {
			background: #fff;
			height: 100%;
			scrollbar-width: none;
			overflow: scroll;
			padding-left: 12px;
			padding-top: 10px;
			padding-right: 12px;
			transition: all .3s ease;
		}
	</style>

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="assets/plugins/jQuery-Mask-Plugin/dist/jquery.mask.min.js" type="text/javascript"></script>
	<script src="assets/js/app_plugins.js"></script>

	<script>
		let SITE_URL = '<?php echo(site_url()); ?>/';	
	</script>


	<script>
	feather.replace();

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