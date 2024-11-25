<?php include_once __DIR__ . "/../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Suporte</title>
    </head>

    
    <body class="Y-theme">
        <?php include_once ("../app/includes/headerLanding.php");?>
        
        <main class="Su-suporte">
            <section class="Su-cellsBackground">
                <h1>Suporte</h1>
                <!--<div class="Su-searchbar">
                    <label class="bi bi-search" for="Su-searchBarInput"></label>
                    <input type="search" placeholder="Pesquisar" id="Su-searchBarInput">
                </div>-->
            </section>

            <h2 class="La-sectionTitle">Precisa de ajuda?</h2>

            <section class="Su-helpSection">
                <article class="Su-articleCards">
                    <a href="<?= $relativeSupportPath;?>/novidades.php" class="Su-card">
                        <img src="../app/assets/imagens/icons/Su_novidades.png" alt="" class="Su-cardIcons">
                        <h3>Novidades</h3>
                        <p>Fique por dentro das últimas <span class="Su-focusyellow">notícias </span> do ConectaMães</p>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/interface.php" class="Su-card">
                        <img src="../app/assets/imagens/icons/Su_interface.png" alt="" class="Su-cardIcons">
                        <h3>Interface</h3>
                        <p><span class="Su-focusblue">O que esse botão faz?</span> Entenda tudo sobre a interface do sistema</p>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/configuracoes.php" class="Su-card">
                        <img src="../app/assets/imagens/icons/Su_config.png" alt="" class="Su-cardIcons">
                        <h3>Configurações</h3>
                        <p><span class="Su-focuspink">Personalize</span> o sistema como for melhor para você</p>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/politicas.php" class="Su-card">
                        <img src="../app/assets/imagens/icons/Su_politicas.png" alt="" class="Su-cardIcons">
                        <h3>Políticas</h3>
                        <p>Mantendo as coisas<span class="Su-focusyellow"> seguras </span>para todos</p>
                    </a>    

                    <a href="<?= $relativeSupportPath;?>/faq.php" class="Su-card">
                        <img src="../app/assets/imagens/icons/Su_faq.png" alt="" class="Su-cardIcons">
                        <h3>FAQ</h3>
                        <p>Veja se já responderam sua <span class="Su-focusblue">dúvida</span></p>
                    </a>
                </article>
            </section>
        </main>

        <?php 
            include_once ("../app/includes/footer.php");
        ?>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>
