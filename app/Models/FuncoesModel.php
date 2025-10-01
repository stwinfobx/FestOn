<?php
namespace App\Models;

use CodeIgniter\Model;

class FuncoesModel extends Model
{
	/*
		CREATE TABLE `tbl_funcoes` (
			`func_id` INT(11) NOT NULL AUTO_INCREMENT,
			`func_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`func_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`func_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`func_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`func_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`func_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`func_id`) USING BTREE,
			UNIQUE INDEX `func_id` (`func_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_funcoes';
	protected $primaryKey = 'func_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'func_titulo',
		'func_obrigatorio',
		'func_dte_cadastro',
		'func_dte_alteracao',
		'func_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }
	
	public function select_all()
	{
		$builder = $this->db->table( $this->table );
		$builder->select('*');
		$builder->where('func_ativo', 1);
		$builder->orderBy('func_titulo', 'ASC');
		$builder->limit(1000);
		$query = $builder->get();
		
		$rs_result = null;
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_result = $query->getResult();
		}

		return $rs_result;
	}

}