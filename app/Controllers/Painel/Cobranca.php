<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Cobranca extends PainelController
{
	protected $anuncMD = null;
	protected $folder_upload = null;

    public function __construct()
    {
        $this->anuncMD = new \App\Models\AnunciosModel();

		helper('form');
		helper('text');

		$this->data['menu_active'] = 'cobranca';

		$this->folder_upload = 'files-upload/';
		$this->data['folder_upload'] = $this->folder_upload;
    }


	public function index()
	{
		return view($this->directory .'/cobranca', $this->data);
	}

}
