<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Criterios extends PainelController
{
	protected $critMD = null;

    public function __construct()
    {
        $this->critMD = new \App\Models\CriteriosModel();

		helper('form');
		helper('text');

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


		$this->critMD
			->where('insti_id', (int)$this->session_user_id)
			->orderBy('crit_id', 'DESC')
			->limit(1000);
		$query = $this->critMD->get();

		$this->data['lastQuery'] = $this->critMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/criterios', $this->data);
	}

	public function form( $crit_id = 0 )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"crit_titulo" => [
					"label" => "Nome", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$crit_titulo = $this->request->getPost('crit_titulo');
				$crit_nota_min = (int)$this->request->getPost('crit_nota_min');
				$crit_ativo = (int)$this->request->getPost('crit_ativo');
				
				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'crit_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'crit_urlpage' => url_title( convert_accented_characters($crit_titulo), '-', TRUE ),
					'crit_titulo' => $crit_titulo,
					'crit_dte_cadastro' => date("Y-m-d H:i:s"),
					'crit_dte_alteracao' => date("Y-m-d H:i:s"),
					'crit_ativo' => $crit_ativo,
				];

				$queryEdit = $this->critMD->where('crit_id', $crit_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['crit_hashkey'] );
					unset( $data_db['crit_dte_cadastro'] );
					$qryExecute = $this->critMD->update($crit_id, $data_db);
				}else{
					$crit_id = $this->critMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('criterios') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->critMD->where('crit_id', $crit_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}

		return view($this->directory .'/criterios-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$crit_hashkey = $this->request->getPost('crit_hashkey');
			$query = $this->critMD->where('crit_hashkey', $crit_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$crit_id = (int)$rs_registro->crit_id;			

				// excluir registro
				$this->critMD->where('crit_hashkey', $crit_hashkey)->delete();

				//$this->critMD->set('solt_excluido', 1);
				//$this->critMD->where('crit_hashkey', $crit_hashkey);
				//$this->critMD->where('crit_id', $crit_id);
				//$this->critMD->update();

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
