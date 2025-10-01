<?php
namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
	/*
		CREATE TABLE status (
			id INT(11) NOT NULL AUTO_INCREMENT,
			status VARCHAR(20) NOT NULL COLLATE 'utf8_unicode_ci',
			del INT(1) NOT NULL DEFAULT '0',
			PRIMARY KEY (id) USING BTREE
		)
		COLLATE='utf8_unicode_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=6
		;
	*/

	protected $db = null;
    protected $table = 'status';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'status',
		'del',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

}