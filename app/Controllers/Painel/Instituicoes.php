<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

use App\Libraries\GenericLib;

class Instituicoes extends PainelController
{
	protected $instiMD = null;

    public function __construct()
    {
		$this->instiMD = new \App\Models\InstituicoesModel();

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


		$this->instiMD->orderBy('insti_id', 'DESC')
			->limit(1000);
		$query = $this->instiMD->get();

		$this->data['lastQuery'] = $this->instiMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/instituicoes', $this->data);
	}


	public function filtrar_old()
	{
		$filtro_pdf = '';
		// filtrar/user:marcio/cliente:123/dini:/dteend:/status:pago

		$uri = service('uri'); // Obter a instância do objeto URI
		$segments = $uri->getSegments();
		$index = array_search('filtrar', $segments); // Encontrar o índice do segmento "filtrar"

		$filteredSegments = array_slice($segments, $index + 1); // Retornar os elementos a partir de $index + 1 até o final

		$bsc_usuario = '';
		$bsc_cliente = '';
		$bsc_dte_inicial = '';
		$bsc_dte_final = '';
		$bsc_status = '';

		// vendedor:marcio/cliente:123/data_inicial:/data_final:/status:pago
		$arr_param_filtro = ["vendedor", "cliente", "data_inicial", "data_final", "status"];
		$rs_filtros = (object)[];

		foreach ($filteredSegments as $key => $val) {
			[$tag, $value] = explode(':', $val);
			if (in_array($tag, $arr_param_filtro)) {
				$rs_filtros->{$tag} = $value; 
				$filtro_pdf .=  '/'. $tag .':'. $value;  
			}
		}
		$this->data['rs_filtros'] = $rs_filtros;
		$this->data['linkGerarPDF'] = painel_url( 'historico/filtro_pdf'. $filtro_pdf );

		$this->vendMD->from('venda As VEND', true)
			->select('VEND.*')
			->select('STA.status')
			->select('CLI.nome')
			->select('USER.nome as userNome')
			->selectSum('( VITEM.valor * VITEM.qtd )', 'vlrTotal')
			->selectCount('VITEM.venda_id', 'qtdItens')
			//->select('0 As vlrTotal')
			//->select(" (SELECT SUM(valor) FROM venda_itens WHERE venda_id = VEND.id) as vlrTotal ")
			->join('venda_itens VITEM', 'VITEM.venda_id = VEND.id', 'INNER')
			->join('status STA', 'STA.id = VEND.status_id', 'LEFT')
			->join('cliente CLI', 'CLI.id = VEND.cliente_id', 'LEFT')
			->join('usuario USER', 'USER.id = VEND.usuario_id', 'LEFT');

		if( $this->session_user_permissao == '2'){ //  vendedores
			$this->vendMD->where('VEND.usuario_id', (int)$this->session_user_id);	
		};

		$this->vendMD->where('VEND.arquivo', '0');
		//$this->vendMD->where('VEND.del', '0');

		$bsc_vendedor = (isset($rs_filtros->vendedor) ? $rs_filtros->vendedor : '');
		$bsc_cliente = (isset($rs_filtros->cliente) ? $rs_filtros->cliente : '');
		$bsc_data_inicial = (isset($rs_filtros->data_inicial) ? $rs_filtros->data_inicial : '');
		$bsc_data_final = (isset($rs_filtros->data_final) ? $rs_filtros->data_final : '');
		$bsc_status = (isset($rs_filtros->status) ? $rs_filtros->status : '');

		if( !empty($bsc_vendedor) )			{ $this->vendMD->where('USER.id', $bsc_vendedor); }
		if( !empty($bsc_cliente) )			{ $this->vendMD->where('CLI.id', $bsc_cliente); }
		if( !empty($bsc_status) )			{ $this->vendMD->where('STA.id', $bsc_status); }
		if( !empty($bsc_data_inicial) )		{ $this->vendMD->where('VEND.data >=', ($bsc_data_inicial)); }
		if( !empty($bsc_data_final) )		{ $this->vendMD->where('VEND.data <=', ($bsc_data_final)); }

		$this->vendMD->groupBy('VEND.id')
			->orderBy('VEND.id', 'DESC')
			->limit(1000);
		$query = $this->vendMD->get();

		$this->data['lastQuery'] = $this->vendMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}


		$query_status = $this->statMD
			->select('id, status')
			->where('del', 0)
			->orderBy('status', 'ASC')
			->get();
		if( $query_status && $query_status->resultID->num_rows >=1 )
		{
			$this->data['rs_status'] = $query_status->getResult();
		}

