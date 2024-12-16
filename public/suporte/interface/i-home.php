<?php include_once __DIR__ . "/../../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre Interface da Home</title>
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
            <section class="In-homeNavigation">
                <h2>Como navegar dentro do sistema?</h2>

                <p>A navegação no sistema é projetada para ser intuitiva e eficiente. Na parte superior (header), você encontrará as principais funcionalidades para interagir com o sistema.</p>

                <h3>Timelines</h3>
                <p>A seção de <strong>Timelines</strong> exibe as postagens mais recentes e as atualizações da sua rede de conexões. Ela está localizada na parte superior da tela, oferecendo acesso rápido a novos conteúdos e interações. Ao clicar na área de *Timelines*, você pode ver as atualizações em tempo real, tornando sua experiência mais dinâmica.</p>

                <h3>Notificações</h3>
                <p>As <strong>Notificações</strong> são exibidas também na parte superior da tela. Elas servem para alertá-lo sobre novas atividades no seu perfil, como curtidas, comentários ou mensagens diretas. Ao clicar nas notificações, você pode visualizar um histórico detalhado de todas as interações e atualizações importantes.</p>

                <h3>Perfil do Usuário</h3>
                <p>O seu <strong>Perfil</strong> fica na parte superior, proporcionando fácil acesso a todas as suas informações pessoais. Aqui, você pode editar dados, visualizar postagens anteriores, fotos de perfil e fazer ajustes nas configurações de privacidade e segurança da sua conta.</p>

                <h3>Botão de Postar</h3>
                <p>Na mesma área superior, você encontrará o <strong>Botão de Postar</strong>, que permite compartilhar novos conteúdos com seus seguidores ou amigos. Ao clicar no ícone de postagem, você poderá criar novas publicações, adicionar fotos ou textos, e publicar diretamente na plataforma.</p>

                <h3>Configurações</h3>
                <p>As <strong>Configurações</strong> estão localizadas também na parte superior. Ao clicar no ícone de configurações, você tem acesso a todas as opções para personalizar sua conta, como notificações, privacidade e preferências gerais. Isso permite que você controle a maneira como o sistema funciona para você.</p>

                <h3>Auxílios do Usuário e Sugestões de Quem Seguir</h3>
                <p>À direita da tela, você encontrará os seus <strong>Auxílios</strong> personalizados, que são recursos de apoio com base nas suas necessidades. Além disso, o sistema sugere novos usuários para seguir, com base nas suas interações e interesses, tornando a experiência mais interativa e ajudando você a expandir sua rede de contatos.</p>

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