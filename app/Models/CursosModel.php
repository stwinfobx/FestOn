<?php
namespace App\Models;

use CodeIgniter\Model;

class CursosModel extends Model
{
	/*
		CREATE TABLE `tbl_cursos` (
			`curso_id` INT(11) NOT NULL AUTO_INCREMENT,
			`curso_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`curso_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`curso_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`curso_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`curso_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`curso_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`curso_id`) USING BTREE,
			UNIQUE INDEX `curso_id` (`curso_id`) USING BTREE,
			INDEX `curso_id_2` (`curso_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
		
		ALTER TABLE `tbl_cursos`
			CHANGE COLUMN `curso_local` `curso_local` LONGTEXT NULL COLLATE 'utf8mb4_general_ci' AFTER `curso_nome_professor`;

		ALTER TABLE `tbl_cursos`
			ADD COLUMN `curso_nome_professor` VARCHAR(250) NULL DEFAULT NULL AFTER `curso_titulo`,
			ADD COLUMN `curso_local` VARCHAR(250) NULL DEFAULT NULL AFTER `curso_nome_professor`,
			ADD COLUMN `curso_dte_inicio` DATE NULL DEFAULT NULL AFTER `curso_local`,
			ADD COLUMN `curso_hrs_inicio` VARCHAR(250) NULL DEFAULT NULL AFTER `curso_dte_inicio`,
			ADD COLUMN `curso_dte_termino` DATE NULL DEFAULT NULL AFTER `curso_hrs_inicio`,
			ADD COLUMN `curso_hrs_termino` VARCHAR(250) NULL DEFAULT NULL AFTER `curso_dte_termino`,
			ADD COLUMN `curso_vagas` INT NULL DEFAULT NULL AFTER `curso_hrs_termino`,
			ADD COLUMN `curso_valor` DECIMAL(20,3) NULL DEFAULT NULL AFTER `curso_vagas`;
			
		ALTER TABLE `tbl_cursos`
			ADD COLUMN `curso_foto_professor` VARCHAR(250) NULL DEFAULT NULL AFTER `curso_conteudo`,
			ADD COLUMN `curso_template_certificado` VARCHAR(250) NULL DEFAULT NULL AFTER `curso_foto_professor`,
			ADD COLUMN `curso_foto_assinatura` VARCHAR(250) NULL DEFAULT NULL AFTER `curso_template_certificado`;

		ALTER TABLE `tbl_cursos`
			ADD COLUMN `curso_dte_limite_insc` DATE NULL DEFAULT NULL AFTER `curso_conteudo`;
			
		ALTER TABLE `tbl_cursos`
			ADD COLUMN `event_id` INT(11) NOT NULL DEFAULT '0' AFTER `insti_id`;	
	*/

	protected $db = null;
    protected $table = 'tbl_cursos';
	protected $primaryKey = 'curso_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'event_id',
		'curso_hashkey',
		'curso_urlpage',
		'curso_titulo',
		'curso_local',
		'curso_nome_professor',
		'curso_dte_inicio',
		'curso_hrs_inicio',
		'curso_dte_termino',
		'curso_hrs_termino',
		'curso_vagas',
		'curso_valor',
		'curso_conteudo',
		'curso_dte_limite_insc',
		'curso_foto_professor',
		'curso_template_certificado',
		'curso_foto_assinatura',
		'curso_dte_cadastro',
		'curso_dte_alteracao',
		'curso_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}