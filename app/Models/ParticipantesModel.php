<?php
namespace App\Models;

use CodeIgniter\Model;

class ParticipantesModel extends Model
{
	/*
		CREATE TABLE `tbl_participantes` (
			`partc_id` INT(11) NOT NULL AUTO_INCREMENT,
			`partc_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`partc_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`partc_nome` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`partc_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`partc_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`partc_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`partc_id`) USING BTREE,
			UNIQUE INDEX `partc_id` (`partc_id`) USING BTREE,
			INDEX `partc_id_2` (`partc_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;

		ALTER TABLE `tbl_participantes`
			ADD COLUMN `partc_resp_nome` VARCHAR(250) NULL DEFAULT NULL AFTER `partc_file_doc_verso`,
			ADD COLUMN `partc_resp_email` VARCHAR(250) NULL DEFAULT NULL AFTER `partc_resp_nome`,
			ADD COLUMN `partc_resp_telefone` VARCHAR(250) NULL DEFAULT NULL AFTER `partc_resp_email`;

		ALTER TABLE `tbl_participantes`
			ADD COLUMN `partc_telefone` VARCHAR(250) NULL DEFAULT NULL AFTER `partc_nome_social`;

		ALTER TABLE `tbl_participantes`
			ADD COLUMN `partc_menor_idade` TINYINT(4) NULL DEFAULT '0' AFTER `partc_file_doc_verso`;
			
		ALTER TABLE `tbl_participantes`
			ADD COLUMN `uf_id` INT(11) NOT NULL DEFAULT '0' AFTER `func_id`,
			ADD COLUMN `munc_id` INT(11) NOT NULL DEFAULT '0' AFTER `uf_id`;
	*/

	protected $db = null;
    protected $table = 'tbl_participantes';
	protected $primaryKey = 'partc_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'grp_id',
		'grevt_id',
		'func_id',
		'categ_id',
		'cad_id',
		'uf_id',
		'munc_id',
		'partc_hashkey',
		'partc_urlpage',
		'partc_nome',
		'partc_nome_social',
		'partc_telefone',
		'partc_email',
		'partc_genero',
		'partc_documento',
		'partc_dte_nascto',
		'partc_file_foto',
		'partc_file_doc_frente',
		'partc_file_doc_verso',
		'partc_menor_idade',
		'partc_resp_nome',
		'partc_resp_email',
		'partc_resp_cpf',
		'partc_dte_cadastro',
		'partc_dte_alteracao',
		'partc_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

	public function select_all_by_insti_id( $insti_id = 0 )
	{
		$builder = $this->db->table( $this->table );
		$builder->where('insti_id', (int)$insti_id);
		$builder->orderBy('partc_nome', 'ASC');
		$builder->limit(3000);
		$query = $builder->get();

		return $query; 
	}

	public function select_by_func_grp_id( $args = [] )
	{
		$insti_id = (int)(isset($args['insti_id']) ? $args['insti_id'] : '');
		$func_id = (int)(isset($args['func_id']) ? $args['func_id'] : '');
		$grp_id = (int)(isset($args['grp_id']) ? $args['grp_id'] : '');

		$builder = $this->db->table( $this->table );
		$builder->select('partc_id, partc_nome, partc_documento, partc_file_foto');
		$builder->where('insti_id', (int)$insti_id);
		$builder->where('func_id', $func_id);
		$builder->where('grp_id', (int)$grp_id);
		$builder->orderBy('partc_nome', 'ASC');
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