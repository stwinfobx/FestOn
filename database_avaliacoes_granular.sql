-- ESTRUTURA GRANULAR POR COREOGRAFIA (uma linha por critério por coreografia)
-- Remove a tabela compacta e cria a granular

DROP TABLE IF EXISTS `tbl_avaliacoes`;

CREATE TABLE `tbl_avaliacoes` (
  `aval_id` int(11) NOT NULL AUTO_INCREMENT,
  `insti_id` int(11) NOT NULL DEFAULT 1,
  `jurd_id` int(11) NOT NULL DEFAULT 1,
  `corgf_id` int(11) NOT NULL DEFAULT 0,
  `crit_id` int(11) NOT NULL DEFAULT 0,
  `aval_hashkey` varchar(250) DEFAULT NULL,
  `aval_nota` decimal(5,2) DEFAULT 0.00,
  `aval_observacao` TEXT DEFAULT NULL,
  `aval_finalizada` tinyint(4) DEFAULT 0,
  `aval_dte_cadastro` datetime DEFAULT NULL,
  `aval_dte_alteracao` datetime DEFAULT NULL,
  `aval_ativo` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`aval_id`),
  UNIQUE KEY `unique_avaliacao` (`jurd_id`, `corgf_id`, `crit_id`),
  KEY `insti_id` (`insti_id`),
  KEY `jurd_id` (`jurd_id`),
  KEY `corgf_id` (`corgf_id`),
  KEY `crit_id` (`crit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- DADOS DE TESTE GRANULARES (exemplo: 3 coreografias × 6 critérios = 18 registros)
INSERT INTO `tbl_avaliacoes` (`insti_id`, `jurd_id`, `corgf_id`, `crit_id`, `aval_hashkey`, `aval_nota`, `aval_finalizada`, `aval_dte_cadastro`, `aval_dte_alteracao`, `aval_ativo`) VALUES
-- Coreografia 1 (6 critérios)
(1, 1, 1, 1, 'hash_1_1_1', 8.5, 0, '2025-10-02 17:30:00', '2025-10-02 17:30:00', 1),
(1, 1, 1, 2, 'hash_1_1_2', 7.0, 0, '2025-10-02 17:30:00', '2025-10-02 17:30:00', 1),
(1, 1, 1, 3, 'hash_1_1_3', 9.0, 0, '2025-10-02 17:30:00', '2025-10-02 17:30:00', 1),
(1, 1, 1, 4, 'hash_1_1_4', 8.0, 0, '2025-10-02 17:30:00', '2025-10-02 17:30:00', 1),
(1, 1, 1, 5, 'hash_1_1_5', 7.5, 0, '2025-10-02 17:30:00', '2025-10-02 17:30:00', 1),
(1, 1, 1, 6, 'hash_1_1_6', 8.5, 0, '2025-10-02 17:30:00', '2025-10-02 17:30:00', 1),
-- Coreografia 2 (6 critérios)
(1, 1, 2, 1, 'hash_1_2_1', 7.0, 0, '2025-10-02 17:35:00', '2025-10-02 17:35:00', 1),
(1, 1, 2, 2, 'hash_1_2_2', 8.0, 0, '2025-10-02 17:35:00', '2025-10-02 17:35:00', 1),
(1, 1, 2, 3, 'hash_1_2_3', 7.5, 0, '2025-10-02 17:35:00', '2025-10-02 17:35:00', 1),
(1, 1, 2, 4, 'hash_1_2_4', 8.5, 0, '2025-10-02 17:35:00', '2025-10-02 17:35:00', 1),
(1, 1, 2, 5, 'hash_1_2_5', 7.0, 0, '2025-10-02 17:35:00', '2025-10-02 17:35:00', 1),
(1, 1, 2, 6, 'hash_1_2_6', 8.0, 0, '2025-10-02 17:35:00', '2025-10-02 17:35:00', 1),
-- Coreografia 3 (6 critérios)
(1, 1, 3, 1, 'hash_1_3_1', 9.0, 0, '2025-10-02 17:40:00', '2025-10-02 17:40:00', 1),
(1, 1, 3, 2, 'hash_1_3_2', 8.5, 0, '2025-10-02 17:40:00', '2025-10-02 17:40:00', 1),
(1, 1, 3, 3, 'hash_1_3_3', 9.5, 0, '2025-10-02 17:40:00', '2025-10-02 17:40:00', 1),
(1, 1, 3, 4, 'hash_1_3_4', 8.0, 0, '2025-10-02 17:40:00', '2025-10-02 17:40:00', 1),
(1, 1, 3, 5, 'hash_1_3_5', 9.0, 0, '2025-10-02 17:40:00', '2025-10-02 17:40:00', 1),
(1, 1, 3, 6, 'hash_1_3_6', 8.5, 0, '2025-10-02 17:40:00', '2025-10-02 17:40:00', 1);
