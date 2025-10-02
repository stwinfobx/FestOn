<?php
// Teste DIRETO com MySQL - SEM CodeIgniter
date_default_timezone_set('America/Sao_Paulo');

// Função para escrever no log
function escreverLog($mensagem) {
    $data = date('Y-m-d H:i:s');
    $linha = "[$data] $mensagem" . PHP_EOL;
    file_put_contents('teste_log.txt', $linha, FILE_APPEND | LOCK_EX);
    echo $mensagem . "<br>" . PHP_EOL;
}

// Configurações do banco (ajuste se necessário)
$db_config = [
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'code', // ajuste o nome do banco
    'port'     => 3306
];

escreverLog("=== INICIANDO TESTE DIRETO MYSQL ===");

try {
    // Conexão direta com MySQL
    $mysqli = new mysqli($db_config['hostname'], $db_config['username'], $db_config['password'], $db_config['database'], $db_config['port']);
    
    if ($mysqli->connect_error) {
        throw new Exception("Erro de conexão: " . $mysqli->connect_error);
    }
    
    escreverLog("✅ Conectado ao banco de dados");
    
    // Hash para teste - vamos listar hashes disponíveis primeiro
    escreverLog("Buscando hashes disponíveis...");
    
    // Listar algumas hashes para teste
    $sql_hashes = "
        SELECT GREVT.grevt_hashkey, GRP.grp_titulo 
        FROM tbl_grupos_x_eventos AS GREVT
        INNER JOIN tbl_grupos AS GRP ON GRP.grp_id = GREVT.grp_id 
        LIMIT 5
    ";
    
    $result_hashes = $mysqli->query($sql_hashes);
    
    if ($result_hashes && $result_hashes->num_rows > 0) {
        escreverLog("--- Hashes disponíveis ---");
        $hashes = [];
        while ($row = $result_hashes->fetch_assoc()) {
            $hashes[] = $row;
            escreverLog("Hash: " . $row['grevt_hashkey'] . " - Grupo: " . $row['grp_titulo']);
        }
        
        // Usar a primeira hash para teste
        $grevt_hashkey = $hashes[0]['grevt_hashkey'];
        escreverLog("--- Usando hash para teste: " . $grevt_hashkey . " ---");
        
        // Buscar dados do grupo
        $sql_grupo = "
            SELECT GREVT.grevt_id, GRP.grp_titulo, EVENT.event_titulo 
            FROM tbl_grupos_x_eventos AS GREVT
            INNER JOIN tbl_grupos AS GRP ON GRP.grp_id = GREVT.grp_id 
            INNER JOIN tbl_eventos AS EVENT ON EVENT.event_id = GREVT.event_id 
            WHERE GREVT.grevt_hashkey = ?
            LIMIT 1
        ";
        
        $stmt = $mysqli->prepare($sql_grupo);
        $stmt->bind_param("s", $grevt_hashkey);
        $stmt->execute();
        $result_grupo = $stmt->get_result();
        
        if ($result_grupo && $result_grupo->num_rows > 0) {
            $grupo = $result_grupo->fetch_assoc();
            escreverLog("✅ Grupo encontrado: " . $grupo['grp_titulo']);
            escreverLog("Evento: " . $grupo['event_titulo']);
            escreverLog("grevt_id: " . $grupo['grevt_id']);
            
            // Buscar diretor
            $sql_diretor = "
                SELECT P.partc_email, P.partc_nome 
                FROM tbl_participantes AS P
                INNER JOIN tbl_participantes_x_grupos AS PG ON PG.partc_id = P.partc_id 
                INNER JOIN tbl_funcoes AS F ON F.func_id = PG.func_id 
                WHERE PG.grevt_id = ? 
                AND F.func_titulo = 'Diretor'
                LIMIT 1
            ";
            
            escreverLog("sql gerado: " . $sql_diretor);

            $stmt_diretor = $mysqli->prepare($sql_diretor);
            $stmt_diretor->bind_param("i", $grupo['grevt_id']);
            $stmt_diretor->execute();
            $result_diretor = $stmt_diretor->get_result();
            
            if ($result_diretor && $result_diretor->num_rows > 0) {
                $diretor = $result_diretor->fetch_assoc();
                escreverLog("🎯 ✅ DIRETOR ENCONTRADO!");
                escreverLog("Nome: " . $diretor['partc_nome']);
                escreverLog("Email: " . $diretor['partc_email']);
            } else {
                escreverLog("❌ NENHUM DIRETOR ENCONTRADO para este grupo");
                
                // Verificar se há outros participantes no grupo
                $sql_participantes = "
                    SELECT P.partc_nome, F.func_titulo 
                    FROM tbl_participantes AS P
                    INNER JOIN tbl_participantes_x_grupos AS PG ON PG.partc_id = P.partc_id 
                    INNER JOIN tbl_funcoes AS F ON F.func_id = PG.func_id 
                    WHERE PG.grevt_id = ?
                    LIMIT 5
                ";
                
                $stmt_part = $mysqli->prepare($sql_participantes);
                $stmt_part->bind_param("i", $grupo['grevt_id']);
                $stmt_part->execute();
                $result_part = $stmt_part->get_result();
                
                escreverLog("--- Participantes do grupo ---");
                if ($result_part && $result_part->num_rows > 0) {
                    while ($part = $result_part->fetch_assoc()) {
                        escreverLog(" - " . $part['partc_nome'] . " (" . $part['func_titulo'] . ")");
                    }
                } else {
                    escreverLog(" - Nenhum participante encontrado");
                }
            }
            
        } else {
            escreverLog("❌ Grupo não encontrado para a hash: " . $grevt_hashkey);
        }
        
    } else {
        escreverLog("❌ Nenhuma hash encontrada na tabela tbl_grupos_x_eventos");
    }
    
    $mysqli->close();
    
} catch (Exception $e) {
    escreverLog("❌ ERRO: " . $e->getMessage());
}

escreverLog("=== TESTE FINALIZADO ===");

echo "<h2>✅ Teste concluído! Verifique o arquivo teste_log.txt</h2>";
?>