<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Usuarios extends PainelController
{
	protected $userMD = null;
	protected $folder_upload = null;
	protected $cfg = null;

    public function __construct()
    {
        $this->userMD = new \App\Models\UsuariosModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'usuarios';

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


		//$this->userMD->orderBy('user_id', 'DESC')
		//	->limit(1000);
		//$query = $this->userMD->get();

		$this->userMD->select('*')
			->limit(1000);
		$query = $this->userMD->get();
		//$this->data['lastQuery'] = $this->userMD->getLastQuery();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/usuarios', $this->data);
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
				$user_email = $this->request->getPost('user_email');
				$user_ativo = (int)$this->request->getPost('user_ativo');

				$data_db = [
					'user_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'user_urlpage' => url_title( convert_accented_characters($user_nome), '-', TRUE ),
					'grp_id' => $grp_id,
					'func_id' => $func_id,
					'user_nome' => $user_nome,
					'user_nome_social' => $user_nome_social,
					'user_genero' => $user_genero,
					'user_documento' => $user_documento,
					'user_dte_nascto' => fct_date2bd($user_dte_nascto),
					'user_dte_cadastro' => date("Y-m-d H:i:s"),
					'user_dte_alteracao' => date("Y-m-d H:i:s"),
					'user_ativo' => $user_ativo,
				];

				if( !empty($file_foto)){
					$data_db['user_file_foto'] = $file_foto;
				}
				if( !empty($file_doc_frente)){
					$data_db['user_file_doc_frente'] = $file_doc_frente;
				}
				if( !empty($file_doc_verso)){
					$data_db['user_file_doc_verso'] = $file_doc_verso;
				}

				$queryEdit = $this->userMD->where('user_id', $user_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['user_hashkey'] );
					unset( $data_db['user_dte_cadastro'] );
					$qryExecute = $this->userMD->update($user_id, $data_db);
				}else{
					$user_id = $this->userMD->insert($data_db);
				}

				//return $this->response->redirect( current_url() );

				$_grp_hashkey = (isset($this->rs_params->grp) ? $this->rs_params->grp : "");
				if( !empty($_grp_hashkey) > 0 ){ $link_param =  '/params/grp:'. $_grp_hashkey; }
				return $this->response->redirect( painel_url('participantes/form/'. $link_param) );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}





		/*
		 * -------------------------------------------------------------
		 * Listagem de participantes do Grupo
		 * -------------------------------------------------------------
		**/
			if( $user_id == 0 ){
				$link_param = "";
				$_grp_hashkey = (isset($this->rs_params->grp) ? $this->rs_params->grp : "");
				//if( !empty($_grp_hashkey) > 0 ){ $link_param =  '/params/grp:'. $_grp_hashkey; }
				$this->userMD->from('tbl_participantes As PARTC', true)
					->select('PARTC.*')
					->select('GRP.grp_hashkey, GRP.grp_titulo, FUNC.func_titulo')
					->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'LEFT')
					->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'LEFT')
					->join('tbl_funcoes FUNC', 'FUNC.func_id = PARTC.func_id', 'LEFT')
					->where('PARTC.insti_id', (int)$this->session_user_id)
					->where('GRP.grp_hashkey', $_grp_hashkey)
					->orderBy('PARTC.user_nome', 'ASC')
					->limit(1000);
				$query_partc = $this->userMD->get();
				//print $this->userMD->getLastQuery();
				if( $query_partc && $query_partc->resultID->num_rows >=1 )
				{
					$rs_user_list = $query_partc->getResult();
					$this->data['rs_user_list'] = $rs_user_list;
				}
			}




		$query = $this->userMD->where('user_id', $user_id)
			->where('insti_id', (int)$this->session_user_id)
			->get();

		//$this->userMD->from('tbl_participantes As PARTC', true)
		//	->select('PARTC.*')
		//	->select('GRP.grp_titulo')
		//	->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'LEFT')
		//$query = $this->userMD->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;

			$this->userMD->from('tbl_participantes As PARTC', true)
				->select('PARTC.*')
				->select('GRP.grp_titulo')
				->select('FUNC.func_titulo')
				->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'LEFT')
				->join('tbl_funcoes FUNC', 'FUNC.func_id = PARTC.func_id', 'LEFT')
				->where('PARTC.insti_id', (int)$this->session_user_id)
				->orderBy('user_id', 'DESC')
				->limit(1000);
			$query_list = $this->userMD->get();

			if( $query_list && $query_list->resultID->num_rows >=1 )
			{
				$this->data['rs_list'] = $query_list;
			}
		}


		$query_grupos = $this->grpMD->select_all_by_insti_id();
		if( $query_grupos && $query_grupos->resultID->num_rows >=1 )
		{
			$this->data['rs_grupos'] = $query_grupos;
		}


		$query_funcoes = $this->funcMD->where('func_ativo', '1')
			->orderBy('func_titulo', 'ASC')
			->get();
		if( $query_funcoes && $query_funcoes->resultID->num_rows >=1 )
		{
			$this->data['rs_funcoes'] = $query_funcoes;
		}


		$this->data['arr_generos'] = $this->cfg->getGeneros();


		return view($this->directory .'/participantes-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$user_hashkey = $this->request->getPost('user_hashkey');
			$query = $this->userMD->where('user_hashkey', $user_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$user_id = (int)$rs_registro->user_id;			

				// excluir registro
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
