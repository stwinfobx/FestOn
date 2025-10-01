<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Configuracoes extends PainelController
{
	protected $cfgMD = null;
	protected $cupomMD = null;

    public function __construct()
    {
        $this->cfgMD = new \App\Models\ConfiguracoesModel();
		$this->cupomMD = new \App\Models\CuponsModel();

		//$this->eventMD = new \App\Models\EventosModel();
		//$this->evdteMD = new \App\Models\EventosDatasModel();
		//$this->evvlrMD = new \App\Models\EventosValoresModel();
		//$this->evcobMD = new \App\Models\EventosCobrancaModel();
		//$this->funcMD = new \App\Models\FuncoesModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'configuracoes';

		$this->folder_upload = 'files-upload/';
		$this->data['folder_upload'] = $this->folder_upload;
    }


	public function index()
	{
		self::form();
		return self::load();
	}


	public function load()
	{
		/*
		 * -------------------------------------------------------------
		 * config valores
		 * -------------------------------------------------------------
		**/
			$query = $this->cfgMD->where('cfg_chave', 'valor-setup')->get();
			if( $query && $query->resultID->num_rows >= 1 )
			{
				$rs_valor_setup = $query->getRow();
				$this->data['rs_valor_setup'] = $rs_valor_setup;
			}

		/*
		 * -------------------------------------------------------------
		 * cupons
		 * -------------------------------------------------------------
		**/
			$query_cupons = $this->cupomMD->orderBy('cupom_id', 'DESC')->get();
			if( $query_cupons && $query_cupons->resultID->num_rows >= 1 )
			{
				$this->data['rs_cupons'] = $query_cupons;
			}

		return view($this->directory .'/configuracoes-form', $this->data);		
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

		$this->data['lastQuery'] = $this->eventMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/eventos', $this->data);
	}


	public function form()
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"cfg_valor" => [
					"label" => "Valor", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$cfg_categ = $this->request->getPost('cfg_categ');
				$cfg_valor = $this->request->getPost('cfg_valor');
				$cfg_valor_desc = $this->request->getPost('cfg_valor_desc');
				$cfg_dte_limite_desc = $this->request->getPost('cfg_dte_limite_desc');

				$cfg_valor = (empty($cfg_valor) ? '0' : $cfg_valor);
				$cfg_valor_desc = (empty($cfg_valor_desc) ? '0' : $cfg_valor_desc);

				$error_infos[] = $this->request->getPost();

				//print('<pre>');
				//var_dump( $error_infos );
				//print('</pre>');
				//exit();

				$arr_valores = [
					'categoria' => $cfg_categ,
					'valor' => fct_to_money($cfg_valor, 2, "bd"),
					'desconto' => fct_to_money($cfg_valor_desc, 2, "bd"),
					'data_limite' => fct_date2bd($cfg_dte_limite_desc)
				];

				$cfg_area = 'valor-setup';
				$cfg_chave = 'valor-setup';
				$cfg_ativo = 1;

				//var_dump( $arr_valores );
				//exit();

				$data_db = [
					'cfg_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'cfg_urlpage' => url_title( convert_accented_characters($cfg_area), '-', TRUE ),
					'cfg_area' => $cfg_area,
					'cfg_chave' => $cfg_chave,
					'cfg_value' => json_encode($arr_valores),
					'cfg_dte_cadastro' => date("Y-m-d H:i:s"),
					'cfg_dte_alteracao' => date("Y-m-d H:i:s"),
					'cfg_ativo' => (int)$cfg_ativo,
				];

				$queryEdit = $this->cfgMD->where('cfg_area', $cfg_area)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['cfg_hashkey'] );
					unset( $data_db['cfg_dte_cadastro'] );

					$this->cfgMD->set($data_db);
					$this->cfgMD->where('cfg_chave', $cfg_chave);
					$this->cfgMD->update();
				}else{
					$cfg_id = $this->cfgMD->insert($data_db);
				}

				return $this->response->redirect( current_url() );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}
	}


	public function cupons( $cupom_id = "" )
	{
		if ($this->request->getMethod() == 'post')
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"cupom_codigo" => [
					"label" => "Código", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$cupom_id = (int)$this->request->getPost('cupom_id');
				$cupom_codigo = $this->request->getPost('cupom_codigo');
				//$cupom_dte_inicio = $this->request->getPost('cupom_dte_inicio');
				$cupom_dte_termino = $this->request->getPost('cupom_dte_termino');
				//$cupom_limite = (int)$this->request->getPost('cupom_limite');
				$cupom_valor_desc = $this->request->getPost('cupom_valor_desc');
				$cupom_percentual = $this->request->getPost('cupom_percentual');
				$cupom_ativo = (int)$this->request->getPost('cupom_ativo');

				$data_db = [
					'cupom_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'cupom_urlpage' => url_title( convert_accented_characters($cupom_codigo), '-', TRUE ),
					'cupom_codigo' => $cupom_codigo,
					//'cupom_dte_inicio' => fct_date2bd($cupom_dte_inicio),
					'cupom_dte_termino' => fct_date2bd($cupom_dte_termino),
					//'cupom_limite' => $cupom_limite,
					'cupom_valor_desc' => fct_to_money($cupom_valor_desc, 2, "bd"),
					'cupom_percentual' => fct_to_money($cupom_percentual, 2, "bd"),
					'cupom_dte_cadastro' => date("Y-m-d H:i:s"),
					'cupom_dte_alteracao' => date("Y-m-d H:i:s"),
					'cupom_ativo' => $cupom_ativo,
				];

				$query_edit = $this->cupomMD->where('cupom_id', $cupom_id)->get();
				if( $query_edit && $query_edit->resultID->num_rows >=1 )
				{
					unset( $data_db['cupom_hashkey'] );
					unset( $data_db['cupom_dte_cadastro'] );
					//$lastQquery = $this->prodMD->where('CODIGO', $CODIGO)->getCompiledSelect();//->update($CODIGO, $data_db);
					$qry_execute = $this->cupomMD->update($cupom_id, $data_db);
				}else{
					$cupom_id = $this->cupomMD->insert($data_db);
				}
			} else {
				$this->data['validation'] = $validation->getErrors();
			}

			return $this->response->redirect( painel_url('configuracoes') );
			exit();
		}

		/*
		 * -------------------------------------------------------------
		 * config valores
		 * -------------------------------------------------------------
		**/
			$query = $this->cupomMD->where('cupom_id', $cupom_id)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_cupom = $query->getRow();
				$this->data['rs_cupom'] = $rs_cupom;
			}
			
		return self::load();
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
		case "EXCLUIR-CUPOM" :

			$cupom_hashkey = $this->request->getPost('cupom_hashkey');
			$query = $this->cupomMD->where('cupom_hashkey', $cupom_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$cupom_id = (int)$rs_registro->cupom_id;			

				// excluir registro
				$this->cupomMD->where('cupom_hashkey', $cupom_hashkey)->delete();

				$error_num = "0";
				$error_msg = "Registro excluído com sucesso!";
				$redirect = "";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		}
	}

}
