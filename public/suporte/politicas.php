<?php include_once __DIR__ . "/../../app/services/helpers/paths.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Políticas</title>
</head>
<body class="Y-theme">
        <?php include_once ("../../app/includes/headerLanding.php");?>
        
        <main class="Su-suporte policy">
            <h2 class="Su-sectionTitle">Políticas do ConectaMães</h2>

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
            
            <section class="Su-policyDocs">
                <h2>Aqui você pode acessar nossas políticas!</h2>
                <p>O ConectaMães se compromete a garantir a transparência e segurança das informações dos usuários, com políticas sobre privacidade, termos de uso e mais, disponíveis nos documentos abaixo.</p>

                <div class="Su-documents">
                    <div class="Su-docLink">
                    <a href="<?=$relativeRootPath;?>/documents/politicas_de_privacidade_ConectaMaes.pdf" download="politicas_de_privacidade_ConectaMaes.pdf" class="Su-docItem">
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/nav_policy.png" alt="Política de Privacidade" class="Su-docIcon">
                            <h4>Política de Privacidade</h4>
                        </a>
                    </div>

                    <div class="Su-docLink">
                        <a href="<?=$relativeRootPath;?>/documents/termos_de_uso_ConectaMaes.pdf" download="termos_de_uso_ConectaMaes.pdf" class="Su-docItem">
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/nav_policy.png" alt="Termos de Uso" class="Su-docIcon">
                            <h4>Termos de Uso</h4>
                        </a>
                    </div>
                </div>
            </section>


        </main>

        <?php 
            include_once ("../../app/includes/footer.php");
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
    document.addEventListener('DOMContentLoaded', () => {
        const docLinks = document.querySelectorAll('.Su-docLink');
        const hoverFilter = 'brightness(0) saturate(100%) invert(98%) sepia(5%) saturate(5439%) hue-rotate(352deg) brightness(81%) contrast(77%)';
        docLinks.forEach(link => {
            link.addEventListener('mouseover', () => {
                link.style.filter = hoverFilter;
            });

            link.addEventListener('mouseout', () => {
                link.style.filter = '';
            });
        });
    });
</script>