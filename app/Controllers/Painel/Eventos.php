<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Eventos extends PainelController
{
	protected $eventMD = null;
	protected $evdteMD = null;
	protected $evvlrMD = null;
	protected $evcobMD = null;
	protected $evcfgMD = null;
	protected $funcMD = null;
	protected $formtMD = null;
	protected $autzMD = null;
	protected $evtautMD = null;
	protected $folder_upload = null;

    public function __construct()
    {
        $this->eventMD = new \App\Models\EventosModel();
		$this->evdteMD = new \App\Models\EventosDatasModel();
		$this->evvlrMD = new \App\Models\EventosValoresModel();
		$this->evcobMD = new \App\Models\EventosCobrancaModel();
		$this->evcfgMD = new \App\Models\EventosConfigModel();
		$this->funcMD = new \App\Models\FuncoesModel();
		$this->formtMD = new \App\Models\FormatosModel();

		$this->autzMD = new \App\Models\AutorizacoesModel();
		$this->evtautMD = new \App\Models\EventosAutorizacoesModel();

		$this->data['menu_active'] = 'eventos';

		$this->folder_upload = 'files-upload/';
		$this->data['folder_upload'] = $this->folder_upload;
    }


	public function index()
	{
		return self::filtrar();
	}


	public function filtrar()
	{
		$filtro_pdf = '';
		// filtrar/user:marcio/cliente:123/dini:/dteend:/status:pago

		$uri = service('uri'); // Obter a instância do objeto URI
		$segments = $uri->getSegments();
		$index = array_search('filtrar', $segments); // Encontrar o índice do segmento "filtrar"

		$filteredSegments = array_slice($segments, $index + 1); // Retornar os elementos a partir de $index + 1 até o final


		$this->eventMD
			->where('insti_id', (int)$this->session_user_id)
			->orderBy('event_id', 'DESC')
			->limit(1000);
		$query = $this->eventMD->get();
		//$this->data['lastQuery'] = $this->eventMD->getLastQuery();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/eventos', $this->data);
	}


	public function form( $event_id = 0 )
	{
		$this->data['event_id'] = (int)$event_id;

		//$payment_methods = array(
		//	/*
		//	// excluir tipos de pagamento
		//	"excluded_payment_types" => array(
		//		array("id" => "ticket")
		//	),
		//	*/
		//	"installments" => 3
		//);


		//$payment_types_default = array(
		//	array("id" => "bank_transfer"),
		//	array("id" => "atm"),
		//	array("id" => "credit_card"),
		//	array("id" => "debit_card"),
		//	array("id" => "ticket"),
		//);
	
		//$payment_selected = Array ( 
		//	'bank_transfer',
		//	'debit_card',
		//	'ticket'
		//);

		//// Extrai apenas os valores 'id' de $payment_types_default
		//$default_ids = array_column($payment_types_default, 'id');

		//// Encontra os elementos em $default_ids que não estão em $payment_selected
		//$missing_elements = array_diff($default_ids, $payment_selected);

		//// Gera o array de retorno com os elementos ausentes
		//$return_array = array_map(function ($id) {
		//	return array('id' => $id);
		//}, $missing_elements);

		//// Mostra os elementos que estão em $payment_types_default mas não estão em $payment_selected
		//print '<pre>';
		//print_r($return_array);
		//print '</pre>';

		//$exluidos = array( "excluded_payment_types" => $return_array );
		//$result = array_merge($payment_methods, $exluidos);


		////$stack = array("orange", "banana");
		////array_push($payment_methods, $exluidos);
		
		//print '<pre>';
		//print_r($result);
		//print '</pre>';


		//exit();

		$this->data['listFormaCobranca'] = $this->cfgAPP->getFormaCobranca();
		$this->data['listFormaCobrancaTipo'] = $this->cfgAPP->getFormaCobrancaTipo();
		$this->data['listTipoCobranca'] = $this->cfgAPP->getTipoCobranca();
		$listTipoCobrancaDoacoes = $this->cfgAPP->getTipoCobrancaDoacoes();
		$this->data['listTipoCobrancaDoacoes'] = $listTipoCobrancaDoacoes;		
		$listDoacaoTipoEntrega = $this->cfgAPP->getDoacaoTipoEntrega();
		$this->data['listDoacaoTipoEntrega'] = $listDoacaoTipoEntrega;	

		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"event_titulo" => [
					"label" => "Nome", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$event_titulo = $this->request->getPost('event_titulo');
				$event_data = $this->request->getPost('event_data');
				$event_hrs_ini = $this->request->getPost('event_hrs_ini');
				$event_limit_coreografia = (int)$this->request->getPost('event_limit_coreografia');
				$event_limit_participantes = (int)$this->request->getPost('event_limit_participantes');
				$event_show_result_site = $this->request->getPost('event_show_result_site');
				$event_permite_votacao = $this->request->getPost('event_permite_votacao');
				$event_encerrar_inscricoes = $this->request->getPost('event_encerrar_inscricoes');
				$event_ativo = (int)$this->request->getPost('event_ativo');

				$fileBANNER = $this->request->getFile('file_banner');

				$event_banner = '';
				if( $fileBANNER ){
					if ($fileBANNER->isValid() && ! $fileBANNER->hasMoved()){
						$originalName = $fileBANNER->getClientName();

						$arq_original = $originalName; 
						$extension = $fileBANNER->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$event_banner = $originalName .'__banner__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileBANNER->getRandomName();
						$fileBANNER->move( $this->folder_upload .'/', $event_banner);
					}
				}

				$fileREGULAMENTO = $this->request->getFile('file_regulamento');

				$event_regulamento = '';
				if( $fileREGULAMENTO ){
					if ($fileREGULAMENTO->isValid() && ! $fileREGULAMENTO->hasMoved()){
						$originalName = $fileREGULAMENTO->getClientName();

						$arq_original = $originalName; 
						$extension = $fileREGULAMENTO->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$event_regulamento = $originalName .'__regulamento__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileREGULAMENTO->getRandomName();
						$fileREGULAMENTO->move( $this->folder_upload .'/', $event_regulamento);
					}
				}

				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'event_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'event_urlpage' => url_title( convert_accented_characters($event_titulo), '-', TRUE ),
					'event_titulo' => $event_titulo,
					'event_data' => fct_date2bd($event_data),
					'event_hrs_ini' => $event_hrs_ini,
					'event_limit_coreografia' => $event_limit_coreografia,
					'event_limit_participantes' => $event_limit_participantes,
					'event_show_result_site' => $event_show_result_site,
					'event_permite_votacao' => $event_permite_votacao,
					'event_encerrar_inscricoes' => (int)$event_encerrar_inscricoes,
					//'event_banner' => $event_banner,
					//'event_regulamento' => $event_regulamento,
					'event_dte_cadastro' => date("Y-m-d H:i:s"),
					'event_dte_alteracao' => date("Y-m-d H:i:s"),
					'event_ativo' => (int)$event_ativo,
				];

				if( !empty($event_banner)){
					$data_db['event_banner'] = $event_banner;
				}
				if( !empty($event_regulamento)){
					$data_db['event_regulamento'] = $event_regulamento;
				}

				$queryEdit = $this->eventMD->where('event_id', $event_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 ){
					unset( $data_db['event_hashkey'] );
					unset( $data_db['event_dte_cadastro'] );
					$qryExecute = $this->eventMD->update($event_id, $data_db);
				}else{
					$event_id = $this->eventMD->insert($data_db);
				}
				
				
				//print_r( 'parar' );
				//print_r( $this->request->getPost() );
				//print_r( $this->request->getPost('evcfg_forma_cobranca_tipo') );
				//print_r( $this->request->getPost('evcfg_forma_cobranca') );
				//exit();					

				/*
				 * -------------------------------------------------------------
				 * Grade de Configurações
				 * -------------------------------------------------------------
				**/
					$evcfg_id = (int)$this->request->getPost('evcfg_id');
					$arr_flimit_func_id = $this->request->getPost('flimit_func_id');
					$arr_flimit_limite = $this->request->getPost('flimit_limite');
					$arr_flimit_hash = $this->request->getPost('flimit_hash');

					$evcfg_func_limites = [];
					if( is_array($arr_flimit_func_id)){
						foreach ($arr_flimit_func_id as $key => $val) {
							if( (int)($val) > 0 ){
								$flimit_func_id = (int)$arr_flimit_func_id[$key];
								$flimit_limite = (int)$arr_flimit_limite[$key];
								$flimit_hash = $arr_flimit_hash[$key];
								$arr_temp = [
									"func_id" => $flimit_func_id,
									"func_titulo" => '',
									"limite" => $flimit_limite,
									"hashkey" => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16))
								];
								array_push($evcfg_func_limites, $arr_temp);
							}
						}
					}
					$evcfg_max_coreogf_grupo = (int)$this->request->getPost('evcfg_max_coreogf_grupo');
					$evcfg_seletiva = (int)$this->request->getPost('evcfg_seletiva');
					$evcfg_seletiva_taxa = (int)$this->request->getPost('evcfg_seletiva_taxa');
					$event_seletiva_result = (int)$this->request->getPost('event_seletiva_result');
					$evcfg_classificacao = $this->request->getPost('evcfg_classificacao');
					$evcfg_exigir_foto_partic = (int)$this->request->getPost('evcfg_exigir_foto_partic');
					$evcfg_quesitos = (int)$this->request->getPost('evcfg_quesitos');
					$evcfg_show_agenda_site = (int)$this->request->getPost('evcfg_show_agenda_site');
					$evcfg_show_ordem_apres_site = (int)$this->request->getPost('evcfg_show_ordem_apres_site');
					$evcfg_show_ordem_ensaio_site = (int)$this->request->getPost('evcfg_show_ordem_ensaio_site');
					$evcfg_agrupar_ensaios = $this->request->getPost('evcfg_agrupar_ensaios');
					$evcfg_perm_bailarino_grupos = (int)$this->request->getPost('evcfg_perm_bailarino_grupos');
					$evcfg_exigir_foto_doc = (int)$this->request->getPost('evcfg_exigir_foto_doc');
					$evcfg_envio_musica = (int)$this->request->getPost('evcfg_envio_musica');
					$evcfg_forma_cobranca_tipo = $this->request->getPost('evcfg_forma_cobranca_tipo');
					$evcfg_forma_cobranca = $this->request->getPost('evcfg_forma_cobranca');
					$evcfg_forma_cobranca = (($evcfg_forma_cobranca_tipo == "doacao")? ['doacao'] : $evcfg_forma_cobranca);
					$evcfg_doacao_entrega_forma = $this->request->getPost('evcfg_doacao_entrega_forma');
					$evcfg_doacao_entrega_dte_ini = $this->request->getPost('evcfg_doacao_entrega_dte_ini');
					$evcfg_doacao_entrega_dte_fim = $this->request->getPost('evcfg_doacao_entrega_dte_fim');
					if( $evcfg_doacao_entrega_forma == "credenciamento"){
						$evcfg_doacao_entrega_dte_ini = null;
						$evcfg_doacao_entrega_dte_fim = null;
					}

							////evcfg_func_limites LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
							////evcfg_max_coreogf_grupo INT(11) NOT NULL DEFAULT '0',
							////evcfg_seletiva TINYINT(4) NULL DEFAULT '0',
							//	evcfg_seletiva_taxa DECIMAL(16,2) NULL DEFAULT NULL,
							//	evcfg_classificacao TINYINT(4) NULL DEFAULT '0',
							////evcfg_forma_cobranca_tipo VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
							////evcfg_forma_cobranca VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
							//	evcfg_exigir_foto_partic TINYINT(4) NULL DEFAULT '0',
							////evcfg_exigir_foto_doc TINYINT(4) NULL DEFAULT '0',
							////evcfg_envio_musica TINYINT(4) NULL DEFAULT '0',
							//	evcfg_quesitos TINYINT(4) NULL DEFAULT '0',
							//	evcfg_show_agenda_site TINYINT(4) NULL DEFAULT '0',
							//	evcfg_show_ordem_apres_site TINYINT(4) NULL DEFAULT '0',
							//	evcfg_show_ordem_ensaio_site TINYINT(4) NULL DEFAULT '0',
							//	evcfg_agrupar_ensaios VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
							//	evcfg_perm_bailarino_grupos TINYINT(4) NULL DEFAULT '0',
							////evcfg_doacao_entrega_forma VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
							//evcfg_doacao_entrega_dte_ini DATE NULL DEFAULT NULL,
							//evcfg_doacao_entrega_dte_fim DATE NULL DEFAULT NULL,					

					$data_config_db = [
						'event_id' => (int)$event_id,
						'evcfg_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
						'evcfg_func_limites' => json_encode($evcfg_func_limites),
						'evcfg_max_coreogf_grupo' => (int)$evcfg_max_coreogf_grupo,
						'evcfg_seletiva' => (int)$evcfg_seletiva,
						'evcfg_exigir_foto_doc' => (int)$evcfg_exigir_foto_doc,
						'evcfg_envio_musica' => (int)$evcfg_envio_musica,
						'evcfg_forma_cobranca_tipo' => $evcfg_forma_cobranca_tipo,
						'evcfg_seletiva_taxa' => $evcfg_seletiva_taxa,
						'event_seletiva_result' => $event_seletiva_result,
						'evcfg_classificacao' => $evcfg_classificacao,
						'evcfg_exigir_foto_partic' => $evcfg_exigir_foto_partic,
						'evcfg_quesitos' => $evcfg_quesitos,
						'evcfg_show_agenda_site' => $evcfg_show_agenda_site,
						'evcfg_show_ordem_apres_site' => $evcfg_show_ordem_apres_site,
						'evcfg_show_ordem_ensaio_site' => $evcfg_show_ordem_ensaio_site,
						'evcfg_agrupar_ensaios' => $evcfg_agrupar_ensaios,
						'evcfg_perm_bailarino_grupos' => $evcfg_perm_bailarino_grupos,
						'evcfg_forma_cobranca' => json_encode($evcfg_forma_cobranca),
						'evcfg_doacao_entrega_forma' => $evcfg_doacao_entrega_forma,
						'evcfg_doacao_entrega_dte_ini' => (!is_null($evcfg_doacao_entrega_dte_ini) ? fct_date2bd($evcfg_doacao_entrega_dte_ini) : null),
						'evcfg_doacao_entrega_dte_fim' => (!is_null($evcfg_doacao_entrega_dte_fim) ? fct_date2bd($evcfg_doacao_entrega_dte_fim) : null),
						'evcfg_dte_cadastro' => date("Y-m-d H:i:s"),
						'evcfg_dte_alteracao' => date("Y-m-d H:i:s"),
					];
					$queryConfig = $this->evcfgMD
						//->where('evcfg_id', $evcfg_id)
						->where('event_id', $event_id)
						->get();
					if( $queryConfig && $queryConfig->resultID->num_rows >= 1 ){
						unset( $data_config_db['evcfg_hashkey'] );
						unset( $data_config_db['evcfg_dte_cadastro'] );
						$this->evcfgMD->set($data_config_db);
						$this->evcfgMD->where('event_id', $event_id);
						$qryExecute = $this->evcfgMD->update();
					}else{
						$evcfg_id = $this->evcfgMD->insert($data_config_db);
					}
					
				/*
				 * -------------------------------------------------------------
				 * Grade de Datas
				 * -------------------------------------------------------------
				**/
				$arr_evdte_data = $this->request->getPost('evdte_data');
				$arr_evdte_hrs_ini = $this->request->getPost('evdte_hrs_ini');
				$arr_evdte_id = $this->request->getPost('evdte_id');
				if( is_array($arr_evdte_data)){
					foreach ($arr_evdte_data as $key => $val) {
						if( !empty($val) ){
							$evdte_data = $val;
							$evdte_hrs_ini = $arr_evdte_hrs_ini[$key];
							$evdte_id = (int)$arr_evdte_id[$key];

							$acaoDATAS = 'INSERT';
							if( $evdte_id > 0 ){
								$query_evdte = $this->evdteMD
									->where('evdte_id', $evdte_id)
									->where('event_id', $event_id)
									->orderBy('evdte_id', 'DESC')
									->get();
								if( $query_evdte && $query_evdte->resultID->num_rows >=1 ){
									$acaoDATAS = 'UPDATE';
								}
							}
							$data_event_db = [
								'event_id' => $event_id, 
								'evdte_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
								'evdte_data' => fct_date2bd($evdte_data),
								'evdte_hrs_ini' => $evdte_hrs_ini,
								'evdte_dte_cadastro' => date("Y-m-d H:i:s"),
								'evdte_dte_alteracao' => date("Y-m-d H:i:s"),
								'evdte_ativo' => 1
							];
							if( $acaoDATAS == "INSERT" ){
								$evdte_id = $this->evdteMD->insert($data_event_db);	
							}
							if( $acaoDATAS == "UPDATE" )
							{	
								unset( $data_event_db['evdte_hashkey'] );
								unset( $data_event_db['evdte_dte_cadastro'] );
								$qryExecuteDATAS = $this->evdteMD->update($evdte_id, $data_event_db);
							}
						}
					}
				}
				//var_dump( $arr_evdte_data );
				//var_dump( $arr_evdte_hrs_ini );
				//exit();

				$args = [
					'event_id' => $event_id,
					'evvlr_label' => 'valores-participantes',
				];
				self::fct_gravar_valores( $args  );
				//var_dump( $arr_evdte_data );
				//var_dump( $arr_evdte_hrs_ini );
				//exit();

				$args = [
					'event_id' => $event_id,
					'evvlr_label' => 'valores-coreografias',
					'prefixo' => 'vlrC_',
				];
				self::fct_gravar_valores( $args  );

				$args = [
					'event_id' => $event_id,
					'evvlr_label' => 'descontos-participantes',
					'prefixo' => 'descP_',
				];
				self::fct_gravar_valores( $args  );

				$args = [
					'event_id' => $event_id,
					'evvlr_label' => 'quantidade-de-doacoes',
					//'prefixo' => 'descP_',
				];
				self::fct_gravar_quantidade_doacoes( $args  );

				/*
				 * -------------------------------------------------------------
				 * Informações de Cobrança
				 * -------------------------------------------------------------
				**/
					//$evcfg_doacao_entrega_dte_fim = $this->request->getPost('evcfg_doacao_entrega_dte_fim');
					$args = [
						'event_id' => $event_id,
						'area' => 'mostra-competitiva',
					];
					self::fct_gravar_infos_cobranca( $args  );
					
					
					// se esta opção estiver marcada como sim
					// deve pegar as mesmas informações já cadastradas
					$mesma_config = (int)$this->request->getPost('mesma_config');
					if( $mesma_config == 1){
						$query_cobranca = $this->evcobMD
							->where('event_id', $event_id)
							->where('evcob_area_cobranca', 'mostra-competitiva')
							->limit(1)
							->get();
						if( $query_cobranca && $query_cobranca->resultID->num_rows >= 1 )
						{
							$row = $query_cobranca->getRowArray(); 
							if ($row) {
								unset($row['id']); 
								$row['evcob_area_cobranca'] = 'workshop';
								$row['evcob_hashkey'] = md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16));
								$this->evcobMD->insert($row); // Insere o novo registro
							}
						}
					}else{
						// utilizar novos dados novos ou dados da mostra competitiva
						//$args = [
						//	'event_id' => $event_id,
						//	'area' => 'workshop',
						//];
						//self::fct_gravar_infos_cobranca( $args  );
					}

				/*
				 * -------------------------------------------------------------
				 * Termos e Autorizações por Evento
				 * -------------------------------------------------------------
				**/
					$args = [
						'event_id' => $event_id,
						'evvlr_label' => 'valores-participantes',
					];
					self::fct_termos_autorizacoes( $args  );
					//$chkAutorizacao = $this->request->getPost('chkAutorizacao');
					//print_r( $chkAutorizacao );
					//exit();


				return $this->response->redirect( painel_url('eventos') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}




		$query = $this->eventMD
			->where('event_id', $event_id)
			->limit(1)
			->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;


			// mostra-competitiva 
			$query_evcob = $this->evcobMD
				->where('event_id', $event_id)
				->where('evcob_area_cobranca', 'mostra-competitiva')
				->limit(1)
				->get();
			//print $this->evcobMD->getLastQuery();
			//print $query_evcob->resultID->num_rows;
			if( $query_evcob && $query_evcob->resultID->num_rows >= 1 )
			{
				$rs_dados_evcob = $query_evcob->getRow();
				$this->data['rs_dados_evcob'] = $rs_dados_evcob;
			}

			// workshop
			$query_evcob_work = $this->evcobMD
				->where('event_id', $event_id)
				->where('evcob_area_cobranca', 'workshop')
				->limit(1)
				->get();
			if( $query_evcob_work && $query_evcob_work->resultID->num_rows >=1 )
			{
				$rs_dados_evcob_work = $query_evcob_work->getRow();
				$this->data['rs_dados_evcob_work'] = $rs_dados_evcob_work;
			}
			
			


			$query_event_config = $this->evcfgMD->where('event_id', $event_id)->get();
			if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
			{
				$rs_dados_config = $query_event_config->getRow();
				$this->data['rs_dados_config'] = $rs_dados_config;
			}

			$query_event_datas = $this->evdteMD->where('event_id', $event_id)->get();
			if( $query_event_datas && $query_event_datas->resultID->num_rows >= 1 )
			{
				$this->data['rs_dados_datas'] = $query_event_datas;
			}

			$query_event_valores = $this->evvlrMD
				->where('event_id', $event_id)
				->where('evvlr_label', 'valores-participantes')
				->get();
			if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
			{
				$this->data['rs_valores_por_participantes'] = $query_event_valores;
			}

			$query_event_valores_coreografias = $this->evvlrMD
				->where('event_id', $event_id)
				->where('evvlr_label', 'valores-coreografias')
				->get();
			if( $query_event_valores_coreografias && $query_event_valores_coreografias->resultID->num_rows >= 1 )
			{
				$this->data['rs_valores_por_coreografias'] = $query_event_valores_coreografias;	
			}


			$query_event_descontos_participantes = $this->evvlrMD
				->where('event_id', $event_id)
				->where('evvlr_label', 'descontos-participantes')
				->get();
			if( $query_event_descontos_participantes && $query_event_descontos_participantes->resultID->num_rows >= 1 )
			{
				$this->data['rs_descontos_por_participantes'] = $query_event_descontos_participantes;	
			}


			$this->evvlrMD->select('evvlr_label, evvlr_quant, evvlr_txt_descr, evvlr_ativo')
				->where('event_id', $event_id);
			$this->evvlrMD->groupStart()
				->whereIn('evvlr_label', array_keys($listTipoCobrancaDoacoes))
			->groupEnd();
			$query_event_quant_doacoes = $this->evvlrMD->get();
			//print $this->evvlrMD->getLastQuery();
			if( $query_event_quant_doacoes && $query_event_quant_doacoes->resultID->num_rows >= 1 )
			{
				//$this->data['rs_event_quant_doacoes'] = $query_event_quant_doacoes->getResult();
				$rs_event_quant_doacoes = [];
				foreach ($query_event_quant_doacoes->getResult() as $row) {
					$evvlr_label = $row->evvlr_label;
					$evvlr_quant = $row->evvlr_quant;
					$evvlr_txt_descr = $row->evvlr_txt_descr;
					$evvlr_ativo = (int)$row->evvlr_ativo;
					$rs_event_quant_doacoes[$evvlr_label] = (object)[
						"evvlr_label" => $evvlr_label,
						"evvlr_quant" => $evvlr_quant,
						"evvlr_txt_descr" => $evvlr_txt_descr,
						"evvlr_ativo" => $evvlr_ativo,
					];
				}
				$this->data['rs_event_quant_doacoes'] = $rs_event_quant_doacoes;
			}


			$query_event_autoriz = $this->evtautMD
				->where('event_id', $event_id)
				->get();
			if( $query_event_autoriz && $query_event_autoriz->resultID->num_rows >= 1 )
			{
				$this->data['rs_event_autoriz'] = $query_event_autoriz;	
			}
		}


		$query_funcoes = $this->funcMD
			->where('func_ativo', '1')
			->orderBy('func_titulo', 'ASC')
			->get();
		if( $query_funcoes && $query_funcoes->resultID->num_rows >=1 )
		{
			$this->data['rs_funcoes'] = $query_funcoes;
		}


		$query_formatos = $this->formtMD
			->where('formt_ativo', '1')
			->orderBy('formt_titulo', 'ASC')
			->get();
		if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
		{
			$this->data['rs_formatos'] = $query_formatos;
		}



		$this->autzMD->from('tbl_autorizacoes GRUPO', true)
			->select('GRUPO.autz_id, GRUPO.autz_parent_id, GRUPO.autz_hashkey, GRUPO.autz_titulo, GRUPO.autz_descricao')
			->select('ITENS.autz_titulo As autz_titulo_parent')
			->join('tbl_autorizacoes ITENS', 'GRUPO.autz_parent_id = ITENS.autz_id', 'LEFT')
			->orderBy('GRUPO.autz_id', 'ASC')
			->orderBy('GRUPO.autz_parent_id', 'ASC')
			->limit(1000);
		$query_autorizacoes = $this->autzMD->get();
		//print $this->autzMD->getLastQuery();
		if( $query_autorizacoes && $query_autorizacoes->resultID->num_rows >=1 )
		{
			$this->data['rs_autorizacoes'] = $query_autorizacoes;
		}



		return view($this->directory .'/eventos-form', $this->data);
	}


	public function fct_gravar_valores( $args = [] ){
		$evvlr_label = (isset($args['evvlr_label']) ? $args['evvlr_label'] : '');
		$event_id = (int)(isset($args['event_id']) ? $args['event_id'] : '');
		$prefixo = (isset($args['prefixo']) ? $args['prefixo'] : '');

		/*
		 * -------------------------------------------------------------
		 * Grade de Valores
		 * -------------------------------------------------------------
		**/
		$arr_formt_id = $this->request->getPost($prefixo .'formt_id');
		$arr_func_id = $this->request->getPost($prefixo .'func_id');
		$arr_evvlr_id = $this->request->getPost($prefixo .'evvlr_id');
		$arr_evvlr_quant = $this->request->getPost($prefixo .'evvlr_quant');
		$arr_evvlr_valor = $this->request->getPost($prefixo .'evvlr_valor');
		$arr_evvlr_vlr_desc = $this->request->getPost($prefixo .'evvlr_vlr_desc');
		$arr_evvlr_data_limite = $this->request->getPost($prefixo .'evvlr_data_limite');
		//$arr_tvlr_id = $this->request->getPost('tvlr_id');
		//var_dump( $arr_evvlr_valor );
		//var_dump( $arr_evvlr_vlr_desc );
		//exit();

		$arrLoop = $arr_evvlr_valor;
		if( $evvlr_label == 'descontos-participantes' || $evvlr_label == 'descontos-coreografias' ){
			$arrLoop = $arr_evvlr_quant;	
		};


		if( is_array($arrLoop)){
			foreach ($arrLoop as $key => $val) {
				$evvlr_valor = (isset($arr_evvlr_valor[$key]) ? $arr_evvlr_valor[$key] : '0');
				$evvlr_quant = (int)(isset($arr_evvlr_quant[$key]) ? $arr_evvlr_quant[$key] : '');
				if( !empty($evvlr_valor) || $evvlr_quant > 0 ){
					$formt_id = (int)(isset($arr_formt_id[$key]) ? $arr_formt_id[$key] : '');
					$func_id = (int)(isset($arr_func_id[$key]) ? $arr_func_id[$key] : '');
					//$evvlr_valor =  $arr_evvlr_valor[$key];
					$evvlr_vlr_desc = (isset($arr_evvlr_vlr_desc[$key]) ? $arr_evvlr_vlr_desc[$key] : '');
					$evvlr_data_limite = (isset($arr_evvlr_data_limite[$key]) ? $arr_evvlr_data_limite[$key] : '');
					$evvlr_id = (int)(isset($arr_evvlr_id[$key]) ? $arr_evvlr_id[$key] : '');
					$acaoVALORES = 'INSERT';
					if( $evvlr_id > 0 ){
						$query_evvlr = $this->evvlrMD
							->where('evvlr_id', $evvlr_id)
							->where('event_id', $event_id)
							->orderBy('evvlr_id', 'DESC')
							->get();
						if( $query_evvlr && $query_evvlr->resultID->num_rows >=1 ){
							$acaoVALORES = 'UPDATE';
						}
					}
					$data_valores_db = [
						'event_id' => $event_id, 
						'func_id' => $func_id, 
						'formt_id' => $formt_id, 
						'evvlr_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
						'evvlr_label' => $evvlr_label,
						'evvlr_quant' => $evvlr_quant, 
						'evvlr_valor' => fct_to_money($evvlr_valor, 2, "bd"),
						'evvlr_vlr_desc' =>  fct_to_money($evvlr_vlr_desc, 2, "bd"),
						'evvlr_data_limite' => fct_date2bd($evvlr_data_limite),
						'evvlr_dte_cadastro' => date("Y-m-d H:i:s"),
						'evvlr_dte_alteracao' => date("Y-m-d H:i:s"),
						'evvlr_ativo' => 1
					];
					if( $acaoVALORES == "INSERT" ){
						$evvlr_id = $this->evvlrMD->insert($data_valores_db);	
					}
					if( $acaoVALORES == "UPDATE" ){	
						unset( $data_valores_db['evvlr_hashkey'] );
						unset( $data_valores_db['evvlr_dte_cadastro'] );
						$qryExecuteVALORES = $this->evvlrMD->update($evvlr_id, $data_valores_db);
					}
				}
			}
		}	
	}


	public function fct_gravar_quantidade_doacoes( $args = [] ){
		$evvlr_label = (isset($args['evvlr_label']) ? $args['evvlr_label'] : '');
		$event_id = (int)(isset($args['event_id']) ? $args['event_id'] : '');
		
		/*
		 * -------------------------------------------------------------
		 * Grade de Valores
		 * -------------------------------------------------------------
		**/
		$arr_evvlr_label = $this->request->getPost('doacoesP_evvlr_label');
		$arr_evvlr_quant = $this->request->getPost('doacoesP_evvlr_quant');
		$arr_evvlr_txt_descr = $this->request->getPost('doacoesP_evvlr_txt_descr');
		$arr_evvlr_ativo = $this->request->getPost('doacoesP_evvlr_ativo');
		if( is_array($arr_evvlr_label)){
			foreach ($arr_evvlr_label as $key => $val) {
				$evvlr_label = $val;
				$evvlr_quant = (int)(isset($arr_evvlr_quant[$key]) ? $arr_evvlr_quant[$key] : '0');
				$evvlr_txt_descr = (isset($arr_evvlr_txt_descr[$key]) ? $arr_evvlr_txt_descr[$key] : '');
				$evvlr_id = (isset($arr_evvlr_id[$key]) ? $arr_evvlr_id[$key] : '');
				$evvlr_ativo = (int)(isset($arr_evvlr_ativo[$val]) ? $arr_evvlr_ativo[$val] : '');
				$data_valores_db = [
					'event_id' => $event_id, 
					'func_id' => 0, 
					'formt_id' => 0, 
					'evvlr_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'evvlr_label' => $evvlr_label,
					'evvlr_quant' => $evvlr_quant,
					'evvlr_txt_descr' => $evvlr_txt_descr,
					'evvlr_valor' => 0,
					'evvlr_vlr_desc' =>  0,
					'evvlr_dte_cadastro' => date("Y-m-d H:i:s"),
					'evvlr_dte_alteracao' => date("Y-m-d H:i:s"),
					'evvlr_ativo' => $evvlr_ativo
				];
				$query_evvlr = $this->evvlrMD
					->where('evvlr_label', $evvlr_label)
					->where('event_id', $event_id)
					->orderBy('evvlr_id', 'DESC')
					->limit(1)
					->get();
				if( $query_evvlr && $query_evvlr->resultID->num_rows >= 1 ){

					$this->evvlrMD->where('evvlr_label', $evvlr_label);
					$this->evvlrMD->where('event_id', $event_id);
					$this->evvlrMD->set($data_valores_db);
					$this->evvlrMD->set($data_valores_db);
					$this->evvlrMD->update();
				}else{
					$this->evvlrMD->insert($data_valores_db);
				}
			}
		}
	}


	public function fct_termos_autorizacoes( $args = [] ){
		$event_id = (int)(isset($args['event_id']) ? $args['event_id'] : '');

		$this->evtautMD->where('event_id', $event_id);
		$this->evtautMD->delete();

		$chkAutorizacao = $this->request->getPost('chkAutorizacao');
		if( is_array($chkAutorizacao)){
			foreach ($chkAutorizacao as $key => $val) {

				$data_termos_db = [
					'event_id' => (int)$event_id, 
					'autz_id' => (int)$val, 
					'evtaut_dte_cadastro' => date("Y-m-d H:i:s"),
					'evtaut_dte_alteracao' => date("Y-m-d H:i:s"),
					'evtaut_ativo' => 1
				];
				$this->evtautMD->insert($data_termos_db);	
			}
		}
	}
	
	
	public function fct_gravar_infos_cobranca( $args = [] ){
		$event_id = (int)(isset($args['event_id']) ? $args['event_id'] : '');
		$work_area = (isset($args['area']) ? $args['area'] : '');
		$abrev_field = '';
		if( $work_area == "workshop" ){ $abrev_field = "work_"; }
		
		/*
		 * -------------------------------------------------------------
		 * Informações de Cobrança
		 * -------------------------------------------------------------
		**/
			$evcob_tipo_cobranca = $this->request->getPost($abrev_field .'evcob_tipo_cobranca');
			$evcob_tipo_cad = $this->request->getPost($abrev_field .'evcob_tipo_cad');
			$evcob_titular = $this->request->getPost($abrev_field .'evcob_titular');
			$evcob_cpf = $this->request->getPost($abrev_field .'evcob_cpf');
			$evcob_cnpj = $this->request->getPost($abrev_field .'evcob_cnpj');

			$evcob_credenciais_mp = $this->request->getPost($abrev_field .'evcob_credenciais_mp');
			$evcob_config_mp = $this->request->getPost($abrev_field .'evcob_config_mp');
			$evcob_chave_pix = $this->request->getPost($abrev_field .'evcob_chave_pix');

			$evcob_banco = $this->request->getPost($abrev_field .'evcob_banco');
			$evcob_agencia = $this->request->getPost($abrev_field .'evcob_agencia');
			$evcob_conta_num = $this->request->getPost($abrev_field .'evcob_conta_num');
			$evcob_informacoes = $this->request->getPost($abrev_field .'evcob_informacoes');
			$evcob_info_doacao = $this->request->getPost($abrev_field .'evcob_info_doacao');
			$evcob_ativo = (int)$this->request->getPost($abrev_field .'evcob_ativo');

			$data_cobranca_db = [
				//'insti_id' => (int)$this->session_user_id,
				'event_id' => (int)$event_id,
				'evcob_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
				//event_urlpage' => url_title( convert_accented_characters($evcob_titular), '-', TRUE ),
				'evcob_area_cobranca' => $work_area,
				'evcob_tipo_cobranca' => $evcob_tipo_cobranca,
				'evcob_titular' => $evcob_titular,
				'evcob_tipo_cad' => $evcob_tipo_cad,
				'evcob_cpf' => $evcob_cpf,
				'evcob_cnpj' => $evcob_cnpj,
				'evcob_chave_pix' => $evcob_chave_pix,
				'evcob_credenciais_mp' => json_encode($evcob_credenciais_mp),
				'evcob_config_mp' => json_encode($evcob_config_mp),
				'evcob_banco' => $evcob_banco,
				'evcob_agencia' => $evcob_agencia,
				'evcob_conta_num' => $evcob_conta_num,
				'evcob_informacoes' => $evcob_informacoes,
				'evcob_info_doacao' => $evcob_info_doacao,
				'evcob_dte_cadastro' => date("Y-m-d H:i:s"),
				'evcob_dte_alteracao' => date("Y-m-d H:i:s"),
				'evcob_ativo' => (int)$evcob_ativo,
			];

			$query_cobranca = $this->evcobMD->where('event_id', $event_id)->get();
			if( $query_cobranca && $query_cobranca->resultID->num_rows >= 1 )
			{
				unset( $data_cobranca_db['evcob_hashkey'] );
				unset( $data_cobranca_db['evcob_dte_cadastro'] );

				$this->evcobMD->set($data_cobranca_db);
				$this->evcobMD->where('event_id', $event_id);
				$this->evcobMD->update();
			}else{
				$evcob_id = $this->evcobMD->insert($data_cobranca_db);
			}	
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$event_hashkey = $this->request->getPost('event_hashkey');
			$query = $this->eventMD->where('event_hashkey', $event_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$event_id = (int)$rs_registro->event_id;			

				// excluir registro
				$this->eventMD->where('event_hashkey', $event_hashkey)->delete();

				//$this->eventMD->set('solt_excluido', 1);
				//$this->eventMD->where('event_hashkey', $event_hashkey);
				//$this->eventMD->where('solt_id', $solt_id);
				//$this->eventMD->update();

				$error_num = "0";
				$error_msg = "Registro excluído com sucesso!";
				$redirect = "";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"redirect" => $redirect 
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		case "EXCLUIR-DATA-EVENTO" :

			$evdte_hashkey = $this->request->getPost('hashkey');
			$query = $this->evdteMD->where('evdte_hashkey', $evdte_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$event_id = (int)$rs_registro->event_id;			

				// excluir registro
				$this->evdteMD->where('evdte_hashkey', $evdte_hashkey)->delete();

				//$this->eventMD->set('solt_excluido', 1);
				//$this->eventMD->where('event_hashkey', $event_hashkey);
				//$this->eventMD->where('solt_id', $solt_id);
				//$this->eventMD->update();

				$error_num = "0";
				$error_msg = "Registro excluído com sucesso!";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		case "EXCLUIR-VALOR-EVENTO" :

			$evvlr_hashkey = $this->request->getPost('hashkey');
			$query = $this->evvlrMD->where('evvlr_hashkey', $evvlr_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$event_id = (int)$rs_registro->event_id;			

				// excluir registro
				$this->evvlrMD->where('evvlr_hashkey', $evvlr_hashkey)->delete();

				$error_num = "0";
				$error_msg = "Registro excluído com sucesso!";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		case "VALIDAR-CPF-CNPJ" :

			$tipo = $this->request->getPost('tipo');
			$documento = $this->request->getPost('documento');

			if( $tipo == "cpf" ){
				if( fct_validar_cpf($documento) ){
					$error_num = "0";
					$error_msg = "CPF VÁLIDO";
				}else{
					$error_num = "1";
					$error_msg = "O CPF informado é inválido. <br>Verifique com atenção.";
				}
			}elseif( $tipo == "cnpj" ){

				if( fct_valida_cnpj($documento) ){
					$error_num = "0";
					$error_msg = "CNPJ VÁLIDO";
				}else{
					$error_num = "1";
					$error_msg = "O CNPJ informado é inválido. <br>Verifique com atenção.";
				}
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		}
	}

}
