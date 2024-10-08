<?php
    function enviarEmailContato() {
        $nomeContato = !empty($_POST['nomeContato']) ? htmlspecialchars(trim($_POST['nomeContato'])) : null;
        $emailContato = !empty($_POST['emailContato']) ? trim($_POST['emailContato']) : null;
        $assuntoContato = !empty($_POST['assuntoContato']) ? htmlspecialchars(trim($_POST['assuntoContato'])) : null;
        $mensagemContato = !empty($_POST['mensagemContato']) ? htmlspecialchars(trim($_POST['mensagemContato'])) : null;

        // Validação de e-mail
        if (!$emailContato || !filter_var($emailContato, FILTER_VALIDATE_EMAIL)) {
            echo "Endereço de e-mail inválido!";
            return;
        }

        if (!$nomeContato || !$assuntoContato || !$mensagemContato) {
            echo "Preencha todos os campos!";
            return;
        }

        $to = 'conectamaes2024@gmail.com';
        $subject = $assuntoContato;
        $message = "
            <html>
                <head>
                    <title>$assuntoContato</title>
                </head>
                <body>
                    <p><strong>Nome:</strong> $nomeContato</p>
                    <p><strong>Email:</strong> $emailContato</p>
                    <p><strong>Mensagem:</strong></p>
                    <p>$mensagemContato</p>
                </body>
            </html>
        ";

        $headers = array();
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';
        $headers[] = 'From: ' . $nomeContato . ' <' . $emailContato . '>';
        $headers[] = 'Reply-To: ' . $emailContato;

        // Envia o e-mail
        if (mail($to, $subject, $message, implode("\r\n", $headers))) {
            echo "E-mail enviado com sucesso!";
        } else {
            echo "Falha no envio do e-mail.";
        }
    }
