<?php
namespace App\Models;

use CodeIgniter\Model;

class EventosConfigModel extends Model
{
	/*
		CREATE TABLE `tbl_eventos_config` (
			`evcfg_id` INT(11) NOT NULL AUTO_INCREMENT,
			`event_id` INT(11) NOT NULL DEFAULT '0',
			`evcfg_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`evcfg_max_diretores` INT(11) NOT NULL DEFAULT '0', 
			`evcfg_max_assistentes` INT(11) NOT NULL DEFAULT '0', 
			`evcfg_max_coreografos` INT(11) NOT NULL DEFAULT '0', 
			`evcfg_max_coreogf_grupo` INT(11) NOT NULL DEFAULT '0', 
			`evcfg_seletiva` TINYINT(4) NULL DEFAULT '0',
			`evcfg_seletiva_taxa` DECIMAL(16,2) NULL DEFAULT NULL,
			`evcfg_classificacao` TINYINT(4) NULL DEFAULT '0',
			`evcfg_forma_cobranca` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`evcfg_exigir_foto_partic` TINYINT(4) NULL DEFAULT '0',
			`evcfg_exigir_foto_doc` TINYINT(4) NULL DEFAULT '0',
			`evcfg_envio_musica` TINYINT(4) NULL DEFAULT '0',
			`evcfg_quesitos` TINYINT(4) NULL DEFAULT '0',
			`evcfg_show_agenda_site` TINYINT(4) NULL DEFAULT '0',
			`evcfg_show_ordem_apres_site` TINYINT(4) NULL DEFAULT '0',
			`evcfg_show_ordem_ensaio_site` TINYINT(4) NULL DEFAULT '0',
			`evcfg_agrupar_ensaios` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`evcfg_perm_bailarino_grupos` TINYINT(4) NULL DEFAULT '0',
			`evcfg_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`evcfg_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`evcfg_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`evcfg_id`) USING BTREE,
			UNIQUE INDEX `evcfg_id` (`evcfg_id`) USING BTREE,
			INDEX `event_id` (`event_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
		
		ALTER TABLE `tbl_eventos_config`
			ADD COLUMN `evcfg_doacao_entrega_cred` TINYINT(4) NULL DEFAULT '0' AFTER `evcfg_perm_bailarino_grupos`,
			ADD COLUMN `evcfg_doacao_entrega_dte_ini` DATE NULL DEFAULT '0' AFTER `evcfg_doacao_entrega_cred`,
			ADD COLUMN `evcfg_doacao_entrega_dte_fim` DATE NULL DEFAULT '0' AFTER `evcfg_doacao_entrega_dte_ini`;
			
		ALTER TABLE `tbl_eventos_config`
			ADD COLUMN `evcfg_forma_cobranca_tipo` VARCHAR(100) NULL DEFAULT NULL AFTER `evcfg_classificacao`;
			
		ALTER TABLE `tbl_eventos_config`
			ADD COLUMN `event_seletiva_result` TINYINT(4) NULL DEFAULT '0' AFTER `evcfg_seletiva_taxa`;	
			
		ALTER TABLE `tbl_eventos_config`
			ADD COLUMN `evcfg_exigir_documento` TINYINT(4) NULL DEFAULT '0' AFTER `evcfg_exigir_foto_doc`;
			
	*/

	protected $db = null;
    protected $table = 'tbl_eventos_config';
	protected $primaryKey = 'evcfg_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'event_id',
		'evcfg_hashkey',
		'evcfg_func_limites',
		//'evcfg_max_diretores',  
		//'evcfg_max_assistentes', 
		//'evcfg_max_coreografos',
		'evcfg_max_coreogf_grupo', 
		'evcfg_seletiva',
		'evcfg_seletiva_taxa',
		'event_seletiva_result',
		'evcfg_classificacao',
		'evcfg_forma_cobranca_tipo',
		'evcfg_forma_cobranca',
		'evcfg_exigir_foto_partic',
		'evcfg_exigir_foto_doc',
		'evcfg_envio_musica',
		'evcfg_quesitos',
		'evcfg_show_agenda_site',
		'evcfg_show_ordem_apres_site',
		'evcfg_show_ordem_ensaio_site',
		'evcfg_agrupar_ensaios',
		'evcfg_perm_bailarino_grupos',
		'evcfg_doacao_entrega_forma',
		'evcfg_doacao_entrega_dte_ini',
		'evcfg_doacao_entrega_dte_fim',
		'evcfg_dte_cadastro',
		'evcfg_dte_alteracao',
		'evcfg_ativo',
	];

    protected function initialize()
    {
		//$this->allowedFields[] = 'middlename';
		$db = \Config\Database::connect();
    }

	public function get_by_id( $event_id = 0 )
	{
		$builder = $this->db->table( $this->table );
		$builder->select('*');
		$builder->where('event_id', (int)$event_id);
		$builder->orderBy('event_id', 'DESC');
		$builder->limit(1);
		$query_event_config = $builder->get();
		
		$rs_event_config = null;
		if( $query_event_config && $query_event_config->resultID->num_rows >=1 )
		{
			$rs_event_config = $query_event_config->getRow();
			//$this->rs_event_config = $rs_event_config;
			//$this->data['rs_event_config'] = $this->rs_event_config;
		}

		return $rs_event_config;
	}
	
	
	
	

}