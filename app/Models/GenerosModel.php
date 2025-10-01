<?php
namespace App\Models;

use CodeIgniter\Model;

class GenerosModel extends Model
{
	/*
		CREATE TABLE `tbl_generos` (
			`gene_id` INT(11) NOT NULL AUTO_INCREMENT,
			`gene_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`gene_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`gene_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`gene_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`gene_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`gene_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`gene_id`) USING BTREE,
			UNIQUE INDEX `gene_id` (`gene_id`) USING BTREE,
			INDEX `gene_id_2` (`gene_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_generos';
	protected $primaryKey = 'gene_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'gene_hashkey',
		'gene_urlpage',
		'gene_titulo',
		'gene_dte_cadastro',
		'gene_dte_alteracao',
		'gene_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}