<?php
namespace App\Models;

use CodeIgniter\Model;

class GruposModel extends Model
{
	/*
		CREATE TABLE tbl_grupos (
			grp_id INT(11) NOT NULL AUTO_INCREMENT,
			grp_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			grp_urlpage VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			grp_titulo VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			grp_observacoes LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			grp_dte_cadastro DATETIME NULL DEFAULT NULL,
			grp_dte_alteracao DATETIME NULL DEFAULT NULL,
			grp_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (grp_id) USING BTREE,
			UNIQUE INDEX grp_id (grp_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;


		ALTER TABLE `tbl_cadastros`
			ADD COLUMN `grp_id` INT(11) NOT NULL DEFAULT '0' AFTER `user_id`;

		ALTER TABLE `tbl_cadastros`
			ADD INDEX `grp_id` (`grp_id`);

	*/

	protected $db = null;
    protected $table = 'tbl_grupos';
	protected $primaryKey = 'grp_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
		'insti_id',
		'user_id',
		'grp_hashkey',
		'grp_urlpage',
		'grp_titulo',
		'grp_responsavel',
		'grp_telefone',
		'grp_celular',
		'grp_whatsapp',
		'grp_cpf',
		'grp_email',
		'grp_senha',
		'grp_logotipo',
		'grp_observacoes',
		'grp_redes_sociais',

		'grp_end_cep',
		'grp_end_logradouro',
		'grp_end_numero',
		'grp_end_compl',
		'grp_end_bairro',
		'grp_end_cidade',
		'grp_end_estado',

		'grp_dte_cadastro',
		'grp_dte_alteracao',
		'grp_ativo',
    ];

	protected $session_id = null;
	protected $session_user_id = null;
	protected $session_user_nome = null;
	protected $session_user_permissao = null;
	protected $session_user_label_permissao = null;

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();


		$this->session_id = session()->get('hash_id');
		$this->session_user_id = (int)session()->get('user_id');
		$this->session_user_nome = session()->get('user_nome');
		$this->session_user_permissao = (int)session()->get('user_permissao');
    }

	public function select_all_by_insti_id()
	{

		$builder = $this->db->table('tbl_grupos');
		$builder->where('insti_id', (int)$this->session_user_id);
		$builder->orderBy('grp_id', 'DESC');
		$builder->limit(1000);
		$query = $builder->get();

		return $query; 
	}







}