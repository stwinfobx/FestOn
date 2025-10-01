<?php
namespace App\Controllers\Painel;
use App\Controllers\PainelController;

use App\Libraries\PHPMailerLib;

class Particautorizacoes extends PainelController
{
	protected $eventMD = null;
	protected $evdteMD = null;
	protected $evvlrMD = null;
	protected $evcobMD = null;

	protected $grpMD = null;
	protected $grevtMD = null;

	protected $autzMD = null;
	protected $evtautMD = null;
	protected $ptcautMD = null;
	protected $partcMD = null;

    public function __construct()
    {
        $this->eventMD = new \App\Models\EventosModel();
		$this->evdteMD = new \App\Models\EventosDatasModel();
		$this->evvlrMD = new \App\Models\EventosValoresModel();
		$this->evcobMD = new \App\Models\EventosCobrancaModel();

		$this->grpMD = new \App\Models\GruposModel();
		$this->grevtMD = new \App\Models\GruposEventosModel();

		$this->autzMD = new \App\Models\AutorizacoesModel();
		$this->evtautMD = new \App\Models\EventosAutorizacoesModel();
		$this->ptcautMD = new \App\Models\ParticipantesAutorizacoesModel();
		$this->partcMD = new \App\Models\ParticipantesModel();

		$this->data['menu_active'] = 'particautorizacoes';
    }


