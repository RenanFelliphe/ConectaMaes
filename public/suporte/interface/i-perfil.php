<?php include_once __DIR__ . "/../../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre Interface de Perfil</title>
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
            <section class="In-profileNavigation">
                <h2>Como Navegar pelo Seu Perfil?</h2>
                <p>O seu perfil é o lugar onde você pode visualizar suas informações pessoais, interagir com outros usuários e explorar os recursos do sistema. Abaixo, explicamos os principais elementos da navegação e como cada um deles pode ser útil para você:</p>

                <div class="In-profileDescription">
                    <h3>Informações do Perfil</h3>
                    <p>Logo no topo do seu perfil, você verá sua foto de perfil, que pode ser alterada a qualquer momento. Ao lado dela, serão apresentados os ícones referentes a cada filho registrado na sua conta e, abaixo, informações como a quantidade de seguidores que você tem, além da quantidade de pessoas que você segue e a quantidade de publicações que você fez até o momento</p>
                    
                    <h3>Interação com o Perfil</h3>
                    <p>Se você estiver visualizando seu próprio perfil, haverá a opção de editar suas informações. Ao clicar em "Editar Perfil", você poderá atualizar seus dados, como nome, foto e outros detalhes. Essa funcionalidade facilita a personalização e atualização do seu perfil.</p>

                    <p>Caso contrário, você verá opções para interagir com o outro usuário, como os botões "Seguir" ou "Deixar de Seguir". A qualquer momento, se não desejar mais seguir alguém, você pode deixar de seguir.</p>

                    <h3>Explorando Conteúdos no Perfil</h3>
                    <p>Abaixo das informações principais do perfil, você encontrará três opções para explorar o conteúdo do usuário:</p>
                    <ul>
                        <li><strong>Postagens:</strong> Aqui, você verá todas as postagens feitas pelo usuário.</li>
                        <li><strong>Relatos:</strong> Relatos pessoais também são exibidos. Porém, vale ressaltar que relatos anônimos feitos por você não serão visíveis no seu próprio perfil, garantindo sua privacidade.</li>
                        <li><strong>Auxílios:</strong> Se o usuário pediu algum auxílio, essa área vai mostrar todos os pedidos dele.</li>
                    </ul>

                    <h3>Limitações e Privacidade</h3>
                    <p>Vale lembrar que os relatos anônimos feitos por você não poderão ser visualizados por ninguém, nem por você mesmo no seu próprio perfil. Isso garante que suas histórias mais privadas fiquem protegidas.</p>

                    <p>Essas são as principais funcionalidades que você encontrará ao navegar pelo seu perfil. Aproveite a experiência e personalize sua conta para aproveitar ao máximo a plataforma!</p>
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