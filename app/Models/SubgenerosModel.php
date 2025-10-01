<?php
namespace App\Models;

use CodeIgniter\Model;

class SubgenerosModel extends Model
{
	/*
		CREATE TABLE `tbl_subgeneros` (
			`subgen_id` INT(11) NOT NULL AUTO_INCREMENT,
			`subgen_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`subgen_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`subgen_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`subgen_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`subgen_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`subgen_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`subgen_id`) USING BTREE,
			UNIQUE INDEX `subgen_id` (`subgen_id`) USING BTREE,
			INDEX `subgen_id_2` (`subgen_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_subgeneros';
	protected $primaryKey = 'subgen_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'subgen_hashkey',
		'subgen_urlpage',
		'subgen_titulo',
		'subgen_dte_cadastro',
		'subgen_dte_alteracao',
		'subgen_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}