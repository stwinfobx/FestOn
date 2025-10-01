<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;
use CodeIgniter\HTTP\URI;

use Dompdf\Dompdf;
use Dompdf\Options;

class Pedidos extends PainelController
{
	protected $vendMD = null;
	protected $vItemMD = null;
	protected $clieMD = null;
	protected $userMD = null;
	protected $statMD = null;

	protected $link_list = null;
	protected $link_form = null;
	protected $link_excel = null;

    public function __construct()
    {
        $this->vendMD = new \App\Models\VendaModel();
		$this->vItemMD = new \App\Models\VendaItensModel();
		$this->clieMD = new \App\Models\ClientesModel();
		$this->userMD = new \App\Models\UsuarioModel();
		$this->statMD = new \App\Models\StatusModel();

		$this->link_list = painel_url('pedidos');
		$this->link_form = painel_url('pedidos/form');
		$this->link_excel = painel_url('pedidos/excel');
		
		$this->data['link_list'] = $this->link_list;
		$this->data['link_form'] = $this->link_form;
		$this->data['link_excel'] = $this->link_excel;

		helper('form');
		helper('text');
		//helper('security');

		$this->data['menu_active'] = 'pedidos';
    }

	public function index_old()
	{
		//$query = $this->prodMD->orderBy('id', 'DESC')->get();
		//if( $query && $query->resultID->num_rows >=1 )
		//{
		//	$this->data['rs_list'] = $query;
		//}

		/*
			SELECT VEND.id, VEND.data_cobranca, SUM(VI.valor) AS vlrTotal
			FROM venda AS VEND
			JOIN venda_itens AS VI ON VEND.id = VI.venda_id
			GROUP BY VEND.id, VEND.data_cobranca
			LIMIT 200		
		*/

		//$uri    = $request->uri;
		//$result = $uri->getQuery();


		// $this->request->getPost('pedidoid');
		// $this->request->getGet('bsc_usuario');

		$uri = service('uri'); // Obter a instância do objeto URI

		//$bsc_usuario = $uri->getSegment('bsc_usuario');
		//$bsc_usuario = $uri->getQuery('bsc_usuario');
		$bsc_usuario = $this->request->getGet('bsc_usuario');
		


		//$this->data['bsc_usuario'] = 'u: '. $this->request->getGet('bsc_usuario');
		$this->data['bsc_usuario'] = 'u: '. $bsc_usuario;


		$query = $this->vendMD->from('venda As VEND', true)
			->select('VEND.*')
			->select('STA.status')
			->select('CLI.nome')
			->select('USER.nome as userNome')
			->selectSum('VITEM.valor', 'vlrTotal')
			->selectCount('VITEM.venda_id', 'qtdItens')
			//->select('0 As vlrTotal')
			//->select(" (SELECT SUM(valor) FROM venda_itens WHERE venda_id = VEND.id) as vlrTotal ")
			->join('venda_itens VITEM', 'VITEM.venda_id = VEND.id', 'INNER')
			->join('status STA', 'STA.id = VEND.status_id', 'LEFT')
			->join('cliente CLI', 'CLI.id = VEND.cliente_id', 'LEFT')
			->join('usuario USER', 'USER.id = VEND.usuario_id', 'LEFT')
			->groupBy('VEND.id')
			->orderBy('VEND.id', 'DESC')
			->limit(1000)
			->get();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			//$rs_list = $query;
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


		$query_cliente = $this->clieMD
			->select('*')
			->where('del', 0)
			->get();
		if( $query_cliente && $query_cliente->resultID->num_rows >=1 )
		{
			$this->data['rs_cliente'] = $query_cliente->getResult();
		}

		return view('pedidos', $this->data);
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

		//print '<pre>';
		//print_r( $filteredSegments );
		//print '</pre>';
		//exit();

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
		$this->data['linkGerarPDF'] = painel_url( 'pedidos/filtro_pdf'. $filtro_pdf );

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

		$this->vendMD->where('VEND.del', '0');

		if( $this->session_user_permissao == '2'){
			$this->vendMD->where('VEND.usuario_id', $this->session_user_id);	
		};

		$bsc_vendedor = (isset($rs_filtros->vendedor) ? $rs_filtros->vendedor : '');
		$bsc_cliente = (isset($rs_filtros->cliente) ? $rs_filtros->cliente : '');
		$bsc_data_inicial = (isset($rs_filtros->data_inicial) ? $rs_filtros->data_inicial : '');
		$bsc_data_final = (isset($rs_filtros->data_final) ? $rs_filtros->data_final : '');
		$bsc_status = (isset($rs_filtros->status) ? $rs_filtros->status : '');

		if( !empty($bsc_vendedor) )			{ $this->vendMD->where('USER.id', $bsc_vendedor); }
		if( !empty($bsc_cliente) )			{ $this->vendMD->where('CLI.id', $bsc_cliente); }
		if( !empty($bsc_status) )			{ $this->vendMD->where('STA.id', $bsc_status); }
		//if( !empty($bsc_data_inicial) )		{ $this->vendMD->where('VEND.data >=', fct_date2bd($bsc_data_inicial)); }
		//if( !empty($bsc_data_final) )		{ $this->vendMD->where('VEND.data <=', fct_date2bd($bsc_data_final)); }
		if( !empty($bsc_data_inicial) )		{ $this->vendMD->where('VEND.data >=', ($bsc_data_inicial)); }
		if( !empty($bsc_data_final) )		{ $this->vendMD->where('VEND.data <=', ($bsc_data_final)); }

		$this->vendMD->groupBy('VEND.id')
			->orderBy('VEND.id', 'DESC')
			->limit(1000);
		$query = $this->vendMD->get();

		//$this->data['lastQuery'] = $this->vendMD->getLastQuery();
			//->getCompiledSelect();

		if( $query && $query->resultID->num_rows >=1 )
		{
			//$rs_list = $query;
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

		return view($this->directory .'/pedidos', $this->data);
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

		return view($this->directory .'/pedidos-form', $this->data);
	}

	public function detalhes( $id = "" )
	{
		$id = (int)$id;

		$fields_post = [];
		$error_infos = [];
		if ($this->request->getPost())
		{
		}

		//$queryPedido = $this->vendMD
		//	->where('id', $id)
		//	->limit(1)
		//	->get();

		$queryPedido = $this->vendMD->from('venda As VEND', true)
			->select('VEND.*')
			->select('STA.status')
			->select('CLI.nome As cli_nome')
			->select('CLI.cpf_cnpj As cli_cpf_cnpj')
			->select('CLI.email As cli_email')
			->select('CLI.telefones As cli_telefone')
			->select('USER.nome as user_nome')
			->select('USER.celular as user_telefone')
			->select('USER.email as user_email')
			->join('status STA', 'STA.id = VEND.status_id', 'LEFT')
			->join('cliente CLI', 'CLI.id = VEND.cliente_id', 'LEFT')
			->join('usuario USER', 'USER.id = VEND.usuario_id', 'LEFT')
			->where('VEND.id', $id)
			->orderBy('VEND.id', 'DESC')
			->limit(1)
			->get();

		if( $queryPedido && $queryPedido->resultID->num_rows >= 1 ){
			$rs_pedido = $queryPedido->getRow();
			$this->data['rs_pedido'] = $rs_pedido;


			$queryItens = $this->vItemMD->from('venda_itens As VITEM', true)
				->select('VITEM.*')
				->select('PROD.descricao As prod_descricao')
				->join('produto PROD', 'PROD.id = VITEM.produto_id', 'LEFT')
				->where('VITEM.venda_id', (int)$rs_pedido->id)
				->orderBy('VITEM.venda_id', 'ASC')
				->get();

			//print '<h2>'. $queryItens->resultID->num_rows .'</h2>';
			$this->data['rs_itens_num_rows'] = $queryItens->resultID->num_rows;
			if( $queryItens && $queryItens->resultID->num_rows >= 1 ){
				//$rs_itens = $queryItens->getResult();
				$this->data['rs_itens'] = $queryItens;
			}

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

		return view('pedidos-detalhes', $this->data);
	}

	public function gerar_pdf($id = "")
	{
		$id = (int)$id;

		$namefile = "undefined";

		$queryPedido = $this->vendMD->from('venda As VEND', true)
			->select('VEND.*')
			->select('STA.status')
			->select('CLI.nome As cli_nome')
			->select('CLI.cpf_cnpj As cli_cpf_cnpj')
			->select('CLI.email As cli_email')
			->select('CLI.telefones As cli_telefone')
			->select('CLI.endereco As cli_endereco')
			->select('CLI.numero As cli_numero')
			->select('CLI.cep As cli_cep')
			->select('CLI.cidade As cli_cidade')
			->select('CLI.estado As cli_estado')
			->select('USER.nome as user_nome')
			->select('USER.celular as user_telefone')
			->select('USER.email as user_email')
			->join('status STA', 'STA.id = VEND.status_id', 'LEFT')
			->join('cliente CLI', 'CLI.id = VEND.cliente_id', 'LEFT')
			->join('usuario USER', 'USER.id = VEND.usuario_id', 'LEFT')
			->where('VEND.id', $id)
			->orderBy('VEND.id', 'DESC')
			->limit(1)
			->get();

		if( $queryPedido && $queryPedido->resultID->num_rows >=1 )
		{
			$rs_pedido = $queryPedido->getRow();
			
			$pedido_id = (int)$rs_pedido->id;

			$cli_nome = $rs_pedido->cli_nome;
			$cli_email = $rs_pedido->cli_email;
			$cli_telefone = $rs_pedido->cli_telefone;
			$cli_endereco = $rs_pedido->cli_endereco;
			$cli_numero = $rs_pedido->cli_numero;
			$cli_cep = $rs_pedido->cli_cep;
			$cli_cidade = $rs_pedido->cli_cidade;
			$cli_estado = $rs_pedido->cli_estado;

			$cli_endereco_completo = $cli_endereco . 
				(!empty($cli_numero) ? ', '. $cli_numero : '') .
				(!empty($cli_cep) ? ' - cep: '. $cli_cep : '') .
				(!empty($cli_cidade) ? ' - '. $cli_cidade : '') .
				(!empty($cli_estado) ? ' / '. $cli_estado : '');

			$user_nome = $rs_pedido->user_nome;
			$status = $rs_pedido->status;
			$data_cobranca = $rs_pedido->data_cobranca;

			$total = 0;
			$html_itens = '';
			$queryItens = $this->vItemMD->from('venda_itens As VITEM', true)
				->select('VITEM.*')
				->select('PROD.descricao As prod_descricao')
				->join('produto PROD', 'PROD.id = VITEM.produto_id', 'LEFT')
				->where('VITEM.venda_id', $pedido_id)
				->orderBy('VITEM.venda_id', 'ASC')
				->get();
			if( $queryItens && $queryItens->resultID->num_rows >= 1 ){
				$rs_itens = $queryItens->getResult();

				foreach ($rs_itens as $row) {
					$prod_descricao = ($row->prod_descricao);
					$qtd = ($row->qtd);
					$valor = ($row->valor);
					$subtotal = (($row->valor) * ($qtd)) ;
					$total = $total + $subtotal;

					$html_itens .= '
						<tr>
							<td>'. $prod_descricao .'</td>
							<td style="text-align:right;">R$ '. number_format($valor, 2, ',', '.') .' x '. $qtd .'</td>
							<td style="text-align:right;">R$ '. number_format($subtotal, 2, ',', '.') .'</td>
						</tr>
					';
				}
			}

			$namefile = 'pedido-numero-'. url_title( convert_accented_characters($pedido_id), '-', TRUE );

			$html = '
				<style>
					@page{ margin: 30px 0 70px 0; }
					body {
						background-size: 100%;
						background-repeat: no-repeat;
						font-size: 18px;
						font-family: \'Helvetica\';
						page-break-inside: unset;
					}
					p{ 
						font-family: \'Helvetica\';
						margin: 0;
						padding: 0;
					}
					h1{
						font-family: \'Helvetica\';
						font-size: 25px;
						font-weight: 800;
						text-align: center;
						margin: 0; 
						padding: 0;
						padding-bottom: 10px;
						line-height: 1;
					}
					h2{
						font-family: \'Helvetica\';
						font-size: 20px;
						font-weight: 600;
						text-align: center;
						margin: 0; 
						padding: 0;
						padding-bottom: 10px;
						line-height: 1;
					}
					.label{ font-size: 13px; color: gray; }
					.mSpace{ margin: 13px 0; }
					.container{
						position:relative;
						margin: 0 auto; 
						text-align: left;
						width: 90%;  
					}
					.central {
						position: relative;
						width: 100%; 
						page-break-inside: unset;
					}
					table { page-break-inside: unset; }
					.tbl td { padding: 4px; vertical-align: top; }
					.tbl-int td { padding: 0; vertical-align: top; }

					table.itens { page-break-inside: unset; border-collapse: collapse; border: 0px solid black; }
					table.tbl.itens td { padding: 8px; vertical-align: top; border-collapse: collapse; border-top: 1px dashed rgb(206, 206, 206); }
				</style>

				<div class="container">
					<div class="central">

						<div style="margin-bottom: 20px; border-bottom: 1px solid gray;">
							<h1>Relatório do Pedido <strong>#'. $pedido_id .'</strong></h1>
						</div>

						<table class="tbl" style="width: 100%;">
							<tr>
								<td style="width: 100%;" >
									<div><span class="label">Cliente:</span> '. $cli_nome .'</div>
								</td>
							</tr>
							<tr>
								<td style="width: 100%;" >
									<div><span class="label">Endereço:</span> '. $cli_endereco_completo  .'</div>
								</td>
							</tr>
							<tr>
								<td style="width: 100%;" >
									<div><span class="label">Telefone:</span> '. $cli_telefone .'</div>
								</td>
							</tr>
							<tr>
								<td style="width: 100%;" >
									<div><span class="label">E-mail:</span> '. $cli_email .'</div>
								</td>
							</tr>
							<tr>
								<td style="width: 100%;" >
									<div><span class="label">Vendedor:</span> '. $user_nome .'</div>
								</td>
							</tr>
							<tr>
								<td style="width: 100%;" >
									<div><span class="label">Status:</span> '. $status .'</div>
								</td>
							</tr>
							<tr>
								<td style="width: 100%;" >
									<div><span class="label">Data de Cobrança:</span> '. $data_cobranca .'</div>
								</td>
							</tr>
						</table>

						<div style="margin-top: 20px;">
							<h2>Itens do Pedido</h2>
						</div>
						<table class="tbl itens" style="width: 100%;">
							<tr>
								<td><strong>Item</strong></td>
								<td style="width: 22%; text-align:right;"><strong>Valor Unit/Qtd</strong></td>
								<td style="width: 22%; text-align:right;"><strong>Valor</strong></td>
							</tr>
							'. $html_itens .'
							<tr>
								<td colspan="2" style="text-align:right;"><strong>Total</strong></td>
								<td style="width: 22%; text-align:right;"><strong>R$ '. number_format($total, 2, ',', '.') .'</strong></td>
							</tr>
						</table>

					</div>
				</div>';

			$options = new Options();
			$options->setIsRemoteEnabled(true);
			$options->set('defaultFont', 'Helvetica');

			$dompdf = new Dompdf($options);
			$dompdf->loadHtml($html);
			$dompdf->setPaper('a4', 'portrait');
			$dompdf->render();

			//$path_file = WRITEPATH ."/uploads/". $namefile .'.pdf';
			$path_file = $namefile .'.pdf';

			// Abrir no Navegador
			$dompdf->stream( $path_file, array("compress" => 0, "Attachment" => 0 ));
			
			// Download
			//$dompdf->stream( $path_file, array("Attachment" => 1));
			//$dompdf->stream();

			//file_put_contents($this->folderFotos . $namefile .'.pdf', $dompdf->output());
			exit();
		}else{
			return false;
		}
	}

	public function filtro_pdf()
	{
		// -------------------------------------------------------------------------------
		// exemplo de uso:
		// filtro_pdf/user:marcio/cliente:123/dini:/dteend:/status:pago

		$uri = service('uri'); // Obter a instância do objeto URI
		$segments = $uri->getSegments();
		$index = array_search('filtro_pdf', $segments); // Encontrar o índice do segmento "filtro_pdf"

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
			}
		}

		$this->vendMD->from('venda As VEND', true)
			->select('VEND.*')
			->select('STA.status')
			->select('CLI.nome As clie_nome')
			->select('CLI.endereco As cli_endereco')
			->select('CLI.numero As cli_numero')
			->select('CLI.bairro As cli_bairro')
			->select('CLI.cep As cli_cep')
			->select('CLI.cidade As cli_cidade')
			->select('CLI.estado As cli_estado')
			->select('USER.nome as userNome')
			//->selectSum('( VITEM.valor * VITEM.qtd )', 'vlrTotal')
			->selectSum('( VITEM.valor * VITEM.qtd )', 'vlrTotal')
			->selectCount('VITEM.venda_id', 'qtdItens')
			//->select('0 As vlrTotal')
			//->select(" (SELECT SUM(valor) FROM venda_itens WHERE venda_id = VEND.id) as vlrTotal ")
			->join('venda_itens VITEM', 'VITEM.venda_id = VEND.id', 'INNER')
			->join('status STA', 'STA.id = VEND.status_id', 'LEFT')
			->join('cliente CLI', 'CLI.id = VEND.cliente_id', 'LEFT')
			->join('usuario USER', 'USER.id = VEND.usuario_id', 'LEFT');

		$this->vendMD->where('VEND.del', '0');

		if( $this->session_user_permissao == '2'){
			$this->vendMD->where('VEND.usuario_id', $this->session_user_id);	
		};

		$bsc_vendedor = (isset($rs_filtros->vendedor) ? $rs_filtros->vendedor : '');
		$bsc_cliente = (isset($rs_filtros->cliente) ? $rs_filtros->cliente : '');
		$bsc_data_inicial = (isset($rs_filtros->data_inicial) ? $rs_filtros->data_inicial : '');
		$bsc_data_final = (isset($rs_filtros->data_final) ? $rs_filtros->data_final : '');
		$bsc_status = (isset($rs_filtros->status) ? $rs_filtros->status : '');

		if( !empty($bsc_vendedor) )			{ $this->vendMD->where('USER.id', $bsc_vendedor); }
		if( !empty($bsc_cliente) )			{ $this->vendMD->where('CLI.id', $bsc_cliente); }
		if( !empty($bsc_status) )			{ $this->vendMD->where('STA.id', $bsc_status); }
		//if( !empty($bsc_data_inicial) )		{ $this->vendMD->where('VEND.data >=', fct_date2bd($bsc_data_inicial)); }
		//if( !empty($bsc_data_final) )		{ $this->vendMD->where('VEND.data <=', fct_date2bd($bsc_data_final)); }
		if( !empty($bsc_data_inicial) )		{ $this->vendMD->where('VEND.data >=', ($bsc_data_inicial)); }
		if( !empty($bsc_data_final) )		{ $this->vendMD->where('VEND.data <=', ($bsc_data_final)); }

		$this->vendMD->groupBy('VEND.id')
			->orderBy('VEND.id', 'DESC')
			->limit(1000);
		$query = $this->vendMD->get();


		$html_itens = '';
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_list_venda = $query->getResult();
			foreach ($rs_list_venda as $row) {
				$vlrTotal = ($row->vlrTotal);
				$qtdItens = ($row->qtdItens);
				$data_cobranca = ($row->data_cobranca);
				$status = ($row->status);

				$clie_nome = ($row->clie_nome);
				$cli_endereco = ($row->cli_endereco);
				$cli_numero = ($row->cli_numero);
				$cli_bairro = ($row->cli_bairro);
				$cli_cep = ($row->cli_cep);
				$cli_cidade = ($row->cli_cidade);
				$cli_estado = ($row->cli_estado);

				$cli_endereco_completo = $cli_endereco . 
					(!empty($cli_numero) ? ', '. $cli_numero : '') .
					(!empty($cli_bairro) ? ' - '. $cli_bairro : '') .
					(!empty($cli_cep) ? ' - cep: '. $cli_cep : '') .
					(!empty($cli_cidade) ? ' - '. $cli_cidade : '') .
					(!empty($cli_estado) ? ' / '. $cli_estado : '');

				$html_itens .= '
					<tr>
						<td>
							<div>'. $clie_nome .'</div>
							<div class="txt_end">'. $cli_endereco_completo .'</div>
						</td>
						<td style="text-align:center;">R$ '. number_format($vlrTotal, 2, ',', '.') .'</td>
						<td style="text-align:center;">'. ($qtdItens) .'</td>
						<td style="text-align:center;">'. fct_formatdate($data_cobranca, 'd/m/Y') .'</td>
						<td style="text-align:center;">'. ($status) .'</td>
					</tr>
				';
			}

			$namefile = 'relatorio-de-pedidos';

			$html = '
				<style>
					@page{ margin: 30px 0 70px 0; }
					body {
						background-size: 100%;
						background-repeat: no-repeat;
						font-size: 14px;
						font-family: \'Helvetica\';
						page-break-inside: unset;
					}
					p{ 
						font-family: \'Helvetica\';
						margin: 0;
						padding: 0;
					}
					h1{
						font-family: \'Helvetica\';
						font-size: 25px;
						font-weight: 800;
						text-align: center;
						margin: 0; 
						padding: 0;
						padding-bottom: 10px;
						line-height: 1;
					}
					h2{
						font-family: \'Helvetica\';
						font-size: 20px;
						font-weight: 600;
						text-align: center;
						margin: 0; 
						padding: 0;
						padding-bottom: 10px;
						line-height: 1;
					}
					.label{ font-size: 13px; color: gray; }
					.mSpace{ margin: 13px 0; }
					.container{
						position:relative;
						margin: 0 auto; 
						text-align: left;
						width: 93%;  
					}
					.central {
						position: relative;
						width: 100%; 
						page-break-inside: unset;
					}
					table { page-break-inside: unset; }
					.tbl td { padding: 4px; vertical-align: top; }
					.tbl-int td { padding: 0; vertical-align: top; }

					table.itens { page-break-inside: unset; border-collapse: collapse; border: 0px solid black; }
					table.tbl.itens td { padding: 8px; vertical-align: top; border-collapse: collapse; border-top: 1px dashed rgb(206, 206, 206); }

					.txt_end{
						padding: 3px 0;
						font-size: 12px;
						color: #5d5d5d;
					}
				</style>

				<div class="container">
					<div class="central">

						<div style="margin-bottom: 20px;">
							<h1>Relatório de pedidos</h1>
						</div>

						<table class="tbl itens" style="width: 100%;">
							<tr>
								<td><strong>Cliente / Endereço</strong></td>
								<td style="width: 13%; text-align:center;"><strong>Valor total</strong></td>
								<td style="width: 7%; text-align:center;"><strong>Itens</strong></td>
								<td style="width: 11%; text-align:center;"><strong>Vencimento</strong></td>
								<td style="width: 18%; text-align:center;"><strong>Status</strong></td>
							</tr>
							'. $html_itens .'
						</table>

					</div>
				</div>';

			$options = new Options();
			$options->setIsRemoteEnabled(true);
			$options->set('defaultFont', 'Helvetica');

			$dompdf = new Dompdf($options);
			$dompdf->loadHtml($html);
			//$dompdf->setPaper('a4', 'portrait');
			$dompdf->setPaper('a4', 'landscape');
			$dompdf->render();

			//$path_file = WRITEPATH ."/uploads/". $namefile .'.pdf';
			$path_file = $namefile .'.pdf';

			// Abrir no Navegador
			$dompdf->stream( $path_file, array("compress" => 0, "Attachment" => 0 ));
			
			// Download
			//$dompdf->stream( $path_file, array("Attachment" => 1));
			//$dompdf->stream();

			//file_put_contents($this->folderFotos . $namefile .'.pdf', $dompdf->output());
			exit();
		}
		// -------------------------------------------------------------------------------
	}

	public function ajaxform( $action = "")
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";

		switch ($action) {
		case "LIST-DEFAULT" :
			$arr_dados = [];

			//$this->imovMD->from('tbl_imoveis As IMOV', true);
			//$this->imovMD->select('IMOV.*');

			//$query = $this->vendMD
			//	->from('venda As VEND', true)
			//	->select('VEND.*')
			//	->select(" (SELECT SUM(valor) FROM venda_itens WHERE venda_id = VEND.id) as vlrTotal ")
			//	->orderBy('id', 'DESC')
			//	->limit(500)
			//	->get();
			//	->getCompiledSelect();

			$query = $this->vendMD->from('venda As VEND', true)
				->select('VEND.*')
				->select('STA.status')
				->select('0 As vlrTotal')
				//->select(" (SELECT SUM(valor) FROM venda_itens WHERE venda_id = VEND.id) as vlrTotal ")
				->join('status STA', 'STA.id = VEND.status_id', 'LEFT')
				->orderBy('VEND.id', 'DESC')
				->limit(200)
				->get();
				//->getCompiledSelect();

			//print_r( $query );
			//exit();

			//$subQuery = $this->vItemMD
			//			   ->select('SUM(valor)')
			//			   ->where('venda_id', 2425)
			//			   ->getCompiledSelect();

			//$query = $db->table('venda')
			//			->select('*')
			//			->select('(' . $subQuery . ') AS total')
			//			->where('id', 2425)
			//			->get();

			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_list = $query;

				foreach ($rs_list->getResult() as $row) {
					$id = ($row->id);
					//$descricao = ($row->descricao);
					//$valor = ($row->valor);
					//$valor_custo = ($row->valor_custo);

					$data_cobranca = fct_formatdate($row->data_cobranca, 'd/m/Y');
					$status = ''; //$row->status;

					$nome = '';
					$valor = 'R$ '. fct_to_money($row->vlrTotal, 2, "br");
					//$detalhes = '
					//	<div>1 itens</div>
					//	<div>Venc: '. $data_cobranca .'</div>
					//	<div>'. $status .'</div> 
					//'; 

					$detalhes = '';
					//1 itens
					//Venc: 10/03/2022
					//pendente
					$venda = '<strong>obs:</strong> '. ($row->observacao);

					//<th>Nome</th>
					//<th style="width:120px;">Valor</th>
					//<th style="width:200px;">Detalhes</th>
					//<th style="width:200px;">Venda</th>

					$link_form = painel_url('pedidos/form/'. $id);

					$arr_dados_temp = [
						$id,
						$nome,
						$valor,	
						$detalhes,
						$venda,
						//'<div class="d-flex justify-content-center"><div style="margin: 0 3px;"><a href="'. $link_form .'" class="btn btn-sm btn-primary"><i class="las la-pen font-16"></i></a></div><div style="margin: 0 3px;"><a href="" class="btn btn-sm btn-danger"><i class="las la-trash font-16"></i></a></div></div>'
					];
					array_push($arr_dados, $arr_dados_temp);
				}
			}

			print '<pre>';
			print_r( $arr_dados  );
			print '</pre>';

			$arr_json = [
				'data' => $arr_dados 	
			];
			$html = json_encode($arr_json);
			print $html;
			exit();	

		break;
		case "SALVAR-OBSERVACAO" :
			
			$pedidoid = $this->request->getPost('pedidoid');
			$observacao = $this->request->getPost('observacao');

			// SALVAR-OBSERVACAO

			$queryPedido = $this->vendMD->from('venda As VEND', true)
				->select('VEND.*')
				->where('VEND.id', $pedidoid)
				->orderBy('VEND.id', 'DESC')
				->limit(1)
				->get();
			if( $queryPedido && $queryPedido->resultID->num_rows >=1 )
			{
				$rs_pedido = $queryPedido->getRow();

				$data_db = [
					'observacao' => $observacao,
				];
				$this->vendMD->set($data_db);
				$this->vendMD->where('id', $pedidoid);
				$this->vendMD->update();

				$error_num = 0;
				$error_msg = "Ação registrada com sucesso!";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
			);
			echo( json_encode($arr_return) );
			exit();

			//$arr_json = [
			//	'data' => [],
			//	'num_rows' => $queryPedido->resultID->num_rows,
			//	'pedidoid' => $pedidoid,
			//	'observacao' => $observacao
			//];
			//$html = json_encode($arr_json);
			//print $html;
			//exit();	

		break;
		case "DELETAR-REGISTRO" :

			$codigo = (int)$this->request->getPost('codigo');
			$query = $this->vendMD
				->select('*')
				->where('id', $codigo)
				->orderBy('id', 'DESC')
				->limit(1)
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_venda = $query->getRow();
				//$this->vendMD->where('id', $codigo);
				//$this->vendMD->delete();

				$data_db = [ 'del' => '1' ];
				$this->vendMD->set($data_db);
				$this->vendMD->where('id', $codigo);
				$this->vendMD->update();

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
		case "ALTERAR-STATUS" :
			$status_label = '';

			$venda_id = $this->request->getPost('venda_id');
			$queryVenda = $this->vendMD->from('venda As VEND', true)
				->select('VEND.*')
				->where('VEND.id', $venda_id)
				->orderBy('VEND.id', 'DESC')
				->limit(1)
				->get();
			if( $queryVenda && $queryVenda->resultID->num_rows >=1 )
			{
				$rs_venda = $queryVenda->getRow();

				$queryStatus = $this->statMD
					->select('id, status')
					->where('status', 'pago')
					->orderBy('id', 'DESC')
					->limit(1)
					->get();
				if( $queryStatus && $queryStatus->resultID->num_rows >=1 )
				{
					$rs_status = $queryStatus->getRow();
					$status_label = $rs_status->status;

					$data_db = [
						'status_id' => (int)$rs_status->id,
					];
					$this->vendMD->set($data_db);
					$this->vendMD->where('id', $venda_id);
					$this->vendMD->update();
				}
			}

			$arr_json = [
				'data' => [],
				'num_rows' => $queryVenda->resultID->num_rows,
				'status' => $status_label
			];
			$html = json_encode($arr_json);
			print $html;
			exit();	

		break;
		}
	}





}
