<?php
namespace App\Controllers;
use App\Controllers\BaseController;

use App\Libraries\GenericLib;

use \DateTime;
use \DateInterval;

class Inscricoes extends BaseController
{
	
	protected $cadMD = null;
	protected $eventMD = null;
	protected $evcfgMD = null;
	protected $evvlrMD = null;
	protected $evcobMD = null;
	protected $grpMD = null;
	protected $grevtMD = null;
	protected $funcMD = null;
	protected $partcMD = null;
	protected $corgfMD = null;
	protected $crfpaMD = null;
	protected $userMD = null;
	protected $modlMD = null;
	protected $formtMD = null;
	protected $categMD = null;
	protected $pedMD = null;
	protected $autzMD = null;
	protected $evtautMD = null;
	protected $cfg = null;

	protected $libGeneric = null;

    public function __construct()
    {
		$this->cadMD = new \App\Models\CadastrosModel();

        $this->eventMD = new \App\Models\EventosModel();
		$this->evcfgMD = new \App\Models\EventosConfigModel();

		$this->evvlrMD = new \App\Models\EventosValoresModel();
		$this->evcobMD = new \App\Models\EventosCobrancaModel();

		$this->grpMD = new \App\Models\GruposModel();
		$this->grevtMD = new \App\Models\GruposEventosModel();
		$this->funcMD = new \App\Models\FuncoesModel();
		$this->partcMD = new \App\Models\ParticipantesModel();

		$this->pedMD = new \App\Models\PedidosModel();

        $this->corgfMD = new \App\Models\CoreografiasModel();
		$this->crfpaMD = new \App\Models\CoreografiasParticipantesModel();

		$this->userMD = new \App\Models\UsuariosModel();

		$this->modlMD = new \App\Models\ModalidadesModel();
		$this->formtMD = new \App\Models\FormatosModel();
		$this->categMD = new \App\Models\CategoriasModel();

		$this->autzMD = new \App\Models\AutorizacoesModel();
		$this->evtautMD = new \App\Models\EventosAutorizacoesModel();

		$this->cfg = new \Config\AppSettings();
		$this->data['cfg'] = $this->cfg;

		$this->data['menu_active'] = 'eventos';

		helper('form');
		helper('text');

		$this->libGeneric = new GenericLib();
    }

