<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Jurados extends PainelController
{
	protected $jurdMD = null;
	protected $folder_upload = null;
	protected $cfg = null;

    public function __construct()
    {
        $this->jurdMD = new \App\Models\JuradosModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'categorias';

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


		//$this->jurdMD->orderBy('jurd_id', 'DESC')
		//	->limit(1000);
		//$query = $this->jurdMD->get();

		$this->jurdMD->from('tbl_jurados As JURD', true)
			->select('JURD.*')
			->where('JURD.insti_id', (int)$this->session_user_id)
			->orderBy('jurd_id', 'DESC')
			->limit(1000);
		$query = $this->jurdMD->get();


		$this->data['lastQuery'] = $this->jurdMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/jurados', $this->data);
	}


	public function form( $jurd_id = 0 )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"jurd_nome" => [
					"label" => "Nome", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$jurd_nome = $this->request->getPost('jurd_nome');
				$jurd_email = $this->request->getPost('jurd_email');
				$jurd_senha = $this->request->getPost('jurd_senha');
				$jurd_file_foto = $this->request->getPost('jurd_file_foto');
				$jurd_ativo = (int)$this->request->getPost('jurd_ativo');

				$file_foto = '';
				$fileFOTO = $this->request->getFile('file_foto');
				if( $fileFOTO ){
					if ($fileFOTO->isValid() && ! $fileFOTO->hasMoved()){
						$originalName = $fileFOTO->getClientName();

						$arq_original = $originalName; 
						$extension = $fileFOTO->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$file_foto = $originalName .'__foto_jurd__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileFOTO->getRandomName();
						$fileFOTO->move( $this->folder_upload .'/', $file_foto);
					}
				}

				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'jurd_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'jurd_urlpage' => url_title( convert_accented_characters($jurd_nome), '-', TRUE ),
					'jurd_nome' => $jurd_nome,
					'jurd_email' => $jurd_email,
					'jurd_senha' => fct_password_hash($jurd_senha),
					'jurd_file_foto' => $jurd_file_foto,
					'jurd_dte_cadastro' => date("Y-m-d H:i:s"),
					'jurd_dte_alteracao' => date("Y-m-d H:i:s"),
					'jurd_ativo' => $jurd_ativo,
				];

				if( !empty($file_foto)){
					$data_db['jurd_file_foto'] = $file_foto;
				}

				$queryEdit = $this->jurdMD->where('jurd_id', $jurd_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['jurd_hashkey'] );
					unset( $data_db['jurd_dte_cadastro'] );
					if( empty($jurd_senha) ){ unset( $data_db['jurd_senha'] ); }
					$qryExecute = $this->jurdMD->update($jurd_id, $data_db);
				}else{
					$jurd_id = $this->jurdMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('jurados') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}

		$query = $this->jurdMD->where('jurd_id', $jurd_id)
			->where('insti_id', (int)$this->session_user_id)
			->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}

		return view($this->directory .'/jurados-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$jurd_hashkey = $this->request->getPost('jurd_hashkey');
			$query = $this->jurdMD->where('jurd_hashkey', $jurd_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$jurd_id = (int)$rs_registro->jurd_id;			

				// excluir registro
				$this->jurdMD->where('jurd_hashkey', $jurd_hashkey)->delete();

				//$this->jurdMD->set('solt_excluido', 1);
				//$this->jurdMD->where('jurd_hashkey', $jurd_hashkey);
				//$this->jurdMD->where('jurd_id', $jurd_id);
				//$this->jurdMD->update();

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
