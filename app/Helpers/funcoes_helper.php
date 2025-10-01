<?php


if (! function_exists('print_debug'))
{
	/**
	 * Returns a site URL restrita as defined by the App config.
	 *
	 * @param mixed       $relativePath URI string
	 */
	function print_debug( $value = '', $height = "150px" )
	{
		print '<pre style="font-size: .65rem; border: 3px solid red; padding: 8px; height: '. $height .'; border-radius: 8px; overflow: auto">';
		print_r( $value );
		print '</pre>';
	}
}



if (! function_exists('admin_url'))
{
	/**
	 * Returns a site URL restrita as defined by the App config.
	 *
	 * @param mixed       $relativePath URI string
	 */
	function admin_url($relativePath = '')
	{
		$config = new \Config\App();
		//$folderRestrito = $config->baseFolderRestrito;
		//$folderRestrito = (empty($folderRestrito) ? 'restrito/' : $folderRestrito .'/'); 
		
		$folderRestrito = 'admin/';
		
		return site_url( $folderRestrito . $relativePath);
	}
}


if (! function_exists('painel_url'))
{
	/**
	 * Returns a site URL restrita as defined by the App config.
	 *
	 * @param mixed       $relativePath URI string
	 */
	function painel_url($relativePath = '')
	{
		$config = new \Config\App();
		//$folderRestrito = $config->baseFolderRestrito;
		//$folderRestrito = (empty($folderRestrito) ? 'restrito/' : $folderRestrito .'/'); 
		
		$folderRestrito = 'painel/';
		
		return site_url( $folderRestrito . $relativePath);
	}
}



/**
 * fct_date2bd: formata data
 */
if ( ! function_exists('fct_date2bd'))
{
	function fct_date2bd($pDate="", $format="Y-m-d")
	{
		if(empty($pDate)) return "";
		list($sDia, $sMes, $sAno) = preg_split('/[\/.-]+/', $pDate);
		$dteReturn = date($format, strtotime($sAno ."-".$sMes ."-".$sDia));
		return $dteReturn;
	}
}


/**
 * fct_formatdate: formata data
**/
if ( ! function_exists('fct_formatdate'))
{
	// 0000-00-00 00:00:00
	function fct_formatdate($pDate="", $format="Y-m-d", $template="", $return_array=false)
	{
		date_default_timezone_set('America/Sao_Paulo');
		//$ci =& get_instance();

		//$ci->config->load('cfg_settings');
		//$arr_meses = $ci->config->item('cfg_meses');
		//$arr_day_week = $ci->config->item('cfg_day_week');
		$arr_meses = array (
			'1'	=> array('jan','Janeiro'),
			'2'	=> array('fev','Fevereiro'),
			'3'	=> array('mar','Março'),
			'4'	=> array('abr','Abril'),
			'5'	=> array('mai','Maio'),
			'6'	=> array('jun','Junho'),
			'7'	=> array('jul','Julho'),
			'8'	=> array('ago','Agosto'),
			'9'	=> array('set','Setembro'),
			'10'=> array('out','Outubro'),
			'11'=> array('nov','Novembro'),
			'12'=> array('dez','Dezembro'),
		);
		$arr_day_week = array (
			0	=> array('dom','Domingo'),
			1	=> array('seg','Segunda-feira'),
			2	=> array('ter','Terça-feira'),
			3	=> array('qua','Quarta-feira'),
			4	=> array('qui','Quinta-feira'),
			5	=> array('sex','Sexta-feira'),
			6	=> array('sac','Sábado')
		);

		if(empty($pDate)) return "";

		$pDate = str_replace("0000-00-00", "", $pDate);
		$pDate = str_replace("0000-00-00 00:00:00", "", $pDate);
		if( empty($pDate) ) return $pDate;
		
		$type_return = "";
		$type_return = ( !empty($template)		? "template" : $type_return );
		$type_return = ( ($return_array==true)	? "array" : $type_return );

		$intDayOfWeek		= date('w',strtotime($pDate));	// Descobre o dia da semana			
		$intDayOfMonth		= date('d',strtotime($pDate));	// Descobre o dia do mês
		$intMonthOfYear		= date('n',strtotime($pDate));	// Descobre o mês
		$intYear			= date('Y',strtotime($pDate));	// Descobre o ano

		$_week			= isset($arr_day_week[$intDayOfWeek][0]) ? $arr_day_week[$intDayOfWeek][0] : "";
		$_week_full		= isset($arr_day_week[$intDayOfWeek][1]) ? $arr_day_week[$intDayOfWeek][1] : "";
		$_month			= isset($arr_meses[$intMonthOfYear][0]) ? $arr_meses[$intMonthOfYear][0] : "";
		$_month_full	= isset($arr_meses[$intMonthOfYear][1]) ? $arr_meses[$intMonthOfYear][1] : "";

		switch ($type_return){
			case "template":
				// modelo de formatacao de template
				// {semana}, {dia} de {mes} de {ano}
				$template = str_replace('{semana}', utf8_encode($_week_full), $template);
				$template = str_replace('{semanaabrev}', utf8_encode($_week), $template);
				$template = str_replace('{dia}', $intDayOfMonth, $template);
				$template = str_replace('{mes}', utf8_encode($_month_full), $template);
				$template = str_replace('{mesabrev}', utf8_encode($_month), $template);
				$template = str_replace('{ano}', $intYear, $template);			

				$dteReturn = $template;

			break;
			case "array":
				$dteReturn = array(
					"week"		=> $_week,
					"week_full"	=> $_week_full,
					"day"		=> $intDayOfMonth,
					"month"		=> $_month,
					"month_full"=> $_month_full,
					"year"		=> $intYear,
				);
				
			break;
			default:
				$dateTemp = preg_replace('/[\/.-]+/','/', $pDate);
				$dteReturn = date($format, strtotime($dateTemp));

			break;
		};

		return $dteReturn;
	}
}


