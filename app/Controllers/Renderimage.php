<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Files\File;

use App\Libraries\GenericLib;

class Renderimage extends BaseController
{
	//protected $postMD = null;
	//protected $arqMD = null;
	//protected $folderFotos = null;
	
	protected $libGeneric = null;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
		parent::initController($request, $response, $logger);

		//// Load the model
		//$this->postMD = new \App\Models\PostsModel();
		//$this->arqMD = new \App\Models\ArquivosModel();

		//helper('text');

		//$this->folderFotos = 'files-upload/';
		//$this->data['folderFotos'] = $this->folderFotos;

		$this->libGeneric = new GenericLib();
    }

	public function index()
	{

	}

    public function show( $path )
    {
		$uri = service('uri'); // Obter a instância do objeto URI
		$segments = $uri->getSegments();
		$path = implode('/', $segments);

        // Sanitize the input path to prevent directory traversal attacks
        //$path = str_replace(['..', './', '.\\', '\\'], '', $path);
		$path = str_replace(['..', './', '.\\', '\\'], '', $path);
        $filePath = WRITEPATH . $path;

        if (file_exists($filePath)) {
            $file = new File($filePath);
            $mimeType = $file->getMimeType();

            return $this->response
                ->setHeader('Content-Type', $mimeType)
                ->setBody(file_get_contents($filePath));
        } else {
            //throw new \CodeIgniter\Exceptions\PageNotFoundException("Image not found: $path");
        }
    }

	public function view( $folder = "", $filename = "" )
	{
		$file_path = WRITEPATH .'uploads/'. (!empty($folder)? $folder ."/" : "") . $filename;
		if(($image = file_get_contents($file_path)) === FALSE)
		show_404();

		// choose the right mime type
		$mimeType = 'image/jpg';

		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}

	public function view_avatar( $filename = "" )
	{
		$file_path = WRITEPATH .'uploads/participantes/'. $filename;
		if(($image = file_get_contents($file_path)) === FALSE)
		show_404();

		// choose the right mime type
		$mimeType = 'image/jpg';

		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}
	
	public function view_grupos( $grp_hashkey = "",$filename = "" )
	{
		$path_folder_grupo = "";

		//$grp_hashkey = '9b3098ccee8fa94b8b6cb5bdef80ae15';

		$grpMD = new \App\Models\GruposModel();
		$grpMD->from('tbl_grupos GRP', true)
			->select('GRP.grp_urlpage')
			->select('EVENT.event_urlpage')
			->select('INSTI.insti_urlpage')
			->select('EVENT.event_urlpage')
			->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'INNER')
			->join('tbl_eventos EVENT', 'EVENT.event_id = GRPEVT.event_id', 'INNER')
			->join('tbl_instituicoes INSTI', 'INSTI.insti_id = GRP.insti_id', 'INNER')				
			->where('GRP.grp_hashkey', $grp_hashkey)
			->orderBy('GRP.grp_id', 'ASC')
			->limit(1);
		$query_folder_grupo = $grpMD->get();
		if( $query_folder_grupo && $query_folder_grupo->resultID->num_rows >= 1 )
		{
			$rs_folder_grupo = $query_folder_grupo->getRow();
			$segment_folder[] = 'instituicoes';
			$segment_folder[] = $rs_folder_grupo->insti_urlpage;
			$segment_folder[] = 'eventos';
			$segment_folder[] = $rs_folder_grupo->event_urlpage;
			$segment_folder[] = 'grupos';
			$segment_folder[] = $rs_folder_grupo->grp_urlpage;
			//$segment_folder[] = 'participantes';

			$path_folder_grupo = implode('/', $segment_folder);

			// Sanitize the input path to prevent directory traversal attacks
			//$path = str_replace(['..', './', '.\\', '\\'], '', $path);
			$path_folder_grupo = str_replace(['..', './', '.\\', '\\'], '', $path_folder_grupo);
			//$args_folder = [ 
			//	'area' => 'all', 
			//	'folder' => $path_folder_grupo  
			//];
			//$path_folder_participante = $this->libGeneric->check_folder($args_folder);

			//$this->data['path_folder_grupo'] = $path_folder_grupo;

			//$path = 'instituicoes/danca-carajas-festival/eventos/danca-carajas-festival/grupos/casa-ribalta-xxx/';
			$file_path = WRITEPATH .'uploads/'. $path_folder_grupo .'/'. $filename;
			
			if(($image = file_get_contents($file_path)) === FALSE)
			show_404();

			// choose the right mime type
			$mimeType = 'image/jpg';

			$this->response
			->setStatusCode(200)
			->setContentType($mimeType)
			->setBody($image)
			->send();			
		}		
	}	

	public function view_cliente( $folder = "", $filename = "" )
	{
		$file_path = WRITEPATH .'uploads/clientes/'. (!empty($folder)? $folder ."/" : "") . $filename;
		if(($image = file_get_contents($file_path)) === FALSE)
		show_404();

		// choose the right mime type
		$mimeType = 'image/jpg';

		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}

	public function view_cliente_galeria( $folder = "", $filename = "" )
	{
		$file_path = WRITEPATH .'uploads/clientes/'. (!empty($folder)? $folder ."/galerias/" : "") . $filename;

		if(($image = file_get_contents($file_path)) === FALSE)
		show_404();

		// choose the right mime type
		$mimeType = 'image/jpg';

		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}


	public function create( $diretorio = "" )
	{
		$file_path = WRITEPATH .'uploads/novos/'. $diretorio;

		if (!file_exists($file_path)) {
			mkdir($file_path, 0777, true);
		}

		//// Obtém a imagem em base64 enviada pelo cliente
		//$imagemBase64 = $_POST['imagem'];
		//$nomeArquivo = $_POST['nomeArquivo'];

		$imagemBase64 = $this->request->getPost('imagem');
		$nomeArquivo = $this->request->getPost('nomeArquivo');

		// Decodifica a imagem base64
		$imagemDecodificada = base64_decode(str_replace('data:image/png;base64,', '', $imagemBase64));

		// Define o caminho e o nome do arquivo para salvar a imagem no servidor
		$caminho = 'imagem_'. $nomeArquivo .'.png';

		$path_save_file = $file_path .'/'. $caminho;

		// Salva a imagem no servidor
		file_put_contents($path_save_file, $imagemDecodificada);
	}



	public function convite( $diretorio = "", $filename = ""  )
	{
		$file_path = WRITEPATH .'uploads/novos/'. $diretorio .'/'. $filename;

		if(($image = file_get_contents($file_path)) === FALSE)
		show_404();

		// choose the right mime type
		$mimeType = 'image/jpg';
		$mimeType = 'image/png';

		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}
}
