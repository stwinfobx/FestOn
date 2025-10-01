<?php
namespace App\Models;

use CodeIgniter\Model;

class CadastrosNovosModel extends Model
{
	/*
		CREATE TABLE `tbl_cadastros` (
			`cad_id` INT(11) NOT NULL AUTO_INCREMENT,
			`cad_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_activekey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_qrcode` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_qrcode_temp` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_qrsalt` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_nome_completo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_nome_cracha` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_celular` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_profissao` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_cidade` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_estado` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_empresa` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_tematica_01` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_tematica_02` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_tematica_03` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_tematica_04` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_sequencia` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_cod_afiliado` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_fields_json` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_fields_error` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`cad_confirmado` TINYINT(4) NULL DEFAULT NULL,
			`cad_dte_confirmado` DATETIME NULL DEFAULT NULL,
			`cad_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`cad_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`cad_gerado` TINYINT(4) NULL DEFAULT '0',
			`cad_ativo` TINYINT(4) NULL DEFAULT '0',
			`cad_teste` TINYINT(4) NULL DEFAULT '0',
			`cad_novo` TINYINT(4) NULL DEFAULT '0',
			`cad_novo_email` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`cad_id`) USING BTREE,
			UNIQUE INDEX `cad_id` (`cad_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_cadastros_novos';
	protected $primaryKey = 'cad_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'cad_hashkey',
		'cad_activekey',
		'cad_urlpage',
		'cad_qrcode',
		'cad_qrcode_temp',
		'cad_qrsalt',
		'cad_nome_completo',
		'cad_nome_cracha',
		'cad_email',
		'cad_celular',
		'cad_profissao',
		'cad_cidade',
		'cad_estado',
		'cad_empresa',
		'cad_tematica_01',
		'cad_tematica_02',
		'cad_tematica_03',
		'cad_tematica_04',
		'cad_tematica_05',
		'cad_tematica_06',
		'cad_tematica_07',
		'cad_tematica_08',
		'cad_sequencia',
		'cad_cod_afiliado',
		'cad_fields_json',
		'cad_fields_error',
		'cad_confirmado',
		'cad_dte_confirmado',
		'cad_dte_cadastro',
		'cad_dte_alteracao',
		'cad_gerado',
		'cad_ativo',
		'cad_teste',
		'cad_novo',
		'cad_novo_email',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}