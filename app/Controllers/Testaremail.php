<?php

namespace App\Controllers;

class Testaremail extends BaseController
{
    public function testeEmail($hash = null)
{
    echo "Teste de envio de e-mail iniciado com hash: $hash";

    // só para teste local, força execução do envio
    $this->enviarEmailConfirmacaoInscricao($hash);
    
    echo "<br>E-mail enviado (ou webhook disparado se estiver em localhost)";
}
}



