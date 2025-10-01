<?php $time = time(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?php echo(base_url()); ?>/" />
	<title>JA FestOn : FrontEnd</title>
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

	<!-- <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet"> -->
	<!-- <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->

	<!-- jquery e bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


	<!-- FONT-AWESOME -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link href="assets/line-awesome/css/line-awesome.min.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" media="all" href="assets/css/stellarnav.css">
	<link defer type="text/css" rel="stylesheet" href="assets/css/style-menu.css?=<?php echo($time); ?>">

	<!-- <link href="assets/css/reset.css" rel="stylesheet" type="text/css" /> -->
	<link href="assets/css/style-frontend.css?=<?php echo($time); ?>" rel="stylesheet" type="text/css" />

	<style>
		:root {
		}
	</style>

	<!-- choose one -->
	<!-- <script src="https://unpkg.com/feather-icons"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script> -->

	<?php $this->renderSection('headers'); ?>
</head>
<body>
	<main id="app" class="p-0">
		<?php 
			print_r( '<pre class="d-none">' );
			//print_r( session()->get('isLoggedInUserInscricao') );
			var_dump( session()->get('isLoggedInUserInscricao') );
			print_r( ' | '. session()->get('inscUser_id') );
			print_r( ' | '. session()->get('inscUser_nome') );

			/*
			'inscUser_id' => $rs_user->user_id,
			'inscUser_hashkey' => $rs_user->user_hashkey,
			'inscUser_nome' => $rs_user->user_nome,
			'inscUser_email' => $rs_user->user_email,
			'isLoggedInUserInscricao' => TRUE			
			*/
			print_r( '</pre>' );
			$this->renderSection('content');
		?>
		<?php $this->renderSection('modals'); ?>
	</main>

	<style>
		.personal-image-header {
			text-align: center;
		}
		.personal-figure-header {
			position: relative;
			width: 60px;
			height: 60px;
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


	<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<!-- <script src="assets/plugins/jQuery-Mask-Plugin/dist/jquery.mask.min.js" type="text/javascript"></script> -->
	<!-- <script src="assets/js/app_plugins.js"></script> -->

	<script>
		let SITE_URL = '<?php echo(site_url()); ?>/';	
	</script>

	<script src="assets/js/jQuery-Mask-Plugin/dist/jquery.mask.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="assets/js/app_plugins.js?t=<?php echo($time); ?>"></script>

	<script src="assets/js/mustache.js"></script>

	<script type="text/javascript" src="assets/js/stellarnav.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery('.stellarnav').stellarNav({
				theme: 'dark',
				breakpoint: 960,
				position: 'right',
			});
		});
	</script>

	<script>
	$(document).ready(function () {
	});
	</script>

	<?php $this->renderSection('scripts'); ?>

</body>
</html>