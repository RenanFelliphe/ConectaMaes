<?php include_once __DIR__ . "/../../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre as Informações da Conta</title>
</head>
<body class="P-theme">
        <?php include_once ("../../../app/includes/headerLanding.php");?>
        
        <main class="Su-suporte">
            <h2 class="Su-sectionTitle">Configurações</h2>

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
            <section class="Su-settings mainSettings">
                <h1>Não se perca na personalização!</h1>
                <h3>Acesse os guias abaixo para entender como encontrar e personalizar corretamente os dados da sua conta:</h3>
                <nav class="Su-navSetLinks mainInterfaces">
                    <a href="<?= $relativeSettingsPath; ?>/info-conta.php" class="Su-navSetLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_profile.png" alt="" class="Su-navIcon">
                        <h3>Informações da Conta</h3>
                    </a>

                    <a href="<?= $relativeSettingsPath; ?>/info-filhos.php" class="Su-navSetLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_register.png" alt="" class="Su-navIcon">
                        <h3>Informações dos Filhos</h3>
                    </a>

                    <a href="<?= $relativeSettingsPath; ?>/seguranca-e-privacidade.php" class="Su-navSetLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_home.png" alt="" class="Su-navIcon">
                        <h3>Segurança e Privacidade</h3>
                    </a>

                    <a href="<?= $relativeSettingsPath; ?>/notificacoes.php" class="Su-navSetLink">
                        <img src="<?= $relativeAssetsPath;?>/imagens/icons/nav_profile.png" alt="" class="Su-navIcon">
                        <h3>Notificações</h3>
                    </a>
                </nav>
            </section>
            <section class="sSe-accountInfo">
                <h2>Informações da Sua Conta</h2>
                <p>Esta seção contém as informações relacionadas à sua conta no sistema. Você pode visualizar e alterar alguns dados pessoais, enquanto outros são apenas para visualização. Abaixo está um detalhamento das informações da sua conta e o que você pode modificar.</p>

                <h3>Informações Editáveis:</h3>
                <ul>
                    <li><strong>Foto de Perfil:</strong> Você pode atualizar sua foto de perfil a qualquer momento. Ela será exibida em seu perfil e nas interações dentro do sistema.</li>
                    <li><strong>Nome Completo:</strong> O nome completo que aparece no seu perfil pode ser alterado para refletir atualizações no seu nome.</li>
                    <li><strong>Biografia:</strong> Escreva ou edite uma breve biografia que será visível em seu perfil. Essa descrição é uma maneira de compartilhar mais sobre você com outros usuários.</li>
                    <li><strong>CEP:</strong> Você pode atualizar seu CEP sempre que mudar de endereço. Lembre-se que o CEP será validado para garantir que seja válido conforme as diretrizes do sistema.</li>
                    <li><strong>Tema:</strong> Escolha entre o tema claro ou escuro para personalizar a aparência do sistema conforme sua preferência.</li>
                </ul>

                <h3>Informações Não Editáveis:</h3>
                <ul>
                    <li><strong>Nome de Usuário:</strong> O nome de usuário é único e associado permanentemente à sua conta. Ele não pode ser alterado.</li>
                    <li><strong>Email:</strong> Seu email de registro também não pode ser modificado diretamente. Caso precise alterar, entre em contato com o suporte.</li>
                    <li><strong>Data de Nascimento:</strong> A data de nascimento registrada em sua conta também não pode ser alterada. Se houver algum erro, contate o suporte para que eles possam ajudá-lo.</li>
                </ul>

                <p>Se precisar de ajuda com qualquer uma dessas informações ou se desejar atualizar algo, consulte as opções de suporte disponíveis no sistema.</p>
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
    document.querySelectorAll('.Su-navSetLink').forEach(link => {
        link.addEventListener('mouseover', () => {
            link.style.filter = 'brightness(0) saturate(100%) invert(42%) sepia(44%) saturate(873%) hue-rotate(277deg) brightness(91%) contrast(92%)';
        });

        link.addEventListener('mouseout', () => {
            link.style.filter = '';
        });
    });

</script>