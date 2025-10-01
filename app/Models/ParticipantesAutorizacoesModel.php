<?php
namespace App\Models;

use CodeIgniter\Model;

class ParticipantesAutorizacoesModel extends Model
{
	/*
		CREATE TABLE tbl_participantes_x_autorizacoes (
			ptcaut_id INT(11) NOT NULL AUTO_INCREMENT,
			insti_id INT(11) NOT NULL DEFAULT '0',
			user_id INT(11) NOT NULL DEFAULT '0',
			partc_id INT(11) NOT NULL DEFAULT '0',
			grevt_id INT(11) NOT NULL DEFAULT '0',
			evtaut_id INT(11) NOT NULL DEFAULT '0',
			ptcaut_numip VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			ptcaut_dte_cadastro DATETIME NULL DEFAULT NULL,
			ptcaut_dte_alteracao DATETIME NULL DEFAULT NULL,
			PRIMARY KEY (ptcaut_id) USING BTREE,
			UNIQUE INDEX ptcaut_id (ptcaut_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		;
		
		ALTER TABLE `tbl_participantes_x_autorizacoes`
			ADD COLUMN `ptcaut_hashkey` VARCHAR(250) NOT NULL DEFAULT '0' AFTER `ptcaut_id`;
	
	*/

	protected $db = null;
    protected $table = 'tbl_participantes_x_autorizacoes';
	protected $primaryKey = 'ptcaut_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'ptcaut_hashkey',
		'insti_id',
		'user_id',
		'partc_id',
		'grevt_id',
		'evtaut_id',
		'autz_hashkey',
		'ptcaut_numip',
		'ptcaut_dte_cadastro',
		'ptcaut_dte_alteracao',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}