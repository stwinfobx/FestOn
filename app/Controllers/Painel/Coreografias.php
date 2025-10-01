<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Coreografias extends PainelController
{
	protected $corgfMD = null;
	protected $crfpaMD = null;
	protected $grpMD = null;
	protected $modlMD = null;
	protected $formtMD = null;
	protected $categMD = null;
	protected $partcMD = null;
	protected $folder_upload = null;

    public function __construct()
    {
        $this->corgfMD = new \App\Models\CoreografiasModel();
		$this->crfpaMD = new \App\Models\CoreografiasParticipantesModel();
		$this->grpMD = new \App\Models\GruposModel();
		$this->modlMD = new \App\Models\ModalidadesModel();
		$this->formtMD = new \App\Models\FormatosModel();
		$this->categMD = new \App\Models\CategoriasModel();
		$this->partcMD = new \App\Models\ParticipantesModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'coreografias';

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

		return view($this->directory .'/coreografias', $this->data);
	}


	public function form( $corgf_id = 0 )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"corgf_titulo" => [
					"label" => "Nome", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$grp_id = (int)$this->request->getPost('grp_id');
				$modl_id = (int)$this->request->getPost('modl_id');
				$formt_id = (int)$this->request->getPost('formt_id');
				$categ_id = (int)$this->request->getPost('categ_id');
				$corgf_titulo = $this->request->getPost('corgf_titulo');
				$corgf_coreografo = $this->request->getPost('corgf_coreografo');
				$corgf_musica = $this->request->getPost('corgf_musica');
				$corgf_musica_tempo = $this->request->getPost('corgf_musica_tempo');
				$corgf_compositor = $this->request->getPost('corgf_compositor');
				$corgf_linkvideo = $this->request->getPost('corgf_linkvideo');
				$corgf_observacao = $this->request->getPost('corgf_observacao');
				$corgf_ativo = (int)$this->request->getPost('corgf_ativo');

				$corgf_tempo = 0;
				$limite_tempo = '4:00';

				$file_musica_mp3 = '';
				$fileMusicaMP3 = $this->request->getFile('fileMusicaMP3');
				if( $fileMusicaMP3 ){
					if ($fileMusicaMP3->isValid() && ! $fileMusicaMP3->hasMoved()){
						$originalName = $fileMusicaMP3->getClientName();

						$arq_original = $originalName; 
						$extension = $fileMusicaMP3->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$file_musica_mp3 = $originalName .'__musica__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileDOCVERSO->getRandomName();
						$fileMusicaMP3->move( $this->folder_upload .'/musicas/', $file_musica_mp3 );
						//$corgf_tempo = obterDuracaoMP3( $this->folder_upload .'/musicas/'. $file_musica_mp3 );

						$corgf_tempo = self::obterDuracao( $this->folder_upload .'/musicas/'. $file_musica_mp3 );
					}
				}

				// LIMITAR TEMPO TOTAL
				if( $corgf_tempo > $limite_tempo ){
					exit('TEMPO LIMITE EXCEDIDO');
				}

				// corgf_tempo
				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'grp_id' => (int)$grp_id,
					'modl_id' => (int)$modl_id,
					'formt_id' => (int)$formt_id,
					'categ_id' => (int)$categ_id,
					'corgf_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'corgf_urlpage' => url_title( convert_accented_characters($corgf_titulo), '-', TRUE ),
					'corgf_titulo' => $corgf_titulo,
					'corgf_coreografo' => $corgf_coreografo,
					'corgf_musica' => $corgf_musica,
					'corgf_tempo' => $corgf_tempo,
					'corgf_compositor' => $corgf_compositor,
					'corgf_observacao' => $corgf_observacao,
					'corgf_linkvideo' => $corgf_linkvideo,
					'corgf_dte_cadastro' => date("Y-m-d H:i:s"),
					'corgf_dte_alteracao' => date("Y-m-d H:i:s"),
					'corgf_ativo' => (int)$corgf_ativo,
				];

				if( !empty($file_musica_mp3)){
					$data_db['corgf_musica_file'] = $file_musica_mp3;
				}

				$queryEdit = $this->corgfMD->where('corgf_id', $corgf_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['corgf_hashkey'] );
					unset( $data_db['corgf_dte_cadastro'] );
					$this->corgfMD->set($data_db);
					$this->corgfMD->where('corgf_id', $corgf_id);
					$this->corgfMD->update();
				}else{
					$corgf_id = $this->corgfMD->insert($data_db);
				}

				$_grp_hashkey = (isset($this->rs_params->grp) ? $this->rs_params->grp : "");
				if( !empty($_grp_hashkey) > 0 ){ $link_param =  '/params/grp:'. $_grp_hashkey; }
				return $this->response->redirect( painel_url('coreografias/form/'. $link_param) );
				//return $this->response->redirect( painel_url('coreografias') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}




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








		$query = $this->corgfMD->where('corgf_id', $corgf_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;

			$this->partcMD->from('tbl_participantes As PARTC', true)
				->select('PARTC.*')
				->select('FUNC.func_titulo')
				//->select('GRP.grp_hashkey, GRP.grp_titulo, MODL.modl_titulo, FORMT.formt_titulo, CATEG.categ_titulo')
				->join('tbl_coreografias_x_participantes CRFPA', 'CRFPA.partc_id = PARTC.partc_id', 'INNER')
				->join('tbl_funcoes FUNC', 'FUNC.func_id = PARTC.func_id', 'LEFT')
				->where('PARTC.insti_id', (int)$this->session_user_id)
				->where('CRFPA.corgf_id', $rs_dados->corgf_id)
				->orderBy('PARTC.partc_nome', 'ASC')
				->limit(1000);
			$query_partic_corgf = $this->partcMD->get();
			if( $query_partic_corgf && $query_partic_corgf->resultID->num_rows >=1 )
			{
				//$rs_partic_corgf = $query_partic_corgf->getResult();
				$this->data['rs_partic_corgf'] = $query_partic_corgf;
			}
		}

		$query_grupos = $this->grpMD->select_all_by_insti_id();
		if( $query_grupos && $query_grupos->resultID->num_rows >=1 )
		{
			$this->data['rs_grupos'] = $query_grupos;
		}

		$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$this->session_user_id );
		if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
		{
			$this->data['rs_modalidades'] = $query_modalidades;
		}

		$query_formatos = $this->formtMD->select_all_by_insti_id( (int)$this->session_user_id );
		if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
		{
			$this->data['rs_formatos'] = $query_formatos;
		}

		$query_categorias = $this->categMD->select_all_by_insti_id( (int)$this->session_user_id );
		if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
		{
			$this->data['rs_categorias'] = $query_categorias;
		}

		$query_participantes = $this->partcMD->select_all_by_insti_id( (int)$this->session_user_id );
		if( $query_participantes && $query_participantes->resultID->num_rows >=1 )
		{
			$this->data['rs_participantes'] = $query_participantes;
		}



		// $query_grupos = $this->grpMD->select_all_by_insti_id();
        // if (!empty($query_grupos)) {
        //     $this->data['rs_grupos'] = $query_grupos;
        // }

        // // Buscar modalidades
        // $query_modalidades = $this->modlMD->select_all_by_insti_id((int)$this->session_user_id);
        // if (!empty($query_modalidades)) {
        //     $this->data['rs_modalidades'] = $query_modalidades;
        // }

        // // Buscar formatos
        // $query_formatos = $this->formtMD->select_all_by_insti_id((int)$this->session_user_id);
        // if (!empty($query_formatos)) {
        //     $this->data['rs_formatos'] = $query_formatos;
        // }

        // // Buscar categorias
        // $query_categorias = $this->categMD->select_all_by_insti_id((int)$this->session_user_id);
        // if (!empty($query_categorias)) {
        //     $this->data['rs_categorias'] = $query_categorias;
        // }

        // // Buscar participantes
        // $query_participantes = $this->partcMD->select_all_by_insti_id((int)$this->session_user_id);
        // if (!empty($query_participantes)) {
        //     $this->data['rs_participantes'] = $query_participantes;
        // }


		return view($this->directory .'/coreografias-form', $this->data);
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
		case "TEMPO-MUSICA-MAX-PARTIC" :

			$formt_tempo_limit = '';
			$formt_max_partic = '';

			$formt_id = $this->request->getPost('formt_id');
			$query = $this->formtMD->where('formt_id', $formt_id)->limit(1)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$formt_tempo_limit = $rs_registro->formt_tempo_limit;
				$formt_max_partic = (int)$rs_registro->formt_max_partic;

				$error_num = "0";
				$error_msg = "Formato encontrado";
			}else{
				$error_num = "1";
				$error_msg = "Formato inexistente";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"formt_tempo_limit" => $formt_tempo_limit,
				"formt_max_partic" => $formt_max_partic,
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		}
	}

    public function obterDuracao($fileName)
    {
        // Carrega a biblioteca getID3
        require_once APPPATH . 'ThirdParty/getID3/getid3.php';

        // Caminho para o arquivo MP3
        //$caminhoDoArquivoMP3 = 'caminho/para/seu/arquivo.mp3'; // Substitua pelo caminho real.

        // Instancia o objeto getID3
        $getID3 = new \getID3;

        // Obtém as informações do arquivo
        $info = $getID3->analyze($fileName);

        // Obtém a duração do arquivo MP3
        $duracao = $info['playtime_string'];

        // Exibe a duração
        return $duracao;
		//echo "Duração do arquivo MP3: $duracao";
    }

}
