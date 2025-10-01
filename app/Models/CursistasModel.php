<?php
namespace App\Models;

use CodeIgniter\Model;

class CursistasModel extends Model
{
	/*
	CREATE TABLE `tbl_cursistas` (
		`crsit_id` INT(11) NOT NULL AUTO_INCREMENT,
		`crsit_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_cpf` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_genero` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_dte_nascto` DATE NULL DEFAULT NULL,
		`crsit_nacionalidade` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_estado` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_cidade` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_estilo_danca` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_anos_exper` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_nivel` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_funcao` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
		`crsit_dte_cadastro` DATETIME NULL DEFAULT NULL,
		`crsit_dte_alteracao` DATETIME NULL DEFAULT NULL,
		`crsit_ativo` TINYINT(4) NULL DEFAULT '0',
		PRIMARY KEY (`crsit_id`) USING BTREE,
		UNIQUE INDEX `crsit_id` (`crsit_id`) USING BTREE,
		INDEX `crsit_id_2` (`crsit_id`) USING BTREE
	)
	COLLATE='utf8mb4_general_ci'
	ENGINE=MyISAM
	;

		
	ALTER TABLE `tbl_cursistas`
		ADD COLUMN `crsit_email` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_nome`,
		ADD COLUMN `crsit_cpf` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_email`,
		ADD COLUMN `crsit_genero` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_cpf`,
		ADD COLUMN `crsit_dte_nascto` DATE NULL DEFAULT NULL AFTER `crsit_genero`,
		ADD COLUMN `crsit_nacionalidade` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_dte_nascto`,
		ADD COLUMN `crsit_estado` VARCHAR(50) NULL DEFAULT NULL AFTER `crsit_nacionalidade`,
		ADD COLUMN `crsit_cidade` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_estado`,
		ADD COLUMN `crsit_estilo_danca` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_cidade`,
		ADD COLUMN `crsit_anos_exper` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_estilo_danca`,
		ADD COLUMN `crsit_nivel` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_anos_exper`;
		
	ALTER TABLE `tbl_cursistas`
		ADD COLUMN `crsit_senha` VARCHAR(250) NULL DEFAULT NULL AFTER `crsit_cpf`;
		
	*/

	protected $db = null;
    protected $table = 'tbl_cursistas';
	protected $primaryKey = 'crsit_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'crsit_hashkey',
		'crsit_urlpage',
		'crsit_nome',
		'crsit_email',
		'crsit_cpf',
		'crsit_senha',
		'crsit_genero',
		'crsit_dte_nascto',
		'crsit_nacionalidade',
		'crsit_estado',
		'crsit_cidade',
		'crsit_estilo_danca',
		'crsit_anos_exper',
		'crsit_nivel',
		'crsit_funcao',
		'crsit_dte_cadastro',
		'crsit_dte_alteracao',
		'crsit_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}