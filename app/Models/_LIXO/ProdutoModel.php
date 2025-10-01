<?php
namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
	/*
		CREATE TABLE produto (
			id INT(11) NOT NULL AUTO_INCREMENT,
			descricao VARCHAR(200) NOT NULL COLLATE 'utf8_unicode_ci',
			detalhes TEXT NOT NULL COLLATE 'utf8_unicode_ci',
			valor FLOAT(10,2) NOT NULL,
			valor_custo FLOAT(10,2) NULL DEFAULT NULL,
			comissao INT(11) NULL DEFAULT NULL,
			observacao TEXT NOT NULL COLLATE 'utf8_unicode_ci',
			del INT(11) NOT NULL DEFAULT '0',
			PRIMARY KEY (id) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=28
		;
	*/

	protected $db = null;
    protected $table = 'produto';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'descricao',
		'detalhes',
		'valor',
		'valor_custo',
		'comissao',
		'observacao',
		'del',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}