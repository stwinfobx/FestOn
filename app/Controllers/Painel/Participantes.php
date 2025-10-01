<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

use App\Libraries\GenericLib;

class Participantes extends PainelController
{
	protected $partcMD = null;
	protected $grpMD = null;
	protected $funcMD = null;
	protected $folder_upload = null;
	protected $cfg = null;

    public function __construct()
    {
        $this->partcMD = new \App\Models\ParticipantesModel();
		$this->grpMD = new \App\Models\GruposModel();
		$this->funcMD = new \App\Models\FuncoesModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'categorias';

		$this->folder_upload = 'files-upload/';
		$this->data['folder_upload'] = $this->folder_upload;

		$this->cfg = new \Config\AppSettings();
		$this->data['cfg'] = $this->cfg;

		$this->libGeneric = new GenericLib();
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


		//$this->partcMD->orderBy('partc_id', 'DESC')
		//	->limit(1000);
		//$query = $this->partcMD->get();

		$this->partcMD->from('tbl_participantes As PARTC', true)
			->select('PARTC.*')
			->select('GRP.grp_titulo')
			->select('FUNC.func_titulo')
			->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'LEFT')
			->join('tbl_funcoes FUNC', 'FUNC.func_id = PARTC.func_id', 'LEFT')
			->where('PARTC.insti_id', (int)$this->session_user_id)
			->orderBy('partc_id', 'DESC')
			->limit(1000);
		$query = $this->partcMD->get();


