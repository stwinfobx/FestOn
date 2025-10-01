<?php
namespace App\Models;

use CodeIgniter\Model;

class FormatosModel extends Model
{
	/*
		CREATE TABLE `tbl_formatos` (
			`formt_id` INT(11) NOT NULL AUTO_INCREMENT,
			`insti_id` INT(11) NOT NULL DEFAULT '0',
			`formt_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`formt_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`formt_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`formt_tempo_limit` TIME NULL DEFAULT NULL,
			`formt_max_partic` INT(11) NOT NULL DEFAULT '0',
			`formt_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`formt_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`formt_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`formt_id`) USING BTREE,
			UNIQUE INDEX `formt_id` (`formt_id`) USING BTREE,
			INDEX `formt_id_2` (`formt_id`) USING BTREE,
			INDEX `insti_id` (`insti_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		;

		ALTER TABLE `tbl_formatos`
			ADD COLUMN `formt_min_partic` INT(11) NULL DEFAULT '0' AFTER `formt_tempo_limit`;
	*/

	protected $db = null;
    protected $table = 'tbl_formatos';
	protected $primaryKey = 'formt_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'formt_hashkey',
		'formt_urlpage',
		'formt_titulo',
		'formt_tempo_limit',
		'formt_min_partic',
		'formt_max_partic',
		'formt_dte_cadastro',
		'formt_dte_alteracao',
		'formt_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

	public function select_all_by_insti_id_old( $insti_id = 0 )
	{
		$builder = $this->db->table( $this->table );
		$builder->where('insti_id', (int)$insti_id);
		$builder->orderBy('formt_titulo', 'ASC');
		$builder->limit(1000);
		$query = $builder->get();

		return $query; 
	}
	public function select_all_by_insti_id( $insti_id = 0 )
	{
		$builder = $this->db->table( $this->table );
		$builder->select('*');
		$builder->where('insti_id', (int)$insti_id);
		$builder->orderBy('formt_titulo', 'ASC');
		//$builder->limit(1);
		$query = $builder->get();
		
		$rs_result = null;
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_result = $query->getResult();
		}

		return $rs_result;
	}	

}