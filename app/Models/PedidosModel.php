<?php
namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model
{
	/*
		CREATE TABLE `tbl_pedidos` (
			`ped_id` INT(11) NOT NULL AUTO_INCREMENT,
			`grevt_id` INT(11) NOT NULL,
			`user_id` INT(11) NOT NULL,
			`ped_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_referencia` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_email` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_payment` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_credenciais` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_status` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_coreografias` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_json` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_valor_total` DECIMAL(16,2) NULL DEFAULT '0.00',
			`ped_valor_percent` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
			`ped_valor_desconto` DECIMAL(16,2) NOT NULL DEFAULT '0.00',
			`ped_cupom_codigo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_cupom_cortesia` TINYINT(4) NULL DEFAULT '0',
			`ped_code_checkout` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`ped_liberado` TINYINT(4) NULL DEFAULT '0',
			`ped_dte_liberado` DATETIME NULL DEFAULT NULL,
			`ped_dtepedido` DATETIME NULL DEFAULT NULL,
			`ped_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`ped_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`ped_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`ped_id`, `grevt_id`) USING BTREE,
			UNIQUE INDEX `ped_id` (`ped_id`) USING BTREE,
			INDEX `grevt_id` (`grevt_id`) USING BTREE,
			INDEX `user_id` (`user_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		;
	*/

	protected $db = null;
    protected $table = 'tbl_pedidos';
	protected $primaryKey = 'ped_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
        'grevt_id',
        'user_id',
		'insti_id',
		'grp_id',
		'event_id',
		'event_titulo',
        'ped_hashkey',
        'ped_referencia',
        'ped_nome',
        'ped_email',
        'ped_payment',
        'ped_credenciais',
        'ped_status',
        'ped_coreografias',
        'ped_json',
        'ped_valor_total',
        'ped_valor_percent',
        'ped_valor_desconto',
        'ped_cupom_codigo',
        'ped_cupom_cortesia',
        'ped_code_checkout',
        'ped_liberado',
        'ped_dte_liberado',
        'ped_dtepedido',
        'ped_dte_cadastro',
        'ped_dte_alteracao',
        'ped_ativo',
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
		$builder = $this->db->table( $this->table );
		$builder->where('insti_id', (int)$insti_id);
		$builder->orderBy('categ_titulo', 'ASC');
		$builder->limit(1000);
		$query = $builder->get();

		return $query; 
	}

}