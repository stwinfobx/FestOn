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
        // Campos da tabela antiga por-critério (fallback)
        'insti_id', 'jurd_id', 'corgf_id', 'crit_id', 'aval_hashkey', 'aval_nota', 'aval_observacao',
        'aval_finalizada', 'aval_dte_cadastro', 'aval_dte_alteracao', 'aval_ativo',
    ];

    public function __construct(?\CodeIgniter\Database\ConnectionInterface $db = null, ?\CodeIgniter\Validation\ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        // Usaremos a tabela consolidada "tbl_avaliacoes"
        $this->table = 'tbl_avaliacoes';
    }

    public function get_avaliacoes_by_jurado_coreografia($jurd_id, $corgf_id)
    {
        // Detecta se a tabela é consolidada (sem crit_id) ou legado (com crit_id)
        try {
            $fields = array_map(fn($f) => $f->name, $this->db->getFieldData($this->table));
        } catch (\Throwable $e) {
            $fields = [];
        }

        $isConsolidated = !in_array('crit_id', $fields, true);

        if (!$isConsolidated) {
            // Legado: por critério
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

        // Consolidado: uma linha por jurado x coreografia. Converter para lista por critério.
        $row = $this->db->table($this->table)
            ->where('jurd_id', (int)$jurd_id)
            ->where('corgf_id', (int)$corgf_id)
            ->where('aval_ativo', 1)
            ->limit(1)
            ->get()
            ->getRow();
        if (!$row) {
            return [];
        }

        // Buscar critérios ativos para mapear títulos -> campos
        $insti_id = (int)($row->insti_id ?? 1);
        $criterios = $this->db->table('tbl_criterios')
            ->where('insti_id', $insti_id)
            ->where('crit_ativo', 1)
            ->orderBy('crit_titulo', 'ASC')
            ->get()->getResult();

        $map = function(string $titulo) {
            $t = mb_strtolower($titulo);
            if (strpos($t, 'técnica') !== false || strpos($t, 'tecnica') !== false) return 'nota_tecnica';
            if (strpos($t, 'coreografia') !== false) return 'nota_coreografia';
            if (strpos($t, 'consist') !== false) return 'nota_consistencia';
            if (strpos($t, 'adequ') !== false) return 'nota_adequacao_etaria';
            if (strpos($t, 'fidelid') !== false) return 'nota_fidelidade';
            return '';
        };

        $result = [];
        foreach ($criterios as $c) {
            $col = $map((string)$c->crit_titulo);
            if ($col && property_exists($row, $col)) {
                $obj = (object) [
                    'crit_id' => (int)$c->crit_id,
                    'crit_titulo' => $c->crit_titulo,
                    'aval_nota' => $row->$col,
                ];
                $result[] = $obj;
            }
        }
        return $result;
    }

    public function salvar_avaliacoes($dados_avaliacoes)
    {
        // Modo legado: salva por critério na tabela antiga
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

    /**
     * Salva avaliação consolidada (todas as notas de uma vez) na tabela tbl_avaliacoes (upsert por jurd_id+corgf_id),
     * mesclando notas para evitar sobrescrita por valores nulos.
     */
    public function salvar_avaliacao_final(array $params): bool
    {
        // params: insti_id, jurd_id, corgf_id, notas(array), total(float), status_avaliacao, data_hora
        $insti_id = (int)($params['insti_id'] ?? 1);
        $jurd_id = (int)($params['jurd_id'] ?? 0);
        $corgf_id = (int)($params['corgf_id'] ?? 0);
        $notas = (array)($params['notas'] ?? []);
        $total = (float)($params['total'] ?? 0);
        $status = (string)($params['status_avaliacao'] ?? 'enviado');
        $dataHora = (string)($params['data_hora'] ?? date('Y-m-d H:i:s'));
        $db = \Config\Database::connect();
        $db->transStart();

        $builder = $db->table('tbl_avaliacoes');

        $row = [
            'insti_id' => $insti_id,
            'jurd_id' => $jurd_id,
            'corgf_id' => $corgf_id,
            'aval_hashkey' => md5(uniqid('', true)),
            'nota_tecnica' => isset($notas['tecnica']) ? (float)$notas['tecnica'] : null,
            'nota_coreografia' => isset($notas['coreografia']) ? (float)$notas['coreografia'] : null,
            'nota_consistencia' => isset($notas['consistencia']) ? (float)$notas['consistencia'] : null,
            'nota_adequacao_etaria' => isset($notas['adequacao']) ? (float)$notas['adequacao'] : null,
            'nota_fidelidade' => isset($notas['fidelidade']) && $notas['fidelidade'] !== '' ? (float)$notas['fidelidade'] : null,
            'data_hora_avaliacao' => $dataHora,
            'status_avaliacao' => $status,
            'status_selecao' => 'em_avaliacao',
            'nota_total_calculada' => $total,
            'ranking' => null,
            'aval_finalizada' => 1,
            'aval_ativo' => 1,
            'dte_cadastro' => date('Y-m-d H:i:s'),
            'dte_alteracao' => date('Y-m-d H:i:s'),
        ];

        // Upsert por jurd_id + corgf_id com MERGE de notas (não sobrescrever com null)
        $exists = $builder
            ->where('jurd_id', $jurd_id)
            ->where('corgf_id', $corgf_id)
            ->get()->getRow();

        if ($exists) {
            // Preservar notas existentes quando não forem enviadas
            $row['nota_tecnica'] = !is_null($row['nota_tecnica']) ? (float)$row['nota_tecnica'] : (float)$exists->nota_tecnica;
            $row['nota_coreografia'] = !is_null($row['nota_coreografia']) ? (float)$row['nota_coreografia'] : (float)$exists->nota_coreografia;
            $row['nota_consistencia'] = !is_null($row['nota_consistencia']) ? (float)$row['nota_consistencia'] : (float)$exists->nota_consistencia;
            $row['nota_adequacao_etaria'] = !is_null($row['nota_adequacao_etaria']) ? (float)$row['nota_adequacao_etaria'] : (float)$exists->nota_adequacao_etaria;
            $row['nota_fidelidade'] = !is_null($row['nota_fidelidade']) ? (float)$row['nota_fidelidade'] : $exists->nota_fidelidade;

            // Recalcular total final
            $totalFinal = 0.0;
            foreach (['nota_tecnica','nota_coreografia','nota_consistencia','nota_adequacao_etaria','nota_fidelidade'] as $col) {
                if ($col === 'nota_fidelidade') { if (!is_null($row[$col])) $totalFinal += (float)$row[$col]; }
                else { $totalFinal += (float)$row[$col]; }
            }
            $row['nota_total_calculada'] = $totalFinal;

            unset($row['dte_cadastro']);
            unset($row['aval_hashkey']);
            $builder->where('aval_id', (int)$exists->aval_id)->update($row);
        } else {
            // Para novos registros, garantir que todas as notas obrigatórias estejam preenchidas
            $builder->insert($row);
        }

        $db->transComplete();
        return $db->transStatus();
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
        // Coreografias ativas do grupo
        $coreoIds = $this->db->table('tbl_coreografias')
            ->select('corgf_id')
            ->where('grp_id', $grp_id)
            ->where('corgf_ativo', 1)
            ->get()->getResult();
        if (empty($coreoIds)) return false;
        $coreoIdsArr = array_map(fn($r) => (int)$r->corgf_id, $coreoIds);

        // Para tabela consolidada: verificar se TODAS as coreografias do grupo foram avaliadas
        $totalAval = $this->db->table('tbl_avaliacoes A')
            ->select('COUNT(*) AS total')
            ->where('A.jurd_id', $jurd_id)
            ->where('A.aval_ativo', 1)
            ->whereIn('A.corgf_id', $coreoIdsArr)
            ->where('A.nota_total_calculada IS NOT NULL')
            ->where('A.nota_total_calculada > 0')
            ->get()->getRow();

        // Deve ter avaliação para TODAS as coreografias do grupo
        return ((int)$totalAval->total) >= count($coreoIdsArr);
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

    /**
     * Retorna o próximo grupo ainda não completamente avaliado por este jurado.
     * Se todos estiverem completos, retorna null.
     */
    public function get_proximo_grupo_pendente(int $jurd_id, int $grp_id_atual, int $insti_id)
    {
        $builder = $this->db->table('tbl_grupos G');
        $builder->select('G.grp_id, G.grp_titulo');
        $builder->join('tbl_coreografias C', 'C.grp_id = G.grp_id AND C.corgf_ativo = 1', 'inner');
        $builder->groupBy('G.grp_id, G.grp_titulo');
        $builder->orderBy('G.grp_titulo', 'ASC');
        $grupos = $builder->get()->getResult();
        if (empty($grupos)) return null;

        // Começa a partir do próximo ao atual, em ciclo
        $order = [];
        $idxAtual = -1;
        foreach ($grupos as $i => $g) { if ((int)$g->grp_id === (int)$grp_id_atual) { $idxAtual = $i; break; } }
        for ($i = 1; $i <= count($grupos); $i++) {
            $order[] = $grupos[ ($idxAtual + $i) % count($grupos) ];
        }

        foreach ($order as $g) {
            $pendente = !$this->verificar_grupo_completo($jurd_id, (int)$g->grp_id, $insti_id);
            if ($pendente) {
                return $g;
            }
        }
        return null;
    }

    /**
     * Retorna a próxima coreografia NÃO AVALIADA por este jurado
     */
    public function get_proxima_coreografia_nao_avaliada(int $jurd_id)
    {
        // Buscar todas as coreografias ativas, ordenadas por grupo e ID
        $builder = $this->db->table('tbl_coreografias C');
        $builder->select('C.corgf_id, C.corgf_hashkey, C.grp_id, G.grp_titulo');
        $builder->join('tbl_grupos G', 'G.grp_id = C.grp_id', 'inner');
        $builder->where('C.corgf_ativo', 1);
        $builder->orderBy('G.grp_titulo', 'ASC');
        $builder->orderBy('C.corgf_id', 'ASC');
        $coreografias = $builder->get()->getResult();
        
        if (empty($coreografias)) return null;
        
        // Para cada coreografia, verificar se já foi avaliada por este jurado
        foreach ($coreografias as $coreografia) {
            $ja_avaliada = $this->db->table('tbl_avaliacoes')
                ->where('jurd_id', $jurd_id)
                ->where('corgf_id', (int)$coreografia->corgf_id)
                ->where('aval_ativo', 1)
                ->where('nota_total_calculada IS NOT NULL')
                ->where('nota_total_calculada > 0')
                ->countAllResults() > 0;
                
            if (!$ja_avaliada) {
                return $coreografia;
            }
        }
        
        return null; // Todas já foram avaliadas
    }

    /**
     * Lista todas as avaliações de um grupo específico
     */
    public function get_avaliacoes_por_grupo(int $grp_id, int $jurd_id = null)
    {
        $builder = $this->db->table('tbl_avaliacoes A');
        $builder->select('A.*, C.corgf_titulo, C.corgf_coreografo, G.grp_titulo');
        $builder->join('tbl_coreografias C', 'C.corgf_id = A.corgf_id', 'inner');
        $builder->join('tbl_grupos G', 'G.grp_id = C.grp_id', 'inner');
        $builder->where('C.grp_id', $grp_id);
        $builder->where('A.aval_ativo', 1);
        
        if ($jurd_id) {
            $builder->where('A.jurd_id', $jurd_id);
        }
        
        $builder->orderBy('C.corgf_id', 'ASC');
        return $builder->get()->getResult();
    }

    /**
     * Lista todos os grupos com suas avaliações
     */
    public function get_grupos_com_avaliacoes(int $jurd_id = null)
    {
        $builder = $this->db->table('tbl_grupos G');
        $builder->select('G.grp_id, G.grp_titulo, COUNT(A.aval_id) as total_avaliacoes');
        $builder->join('tbl_coreografias C', 'C.grp_id = G.grp_id AND C.corgf_ativo = 1', 'left');
        $builder->join('tbl_avaliacoes A', 'A.corgf_id = C.corgf_id AND A.aval_ativo = 1', 'left');
        
        if ($jurd_id) {
            $builder->where('A.jurd_id', $jurd_id);
        }
        
        $builder->groupBy('G.grp_id, G.grp_titulo');
        $builder->orderBy('G.grp_titulo', 'ASC');
        return $builder->get()->getResult();
    }
}
