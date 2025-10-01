<?php
namespace App\Libraries;

use Config\Services;
use CodeIgniter\Libraries; 

class GenericLib {

	protected $folderBase = null;
	protected $request = null;

    public function __construct()
	{
		//$this->categMD = new \App\Models\CategoriasModel();

		$this->folderBase = WRITEPATH .'uploads/';

		$this->request = Services::request();
    }


	public function check_folder_instituicao( $insti_urlpage = "" )
	{
		// pasta principal com nome da instituicao
		$path_folder = $this->folderBase .'instituicoes/'. $insti_urlpage;
		if (!is_dir($path_folder)) { mkdir($path_folder, 0777, TRUE); }

		// documentacao
		$path_folder_doc = $this->folderBase .'instituicoes/'. $insti_urlpage ."/documentacao/";
		if (!is_dir($path_folder_doc)) {
			mkdir($path_folder_doc, 0777, TRUE);
		}

		// eventos
		$path_folder_doc = $this->folderBase .'instituicoes/'. $insti_urlpage ."/eventos/";
		if (!is_dir($path_folder_doc)) {
			mkdir($path_folder_doc, 0777, TRUE);
		}
		return $path_folder;
	}

	public function check_folder( $args = [] )
	{
		$area = (isset($args['area']) ? $args['area'] : '');
		$folder = (isset($args['folder']) ? $args['folder'] : '');
		$path_folder = "";

		switch ($area){
		case "instituicoes":
			// pasta principal com nome da instituicao
			$path_folder = $this->folderBase .'instituicoes/'. $insti_urlpage;
			if (!is_dir($path_folder)) { mkdir($path_folder, 0777, TRUE); }

			// documentacao
			$path_folder_doc = $this->folderBase .'instituicoes/'. $insti_urlpage ."/documentacao/";
			if (!is_dir($path_folder_doc)) {
				mkdir($path_folder_doc, 0777, TRUE);
			}

		break;
		case "eventos":
			$path_folder = $this->folderBase .'instituicoes/'. $folder;
			if (!is_dir($path_folder)) { mkdir($path_folder, 0777, TRUE); }
		break;
		case "grupos":
			$path_folder = $folder;
			if (!is_dir($path_folder)) { mkdir($path_folder, 0777, TRUE); }
		break;
		case "all":
			//$path_folder = $folder;
			$path_folder = $this->folderBase .'/'. $folder;
			if (!is_dir($path_folder)) { mkdir($path_folder, 0777, TRUE); }
		break;
		}
		return $path_folder;
	}


	public function upload_file_unico( $args = [] ){
		$fileName = (isset($args['file_name']) ? $args['file_name'] : '');
		$prefixo = (isset($args['prefixo']) ? $args['prefixo'] : '');
		$folder = (isset($args['folder']) ? $args['folder'] : '');

		$imageName = "";
		$fileInput = $this->request->getFile($fileName);
		if( $fileInput ){
			if ($fileInput->isValid() && ! $fileInput->hasMoved()){
				//$ext = $fileInput->guessExtension();
				$imageName = $prefixo .'_'. $fileInput->getRandomName();
				//$imgAssinatura1 = 'assinatura_foto.'. $fileInput->guessExtension();
				$fileInput->move( $folder, $imageName);
			}
		}
		return $imageName;
	}

	public function excluir_arquivos_antigos( $arr_list_files = [] ){
		foreach ($arr_list_files as $keyArq => $valArq) {
			$file_new = (isset($valArq['file_new']) ? $valArq['file_new'] : '');
			$file_old = (isset($valArq['file_old']) ? $valArq['file_old'] : '');
			$folder = (isset($valArq['folder']) ? $valArq['folder'] : '');
			if( !empty($file_new) && !empty($file_old) ){
				$path_file_new = $folder ."/". $file_new;
				$path_file_old = $folder ."/". $file_old;
				if( file_exists($path_file_old) ){	
					unlink($path_file_old);
				}
			}else{
				//print '<pre>';
				//print_r($path_file_old);
				//print '</pre>'; 
			}
		}
	}


	public function view_image( $args = [] )
	{
		$file_name = (isset($args['file_name']) ? $args['file_name'] : '');
		$folder = (isset($args['folder']) ? $args['folder'] : '');

		$file_path = WRITEPATH .'uploads/'. $folder .'/'. $file_name;
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


	public function get_folder_grupo( $args = [] )
	{
		$path_folder_grupo = "";

		$grp_id = (int)(isset($args['grp_id']) ? $args['grp_id'] : '');

		$grpMD = new \App\Models\GruposModel();
		$grpMD->from('tbl_grupos GRP', true)
			->select('GRP.grp_urlpage')
			->select('EVENT.event_urlpage')
			->select('INSTI.insti_urlpage')
			->select('EVENT.event_urlpage')
			->join('tbl_grupos_x_eventos GRPEVT', 'GRPEVT.grp_id = GRP.grp_id', 'INNER')
			->join('tbl_eventos EVENT', 'EVENT.event_id = GRPEVT.event_id', 'INNER')
			->join('tbl_instituicoes INSTI', 'INSTI.insti_id = GRP.insti_id', 'INNER')				
			//->where('PARTC.insti_id', (int)$this->session_user_id)
			//->where('GRP.grp_hashkey', $_grp_hashkey)
			->where('GRP.grp_id', (int)$grp_id)
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

			//print '<pre>';
			//print_r( $segment_folder );
			//print '</pre>';

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
		}


		return $path_folder_grupo;
	}










}