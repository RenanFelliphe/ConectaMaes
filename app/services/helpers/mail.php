<?php
    require_once "paths.php";
    require __DIR__ . '/../../../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $name = $_POST["nomeContato"];
    $email = $_POST["emailContato"];
    $subject = $_POST["assuntoContato"];
    $message = $_POST["mensagemContato"];

    function configureMailServer($name, $email, $subject, $message) {
        $mailServer = new PHPMailer(true);
        try {
            //$mailServer->SMTPDebug = SMTP::DEBUG_SERVER;
            $mailServer->isSMTP();
            $mailServer->SMTPAuth = true;
            
            $mailServer->Host = "mail.conectamaes.linceonline.com.br";
            $mailServer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mailServer->Port = 465;

            $mailServer->Username = "contato@conectamaes.linceonline.com.br";
            $mailServer->Password = "!JCaBe%1}?9u";

            $mailServer->setFrom("$email", $name);
            $mailServer->addAddress("contato@conectamaes.linceonline.com.br");

            $mailServer->Subject = $subject;
            $mailServer->Body = "Olá, ConectaMães.\n" . $message;
            $mailServer->send();

            echo "<p>Sua mensagem foi enviada com sucesso. Nossa equipe agradece seu feedback!</p>";
        } catch (Exception $e) {
            echo "<p>Infelizmente não foi possível enviar sua mensagem. Tente novamente mais tarde!</p> \nErro: " . $e->getMessage();
        }
    }