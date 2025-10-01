<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Responsaveis extends PainelController
{
	protected $userMD = null;
	protected $folder_upload = null;
	protected $cfg = null;

    public function __construct()
    {
        $this->userMD = new \App\Models\UsuariosModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'responsaveis';

		$this->folder_upload = 'files-upload/';
		$this->data['folder_upload'] = $this->folder_upload;

		$this->cfg = new \Config\AppSettings();
		$this->data['cfg'] = $this->cfg;
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

		$this->userMD->select('*')
			->where('user_nivel', 'inscricao')
			->limit(1000);
		$query = $this->userMD->get();
		//$this->data['lastQuery'] = $this->userMD->getLastQuery();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/responsaveis', $this->data);
	}


	public function form( $user_id = 0 )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"user_nome" => [
					"label" => "Título", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$user_nome = $this->request->getPost('user_nome');
				$user_sobrenome = $this->request->getPost('user_sobrenome');
				$user_email = $this->request->getPost('user_email');
				$user_senha = $this->request->getPost('user_senha');
				$user_ativo = (int)$this->request->getPost('user_ativo');

				$data_db = [
					'user_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'user_urlpage' => url_title( convert_accented_characters($user_nome), '-', TRUE ),
					'user_nivel' => 'inscricao',
					'user_nome' => $user_nome,
					'user_sobrenome' => $user_sobrenome,
					'user_senha' => fct_password_hash($user_senha),
					'user_dte_cadastro' => date("Y-m-d H:i:s"),
					'user_dte_alteracao' => date("Y-m-d H:i:s"),
					'user_ativo' => $user_ativo,
				];

				$queryEdit = $this->userMD->where('user_id', $user_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >= 1 )
				{
					unset( $data_db['user_hashkey'] );
					unset( $data_db['user_dte_cadastro'] );
					if( empty($user_senha) ){ unset( $data_db['user_senha'] ); }
					$qryExecute = $this->userMD->update($user_id, $data_db);
				}else{
					$user_id = $this->userMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('responsaveis') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}

		$query = $this->userMD
			->where('user_nivel', 'inscricao')
			->where('user_id', $user_id)
			->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}


		return view($this->directory .'/responsaveis-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$user_hashkey = $this->request->getPost('user_hashkey');
			$query = $this->userMD
				->where('user_hashkey', $user_hashkey)
				->where('user_nivel', 'inscricao')
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$user_id = (int)$rs_registro->user_id;			

				// excluir registro
				$this->userMD->where('user_hashkey', $user_hashkey);
				$this->userMD->delete();

				// excluir tabelas relacionadas
				//$this->userMD->where('user_hashkey', $user_hashkey);
				//$this->userMD->delete();

				$error_num = "0";
				$error_msg = "Registro excluído com sucesso!";
				$redirect = "";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				//"redirect" => $redirect 
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		case "VALIDAR-CPF" :

			$error_num = "0";
			$error_msg = "Pode Continuar!";

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