/**
 * fct_to_money: formata numero decimal
**/
if ( ! function_exists('fct_to_money'))
{
	function fct_to_money($pValue="", $decimal=2, $type="")
	{
		if( $type == "bd" ){
			$pValue = (empty($pValue) ? 0 : $pValue);
			$pValue = str_replace(".", "", $pValue);
			$pValue = str_replace(",", ".", $pValue);
			return $pValue;
		}
		if( empty($type) || $type == "br"){
			$pValue = (empty($pValue) ? 0 : $pValue);
			return number_format( $pValue, $decimal, ',', '.' );
		}
	}
}

function show_error($validation, $field)
{
	if(isset($validation))
	{
		//if (in_array($field, $validation)) 
		if ( array_key_exists($field, $validation) )
		{
			return '<small class="badge badge-danger label-custom-error"><i class="fas fa-exclamation"></i> '. $validation[$field] .'</small>';
		}
		// $validation->getError($field) .'
		//print_r($validation);
	}
	
	//if( $validation->getError($field) ){
		//return '<div class="alert alert-danger mt-2">'. 
			//$validation->getError($field) .'
		//</div>';
	//}
}

/**
 * fct_encripta : encripta uma string
**/
if ( ! function_exists('fct_encripta'))
{
	function fct_password_hash($pString="", $pTipo="sha512") {
		if(!empty($pString))
		{
			$config = new \Config\AppSettings();
			$encryption_hashkey = $config->encryption_hashkey;			
			$passGerada	= hash($pTipo, sha1($pString . $encryption_hashkey));		
		}else{
			$passGerada = "";
		};

		return $passGerada;
	}

	//$passGerada	= hash($pTipo, sha1($pString . $ci->config->item('encryption_hashkey')));
}


/**
 * fct_valida_cpf : validar número de CPF
**/
//if ( ! function_exists('fct_valida_cpf'))
//{
//	function fct_valida_cpf($cpf = null) {

//		// Verifica se um número foi informado
//		if(empty($cpf)) {
//			return false;
//		}

