<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Autorizacoes extends PainelController
{
	protected $autzMD = null;

    public function __construct()
    {
        $this->autzMD = new \App\Models\AutorizacoesModel();

		$this->data['menu_active'] = 'categorias';
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

		$this->autzMD->from('tbl_autorizacoes GRUPO', true)
			->select('GRUPO.autz_id, GRUPO.autz_parent_id, GRUPO.autz_hashkey, GRUPO.autz_titulo')
			->select('ITENS.autz_titulo As autz_titulo_parent')
			->join('tbl_autorizacoes ITENS', 'GRUPO.autz_parent_id = ITENS.autz_id', 'LEFT')
			->orderBy('GRUPO.autz_id', 'ASC')
			->orderBy('GRUPO.autz_parent_id', 'ASC')
			->limit(1000);
		$query = $this->autzMD->get();
		//$this->data['lastQuery'] = $this->autzMD->getLastQuery();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/autorizacoes', $this->data);
	}


	public function form( $autz_id = 0 )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"autz_titulo" => [
					"label" => "Título", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$autz_parent_id = (int)$this->request->getPost('autz_parent_id');
				$autz_titulo = $this->request->getPost('autz_titulo');
				$autz_descricao = $this->request->getPost('autz_descricao');
				$autz_descricao_full = $this->request->getPost('autz_descricao_full');
				$autz_ativo = (int)$this->request->getPost('autz_ativo');
				
				$data_db = [
					'autz_parent_id' => $autz_parent_id,
					'autz_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'autz_urlpage' => url_title( convert_accented_characters($autz_titulo), '-', TRUE ),
					'autz_titulo' => $autz_titulo,
					'autz_descricao' => $autz_descricao,
					'autz_descricao_full' => $autz_descricao_full,
					'autz_dte_cadastro' => date("Y-m-d H:i:s"),
					'autz_dte_alteracao' => date("Y-m-d H:i:s"),
					'autz_ativo' => $autz_ativo,
				];

				$queryEdit = $this->autzMD->where('autz_id', $autz_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['autz_hashkey'] );
					unset( $data_db['autz_dte_cadastro'] );
					$qryExecute = $this->autzMD->update($autz_id, $data_db);
				}else{
					$autz_id = $this->autzMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('autorizacoes') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->autzMD->where('autz_id', $autz_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}

		$query_parent = $this->autzMD
			->where('autz_parent_id', '0')
			->get();
		if( $query_parent && $query_parent->resultID->num_rows >=1 )
		{
			$rs_parent = $query_parent->getResult();
			$this->data['rs_parent'] = $rs_parent;
		}


		return view($this->directory .'/autorizacoes-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$autz_hashkey = $this->request->getPost('autz_hashkey');
			$query = $this->autzMD->where('autz_hashkey', $autz_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$autz_id = (int)$rs_registro->autz_id;			

				// excluir registro
				$this->autzMD->where('autz_hashkey', $autz_hashkey)->delete();

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
		}
	}

}
