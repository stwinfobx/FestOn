<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Dashboard extends PainelController
{
	
	protected $userMD = null;
	protected $prodMD = null;
	protected $vendMD = null;

    public function __construct()
    {
        //$this->userMD = new \App\Models\UsuarioModel();
		//$this->prodMD = new \App\Models\ProdutoModel();
		//$this->vendMD = new \App\Models\VendaModel();

		$this->data['menu_active'] = 'dashboard';
    }

	public function index()
	{
		//if( $this->session_user_permissao == '1' ){ // administradores
		//	$query_rows_users = $this->userMD->where('del', '0')->selectCount('id')->get();
		//	if( $query_rows_users && $query_rows_users->resultID->num_rows >=1 )
		//	{
		//		$rs_rows_users = $query_rows_users->getRow();
		//		$this->data['vendedores_count'] = (int)$rs_rows_users->id;
		//	}
		//}

		//$query_rows_prod = $this->prodMD
		//	->where('del', '0')
		//	->selectCount('id')->get();
		//if( $query_rows_prod && $query_rows_prod->resultID->num_rows >=1 )
		//{
		//	$rs_rows_prod = $query_rows_prod->getRow();
		//	$this->data['produtos_count'] = (int)$rs_rows_prod->id;
		//}


		//$this->vendMD->where('del', '0');
		//if( $this->session_user_permissao == '2' ){ // vendedores
		//	$this->vendMD->where('usuario_id', $this->session_user_id);
		//}
		//$this->vendMD->selectCount('id');

		//$query_rows_vend = $this->vendMD->get();
		//if( $query_rows_vend && $query_rows_vend->resultID->num_rows >=1 )
		//{
		//	$rs_rows_vend = $query_rows_vend->getRow();
		//	$this->data['pedidos_count'] = (int)$rs_rows_vend->id;
		//}


		return view($this->directory .'/dashboard', $this->data);
	}

}
