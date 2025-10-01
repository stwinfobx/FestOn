<?php
namespace App\Models;

use CodeIgniter\Model;

class ConfiguracoesModel extends Model
{
	/*
		CREATE TABLE `tbl_configuracoes` (
			`cfg_id` INT(11) NOT NULL AUTO_INCREMENT,
			`cfg_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cfg_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cfg_area` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cfg_chave` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cfg_value` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cfg_descricao` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cfg_redirect` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cfg_horario` TIME NULL DEFAULT NULL,
			`cfg_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`cfg_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`cfg_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`cfg_id`) USING BTREE,
			UNIQUE INDEX `cfg_id` (`cfg_id`) USING BTREE
		)
		COMMENT='Configuracoes gerais da plataforma'
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_configuracoes';
	protected $primaryKey = 'cfg_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'cfg_hashkey',
		'cfg_urlpage',
		'cfg_area',
		'cfg_chave',
		'cfg_value',
		'cfg_descricao',
		'cfg_redirect',
		'cfg_horario',
		'cfg_dte_cadastro',
		'cfg_dte_alteracao',
		'cfg_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}