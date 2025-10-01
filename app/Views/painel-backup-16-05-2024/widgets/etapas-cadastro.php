	<?php
		//print '<pre>';
		//print_r( $rs_params );
		//print '</pre>';

		$etapa = (isset($etapa) ? $etapa : '');
		//$arr_etapas = [
		//	['chave' => 'grupos',			'label' => 'Grupos'],
		//	['chave' => 'participantes',	'label' => 'Participantes'],
		//	['chave' => 'coreografias',		'label' => 'Coreografias'],
		//	['chave' => 'cobranca',			'label' => 'Gerar Cobrança'],
		//	['chave' => 'relatorios',		'label' => 'Relatórios'],
		//];
		//$exists = false;
		
		//$key = array_search('green', $array); // $key = 2;

		////if (array_key_exists($etapa, $arr_etapas)) {
		////	echo "The 'first' element is in the array";
		////}


		//function encontrarIndicePorChave($vetor, $chaveDesejada) {
		//	$chaves = array_column($vetor, 'chave');
		//	$indice_encontrado = array_search($chaveDesejada, $chaves, true);
		//	return $indice_encontrado !== false ? $indice_encontrado : false;
		//}

		$arr_etapas_vetor = [
			0 => ['chave' => 'grupos', 'label' => 'Grupos', 'link' => painel_url('grupos/form')],
			1 => ['chave' => 'participantes', 'label' => 'Participantes', 'link' => painel_url('participantes/form')],
			2 => ['chave' => 'coreografias', 'label' => 'Coreografias', 'link' => painel_url('coreografias/form')],
			3 => ['chave' => 'cobranca', 'label' => 'Gerar Cobrança', 'link' => painel_url('cobranca')],
			4 => ['chave' => 'relatorios', 'label' => 'Relatórios', 'link' => painel_url('relatorios')],
		];

		//$chave_desejada = 'cobranca';

		$chaves = array_column($arr_etapas_vetor, 'chave');
		$indice_encontrado = array_search($etapa, $chaves, true);
		$indice_encontrado = ($indice_encontrado !== false ? $indice_encontrado : false);

		//$indice_encontrado = encontrarIndicePorChave($arr_etapas, $chave_desejada);

		//if ($indice_encontrado !== false) {
		//	echo "A chave '$chave_desejada' foi encontrada no índice $indice_encontrado.";
		//} else {
		//	echo "A chave '$chave_desejada' não foi encontrada.";
		//}
	?>

	<?php
	//$arr_etapas = [
	//	'grupos' => 'Grupos',
	//	'participantes' => 'Participantes',
	//	'coreografias' => 'Coreografias',
	//	'cobranca' => 'Gerar Cobrança',
	//	'relatorios' => 'Relatórios',
	//];

	//$chave_desejada = 'cobranca';
	//$encontrado = false;

	//echo '<ul class="d-flex step-cadastro">';

	//foreach ($arr_etapas as $chave => $valor) {
	//	if ($chave == $chave_desejada && !empty($chave_desejada)) {
	//		$encontrado = true;
	//	}

	//	if ($encontrado) {
	//		echo '<li>' . $valor . '</li>';
	//	} else {
	//		echo '<li class="active">' . $valor . '</li>';
	//	}
	//}

	//echo '</ul>';
	?>

	<div class="d-flex flex-column">
		<div>Você está nesta etapa:</div>
		<div class="">
			<ul class="d-flex step-cadastro">
				<?php
				$link_param = "";
				$_grp_id = (int)(isset($rs_params->grp) ? $rs_params->grp : "");
				if( $_grp_id > 0 ){ $link_param =  '/params/grp:'. $_grp_id; }
				foreach ($arr_etapas_vetor as $key => $val) {
					$li_active = '';
					if ( ($indice_encontrado !== false && $key <= $indice_encontrado) || ($indice_encontrado === false && $key == 0) ) {
						$li_active = 'active';		
					}
					//if( $indice_encontrado === false && $key == 0){ $li_active = 'active'; }
					print('<li class="'. $li_active  .'"><a href="'. $val['link'] . $link_param .'">'. $val['label'] .'</a></li>');
				}
				?>
				<!-- <li class="active"> Grupo</li> -->
				<!-- <li> Participante</li> -->
				<!-- <li> Coreografias</li> -->
				<!-- <li> Gerar Cobrança</li> -->
				<!-- <li> Relatórios</li> -->
			</ul>
		</div>
	</div>

