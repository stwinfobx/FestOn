<?php
	$site_name = "";
	$cad_nome_completo = (isset($cad_nome_completo) ? $cad_nome_completo : '');
	
	$NOME_DO_PARTICIPANTE = (isset($NOME_DO_PARTICIPANTE) ? $NOME_DO_PARTICIPANTE : '');
	$NOME_DO_FESTIVAL = (isset($NOME_DO_FESTIVAL) ? $NOME_DO_FESTIVAL : '');
	$DATA_DA_INSCRICAO = (isset($DATA_DA_INSCRICAO) ? $DATA_DA_INSCRICAO : '');
	$LINK_DO_SITE = site_url();

	$TOPICOS_PARA_AUTORIZAR = 'itens';

	$grevt_hashkey = ""; $partc_hashkey = "";
	$LINK_DA_AUTORIZACAO = site_url('inscricoes/'. $grevt_hashkey .'/'. $partc_hashkey);	
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /*background-color: #f4f4f4;*/
            margin: 8px 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .imgevento {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
			margin-bottom: 2px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			display: block;
        }
		.imgevento img{ border-radius: 8px; }
        .header {
            background-color: #1E90FF;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }
        .content {
			background-color: #ffffff;
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .content h1 {
            font-size: 22px;
            margin-bottom: 10px;
        }
        .content p {
            margin-bottom: 15px;
        }
        .content a.button {
            display: inline-block;
            padding: 15px 25px;
            background-color: #1E90FF;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .content a.button:hover {
            background-color: #187bcd;
        }
        .footer {
            background-color: #f4f4f4;
            color: #888888;
            text-align: center;
            padding: 20px 15px;
            font-size: 14px;
        }
        .footer a {
            color: #1E90FF;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .emoji {
            font-size: 20px;
        }
    </style>
</head>
<body>

<table role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100.0%;background: #e3e3e3; border-collapse: collapse;">
	<tr>
		<td style="text-align: center; padding: 8px;"> 

			<center>
			<table role="presentation" border="0" cellpadding="0" cellspacing="0" style="max-width: 600px; border-collapse: collapse;">
				<tr>
					<td>

						<div class="imgevento">
							<div>
								<a href="<?php echo(site_url()); ?>" target="_blank"><img width="600" src="https://misterlab.com.br/jafeston/public/files-upload/ballerina-dance-academy__banner__1701865173_2fMu.jpg" style="width:100%; max-width:600px; border-radius:8px; display: block;" class="logo" /></a>
							</div>
						</div>
						<div class="container">
							<div class="header" >
								🎉 Você Está Dentro do <strong><?php echo($NOME_DO_FESTIVAL); ?></strong>!
							</div>
							<div class="content" style="text-align: start;">

								<h1>Oi, <?php echo($NOME_DO_PARTICIPANTE); ?>! 👋</h1>
								<p>Parabéns! Sua inscrição no <strong><?php echo($NOME_DO_FESTIVAL); ?></strong> foi feita com sucesso no dia <strong>[00/00/0000]</strong> às <strong>[00:00]</strong>. Estamos super animados em te ver fazendo parte desse evento incrível que celebra a dança e a cultura! 💃🕺</p>

								<p><strong>Agora, só falta uma coisinha:</strong> Para validar sua inscrição e garantir sua participação, precisamos que você dê o seu OK nos termos e condições abaixo. Isso é super importante para cumprir as regras da LGPD (Lei Geral de Proteção de Dados) e manter tudo certinho para o festival:</p>

								<ul>
									<li>📜 <strong>Autorização para Uso de Dados Pessoais:</strong> Concorde que a gente pode usar seus dados para organizar e divulgar o evento.</li>
									<li>📸 <strong>Permissão para Uso de Imagem e Voz:</strong> Aceite que suas fotos e vídeos durante o evento possam aparecer nas nossas redes sociais e materiais promocionais.</li>
									<li>📄 <strong>Concordância com as Regras do Festival:</strong> Leia e concorde com as nossas regras para que tudo role tranquilamente.</li>
									<li>📧 <strong>Autorização para Receber Comunicações:</strong> Fique ligado(a) nas novidades e atualizações que vamos mandar por e-mail e mensagem.</li>
								</ul>

								<p>Clica no botão aqui embaixo para autorizar tudo e fechar essa etapa com chave de ouro:</p>


								<center>
								<div>
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="text-align: center;">
											<center>
												<a href="<?php echo($LINK_DA_AUTORIZACAO); ?>" style="display: inline-block; padding: 15px 25px; background-color: #1E90FF; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; font-family: Arial, sans-serif; text-align: center; mso-line-height-rule: exactly;">Autorizar Termos e Condições</a>
											</center>
										</td>
									</tr>
								</table>
								</div>
								</center>


								<p>Estamos muito ansiosos para te ver brilhando no <strong><?php echo($NOME_DO_FESTIVAL); ?></strong>! 🌟 Qualquer dúvida, só chamar a gente.</p>

								<p>Abraços,<br>Equipe <strong><?php echo($NOME_DO_FESTIVAL); ?></strong></p>
							</div>
							<div class="footer">
								<p style="margin: 0;">Para mais informações, visite nosso <a href="<?php echo($LINK_DO_SITE); ?>">site oficial</a> ou siga-nos nas redes sociais.</p>
							</div>
						</div>

					</td>
				</tr>
			</table>
			</center>

		</td>
	</tr>
</table>

</body>
</html>