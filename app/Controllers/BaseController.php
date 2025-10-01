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
abstract class BaseController extends Controller
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

	protected $cfgAPP = null;

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

        // E.g.: 
		
		$this->session = \Config\Services::session();

		date_default_timezone_set('America/Sao_Paulo');

		$this->cfgAPP = new \Config\AppSettings();
		$this->data['cfgAPP'] = $this->cfgAPP;

		$this->nivel_acesso = [
			'1' => 'Administrador',
			//'2' => 'Vendedor',
		];
		$this->data['nivel_acesso'] = $this->nivel_acesso;

		$this->session_id = $this->session->get('hash_id'); //session()->session_id;
		$this->session_user_id = (int)$this->session->get('user_id');
		$this->session_user_nome = $this->session->get('user_nome');
		$this->session_user_permissao = (int)$this->session->get('user_permissao');
		$this->session_user_label_permissao = (isset($this->nivel_acesso[$this->session_user_permissao]) ? $this->nivel_acesso[$this->session_user_permissao] : '');

		$this->data['session_id'] = $this->session_id;
		$this->data['session_user_id'] = $this->session_user_id;
		$this->data['session_user_nome'] = $this->session_user_nome;
		$this->data['session_user_permissao'] = $this->session_user_permissao;
		$this->data['session_user_label_permissao'] = $this->session_user_label_permissao;

		$this->libGeneric = new GenericLib();

		$validation =  \Config\Services::validation();
		$this->data['validation'] = null;


		$this->folder_upload = 'files-upload/';
		$this->data['folder_upload'] = $this->folder_upload;
    }
}
