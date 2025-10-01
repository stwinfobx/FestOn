<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Clientes extends PainelController
{
	
	protected $userMD = null;
	protected $clieMD = null;
	protected $link_list = null;
	protected $link_form = null;
	protected $link_excel = null;

    public function __construct()
    {
        $this->userMD = new \App\Models\UsuarioModel();
		$this->clieMD = new \App\Models\ClientesModel();

		$this->link_list = painel_url('clientes');
		$this->link_form = painel_url('clientes/form');
		$this->link_excel = painel_url('clientes/excel');
		
		$this->data['link_list'] = $this->link_list;
		$this->data['link_form'] = $this->link_form;
		$this->data['link_excel'] = $this->link_excel;

		helper('form');

		$this->data['menu_active'] = 'clientes';
    }

	public function index()
	{
		if ($this->request->getPost())
		{

		}

		$query = $this->clieMD
			->where('del', '0')
			->orderBy('id', 'DESC')
			->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/clientes', $this->data);
	}


	public function form( $id = "" )
	{
		$id = (int)$id;

		$fields_post = [];
		$error_infos = [];
		if ($this->request->getPost())
		{
			$nome = $this->request->getPost('nome');
			$email = $this->request->getPost('email');
			$cpf_cnpj = $this->request->getPost('cpf_cnpj');
			$endereco = $this->request->getPost('endereco');
			$numero = $this->request->getPost('numero');
			$bairro = $this->request->getPost('bairro');
			$cep = $this->request->getPost('cep');
			$cidade = $this->request->getPost('cidade');
			$estado = $this->request->getPost('estado');
			$telefones = $this->request->getPost('telefones');

			$data_db = [
				'nome' => ($nome),
				'email' => ($email),
				'cpf_cnpj' => ($cpf_cnpj),
				'endereco' => ($endereco),
				'numero' => ($numero),
				'bairro' => ($bairro),
				'cep' => ($cep),
				'cidade' => ($cidade),
				'estado' => ($estado),
				'telefones' => ($telefones),
				//'del' => 1,
			];
			$query = $this->clieMD
				->where('id', $id)
				->limit(1)
				->get();	
			if( $query && $query->resultID->num_rows >= 1 ){
				$this->clieMD->set($data_db);
				$this->clieMD->where('id', $id);
				$this->clieMD->update();
			}else{
				$this->clieMD->set($data_db);
				$id = $this->clieMD->insert();
			}

			return $this->response->redirect( $this->link_list );
			exit();
		}


		$query = $this->clieMD
			->where('id', $id)
			->limit(1)
			->get();	
		if( $query && $query->resultID->num_rows >= 1 ){
			$rs_edit = $query->getRow();
			$this->data['rs_edit'] = $rs_edit;
		}

		return view($this->directory .'/clientes-form', $this->data);
	}


	public function view( $id = "" )
	{
		$id = (int)$id;

		$fields_post = [];
		$error_infos = [];


		$query = $this->clieMD
			->where('id', $id)
			->limit(1)
			->get();	
		if( $query && $query->resultID->num_rows >= 1 ){
			$rs_edit = $query->getRow();
			$this->data['rs_edit'] = $rs_edit;
		}

		return view($this->directory .'/clientes-view', $this->data);
	}


	public function ajaxform( $action = "")
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";

		switch ($action) {
		case "list-default" :
			$arr_dados = [];

			//`id` INT(11) NOT NULL AUTO_INCREMENT,
			//` nome ` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` cpf_cnpj ` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` endereco ` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` numero ` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` bairro ` VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` cep ` VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` cidade ` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` estado ` VARCHAR(2) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` email ` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			//` telefones ` VARCHAR(100) NOT NULL COLLATE 'utf8_unicode_ci',
			//` del` INT(1) NOT NULL DEFAULT '0',

			$query = $this->clieMD->orderBy('id', 'DESC')->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_list = $query;
				foreach ($rs_list->getResult() as $row) {
					$id = ($row->id);
					$nome = ($row->nome);
					$telefones = ($row->telefones);
					$cpf_cnpj = ($row->cpf_cnpj);
					$email = ($row->email);

					$link_form = painel_url('clientes/form/'. $id);

					$arr_dados_temp = [
						$id,
						$nome,
						$telefones,
						$cpf_cnpj,
						$email,
						'<div class="d-flex justify-content-center"><div style="margin: 0 3px;"><a href="'. $link_form .'" class="btn btn-sm btn-primary"><i class="las la-pen font-16"></i></a></div><div style="margin: 0 3px;"><a href="" class="btn btn-sm btn-danger"><i class="las la-trash font-16"></i></a></div></div>'
					];
					array_push($arr_dados, $arr_dados_temp);
				}
			}

			$arr_json = [
				'data' => $arr_dados 	
			];
			$html = json_encode($arr_json);

			print $html;

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

}
