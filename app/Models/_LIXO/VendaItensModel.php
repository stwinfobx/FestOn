<?php
namespace App\Models;

use CodeIgniter\Model;

class VendaItensModel extends Model
{
	/*
		CREATE TABLE venda_itens (
			id INT(11) NOT NULL AUTO_INCREMENT,
			venda_id INT(11) NOT NULL,
			produto_id INT(11) NOT NULL,
			qtd INT(11) NOT NULL,
			valor FLOAT(10,2) NOT NULL,
			usuario_id INT(11) NOT NULL,
			del INT(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (id) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=3785
		;
	*/

	protected $db = null;
    protected $table = 'venda_itens';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'venda_id',
		'produto_id',
		'qtd',
		'valor',
		'usuario_id',
		'del',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}