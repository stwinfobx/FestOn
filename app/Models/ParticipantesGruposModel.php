<?php
namespace App\Models;

use CodeIgniter\Model;

class ParticipantesGruposModel extends Model
{
	/*
		CREATE TABLE tbl_participantes_x_grupos (
			ptgrp_id INT(11) NOT NULL AUTO_INCREMENT,
			insti_id INT(11) NOT NULL DEFAULT '0',
			partc_id INT(11) NOT NULL DEFAULT '0',
			grp_id INT(11) NOT NULL DEFAULT '0',
			func_id INT(11) NOT NULL DEFAULT '0',
			partc_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			partc_urlpage VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			partc_nome VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			partc_documento VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			partc_dte_cadastro DATETIME NULL DEFAULT NULL,
			partc_dte_alteracao DATETIME NULL DEFAULT NULL,
			partc_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (ptgrp_id) USING BTREE,
			UNIQUE INDEX ptgrp_id (ptgrp_id) USING BTREE,
			INDEX partc_id_2 (ptgrp_id) USING BTREE,
			INDEX grp_id (grp_id) USING BTREE,
			INDEX func_id (func_id) USING BTREE,
			INDEX insti_id (insti_id) USING BTREE,
			INDEX partc_id (partc_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=3
		;
	*/

	protected $db = null;
    protected $table = 'tbl_participantes_x_grupos';
	protected $primaryKey = 'ptgrp_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'partc_id',
		'grp_id',
		'func_id',
		'grevt_id',
		'ptgrp_hashkey',
		'ptgrp_urlpage',
		'ptgrp_nome',
		'ptgrp_documento',
		'ptgrp_dte_cadastro',
		'ptgrp_dte_alteracao',
		'ptgrp_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}