//		// Elimina possivel mascara
//		$cpf = preg_replace("/[^0-9]/", "", $cpf);
//		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
//		
//		// Verifica se o numero de digitos informados é igual a 11 
//		if (strlen($cpf) != 11) {
//			return false;
//		}
//		// Verifica se nenhuma das sequências invalidas abaixo 
//		// foi digitada. Caso afirmativo, retorna falso
//		else if ($cpf == '00000000000' || 
//			$cpf == '11111111111' || 
//			$cpf == '22222222222' || 
//			$cpf == '33333333333' || 
//			$cpf == '44444444444' || 
//			$cpf == '55555555555' || 
//			$cpf == '66666666666' || 
//			$cpf == '77777777777' || 
//			$cpf == '88888888888' || 
//			$cpf == '99999999999') {
//			return false;
//		 // Calcula os digitos verificadores para verificar se o
//		 // CPF é válido
//		 } else {   
//			
//			for ($t = 9; $t < 11; $t++) {
//				
//				for ($d = 0, $c = 0; $c < $t; $c++) {
//					$d += $cpf{$c} * (($t + 1) - $c);
//				}
//				$d = ((10 * $d) % 11) % 10;
//				if ($cpf{$c} != $d) {
//					return false;
//				}
//			}

//			return true;
//		}
//	}
//}


/**
 * fct_valida_cnpj : validar número de CNPJ
**/
if ( ! function_exists('fct_valida_cnpj'))
{
	function fct_valida_cnpj($cnpj = null)
	{
		// Verifica se um número foi informado
		if(empty($cnpj)) {
			return false;
		}

		//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cnpj em diferentes formatos como "00.000.000/0000-00", "00000000000000", "00 000 000 0000 00" etc...
		$j=0;
		for($i=0; $i<(strlen($cnpj)); $i++)
			{
				if(is_numeric($cnpj[$i]))
					{
						$num[$j]=$cnpj[$i];
						$j++;
					}
			}
		//Etapa 2: Conta os dígitos, um Cnpj válido possui 14 dígitos numéricos.
		if(count($num)!=14)
			{
				$isCnpjValid=false;
			}
		//Etapa 3: O número 00000000000 embora não seja um cnpj real resultaria um cnpj válido após o calculo dos dígitos verificares e por isso precisa ser filtradas nesta etapa.
		if ($num[0]==0 && $num[1]==0 && $num[2]==0 && $num[3]==0 && $num[4]==0 && $num[5]==0 && $num[6]==0 && $num[7]==0 && $num[8]==0 && $num[9]==0 && $num[10]==0 && $num[11]==0)
			{
				$isCnpjValid=false;
			}
		//Etapa 4: Calcula e compara o primeiro dígito verificador.
		else
			{
				$j=5;
				for($i=0; $i<4; $i++)
					{
						$multiplica[$i]=$num[$i]*$j;
						$j--;
					}
				$soma = array_sum($multiplica);
				$j=9;
				for($i=4; $i<12; $i++)
					{
						$multiplica[$i]=$num[$i]*$j;
						$j--;
					}
				$soma = array_sum($multiplica);
				$resto = $soma%11;
				if($resto<2)
					{
						$dg=0;
					}
				else
					{
						$dg=11-$resto;
					}
				if($dg!=$num[12])
					{
						$isCnpjValid=false;
					}
			}
		//Etapa 5: Calcula e compara o segundo dígito verificador.
		if(!isset($isCnpjValid))
			{
				$j=6;
				for($i=0; $i<5; $i++)
					{
						$multiplica[$i]=$num[$i]*$j;
						$j--;
					}
				$soma = array_sum($multiplica);
				$j=9;
				for($i=5; $i<13; $i++)
					{
						$multiplica[$i]=$num[$i]*$j;
						$j--;
					}
				$soma = array_sum($multiplica);
				$resto = $soma%11;
				if($resto<2)
					{
						$dg=0;
					}
				else
					{
						$dg=11-$resto;
					}
				if($dg!=$num[13])
					{
						$isCnpjValid=false;
					}
				else
					{
						$isCnpjValid=true;
					}
			}

		return $isCnpjValid;
	}
}

/**
 * fct_validar_cpf : CPF
**/
if ( ! function_exists('fct_validar_cpf'))
{
	function fct_validar_cpf($cpf) {
		// Remover caracteres não numéricos
		$cpf = preg_replace('/[^0-9]/', '', $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

		// Verificar se o CPF possui 11 dígitos
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verificar se todos os dígitos são iguais, o que invalida o CPF
		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return false;
			}
		}
		return true;
	}
}


