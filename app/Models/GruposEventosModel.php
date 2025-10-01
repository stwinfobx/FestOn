<?php
namespace App\Models;

use CodeIgniter\Model;

class GruposEventosModel extends Model
{
	/*
		CREATE TABLE tbl_grupos_x_eventos (
			grevt_id INT(11) NOT NULL AUTO_INCREMENT,
			insti_id INT(11) NOT NULL DEFAULT '0',
			grp_id INT(11) NOT NULL DEFAULT '0',
			event_id INT(11) NOT NULL DEFAULT '0',
			grevt_dte_cadastro DATETIME NULL DEFAULT NULL,
			grevt_dte_alteracao DATETIME NULL DEFAULT NULL,
			grevt_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (grevt_id) USING BTREE,
			UNIQUE INDEX grevt_id (grevt_id) USING BTREE,
			INDEX grevt_id_2 (grevt_id) USING BTREE,
			INDEX grp_id (grp_id) USING BTREE,
			INDEX insti_id (insti_id) USING BTREE,
			INDEX event_id (event_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;

	ALTER TABLE `tbl_grupos_x_eventos`
		ADD COLUMN `grevt_hashkey` VARCHAR(250) NULL DEFAULT NULL AFTER `grevt_id`;
	*/

	protected $db = null;
    protected $table = 'tbl_grupos_x_eventos';
	protected $primaryKey = 'grevt_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
		'grevt_hashkey',
		'insti_id',
		'user_id',
		'grp_id',
		'event_id',
		'grevt_dte_cadastro',
		'grevt_dte_alteracao',
		'grevt_ativo',
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