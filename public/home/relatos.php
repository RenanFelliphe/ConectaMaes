<?php 
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../../app/services/helpers/paths.php";

    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    
    require_once "../../app/services/crud/userFunctions.php"; 
    require_once "../../app/services/crud/postFunctions.php";
    require_once '../../app/services/helpers/dateChecker.php';

    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);  

    // Processar $_POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($likedPost = array_keys($_POST, 'like', true)) {
            $postId = str_replace('like_', '', $likedPost[0]); // Extrai o ID da publicação
            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId); // Lida com o like
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Relatos</title>
        </meta>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main mainSystem">
            <?php include_once ("../../app/includes/asideLeft.php");?>

            <section class="timeline">
                <!-- 
                <section class="Ho-postFilter">
                    <h1 class="Ho-postRecent Ho-mainFilters active" onclick="toggleAuxilioFilter(this);">Recentes</h1>
                    <h1 class="Ho-postMain Ho-mainFilters" onclick="toggleAuxilioFilter(this);">Principais</h1>
                </section>
                -->

                <?php
                    $tipoPublicacao = 'Relato';
                    include_once ("../../app/includes/posts.php");
                ?>
            </section>

            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>
        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>