<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Widgets extends PainelController
{
	protected $instiMD = null;

    public function __construct()
    {
    }


	public function etapas_cadastro()
	{
		return view($this->directory .'/widgets/etapas-cadastro');
	}


}
