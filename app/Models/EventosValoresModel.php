<?php
namespace App\Models;

use CodeIgniter\Model;

class EventosValoresModel extends Model
{
	/*
		CREATE TABLE tbl_eventos_valores (
			evvlr_id INT(11) NOT NULL AUTO_INCREMENT,
			event_id INT(11) NOT NULL DEFAULT '0',
			cat_id INT(11) NOT NULL DEFAULT '0',
			evvlr_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evvlr_valor DECIMAL(16,2) NULL DEFAULT NULL,
			evvlr_vlr_desc DECIMAL(16,2) NULL DEFAULT NULL,
			evvlr_data_limite DATE NULL DEFAULT NULL,
			evvlr_dte_cadastro DATETIME NULL DEFAULT NULL,
			evvlr_dte_alteracao DATETIME NULL DEFAULT NULL,
			evvlr_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (evvlr_id) USING BTREE,
			UNIQUE INDEX evvlr_id (evvlr_id) USING BTREE,
			INDEX evvlr_id_2 (evvlr_id) USING BTREE,
			INDEX event_id (event_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		;

		ALTER TABLE `tbl_eventos_valores`
			ADD COLUMN `evvlr_txt_descr` VARCHAR(250) NULL DEFAULT NULL AFTER `evvlr_vlr_desc`;
	*/

	protected $db = null;
    protected $table = 'tbl_eventos_valores';
	protected $primaryKey = 'evvlr_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'event_id',
		'categ_id',
		'func_id',
		'formt_id',
		'evvlr_hashkey',
		'evvlr_label', // valores-participantes / valores-coreografias / descontos-participantes / descontos-coreografias
		'evvlr_quant',
		'evvlr_valor',
		'evvlr_vlr_desc',
		'evvlr_txt_descr',
		'evvlr_data_limite',
		'evvlr_dte_cadastro',
		'evvlr_dte_alteracao',
		'evvlr_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}