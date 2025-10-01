<?php
namespace App\Controllers;

use CodeIgniter\Controllers; 
use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Libraries\PHPMailerLib;

use MercadoPago;

class Mercadopg extends BaseController
{
	//protected $colabMD = null;
	//protected $convMD = null;
	protected $pedMD = null;
	protected $pgtoMD = null;
	protected $eventMD = null;
	protected $evcobMD = null;
	
	protected $pedpgtoMD = null;
	protected $tranMD = null;
	protected $paymMD = null;
	protected $cfgMD = null;
	protected $cfMP = null;

	protected $MP_SANDBOX_PUBLIC_KEY = null;
	protected $MP_SANDBOX_TOKEN = null;
	protected $MP_APP_PUBLIC_KEY = null;
	protected $MP_APP_TOKEN = null;

	protected $MP_ENVIRONMENT = null;

	protected $MP_PUBLIC_KEY = null;
	protected $MP_ACCESS_TOKEN = null;

	//protected $mp_credenciais = NULL;
	//protected $mp_status_pagamento = NULL;
	//protected $mp_status_cobranca = NULL;
	//protected $mp_status_detail = NULL;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
		parent::initController($request, $response, $logger);

		// Library Models
		$this->pedMD = new \App\Models\PedidosModel();
		$this->pgtoMD = new \App\Models\PedidosPagtosModel();
		$this->eventMD = new \App\Models\EventosModel();
		$this->evcobMD = new \App\Models\EventosCobrancaModel();

		//$this->colabMD = new \App\Models\ColaboradoresModel();
		//$this->convMD = new \App\Models\ConvidadosModel();
		//$this->cadMD = new \App\Models\CadastrosModel();
		//$this->pedpgtoMD = new \App\Models\PedpagtosModel();
		//$this->tranMD = new \App\Models\TransacoesModel();
		//$this->paymMD = new \App\Models\PaymentsModel();
		//$this->cfgMD = new \App\Models\ConfigGeraisModel();

		// Library Helpers
		helper('funcoes');
		helper('text');

		// Library Mercado Pago : Configuracoes
		//$this->cfMP = new \Config\AppMercadoPago();

		//$this->mp_credenciais = $this->cfMP->MP_CREDENCIAIS;
		//$this->mp_status_pagamento = $this->cfMP->getMP_status_pagamento();
		//$this->mp_status_cobranca = $this->cfMP->getMP_status_cobranca();
		//$this->mp_status_detail = $this->cfMP->getMP_status_detail();

		//$this->data["mp_environment"] = $this->MP_ENVIRONMENT;
		//if( $this->MP_ENVIRONMENT == 'production' ){
		//	$this->MP_PUBLIC_KEY = $this->cfMP->MP_APP_PUBLIC_KEY;
		//	$this->MP_ACCESS_TOKEN = $this->cfMP->MP_APP_TOKEN;
		//}else{
		//	$this->MP_PUBLIC_KEY = $this->cfMP->MP_SANDBOX_PUBLIC_KEY;
		//	$this->MP_ACCESS_TOKEN = $this->cfMP->MP_SANDBOX_TOKEN;
		//}

