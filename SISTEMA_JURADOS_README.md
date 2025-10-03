# 🎭 Sistema de Jurados - FestOn

## 📋 Visão Geral

O Sistema de Jurados é um módulo completo para avaliação de coreografias em festivais de dança. Permite que jurados avaliem coreografias seguindo critérios específicos, com sistema de navegação inteligente e salvamento automático.

## 🏗️ Arquitetura do Sistema

### 📁 Estrutura de Arquivos

```
app/
├── Controllers/
│   └── Jurados.php                 # Controller principal
├── Models/
│   ├── AvaliacoesModel.php        # Model de avaliações
│   ├── JuradosModel.php           # Model de jurados
│   ├── CoreografiasModel.php      # Model de coreografias
│   └── GruposModel.php            # Model de grupos
└── Views/
    └── jurados/
        └── index.php              # Interface principal

public/assets/vue/
└── jurados-avaliacao.js          # Frontend Vue.js

database/
└── database_avaliacoes_compacto.sql  # Schema do banco
```

## 🎯 Funcionalidades Principais

### ✅ Sistema de Avaliação
- **Critérios Dinâmicos**: Técnica, Coreografia, Consistência, Adequação Etária
- **Critério Condicional**: "Fidelidade" apenas para "Balé Clássico de Repertório"
- **Notas de 0 a 10**: Validação automática de range
- **Salvamento Local**: Persistência no localStorage do navegador
- **Salvamento em Lote**: Todas as coreografias do grupo de uma vez

### 🧭 Navegação Inteligente
- **Pular Avaliadas**: Jurado não vê coreografias já avaliadas
- **Próxima Automática**: Redirecionamento para próxima não avaliada
- **Grupo Completo**: Botão só ativa quando todas as coreografias estão preenchidas

### 🎨 Interface Moderna
- **Design Responsivo**: Funciona em desktop e mobile
- **Filtros Suspensos**: Modal compacto no canto superior direito
- **Feedback Visual**: Botões mudam de cor conforme status
- **Dados do Jurado**: Exibe nome e foto do jurado logado

## 🗄️ Banco de Dados

### 📊 Tabela `tbl_avaliacoes` (Consolidada)

```sql
CREATE TABLE `tbl_avaliacoes` (
  `aval_id` int(11) NOT NULL AUTO_INCREMENT,
  `insti_id` int(11) NOT NULL DEFAULT 0,
  `jurd_id` int(11) NOT NULL,
  `corgf_id` int(11) NOT NULL,
  `aval_hashkey` varchar(250) DEFAULT NULL,
  
  -- Notas por critério
  `nota_tecnica` decimal(5,2) DEFAULT NULL,
  `nota_coreografia` decimal(5,2) DEFAULT NULL,
  `nota_consistencia` decimal(5,2) DEFAULT NULL,
  `nota_adequacao_etaria` decimal(5,2) DEFAULT NULL,
  `nota_fidelidade` decimal(5,2) DEFAULT NULL,
  
  -- Campos calculados
  `nota_total_calculada` decimal(5,2) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  
  -- Status
  `status_avaliacao` enum('pendente','enviado','com_erro') DEFAULT 'pendente',
  `status_selecao` enum('selecionada','não_selecionada','em_avaliação') DEFAULT 'em_avaliação',
  `aval_finalizada` tinyint(1) DEFAULT 0,
  
  -- Controle
  `data_hora_avaliacao` datetime DEFAULT NULL,
  `aval_ativo` tinyint(1) DEFAULT 1,
  `dte_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `dte_alteracao` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`aval_id`),
  UNIQUE KEY `uq_jurado_coreografia` (`jurd_id`, `corgf_id`),
  KEY `idx_insti_id` (`insti_id`),
  KEY `idx_jurd_id` (`jurd_id`),
  KEY `idx_corgf_id` (`corgf_id`)
);
```

### 🔑 Chaves e Relacionamentos
- **UNIQUE**: `(jurd_id, corgf_id)` - Um jurado só pode avaliar uma coreografia uma vez
- **FK**: `jurd_id` → `tbl_jurados.jurd_id`
- **FK**: `corgf_id` → `tbl_coreografias.corgf_id`
- **FK**: `insti_id` → `tbl_instituicoes.insti_id`

## 🚀 Como Usar

### 1. Acesso ao Sistema
```
URL: /jurados
```

### 2. Fluxo de Avaliação

#### 📝 Passo 1: Seleção Automática
- Sistema busca primeira coreografia **não avaliada** pelo jurado
- Se todas foram avaliadas, mostra mensagem de conclusão

#### 📝 Passo 2: Preenchimento de Notas
- Jurado preenche notas de 0 a 10 para cada critério
- **Salvamento automático** no localStorage a cada digitação
- **Critério "Fidelidade"** aparece apenas para "Balé Clássico de Repertório"

#### 📝 Passo 3: Navegação no Grupo
- Jurado pode navegar entre coreografias do mesmo grupo
- Notas são **preservadas** durante navegação
- **Botão "Concluir"** só ativa quando todas as coreografias estão preenchidas

#### 📝 Passo 4: Finalização
- Clica em **"Concluir Avaliação"**
- Sistema salva **TODAS** as coreografias do grupo no banco
- Redireciona para próxima coreografia não avaliada

### 3. Filtros (Frontend)
- **Botão compacto** no canto superior direito
- **Modal elegante** com filtros por:
  - Formato (Solo, Dupla, Grupo, etc.)
  - Modalidade (Dança Contemporânea, Balé, etc.)
  - Categoria (Adulto, Juvenil, etc.)

## 🔧 Configuração Técnica

### 📋 Dependências
```php
// Models necessários
$this->avalMD = new \App\Models\AvaliacoesModel();
$this->corgfMD = new \App\Models\CoreografiasModel();
$this->grpMD = new \App\Models\GruposModel();
```

### 🎯 Critérios de Avaliação
```php
// Critérios fixos
$criterios = [
    101 => 'Técnica',
    102 => 'Coreografia', 
    103 => 'Consistência da Proposta',
    104 => 'Adequação Etária'
];

