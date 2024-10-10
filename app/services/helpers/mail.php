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

    $mailServer->setFrom($email,$name);
    $mailServer->addAddress("conectamaes2024@gmail.com", "Equipe ConectaMães");

    $mailServer->Subject = $subject;
    $mailServer->Body = $message;
    function sendEmail($mailServer){
        $mailServer->send();
        echo "<p>Sua mensagem foi enviada com sucesso. Nossa equipe agradece seu feedback!</p>";
    }
    

    
