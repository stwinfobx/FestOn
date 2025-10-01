<?php
namespace App\Models;

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
	/*
		CREATE TABLE `tbl_municipios` (
			`munc_id` INT(11) NOT NULL,
			`uf_id` INT(11) NOT NULL,
			`munc_nome` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
			PRIMARY KEY (`munc_id`) USING BTREE,
			INDEX `ufid` (`uf_id`) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		;
	*/

	protected $db = null;
    protected $table = 'tbl_municipios';
	protected $primaryKey = 'munc_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
        'uf_id',
        'munc_nome',
    ];


    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }


	public function getBy_estado_id( $uf_id = 0 )
	{
		$builder = $this->db->table( $this->table );
		$builder->where('uf_id', (int)$uf_id);
		$builder->orderBy('munc_nome', 'ASC');
		$builder->limit(2000);
		$query = $builder->get();

		return $query; 
	}

	public function getBy_estado_sigla( $uf_sigla = '' )
	{
		$builder = $this->db->table('tbl_municipios MUNC')
			->select('MUNC.*')
			->select('UF.uf_sigla')
			->join('tbl_estados UF', 'UF.uf_id = MUNC.uf_id', 'INNER')
			->where('UF.uf_sigla', $uf_sigla)
			->orderBy('MUNC.munc_nome', 'ASC');
		$query = $builder->get();

		return $query; 
	}

}