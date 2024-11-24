<?php
    include_once __DIR__ . "/../services/helpers/paths.php";
    include_once __DIR__ . "/../services/crud/postFunctions.php";
?>

<header class="headerHome">
    <img src="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães">
    <input type="hidden" id="postTypeInput" name="postType" value="">

    <div class="headerPageLinks">
        <a class="homePageLink pageLink" id="homePageLink" href="<?= $relativePublicPath; ?>/home.php">
            <img class="homePageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/home_off.png" alt="Ícone da página inicial">
            <p>Home</p>
            <?php $postType = "Postagem";?>
            <span class="pageSelector"></span>
        </a>

        <a class="reportPageLink pageLink" id="reportPageLink" href="<?= $relativePublicPath; ?>/home/relatos.php">
            <img class="reportPageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
            <p>Relatos</p>
            <?php $postType = "Relato";?>
            <span class="pageSelector"></span>
        </a>

        <a class="helpPageLink pageLink" id="helpPageLink" href="<?= $relativePublicPath; ?>/home/auxilios.php">
            <img class="helpPageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
            <p>Auxilios</p>
            <span class="pageSelector"></span>
        </a>
    </div>

    <div class="userContainer">
        <img class="notificationsModalIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/notifications_off.png" alt="Ícone do modal de notificações">

        <div class="makeAPost" onclick="openModalHeader(this);">
            <button name ="postPostagem" class="makeAPostBtn">Postar</button>

            <div class="postStyle">
                <i class="bi bi-caret-down-fill pageIcon"></i>
            </div>
        </div>

        <div class="userInformations">
            <span class="userRealName">
                <?= getFirstAndLastName($currentUserData['nomeCompleto']);?>
            </span>
            <span class="userNickname">
                <?php 
                    echo "@" . $currentUserData['nomeDeUsuario']; 
                ?>
            </span>
        </div>

        <div class="userAccount">
            <div class="userProfileImage">
                <img src="<?= $relativeAssetsPath . "/imagens/fotos/perfil/". $currentUserData['linkFotoPerfil'];?>">
            </div>
            <i class="bi bi-chevron-down"></i>
        </div>
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

    <div class="makeAPostModal headerModal close">
        <div class="modalHeader">
            <h1>Publicação</h1>
        </div>

        <div class="postStyleSummary" post-link="postPostModal" id='' data-type="postSomething" onclick="openModalHeader(this);">
            <div class="postStyleTitle">
                <span></span>
                <img class="homePageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/home_off.png" alt="Ícone da página inicial">
                <h4>Post</h4>
                <span></span>
            </div>
            <p>Faça uma publicação para compartilhar momentos
                do seu dia a dia, novidades, fotos ou qualquer outra coisa
                que queira dividir com a comunidade. <span>É a forma padrão
                de se conectar e interagir com outras mães<span>.</p>
            <button name="postPostagem" class="postBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Postar</button>
        </div>

        <div class="postStyleSummary" post-link="postRelatoModal" id="Relato" data-type="postSomething" onclick="openModalHeader(this);">
            <div class="postStyleTitle">
                <span></span>
                <img class="reportPageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
                <h4>Relato</h4>
                <span></span>
            </div>
            <p>Compartilhe suas experiências pessoais. <span>Conte sobre
                momentos importantes, dificuldades superadas,
                alegrias ou tristezas da sua vida</span>. Seus relatos podem
                inspirar e confortar outras mães na comunidade.</p>
            <button name="postPostagem" class="postBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Relatar</button>
        </div>

        <div class="postStyleSummary" post-link="postAuxilioModal" id="Auxilio" data-type="postSomething" onclick="openModalHeader(this);">
            <div class="postStyleTitle">
                <span></span>
                <img class="helpPageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
                <h4>Auxílio</h4>
                <span></span>
            </div>
            <p>Precisa de ajuda? <span>Descreva uma dificuldade que está
                passando, e receba apoio e conselhos da comunidade</span>.</p>
            <button name="postPostagem" class="postBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Pedir</button>
        </div>
    </div>

    <div class="userFunctionsModal headerModal close">
        <a href="<?= $relativePublicPath . "/home/perfil.php?user=" . $currentUserData['nomeDeUsuario'];?>" class="userFunctions">
            <i class="bi bi-person-fill pageIcon"></i>
            <p>Perfil</p>
        </a>
        <?php if($currentUserData['isAdmin']){?>
            <!--<a href="<?//= $relativePublicPath; ?>/admin.php" class="userFunctions">
                <i class="bi bi-key-fill pageIcon"></i>
                <p>Administração</p>
            </a>-->
        <?php }?>
        
        <a href="<?= $relativePublicPath; ?>/home/config.php" class="userFunctions">
            <i class="bi bi-gear-fill pageIcon"></i>
            <p>Configurações</p>
        </a>
        <span></span>
        <a href="<?= $relativeServicesPath; ?>/helpers/logOut.php" class="userFunctions">
            <i class="bi bi-arrow-left-circle pageIcon"></i>
            <p>Sair</p>
        </a>
        <span></span>
    </div>
</header>

