<?php include_once __DIR__ . "/../../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre Interface de Apresentação</title>
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
                <p>Explore as funcionalidades das nossas interfaces e descubra como usar cada recurso disponível para uma experiência mais completa. Abaixo você encontra os principais pontos de navegação:</p>

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
            <section class="In-landing">
                <div class="In-landing-content">
                    <h2 class="In-sectionTitle">Bem-vindo à ConectaMães!</h2>

                    <p class="In-description">Chegou de paraquedas no sistema? Comece pela interface de Apresentação. Antes de logar na plataforma você pode acessá-la clicando na nossa logo no canto superior esquerdo.</p>

                    <div class="In-feature-section">
                        <h3>Funcionalidades do Sistema</h3>
                        <p>Na página de Apresentação são apresentadas algumas das funcionalidades que o ConectaMães oferece. Desde o registro até suas interações dentro do sistema, pensamos em como otimizar a sua experiência.</p>
                    </div>

                    <div class="In-nav-section">
                        <h3>Como Navegar pelo Sistema?</h3>
                        <p>A navegação é simples e intuitiva. Antes de logar, basta usar o menu superior para acessar as áreas principais do sistema, como o Registro e o Login. Assim que logado, o usuário acessa a interface da Home, podendo acessar seu Perfil e, a partir da interface de Configurações, a página de Suporte.</p>
                    </div>

                    <div class="In-faq-section">
                        <h3>FAQ & Suporte</h3>
                        <p>Em caso de dúvidas, consulte a nossa seção de <a href="<?= $relativeSupportPath; ?>/faq.php">FAQ</a> ou entre em contato com o suporte. Nossa equipe está sempre pronta para ajudar!</p>
                        <a href="<?= $relativeInterfacesPath; ?>/i-suporte.php" class="In-navLink">Acessar Suporte</a>
                    </div>

                    <div class="In-contact-section">
                        <h3>Contato</h3>
                        <p>Se você precisar de ajuda adicional ou tiver algum feedback, envie-nos um e-mail em <a href="mailto:contato@conectamaes.linceonline.com.br">contato@conectamaes.linceonline.com.br</a>.</p>
                    </div>

                    <div class="In-cta-section">
                        <h3>Pronto para Começar?</h3>
                        <p>Não perca tempo! Registre-se agora e comece a explorar todos os recursos incríveis que preparamos para você. Entenda como fazer o registro e o login:</p>
                        <a href="<?= $relativeInterfacesPath; ?>/i-registro-e-login.php" class="In-navLink">Registrar-se</a>
                    </div>

                    <div class="In-team-section">
                        <h3>Conheça a Equipe</h3>
                        <p>Nosso time é composto por profissionais dedicados que estão sempre buscando a melhor experiência para nossos usuários. Conheça mais sobre a nossa equipe e nossos valores!</p>
                    </div>
                </div>
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