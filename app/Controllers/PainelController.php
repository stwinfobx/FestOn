<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Libraries\GenericLib;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class PainelController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['funcoes', 'cookie', 'text', 'form'];

	protected $data = [];

	protected $nivel_acesso = null;

	protected $session_id = null;
	protected $session_user_id = null;
	protected $session_user_nome = null;
	protected $session_user_permissao = null;
	protected $session_user_label_permissao = null;

	protected $folder_upload = null;

	protected $directory = 'painel';

	protected $cfgAPP = null;

	protected $rs_params = null;

	protected $libGeneric = null;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

		date_default_timezone_set('America/Sao_Paulo');

		$this->cfgAPP = new \Config\AppSettings();
		$this->data['cfgAPP'] = $this->cfgAPP;


		$this->folder_upload = 'files-upload/';
		$this->data['folder_upload'] = $this->folder_upload;	


		$this->nivel_acesso = [
			'1' => 'Administrador',
			//'2' => 'Vendedor',
		];
		$this->data['nivel_acesso'] = $this->nivel_acesso;


		$this->session_id = session()->get('hash_id'); //session()->session_id;
		$this->session_user_id = (int)session()->get('user_id');
		$this->session_user_nome = session()->get('user_nome');
		$this->session_user_permissao = (int)session()->get('user_permissao');
		$this->session_user_label_permissao = (isset($this->nivel_acesso[$this->session_user_permissao]) ? $this->nivel_acesso[$this->session_user_permissao] : '');

		$this->data['session_id'] = $this->session_id;
		$this->data['session_user_id'] = $this->session_user_id;
		$this->data['session_user_nome'] = $this->session_user_nome;
		$this->data['session_user_permissao'] = $this->session_user_permissao;
		$this->data['session_user_label_permissao'] = $this->session_user_label_permissao;


		$this->data['cliente_id'] = 0;

		$validation =  \Config\Services::validation();
		$this->data['validation'] = null;


		$this->libGeneric = new GenericLib();


		// permissao 
		//	1 - administrador
		//	2 - vendedores


		$uri = service('uri');
		$segments = $uri->getSegments();
		$index = array_search('params', $segments);
		//print '<pre>[';
		//var_dump( $index );
		//print ']</pre>';

		if( $index !== false ){ 
			$filteredSegments = array_slice($segments, $index + 1); // Retornar os elementos a partir de $index + 1 at� o final
			//print '<pre>[';
			//print_r( $filteredSegments );
			//print ']</pre>';

			$arr_param_filtro = ["grp"];
			$rs_params = (object)[];

			foreach ($filteredSegments as $key => $val) {
				[$tag, $value] = explode(':', $val);
				if (in_array($tag, $arr_param_filtro)) { $rs_params->{$tag} = $value; break; }
			}
			
			$this->rs_params = $rs_params;
			$this->data['rs_params'] = $rs_params;
			//print '<pre>';
			//print_r( $rs_params );
			//print '</pre>';
		}

    }
}