// Critério condicional
if (stripos($modalidade, 'balé clássico de repertório') !== false) {
    $criterios[105] = 'Fidelidade';
}
```

### 💾 Salvamento Local (localStorage)
```javascript
// Chave única por jurado + coreografia
const key = `jurado_${jurd_id}_corgf_${corgf_hashkey}`;

// Estrutura dos dados
const payload = {
    avaliacoes: { 101: 8.5, 102: 9.0, ... },
    keys: ['101', '102', ...],
    ts: Date.now()
};
```

## 🛠️ Manutenção e Debug

### 📊 Logs de Debug
```php
// Log detalhado em: writable/logs/debug_jurados.log
file_put_contents(WRITEPATH . 'logs/debug_jurados.log', 
    json_encode($log_data, JSON_PRETTY_PRINT) . "\n", FILE_APPEND);
```

### 🔍 Verificações Importantes

#### ✅ Banco de Dados
```sql
-- Verificar avaliações salvas
SELECT * FROM tbl_avaliacoes ORDER BY dte_cadastro DESC LIMIT 10;

-- Verificar jurados ativos
SELECT * FROM tbl_jurados WHERE jurd_ativo = 1;

-- Verificar coreografias ativas
SELECT * FROM tbl_coreografias WHERE corgf_ativo = 1;
```

#### ✅ Frontend
```javascript
// Verificar localStorage
Object.keys(localStorage).filter(k => k.startsWith('jurado_'));

// Verificar dados injetados
console.log('JURD_ID:', window.JURD_ID);
console.log('GROUP_COREOS:', window.GROUP_COREOS);
```

### 🚨 Troubleshooting

#### ❌ Problema: Notas não salvam
**Causa**: JavaScript não carregado ou localStorage bloqueado
**Solução**: Verificar console do navegador e permissões

#### ❌ Problema: Jurado vê coreografia já avaliada
**Causa**: Cache ou sessão incorreta
**Solução**: Limpar cache e verificar `jurd_id` na sessão

#### ❌ Problema: Botão "Concluir" não ativa
**Causa**: Nem todas as coreografias do grupo estão preenchidas
**Solução**: Verificar `isGrupoCompleto()` no console

## 📈 Melhorias Futuras

### 🎯 Funcionalidades Planejadas
- [ ] **Relatórios PDF**: Geração automática de relatórios
- [ ] **Ranking Dinâmico**: Cálculo automático de posições
- [ ] **Notificações**: Alertas para jurados
- [ ] **Backup**: Exportação de dados de avaliação

### 🔧 Otimizações Técnicas
- [ ] **Cache**: Implementar cache para consultas frequentes
- [ ] **API REST**: Endpoints para integração externa
- [ ] **WebSocket**: Atualizações em tempo real
- [ ] **PWA**: Funcionamento offline

## 📞 Suporte

### 🐛 Reportar Bugs
1. Verificar logs em `writable/logs/debug_jurados.log`
2. Capturar console do navegador
3. Descrever passos para reproduzir

### 💡 Sugestões
- Interface mais intuitiva
- Novos critérios de avaliação
- Integração com outros módulos

---

## 🎉 Conclusão

O Sistema de Jurados está **100% funcional** e pronto para uso em produção. Todas as funcionalidades principais foram implementadas e testadas:

✅ **Avaliação completa** de coreografias  
✅ **Navegação inteligente** entre grupos  
✅ **Salvamento automático** e em lote  
✅ **Interface moderna** e responsiva  
✅ **Filtros avançados** por categoria  
✅ **Sistema robusto** com logs detalhados  

**Sistema pronto para segunda-feira!** 🚀
