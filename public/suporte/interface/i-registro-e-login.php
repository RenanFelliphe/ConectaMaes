<?php include_once __DIR__ . "/../../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre Interface de Registro</title>
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
            <section class="In-registerAndLogin">
                <div class="In-registerContent">
                    <h2 class="In-sectionTitle">Registro e Login</h2>

                    <!-- Registro -->
                    <h3>Registro</h3>
                    <p>Para começar a usar a plataforma, você precisa se <a href="<?=$relativePublicPath?>/registrar.php">registrar</a>. O processo de registro é dividido em 4 partes:</p>

                    <!-- Primeira parte: User, Email, Senha -->
                    <div class="In-register-step">
                        <h4>Primeira Parte</h4>
                        <p>Dados básicos para iniciar o registro.</p>
                        <ul>
                            <li><strong>Usuário:</strong> Escolha um nome único para sua conta.</li>
                            <li><strong>E-mail:</strong> Informe um endereço de e-mail válido.</li>
                            <li><strong>Senha:</strong> Crie uma senha segura para sua conta.</li>
                            <li><strong>Confirmar Senha:</strong> Digite novamente a senha para confirmar.</li>
                            <li><strong>Tema:</strong> Escolha o tema da interface, claro ou escuro.</li>
                        </ul>
                    </div>

                    <!-- Segunda parte: Dados pessoais -->
                    <div class="In-register-step">
                        <h4>Segunda Parte</h4>
                        <p>Coletamos, então, informações pessoais para melhorar a experiência.</p>
                        <ul>
                            <li><strong>Nome Completo (obrigatório):</strong> Informe seu nome completo.</li>
                            <li><strong>Telefone (opcional):</strong> Digite seu número de telefone.</li>
                            <li><strong>Data de Nascimento (obrigatória):</strong> Informe sua data de nascimento, você deve ter ao menos 18 anos para utilizar o sistema.</li>
                            <li><strong>CEP (obrigatório):</strong> Insira o Código de Endereçamento Postal (CEP). Para utilizar o sistema você deve morar em uma localização que esteja contemplada por pelo menos um dos nossos clientes.</li>
                            <li><strong>Biografia (opcional):</strong> Escreva uma breve descrição sobre você.</li>
                        </ul>
                    </div>

                    <!-- Terceira parte: Foto e Mostrar Dados -->
                    <div class="In-register-step">
                        <h4>Terceira Parte</h4>
                        <p>Você pode escolher uma foto. Nesta parte você pode revisar os dados que você inserir e voltar para mudá-los caso deseje.</p>
                        <ul>
                            <li><strong>Foto (opcional):</strong> Faça upload de uma foto de perfil.</li>
                        </ul>
                    </div>

                    <!-- Quarta parte: Termos de uso e Políticas de Privacidade -->
                    <div class="In-register-step">
                        <h4>Quarta Parte</h4>
                        <p>Leia e aceite os termos de uso e políticas de privacidade.</p>
                        <ul>
                            <li><strong>Termos de Uso:</strong> Para utilizar o sistema é necessário que aceite os termos de uso.</li>
                            <li><strong>Políticas de Privacidade:</strong> Do mesmo modo, é necessário aceitar as políticas de privacidade.</li>
                        </ul>
                    </div>

                    <hr>

                    <!-- Login -->
                    <h3>Login</h3>
                    <p>Se já possui uma conta, você pode realizar o <a href="<?=$relativePublicPath?>/login.php">login</a> com seu e-mail e senha. Você pode também optar por ter seus dados salvos na plataforma por 7 dias, caso seja conveniente.</p>
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