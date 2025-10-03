-- ESTRUTURA COMPACTA PARA AVALIAÇÕES DE JUROS
-- Remove a tabela antiga e cria uma nova mais eficiente

-- NOVA ESTRUTURA: AVALIAÇÃO CONSOLIDADA POR JURADO X COREOGRAFIA
DROP TABLE IF EXISTS `tbl_avaliacoes`;

CREATE TABLE `tbl_avaliacoes` (
  `aval_id` int(11) NOT NULL AUTO_INCREMENT,
  `insti_id` int(11) NOT NULL DEFAULT 1,
  `jurd_id` int(11) NOT NULL,
  `corgf_id` int(11) NOT NULL,
  `aval_hashkey` varchar(250) DEFAULT NULL,
  `nota_tecnica` decimal(4,1) NOT NULL,
  `nota_coreografia` decimal(4,1) NOT NULL,
  `nota_consistencia` decimal(4,1) NOT NULL,
  `nota_adequacao_etaria` decimal(4,1) NOT NULL,
  `nota_fidelidade` decimal(4,1) DEFAULT NULL,
  `data_hora_avaliacao` datetime NOT NULL,
  `status_avaliacao` enum('pendente','enviado','com_erro') NOT NULL DEFAULT 'pendente',
  `status_selecao` enum('selecionada','nao_selecionada','em_avaliacao') NOT NULL DEFAULT 'em_avaliacao',
  `nota_total_calculada` decimal(5,2) NOT NULL,
  `ranking` int(11) DEFAULT NULL,
  `aval_finalizada` tinyint(1) NOT NULL DEFAULT 0,
  `aval_ativo` tinyint(1) NOT NULL DEFAULT 1,
  `dte_cadastro` datetime DEFAULT NULL,
  `dte_alteracao` datetime DEFAULT NULL,
  PRIMARY KEY (`aval_id`),
  UNIQUE KEY `uq_jurado_coreografia` (`jurd_id`, `corgf_id`),
  KEY `insti_id` (`insti_id`),
  KEY `jurd_id` (`jurd_id`),
  KEY `corgf_id` (`corgf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INSERIR DADOS DE TESTE COMPACTOS
-- DADOS DE TESTE (OPCIONAL)
-- INSERTS podem ser gerados após integração com coreografias reais



