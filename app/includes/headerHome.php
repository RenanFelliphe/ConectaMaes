<?php
    include_once __DIR__ . "/../services/helpers/paths.php";
?>

<i class="bi bi-list Ho-toggleHeader"></i>

<header class="headerHome">
    <img src="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães">
    <input type="hidden" id="postTypeInput" name="postType" value="">

    <div class="headerPageLinks">
        <a class="homePageLink pageLink" id="homePageLink" href="<?php echo $relativePublicPath; ?>/home.php">
            <img class="homePageIcon headerIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/home_off.png" alt="Ícone da página inicial">
            <p>Home</p>
            <span class="pageSelector"></span>
        </a>

        <a class="reportPageLink pageLink" id="reportPageLink" href="<?php echo $relativePublicPath; ?>/home/relatos.php">
            <img class="reportPageIcon headerIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
            <p>Relatos</p>
            <span class="pageSelector"></span>
        </a>

        <a class="helpPageLink pageLink" id="helpPageLink" href="<?php echo $relativePublicPath; ?>/home/auxilios.php">
            <img class="helpPageIcon headerIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
            <p>Auxilios</p>
            <span class="pageSelector"></span>
        </a>
    </div>

    <div class="userContainer">
        <!-- 
        <img class="notificationsModalIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/notifications_off.png" alt="Ícone do modal de notificações">
        -->

        <div class="makeAPost">
            <button name ="postPostagem" class="makeAPostBtn">Postar</button>

            <div class="postStyle">
                <i class="bi bi-caret-down-fill pageIcon"></i>
            </div>
        </div>

        <div class="makeAPostModal headerModal close">
            <div class="modalHeader">
                <h1>Publicação</h1>
                <!--
                <i class="bi bi-three-dots pageIcon"></i>
                -->
            </div>

            <div class="postStyleSummary" data-post-type=" " onclick="openModal(this);">
                <?php $postType = " " ?>
                <div class="postStyleTitle">
                    <span></span>
                    <img class="homePageIcon headerIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/home_off.png" alt="Ícone da página inicial">
                    <h4>Post</h4>
                    <span></span>
                </div>
                <p>Faça uma publicação para compartilhar momentos
                    do seu dia a dia, novidades, fotos ou qualquer outra coisa
                    que queira dividir com a comunidade. <span>É a forma padrão
                    de se conectar e interagir com outras mães<span>.</p>
                <button name ="postPostagem" class="postBtn postagemBtn">Postar</button>
            </div>

            <div class="postStyleSummary" data-post-type="Relato" onclick="openModal(this);">
                <?php $postType = "Relato" ?>
                <div class="postStyleTitle">
                    <span></span>
                    <img class="reportPageIcon headerIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
                    <h4>Relato</h4>
                    <span></span>
                </div>
                <p>Compartilhe suas experiências pessoais. <span>Conte sobre
                    momentos importantes, dificuldades superadas,
                    alegrias ou tristezas da sua vida</span>. Seus relatos podem
                    inspirar e confortar outras mães na comunidade.</p>
                <button name ="postPostagem" class="postBtn relatoBtn">Postar</button>
            </div>

            <div class="postStyleSummary" data-post-type="Auxilio" onclick="openModal(this);">
                <?php $postType = "Auxilio" ?>
                <div class="postStyleTitle">
                    <span></span>
                    <img class="helpPageIcon headerIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
                    <h4>Auxílio</h4>
                    <span></span>
                </div>
                <p>Precisa de ajuda? <span>Descreva uma dificuldade que está
                    enfrentando no momento e consiga apoio da
                    comunidade</span>. Outras mães estão aqui para oferecer
                    suporte baseado em suas próprias experiências.</p>
                <button name="postPostagem" class="postBtn pedidosBtn">Pedir</button>
            </div>
        </div>

        <div class="userInformations">
            <span class="userRealName">
                <?php 
                    $partesDoNomeCompleto = explode(" ", $currentUserData['nomeCompleto']);
                    $firstName = $partesDoNomeCompleto[0];
                    $lastName = $partesDoNomeCompleto[count($partesDoNomeCompleto) - 1];
                    $firstAndLastName = $firstName . " " . $lastName;// Concatena a primeira e a última palavra separadas por um espaço
                    
                    echo $firstAndLastName;
                ?>
            </span>
            <span class="userNickname">
                <?php 
                    echo "@" . $currentUserData['nomeDeUsuario']; 
                ?>
            </span>
        </div>

        <div class="userAccount">
            <div class="userProfileImage">
                <img src="<?php echo $relativeAssetsPath . "/imagens/fotos/perfil/". $currentUserData['linkFotoPerfil'];?>">
            </div>
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>

    <div class="userFunctionsModal headerModal close">
        <a href="<?= $relativePublicPath . "/home/perfil.php?user=" . $currentUserData['nomeDeUsuario'];?>" class="userFunctions">
            <i class="bi bi-person-fill pageIcon"></i>
            <p>Perfil</p>
        </a>
        <?php if($currentUserData['isAdmin']){?>
            <!--<a href="<?php echo $relativePublicPath; ?>/admin.php" class="userFunctions">
                <i class="bi bi-key-fill pageIcon"></i>
                <p>Administração</p>-->
            </a>
        <?php }?>
        
        <a href="<?php echo $relativePublicPath; ?>/home/config.php" class="userFunctions">
            <i class="bi bi-gear-fill pageIcon"></i>
            <p>Configurações</p>
        </a>
        <span></span>
        <a href="<?php echo $relativeServicesPath; ?>/helpers/logOut.php" class="userFunctions">
            <i class="bi bi-arrow-left-circle pageIcon"></i>
            <p>Sair</p>
        </a>
        <span></span>
    </div>

    <div class="notificationsModal headerModal close">
        <div class="modalHeader">
            <h1>Notificações</h1>
            <i class="bi bi-three-dots pageIcon"></i>
        </div>    
        <div class="notificationsCenter">
            <div class="notificationsRelativeDate">
                <span></span>    
                <p> Hoje </p>
                <span></span>
            </div>
        </div>
    </div>