		$query_vendedor = $this->userMD
			->select('*')
			->where('del', 0)
			->get();
		if( $query_vendedor && $query_vendedor->resultID->num_rows >=1 )
		{
			$this->data['rs_vendedor'] = $query_vendedor->getResult();
		}

		$query_cliente = $this->clieMD
			->select('*')
			->where('del', 0)
			->get();
		if( $query_cliente && $query_cliente->resultID->num_rows >=1 )
		{
			$this->data['rs_cliente'] = $query_cliente->getResult();
		}

		return view($this->directory .'/participantes', $this->data);
	}


	public function form( $insti_id = 0 )
	{
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

			$validation =  \Config\Services::validation();
			$rules = [
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

			if ($this->validate($rules)) {
				$insti_nome = $this->request->getPost('insti_nome');
				$insti_cnpj = $this->request->getPost('insti_cnpj');
				$insti_email = $this->request->getPost('insti_email');
				$insti_telefone = $this->request->getPost('insti_telefone');
				$insti_celular = $this->request->getPost('insti_celular');
				$insti_whatsapp = $this->request->getPost('insti_whatsapp');
				$insti_senha = $this->request->getPost('insti_senha');

				$insti_resp_nome = $this->request->getPost('insti_resp_nome');
				$insti_resp_cpf = $this->request->getPost('insti_resp_cpf');

				$insti_redes_sociais = $this->request->getPost('insti_redes_sociais');

				$insti_end_cep = $this->request->getPost('insti_end_cep');
				$insti_end_logradouro = $this->request->getPost('insti_end_logradouro');
				$insti_end_numero = $this->request->getPost('insti_end_numero');
				$insti_end_compl = $this->request->getPost('insti_end_compl');
				$insti_end_bairro = $this->request->getPost('insti_end_bairro');
				$insti_end_cidade = $this->request->getPost('insti_end_cidade');
				$insti_end_estado = $this->request->getPost('insti_end_estado');

				$insti_urlpage_old = $this->request->getPost('insti_urlpage_old');
				$insti_urlpage = url_title( convert_accented_characters($insti_nome), '-', TRUE );

				$data_db = [
					'insti_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
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

					'insti_redes_sociais' => json_encode($insti_redes_sociais),

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


				/*
				 * -------------------------------------------------------------
				 * mudança do diretório
				 * -------------------------------------------------------------
				**/
					if( !empty($insti_urlpage_old) && $insti_urlpage_old != $insti_urlpage ){
						$path_folder_old = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage_old;
						$path_folder_new = WRITEPATH .'uploads/instituicoes/'. $insti_urlpage;
						if (is_dir($path_folder_old)) {
							if (rename($path_folder_old, $path_folder_new)) {
								//echo "O diretório foi renomeado com sucesso!";
							}
						}
					}


				/*
				 * -------------------------------------------------------------
				 * verificar diretório para guardar a documentacao
				 * -------------------------------------------------------------
				**/
					$libGeneric = new GenericLib();

					// guardar na pasta instituicoes / nome da instituicao / insti_urlpage / documentacao
					//$path_diretorio = self::check_folder_instituicao( $insti_urlpage ) ."/documentacao/";
					$path_diretorio = $libGeneric->check_folder_instituicao( $insti_urlpage ) ."/documentacao/";

					$args_file = [ 'file_name' => 'fileInputLogotipo', 'prefixo' => 'logotipo', 'folder' => $path_diretorio ];
					$fileInputLogotipo = $libGeneric->upload_file_unico( $args_file );
					//$fileInputLogotipo = self::upload_file_unico( $args_file );
					if( !empty($fileInputLogotipo) ){ $data_db['insti_logotipo'] = $fileInputLogotipo; } 

					$args_file = [ 'file_name' => 'fileInputCartaoCNPJ', 'prefixo' => 'cartao_cnpj', 'folder' => $path_diretorio ];
					$fileInputCartaoCNPJ = $libGeneric->upload_file_unico( $args_file );
					if( !empty($fileInputCartaoCNPJ) ){ $data_db['insti_file_cartao_cnpj'] = $fileInputCartaoCNPJ; } 

					$args_file = [ 'file_name' => 'fileInputContrSocial', 'prefixo' => 'contr_social', 'folder' => $path_diretorio ];
					$fileInputContrSocial = $libGeneric->upload_file_unico( $args_file );
					if( !empty($fileInputContrSocial) ){ $data_db['insti_file_contr_social'] = $fileInputContrSocial; } 

					$args_file = [ 'file_name' => 'fileInputDocRG', 'prefixo' => 'doc_rg', 'folder' => $path_diretorio ];
					$fileInputDocRG = $libGeneric->upload_file_unico( $args_file );
					if( !empty($fileInputDocRG) ){ $data_db['insti_file_doc_rg'] = $fileInputDocRG; } 

					$args_file = [ 'file_name' => 'fileInputDocCPF', 'prefixo' => 'doc_cpf', 'folder' => $path_diretorio ];
					$fileInputDocCPF = $libGeneric->upload_file_unico( $args_file );
					if( !empty($fileInputDocCPF) ){ $data_db['insti_file_doc_cpf'] = $fileInputDocCPF; } 





				$queryEdit = $this->instiMD->where('insti_id', $insti_id)->limit(1)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >= 1 )
				{
					$rs_edit = $queryEdit->getRow();
					$insti_logotipo = $rs_edit->insti_logotipo;
					$insti_file_cartao_cnpj = $rs_edit->insti_file_cartao_cnpj;
					$insti_file_contr_social = $rs_edit->insti_file_contr_social;
					$insti_file_doc_rg = $rs_edit->insti_file_doc_rg;
					$insti_file_doc_cpf = $rs_edit->insti_file_doc_cpf;

					$arr_list_files = [
						[ 'file_new' => $fileInputLogotipo, 'file_old' => $insti_logotipo, 'folder' => $path_diretorio ],
						[ 'file_new' => $fileInputCartaoCNPJ, 'file_old' => $insti_file_cartao_cnpj, 'folder' => $path_diretorio ],
						[ 'file_new' => $fileInputContrSocial, 'file_old' => $insti_file_contr_social, 'folder' => $path_diretorio ],
						[ 'file_new' => $fileInputDocRG, 'file_old' => $insti_file_doc_rg, 'folder' => $path_diretorio ],
						[ 'file_new' => $fileInputDocCPF, 'file_old' => $insti_file_doc_cpf, 'folder' => $path_diretorio ]
					];
					
					$args_file = [ 'file_new' => $fileInputLogotipo, 'file_old' => $insti_logotipo, 'folder' => $path_diretorio ];
					$libGeneric->excluir_arquivos_antigos( $arr_list_files );

					unset( $data_db['insti_hashkey'] );
					unset( $data_db['insti_dte_cadastro'] );
					if( empty($insti_senha) ){ unset( $data_db['insti_senha'] ); }
					$qryExecute = $this->instiMD->update($insti_id, $data_db);
				}else{
					$insti_id = $this->instiMD->insert($data_db);
				}


				session()->setFlashdata('msg_save', 'Ação executada com sucesso!');
				return $this->response->redirect( painel_url('instituicoes/form/'. $insti_id) );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->instiMD->where('insti_id', $insti_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}

		return view($this->directory .'/instituicoes-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$insti_hashkey = $this->request->getPost('insti_hashkey');
			$query = $this->instiMD->where('insti_hashkey', $insti_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$insti_id = (int)$rs_registro->insti_id;			

				// excluir registro
				$this->instiMD->where('insti_hashkey', $insti_hashkey)->delete();

				//$this->instiMD->set('solt_excluido', 1);
				//$this->instiMD->where('insti_hashkey', $insti_hashkey);
				//$this->instiMD->where('insti_id', $insti_id);
				//$this->instiMD->update();

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






	public function excluir_arquivos_antigos( $arr_list_files = [] ){
		foreach ($arr_list_files as $keyArq => $valArq) {
			$file_new = (isset($valArq['file_new']) ? $valArq['file_new'] : '');
			$file_old = (isset($valArq['file_old']) ? $valArq['file_old'] : '');
			$folder = (isset($valArq['folder']) ? $valArq['folder'] : '');
			if( !empty($file_new) && !empty($file_old) ){
				$path_file_new = $folder ."/". $file_new;
				$path_file_old = $folder ."/". $file_old;
				if( file_exists($path_file_old) ){	
					unlink($path_file_old);
				}
			}else{
				//print '<pre>';
				//print_r($path_file_old);
				//print '</pre>'; 
			}
		}
	}

	public function upload_file_unico( $args = [] ){
		$fileName = (isset($args['file_name']) ? $args['file_name'] : '');
		$prefixo = (isset($args['prefixo']) ? $args['prefixo'] : '');
		$folder = (isset($args['folder']) ? $args['folder'] : '');

		//if (!is_dir($folder)) {  $folder = WRITEPATH ."/uploads/". $folder ."/"; }

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
