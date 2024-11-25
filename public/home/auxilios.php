<?php 
    include_once ("../../app/includes/globalIncludes.php"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Auxílios</title>
        </meta>
    </head>

    <body class="<?= $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main Au-main mainSystem">
            <?php include_once ("../../app/includes/asideLeft.php");?>

            <section class="timeline">
                <!--
                <section class="Ho-postFilter">
                    <h1 class="Ho-postRecent Ho-mainFilters active" onclick="toggleAuxilioFilter(this);">Recentes</h1>
                    <h1 class="Ho-postMain Ho-mainFilters" onclick="toggleAuxilioFilter(this);">Principais</h1>
                </section>
                -->
                
                <section class="Au-allAuxilios">
                    <?php
                        $tipoPublicacao = 'Auxilio';
                        include_once ("../../app/includes/posts.php");
                    ?>
                </section>
            </section>

            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>
        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>