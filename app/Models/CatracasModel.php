<?php
namespace App\Models;

use CodeIgniter\Model;

class CatracasModel extends Model
{
	/*
		CREATE TABLE tbl_catracas (
			ctr_id INT(11) NOT NULL AUTO_INCREMENT,
			ctr_hashkey',
			ctr_urlpage',
			ctr_catraca',
			ctr_horario',
			ctr_local',
			ctr_quant INT(11) NOT NULL,
			ctr_observacoes LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			ctr_dte_cadastro DATETIME NULL DEFAULT NULL,
			ctr_dte_alteracao DATETIME NULL DEFAULT NULL,
			ctr_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (ctr_id) USING BTREE,
			UNIQUE INDEX ctr_id (ctr_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_catracas';
	protected $primaryKey = 'ctr_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
		'user_id',
		'ctr_hashkey',
		'ctr_urlpage',
		'ctr_evento',
		'ctr_catraca',
		'ctr_horario',
		'ctr_local',
		'ctr_tipo',
		'ctr_quant',
		'ctr_observacoes',
		'ctr_dte_cadastro',
		'ctr_dte_alteracao',
		'ctr_ativo',
    ];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}