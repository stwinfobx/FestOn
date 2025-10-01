<?php
namespace App\Models;

use CodeIgniter\Model;

class CursosDatasModel extends Model
{
	/*
		CREATE TABLE `tbl_cursos_datas` (
			`crsdte_id` INT(11) NOT NULL AUTO_INCREMENT,
			`curso_id` INT(11) NOT NULL DEFAULT '0',
			`crsdte_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`crsdte_data` DATE NULL DEFAULT NULL,
			`crsdte_hrs_ini` TIME NULL DEFAULT NULL,
			`crsdte_hrs_end` TIME NULL DEFAULT NULL,
			`crsdte_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`crsdte_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`crsdte_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`crsdte_id`) USING BTREE,
			UNIQUE INDEX `crsdte_id` (`crsdte_id`) USING BTREE,
			INDEX `crsdte_id_2` (`crsdte_id`) USING BTREE,
			INDEX `curso_id` (`curso_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_cursos_datas';
	protected $primaryKey = 'crsdte_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'curso_id',
		'crsdte_hashkey',
		'crsdte_data',
		'crsdte_hrs_ini',
		'crsdte_hrs_end',
		'crsdte_dte_cadastro',
		'crsdte_dte_alteracao',
		'crsdte_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}