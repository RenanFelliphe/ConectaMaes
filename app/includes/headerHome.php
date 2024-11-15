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
                <?php 
                    $partesDoNomeCompleto = explode(" ", $currentUserData['nomeCompleto']);
                    $firstName = $partesDoNomeCompleto[0];
                    $lastName = end($partesDoNomeCompleto);
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

        <div class="postStyleSummary" post-link="postPostModal" id='' data-type="postSomething" <?= $currentUserData['idUsuario'] == 1 ? '' : 'onclick="openModalHeader(this);"'; ?>>
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

        <div class="postStyleSummary" post-link="postRelatoModal" id="Relato" data-type="postSomething" <?= $currentUserData['idUsuario'] == 1 ? '' : 'onclick="openModalHeader(this);"'; ?>>
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

        <div class="postStyleSummary" post-link="postAuxilioModal" id="Auxilio" data-type="postSomething" <?= $currentUserData['idUsuario'] == 1 ? '' : 'onclick="openModalHeader(this);"'; ?>>
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
                
                <textarea name="conteudoEnvio" id="postText" cols="62" rows="3" class="Ho-postTextContent" placeholder="Como você está se sentindo?" style="resize: none;" oninput="postCharLimiter()"></textarea>
                <div class="Ho-characters">
                    <span class="Ho-charactersNumber">0</span>/<span class="Ho-maxCharacters">200</span>
                </div>
            </div>
        </div>
        <?php
            foreach ($messages as $message) {
                echo "<p>$message</p>";
            }
        ?>
        <div class="Ho-postBottom">
            <div class="Ho-identifyMyself" id="meIdentificarContainer"style="display: none;">
                <label for="meIdentificarCheckbox">
                    <input type="checkbox" id="meIdentificarCheckbox" name="meIdentificar" checked>
                    Me identificar
                </label>
                <i class="bi bi-info-circle" id="infoIcon"></i>
            </div>

            <button type="submit" value="submit" post-link="postPostModal" name="postPostModal" class="Ho-submitBtn confirmBtn close"> Postar </button>
            <button type="submit" value="submit" post-link="postRelatoModal" name="postRelatoModal" class="Ho-submitBtn confirmBtn close"> Relatar </button>
            <button type="submit" value="submit" post-link="postAuxilioModal" name="postAuxilioModal" class="Ho-submitBtn confirmBtn close"> Pedir </button>
            <button type="submit" value="submit" post-link="postComentarioModal" name="postComentarioModal" class="Ho-submitBtn confirmBtn"> Comentar </button>
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
    const btnClicked = modal.getAttribute("data-type");
    const postStyleSummary = document.querySelectorAll('.postStyleSummary');
    const submitBtns = document.querySelectorAll('.Ho-submitBtn');
    const postTitleContainer = document.getElementById('postTitleContainer');
    const meIdentificarContainer = document.getElementById('meIdentificarContainer');  // Referência ao container "Me Identificar"

    // Controle de exibição do título
    postTitleContainer.style.display = (btnClicked === 'postSomething' && modal.id === '') ? 'none' : 'flex';

    // Inicialmente, esconda o "Me Identificar" (mesmo no caso de outro tipo de post)
    meIdentificarContainer.style.display = 'none';

    postStyleSummary.forEach(postStyle => {
        postStyle.addEventListener('click', () => {
            const postStyleName = postStyle.getAttribute('post-link');

            if (postStyleName === "postRelatoModal") {
                meIdentificarContainer.style.display = 'flex';  
            } else {
                meIdentificarContainer.style.display = 'none';  
            }

            submitBtns.forEach(btn => {
                if (btn.getAttribute('post-link') === postStyleName) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        });
    });
    
    toggleModal(modal);
    

    const postId = modal.getAttribute("data-post-id");

    if (btnClicked === 'postSomething' && postId) {
        const postIdField = document.querySelector('#postIdField');
        if (postIdField) {
            postIdField.value = postId;
        }
    }

    submitBtns.forEach(btn => btn.classList.remove('active'));

    if (modal.getAttribute("post-link") === "postComentarioModal") {
        const commentBtn = document.querySelector('.Ho-submitBtn[post-link="postComentarioModal"]');
        if (commentBtn) commentBtn.classList.add('active');
    }

    closeModalBtns.forEach(closeModalBtn => {
        closeModalBtn.addEventListener('click', () => {
            modalSections.forEach(modal => modal.classList.add('close'));
            submitBtns.forEach(btn => btn.classList.remove('active'));
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

    dropdownHeaderSections();
    toggleSelectedPage();
    
</script>

