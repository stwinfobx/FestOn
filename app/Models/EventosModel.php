<?php
namespace App\Models;

use CodeIgniter\Model;

class EventosModel extends Model
{
	/*
		CREATE TABLE `tbl_eventos` (
			`event_id` INT(11) NOT NULL AUTO_INCREMENT,
			`event_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`event_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`event_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`event_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`event_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`event_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`event_id`) USING BTREE,
			UNIQUE INDEX `event_id` (`event_id`) USING BTREE,
			INDEX `event_id_2` (`event_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_eventos';
	protected $primaryKey = 'event_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'event_hashkey',
		'event_urlpage',
		'event_titulo',
		'event_banner',
		'event_regulamento',
		'event_data',
		'event_hrs_ini',
		'event_limit_coreografia',
		'event_limit_participantes',
		'event_show_result_site',
		'event_permite_votacao',
		'event_encerrar_inscricoes',
		'event_dte_cadastro',
		'event_dte_alteracao',
		'event_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}