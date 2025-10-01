<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Grupos extends PainelController
{
	protected $grpMD = null;

    public function __construct()
    {
        $this->grpMD = new \App\Models\GruposModel();

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


		$this->grpMD
			->where('insti_id', (int)$this->session_user_id)
			->orderBy('grp_id', 'DESC')
			->limit(1000);
		$query = $this->grpMD->get();

		$this->data['lastQuery'] = $this->grpMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/grupos', $this->data);
	}


	public function form( $grp_id = 0  )
	{
		$segment_folder = [];

		/*
		 * -------------------------------------------------------------
		 * recuperar diretórios
		 * -------------------------------------------------------------
		**/
			$this->grpMD->from('tbl_grupos GRP', true)
				->select('GRP.grp_urlpage')
				->select('EVENT.event_urlpage')
				->select('INSTI.insti_urlpage')
				->select('EVENT.event_urlpage')
				->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'INNER')
				->join('tbl_eventos EVENT', 'EVENT.event_id = GRPEVT.event_id', 'INNER')
				->join('tbl_instituicoes INSTI', 'INSTI.insti_id = GRP.insti_id', 'INNER')				
				//->where('PARTC.insti_id', (int)$this->session_user_id)
				//->where('GRP.grp_hashkey', $_grp_hashkey)
				->where('GRP.grp_id', (int)$grp_id)
				->orderBy('GRP.grp_id', 'DESC')
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

				//print '<pre>';
				//print_r( $segment_folder );
				//print '</pre>';

				$path_folder_grupo_string = implode('/', $segment_folder);

				// Sanitize the input path to prevent directory traversal attacks
				//$path = str_replace(['..', './', '.\\', '\\'], '', $path);
				$path_folder_grupo_string = str_replace(['..', './', '.\\', '\\'], '', $path_folder_grupo_string);
				$args_folder = [ 
					'area' => 'all', 
					'folder' => $path_folder_grupo_string  
				];
				$path_folder_grupo = $this->libGeneric->check_folder($args_folder);

				$this->data['path_folder_directory'] = $path_folder_grupo_string;
			}

		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"grp_titulo" => [
					"label" => "Título", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$grp_titulo = $this->request->getPost('grp_titulo');
				$grp_responsavel = $this->request->getPost('grp_responsavel');
				$grp_telefone = $this->request->getPost('grp_telefone');
				$grp_celular = $this->request->getPost('grp_celular');
				$grp_whatsapp = $this->request->getPost('grp_whatsapp');
				$grp_cpf = $this->request->getPost('grp_cpf');
				$grp_email = $this->request->getPost('grp_email');
				$grp_senha = $this->request->getPost('grp_senha');

				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'grp_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'grp_urlpage' => url_title( convert_accented_characters($grp_titulo), '-', TRUE ),
					'grp_titulo' => $grp_titulo,
					'grp_responsavel' => $grp_responsavel,
					'grp_telefone' => $grp_telefone,
					'grp_celular' => $grp_celular,
					'grp_whatsapp' => $grp_whatsapp,
					'grp_cpf' => $grp_cpf,
					'grp_email' => $grp_email,
					'grp_senha' => fct_password_hash($grp_senha),
					'grp_dte_cadastro' => date("Y-m-d H:i:s"),
					'grp_dte_alteracao' => date("Y-m-d H:i:s"),
					'grp_ativo' => 1,
				];

				/*
				 * -------------------------------------------------------------
				 * verificar diretório para guardar a documentacao
				 * -------------------------------------------------------------
				**/
					$args_file = [ 'file_name' => 'fileInputLogotipo', 'prefixo' => 'logomarca', 'folder' => $path_folder_grupo ];
					$fileInputLogotipo = $this->libGeneric->upload_file_unico( $args_file );
					if( !empty($fileInputLogotipo) ){ $data_db['grp_logotipo'] = $fileInputLogotipo; } 


				$queryEdit = $this->grpMD->where('grp_id', $grp_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['grp_hashkey'] );
					unset( $data_db['grp_dte_cadastro'] );
					$this->grpMD->set($data_db);
					$this->grpMD->where('grp_id', $grp_id);
					$this->grpMD->update();
				}else{
					$grp_id = $this->grpMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('grupos') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->grpMD->where('grp_id', $grp_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}

		return view($this->directory .'/grupos-form', $this->data);
	}

}