	public function index()
	{

		$event_id = 0;
		if ($this->request->getPost())
		{
			$event_id = (int)$this->request->getPost('event_id');
			$this->data['bsc_event_id'] = $event_id;
		}

		
		// CONTA O TOTAL DE AUTORIZAÇÕES PARA O EVENTO
		// Funcionando
		/*
			SELECT 
				EVET.event_titulo,
				GRP.grp_titulo, 
				PARTC.partc_nome,
				COUNT(DISTINCT EVTAUT.autz_id) AS total_autorizacoes,
				COUNT(DISTINCT PTCAUT.evtaut_id) AS total_autorizacoes_checadas
			FROM tbl_grupos_x_eventos AS GREVT
			INNER JOIN tbl_eventos AS EVET ON EVET.event_id = GREVT.event_id
			INNER JOIN tbl_grupos AS GRP ON GRP.grp_id = GREVT.grp_id
			INNER JOIN tbl_eventos_autorizacoes AS EVTAUT ON EVTAUT.event_id = GREVT.event_id
			LEFT JOIN tbl_participantes_x_autorizacoes AS PTCAUT ON PTCAUT.grevt_id = GREVT.grevt_id 
				-- AND PTCAUT.evtaut_id = EVTAUT.autz_id
			INNER JOIN tbl_participantes AS PARTC ON PARTC.partc_id = PTCAUT.partc_id
			WHERE 
				GREVT.event_id = 7
			GROUP BY 
				GRP.grp_titulo;	
		*/	

			$this->autzMD->from('tbl_grupos_x_eventos AS GREVT', true)
				//->select('GREVT.grevt_hashkey, PARTC.partc_hashkey')
				->select('EVET.event_id, EVET.event_titulo')
				->join('tbl_eventos AS EVET', 'EVET.event_id = GREVT.event_id')
				->join('tbl_grupos AS GRP', 'GRP.grp_id = GREVT.grp_id')
				->join('tbl_eventos_autorizacoes AS EVTAUT', 'EVTAUT.event_id = GREVT.event_id')
				->join('tbl_participantes_x_autorizacoes AS PTCAUT', 'PTCAUT.grevt_id = GREVT.grevt_id', 'left')
				->join('tbl_participantes AS PARTC', 'PARTC.partc_id = PTCAUT.partc_id');
				//->where('GREVT.event_id', 7)
				//->groupBy('EVET.event_id, GRP.grp_titulo, GRP.grp_id, PARTC.partc_id')
			$this->autzMD->groupBy('EVET.event_id, EVET.event_titulo')
				->orderBy('EVET.event_titulo', 'ASC')
				->orderBy('GRP.grp_id', 'ASC');
			$query_autorizacoes_event = $this->autzMD->get(); 
			//print $this->autzMD->getLastQuery();
			if( $query_autorizacoes_event && $query_autorizacoes_event->resultID->num_rows >= 1 )
			{
				$this->data['rs_autorizacoes_event'] = $query_autorizacoes_event;
			}

			$this->autzMD->from('tbl_grupos_x_eventos AS GREVT', true)
				->select('GREVT.grevt_id, GREVT.grevt_hashkey, PARTC.partc_hashkey')
				->select('EVET.event_id, EVET.event_hashkey, EVET.event_titulo, GRP.grp_titulo, PARTC.partc_nome')
				->select('COUNT(DISTINCT EVTAUT.autz_id) AS total_autorizacoes')
				->select('COUNT(DISTINCT PTCAUT.evtaut_id) AS total_autorizacoes_checadas')
				->join('tbl_eventos AS EVET', 'EVET.event_id = GREVT.event_id')
				->join('tbl_grupos AS GRP', 'GRP.grp_id = GREVT.grp_id')
				->join('tbl_eventos_autorizacoes AS EVTAUT', 'EVTAUT.event_id = GREVT.event_id')
				->join('tbl_participantes_x_autorizacoes AS PTCAUT', 'PTCAUT.grevt_id = GREVT.grevt_id', 'left')
				->join('tbl_participantes AS PARTC', 'PARTC.partc_id = PTCAUT.partc_id');
			if( $event_id > 0 ){
				$this->autzMD->where('GREVT.event_id', $event_id);
			}
				//->where('GREVT.event_id', 7)
				//->groupBy('EVET.event_id, GRP.grp_titulo, GRP.grp_id, PARTC.partc_id')
			$this->autzMD->groupBy('GREVT.grevt_hashkey, GRP.grp_titulo')
				->orderBy('EVET.event_id', 'ASC')
				->orderBy('GRP.grp_id', 'ASC');
			$query_autorizacoes_event = $this->autzMD->get(); 
			//print $this->autzMD->getLastQuery();
			if( $query_autorizacoes_event && $query_autorizacoes_event->resultID->num_rows >= 1 )
			{
				//$this->data['qtd_autorizacoes'] = $query_autorizacoes->resultID->num_rows;
				//$this->data['rs_list_autorizacoes'] = $query_autorizacoes;

				$arr_list_autorizacoes = [];
				foreach ($query_autorizacoes_event->getResult() as $row) {
					/*
					$this->autzMD->from('tbl_grupos_x_eventos AS GREVT', true)
						->select('GREVT.grevt_hashkey, PARTC.partc_hashkey, PARTC.partc_nome, PARTC.partc_file_foto')
						->select('EVET.event_id, EVET.event_titulo, GRP.grp_titulo')
						->select('COUNT(DISTINCT EVTAUT.autz_id) AS total_autorizacoes')
						->select('COUNT(DISTINCT PTCAUT.evtaut_id) AS total_autorizacoes_checadas')
						->join('tbl_eventos AS EVET', 'EVET.event_id = GREVT.event_id')
						->join('tbl_grupos AS GRP', 'GRP.grp_id = GREVT.grp_id')
						->join('tbl_eventos_autorizacoes AS EVTAUT', 'EVTAUT.event_id = GREVT.event_id')
						->join('tbl_participantes_x_autorizacoes AS PTCAUT', 'PTCAUT.grevt_id = GREVT.grevt_id', 'left')
						->join('tbl_participantes AS PARTC', 'PARTC.partc_id = PTCAUT.partc_id', 'left');
					if( $event_id > 0 ){
						$this->autzMD->where('GREVT.event_id', $event_id);
					}				
					$this->autzMD->where('GREVT.grevt_hashkey', $row->grevt_hashkey);
					$this->autzMD->groupBy('EVET.event_id, GRP.grp_titulo, GRP.grp_id, PARTC.partc_id')
						->orderBy('EVET.event_id', 'ASC')
						->orderBy('GRP.grp_id', 'ASC');
					$query_autorizacoes = $this->autzMD->get(); 
					print $this->autzMD->getLastQuery();
					*/

					/*
						SELECT 
							-- GREVT.grevt_hashkey, 
							PARTC.grevt_id,
							GREVT.grevt_hashkey,
							PARTC.partc_hashkey, PARTC.partc_nome, PARTC.partc_file_foto,
							COUNT(DISTINCT EVTAUT.autz_id) AS total_autorizacoes, 
							COUNT(DISTINCT PTCAUT.evtaut_id) AS total_autorizacoes_checadas 	
							-- EVET.event_id, EVET.event_titulo, 
							-- GRP.grp_titulo, 
							-- COUNT(DISTINCT EVTAUT.autz_id) AS total_autorizacoes, 
							-- COUNT(DISTINCT PTCAUT.evtaut_id) AS total_autorizacoes_checadas 
						FROM tbl_participantes AS PARTC
							LEFT JOIN tbl_participantes_x_autorizacoes AS PTCAUT ON PTCAUT.partc_id = PARTC.partc_id
							LEFT JOIN tbl_grupos_x_eventos AS GREVT ON GREVT.grevt_id = PARTC.grevt_id 
							LEFT JOIN tbl_eventos_autorizacoes AS EVTAUT ON EVTAUT.event_id = GREVT.event_id 
							-- LEFT JOIN tbl_eventos AS EVET ON EVET.event_id = PTCAUT.grevt_id  
							-- LEFT JOIN tbl_eventos AS EVET ON EVET.event_id = PTCAUT.grevt_id 
							-- JOIN tbl_eventos AS EVET ON EVET.event_id = PTCAUT.grevt_id 
						-- WHERE PARTC.grevt_id = 1
						WHERE GREVT.grevt_hashkey = '3418a92831a1b36420edc600b4b1a8a7' 
						GROUP BY PARTC.partc_id
						;				
					*/
					$this->partcMD->from('tbl_participantes AS PARTC', true)
						->select('PARTC.grevt_id, PARTC.partc_hashkey, PARTC.partc_nome, PARTC.partc_file_foto')
						//->select('EVET.event_id, EVET.event_titulo, GRP.grp_titulo')
						->select('COUNT(DISTINCT EVTAUT.autz_id) AS total_autorizacoes')
						->select('COUNT(DISTINCT PTCAUT.evtaut_id) AS total_autorizacoes_checadas')
						->join('tbl_participantes_x_autorizacoes AS PTCAUT', 'PTCAUT.partc_id = PARTC.partc_id', 'LEFT')
						->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grevt_id = PARTC.grevt_id', 'LEFT')
						->join('tbl_eventos_autorizacoes AS EVTAUT', 'EVTAUT.event_id = GREVT.event_id', 'LEFT');
						//->join('tbl_eventos AS EVET', 'EVET.event_id = GREVT.event_id')
						//->join('tbl_grupos AS GRP', 'GRP.grp_id = GREVT.grp_id')
						//->join('tbl_participantes AS PARTC', 'PARTC.partc_id = PTCAUT.partc_id', 'left');
					if( $event_id > 0 ){
						$this->partcMD->where('GREVT.grevt_id', $row->grevt_id);
					}				
					$this->partcMD->where('GREVT.grevt_hashkey', $row->grevt_hashkey);
					$this->partcMD->groupBy('PARTC.partc_id')
						//->orderBy('EVET.event_id', 'ASC')
						->orderBy('PARTC.partc_id', 'ASC');
					$query_autorizacoes = $this->partcMD->get(); 
					//print $this->partcMD->getLastQuery();
					if( $query_autorizacoes && $query_autorizacoes->resultID->num_rows >= 1 )
					{
						//$this->data['qtd_autorizacoes'] = $query_autorizacoes->resultID->num_rows;
						//$this->data['rs_list_autorizacoes'] = $query_autorizacoes;
						//$arr_list_autorizacoes[$row->grevt_hashkey] = $query_autorizacoes->getResult();
						$arr_temp = (object) array(
							"event_id" => (int)$row->event_id,
							"event_hashkey" => $row->event_hashkey,
							"event_titulo" => $row->event_titulo,
							"grevt_hashkey" => $row->grevt_hashkey,
							"grp_titulo" => $row->grp_titulo,
							"participantes" => $query_autorizacoes->getResult()
							//"list" => $quantidade,
							//"tvlrvalor" => $tvlr_valor,
							//"tvlrsubtotal" => $sub_total,
						);
						array_push($arr_list_autorizacoes, $arr_temp);
					}
				}

				$this->data['rs_list_autorizacoes'] = $arr_list_autorizacoes;
			}


		//$this->autzMD->from('tbl_autorizacoes GRUPO', true)
		//	->select('GRUPO.autz_id, GRUPO.autz_parent_id, GRUPO.autz_hashkey, GRUPO.autz_titulo, GRUPO.autz_descricao')
		//	->select('ITENS.autz_titulo As autz_titulo_parent')
		//	->join('tbl_autorizacoes ITENS', 'GRUPO.autz_parent_id = ITENS.autz_id', 'LEFT')
		//	->orderBy('GRUPO.autz_id', 'ASC')
		//	->orderBy('GRUPO.autz_parent_id', 'ASC')
		//	->limit(1000);
		//$query_autorizacoes = $this->autzMD->get();
		////print $this->autzMD->getLastQuery();
		//if( $query_autorizacoes && $query_autorizacoes->resultID->num_rows >=1 )
		//{
		//	$this->data['rs_autorizacoes'] = $query_autorizacoes;
		//}

		return view($this->directory .'/autorizacoes-participantes', $this->data);
	}


