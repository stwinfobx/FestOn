<?php
	$site_name = "";
	$cad_nome_completo = (isset($cad_nome_completo) ? $cad_nome_completo : '');
	
	
	$BANNER_DO_FESTIVAL = (isset($BANNER_DO_FESTIVAL) ? $BANNER_DO_FESTIVAL : 'https://misterlab.com.br/jafeston/public/files-upload/ballerina-dance-academy__banner__1701865173_2fMu.jpg');
	$NOME_DO_PARTICIPANTE = (isset($NOME_DO_PARTICIPANTE) ? $NOME_DO_PARTICIPANTE : '');
	$NOME_DO_FESTIVAL = (isset($NOME_DO_FESTIVAL) ? $NOME_DO_FESTIVAL : '');
	$DATA_DA_INSCRICAO = (isset($DATA_DA_INSCRICAO) ? $DATA_DA_INSCRICAO : '');
	$LINK_DO_SITE = site_url();

	$TOPICOS_PARA_AUTORIZAR = 'itens';

	$grevt_hashkey = ""; $partc_hashkey = "";
	//$LINK_DA_AUTORIZACAO = site_url('inscricoes/'. $grevt_hashkey .'/'. $partc_hashkey);
	$LINK_DA_AUTORIZACAO = (isset($LINK_DA_AUTORIZACAO) ? $LINK_DA_AUTORIZACAO : '');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo($site_name); ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
