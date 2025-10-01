<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Institucional extends BaseController
{
	
	protected $eventMD = null;

    public function __construct()
    {
        $this->eventMD = new \App\Models\EventosModel();

		$this->data['menu_active'] = 'festivais';
    }

	public function index()
	{
		$query_eventos = $this->eventMD
			->where('event_banner !=', null)
			->orderBy('event_id', 'DESC')
			->get();
		//$this->data['lastQuery'] = $this->eventMD->getLastQuery();
		if( $query_eventos && $query_eventos->resultID->num_rows >=1 )
		{
			//$rs_eventos = $query_eventos->getResult();
			$this->data['rs_eventos'] = $query_eventos;
		}


		return view('festivais', $this->data);
	}


	public function funcionalidades()
	{
		return view('funcionalidades', $this->data);
	}


	public function fale_conosco()
	{
		return view('fale-conosco', $this->data);
	}


	public function cadastro()
	{
		return view('cadastro', $this->data);
	}

	public function inscricoes()
	{
		return view('inscricoes', $this->data);
	}

}
