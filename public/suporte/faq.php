<?php include_once __DIR__ . "/../../app/services/helpers/paths.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - FAQ</title>
    </head>

    <body class="B-theme">
        <?php include_once ("../../app/includes/headerLanding.php");?>
        
        <main class="Su-suporte">
            <h2 class="Su-sectionTitle">Perguntas Frequentes - FAQ</h2>

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

            <section class="Su-faqQuestionsSection">
                <article class="Su-frequentQuestions" id="Su-contactFAQ">
                    <h1 class="Su-articleTitle"> Perguntas Frequentes</h1>
                    <ul class="faqList">
                        <li class="Su-faqQuestions">
                            <p>Posso excluir minha conta do ConectaMães?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="Su-faqAnswers">Você pode excluir sua conta a qualquer momento. Após a exclusão, todos os seus dados serão removidos do sistema. Para excluir sua conta, acesse as configurações de Segurança e Privacidade e siga as instruções fornecidas.</div>
                        </li>
                        <li class="Su-faqQuestions">
                            <p>O ConectaMães oferece suporte em caso de problemas técnicos?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="Su-faqAnswers">Sim, o ConectaMães oferece suporte técnico para resolver quaisquer problemas relacionados ao sistema. Caso enfrente algum problema, entre em contato com a nossa equipe de suporte através da seção de Contato na interface de Apresentação.</div>
                        </li>
                        <li class="Su-faqQuestions">
                            <p>O que devo fazer se encontrar um comportamento inadequado na plataforma?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="Su-faqAnswers">Caso você se depare com comportamento inadequado ou violação das regras, pedimos que reporte imediatamente através da seção de Contato na interface de Apresentação. Nossa equipe investigará a situação e tomará as providências necessárias para garantir a segurança e respeito no sistema.</div>
                        </li>
                        <li class="Su-faqQuestions">
                            <p>Como posso controlar as notificações que recebo no ConectaMães?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="Su-faqAnswers">Você pode personalizar suas preferências de notificação diretamente nas configurações da sua conta. Lá, é possível ativar ou desativar notificações, além de escolher quais tipos de notificações deseja receber.</div>
                        </li>
                        <li class="Su-faqQuestions">
                            <p>O que fazer se eu encontrar um erro ou bug na plataforma?</p>
                            <i class="bi bi-chevron-right"></i>
                            <div class="Su-faqAnswers">Se você encontrar um erro ou bug enquanto usa o ConectaMães, pedimos que nos avise imediatamente para que possamos corrigir o problema. Você pode reportar o erro pelo e-mail de contato, descrevendo o problema e, se possível, incluindo capturas de tela para nos ajudar a entender melhor a situação. Nossa equipe de suporte técnico fará o possível para resolver rapidamente.</div>
                        </li>
                    </ul>
                    <p class="Su-observation">Suas dúvidas ainda não foram respondidas? Contate-nos através do nosso <a href="<?=$relativeRootPath;?>/index.php#La-contactSection" class="Su-focus">Email! <i class="bi bi-arrow-up-right"></i> </a></p>
                </article>  
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
    document.querySelectorAll('.Su-faqQuestions').forEach((question) => {
        const answer = question.querySelector('.Su-faqAnswers');
        
        question.addEventListener('click', () => {
            const isActive = question.classList.contains('active');
            
            // Remove a classe 'active' de todas as perguntas e reseta a altura
            document.querySelectorAll('.Su-faqQuestions').forEach(q => {
                q.classList.remove('active');
                q.querySelector('.Su-faqAnswers').style.maxHeight = null;
            });
            
            // Se a pergunta não estiver ativa, adicionar a classe 'active' e ajustar a altura do conteúdo
            if (!isActive) {
                question.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px'; // Define a altura do conteúdo
            }
        });
    });
</script>