		$this->data['lastQuery'] = $this->partcMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/participantes', $this->data);
	}


	public function form( $partc_id = 0 )
	{
		//print "session_user_id: ". (int)$this->session_user_id ." ---> ";

		$segment_folder = [];

		/*
		 * -------------------------------------------------------------
		 * recuperar diretórios
		 * -------------------------------------------------------------
		**/
			$this->partcMD->from('tbl_participantes As PARTC', true)
				->select('GRP.grp_urlpage')
				->select('EVENT.event_urlpage')
				->select('INSTI.insti_urlpage')
				->select('EVENT.event_urlpage')
				->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'INNER')
				->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'INNER')
				->join('tbl_eventos EVENT', 'EVENT.event_id = GRPEVT.event_id', 'INNER')
				->join('tbl_instituicoes INSTI', 'INSTI.insti_id = PARTC.insti_id', 'INNER')				
				//->where('PARTC.insti_id', (int)$this->session_user_id)
				//->where('GRP.grp_hashkey', $_grp_hashkey)
				->where('PARTC.partc_id', (int)$partc_id)
				->orderBy('PARTC.partc_nome', 'ASC')
				->limit(1);
			$query_folder = $this->partcMD->get();
			if( $query_folder && $query_folder->resultID->num_rows >= 1 )
			{
				$rs_folder = $query_folder->getRow();
				$segment_folder[] = 'instituicoes';
				$segment_folder[] = $rs_folder->insti_urlpage;
				$segment_folder[] = 'eventos';
				$segment_folder[] = $rs_folder->event_urlpage;
				$segment_folder[] = 'grupos';
				$segment_folder[] = $rs_folder->grp_urlpage;
				$segment_folder[] = 'participantes';

				//print '<pre>';
				//print_r( $segment_folder );
				//print '</pre>';

				$path_folder_grupo = implode('/', $segment_folder);

				// Sanitize the input path to prevent directory traversal attacks
				//$path = str_replace(['..', './', '.\\', '\\'], '', $path);
				$path_folder_grupo = str_replace(['..', './', '.\\', '\\'], '', $path_folder_grupo);
				$args_folder = [ 
					'area' => 'all', 
					'folder' => $path_folder_grupo  
				];
				$path_folder_participante = $this->libGeneric->check_folder($args_folder);

				$this->data['path_folder_grupo'] = $path_folder_grupo;
			}


		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"partc_nome" => [
					"label" => "Título", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$grp_id = (int)$this->request->getPost('grp_id');
				$func_id = (int)$this->request->getPost('func_id');
				$partc_nome = $this->request->getPost('partc_nome');
				$partc_nome_social = $this->request->getPost('partc_nome_social');
				$partc_genero = $this->request->getPost('partc_genero');
				$partc_documento = $this->request->getPost('partc_documento');
				$partc_dte_nascto = $this->request->getPost('partc_dte_nascto');
				$partc_ativo = (int)$this->request->getPost('partc_ativo');

				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'partc_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'partc_urlpage' => url_title( convert_accented_characters($partc_nome), '-', TRUE ),
					'grp_id' => $grp_id,
					'func_id' => $func_id,
					'partc_nome' => $partc_nome,
					'partc_nome_social' => $partc_nome_social,
					'partc_genero' => $partc_genero,
					'partc_documento' => $partc_documento,
					'partc_dte_nascto' => fct_date2bd($partc_dte_nascto),
					'partc_dte_cadastro' => date("Y-m-d H:i:s"),
					'partc_dte_alteracao' => date("Y-m-d H:i:s"),
					'partc_ativo' => $partc_ativo,
				];

				$args_file = [ 'file_name' => 'fileInputFoto', 'prefixo' => 'participante', 'folder' => $path_folder_participante ];
				$fileInputFoto = $this->libGeneric->upload_file_unico( $args_file );
				if( !empty($fileInputFoto) ){ $data_db['partc_file_foto'] = $fileInputFoto; } 

				/*
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
						$file_foto = $originalName .'__foto_partc__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileFOTO->getRandomName();
						$fileFOTO->move( $this->folder_upload .'/', $file_foto);
					}
				}

				$file_doc_frente = '';
				$fileDOCFRENTE = $this->request->getFile('file_doc_frente');
				if( $fileDOCFRENTE ){
					if ($fileDOCFRENTE->isValid() && ! $fileDOCFRENTE->hasMoved()){
						$originalName = $fileDOCFRENTE->getClientName();

						$arq_original = $originalName; 
						$extension = $fileDOCFRENTE->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$file_doc_frente = $originalName .'__doc_frente__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileDOCFRENTE->getRandomName();
						$fileDOCFRENTE->move( $this->folder_upload .'/', $file_doc_frente);
					}
				}

				$file_doc_verso = '';
				$fileDOCVERSO = $this->request->getFile('file_doc_verso');
				if( $fileDOCVERSO ){
					if ($fileDOCVERSO->isValid() && ! $fileDOCVERSO->hasMoved()){
						$originalName = $fileDOCVERSO->getClientName();

						$arq_original = $originalName; 
						$extension = $fileDOCVERSO->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$file_doc_verso = $originalName .'__doc_verso__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileDOCVERSO->getRandomName();
						$fileDOCVERSO->move( $this->folder_upload .'/', $file_doc_verso);
					}
				}
				*/
				//exit();



				//if( !empty($file_foto)){
				//	$data_db['partc_file_foto'] = $file_foto;
				//}
				//if( !empty($file_doc_frente)){
				//	$data_db['partc_file_doc_frente'] = $file_doc_frente;
				//}
				//if( !empty($file_doc_verso)){
				//	$data_db['partc_file_doc_verso'] = $file_doc_verso;
				//}

				$queryEdit = $this->partcMD->where('partc_id', $partc_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['partc_hashkey'] );
					unset( $data_db['partc_dte_cadastro'] );

					$this->partcMD->set($data_db);
					$this->partcMD->where("partc_id", $partc_id);
					$this->partcMD->update();
				}else{
					$partc_id = $this->partcMD->insert($data_db);
				}

				//return $this->response->redirect( current_url() );

				$link_param = $partc_id;

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
			if( $partc_id == 0 ){
				$link_param = "";
				$_grp_hashkey = (isset($this->rs_params->grp) ? $this->rs_params->grp : "");
				//if( !empty($_grp_hashkey) > 0 ){ $link_param =  '/params/grp:'. $_grp_hashkey; }
				$this->partcMD->from('tbl_participantes As PARTC', true)
					->select('PARTC.*')
					->select('GRP.grp_hashkey, GRP.grp_titulo, FUNC.func_titulo')
					->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'LEFT')
					->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'LEFT')
					->join('tbl_funcoes FUNC', 'FUNC.func_id = PARTC.func_id', 'LEFT')
					->where('PARTC.insti_id', (int)$this->session_user_id)
					->where('GRP.grp_hashkey', $_grp_hashkey)
					->orderBy('PARTC.partc_nome', 'ASC')
					->limit(1000);
				$query_partc = $this->partcMD->get();
				//print $this->partcMD->getLastQuery();
				if( $query_partc && $query_partc->resultID->num_rows >=1 )
				{
					$rs_partc_list = $query_partc->getResult();
					$this->data['rs_partc_list'] = $rs_partc_list;
				}
			}




		$query = $this->partcMD->where('partc_id', $partc_id)
			->where('insti_id', (int)$this->session_user_id)
			->get();

		//$this->partcMD->from('tbl_participantes As PARTC', true)
		//	->select('PARTC.*')
		//	->select('GRP.grp_titulo')
		//	->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'LEFT')
		//$query = $this->partcMD->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;

			$this->partcMD->from('tbl_participantes As PARTC', true)
				->select('PARTC.*')
				->select('GRP.grp_titulo')
				->select('FUNC.func_titulo')
				->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'LEFT')
				->join('tbl_funcoes FUNC', 'FUNC.func_id = PARTC.func_id', 'LEFT')
				->where('PARTC.insti_id', (int)$this->session_user_id)
				->orderBy('partc_id', 'DESC')
				->limit(1000);
			$query_list = $this->partcMD->get();

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

			$partc_hashkey = $this->request->getPost('partc_hashkey');
			$query = $this->partcMD->where('partc_hashkey', $partc_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$partc_id = (int)$rs_registro->partc_id;			

				// excluir registro
				//$this->partcMD->where('partc_hashkey', $partc_hashkey);
				//$this->partcMD->delete();

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
