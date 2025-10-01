<?php
namespace App\Models;

use CodeIgniter\Model;

class EstadosModel extends Model
{
	/*
		CREATE TABLE `tbl_estados` (
			`uf_id` INT(11) NOT NULL,
			`uf_nome` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			`uf_sigla` CHAR(2) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			PRIMARY KEY (`uf_id`) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		;
	*/

	protected $db = null;
    protected $table = 'tbl_estados';
	protected $primaryKey = 'uf_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
        'uf_nome',
		'uf_sigla',
    ];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

	public function select_all()
	{
		$builder = $this->db->table( $this->table );
		$builder->select('uf_id, uf_nome, uf_sigla');
		$builder->orderBy('uf_nome', 'ASC');
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