	public function ajaxform( $action = "" )
	{
		$error_num = "1";
		$error_msg = "Erro inesperado";
		$redirect = "";

		switch ($action) {
		case "EXCLUIR-REGISTRO" :

			$curso_hashkey = $this->request->getPost('curso_hashkey');
			$query = $this->cursoMD->where('curso_hashkey', $curso_hashkey)->get();
			if( $query && $query->resultID->num_rows >=1 )
			{
				$rs_registro = $query->getRow();
				$curso_id = (int)$rs_registro->curso_id;			

				// excluir registro
				$this->cursoMD->where('curso_hashkey', $curso_hashkey)->delete();

				//$this->cursoMD->set('solt_excluido', 1);
				//$this->cursoMD->where('curso_hashkey', $curso_hashkey);
				//$this->cursoMD->where('curso_id', $curso_id);
				//$this->cursoMD->update();

				$error_num = "0";
				$error_msg = "Registro excluído com sucesso!";
				$redirect = "";
			}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"redirect" => $redirect 
			);

			echo( json_encode($arr_return) );
			exit();
		break;

		case "REENVIAR-EMAIL-TERMOS" :

			$partc_hashkey = $this->request->getPost('partc_hashkey');
			$grevt_hashkey = $this->request->getPost('grevt_hashkey');

			/*
			SELECT EVTAUT.event_id, AUT.* FROM tbl_eventos_autorizacoes EVTAUT
				INNER JOIN tbl_autorizacoes AUT ON AUT.autz_id = EVTAUT.autz_id
			WHERE EVTAUT.event_id = 8;

			SELECT EVTAUT.event_id, AUT.* FROM tbl_eventos_autorizacoes EVTAUT
				INNER JOIN tbl_autorizacoes AUT ON AUT.autz_id = EVTAUT.autz_id
				INNER JOIN tbl_eventos EVET ON EVET.event_id = EVTAUT.event_id
			WHERE EVET.event_hashkey = '19ec236c67883adae1b3342a56baec8f';
			*/

			$this->grpMD->from('tbl_grupos As GRP', true)
				->select('GREVT.grevt_id')
				->select('GRP.*')
				->select('EVENT.*')
				->join('tbl_grupos_x_eventos AS GREVT', 'GREVT.grp_id = GRP.grp_id', 'INNER')
				->join('tbl_eventos AS EVENT', 'EVENT.event_id = GREVT.event_id', 'INNER')
				->where('GREVT.grevt_hashkey', $grevt_hashkey)
				->orderBy('GREVT.grevt_id', 'DESC')
				->limit(1);
			$query_grupo_evt = $this->grpMD->get();
			//print $this->grpMD->getLastQuery();
			if( $query_grupo_evt && $query_grupo_evt->resultID->num_rows >=1 )
			{
				$rs_grupo_evt = $query_grupo_evt->getRow();
				//$this->data['rs_grupo_evt'] = $rs_grupo_evt;

				//$insti_id = (int)$rs_grupo_evt->insti_id;
				//$event_id = (int)$rs_grupo_evt->event_id;
				//$grp_id = (int)$rs_grupo_evt->grp_id;
				//$grevt_id = (int)$rs_grupo_evt->grevt_id;
				//$grp_titulo = $rs_grupo_evt->grp_titulo;
				//$event_titulo = $rs_grupo_evt->event_titulo;


				$event_hashkey = $rs_grupo_evt->event_hashkey; 
			}



			$this->autzMD->from('tbl_autorizacoes AUT', true)
				->select('EVTAUT.event_id')
				->select('AUT.*')
				->join('tbl_eventos_autorizacoes AS EVTAUT', 'EVTAUT.autz_id = AUT.autz_id', 'INNER')
				->join('tbl_eventos EVET', 'EVET.event_id = EVTAUT.event_id', 'INNER')
				->where('EVET.event_hashkey', $event_hashkey);
			$query_autorizacoes = $this->autzMD->get();
			//print $this->autzMD->getLastQuery();
			//print $query_autorizacoes->resultID->num_rows;
			$html_autoriz = '';
			if( $query_autorizacoes && $query_autorizacoes->resultID->num_rows >= 1 )
			{
				foreach ($query_autorizacoes->getResult() as $row) {
					$autz_titulo = $row->autz_titulo;
					$html_autoriz .= '<li><strong>'. $autz_titulo .'</strong></li>';
				}
			}

			$BANNER_DO_FESTIVAL = 'https://misterlab.com.br/jafeston/public/files-upload/ballerina-dance-academy__banner__1701865173_2fMu.jpg';

			$this->eventMD->select('*')
				->where('event_hashkey', $event_hashkey)
				->limit(1);
			$query_eventos = $this->eventMD->get();
			//print $this->eventMD->getLastQuery();
			$NOME_DO_FESTIVAL = "";
			if( $query_eventos && $query_eventos->resultID->num_rows >= 1 )
			{
				$rs_eventos = $query_eventos->getRow();
				$NOME_DO_FESTIVAL = $rs_eventos->event_titulo;
				$event_banner = ($rs_eventos->event_banner);
				$BANNER_DO_FESTIVAL = base_url($this->folder_upload) . $event_banner; 
			}
			//exit();


			$EMAIL_DESTINO = '';

			$this->partcMD->select('*')
				->where('partc_hashkey', $partc_hashkey)
				->limit(1);
			$query_participacoes = $this->partcMD->get();
			$NOME_DO_PARTICIPANTE = "";
			if( $query_participacoes && $query_participacoes->resultID->num_rows >= 1 )
			{
				$rs_participacoes = $query_participacoes->getRow();
				$NOME_DO_PARTICIPANTE = $rs_participacoes->partc_nome;
				$EMAIL_DESTINO = $rs_participacoes->partc_email;

				// Se for Menor, enviar para o Responsável
				$partc_menor_idade = (int)$rs_participacoes->partc_menor_idade;
				if( $partc_menor_idade == 1 ){
					$EMAIL_DESTINO = $rs_participacoes->partc_resp_email;	
				}
			}

			//$link_autorizacoes = site_url( 'inscricoes/compliance/'. $grevt_hashkey .'/'. $partc_hashkey );
			$LINK_DA_AUTORIZACAO = site_url( 'inscricoes/compliance/'. $grevt_hashkey .'/'. $partc_hashkey );
			// inscricoes/compliance/3418a92831a1b36420edc600b4b1a8a7/dTTIZZ2HXQZKNBj1Boj0lDcMJMGXrpFW

			/*
			 * -------------------------------------------------------------
			 * ENVIAR EMAIL PARA O CLIENTE
			 * -------------------------------------------------------------
			**/
			if( !empty($EMAIL_DESTINO) ){
				$data_fields = [
					'site_name' => "JA-Feston",
					'BANNER_DO_FESTIVAL' => $BANNER_DO_FESTIVAL,
					'NOME_DO_FESTIVAL' => $NOME_DO_FESTIVAL,
					'NOME_DO_PARTICIPANTE' => $NOME_DO_PARTICIPANTE,
					'LISTA_DE_AUTORIZACOES' => $html_autoriz,
					'LINK_DA_AUTORIZACAO' => $LINK_DA_AUTORIZACAO,
					'DATA_DA_INSCRICAO' => date("d/m-Y H:i:s"),
				];
				// $stringEmail = view('emails/participantes-autorizacoes-view-antigo', $data_fields);
				$stringEmail = view('emails/confirmacao-inscricao-view', $data_fields);

				$enviar_para = array( 
					//'listasguardiao@gmail.com',
					'dancacarajas@gmail.com',
					//'marcio.mjlima1977@gmail.com',
					// 'marcio.misterlab@gmail.com',
					//'mjlima@hotmail.com',
					//'dancacarajas@gmail.com',
				);
				//$enviar_para = array( $EMAIL_DESTINO );
				$arr_fields = [];
				$arr_anexos = [];
				$args_email = array(
					"body"			=> $stringEmail,
					"subject"		=> "Você Está Dentro do Festival Dance! Agora Só Falta Um Passo",
					"fields"		=> $arr_fields,
					"enviar_para"	=> $enviar_para,
					"anexos"		=> $arr_anexos,
				);
				$pMail = new PHPMailerLib();
				$pMail->send($args_email);	
				
				$error_num = "0";
				$error_msg = "E-mail enviado com sucesso";
			}


			//$query = $this->cursoMD->where('curso_hashkey', $curso_hashkey)->get();
			//if( $query && $query->resultID->num_rows >=1 )
			//{
			//	$rs_registro = $query->getRow();
			//	$curso_id = (int)$rs_registro->curso_id;			

			//	// excluir registro
			//	$this->cursoMD->where('curso_hashkey', $curso_hashkey)->delete();

			//	//$this->cursoMD->set('solt_excluido', 1);
			//	//$this->cursoMD->where('curso_hashkey', $curso_hashkey);
			//	//$this->cursoMD->where('curso_id', $curso_id);
			//	//$this->cursoMD->update();

			//	$error_num = "0";
			//	$error_msg = "Registro excluído com sucesso!";
			//	$redirect = "";
			//}

			$arr_return = array(
				"error_num" => $error_num,
				"error_msg" => $error_msg,
				"redirect" => $redirect 
			);

			echo( json_encode($arr_return) );
			exit();
		break;
		}
	}

}
