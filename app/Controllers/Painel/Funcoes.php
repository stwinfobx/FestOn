<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Funcoes extends PainelController
{
	protected $funcMD = null;

    public function __construct()
    {
        $this->funcMD = new \App\Models\FuncoesModel();

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


		$this->funcMD->orderBy('func_id', 'DESC')
			->limit(1000);
		$query = $this->funcMD->get();

		$this->data['lastQuery'] = $this->funcMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/funcoes', $this->data);
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

		return view('grupos', $this->data);
	}


	public function form( $func_id = 0  )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"func_titulo" => [
					"label" => "Título", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$func_titulo = $this->request->getPost('func_titulo');
				$func_obrigatorio = $this->request->getPost('func_obrigatorio');
				$func_ativo = $this->request->getPost('func_ativo');
				$data_db = [
					'func_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'func_urlpage' => url_title( convert_accented_characters($func_titulo), '-', TRUE ),
					'func_titulo' => $func_titulo,
					'func_obrigatorio' => (int)$func_obrigatorio,
					'func_dte_cadastro' => date("Y-m-d H:i:s"),
					'func_dte_alteracao' => date("Y-m-d H:i:s"),
					'func_ativo' => (int)$func_ativo,
				];

				$queryEdit = $this->funcMD->where('func_id', $func_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['func_hashkey'] );
					unset( $data_db['func_dte_cadastro'] );
					if( empty($func_senha) ){ unset( $data_db['func_senha'] ); }
					$qryExecute = $this->funcMD->update($func_id, $data_db);
				}else{
					$func_id = $this->funcMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('funcoes') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->funcMD->where('func_id', $func_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}

		return view($this->directory .'/funcoes-form', $this->data);
	}

}