<div style="width:100%; margin: 0; background-color: #F1F1F1; padding: 40px 0;">
	<table width="100%" bgcolor="#F1F1F1" border="0" cellpadding="0" cellspacing="10" align="center">
		<tr>
			<td align="center">

				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 600px;">
					<tr>
						<td align="center" style="text-align: center;">
							<img width="600" src="<?php echo($BANNER_DO_FESTIVAL); ?>" style="width:100%; max-width:600px; margin: 0 auto; border-radius:8px; display: block;"/>
						</td>
					</tr>
					<tr>
						<td align="center" height="10" style="text-align: center;"></td>
					</tr>
				</table>

				<div style="max-width: 600px; border-radius:8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 600px;">
					<tr>
						<td align="center">
							<div style="background-color: #1E90FF; color: #ffffff; text-align: center; border-top-left-radius:8px; border-top-right-radius:8px; padding: 8px 8px 0px 8px; display: block;">
								<table width="100%" bgcolor="#1E90FF" border="0" cellpadding="0" cellspacing="0" align="center" style="width: 100%; max-width: 100%; margin: 0 auto; text-align: center;">
									<tr>
										<td align="center" height="2" style="padding: 0; ">
											<img width="2" height="2" src="https://misterlab.com.br/jafeston/public/assets/images/2px.png" style="width:2px; max-width:2px; margin: 0 auto; display: block;"/>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td bgcolor="#1E90FF" align="center" valign="middle" height="40">
							<div style="background-color: #1E90FF; color: #ffffff; text-align: center; border-top-left-radius:8px; border-top-right-radius:8px; padding: 8px; display: block;"><font color="#ffffff" size="5" face="Arial, Helvetica, sans-serif">🎉 Você Está Dentro do <strong><?php echo($NOME_DO_FESTIVAL); ?></strong>!</font></div>
						</td>
					</tr>
					<tr>
						<td align="center" bgcolor="#1E90FF" align="center" height="6" style="padding: 0; ">
							<img width="1" height="6" src="https://misterlab.com.br/jafeston/public/assets/images/2px.png" style="width:2px; max-width:2px; margin: 0 auto; display: block;"/>
						</td>
					</tr>
					<tr>
						<td align="center" style="">
							<div style="background-color: #FFFFFF; color: #000000; text-align: center;padding: 8px;">
								<table width="100%" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="12" align="center" style="max-width: 100%;">
									<tr>
										<td align="left" style="padding: 5px 20px; ">
											<font color="#000000" size="4" face="Arial, Helvetica, sans-serif">
												<h1>Oi, <?php echo($NOME_DO_PARTICIPANTE); ?>! 👋</h1>
											</font>
											<font color="#000000" size="3" face="Arial, Helvetica, sans-serif">
												<p>Parabéns! Sua inscrição no <strong><?php echo($NOME_DO_FESTIVAL); ?></strong> foi feita com sucesso no dia <strong>[00/00/0000]</strong> às <strong>[00:00]</strong>. Estamos super animados em te ver fazendo parte desse evento incrível que celebra a dança e a cultura! 💃🕺</p>

												<p><strong>Agora, só falta uma coisinha:</strong> Para validar sua inscrição e garantir sua participação, precisamos que você dê o seu OK nos termos e condições abaixo. Isso é super importante para cumprir as regras da LGPD (Lei Geral de Proteção de Dados) e manter tudo certinho para o festival:</p>

												<ul>
													<?php echo($LISTA_DE_AUTORIZACOES); ?>
													<!--
													<li>📜 <strong>Autorização para Uso de Dados Pessoais:</strong> Concorde que a gente pode usar seus dados para organizar e divulgar o evento.</li>
													<li>📸 <strong>Permissão para Uso de Imagem e Voz:</strong> Aceite que suas fotos e vídeos durante o evento possam aparecer nas nossas redes sociais e materiais promocionais.</li>
													<li>📄 <strong>Concordância com as Regras do Festival:</strong> Leia e concorde com as nossas regras para que tudo role tranquilamente.</li>
													<li>📧 <strong>Autorização para Receber Comunicações:</strong> Fique ligado(a) nas novidades e atualizações que vamos mandar por e-mail e mensagem.</li>
													-->
												</ul>

												<p>Clica no botão aqui embaixo para autorizar tudo e fechar essa etapa com chave de ouro:</p>
											</font>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td align="center" bgcolor="#FFFFFF" style="">
							<div style="background-color: #1E90FF; text-align: center; border-radius: 8px; padding: 8px; margin: 0 auto; max-width: 360px;">
								<table width="360" bgcolor="#1E90FF" border="0" cellpadding="0" cellspacing="10" align="center" style="max-width: 100%;">
									<tr>
										<td align="center">
											<div style="background-color: #1E90FF; color: #888888; text-align: center;padding: 8px;">
											<font color="#888888" size="3" face="Arial, Helvetica, sans-serif">
												<a href="<?php echo($LINK_DA_AUTORIZACAO); ?>" style="display: inline-block; padding: 8px 20px; background-color: #1E90FF; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; font-family: Arial, sans-serif; text-align: center; mso-line-height-rule: exactly;">Autorizar Termos e Condições</a>
											</font>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td align="center" style="">
							<div style="background-color: #FFFFFF; color: #000000; text-align: start; padding: 8px;">
								<table width="100%" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="12" align="center" style="max-width: 100%;">
									<tr>
										<td align="left" style="padding: 5px 20px; ">
											<font color="#000000" size="3" face="Arial, Helvetica, sans-serif">
												<p>Estamos muito ansiosos para te ver brilhando no <strong><?php echo($NOME_DO_FESTIVAL); ?></strong>! 🌟 Qualquer dúvida, só chamar a gente.</p>
											</font>

											<font color="#000000" size="3" face="Arial, Helvetica, sans-serif">
												<p>Abraços,<br>Equipe <strong><?php echo($NOME_DO_FESTIVAL); ?></strong></p>
											</font>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td align="left">
							<div style="background-color: #f4f4f4; color: #888888; text-align: start; padding: 8px;">
								<table width="100%" bgcolor="#f4f4f4" border="0" cellpadding="0" cellspacing="12" align="left" style="max-width: 100%;">
									<tr>
										<td align="center" style="padding: 5px 20px; ">
											<font color="#888888" size="2" face="Arial, Helvetica, sans-serif">
												Para mais informações, visite nosso <a href="<?php echo($LINK_DO_SITE); ?>">site oficial</a> ou siga-nos nas redes sociais.
											</font>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
				</table>
				</div>

			</td>
		</tr>
	</table>
</div>
</body>
</html>