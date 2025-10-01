<?php
namespace App\Libraries;

use CodeIgniter\Libraries; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerLib {

    private $mailer;

    public function __construct()
	{
		$this->mailer = new PHPMailer(true);
    }

	public function send($args = array())
	{
		$config = new \Config\AppSettings();
		$cfg_info_base = [];

		$site_name = "Dança Carajás Festival 2025";

		// Detectar ambiente
		$http_host = $_SERVER['HTTP_HOST'] ?? '';
		$is_localhost = in_array($http_host, ['localhost', '127.0.0.1']) || 
						strpos($http_host, 'localhost') !== false ||
						strpos($http_host, '127.0.0.1') !== false;

		if ($is_localhost) {
			// Configuração localhost
			$lbl_email    = 'inscricoes@dancacarajas.com.br';
			$lbl_host     = 'localhost';
			$lbl_user     = 'inscricoes@dancacarajas.com.br';
			$lbl_password = 'Carajas@2025';
			$lbl_port     = 587;
			$lbl_ssl      = false;
			$lbl_tls      = false;
		} else {
			// Configuração produção
			$lbl_email    = 'inscricoes@dancacarajas.com.br';
			$lbl_host     = 'smtp.dancacarajas.com.br';
			$lbl_user     = 'inscricoes@dancacarajas.com.br';
			$lbl_password = 'Carajas@2025';
			$lbl_port     = 587; // TLS
			$lbl_ssl      = false;
			$lbl_tls      = true;
		}

		$cfg_info_smpt = [
			"sender_name"  => $site_name,
			"sender_mail"  => $lbl_email,
			"smtp_host"    => $lbl_host,
			"smtp_port"    => $lbl_port,
			"smtp_user"    => $lbl_user,
			"smtp_pass"    => $lbl_password,
			"smtp_auth"    => true,
			"smtp_ssl"     => $lbl_ssl,
			"smtp_tls"     => $lbl_tls,
			"mail_debug"   => true,
			"test_localhost" => $is_localhost,
		];

		$enviar_para = array_unique($args["enviar_para"] ?? []);
		$anexos      = $args["anexos"] ?? [];
		$fileFields  = $args["fields"] ?? [];

		$dataParser = array_merge([
			'base_url'      => base_url(),
			'site_url'      => site_url(),
			'data_envio'    => date("d/m/Y H:i:s"),
			'ip_visitante'  => $_SERVER["REMOTE_ADDR"] ?? ''
		], $cfg_info_base, $fileFields);

		$strSubject = "[". $site_name ."] : ". ($args["subject"] ?? "");
		$template   = $args["template"] ?? "";
		$strBody    = $args["body"] ?? "<!-- não informado -->";

		if (!empty($template)) {
			$parser = \Config\Services::parser();
			$strBody = $parser->setData($dataParser)->render($template);
		}

		$mail = $this->mailer;
		$mail->CharSet = 'UTF-8';
		$mail->SMTPOptions = [
			'ssl' => [
				'verify_peer'      => false,
				'verify_peer_name' => false,
				'allow_self_signed'=> true
			]
		];

		// Configuração SMTP
		if ($cfg_info_smpt['smtp_auth']) {
			$mail->isSMTP();
			$mail->SMTPAuth   = true;
			if ($cfg_info_smpt['smtp_tls']) { $mail->SMTPSecure = 'tls'; }
			if ($cfg_info_smpt['smtp_ssl']) { $mail->SMTPSecure = 'ssl'; }
			$mail->Host       = $cfg_info_smpt['smtp_host'];
			$mail->Port       = $cfg_info_smpt['smtp_port'];
			$mail->Username   = $cfg_info_smpt['smtp_user'];
			$mail->Password   = $cfg_info_smpt['smtp_pass'];
		} else {
			$mail->isMail();
		}

		$mail->SMTPDebug   = 2; // debug
		$mail->Debugoutput = 'html';

		// Remetente
		$mail->setFrom($cfg_info_smpt['sender_mail'], $cfg_info_smpt['sender_name']);

		foreach ($enviar_para as $userEmail) {
			$mail->addAddress($userEmail);
			$mail->addReplyTo($cfg_info_smpt['sender_mail'], $cfg_info_smpt['sender_name']);

			// Anexos
			foreach ($anexos as $valAnexo) {
				$mail->addAttachment($valAnexo);
			}

			// Conteúdo
			$mail->isHTML(true);
			$mail->Subject = $strSubject;
			$mail->Body    = $strBody;

			if (!$mail->send()) {
				// Log do erro
				log_message('error', 'Erro ao enviar email para '.$userEmail.': '.$mail->ErrorInfo);
			}

			// Limpar destinatários e anexos para próximo loop
			$mail->clearAddresses();
			$mail->clearAttachments();
		}
	}
}
