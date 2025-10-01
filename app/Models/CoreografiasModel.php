<?php
namespace App\Models;

use CodeIgniter\Model;

class CoreografiasModel extends Model
{
	/*
		CREATE TABLE `tbl_coreografias` (
			`corgf_id` INT(11) NOT NULL AUTO_INCREMENT,
			`corgf_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`corgf_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`corgf_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`corgf_coreografo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`corgf_musica` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`corgf_tempo` VARCHAR(30) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`corgf_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`corgf_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`corgf_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`corgf_id`) USING BTREE,
			UNIQUE INDEX `corgf_id` (`corgf_id`) USING BTREE,
			INDEX `corgf_id_2` (`corgf_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_coreografias';
	protected $primaryKey = 'corgf_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
		'insti_id',
		'grp_id',
		'modl_id',
		'formt_id',
		'categ_id',
		'corgf_hashkey',
		'corgf_urlpage',
		'corgf_titulo',
		'corgf_coreografo',
		'corgf_musica_file',
		'corgf_musica',
		'corgf_compositor',
		'corgf_tempo',
		'corgf_observacao',
		'corgf_linkvideo',
		'corgf_dte_cadastro',
		'corgf_dte_alteracao',
		'corgf_ativo',
    ];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

	public function lista_por_grupo( $insti_id = 0, $grp_id = 0 )
	{
		//$builder = $this->db->table( $this->table );
		//$builder->where('insti_id', (int)$insti_id);
		//$builder->orderBy('categ_titulo', 'ASC');
		//$builder->limit(1000);
		//$query = $builder->get();

		$builder = $this->db->table('tbl_coreografias CORF')
			->select('CORF.*')
			->select('MODL.modl_titulo')
			->select('FORMT.formt_titulo')
			->select('CATEG.categ_titulo')
			->join('tbl_modalidades MODL', 'MODL.modl_id = CORF.modl_id', 'LEFT')
			->join('tbl_formatos FORMT', 'FORMT.formt_id = CORF.formt_id', 'LEFT')
			->join('tbl_categorias CATEG', 'CATEG.categ_id = CORF.categ_id', 'LEFT')
			->where('CORF.insti_id', (int)$insti_id)
			->where('CORF.grp_id', (int)$grp_id)
			->orderBy('CORF.corgf_id', 'ASC');
		$query = $builder->get();
		return $query; 
	}

	public function select_by_grp_id( $args = [] )
	{
		$insti_id = (int)(isset($args['insti_id']) ? $args['insti_id'] : '');
		$grp_id = (int)(isset($args['grp_id']) ? $args['grp_id'] : '');		

		$builder = $this->db->table( $this->table );
		$builder->from('tbl_coreografias CORF', true)
			->select('CORF.*')
			->select('MODL.modl_titulo')
			->select('FORMT.formt_titulo')
			->select('CATEG.categ_titulo')
			->join('tbl_modalidades MODL', 'MODL.modl_id = CORF.modl_id', 'LEFT')
			->join('tbl_formatos FORMT', 'FORMT.formt_id = CORF.formt_id', 'LEFT')
			->join('tbl_categorias CATEG', 'CATEG.categ_id = CORF.categ_id', 'LEFT')
			->where('CORF.insti_id', (int)$insti_id)
			->where('CORF.grp_id', (int)$grp_id)
			->orderBy('CORF.corgf_id', 'ASC')
			->limit(300);
		$query = $builder->get();	

		$rs_result = null;
		if( $query && $query->resultID->num_rows >=1 )
		{
			$rs_result = $query->getResult();
		}
		
		return $rs_result;
	}

}