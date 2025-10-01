<?php
namespace App\Models;

use CodeIgniter\Model;

class EventosCobrancaModel extends Model
{
	/*
		CREATE TABLE tbl_eventos_cobranca (
			evcob_id INT(11) NOT NULL AUTO_INCREMENT,
			event_id INT(11) NOT NULL DEFAULT '0',
			evcob_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_titular VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_cpf VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_chave_pix VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_banco VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_agencia VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_conta_num VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_informacoes VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			evcob_dte_cadastro DATETIME NULL DEFAULT NULL,
			evcob_dte_alteracao DATETIME NULL DEFAULT NULL,
			evcob_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (evcob_id) USING BTREE,
			UNIQUE INDEX evcob_id (evcob_id) USING BTREE,
			INDEX event_id (event_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		;
		
		ALTER TABLE `tbl_eventos_cobranca`
			ADD COLUMN `evcob_area_cobranca` VARCHAR(250) NULL DEFAULT NULL AFTER `evcob_hashkey`;		
	*/

	protected $db = null;
    protected $table = 'tbl_eventos_cobranca';
	protected $primaryKey = 'evcob_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'event_id',
		'evcob_hashkey',
		'evcob_titular',
		'evcob_area_cobranca',
		'evcob_tipo_cobranca',
		'evcob_tipo_cad',
		'evcob_cpf',
		'evcob_cnpj',
		'evcob_chave_pix',
		'evcob_banco',
		'evcob_agencia',
		'evcob_conta_num',
		'evcob_informacoes',
		'evcob_info_doacao',
		'evcob_credenciais_mp',
		'evcob_config_mp',
		'evcob_dte_cadastro',
		'evcob_dte_alteracao',
		'evcob_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}