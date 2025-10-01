<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        $senhaHex = bin2hex(random_bytes(64));
        $data = [
            'user_hashkey'    => bin2hex(random_bytes(64)), // hashkey no mesmo padrão
            'user_activekey'  => bin2hex(random_bytes(32)),
            'user_urlpage'    => 'administrador',
            'user_nivel'      => 'administrador',
            'user_nome'       => 'Vandeilson',
            'user_sobrenome'  => 'Fernandes',
            'user_login'      => 'vandeilson',
            'user_email'      => 'vandeilson@example.com',
            'user_senha'      => $senhaHex,
            'user_evento'     => 'administrador',
            'user_dte_cadastro'  => date('Y-m-d H:i:s'),
            'user_dte_alteracao' => date('Y-m-d H:i:s'),
            'user_ativo'      => 1
        ];

        $this->db->table('tbl_usuarios')->insert($data);
    }
}
