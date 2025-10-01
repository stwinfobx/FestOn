<?php
namespace App\Controllers;
use App\Controllers\BaseController;

use \DateTime;
use \DateInterval;

class Agendamentos extends BaseController
{

	protected $cfg = null;

    public function __construct()
    {
    }

	public function index()
	{
		return view('agendamentos/index', $this->data);
	}

}
