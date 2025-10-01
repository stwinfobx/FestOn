<?php
namespace App\Models;

use CodeIgniter\Model;

class JuradosModel extends Model
{
	/*
		CREATE TABLE tbl_jurados (
			jurd_id INT(11) NOT NULL AUTO_INCREMENT,
			insti_id INT(11) NOT NULL DEFAULT '0',
			jurd_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			jurd_urlpage VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			jurd_nome VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			jurd_email VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			jurd_senha VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			jurd_file_foto VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			jurd_dte_cadastro DATETIME NULL DEFAULT NULL,
			jurd_dte_alteracao DATETIME NULL DEFAULT NULL,
			jurd_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (jurd_id) USING BTREE,
			UNIQUE INDEX jurd_id (jurd_id) USING BTREE,
			INDEX `insti_id` (`insti_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_jurados';
	protected $primaryKey = 'jurd_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'jurd_hashkey',
		'jurd_urlpage',
		'jurd_nome',
		'jurd_email',
		'jurd_senha',
		'jurd_file_foto',
		'jurd_dte_cadastro',
		'jurd_dte_alteracao',
		'jurd_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}