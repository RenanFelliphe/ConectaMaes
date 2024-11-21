<?php include_once __DIR__ . "/../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre Interface</title>
</head>
<body class="Y-theme">
        <?php include_once ("../../app/includes/headerLanding.php");?>
        
        <main class="Su-suporte">
            <h2 class="La-sectionTitle">Políticas</h2>

            <section class="Su-helpSection">
                <article class="Su-articleCards">
                    <a href="<?= $relativePublicPath;?>/suporte.php" class="Su-card">
                        <img src="../../app/assets/imagens/icons/support_icon.png" alt="" class="Su-cardIcons">
                        <h3>Voltar ao Suporte</h3>
                    </a>
                    <a href="<?= $relativeSupportPath;?>/novidades.php" class="Su-card">
                        <img src="../../app/assets/imagens/icons/Su_novidades.png" alt="" class="Su-cardIcons">
                        <h3>Novidades</h3>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/interface.php" class="Su-card">
                        <img src="../../app/assets/imagens/icons/Su_interface.png" alt="" class="Su-cardIcons">
                        <h3>Interface</h3>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/configuracoes.php" class="Su-card">
                        <img src="../../app/assets/imagens/icons/Su_config.png" alt="" class="Su-cardIcons">
                        <h3>Configurações</h3>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/politicas.php" class="Su-card">
                        <img src="../../app/assets/imagens/icons/Su_politicas.png" alt="" class="Su-cardIcons">
                        <h3>Políticas</h3>
                    </a>    

                    <a href="<?= $relativeSupportPath;?>/faq.php" class="Su-card">
                        <img src="../../app/assets/imagens/icons/Su_faq.png" alt="" class="Su-cardIcons">
                        <h3>FAQ</h3>
                    </a>
                </article>
            </section>
        </main>

        <?php 
            include_once ("../../app/includes/footer.php");
        ?>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>