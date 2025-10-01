<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

class Login extends PainelController
{
	protected $userMD = null;
	protected $instiMD = null;

    public function __construct()
    {
        //$this->userMD = new \App\Models\UsuarioModel();
		$this->instiMD = new \App\Models\UsuariosModel();

		helper('form');
		helper('text');
    }

	public function index()
	{
		if ($this->request->getPost())
		{
			self::loginAuth();
		}

		return view($this->directory .'/login', $this->data);
	}

	public function logout()
	{
		$session = session();
		$session->destroy();

		return $this->response->redirect( painel_url('login') );
	}

    public function loginAuth()
    {
        $session = session();
		$email = $this->request->getPost('email');
		$senha = $this->request->getPost('senha');

		// ba87bbe0a5488eb2874816003d8b2d348e994e3396a5288f574127510c96655f55b205f036b947c91164375aabc113619fe762f46b9680a1a02e19fca7348b22
		
		// 112233
		// 6dee7f60332b50b309acecb04812b7d29045cb589250fa71f65edc04256d35fc1968d918f8381024cc308ed45d53aefa74235ebdac5a78b1d4d6b207d161de3f

		// adm-developer
		// 37f40751f08f733bcb4f612b7a033be41ea2c86a0db617388b582db1843ba345e50770cadcc0599de3e4367e848a10f7488ed679e756e853e9df9f12cddce0d2


		$query_user = $this->instiMD->select('*')
			->groupStart()
				->orGroupStart()
					->where('user_email', $email)
					->orWhere('user_login', $email)
				->groupEnd()
			->groupEnd()
			->where('user_senha', fct_password_hash($senha))
			->where('user_ativo', '1')
			//->getCompiledSelect();
			->get();

		;
		//print '<br>'. $this->instiMD->getLastQuery();; 
		print json_encode($this->instiMD->select('*')); 
		exit();
		if( $query_user && $query_user->resultID->num_rows >=1 )
		{
			$rs_user = $query_user->getRow();
			

			$ses_data = [
				'hash_id' => md5(date("Y-m-d H:i:s") ."-". random_string('alnum', 16)),
				'user_id' => $rs_user->insti_id,
				'user_nome' => $rs_user->insti_nome,
				'user_email' => $rs_user->insti_email,
				//'user_permissao' => $rs_user->permissao,
				'isLoggedIn' => TRUE
			];
			$session->set($ses_data);

			// colocar aqui login por cookie tamb�m
		 
			return $this->response->redirect(painel_url('dashboard/') );

		}else{
		
			//return $this->response->redirect( painel_url('login/error') );
		
		}
    }

}
