<?php
namespace App\Models;

use CodeIgniter\Model;

class WorkshopsModel extends Model
{
	/*
		CREATE TABLE `tbl_workshops` (
			`work_id` INT(11) NOT NULL AUTO_INCREMENT,
			`insti_id` INT(11) NOT NULL DEFAULT '0',
			`work_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`work_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`work_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`work_banner` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`work_regulamento` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`work_descricao` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`work_encerrar_inscricoes` TINYINT(4) NULL DEFAULT '0',
			`work_localizacao` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`work_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`work_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`work_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`work_id`) USING BTREE,
			UNIQUE INDEX `work_id` (`work_id`) USING BTREE,
			INDEX `work_id_2` (`work_id`) USING BTREE,
			INDEX `insti_id` (`insti_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
		
		ALTER TABLE `tbl_workshops`
			ADD COLUMN `work_quant_vagas` INT(11) NULL DEFAULT '0' AFTER `work_localizacao`,
			ADD COLUMN `work_foto_professor` VARCHAR(250) NULL DEFAULT NULL AFTER `work_quant_vagas`,
			ADD COLUMN `work_template_certificado` VARCHAR(250) NULL DEFAULT NULL AFTER `work_foto_professor`,
			ADD COLUMN `work_foto_assinatura` VARCHAR(250) NULL DEFAULT NULL AFTER `work_template_certificado`;
		
		ALTER TABLE `tbl_workshops`
			ADD COLUMN `work_instrutor` VARCHAR(250) NULL DEFAULT NULL AFTER `work_titulo`;
	*/

	protected $db = null;
    protected $table = 'tbl_workshops';
	protected $primaryKey = 'work_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'work_hashkey',
		'work_urlpage',
		'work_titulo',
		'work_instrutor',
		'work_banner',
		'work_regulamento',
		'work_descricao',
		'work_encerrar_inscricoes',
		'work_localizacao',
		'work_quant_vagas',
		'work_foto_professor',
		'work_template_certificado',
		'work_foto_assinatura',
		'work_dte_cadastro',
		'work_dte_alteracao',
		'work_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}