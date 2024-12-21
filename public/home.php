<?php
    include_once __DIR__ . "/../app/includes/globalIncludes.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Home</title>
    </head>

    <body class="<?= $currentUserData['tema'];?>">

        <?php include_once ("../app/includes/headerHome.php");?>

        <main class="Ho-Main mainSystem">
            <?php include_once ("../app/includes/asideLeft.php");?>

            <section class="timeline">
                <?php 
                    $publicacoes = queryPostsAndUserData($conn, '', null, null, 10, 0, true);
                    include_once ("../app/includes/posts.php");
                ?>
            </section>

            <?php include_once ("../app/includes/asideRight.php");?>

           </main>
        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>
