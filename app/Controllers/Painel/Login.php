<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Login extends PainelController
{
    protected $instiMD = null;

    public function __construct()
    {
        $this->instiMD = new \App\Models\UsuariosModel();
        helper(['form', 'text']);
    }

    public function index()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->loginAuth();
        }

        return view($this->directory . '/login', $this->data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(painel_url('login'));
    }

    public function loginAuth()
    {
        $session = session();
        $email = $this->request->getPost('insti_email');
        $senha = $this->request->getPost('insti_senha');

        // Busca o usuário pelo email ou login
        $user = $this->instiMD->where('user_ativo', 1)
            ->groupStart()
                ->where('user_email', $email)
                ->orWhere('user_login', $email)
            ->groupEnd()
			->where('user_senha', fct_password_hash($senha))
			->where('user_ativo', '1')
            ->first();
 
	 
        if ($user) {
            $ses_data = [
                'hash_id' => md5(date("Y-m-d H:i:s") . "-" . random_string('alnum', 16)),
                'user_id' => $user->user_id,
                'user_nome' => $user->user_nome,
                'user_email' => $user->user_email,
                'isLoggedIn' => true
            ];
            
            $session->set($ses_data);
            return redirect()->to(painel_url('dashboard'));
        }

        // Se a autenticação falhar
        $session->setFlashdata('error', 'Credenciais inválidas');
        return redirect()->to(painel_url('login'))->withInput();
    }
}