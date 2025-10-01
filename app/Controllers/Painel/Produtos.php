<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Produtos extends PainelController
{
	
	protected $userMD = null;
	protected $prodMD = null;
	protected $link_list = null;
	protected $link_form = null;
	protected $link_excel = null;

    public function __construct()
    {
        $this->userMD = new \App\Models\UsuarioModel();
		$this->prodMD = new \App\Models\ProdutoModel();

		$this->link_list = painel_url('produtos');
		$this->link_form = painel_url('produtos/form');
		$this->link_excel = painel_url('produtos/excel');
		
		$this->data['link_list'] = $this->link_list;
		$this->data['link_form'] = $this->link_form;
		$this->data['link_excel'] = $this->link_excel;

		helper('form');
		//helper('security');

		$this->data['menu_active'] = 'produtos';
    }

	public function index()
	{

		$query = $this->prodMD
			->where('del', '0')
			->orderBy('id', 'DESC')
			->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/produtos', $this->data);
	}


	public function form( $id = "" )
	{
		$id = (int)$id;

		$fields_post = [];
		$error_infos = [];
		if ($this->request->getPost())
		{
			//$validation =  \Config\Services::validation();

			//$validateFields = [
			//	'descricao' => [ 'label' => 'cpf', 'rules' => 'required',
			//		'errors' => [
			//			'required' => 'Preencha corretamente {field}.',
			//		],
			//	],
			//	//'csrf_test_name' => [ 'label' => 'csrf', 'rules' => 'validate_csrf',
			//	//	'errors' => [
			//	//		'required' => 'Preencha corretamente {field}.',
			//	//	],
			//	//],
			//];
			//$fields_valid = $validation->setRules($validateFields);
			//if( $validation->withRequest($this->request)->run() === FALSE )
			//{
			//	$error_num = 1;
			//	$error_msg = "error inválido!";
			//	$error_infos[] = $validation->getErrors();
			//	$prosseguir = false;
			
			//	print_r( $validation->getErrors() );
			//	exit();
			//}


			//$data = [
			//	'descricao'  => $this->request->getVar('descricao'),
			//];

			//if (!$this->validate([
			//	'descricao' => 'required',
			//	'csrf' => 'validate_csrf'
			//])) {
			//	return view('csrf_error');
			//}

			//if (!$model->insert($data)) {
			//	throw new \Exception("Failed to insert data.");
			//}

			
			//$fields_post[] = $this->request->getPost();


			//print_r( $this->request->getPost() ); 
			//exit(  );

			$descricao = $this->request->getPost('descricao');
			$detalhes = $this->request->getPost('detalhes');
			$valor = $this->request->getPost('valor');
			$valor_custo = $this->request->getPost('valor_custo');
			$comissao = $this->request->getPost('comissao');
			$observacao = $this->request->getPost('observacao');

			$data_db = [
				'descricao' => ($descricao),
				'detalhes' => ($detalhes),
				'valor' => ($valor),
				'valor_custo' => ($valor_custo),
				'comissao' => ($comissao),
				'observacao' => ($observacao),
				//'del' => 1,
			];
			$query = $this->prodMD
				->where('id', $id)
				->limit(1)
				->get();	
			if( $query && $query->resultID->num_rows >= 1 ){
				//unset( $data_db['senha'] );
				$this->prodMD->set($data_db);
				$this->prodMD->where('id', $id);
				$this->prodMD->update();
			}else{
				$this->prodMD->set($data_db);
				$id = $this->prodMD->insert();
			}

			return $this->response->redirect( $this->link_list );
			exit();
		}


		$query = $this->prodMD
			->where('id', $id)
			->limit(1)
			->get();	
		if( $query && $query->resultID->num_rows >= 1 ){
			$rs_edit = $query->getRow();
			$this->data['rs_edit'] = $rs_edit;
		}

		return view($this->directory .'/produtos-form', $this->data);
	}


	public function ajaxform( $action = "")
	{
		switch ($action) {
		case "list-default" :
			$arr_dados = [];

			$query = $this->prodMD->orderBy('id', 'DESC')->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_list = $query;

				foreach ($rs_list->getResult() as $row) {
					$id = ($row->id);
					$descricao = ($row->descricao);
					$valor = ($row->valor);
					$valor_custo = ($row->valor_custo);

					$link_form = painel_url('produtos/form/'. $id);

					$arr_dados_temp = [
						$id,
						$descricao,
						$valor,	
						$valor_custo,
						'<div class="d-flex justify-content-center"><div style="margin: 0 3px;"><a href="'. $link_form .'" class="btn btn-sm btn-primary"><i class="las la-pen font-16"></i></a></div><div style="margin: 0 3px;"><a href="" class="btn btn-sm btn-danger"><i class="las la-trash font-16"></i></a></div></div>'
					];
					array_push($arr_dados, $arr_dados_temp);
				}
			}

			$arr_json = [
				'data' => $arr_dados 	
			];
			$html = json_encode($arr_json);
			//print '<pre>';
			//print_r( json_encode($arr_json) );
			//print '</pre>';

			$html_2b = '{
			  "data": [
				[
				  "Tiger Nixon",
				  "System Architect",
				  "Edinburgh",
				  "5421",
				  "2011/04/25",
				  "$320,800"
				],
				[
				  "Garrett Winters",
				  "Accountant",
				  "Tokyo",
				  "8422",
				  "2011/07/25",
				  "$170,750"
				],
				[
				  "Tiger Nixon",
				  "System Architect",
				  "Edinburgh",
				  "5421",
				  "2011/04/25",
				  "$320,800"
				],
				[
				  "Garrett Winters",
				  "Accountant",
				  "Tokyo",
				  "8422",
				  "2011/07/25",
				  "$170,750"
				]
			  ]
			}';
			print $html;
		break;
		case "autocomplete" :
			$rs_produtos = [];

			$search = $this->request->getPost('search');

			$query = $this->prodMD
				->select('id, descricao, valor')
				->like('descricao', $search)
				->orderBy('descricao', 'ASC')
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_produtos = $query->getResult();
			}

			$arr_return = array(
				"produtos" => $rs_produtos,
			);
			echo( json_encode($arr_return) );
			exit();

		break;
		case "DELETAR-REGISTRO" :

			$codigo = $this->request->getPost('codigo');
			$query = $this->prodMD->from('produto As PROD', true)
				->select('PROD.*')
				->where('PROD.id', $codigo)
				->orderBy('PROD.id', 'DESC')
				->limit(1)
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();

				$data_db = [ 'del' => '1' ];
				$this->prodMD->set($data_db);
				$this->prodMD->where('id', $codigo);
				$this->prodMD->update();

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
