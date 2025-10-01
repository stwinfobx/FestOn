<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="Generator" content="EditPlus®">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="Description" content="">
	<title>Document</title>
	
	
	<!-- Fancybox CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />

	<!-- jQuery (necessário para Fancybox) -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- Fancybox JS -->
	<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
	
</head>
<body>

	<div class="gallery">
		<a href="https://via.placeholder.com/800x600" data-fancybox="gallery" data-caption="Imagem 1">
			<img src="https://via.placeholder.com/150" alt="Imagem 1">
		</a>
		<a href="https://via.placeholder.com/800x600" data-fancybox="gallery" data-caption="Imagem 2">
			<img src="https://via.placeholder.com/150" alt="Imagem 2">
		</a>
		<a href="https://via.placeholder.com/800x600" data-fancybox="gallery" data-caption="Imagem 3">
			<img src="https://via.placeholder.com/150" alt="Imagem 3">
		</a>
	</div>
	
	
	<script>
	$(document).ready(function(){
		$('[data-fancybox="gallery"]').fancybox({
			buttons: [
				"zoom",
				"slideShow",
				"thumbs",
				"close"
			],
			loop: true,  // Permite navegar em loop na galeria
			protect: true // Evita que as imagens sejam baixadas (botão direito)
		});	
	});
	</script>	

</body>
</html>
