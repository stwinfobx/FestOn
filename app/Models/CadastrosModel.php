<?php
namespace App\Models;

use CodeIgniter\Model;

class CadastrosModel extends Model
{
	/*
		CREATE TABLE `tbl_cadastros` (
			`cad_id` INT(11) NOT NULL AUTO_INCREMENT,
			`cad_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_nome_social` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_genero` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_raca` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_documento` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_observacao` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_dte_nascto` DATE NULL DEFAULT NULL,
			`cad_file_foto` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_file_doc_frente` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_file_doc_verso` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`cad_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`cad_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`cad_id`) USING BTREE,
			UNIQUE INDEX `cad_id` (`cad_id`) USING BTREE,
			INDEX `cad_id_2` (`cad_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
		
		ALTER TABLE `tbl_cadastros`
			ADD COLUMN `uf_id` INT(11) NOT NULL DEFAULT '0' AFTER `cad_id`,
			ADD COLUMN `munc_id` INT(11) NOT NULL DEFAULT '0' AFTER `uf_id`;
		
	*/

	protected $db = null;
    protected $table = 'tbl_cadastros';
	protected $primaryKey = 'cad_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'uf_id',
		'munc_id',
		'cad_hashkey',
		'cad_urlpage',
		'cad_nome',
		'cad_nome_social',
		'cad_email',
		'cad_genero',
		'cad_raca',
		'cad_documento',
		'cad_dte_nascto',
		'cad_file_foto',
		'cad_file_doc_frente',
		'cad_file_doc_verso',
		'cad_dte_cadastro',
		'cad_dte_alteracao',
		'cad_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}