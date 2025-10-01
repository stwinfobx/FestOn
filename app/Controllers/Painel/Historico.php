<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;
use CodeIgniter\HTTP\URI;

use Dompdf\Dompdf;
use Dompdf\Options;

class Historico extends PainelController
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

		$this->link_list = painel_url('historico');
		$this->link_form = painel_url('historico/form');
		$this->link_excel = painel_url('historico/excel');
		
		$this->data['link_list'] = $this->link_list;
		$this->data['link_form'] = $this->link_form;
		$this->data['link_excel'] = $this->link_excel;

		helper('form');
		helper('text');
		//helper('security');

		$this->data['menu_active'] = 'historico';
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

		return view($this->directory .'/historico', $this->data);
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
		}else{
			exit('não há registros');
		}
		// -------------------------------------------------------------------------------
	}


	public function ajaxform( $action = "")
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";

		switch ($action) {
		case "ARQUIVAR-REGISTRO" :

			$codigo = (int)$this->request->getPost('codigo');
			$query = $this->vendMD
				->select('*')
				->where('id', $codigo)
				->orderBy('id', 'DESC')
				->limit(1)
				->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				//$rs_venda = $query->getRow();
				//$this->vendMD->where('id', $codigo);
				//$this->vendMD->delete();

				$data_db = [ 'del' => '1', 'arquivo' => '1', 'arquivo2' => '1' ];
				$this->vendMD->set($data_db);
				$this->vendMD->where('id', $codigo);
				//$this->vendMD->where('usuario_id', (int)session()->get('id'));
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
		}

	}

}