		//$this->data["mp_public_key"] = $this->MP_PUBLIC_KEY;
    }


	public function index()
	{
	}

	public function get_credenciais( $event_id = "" )
	{
		/*
		 * -------------------------------------------------------------
		 * Obter Credenciais Referente ao Evento
		 * -------------------------------------------------------------
		**/
			$query_evcob = $this->evcobMD
				->where('event_id', (int)$event_id)
				->orderBy('evcob_id', 'DESC')
				->limit(1)
				->get();
			if( $query_evcob && $query_evcob->resultID->num_rows >= 1 )
			{
				$rs_evcob = $query_evcob->getRow();

				$evcob_credenciais_mp = $rs_evcob->evcob_credenciais_mp;
				$mp_credenciais = json_decode($evcob_credenciais_mp);

				$evcob_config_mp = $rs_evcob->evcob_config_mp;
				$mp_config_json = json_decode($evcob_config_mp);

				$this->MP_ENVIRONMENT = 'production';
				if( $this->MP_ENVIRONMENT == 'production' ){
					$this->MP_PUBLIC_KEY = $mp_credenciais->app_key;
					$this->MP_ACCESS_TOKEN = $mp_credenciais->app_token;
				}else{
					$this->MP_PUBLIC_KEY = $mp_credenciais->sandbox_key;
					$this->MP_ACCESS_TOKEN = $mp_credenciais->sandbox_token;
				}
			}
	}

	public function get_config_dados_mp( $event_id = "" )
	{
		/*
		 * -------------------------------------------------------------
		 * Obter as configurações para criar o pedido de pagamento
		 * -------------------------------------------------------------
		**/
			$arr_dados_config_mp = (object)[];

			$query_evcob = $this->evcobMD
				->where('event_id', (int)$event_id)
				->orderBy('evcob_id', 'DESC')
				->limit(1)
				->get();
			if( ($query_evcob && $query_evcob->resultID->num_rows >=1) )
			{
				$rs_evcob = $query_evcob->getRow();

				$evcob_config_mp = $rs_evcob->evcob_config_mp;
				$mp_config_json = json_decode($evcob_config_mp);

				$mp_parcelas = (int)(isset($mp_config_json->parcelas) ? $mp_config_json->parcelas : '');
				$mp_prazo_boleto = (int)(isset($mp_config_json->prazo_boleto) ? $mp_config_json->prazo_boleto : 5);
				$mp_metodos = (isset($mp_config_json->metodos) ? $mp_config_json->metodos : []);

				$arr_dados_config_mp = (object)[
					'parcelas' => (int)$mp_parcelas,
					'prazo_boleto' => (int)$mp_prazo_boleto,
					'metodos' => $mp_metodos,
				];
			}

		return $arr_dados_config_mp;
	}




	public function ingresso( $ped_hashkey = "" )
	{
		$session = session();
		$ses_data = [
			//'cad_id' => 1,
			//'cad_nome' => "Marcio Lima",
			//'cad_email' => 'marcio.misterlab@gmail.com',
			'isPayment' => TRUE
		];
		$session->set($ses_data);

		//exit( 'colab_id: '. (int)session()->get('colab_id') );
		//exit( 'ped_hashkey: '. $ped_hashkey );
		//exit( $this->mp_credenciais );

		// ------------------------------------------------------------------------
		if ( session()->get('isPayment') ) 
		{
			$continuar = true;
			//$cad_id = (int)session()->get('cad_id');

			$ingresso_titulo = '';
			$ingresso_valor = 0; 
			$ingresso_quant = 1;
			$tipo_ingresso = '';

			
			//$query_pedido = $this->pedMD
			//	->where('ped_hashkey', $ped_hashkey)
			//	//->where('cad_id', $cad_id)
			//	->orderBy('ped_id', 'DESC')
			//	->limit(1)
			//	->get();

			$query_pedido = $this->pedMD->from('tbl_pedidos As PED', true)
				->select('PED.*')
				->select('GRP.grp_responsavel, GRP.grp_cpf, GRP.grp_email, GRP.grp_celular')
				->join('tbl_grupos AS GRP', 'GRP.grp_id = PED.grp_id', 'INNER')
				->where('PED.ped_hashkey', $ped_hashkey)
				->orderBy('PED.ped_id', 'DESC')
				->limit(1)
				->get();
			if( ($query_pedido && $query_pedido->resultID->num_rows >=1) && $continuar === true )
			{
				$rs_pedido = $query_pedido->getRow();
				$this->data['rs_pedido'] = $rs_pedido;

				$ped_hashkey = $rs_pedido->ped_hashkey;
				$ped_id = (int)$rs_pedido->ped_id;
				$event_id = (int)$rs_pedido->event_id;
				$user_id = (int)$rs_pedido->user_id;
				$ingresso_valor = $rs_pedido->ped_valor_total;
				//$ingresso_valor = 2;
				$ingresso_titulo = $rs_pedido->event_titulo;

				$grp_responsavel = $rs_pedido->grp_responsavel;
				$grp_cpf = $rs_pedido->grp_cpf;
				$grp_email = $rs_pedido->grp_email;
				$grp_celular = $rs_pedido->grp_celular;


				/*
				 * -------------------------------------------------------------
				 * Obter Credenciais Referente ao Evento
				 * -------------------------------------------------------------
				**/
					self::get_credenciais( (int)$event_id );
					$this->data["mp_public_key"] = $this->MP_PUBLIC_KEY;

				/*
				 * -------------------------------------------------------------
				 * Obter Configurações Para Gerar Pedido de Pagamento
				 * -------------------------------------------------------------
				**/
					$config_mp = self::get_config_dados_mp( (int)$event_id );

					$mp_parcelas = (isset($config_mp->parcelas) ? $config_mp->parcelas : '');
					$mp_prazo_boleto = (int)(isset($config_mp->prazo_boleto) ? $config_mp->prazo_boleto : 5);
					$mp_metodos = (isset($config_mp->metodos) ? $config_mp->metodos : []);

					/*
					$query_evcob = $this->evcobMD
						->where('event_id', $event_id)
						//->where('cad_id', $cad_id)
						->orderBy('evcob_id', 'DESC')
						->limit(1)
						->get();
					if( ($query_evcob && $query_evcob->resultID->num_rows >=1) )
					{
						$rs_evcob = $query_evcob->getRow();
						//$this->data['rs_pedido'] = $evcob_credenciais_mp;

						$evcob_credenciais_mp = $rs_evcob->evcob_credenciais_mp;
						$mp_credenciais = json_decode($evcob_credenciais_mp);

						$evcob_config_mp = $rs_evcob->evcob_config_mp;
						$mp_config_json = json_decode($evcob_config_mp);

						$mp_parcelas = (int)(isset($mp_config_json->parcelas) ? $mp_config_json->parcelas : '');
						$mp_prazo_boleto = (int)(isset($mp_config_json->prazo_boleto) ? $mp_config_json->prazo_boleto : 5);
						$mp_metodos = (isset($mp_config_json->metodos) ? $mp_config_json->metodos : []);

						//{
						//	"email":"listasguardiao@gmail.com",
						//	"app_key":"APP_USR-1da73b9f-f42a-4a51-b323-ed2bb755fad4",
						//	"app_token":"APP_USR-1375836524113491-122714-90708c38be07a0efeca22a861b3cced9-80782311",
						//	"sandbox_key":"TEST-94597c19-8788-44eb-b796-4f92e5e34b5c",
						//	"sandbox_token":"TEST-1375836524113491-122714-cbe1c60456dea1e3e5f86c309fc14aad-80782311"
						//}
						

						$this->MP_ENVIRONMENT = 'production';
						if( $this->MP_ENVIRONMENT == 'production' ){
							$this->MP_PUBLIC_KEY = $mp_credenciais->app_key;
							$this->MP_ACCESS_TOKEN = $mp_credenciais->app_token;
						}else{
							$this->MP_PUBLIC_KEY = $mp_credenciais->sandbox_key;
							$this->MP_ACCESS_TOKEN = $mp_credenciais->sandbox_token;
						}

						$this->data["mp_public_key"] = $this->MP_PUBLIC_KEY;
					}
					*/


				/*
				 * -------------------------------------------------------------
				 * dados do comprador / deverá ser o 
				 * -------------------------------------------------------------
				**/
					$cad_id = 1;
					//$cad_nome_completo = $grp_responsavel;
					$cad_nome_completo = "Marcio Lima";
					$cad_email = 'marcio.misterlab@gmail.com';
					//$cad_cpf = $grp_cpf;
					$cad_cpf = '17487363880';
					$cad_cpf = preg_replace("/[^0-9]/", "", $cad_cpf);
					$date_of_expiration = $mp_prazo_boleto; // prazo do boleto

					$cad_nome_completo = "Maria Luciana da Silva Lima";
					$cad_cpf = "26692789818";

				//$tipo_ingresso = $info_payment->tipo_ingresso;
				$tipo_ingresso = 'unico';

				$cad_telefone = (empty($cad_telefone) ? "12345678" : $cad_telefone);
				$cad_cpf = (empty($cad_cpf) ? "12312312387" : $cad_cpf);

				$cod_referencia_pagto = "";
				if( $this->MP_ENVIRONMENT == "sandbox" ){
					$cod_referencia_pagto = "TESTE-MP_";
					//$cod_referencia_pagto = "";
				}				
				$cod_referencia_pagto = $cod_referencia_pagto . strtoupper(random_string('alnum', 6)) .'-'. str_pad($cad_id, 4, "0", STR_PAD_LEFT); 
				$pg_url_redirect = site_url();

				//$INFOS_INGRESSO = $session->get('INFOS_INGRESSO');
				//if( empty($INFOS_INGRESSO) ){

					// ------------------------------------------------------------------------
					// MERCADO PAGO
					// ------------------------------------------------------------------------
						\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);

						$preference = new MercadoPago\Preference();

						$partes = explode(' ', $cad_nome_completo);
						$payer_name = array_shift($partes);
						$payer_surname = array_pop($partes);

						# Dados do comprador
						$payer = new MercadoPago\Payer();
						$payer->name = $payer_name;
						$payer->surname = (empty($payer_surname) ? "Santos" : $payer_surname);
						$payer->email = $cad_email;
						$payer->date_created = date("Y-m-dTH:i:s");
						//$payer->phone = array(
							//"area_code" => "11",
							//"number" => "4444-4444"
						//);
						$payer->identification = array(
							"type" => "CPF",
							"number" => $cad_cpf
						);
						//$payer->address = array(
							//"street_name" => "Street",
							//"street_number" => 123,
							//"zip_code" => "06233200"
						//);
						$preference->payer = $payer;

						# Building an item
						$item1 = new MercadoPago\Item();
						$item1->id = "00001";
						$item1->title = $ingresso_titulo; 
						$item1->quantity = 1;
						$item1->unit_price = $ingresso_valor;

						$preference->items = array($item1);

						/*
						$payment_types_default = array(
							array("id" => "bank_transfer"),
							array("id" => "atm"),
							array("id" => "credit_card"),
							array("id" => "debit_card"),
							array("id" => "ticket"),
						);

						$payment_selected = Array ( 
							'bank_transfer',
							'debit_card',
							'ticket'
						);
						$default_ids = array_column($payment_types_default, 'id');
						//$missing_elements = array_diff($default_ids, $mp_metodos);
						$missing_elements = array_values(array_diff($default_ids, $mp_metodos));

						$return_array = array_map(function ($id) {
							return array('id' => $id);
						}, $missing_elements);
						//print_r($return_array);

						$arr_payment_methods = array(
							"installments" => $mp_parcelas,
							"default_payment_method_id" => "pix"
						);

						$exluidos = array( "excluded_payment_types" => $return_array );
						//$teste = array_merge($arr_payment_methods, $exluidos);
						$preference->payment_methods = array_merge($arr_payment_methods, $exluidos);

						//print '<pre>';
						//print_r( $return_array );
						//print '</pre>';

						//$preference->payment_methods = $arr_payment_methods;
						//print 'Gerando Pelo Banco<pre>';
						//print_r( $preference->payment_methods );
						//print '</pre>';
						//exit();
						*/

						$preference->payment_methods = array(
							//"excluded_payment_methods" => array(
							//	array("id" => "visa"),
							//	array("id" => "master"),
							//	array("id" => "hipercard"),
							//	array("id" => "amex"),
							//	array("id" => "diners"),
							//	array("id" => "eso"),
							//	array("id" => "melicard")
							//),
							"installments" => $mp_parcelas,
							//"default_payment_method_id" => "pix",
							"excluded_payment_types" => array(
								//array("id" => "bank_transfer"),
								array("id" => "atm"),
								//array("id" => "credit_card"),
								array("id" => "debit_card"),
								//array("id" => "ticket"),
							)
						);
						//print 'Gerando pelo padrao<pre>';
						//print_r( $preference->payment_methods );
						//print '</pre>';



						//exit();

						/*
						print '<pre>';
						print_r( $preference->payment_methods );
						print '</pre>';

						$preference->payment_methods = array(
							"excluded_payment_methods" => array(
								array("id" => "visa"),
								array("id" => "master"),
								array("id" => "hipercard"),
								array("id" => "amex"),
								array("id" => "diners"),
								array("id" => "eso"),
								array("id" => "melicard")
							),
							"excluded_payment_types" => array(
								//array("id" => "bank_transfer"),
								array("id" => "atm"),
								array("id" => "credit_card"),
								array("id" => "debit_card"),
								array("id" => "ticket"),
							),
							"default_payment_method_id" => "pix"
						);
						print '<pre>';
						print_r( $preference->payment_methods );
						print '</pre>';

						exit();

						$preference->payment_methods = array(
							//"excluded_payment_methods" => array(
							//	array("id" => "visa"),
							//	array("id" => "master"),
							//	array("id" => "hipercard"),
							//	array("id" => "amex"),
							//	array("id" => "diners"),
							//	array("id" => "eso"),
							//	array("id" => "melicard")
							//),
							//"excluded_payment_types" => array(
							//	//array("id" => "bank_transfer"),
							//	array("id" => "atm"),
							//	array("id" => "credit_card"),
							//	array("id" => "debit_card"),
							//	array("id" => "ticket"),
							//),
							"installments" => 3,
							"default_payment_method_id" => "pix"
						);
						*/


						$preference->notification_url = site_url('mercadopg/notifications/'. $cod_referencia_pagto);
						$preference->back_urls = array(
							"success" => site_url('mercadopg/feedback/success'),
							"failure" => site_url('mercadopg/feedback/failure'), 
							"pending" => site_url('mercadopg/feedback/pending')
						);
						$preference->external_reference = $cod_referencia_pagto;	

						// FORÇA O PRAZO PARA 5 DIAS NO BOLETO
						//$date_of_expiration = 5;
						//$preference->date_of_expiration = date('Y-m-d\TH:i:s\Z', strtotime('+'. $date_of_expiration .' days'));
						$preference->save();

						//echo "<a href='$preference->sandbox_init_point'> Pagar </a>";
						$preference_id = $preference->id; 
						$init_point = $preference->init_point; 
						$this->data["preference_id"] = $preference_id;
						try {
							$data_ped_pagto = [
								'pgto_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
								'user_id' => (int)$user_id,
								'ped_id' => (int)$ped_id,
								'pgto_payment' => 'mercado-pago', 
								//'pgto_credenciais' => json_encode($mp_credenciais),
								'pgto_referencia' => $cod_referencia_pagto,
								'pgto_nome' => $cad_nome_completo,
								'pgto_email' => $cad_email,
								'pgto_code_checkout' => $preference_id, 
								'pgto_init_point' => $init_point, 
								'pgto_dte_cadastro' => date("Y-m-d H:i:s"),
								'pgto_dte_alteracao' => date("Y-m-d H:i:s"),
								'pgto_ativo' => 1,
							];
							$pgto_id = $this->pgtoMD->insert($data_ped_pagto);

							//$this->pedpgtoMD->set('pgto_credenciais', $this->mp_credenciais);
							//$this->pedpgtoMD->set('pgto_referencia', $cod_referencia_pagto);
							//$this->pedpgtoMD->set('pgto_code_checkout', $preference->id);
							//$this->pedMD->where('ped_hashkey', $ped_hashkey);
							//$this->pedMD->where('colab_id', $colab_id);
							//$this->pedMD->update();

							// ------------------------------------------------------
							// Guardamos o valor em Sessão para Obter Posteriormente
							// ------------------------------------------------------
							$this->data["data_infos"] = array(
								"ingresso_valor" => $ingresso_valor,
								"tipo_ingresso" => $tipo_ingresso,							
								"success" => "success",
								"code_checkout" => $preference->id,
								"cod_referencia_pagto" => $cod_referencia_pagto
							);
							//$session->set('INFOS_INGRESSO', $this->data["data_infos"]);
				
						} catch (Exception $e) {
							$this->data["data_infos"] = array(
								"error" => "error",
								"error_msg" => $e->getMessage(),
							);
						}
					// ------------------------------------------------------------------------

				//}else{
					//$INFOS_INGRESSO = $session->get('INFOS_INGRESSO');
					//$this->data["data_infos"] = array(
						//"success" => "success",
						//"code_checkout" => $INFOS_INGRESSO['code_checkout'],
						//"code_ingresso" => $INFOS_INGRESSO['code_ingresso'],
					//);
					//$this->data["preference_id"] = $INFOS_INGRESSO['code_checkout'];
				//}
			}else{
				exit('pedido inexistente');
			}
		}else{
			exit('no session');
		}
		// ------------------------------------------------------------------------

		

		
		$this->data["evcob_tipo_cobranca"] = "mercado_pago";
		return view('inscricoes/pagamento-mp', $this->data);
	}

	public function segunda_via( $pgto_code_checkout = "" )
	{
		//$cad_id = (int)session()->get('cad_id');

		//$this->pedMD->from('tbl_pedidos PED', true);
		//$this->pedMD->select('PED.ped_id, PED.ped_hashkey, PGTO.pgto_referencia, PED.ped_valor_total, PGTO.pgto_code_checkout, PGTO.pgto_referencia');
		//$this->pedMD->join('tbl_ped_pagtos PGTO', 'PGTO.ped_id = PED.ped_id', 'LEFT');
		////$this->pedMD->join('tbl_payments PAY', 'PAY.paym_referencia = PGTO.pgto_referencia', 'LEFT');
		//$this->pedMD->where('PGTO.pgto_code_checkout', $pgto_code_checkout);
		//$this->pedMD->where('PED.cad_id', $cad_id);
		//$this->pedMD->limit(1);
		//$query_pgto = $this->pedMD->get();
		//if( $query_pgto && $query_pgto->resultID->num_rows >= 1 )
		//{
		//	$rs_pedido = $query_pgto->getRow();
		//	$this->data["preference_id"] = $rs_pedido->pgto_code_checkout;
		//	$this->data["data_infos"] = array(
		//		"ingresso_valor" => $rs_pedido->ped_valor_total,
		//		"tipo_ingresso" => 'unico',
		//		"success" => "success",
		//		"code_checkout" => $rs_pedido->pgto_code_checkout,
		//		"code_ingresso" => $rs_pedido->pgto_referencia
		//	);
		//}

		return view('inscricoes/segunda-via', $this->data);
	}


	public function pagar($cad_id)
	{
		//$session = session();
		// $ses_data = [
		// 	'cad_id' => 1,
		// 	'cad_nome' => "Marcio Lima",
		// 	'cad_email' => 'marcio.misterlab@gmail.com',
		// 	'isPayment' => TRUE
		// ];
		// $session->set($ses_data);

		$cad_id = (int)$cad_id; 

		// ------------------------------------------------------------------------
		if ( $cad_id > 0 ) 
		{
			$continuar = true;

			$ingresso_titulo = 'LC Summit 2023';
			$ingresso_valor = 0;
			$ingresso_quant = 1;
			$tipo_ingresso = '';

			// OBTENDO OS VALORES DO INGRESSO
			// $qryIngresso = $this->prodMD
			// 	->where('prod_area', 'ingressos')
			// 	->where('prod_ativo', '1')
			// 	->orderBy('prod_id', 'DESC')
			// 	->limit(1)
			// 	->get();
			// if( $qryIngresso && $qryIngresso->resultID->num_rows >=1 )
			// {
			// 	$rs_ingresso = $qryIngresso->getRow();
			// 	$this->data['rs_ingresso'] = $rs_ingresso;

			// 	$ingresso_id = $rs_ingresso->prod_id;
			// 	$ingresso_titulo = $rs_ingresso->prod_titulo;
			// 	$ingresso_valor = $rs_ingresso->prod_valor;
			// 	$ingresso_quant = 1;

			// 	$continuar = true;
			// }

			$qryCad = $this->cadMD
				->where('cad_id', $cad_id)
				->orderBy('cad_id', 'DESC')
				->limit(1)
				->get();
			if( ($qryCad && $qryCad->resultID->num_rows >=1) && $continuar === true )
			{
				$rs_cad = $qryCad->getRow();
				$this->data['rs_cadastro'] = $rs_cad;

				$info_payment = json_decode($rs_cad->cad_payment_json);

				$ingresso_valor = $info_payment->vlr_ingresso; 
				//$ingresso_valor = '2.35'; 
				$tipo_ingresso = $info_payment->tipo_ingresso;				

				$cad_id = $rs_cad->cad_id;
				$cad_nome = $rs_cad->cad_nome_completo;
				$cad_email = $rs_cad->cad_email;

				$cad_telefone = '';
				$cad_cpf = '';

				$cad_telefone = (empty($cad_telefone) ? "12345678" : $cad_telefone);
				$cad_cpf = (empty($cad_cpf) ? "12312312387" : $cad_cpf);

				$cod_referencia_pagto = "";
				//if( $_SERVER['SERVER_NAME'] == "localhost" || $this->MP_ENVIRONMENT == "sandbox" ){
					$cod_referencia_pagto = "TESTE-MP_";
				//}				
				$cod_referencia_pagto = $cod_referencia_pagto . strtoupper(random_string('alnum', 6)) .'-'. str_pad($cad_id, 4, "0", STR_PAD_LEFT); 
				$pg_url_redirect = site_url();


				//$INFOS_INGRESSO = $session->get('INFOS_INGRESSO');
				//if( empty($INFOS_INGRESSO) ){
					// ------------------------------------------------------------------------
					// MERCADO PAGO
					// ------------------------------------------------------------------------
						\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);

						$preference = new MercadoPago\Preference();

						$partes = explode(' ', $cad_nome);
						$payer_name = array_shift($partes);
						$payer_surname = array_pop($partes);

						# Dados do comprador
						$payer = new MercadoPago\Payer();
						$payer->name = $payer_name;
						$payer->surname = (empty($payer_surname) ? "Santos" : $payer_surname);
						$payer->email = $cad_email;
						$payer->date_created = date("Y-m-dTH:i:s");
						//$payer->phone = array(
							//"area_code" => "11",
							//"number" => "4444-4444"
						//);
						$payer->identification = array(
							"type" => "CPF",
							"number" => $cad_cpf
						);
						//$payer->address = array(
							//"street_name" => "Street",
							//"street_number" => 123,
							//"zip_code" => "06233200"
						//);
						$preference->payer = $payer;

						# Building an item
						$item1 = new MercadoPago\Item();
						$item1->id = "00001";
						$item1->title = $ingresso_titulo; 
						$item1->quantity = 1;
						$item1->unit_price = $ingresso_valor;

						$preference->items = array($item1);

						$preference->payment_methods = array(
							"excluded_payment_types" => array(
								array("id" => "ticket")
							),
							"installments" => 1
						);

						$preference->notification_url = site_url('mercadopg/notifications');
						$preference->back_urls = array(
							"success" => site_url('mercadopg/feedback'),
							"failure" => site_url('mercadopg/feedback'), 
							"pending" => site_url('mercadopg/feedback')
						);
						$preference->external_reference = $cod_referencia_pagto;	
						$preference->save();

						//echo "<a href='$preference->sandbox_init_point'> Pagar </a>";
						$this->data["preference_id"] = $preference->id;
					try {
						$data_pedido = [
							'ped_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
							'cad_id' => $cad_id,
							'ped_payment' => 'mercado-pago', 
							'ped_referencia' => $cod_referencia_pagto,
							'ped_nome' => $cad_nome,
							'ped_email' => $cad_email,
							'ped_code_checkout' => $preference->id, 
							'ped_dte_cadastro' => date("Y-m-d H:i:s"),
							'ped_dte_alteracao' => date("Y-m-d H:i:s"),
							'ped_ativo' => 1,
						];
						$ped_id = $this->pedMD->insert($data_pedido);

						// Guardamos o valor em Sessão para Obter Posteriormente
						// ------------------------------------------------------
						$this->data["data_infos"] = array(
							"ingresso_valor" => $ingresso_valor,
							"tipo_ingresso" => $tipo_ingresso,							
							"success" => "success",
							"code_checkout" => $preference->id,
							"code_ingresso" => $cod_referencia_pagto
						);
						//$session->set('INFOS_INGRESSO', $this->data["data_infos"]);
			
					} catch (Exception $e) {
						$this->data["data_infos"] = array(
							"error" => "error",
							"error_msg" => $e->getMessage(),
						);
					}
					// ------------------------------------------------------------------------
				//}else{
					//$INFOS_INGRESSO = $session->get('INFOS_INGRESSO');
					//$this->data["data_infos"] = array(
						//"success" => "success",
						//"code_checkout" => $INFOS_INGRESSO['code_checkout'],
						//"code_ingresso" => $INFOS_INGRESSO['code_ingresso'],
					//);
					//$this->data["preference_id"] = $INFOS_INGRESSO['code_checkout'];
				//}

			}
		}
		// ------------------------------------------------------------------------

		return view('pagar-inscricao', $this->data);
	}	


	public function pesquisar___OLD()
	{
		// 
		//https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=ID_REF
		

		//https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=80782311-e13fdcdd-1daf-4837-9352-4c17c54e87dc

		/*
		curl -X GET \
			'https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=ID_REF' \
			-H 'Authorization: Bearer YOUR_ACCESS_TOKEN' 
		*/

		//curl -X GET \
			//'https://api.mercadopago.com/checkout/preferences/search?sponsor_id=undefined&external_reference=undefined&site_id=undefined&marketplace=undefined' \
			//-H 'Authorization: Bearer YOUR_ACCESS_TOKEN' 


		//$KEY_MP = 'TEST-1375836524113491-122714-cbe1c60456dea1e3e5f86c309fc14aad-80782311';
		\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);

		//$payment = new MercadoPago\Preference();



		//$preference_id = '80782311-e13fdcdd-1daf-4837-9352-4c17c54e87dc';


        //$preference = MercadoPago\Preference::find_by_id($preference_id);
       // $this->assertEquals($preference->id, $preference_id);


		//$filters = [];
		//$options = [];


        //$filters = array(
            ////"external_reference" => 'testeMPONCLOUD-002'
			////"external_reference" => 'TESTE-MP_6AKSPP-0015'
        //);
		//$results = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create
		////$results = MercadoPago\Payment::search($filters);

        //$results = $results->getArrayCopy();
        //$payment = end($results);

		//// 80782311-b276c464-bcc6-45ac-a96a-ce3821034145
		//// testeMPONCLOUD-001

		//// https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=testeMPONCLOUD-001


		//print "<pre>";
		//print_r($results);
		//print "</pre>";


		print '<h1>PAYMENT</h1>';

        $filters = array(
            "external_reference" => 'TV9DWI-0011'
        );
		//$results = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create
		$results = MercadoPago\Payment::search($filters);

        $results = $results->getArrayCopy();
        $payment = end($results);

		print "<pre>";
		print_r($results);
		print "</pre>";


		//print '<h1>MERCHANT_ORDER</h1>';
		//$MerchantOrder_id = "3865265804";
		//$merchant_order = MercadoPago\MerchantOrder::find_by_id( $MerchantOrder_id );
		//print "<pre>";
		//print_r($merchant_order);
		//print "</pre>";

		// https://www.mercadopago.com.br/checkout/v1/payment/redirect/0b481908-e78a-4f26-ad63-d5fa5026c0ed/fatal/?preference-id=80782311-56e11a46-0a2a-4f74-8576-f7a61aa152fd&p=ddb49ec6921ddbd6d0894878b1bdc364
	}


	public function pesquisar($REFERENCIA)
	{
		/*
		{
			"email":"listasguardiao@gmail.com",
			"app_key":"APP_USR-1da73b9f-f42a-4a51-b323-ed2bb755fad4",
			"app_token":"APP_USR-1375836524113491-122714-90708c38be07a0efeca22a861b3cced9-80782311",
			"sandbox_key":"TEST-94597c19-8788-44eb-b796-4f92e5e34b5c",
			"sandbox_token":"TEST-1375836524113491-122714-cbe1c60456dea1e3e5f86c309fc14aad-80782311"
		}
		*/



		// 
		//https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=ID_REF
		

		//https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=80782311-e13fdcdd-1daf-4837-9352-4c17c54e87dc

		/*
		curl -X GET \
			'https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=ID_REF' \
			-H 'Authorization: Bearer YOUR_ACCESS_TOKEN' 
		*/

		//curl -X GET \
			//'https://api.mercadopago.com/checkout/preferences/search?sponsor_id=undefined&external_reference=undefined&site_id=undefined&marketplace=undefined' \
			//-H 'Authorization: Bearer YOUR_ACCESS_TOKEN' 




		//print_r( $this->MP_ACCESS_TOKEN );
		//exit();

		
		$MP_ACCESS_TOKEN = "APP_USR-1375836524113491-122714-90708c38be07a0efeca22a861b3cced9-80782311";
		/*
			https://misterlab.com.br/jafeston/public/index.php/mercadopg/feedback/pending?collection_id=78632844039&collection_status=pending&payment_id=78632844039&status=pending&external_reference=CQ3GMS-0001&payment_type=bank_transfer&merchant_order_id=18943517268&preference_id=80782311-255e4113-bffd-416b-a36f-8fbdd2c78586&site_id=MLB&processing_mode=aggregator&merchant_account_id=null		
		*/


		//$KEY_MP = 'TEST-1375836524113491-122714-cbe1c60456dea1e3e5f86c309fc14aad-80782311';
		//\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);
		\MercadoPago\SDK::setAccessToken($MP_ACCESS_TOKEN);

		//$payment = new MercadoPago\Preference();

		//$preference_id = '80782311-e13fdcdd-1daf-4837-9352-4c17c54e87dc';


        //$preference = MercadoPago\Preference::find_by_id($preference_id);
       // $this->assertEquals($preference->id, $preference_id);


		//$filters = [];
		//$options = [];


        //$filters = array(
            ////"external_reference" => 'testeMPONCLOUD-002'
			////"external_reference" => 'TESTE-MP_6AKSPP-0015'
        //);
		//$results = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create
		////$results = MercadoPago\Payment::search($filters);

        //$results = $results->getArrayCopy();
        //$payment = end($results);

		//// 80782311-b276c464-bcc6-45ac-a96a-ce3821034145
		//// testeMPONCLOUD-001

		//// https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=testeMPONCLOUD-001


		//print "<pre>";
		//print_r($results);
		//print "</pre>";


		print '<h1>PAYMENT</h1>';

        $filters = array(
            //"external_reference" => 'DAY3CS-0133'
			"external_reference" => $REFERENCIA
        );
		//$results = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create
		$results = MercadoPago\Payment::search($filters);

        $results = $results->getArrayCopy();
        //$payment = end($results);
		$payment = $results;

		print "<pre>";
		print_r($results);
		print "</pre>";

	}

	public function pesquisar_todos()
	{

		//$access_token = 'APP_USR-1375836524113491-122714-90708c38be07a0efeca22a861b3cced9-80782311';
		$MP_ACCESS_TOKEN = "APP_USR-1375836524113491-122714-90708c38be07a0efeca22a861b3cced9-80782311";
		\MercadoPago\SDK::setAccessToken($MP_ACCESS_TOKEN);	



		$payment_id = '78584682999'; // Substitua 'ID_DO_PAGAMENTO' pelo ID do pagamento que deseja consultar

		$payment = \MercadoPago\Payment::find_by_id($payment_id);

		if ($payment->status == 'approved') {
			$installments = $payment->installments;

			print '<pre>';
			print_r( $installments );
			print '</pre>';

			//foreach ($installments as $installment) {
			//	echo "Parcela: " . $installment->installment_number . "\n";
			//	echo "Vencimento: " . $installment->date_due . "\n";
			//	echo "Status: " . $installment->status . "\n";
			//}
		} else {
			echo "O pagamento não foi aprovado ou não foi encontrado.\n";
		}


		exit();








		
		$filters = [
			'offset' => 0,
			'limit' => 100  // Ajuste conforme necessário
		];

		$results = \MercadoPago\Payment::search($filters);
		//$payments = $results->getArrayCopy()['results'];
		$objResults = $results->getArrayCopy();
		$payments = $objResults;

		print '<pre>';
		print_r( $payments );
		print '</pre>';
		exit();


		foreach ($payments as $payment) {


			echo "Data da Compra: " . $payment['date_created'] . "\n";
			echo "Valor: " . $payment['transaction_amount'] . "\n";
			foreach ($payment['installments'] as $installment) {
				echo "Parcela: " . $installment['installment_number'] . "\n";
				echo "Vencimento: " . $installment['date_due'] . "\n";
				echo "Status: " . $installment['status'] . "\n";
			}
		}



		/*
		$MP_ACCESS_TOKEN = "APP_USR-1375836524113491-122714-90708c38be07a0efeca22a861b3cced9-80782311";
		\MercadoPago\SDK::setAccessToken($MP_ACCESS_TOKEN);

        $filters = array();
		//$results = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create
		$results = MercadoPago\Payment::search($filters);

        $results = $results->getArrayCopy();
        //$payment = end($results);
		$payment = $results;

		print "<pre>";
		print_r($results);
		print "</pre>";
		*/
	}


	public function notifications( $REFERENCIA = "" )
	{
		ini_set('memory_limit', '2048M');

		$filename = "mercadopago_notifications___". date("m") ."_". date("Y") .".log"; 
		//print '<h2>'. $REFERENCIA .'</h2>';

		/*
		 * -------------------------------------------------------------
		 * Verifica se o código de Referência existe no banco de dados
		 * -------------------------------------------------------------
		**/
		$this->pgtoMD->from('tbl_pedidos_pagtos As PGTO', true)
			->select('PGTO.*')
			->select('PED.event_id')
			->join('tbl_pedidos As PED', 'PED.ped_id = PGTO.ped_id', 'INNER')
			->where('PGTO.pgto_referencia', $REFERENCIA)
			->orderBy('PGTO.pgto_id', 'DESC')
			->limit(1);
		$query_pedpgto = $this->pgtoMD->get();
		//print '<h3>rows: '. $query_pedpgto->resultID->num_rows .'</h3>';
		if( $query_pedpgto && $query_pedpgto->resultID->num_rows >= 1 )
		{
			$rs_pedpgto = $query_pedpgto->getRow();
			$pgto_referencia = $rs_pedpgto->pgto_referencia;
			$pgto_hashkey = $rs_pedpgto->pgto_hashkey;

			/*
			 * -------------------------------------------------------------
			 * Obtemos as credenciais para atualizar o Status
			 * -------------------------------------------------------------
			**/
				self::get_credenciais( (int)$rs_pedpgto->event_id );

				//print '<h3>token: '. $this->MP_ACCESS_TOKEN .'</h3>';

				\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);

				$filters = array(
					"external_reference" => $REFERENCIA
				);
				//$results = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create
				$results = MercadoPago\Payment::search($filters);

				//$results = $results->getArrayCopy();
				////$payment = end($results);
				//$payment = $results;

				//print '<pre>';
				//print_r( $results );
				//print '</pre>';

				$dataPOST = [];
				if( (int)$results->total >= 1 ){
					$results = $results->getArrayCopy();
					$payment = end($results);
					$json = json_encode( $payment->toArray() );

					$status = $payment->status;
					$status_detail = $payment->status_detail;
					$installments = $payment->installments;
					$payment_type_id = $payment->payment_type_id;
					$payment_method_id = $payment->payment_method_id;
					$date_of_expiration = $payment->date_of_expiration;
					$date_approved = $payment->date_approved;
					//$ticket_url = 'https://www.mercadopago.com.br/payments/101632657618/ticket?caller_id=1237113169&hash=2a39cdc1-6f08-4ff7-a78c-1a6fc9109c33';// $payment->ticket_url;

					$dataPOST = array(
						//"token" => $this->MP_ACCESS_TOKEN,
						"external_reference" => $REFERENCIA,
						"status" => $status,
						"status_detail" => $status_detail,
						"installments" => $installments,
						"payment_type_id" => $payment_type_id,
						"payment_method_id" => $payment_method_id,
						"date_of_expiration" => $date_of_expiration,
						"date_approved" => $date_approved,
						//"ticket_url" => $ticket_url,	
					);

					/*
					 * -------------------------------------------------------------
					 * Atualiza o Status do Pagamento
					 * -------------------------------------------------------------
					**/
						$this->pgtoMD->set('pgto_status', $status);
						$this->pgtoMD->set('pgto_json', json_encode($dataPOST));
						if( $status == "approved" ){
							$this->pgtoMD->set('pgto_liberado', 1);
							$this->pgtoMD->set('pgto_dte_liberado', date("Y-m-d H:i:s"));
						} 
						$this->pgtoMD->where('pgto_referencia', $REFERENCIA);
						$this->pgtoMD->where('pgto_hashkey', $pgto_hashkey);
						$this->pgtoMD->update();


					//$lblstatus = (isset($this->mp_status_cobranca[$status]) ? $this->mp_status_cobranca[$status]["texto"] :"");
					//$lblstatus_detail =(isset($this->mp_status_detail[$status_detail]) ? $this->mp_status_detail[$status_detail]["texto"] :"");
					//$lblstatus .= (!empty($lblstatus_detail) ? " | ". $lblstatus_detail : "");


					$dataJSON = json_encode($dataPOST);
					//$dataJSON = json_encode($results);

					$filename = "mercadopago_status_payment___". date("m") ."_". date("Y") .".log"; 
					$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
					if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

					$fp = fopen($dir_root ."/". $filename,"a+");
					fwrite($fp,"\n---- status_payment: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
					fwrite($fp,$dataJSON);	

				}

		}
	}


	public function notifications_____OLD( $REFERENCIA = "" )
	{
		ini_set('memory_limit', '2048M');

		$filename = "mercadopago_notifications___". date("m") ."_". date("Y") .".log"; 


		print '<h2>'. $REFERENCIA .'</h2>';


		/*
		 * -------------------------------------------------------------
		 * Verifica se o código de Referência existe no banco de dados
		 * -------------------------------------------------------------
		**/
		$this->pgtoMD->from('tbl_pedidos_pagtos As PGTO', true)
			->select('PGTO.*')
			->select('PED.event_id')
			->join('tbl_pedidos As PED', 'PED.ped_id = PGTO.ped_id', 'INNER')
			->where('PGTO.pgto_referencia', $REFERENCIA)
			->orderBy('PGTO.pgto_id', 'DESC')
			->limit(1);
		$query_pedpgto = $this->pgtoMD->get();
		//print '<h3>rows: '. $query_pedpgto->resultID->num_rows .'</h3>';
		if( $query_pedpgto && $query_pedpgto->resultID->num_rows >= 1 )
		{
			$rs_pedpgto = $query_pedpgto->getRow();
			$pgto_referencia = $rs_pedpgto->pgto_referencia;
			$pgto_hashkey = $rs_pedpgto->pgto_hashkey;

			/*
			 * -------------------------------------------------------------
			 * Obtemos as credenciais para atualizar o Status
			 * -------------------------------------------------------------
			**/
				self::get_credenciais( (int)$rs_pedpgto->event_id );

				print '<h3>token: '. $this->MP_ACCESS_TOKEN .'</h3>';

				\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);

				$filters = array(
					"external_reference" => $REFERENCIA
				);
				//$results = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create
				$results = MercadoPago\Payment::search($filters);

				//$results = $results->getArrayCopy();
				////$payment = end($results);
				//$payment = $results;

				print '<pre>';
				print_r( $results );
				print '</pre>';

				$dataPOST = [];
				if( (int)$results->total >= 1 ){
					$results = $results->getArrayCopy();
					$payment = end($results);
					$json = json_encode( $payment->toArray() );

					$status = $payment->status;
					$status_detail = $payment->status_detail;
					$installments = $payment->installments;
					$payment_type_id = $payment->payment_type_id;
					$payment_method_id = $payment->payment_method_id;
					$date_of_expiration = $payment->date_of_expiration;

					$dataPOST = array(
						//"token" => $this->MP_ACCESS_TOKEN,
						"external_reference" => $REFERENCIA,
						"status" => $status,
						"status_detail" => $status_detail,
						"installments" => $installments,
						"payment_type_id" => $payment_type_id,
						"payment_method_id" => $payment_method_id,
						"date_of_expiration" => $date_of_expiration,
					);

					/*
					 * -------------------------------------------------------------
					 * Atualiza o Status do Pagamento
					 * -------------------------------------------------------------
					**/
						$this->pgtoMD->set('pgto_status', $status);
						$this->pgtoMD->set('pgto_json', json_encode($dataPOST));
						if( $status == "approved" ){
							$this->pgtoMD->set('pgto_liberado', 1);
							$this->pgtoMD->set('pgto_dte_liberado', date("Y-m-d H:i:s"));
						} 
						$this->pgtoMD->where('pgto_referencia', $REFERENCIA);
						$this->pgtoMD->where('pgto_hashkey', $pgto_hashkey);
						$this->pgtoMD->update();


					//$lblstatus = (isset($this->mp_status_cobranca[$status]) ? $this->mp_status_cobranca[$status]["texto"] :"");
					//$lblstatus_detail =(isset($this->mp_status_detail[$status_detail]) ? $this->mp_status_detail[$status_detail]["texto"] :"");
					//$lblstatus .= (!empty($lblstatus_detail) ? " | ". $lblstatus_detail : "");


					$dataJSON = json_encode($dataPOST);
					//$dataJSON = json_encode($results);

					$filename = "mercadopago_status_payment___". date("m") ."_". date("Y") .".log"; 
					$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
					if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

					$fp = fopen($dir_root ."/". $filename,"a+");
					fwrite($fp,"\n---- status_payment: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
					fwrite($fp,$dataJSON);	

				}













			/*
			 * -------------------------------------------------------------
			 * Grava o log no arquivo TXT
			 * -------------------------------------------------------------
			**/	
				$type = $this->request->getGetPost('type');

				$dataPOST = array(
					"type" => $type,
					"page" => 'notifications',
					"pgto_referencia" => $REFERENCIA,
				);
				$dataJSON = json_encode($dataPOST);

				//$dataPOST = $this->request->getPost();
				//$dataPOST = $this->request->getGetPost();
				$dataJSON = json_encode($dataPOST);

				$filename = "mercadopago_notifications___". date("m") ."_". date("Y") .".log"; 
				$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
				if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

				$fp = fopen($dir_root ."/". $filename,"a+");
				fwrite($fp,"\n---- notifications: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
				fwrite($fp,$dataJSON);	
		}






		return;
		/*
		 * -------------------------------------------------------------
		 * Grava o log no arquivo TXT
		 * -------------------------------------------------------------
		**/	
			$type = $this->request->getGetPost('type');

			$dataPOST = array(
				"type" => $type,
				"page" => 'notifications',
				"pgto_referencia" => $REFERENCIA,
			);
			$dataJSON = json_encode($dataPOST);

			//$dataPOST = $this->request->getPost();
			//$dataPOST = $this->request->getGetPost();
			$dataJSON = json_encode($dataPOST);

			$filename = "mercadopago_notifications___". date("m") ."_". date("Y") .".log"; 
			$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
			if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

			$fp = fopen($dir_root ."/". $filename,"a+");
			fwrite($fp,"\n---- notifications: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
			fwrite($fp,$dataJSON);	




		$type = $this->request->getGetPost('type');
		if( $type == "payment" )
		{
			$payment_id = $this->request->getGetPost('data_id');



			//$dataPOST = $this->request->getPost();
			$dataPOST = $this->request->getGetPost();
			$dataJSON = json_encode($dataPOST);

			$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
			if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

			$fp = fopen($dir_root ."/". $filename,"a+");
			fwrite($fp,"\n---- notifications: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
			fwrite($fp,$dataJSON);



			/*
			if( !empty($payment_id) )
			{
				\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);
				$payment = MercadoPago\Payment::find_by_id($payment_id);

				if ($payment->status == 'approved'){
					$external_ref = $payment->external_reference;
					if( !empty($external_ref) )
					{
						//self::atualizaStatusPedido( $external_ref );

						$status = $payment->status;
						$status_detail = $payment->status_detail;
						$lblstatus = (isset($this->mp_status_cobranca[$status]) ? $this->mp_status_cobranca[$status]["texto"] :"");
						$lblstatus_detail =(isset($this->mp_status_detail[$status_detail]) ? $this->mp_status_detail[$status_detail]["texto"] :"");
						$lblstatus .= (!empty($lblstatus_detail) ? " | ". $lblstatus_detail : "");

						$args_insert = array(
							"code" => $payment->id,
							"reference" => $external_ref,
							"status" => $payment->status,
							"status_label" => $lblstatus,
							//tran_status_label
							"valor" => $payment->transaction_amount,
							"json" => '',
						);
						self::insertTransaction($args_insert);

						// $results = $results->getArrayCopy();
						// $payment = end($results);
						// $json = json_encode( $payment->toArray() );					

						//$dataPOST = $this->request->getPost();
						$dataPOST = array(
							"action" => 'atualizou',
							"page" => 'notifications',
							"payment_status" => $payment->status,
							"payment_status_detail" => $payment->status_detail,
							"payment_transaction_amount" => $payment->transaction_amount,
							"external_ref" => $external_ref,
						);
						$dataJSON = json_encode($dataPOST);

						$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
						if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

						$fp = fopen($dir_root ."/". $filename,"a+");
						fwrite($fp,"\n---- approved ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
						fwrite($fp,$dataJSON);
					}
				}
			}
			*/

		}

		//$dataPOST = $this->request->getPost();
		$dataPOST = $this->request->getGetPost();
		$dataJSON = json_encode($dataPOST);

		$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
		if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

		$fp = fopen($dir_root ."/". $filename,"a+");
		fwrite($fp,"\n---- notifications: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
		fwrite($fp,$dataJSON);
	}



	public function feedback( $feedback_status = "" )
	{
		ini_set('memory_limit', '2048M');

		/*
		 * -------------------------------------------------------------
		 * Atualização enviada direto do Mercado Pago
		 * -------------------------------------------------------------
		**/


		/*
			https://misterlab.com.br/jafeston/public/index.php/mercadopg/feedback/success?collection_id=78635526925&collection_status=approved&payment_id=78635526925&status=approved&external_reference=N6SM4T-0001&payment_type=credit_card&merchant_order_id=18944713332&preference_id=80782311-fc51436e-c8b2-4917-ae2f-b0020149a628&site_id=MLB&processing_mode=aggregator&merchant_account_id=null		
		*/


		// Opções: feedback_status
			// success
			// failure
			// pending

		/*
		 * -------------------------------------------------------------
		 * success
		 * -------------------------------------------------------------
		**/
			if( $feedback_status == "success" ){
				//$dataPOST = $this->request->getPost();
				$dataPOST = $this->request->getGetPost();
				$dataJSON = json_encode($dataPOST);

				$filename = "mercadopago_notify__". $feedback_status ."___". date("m") ."_". date("Y") .".log"; 
				$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
				if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

				$fp = fopen($dir_root ."/". $filename,"a+");
				fwrite($fp,"\n---- feedback: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
				fwrite($fp,$dataJSON);	
			}

		/*
		 * -------------------------------------------------------------
		 * failure
		 * -------------------------------------------------------------
		**/
			if( $feedback_status == "failure" ){
				//$dataPOST = $this->request->getPost();
				$dataPOST = $this->request->getGetPost();
				$dataJSON = json_encode($dataPOST);

				$filename = "mercadopago_notify__". $feedback_status ."___". date("m") ."_". date("Y") .".log"; 
				$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
				if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

				$fp = fopen($dir_root ."/". $filename,"a+");
				fwrite($fp,"\n---- feedback: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
				fwrite($fp,$dataJSON);	
			}

		/*
		 * -------------------------------------------------------------
		 * pending
		 * -------------------------------------------------------------
		**/
			if( $feedback_status == "pending" ){
				//$dataPOST = $this->request->getPost();
				$dataPOST = $this->request->getGetPost();
				$dataJSON = json_encode($dataPOST);

				$filename = "mercadopago_notify__". $feedback_status ."___". date("m") ."_". date("Y") .".log"; 
				$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
				if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

				$fp = fopen($dir_root ."/". $filename,"a+");
				fwrite($fp,"\n---- feedback: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
				fwrite($fp,$dataJSON);	
			}


		/*
		 * -------------------------------------------------------------
		 * verificar se o external_reference existe no banco de dados
		 * -------------------------------------------------------------
		**/
			$external_reference = $this->request->getGetPost('external_reference');
			//$external_reference 
			//external_ref
			if( !empty($external_reference) )
			{
				//self::atualizaStatusPedido( $external_reference );
			}


			////$dataPOST = $this->request->getPost();
			//$dataPOST = $this->request->getGetPost();
			//$dataJSON = json_encode($dataPOST);

			//$filename = "mercadopago_notify__". $feedback_status ."___". date("m") ."_". date("Y") .".log"; 
			//$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
			//if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

			//$fp = fopen($dir_root ."/". $filename,"a+");
			//fwrite($fp,"\n---- feedback: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
			//fwrite($fp,$dataJSON);

		return $this->response->redirect( site_url() );
	}










	public function create_old()
	{
		//$post = $this->request->getPost();


		$KEY_MP = '';
		$produto = 'produto teste';
		$valor = 1.00;

		\MercadoPago\SDK::setAccessToken($KEY_MP);

		$payment = new \MercadoPago\Payment();

		$payment->transaction_amount = 1.00;
		$payment->description = $produto;
		$payment->payment_method_id = "pix";
		$payment->payer = array(
			"email" => "marcio.misterlab@gmail.com.com",
			"first_name" => "Marcio",
			"last_name" => "Lima",
			"identification" => array(
				"type" => "CPF",
				"number" => "17487363880"
			)
		);

		// dd($payment);
		if ($payment->save()) {

			print_r( $payment );

			/*
			$dados = [
				'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64,
				'qr_code' => $payment->point_of_interaction->transaction_data->qr_code,
				'payment_id' => $payment->id,
				'valor' =>  $valor,
				'produto' => $post['produto']

			];
			*/

			//echo view('qrcode', $dados);
		}
	}

	public function ingresso_OLD()
	{
		$this->data['mris_mobile'] = '';
		$this->data['mris_iphone'] = '';
		$this->data['mris_android'] = '';
		
		$detect = new MobileDetectLib();
		if ($detect->isMobile() || $detect->isTablet()) {
			//echo "<br />MOBILE OR TABLET DEVICE";

			$this->data['mris_mobile'] = 'mris_mobile';
			$dataContent['isMobileOrTablet'] = true; 
			if( $detect->isiOS() ){ 
				$this->data['mris_iphone'] = 'mris_iphone';
				$dataContent['isiOS'] = true;
				//echo "<br />IOS"; 

				$version = $detect->version('iPhone');
				$dataContent['iPhone_version'] = $version;
				//echo "<br />versao: ". $version;
			}
			if( $detect->isAndroidOS() ){ 
				$dataContent['isAndroidOS'] = true;
				//echo "<br />ANDROID"; 
				$this->data['mris_android'] = 'mris_android';
			}
		} else { 
			$dataContent['DESKTOP'] = true;
			//echo "<br />DESKTOP"; 
		}


		$qryIngresso = $this->prodMD
			->where('prod_area', 'ingressos')
			->where('prod_ativo', '1')
			->orderBy('prod_id', 'DESC')
			->limit(1)
			->get();
		if( $qryIngresso && $qryIngresso->resultID->num_rows >=1 )
		{
			$this->data['rs_ingresso'] = $qryIngresso->getRow();
		}

		$this->data["data_pagseguro"] = self::pgs_ingresso();

		return view('ingresso', $this->data);
	}

	public function nofitication_OLD()
	{
		ini_set('memory_limit', '2048M');

		$filename = "pagseguro_notify___". date("m") ."_". date("Y") .".log"; 

		$dataPOST = $this->request->getPost();
		////$dataPOST = $ci->input->post(NULL, TRUE);
		$dataJSON = json_encode($dataPOST);

		$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
		if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

		$fp = fopen($dir_root ."/". $filename,"a+");
		fwrite($fp,"\n---- ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
		fwrite($fp,$dataJSON);

		$response = (object) json_decode($dataJSON);
		if( isset($response->notificationCode) && isset($response->notificationType)  )
		{
			self::consulta( $response->notificationCode );	
		}
	}

	public function pgs_ingresso()
	{
		if ( session()->get('isPayment') ) 
		{
			$continuar = false;

			$qryIngresso = $this->prodMD
				->where('prod_area', 'ingressos')
				->where('prod_ativo', '1')
				->orderBy('prod_id', 'DESC')
				->limit(1)
				->get();
			if( $qryIngresso && $qryIngresso->resultID->num_rows >=1 )
			{
				$rs_ingresso = $qryIngresso->getRow();
				$ingresso_id = $rs_ingresso->prod_id;
				$ingresso_titulo = $rs_ingresso->prod_titulo;
				$ingresso_valor = $rs_ingresso->prod_valor;
				$ingresso_quant = 1;

				$continuar = true;
			}


			// ----------------------------------------------------------
			// verificamos se tem um pedido pendente
			// A70D4E0AC7C7A2EEE4E48FAFED500B24
			// ----------------------------------------------------------
			//$qryPedido = $this->pedMD
				//->where('cad_id', (int)session()->get('cad_id'))
				//->orderBy('ped_id', 'DESC')
				//->limit(1)
				//->get();
			//if( ($qryPedido && $qryPedido->resultID->num_rows >=1) && $continuar === true )
			//{
				//$rs_pedido = $qryPedido->getRow();
				//if( !empty($rs_pedido->ped_code_checkout) )
				//{
					//return array(
						//"success" => "success",
						//"code_checkout" => $rs_pedido->ped_code_checkout,
						//"code_ingresso" => $rs_pedido->ped_referencia,
					//);
				//}
			//}



			$qryCad = $this->cadMD
				->where('cad_id', (int)session()->get('cad_id'))
				->orderBy('cad_id', 'DESC')
				->limit(1)
				->get();
			if( ($qryCad && $qryCad->resultID->num_rows >=1) && $continuar === true )
			{
				$rs_cad = $qryCad->getRow();
				$cad_id = $rs_cad->cad_id;
				$cad_nome = $rs_cad->cad_nome;
				$cad_apelido = $rs_cad->cad_apelido;
				$cad_email = $rs_cad->cad_email;

				$cad_telefone = '';
				$cad_cpf = '';

				$cad_telefone = (empty($cad_telefone) ? "12345678" : $cad_telefone);
				$cad_cpf = (empty($cad_cpf) ? "12312312387" : $cad_cpf);

				$cod_referencia_pagto = strtoupper(random_string('alnum', 6)) .'-'. str_pad($cad_id, 4, "0", STR_PAD_LEFT); 
		
				//$payment->setRedirectUrl("http://www.lojamodelo.com.br");
				//$payment->setNotificationUrl("http://www.lojamodelo.com.br/nofitication");

				//$pg_url_redirect = 'https://oncloud.misterlab.com.br/';
				$pg_url_redirect = site_url();
				//site_url(); // setRedirectUrl
				
				//$pg_url_nofitication = 'https://oncloud.misterlab.com.br/index.php/pagseguro/nofitication';
				$pg_url_nofitication = site_url('pagseguro/nofitication');

				\PagSeguro\Library::initialize();
				\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
				\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

				$payment = new \PagSeguro\Domains\Requests\Payment();

				$payment->addItems()->withParameters(
					$ingresso_id,
					$ingresso_titulo,
					$ingresso_quant,
					$ingresso_valor
				);

				$payment->setCurrency("BRL");
				// $payment->setExtraAmount(11.5); // valores extras
				$payment->setReference($cod_referencia_pagto);

				// Set your customer information.
				$payment->setSender()->setName( $cad_nome );
				$payment->setSender()->setEmail( $cad_email );
				$payment->setSender()->setPhone()->withParameters(
					11,
					$cad_telefone
				);
				$payment->setSender()->setDocument()->withParameters(
					'CPF',
					$cad_cpf
				);

				// shipping: addressRequired
				$payment->setShipping()->setAddressRequired()->withParameters('FALSE');

				$payment->setRedirectUrl( $pg_url_redirect );
				$payment->setNotificationUrl( $pg_url_nofitication );

				try {

					/**
					 * @todo For checkout with application use:
					 * \PagSeguro\Configuration\Configure::getApplicationCredentials()
					 *  ->setAuthorizationCode("FD3AF1B214EC40F0B0A6745D041BF50D")
					 */
					//$result = $payment->register(
						//\PagSeguro\Configuration\Configure::getAccountCredentials()
					//);

					$onlyCheckoutCode = true;
					$result = $payment->register(
						\PagSeguro\Configuration\Configure::getAccountCredentials(),
						$onlyCheckoutCode
					);

					$data_pedido = [
						'ped_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
						'cad_id' => $cad_id,
						'ped_referencia' => $cod_referencia_pagto,
						'ped_nome' => $cad_id,
						'ped_email' => $cad_id,
						'ped_code_checkout' => $result->getCode(), 
						'ped_dte_cadastro' => date("Y-m-d H:i:s"),
						'ped_dte_alteracao' => date("Y-m-d H:i:s"),
						'ped_ativo' => 1,
					];
					$ped_id = $this->pedMD->insert($data_pedido);

					return array(
						"success" => "success",
						"code_checkout" => $result->getCode(),
						"code_ingresso" => $cod_referencia_pagto
					);

				} catch (Exception $e) {
					//die($e->getMessage());
					return array(
						"error" => "error",
						"error_msg" => $e->getMessage(),
					);
				}
				// ----------------------------------------------------------

			}
		}
	}

	public function consulta($param="")
	{
		helper('text');

		//$notificationCode = '46069E-EE58E558E536-EAA46BFFBAB3-12128E';	// sandbox ok
		if( !empty($param) )
		{
			$notificationCode = $param;
			
			$url_transaction = $this->PGS_URL .'/v2/transactions/notifications/'. $notificationCode .'?email='. $this->PGS_EMAIL .'&token='. $this->PGS_TOKEN;

			$curl = curl_init();
			//curl_setopt($curl, CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
			//curl_setopt($curl, CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=iso-8859-1"));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_HTTPGET, 1);
			curl_setopt($curl, CURLOPT_URL, $url_transaction );
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,  2);
			curl_setopt($curl, CURLOPT_DNS_USE_GLOBAL_CACHE, FALSE );
			curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
			//curl_setopt($curl, CURLOPT_POST, TRUE);
			//curl_setopt($curl, CURLOPT_POSTFIELDS, $BuildQuery);
			$output = curl_exec($curl);
			$output = utf8_encode($output);
			//curl_close($Curl);
			//fct_print_debug( $output );

			$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);

			$response = (object) json_decode($statusCode);
			
			//fct_print_debug( $statusCode );
			//echo "<pre>";
			//print_r($response);
			//echo "</pre>";

			if ($statusCode === 200) // conectou com sucesso
			{
				$xmlObject = simplexml_load_string($output);
					  
				$json = json_encode($xmlObject);
				$phpArray = json_decode($json);

				$PEDIDO_CODE = (isset($phpArray->code) ? $phpArray->code : "");
				$PEDIDO_REFERENCIA = (isset($phpArray->reference) ? $phpArray->reference : "");
				$PEDIDO_STATUS = (isset($phpArray->status) ? $phpArray->status : "");
				$PEDIDO_VALOR = (isset($phpArray->grossAmount) ? $phpArray->grossAmount : "");

				$args_insert = array(
					"code" => $PEDIDO_CODE,
					"reference" => $PEDIDO_REFERENCIA,
					"status" => $PEDIDO_STATUS,
					"valor" => $PEDIDO_VALOR,
					"json" => $json,
				);
				self::insertTransaction($args_insert);

				exit();
			}else{ // ocorreu algum erro

				ini_set('memory_limit', '2048M');
				$filename = "pagseguro_notify_error___". date("m") ."_". date("Y") .".log"; 

				$dataContent = array();
				$dataPOST = $this->request->getPost();
				$dataJSON = json_encode($dataPOST);
				$dataResponseJSON = json_encode($statusCode);

				$dataContent = array_merge($dataContent, json_decode($dataJSON));
				//$dataContent = array_merge($dataContent, json_decode(json_encode($response)));

				$responset = json_decode($statusCode);
				$array_temp = array(
					'statusCode'=> $responset
				);
				$dataContent = array_merge($dataContent, $array_temp);

				//echo "<pre>";
				//var_dump( $responset );
				//echo "</pre>";

				//echo "<pre>";
				//print_r($dataContent);
				//echo "</pre>";

				$dataContent = json_encode($dataContent);

				if( !empty($dataContent) )
				{
					$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
					if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

					$fp = fopen($dir_root ."/". $filename,"a+");
					fwrite($fp,"\n---- ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
					fwrite($fp,$dataContent);
				}
			}

		}
	}

	public function transaction_by_reference($param="")
	{
		// k https://ws.pagseguro.uol.com.br/v2/transactions -d
		//“email=busca-api@pagseguro.com.br
		//&token=2507D8278A9D478D94327BABDDC2A573
		//&reference=REF123456”
		//&initialDate=2021-11-01T00:00
		//&finalDate=2014-04-20T00:00

		helper('text');

		//$reference = "EQHBAT-0008";
		//$reference = "LIBPHP000001";
		//$reference = "KK1IQF-0010";

		if( !empty($param) )
		{
			$reference = $param;

			$url_transaction = $this->PGS_URL .'/v2/transactions?email='. $this->PGS_EMAIL .'&token='. $this->PGS_TOKEN .'&reference='. $reference;

			// ---------------------------------------------------------------
			$curl = curl_init();
			//curl_setopt($curl, CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
			//curl_setopt($curl, CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=iso-8859-1"));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_HTTPGET, 1);
			curl_setopt($curl, CURLOPT_URL, $url_transaction );
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,  2);
			curl_setopt($curl, CURLOPT_DNS_USE_GLOBAL_CACHE, FALSE );
			curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
			//curl_setopt($curl, CURLOPT_POST, TRUE);
			//curl_setopt($curl, CURLOPT_POSTFIELDS, $BuildQuery);
			$output = curl_exec($curl);
			$output = utf8_encode($output);
			//curl_close($Curl);
			//fct_print_debug( $output );

			$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);

			$response = (object) json_decode($statusCode);

			if ($statusCode === 200) // conectou com sucesso
			{
				$xmlObject = simplexml_load_string($output);
					  
				$json = json_encode($xmlObject);
				$phpArray = json_decode($json);

				// faz um loop dentro das transações ocorridas
				// -------------------------------------------------------
				if( isset($phpArray->transactions) ){
					$transaction = $phpArray->transactions->transaction;
					$pkCount = (is_array($transaction) ? count($transaction) : 0);

					if( $pkCount == 0 ){
						$valueTRT = $phpArray->transactions->transaction;
						$args_insert = array(
							"code" => $valueTRT->code,
							"reference" => $valueTRT->reference,
							"status" => $valueTRT->status,
							"valor" => $valueTRT->grossAmount,
							"json" => $json,
						);
						self::insertTransaction($args_insert);

						$status = (int)$valueTRT->status;
						$lblstatus = (isset($this->psg_status_transacoes[$status]) ? $this->psg_status_transacoes[$status]["texto"] :"");
					}else{
						foreach ($phpArray->transactions->transaction as $keyTRT => $valueTRT)
						{
							$args_insert = array(
								"code" => $valueTRT->code,
								"reference" => $valueTRT->reference,
								"status" => $valueTRT->status,
								"valor" => $valueTRT->grossAmount,
								"json" => $json,
							);
							self::insertTransaction($args_insert);

							$status = (int)$valueTRT->status;
							$lblstatus = (isset($this->psg_status_transacoes[$status]) ? $this->psg_status_transacoes[$status]["texto"] :"");
						}
					}

				}else{
					ini_set('memory_limit', '2048M');
					$filename = "pagseguro_transaction_ref_error_xxx___". date("m") ."_". date("Y") .".log"; 
					$dataContent = json_encode($phpArray);
					if( !empty($dataContent) )
					{
						$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
						if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

						$fp = fopen($dir_root ."/". $filename,"a+");
						fwrite($fp,"\n---- ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
						fwrite($fp,$dataContent);
					}
				}
				// -------------------------------------------------------
			}else{ // ocorreu algum erro

				ini_set('memory_limit', '2048M');
				$filename = "pagseguro_transaction_ref_error___". date("m") ."_". date("Y") .".log"; 

				$dataContent = array();
				$dataPOST = $this->request->getPost();
				$dataJSON = json_encode($dataPOST);
				$dataResponseJSON = json_encode($statusCode);

				$dataContent = array_merge($dataContent, json_decode($dataJSON));
				//$dataContent = array_merge($dataContent, json_decode(json_encode($response)));

				$responseStatusCode = json_decode($statusCode);
				$array_temp = array(
					'statusCode'=> $responseStatusCode
				);
				$dataContent = array_merge($dataContent, $array_temp);
				$dataContent = json_encode($dataContent);

				if( !empty($dataContent) )
				{
					$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
					if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);

					$fp = fopen($dir_root ."/". $filename,"a+");
					fwrite($fp,"\n---- ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
					fwrite($fp,$dataContent);
				}
			}
		}
	}


	public function insertTransaction( $args=array() )
	{
		$PEDIDO_CODE = (isset($args["code"]) ? $args["code"] : "");
		$PEDIDO_REFERENCIA = (isset($args["reference"]) ? $args["reference"] : ""); 
		$PEDIDO_STATUS = (isset($args["status"]) ? $args["status"] : "");
		$PEDIDO_STATUS_DETAIL = (isset($args["status_detail"]) ? $args["status_detail"] : "");
		$PEDIDO_STATUS_LABEL = (isset($args["status_label"]) ? $args["status_label"] : "");
		$PEDIDO_DTE_LAST_UPDATED = (isset($args["date_last_updated"]) ? $args["date_last_updated"] : "");
		$PEDIDO_VALOR = (isset($args["valor"]) ? $args["valor"] : "");
		$json = (isset($args["json"]) ? $args["json"] : "");

		if( !empty($PEDIDO_CODE) && !empty($PEDIDO_REFERENCIA) )
		{
			$qryTrans = $this->tranMD
				->where('tran_codigo', $PEDIDO_CODE)
				->where('tran_referencia', $PEDIDO_REFERENCIA)
				->where('tran_status', $PEDIDO_STATUS)
				->orderBy('tran_id', 'DESC')
				->limit(1)
				->get();
			if( $qryTrans && $qryTrans->resultID->num_rows == 0 )
			{
				//$rs_transacao = $qryTrans->getRow();
				$data_db = [
					'tran_payment' => 'mercado-pago',
					'tran_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'tran_codigo' => $PEDIDO_CODE,
					'tran_referencia' => $PEDIDO_REFERENCIA,
					'tran_status' => $PEDIDO_STATUS,
					'tran_status_detail' => $PEDIDO_STATUS_DETAIL,
					'tran_status_label' => $PEDIDO_STATUS_LABEL,
					'tran_date_last_updated' => $PEDIDO_DTE_LAST_UPDATED,
					'tran_valor' => $PEDIDO_VALOR,
					'tran_json' => ($json),
					'tran_dte_cadastro' => date("Y-m-d H:i:s"),
					'tran_dte_alteracao' => date("Y-m-d H:i:s"),
					'tran_ativo' => 1,
				];
				$tran_id = $this->tranMD->insert($data_db);

				// ------------------------------------------------------
				// quando transação for Paga
				// atualizar o cadastro para liberado
				// ------------------------------------------------------
				if( $PEDIDO_STATUS == 'approved')
				{
					$qryPedido = $this->pedMD->where('ped_referencia', $PEDIDO_REFERENCIA)
						->limit(1)
						//->getCompiledSelect();
						->get();
					if( $qryPedido && $qryPedido->resultID->num_rows >= 1 )
					{	
						$rs_pedido = $qryPedido->getRow();
						$data_pedido = [
							'ped_liberado' => 1,
							'ped_dte_liberado' => date("Y-m-d H:i:s"),
							'ped_dte_alteracao' => date("Y-m-d H:i:s"),
							'ped_ativo' => 1,
						];
						$this->pedMD->update(['ped_referencia' => $PEDIDO_REFERENCIA, 'ped_id' => $rs_pedido->ped_id], $data_pedido);

						$data_cadastro = [
							'cad_liberado' => 1,
							'cad_dte_liberado' => date("Y-m-d H:i:s"),
						];
						$this->cadMD->update(['cad_id' => $rs_pedido->cad_id], $data_cadastro);

						/*
						* -------------------------------------------------------------
						* enviando email após confirmação de pagamento
						* -------------------------------------------------------------
						**/	
							//self::enviarEmailConfirmacao($rs_pedido->cad_id);
					}		
				}

				// ------------------------------------------------------
				// enviar dados para o webhook
				// ------------------------------------------------------
				//$filename = "webhook___". date("m") ."_". date("Y") .".log"; 
				//$dir_root = WRITEPATH ."/uploads";//. $strarquivo;
				//if( !is_dir($dir_root) ) mkdir($dir_root, 0777, TRUE);
		
				//$fp = fopen($dir_root ."/". $filename,"a+");
				//fwrite($fp,"\n---- webhook: ". date("d/m/Y H:i:s")  ." - informacoes da mensagem ---- \n");
				//fwrite($fp, json_encode($data_db) );

			}
		}
	}

	public function enviarEmailConfirmacao($cad_id)
	{
		$qryCad = $this->cadMD
			->where('cad_id', (int)$cad_id)
			->orderBy('cad_id', 'DESC')
			->limit(1)
			->get();
		if( ($qryCad && $qryCad->resultID->num_rows >=1) )
		{
			$rs_cad = $qryCad->getRow();
			$cad_id = $rs_cad->cad_id;
			$cad_hashkey = $rs_cad->cad_hashkey;
			$cad_email = $rs_cad->cad_email; 
			$cad_nome_completo = $rs_cad->cad_nome_completo; 
			$cad_qrcode = $rs_cad->cad_qrcode;
			$url_meu_ingresso = site_url('imprimir/'. $cad_hashkey);

			$fields_email = [
				'cad_id' => $cad_id,
				'url_meu_ingresso' => $url_meu_ingresso,
				'cad_nome_completo' => $cad_nome_completo,
			];
			$stringEmail = view('emails/confirmacao', $fields_email);

			$arr_emails_sender = [];
			$arr_emails_sender = array_merge($arr_emails_sender, array($cad_email));

			$arr_anexos = [];
			// $folderFotos = 'files-upload/';
			// $path_file = $folderFotos . $cad_qrcode .'.pdf';

			// if( file_exists($path_file) && !empty($cad_qrcode) )
			// {	
			// 	$arr_anexos = array( $folderFotos . $cad_qrcode .'.pdf' );
			// }

			$pMail = new PHPMailerLib();
			$args_email = array(
				"body"			=> $stringEmail,
				"subject"		=> 'Novo Cadastro',
				"fields"		=> [],
				"enviar_para"	=> $arr_emails_sender,
				"anexos"		=> $arr_anexos,
			);
			$pMail->send($args_email);
		}
	// -------------------------------------------------------------
	}

	public function enviarEmailConfirmacaoTeste($cad_id)
	{
		$qryCad = $this->cadMD
			->where('cad_id', (int)$cad_id)
			->orderBy('cad_id', 'DESC')
			->limit(1)
			->get();
		if( ($qryCad && $qryCad->resultID->num_rows >=1) )
		{
			$rs_cad = $qryCad->getRow();
			$cad_id = $rs_cad->cad_id;
			$cad_hashkey = $rs_cad->cad_hashkey;
			$cad_email = $rs_cad->cad_email; 
			$cad_nome_completo = $rs_cad->cad_nome_completo; 
			$cad_qrcode = $rs_cad->cad_qrcode;
			$url_meu_ingresso = site_url('imprimir/'. $cad_hashkey);

			$fields_email = [
				'cad_id' => $cad_id,
				'url_meu_ingresso' => $url_meu_ingresso,
				'cad_nome_completo' => $cad_nome_completo,
			];
			$stringEmail = view('emails/confirmacao', $fields_email);

			$cad_email = 'listasguardiao@gmail.com';
			$arr_emails_sender = [];
			$arr_emails_sender = array_merge($arr_emails_sender, array($cad_email));

			$arr_anexos = [];
			// $folderFotos = 'files-upload/';
			// $path_file = $folderFotos . $cad_qrcode .'.pdf';

			// if( file_exists($path_file) && !empty($cad_qrcode) )
			// {	
			// 	$arr_anexos = array( $folderFotos . $cad_qrcode .'.pdf' );
			// }

			$pMail = new PHPMailerLib();
			$args_email = array(
				"body"			=> $stringEmail,
				"subject"		=> 'Novo Cadastro',
				"fields"		=> [],
				"enviar_para"	=> $arr_emails_sender,
				"anexos"		=> $arr_anexos,
			);
			$pMail->send($args_email);
		}
	// -------------------------------------------------------------
	}	

	public function ajaxform( $action="" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";

		switch ($action) {
		case "GET-STATUS-BY-REFERENCE" :

			$PEDIDO_REFERENCIA = $this->request->getPost('reference');
			if( !empty($PEDIDO_REFERENCIA) )
			{
				//self::transaction_by_reference($reference);

				// --------------------------------------------------------------
				\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);

				$filters = array(
					"external_reference" => $PEDIDO_REFERENCIA
				);
				//$result = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create

				$results = MercadoPago\Payment::search($filters);
				//print "<pre>";
				//print_r($results);
				//print "</pre>";

				if( (int)$results->total >= 1 ){
					$results = $results->getArrayCopy();
					$payment = end($results);
					$json = json_encode( $payment->toArray() );

					$status = $payment->status;
					$status_detail = $payment->status_detail;
					$lblstatus = (isset($this->mp_status_cobranca[$status]) ? $this->mp_status_cobranca[$status]["texto"] :"");
					$lblstatus_detail =(isset($this->mp_status_detail[$status_detail]) ? $this->mp_status_detail[$status_detail]["texto"] :"");
					$lblstatus .= (!empty($lblstatus_detail) ? " | ". $lblstatus_detail : "");

					$args_insert = array(
						"code" => $payment->id,
						"reference" => $PEDIDO_REFERENCIA,
						"status" => $payment->status,
						"status_label" => $lblstatus,
						//tran_status_label
						"valor" => $payment->transaction_amount,
						"json" => $json,
					);
					self::insertTransaction($args_insert);

					// https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=testeMPONCLOUD-001
					// --------------------------------------------------------------

					$error_num = "0";
					$error_msg = "consulta ok";

				}else{
					$error_num = "1";
					$error_msg = "Nenhum pagamento encontrado";
				}
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg ,
				"reference" => $PEDIDO_REFERENCIA ,
			);

			echo( json_encode($arr_return) );
			exit();
			
			break;
		}
	}

	public function atualizaStatusPedido( $PEDIDO_REFERENCIA = "" )
	{
		if( !empty($PEDIDO_REFERENCIA) )
		{
			//self::transaction_by_reference($reference);

			// --------------------------------------------------------------
			\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);

			$filters = array(
				"external_reference" => $PEDIDO_REFERENCIA
			);
			//$result = MercadoPago\Preference::search($filters); # Save the preference and send the HTTP Request to create

			$results = MercadoPago\Payment::search($filters);

			if( (int)$results->total >= 1 ){
				$results = $results->getArrayCopy();
				$payment = end($results);
				$json = json_encode( $payment->toArray() );

				$status = $payment->status;
				$status_detail = $payment->status_detail;
				$date_last_updated = $payment->date_last_updated;
				$lblstatus = (isset($this->mp_status_cobranca[$status]) ? $this->mp_status_cobranca[$status]["texto"] :"");
				$lblstatus_detail =(isset($this->mp_status_detail[$status_detail]) ? $this->mp_status_detail[$status_detail]["texto"] :"");
				$lblstatus .= (!empty($lblstatus_detail) ? " | ". $lblstatus_detail : "");

				$args_insert = array(
					"code" => $payment->id,
					"reference" => $PEDIDO_REFERENCIA,
					"status" => $payment->status,
					"status_detail" => $status_detail,
					"status_label" => $lblstatus,
					"date_last_updated" => $date_last_updated,
					//tran_status_label
					"valor" => $payment->transaction_amount,
					"json" => $json,
				);
				self::insertTransaction($args_insert);

				// https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=testeMPONCLOUD-001
				// --------------------------------------------------------------

				$error_num = "0";
				$error_msg = "consulta ok";

			}else{
				$error_num = "1";
				$error_msg = "Nenhum pagamento encontrado";
			}
		}
	}
	

	/*
		<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
		<transaction>
			<date>2021-11-28T14:07:17.000-03:00</date>
			<code>C7CABF9C-435B-4319-8DC1-264CFC6C2FAE</code>
			<reference>LIBPHP000002</reference>
			<type>1</type>
			<status>3</status>
			<lastEventDate>2021-11-28T14:09:14.000-03:00</lastEventDate>
			<paymentMethod><type>1</type>
			<code>102</code></paymentMethod>
			<grossAmount>3.00</grossAmount>
			<discountAmount>0.00</discountAmount>
			<feeAmount>0.55</feeAmount>
			<netAmount>2.45</netAmount>
			<extraAmount>0.00</extraAmount>
			<escrowEndDate>2021-12-12T14:09:14.000-03:00</escrowEndDate>
			<installmentCount>1</installmentCount>
			<itemCount>1</itemCount>
			<items>
				<item>
					<id>0002</id>
					<description>Ingresso MetaVerso Festival 2021</description>
					<quantity>1</quantity>
					<amount>3.00</amount>
				</item>
			</items>
			<sender>
				<name>Marcio Lima</name>
				<email>marcio.misterlab@gmail.com</email>
				<phone>
					<areaCode>11</areaCode>
					<number>948919736</number>
				</phone>
			</sender>
		</transaction>
	*/


	public function getDataReferencia( $args = [] )
	{
		$PEDIDO_REFERENCIA = (isset($args["PEDIDO_REFERENCIA"]) ? $args["PEDIDO_REFERENCIA"] : "");
		$CAD_ID = (int)(isset($args["CAD_ID"]) ? $args["CAD_ID"] : "");
		$PED_ID = (int)(isset($args["PED_ID"]) ? $args["PED_ID"] : ""); 

		if( !empty($PEDIDO_REFERENCIA) && $CAD_ID > 0 && $PED_ID > 0 )
		{
			\MercadoPago\SDK::setAccessToken($this->MP_ACCESS_TOKEN);
			$filters = array(
				"external_reference" => $PEDIDO_REFERENCIA
			);
			$results = MercadoPago\Payment::search($filters);

			if( (int)$results->total >= 1 ){
				$results = $results->getArrayCopy();
				//$payment = end($results);

				$arra_data = [];
				$arr_itens = []; 
				$cont = 0;
				foreach ($results as $keyPref => $valPref)
				{
					$cont++;
					//print $valPref->id;
					$payment = ($valPref);
					$json = json_encode( $payment->toArray() );

					$status = $payment->status;
					$status_detail = $payment->status_detail;
					$lblstatus = (isset($this->mp_status_cobranca[$status]) ? $this->mp_status_cobranca[$status]["texto"] :"");
					$lblstatus_detail =(isset($this->mp_status_detail[$status_detail]) ? $this->mp_status_detail[$status_detail]["texto"] :"");
					$lblstatus .= (!empty($lblstatus_detail) ? " | ". $lblstatus_detail : "");
	
					$arr_itens[] = array(
						"cont" => $cont,
						"code" => $payment->id,
						"reference" => $PEDIDO_REFERENCIA,
						"status" => $payment->status,
						"status_label" => $lblstatus,
						"status_label" => $lblstatus,
						"status_detail" => $status_detail, 
						"valor" => $payment->transaction_amount,
						//"json" => $json,
					);

					$qryPaym = $this->paymMD
						->where('paym_referencia', $PEDIDO_REFERENCIA)
						->where('paym_codigo', $payment->id)
						->orderBy('ped_id', 'ASC')
						->limit(1)
						->get();
					if( $qryPaym && $qryPaym->resultID->num_rows == 0 )
					{	
						$this->paymMD->set('paym_hashkey', md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)));
						$this->paymMD->set('paym_codigo', $payment->id);
						$this->paymMD->set('paym_status', $payment->status);
						$this->paymMD->set('paym_status_detail', $payment->status_detail);
						$this->paymMD->set('paym_date_created', $payment->date_created);
						$this->paymMD->set('paym_valor', $payment->transaction_amount);
						$this->paymMD->set('paym_json', $json);	
						$this->paymMD->set('paym_payment', 'mercado-pago');	
						$this->paymMD->set('paym_referencia', $PEDIDO_REFERENCIA);		
						$this->paymMD->set('cad_id', $CAD_ID);
						$this->paymMD->set('ped_id', $PED_ID);
						$this->paymMD->set('paym_dte_cadastro', date("Y-m-d H:i:s"));
						$this->paymMD->set('paym_dte_alteracao', date("Y-m-d H:i:s"));
						$this->paymMD->insert();
						//$this->paymMD->where('user_id', (int)session()->get('user_id'));
						//$this->paymMD->update();
					}else{
						$rs_paym = $qryPaym->getRow();
						$paym_hashkey = $rs_paym->paym_hashkey;

						// Atualiza o Status de Pagamento
						//$this->paymMD->set('paym_hashkey', md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)));
						$this->paymMD->set('paym_status', $payment->status);
						$this->paymMD->set('paym_status_detail', $payment->status_detail);
						$this->paymMD->set('paym_date_created', $payment->date_created);
						$this->paymMD->set('paym_valor', $payment->transaction_amount);
						$this->paymMD->set('paym_json', $json);	
						//$this->paymMD->set('paym_payment', 'mercado-pago');	
						//$this->paymMD->set('paym_referencia', $PEDIDO_REFERENCIA);		
						//$this->paymMD->set('cad_id', $CAD_ID);
						//$this->paymMD->set('ped_id', $PED_ID);
						//$this->paymMD->set('paym_dte_cadastro', date("Y-m-d H:i:s"));
						$this->paymMD->set('paym_dte_alteracao', date("Y-m-d H:i:s"));
						$this->paymMD->where('paym_hashkey', $paym_hashkey);
						$this->paymMD->where('paym_referencia', $PEDIDO_REFERENCIA);
						$this->paymMD->where('paym_codigo', $payment->id);
						$this->paymMD->update();
					}
					//self::insertTransaction($args_insert);
				}				




				// https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=testeMPONCLOUD-001
				// --------------------------------------------------------------

				$error_num = "0";
				$error_msg = "consulta ok";

				$arr_return = [
					'error_num' => $error_num,
					'error_msg' => $error_msg,
					'data' => $arr_itens,
				];
			}else{
				$error_num = "1";
				$error_msg = "Nenhum pagamento encontrado";
				$arr_return = [
					'error_num' => $error_num,
					'error_msg' => $error_msg,
				];				
			}
			return $arr_return; 

			// echo('<pre>');
			// print_r( $arr_return );
			// echo('</pre>');
		}
	}

}
