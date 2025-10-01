<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Cursos extends PainelController
{
	protected $cursoMD = null;

    public function __construct()
    {
        $this->cursoMD = new \App\Models\CursosModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'cursos';
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

		$this->cursoMD
			->where('insti_id', (int)$this->session_user_id)
			->orderBy('curso_id', 'DESC')
			->limit(1000);
		$query = $this->cursoMD->get();

		$this->data['lastQuery'] = $this->cursoMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			$this->data['rs_list'] = $query;
		}

		return view($this->directory .'/cursos', $this->data);
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

		return view('cursos', $this->data);
	}


	public function form( $curso_id = 0  )
	{
		if ($this->request->getPost())
		{
			$validation =  \Config\Services::validation();
			$rules = [
				"curso_titulo" => [
					"label" => "Título", 
					"rules" => "required",
					'errors' => [
						'required' => 'Preencha corretamente',
					],
				],
			];

			if ($this->validate($rules)) {
				$curso_titulo = $this->request->getPost('curso_titulo');
				$curso_nome_professor = $this->request->getPost('curso_nome_professor');
				$curso_local = $this->request->getPost('curso_local');
				$curso_dte_inicio = $this->request->getPost('curso_dte_inicio');
				$curso_hrs_inicio = $this->request->getPost('curso_hrs_inicio');
				$curso_dte_termino = $this->request->getPost('curso_dte_termino');
				$curso_hrs_termino = $this->request->getPost('curso_hrs_termino');
				$curso_vagas = (int)$this->request->getPost('curso_vagas');
				$curso_valor = $this->request->getPost('curso_valor');
				$curso_conteudo = $this->request->getPost('curso_conteudo');

				$data_db = [
					'insti_id' => (int)$this->session_user_id,
					'curso_hashkey' =>md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
					'curso_urlpage' => url_title( convert_accented_characters($curso_titulo), '-', TRUE ),
					'curso_titulo' => $curso_titulo,
					'curso_nome_professor' => $curso_nome_professor,
					'curso_local' => $curso_local,
					'curso_dte_inicio' => fct_date2bd($curso_dte_inicio),
					'curso_hrs_inicio' => $curso_hrs_inicio,
					'curso_dte_termino' => fct_date2bd($curso_dte_termino),
					'curso_hrs_termino' => $curso_hrs_termino,
					'curso_vagas' => $curso_vagas,
					'curso_valor' => fct_to_money($curso_valor, 2, 'bd'),
					'curso_conteudo' => $curso_conteudo,
					'curso_dte_cadastro' => date("Y-m-d H:i:s"),
					'curso_dte_alteracao' => date("Y-m-d H:i:s"),
					'curso_ativo' => 1,
				];

				$queryEdit = $this->cursoMD->where('curso_id', $curso_id)->get();
				if( $queryEdit && $queryEdit->resultID->num_rows >=1 )
				{
					unset( $data_db['curso_hashkey'] );
					unset( $data_db['curso_dte_cadastro'] );
					$qryExecute = $this->cursoMD->update($curso_id, $data_db);
				}else{
					$curso_id = $this->cursoMD->insert($data_db);
				}

				return $this->response->redirect( painel_url('cursos') );
				exit();

			} else {
				$this->data['validation'] = $validation->getErrors();
			}
		}


		$query = $this->cursoMD->where('curso_id', $curso_id)->get();
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_dados = $query->getRow();
			$this->data['rs_dados'] = $rs_dados;
		}

		return view($this->directory .'/cursos-form', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$curso_hashkey = $this->request->getPost('curso_hashkey');
			$query = $this->cursoMD->where('curso_hashkey', $curso_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$curso_id = (int)$rs_registro->curso_id;			

				// excluir registro
				$this->cursoMD->where('curso_hashkey', $curso_hashkey)->delete();

				//$this->cursoMD->set('solt_excluido', 1);
				//$this->cursoMD->where('curso_hashkey', $curso_hashkey);
				//$this->cursoMD->where('curso_id', $curso_id);
				//$this->cursoMD->update();

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

}