/**
 * fct_mask : mascaras
**/
if ( ! function_exists('fct_mask'))
{
	function fct_mask($val, $mask) {
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++) {
			if($mask[$i] == '#') {
				if(isset($val[$k])) $maskared .= $val[$k++];
			} else {
				if(isset($mask[$i])) $maskared .= $mask[$i];
			}
		}
		return $maskared;
	}
}


function geraTimestamp($data)
{
    $partes = explode('/', $data); 
    return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}


function checarData( $start_date, $end_date, $date_from_user)
{
	//$start_date = '2009-06-17';
	//$end_date = '2009-09-05';
	//$date_from_user = '2009-08-28';

	$start_date = date_create($start_date);
	$date_from_user = date_create($date_from_user);
	$end_date = date_create($end_date);

	$interval1 = date_diff($start_date, $date_from_user);
	$interval2 = date_diff($end_date, $date_from_user);

	$retorno = 0;
	if($interval1->invert == 0){
		if($interval2->invert == 1){
			$retorno = 1;
			// if it lies between start date and end date execute this code
		}
	}
	return $retorno;
}

function checardiff( $dt)
{
	$unit = "";
	$number = "";
	if ($dt->y > 0){
		$number = $dt->y;
		$unit = "year";
	} else if ($dt->m > 0) {
		$number = $dt->m;
		$unit = "month";
	} else if ($dt->d > 0) {
		$number = $dt->d;
		$unit = "day";
	} else if ($dt->h > 0) {
		$number = $dt->h;
		$unit = "hour";
	} else if ($dt->i > 0) {
		$number = $dt->i;
		$unit = "minute";
	} else if ($dt->s > 0) {
		$number = $dt->s;
		$unit = "second";
	}
	$unit .= $number  > 1 ? "s" : "";
	$ret = $number ." ". $unit ." "."ago";

	return  $ret;
}


function checarDataPeriodo( $start_date, $end_date, $date_current)
{
	$dte_inicial = new DateTime( fct_date2bd($start_date) ." 00:00:00" );
	$dte_final = new DateTime( fct_date2bd($end_date) ." 23:59:00");
	$dte_current = new DateTime(date('Y-m-d H:i:s'));

	$dt = $dte_inicial->diff($dte_current);		// DateInterval
	$dt2 = $dte_final->diff($dte_current);		// DateInterval

	$ret1 = checardiff( $dt );
	$ret2 = checardiff( $dt2 );

	$retorno = 0;
	if($dt->invert == 0){
		if($dt2->invert == 1){
			$retorno = 1;
		}
	}
	return $retorno;
}


function fct_CountDias($data_inicial = '', $data_final = '') {
	if( empty($data_inicial) || empty($data_final) ){ return 0; }
	$diferenca = strtotime($data_final) - strtotime($data_inicial);
    $dias = floor($diferenca / (60 * 60 * 24)); 
    return $dias;
}


function getNightsBetween(\DateTime $dt1, \DateTime $dt2){
    if(!$dt1 || !$dt2){
        return false;
    }
    $dt1->setTime(0,0,0);
    $dt2->setTime(0,0,0);
    $dti = $dt1->diff($dt2);    // DateInterval
    return $dti->days * ( $dti->invert ? -1 : 1);   // nb: ->days always positive
}

function fct_Text2Color($str) {
    if (!$str || strlen($str) == 0) {
        return false;
    }
    for ($i = 0, $hash = 0; $i < strlen($str); $hash = ord($str[$i++]) + (($hash << 5) - $hash));
    for ($i = 0, $colour = "#"; $i < 3; $colour .= ("00" . (($hash >> $i++ * 2) & 0xFF)
                                    .toString(16))
                                .slice(-2));
    return $colour;
}
function text2Color($str) {
    if (!$str || strlen($str) == 0) {
        return false;
    }
    for ($i = 0, $hash = 0; $i < strlen($str); $hash = ord($str[$i++]) + (($hash << 5) - $hash));
    for ($i = 0, $colour = "#"; $i < 3; $colour .= str_pad(dechex(($hash >> $i++ * 2) & 0xFF), 2, "0", STR_PAD_LEFT));
    return $colour;
}

