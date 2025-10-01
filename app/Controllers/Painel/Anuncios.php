<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Anuncios extends PainelController
{
	protected $anuncMD = null;
	protected $folder_upload = null;

    public function __construct()
    {
        $this->anuncMD = new \App\Models\AnunciosModel();

		helper('form');
		helper('text');

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


		$this->anuncMD
			->orderBy('anunc_id', 'DESC')
			->limit(1000);
		$query = $this->anuncMD->get();

		$this->data['lastQuery'] = $this->anuncMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/anuncios', $this->data);
	}


	public function form( $anunc_id = 0 )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"anunc_titulo" => [
					"label" => "Nome", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$anunc_titulo = $this->request->getPost('anunc_titulo');
				$anunc_subtitulo = $this->request->getPost('anunc_subtitulo');
				$anunc_redirect = $this->request->getPost('anunc_redirect');
				$anunc_ativo = (int)$this->request->getPost('anunc_ativo');

				$file_banner = '';
				$fileBANNER = $this->request->getFile('file_banner');
				if( $fileBANNER ){
					if ($fileBANNER->isValid() && ! $fileBANNER->hasMoved()){
						$originalName = $fileBANNER->getClientName();

						$arq_original = $originalName; 
						$extension = $fileBANNER->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$file_banner = $originalName .'__anuncio__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileBANNER->getRandomName();
						$fileBANNER->move( $this->folder_upload .'/', $file_banner);
					}
				}

				$data_db = [
					'anunc_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'anunc_urlpage' => url_title( convert_accented_characters($anunc_titulo), '-', TRUE ),
					'anunc_titulo' => $anunc_titulo,
					'anunc_subtitulo' => $anunc_subtitulo,
					'anunc_redirect' => $anunc_redirect,
					'anunc_dte_cadastro' => date("Y-m-d H:i:s"),
					'anunc_dte_alteracao' => date("Y-m-d H:i:s"),
					'anunc_ativo' => (int)$anunc_ativo,
				];

				if( !empty($file_banner)){
					$data_db['anunc_file_banner'] = $file_banner;
				}

				$queryEdit = $this->anuncMD->where('anunc_id', $anunc_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['anunc_hashkey'] );
					unset( $data_db['anunc_dte_cadastro'] );
					$qryExecute = $this->anuncMD->update($anunc_id, $data_db);
				}else{
					$anunc_id = $this->anuncMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('anuncios') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->anuncMD->where('anunc_id', $anunc_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}


		return view($this->directory .'/anuncios-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$anunc_hashkey = $this->request->getPost('anunc_hashkey');
			$query = $this->anuncMD->where('anunc_hashkey', $anunc_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$anunc_id = (int)$rs_registro->anunc_id;			

				// excluir registro
				$this->anuncMD->where('anunc_hashkey', $anunc_hashkey)->delete();

				//$this->anuncMD->set('solt_excluido', 1);
				//$this->anuncMD->where('anunc_hashkey', $anunc_hashkey);
				//$this->anuncMD->where('solt_id', $solt_id);
				//$this->anuncMD->update();

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
