<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\View\Parser;

use App\Libraries\PHPMailerLib;

class Home extends BaseController
{
	
	protected $eventMD = null;
	protected $anuncMD = null;

    public function __construct()
    {
        $this->eventMD = new \App\Models\EventosModel();
		$this->anuncMD = new \App\Models\AnunciosModel();

		$this->data['menu_active'] = 'home';
    }

	public function index()
	{
		$query_anuncios = $this->anuncMD
			->where('anunc_file_banner !=', null)
			->orderBy('anunc_id', 'ASC')
			->limit(4)->get();
		//$this->data['lastQuery'] = $this->eventMD->getLastQuery();
		if( $query_anuncios && $query_anuncios->resultID->num_rows >=1 )
		{
			//$rs_eventos = $query_anuncios->getResult();
			$this->data['rs_anuncios'] = $query_anuncios;
		}

		$query_eventos = $this->eventMD
			->where('event_banner !=', null)
			->where('event_ativo', 1)
			->orderBy('event_id', 'DESC')
			->limit(4)->get();
		//$this->data['lastQuery'] = $this->eventMD->getLastQuery();
		if( $query_eventos && $query_eventos->resultID->num_rows >=1 )
		{
			//$rs_eventos = $query_eventos->getResult();
			$this->data['rs_eventos'] = $query_eventos;
		}


		$query_festival = $this->eventMD
			->where('event_banner !=', null)
			->where('event_ativo', 1)
			->orderBy('event_id', 'ASC')
			->limit(1)->get();
		//$this->data['lastQuery'] = $this->eventMD->getLastQuery();
		if( $query_festival && $query_festival->resultID->num_rows >=1 )
		{
			//$rs_festival = $query_festival->getResult();
			$this->data['rs_festival'] = $query_festival;
		}

		return view('index', $this->data);
	}


	public function preview( $template = "" )
	{
		return view('emails/'. $template, []);
	}
	
	public function contratos()
	{
		
		
		// vem do banco de dados		
		$data = [
			'nome'		=> 'Marcio',
			'cad_cpf'		=> '123.123.123-87',
			'cad_evento'	=> 'Bailarina'
		];
		
		$data = [
			'nome'		=> '<span style="font-weight:bold">Jarbas</span>',
			'cpf'		=> '<span style="font-weight:bold">123.123.123-87</span>',
			'evento'	=> '<span style="font-weight:bold">Bailarina</span>'
		];	
		//$parser = new \CodeIgniter\View\Parser();
		//return $parser->setData($data)->render('emails/contrato');
		
		
		$parser = service('parser');
		return $parser->setData($data)->render('emails/contrato');
		
	}


	public function sendmail()
	{
		/*
		 * -------------------------------------------------------------
		 * ENVIAR EMAIL PARA O CLIENTE
		 * -------------------------------------------------------------
		**/
			$data_fields = [
				'site_name' => "JA-Feston",
				'NOME_DO_FESTIVAL' => "Festival Dance",
				'NOME_DO_PARTICIPANTE' => "Márcio Lima",
				'DATA_DA_INSCRICAO' => date("d/m-Y H:i:s"),
			];
			$stringEmail = view('emails/participantes-autorizacoes-view-antigo', $data_fields);

			$enviar_para = array( 
				'listasguardiao@gmail.com',
				'marcio.mjlima1977@gmail.com',
				//'marcio.misterlab@gmail.com',
				//'mjlima@hotmail.com',
				'dancacarajas@gmail.com',
			);
			//$enviar_para = array( $clie_email );
			$arr_fields = [];
			$arr_anexos = [];
			$args_email = array(
				"body"			=> $stringEmail,
				"subject"		=> "Você Está Dentro do Festival Dance! Agora Só Falta Um Passo",
				"fields"		=> $arr_fields,
				"enviar_para"	=> $enviar_para,
				"anexos"		=> $arr_anexos,
			);
			$pMail = new PHPMailerLib();
			$pMail->send($args_email);	
	}

}
