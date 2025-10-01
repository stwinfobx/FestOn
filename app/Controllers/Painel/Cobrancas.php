<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Cobrancas extends PainelController
{
	protected $corgfMD = null;
	protected $crfpaMD = null;
	protected $grpMD = null;
	protected $modlMD = null;
	protected $formtMD = null;
	protected $categMD = null;
	protected $partcMD = null;
	protected $folder_upload = null;

	protected $eventMD = null;
	protected $evcfgMD = null;
	protected $evvlrMD = null;
	protected $evcobMD = null;
	protected $pedMD = null;
	protected $pedPgtoMD = null;

    public function __construct()
    {
        $this->corgfMD = new \App\Models\CoreografiasModel();
		$this->crfpaMD = new \App\Models\CoreografiasParticipantesModel();

		$this->eventMD = new \App\Models\EventosModel();
		$this->evcfgMD = new \App\Models\EventosConfigModel();
		$this->evvlrMD = new \App\Models\EventosValoresModel();
		$this->evcobMD = new \App\Models\EventosCobrancaModel();

		$this->grpMD = new \App\Models\GruposModel();
		$this->modlMD = new \App\Models\ModalidadesModel();
		$this->formtMD = new \App\Models\FormatosModel();
		$this->categMD = new \App\Models\CategoriasModel();
		$this->partcMD = new \App\Models\ParticipantesModel();

		$this->pedMD = new \App\Models\PedidosModel();
		$this->pedPgtoMD = new \App\Models\PedidosPagtosModel();

		$this->data['menu_active'] = 'cobrancas';

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

		//$this->corgfMD
		//	->where('insti_id', (int)$this->session_user_id)
		//	->orderBy('corgf_id', 'DESC')
		//	->limit(1000);
		//$query = $this->corgfMD->get();

		$this->corgfMD->from('tbl_coreografias As CORGF', true)
			->select('CORGF.*')
			->select('GRP.grp_hashkey, GRP.grp_titulo, MODL.modl_titulo, FORMT.formt_titulo, CATEG.categ_titulo')
			->join('tbl_grupos GRP', 'GRP.grp_id = CORGF.grp_id', 'LEFT')
			->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'LEFT')
			->join('tbl_modalidades MODL', 'MODL.modl_id = CORGF.modl_id', 'LEFT')
			->join('tbl_formatos FORMT', 'FORMT.formt_id = CORGF.formt_id', 'LEFT')
			->join('tbl_categorias CATEG', 'CATEG.categ_id = CORGF.categ_id', 'LEFT')
			->where('CORGF.insti_id', (int)$this->session_user_id)
			->orderBy('CORGF.corgf_id', 'DESC')
			->limit(1000);
		$query = $this->corgfMD->get();
		//->getCompiledSelect();

		$this->data['lastQuery'] = $this->corgfMD->getLastQuery();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/cobrancas', $this->data);
	}


	public function form( $corgf_id = 0 )
	{

		/*
		 * -------------------------------------------------------------
		 * Recupera o Hashkey do Grupo
		 * -------------------------------------------------------------
		**/
			if( $corgf_id == 0 ){
				$link_param = "";
				$_grp_hashkey = (isset($this->rs_params->grp) ? $this->rs_params->grp : "");
				//if( !empty($_grp_hashkey) > 0 ){ $link_param =  '/params/grp:'. $_grp_hashkey; }

				$this->corgfMD->from('tbl_coreografias As CORGF', true)
					->select('CORGF.*')
					->select('GRP.grp_hashkey, GRP.grp_titulo, MODL.modl_titulo, FORMT.formt_titulo, CATEG.categ_titulo')
					->join('tbl_grupos GRP', 'GRP.grp_id = CORGF.grp_id', 'LEFT')
					->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'LEFT')
					->join('tbl_modalidades MODL', 'MODL.modl_id = CORGF.modl_id', 'LEFT')
					->join('tbl_formatos FORMT', 'FORMT.formt_id = CORGF.formt_id', 'LEFT')
					->join('tbl_categorias CATEG', 'CATEG.categ_id = CORGF.categ_id', 'LEFT')
					->where('CORGF.insti_id', (int)$this->session_user_id)
					->where('GRP.grp_hashkey', $_grp_hashkey)
					->orderBy('CORGF.corgf_id', 'DESC')
					->limit(1000);
				$query_corgf = $this->corgfMD->get();
				if( $query_corgf && $query_corgf->resultID->num_rows >=1 )
				{
					$rs_corgf_list = $query_corgf->getResult();
					$this->data['rs_corgf_list'] = $rs_corgf_list;
				}
			}


			$_grp_hashkey = (isset($this->rs_params->grp) ? $this->rs_params->grp : "");

			self::cobranca_post( 0, $_grp_hashkey);




		return view($this->directory .'/cobrancas-form', $this->data);
	}


	public function cobranca_post( $user_id = "", $grp_hashkey = ""){
		$total_geral_pedido = 0;
		
		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
		$this->grpMD->from('tbl_grupos As GRP', true)
			->select('GRP.*')
			->select('EVENT.*')
			->select('GREVT.grevt_id')
			->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
			->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
			//->where('GRP.user_id', $user_id)
			->where('GRP.grp_hashkey', $grp_hashkey)
			->orderBy('GREVT.grevt_id', 'DESC')
			->limit(1);
		$query_grupo_evt = $this->grpMD->get();
		//print( $this->grpMD->getLastQuery() );
		//exit();
		if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
		{
			$rs_grupo_evt = $query_grupo_evt->getRow();
			$this->data['rs_event'] = $rs_grupo_evt;

			$insti_id = (int)$rs_grupo_evt->insti_id;
			$event_id = (int)$rs_grupo_evt->event_id;
			$event_titulo = $rs_grupo_evt->event_titulo;
			$grevt_id = (int)$rs_grupo_evt->grevt_id;
			$grp_id = (int)$rs_grupo_evt->grp_id;
			$grp_titulo = $rs_grupo_evt->grp_titulo;

			/*
			 * -------------------------------------------------------------
			 * Configurações do Evento
			 * -------------------------------------------------------------
			**/
				$this->evcfgMD->select('*');
				$this->evcfgMD->where('event_id', $event_id);
				$this->evcfgMD->orderBy('event_id', 'DESC');
				$this->evcfgMD->limit(1);
				$query_event_config = $this->evcfgMD->get();
				//$lastQuery = $this->evcfgMD->getLastQuery();
				//print( $lastQuery );
				if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
				{
					$rs_event_config = $query_event_config->getRow();
					$this->data['rs_event_config'] = $rs_event_config;

					$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
					$arr_evcfg_forma_cobranca = json_decode( $evcfg_forma_cobranca );

					//print '<pre>';
					//print_r( $rs_event_config );
					//print '</pre>';
					
					//print '<pre>';
					//print_r( $arr_evcfg_forma_cobranca );
					//print '</pre>';

					if( !is_array($arr_evcfg_forma_cobranca) ){ $arr_evcfg_forma_cobranca = []; }
					//$arr_forma_cobranca = isset( $evcfg_forma_cobranca_json[] )

					/*
					 * -------------------------------------------------------------
					 * Informações sobre valores
					 * -------------------------------------------------------------
					**/
						if (in_array("por_coreografia", $arr_evcfg_forma_cobranca)) {
							// valores por_coreografia
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
							{
								$this->data['rs_valores_por_coreografias'] = $query_event_valores;
							}
						}
						if (in_array("por_participante", $arr_evcfg_forma_cobranca)) {
							// valores por_participante
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', $event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-participantes');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
							{
								$this->data['rs_valores_por_participantes'] = $query_event_valores;
							}
						}

						// valores por participante
						// -----------------------------------------
						//$this->evvlrMD->select('*');
						//$this->evvlrMD->where('event_id', $event_id);
						//$this->evvlrMD->orderBy('event_id', 'DESC');
						//$this->evvlrMD->limit(200);
						//$query_event_valores = $this->evvlrMD->get();
						//if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
						//{
						//	$this->data['rs_event_valores'] = $query_event_valores;
						//}
				}

			/*
			 * -------------------------------------------------------------
			 * Modalidade
			 * -------------------------------------------------------------
			**/
				$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
				{
					$this->data['rs_modalidades'] = $query_modalidades;
				}

			/*
			 * -------------------------------------------------------------
			 * Formatos
			 * -------------------------------------------------------------
			**/
				//$query_formatos = $this->formtMD->select_all_by_insti_id( (int)$insti_id );
				$query_formatos = $this->formtMD
					->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
					->where('insti_id', (int)$insti_id)
					->orderBy('formt_titulo', 'ASC')
					->get();
				if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
				{
					$this->data['rs_formatos'] = $query_formatos->getResult();
				}

				//$query_formatos = $this->formtMD
				//	->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				//	->where('insti_id', (int)$insti_id)
				//	->orderBy('formt_titulo', 'ASC')
				//	->get();


			/*
			 * -------------------------------------------------------------
			 * Categorias
			 * -------------------------------------------------------------
			**/
				$this->data['list_rs_categorias'] = [];
				$query_categorias = $this->categMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
				{
					$rs_categorias = $query_categorias->getResult();
					$this->data['rs_categorias'] = $query_categorias;

					$categorias = [];
					foreach ($rs_categorias as $row) {
						$categoria = [
							'id' => $row->categ_id,
							'titulo' => $row->categ_titulo,
							'idade_min' => (int)$row->categ_idade_min,
							'idade_max' => (int)$row->categ_idade_max,
						];
						$categorias[] = $categoria;
					}
					$this->data['list_rs_categorias'] = $categorias;
				}


			/*
			 * -------------------------------------------------------------
			 * lista de coreografias / elenco
			 * -------------------------------------------------------------
			**/
				$func_id = 3; 
				$total_geral_pedido = 0;
				$query_coreografos = $this->partcMD
					->select('partc_id, partc_nome, partc_documento')
					->where('insti_id', (int)$insti_id)
					->where('func_id', $func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_coreografos && $query_coreografos->resultID->num_rows >= 1 )
				{
					$this->data['rs_coreografos'] = $query_coreografos->getResult();
				}

				$query_corgf_cadastradas = self::fct_coreografias_cadastradas( (int)$insti_id, (int)$grp_id, (int)$event_id );
				if( $query_corgf_cadastradas && $query_corgf_cadastradas->resultID->num_rows >= 1 )
				{
					$rs_corgf_cadastradas = $query_corgf_cadastradas->getResultArray();

					$lista_de_coreografias = [];
					$xx = 0;
					foreach ($rs_corgf_cadastradas as $row) {
						$lista_de_coreografias['coreografias'][$xx] = $row;

						/*
						 * -------------------------------------------------------------
						 * verificar o valor por coreografia
						 * -------------------------------------------------------------
						**/
						$valor_coreografia = 0;
						$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '0';
						if( in_array('por_coreografia', $arr_evcfg_forma_cobranca) ){

							//print_debug( 'verificar valores por coreografias' );
							$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '1';

							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('formt_id', (int)$row['formt_id']);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(1);
							$query_valor_por_formato = $this->evvlrMD->get();
							if( $query_event_valores && $query_valor_por_formato->resultID->num_rows >= 1 )
							{
								$rs_vlr_formato = $query_valor_por_formato->getRow();
								//print_debug( 'Valor por Formato' );	
								//print_debug( $rs_vlr_formato );

								if( in_array('doacao', $arr_evcfg_forma_cobranca) ){
									$valor_coreografia = 0;
									$lista_de_coreografias['coreografias'][$xx]['valor'] = 0;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = 0;
								}else{
									$valor_coreografia = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['valor'] = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = $rs_vlr_formato->evvlr_vlr_desc;
								}
							}
						}
						//$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
						$query_elenco = self::fct_elenco_por_coreografia( (int)$row['corgf_id'], (int)$event_id, $arr_evcfg_forma_cobranca );


						$lista_de_coreografias['coreografias'][$xx]['CODIGO'] = (int)$row['corgf_id'];
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco->getResult();
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco;
						
						$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco['lista'];
						$lista_de_coreografias['coreografias'][$xx]['valores_totais_por_participantes'] = $query_elenco['valores_totais'];


						$valor_total_por_coreografia = ($valor_coreografia + $query_elenco['valores_totais']);
						$lista_de_coreografias['coreografias'][$xx]['valor_total_coreografia'] = $valor_total_por_coreografia;
						$xx++;

						$total_geral_pedido = ($total_geral_pedido + $valor_total_por_coreografia);
					}
					//print_debug( $lista_de_coreografias );
					//exit();

					$this->data['lista_de_coreografias'] = $lista_de_coreografias;
					//$this->data['rs_corgf_cadastradas'] = $query_corgf_cadastradas; //->getResult();
				}

			


			/*
			 * -------------------------------------------------------------
			 * Tipo de Configurações para Cobranca
			 * -------------------------------------------------------------
			**/
				$this->evcobMD->select('*');
				$this->evcobMD->where('event_id', $event_id);
				$this->evcobMD->orderBy('event_id', 'DESC');
				$this->evcobMD->limit(1);
				$query_event_cobr = $this->evcobMD->get();
				if( $query_event_cobr && $query_event_cobr->resultID->num_rows >=1 )
				{
					$rs_event_cobr = $query_event_cobr->getRow();
					$this->data['rs_event_cobr'] = $rs_event_cobr;

					$evcob_tipo_cobranca = $rs_event_cobr->evcob_tipo_cobranca;
					if( $evcob_tipo_cobranca == "mercado_pago" ){
						/*
						 * -------------------------------------------------------------
						 * novo pedido
						 * -------------------------------------------------------------
						**/	
							$valor_total = $total_geral_pedido;
							$cupom_desconto = 0;
							$cupom_percentual = 0;
							$total_desconto = 0;

					}
				}


			/*
			 * -------------------------------------------------------------
			 * Pedido de Pagamentos
			 * -------------------------------------------------------------
			**/
				$this->pedMD->select('*');
				$this->pedMD->where('event_id', $event_id);
				$this->pedMD->where('grp_id', $grp_id);
				$this->pedMD->where('insti_id', $insti_id);
				$this->pedMD->where('grevt_id', $grevt_id);
				$this->pedMD->limit(1);
				$query_pedido = $this->pedMD->get();
				if( $query_pedido && $query_pedido->resultID->num_rows >=1 )
				{
					$rs_pedido = $query_pedido->getRow();
					$this->data['rs_pedido'] = $rs_pedido;

					$this->pedPgtoMD->select('*');
					$this->pedPgtoMD->where('ped_id', (int)$rs_pedido->ped_id);
					$this->pedPgtoMD->orderBy('pgto_id', 'DESC');
					$query_transacoes = $this->pedPgtoMD->get();
					if( $query_transacoes && $query_transacoes->resultID->num_rows >=1 )
					{
						$rs_transacoes = $query_transacoes->getResult();
						$this->data['rs_transacoes'] = $rs_transacoes;
					}
				}
		}

	}

	public function fct_coreografias_cadastradas( $insti_id = '', $grp_id = '', $event_id = '' )
	{
		/*
		 * -------------------------------------------------------------
		 * Coreografias Cadastradas
		 * -------------------------------------------------------------
		**/
		$this->corgfMD->from('tbl_coreografias CORF', true)
			->select('CORF.*')
			->select('MODL.modl_titulo')
			->select('FORMT.formt_titulo')
			->select('CATEG.categ_titulo')
			->join('tbl_modalidades MODL', 'MODL.modl_id = CORF.modl_id', 'LEFT')
			->join('tbl_formatos FORMT', 'FORMT.formt_id = CORF.formt_id', 'LEFT')
			->join('tbl_categorias CATEG', 'CATEG.categ_id = CORF.categ_id', 'LEFT')
			->where('CORF.insti_id', (int)$insti_id)
			->where('CORF.grp_id', (int)$grp_id)
			->orderBy('CORF.corgf_id', 'ASC')
			->limit(200);
		$query = $this->corgfMD->get();

		/*
		$this->corgfMD->select('*')
			->where('insti_id', (int)$insti_id)
			->where('grp_id', (int)$grp_id)
			//->where('event_id', (int)$event_id)
			->orderBy('corgf_id', 'ASC')
			->limit(100);
		$query = $this->corgfMD->get();
		*/
		return $query;	
	}
	public function fct_elenco_por_coreografia( $corgf_id = '', $event_id = 0,  $forma_cobranca = [])
	{
		/*
		 * -------------------------------------------------------------
		 * Elenco Relacionado
		 * -------------------------------------------------------------
		**/
		$this->crfpaMD->from('tbl_coreografias_x_participantes CRFPA', true)
			->select('PARTC.partc_id, PARTC.partc_hashkey, PARTC.partc_nome, PARTC.partc_documento ')
			->select('FUNC.func_id, FUNC.func_titulo')
			->join('tbl_participantes PARTC', 'PARTC.partc_id = CRFPA.partc_id', 'INNER')
			->join('tbl_funcoes AS FUNC', 'FUNC.func_id = PARTC.func_id', 'INNER')
			->where('CRFPA.corgf_id', (int)$corgf_id)
			->orderBy('PARTC.partc_nome', 'ASC')
			->limit(100);
		$query = $this->crfpaMD->get();
		$rs_participantes = $query->getResultArray();

		$xP = 0;
		$lista_de_participantes = [];
		$valores_totais = 0;
		foreach ($rs_participantes as $rowP) {
			//$arr_item = $rowP;
			//$rowP['valor'] = 10;
			//$rowP['desconto'] = 0;
			//array_push($arr_item, $arr_temp);

			if( in_array('por_participante', $forma_cobranca) ){
				$this->evvlrMD->select('*');
				$this->evvlrMD->where('event_id', (int)$event_id);
				$this->evvlrMD->where('func_id', (int)$rowP['func_id']);
				$this->evvlrMD->where('evvlr_label', 'valores-participantes');
				$this->evvlrMD->orderBy('event_id', 'DESC');
				$this->evvlrMD->limit(1);
				$query_valor_por_funcao = $this->evvlrMD->get();
				if( $query_valor_por_funcao && $query_valor_por_funcao->resultID->num_rows >= 1 )
				{
					$rs_vlr_funcao = $query_valor_por_funcao->getRow();	
					if( in_array('doacao', $forma_cobranca) ){
						$rowP['valor'] = $rs_vlr_funcao->evvlr_quant;
						$rowP['desconto'] = 0;
					}else{
						$rowP['valor'] = $rs_vlr_funcao->evvlr_valor;
						$rowP['desconto'] = $rs_vlr_funcao->evvlr_vlr_desc;

						$valores_totais = $valores_totais + $rs_vlr_funcao->evvlr_valor;
					}
				}
			}else{
				$rowP['valor'] = 0;
				$rowP['desconto'] = 0;
			}
			$lista_de_participantes[] = $rowP;
			//print_debug( $rowP );
		}


		$listagem_retorno['lista'] = $lista_de_participantes;
		$listagem_retorno['valores_totais'] = $valores_totais;


		//$lastQuery = $this->crfpaMD->getLastQuery();
		//print_debug( $lista_de_participantes );
		//exit();

		return $listagem_retorno;	
	}



	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$corgf_hashkey = $this->request->getPost('corgf_hashkey');
			$query = $this->corgfMD->where('corgf_hashkey', $corgf_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$corgf_id = (int)$rs_registro->corgf_id;


				//// Excluir Participantes Relacionados
				//$this->crfpaMD->where('corgf_id', $corgf_id);
				//$this->crfpaMD->delete();


				//// excluir registro
				//$this->corgfMD->where('corgf_hashkey', $corgf_hashkey);
				//$this->corgfMD->where('corgf_id', $corgf_id);
				//$this->corgfMD->delete();


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
		}
	}

}
