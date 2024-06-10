<header class="headerHome">
    <a href="/ConectaMaesProject/public/index.php">
        <img src="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães">
    </a>

    <div class="headerPageLinks">
        <a class="homePageLink pageLink" id="homePageLink" href="/ConectaMaesProject/public/home.php">
            <img class="homePageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/home_off.png" alt="Ícone da página inicial">
            <p>Home</p>
            <span class="pageSelector"></span>
        </a>

        <a class="reportPageLink pageLink" id="reportPageLink" href="/ConectaMaesProject/public/home/relatos.php">
            <img class="reportPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
            <p>Relatos</p>
            <span class="pageSelector"></span>
        </a>

        <a class="helpPageLink pageLink" id="helpPageLink" href="/ConectaMaesProject/public/home/pedidos.php">
            <img class="helpPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
            <p>Pedidos</p>
            <span class="pageSelector"></span>
        </a>
    </div>

    <div class="userContainer">
        <img class="notificationsModalIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/notifications_off.png" alt="Ícone do modal de notificações">
        
        <div class="makeAPost">
            <button name ="postPostagem" class="makeAPostBtn">Postar</button>

            <div class="postStyle">
                <i class="bi bi-caret-down-fill"></i>
            </div>

            <div class="makeAPostModal">
                <div class="modalHeader">
                    <h1>Publicação</h1>
                    <i class="bi bi-three-dots-vertical"></i>
                </div>

                <div class="postStyleSummary">
                    <div class="postStyleTitle">
                        <img class="homePageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/home_off.png" alt="Ícone da página inicial">
                        <p>Post</p>
                    </div>
                    <p>Faça uma publicação para compartilhar momentos 
                        do seu dia a dia, novidades, fotos ou qualquer outra coisa 
                        que queira dividir com a comunidade. É a forma padrão 
                        de se conectar e interagir com outras mães.</p>
                    <button name ="postPostagem" class="postBtn postagemBtn">Postar</button>
                </div>

                <div class="postStyleSummary">
                    <div class="postStyleTitle">
                        <img class="reportPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
                        <p>Relato</p>
                    </div>
                    <p>Compartilhe suas experiências pessoais. Conte sobre 
                        momentos importantes, dificuldades superadas, 
                        alegrias ou tristezas da sua vida. Seus relatos podem 
                        inspirar e confortar outras mães na comunidade.</p>
                    <button name ="postPostagem" class="postBtn relatoBtn">Postar</button>
                </div>

                <div class="postStyleSummary">
                    <div class="postStyleTitle">
                        <img class="helpPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
                        <p>Auxílio</p>
                    </div>
                    <p>Precisa de ajuda? Descreva uma dificuldade que está 
                        enfrentando no momento e consiga apoio da 
                        comunidade. Outras mães estão aqui para oferecer 
                        suporte baseado em suas próprias experiências.</p>
                    <button name ="postPostagem" class="postBtn pedidosBtn">Postar</button>
                </div>
            </div>
        </div>

        <div class="userInformations">
            <span class="userRealName">
                <?php 
                    $partesDoNomeCompleto = explode(" ", $currentUserData['nomeCompleto']);
                    $firstName = $partesDoNomeCompleto[0];
                    $lastName = $partesDoNomeCompleto[count($partesDoNomeCompleto) - 1];
                    
                    // Concatena a primeira e a última palavra separadas por um espaço
                    $firstAndLastName = $firstName . " " . $lastName;
                    
                    echo $firstAndLastName;
                ?>
            </span>
            <span class="userNickname">
                <?php 
                    echo "@" . $currentUserData['nomeDeUsuario']; 
                ?>
            </span>
        </div>
        <div class="userAccount" onclick="openHeaderUserFunctions();">
            <div class="userProfileImage">
                <?php
                    $profileImagePath = "/ConectaMaesProject/app/assets/imagens/fotos/perfil/" . htmlspecialchars($currentUserData['nomeDeUsuario']) . '-' . htmlspecialchars($currentUserData['dataNascimentoUsuario']) . '-perfil.png';
                    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $profileImagePath)) {
                        $profileImagePath = "/ConectaMaesProject/app/assets/imagens/fotos/perfil/default.png";
                    }
                ?>
                <img src="<?php echo $profileImagePath; ?>">
            </div>
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>

    <div class="userFunctionsModal close">
        <a href="/ConectaMaesProject/public/home/perfil.php" class="userFunctions">
            <i class="bi bi-person-fill pageIcon"></i>
            <p>Perfil</p>
        </a>
        <a href="/ConectaMaesProject/public/admin.php" class="userFunctions">
            <i class="bi bi-key-fill pageIcon"></i>
            <p>Administração</p>
        </a>
        <a href="/ConectaMaesProject/public/home/config.php" class="userFunctions">
            <i class="bi bi-gear-fill pageIcon"></i>
            <p>Configurações</p>
        </a>
        <span></span>
        <a href="/ConectaMaesProject/app/services/helpers/logOut.php" class="userFunctions">
            <i class="bi bi-arrow-left-circle pageIcon"></i>
            <p>Sair</p>
        </a>
        <span></span>
    </div>
</header>



<script>
    function openHeaderUserFunctions() {
        const userFunctionsModal = document.querySelector('.userFunctionsModal');
        userFunctionsModal.classList.toggle('close');
    }

    function toggleHeaderActivePage() {
        const homePageLink = document.getElementById('homePageLink');
        const reportPageLink = document.getElementById('reportPageLink');
        const helpPageLink = document.getElementById('helpPageLink');
        const currentUrl = window.location.href;

        if (currentUrl.includes('/ConectaMaesProject/public/home.php')) {
            homePageLink.classList.add('active');
            reportPageLink.classList.remove('active');
            helpPageLink.classList.remove('active');
        } else if (currentUrl.includes('/ConectaMaesProject/public/home/relatos.php')) {
            homePageLink.classList.remove('active');
            reportPageLink.classList.add('active');
            helpPageLink.classList.remove('active');
        } else if (currentUrl.includes('/ConectaMaesProject/public/home/pedidos.php')) {
            homePageLink.classList.remove('active');
            reportPageLink.classList.remove('active');
            helpPageLink.classList.add('active');
        } else {
            homePageLink.classList.remove('active');
            reportPageLink.classList.remove('active');
            helpPageLink.classList.remove('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleHeaderActivePage();
    });
</script>

