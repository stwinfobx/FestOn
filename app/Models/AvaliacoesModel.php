<?php
namespace App\Models;

use CodeIgniter\Model;

class AvaliacoesModel extends Model
{
    protected $table = 'tbl_avaliacoes';
    protected $primaryKey = 'aval_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = [
        'insti_id',
        'jurd_id',
        'corgf_id',
        'crit_id',
        'aval_hashkey',
        'aval_nota',
        'aval_observacao',
        'aval_finalizada',
        'aval_dte_cadastro',
        'aval_dte_alteracao',
        'aval_ativo',
    ];

    public function get_avaliacoes_by_jurado_coreografia($jurd_id, $corgf_id)
    {
        $builder = $this->db->table($this->table . ' A');
        $builder->select('A.*, C.crit_titulo');
        $builder->join('tbl_criterios C', 'C.crit_id = A.crit_id', 'left');
        $builder->where('A.jurd_id', (int)$jurd_id);
        $builder->where('A.corgf_id', (int)$corgf_id);
        $builder->where('A.aval_ativo', 1);
        $builder->orderBy('C.crit_titulo', 'ASC');
        $query = $builder->get();
        return $query ? $query->getResult() : [];
    }

    public function salvar_avaliacoes($dados_avaliacoes)
    {
        log_message('debug', 'AvaliacoesModel::salvar_avaliacoes - dados recebidos: ' . print_r($dados_avaliacoes, true));
        
        $db = \Config\Database::connect();
        $db->transStart();
        foreach ($dados_avaliacoes as $avaliacao) {
            log_message('debug', 'Processando avaliação: ' . print_r($avaliacao, true));
            
            $existing = $this->where([
                'jurd_id' => (int)$avaliacao['jurd_id'],
                'corgf_id' => (int)$avaliacao['corgf_id'],
                'crit_id' => (int)$avaliacao['crit_id'],
                'aval_ativo' => 1,
            ])->first();
            
            if ($existing) {
                log_message('debug', 'Atualizando avaliação existente ID: ' . $existing->aval_id);
                $this->update($existing->aval_id, [
                    'aval_nota' => (float)$avaliacao['aval_nota'],
                    'aval_dte_alteracao' => date('Y-m-d H:i:s'),
                ]);
            } else {
                log_message('debug', 'Inserindo nova avaliação');
                $this->insert([
                    'insti_id' => (int)$avaliacao['insti_id'],
                    'jurd_id' => (int)$avaliacao['jurd_id'],
                    'corgf_id' => (int)$avaliacao['corgf_id'],
                    'crit_id' => (int)$avaliacao['crit_id'],
                    'aval_hashkey' => md5(uniqid('', true)),
                    'aval_nota' => (float)$avaliacao['aval_nota'],
                    'aval_finalizada' => 0,
                    'aval_dte_cadastro' => date('Y-m-d H:i:s'),
                    'aval_dte_alteracao' => date('Y-m-d H:i:s'),
                    'aval_ativo' => 1,
                ]);
            }
        }
        $db->transComplete();
        $status = $db->transStatus();
        log_message('debug', 'AvaliacoesModel::salvar_avaliacoes - status da transação: ' . ($status ? 'SUCESSO' : 'ERRO'));
        return $status;
    }

    public function finalizar_coreografia($jurd_id, $corgf_id)
    {
        $builder = $this->db->table($this->table);
        $builder->set('aval_finalizada', 1);
        $builder->set('aval_dte_alteracao', date('Y-m-d H:i:s'));
        $builder->where('jurd_id', (int)$jurd_id);
        $builder->where('corgf_id', (int)$corgf_id);
        $builder->where('aval_ativo', 1);
        return $builder->update();
    }

    public function verificar_grupo_completo(int $jurd_id, int $grp_id, int $insti_id): bool
    {
        // Quantidade de critérios ativos da instituição
        $critCount = $this->db->table('tbl_criterios')
            ->where('insti_id', $insti_id)
            ->where('crit_ativo', 1)
            ->countAllResults();
        if ($critCount <= 0) return false;

        // Coreografias ativas do grupo
        $coreoIds = $this->db->table('tbl_coreografias')
            ->select('corgf_id')
            ->where('grp_id', $grp_id)
            ->where('corgf_ativo', 1)
            ->get()->getResult();
        if (empty($coreoIds)) return false;
        $coreoIdsArr = array_map(fn($r) => (int)$r->corgf_id, $coreoIds);

        // Total esperado = critérios x coreografias
        $totalEsperado = $critCount * count($coreoIdsArr);

        // Total de avaliações existentes (nota não nula) para este jurado neste grupo
        $totalAval = $this->db->table('tbl_avaliacoes A')
            ->select('COUNT(*) AS total')
            ->where('A.jurd_id', $jurd_id)
            ->where('A.aval_ativo', 1)
            ->whereIn('A.corgf_id', $coreoIdsArr)
            ->where('A.aval_nota IS NOT NULL')
            ->get()->getRow();

        return ((int)$totalAval->total) >= $totalEsperado;
    }


    public function finalizar_grupo(int $jurd_id, int $grp_id): bool
    {
        // Finaliza TODAS as avaliações das coreografias do grupo para este jurado
        $coreografias = $this->db->table('tbl_coreografias')
            ->select('corgf_id')
            ->where('grp_id', $grp_id)
            ->where('corgf_ativo', 1)
            ->get()->getResult();
        
        if (empty($coreografias)) return true;
        
        $corgf_ids = array_map(fn($c) => (int)$c->corgf_id, $coreografias);
        
        $builder = $this->db->table($this->table);
        $builder->set('aval_finalizada', 1);
        $builder->set('aval_dte_alteracao', date('Y-m-d H:i:s'));
        $builder->where('jurd_id', $jurd_id);
        $builder->whereIn('corgf_id', $corgf_ids);
        $builder->where('aval_ativo', 1);
        return $builder->update();
    }

    public function get_primeira_coreografia_de_grupo($grp_id)
    {
        $builder = $this->db->table('tbl_coreografias');
        $builder->select('corgf_hashkey');
        $builder->where('grp_id', (int)$grp_id);
        $builder->where('corgf_ativo', 1);
        $builder->orderBy('corgf_id', 'ASC');
        $builder->limit(1);
        $query = $builder->get();
        return $query ? $query->getRow() : null;
    }

    public function get_proximo_grupo($grp_id_atual)
    {
        // Próximo grupo por ordem alfabética (cíclico)
        $builder = $this->db->table('tbl_grupos G');
        $builder->select('G.grp_id, G.grp_titulo');
        $builder->join('tbl_coreografias C', 'C.grp_id = G.grp_id AND C.corgf_ativo = 1', 'inner');
        $builder->groupBy('G.grp_id, G.grp_titulo');
        $builder->orderBy('G.grp_titulo', 'ASC');
        $query = $builder->get();
        $grupos = $query ? $query->getResult() : [];
        if (empty($grupos)) return null;
        // Encontrar o índice do atual e retornar o próximo (ou o primeiro)
        $idxAtual = -1;
        foreach ($grupos as $i => $g) {
            if ((int)$g->grp_id === (int)$grp_id_atual) { $idxAtual = $i; break; }
        }
        $nextIdx = ($idxAtual >= 0 && $idxAtual + 1 < count($grupos)) ? $idxAtual + 1 : 0;
        return $grupos[$nextIdx];
    }
}
