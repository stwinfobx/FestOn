<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
	/*
		CREATE TABLE usuario (
			id INT(11) NOT NULL AUTO_INCREMENT,
			nome TEXT NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
			email TEXT NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
			celular VARCHAR(30) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
			senha TEXT NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
			permissao INT(1) NOT NULL DEFAULT '0',
			del INT(11) NOT NULL DEFAULT '0',
			PRIMARY KEY (id) USING BTREE
		)
		COLLATE='latin1_swedish_ci'
		ENGINE=InnoDB
		AUTO_INCREMENT=60
		;

	*/

	protected $db = null;
    protected $table = 'usuario';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'nome',
		'email',
		'celular',
		'senha',
		'permissao',
		'del',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}