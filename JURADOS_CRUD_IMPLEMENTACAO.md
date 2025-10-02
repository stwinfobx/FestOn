# 📌 CRUD do Sistema de Jurados - Implementação Completa

## ✅ Checklist de Implementação

### ✅ READ (Listar / Mostrar)
- [x] **Removida seção estática** de indicações e nomes de coreógrafos
- [x] **Substituído por dados dinâmicos do banco:**
  - iframe do vídeo do YouTube (URL puxada do campo `corgf_linkvideo`)
  - Nome da coreografia (`corgf_titulo`)
  - Nome do grupo (`grp_titulo`)
  - Outros dados da coreografia (descrição, modalidade, formato, categoria)
- [x] **Navegação Vue.js entre coreografias:**
  - Botões para navegar pelas coreografias do grupo
  - Exemplo: Grupo X tem 5 coreografias → navegação entre as 5

### ✅ CREATE (Criar notas)
- [x] **Inputs numéricos** (`<input type="number">`)
- [x] **Estados visuais Vue.js:**
  - Input cinza inicialmente
  - Muda para amarelo quando digitado
  - Salvamento automático via debounce (1 segundo)

### ✅ UPDATE (Atualizar notas)
- [x] **Sistema de atualização:** se o jurado alterar nota antes de concluir, a nota é atualizada
- [x] **Salvamento automático:** todas as notas são salvas automaticamente

### ✅ DELETE (Remover)
- [x] **Removida seção estática** de indicações
- [x] **Removido botão** "Gravar Justificativa"

### ✅ Finalização (Workflow Vue.js)
- [x] **Pop-up de confirmação:** "Você já analisou todas as notas? Deseja concluir?"
- [x] **Validação completa:**
  - Verifica se todas as coreografias do grupo têm notas
  - Alerta se faltar nota: "Você precisa avaliar todas as coreografias antes de concluir"
- [x] **Redirecionamento automático:** após salvar, redireciona para próximo grupo sem notas

## 🔧 Arquivos Criados/Modificados

### **Novos Arquivos:**
1. `app/Models/AvaliacoesModel.php` - Model para sistema de avaliações
2. `public/assets/vue/jurados-avaliacao.js` - Vue.js para interface de avaliação
3. `database_avaliacoes.sql` - Script SQL para criar tabela de avaliações

### **Arquivos Modificados:**
1. `app/Controllers/Jurados.php` - Controller principal
   - Novo método `index()` com parâmetro de coreografia
   - Novos casos no `ajaxform()`: SALVAR-AVALIACOES, FINALIZAR-COREOGRAFIA
   
2. `app/Views/jurados/index.php` - Interface principal
   - Seção estática removida completamente
   - Inputs dinâmicos com Vue.js
   - Navegação entre coreografias
   - Botão de finalização com validação

## 🎯 Funcionalidades Implementadas

### **Sistema de Avaliação:**
- ✅ Inputs numéricos (0-10) com validação
- ✅ Estados visuais (cinza → amarelo)
- ✅ Salvamento automático (debounce 1s)
- ✅ Validação completa antes de finalizar

### **Navegação:**
- ✅ Navegação entre coreografias do mesmo grupo
- ✅ Redirecionamento automático para próximo grupo
- ✅ Interface responsiva e intuitiva

### **Backend:**
- ✅ CRUD completo para avaliações
- ✅ Validação de dados no servidor
- ✅ Sistema de busca de próximos grupos
- ✅ Controle de sessão de jurados

## 🗃️ Estrutura do Banco de Dados

### **Nova Tabela: `tbl_avaliacoes`**
```sql
CREATE TABLE `tbl_avaliacoes` (
    `aval_id` INT(11) NOT NULL AUTO_INCREMENT,
    `insti_id` INT(11) NOT NULL DEFAULT '0',
    `jurd_id` INT(11) NOT NULL DEFAULT '0',
    `corgf_id` INT(11) NOT NULL DEFAULT '0',
    `crit_id` INT(11) NOT NULL DEFAULT '0',
    `aval_hashkey` VARCHAR(250) NULL DEFAULT NULL,
    `aval_nota` DECIMAL(5,2) NULL DEFAULT '0.00',
    `aval_observacao` TEXT NULL DEFAULT NULL,
    `aval_finalizada` TINYINT(4) NULL DEFAULT '0',
    `aval_dte_cadastro` DATETIME NULL DEFAULT NULL,
    `aval_dte_alteracao` DATETIME NULL DEFAULT NULL,
    `aval_ativo` TINYINT(4) NULL DEFAULT '1',
    PRIMARY KEY (`aval_id`),
    UNIQUE INDEX `unique_avaliacao` (`jurd_id`, `corgf_id`, `crit_id`)
);
```

## 🚀 Como Usar

1. **Execute o SQL:** Rode o arquivo `database_avaliacoes.sql` no banco
2. **Configure sessão:** Certifique-se que as sessões `jurd_id` e `insti_id` estão configuradas
3. **Acesse:** Navegue para `/jurados` para iniciar as avaliações
4. **Avalie:** Digite notas de 0-10 para cada critério
5. **Finalize:** Clique em "Concluir Avaliação" quando todas as notas estiverem preenchidas

## 📋 Dependências

- **Vue.js 2.6.14** (já incluso)
- **Axios** (já incluso)
- **SweetAlert2** (já incluso)
- **Lodash** (adicionado para debounce)
- **CodeIgniter 4** (framework base)

## ⚠️ Notas Importantes

1. **Sessão:** O sistema assume que `jurd_id` e `insti_id` estão na sessão
2. **Vídeos:** URLs de vídeo devem estar no campo `corgf_linkvideo` da tabela de coreografias
3. **Critérios:** Devem estar cadastrados na tabela `tbl_criterios`
4. **Autoload:** O sistema salva automaticamente a cada mudança (debounce 1s)

## 🎨 Interface

- **Design responsivo** mantendo o estilo original
- **Estados visuais claros** (cinza/amarelo)
- **Navegação intuitiva** entre coreografias
- **Validação em tempo real**
- **Feedback visual** para todas as ações

## 🔄 Fluxo de Avaliação

1. Jurado acessa o sistema
2. Sistema carrega primeira coreografia disponível
3. Jurado avalia todos os critérios (0-10)
4. Sistema salva automaticamente
5. Jurado navega entre coreografias do grupo
6. Ao finalizar, sistema valida completude
7. Sistema redireciona para próximo grupo automaticamente

---

**Status:** ✅ Implementação Completa
**Testado:** Interface funcional, backend operacional
**Próximos passos:** Teste em ambiente de produção
