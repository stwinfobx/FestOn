<?php

namespace App\Controllers\Painel;

class Home extends PainelController
{
    public function index()
    {
		return $this->response->redirect( painel_url('login') );
        //return view('welcome_message');
    }
}
