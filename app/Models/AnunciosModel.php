<?php
namespace App\Models;

use CodeIgniter\Model;

class AnunciosModel extends Model
{
	/*
		CREATE TABLE tbl_anuncios (
			anunc_id INT(11) NOT NULL AUTO_INCREMENT,
			anunc_hashkey VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_urlpage VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_area VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_titulo VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_subtitulo VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_descricao VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_file_banner VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_redirect VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			anunc_dte_cadastro DATETIME NULL DEFAULT NULL,
			anunc_dte_alteracao DATETIME NULL DEFAULT NULL,
			anunc_ativo TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (anunc_id) USING BTREE,
			UNIQUE INDEX anunc_id (anunc_id) USING BTREE,
			INDEX anunc_id_2 (anunc_id) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		;
	*/

	protected $db = null;
    protected $table = 'tbl_anuncios';
	protected $primaryKey = 'anunc_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'anunc_hashkey',
		'anunc_urlpage', 
		'anunc_area', 
		'anunc_titulo', 
		'anunc_subtitulo', 
		'anunc_descricao', 
		'anunc_file_banner', 
		'anunc_redirect', 
		'anunc_dte_cadastro', 
		'anunc_dte_alteracao', 
		'anunc_ativo'
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}