<?php
namespace App\Models;

use CodeIgniter\Model;

class InstituicoesModel extends Model
{
	/*
		CREATE TABLE `tbl_instituicoes` (
			`insti_id` INT(11) NOT NULL AUTO_INCREMENT,
			`insti_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_senha` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_telefone` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_celular` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_whatsapp` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_end_cep` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_endereco` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_end_numero` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_end_compl` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_end_bairro` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_end_cidade` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_end_estado` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',

			`insti_dir1_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_dir1_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_dir1_funcao` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_dir1_assinatura` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',

			`insti_dir2_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_dir2_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_dir2_funcao` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`insti_dir2_assinatura` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',

			`insti_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`insti_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`insti_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`insti_id`) USING BTREE,
			UNIQUE INDEX `insti_id` (`insti_id`) USING BTREE,
			INDEX `insti_id_2` (`insti_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;


		ALTER TABLE `tbl_instituicoes`
			ADD COLUMN `insti_file_cartao_cnpj` VARCHAR(250) NULL DEFAULT NULL AFTER `insti_logotipo`,
			ADD COLUMN `insti_file_contr_social` VARCHAR(250) NULL DEFAULT NULL AFTER `insti_file_cartao_cnpj`,
			ADD COLUMN `insti_file_doc_rg` VARCHAR(250) NULL DEFAULT NULL AFTER `insti_file_contr_social`,
			ADD COLUMN `insti_file_doc_cpf` VARCHAR(250) NULL DEFAULT NULL AFTER `insti_file_doc_rg`;
	
		ALTER TABLE `tbl_instituicoes`
			ADD COLUMN `insti_cnpj` VARCHAR(250) NULL DEFAULT NULL AFTER `insti_nome`;

		ALTER TABLE `tbl_instituicoes`
			ADD COLUMN `insti_resp_nome` VARCHAR(250) NULL DEFAULT NULL AFTER `insti_whatsapp`,
			ADD COLUMN `insti_resp_cpf` VARCHAR(250) NULL DEFAULT NULL AFTER `insti_resp_nome`;

	*/

	protected $db = null;
    protected $table = 'tbl_instituicoes';
	protected $primaryKey = 'insti_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
        'insti_hashkey',
        'insti_urlpage',
        'insti_nome',
		'insti_cnpj',
        'insti_email',
        'insti_senha',
        'insti_telefone',
        'insti_celular',
        'insti_whatsapp',

		'insti_resp_nome',
		'insti_resp_cpf',

		'insti_redes_sociais',

        'insti_end_cep',
        'insti_end_logradouro',
        'insti_end_numero',
        'insti_end_compl',
        'insti_end_bairro',
        'insti_end_cidade',
        'insti_end_estado',

		'insti_logotipo',
		'insti_file_cartao_cnpj',
		'insti_file_contr_social',
		'insti_file_doc_rg',
		'insti_file_doc_cpf',

        'insti_dte_cadastro',
        'insti_dte_alteracao',
        'insti_ativo',
    ];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}