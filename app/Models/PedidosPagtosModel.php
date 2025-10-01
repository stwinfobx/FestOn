<?php
namespace App\Models;

use CodeIgniter\Model;

class PedidosPagtosModel extends Model
{
	/*
		CREATE TABLE `tbl_pedidos_pagtos` (
			`pgto_id` INT(11) NOT NULL AUTO_INCREMENT,
			`user_id` INT(11) NOT NULL,
			`ped_id` INT(11) NOT NULL,
			`pgto_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_referencia` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_payment` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_credenciais` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_status` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_json` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_code_checkout` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`pgto_liberado` TINYINT(4) NULL DEFAULT '0',
			`pgto_dte_liberado` DATETIME NULL DEFAULT NULL,
			`pgto_dtepedido` DATETIME NULL DEFAULT NULL,
			`pgto_consultado` TINYINT(4) NULL DEFAULT '0',
			`pgto_sendmail` TINYINT(4) NULL DEFAULT '0',
			`pgto_recibo_num` INT(11) NULL DEFAULT '0',
			`pgto_recibo_send` TINYINT(4) NULL DEFAULT '0',
			`pgto_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`pgto_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`pgto_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`pgto_id`, `user_id`) USING BTREE,
			UNIQUE INDEX `pgto_id` (`pgto_id`) USING BTREE,
			INDEX `ped_id` (`ped_id`) USING BTREE,
			INDEX `colab_id` (`user_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
		
		ALTER TABLE `tbl_pedidos_pagtos`
			ADD COLUMN `pgto_init_point` VARCHAR(250) NULL DEFAULT NULL AFTER `pgto_code_checkout`;
	*/

	protected $db = null;
    protected $table = 'tbl_pedidos_pagtos';
	protected $primaryKey = 'pgto_id';
	protected $useAutoIncremepgto_idnt = true;
	protected $returnType = 'object';
    protected $allowedFields = [
        'user_id',
        'ped_id',
        'pgto_hashkey',
        'pgto_referencia',
        'pgto_nome',
        'pgto_email',
        'pgto_payment',
        'pgto_credenciais',
        'pgto_status',
        'pgto_json',
        'pgto_code_checkout',
		'pgto_init_point',
        'pgto_liberado',
        'pgto_dte_liberado',
        'pgto_dtepedido',
        'pgto_consultado',
        'pgto_sendmail',
        'pgto_recibo_num',
        'pgto_recibo_send',
        'pgto_dte_cadastro',
        'pgto_dte_alteracao',
        'pgto_ativo',
    ];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();


		//$this->session_id = session()->get('hash_id');
		//$this->session_user_id = (int)session()->get('user_id');
		//$this->session_user_nome = session()->get('user_nome');
		//$this->session_user_permissao = (int)session()->get('user_permissao');
    }

	public function select_all_by_insti_id( $insti_id = 0 )
	{
		//$builder = $this->db->table( $this->table );
		//$builder->where('insti_id', (int)$insti_id);
		//$builder->orderBy('categ_titulo', 'ASC');
		//$builder->limit(1000);
		//$query = $builder->get();

		//return $query; 
	}

}