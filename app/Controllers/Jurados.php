<?php
namespace App\Controllers;
use App\Controllers\BaseController;

use \DateTime;
use \DateInterval;

class Jurados extends BaseController
{

	protected $cfg = null;

    public function __construct()
    {
		$this->avalMD = new \App\Models\AvaliacoesModel();
		$this->critMD = new \App\Models\CriteriosModel();
		$this->corgfMD = new \App\Models\CoreografiasModel();
		$this->grpMD = new \App\Models\GruposModel();
    }

	public function index($corgf_hashkey = null)
	{
		// Se não foi passada uma coreografia específica, busca a primeira disponível
		if (!$corgf_hashkey) {
			// Buscar primeira coreografia ativa (simplificado para funcionar)
			$primeira_coreografia = $this->corgfMD
				->select('tbl_coreografias.corgf_hashkey')
				->join('tbl_grupos', 'tbl_grupos.grp_id = tbl_coreografias.grp_id', 'inner')
				->where('tbl_coreografias.corgf_ativo', 1)
				->orderBy('tbl_grupos.grp_titulo', 'ASC')
				->orderBy('tbl_coreografias.corgf_id', 'ASC')
				->first();
			if ($primeira_coreografia && !empty($primeira_coreografia->corgf_hashkey)) {
				return redirect()->to(site_url('jurados/index/' . $primeira_coreografia->corgf_hashkey));
			}
		}

		// Carregar dados da coreografia atual
		$this->data['coreografia_atual'] = null;
		$this->data['grupo_atual'] = null;
		$this->data['coreografias_grupo'] = [];
		$this->data['criterios'] = [];
		$this->data['avaliacoes_existentes'] = [];
		
		// Carregar lista de todos os grupos (simplificado)
		$this->data['grupos_lista'] = [];
		try {
			$gruposQuery = $this->corgfMD
				->select('tbl_grupos.grp_id, tbl_grupos.grp_titulo, MIN(tbl_coreografias.corgf_id) AS first_corgf_id')
				->join('tbl_grupos', 'tbl_grupos.grp_id = tbl_coreografias.grp_id', 'inner')
				->where('tbl_coreografias.corgf_ativo', 1)
				->groupBy('tbl_grupos.grp_id, tbl_grupos.grp_titulo')
				->orderBy('tbl_grupos.grp_titulo', 'ASC')
				->get();
			$gruposRows = $gruposQuery ? $gruposQuery->getResult() : [];
			$gruposLista = [];
			foreach ($gruposRows as $g) {
				$corgf = $this->corgfMD->select('corgf_hashkey')->where('corgf_id', (int)$g->first_corgf_id)->first();
				$gruposLista[] = (object)[
					'grp_id' => (int)$g->grp_id,
					'grp_titulo' => $g->grp_titulo,
					'corgf_hashkey' => $corgf ? $corgf->corgf_hashkey : ''
				];
			}
			$this->data['grupos_lista'] = $gruposLista;
		} catch (\Exception $e) {
			$this->data['grupos_lista'] = [];
		}

		if ($corgf_hashkey) {
			// BUSCAR COREOGRAFIA REAL DO BANCO DE DADOS
			$coreografia = $this->corgfMD->select('tbl_coreografias.*, tbl_grupos.grp_titulo, tbl_grupos.grp_id, 
													tbl_modalidades.modl_titulo, tbl_formatos.formt_titulo, 
													tbl_categorias.categ_titulo')
										->join('tbl_grupos', 'tbl_grupos.grp_id = tbl_coreografias.grp_id', 'inner')
										->join('tbl_modalidades', 'tbl_modalidades.modl_id = tbl_coreografias.modl_id', 'left')
										->join('tbl_formatos', 'tbl_formatos.formt_id = tbl_coreografias.formt_id', 'left')
										->join('tbl_categorias', 'tbl_categorias.categ_id = tbl_coreografias.categ_id', 'left')
										->where('tbl_coreografias.corgf_hashkey', $corgf_hashkey)
										->first();
			
            if ($coreografia) {
				$this->data['coreografia_atual'] = $coreografia;
				
				// Buscar todas as coreografias do mesmo grupo REAL
				$coreografias_grupo = $this->corgfMD->where('grp_id', $coreografia->grp_id)
													->where('corgf_ativo', 1)
													->orderBy('corgf_id', 'ASC')
													->findAll();
				$this->data['coreografias_grupo'] = $coreografias_grupo;

				// Paginação de coreografias dentro do grupo (primeiro/anterior/próximo/último)
				$hash_atual = $coreografia->corgf_hashkey;
				$pos_atual = 0; $total = count($coreografias_grupo);
				$first_hash = $last_hash = $prev_hash = $next_hash = '';
				if ($total > 0) {
					$first_hash = $coreografias_grupo[0]->corgf_hashkey;
					$last_hash = $coreografias_grupo[$total-1]->corgf_hashkey;
					foreach ($coreografias_grupo as $i => $c) {
						if ($c->corgf_hashkey === $hash_atual) { $pos_atual = $i; break; }
					}
					$prev_hash = ($pos_atual > 0) ? $coreografias_grupo[$pos_atual-1]->corgf_hashkey : '';
					$next_hash = ($pos_atual < $total-1) ? $coreografias_grupo[$pos_atual+1]->corgf_hashkey : '';
				}
				$this->data['pager_coreo'] = [
					'pos_atual' => $pos_atual+1,
					'total' => $total,
					'first' => $first_hash,
					'last' => $last_hash,
					'prev' => $prev_hash,
					'next' => $next_hash,
				];
				
				// Buscar critérios de avaliação
				$insti_id = session()->get('insti_id') ?: 1;
				$criterios = $this->critMD->select_all_by_insti_id($insti_id);
				$this->data['criterios'] = $criterios;
				
				// Buscar avaliações já existentes da coreografia atual
				$jurd_id = session()->get('jurd_id') ?: 1;
				if ($jurd_id) {
					$avaliacoes = $this->avalMD->get_avaliacoes_by_jurado_coreografia($jurd_id, $coreografia->corgf_id);
					$this->data['avaliacoes_existentes'] = $avaliacoes;
				}

                // Ajustar link de vídeo para formato embed, se necessário
                $video = (string)($coreografia->corgf_linkvideo ?? '');
                $embed = '';
                if (!empty($video)) {
                    if (preg_match('~youtu\.be/([A-Za-z0-9_-]+)~', $video, $m)) {
                        $embed = 'https://www.youtube.com/embed/' . $m[1];
                    } elseif (preg_match('~watch\?v=([A-Za-z0-9_-]+)~', $video, $m)) {
                        $embed = 'https://www.youtube.com/embed/' . $m[1];
                    } elseif (preg_match('~/embed/([A-Za-z0-9_-]+)~', $video, $m)) {
                        $embed = $video;
                    }
                }
                $this->data['video_embed'] = $embed;
			}
		}

        // Cabeçalho - dados do jurado logado (nome/foto com fallback)
        $this->data['jurd_nome'] = session()->get('jurd_nome') ?: (session()->get('user_nome') ?: 'Jurado');
        $fotoSess = session()->get('jurd_file_foto');
        if (!empty($fotoSess)) {
            $this->data['jurd_foto_url'] = site_url('files-upload/'.$fotoSess);
        } else {
            // usar um avatar existente no projeto (ajuste aqui se necessário)
            $this->data['jurd_foto_url'] = base_url('assets/avatar/avatar1.jpg');
        }

		return view('jurados/index', $this->data);
	}

	public function ajaxform( $action = "")
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$error_infos = "";

		switch ($action) {
		case "SALVAR-GRUPO" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			$grp_id = 0;
			$grp_hashkey = '';

			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				// Recuperamos o evento selecionado
				// ---------------------------------------------------------
				$event_hashkey = $this->request->getPost('event_hashkey');

				$this->eventMD->select('*');
				$this->eventMD->where('event_hashkey', $event_hashkey);
				$this->eventMD->orderBy('event_id', 'DESC');
				$this->eventMD->limit(1);
				$query_event = $this->eventMD->get();
				if( $query_event && $query_event->resultID->num_rows >=1 )
				{
					$rs_event = $query_event->getRow();
					$insti_id = (int)$rs_event->insti_id; 
					$event_id = (int)$rs_event->event_id; 

					// Precisa Relacionar o User com o Grupo
					// ---------------------------------------------------------
					$grp_titulo = $this->request->getPost('grp_titulo');
					$grp_responsavel = $this->request->getPost('grp_responsavel');
					$grp_cpf = $this->request->getPost('grp_cpf');
					$grp_telefone = $this->request->getPost('grp_telefone');
					$grp_celular = $this->request->getPost('grp_celular');
					$grp_sm_instagram = $this->request->getPost('grp_sm_instagram');
					$grp_sm_facebook = $this->request->getPost('grp_sm_facebook');
					$grp_sm_youtube = $this->request->getPost('grp_sm_youtube');
					$grp_sm_vimeo = $this->request->getPost('grp_sm_vimeo');

					$grp_redes_sociais = [
						'instagram' => $grp_sm_instagram,
						'facebook' => $grp_sm_facebook,
						'youtube' => $grp_sm_youtube,
						'vimeo' => $grp_sm_vimeo
					];

					$grp_end_cep = $this->request->getPost('grp_end_cep');
					$grp_end_logradouro = $this->request->getPost('grp_end_logradouro');
					$grp_end_numero = $this->request->getPost('grp_end_numero');
					$grp_end_compl = $this->request->getPost('grp_end_compl');
					$grp_end_bairro = $this->request->getPost('grp_end_bairro');
					$grp_end_cidade = $this->request->getPost('grp_end_cidade');
					$grp_end_estado = $this->request->getPost('grp_end_estado');

					/*
					 * -------------------------------------------------------------
					 * Gravamos as informações do Grupo
					 * -------------------------------------------------------------
					**/
					$grp_hashkey = md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16));

					$data_db_grp = [
						'insti_id' => (int)$insti_id,
						'user_id' => (int)$user_id,
						'grp_hashkey' => $grp_hashkey,
						'grp_urlpage' => url_title( convert_accented_characters($grp_titulo), '-', TRUE ),
						'grp_titulo' => $grp_titulo,
						'grp_responsavel' => $grp_responsavel,
						'grp_telefone' => $grp_telefone,
						'grp_celular' => $grp_celular,
						'grp_cpf' => $grp_cpf,
						'grp_redes_sociais' => json_encode($grp_redes_sociais),
						'grp_end_cep' => $grp_end_cep,
						'grp_end_logradouro' => $grp_end_logradouro,
						'grp_end_numero' => $grp_end_numero,
						'grp_end_compl' => $grp_end_compl,
						'grp_end_bairro' => $grp_end_bairro,
						'grp_end_cidade' => $grp_end_cidade,
						'grp_end_estado' => $grp_end_estado,
						'grp_dte_cadastro' => date("Y-m-d H:i:s"),
						'grp_dte_alteracao' => date("Y-m-d H:i:s"),
						'grp_ativo' => 1,
					];

					$query_grupo = $this->grpMD
						->where('insti_id', (int)$insti_id)
						->where('user_id', (int)$user_id)
						//->where('grp_urlpage', url_title( convert_accented_characters($grp_titulo), '-', TRUE ))
						->limit(1)
						->get();
					if( $query_grupo && $query_grupo->resultID->num_rows >= 1 )
					{
						$rs_grupo = $query_grupo->getRow();
						$grp_id = (int)$rs_grupo->grp_id; 
						$grp_hashkey = $rs_grupo->grp_hashkey; 


						$grp_id = $this->grpMD->insert($data_db_grp);

						/*
						 * -------------------------------------------------------------
						 * Gravamos as informações do Grupo x Eventos
						 * -------------------------------------------------------------
						**/
							$data_db_grevt = [
								'insti_id' => (int)$insti_id,
								'user_id' => (int)$user_id,
								'grp_id' => (int)$grp_id,
								'event_id' => (int)$event_id,
								'grevt_dte_cadastro' => date("Y-m-d H:i:s"),
								'grevt_dte_alteracao' => date("Y-m-d H:i:s"),
								'grevt_ativo' => 1,
							];
							$grevt_id = $this->grevtMD->insert($data_db_grevt);

						$error_num = "0";
						$error_msg = "Grupo cadastrado com sucesso. Novo";
						$error_infos = "";

					}else{
						$grp_id = $this->grpMD->insert($data_db_grp);

						/*
						 * -------------------------------------------------------------
						 * Gravamos as informações do Grupo x Eventos
						 * -------------------------------------------------------------
						**/
							//$data_db_grevt = [
							//	'insti_id' => (int)$insti_id,
							//	'user_id' => (int)$user_id,
							//	'grp_id' => (int)$grp_id,
							//	'event_id' => (int)$event_id,
							//	'grevt_dte_cadastro' => date("Y-m-d H:i:s"),
							//	'grevt_dte_alteracao' => date("Y-m-d H:i:s"),
							//	'grevt_ativo' => 1,
							//];
							//$grevt_id = $this->grevtMD->insert($data_db_grevt);

						$error_num = "0";
						$error_msg = "Grupo cadastrado com sucesso. Existente";
						$error_infos = "";
					}


				}
			}


			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				'grp_id' => (int)$grp_id,
				"grp_hashkey" => $grp_hashkey,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "SALVAR-PARTICIPANTE" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');

			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				/*
				 * -------------------------------------------------------------
				 * verificamos qual o grupo e evento que deve ser relacionado
				 * -------------------------------------------------------------
				**/
					$grp_hashkey = $this->request->getPost('grp_hashkey');
					$event_hashkey = $this->request->getPost('event_hashkey');
					$participantes_json = $this->request->getPost('participantes_json');

					$this->grpMD->from('tbl_grupos As GRP', true)
						->select('GRP.*')
						->select('EVENT.*')
						//->select('GREVT.grevt_id, GREVT.event_id')
						->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
						->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
						->where('GRP.user_id', $user_id)
						->where('GRP.grp_hashkey', $grp_hashkey)
						->where('EVENT.event_hashkey', $event_hashkey)
						->orderBy('GREVT.grevt_id', 'DESC')
						->limit(1);
					$query_grupo_evt = $this->grpMD->get();
					if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
					{
						$rs_grupo_evt = $query_grupo_evt->getRow();
						$insti_id = (int)$rs_grupo_evt->insti_id; 
						$event_id = (int)$rs_grupo_evt->event_id;
						$grp_id = (int)$rs_grupo_evt->grp_id;

						/*
						 * -------------------------------------------------------------
						 * Gravamos as informações dos participantes
						 * -------------------------------------------------------------
						**/
							if( !empty( $participantes_json ) ){
								//print '<pre>';
								//print_r( json_decode($lista_participantes) );
								//print '</pre>';
								$lista_participantes_json = json_decode($participantes_json);
								foreach ($lista_participantes_json as $key => $val) {
									//print '<hr>';
									//print ' | '. $val->partc_documento;
									//print ' | '. $val->partc_nome;
									//print ' | '. $val->partc_nome_social;
									//print ' | '. $val->partc_genero;
									//print ' | '. $val->partc_dte_nascto;
									//print ' | '. $val->partc_idade;
									//print ' | '. $val->partc_categoria;
									//print ' | '. $val->func_id;
									//print ' | '. $val->partc_file_doc_frente;
									//print ' | '. $val->partc_file_doc_verso;
									//print ' | '. $val->partc_file_foto;

									$partc_hashkey = $val->partc_hashkey;
									if( empty($partc_hashkey) ){ $partc_hashkey = md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)); }

									$data_participante_db = [
										'insti_id' => (int)$insti_id,
										'partc_hashkey' => $partc_hashkey,
										'partc_urlpage' => url_title( convert_accented_characters($val->partc_nome), '-', TRUE ),
										'grp_id' => $grp_id,
										'func_id' => (int)$val->func_id,
										'categ_id' => (int)$val->categ_id,
										'partc_nome' => $val->partc_nome,
										'partc_nome_social' => $val->partc_nome_social,
										'partc_genero' => $val->partc_genero,
										'partc_documento' => $val->partc_documento,
										'partc_dte_nascto' => fct_date2bd($val->partc_dte_nascto),
										'partc_dte_cadastro' => date("Y-m-d H:i:s"),
										'partc_dte_alteracao' => date("Y-m-d H:i:s"),
										'partc_ativo' => 1,
									];

									$imgLogotipo = "";
									$fileInputLogotipo = $this->request->getFile('fileInputLogotipo');
									if( $fileInputLogotipo ){
										if ($fileInputLogotipo->isValid() && ! $fileInputLogotipo->hasMoved()){
											$cpf_limpo = url_title( convert_accented_characters($val->partc_documento), '', TRUE );
											$newName = $fileInputLogotipo->getRandomName();
											//$ext = $fileInputLogotipo->guessExtension();
											$imgLogotipo = 'participante_'. $cpf_limpo .'.'. $fileInputLogotipo->guessExtension();
											$fileInputLogotipo->move( WRITEPATH ."/uploads/participantes/", $imgLogotipo);
											$data_participante_db['partc_file_foto'] = $imgLogotipo;
										}
									}

									//$data_participante_db['partc_file_doc_frente'] = $imgLogotipo;
									//$data_participante_db['partc_file_doc_verso'] = $imgLogotipo;

									//if( !empty($file_foto)){
									//	$data_participante_db['partc_file_foto'] = $file_foto;
									//}
									//if( !empty($file_doc_frente)){
									//	$data_participante_db['partc_file_doc_frente'] = $file_doc_frente;
									//}
									//if( !empty($file_doc_verso)){
									//	$data_participante_db['partc_file_doc_verso'] = $file_doc_verso;
									//}

									$query_participante = $this->partcMD
										->where('insti_id', (int)$insti_id)
										->where('grp_id', (int)$grp_id)
										->where('partc_hashkey', $val->partc_hashkey)
										->limit(1)
										->get();
									if( $query_participante && $query_participante->resultID->num_rows == 0 )
									{
										$partc_id = $this->partcMD->insert($data_participante_db);
									}else{
										unset($data_participante_db['partc_hashkey']);
										unset($data_participante_db['partc_dte_cadastro']);
										$this->partcMD.set($data_participante_db);
										$this->partcMD
										->where('insti_id', (int)$insti_id)
										->where('grp_id', (int)$grp_id)
										->where('partc_hashkey', $val->partc_hashkey);
										$this->partcMD->update();
									}
								} // foreach
							} // if participantes_json


						$error_num = "0";
						$error_msg = "Participante Ok";
						$error_infos = "";
					}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "UPDATE-PARTICIPANTE" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			$grp_id = 0;
			$grp_hashkey = '';

			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				// Recuperamos o evento selecionado
				// ---------------------------------------------------------
				$event_hashkey = $this->request->getPost('event_hashkey');
				$partc_hashkey = $this->request->getPost('partc_hashkey');
				$partc_documento = $this->request->getPost('partc_documento');
				$partc_nome = $this->request->getPost('partc_nome');
				$partc_nome_social = $this->request->getPost('partc_nome_social');
				$partc_genero = $this->request->getPost('partc_genero');
				$func_id = (int)$this->request->getPost('func_id');
				$categ_id = (int)$this->request->getPost('categ_id');
				$partc_dte_nascto = $this->request->getPost('partc_dte_nascto');

				$this->eventMD->select('*');
				$this->eventMD->where('event_hashkey', $event_hashkey);
				$this->eventMD->orderBy('event_id', 'DESC');
				$this->eventMD->limit(1);
				$query_event = $this->eventMD->get();
				if( $query_event && $query_event->resultID->num_rows >=1 )
				{
					$rs_event = $query_event->getRow();
					$insti_id = (int)$rs_event->insti_id; 
					$event_id = (int)$rs_event->event_id; 

				/*
				 * -------------------------------------------------------------
				 * Gravamos as informações dos participantes
				 * -------------------------------------------------------------
				**/
					//if( empty($partc_hashkey) ){ $partc_hashkey = md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)); }
					$data_participante_db = [
						'insti_id' => (int)$insti_id,
						'partc_hashkey' => $partc_hashkey,
						'partc_urlpage' => url_title( convert_accented_characters($partc_nome), '-', TRUE ),
						//'grp_id' => $grp_id,
						'func_id' => (int)$func_id,
						'categ_id' => (int)$categ_id,
						'partc_nome' => $partc_nome,
						'partc_nome_social' => $partc_nome_social,
						'partc_genero' => $partc_genero,
						'partc_documento' => $partc_documento,
						'partc_dte_nascto' => fct_date2bd($partc_dte_nascto),
						'partc_dte_alteracao' => date("Y-m-d H:i:s"),
						'partc_ativo' => 1,
					];

					$imgLogotipo = "";
					$fileInputLogotipo = $this->request->getFile('fileInputLogotipo');
					if( $fileInputLogotipo ){
						if ($fileInputLogotipo->isValid() && ! $fileInputLogotipo->hasMoved()){
							$cpf_limpo = url_title( convert_accented_characters($partc_documento), '', TRUE );
							$newName = $fileInputLogotipo->getRandomName();
							//$ext = $fileInputLogotipo->guessExtension();
							$imgLogotipo = 'participante_'. $cpf_limpo .'.'. $fileInputLogotipo->guessExtension();
							$fileInputLogotipo->move( WRITEPATH ."/uploads/participantes/", $imgLogotipo);
							$data_participante_db['partc_file_foto'] = $imgLogotipo;
						}
					}

					$query_participante = $this->partcMD
						->where('insti_id', (int)$insti_id)
						->where('grp_id', (int)$grp_id)
						->where('partc_hashkey', $partc_hashkey)
						->limit(1)
						->get();
					if( $query_participante && $query_participante->resultID->num_rows >= 1 )
					{
						$this->partcMD->set($data_participante_db);
						$this->partcMD
						->where('insti_id', (int)$insti_id)
						->where('grp_id', (int)$grp_id)
						->where('partc_hashkey', $partc_hashkey);
						$this->partcMD->update();
					}

					$error_num = "0";
					$error_msg = "Participante alterado com sucesso.";
					$error_infos = "";
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "EXCLUIR-PARTICIPANTE" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			$grp_id = 0;
			$grp_hashkey = '';

			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();


				$partc_hashkey = $this->request->getPost('partc_hashkey');


				$query_participante = $this->partcMD
					//->where('insti_id', (int)$insti_id)
					//->where('grp_id', (int)$grp_id)
					->where('partc_hashkey', $partc_hashkey)
					->limit(1)
					->get();
				if( $query_participante && $query_participante->resultID->num_rows >= 1 )
				{
					$this->partcMD->where('partc_hashkey', $partc_hashkey)->delete();

					$error_num = "0";
					$error_msg = "Participante removido com sucesso.";
				}else{
					$error_num = "1";
					$error_msg = "Participante inexistente.";
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "LIST-PARTICIPANTE-POR-CATEG" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			$grp_id = (int)$this->request->getPost('grp_id');
			$grp_hashkey = '';

			$func_id = 4;

			$participantes = [];

			// Recuperamos o evento selecionado
			// ---------------------------------------------------------
			$event_hashkey = $this->request->getPost('event_hashkey');
			$categ_id = $this->request->getPost('corgf_categ_id');
			
			$participantes_json = $this->request->getPost('participantes_json');

			$this->eventMD->select('*');
			$this->eventMD->where('event_hashkey', $event_hashkey);
			$this->eventMD->orderBy('event_id', 'DESC');
			$this->eventMD->limit(1);
			$query_event = $this->eventMD->get();
			if( $query_event && $query_event->resultID->num_rows >=1 )
			{
				$rs_event = $query_event->getRow();
				$insti_id = (int)$rs_event->insti_id; 
				//$event_id = (int)$rs_event->event_id;

				$query_participante = $this->partcMD
					->select('partc_id, partc_nome, partc_documento')
					->where('insti_id', (int)$insti_id)
					->where('categ_id', (int)$categ_id)
					->where('func_id', (int)$func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_participante && $query_participante->resultID->num_rows >= 1 )
				{
					$participantes = $query_participante->getResult();

					$error_num = "0";
					$error_msg = "Lista de Participantes";
				}else{
					$error_num = "1";
					$error_msg = "Não existe participantes relacionados a este grupo";
				}
			}else{
				$error_num = "1";
				$error_msg = "Evento não encontrado";
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"participantes" => $participantes,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "LIST-PARTICIPANTE-COREOGRAFOS" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			$coreografos = '';

			// Recuperamos o evento selecionado
			// ---------------------------------------------------------
			$event_hashkey = $this->request->getPost('event_hashkey');
			$grp_id = (int)$this->request->getPost('grp_id');

			$this->eventMD->select('*');
			$this->eventMD->where('event_hashkey', $event_hashkey);
			$this->eventMD->orderBy('event_id', 'DESC');
			$this->eventMD->limit(1);
			$query_event = $this->eventMD->get();
			if( $query_event && $query_event->resultID->num_rows >=1 )
			{
				$rs_event = $query_event->getRow();
				$insti_id = (int)$rs_event->insti_id; 
				$func_id = 3; 

				$query_coreografos = $this->partcMD
					->select('partc_id, partc_nome, partc_documento')
					->where('insti_id', (int)$insti_id)
					->where('func_id', $func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_coreografos && $query_coreografos->resultID->num_rows >= 1 )
				{
					$coreografos = $query_coreografos->getResult();

					$error_num = "0";
					$error_msg = "Lista de Participantes Ok | ". $query_coreografos->resultID->num_rows;
					//$error_msg = $this->partcMD->getLastQuery();
					//print $error_msg;
					//exit();

				}else{
					$error_num = "1";
					$error_msg = "Não existe participantes relacionados a este grupo";
				}
			}else{
				$error_num = "1";
				$error_msg = "Evento não encontrado";
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"coreografos" => $coreografos,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "SALVAR-ELENCO-COREOGRAFIA" :
			$arr_dados = [];
			$retorno = [];

			$user_id = (int)session()->get('inscUser_id');

			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				// Recuperamos o evento selecionado
				// ---------------------------------------------------------
				$event_hashkey = $this->request->getPost('event_hashkey');
				$grp_hashkey = $this->request->getPost('grp_hashkey');
				$grp_id = (int)$this->request->getPost('grp_id');

				$corgf_hashkey = $this->request->getPost('corgf_hashkey');
				$corgf_titulo = $this->request->getPost('corgf_titulo');
				$corgf_coreografo = $this->request->getPost('corgf_coreografo');
				$corgf_musica_file = '';
				$corgf_musica = $this->request->getPost('corgf_musica');
				$corgf_compositor = $this->request->getPost('corgf_compositor');
				$corgf_observacao = $this->request->getPost('corgf_observacao');
				$corgf_modl_id = (int)$this->request->getPost('corgf_modl_id');
				$corgf_formt_id = (int)$this->request->getPost('corgf_formt_id');
				$corgf_categ_id = (int)$this->request->getPost('corgf_categ_id');
				$corgf_evcfg_seletiva = $this->request->getPost('corgf_evcfg_seletiva');
				$coreografia_elenco_json = $this->request->getPost('coreografia_elenco_json');
				$coreografia_elenco_all = $this->request->getPost('coreografia_elenco_all');

				$this->eventMD->select('*');
				$this->eventMD->where('event_hashkey', $event_hashkey);
				$this->eventMD->orderBy('event_id', 'DESC');
				$this->eventMD->limit(1);
				$query_event = $this->eventMD->get();
				if( $query_event && $query_event->resultID->num_rows >= 1 )
				{
					$rs_event = $query_event->getRow();
					$insti_id = (int)$rs_event->insti_id; 
					$event_id = (int)$rs_event->event_id; 
					$corgf_ativo = 1;

					$retorno[] = 'encontrou evento';

					/*
					 * -------------------------------------------------------------
					 * Gravamos as informações da coreografia
					 * -------------------------------------------------------------
					**/
						$data_coreografia_db = [
							'insti_id' => (int)$insti_id,
							'grp_id' => (int)$grp_id,
							'modl_id' => (int)$corgf_modl_id,
							'formt_id' => (int)$corgf_formt_id,
							'categ_id' => (int)$corgf_categ_id,
							'corgf_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
							'corgf_urlpage' => url_title( convert_accented_characters($corgf_titulo), '-', TRUE ),
							'corgf_titulo' => $corgf_titulo,
							'corgf_coreografo' => $corgf_coreografo,
							'corgf_musica_file' => $corgf_musica_file,
							'corgf_musica' => $corgf_musica,
							//'corgf_tempo' => $corgf_tempo,
							'corgf_compositor' => $corgf_compositor,
							'corgf_observacao' => $corgf_observacao,
							'corgf_linkvideo' => $corgf_evcfg_seletiva,
							'corgf_dte_cadastro' => date("Y-m-d H:i:s"),
							'corgf_dte_alteracao' => date("Y-m-d H:i:s"),
							'corgf_ativo' => (int)$corgf_ativo,
						];
						$query_check_corgf = $this->corgfMD
							->where('corgf_hashkey', $corgf_hashkey)
							->where('insti_id', (int)$insti_id)
							->where('grp_id', (int)$grp_id)
							->limit(1)
							->get();
						if( $query_check_corgf && $query_check_corgf->resultID->num_rows == 0 )
						{
							$corgf_id = $this->corgfMD->insert($data_coreografia_db);

							$retorno[] = 'inseriu coreografia';
						}else{
							$rs_corf = $query_check_corgf->getRow();
							$insti_id = (int)$rs_corf->insti_id;
							$corgf_id = (int)$rs_corf->corgf_id;  

							$retorno[] = 'alterou coreografia';

							unset( $data_coreografia_db['corgf_hashkey'] );
							unset( $data_coreografia_db['corgf_dte_alteracao'] );
							$this->corgfMD->set($data_coreografia_db);
							$this->corgfMD->where('corgf_hashkey', $corgf_hashkey);
							$this->corgfMD->update();
						}

					/*
					 * -------------------------------------------------------------
					 * Gravamos as informações dos participantes na tabela de coreografia x participantes
					 * -------------------------------------------------------------
					**/
						if( !empty( $coreografia_elenco_json ) ){

							$retorno[] = 'tem elenco';
							
							// Excluir participantes relacionados
							//$this->crfpaMD
							//	//->where('insti_id', (int)$insti_id)
							//	->where('corgf_id', (int)$corgf_id)
							//	->delete();

							$this->crfpaMD->set('crfpaativo', 0);
							$this->crfpaMD->where('corgf_id', (int)$corgf_id);
							$this->crfpaMD->update();

							$lista_elenco_json = json_decode($coreografia_elenco_json);
							foreach ($lista_elenco_json as $key => $val) {
								$partc_id = (int)$val->partc_id;
								//$partc_hashkey = $val->partc_hashkey;

								$data_elenco_db = [
									'corgf_id' => (int)$corgf_id,
									'partc_id' => (int)$partc_id,
									'crfpadte_cadastro' => date("Y-m-d H:i:s"),
									'crfpadte_alteracao' => date("Y-m-d H:i:s"),
									'crfpaativo' => 1,
								];
								$query_elenco = $this->crfpaMD
									->where('corgf_id', (int)$corgf_id)
									->where('partc_id', (int)$partc_id)
									->limit(1)
									->get();
								if( $query_elenco && $query_elenco->resultID->num_rows == 0 )
								{
									$crfpa_id = $this->crfpaMD->insert($data_elenco_db);

									$retorno[] = 'insere elenco';
								}else{
									$retorno[] = 'altera elenco';

									$this->crfpaMD->set('crfpaativo', 1);
									$this->crfpaMD->where('partc_id', (int)$partc_id);
									$this->crfpaMD->where('corgf_id', (int)$corgf_id);
									$this->crfpaMD->update();
								}

								$this->crfpaMD
									->where('corgf_id', (int)$corgf_id)
									->where('crfpaativo', 0)
									->delete();
							}
						}

					$error_num = "0";
					$error_msg = "Participante Ok";
					$error_infos = "";
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"retorno" => $retorno,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "autocomplete" :

			$arr_dados = [];
			$rs_clientes = [];

			$search = $this->request->getPost('search');

			$query = $this->clieMD
				->select('id, nome')
				->where('del', '0')
				->like('nome', $search)
				->orderBy('nome', 'ASC')
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_clientes = $query->getResult();
			}

			$arr_return = array(
				"clientes" => $rs_clientes,
			);
			echo( json_encode($arr_return) );
			exit();

		break;
		case "DELETAR-REGISTRO" :

			$codigo = (int)$this->request->getPost('codigo');
			$query = $this->clieMD
				->select('*')
				->where('id', $codigo)
				->orderBy('id', 'DESC')
				->limit(1)
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				//$this->clieMD->where('id', $cliente_id);
				//$this->clieMD->delete();

				$data_db = [ 'del' => '1' ];
				$this->clieMD->set($data_db);
				$this->clieMD->where('id', $codigo);
				$this->clieMD->update();

				$error_num = 0;
				$error_msg = "Ação registrada com sucesso!";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			);
			echo( json_encode($arr_return) );
			exit();

		break;
		case "LOAD-EDIT-COREOGRAFIA" :
			$rs_corf = [];
			$rs_elenco_selecionado = [];
			$rs_coreografos = [];

			$user_id = (int)session()->get('inscUser_id');

			if ($this->request->getPost())
			{
				$corgf_hashkey = $this->request->getPost('corgf_hashkey');

				$query_coreografia = $this->corgfMD
					->where('corgf_hashkey', $corgf_hashkey)
					->limit(1)
					->get();
				if( $query_coreografia && $query_coreografia->resultID->num_rows >= 1 )
				{
					$rs_corf = $query_coreografia->getRow();
					$rs_coreografos = explode(',', $rs_corf->corgf_coreografo);

					$this->partcMD->from('tbl_participantes As PARTC', true)
						->select('PARTC.partc_id, PARTC.partc_hashkey, PARTC.partc_documento, PARTC.partc_nome')
						->select('FUNC.func_titulo')
						->join('tbl_coreografias_x_participantes AS CRFPA', 'CRFPA.partc_id = PARTC.partc_id', 'INNER')
						->join('tbl_funcoes AS FUNC', 'FUNC.func_id = PARTC.func_id', 'INNER')
						->where('CRFPA.corgf_id', (int)$rs_corf->corgf_id)
						->orderBy('CRFPA.crfpa_id', 'ASC')
						->limit(200);
					$query_elenco = $this->partcMD->get();
					if( $query_elenco && $query_elenco->resultID->num_rows >= 1 )
					{
						$rs_elenco = $query_elenco->getResult();
						foreach ($rs_elenco as $row) {
							$arr_temp = [
								'partc_id' => $row->partc_id,
								'partc_hashkey' => $row->partc_hashkey,
								'partc_documento' => $row->partc_documento,
								'partc_nome' => $row->partc_nome,
								'func_titulo' => $row->func_titulo
							];
							array_push($rs_elenco_selecionado, $arr_temp);
						}
					}

					$error_num = "0";
					$error_msg = "Coreografia excluída com sucesso.";
				}else{
					$error_num = "1";
					$error_msg = "Coreografia inexistente.";
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"dados" => $rs_corf,
				"elenco_selecionado" => $rs_elenco_selecionado,
				"coreografos" => $rs_coreografos,
				'coreografia_elenco' => [12],
			];
			print json_encode($json_arr);
			exit();

		break;
		case "EXCLUIR-COREOGRAFIA" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			$grp_id = 0;
			$grp_hashkey = '';

			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				$corgf_hashkey = $this->request->getPost('corgf_hashkey');

				$query_coreografia = $this->corgfMD
					->where('corgf_hashkey', $corgf_hashkey)
					->limit(1)
					->get();
				if( $query_coreografia && $query_coreografia->resultID->num_rows >= 1 )
				{
					$rs_corf = $query_coreografia->getRow();
					$insti_id = (int)$rs_corf->insti_id;
					$corgf_id = (int)$rs_corf->corgf_id;  

					// Excluir participantes relacionados
					$this->crfpaMD
						//->where('insti_id', (int)$insti_id)
						->where('corgf_id', (int)$corgf_id)
						->delete();

					// Excluir coreografia em definitivo
					$this->corgfMD
						->where('corgf_hashkey', $corgf_hashkey)
						->where('insti_id', (int)$insti_id)
						->where('corgf_id', (int)$corgf_id)
						->delete();

					$error_num = "0";
					$error_msg = "Coreografia excluída com sucesso.";
				}else{
					$error_num = "1";
					$error_msg = "Coreografia inexistente.";
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			];
			print json_encode($json_arr);
			exit();

		break;
		case "SALVAR-AVALIACOES" :
			// Usar valores padrão para teste caso sessão não esteja configurada
			$jurd_id = (int)session()->get('jurd_id') ?: 1;
			$insti_id = (int)session()->get('insti_id') ?: 1;
			
			// Log de debug
			log_message('debug', 'SALVAR-AVALIACOES - jurd_id: ' . $jurd_id . ', insti_id: ' . $insti_id);
			
			if ($this->request->getPost()) {
				$corgf_hashkey = $this->request->getPost('corgf_hashkey');
				$avaliacoes_data = $this->request->getPost('avaliacoes');
				
				log_message('debug', 'SALVAR-AVALIACOES - corgf_hashkey: ' . $corgf_hashkey);
				log_message('debug', 'SALVAR-AVALIACOES - avaliacoes_data: ' . print_r($avaliacoes_data, true));
				
				// Buscar coreografia
				$coreografia = $this->corgfMD->where('corgf_hashkey', $corgf_hashkey)->first();
				
				if ($coreografia && !empty($avaliacoes_data)) {
					$dados_avaliacoes = [];
					
					foreach ($avaliacoes_data as $crit_id => $nota) {
						// Validação rigorosa: apenas números de 0 a 10
						if (is_numeric($nota) && $nota >= 0 && $nota <= 10) {
							$dados_avaliacoes[] = [
								'insti_id' => $insti_id,
								'jurd_id' => $jurd_id,
								'corgf_id' => $coreografia->corgf_id,
								'crit_id' => (int)$crit_id,
								'aval_nota' => (float)$nota
							];
						}
					}
					
					log_message('debug', 'SALVAR-AVALIACOES - dados_avaliacoes: ' . print_r($dados_avaliacoes, true));
					
					if ($this->avalMD->salvar_avaliacoes($dados_avaliacoes)) {
						$error_num = "0";
						$error_msg = "Avaliações salvas com sucesso";
					} else {
						$error_msg = "Erro ao salvar avaliações";
					}
				} else {
					$error_msg = "Coreografia não encontrada ou dados inválidos";
				}
			} else {
				$error_msg = "Nenhum dado foi enviado";
			}
			
			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			];
			print json_encode($json_arr);
			exit();
		break;
		case "FINALIZAR-COREOGRAFIA" :
			$jurd_id = (int)session()->get('jurd_id') ?: 1;
			$insti_id = (int)session()->get('insti_id') ?: 1;
			
			if ($this->request->getPost()) {
				$corgf_hashkey = $this->request->getPost('corgf_hashkey');
				
				// Buscar coreografia
				$coreografia = $this->corgfMD->where('corgf_hashkey', $corgf_hashkey)->first();
				
				if ($coreografia) {
					$grp_id = $coreografia->grp_id;
					$insti_id = (int)session()->get('insti_id') ?: 1;
					
					// Verificar se TODAS as coreografias do grupo têm notas para TODOS os critérios
					if ($this->avalMD->verificar_grupo_completo($jurd_id, $grp_id, $insti_id)) {
						// Finalizar TODAS as coreografias do grupo para este jurado
						if ($this->avalMD->finalizar_grupo($jurd_id, $grp_id)) {
							$error_num = "0";
							$error_msg = "Grupo finalizado com sucesso! Redirecionando...";
							
							// SEMPRE redirecionar para /jurados (sem hash) para buscar próximo grupo automaticamente
							$redirect_url = site_url('jurados');
						} else {
							$error_msg = "Erro ao finalizar grupo";
						}
					} else {
						$error_msg = "Você precisa avaliar TODAS as coreografias do grupo antes de concluir!";
					}
				} else {
					$error_msg = "Coreografia não encontrada";
				}
			} else {
				$error_msg = "Dados não fornecidos ou usuário não autenticado";
			}
			
			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"redirect_url" => isset($redirect_url) ? $redirect_url : ""
			];
			print json_encode($json_arr);
			exit();
		break;
		case "GET-COREOGRAFIAS-GRUPO" :
			$jurd_id = (int)session()->get('jurd_id');
			
			if ($this->request->getPost() && $jurd_id) {
				$grp_id = (int)$this->request->getPost('grp_id');
				
				// Buscar coreografias do grupo
				$coreografias = $this->corgfMD->where('grp_id', $grp_id)
											  ->where('corgf_ativo', 1)
											  ->orderBy('corgf_id', 'ASC')
											  ->findAll();
				
				$error_num = "0";
				$error_msg = "Coreografias carregadas";
			} else {
				$error_msg = "Dados não fornecidos";
				$coreografias = [];
			}
			
			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"coreografias" => $coreografias
			];
			print json_encode($json_arr);
			exit();
		break;
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







}
