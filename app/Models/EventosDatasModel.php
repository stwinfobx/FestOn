<?php
namespace App\Models;

use CodeIgniter\Model;

class EventosDatasModel extends Model
{
	/*
		CREATE TABLE `tbl_eventos_datas` (
			`evdte_id` INT(11) NOT NULL AUTO_INCREMENT,
			`evdte_id` INT(11) NOT NULL DEFAULT '0',
			`evdte_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`evdte_data` DATE NULL DEFAULT NULL,
			`evdte_hrs_ini` TIME NULL DEFAULT NULL,
			`evdte_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`evdte_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`evdte_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`evdte_id`) USING BTREE,
			UNIQUE INDEX `evdte_id` (`evdte_id`) USING BTREE,
			INDEX `evdte_id_2` (`evdte_id`) USING BTREE,
			INDEX `evdte_id` (`evdte_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_eventos_datas';
	protected $primaryKey = 'evdte_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'event_id',
		'evdte_hashkey',
		'evdte_data',
		'evdte_hrs_ini',
		'evdte_dte_cadastro',
		'evdte_dte_alteracao',
		'evdte_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}