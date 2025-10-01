<?php
namespace App\Controllers;
use App\Controllers\BaseController;

use \DateTime;
use \DateInterval;

class Apresentacoes extends BaseController
{

	protected $cfg = null;

    public function __construct()
    {
    }

	public function index()
	{
		return view('apresentacoes/index', $this->data);
	}

}
