<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Vendedores extends PainelController
{
	
	protected $userMD = null;
	protected $prodMD = null;

    public function __construct()
    {
        $this->userMD = new \App\Models\UsuarioModel();
		$this->prodMD = new \App\Models\ProdutoModel();
    }

	public function index()
	{
		
		if ($this->request->getPost())
		{

		}

		$query = $this->userMD
			->where('del', '0')
			->orderBy('id', 'DESC')
			->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/vendedores', $this->data);
	}

	public function form()
	{
		
		if ($this->request->getPost())
		{

		}

		return view('vendedores-form', $this->data);
	}


	public function ajaxform( $action = "")
	{
		$arr_dados = [];


		$query = $this->userMD->orderBy('id', 'DESC')->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_list = $query;
			foreach ($rs_list->getResult() as $row) {
				$id = ($row->id);
				$nome = ($row->nome);
				$celular = ($row->celular);
				$email = ($row->email);

				$link_form = painel_url('usuarios/form/'. $id);

				$arr_dados_temp = [
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
	}

}
