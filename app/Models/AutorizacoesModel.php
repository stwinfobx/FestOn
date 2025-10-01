<?php
namespace App\Models;

use CodeIgniter\Model;

class AutorizacoesModel extends Model
{
	/*
		CREATE TABLE `tbl_autorizacoes` (
			`autz_id` INT(11) NOT NULL AUTO_INCREMENT,
			`autz_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`autz_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`autz_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`autz_descricao` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`autz_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`autz_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`autz_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`autz_id`) USING BTREE,
			UNIQUE INDEX `autz_id` (`autz_id`) USING BTREE,
			INDEX `modl_id_2` (`autz_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_autorizacoes';
	protected $primaryKey = 'autz_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'autz_parent_id',
		'autz_hashkey',
		'autz_urlpage',
		'autz_titulo',
		'autz_descricao',
		'autz_descricao_full',
		'autz_dte_cadastro',
		'autz_dte_alteracao',
		'autz_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}