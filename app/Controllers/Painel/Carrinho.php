<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Carrinho extends PainelController
{
	protected $userMD = null;
	protected $prodMD = null;
	protected $statMD = null;
	protected $clieMD = null;
	protected $cartMD = null;
	protected $vendMD = null;
	protected $vItemMD = null;
	protected $link_list = null;
	protected $link_form = null;
	protected $link_excel = null;

    public function __construct()
    {
        $this->userMD = new \App\Models\UsuarioModel();
		$this->prodMD = new \App\Models\ProdutoModel();
		$this->statMD = new \App\Models\StatusModel();
		$this->clieMD = new \App\Models\ClientesModel();
		$this->cartMD = new \App\Models\CarrinhoModel();
		$this->vendMD = new \App\Models\VendaModel();
		$this->vItemMD = new \App\Models\VendaItensModel();

		$this->link_list = painel_url('produtos');
		$this->link_form = painel_url('produtos/form');
		$this->link_excel = painel_url('produtos/excel');
		
		$this->data['link_list'] = $this->link_list;
		$this->data['link_form'] = $this->link_form;
		$this->data['link_excel'] = $this->link_excel;

		helper('form');

		//$session = \Config\Services::session();
		//$session = session();
		//$ses_data = [
		//	'id' => 'm3g6u604j6eqvh2bm6rda09ba9frl472',
		//];
		//$session->set($ses_data);
    }


	public function index()
	{
		
		if ($this->request->getPost())
		{

		}

		return view('carrinho', $this->data);
	}


	public function form( $cliente_id = 0)
	{
		$this->data['cliente_id'] = (int)$cliente_id;

		$query_produtos = $this->prodMD
			->select('id, descricao, valor')
			->where('del', 0)
			->orderBy('descricao', 'ASC')
			->get();
		if( $query_produtos && $query_produtos->resultID->num_rows >=1 )
		{
			$this->data['rs_produtos'] = $query_produtos->getResult();
		}

		$query_cliente = $this->clieMD
			->select('*')
			->where('del', 0)
			->where('id', $cliente_id)
			->orderBy('id', 'DESC')
			->limit(1)
			->get();
		if( $query_cliente && $query_cliente->resultID->num_rows >=1 )
		{
			$this->data['rs_cliente'] = $query_cliente->getRow();
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

		return view('carrinho-form', $this->data);
	}


	public function ajaxform( $action = "")
	{
		switch ($action) {
		case "add-produto-carrinho" :
			$produtos = $this->request->getPost('produto');

			$arr_produtos = json_decode($produtos);
			//$arr_produtos_t = json_decode($produtos, true);

			$qryInsertBatch = [];
			foreach ($arr_produtos as $key => $val) {
				//$qtdProdutos = $qtdProdutos + $val->qtd; 
				$data_fields = [
					'produto_id' => (int)$val->id,
					'qtd' => $val->quantidade,
					'valor' => (int)$val->valor,
					'session' => $this->session_id,
				];
				array_push($qryInsertBatch, $data_fields);
			}
			$this->cartMD->insertBatch($qryInsertBatch);

			$arr_return = array(
				//"list_cart_produtos" => $rs_produtos,
			);
			echo( json_encode($arr_return) );
			exit();

		break;
		case "remove-produto-carrinho" :
			$produto = $this->request->getPost('produto');
			$arr_produto = json_decode($produto);
			//$arr_produtos_t = json_decode($produtos, true);

			$qryInsertBatch = [];
			foreach ($arr_produto as $key => $val) {
				$this->cartMD
					->where('session', $this->session_id)
					->where('produto_id', $val->id)
					->delete();
			}

			$arr_return = array(
				//"list_cart_produtos" => $rs_produtos,
			);
			echo( json_encode($arr_return) );
			exit();

		break;
		case "finalizar-pedido" :
			$status_id = $this->request->getPost('status_id');
			$data_cobranca = $this->request->getPost('data_cobranca');
			$cliente_id = (int)$this->request->getPost('cliente_id');
			//$usuario_id = (int)$this->request->getPost('usuario_id');
			$observacao = $this->request->getPost('observacao');


			// Recupera os itens adicionados no carrinho
			$query = $this->cartMD
				->where('session', $this->session_id)
				->orderBy('id', 'ASC')
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				// Grava as infomações principais da venda
				$this->vendMD->set('cliente_id', $cliente_id);
				$this->vendMD->set('usuario_id', (int)$this->session_user_id);
				$this->vendMD->set('status_id', $status_id);
				$this->vendMD->set('observacao', $observacao);
				$this->vendMD->set('data_cobranca', fct_date2bd($data_cobranca));
				$this->vendMD->set('data', date("Y-m-d"));
				$this->vendMD->set('hora', date("H:i:s"));
				$this->vendMD->set('del', 0);
				$venda_id = $this->vendMD->insert();


				// Grava os produtos da venda
				$qryInsertBatch = [];
				$rs_carrinho = $query->getResult();
				foreach ($rs_carrinho as $row) {
					$data_fields = [
						'venda_id' => (int)$venda_id,
						'usuario_id' => (int)$this->session_user_id,
						'produto_id' => (int)$row->produto_id,
						'qtd' => (int)$row->qtd,
						'valor' => $row->valor,
						'del' => '0',
					];
					array_push($qryInsertBatch, $data_fields);
				}
				$this->vItemMD->insertBatch($qryInsertBatch);
			}


			// Remove itens finalizados do carrinho
			$this->cartMD
				->where('session', $this->session_id)
				->delete();


			$arr_return = array(
				//"list_cart_produtos" => $rs_produtos,
			);
			echo( json_encode($arr_return) );
			exit();

		break;
		}
	}

}
