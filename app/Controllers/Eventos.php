<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Eventos extends BaseController
{
	
	protected $eventMD = null;
	protected $evdteMD = null;
	protected $evvlrMD = null;
	protected $evcobMD = null;
	
	protected $cursoMD = null;
	protected $crsDteMD = null;

    public function __construct()
    {
        $this->eventMD = new \App\Models\EventosModel();
		$this->evdteMD = new \App\Models\EventosDatasModel();
		$this->evvlrMD = new \App\Models\EventosValoresModel();
		$this->evcobMD = new \App\Models\EventosCobrancaModel();
		
		$this->cursoMD = new \App\Models\CursosModel();
		$this->crsDteMD = new \App\Models\CursosDatasModel();		

		$this->data['menu_active'] = 'home';
    }

	public function index()
	{
		return view('evento', $this->data);
	}


	public function inicial($event_id = "", $event_urlpage = "")
	{
		$this->eventMD->select('*');
		$this->eventMD->where('event_id', $event_id);
		$this->eventMD->where('event_urlpage', $event_urlpage);
		$this->eventMD->where('event_ativo', 1);
		$this->eventMD->orderBy('event_id', 'DESC');
		$this->eventMD->limit(1);
		$query_event = $this->eventMD->get();
		
		if( $query_event && $query_event->resultID->num_rows >=1 )
		{
			$rs_event = $query_event->getRow();
			$this->data['rs_event'] = $rs_event;

			$event_id = (int)$rs_event->event_id;

			$query_event_datas = $this->evdteMD->where('event_id', $event_id)->get();
			if( $query_event_datas && $query_event_datas->resultID->num_rows >= 1 )
			{
				$this->data['rs_dados_datas'] = $query_event_datas;
			}

			$query_event_valores = $this->evvlrMD->where('event_id', $event_id)->get();
			if( $query_event_valores && $query_event_valores->resultID->num_rows >= 1 )
			{
				$this->data['rs_dados_valores'] = $query_event_valores;
			}


			/*
			 * -------------------------------------------------------------
			 * Datas dos Workshops
			 * -------------------------------------------------------------
			**/
				$query_workshops = $this->cursoMD
					->where('event_id', $event_id)
					->orderBy('curso_titulo', 'ASC')
					->limit(100)
					->get();
				if( $query_workshops && $query_workshops->resultID->num_rows >= 1 )
				{
					$this->data['rs_workshops'] = $query_workshops;
				}
		}

		return view('evento', $this->data);
	}

}
