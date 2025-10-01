<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Workshops extends PainelController
{
	protected $eventMD = null;
	protected $cursoMD = null;
	protected $crsDteMD = null;
	protected $curVlrMD = null;
	protected $crsitMD = null;

    public function __construct()
    {
		$this->eventMD = new \App\Models\EventosModel();
        $this->cursoMD = new \App\Models\CursosModel();
		$this->crsDteMD = new \App\Models\CursosDatasModel();
		$this->curVlrMD = new \App\Models\CursosValoresModel();
		$this->crsitMD = new \App\Models\CursistasModel();

		$this->data['menu_active'] = 'cursos';
    }


	public function index()
	{
		$filtro_pdf = '';
		// filtrar/user:marcio/cliente:123/dini:/dteend:/status:pago

		$uri = service('uri'); // Obter a instância do objeto URI
		$segments = $uri->getSegments();
		$index = array_search('filtrar', $segments); // Encontrar o índice do segmento "filtrar"

		$filteredSegments = array_slice($segments, $index + 1); // Retornar os elementos a partir de $index + 1 até o final

		$this->cursoMD
			->where('insti_id', (int)$this->session_user_id)
			->orderBy('curso_id', 'DESC')
			->limit(1000);
		$query = $this->cursoMD->get();
		$this->data['lastQuery'] = $this->cursoMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/workshops', $this->data);
	}


	public function listar()
	{
		$filtro_pdf = '';
		// filtrar/user:marcio/cliente:123/dini:/dteend:/status:pago

		$uri = service('uri'); // Obter a instância do objeto URI
		$segments = $uri->getSegments();
		$index = array_search('filtrar', $segments); // Encontrar o índice do segmento "filtrar"

		$filteredSegments = array_slice($segments, $index + 1); // Retornar os elementos a partir de $index + 1 até o final

		$this->cursoMD
			->where('insti_id', (int)$this->session_user_id)
			->orderBy('curso_id', 'DESC')
			->limit(1000);
		$query = $this->cursoMD->get();
		$this->data['lastQuery'] = $this->cursoMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/workshops-list', $this->data);
	}


	public function form( $curso_id = 0, $crsit_id = 0  )
	{
		$this->data['listFormaCobranca'] = $this->cfgAPP->getFormaCobranca();
		$this->data['listFormaCobrancaTipo'] = $this->cfgAPP->getFormaCobrancaTipo();
		$this->data['listTipoCobranca'] = $this->cfgAPP->getTipoCobranca();
		$listTipoCobrancaDoacoes = $this->cfgAPP->getTipoCobrancaDoacoes();
		$this->data['listTipoCobrancaDoacoes'] = $listTipoCobrancaDoacoes;		
		$listDoacaoTipoEntrega = $this->cfgAPP->getDoacaoTipoEntrega();
		$this->data['listDoacaoTipoEntrega'] = $listDoacaoTipoEntrega;	


		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"curso_titulo" => [
					"label" => "Título", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$event_id = (int)$this->request->getPost('event_id');
				$curso_titulo = $this->request->getPost('curso_titulo');
				$curso_nome_professor = $this->request->getPost('curso_nome_professor');
				$curso_local = $this->request->getPost('curso_local');
				$curso_dte_inicio = $this->request->getPost('curso_dte_inicio');
				$curso_hrs_inicio = $this->request->getPost('curso_hrs_inicio');
				$curso_dte_termino = $this->request->getPost('curso_dte_termino');
				$curso_hrs_termino = $this->request->getPost('curso_hrs_termino');
				$curso_vagas = (int)$this->request->getPost('curso_vagas');
				$curso_valor = $this->request->getPost('curso_valor');
				$curso_conteudo = $this->request->getPost('curso_conteudo');
				$curso_dte_limite_insc = $this->request->getPost('curso_dte_limite_insc');

				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'event_id' => (int)$event_id,
					'curso_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'curso_urlpage' => url_title( convert_accented_characters($curso_titulo), '-', TRUE ),
					'curso_titulo' => $curso_titulo,
					'curso_nome_professor' => $curso_nome_professor,
					'curso_local' => $curso_local,
					'curso_dte_inicio' => fct_date2bd($curso_dte_inicio),
					'curso_hrs_inicio' => $curso_hrs_inicio,
					'curso_dte_termino' => fct_date2bd($curso_dte_termino),
					'curso_hrs_termino' => $curso_hrs_termino,
					'curso_vagas' => $curso_vagas,
					'curso_valor' => fct_to_money($curso_valor, 2, 'bd'),
					'curso_conteudo' => $curso_conteudo,
					'curso_dte_limite_insc' => fct_date2bd($curso_dte_limite_insc),
					'curso_dte_cadastro' => date("Y-m-d H:i:s"),
					'curso_dte_alteracao' => date("Y-m-d H:i:s"),
					'curso_ativo' => 1,
				];

				$fileFotoProfessor = $this->request->getFile('curso_foto_professor');
				$fileTemplateCertif = $this->request->getFile('curso_template_certificado');
				$fileFotoAssinat = $this->request->getFile('curso_foto_assinatura');
				if( $fileFotoProfessor ){
					if ($fileFotoProfessor->isValid() && ! $fileFotoProfessor->hasMoved()){
						$originalName = $fileFotoProfessor->getClientName();

						$arq_original = $originalName; 
						$extension = $fileFotoProfessor->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$curso_foto_professor = $originalName .'__curso__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileFotoProfessor->getRandomName();
						$fileFotoProfessor->move( $this->folder_upload .'/workshops/', $curso_foto_professor);
						$data_db['curso_foto_professor'] = $curso_foto_professor;
					}
				}
				if( $fileTemplateCertif ){
					if ($fileTemplateCertif->isValid() && ! $fileTemplateCertif->hasMoved()){
						$originalName = $fileTemplateCertif->getClientName();

						$arq_original = $originalName; 
						$extension = $fileTemplateCertif->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$curso_template_certificado = $originalName .'__certificado__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileTemplateCertif->getRandomName();
						$fileTemplateCertif->move( $this->folder_upload .'/workshops/', $curso_template_certificado);
						$data_db['curso_template_certificado'] = $curso_template_certificado;
					}
				}
				if( $fileFotoAssinat ){
					if ($fileFotoAssinat->isValid() && ! $fileFotoAssinat->hasMoved()){
						$originalName = $fileFotoAssinat->getClientName();

						$arq_original = $originalName; 
						$extension = $fileFotoAssinat->getClientExtension();
						$extension = empty($extension) ? '' : '.' . $extension;
						$originalName = str_replace($extension, "", $originalName);
						
						$originalName = url_title( convert_accented_characters($originalName), '-', TRUE );
						$curso_foto_assinatura = $originalName .'__assinatura__'. time() .'_'. random_string('alnum', 4) . $extension;
						
						//$newFileUpload = $originalName .'___'. $fileFotoAssinat->getRandomName();
						$fileFotoAssinat->move( $this->folder_upload .'/workshops/', $curso_foto_assinatura);
						$data_db['curso_foto_assinatura'] = $curso_foto_assinatura;
					}
				}

				$queryEdit = $this->cursoMD->where('curso_id', $curso_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['curso_hashkey'] );
					unset( $data_db['curso_dte_cadastro'] );
					$qryExecute = $this->cursoMD->update($curso_id, $data_db);
				}else{
					$curso_id = $this->cursoMD->insert($data_db);
				}
				
				/*
				 * -------------------------------------------------------------
				 * Datas dos Workshops
				 * -------------------------------------------------------------
				**/
					$arr_crsdte_data = $this->request->getPost('crsdte_data');
					$arr_crsdte_hrs_ini = $this->request->getPost('crsdte_hrs_ini');
					$arr_crsdte_hrs_end = $this->request->getPost('crsdte_hrs_end');
					$arr_crsdte_id = $this->request->getPost('crsdte_id');
						
					if( is_array($arr_crsdte_data)){
						foreach ($arr_crsdte_data as $key => $val) {
							if( !empty($val) ){
								$crsdte_data = $val;
								$crsdte_hrs_ini = $arr_crsdte_hrs_ini[$key];
								$crsdte_hrs_end = $arr_crsdte_hrs_end[$key];
								$crsdte_id = (int)$arr_crsdte_id[$key];

								$data_db_curso_data = [
									'curso_id' => (int)$curso_id,
									//'insti_id' => (int)$this->session_user_id,
									'crsdte_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
									'crsdte_data' => fct_date2bd($crsdte_data),
									'crsdte_hrs_ini' => $crsdte_hrs_ini,
									'crsdte_hrs_end' => $crsdte_hrs_end,
									'crsdte_dte_cadastro' => date("Y-m-d H:i:s"),
									'crsdte_dte_alteracao' => date("Y-m-d H:i:s"),
									'crsdte_ativo' => 1,
								];					
								
								$query_cursos_datas = $this->crsDteMD
									->where('crsdte_id', $crsdte_id)
									->get();
								if( $query_cursos_datas && $query_cursos_datas->resultID->num_rows >=1 )
								{
									unset( $data_db_curso_data['crsdte_hashkey'] );
									unset( $data_db_curso_data['crsdte_dte_cadastro'] );
									$this->crsDteMD->set($data_db_curso_data);
									$this->crsDteMD->where('curso_id', (int)$curso_id);
									$this->crsDteMD->where('crsdte_id', (int)$crsdte_id);
									$this->crsDteMD->update();
								}else{
									$crsdte_id = $this->crsDteMD->insert($data_db_curso_data);
								}
							}
						}
					}

				/*
				 * -------------------------------------------------------------
				 * Gravando Cursistas
				 * -------------------------------------------------------------
				**/
					$crsit_id = (int)$this->request->getPost('crsit_id');
					$crsit_nome = $this->request->getPost('crsit_nome');
					$crsit_email = $this->request->getPost('crsit_email');
					$crsit_cpf = $this->request->getPost('crsit_cpf');
					$crsit_genero = $this->request->getPost('crsit_genero');
					$crsit_dte_nascto = $this->request->getPost('crsit_dte_nascto');
					$crsit_nacionalidade = $this->request->getPost('crsit_nacionalidade');
					$crsit_estado = $this->request->getPost('crsit_estado');
					$crsit_cidade = $this->request->getPost('crsit_cidade');
					$crsit_estilo_danca = $this->request->getPost('crsit_estilo_danca');
					$crsit_anos_exper = $this->request->getPost('crsit_anos_exper');
					$crsit_nivel = $this->request->getPost('crsit_nivel');

					$data_db_cursista = [
						'insti_id' => (int)$this->session_user_id,
						'crsit_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
						'crsit_urlpage' => url_title( convert_accented_characters($crsit_nome), '-', TRUE ),
						'crsit_nome' => $crsit_nome,
						'crsit_email' => $crsit_email,
						'crsit_cpf' => $crsit_cpf,
						'crsit_genero' => $crsit_genero,
						'crsit_dte_nascto' => fct_date2bd($crsit_dte_nascto),
						'crsit_nacionalidade' => $crsit_nacionalidade,
						'crsit_estado' => $crsit_estado,
						'crsit_cidade' => $crsit_cidade,
						'crsit_estilo_danca' => $crsit_estilo_danca,
						'crsit_anos_exper' => $crsit_anos_exper,
						'crsit_nivel' => $crsit_nivel,
						'crsit_dte_cadastro' => date("Y-m-d H:i:s"),
						'crsit_dte_alteracao' => date("Y-m-d H:i:s"),
						'crsit_ativo' => 1,
					];
					$queryCursistas = $this->crsitMD->where('crsit_id', $crsit_id)->get();
					if( $queryCursistas && $queryCursistas->resultID->num_rows >=1 )
					{
						unset( $data_db_cursista['crsit_hashkey'] );
						unset( $data_db_cursista['crsit_dte_cadastro'] );
						$this->crsitMD->set($data_db_cursista);
						$this->crsitMD->where('crsit_id', $crsit_id);
						$this->crsitMD->update();
					}else{
						if( !empty($crsit_cpf) && !empty($crsit_nome) ){
							$crsit_id = $this->crsitMD->insert($data_db_cursista);
						}
					}

				/*
				 * -------------------------------------------------------------
				 * Valores dos Workshops
				 * -------------------------------------------------------------
				**/


				return $this->response->redirect( painel_url('workshops/form/'. $curso_id) );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->cursoMD->where('curso_id', $curso_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
			

			$this->crsDteMD
				->where('curso_id', (int)$rs_dados->curso_id)
				->orderBy('crsdte_id', 'ASC')
				->limit(50);
			$query_workshops_datas = $this->crsDteMD->get();
			if( $query_workshops_datas && $query_workshops_datas->resultID->num_rows >= 1 )
			{
				//$rs_workshops_datas = $query_workshops_datas->getRow();
				$this->data['rs_workshops_datas'] = $query_workshops_datas;
			}
			
			
			$this->crsitMD
				//->where('insti_id', (int)$this->session_user_id)
				->where('crsit_id', (int)$crsit_id)
				//->orderBy('curso_id', 'DESC')
				->limit(1);
			$query_cusista = $this->crsitMD->get();
			if( $query_cusista && $query_cusista->resultID->num_rows >= 1 )
			{
				$rs_cursista = $query_cusista->getRow();
				$this->data['rs_cursista'] = $rs_cursista;
				$this->data['aba_ativa'] = 'inscricoes';
			}


			$this->crsitMD
				//->where('insti_id', (int)$this->session_user_id)
				//->where('crsit_id', (int)$crsit_id)
				//->orderBy('curso_id', 'DESC')
				->limit(1000);
			$query_cusistas = $this->crsitMD->get();
			if( $query_cusistas && $query_cusistas->resultID->num_rows >= 1 )
			{
				$this->data['rs_cursistas'] = $query_cusistas;
			}
			
			
			/*
			 * -------------------------------------------------------------
			 * Eventos Relacionados a Instituicao
			 * -------------------------------------------------------------
			**/
				$this->eventMD
					->where('insti_id', (int)$this->session_user_id)
					->orderBy('event_titulo', 'ASC')
					->limit(1000);
				$query_eventos = $this->eventMD->get();
				//print $this->eventMD->getLastQuery();
				//exit();
				if( $query_eventos && $query_eventos->resultID->num_rows >= 1 )
				{
					$this->data['rs_eventos'] = $query_eventos;
				}
		}
		
		
		//$query_cursista = $this->crsitMD->get();
		//if( $query_cursista && $query_cursista->resultID->num_rows >=1 )
		//{
		//	$rs_cursista = $query_cursista->getRow();
		//	$this->data['rs_cursista'] = $rs_cursista;
		//}		
		

		return view($this->directory .'/workshops-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$curso_hashkey = $this->request->getPost('curso_hashkey');
			$query = $this->cursoMD->where('curso_hashkey', $curso_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$curso_id = (int)$rs_registro->curso_id;			

				// excluir registro
				$this->cursoMD->where('curso_hashkey', $curso_hashkey)->delete();

				//$this->cursoMD->set('solt_excluido', 1);
				//$this->cursoMD->where('curso_hashkey', $curso_hashkey);
				//$this->cursoMD->where('curso_id', $curso_id);
				//$this->cursoMD->update();

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
