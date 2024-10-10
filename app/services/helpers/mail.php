<?php
    require_once "paths.php";
    
    $name = $_POST["nomeContato"];
    $email = $_POST["emailContato"];
    $subject = $_POST["assuntoContato"];
    $message = $_POST["mensagemContato"];

    require __DIR__ . '/../../../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    $mailServer = new PHPMailer(true);

    //$mailServer->SMTPDebug = SMTP::DEBUG_SERVER;
    $mailServer->isSMTP();
    $mailServer->SMTPAuth = true;

    $mailServer->Host = "smtp.gmail.com";
    $mailServer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mailServer->Port = 587;

    $mailServer->Username = "conectamaes2024@gmail.com";
    $mailServer->Password = "lbik fekx toxo ieiy";

    $mailServer->setFrom("conectamaes2024@gmail.com", $name." - User");
    $mailServer->addAddress("conectamaes2024@gmail.com");

    $mailServer->Subject = $subject;
    $mailServer->Body =  $email. " enviou:\n\n". $message;
    function sendEmail($mailServer){
        try {
            $mailServer->send();
            echo "<p>Sua mensagem foi enviada com sucesso. Nossa equipe agradece seu feedback!</p>";
        } catch (Exception $e) {
            echo "<p>Infelizmente não foi possível enviar sua mensagem. Tente novamente mais tarde!</p> \nErro:{$mailServer->ErrorInfo}";
        }
    }
    

    
