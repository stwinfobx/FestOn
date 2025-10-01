<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Cadastros extends BaseController
{
	
	protected $instiMD = null;
	protected $cfg = null;

    public function __construct()
    {
		$this->instiMD = new \App\Models\InstituicoesModel();

		$this->cfg = new \Config\AppSettings();
		$this->data['cfg'] = $this->cfg;

		$this->data['menu_active'] = 'cadastros';

		helper('form');
		helper('text');
    }

	public function index()
	{
		return view('cadastro', $this->data);
	}

	public function ajaxform( $action = "")
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$error_infos = "";

		switch ($action) {
		case "CADASTRAR-INSTITUICAO" :
			$arr_dados = [];

			if ($this->request->getPost())
			{
				//$all_fields_post[] = $this->request->getPost();
				//print '<pre>';
				//print_r( $all_fields_post );
				//print '</pre>';

				//$all_fields_files[] = $this->request->getFiles();
				//print '<pre>';
				//print_r( $all_fields_files );
				//print '</pre>';
				//return false;

				$prosseguir = true;
				$validation =  \Config\Services::validation();

				$all_fields_post[] = $this->request->getPost();
				$all_fields_files[] = $this->request->getFiles();

				$insti_nome = $this->request->getPost('insti_nome');
				$insti_cnpj = $this->request->getPost('insti_cnpj');
				$insti_email = $this->request->getPost('insti_email');
				$insti_telefone = $this->request->getPost('insti_telefone');
				$insti_celular = $this->request->getPost('insti_celular');
				$insti_whatsapp = $this->request->getPost('insti_whatsapp');
				$insti_senha = $this->request->getPost('insti_senha');

				$insti_resp_nome = $this->request->getPost('insti_resp_nome');
				$insti_resp_cpf = $this->request->getPost('insti_resp_cpf');

				$insti_end_cep = $this->request->getPost('insti_end_cep');
				$insti_end_logradouro = $this->request->getPost('insti_end_logradouro');
				$insti_end_numero = $this->request->getPost('insti_end_numero');
				$insti_end_compl = $this->request->getPost('insti_end_compl');
				$insti_end_bairro = $this->request->getPost('insti_end_bairro');
				$insti_end_cidade = $this->request->getPost('insti_end_cidade');
				$insti_end_estado = $this->request->getPost('insti_end_estado');


				if( $prosseguir == true ){
					$validateFields = [
						"insti_nome" => [
							"label" => "Título", 
							"rules" => "required",
							'errors' => [
								'required' => 'Preencha corretamente',
							],
						],
						"insti_email" => [
							"label" => "E-mail", 
							"rules" => "required",
							'errors' => [
								'required' => 'Preencha corretamente',
							],
						],
					];
					$fields_valid = $validation->setRules($validateFields);
					if( $validation->withRequest($this->request)->run() === FALSE )
					{
						$prosseguir = false;
					}
				}

				/*
				 * -------------------------------------------------------------
				 * Verificar se o email já está cadastrado 
				 * -------------------------------------------------------------
				**/
					if( $prosseguir == true ){
						$query_insti_email = $this
							->instiMD->where('insti_email', $insti_email)
							->limit(1)
							->get();
						if( $query_insti_email && $query_insti_email->resultID->num_rows >= 1 )
						{
							$error_num = 1;
							$error_msg = "O e-mail informado já está em uso no sistema!";
							$prosseguir = false;
						}
					}

				/*
				 * -------------------------------------------------------------
				 * Verificar se o CNPJ já está cadastrado 
				 * -------------------------------------------------------------
				**/
					if( $prosseguir == true ){
						$query_insti_cnpj = $this
							->instiMD->where('insti_cnpj', $insti_cnpj)
							->limit(1)
							->get();
						if( $query_insti_cnpj && $query_insti_cnpj->resultID->num_rows >= 1 )
						{
							$error_num = 1;
							$error_msg = "O CNPJ informado já está em uso no sistema!";
							$prosseguir = false;
						}
					}
				
				if( $prosseguir == true ){
					if( !empty($insti_resp_cpf) ){ 
						$insti_resp_cpf = preg_replace("/[^0-9]/", "", $insti_resp_cpf);
						$insti_resp_cpf = str_pad($insti_resp_cpf, 11, '0', STR_PAD_LEFT);
						$insti_resp_cpf = fct_mask($insti_resp_cpf, '###.###.###-##');
					}
					if( !empty($insti_cnpj) ){ 
						$insti_cnpj = preg_replace("/[^0-9]/", "", $insti_cnpj);
						$insti_cnpj = str_pad($insti_cnpj, 14, '0', STR_PAD_LEFT);
						$insti_cnpj = fct_mask($insti_cnpj, '##.###.###/####-##');
					}

					$insti_urlpage = url_title( convert_accented_characters($insti_nome), '-', TRUE );

					$data_db = [
						'insti_hashkey' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
						'insti_urlpage' => $insti_urlpage,
						'insti_nome' => $insti_nome,
						'insti_cnpj' => $insti_cnpj,
						'insti_email' => $insti_email,
						'insti_telefone' => $insti_telefone,
						'insti_celular' => $insti_celular,
						'insti_whatsapp' => $insti_whatsapp,
						'insti_senha' => fct_password_hash($insti_senha),

						'insti_resp_nome' => $insti_resp_nome,
						'insti_resp_cpf' => $insti_resp_cpf,

						'insti_end_cep' => $insti_end_cep,
						'insti_end_logradouro' => $insti_end_logradouro,
						'insti_end_numero' => $insti_end_numero,
						'insti_end_compl' => $insti_end_compl,
						'insti_end_bairro' => $insti_end_bairro,
						'insti_end_cidade' => $insti_end_cidade,
						'insti_end_estado' => $insti_end_estado,

						'insti_dte_cadastro' => date("Y-m-d H:i:s"),
						'insti_dte_alteracao' => date("Y-m-d H:i:s"),
						'insti_ativo' => 1,
					];

					// verificar diretório para guardar a documentacao
					// -------------------------------------------------------
					// guardar na pasta instituicoes / nome da instituicao / insti_urlpage / documentacao
					$path_diretorio = self::check_folder_instituicao( $insti_urlpage ) ."/documentacao/";

					$args_file = [ 'file_name' => 'fileInputLogotipo', 'prefixo' => 'logotipo', 'folder' => $path_diretorio ];
					$fileInputLogotipo = self::upload_file_unico( $args_file );
					if( !empty($fileInputLogotipo) ){ $data_db['insti_logotipo'] = $fileInputLogotipo; } 

					$args_file = [ 'file_name' => 'fileInputCartaoCNPJ', 'prefixo' => 'cartao_cnpj', 'folder' => $path_diretorio ];
					$fileInputCartaoCNPJ = self::upload_file_unico( $args_file );
					if( !empty($fileInputCartaoCNPJ) ){ $data_db['insti_file_cartao_cnpj'] = $fileInputCartaoCNPJ; } 

					$args_file = [ 'file_name' => 'fileInputContrSocial', 'prefixo' => 'contr_social', 'folder' => $path_diretorio ];
					$fileInputContrSocial = self::upload_file_unico( $args_file );
					if( !empty($fileInputContrSocial) ){ $data_db['insti_file_contr_social'] = $fileInputContrSocial; } 

					$args_file = [ 'file_name' => 'fileInputDocRG', 'prefixo' => 'doc_rg', 'folder' => $path_diretorio ];
					$fileInputDocRG = self::upload_file_unico( $args_file );
					if( !empty($fileInputDocRG) ){ $data_db['insti_file_doc_rg'] = $fileInputDocRG; } 

					$args_file = [ 'file_name' => 'fileInputDocCPF', 'prefixo' => 'doc_cpf', 'folder' => $path_diretorio ];
					$fileInputDocCPF = self::upload_file_unico( $args_file );
					if( !empty($fileInputDocCPF) ){ $data_db['insti_file_doc_cpf'] = $fileInputDocCPF; } 

					$insti_id = $this->instiMD->insert($data_db);

					//$queryEdit = $this->instiMD->where('insti_id', $insti_id)->get();
					//if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
					//{
					//	unset( $data_db['insti_hashkey'] );
					//	unset( $data_db['insti_dte_cadastro'] );
					//	if( empty($insti_senha) ){ unset( $data_db['insti_senha'] ); }
					//	$qryExecute = $this->instiMD->update($insti_id, $data_db);
					//}

					$error_num = "0";
					$error_msg = "Cadastro efetuado com sucess.";
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
			$grp_id = 0;
			$grp_hashkey = '';

			if ($this->request->getPost())
			{
				$prosseguir = true;
				$validation =  \Config\Services::validation();

				// Recuperamos o evento selecionado
				// ---------------------------------------------------------
				$event_hashkey = $this->request->getPost('event_hashkey');
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
					$event_id = (int)$rs_event->event_id; 

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
		}
	}

	public function upload_file_unico( $args = [] ){
		$fileName = (isset($args['file_name']) ? $args['file_name'] : '');
		$prefixo = (isset($args['prefixo']) ? $args['prefixo'] : '');
		$folder = (isset($args['folder']) ? $args['folder'] : '');

		if (!is_dir($folder)) {  $folder = WRITEPATH ."/uploads/". $folder ."/"; }

		$imageName = "";
		$fileInput = $this->request->getFile($fileName);
		if( $fileInput ){
			if ($fileInput->isValid() && ! $fileInput->hasMoved()){
				//$ext = $fileInput->guessExtension();
				$imageName = $prefixo .'_'. $fileInput->getRandomName();
				//$imgAssinatura1 = 'assinatura_foto.'. $fileInput->guessExtension();
				$fileInput->move( $folder, $imageName);
			}
		}
		return $imageName;
	}

	public function check_folder_instituicao( $insti_urlpage = "" )
	{
		// pasta principal com nome da instituicao
		$path_folder = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage;
		if (!is_dir($path_folder)) { 
			mkdir($path_folder, 0777, TRUE);
		}
		// documentacoa
		$path_folder_doc = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage ."/documentacao/";
		if (!is_dir($path_folder_doc)) {
			mkdir($path_folder_doc, 0777, TRUE);
		}
		return $path_folder;
	}

}
