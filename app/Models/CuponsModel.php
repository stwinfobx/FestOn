<?php
namespace App\Models;

use CodeIgniter\Model;

class CuponsModel extends Model
{
	/*
		CREATE TABLE tbl_cupons (
			cupom_id INT(11) NOT NULL AUTO_INCREMENT,
			cupom_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			cupom_urlpage VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			cupom_codigo VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			cupom_categoria DATETIME NULL DEFAULT NULL,
			cupom_dte_inicio DATETIME NULL DEFAULT NULL,
			cupom_dte_termino DATETIME NULL DEFAULT NULL,
			cupom_limite DATETIME NULL DEFAULT NULL,
			cupom_valor_desc DECIMAL(16,2) NULL DEFAULT '0.00',
			cupom_percentual DECIMAL(16,2) NULL DEFAULT '0.00',
			cupom_dte_cadastro DATETIME NULL DEFAULT NULL,
			cupom_dte_alteracao DATETIME NULL DEFAULT NULL,
			cupom_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (cupom_id) USING BTREE,
			UNIQUE INDEX cupom_id (cupom_id) USING BTREE
		)
		COMMENT='Vouchers'
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_cupons';
	protected $primaryKey = 'cupom_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
		'cupom_hashkey',
		'cupom_urlpage',
		'cupom_codigo',
		'cupom_categoria',
		'cupom_dte_inicio',
		'cupom_dte_termino',
		'cupom_limite',
		'cupom_valor_desc',
		'cupom_percentual',
		'cupom_dte_cadastro',
		'cupom_dte_alteracao',
		'cupom_ativo',
    ];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}