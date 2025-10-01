<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	/*
		CREATE TABLE tbl_usuarios (
			user_id INT(11) NOT NULL AUTO_INCREMENT,
			user_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
			user_activekey VARCHAR(250) NULL DEFAULT NULL,
			user_urlpage VARCHAR(250) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
			user_nome VARCHAR(250) NULL DEFAULT NULL,
			user_login VARCHAR(250) NULL DEFAULT NULL,
			user_email VARCHAR(250) NULL DEFAULT NULL,
			user_senha VARCHAR(250) NULL DEFAULT NULL,
			user_evento VARCHAR(250) NULL DEFAULT NULL,
			user_dte_cadastro DATETIME NULL DEFAULT NULL,
			user_dte_alteracao DATETIME NULL DEFAULT NULL,
			user_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (user_id),
			UNIQUE INDEX user_id (user_id)
		)
		COLLATE='utf8_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_usuarios';
	protected $primaryKey = 'user_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
		'user_nivel',
		'user_hashkey',
		'user_activekey',
		'user_urlpage',
		'user_nome',
		'user_sobrenome',
		'user_login',
		'user_email',
		'user_senha',
		'user_evento',
		'user_hash_evento',
		'user_dte_cadastro',
		'user_dte_alteracao',
		'user_ativo',
    ];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

	public function select_all()
	{
		$builder = $this->db->table('tbl_usuarios');
		$builder->select('*');
		$builder->limit(100);
		$query = $builder->get();

		return $query; 
	}

	public function select_by_id($cad_id)
	{
		$builder = $this->db->table('tbl_usuarios');
		$builder->select('*');
		$builder->where('cad_id ', $cad_id);
		$builder->limit(1);
		$query = $builder->get();

		return $query; 
	}	

	public function updateByHashkey($where, $data)
	{
		$builder = $this->db->table('tbl_usuarios');
		$builder->update($data, $where);
		//$builder->where($where);
		//$builder->update($data);


		//echo $builder->getCompiledSelect();
		//echo( $builder->getCompiledUpdate() );
		//return $query; 
	}	

}