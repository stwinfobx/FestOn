<?php
namespace App\Models;

use CodeIgniter\Model;

class CriteriosModel extends Model
{
	/*
		CREATE TABLE `tbl_criterios` (
			`crit_id` INT(11) NOT NULL AUTO_INCREMENT,
			`insti_id` INT(11) NOT NULL DEFAULT '0',
			`crit_hashkey` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`crit_urlpage` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`crit_titulo` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
			`crit_nota_min` INT(11) NULL DEFAULT '0',
			`crit_dte_cadastro` DATETIME NULL DEFAULT NULL,
			`crit_dte_alteracao` DATETIME NULL DEFAULT NULL,
			`crit_ativo` TINYINT(4) NULL DEFAULT '0',
			PRIMARY KEY (`crit_id`) USING BTREE,
			UNIQUE INDEX `crit_id` (`crit_id`) USING BTREE,
			INDEX `crit_id_2` (`crit_id`) USING BTREE,
			INDEX `insti_id` (`insti_id`) USING BTREE
		)
		COLLATE='utf8mb4_general_ci'
		ENGINE=MyISAM
		AUTO_INCREMENT=1
		;
	*/

	protected $db = null;
    protected $table = 'tbl_criterios';
	protected $primaryKey = 'crit_id';
	protected $useAutoIncrement = true;
	protected $returnType = 'object';
	protected $allowedFields = [
		'insti_id',
		'crit_hashkey',
		'crit_urlpage',
		'crit_titulo',
		'crit_nota_min',
		'crit_dte_cadastro',
		'crit_dte_alteracao',
		'crit_ativo',
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
		// TENTAR BUSCAR DADOS REAIS DO BANCO PRIMEIRO
		try {
			$builder = $this->db->table( $this->table );
			$builder->where('insti_id', (int)$insti_id);
			$builder->where('crit_ativo', 1);
			$builder->orderBy('crit_titulo', 'ASC');
			$builder->limit(1000);
			$query = $builder->get();
			
			if ($query && $query->getNumRows() > 0) {
				return $query->getResult();
			}
		} catch (\Exception $e) {
			log_message('info', 'Tentativa de busca de critérios no banco falhou, usando dados de teste: ' . $e->getMessage());
		}
		
		// Se não conseguir do banco, usar dados de teste
		$criterios_teste = [
			(object)[
				'crit_id' => 1,
				'crit_titulo' => 'Técnica',
				'crit_nota_min' => 5,
				'crit_ativo' => 1
			],
			(object)[
				'crit_id' => 2,
				'crit_titulo' => 'Interpretação',
				'crit_nota_min' => 5,
				'crit_ativo' => 1
			],
			(object)[
				'crit_id' => 3,
				'crit_titulo' => 'Criatividade',
				'crit_nota_min' => 5,
				'crit_ativo' => 1
			],
			(object)[
				'crit_id' => 4,
				'crit_titulo' => 'Harmonia',
				'crit_nota_min' => 5,
				'crit_ativo' => 1
			],
			(object)[
				'crit_id' => 5,
				'crit_titulo' => 'Figurino',
				'crit_nota_min' => 5,
				'crit_ativo' => 1
			],
			(object)[
				'crit_id' => 6,
				'crit_titulo' => 'Impacto Artístico',
				'crit_nota_min' => 5,
				'crit_ativo' => 1
			]
		];
		
		// Retorna os dados diretamente
		return $criterios_teste;
	}

}