function getMediaType($filename)
{
    // Lista de extensões de arquivo associadas a tipos de mídia
    $mediaTypes = array(
        'mp4' => 'video',
        'mov' => 'video',
        'avi' => 'video',
        'mp3' => 'audio',
        'wav' => 'audio',
		'webp' => 'image',
		'bmp' => 'image',
        'png' => 'image',
        'jpg' => 'image',
        'jpeg' => 'image',
        'gif' => 'image',
    );

    // Obtém a extensão do arquivo
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Verifica se a extensão do arquivo está na lista de tipos de mídia
    if (array_key_exists($ext, $mediaTypes)) {
        return $mediaTypes[$ext];
    } else {
        return '';
    }
}

//// Exemplo de uso
//$filename = 'video.mp4'; // Substitua pelo nome do arquivo que deseja verificar
//$mediaType = getMediaType($filename);
//echo "O arquivo $filename é do tipo: $mediaType";


function obterDuracaoMP3($caminhoDoArquivoMP3) {
    // Abre o arquivo MP3 para leitura binária
    $handle = fopen($caminhoDoArquivoMP3, 'rb');
    if (!$handle) {
        return;
    }

    // Lê os primeiros 10 bytes do cabeçalho do arquivo MP3
    $cabecalho = fread($handle, 10);

    // Fecha o arquivo
    fclose($handle);

    // Verifica se o arquivo começa com "ID3" (cabeçalho ID3)
    if (substr($cabecalho, 0, 3) == 'ID3') {
        // Se começar com "ID3", então há um cabeçalho ID3, e os próximos 6 bytes contêm informações sobre o cabeçalho
        $versaoID3 = ord($cabecalho[3]);
        $byteFlags = ord($cabecalho[5]);
        $tamanhoCabecalho = (($byteFlags & 0x80) ? 10 : 0) + 10;

        // Pula para a posição após o cabeçalho ID3
        $handle = fopen($caminhoDoArquivoMP3, 'rb');
        fseek($handle, $tamanhoCabecalho);

        // Lê os próximos 4 bytes que representam a duração em segundos
        $duracaoBytes = fread($handle, 4);

        // Fecha o arquivo
        fclose($handle);

        // Converte os bytes para um número
        $duracaoSegundos = unpack('N', $duracaoBytes)[1];

        // Exibe a duração
        //echo "Duração do arquivo MP3: $duracaoSegundos segundos";

		return segundosParaMinutosSegundos($duracaoSegundos);
    }

	// Modo de Uso
	// Substitua 'caminho/para/seu/arquivo.mp3' pelo caminho real para o seu arquivo MP3.
	//obterDuracaoMP3('caminho/para/seu/arquivo.mp3');
}

function segundosParaMinutosSegundos($segundos) {
    // Formata a duração no formato mm:ss
    //return sprintf('%02d:%02d', floor($segundos / 60), $segundos % 60);
	return $segundos;
}



function fct_ValidarTempo($tempoLimite, $tempoInformado)
{
    // Converte as strings de tempo para segundos
    $limiteSegundos = strtotime($tempoLimite);
    $informadoSegundos = strtotime($tempoInformado);

    // Adiciona a tolerância de 5 segundos ao tempo limite
    $limiteSegundos += 5;

    // Verifica se o tempo informado é maior que o tempo limite
    if ($informadoSegundos > $limiteSegundos) {
        return false;
    }

    return true;
}

function calcularIdade($dataNascimento) {
    // Criar um objeto DateTime com a data de nascimento
    $dataNascimento = new DateTime($dataNascimento);
    
    // Criar um objeto DateTime com a data atual
    $dataAtual = new DateTime();
    
    // Calcular a diferença entre a data atual e a data de nascimento
    $diferenca = $dataAtual->diff($dataNascimento);
    
    // Retornar a idade em anos
    return $diferenca->y;
}

function parseTemplate($template, $fields) {
    $tags = array_map(fn($key) => "{{{$key}}}", array_keys($fields)); // Cria tags {{chave}}
    $values = array_values($fields); // Obtém os valores correspondentes

    return str_replace($tags, $values, $template);
}
