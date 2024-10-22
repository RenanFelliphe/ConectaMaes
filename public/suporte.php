s<?php include_once __DIR__ . "/../app/services/helpers/paths.php"; ?>
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
            <section class="Su-search">
                <div class="Su-inputsearch">
                    <h1>Suporte</h1>
                    <div class="Su-searchbar">
                        <input type="text" placeholder="Pesquisar">
                    </div>
                    <img src="../app/assets/imagens/figuras/suportBack.png" alt="" class="Su-background">
                </div>
            </section>

            <section class="Su-helpSection">
                <article class="Su-articleCards">
                    <h2>Precisa de ajuda?</h2>
                        <div class="Su-helpCards">
                            <div class="Su-card">
                                <img src="../app/assets/imagens/icons/Su_novidades.png" alt="" class="Su-cardIcons">
                                <h3>Novidades</h3>
                                <p>Fique por dentro das últimas <span class="Su-focusyellow">notícias </span> do ConectaMães</p>
                            </div>

                            <div class="Su-card">
                                <img src="../app/assets/imagens/icons/Su_interface.png" alt="" class="Su-cardIcons">
                                <h3>Interface</h3>
                                <p><span class="Su-focusblue">O que esse botão faz?</span> Entenda tudo sobre a interface do sistema</p>
                            </div>

                            <div class="Su-card">
                                <img src="../app/assets/imagens/icons/Su_config.png" alt="" class="Su-cardIcons">
                                <h3>Configurações</h3>
                                <p><span class="Su-focuspink">Personalize</span> o sistema como for melhor para você</p>
                            </div>

                            <div class="Su-card">
                                <img src="../app/assets/imagens/icons/Su_politicas.png" alt="" class="Su-cardIcons">
                                <h3>Políticas</h3>
                                <p>Mantendo as coisas<span class="Su-focusyellow"> seguras </span>para todos</p>
                            </div>

                            <div class="Su-card">
                                <img src="../app/assets/imagens/icons/Su_faq.png" alt="" class="Su-cardIcons">
                                <h3>FAQ</h3>
                                <p>Veja se já responderam sua <span class="Su-focusblue">dúvida</span></p>
                            </div>
                        </div>
                </article>
            </section>
        </main>


        <?php 
            include_once ("../app/includes/footer.php");
        ?>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </body>
</html>
