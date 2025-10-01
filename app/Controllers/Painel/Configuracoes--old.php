<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

use Ifsnop\Mysqldump as IMysqldump;

class Configuracoes extends PainelController
{
	
	protected $userMD = null;
	protected $clieMD = null;
	protected $link_list = null;
	protected $link_form = null;
	protected $link_excel = null;

    public function __construct()
    {
        $this->userMD = new \App\Models\UsuarioModel();
		$this->clieMD = new \App\Models\ClientesModel();

		$this->link_list = painel_url('configuracoes');
		$this->link_form = painel_url('configuracoes/form');
		$this->link_excel = painel_url('configuracoes/excel');
		
		$this->data['link_list'] = $this->link_list;
		$this->data['link_form'] = $this->link_form;
		$this->data['link_excel'] = $this->link_excel;

		helper('form');

		$this->data['menu_active'] = 'clientes';
    }

	public function index()
	{
		return view('clientes', $this->data);
	}

	public function backup()
	{
		$db = \Config\Database::connect();
		$hostname = $db->hostname;
		$dbname = $db->database;
		$username = $db->username;
		$password = $db->password;
		try {
			$options = [
				'compress' => 'gzip'
			];

			$filename = $dbname.'_'.date('dMY_Hi').'.sql.gz';	// change file name here
			$path = WRITEPATH .'uploads/backup-database/';	// change path here

			$dump = new IMysqldump\Mysqldump('mysql:host='. $hostname .';dbname='. $dbname .'', $username, $password, $options);
			//$dump->setGzipCompress(true);
			$dump->start( $path .$filename );
		} catch (\Exception $e) {
			echo 'mysqldump-php error: ' . $e->getMessage();
		}	
	}

}