	public function inicial( $event_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/login/'. $event_hashkey) );	
		}else{
			return $this->response->redirect( site_url('inscricoes/grupos/'. $event_hashkey) );		
		}
		exit();
	}

	public function grupos( $event_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/login/'. $event_hashkey) );	
		}else{
			$user_id = (int)session()->get('inscUser_id');
		}
		if( empty($event_hashkey) ){
			return $this->response->redirect( site_url() );	
		}



		/*
		 * -------------------------------------------------------------
		 * Informações do evento selecionado
		 * -------------------------------------------------------------
		**/
			$this->eventMD->from('tbl_eventos As EVENT', true)
				->select('INSTI.insti_urlpage')
				->select('EVENT.*')
				->join('tbl_instituicoes AS INSTI', 'INSTI.insti_id = EVENT.insti_id', 'INNER')
				->where('EVENT.event_hashkey', $event_hashkey)
				->orderBy('EVENT.event_id', 'DESC')
				->limit(1);
			$query_event = $this->eventMD->get();
			if( $query_event && $query_event->resultID->num_rows >=1 )
			{
				$rs_event = $query_event->getRow();
				$this->data['rs_event'] = $rs_event;

				$insti_id = (int)$rs_event->insti_id;
				$event_id = (int)$rs_event->event_id;
				$insti_urlpage = $rs_event->insti_urlpage;
				$event_urlpage = $rs_event->event_urlpage;

				$args_folder = [ 
					'area' => 'eventos', 
					'folder' => $insti_urlpage ."/eventos/". $event_urlpage  
				];
				$path_folder_evento = $this->libGeneric->check_folder($args_folder);
			}else{

				// evento inexistente
				return $this->response->redirect( site_url() );	
				
			}


		print '<br><br><br><br><br>' ;
		print '<h2>event_hashkey: '. $event_hashkey .'</h2>' ;
		print '<h2>event_id: '. $event_id .'</h2>' ;
		//exit();


		/*
		 * -------------------------------------------------------------
		 * Gravando a informações por meio de POST tradicional
		 * -------------------------------------------------------------
		**/
			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();


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
					$grp_urlpage = url_title( convert_accented_characters($grp_titulo), '-', TRUE );
					$data_db = [
						'insti_id' => (int)$insti_id,
						'user_id' => (int)$user_id,
						'grp_hashkey' => $grp_hashkey,
						'grp_urlpage' => $grp_urlpage,
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

				/*
				 * -------------------------------------------------------------
				 * mudança do diretório
				 * -------------------------------------------------------------
				**/
					/*
					if( !empty($insti_urlpage_old) && $insti_urlpage_old != $insti_urlpage ){
						$path_folder_old = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage_old;
						$path_folder_new = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage;
						if (is_dir($path_folder_old)) {
							if (rename($path_folder_old, $path_folder_new)) {
								//echo "O diretório foi renomeado com sucesso!";
							}
						}
					}
					*/

				/*
				 * -------------------------------------------------------------
				 * verificar diretório para guardar a documentacao
				 * -------------------------------------------------------------
				**/
					$args_folder_grupo = [ 
						'area' => 'grupos', 
						'folder' => $path_folder_evento ."/grupos/". $grp_urlpage  
					];
					$path_folder_grupo = $this->libGeneric->check_folder($args_folder_grupo);

					$args_file = [ 'file_name' => 'fileInputLogotipo', 'prefixo' => 'logomarca', 'folder' => $path_folder_grupo ];
					$fileInputLogotipo = $this->libGeneric->upload_file_unico( $args_file );
					if( !empty($fileInputLogotipo) ){ $data_db['grp_logotipo'] = $fileInputLogotipo; } 


					$grp_id = $this->grpMD->insert($data_db);

				/*
				 * -------------------------------------------------------------
				 * Relaciona grupo com evento
				 * -------------------------------------------------------------
				**/
					$data_event_db = [
						'insti_id' => (int)$insti_id,
						'user_id' => (int)$user_id,
						'grp_id' => (int)$grp_id,
						'event_id' => (int)$event_id,
						'grevt_dte_cadastro' => date("Y-m-d H:i:s"),
						'grevt_dte_alteracao' => date("Y-m-d H:i:s"),
						'grevt_ativo' => 1,
					];
					$grevt_id = $this->grevtMD->insert($data_event_db);


					return $this->response->redirect( site_url('inscricoes/participantes/'. $grp_hashkey) );	
			}




		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
			//$builder = $this->db->table('tbl_grupos AS GRP');
			//$builder->select('GRP.*, EVENT.event_id, CASE WHEN GREVT.event_id = 7 THEN "Inscrito" ELSE "Não Inscrito" END AS Inscrito');
			//$builder->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'left');
			//$builder->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'left');
			//$builder->where('GRP.user_id', $userId);
			//$builder->orderBy('GRP.grp_id', 'asc');

			/*
				SELECT
					GRP.grp_id,
					GRP.grp_titulo,
					CASE WHEN EXISTS (
						SELECT 1 FROM tbl_grupos_x_eventos WHERE grp_id = GRP.grp_id AND event_id = 7
					) THEN 'Inscrito' ELSE 'Não Inscrito' END AS Inscrito
				FROM
					`tbl_grupos` AS GRP
				WHERE
					GRP.user_id = 25
				ORDER BY
					GRP.grp_id ASC;			
			*/

			/*
			$this->grpMD->from('tbl_grupos As GRP', true)
				->select('GRP.*')
				->select('GREVT.grevt_id')
				->select('EVENT.event_titulo')
				->select('CASE WHEN GREVT.event_id = '. $event_id .' THEN "inscrito" ELSE "nao-inscrito" END AS grpinscrito', false)
				->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
				->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
				->where('GRP.user_id', $user_id)
				//->where('GREVT.event_id', $event_id)
				->orderBy('GREVT.grevt_id', 'ASC')
				->limit(100);
			$query_grupos_evt = $this->grpMD->get();
			print $this->grpMD->getLastQuery();
			*/

			$this->grpMD
				->from('tbl_grupos As GRP', true)
				->select('GRP.*')
				->select('CASE WHEN EXISTS (
						SELECT 1 FROM tbl_grupos_x_eventos WHERE grp_id = GRP.grp_id AND event_id = '. (int)$event_id .'
					) THEN "inscrito" ELSE "nao-inscrito" END AS grpinscrito', false)
				->where('user_id', $user_id)
				->limit(100);
			$query_grupos = $this->grpMD->get();
			//print $this->grpMD->getLastQuery();
			if( $query_grupos && $query_grupos->resultID->num_rows >= 1 )
			{
				//$rs_grupos_evt = $query_grupos_evt->getRow();
				$this->data['rs_grupos'] = $query_grupos;

			
				$this->grevtMD
					->where('user_id', $user_id)
					->where('event_id', $event_id)
					->limit(100);
				$query_grupos_eventos = $this->grevtMD->get();
				print $this->grevtMD->getLastQuery();
				$arr_dados_grevt = [];
				if( $query_grupos_eventos && $query_grupos_eventos->resultID->num_rows >= 1 )
				{
					foreach ($query_grupos_eventos->getResult() as $rowGREVT) {
						$arr_dados_grevt[$rowGREVT->grp_id] = $rowGREVT->grevt_hashkey;
					}
				}
				$this->data['arr_dados_grevt'] = $arr_dados_grevt;
			}



		return view('inscricoes/grupos', $this->data);
	}

	public function grupos_OLD( $event_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/login/'. $event_hashkey) );	
		}
		$user_id = (int)session()->get('inscUser_id');


		/*
		 * -------------------------------------------------------------
		 * Gravando a informações por meio de POST tradicional
		 * -------------------------------------------------------------
		**/
			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

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
				 * Recuperamos as informações do Evento
				 * -------------------------------------------------------------
				**/
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
					 * Gravamos as informações do Grupo
					 * -------------------------------------------------------------
					**/
					$grp_hashkey = md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16));
					$data_db = [
						'insti_id' => (int)$insti_id,
						'user_id' => (int)$user_id,
						'grp_hashkey' => $grp_hashkey,
						'grp_urlpage' => url_title( convert_accented_characters($grp_titulo .'TESTE-CADASTRO'), '-', TRUE ),
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
					$grp_id = $this->grpMD->insert($data_db);

					$data_event_db = [
						'insti_id' => (int)$insti_id,
						'user_id' => (int)$user_id,
						'grp_id' => (int)$grp_id,
						'event_id' => (int)$event_id,
						'grevt_dte_cadastro' => date("Y-m-d H:i:s"),
						'grevt_dte_alteracao' => date("Y-m-d H:i:s"),
						'grevt_ativo' => 1,
					];
					$grevt_id = $this->grevtMD->insert($data_event_db);

					return $this->response->redirect( site_url('inscricoes/participantes/'. $grp_hashkey) );	

					//$query_grupo = $this->grpMD
					//	->where('insti_id', (int)$insti_id)
					//	->where('user_id', (int)$user_id)
					//	->where('grp_urlpage', url_title( convert_accented_characters($grp_titulo .'TESTECADASTRO'), '-', TRUE ))
					//	->limit(1)
					//	->get();
					//if( $query_grupo && $query_grupo->resultID->num_rows == 0 )
					//{
					//	$grp_id = $this->grpMD->insert($data_db);


					//}
					//exit();
				}
			}





		/*
		 * -------------------------------------------------------------
		 * Informações do evento selecionado
		 * -------------------------------------------------------------
		**/
			$this->eventMD->select('*');
			//$this->eventMD->where('event_hashkey', $event_hashkey);
			$this->eventMD->orderBy('event_id', 'DESC');
			$this->eventMD->limit(1);
			$query_event = $this->eventMD->get();
			//$query_grupos = $this->grpMD->select_all_by_insti_id();
			if( $query_event && $query_event->resultID->num_rows >=1 )
			{
				$rs_event = $query_event->getRow();
				$this->data['rs_event'] = $rs_event;

				$insti_id = (int)$rs_event->insti_id;
				$event_id = (int)$rs_event->event_id;

				/*
				 * -------------------------------------------------------------
				 * Informações referente ao grupo e evento
				 * -------------------------------------------------------------
				**/
					$this->grpMD->from('tbl_grupos As GRP', true)
						->select('GRP.*')
						->select('GREVT.grevt_id')
						->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
						->where('GRP.user_id', $user_id)
						->where('GREVT.event_id', $event_id)
						->orderBy('GREVT.grevt_id', 'ASC')
						->limit(100);
					$query_grupos_evt = $this->grpMD->get();
					if( $query_grupos_evt && $query_grupos_evt->resultID->num_rows >= 1 )
					{
						//$rs_grupos_evt = $query_grupos_evt->getRow();
						$this->data['rs_grupos'] = $query_grupos_evt;
					}else{

						/*
						 * -------------------------------------------------------------
						 * Recuperar informações do último grupo criado
						 * -------------------------------------------------------------
						**/
							$this->grpMD->select('*');
							//$this->grpMD->where('insti_id', (int)$rs_event->insti_id);
							$this->grpMD->where('user_id', $user_id);
							$this->grpMD->orderBy('grp_id', 'ASC');
							$this->grpMD->limit(100);
							$query_grupos = $this->grpMD->get();
							//$query_grupos = $this->grpMD->select_all_by_insti_id();
							if( $query_grupos && $query_grupos->resultID->num_rows >=1 )
							{
								//$rs_grupos = $query_grupos->getRow();
								$this->data['rs_grupos'] = $query_grupos;
							}
					}
			}





		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
			$this->grpMD->from('tbl_grupos As GRP', true)
				->select('GRP.*')
				->select('GREVT.grevt_id')
				->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
				->where('GRP.user_id', $user_id)
				//->where('GREVT.event_id', $event_id)
				->orderBy('GREVT.grevt_id', 'ASC')
				->limit(100);
			$query_grupos_evt = $this->grpMD->get();
			if( $query_grupos_evt && $query_grupos_evt->resultID->num_rows >= 1 )
			{
				//$rs_grupos_evt = $query_grupos_evt->getRow();
				$this->data['rs_grupos'] = $query_grupos_evt;
			}



		return view('inscricoes/grupos', $this->data);
	}

	public function participantes( $grevt_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/error') );
		}
		$user_id = (int)session()->get('inscUser_id');


		/*
		 * -------------------------------------------------------------
		 * Gravando a informações por meio de POST tradicional
		 * -------------------------------------------------------------
		**/
			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

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

				//$partc_documento = $this->request->getPost('partc_documento');
				//$partc_nome = $this->request->getPost('partc_nome');
				//$partc_nome_social = $this->request->getPost('partc_nome_social');
				//$partc_genero = $this->request->getPost('partc_genero');
				//$partc_dte_nascto = $this->request->getPost('partc_dte_nascto');
				//$func_id = $this->request->getPost('func_id');
				$lista_participantes = $this->request->getPost('lista_participantes');

				$corgf_titulo = $this->request->getPost('corgf_titulo');
				$corgf_coreografo = $this->request->getPost('corgf_coreografo');
				$corgf_musica = $this->request->getPost('corgf_musica');
				$corgf_compositor = $this->request->getPost('corgf_compositor');
				$corgf_observacao = $this->request->getPost('corgf_observacao');
				$corgf_modl_id = (int)$this->request->getPost('corgf_modl_id');
				$corgf_formt_id = (int)$this->request->getPost('corgf_formt_id');
				$corgf_categ_id = (int)$this->request->getPost('corgf_categ_id');

				$all_fields_post[] = $this->request->getPost();

				$insti_id = 0;

				/*
				 * -------------------------------------------------------------
				 * Recuperamos as informações do Evento
				 * -------------------------------------------------------------
				**/
				$this->eventMD->select('*');
				$this->eventMD->where('event_hashkey', $event_hashkey);
				$this->eventMD->orderBy('event_id', 'DESC');
				$this->eventMD->limit(1);
				$query_event = $this->eventMD->get();
				if( $query_event && $query_event->resultID->num_rows >=1 )
				{
					$rs_event = $query_event->getRow();
					$insti_id = (int)$rs_event->insti_id; 

					/*
					 * -------------------------------------------------------------
					 * Gravamos as informações do Grupo
					 * -------------------------------------------------------------
					**/
					$data_db = [
						'insti_id' => (int)$insti_id,
						'user_id' => (int)$user_id,
						'grp_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
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
						->where('grp_urlpage', url_title( convert_accented_characters($grp_titulo), '-', TRUE ))
						->limit(1)
						->get();
					if( $query_grupo && $query_grupo->resultID->num_rows == 0 )
					{
						$grp_id = $this->grpMD->insert($data_db);

						/*
						 * -------------------------------------------------------------
						 * Gravamos as informações dos participantes
						 * -------------------------------------------------------------
						**/
							if( !empty( $lista_participantes ) ){
								//print '<pre>';
								//print_r( json_decode($lista_participantes) );
								//print '</pre>';
								$lista_participantes_json = json_decode($lista_participantes);
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

									$data_participante_db = [
										'insti_id' => (int)$insti_id,
										'partc_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
										'partc_urlpage' => url_title( convert_accented_characters($val->partc_nome), '-', TRUE ),
										'grp_id' => $grp_id,
										//'func_id' => $func_id,
										'partc_nome' => $val->partc_nome,
										'partc_nome_social' => $val->partc_nome_social,
										'partc_genero' => $val->partc_genero,
										'partc_documento' => $val->partc_documento,
										'partc_dte_nascto' => fct_date2bd($val->partc_dte_nascto),
										'partc_dte_cadastro' => date("Y-m-d H:i:s"),
										'partc_dte_alteracao' => date("Y-m-d H:i:s"),
										'partc_ativo' => 1,
									];

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
										->where('partc_documento', $val->partc_documento)
										->limit(1)
										->get();
									if( $query_participante && $query_participante->resultID->num_rows == 0 )
									{
										$partc_id = $this->partcMD->insert($data_participante_db);
									}
								}
							}

						/*
						 * -------------------------------------------------------------
						 * Gravamos as informações de coreografia
						 * -------------------------------------------------------------
						**/
							$data_coreografia_db = [
								'insti_id' => (int)$insti_id,
								'grp_id' => (int)$grp_id,
								'modl_id' => (int)$corgf_modl_id,
								'formt_id' => (int)$corgf_formt_id,
								'categ_id' => (int)$corgf_categ_id,
								'corgf_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
								'corgf_urlpage' => url_title( convert_accented_characters($corgf_titulo), '-', TRUE ),
								'corgf_titulo' => $corgf_titulo,
								'corgf_coreografo' => $corgf_coreografo,
								'corgf_musica' => $corgf_musica,
								//'corgf_tempo' => $corgf_tempo,
								'corgf_compositor' => $corgf_compositor,
								'corgf_observacao' => $corgf_observacao,
								'corgf_dte_cadastro' => date("Y-m-d H:i:s"),
								'corgf_dte_alteracao' => date("Y-m-d H:i:s"),
								'corgf_ativo' => 1,
							];

							//if( !empty($file_musica_mp3)){
							//	$data_db['corgf_musica_file'] = $file_musica_mp3;
							//}

							$query_coreografia = $this->corgfMD
								->where('insti_id', (int)$insti_id)
								->where('grp_id', (int)$grp_id)
								->where('corgf_urlpage', url_title( convert_accented_characters($corgf_titulo), '-', TRUE ))
								->get();
							if( $query_coreografia && $query_coreografia->resultID->num_rows == 0 )
							{
								$corgf_id = $this->corgfMD->insert($data_coreografia_db);
							}
					}

					//print '<pre>';
					//print_r( $all_fields_post );
					//print '<pre>';
					exit();
				}
			}





		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
			$this->grpMD->from('tbl_grupos As GRP', true)
				->select('GRP.*')
				->select('EVENT.*')
				//->select('GREVT.grevt_id, GREVT.event_id')
				->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
				->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
				->where('GRP.user_id', $user_id)
				//->where('GRP.grp_hashkey', $grp_hashkey)
				->where('GREVT.grevt_hashkey', $grevt_hashkey)
				->orderBy('GREVT.grevt_id', 'DESC')
				->limit(1);
			$query_grupo_evt = $this->grpMD->get();
			if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
			{
				$rs_grupo_evt = $query_grupo_evt->getRow();
				$this->data['rs_event'] = $rs_grupo_evt;

				$insti_id = (int)$rs_grupo_evt->insti_id;
				$event_id = (int)$rs_grupo_evt->event_id;
				$grp_id = (int)$rs_grupo_evt->grp_id;
				$grp_titulo = $rs_grupo_evt->grp_titulo;


				/*
				 * -------------------------------------------------------------
				 * Configurações do Evento
				 * -------------------------------------------------------------
				**/
					$this->evcfgMD->select('*');
					$this->evcfgMD->where('event_id', $event_id);
					$this->evcfgMD->orderBy('event_id', 'DESC');
					$this->evcfgMD->limit(1);
					$query_event_config = $this->evcfgMD->get();
					if( $query_event_config && $query_event_config->resultID->num_rows >= 1 )
					{
						$rs_event_config = $query_event_config->getRow();
						$this->data['rs_event_config'] = $rs_event_config;
					}

				/*
				 * -------------------------------------------------------------
				 * categorias
				 * -------------------------------------------------------------
				**/
					$list_rs_categorias = [];
					$query_categorias = $this->categMD->select_all_by_insti_id( (int)$insti_id );
					if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
					{
						$rs_categorias = $query_categorias->getResult();
						$this->data['rs_categorias'] = $query_categorias;

						$categorias = [];
						foreach ($rs_categorias as $row) {
							$categoria = [
								'id' => $row->categ_id,
								'titulo' => $row->categ_titulo,
								'idade_min' => (int)$row->categ_idade_min,
								'idade_max' => (int)$row->categ_idade_max,
							];
							$categorias[] = $categoria;
						}
						$list_rs_categorias = $categorias;
					}
					$this->data['list_rs_categorias'] = $list_rs_categorias;

				/*
				 * -------------------------------------------------------------
				 * Informações referente ao grupo e evento
				 * -------------------------------------------------------------
				**/
					$this->grpMD->from('tbl_grupos As GRP', true)
						->select('GRP.*')
						->select('GREVT.grevt_id')
						->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
						->where('GRP.user_id', $user_id)
						->where('GREVT.event_id', (int)$event_id)
						->orderBy('GREVT.grevt_id', 'DESC')
						->limit(1);
					$query_group_evt = $this->grpMD->get();
					if( $query_group_evt && $query_group_evt->resultID->num_rows >=1 )
					{
						$rs_group_evt = $query_group_evt->getRow();
						$this->data['rs_group'] = $rs_group_evt;
					}else{
						/*
						 * -------------------------------------------------------------
						 * Recuperar informações do último grupo criado
						 * -------------------------------------------------------------
						**/
							$this->grpMD->select('*');
							//$this->grpMD->where('insti_id', (int)$rs_event->insti_id);
							$this->grpMD->where('user_id', $user_id);
							$this->grpMD->orderBy('grp_id', 'DESC');
							$this->grpMD->limit(1);
							$query_group = $this->grpMD->get();
							//$query_grupos = $this->grpMD->select_all_by_insti_id();
							if( $query_group && $query_group->resultID->num_rows >=1 )
							{
								$rs_group = $query_group->getRow();
								$this->data['rs_group'] = $rs_group;
							}
					}

				/*
				 * -------------------------------------------------------------
				 * participantes já cadastrados
				 * -------------------------------------------------------------
				**/
					$query_partc_cadastrados = $this->partcMD->from('tbl_participantes As PARTC', true)
						->select('PARTC.*')
						->select('CATEG.categ_titulo')
						->select('FUNC.func_titulo')
						->join('tbl_categorias AS CATEG', 'CATEG.categ_id = PARTC.categ_id', 'LEFT')
						->join('tbl_funcoes AS FUNC', 'FUNC.func_id = PARTC.func_id', 'LEFT')
						->where('PARTC.insti_id', (int)$insti_id)
						->where('PARTC.grp_id', (int)$grp_id)
						->orderBy('PARTC.partc_nome', 'ASC')
						->limit(1000)
						->get();
					//$query_partc_cadastrados = $this->partcMD
					//	->select('*')
					//	->where('insti_id', (int)$rs_event->insti_id)
					//	->orderBy('partc_nome', 'ASC')
					//	->limit(1000)
					//	->get();
					if( $query_partc_cadastrados && $query_partc_cadastrados->resultID->num_rows >=1 )
					{
						$rs_partc_cadastrados = $query_partc_cadastrados->getResult();
						$arr_partc_cadastrados = [];
						foreach ($rs_partc_cadastrados as $row) {
							$partc_hashkey = ($row->partc_hashkey);
							$partc_documento = ($row->partc_documento);
							$partc_nome = ($row->partc_nome);
							$partc_nome_social = ($row->partc_nome_social);
							$partc_email = ($row->partc_email);
							$partc_genero = ($row->partc_genero);
							$partc_dte_nascto = ($row->partc_dte_nascto);

							$partc_file_foto = ($row->partc_file_foto);
							$partc_file_doc_frente = ($row->partc_file_doc_frente);
							$partc_file_doc_verso = ($row->partc_file_doc_verso);

							$categ_id = (int)($row->categ_id);
							$func_id = (int)($row->func_id);

							$categ_titulo = ($row->categ_titulo);
							$func_titulo = ($row->func_titulo);

							$dte_nascto = new DateTime( $partc_dte_nascto );	
							$dte_current = new DateTime(date('Y-m-d H:i:s'));

							$nasc_diff = $dte_current->diff($dte_nascto);
							$idade_years = (int)$nasc_diff->format('%y');
							$idade_months = (int)$nasc_diff->format('%m');
							$idade_days = (int)$nasc_diff->format('%d');
							//if( $idade_years < 18 ){
							//	$error_num = 1;
							//	$error_msg = "A Promoção válida somente para maiores de 18 anos.";
							//	$prosseguir = false;
							//}
							$partc_idade = $idade_years;

							//encontrarCategoria($list_rs_categorias, $idade = 0 )

							/*
								var partes = dataNascimento.split("/");
								var dia = parseInt(partes[0]);
								var mes = parseInt(partes[1]) - 1; // Meses em JavaScript são indexados a partir de 0
								var ano = parseInt(partes[2]);
								var hoje = new Date();
								var nascimento = new Date(ano, mes, dia);
								var idade = hoje.getFullYear() - nascimento.getFullYear();
								var mes = hoje.getMonth() - nascimento.getMonth();
								if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
									idade--;
								}
								return idade;						
							*/

							$path_foto = (empty($partc_file_foto) ? '' : site_url("renderimage/view_avatar/". $partc_file_foto));

							$arr_temp = [
								"partc_hashkey" => $partc_hashkey,
								"partc_documento" => $partc_documento,
								"partc_nome" => $partc_nome,
								"partc_nome_social" => $partc_nome_social,
								"partc_email" => $partc_email,
								"partc_genero" => "X",
								"partc_dte_nascto" => fct_formatdate($partc_dte_nascto, "d/m/Y"),
								"partc_idade" => $partc_idade,
								"partc_categoria" => $categ_titulo,
								"categ_id" => $categ_id,
								"func_id" => $func_id,
								"func_titulo" => $func_titulo,
								"partc_file_foto" => (empty($partc_file_foto) ? '' : $partc_file_foto),
								"partc_file_foto_preview" => $path_foto,
								"partc_file_doc_frente" => $partc_file_doc_frente,
								"partc_file_doc_verso" => $partc_file_doc_verso,
							];
							array_push($arr_partc_cadastrados, $arr_temp);
						}
						$this->data['rs_partc_cadastrados'] = $arr_partc_cadastrados;
					}


			


			// GRUPOS -- não será necessário esta query
			//$this->grpMD->select('*');
			//$this->grpMD->where('insti_id', (int)$insti_id);
			////$this->grpMD->where('insti_id', (int)$this->session_user_id);
			//$this->grpMD->orderBy('grp_titulo', 'ASC');
			//$this->grpMD->limit(1000);
			//$query_grupos = $this->grpMD->get();
			////$query_grupos = $this->grpMD->select_all_by_insti_id();
			//if( $query_grupos && $query_grupos->resultID->num_rows >=1 )
			//{
			//	$this->data['rs_grupos'] = $query_grupos;
			//}

			/*
			 * -------------------------------------------------------------
			 * Modalidades
			 * -------------------------------------------------------------
			**/
				$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
				{
					$this->data['rs_modalidades'] = $query_modalidades;
				}

			/*
			 * -------------------------------------------------------------
			 * Formatos
			 * -------------------------------------------------------------
			**/
				$query_formatos = $this->formtMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
				{
					$this->data['rs_formatos'] = $query_formatos;
				}

			/*
			 * -------------------------------------------------------------
			 * Funções Obrigatórias
			 * -------------------------------------------------------------
			**/
				$this->data['list_rs_func_obrig'] = [];
				$query_func_obrig = $this->funcMD
					->select('func_id, func_titulo')
					->where('func_obrigatorio', 1)
					->get();
				if( $query_func_obrig && $query_func_obrig->resultID->num_rows >=1 )
				{
					$rs_func_obrig = $query_func_obrig->getResult();
					$this->data['list_rs_func_obrig'] = $rs_func_obrig;
				}
		}




		// FUNCOES
		$this->funcMD->select('func_id, func_titulo');
		$this->funcMD->where('func_ativo', 1);
		$this->funcMD->orderBy('func_titulo', 'ASC');
		$this->funcMD->limit(1000);
		$query_funcoes = $this->funcMD->get();
		if( $query_funcoes && $query_funcoes->resultID->num_rows >=1 )
		{
			$this->data['rs_funcoes'] = $query_funcoes;
		}

		// GENERO SEXUAL
		$this->data['arr_generos'] = $this->cfg->getGeneros();


		return view('inscricoes/participantes', $this->data);
	}

	public function coreografias( $grp_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/error') );
		}
		$user_id = (int)session()->get('inscUser_id');


		/*
		 * -------------------------------------------------------------
		 * Gravando a informações por meio de POST tradicional
		 * -------------------------------------------------------------
		**/
			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

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

				//$partc_documento = $this->request->getPost('partc_documento');
				//$partc_nome = $this->request->getPost('partc_nome');
				//$partc_nome_social = $this->request->getPost('partc_nome_social');
				//$partc_genero = $this->request->getPost('partc_genero');
				//$partc_dte_nascto = $this->request->getPost('partc_dte_nascto');
				//$func_id = $this->request->getPost('func_id');
				$lista_participantes = $this->request->getPost('lista_participantes');

				$corgf_titulo = $this->request->getPost('corgf_titulo');
				$corgf_coreografo = $this->request->getPost('corgf_coreografo');
				$corgf_musica = $this->request->getPost('corgf_musica');
				$corgf_compositor = $this->request->getPost('corgf_compositor');
				$corgf_observacao = $this->request->getPost('corgf_observacao');
				$corgf_modl_id = (int)$this->request->getPost('corgf_modl_id');
				$corgf_formt_id = (int)$this->request->getPost('corgf_formt_id');
				$corgf_categ_id = (int)$this->request->getPost('corgf_categ_id');

				$all_fields_post[] = $this->request->getPost();

				$insti_id = 0;

				/*
				 * -------------------------------------------------------------
				 * Recuperamos as informações do Evento
				 * -------------------------------------------------------------
				**/
				$this->eventMD->select('*');
				$this->eventMD->where('event_hashkey', $event_hashkey);
				$this->eventMD->orderBy('event_id', 'DESC');
				$this->eventMD->limit(1);
				$query_event = $this->eventMD->get();
				if( $query_event && $query_event->resultID->num_rows >=1 )
				{
					$rs_event = $query_event->getRow();
					$insti_id = (int)$rs_event->insti_id; 

					/*
					 * -------------------------------------------------------------
					 * Gravamos as informações do Grupo
					 * -------------------------------------------------------------
					**/
					$data_db = [
						'insti_id' => (int)$insti_id,
						'user_id' => (int)$user_id,
						'grp_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
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
						->where('grp_urlpage', url_title( convert_accented_characters($grp_titulo), '-', TRUE ))
						->limit(1)
						->get();
					if( $query_grupo && $query_grupo->resultID->num_rows == 0 )
					{
						$grp_id = $this->grpMD->insert($data_db);

						/*
						 * -------------------------------------------------------------
						 * Gravamos as informações dos participantes
						 * -------------------------------------------------------------
						**/
							if( !empty( $lista_participantes ) ){
								//print '<pre>';
								//print_r( json_decode($lista_participantes) );
								//print '</pre>';
								$lista_participantes_json = json_decode($lista_participantes);
								foreach ($lista_participantes_json as $key => $val) {
									//print '<hr>';
									//print ' | '. $val->partc_documento;

									$data_participante_db = [
										'insti_id' => (int)$insti_id,
										'partc_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
										'partc_urlpage' => url_title( convert_accented_characters($val->partc_nome), '-', TRUE ),
										'grp_id' => $grp_id,
										//'func_id' => $func_id,
										'partc_nome' => $val->partc_nome,
										'partc_nome_social' => $val->partc_nome_social,
										'partc_genero' => $val->partc_genero,
										'partc_documento' => $val->partc_documento,
										'partc_dte_nascto' => fct_date2bd($val->partc_dte_nascto),
										'partc_dte_cadastro' => date("Y-m-d H:i:s"),
										'partc_dte_alteracao' => date("Y-m-d H:i:s"),
										'partc_ativo' => 1,
									];

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
										->where('partc_documento', $val->partc_documento)
										->limit(1)
										->get();
									if( $query_participante && $query_participante->resultID->num_rows == 0 )
									{
										$partc_id = $this->partcMD->insert($data_participante_db);
									}
								}
							}

						/*
						 * -------------------------------------------------------------
						 * Gravamos as informações de coreografia
						 * -------------------------------------------------------------
						**/
							$data_coreografia_db = [
								'insti_id' => (int)$insti_id,
								'grp_id' => (int)$grp_id,
								'modl_id' => (int)$corgf_modl_id,
								'formt_id' => (int)$corgf_formt_id,
								'categ_id' => (int)$corgf_categ_id,
								'corgf_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
								'corgf_urlpage' => url_title( convert_accented_characters($corgf_titulo), '-', TRUE ),
								'corgf_titulo' => $corgf_titulo,
								'corgf_coreografo' => $corgf_coreografo,
								'corgf_musica' => $corgf_musica,
								//'corgf_tempo' => $corgf_tempo,
								'corgf_compositor' => $corgf_compositor,
								'corgf_observacao' => $corgf_observacao,
								'corgf_dte_cadastro' => date("Y-m-d H:i:s"),
								'corgf_dte_alteracao' => date("Y-m-d H:i:s"),
								'corgf_ativo' => 1,
							];

							//if( !empty($file_musica_mp3)){
							//	$data_db['corgf_musica_file'] = $file_musica_mp3;
							//}

							$query_coreografia = $this->corgfMD
								->where('insti_id', (int)$insti_id)
								->where('grp_id', (int)$grp_id)
								->where('corgf_urlpage', url_title( convert_accented_characters($corgf_titulo), '-', TRUE ))
								->get();
							if( $query_coreografia && $query_coreografia->resultID->num_rows == 0 )
							{
								$corgf_id = $this->corgfMD->insert($data_coreografia_db);
							}
					}

					//print '<pre>';
					//print_r( $all_fields_post );
					//print '<pre>';
					exit();
				}
			}

		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
			$this->grpMD->from('tbl_grupos As GRP', true)
				->select('GRP.*')
				->select('EVENT.*')
				//->select('GREVT.grevt_id, GREVT.event_id')
				->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
				->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
				->where('GRP.user_id', $user_id)
				->where('GRP.grp_hashkey', $grp_hashkey)
				->orderBy('GREVT.grevt_id', 'DESC')
				->limit(1);
			$query_grupo_evt = $this->grpMD->get();
			if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
			{
				$rs_grupo_evt = $query_grupo_evt->getRow();
				$this->data['rs_event'] = $rs_grupo_evt;

				$insti_id = (int)$rs_grupo_evt->insti_id;
				$event_id = (int)$rs_grupo_evt->event_id;
				$grp_id = (int)$rs_grupo_evt->grp_id;
				$grp_titulo = $rs_grupo_evt->grp_titulo;

				/*
				 * -------------------------------------------------------------
				 * Configurações do Evento
				 * -------------------------------------------------------------
				**/
					$this->evcfgMD->select('*');
					$this->evcfgMD->where('event_id', $event_id);
					$this->evcfgMD->orderBy('event_id', 'DESC');
					$this->evcfgMD->limit(1);
					$query_event_config = $this->evcfgMD->get();
					if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
					{
						$rs_event_config = $query_event_config->getRow();
						$this->data['rs_event_config'] = $rs_event_config;
					}

				$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
				{
					$this->data['rs_modalidades'] = $query_modalidades;
				}



				$query_formatos = $this->formtMD
					->select('formt_id, formt_titulo, formt_tempo_limit, formt_min_partic, formt_max_partic')
					->where('insti_id', (int)$insti_id)
					->orderBy('formt_titulo', 'ASC')
					->get();
				if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
				{
					$this->data['rs_formatos'] = $query_formatos->getResult();
				}



				//$query_formatos = $this->formtMD
				//	->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				//	->where('insti_id', (int)$insti_id)
				//	->orderBy('formt_titulo', 'ASC')
				//	->get();

				$this->data['list_rs_categorias'] = [];
				$query_categorias = $this->categMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
				{
					$rs_categorias = $query_categorias->getResult();
					$this->data['rs_categorias'] = $query_categorias;

					$categorias = [];
					foreach ($rs_categorias as $row) {
						$categoria = [
							'id' => $row->categ_id,
							'titulo' => $row->categ_titulo,
							'idade_min' => (int)$row->categ_idade_min,
							'idade_max' => (int)$row->categ_idade_max,
						];
						$categorias[] = $categoria;
					}
					$this->data['list_rs_categorias'] = $categorias;
				}


				/*
				 * -------------------------------------------------------------
				 * Coreografos
				 * -------------------------------------------------------------
				**/
				$args_params = [ 
					'grp_id' => (int)$grp_id  
				];
				$path_folder_grupo = $this->libGeneric->get_folder_grupo($args_params);
				$this->data['PATH_FOLDER_GRUPO'] = $path_folder_grupo;
				$func_id = 3; 

				$query_coreografos = $this->partcMD
					->select('partc_id, partc_nome, partc_documento, partc_file_foto')
					->where('insti_id', (int)$insti_id)
					->where('func_id', $func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_coreografos && $query_coreografos->resultID->num_rows >= 1 )
				{
					$this->data['rs_coreografos'] = $query_coreografos->getResult();
				}



				$query_corgf_cadastradas = self::fct_coreografias_cadastradas( (int)$insti_id, (int)$grp_id, (int)$event_id );
				if( $query_corgf_cadastradas && $query_corgf_cadastradas->resultID->num_rows >= 1 )
				{
					$this->data['rs_corgf_cadastradas'] = $query_corgf_cadastradas; //->getResult();
				}
			}



		/*
		 * -------------------------------------------------------------
		 * Termos e Autorizações
		 * -------------------------------------------------------------
		**/
			/*
				SELECT AUTZ.autz_id, AUTZ.autz_titulo, AUTZ.autz_parent_id 
				FROM tbl_eventos_autorizacoes EVTAUT
					LEFT JOIN tbl_autorizacoes AUTZ ON AUTZ.autz_id = EVTAUT.autz_id	
					
				SELECT
					DISTINCT 
					-- AUTZ.autz_id, AUTZ.autz_titulo, AUTZ.autz_parent_id, 
					PARENT.autz_id As autz_id_parent,
					PARENT.autz_titulo As autz_titulo_parent
				FROM tbl_eventos_autorizacoes EVTAUT
					LEFT JOIN tbl_autorizacoes AUTZ ON AUTZ.autz_id = EVTAUT.autz_id
					LEFT JOIN tbl_autorizacoes PARENT ON AUTZ.autz_parent_id = PARENT.autz_id
			*/
			$this->evtautMD->from('tbl_eventos_autorizacoes EVTAUT', true)
				->distinct()
				->select('PARENT.autz_id As autz_id_parent')
				->select('PARENT.autz_titulo As autz_titulo_parent')
				->join('tbl_autorizacoes AUTZ', 'AUTZ.autz_id = EVTAUT.autz_id', 'LEFT')
				->join('tbl_autorizacoes PARENT', 'AUTZ.autz_parent_id = PARENT.autz_id', 'LEFT')
				->orderBy('PARENT.autz_id', 'ASC')
				->limit(1000);
			$query_autz_parent = $this->evtautMD->get();

			$rs_grupo_autorizacao = [];
			if( $query_autz_parent && $query_autz_parent->resultID->num_rows >=1 )
			{
				$rs_autz_parent = $query_autz_parent->getResult();
				//$this->data['rs_autorizacoes'] = $query_autz_parent;
				foreach ($rs_autz_parent as $rowAutzParent) {
					$autz_id_parent = $rowAutzParent->autz_id_parent;
					$autz_titulo_parent = $rowAutzParent->autz_titulo_parent;
					//print '<br>'. $autz_titulo_parent;
					$this->evtautMD->from('tbl_eventos_autorizacoes EVTAUT', true)
						->select('AUTZ.autz_id, AUTZ.autz_titulo, AUTZ.autz_descricao, AUTZ.autz_descricao_full')
						->join('tbl_autorizacoes AUTZ', 'AUTZ.autz_id = EVTAUT.autz_id', 'INNER')
						->where('AUTZ.autz_parent_id', $rowAutzParent->autz_id_parent)
						->orderBy('AUTZ.autz_id', 'ASC')
						->limit(1000);
					$query_autorizacoes = $this->evtautMD->get();
					if( $query_autorizacoes && $query_autorizacoes->resultID->num_rows >=1 )
					{
						$rs_grupo_autorizacao[$autz_id_parent]['titulo'] = $autz_titulo_parent;
						$rs_grupo_autorizacao[$autz_id_parent]['dados'] = $query_autorizacoes->getResult();
						
						/*
						$rs_autorizacoes = $query_autorizacoes->getResult();
						foreach ($rs_autorizacoes as $rowAutz) {
							print '<br> &nbsp;&nbsp;&nbsp;'. $rowAutz->autz_id;
							print ' | '. $rowAutz->autz_titulo;
						}
						*/
					}
				}
			}
			$this->data['rs_autorizacoes'] = $rs_grupo_autorizacao;

			//$this->autzMD->from('tbl_autorizacoes GRUPO', true)
			//	->select('GRUPO.autz_id, GRUPO.autz_parent_id, GRUPO.autz_hashkey, GRUPO.autz_titulo, GRUPO.autz_descricao')
			//	->select('ITENS.autz_titulo As autz_titulo_parent')
			//	->join('tbl_autorizacoes ITENS', 'GRUPO.autz_parent_id = ITENS.autz_id', 'LEFT')
			//	->join('tbl_eventos_autorizacoes AUTZ', 'AUTZ.autz_id = GRUPO.autz_id', 'LEFT')
			//	->where('GRUPO.autz_parent_id', '0')
			//	->orWhere('AUTZ.autz_id !=', NULL)
			//	->orderBy('GRUPO.autz_id', 'ASC')
			//	->orderBy('GRUPO.autz_parent_id', 'ASC')
			//	->limit(1000);
			//$query_autorizacoes = $this->autzMD->get();
			////print $this->autzMD->getLastQuery();
			//if( $query_autorizacoes && $query_autorizacoes->resultID->num_rows >=1 )
			//{
			//	//$rs_autorizacoes = $query_autorizacoes->getResult();
			//	$this->data['rs_autorizacoes'] = $query_autorizacoes;

			//}


		/*
		SELECT 
			`GRUPO`.`autz_id`, `GRUPO`.`autz_parent_id`, `GRUPO`.`autz_hashkey`, 
			`GRUPO`.`autz_titulo`, `GRUPO`.`autz_descricao`, 
			`ITENS`.`autz_titulo` As `autz_titulo_parent`,
			AUTZ.autz_id
		FROM `tbl_autorizacoes` `GRUPO` 
		LEFT JOIN `tbl_autorizacoes` `ITENS` ON `GRUPO`.`autz_parent_id` = `ITENS`.`autz_id` 
		LEFT JOIN tbl_eventos_autorizacoes AUTZ ON AUTZ.autz_id = `GRUPO`.`autz_id`
		WHERE `GRUPO`.autz_parent_id = 0 OR NOT AUTZ.autz_id IS NULL
		ORDER BY `GRUPO`.`autz_id` ASC, `GRUPO`.`autz_parent_id` ASC 
		LIMIT 1000
		*/


		return view('inscricoes/coreografias', $this->data);
	}

	public function cobrancas( $grp_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/error') );
		}
		$user_id = (int)session()->get('inscUser_id');




		/*
		 * -------------------------------------------------------------
		 * Gravando a informações por meio de POST tradicional
		 * -------------------------------------------------------------
		**/
			if ($this->request->getPost())
			{
				$ped_hashkey = self::cobranca_post( $user_id, $grp_hashkey);

				/*
				 * -------------------------------------------------------------
				 * Gravamos a informação do pedido para enviar para o mercado pago
				 * -------------------------------------------------------------
				**/

				return $this->response->redirect( site_url('inscricoes/pagamento/'. $ped_hashkey) );


				//print '<h1>'. $total_geral_pedido .'<h1>';
				exit();
			}



		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
		$this->grpMD->from('tbl_grupos As GRP', true)
			->select('GRP.*')
			->select('EVENT.*')
			//->select('GREVT.grevt_id, GREVT.event_id')
			->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
			->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
			->where('GRP.user_id', $user_id)
			->where('GRP.grp_hashkey', $grp_hashkey)
			->orderBy('GREVT.grevt_id', 'DESC')
			->limit(1);
		$query_grupo_evt = $this->grpMD->get();
		if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
		{
			$rs_grupo_evt = $query_grupo_evt->getRow();
			$this->data['rs_event'] = $rs_grupo_evt;

			$insti_id = (int)$rs_grupo_evt->insti_id;
			$event_id = (int)$rs_grupo_evt->event_id;
			$grp_id = (int)$rs_grupo_evt->grp_id;
			$grp_titulo = $rs_grupo_evt->grp_titulo;

			/*
			 * -------------------------------------------------------------
			 * Configurações do Evento
			 * -------------------------------------------------------------
			**/
				$this->evcfgMD->select('*');
				$this->evcfgMD->where('event_id', $event_id);
				$this->evcfgMD->orderBy('event_id', 'DESC');
				$this->evcfgMD->limit(1);
				$query_event_config = $this->evcfgMD->get();
				if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
				{
					$rs_event_config = $query_event_config->getRow();
					$this->data['rs_event_config'] = $rs_event_config;

					$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
					$arr_evcfg_forma_cobranca = json_decode( $evcfg_forma_cobranca );
					if( !is_array($arr_evcfg_forma_cobranca) ){ $arr_evcfg_forma_cobranca = []; }
					//$arr_forma_cobranca = isset( $evcfg_forma_cobranca_json[] )

					/*
					 * -------------------------------------------------------------
					 * Informações sobre valores
					 * -------------------------------------------------------------
					**/
						if (in_array("por_coreografia", $arr_evcfg_forma_cobranca)) {
							// valores por_coreografia
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
							{
								$this->data['rs_valores_por_coreografias'] = $query_event_valores;
							}
						}
						if (in_array("por_participante", $arr_evcfg_forma_cobranca)) {
							// valores por_participante
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', $event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-participantes');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
							{
								$this->data['rs_valores_por_participantes'] = $query_event_valores;
							}
						}

						// valores por participante
						// -----------------------------------------
						//$this->evvlrMD->select('*');
						//$this->evvlrMD->where('event_id', $event_id);
						//$this->evvlrMD->orderBy('event_id', 'DESC');
						//$this->evvlrMD->limit(200);
						//$query_event_valores = $this->evvlrMD->get();
						//if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
						//{
						//	$this->data['rs_event_valores'] = $query_event_valores;
						//}
				}




			$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$insti_id );
			if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
			{
				$this->data['rs_modalidades'] = $query_modalidades;
			}

			//$query_formatos = $this->formtMD->select_all_by_insti_id( (int)$insti_id );
			$query_formatos = $this->formtMD
				->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				->where('insti_id', (int)$insti_id)
				->orderBy('formt_titulo', 'ASC')
				->get();
			if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
			{
				$this->data['rs_formatos'] = $query_formatos->getResult();
			}

			$query_formatos = $this->formtMD
				->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				->where('insti_id', (int)$insti_id)
				->orderBy('formt_titulo', 'ASC')
				->get();

			$this->data['list_rs_categorias'] = [];
			$query_categorias = $this->categMD->select_all_by_insti_id( (int)$insti_id );
			if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
			{
				$rs_categorias = $query_categorias->getResult();
				$this->data['rs_categorias'] = $query_categorias;

				$categorias = [];
				foreach ($rs_categorias as $row) {
					$categoria = [
						'id' => $row->categ_id,
						'titulo' => $row->categ_titulo,
						'idade_min' => (int)$row->categ_idade_min,
						'idade_max' => (int)$row->categ_idade_max,
					];
					$categorias[] = $categoria;
				}
				$this->data['list_rs_categorias'] = $categorias;
			}


			/*
			 * -------------------------------------------------------------
			 * lista de coreografias / elenco
			 * -------------------------------------------------------------
			**/
				$func_id = 3; 
				$query_coreografos = $this->partcMD
					->select('partc_id, partc_nome, partc_documento')
					->where('insti_id', (int)$insti_id)
					->where('func_id', $func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_coreografos && $query_coreografos->resultID->num_rows >= 1 )
				{
					$this->data['rs_coreografos'] = $query_coreografos->getResult();
				}

				$query_corgf_cadastradas = self::fct_coreografias_cadastradas( (int)$insti_id, (int)$grp_id, (int)$event_id );
				if( $query_corgf_cadastradas && $query_corgf_cadastradas->resultID->num_rows >= 1 )
				{
					$rs_corgf_cadastradas = $query_corgf_cadastradas->getResultArray();

					$lista_de_coreografias = [];
					$xx = 0;
					foreach ($rs_corgf_cadastradas as $row) {
						$lista_de_coreografias['coreografias'][$xx] = $row;

						/*
						 * -------------------------------------------------------------
						 * verificar o valor por coreografia
						 * -------------------------------------------------------------
						**/
						$valor_coreografia = 0;
						$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '0';
						if( in_array('por_coreografia', $arr_evcfg_forma_cobranca) ){

							//print_debug( 'verificar valores por coreografias' );
							$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '1';

							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('formt_id', (int)$row['formt_id']);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(1);
							$query_valor_por_formato = $this->evvlrMD->get();
							if( $query_event_valores && $query_valor_por_formato->resultID->num_rows >= 1 )
							{
								$rs_vlr_formato = $query_valor_por_formato->getRow();
								//print_debug( 'Valor por Formato' );	
								//print_debug( $rs_vlr_formato );

								if( in_array('doacao', $arr_evcfg_forma_cobranca) ){
									$valor_coreografia = 0;

									$lista_de_coreografias['coreografias'][$xx]['valor'] = 0;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = 0;
								}else{
									$valor_coreografia = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['valor'] = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = $rs_vlr_formato->evvlr_vlr_desc;
								}
							}
						}
						//$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
						$query_elenco = self::fct_elenco_por_coreografia( (int)$row['corgf_id'], (int)$event_id, $arr_evcfg_forma_cobranca );


						$lista_de_coreografias['coreografias'][$xx]['CODIGO'] = (int)$row['corgf_id'];
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco->getResult();
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco;
						
						$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco['lista'];
						$lista_de_coreografias['coreografias'][$xx]['valores_totais_por_participantes'] = $query_elenco['valores_totais'];


						$valor_total_por_coreografia = ($valor_coreografia + $query_elenco['valores_totais']);
						$lista_de_coreografias['coreografias'][$xx]['valor_total_coreografia'] = $valor_total_por_coreografia;
						$xx++;
					}
					//print_debug( $lista_de_coreografias );
					//exit();

					$this->data['lista_de_coreografias'] = $lista_de_coreografias;
					$this->data['rs_corgf_cadastradas'] = $query_corgf_cadastradas; //->getResult();
				}
		}
	
		return view('inscricoes/cobrancas', $this->data);
	}

	public function cobranca_post( $user_id = "", $grp_hashkey = ""){
		$total_geral_pedido = 0;
		
		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
		$this->grpMD->from('tbl_grupos As GRP', true)
			->select('GRP.*')
			->select('EVENT.*')
			->select('GREVT.grevt_id')
			->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
			->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
			->where('GRP.user_id', $user_id)
			->where('GRP.grp_hashkey', $grp_hashkey)
			->orderBy('GREVT.grevt_id', 'DESC')
			->limit(1);
		$query_grupo_evt = $this->grpMD->get();
		if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
		{
			$rs_grupo_evt = $query_grupo_evt->getRow();
			$this->data['rs_event'] = $rs_grupo_evt;

			$insti_id = (int)$rs_grupo_evt->insti_id;
			$event_id = (int)$rs_grupo_evt->event_id;
			$event_titulo = $rs_grupo_evt->event_titulo;
			$grevt_id = (int)$rs_grupo_evt->grevt_id;
			$grp_id = (int)$rs_grupo_evt->grp_id;
			$grp_titulo = $rs_grupo_evt->grp_titulo;

			/*
			 * -------------------------------------------------------------
			 * Configurações do Evento
			 * -------------------------------------------------------------
			**/
				$this->evcfgMD->select('*');
				$this->evcfgMD->where('event_id', $event_id);
				$this->evcfgMD->orderBy('event_id', 'DESC');
				$this->evcfgMD->limit(1);
				$query_event_config = $this->evcfgMD->get();
				if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
				{
					$rs_event_config = $query_event_config->getRow();
					$this->data['rs_event_config'] = $rs_event_config;

					$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
					$arr_evcfg_forma_cobranca = json_decode( $evcfg_forma_cobranca );
					if( !is_array($arr_evcfg_forma_cobranca) ){ $arr_evcfg_forma_cobranca = []; }
					//$arr_forma_cobranca = isset( $evcfg_forma_cobranca_json[] )

					/*
					 * -------------------------------------------------------------
					 * Informações sobre valores
					 * -------------------------------------------------------------
					**/
						if (in_array("por_coreografia", $arr_evcfg_forma_cobranca)) {
							// valores por_coreografia
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
							{
								$this->data['rs_valores_por_coreografias'] = $query_event_valores;
							}
						}
						if (in_array("por_participante", $arr_evcfg_forma_cobranca)) {
							// valores por_participante
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', $event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-participantes');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
							{
								$this->data['rs_valores_por_participantes'] = $query_event_valores;
							}
						}

						// valores por participante
						// -----------------------------------------
						//$this->evvlrMD->select('*');
						//$this->evvlrMD->where('event_id', $event_id);
						//$this->evvlrMD->orderBy('event_id', 'DESC');
						//$this->evvlrMD->limit(200);
						//$query_event_valores = $this->evvlrMD->get();
						//if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
						//{
						//	$this->data['rs_event_valores'] = $query_event_valores;
						//}
				}

			/*
			 * -------------------------------------------------------------
			 * Modalidade
			 * -------------------------------------------------------------
			**/
				$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
				{
					$this->data['rs_modalidades'] = $query_modalidades;
				}

			/*
			 * -------------------------------------------------------------
			 * Formatos
			 * -------------------------------------------------------------
			**/
				//$query_formatos = $this->formtMD->select_all_by_insti_id( (int)$insti_id );
				$query_formatos = $this->formtMD
					->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
					->where('insti_id', (int)$insti_id)
					->orderBy('formt_titulo', 'ASC')
					->get();
				if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
				{
					$this->data['rs_formatos'] = $query_formatos->getResult();
				}

				//$query_formatos = $this->formtMD
				//	->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				//	->where('insti_id', (int)$insti_id)
				//	->orderBy('formt_titulo', 'ASC')
				//	->get();


			/*
			 * -------------------------------------------------------------
			 * Categorias
			 * -------------------------------------------------------------
			**/
				$this->data['list_rs_categorias'] = [];
				$query_categorias = $this->categMD->select_all_by_insti_id( (int)$insti_id );
				if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
				{
					$rs_categorias = $query_categorias->getResult();
					$this->data['rs_categorias'] = $query_categorias;

					$categorias = [];
					foreach ($rs_categorias as $row) {
						$categoria = [
							'id' => $row->categ_id,
							'titulo' => $row->categ_titulo,
							'idade_min' => (int)$row->categ_idade_min,
							'idade_max' => (int)$row->categ_idade_max,
						];
						$categorias[] = $categoria;
					}
					$this->data['list_rs_categorias'] = $categorias;
				}


			/*
			 * -------------------------------------------------------------
			 * lista de coreografias / elenco
			 * -------------------------------------------------------------
			**/
				$func_id = 3; 
				$total_geral_pedido = 0;
				$query_coreografos = $this->partcMD
					->select('partc_id, partc_nome, partc_documento')
					->where('insti_id', (int)$insti_id)
					->where('func_id', $func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_coreografos && $query_coreografos->resultID->num_rows >= 1 )
				{
					$this->data['rs_coreografos'] = $query_coreografos->getResult();
				}

				$query_corgf_cadastradas = self::fct_coreografias_cadastradas( (int)$insti_id, (int)$grp_id, (int)$event_id );
				if( $query_corgf_cadastradas && $query_corgf_cadastradas->resultID->num_rows >= 1 )
				{
					$rs_corgf_cadastradas = $query_corgf_cadastradas->getResultArray();

					$lista_de_coreografias = [];
					$xx = 0;
					foreach ($rs_corgf_cadastradas as $row) {
						$lista_de_coreografias['coreografias'][$xx] = $row;

						/*
						 * -------------------------------------------------------------
						 * verificar o valor por coreografia
						 * -------------------------------------------------------------
						**/
						$valor_coreografia = 0;
						$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '0';
						if( in_array('por_coreografia', $arr_evcfg_forma_cobranca) ){

							//print_debug( 'verificar valores por coreografias' );
							$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '1';

							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('formt_id', (int)$row['formt_id']);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(1);
							$query_valor_por_formato = $this->evvlrMD->get();
							if( $query_event_valores && $query_valor_por_formato->resultID->num_rows >= 1 )
							{
								$rs_vlr_formato = $query_valor_por_formato->getRow();
								//print_debug( 'Valor por Formato' );	
								//print_debug( $rs_vlr_formato );

								if( in_array('doacao', $arr_evcfg_forma_cobranca) ){
									$valor_coreografia = 0;

									$lista_de_coreografias['coreografias'][$xx]['valor'] = 0;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = 0;
								}else{
									$valor_coreografia = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['valor'] = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = $rs_vlr_formato->evvlr_vlr_desc;
								}
							}
						}
						//$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
						$query_elenco = self::fct_elenco_por_coreografia( (int)$row['corgf_id'], (int)$event_id, $arr_evcfg_forma_cobranca );


						$lista_de_coreografias['coreografias'][$xx]['CODIGO'] = (int)$row['corgf_id'];
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco->getResult();
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco;
						
						$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco['lista'];
						$lista_de_coreografias['coreografias'][$xx]['valores_totais_por_participantes'] = $query_elenco['valores_totais'];


						$valor_total_por_coreografia = ($valor_coreografia + $query_elenco['valores_totais']);
						$lista_de_coreografias['coreografias'][$xx]['valor_total_coreografia'] = $valor_total_por_coreografia;
						$xx++;

						$total_geral_pedido = ($total_geral_pedido + $valor_total_por_coreografia);
					}
					//print_debug( $lista_de_coreografias );
					//exit();

					//$this->data['lista_de_coreografias'] = $lista_de_coreografias;
					//$this->data['rs_corgf_cadastradas'] = $query_corgf_cadastradas; //->getResult();
				}


			/*
			 * -------------------------------------------------------------
			 * Tipo de Configurações para Cobranca
			 * -------------------------------------------------------------
			**/
				$this->evcobMD->select('*');
				$this->evcobMD->where('event_id', $event_id);
				$this->evcobMD->orderBy('event_id', 'DESC');
				$this->evcobMD->limit(1);
				$query_event_cobr = $this->evcobMD->get();
				if( $query_event_cobr && $query_event_cobr->resultID->num_rows >=1 )
				{
					$rs_event_cobr = $query_event_cobr->getRow();
					$this->data['rs_event_cobr'] = $rs_event_cobr;

					$evcob_tipo_cobranca = $rs_event_cobr->evcob_tipo_cobranca;
					if( $evcob_tipo_cobranca == "mercado_pago" ){
						/*
						 * -------------------------------------------------------------
						 * novo pedido
						 * -------------------------------------------------------------
						**/	
							$valor_total = $total_geral_pedido;
							$cupom_desconto = 0;
							$cupom_percentual = 0;
							$total_desconto = 0;

							$pedidos_itens = [];

							$arr_temp = (object) array(
								//"tvlrid" => $key,
								//"tarftitulo" => $tarf_titulo,
								//"tvlrquant" => $quantidade,
								//"tvlrvalor" => $tvlr_valor,
								//"tvlrsubtotal" => $sub_total,
							);
							array_push($pedidos_itens, $arr_temp);

							$ped_hashkey = md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16));
							$data_cadastro = [
								'grevt_id' => (int)$grevt_id,
								'user_id' => (int)$user_id,
								'event_id' => (int)$event_id,
								'event_titulo' => $event_titulo,
								'insti_id' => (int)$insti_id,
								'grp_id' => (int)$grp_id,
								'ped_hashkey' => $ped_hashkey,
								'ped_nome' => '',
								'ped_email' => '',
								'ped_payment' => 'mercado-pago',
								'ped_json' => json_encode($pedidos_itens),
								'ped_valor_total' => $valor_total,
								'ped_valor_percent' => $cupom_percentual,
								'ped_valor_desconto' => $total_desconto,
								'ped_cupom_codigo' => $cupom_desconto,
								'ped_cupom_cortesia' => 0,
								'ped_liberado' => 1,
								'ped_dte_liberado' => date("Y-m-d H:i:s"),
								'ped_dte_cadastro' => date("Y-m-d H:i:s"),
								'ped_dte_alteracao' => date("Y-m-d H:i:s"),
								'ped_ativo' => 1,
							];
							//print_r( $data_cadastro );
							//exit();
							$ped_id = (int)$this->pedMD->insert($data_cadastro);

							//$this->response->redirect( painel_url('login') );
					}
				}
		}

		return $ped_hashkey;
	}

	public function doacoes( $grp_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/error') );
		}
		$user_id = (int)session()->get('inscUser_id');


		/*
		 * -------------------------------------------------------------
		 * Gravando a informações por meio de POST tradicional
		 * -------------------------------------------------------------
		**/
			if ($this->request->getPost())
			{
				//$ped_hashkey = self::cobranca_post( $user_id, $grp_hashkey);

				/*
				 * -------------------------------------------------------------
				 * Gravamos a informação do pedido para enviar para o mercado pago
				 * -------------------------------------------------------------
				**/

				//return $this->response->redirect( site_url('inscricoes/pagamento/'. $ped_hashkey) );

				//print '<h1>'. $total_geral_pedido .'<h1>';
				exit();
			}


		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
		$this->grpMD->from('tbl_grupos As GRP', true)
			->select('GRP.*')
			->select('EVENT.*')
			//->select('GREVT.grevt_id, GREVT.event_id')
			->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
			->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
			->where('GRP.user_id', $user_id)
			->where('GRP.grp_hashkey', $grp_hashkey)
			->orderBy('GREVT.grevt_id', 'DESC')
			->limit(1);
		$query_grupo_evt = $this->grpMD->get();
		if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
		{
			$rs_grupo_evt = $query_grupo_evt->getRow();
			$this->data['rs_event'] = $rs_grupo_evt;

			$insti_id = (int)$rs_grupo_evt->insti_id;
			$event_id = (int)$rs_grupo_evt->event_id;
			$grp_id = (int)$rs_grupo_evt->grp_id;
			$grp_titulo = $rs_grupo_evt->grp_titulo;



			/*
			 * -------------------------------------------------------------
			 * Configurações do Evento
			 * -------------------------------------------------------------
			**/
				$query_event_config = $this->evcfgMD->get_by_id( (int)$event_id );
				if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
				{
					$rs_event_config = $query_event_config->getRow();
					$this->data['rs_event_config'] = $rs_event_config;

					$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
					$arr_evcfg_forma_cobranca = json_decode( $evcfg_forma_cobranca );
					if( !is_array($arr_evcfg_forma_cobranca) ){ $arr_evcfg_forma_cobranca = []; }
					//$arr_forma_cobranca = isset( $evcfg_forma_cobranca_json[] )

					//print '<pre>';
					//print_r( $arr_evcfg_forma_cobranca);
					//print '</pre>';

					/*
					 * -------------------------------------------------------------
					 * Informações sobre forma de cobranca
					 * -------------------------------------------------------------
					**/
						if (in_array("doacao", $arr_evcfg_forma_cobranca)) {
							$listTipoCobrancaDoacoes = $this->cfgAPP->getTipoCobrancaDoacoes();
							$this->data['listTipoCobrancaDoacoes'] = $listTipoCobrancaDoacoes;

							$this->evvlrMD->select('evvlr_label, evvlr_quant, evvlr_txt_descr, evvlr_ativo')
								->where('event_id', $event_id)
								->where('evvlr_ativo', '1');
							$this->evvlrMD->groupStart()
								->whereIn('evvlr_label', array_keys($listTipoCobrancaDoacoes))
							->groupEnd();
							$query_event_quant_doacoes = $this->evvlrMD->get();

							$rs_config_info_doacoes = [];
							if( $query_event_quant_doacoes && $query_event_quant_doacoes->resultID->num_rows >= 1 )
							{
								//$this->data['rs_config_info_doacoes'] = $query_event_quant_doacoes->getResult();
								foreach ($query_event_quant_doacoes->getResult() as $row) {
									$evvlr_label = $row->evvlr_label;
									$evvlr_quant = $row->evvlr_quant;
									$evvlr_txt_descr = $row->evvlr_txt_descr;
									$evvlr_ativo = (int)$row->evvlr_ativo;
									$rs_config_info_doacoes[$evvlr_label] = (object)[
										"evvlr_label" => $evvlr_label,
										"evvlr_quant" => $evvlr_quant,
										"evvlr_txt_descr" => $evvlr_txt_descr,
										"evvlr_ativo" => $evvlr_ativo,
									];
								}
								$this->data['rs_config_info_doacoes'] = $rs_config_info_doacoes;
							}

							//print '<pre>';
							//print_r( $rs_config_info_doacoes);
							//print '</pre>';

							//exit();
							
							//// valores por_coreografia
							//// -----------------------------------------
							//$this->evvlrMD->select('*');
							//$this->evvlrMD->where('event_id', (int)$event_id);
							//$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							//$this->evvlrMD->orderBy('event_id', 'DESC');
							//$this->evvlrMD->limit(200);
							//$query_event_valores = $this->evvlrMD->get();
							//if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
							//{
							//	$this->data['rs_valores_por_coreografias'] = $query_event_valores;
							//}
						}
					//exit();
				}



			/*
			 * -------------------------------------------------------------
			 * Lista Geral de Participantes
			 * -------------------------------------------------------------
			**/
				$this->partcMD->from('tbl_participantes PARTC', true)
					->select('PARTC.partc_id, PARTC.partc_hashkey, PARTC.partc_nome, PARTC.partc_documento ')
					->select('FUNC.func_id, FUNC.func_titulo')
					->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'INNER')
					->join('tbl_grupos_x_eventos GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
					->join('tbl_funcoes AS FUNC', 'FUNC.func_id = PARTC.func_id', 'INNER')
					->where('GREVT.event_id', (int)$event_id)
					->where('GREVT.grp_id', (int)$grp_id)
					->orderBy('PARTC.partc_nome', 'ASC')
					->limit(100);
				$query_participantes_list = $this->partcMD->get();
				if( $query_participantes_list && $query_participantes_list->resultID->num_rows >= 1 )
				{
					$rs_participantes_list = $query_participantes_list->getResult();
					$this->data['rs_participantes_list'] = $rs_participantes_list;
					//print '<pre>';
					//print_r( $rs_participantes_list);
					//print '</pre>';
					//exit();
				}


			/*
			 * -------------------------------------------------------------
			 * Lista Geral de Coreografias
			 * -------------------------------------------------------------
			**/
				//$this->corgfMD->from('tbl_participantes PARTC', true)
				//	->select('PARTC.partc_id, PARTC.partc_hashkey, PARTC.partc_nome, PARTC.partc_documento ')
				//	->select('FUNC.func_id, FUNC.func_titulo')
				//	->join('tbl_grupos GRP', 'GRP.grp_id = PARTC.grp_id', 'INNER')
				//	->join('tbl_grupos_x_eventos GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
				//	->join('tbl_funcoes AS FUNC', 'FUNC.func_id = PARTC.func_id', 'INNER')
				//	->where('GREVT.event_id', (int)$event_id)
				//	->where('GREVT.grp_id', (int)$grp_id)
				//	->orderBy('PARTC.partc_nome', 'ASC')
				//	->limit(100);
				$query_coreografias_list = $this->corgfMD->lista_por_grupo( $insti_id, $grp_id );
				if( $query_coreografias_list && $query_coreografias_list->resultID->num_rows >= 1 )
				{
					$rs_coreografias_list = $query_coreografias_list->getResult();
					$this->data['rs_coreografias_list'] = $rs_coreografias_list;
					//print '<pre>';
					//print_r( $rs_participantes_list);
					//print '</pre>';
					//exit();
				}






			/*
			 * -------------------------------------------------------------
			 * Configurações do Evento
			 * -------------------------------------------------------------
			**/
				$this->evcfgMD->select('*');
				$this->evcfgMD->where('event_id', $event_id);
				$this->evcfgMD->orderBy('event_id', 'DESC');
				$this->evcfgMD->limit(1);
				$query_event_config = $this->evcfgMD->get();
				if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
				{
					$rs_event_config = $query_event_config->getRow();
					$this->data['rs_event_config'] = $rs_event_config;

					$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
					$arr_evcfg_forma_cobranca = json_decode( $evcfg_forma_cobranca );
					if( !is_array($arr_evcfg_forma_cobranca) ){ $arr_evcfg_forma_cobranca = []; }
					//$arr_forma_cobranca = isset( $evcfg_forma_cobranca_json[] )

					/*
					 * -------------------------------------------------------------
					 * Informações sobre valores
					 * -------------------------------------------------------------
					**/
						if (in_array("por_coreografia", $arr_evcfg_forma_cobranca)) {
							// valores por_coreografia
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
							{
								$this->data['rs_valores_por_coreografias'] = $query_event_valores;
							}
						}
						if (in_array("por_participante", $arr_evcfg_forma_cobranca)) {
							// valores por_participante
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', $event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-participantes');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
							{
								$this->data['rs_valores_por_participantes'] = $query_event_valores;
							}
						}

						// valores por participante
						// -----------------------------------------
						//$this->evvlrMD->select('*');
						//$this->evvlrMD->where('event_id', $event_id);
						//$this->evvlrMD->orderBy('event_id', 'DESC');
						//$this->evvlrMD->limit(200);
						//$query_event_valores = $this->evvlrMD->get();
						//if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
						//{
						//	$this->data['rs_event_valores'] = $query_event_valores;
						//}
				}




			$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$insti_id );
			if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
			{
				$this->data['rs_modalidades'] = $query_modalidades;
			}

			//$query_formatos = $this->formtMD->select_all_by_insti_id( (int)$insti_id );
			$query_formatos = $this->formtMD
				->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				->where('insti_id', (int)$insti_id)
				->orderBy('formt_titulo', 'ASC')
				->get();
			if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
			{
				$this->data['rs_formatos'] = $query_formatos->getResult();
			}

			$query_formatos = $this->formtMD
				->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				->where('insti_id', (int)$insti_id)
				->orderBy('formt_titulo', 'ASC')
				->get();

			$this->data['list_rs_categorias'] = [];
			$query_categorias = $this->categMD->select_all_by_insti_id( (int)$insti_id );
			if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
			{
				$rs_categorias = $query_categorias->getResult();
				$this->data['rs_categorias'] = $query_categorias;

				$categorias = [];
				foreach ($rs_categorias as $row) {
					$categoria = [
						'id' => $row->categ_id,
						'titulo' => $row->categ_titulo,
						'idade_min' => (int)$row->categ_idade_min,
						'idade_max' => (int)$row->categ_idade_max,
					];
					$categorias[] = $categoria;
				}
				$this->data['list_rs_categorias'] = $categorias;
			}


			/*
			 * -------------------------------------------------------------
			 * lista de coreografias / elenco
			 * -------------------------------------------------------------
			**/
				$func_id = 3; 
				$query_coreografos = $this->partcMD
					->select('partc_id, partc_nome, partc_documento')
					->where('insti_id', (int)$insti_id)
					->where('func_id', $func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_coreografos && $query_coreografos->resultID->num_rows >= 1 )
				{
					$this->data['rs_coreografos'] = $query_coreografos->getResult();
				}

				$query_corgf_cadastradas = self::fct_coreografias_cadastradas( (int)$insti_id, (int)$grp_id, (int)$event_id );
				if( $query_corgf_cadastradas && $query_corgf_cadastradas->resultID->num_rows >= 1 )
				{
					$rs_corgf_cadastradas = $query_corgf_cadastradas->getResultArray();

					$lista_de_coreografias = [];
					$xx = 0;
					foreach ($rs_corgf_cadastradas as $row) {
						$lista_de_coreografias['coreografias'][$xx] = $row;

						/*
						 * -------------------------------------------------------------
						 * verificar o valor por coreografia
						 * -------------------------------------------------------------
						**/
						$valor_coreografia = 0;
						$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '0';
						if( in_array('por_coreografia', $arr_evcfg_forma_cobranca) ){

							//print_debug( 'verificar valores por coreografias' );
							$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '1';

							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('formt_id', (int)$row['formt_id']);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(1);
							$query_valor_por_formato = $this->evvlrMD->get();
							if( $query_event_valores && $query_valor_por_formato->resultID->num_rows >= 1 )
							{
								$rs_vlr_formato = $query_valor_por_formato->getRow();
								//print_debug( 'Valor por Formato' );	
								//print_debug( $rs_vlr_formato );

								if( in_array('doacao', $arr_evcfg_forma_cobranca) ){
									$valor_coreografia = 0;

									$lista_de_coreografias['coreografias'][$xx]['valor'] = 0;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = 0;
								}else{
									$valor_coreografia = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['valor'] = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = $rs_vlr_formato->evvlr_vlr_desc;
								}
							}
						}
						//$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
						$query_elenco = self::fct_elenco_por_coreografia( (int)$row['corgf_id'], (int)$event_id, $arr_evcfg_forma_cobranca );


						$lista_de_coreografias['coreografias'][$xx]['CODIGO'] = (int)$row['corgf_id'];
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco->getResult();
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco;
						
						$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco['lista'];
						$lista_de_coreografias['coreografias'][$xx]['valores_totais_por_participantes'] = $query_elenco['valores_totais'];


						$valor_total_por_coreografia = ($valor_coreografia + $query_elenco['valores_totais']);
						$lista_de_coreografias['coreografias'][$xx]['valor_total_coreografia'] = $valor_total_por_coreografia;
						$xx++;
					}
					//print_debug( $lista_de_coreografias );
					//exit();

					$this->data['lista_de_coreografias'] = $lista_de_coreografias;
					$this->data['rs_corgf_cadastradas'] = $query_corgf_cadastradas; //->getResult();
				}
		}
	
		return view('inscricoes/doacoes', $this->data);
	}

	public function pagamento( $grp_hashkey = "" )
	{
		if( !session()->get('isLoggedInUserInscricao') == TRUE ){
			return $this->response->redirect( site_url('inscricoes/error') );
		}
		$user_id = (int)session()->get('inscUser_id');


		/*
		 * -------------------------------------------------------------
		 * Informações referente ao grupo e evento
		 * -------------------------------------------------------------
		**/
		$this->grpMD->from('tbl_grupos As GRP', true)
			->select('GRP.*')
			->select('EVENT.*')
			//->select('GREVT.grevt_id, GREVT.event_id')
			->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
			->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
			->where('GRP.user_id', $user_id)
			->where('GRP.grp_hashkey', $grp_hashkey)
			->orderBy('GREVT.grevt_id', 'DESC')
			->limit(1);
		$query_grupo_evt = $this->grpMD->get();
		if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
		{
			$rs_grupo_evt = $query_grupo_evt->getRow();
			$this->data['rs_event'] = $rs_grupo_evt;

			$insti_id = (int)$rs_grupo_evt->insti_id;
			$event_id = (int)$rs_grupo_evt->event_id;
			$grp_id = (int)$rs_grupo_evt->grp_id;
			$grp_titulo = $rs_grupo_evt->grp_titulo;


			/*
			 * -------------------------------------------------------------
			 * Tipo de Configurações para Cobranca
			 * -------------------------------------------------------------
			**/
				$this->evcobMD->select('*');
				$this->evcobMD->where('event_id', $event_id);
				$this->evcobMD->orderBy('event_id', 'DESC');
				$this->evcobMD->limit(1);
				$query_event_cobr = $this->evcobMD->get();
				if( $query_event_cobr && $query_event_cobr->resultID->num_rows >=1 )
				{
					$rs_event_cobr = $query_event_cobr->getRow();
					$this->data['rs_event_cobr'] = $rs_event_cobr;

					$evcob_tipo_cobranca = $rs_event_cobr->evcob_tipo_cobranca;
					if( $evcob_tipo_cobranca == "mercado_pago" ){
						/*
						 * -------------------------------------------------------------
						 * novo pedido
						 * -------------------------------------------------------------
						**/	
							$valor_total = 2.00;
							$cupom_desconto = 0;
							$cupom_percentual = 0;
							$total_desconto = 0;

							$pedidos_itens = [];

							$arr_temp = (object) array(
								//"tvlrid" => $key,
								//"tarftitulo" => $tarf_titulo,
								//"tvlrquant" => $quantidade,
								//"tvlrvalor" => $tvlr_valor,
								//"tvlrsubtotal" => $sub_total,
							);
							array_push($pedidos_itens, $arr_temp);

							$ped_hashkey = md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16));
							$data_cadastro = [
								'grevt_id' => 0,
								'user_id' => $user_id,
								'ped_hashkey' => $ped_hashkey,
								'ped_nome' => '',
								'ped_email' => '',
								'ped_payment' => 'mercado-pago',
								'ped_json' => json_encode($pedidos_itens),
								'ped_valor_total' => $valor_total,
								'ped_valor_percent' => $cupom_percentual,
								'ped_valor_desconto' => $total_desconto,
								'ped_cupom_codigo' => $cupom_desconto,
								'ped_cupom_cortesia' => 0,
								'ped_liberado' => 1,
								'ped_dte_liberado' => date("Y-m-d H:i:s"),
								'ped_dte_cadastro' => date("Y-m-d H:i:s"),
								'ped_dte_alteracao' => date("Y-m-d H:i:s"),
								'ped_ativo' => 1,
							];
							//print_r( $data_cadastro );
							//exit();
							$ped_id = (int)$this->pedMD->insert($data_cadastro);
					}
				}


			/*
			 * -------------------------------------------------------------
			 * Configurações do Evento
			 * -------------------------------------------------------------
			**/
				$this->evcfgMD->select('*');
				$this->evcfgMD->where('event_id', $event_id);
				$this->evcfgMD->orderBy('event_id', 'DESC');
				$this->evcfgMD->limit(1);
				$query_event_config = $this->evcfgMD->get();
				if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
				{
					$rs_event_config = $query_event_config->getRow();
					$this->data['rs_event_config'] = $rs_event_config;


					$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
					$arr_evcfg_forma_cobranca = json_decode( $evcfg_forma_cobranca );
					if( !is_array($arr_evcfg_forma_cobranca) ){ $arr_evcfg_forma_cobranca = []; }
					//$arr_forma_cobranca = isset( $evcfg_forma_cobranca_json[] )

					/*
					 * -------------------------------------------------------------
					 * Informações sobre valores
					 * -------------------------------------------------------------
						Array
						(
							[0] => por_coreografia
							[1] => por_participante
						)
					**/
						if (in_array("por_coreografia", $arr_evcfg_forma_cobranca)) {
							// valores por_coreografia
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
							{
								$this->data['rs_valores_por_coreografias'] = $query_event_valores;
							}
						}
						if (in_array("por_participante", $arr_evcfg_forma_cobranca)) {
							// valores por_participante
							// -----------------------------------------
							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', $event_id);
							$this->evvlrMD->where('evvlr_label', 'valores-participantes');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(200);
							$query_event_valores = $this->evvlrMD->get();
							if( $query_event_valores && $query_event_valores->resultID->num_rows >=1 )
							{
								$this->data['rs_valores_por_participantes'] = $query_event_valores;
							}
						}
				}


			$query_modalidades = $this->modlMD->select_all_by_insti_id( (int)$insti_id );
			if( $query_modalidades && $query_modalidades->resultID->num_rows >=1 )
			{
				$this->data['rs_modalidades'] = $query_modalidades;
			}

			//$query_formatos = $this->formtMD->select_all_by_insti_id( (int)$insti_id );
			$query_formatos = $this->formtMD
				->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				->where('insti_id', (int)$insti_id)
				->orderBy('formt_titulo', 'ASC')
				->get();
			if( $query_formatos && $query_formatos->resultID->num_rows >=1 )
			{
				$this->data['rs_formatos'] = $query_formatos->getResult();
			}

			$query_formatos = $this->formtMD
				->select('formt_id, formt_titulo, formt_tempo_limit, formt_max_partic')
				->where('insti_id', (int)$insti_id)
				->orderBy('formt_titulo', 'ASC')
				->get();

			$this->data['list_rs_categorias'] = [];
			$query_categorias = $this->categMD->select_all_by_insti_id( (int)$insti_id );
			if( $query_categorias && $query_categorias->resultID->num_rows >=1 )
			{
				$rs_categorias = $query_categorias->getResult();
				$this->data['rs_categorias'] = $query_categorias;

				$categorias = [];
				foreach ($rs_categorias as $row) {
					$categoria = [
						'id' => $row->categ_id,
						'titulo' => $row->categ_titulo,
						'idade_min' => (int)$row->categ_idade_min,
						'idade_max' => (int)$row->categ_idade_max,
					];
					$categorias[] = $categoria;
				}
				$this->data['list_rs_categorias'] = $categorias;
			}


			//$this->data['list_rs_func_obrig'] = [];
			//$query_func_obrig = $this->funcMD
			//	->select('func_id, func_titulo')
			//	->where('func_obrigatorio', 1)
			//	->get();
			//if( $query_func_obrig && $query_func_obrig->resultID->num_rows >=1 )
			//{
			//	$rs_func_obrig = $query_func_obrig->getResult();
			//	$this->data['list_rs_func_obrig'] = $rs_func_obrig;
			//}


			/*
			 * -------------------------------------------------------------
			 * lista de coreografias / elenco
			 * -------------------------------------------------------------
			**/
				$func_id = 3; 
				$query_coreografos = $this->partcMD
					->select('partc_id, partc_nome, partc_documento')
					->where('insti_id', (int)$insti_id)
					->where('func_id', $func_id)
					->where('grp_id', (int)$grp_id)
					->get();
				if( $query_coreografos && $query_coreografos->resultID->num_rows >= 1 )
				{
					$this->data['rs_coreografos'] = $query_coreografos->getResult();
				}



				$query_corgf_cadastradas = self::fct_coreografias_cadastradas( (int)$insti_id, (int)$grp_id, (int)$event_id );
				if( $query_corgf_cadastradas && $query_corgf_cadastradas->resultID->num_rows >= 1 )
				{
					$rs_corgf_cadastradas = $query_corgf_cadastradas->getResultArray();

					$lista_de_coreografias = [];
					$xx = 0;
					foreach ($rs_corgf_cadastradas as $row) {
						$lista_de_coreografias['coreografias'][$xx] = $row;

						/*
						 * -------------------------------------------------------------
						 * verificar o valor por coreografia
						 * -------------------------------------------------------------
						**/
						$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '0';
						if( in_array('por_coreografia', $arr_evcfg_forma_cobranca) ){
							//print_debug( 'verificar valores por coreografias' );
							$lista_de_coreografias['coreografias'][$xx]['por_coreografia'] = '1';

							$this->evvlrMD->select('*');
							$this->evvlrMD->where('event_id', (int)$event_id);
							$this->evvlrMD->where('formt_id', (int)$row['formt_id']);
							$this->evvlrMD->where('evvlr_label', 'valores-coreografias');
							$this->evvlrMD->orderBy('event_id', 'DESC');
							$this->evvlrMD->limit(1);
							$query_valor_por_formato = $this->evvlrMD->get();
							if( $query_event_valores && $query_valor_por_formato->resultID->num_rows >= 1 )
							{
								$rs_vlr_formato = $query_valor_por_formato->getRow();
								//print_debug( 'Valor por Formato' );	
								//print_debug( $rs_vlr_formato );

								if( in_array('doacao', $arr_evcfg_forma_cobranca) ){
									$lista_de_coreografias['coreografias'][$xx]['valor'] = 0;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = 0;
								}else{
									$lista_de_coreografias['coreografias'][$xx]['valor'] = $rs_vlr_formato->evvlr_valor;
									$lista_de_coreografias['coreografias'][$xx]['desconto'] = $rs_vlr_formato->evvlr_vlr_desc;
								}
							}
						}
						//$evcfg_forma_cobranca = ((isset($rs_event_config->evcfg_forma_cobranca) ? $rs_event_config->evcfg_forma_cobranca : ""));
						
						$query_elenco = self::fct_elenco_por_coreografia( (int)$row['corgf_id'], (int)$event_id, $arr_evcfg_forma_cobranca );

						$lista_de_coreografias['coreografias'][$xx]['CODIGO'] = (int)$row['corgf_id'];
						//$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco->getResult();
						$lista_de_coreografias['coreografias'][$xx]['elenco'] = $query_elenco;
						$xx++;
					}
					//print_debug( $lista_de_coreografias );
					//exit();

					$this->data['lista_de_coreografias'] = $lista_de_coreografias;
					$this->data['rs_corgf_cadastradas'] = $query_corgf_cadastradas; //->getResult();
				}
		}
	
		return view('inscricoes/pagamento', $this->data);
	}

	// CADASTRO DE RESPONSÁVEIS DE GRUPOS
	public function cadastro( $event_hashkey = "" )
	{
		if ($this->request->getPost())
		{
			$session = session();

			$prosseguir = true;
			$validation =  \Config\Services::validation();

			$user_nome = $this->request->getPost('user_nome');
			$user_sobrenome = $this->request->getPost('user_sobrenome');
			$user_email = $this->request->getPost('user_email');
			$user_senha = $this->request->getPost('user_senha');

			$all_fields_post[] = $this->request->getPost();

			/*
			 * -------------------------------------------------------------
			 * Verificamos os campos
			 * -------------------------------------------------------------
			**/
				if( $prosseguir == true ){
					$validateFields = [
						'user_nome' => [ 'label' => 'user_nome', 'rules' => 'required',
							'errors' => [
								'required' => 'Preencha corretamente {field}.',
								//'validar_cpf' => 'O {field} informado é inválido.',
							],
						],
						'user_email' => [ 'label' => 'user_email', 'rules' => 'required',
							'errors' => [
								'required' => 'Preencha corretamente {field}.',
								//'validar_cpf' => 'O {field} informado é inválido.',
							],
						],
						'user_senha' => [ 'label' => 'user_senha', 'rules' => 'required',
							'errors' => [
								'required' => 'Preencha corretamente {field}.',
								//'validar_cpf' => 'O {field} informado é inválido.',
							],
						],
					];
					$fields_valid = $validation->setRules($validateFields);
					if( $validation->withRequest($this->request)->run() === FALSE )
					{
						$error_num = 1;
						$error_msg = "Preencha corretamente os campos!";
						$error_infos[] = $validation->getErrors();
						$prosseguir = false;
					}
				}


			/*
			 * -------------------------------------------------------------
			 * Verificar se o email já está cadastrado 
			 * -------------------------------------------------------------
			**/
				if( $prosseguir == true ){
					$query_email = $this
						->userMD->where('user_email', $user_email)
						->limit(1)
						->get();
					if( $query_email && $query_email->resultID->num_rows >= 1 )
					{
						$error_num = 1;
						$error_msg = "O e-mail informado já está em uso no sistema!";
						$error_infos[] = $validation->getErrors();
						$prosseguir = false;

						session()->setFlashdata('msg_inscricoes_cadastro', 'O e-mail informado já está em uso no sistema!');
						return $this->response->redirect( site_url('inscricoes/cadastro/'. $event_hashkey) );
					}
				}


			/*
			 * -------------------------------------------------------------
			 * Todas validações ok! Gravar no banco de dados
			 * -------------------------------------------------------------
			**/
				$prosseguir_x = false;
				if( $prosseguir == true ){
					$user_ativo = 1;

					$data_db = [
						//'insti_id' => (int)$this->session_user_id,
						'user_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
						'user_urlpage' => url_title( convert_accented_characters($user_nome), '-', TRUE ),
						'user_nome' => $user_nome,
						'user_sobrenome' => $user_sobrenome,
						'user_email' => $user_email,
						'user_senha' => fct_password_hash($user_senha),
						'user_nivel' => 'inscricao',
						'user_dte_cadastro' => date("Y-m-d H:i:s"),
						'user_dte_alteracao' => date("Y-m-d H:i:s"),
						'user_ativo' => $user_ativo,
					];

					$query_user = $this->userMD->where('user_email', $user_email)->get();
					if( $query_user && $query_user->resultID->num_rows >=1 )
					{
						//unset( $data_db['user_hashkey'] );
						//unset( $data_db['user_dte_cadastro'] );
						//$qryExecute = $this->userMD->update($partc_id, $data_db);
					}else{
						$user_id = $this->userMD->insert($data_db);
					}

					/*
					 * -------------------------------------------------------------
					 * Gera Sessão
					 * -------------------------------------------------------------
					**/
						$ses_data = [
							//'cad_id' => $rs_cad->cad_id,
							//'cad_hashkey' => $rs_cad->cad_hashkey,
							//'cad_nome_completo' => $rs_cad->cad_nome_completo,
							//'cad_email' => $rs_cad->cad_email,
							//'cad_associado' => (int)$rs_cad->cad_associado,
							'isLoggedInUserInscricao' => TRUE
						];
						$session = session();
						$session->set($ses_data);

					/*
					 * -------------------------------------------------------------
					 * COOKIE
					 * -------------------------------------------------------------
					**/
						//$config = new \Config\AppSettings();
						$CFG_COOKIE_NAME = 'JAFESTON-USUARIO-GRUPO';

						$cookieValue = json_encode($ses_data); // valor a ser armazenado no cookie;
						//$cookieExpiration = 3600; // Tempo em segundos (aqui, 1 hora)
						$cookieExpiration = 30 * 24 * 60 * 60; // 30 dias em segundos

						$cookie = [
							'name'   => $CFG_COOKIE_NAME,
							'value'  => $cookieValue,
							'expire' => $cookieExpiration,
							'secure' => FALSE
						];
						set_cookie($cookie);



					return $this->response->redirect( site_url('inscricoes/'. $event_hashkey) );














					$this->cadMD->where('cad_email', $cad_email);
					//$this->cadMD->where('cad_senha', fct_password_hash($cad_senha));
					$this->cadMD->limit(1);
					$query_cad = $this->cadMD->get();
					if( $query_cad && $query_cad->resultID->num_rows >= 1 )
					{
						$rs_cad = $query_cad->getRow();

						/*
						 * -------------------------------------------------------------
						 * Gera Sessão
						 * -------------------------------------------------------------
						**/
							$ses_data = [
								'cad_id' => $rs_cad->cad_id,
								'cad_hashkey' => $rs_cad->cad_hashkey,
								'cad_nome_completo' => $rs_cad->cad_nome_completo,
								'cad_email' => $rs_cad->cad_email,
								'cad_associado' => (int)$rs_cad->cad_associado,
								'isLoggedInFrontEnd' => TRUE
							];
							$session = session();
							$session->set($ses_data);

						/*
						 * -------------------------------------------------------------
						 * COOKIE
						 * -------------------------------------------------------------
						**/
							$config = new \Config\AppSettings();
							$CFG_COOKIE_NAME = $config->CFG_COOKIE_NAME;

							$cookieValue = json_encode($ses_data); // valor a ser armazenado no cookie;
							//$cookieExpiration = 3600; // Tempo em segundos (aqui, 1 hora)
							$cookieExpiration = 30 * 24 * 60 * 60; // 30 dias em segundos

							$cookie = [
								'name'   => $CFG_COOKIE_NAME,
								'value'  => $cookieValue,
								'expire' => $cookieExpiration,
								'secure' => FALSE
							];
							set_cookie($cookie);

						return $this->response->redirect( site_url('dashboard') );
					}else{
						$redirect = site_url('login/?error');
					}
				}else{
					return $this->response->redirect( site_url('inscricoes/cadastro/'. $event_hashkey) );	
				}

			exit();
		}



		$this->eventMD->select('*');
		$this->eventMD->where('event_hashkey', $event_hashkey);
		$this->eventMD->orderBy('event_id', 'DESC');
		$this->eventMD->limit(1);
		$query_event = $this->eventMD->get();
		//$query_grupos = $this->grpMD->select_all_by_insti_id();
		if( $query_event && $query_event->resultID->num_rows >=1 )
		{
			$rs_event = $query_event->getRow();
			$this->data['rs_event'] = $rs_event;



			// aqui iremos obter informações do evento para filtrar algumas informações
			$this->grpMD->select('*');
			$this->grpMD->where('insti_id', (int)$rs_event->insti_id);
			//$this->grpMD->where('insti_id', (int)$this->session_user_id);
			$this->grpMD->orderBy('grp_id', 'DESC');
			$this->grpMD->limit(1000);
			$query_grupos = $this->grpMD->get();
			//$query_grupos = $this->grpMD->select_all_by_insti_id();
			if( $query_grupos && $query_grupos->resultID->num_rows >=1 )
			{
				$this->data['rs_grupos'] = $query_grupos;
			}

		}		

		return view('inscricoes/cadastro', $this->data);
	}

	public function login( $event_hashkey = "" )
	{
		if ($this->request->getPost())
		{
			$session = session();

			$prosseguir = true;
			$validation =  \Config\Services::validation();

			$user_email = $this->request->getPost('user_email');
			$user_senha = $this->request->getPost('user_senha');

			$all_fields_post[] = $this->request->getPost();

			/*
			 * -------------------------------------------------------------
			 * Verificamos os campos
			 * -------------------------------------------------------------
			**/
				if( $prosseguir == true ){
					$validateFields = [
						'user_email' => [ 'label' => 'user_email', 'rules' => 'required',
							'errors' => [
								'required' => 'Preencha corretamente {field}.',
								//'validar_cpf' => 'O {field} informado é inválido.',
							],
						],
						'user_senha' => [ 'label' => 'user_senha', 'rules' => 'required',
							'errors' => [
								'required' => 'Preencha corretamente {field}.',
								//'validar_cpf' => 'O {field} informado é inválido.',
							],
						],
					];
					$fields_valid = $validation->setRules($validateFields);
					if( $validation->withRequest($this->request)->run() === FALSE )
					{
						$error_num = 1;
						$error_msg = "Preencha corretamente os campos!";
						$error_infos[] = $validation->getErrors();
						$prosseguir = false;
					}
				}


			/*
			 * -------------------------------------------------------------
			 * Todas validações ok!
			 * -------------------------------------------------------------
			**/
				$prosseguir_x = false;
				if( $prosseguir == true ){
					$this->userMD->where('user_nivel', 'inscricao');
					$this->userMD->where('user_email', $user_email);
					$this->userMD->where('user_senha', fct_password_hash($user_senha));
					$this->userMD->limit(1);
					$query_user = $this->userMD->get();
					if( $query_user && $query_user->resultID->num_rows >= 1 )
					{
						$rs_user = $query_user->getRow();

						/*
						 * -------------------------------------------------------------
						 * Gera Sessão
						 * -------------------------------------------------------------
						**/
							$ses_data = [
								'inscUser_id' => $rs_user->user_id,
								'inscUser_hashkey' => $rs_user->user_hashkey,
								'inscUser_nome' => $rs_user->user_nome,
								'inscUser_email' => $rs_user->user_email,
								'isLoggedInUserInscricao' => TRUE
							];
							$session = session();
							$session->set($ses_data);

						/*
						 * -------------------------------------------------------------
						 * COOKIE
						 * -------------------------------------------------------------
						**/
							$config = new \Config\AppSettings();
							//$CFG_COOKIE_NAME = $config->CFG_COOKIE_NAME;
							$CFG_COOKIE_NAME = 'JAFESTON-USUARIO-GRUPO';

							$cookieValue = json_encode($ses_data); // valor a ser armazenado no cookie;
							//$cookieExpiration = 3600; // Tempo em segundos (aqui, 1 hora)
							$cookieExpiration = 30 * 24 * 60 * 60; // 30 dias em segundos

							$cookie = [
								'name'   => $CFG_COOKIE_NAME,
								'value'  => $cookieValue,
								'expire' => $cookieExpiration,
								'secure' => FALSE
							];
							set_cookie($cookie);


							$redirect = site_url('inscricoes/grupos/');
							if( !empty($event_hashkey) ){
								$redirect = site_url('inscricoes/grupos/'. $event_hashkey);
							}

							//print('<hr>'. $event_hashkey );
							//print('<hr>'. $redirect );
							//exit( );
							//$redirect = site_url();

						return $this->response->redirect( $redirect );
					}else{
						session()->setFlashdata('msg_inscricoes_login', 'E-mail ou senha estão incorretos!');
						return $this->response->redirect( site_url('inscricoes/login/'. $event_hashkey .'/?error') );
					}
				}else{
					return $this->response->redirect( site_url('inscricoes/login/'. $event_hashkey .'/?error') );
				}

			exit();
		}



		$this->eventMD->select('*');
		$this->eventMD->where('event_hashkey', $event_hashkey);
		$this->eventMD->orderBy('event_id', 'DESC');
		$this->eventMD->limit(1);
		$query_event = $this->eventMD->get();
		//$query_grupos = $this->grpMD->select_all_by_insti_id();
		if( $query_event && $query_event->resultID->num_rows >=1 )
		{
			$rs_event = $query_event->getRow();
			$this->data['rs_event'] = $rs_event;



			// aqui iremos obter informações do evento para filtrar algumas informações
			$this->grpMD->select('*');
			$this->grpMD->where('insti_id', (int)$rs_event->insti_id);
			//$this->grpMD->where('insti_id', (int)$this->session_user_id);
			$this->grpMD->orderBy('grp_id', 'DESC');
			$this->grpMD->limit(1000);
			$query_grupos = $this->grpMD->get();
			//$query_grupos = $this->grpMD->select_all_by_insti_id();
			if( $query_grupos && $query_grupos->resultID->num_rows >=1 )
			{
				$this->data['rs_grupos'] = $query_grupos;
			}

		}		

		$template = 'inscricoes/login';
		return view($template, $this->data);
	}

	public function logout()
	{
		$session = session();
		$session->destroy();	

		return $this->response->redirect( site_url() );
	}

	public function meus_grupos()
	{
		$this->grpMD->select('*');
		//$this->grpMD->where('insti_id', (int)$rs_event->insti_id);
		$this->grpMD->where('user_id', (int)session()->get('inscUser_id'));
		$this->grpMD->orderBy('grp_id', 'DESC');
		$this->grpMD->limit(1000);
		$query_meus_grupos = $this->grpMD->get();
		if( $query_meus_grupos && $query_meus_grupos->resultID->num_rows >=1 )
		{
			$this->data['rs_meus_grupos'] = $query_meus_grupos;
		}	

		return view('inscricoes/meus-grupos', $this->data);
	}

	public function encontrarCategoria($LISTA_CATEG = [], $idade = 0 )
	{
		if( (int)$idade > 0 ){
			foreach ($LISTA_CATEG as $categoria) {
				if ($idade >= $categoria['idade_min'] && $idade <= $categoria['idade_max']) {
					return ['id' => $categoria['id'], 'titulo' => $categoria['titulo']];
				}
			}
		}
		return '';

		/*
			let LISTA_CATEG = vue.lista_categorias;
			for (let categoria of LISTA_CATEG) {
				if (idade >= categoria.idade_min && idade <= categoria.idade_max) {
					return { id : categoria.id, titulo : categoria.titulo } ;
				}
			}
		*/

	}






	public function ajaxform( $action = "")
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$error_infos = "";

		switch ($action) {
		case "LOAD-CADASTRO-AJAX" :
			$dados_cadastro = [];

			$user_id = (int)session()->get('inscUser_id');
			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				// Recuperamos o evento selecionado
				// ---------------------------------------------------------
				$cad_cpf = $this->request->getPost('cad_cpf');

				if( !empty($cad_cpf) ){ 
					$cad_cpf = preg_replace("/[^0-9]/", "", $cad_cpf);
					$cad_cpf = str_pad($cad_cpf, 11, '0', STR_PAD_LEFT);
					$cad_cpf = fct_mask($cad_cpf, '###.###.###-##');
				}

				$this->cadMD->select('*');
				$this->cadMD->where('cad_documento', $cad_cpf);
				$this->cadMD->orderBy('cad_id', 'DESC');
				$this->cadMD->limit(1);
				$query_cadastro = $this->cadMD->get();
				if( $query_cadastro && $query_cadastro->resultID->num_rows >= 1 )
				{
					$rs_cadastro = $query_cadastro->getRow();

					$cad_nome = $rs_cadastro->cad_nome;
					$cad_nome_social = $rs_cadastro->cad_nome_social;
					$cad_email = $rs_cadastro->cad_email;
					$cad_genero = $rs_cadastro->cad_genero;
					$cad_raca = $rs_cadastro->cad_raca;
					$cad_dte_nascto = $rs_cadastro->cad_dte_nascto;
					$cad_file_foto = $rs_cadastro->cad_file_foto;
					$cad_file_doc_frente = $rs_cadastro->cad_file_doc_frente;
					$cad_file_doc_verso = $rs_cadastro->cad_file_doc_verso;

					$dados_cadastro = [
						'cad_nome' => $cad_nome,
						'cad_nome_social' => $cad_nome_social,
						'cad_email' => $cad_email,
						'cad_genero' => $cad_genero,
						'cad_raca' => $cad_raca,
						'cad_dte_nascto' => fct_formatdate($cad_dte_nascto, "d/m/Y"),
						'cad_file_foto' => $cad_file_foto,
						'cad_file_doc_frente' => $cad_file_doc_frente,
						'cad_file_doc_verso' => $cad_file_doc_verso,
					];

					$error_num = "0";
					$error_msg = "Cadastro Encontrado";
				}else{
					$error_num = "1";
					$error_msg = "CPF não encontrado";		
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				'dados' => $dados_cadastro,
			];
			print json_encode($json_arr);
			exit();

		break;
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
		case "INSCREVER-GRUPO" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				$grp_hashkey = $this->request->getPost('grp_hashkey');
				$event_hashkey = $this->request->getPost('event_hashkey');

				/*
				 * -------------------------------------------------------------
				 * verifica o ID do evento
				 * -------------------------------------------------------------
				**/
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

					/*
					 * -------------------------------------------------------------
					 * verifica o ID do grupo
					 * -------------------------------------------------------------
					**/
					$grp_hashkey = $this->request->getPost('grp_hashkey');
					$query_grupo = $this->grpMD
						->where('user_id', (int)$user_id)
						->where('grp_hashkey', $grp_hashkey)
						->limit(1)
						->get();
					if( $query_grupo && $query_grupo->resultID->num_rows >= 1 )
					{
						$rs_grupo = $query_grupo->getRow();
						$grp_id = (int)$rs_grupo->grp_id; 

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
						$this->grevtMD->insert($data_db_grevt);
						
						$error_num = "0";
						$error_msg = "Grupo inscrito com sucesso.";
					}else{
						$error_num = "1";
						$error_msg = "Grupo inexistente.";
					}
				}else{
					$error_num = "1";
					$error_msg = "Evento inexistente.";				
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
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
				$segment_folder = [];

				$grp_hashkey = $this->request->getPost('grp_hashkey');
				$event_hashkey = $this->request->getPost('event_hashkey');
				$participantes_json = $this->request->getPost('participantes_json');

				/*
				 * -------------------------------------------------------------
				 * recuperar diretórios
				 * -------------------------------------------------------------
				**/
					$this->grpMD->from('tbl_grupos As GRP', true)
						->select('GRP.grp_urlpage')
						->select('EVENT.event_urlpage')
						->select('INSTI.insti_urlpage')
						->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'INNER')
						->join('tbl_eventos EVENT', 'EVENT.event_id = GRPEVT.event_id', 'INNER')
						->join('tbl_instituicoes INSTI', 'INSTI.insti_id = GRP.insti_id', 'INNER')
						->where('GRP.grp_hashkey', $grp_hashkey)
						->where('EVENT.event_hashkey', $event_hashkey)
						->limit(1);
					$query_folder = $this->grpMD->get();
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





						$segment_folder = [];
						$segment_folder[] = "cadastros";

						//print '<pre>';
						//print_r( $segment_folder );
						//print '</pre>';

						$path_folder_directory = implode('/', $segment_folder);

						// Sanitize the input path to prevent directory traversal attacks
						$path_folder_directory = str_replace(['..', './', '.\\', '\\'], '', $path_folder_directory);
						$args_folder = [ 
							'area' => 'all', 
							'folder' => $path_folder_directory  
						];
						$path_folder_participante = $this->libGeneric->check_folder($args_folder);
						//$this->data['path_folder_grupo'] = $path_folder_grupo;
					}

				/*
				 * -------------------------------------------------------------
				 * verificamos qual o grupo e evento que deve ser relacionado
				 * -------------------------------------------------------------
				**/
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
										'partc_email' => $val->partc_email,
										'partc_dte_nascto' => fct_date2bd($val->partc_dte_nascto),
										'partc_dte_cadastro' => date("Y-m-d H:i:s"),
										'partc_dte_alteracao' => date("Y-m-d H:i:s"),
										'partc_ativo' => 1,
									];

									// FOTO / AVATAR DO PARTICIPANTE
									$partc_file_foto = "";
									$args_file = [ 
										'file_name' => 'fileInputLogotipo', 
										'prefixo' => 'participante', 
										'folder' => $path_folder_participante
									];
									$fileInputLogotipo = $this->libGeneric->upload_file_unico( $args_file );
									if( !empty($fileInputLogotipo) ){ 
										$data_participante_db['partc_file_foto'] = $fileInputLogotipo;
										$partc_file_foto = $fileInputLogotipo;
									}

									// FOTO DOCUMENTO FRENTE
									$partc_file_doc_frente = "";
									$args_file = [ 
										'file_name' => 'fileInputDocFrente', 
										'prefixo' => 'doc_frente', 
										'folder' => $path_folder_participante
									];
									$fileInputDocFrente = $this->libGeneric->upload_file_unico( $args_file );
									if( !empty($fileInputDocFrente) ){ 
										$data_participante_db['partc_file_doc_frente'] = $fileInputDocFrente;
										$partc_file_doc_frente = $fileInputDocFrente;
									} 

									// FOTO DOCUMENTO VERSO
									$partc_file_doc_verso = "";
									$args_file = [ 
										'file_name' => 'fileInputDocVerso', 
										'prefixo' => 'doc_verso', 
										'folder' => $path_folder_participante
									];
									$fileInputDocVerso = $this->libGeneric->upload_file_unico( $args_file );
									if( !empty($fileInputDocVerso) ){ 
										$data_participante_db['partc_file_doc_verso'] = $fileInputDocVerso;
										$partc_file_doc_verso = $fileInputDocVerso;
									} 

									//$imgLogotipo = "";
									//$fileInputLogotipo = $this->request->getFile('fileInputLogotipo');
									//if( $fileInputLogotipo ){
									//	if ($fileInputLogotipo->isValid() && ! $fileInputLogotipo->hasMoved()){
									//		$cpf_limpo = url_title( convert_accented_characters($val->partc_documento), '', TRUE );
									//		$newName = $fileInputLogotipo->getRandomName();
									//		//$ext = $fileInputLogotipo->guessExtension();
									//		$imgLogotipo = 'participante_'. $cpf_limpo .'.'. $fileInputLogotipo->guessExtension();
									//		$fileInputLogotipo->move( WRITEPATH ."/uploads/participantes/", $imgLogotipo);
									//		$data_participante_db['partc_file_foto'] = $imgLogotipo;
									//	}
									//}

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

										/*
										 * -------------------------------------------------------------
										 * Cadastro do Usuarios na tabela global
										 * -------------------------------------------------------------
										**/
											$cad_cpf = $val->partc_documento;
											if( !empty($cad_cpf) ){ 
												$cad_cpf = preg_replace("/[^0-9]/", "", $cad_cpf);
												$cad_cpf = str_pad($cad_cpf, 11, '0', STR_PAD_LEFT);
												$cad_cpf = fct_mask($cad_cpf, '###.###.###-##');
											}
											
											$this->cadMD->select('*');
											$this->cadMD->where('cad_documento', $cad_cpf);
											$this->cadMD->orderBy('cad_id', 'DESC');
											$this->cadMD->limit(1);
											$query_cadastro = $this->cadMD->get();
											if( $query_cadastro && $query_cadastro->resultID->num_rows == 0 )
											{
												$data_cadastro = [
													'cad_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
													'cad_urlpage' => url_title( convert_accented_characters($val->partc_nome), '-', TRUE ),
													'cad_nome' => $val->partc_nome,
													'cad_nome_social' => $val->partc_nome_social,
													'cad_genero' => $val->partc_genero,
													'cad_documento' => $cad_cpf,
													'cad_email' => $val->partc_email,
													'cad_dte_nascto' => fct_date2bd($val->partc_dte_nascto),
													'cad_file_foto' => $partc_file_foto,
													'cad_file_doc_frente' => $partc_file_doc_frente,
													'cad_file_doc_verso' => $partc_file_doc_verso,
													'cad_dte_cadastro' => date("Y-m-d H:i:s"),
													'cad_dte_alteracao' => date("Y-m-d H:i:s"),
													'cad_ativo' => 1,
												];
												$this->cadMD->insert($data_cadastro);
											}
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
				$grp_id = (int)$this->request->getPost('grp_id');
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

					$cpf_limpo = url_title( convert_accented_characters($partc_documento), '', TRUE );

					$imgLogotipo = "";
					$fileInputLogotipo = $this->request->getFile('fileInputLogotipo');
					if( $fileInputLogotipo ){
						if ($fileInputLogotipo->isValid() && ! $fileInputLogotipo->hasMoved()){
							$newName = $fileInputLogotipo->getRandomName();
							//$ext = $fileInputLogotipo->guessExtension();
							$imgLogotipo = 'participante_'. $cpf_limpo .'_avatar.'. $fileInputLogotipo->guessExtension();
							$fileInputLogotipo->move( WRITEPATH ."/uploads/participantes/", $imgLogotipo);
							$data_participante_db['partc_file_foto'] = $imgLogotipo;
						}
					}

					$imageDocFrente = "";
					$fileInputDocFrente = $this->request->getFile('fileInputDocFrente');
					if( $fileInputDocFrente ){
						if ($fileInputDocFrente->isValid() && ! $fileInputDocFrente->hasMoved()){
							$newName = $fileInputDocFrente->getRandomName();
							//$ext = $fileInputDocFrente->guessExtension();
							$imageDocFrente = 'participante_'. $cpf_limpo .'_docfrente.'. $fileInputDocFrente->guessExtension();
							$fileInputDocFrente->move( WRITEPATH ."/uploads/participantes/", $imageDocFrente);
							$data_participante_db['partc_file_doc_frente'] = $imageDocFrente;
						}
					}

					$imageDocVerso = "";
					$fileInputDocVerso = $this->request->getFile('fileInputDocVerso');
					if( $fileInputDocVerso ){
						if ($fileInputDocVerso->isValid() && ! $fileInputDocVerso->hasMoved()){
							$newName = $fileInputDocVerso->getRandomName();
							//$ext = $fileInputDocVerso->guessExtension();
							$imageDocVerso = 'participante_'. $cpf_limpo .'_docverso.'. $fileInputDocVerso->guessExtension();
							$fileInputDocVerso->move( WRITEPATH ."/uploads/participantes/", $imageDocVerso);
							$data_participante_db['partc_file_doc_verso'] = $imageDocVerso;
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

				$arr_infos = [
					'insti_id' => (int)$insti_id,
					'categ_id' => (int)$categ_id,
					'func_id' => (int)$func_id,
					'grp_id' => (int)$grp_id,
				];

				$query_participante = $this->partcMD
					->select('partc_id, partc_nome, partc_documento, partc_file_foto')
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
					$error_num = "2";
					$error_msg = "Não existe participantes relacionados a este grupo .". json_encode($arr_infos);
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

				$event_hashkey = $this->request->getPost('event_hashkey');
				$grp_hashkey = $this->request->getPost('grp_hashkey');
				$grp_id = (int)$this->request->getPost('grp_id');

				/*
				 * -------------------------------------------------------------
				 * recuperar diretórios
				 * -------------------------------------------------------------
				 // nome da coreografia
				 // musica
				**/
					$this->grpMD->from('tbl_grupos As GRP', true)
						->select('GRP.grp_urlpage')
						->select('EVENT.event_urlpage')
						->select('INSTI.insti_urlpage')
						->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'INNER')
						->join('tbl_eventos EVENT', 'EVENT.event_id = GRPEVT.event_id', 'INNER')
						->join('tbl_instituicoes INSTI', 'INSTI.insti_id = GRP.insti_id', 'INNER')
						->where('GRP.grp_hashkey', $grp_hashkey)
						->where('EVENT.event_hashkey', $event_hashkey)
						->limit(1);
					$query_folder = $this->grpMD->get();
					if( $query_folder && $query_folder->resultID->num_rows >= 1 )
					{
						$rs_folder = $query_folder->getRow();
						$segment_folder[] = 'instituicoes';
						$segment_folder[] = $rs_folder->insti_urlpage;
						$segment_folder[] = 'eventos';
						$segment_folder[] = $rs_folder->event_urlpage;
						$segment_folder[] = 'grupos';
						$segment_folder[] = $rs_folder->grp_urlpage;
						$segment_folder[] = 'coreografias';

						$path_folder_directory = implode('/', $segment_folder);

						// Sanitize the input path to prevent directory traversal attacks
						$path_folder_directory = str_replace(['..', './', '.\\', '\\'], '', $path_folder_directory);
						$args_folder = [ 
							'area' => 'all', 
							'folder' => $path_folder_directory  
						];
						$path_folder_coreografias = $this->libGeneric->check_folder($args_folder);
					}


				// Recuperamos o evento selecionado
				// ---------------------------------------------------------
				$corgf_hashkey = $this->request->getPost('corgf_hashkey');
				$corgf_titulo = $this->request->getPost('corgf_titulo');
				$corgf_coreografo = $this->request->getPost('corgf_coreografo');
				$corgf_musica_file = '';
				$corgf_musica = $this->request->getPost('corgf_musica');
				$corgf_tempo = $this->request->getPost('corgf_tempo');
				$corgf_compositor = $this->request->getPost('corgf_compositor');
				$corgf_observacao = $this->request->getPost('corgf_observacao');
				$corgf_modl_id = (int)$this->request->getPost('corgf_modl_id');
				$corgf_formt_id = (int)$this->request->getPost('corgf_formt_id');
				$corgf_categ_id = (int)$this->request->getPost('corgf_categ_id');
				$corgf_evcfg_seletiva = $this->request->getPost('corgf_evcfg_seletiva');
				$coreografia_elenco_json = $this->request->getPost('coreografia_elenco_json');
				$coreografia_elenco_all = $this->request->getPost('coreografia_elenco_all');

				$elenco_coreografos_json = $this->request->getPost('elenco_coreografos_json');
				$elenco_bailarinos_json = $this->request->getPost('elenco_bailarinos_json');

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
						$corgf_urlpage = url_title( convert_accented_characters($corgf_titulo), '-', TRUE );
						$data_coreografia_db = [
							'insti_id' => (int)$insti_id,
							'grp_id' => (int)$grp_id,
							'modl_id' => (int)$corgf_modl_id,
							'formt_id' => (int)$corgf_formt_id,
							'categ_id' => (int)$corgf_categ_id,
							'corgf_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
							'corgf_urlpage' => $corgf_urlpage,
							'corgf_titulo' => $corgf_titulo,
							'corgf_coreografo' => $corgf_coreografo,
							//'corgf_musica_file' => $corgf_musica_file,
							'corgf_musica' => $corgf_musica,
							'corgf_tempo' => $corgf_tempo,
							'corgf_compositor' => $corgf_compositor,
							'corgf_observacao' => $corgf_observacao,
							'corgf_linkvideo' => $corgf_evcfg_seletiva,
							'corgf_dte_cadastro' => date("Y-m-d H:i:s"),
							'corgf_dte_alteracao' => date("Y-m-d H:i:s"),
							'corgf_ativo' => (int)$corgf_ativo,
						];

						$args_file = [ 
							'file_name' => 'fileInputMusica', 
							'prefixo' => 'musica', 
							'folder' => $path_folder_coreografias ."/". $corgf_urlpage .'/musica/'
						];
						$fileInputMusica = $this->libGeneric->upload_file_unico( $args_file );
						if( !empty($fileInputMusica) ){ $data_coreografia_db['corgf_musica_file'] = $fileInputMusica; } 

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
						$json_data_A = [];
						$json_data_B = [];
						if( !empty($elenco_coreografos_json) ){ $json_data_A = json_decode($elenco_coreografos_json); }
						if( !empty($elenco_bailarinos_json) ){ $json_data_B = json_decode($elenco_bailarinos_json); }
						$result_elenco_json = array_merge($json_data_A, $json_data_B);

						$args_param = [ 
							'json_data' => json_encode($result_elenco_json),
							'corgf_id' => (int)$corgf_id  
						];
						self::fct_gravar_participantes_x_coreografias( $args_param );

						//$args_param = [ 
						//	'json_data' => $elenco_bailarinos_json,
						//	'corgf_id' => (int)$corgf_id  
						//];
						//self::fct_gravar_participantes_x_coreografias( $args_param );

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
		case "EXCLUIR-GRUPO" :
			$arr_dados = [];

			$user_id = (int)session()->get('inscUser_id');
			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				$grp_hashkey = $this->request->getPost('grp_hashkey');

				$query_grupo = $this->grpMD
					->where('user_id', (int)$user_id)
					->where('grp_hashkey', $grp_hashkey)
					->limit(1)
					->get();
				if( $query_grupo && $query_grupo->resultID->num_rows >= 1 )
				{
					$rs_grupo = $query_grupo->getRow();
					$insti_id = (int)$rs_grupo->insti_id;
					$grp_id = (int)$rs_grupo->grp_id;

					$this->grpMD->where('grp_hashkey', $grp_hashkey);
					$this->grpMD->where('user_id', (int)$user_id);
					$this->grpMD->delete();

					// deletar grupo x evento
					$this->grevtMD->where('grp_id', (int)$grp_id);
					$this->grevtMD->where('insti_id', (int)$insti_id);
					$this->grevtMD->where('user_id', (int)$user_id);
					$this->grevtMD->delete();

					// deletar participantes
					$this->partcMD->where('grp_id', (int)$grp_id);
					$this->partcMD->where('insti_id', (int)$insti_id);
					$this->partcMD->where('user_id', (int)$user_id);
					$this->partcMD->delete();

					$error_num = "0";
					$error_msg = "Grupo excluído com sucesso.";
				}else{
					$error_num = "1";
					$error_msg = "Grupo inexistente.";
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
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
			$rs_elenco_coreografos = [];
			$rs_elenco_bailarinos = [];
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

					// Coreografos
					$this->partcMD->from('tbl_participantes As PARTC', true)
						->select('PARTC.partc_id, PARTC.partc_hashkey, PARTC.partc_documento, PARTC.partc_nome')
						->select('FUNC.func_titulo')
						->join('tbl_coreografias_x_participantes AS CRFPA', 'CRFPA.partc_id = PARTC.partc_id', 'INNER')
						->join('tbl_funcoes AS FUNC', 'FUNC.func_id = PARTC.func_id', 'INNER')
						->where('PARTC.func_id', 3)
						->where('CRFPA.corgf_id', (int)$rs_corf->corgf_id)
						->orderBy('CRFPA.crfpa_id', 'ASC')
						->limit(200);
					$query_elenco_coreografos = $this->partcMD->get();
					//print $this->partcMD->getLastQuery();
					if( $query_elenco_coreografos && $query_elenco_coreografos->resultID->num_rows >= 1 )
					{
						$rs_elenco = $query_elenco_coreografos->getResult();
						foreach ($rs_elenco as $row) {
							$arr_temp_corf = [
								'partc_id' => $row->partc_id,
								'partc_hashkey' => $row->partc_hashkey,
								'partc_documento' => $row->partc_documento,
								'partc_nome' => $row->partc_nome,
								'func_titulo' => $row->func_titulo
							];
							array_push($rs_elenco_coreografos, $arr_temp_corf);
							array_push($rs_elenco_selecionado, $arr_temp_corf);
						}
					}
					
					// Bailarinos
					$this->partcMD->from('tbl_participantes As PARTC', true)
						->select('PARTC.partc_id, PARTC.partc_hashkey, PARTC.partc_documento, PARTC.partc_nome')
						->select('FUNC.func_titulo')
						->join('tbl_coreografias_x_participantes AS CRFPA', 'CRFPA.partc_id = PARTC.partc_id', 'INNER')
						->join('tbl_funcoes AS FUNC', 'FUNC.func_id = PARTC.func_id', 'INNER')
						->where('PARTC.func_id', 4)
						->where('CRFPA.corgf_id', (int)$rs_corf->corgf_id)
						->orderBy('CRFPA.crfpa_id', 'ASC')
						->limit(200);
					$query_elenco_bailarinos = $this->partcMD->get();
					if( $query_elenco_bailarinos && $query_elenco_bailarinos->resultID->num_rows >= 1 )
					{
						$rs_elenco = $query_elenco_bailarinos->getResult();
						foreach ($rs_elenco as $row) {
							$arr_temp = [
								'partc_id' => $row->partc_id,
								'partc_hashkey' => $row->partc_hashkey,
								'partc_documento' => $row->partc_documento,
								'partc_nome' => $row->partc_nome,
								'func_titulo' => $row->func_titulo
							];
							array_push($rs_elenco_bailarinos, $arr_temp);
							array_push($rs_elenco_selecionado, $arr_temp);
						}
					}

					$error_num = "0";
					$error_msg = "Coreografia carregada com sucesso.";
				}else{
					$error_num = "1";
					$error_msg = "Coreografia inexistente.";
				}
			}

			$json_arr = [
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"dados" => $rs_corf,
				"elenco_coreografos" => $rs_elenco_coreografos,
				"elenco_bailarinos" => $rs_elenco_bailarinos,
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
		}
	}


	public function fct_gravar_participantes_x_coreografias( $args = [] ){
		$json_data = (isset($args['json_data']) ? $args['json_data'] : '');
		$corgf_id = (int)(isset($args['corgf_id']) ? $args['corgf_id'] : '');

		if( !empty( $json_data ) ){

			$retorno[] = 'tem elenco';
			
			// Excluir participantes relacionados
			//$this->crfpaMD
			//	//->where('insti_id', (int)$insti_id)
			//	->where('corgf_id', (int)$corgf_id)
			//	->delete();

			$this->crfpaMD->set('crfpaativo', 0);
			$this->crfpaMD->where('corgf_id', (int)$corgf_id);
			$this->crfpaMD->update();

			$lista_elenco_json = json_decode($json_data);
			foreach ($lista_elenco_json as $key => $val) {
				$partc_id = (int)$val;
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
	}

	public function fct_gravar_participantes_x_coreografias_BACKUP( $args = [] ){
		$json_data = (isset($args['json_data']) ? $args['json_data'] : '');
		$corgf_id = (int)(isset($args['corgf_id']) ? $args['corgf_id'] : '');

		if( !empty( $json_data ) ){

			$retorno[] = 'tem elenco';
			
			// Excluir participantes relacionados
			//$this->crfpaMD
			//	//->where('insti_id', (int)$insti_id)
			//	->where('corgf_id', (int)$corgf_id)
			//	->delete();

			$this->crfpaMD->set('crfpaativo', 0);
			$this->crfpaMD->where('corgf_id', (int)$corgf_id);
			$this->crfpaMD->update();

			$lista_elenco_json = json_decode($json_data);
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
				//$this->crfpaMD
				//	->where('corgf_id', (int)$corgf_id)
				//	->where('crfpaativo', 0)
				//	->delete();
			}
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
