<?php
// Arquivo de teste para verificar se os dados estão sendo gerados corretamente

require_once 'app/Models/CriteriosModel.php';
require_once 'app/Models/AvaliacoesModel.php';

echo "<h2>Teste dos Models Simulados</h2>";

// Teste CriteriosModel
echo "<h3>1. Teste CriteriosModel</h3>";
$critMD = new \App\Models\CriteriosModel();
$criterios = $critMD->select_all_by_insti_id(1);

echo "<pre>";
echo "Critérios retornados:\n";
print_r($criterios);
echo "</pre>";

// Teste AvaliacoesModel
echo "<h3>2. Teste AvaliacoesModel</h3>";
$avalMD = new \App\Models\AvaliacoesModel();

// Teste salvamento
echo "<h4>2.1. Teste de Salvamento</h4>";
$dados_teste = [
    [
        'jurd_id' => 1,
        'corgf_id' => 1,
        'crit_id' => 1,
        'aval_nota' => 8.5
    ],
    [
        'jurd_id' => 1,
        'corgf_id' => 1,
        'crit_id' => 2,
        'aval_nota' => 9.0
    ]
];

$resultado_salvar = $avalMD->salvar_avaliacoes($dados_teste);
echo "Resultado salvamento: " . ($resultado_salvar ? "Sucesso" : "Erro") . "<br>";

// Teste busca
echo "<h4>2.2. Teste de Busca</h4>";
$avaliacoes = $avalMD->get_avaliacoes_by_jurado_coreografia(1, 1);
echo "<pre>";
echo "Avaliações encontradas:\n";
print_r($avaliacoes);
echo "</pre>";

// Verificar arquivo
echo "<h3>3. Conteúdo do Arquivo</h3>";
$arquivo = 'writable/avaliacoes.txt';
if (file_exists($arquivo)) {
    echo "<pre>";
    echo file_get_contents($arquivo);
    echo "</pre>";
} else {
    echo "Arquivo não encontrado: $arquivo";
}
?>
