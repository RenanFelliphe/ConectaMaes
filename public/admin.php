<?php 
    session_start();
    include_once __DIR__ . "/../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    require_once "../app/services/crud/userFunctions.php"; 
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);   
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Administração</title>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">
        <?php include_once ("../app/includes/headerHome.php");?>

        <main class="Ho-Main">

        </main>

        <?php include_once ("../app/includes/modais.php");?>
        
        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>        
            toggleTheme();
        </script>
    </body>
</html>