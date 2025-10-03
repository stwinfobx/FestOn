<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição - Dança Carajás Festival 2025</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .confirmation-banner {
            background: linear-gradient(135deg, #feb100, #ffd700);
            color: #000000;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        .confirmation-banner h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .confirmation-banner .emoji {
            font-size: 24px;
            margin-right: 10px;
        }
        .date-info {
            background-color: #ffffff;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eeeeee;
        }
        .date-info .emoji {
            font-size: 20px;
            margin-right: 8px;
        }
        .button-container {
            text-align: center;
            padding: 30px 20px;
        }

        .btn {
            display: inline-block;
            background-color: #feb100;
            color: #000000;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            margin: 10px;
        }
        .btn:hover {
            background-color: #e6a000;
        }
        .content {
            padding: 30px 20px;
            line-height: 1.6;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .success-message {
            background-color: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #28a745;
            margin: 20px 0;
            border-radius: 4px;
        }
        .success-message .emoji {
            font-size: 18px;
            margin-right: 8px;
        }
        .warning-message {
            background-color: #fff3cd;
            padding: 15px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning-message .emoji {
            font-size: 18px;
            margin-right: 8px;
        }
        .summary-section {
            background-color: #f8f9fa;
            padding: 25px;
            margin: 25px 0;
            border-radius: 8px;
        }
        .summary-section h3 {
            margin: 0 0 20px 0;
            color: #333333;
        }
        .summary-section .emoji {
            font-size: 20px;
            margin-right: 8px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eeeeee;
        }
        .summary-item:last-child {
            border-bottom: none;
        }
        .summary-label {
            font-weight: bold;
        }
        .status-badge {
            background-color: #feb100;
            color: #000000;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
        }
        .whatsapp-section {
            background-color: #e8f5e8;
            padding: 25px;
            margin: 25px 0;
            border-radius: 8px;
            text-align: center;
        }
        .whatsapp-section h3 {
            margin: 0 0 15px 0;
            color: #333333;
        }
        .whatsapp-section .emoji {
            font-size: 20px;
            margin-right: 8px;
        }
        .whatsapp-btn {
            background-color: #25d366;
            color: #ffffff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 15px;
        }
        .whatsapp-btn:hover {
            background-color: #1ea952;
        }
        .closing-message {
            text-align: center;
            padding: 30px 20px;
            background-color: #f8f9fa;
        }
        .closing-message .emoji {
            font-size: 24px;
            margin: 0 8px;
        }
        .footer {
            background-color: #feb100;
            color: #000000;
            padding: 20px;
            text-align: center;
        }
        .footer h3 {
            margin: 0 0 10px 0;
        }
        .footer a {
            color: #000000;
            text-decoration: underline;
        }
        .unsubscribe {
            font-size: 12px;
            color: #666666;
            margin-top: 15px;
        }
        .unsubscribe a {
            color: #666666;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <p style="font-size: 14px; color: #666666; margin: 0;">
                Esta é a sua confirmação de inscrição - Dança Carajás Festival 2025
            </p>
        </div>

        <!-- Banner -->
        <div class="confirmation-banner">
            <h1>
                <span class="emoji">🎉</span>
                <span class="emoji">👯</span>
                INSCRIÇÃO CONFIRMADA
            </h1>
            <div class="date-info">
                <span class="emoji">🗓️</span>
                <strong>Setembro/2025</strong>
            </div>
        </div>

        <!-- Button -->
        <div class="button-container">
            <a href="<?= base_url('index.php/inscricoes/status/' . $grevt_hashkey) ?>" class="btn">
                VER STATUS DA INSCRIÇÃO
            </a>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                <strong>Prezado(a) <?= $grp_titulo ?>,</strong>
            </div>

            <div class="success-message">
                <span class="emoji">✅</span>
                Sua inscrição no Dança Carajás Festival 2025 foi concluída com sucesso.
            </div>

            <div class="warning-message">
                <span class="emoji">⚠️</span>
                <strong>Reforçamos:</strong> apenas as coreografias <strong>homologadas</strong> estarão aptas a participar da Mostra Competitiva.
            </div>

            <!-- Summary Section -->
            <div class="summary-section">
                <h3>
                    <span class="emoji">✨</span>
                    Resumo da Inscrição
                </h3>
                
                <div class="summary-item">
                    <span class="summary-label">Participante:</span>
                    <span><?= $grp_titulo ?></span>
                </div>
                
                <div class="summary-item">
                    <span class="summary-label">Localidade:</span>
                    <span><?= $grp_end_cidade ?>/<?= $grp_end_estado ?></span>
                </div>
                
                <div class="summary-item">
                    <span class="summary-label">Status:</span>
                    <span class="status-badge">Aguardando curadoria</span>
                </div>
                
                <div class="summary-item">
                    <span class="summary-label">Próxima etapa:</span>
                    <span>
                        <span class="emoji">📊</span>
                        Resultado até 15/10/2025
                    </span>
                </div>
            </div>

            <!-- WhatsApp Section -->
            <div class="whatsapp-section">
                <h3>
                    <span class="emoji">💻</span>
                    <span class="emoji">💬</span>
                    Fique por dentro!
                </h3>
                
                <p>
                    Participe do <strong>grupo oficial no WhatsApp</strong> exclusivo para diretores dos grupos participantes.
                </p>
                
                <p>
                    Esse é o nosso canal direto de comunicação com você para avisos, prazos e informações importantes durante o festival.
                </p>
                
                <a href="https://wa.me/5599999999999" class="whatsapp-btn">
                    ENTRAR NO GRUPO OFICIAL DO WHATSAPP
                </a>
            </div>
        </div>

        <!-- Closing Message -->
        <div class="closing-message">
            <p>
                <span class="emoji">💃</span>
                <span class="emoji">🙌</span>
                Agradecemos sua participação nesta celebração da dança amazônica. Nos vemos na cena!
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <h3>Dança Carajás Festival 2025</h3>
            <p>JA Produções Artísticas</p>
            <p><a href="https://www.dancacarajas.com.br">www.dancacarajas.com.br</a></p>
            
            <div class="unsubscribe">
                <p>
                    Caso não deseje mais receber e-mails do festival, 
                    <a href="<?= base_url('unsubscribe/' . $grevt_hashkey) ?>">clique aqui</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
