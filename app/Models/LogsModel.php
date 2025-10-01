<?php
namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model
{
	/*
		CREATE TABLE tbl_logs (
			log_id INT(11) NOT NULL AUTO_INCREMENT,
			cad_id INT(11) NULL DEFAULT NULL,
			log_tipo VARCHAR(250) NULL DEFAULT NULL,
			log_ip VARCHAR(250) NULL DEFAULT NULL,
			log_infos_server LONGTEXT NULL,
			log_fields LONGTEXT NULL,
			log_url VARCHAR(250) NULL DEFAULT NULL,
			log_dte_cadastro DATETIME NULL DEFAULT NULL,
			log_dte_alteracao DATETIME NULL DEFAULT NULL,
			PRIMARY KEY (log_id),
			UNIQUE INDEX log_id (log_id)
		)
		COLLATE='utf8_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_logs';
	protected $primaryKey = 'log_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
    protected $allowedFields = [
		'cad_id',
		'log_tipo',
		'log_ip',
		'log_infos_server',
		'log_fields',
		'log_url',
		'log_dte_cadastro',
		'log_dte_alteracao'
    ];

    protected function initialize()
    {
		$db = \Config\Database::connect();
    }

	public function select_all()
	{
		$builder = $this->db->table('tbl_logs');
		$builder->select('*');
		$builder->limit(100);
		$query = $builder->get();

		return $query; 
	}

	public function save_log( $fields )
	{
		$dataR = array();

		$log_tipo = (isset($fields['log_tipo']) ? $fields['log_tipo'] : "");
		$cad_id = (int)(isset($fields['cad_id']) ? $fields['cad_id'] : "");

		$log_ip = "";
		$ip_remoto = "";
		if (isset($_SERVER['REMOTE_ADDR'])){
			$ip_remoto = $_SERVER['REMOTE_ADDR'];
		}
		if (!empty( $_SERVER['HTTP_CLIENT_IP'])) {
			$log_ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) {
			//to check ip passed from proxy
			$log_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$log_ip = $_SERVER['REMOTE_ADDR'];
		}

		$log_infos_server = array(
			"user_agent" => $_SERVER['HTTP_USER_AGENT'],
		);
		$log_fields = (isset($fields) ? $fields : array());

		$data_db = [
			'cad_id' => $cad_id,
			'log_url' => '',
			'log_ip' => $log_ip,
			'log_tipo' => $log_tipo,
			'log_infos_server' => json_encode($log_infos_server),
			'log_fields' => json_encode($log_fields),
			'log_dte_cadastro' => date("Y-m-d H:i:s"),
			'log_dte_alteracao' => date("Y-m-d H:i:s"),
		];
		//$log_id = $this->db->insert($data_db);
		$builder = $this->db->table('tbl_logs');
		$builder->insert($data_db);

		return $dataR;	
	}
}