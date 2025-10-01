<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Seats extends BaseController
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
		return view('seats/index', $this->data);
	}
	public function modelo2()
	{
		return view('seats/modelo2', $this->data);
	}
	public function modelo3()
	{
		return view('seats/modelo3', $this->data);
	}
}
