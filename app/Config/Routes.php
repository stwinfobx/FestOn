<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */


// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Home::index');

#redirect pra evento
// $routes->redirect(///);

 
$routes->group('evento', ['namespace' => 'App\Controllers'/*, "filter" => "loginAdmin"*/], function ($routes) {
	//$routes->get('/', 'Eventos::index');
	//$routes->get('/', 'Eventos::index');
	$routes->add('(:num)/(.+)', 'Eventos::inicial/$1/$2');
	$routes->add('filtrar', 'Historico::filtrar', ["filter" => "loginAdmin"]);
	$routes->match(['get', 'post'], '(:num)/(:alphanum)', 'Eventos::inicial/$1/$2');
});

$routes->group('festivais', ['namespace' => 'App\Controllers', "filter" => "loginAdmin"], function ($routes) {
	$routes->get('/', 'Festivais::index');
});

$routes->group('funcionalidades', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Institucional::funcionalidades');
});
$routes->group('fale-conosco', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Institucional::fale_conosco');
});
$routes->group('cadastro', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Institucional::cadastro');
});

$routes->get('uploads/(.+)', 'Renderimage::show/$1');


$routes->group('cadastro', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->get('/', 'Cadastros::index');
	$routes->match(['get', 'post'], 'ajaxform/(.+)', 'Cadastros::ajaxform/$1');
});
 
$routes->group('inscricoes', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->match(['get', 'post'], 'logout', 'Inscricoes::logout');

	$routes->match(['get', 'post'], 'login', 'Inscricoes::login');
	$routes->match(['get', 'post'], 'login/(.+)', 'Inscricoes::login/$1');
	// $routes->match(['post', 'add'], 'ajaxform/(.+)', 'Produtos::ajaxform/$1'/*, ["filter" => "loginAdmin"]*/);
  
	// precisa do hash do grupo // evento
	//$routes->match(['get', 'post'], 'grupo', 'Inscricoes::grupos');
	$routes->match(['get', 'post'], 'grupos', 'Inscricoes::grupos');
	$routes->match(['get', 'post'], 'grupos/(.+)', 'Inscricoes::grupos/$1');

	// precisa do hash do grupo relacionado ao evento
	$routes->match(['get', 'post'], 'participantes/(.+)', 'Inscricoes::participantes/$1');

	// precisa do hash do grupo relacionado ao evento
	$routes->match(['get', 'post'], 'coreografias/autorizacoes/(.+)', 'Inscricoes::coreografias_autorizacoes/$1');
	$routes->match(['get', 'post'], 'coreografias/(.+)', 'Inscricoes::coreografias/$1');

	// precisa do hash do grupo relacionado ao evento
	$routes->match(['get', 'post'], 'cobrancas/(.+)', 'Inscricoes::cobrancas/$1');
	
	// precisa do hash do grupo relacionado ao evento
	$routes->match(['get', 'post'], 'doacoes/(.+)', 'Inscricoes::doacoes/$1');
	
	// precisa do hash do grupo relacionado ao evento
	$routes->match(['get', 'post'], 'status/(.+)', 'Inscricoes::status/$1');
	
	// precisa do hash do grupo relacionado ao evento
	$routes->match(['get', 'post'], 'pagamento/segunda-via/(.+)', 'Mercadopg::segunda_via/$1');
	$routes->match(['get', 'post'], 'pagamento/(.+)', 'Mercadopg::ingresso/$1');
	$routes->match(['get', 'post'], 'pesquisar/(.+)', 'Mercadopg::pesquisar/$1');
	$routes->match(['get', 'post'], 'pesquisar-todos', 'Mercadopg::pesquisar_todos');

	$routes->match(['get', 'post'], 'cadastro', 'Inscricoes::cadastro');
	$routes->match(['get', 'post'], 'cadastro/(.+)', 'Inscricoes::cadastro/$1');

	$routes->match(['get', 'post'], 'meus-grupos', 'Inscricoes::meus_grupos');
	$routes->match(['get', 'post'], 'meus-grupos/(.+)', 'Inscricoes::cadastro/$1');
	
	//$routes->match(['get', 'post'], 'ajaxform/(.+)', 'Inscricoes::ajaxform/$1', ["filter" => "loginAdmin"]);	
    $routes->match(['get', 'post'], 'ajaxform/(.+)', 'Inscricoes::ajaxform/$1');


	// $routes->post('ajaxform/(.+)', 'Inscricoes::ajaxform/$1'/*, ["filter" => "loginAdmin"]*/);
	
	$routes->match(['get', 'post'], '/', 'Inscricoes::inicial');
	$routes->match(['get', 'post'], '(.+)', 'Inscricoes::inicial/$1');

	// inscricoes/compliance/98d3ecb510913ecf880c93c0fe6b12af/3418a92831a1b36420edc600b4b1a8a7
	$routes->match(['get', 'post'], 'compliance/(.+)/(.+)', 'Inscricoes::compliance/$1/$2');
	$routes->match(['get', 'post'], 'cadastro/(.+)', 'Inscricoes::cadastro/$1');

	$routes->match(['get', 'post'], '(.+)', 'Inscricoes::inicial/$1');
	$routes->get('/', 'Inscricoes::inicial');
	$routes->get('(.+)', 'Inscricoes::inicial/$1');
	
});

