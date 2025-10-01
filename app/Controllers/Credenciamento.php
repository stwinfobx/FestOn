<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Credenciamento extends BaseController
{
	
	protected $eventMD = null;
	protected $evdteMD = null;
	protected $evvlrMD = null;
	protected $evcobMD = null;

    public function __construct()
    {
        $this->eventMD = new \App\Models\EventosModel();
		$this->evdteMD = new \App\Models\EventosDatasModel();
		$this->evvlrMD = new \App\Models\EventosValoresModel();
		$this->evcobMD = new \App\Models\EventosCobrancaModel();

		$this->data['menu_active'] = 'home';
    }

	public function index()
	{
		return view('credenciamento', $this->data);
	}

}
