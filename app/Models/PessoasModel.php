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
	*/

	protected $db = null;
    protected $table = 'tbl_participantes';
	protected $primaryKey = 'partc_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'grp_id',
		'func_id',
		'categ_id',
		'partc_hashkey',
		'partc_urlpage',
		'partc_nome',
		'partc_nome_social',
		'partc_email',
		'partc_genero',
		'partc_documento',
		'partc_dte_nascto',
		'partc_file_foto',
		'partc_file_doc_frente',
		'partc_file_doc_verso',
		'partc_dte_cadastro',
		'partc_dte_alteracao',
		'partc_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();

		$this->session_id = session()->get('hash_id');
		$this->session_user_id = (int)session()->get('user_id');
		$this->session_user_nome = session()->get('user_nome');
		$this->session_user_permissao = (int)session()->get('user_permissao');
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

}