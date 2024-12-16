<?php include_once __DIR__ . "/../../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Sobre as Informações dos Filhos</title>
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
            <section class="sSe-childInfo">
                <h2>Informações dos Filhos</h2>
                <p>Na seção de informações dos filhos, você pode gerenciar os dados de seus filhos no sistema. Veja como é fácil adicionar, editar ou excluir registros:</p>

                <h3>Adicionando um Filho</h3>
                <p>Para adicionar um filho, basta clicar no botão <strong>"Adicionar Filho(a)"</strong>. Em seguida, você precisará preencher algumas informações, como o sexo, o nome completo, a data de nascimento e, caso deseje, também pode inserir a deficiência do seu filho, se houver. A deficiência deve ser relacionada à Classificação Internacional de Doenças (CID). Após preencher os campos, o registro do seu filho será adicionado ao sistema.</p>

                <h3>Editando as Informações de um Filho</h3>
                <p>Se você precisar editar as informações de um filho, clique no nome do filho que você deseja alterar. Ao clicar, um botão com a opção <strong>"Editar Filho(a)"</strong> aparecerá. Ao pressionar esse botão, um formulário de edição será aberto, permitindo que você modifique os dados do filho, como nome, data de nascimento, sexo ou deficiência.</p>

                <h3>Excluindo um Filho</h3>
                <p>Se em algum momento você precisar excluir um registro de filho, basta clicar no ícone de <strong>"X"</strong> que aparece no cabeçalho do registro de cada filho. Após clicar no "X", o registro será removido do sistema. Lembre-se de que essa ação é permanente e não poderá ser desfeita.</p>

                <h3>Adicionando Vários Registros de Filhos</h3>
                <p>Você pode adicionar quantos registros de filhos desejar. Não há limite para o número de filhos que você pode cadastrar no sistema. Basta repetir o processo de adição de filhos conforme necessário.</p>
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