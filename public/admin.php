<?php 
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    require_once "../app/services/crud/userFunctions.php"; 
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);   
    $verifyAdmin = $currentUserData['isAdmin'] ? true : header("Location:".$relativePublicPath."/home.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Administração</title>
    </head>

    <body class="<?= $currentUserData['tema'];?>">
        <?php include_once ("../app/includes/headerHome.php");?>

        <main class="Ho-Main">

        </main>
        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>