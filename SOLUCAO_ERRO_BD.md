# 🔧 Solução para Erro de Banco de Dados

## ❌ Problema Identificado

**Erro SQL #1064:** Sintaxe incorreta na consulta WHERE do model AvaliacoesModel.

## ✅ Correções Aplicadas

### 1. **Corrigido Model AvaliacoesModel.php**
- **Problema:** `WHERE 'tbl_avaliacoes.aval_id IS NULL OR tbl_avaliacoes.aval_finalizada', 0`
- **Solução:** Separado em condições distintas com `groupStart()` e `groupEnd()`

### 2. **Criado Script SQL Corrigido** 
- Arquivo: `fix_database.sql`
- Sintaxe simplificada e compatível com MariaDB
- Usa `IF NOT EXISTS` para evitar erros

### 3. **Adicionado Valores Padrão no Controller**
- Evita erros quando sessão não está configurada
- Valores padrão: `jurd_id = 1`, `insti_id = 1`

## 🚀 Como Resolver

### **Passo 1: Execute o SQL Corrigido**
```sql
-- Use o arquivo fix_database.sql ao invés do database_avaliacoes.sql
```

### **Passo 2: Execute este SQL no seu banco:**
```sql
CREATE TABLE IF NOT EXISTS `tbl_avaliacoes` (
  `aval_id` int(11) NOT NULL AUTO_INCREMENT,
  `insti_id` int(11) NOT NULL DEFAULT 0,
  `jurd_id` int(11) NOT NULL DEFAULT 0,
  `corgf_id` int(11) NOT NULL DEFAULT 0,
  `crit_id` int(11) NOT NULL DEFAULT 0,
  `aval_hashkey` varchar(250) DEFAULT NULL,
  `aval_nota` decimal(5,2) DEFAULT 0.00,
  `aval_observacao` text DEFAULT NULL,
  `aval_finalizada` tinyint(4) DEFAULT 0,
  `aval_dte_cadastro` datetime DEFAULT NULL,
  `aval_dte_alteracao` datetime DEFAULT NULL,
  `aval_ativo` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`aval_id`),
  KEY `insti_id` (`insti_id`),
  KEY `jurd_id` (`jurd_id`),
  KEY `corgf_id` (`corgf_id`),
  KEY `crit_id` (`crit_id`),
  UNIQUE KEY `unique_avaliacao` (`jurd_id`,`corgf_id`,`crit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

### **Passo 3: Adicione Critérios de Teste**
```sql
INSERT IGNORE INTO `tbl_criterios` (`insti_id`, `crit_hashkey`, `crit_urlpage`, `crit_titulo`, `crit_nota_min`, `crit_dte_cadastro`, `crit_dte_alteracao`, `crit_ativo`) VALUES
(1, MD5(CONCAT(NOW(), 'tecnica')), 'tecnica', 'Técnica', 5, NOW(), NOW(), 1),
(1, MD5(CONCAT(NOW(), 'interpretacao')), 'interpretacao', 'Interpretação', 5, NOW(), NOW(), 1),
(1, MD5(CONCAT(NOW(), 'criatividade')), 'criatividade', 'Criatividade', 5, NOW(), NOW(), 1),
(1, MD5(CONCAT(NOW(), 'harmonia')), 'harmonia', 'Harmonia', 5, NOW(), NOW(), 1),
(1, MD5(CONCAT(NOW(), 'figurino')), 'figurino', 'Figurino', 5, NOW(), NOW(), 1),
(1, MD5(CONCAT(NOW(), 'impacto')), 'impacto-artistico', 'Impacto Artístico', 5, NOW(), NOW(), 1);
```

### **Passo 4: Teste o Sistema**
1. Acesse: `http://seu-site.com/jurados`
2. O sistema agora deve carregar sem erros
3. Para testar completamente, configure as sessões apropriadas

## 📋 Verificações

✅ **AvaliacoesModel.php** - Consulta SQL corrigida  
✅ **fix_database.sql** - Script SQL funcional  
✅ **Jurados.php** - Valores padrão para sessão  
✅ **Sintaxe MariaDB** - Compatível com seu servidor  

## 🔄 Status
**CORRIGIDO** - O sistema deve funcionar normalmente após executar o SQL correto.

## ⚠️ Nota Importante
Os valores padrão (`jurd_id = 1`, `insti_id = 1`) são temporários para testes. 
Em produção, implemente autenticação adequada para definir esses valores corretamente.




