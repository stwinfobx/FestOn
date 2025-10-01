<?php
namespace App\Models;

use CodeIgniter\Model;

class CoreografiasParticipantesModel extends Model
{
	/*
		CREATE TABLE `tbl_coreografias_x_participantes` (
			`crfpa_id` INT(11) NOT NULL AUTO_INCREMENT,
			`corgf_id` INT(11) NOT NULL DEFAULT '0',
			`partc_id` INT(11) NOT NULL DEFAULT '0',
			`crfpadte_cadastro` DATETIME NULL DEFAULT NULL,
			`crfpadte_alteracao` DATETIME NULL DEFAULT NULL,
			`crfpaativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`crfpa_id`) USING BTREE,
			UNIQUE INDEX `crfpa_id` (`crfpa_id`) USING BTREE,
			INDEX `corgf_id_partc_id` (`corgf_id`, `partc_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		;
	*/

	protected $db = null;
    protected $table = 'tbl_coreografias_x_participantes';
	protected $primaryKey = 'crfpa_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
        'corgf_id',
        'partc_id',
        'crfpadte_cadastro',
        'crfpadte_alteracao',
        'crfpaativo',
    ];
    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}