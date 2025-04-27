<?php
    include_once("../app/services/helpers/authUser.php");
    include_once("../app/services/helpers/conn.php");
    include_once("../app/services/helpers/paths.php");
    
    validateRememberedCookie($conn, "home.php");

    if(isset($_POST['logar'])) {
        logIn($conn);
        if(empty($return['email'])){
            $loginErrorMsg = "Usuário ou senha não encontrados!";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../app/assets/styles/style.css">
        <link rel="icon" href="../app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Login</title>
    </head>

    <body class="Y-theme">
        <?php 
            include_once("../app/includes/headerLanding.php");
        ?>
        <p>Teste</p>
        <?php 
            include_once("../app/includes/footer.php");
        ?>
        
        <script src="../app/assets/js/system.js"></script>
    </body>
</html>
