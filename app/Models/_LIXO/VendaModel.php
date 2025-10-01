<?php
namespace App\Models;

use CodeIgniter\Model;

class VendaModel extends Model
{
	/*
		CREATE TABLE venda (
			id INT(11) NOT NULL AUTO_INCREMENT,
			data_cobranca DATE NOT NULL,
			data DATE NOT NULL,
			hora TIME NOT NULL,
			cliente_id INT(11) NOT NULL,
			usuario_id INT(11) NOT NULL,
			baixa INT(1) NOT NULL DEFAULT '0',
			status_id INT(11) NULL DEFAULT NULL,
			arquivo INT(1) NULL DEFAULT '0',
			arquivo2 INT(1) NULL DEFAULT '0',
			data_baixa DATE NOT NULL,
			hora_baixa TIME NOT NULL,
			observacao TEXT NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			del INT(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (id) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=2434
		;
	*/

	protected $db = null;
    protected $table = 'venda';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'data_cobranca',
		'data',
		'hora',
		'cliente_id',
		'usuario_id',
		'baixa',
		'status_id',
		'arquivo',
		'arquivo2',
		'data_baixa',
		'hora_baixa',
		'observacao',
		'del',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}