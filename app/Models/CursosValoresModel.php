<?php
namespace App\Models;

use CodeIgniter\Model;

class CursosValoresModel extends Model
{
	/*
		CREATE TABLE `tbl_cursos_valores` (
			`curvlr_id` INT(11) NOT NULL AUTO_INCREMENT,
			`curso_id` INT(11) NOT NULL DEFAULT '0',
			`curvlr_label` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`curvlr_quant` INT(11) NOT NULL DEFAULT '0',
			`curvlr_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`curvlr_valor` DECIMAL(16,2) NULL DEFAULT NULL,
			`curvlr_vlr_desc` DECIMAL(16,2) NULL DEFAULT NULL,
			`curvlr_txt_descr` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`curvlr_data_limite` DATE NULL DEFAULT NULL,
			`curvlr_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`curvlr_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`curvlr_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`curvlr_id`) USING BTREE,
			UNIQUE INDEX `curvlr_id` (`curvlr_id`) USING BTREE,
			INDEX `curvlr_id_2` (`curvlr_id`) USING BTREE,
			INDEX `curso_id` (`curso_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_cursos_valores';
	protected $primaryKey = 'curvlr_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'curso_id',
		'curvlr_hashkey',
		'curvlr_label', // valores-participantes / valores-coreografias / descontos-participantes / descontos-coreografias
		'curvlr_quant',
		'curvlr_valor',
		'curvlr_vlr_desc',
		'curvlr_txt_descr',
		'curvlr_data_limite',
		'curvlr_dte_cadastro',
		'curvlr_dte_alteracao',
		'curvlr_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}