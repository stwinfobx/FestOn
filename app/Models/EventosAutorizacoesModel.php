<?php
namespace App\Models;

use CodeIgniter\Model;

class EventosAutorizacoesModel extends Model
{
	/*
		CREATE TABLE `tbl_eventos_autorizacoes` (
			`evtaut_id` INT(11) NOT NULL AUTO_INCREMENT,
			`event_id` INT(11) NOT NULL DEFAULT '0',
			`autz_id` INT(11) NOT NULL DEFAULT '0',
			`evtaut_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`evtaut_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`evtaut_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`evtaut_id`) USING BTREE,
			UNIQUE INDEX `evtaut_id` (`evtaut_id`) USING BTREE,
			INDEX `evtaut_2` (`evtaut_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_eventos_autorizacoes';
	protected $primaryKey = 'evtaut_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'event_id',
		'autz_id',
		'evtaut_dte_cadastro',
		'evtaut_dte_alteracao',
		'evtaut_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}