<modal class="modalSection close" data-type="postSomething">
    <form class="Ho-postSomething pageModal" method="post" enctype="multipart/form-data">
        <i class="bi bi-x closeModal" onclick="openModalHeader(this);"></i>
        <input type="hidden" name="idPublicacao" id="postIdField" value="">

        <div class="Ho-postTop">
            <a class="Ho-userProfileImage" href="<?= $relativePublicPath; ?>/home/perfil.php">
                <img src="<?= $relativeAssetsPath . "/imagens/fotos/perfil/" . $currentUserData['linkFotoPerfil'];?>">
            </a>

            <div class="Ho-postText">
                <div class="Ho-postTitle" id="postTitleContainer" style="display: none;">
                    <label for="Ho-postTitleInput">Título:</label>
                    <input type="text" id="Ho-postTitleInput" name="tituloEnvio" class="Ho-postTitleInput" oninput="postTitleCharLimiter()">
                    <div class="Ho-titleCharacters">
                        <span class="Ho-titleCharactersNumber">0</span>/<span class="Ho-maxTitleCharacters">50</span>
                    </div>
                </div>
                
                <div class="Ho-postMainContent">
                    <textarea name="conteudoEnvio" id="postText" cols="62" rows="3" class="Ho-postTextContent" placeholder="Como você está se sentindo?" style="resize: none;" oninput="postCharLimiter()"></textarea>
                    <div class="Ho-characters">
                        <span class="Ho-charactersNumber">0</span>/<span class="Ho-maxCharacters">200</span>
                    </div>
                </div>

                <div class="Ho-identifyMyself" style="cursor: pointer;">
                    <input type="checkbox" id="meIdentificarCheckbox" name="meIdentificar" style="cursor: pointer;" checked>
                    <label for="meIdentificarCheckbox" style="cursor: pointer;"> Me identificar </label>
                    <i class="bi bi-info-circle-fill" id="Ho-identifyMyselfIcon" style="cursor: pointer;"></i>
                </div>
            </div>
        </div>

        <div class="Ho-identifyMyselfModal close">
            <div class="Ho-identifyHeader"> 
                <img class="Ho-relatosIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
                <h3>Publicação sem identificação</h3>
            </div>
            <p><span>Relatos</span> podem ser publicados sem a necessidade de identificação, logo, 
                suas informações <span>não serão vinculadas</span> ao post e nenhum usuários poderá 
                acessar seu perfil a partir dele. Apesar disso, as notificações chegarão 
                normalmente.</p>
        </div>

        <div class="Ho-postBottom">
            <button type="submit" value="submit" name="postPostModal" class="Ho-submitPost confirmBtn close"> Postar </button>
        </div>

        <div class="Ho-postAttachments">
            <span class="Ho-preview"></span>
        </div>
    </form>
</modal> 

<script>
    const headerHome = document.querySelector('.headerHome');

    function openModalHeader(modal) {
        const modalSections = document.querySelectorAll('.modalSection');
        const closeModalBtns = document.querySelectorAll('.closeModal');
        const postStyleSummary = document.querySelectorAll('.postStyleSummary');
        const submitPostBtn = document.querySelector('.Ho-submitPost');
        const identifyMyself = document.querySelector('.Ho-identifyMyself');
        const postTitleContainer = document.querySelector('#postTitleContainer');
        const btnClicked = modal.getAttribute("data-type");
        
        postTitleContainer.style.display = (btnClicked === 'postSomething' && modal.id === '') ? 'none' : 'flex';

        submitPostBtn.setAttribute('name', modal.getAttribute('post-link'));
        
        if (modal.getAttribute('post-link') === "postRelatoModal") {
            identifyMyself.style.display = 'flex';  
        } else {
            identifyMyself.style.display = 'none';  
        }
        
        toggleModal(modal);

        const postId = modal.getAttribute("data-post-id");

        if (btnClicked === 'postSomething' && postId) {
            const postIdField = document.querySelector('#postIdField');
            if (postIdField) {
                postIdField.value = postId;
            }
        }

        if (modal.getAttribute("post-link") === "postComentarioModal") {
            const commentBtn = document.querySelector('.Ho-submitBtn[post-link="postComentarioModal"]');
            if (commentBtn) commentBtn.classList.add('active');
        }

        closeModalBtns.forEach(closeModalBtn => {
            closeModalBtn.addEventListener('click', () => {
                modalSections.forEach(modal => modal.classList.add('close'));
            });
        });
    }

    function dropdownHeaderSections() {
        const makeAPostButton = document.querySelector('.makeAPost');
        let closeTimeout;

        function closeAllModals() {
            document.querySelectorAll('.headerModal').forEach(modal => modal.classList.add('close'));
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

        document.querySelector('.notificationsModalIcon').addEventListener('click', () => {
            toggleModal(document.querySelector('.notificationsModal'));
        });

        document.querySelector('.makeAPost').addEventListener('click', () => {
            toggleModal(document.querySelector('.makeAPostModal'));

            if(!document.querySelector('.makeAPostModal').classList.contains('close'))
                makeAPostButton.classList.add('active');
        });

        headerHome.addEventListener('mouseleave', () => {
            closeTimeout = setTimeout(closeAllModals, 400);
        });
    }

    function toggleSelectedPage() {
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

    document.querySelector('.Ho-identifyMyself').addEventListener('click', () => {
        document.querySelector('.Ho-identifyMyselfModal').classList.toggle('close');
    })

    dropdownHeaderSections();
    toggleSelectedPage();
    
</script>

