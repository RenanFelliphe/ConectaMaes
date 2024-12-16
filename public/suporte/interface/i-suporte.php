<?php include_once __DIR__ . "/../../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre Interface de Suporte</title>
</head>
<body class="B-theme">
        <?php include_once ("../../../app/includes/headerLanding.php");?>
        
        <main class="Su-suporte">
            <h2 class="Su-sectionTitle">Interface</h2>

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
            <section class="Su-interfaces">
                <h2>Como navegar pela nossa interface?</h2>
                <p>Explore as funcionalidades da nossa interface e descubra como usar cada recurso disponível para uma experiência mais completa. Abaixo você encontra os principais pontos de navegação:</p>

                <nav class="Su-navIntLinks">
                    <a href="<?= $relativeInterfacesPath; ?>/i-apresentacao.php" class="Su-navIntLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_landing.png" alt="" class="Su-navIcon">
                        <h3>Apresentação</h3>
                    </a>

                    <a href="<?= $relativeInterfacesPath; ?>/i-registro-e-login.php" class="Su-navIntLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_register.png" alt="" class="Su-navIcon">
                        <h3>Registro e Login</h3>
                    </a>

                    <a href="<?= $relativeInterfacesPath; ?>/i-home.php" class="Su-navIntLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_home.png" alt="" class="Su-navIcon">
                        <h3>Home</h3>
                    </a>

                    <a href="<?= $relativeInterfacesPath; ?>/i-perfil.php" class="Su-navIntLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_profile.png" alt="" class="Su-navIcon">
                        <h3>Perfil</h3>
                    </a>

                    <a href="<?= $relativeInterfacesPath; ?>/i-suporte.php" class="Su-navIntLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_suporte.png" alt="" class="Su-navIcon">
                        <h3>Suporte</h3>
                    </a>
                </nav>
            </section>
            <section class="In-supportNavigation">
                <h2>Como Navegar pelo Suporte</h2>
                <p>Explore os principais tópicos de suporte abaixo. Cada área é dividida em tópicos e sub-tópicos, onde você pode aprender mais sobre o funcionamento do sistema. A navegação é simples e você pode clicar em cada título para ser redirecionado diretamente à página correspondente.</p>

                <ul class="Su-navLinks">
                    <li>
                        <a href="<?= $relativePublicPath; ?>/suporte.php" class="In-sNavLink">Suporte</a>
                        <p>Aqui você encontrará informações gerais sobre o suporte, como entrar em contato com a equipe e recursos para solucionar problemas comuns.</p>
                    </li>
                    
                    <li>
                        <a href="<?= $relativeSupportPath; ?>/novidades.php" class="In-sNavLink">Novidades</a>
                        <p>Esta seção contém todas as atualizações importantes sobre o sistema, incluindo novas funcionalidades e melhorias.</p>
                    </li>
                    
                    <li>
                        <a href="<?= $relativeSupportPath; ?>/interface.php" class="In-sNavLink">Interface</a>
                        <p>Aqui você pode aprender sobre a interface do sistema e como navegar pelas diferentes telas. Ela inclui os seguintes tópicos:</p>
                        <ul>
                            <li><a href="<?= $relativeInterfacesPath; ?>/i-apresentacao.php" class="In-sNavLink">Interface de Apresentação</a></li>
                            <li><a href="<?= $relativeInterfacesPath; ?>/i-registro-e-login.php" class="In-sNavLink">Interface de Registro e Login</a></li>
                            <li><a href="<?= $relativeInterfacesPath; ?>/i-home.php" class="In-sNavLink">Interface da Home</a></li>
                            <li><a href="<?= $relativeInterfacesPath; ?>/i-perfil.php" class="In-sNavLink">Interface de Perfil</a></li>
                            <li><a href="<?= $relativeInterfacesPath; ?>/i-suporte.php" class="In-sNavLink">Interface de Suporte</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= $relativeSupportPath; ?>/configuracoes.php" class="In-sNavLink">Configurações</a>
                        <p>Você pode personalizar sua conta nas configurações. As principais áreas incluem:</p>
                        <ul>
                            <li><a href="<?= $relativeSettingsPath; ?>/info-conta.php" class="In-sNavLink">Informações da Conta</a></li>
                            <li><a href="<?= $relativeSettingsPath; ?>/info-filhos.php" class="In-sNavLink">Informações dos Filhos</a></li>
                            <li><a href="<?= $relativeSettingsPath; ?>/seguranca-e-privacidade.php" class="In-sNavLink">Segurança e Privacidade</a></li>
                            <li><a href="<?= $relativeSettingsPath; ?>/notificacoes.php" class="In-sNavLink">Notificações</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?= $relativeSupportPath; ?>/politicas.php" class="In-sNavLink">Políticas</a>
                        <p>Aqui você encontra as políticas do sistema, incluindo termos de uso e políticas de privacidade. É importante que você leia e compreenda esses documentos.</p>
                    </li>

                    <li>
                        <a href="<?= $relativeSupportPath; ?>/faq.php" class="In-sNavLink">FAQ</a>
                        <p>Se você tiver dúvidas, esta seção traz respostas para as perguntas mais comuns sobre o uso do sistema.</p>
                    </li>
                </ul>
            </section>
        </main>

        <?php 
            include_once ("../../../app/includes/footer.php");
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
<script>
document.querySelectorAll('.Su-navIntLink').forEach(link => {
    link.addEventListener('mouseover', () => {
        link.style.filter = 'brightness(0) saturate(100%) invert(85%) sepia(14%) saturate(4477%) hue-rotate(149deg) brightness(82%) contrast(74%)';
    });

    link.addEventListener('mouseout', () => {
        link.style.filter = '';
    });
});
</script>