$routes->group('workshops', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->match(['get', 'post'], 'ajaxform/(.+)', 'Workshops::ajaxform/$1');
	$routes->match(['get', 'post'], '(.+)/(.+)', 'Workshops::inicio/$1/$2');
	
	$routes->match(['get', 'post'], '/', 'Workshops::inicio');
});

/*
 * --------------------------------------------------------------------
 * ROTAS DO PAINEL ADMINISTRATIVO
 * --------------------------------------------------------------------
 *
 */
$routes->group('painel', ['namespace' => 'App\Controllers\Painel'], function ($routes) {

	$routes->get('/', 'Dashboard::index', ["filter" => "loginAdmin"]);

	$routes->group('login', ['namespace' => 'App\Controllers\Painel'], function ($routes) {
		$routes->get('/', 'Login::index');
	});
	$routes->group('logout', ['namespace' => 'App\Controllers\Painel'], function ($routes) {
		$routes->get('/', 'Login::logout');
	});

	$routes->group('participantes', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Participantes::index', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form', 'Participantes::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/params/(.+)', 'Participantes::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Participantes::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'ajaxform/(.+)', 'Participantes::ajaxform/$1'/*, ["filter" => "loginAdmin"]*/);
		// participantes/form/params/grp:5ba56a717742bc3383d6b45f9cf1ba22
		$routes->get('form', 'Produtos::form', ["filter" => "loginAdmin"]);
		$routes->get('form/(:num)', 'Produtos::form/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Produtos::ajaxform/$1'/*, ["filter" => "loginAdmin"]*/);
	});

	$routes->group('workshops', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Workshops::index', ["filter" => "loginAdmin"]);

		$routes->match(['get', 'post'], 'list', 'Workshops::listar', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'list/(:num)', 'Workshops::listar/$1', ["filter" => "loginAdmin"]);

		$routes->match(['get', 'post'], 'form', 'Workshops::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Workshops::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)/inscricao/(:num)', 'Workshops::form/$1/$2', ["filter" => "loginAdmin"]);

		$routes->match(['get', 'post'], 'ajaxform/(.+)', 'Workshops::ajaxform/$1', ["filter" => "loginAdmin"]);
	});
	
	$routes->group('coreografias', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Coreografias::index', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form', 'Coreografias::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/params/(.+)', 'Coreografias::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Coreografias::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'ajaxform/(.+)', 'Coreografias::ajaxform/$1', ["filter" => "loginAdmin"]);
	});

	$routes->post('produtos/form', 'Produtos::form', ["filter" => "csrf"]);
	$routes->group('dashboard', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Dashboard::index', ["filter" => "loginAdmin"]);
		$routes->get('form', 'Produtos::form', ["filter" => "loginAdmin"]);
		$routes->get('form/(:num)', 'Produtos::form/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Produtos::ajaxform/$1', ["filter" => "loginAdmin"]);
	});

	$routes->group('recursoshumanos', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Recursoshumanos::index', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post', 'add'], 'form', 'Recursoshumanos::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'list/(:num)', 'Workshops::listar/$1', ["filter" => "loginAdmin"]);

		$routes->match(['get', 'post', 'add'], 'contratos', 'Recursoshumanos::contratos', ["filter" => "loginAdmin"]);

		$routes->match(['get', 'post'], 'form', 'Workshops::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Workshops::form/$1', ["filter" => "loginAdmin"]);

		$routes->match(['get', 'post'], 'ajaxform/(.+)', 'Workshops::ajaxform/$1', ["filter" => "loginAdmin"]);
	});


	$routes->group('produtos', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Produtos::index', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form', 'Produtos::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Produtos::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Produtos::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->get('form', 'Produtos::form', ["filter" => "loginAdmin"]);
		$routes->get('form/(:num)', 'Produtos::form/$1', ["filter" => "loginAdmin"]);
		$routes->post('form', 'Produtos::form', ["filter" => "loginAdmin"]);
		$routes->post('form/(:num)', 'Produtos::form/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Produtos::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Produtos::ajaxform/$1', ["filter" => "loginAdmin"]);
	});

	$routes->group('usuarios', ['namespace' => 'App\Controllers', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Usuarios::index', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form', 'Usuarios::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Usuarios::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Usuarios::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->match(['get'], 'historico/(:num)', 'Usuarios::historico/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Usuarios::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Usuarios::ajaxform/$1', ["filter" => "loginAdmin"]);
	});

	$routes->group('usuarios', ['namespace' => 'App\Controllers\Painel'], function ($routes) {
		$routes->get('/', 'Usuarios::index');
		$routes->match(['get', 'post'], 'form', 'Usuarios::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Usuarios::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Usuarios::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->match(['get'], 'historico/(:num)', 'Usuarios::historico/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Usuarios::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Usuarios::ajaxform/$1', ["filter" => "loginAdmin"]);
	});

	$routes->group('clientes', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Clientes::index', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form', 'Clientes::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Clientes::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['get'], 'view/(:num)', 'Clientes::view/$1', ["filter" => "loginAdmin"]);
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Clientes::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Clientes::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Clientes::ajaxform/$1', ["filter" => "loginAdmin"]);
	});

	$routes->group('carrinho', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Carrinho::index', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form', 'Carrinho::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Carrinho::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Carrinho::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->get('form', 'Carrinho::form', ["filter" => "loginAdmin"]);
		$routes->get('form/(:num)', 'Carrinho::form/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Carrinho::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Carrinho::ajaxform/$1', ["filter" => "loginAdmin"]);
	});

	$routes->group('pedidos', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Pedidos::index', ["filter" => "loginAdmin"]);
		$routes->get('detalhes/(:num)', 'Pedidos::detalhes/$1', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form', 'Pedidos::form', ["filter" => "loginAdmin"]);
		$routes->match(['get', 'post'], 'form/(:num)', 'Pedidos::form/$1', ["filter" => "loginAdmin"]);
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Pedidos::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->get('form', 'Pedidos::form', ["filter" => "loginAdmin"]);
		$routes->get('form/(:num)', 'Pedidos::form/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Pedidos::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Pedidos::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('filtrar', 'Pedidos::filtrar', ["filter" => "loginAdmin"]);
		$routes->add('filtrar/(.+)', 'Pedidos::filtrar/$1', ["filter" => "loginAdmin"]);
		$routes->add('gerar_pdf', 'Pedidos::gerar_pdf', ["filter" => "loginAdmin"]);
		$routes->add('gerar_pdf/(.+)', 'Pedidos::gerar_pdf/$1', ["filter" => "loginAdmin"]);
		$routes->add('filtro_pdf', 'Pedidos::filtro_pdf', ["filter" => "loginAdmin"]);	
		$routes->add('filtro_pdf/(.+)', 'Pedidos::filtro_pdf/$1', ["filter" => "loginAdmin"]);	
	});

	$routes->group('historico', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Historico::index', ["filter" => "loginAdmin"]);
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Historico::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Historico::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Historico::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('filtrar', 'Historico::filtrar', ["filter" => "loginAdmin"]);
		$routes->add('filtrar/(.+)', 'Historico::filtrar/$1', ["filter" => "loginAdmin"]);
		$routes->add('gerar_pdf', 'Historico::gerar_pdf', ["filter" => "loginAdmin"]);
		$routes->add('gerar_pdf/(.+)', 'Historico::gerar_pdf/$1', ["filter" => "loginAdmin"]);
		$routes->add('filtro_pdf', 'Historico::filtro_pdf', ["filter" => "loginAdmin"]);
		$routes->add('filtro_pdf/(.+)', 'Historico::filtro_pdf/$1', ["filter" => "loginAdmin"]);
	});

	$routes->group('cobranca', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		$routes->get('/', 'Cobranca::index', ["filter" => "loginAdmin"]);
	});

	$routes->group('relatorios', ['namespace' => 'App\Controllers\Painel', "filter" => "loginAdmin"], function ($routes) {
		
		$routes->get('/', 'Historico::index', ["filter" => "loginAdmin"]);

		$routes->get('excel/(.+)', 'Relatorios::excel/(.+)', ["filter" => "loginAdmin"]);
		$routes->get('(.+)', 'Relatorios::agrupar/(.+)', ["filter" => "loginAdmin"]);
		
		$routes->match(['post', 'add'], 'ajaxform/(.+)', 'Historico::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->post('ajaxform/(.+)', 'Historico::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('ajaxform/(.+)', 'Historico::ajaxform/$1', ["filter" => "loginAdmin"]);
		$routes->add('filtrar', 'Historico::filtrar', ["filter" => "loginAdmin"]);
		$routes->add('filtrar/(.+)', 'Historico::filtrar/$1', ["filter" => "loginAdmin"]);
		$routes->add('gerar_pdf', 'Historico::gerar_pdf', ["filter" => "loginAdmin"]);
		$routes->add('gerar_pdf/(.+)', 'Historico::gerar_pdf/$1', ["filter" => "loginAdmin"]);
		$routes->add('filtro_pdf', 'Historico::filtro_pdf', ["filter" => "loginAdmin"]);
		$routes->add('filtro_pdf/(.+)', 'Historico::filtro_pdf/$1', ["filter" => "loginAdmin"]);
	});

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
