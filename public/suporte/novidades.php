<?php include_once __DIR__ . "/../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Novidades</title>
    </head>
    <body class="Y-theme">
        <?php include_once ("../../app/includes/headerLanding.php");?>
        
        <main class="Su-suporte">
            <h2 class="Su-sectionTitle">Novidades</h2>

            <section class="Su-helpSection">
                <nav class="Su-navigator">
                    <a href="<?= $relativePublicPath;?>/suporte.php" class="Su-navLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_suporte.png" alt="" class="Su-navIcon">
                        <h3>Voltar ao Suporte</h3>
                    </a>
                    <a href="<?= $relativeSupportPath;?>/novidades.php" class="Su-navLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_news.png" alt="" class="Su-navIcon">
                        <h3>Novidades</h3>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/interface.php" class="Su-navLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_interface.png" alt="" class="Su-navIcon">
                        <h3>Interface</h3>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/configuracoes.php" class="Su-navLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_config.png" alt="" class="Su-navIcon">
                        <h3>Configurações</h3>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/politicas.php" class="Su-navLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_policy.png" alt="" class="Su-navIcon">
                        <h3>Políticas</h3>
                    </a>

                    <a href="<?= $relativeSupportPath;?>/faq.php" class="Su-navLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_faq.png" alt="" class="Su-navIcon">
                        <h3>FAQ</h3>
                    </a>
                </nav>
            </section>

            <!-- Nova seção para o Patch Note -->
            <section class="Su-patchNotes">
                <h2>ConectaMães - Primeira Versão (1.0)</h2>
                <p><strong>🚀 Lançamento inicial</strong></p>
                <p>A primeira versão do ConectaMães chega com funcionalidades essenciais para facilitar o dia a dia dos responsáveis pelo trabalho de cuidado! Este é apenas o começo, e estamos muito animados com a jornada que estamos iniciando.</p>
                
                <h3>O que está incluído nesta versão:</h3>
                <ul>
                    <li><strong>Postagens: </strong>Os publicar uma postagem, você pode interagir de forma facilitada com outros usuários!</li>
                    <li><strong>Relatos: </strong>Relate suas experiências através dessas publicações que te permitem se identificar ou não.</li>
                    <li><strong>Auxílios: </strong>Peça e receba auxílio de outros usuários do sistema ConectaMães!</li>
                    <li><strong>Notificações: </strong>Fique por dentro das interações dos outros usuários com seus conteúdos!</li>
                    <li><strong>Configurações: </strong> Personalize sua experiência no sistema!</li>
                </ul>

                <h3>Próximos passos:</h3>
                <p>Esta versão é apenas a base para o que está por vir. Estamos trabalhando ativamente para implementar novas funcionalidades e melhorar a experiência geral da plataforma.</p>

                <h3>O que esperar nas próximas atualizações:</h3>
                <ul>
                    <li>Melhoria da interface com base no feedback dos usuários.</li>
                    <li>Correções e ajustes de bugs conforme identificados.</li>
                    <li>Melhoria do carregamento das interfaces.</li>
                    <li>Melhoria da navegação entre interfaces.</li>
                </ul>

                <h3>Estamos apenas começando!</h3>
                <p>Sua participação é fundamental para que possamos melhorar o ConectaMães. Fique de olho nas próximas atualizações e continue nos enviando sugestões e feedbacks!</p>
            </section>
        </main>

        <?php 
            include_once "../../app/includes/footer.php";
        ?>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>

<script>
    const currentPath = window.location.pathname.toLowerCase();
    const filters = {
        faq: 'brightness(0) saturate(100%) invert(85%) sepia(14%) saturate(4477%) hue-rotate(149deg) brightness(82%) contrast(74%)',
        interface: 'brightness(0) saturate(100%) invert(85%) sepia(14%) saturate(4477%) hue-rotate(149deg) brightness(82%) contrast(74%)',
        configuracoes: 'brightness(0) saturate(100%) invert(44%) sepia(38%) saturate(1315%) hue-rotate(283deg) brightness(85%) contrast(89%)',
        novidades: 'brightness(0) saturate(100%) invert(74%) sepia(85%) saturate(284%) hue-rotate(7deg) brightness(82%) contrast(90%)',
        politicas: 'brightness(0) saturate(100%) invert(74%) sepia(85%) saturate(284%) hue-rotate(7deg) brightness(82%) contrast(90%)'
    };
    const navLinks = document.querySelectorAll('.Su-navLink');
    function applyFilter(link, filter) {
        link.style.filter = filter;
    }
    Object.keys(filters).forEach(keyword => {
        if (currentPath.includes(keyword)) {
            navLinks.forEach(link => {
                link.addEventListener('mouseover', () => {
                    applyFilter(link, filters[keyword]);
                });
                link.addEventListener('mouseout', () => {
                    link.style.filter = '';
                });
            });
        }
    });
</script>
