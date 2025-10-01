<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
	/*
		CREATE TABLE cliente (
			id INT(11) NOT NULL AUTO_INCREMENT,
			nome VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			cpf_cnpj VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			endereco VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			numero VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			bairro VARCHAR(150) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			cep VARCHAR(15) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			cidade VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			estado VARCHAR(2) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			email VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			telefones VARCHAR(100) NOT NULL COLLATE 'utf8_unicode_ci',
			del INT(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (id) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=968
		;
	*/

	protected $db = null;
    protected $table = 'cliente';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'nome',
		'cpf_cnpj',
		'endereco',
		'numero',
		'bairro',
		'cep',
		'cidade',
		'estado',
		'email',
		'telefones',
		'del',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}