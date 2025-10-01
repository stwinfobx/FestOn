<?php
namespace App\Models;

use CodeIgniter\Model;

class ModalidadesModel extends Model
{
	/*
		CREATE TABLE `tbl_modalidades` (
			`modl_id` INT(11) NOT NULL AUTO_INCREMENT,
			`insti_id` INT(11) NOT NULL DEFAULT '0',
			`modl_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`modl_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`modl_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`modl_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`modl_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`modl_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`modl_id`) USING BTREE,
			UNIQUE INDEX `modl_id` (`modl_id`) USING BTREE,
			INDEX `modl_id_2` (`modl_id`) USING BTREE,
			INDEX `insti_id` (`insti_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_modalidades';
	protected $primaryKey = 'modl_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'modl_hashkey',
		'modl_urlpage',
		'modl_titulo',
		'modl_dte_cadastro',
		'modl_dte_alteracao',
		'modl_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

	public function select_all_by_insti_id( $insti_id = 0 )
	{
		$builder = $this->db->table( $this->table );
		$builder->select('*');
		$builder->where('insti_id', (int)$insti_id);
		$builder->orderBy('modl_titulo', 'ASC');
		//$builder->limit(1);
		$query = $builder->get();
		
		$rs_result = null;
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_result = $query->getResult();
			//$this->rs_event_config = $rs_event_config;
			//$this->data['rs_event_config'] = $this->rs_event_config;
		}

		return $rs_result;
	}

}