</header>

<script>
    const headerHome = document.querySelector('.headerHome');
    const toggleHeader = document.querySelector('.Ho-toggleHeader');
    const body = document.querySelector('body');

    toggleHeader.addEventListener('click', () => {
        headerHome.classList.toggle('active');
        toggleHeader.style.backgroundColor = headerHome.classList.contains('active') ? "#80808030" : "";
    });

    const notificationsModalIcon = document.querySelector(".notificationsModalIcon");
    const notificationsModal = document.querySelector(".notificationsModal");

    function headerFunctions() {
        function toggleModals() {
            const modals = document.querySelectorAll('.headerModal');
            const makeAPostButton = document.querySelector('.makeAPost');
            let closeTimeout;

            function closeAllModals() {
                modals.forEach(modal => modal.classList.add('close'));
                makeAPostButton.classList.remove('active');
            }

            function toggleModal(modal, button = null) {
                const isClosed = modal.classList.contains('close');
                closeAllModals();
                if (isClosed) {
                    modal.classList.remove('close');
                    if (button) {
                        button.classList.add('active');
                    }
                }
            }

            document.querySelector('.userAccount').addEventListener('click', () => {
                toggleModal(document.querySelector('.userFunctionsModal'));
            });

            makeAPostButton.addEventListener('click', () => {
                toggleModal(document.querySelector('.makeAPostModal'), makeAPostButton);
            });

            modals.forEach(modal => {
                modal.addEventListener('mouseleave', () => {
                    closeTimeout = setTimeout(closeAllModals, 400);
                });
                modal.addEventListener('mouseenter', () => {
                    clearTimeout(closeTimeout);
                });
            });
        }

        function togglePages() {
            const homePageLink = document.getElementById('homePageLink');
            const reportPageLink = document.getElementById('reportPageLink');
            const helpPageLink = document.getElementById('helpPageLink');
            const currentUrl = window.location.href;

            if (currentUrl.includes('home.php')) {
                homePageLink.classList.add('active');
            } else if (currentUrl.includes('/home/relatos.php')) {
                reportPageLink.classList.add('active');
            } else if (currentUrl.includes('/home/auxilios.php')) {
                helpPageLink.classList.add('active');
            }
        }

        toggleModals();
        togglePages();
    }

    /*notificationsModalIcon.addEventListener('click', () => {
        notificationsModal.classList.toggle("close");
    });*/

    headerFunctions();
</script>

