<?php
namespace App\Models;

use CodeIgniter\Model;

class CarrinhoModel extends Model
{
	/*
		CREATE TABLE `carrinho` (
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`produto_id` INT(11) NOT NULL,
			`qtd` INT(11) NOT NULL,
			`valor` FLOAT(10,2) NOT NULL,
			`session` VARCHAR(100) NOT NULL COLLATE 'utf8_unicode_ci',
			PRIMARY KEY (`id`) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=2034
		;
	*/

	protected $db = null;
    protected $table = 'carrinho';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'produto_id',
		'qtd',
		'valor',
		'session',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}