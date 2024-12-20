<?php
    include_once __DIR__ . "/../services/helpers/paths.php";
    include_once __DIR__ . "/../services/crud/postFunctions.php";
    $currentUserHasNewNotifications = hasNewNotifications($conn, $currentUserData['idUsuario']);
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
        <div class="notificationIconContainer">
            <img class="notificationsModalIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/notifications_off.png" alt="Ícone do modal de notificações">
            <?php
                if($currentUserHasNewNotifications){
                ?>
                    <span class="notificationAlert"></span>
                <?php
                }
            ?>
        </div>

        <div class="makeAPost" onclick="openModalHeader(this);">
            <button name ="postPostagem" class="makeAPostBtn">Postar</button>

            <i class="bi bi-plus-lg postBtnMobile pageIcon"></i>

            <div class="postStyle">
                <i class="bi bi-caret-down-fill pageIcon"></i>
            </div>
        </div>

        <div class="userInformations">
            <span class="userRealName">
                <?= getFirstAndLastName($currentUserData['nomeCompleto']);?>
            </span>
            <span class="userNickname">
                <?= "@" . $currentUserData['nomeDeUsuario']; ?>
            </span>
        </div>

        <div class="userAccount">
            <div class="userProfileImage">
                <img src="<?= $relativeAssetsPath . "/imagens/fotos/perfil/". $currentUserData['linkFotoPerfil'];?>">
            </div>
        </div>
    </div>

    <div class="notificationsModal headerModal close">
        <div class="modalHeader">
            <h1>Notificações</h1>
            <!--i class="bi bi-three-dots pageIcon"></i-->
        </div>    
        
        <div class="notificationsCenter">
            <div class="notificationsContainer">
                <?php 
                    $notifications = getUserNotifications($conn, $currentUserData['idUsuario']);
                    $today = date('Y-m-d'); 
                    $sevenDaysAgo = date('Y-m-d', strtotime('-7 days')); 
                    $foundNotification = false;

                    // Lista de notificações desativadas por tipo de notificação
                    $mutedNotifs = [
                        1 => ["curtiuPublicacao", "curtiuComentario"],
                        2 => ["comentouPublicacao", "comentouComentario"],
                        4 => ["seguiuUsuario"],
                    ];
                    
                    $mutedNotifs[3] = array_merge($mutedNotifs[1], $mutedNotifs[2]);
                    $mutedNotifs[5] = array_merge($mutedNotifs[1], $mutedNotifs[4]);
                    $mutedNotifs[6] = array_merge($mutedNotifs[2], $mutedNotifs[4]);
                    $mutedNotifs[7] = array_merge($mutedNotifs[1], $mutedNotifs[2], $mutedNotifs[4]);
                    
                    // Função para calcular o texto da data relativa
                    function getRelativeDateText($date, $today) {
                        $diff = (strtotime($today) - strtotime($date)) / 86400;
                        if ($diff == 0) return "Hoje";
                        if ($diff == 1) return "Ontem";
                        return "$diff dias atrás";
                    }

                    $groupedNotifications = [];

                    if (count($notifications) > 0) {
                        foreach ($notifications as $notification) {
                            $notificationDate = date('Y-m-d', strtotime($notification['dataNotificacao']));

                            // Pula notificações fora do intervalo de 7 dias ou do próprio usuário
                            if ($notificationDate < $sevenDaysAgo || $notification['idUsuarioGerou'] == $currentUserData['idUsuario']) {
                                continue;
                            }

                            // Verifica se a notificação está desativada para o tipo atual
                            $desativadoTipos = $mutedNotifs[$currentUserData['desativouNotificacao']] ?? [];
                            if (in_array($notification['tipoNotificacao'], $desativadoTipos)) {
                                continue;
                            }

                            $foundNotification = true;

                            // Agrupa notificações por data
                            $relativeDateText = getRelativeDateText($notificationDate, $today);
                            if (!isset($groupedNotifications[$relativeDateText])) {
                                $groupedNotifications[$relativeDateText] = [];
                            }
                            $groupedNotifications[$relativeDateText][] = $notification;
                        }

                        // Renderiza notificações agrupadas
                        foreach ($groupedNotifications as $relativeDate => $notificationsGroup) {
                            ?>
                                <div class='notificationsRelativeDate'>
                                    <span></span>
                                    <p><?= $relativeDate ?></p>
                                    <span></span>
                                </div>
                            <?php

                            foreach ($notificationsGroup as $notification) {
                                $userPhoto = $notification['fotoUsuarioGerou'];
                                $username = $notification['usernameUsuarioGerou'];
                                $action = '';

                                // Define a ação de acordo com o tipo de notificação
                                switch ($notification['tipoNotificacao']) {
                                    case 'curtiuPublicacao':
                                        $action = "curtiu sua publicação";
                                        break;
                                    case 'curtiuComentario':
                                        $action = "curtiu seu comentário";
                                        break;
                                    case 'comentouPublicacao':
                                        $action = "comentou sua publicação";
                                        break;
                                    case 'comentouComentario':
                                        $action = "respondeu ao seu comentário";
                                        break;
                                    case 'seguiuUsuario':
                                        $action = "seguiu você";
                                        break;
                                }
                                ?>
                                <div class='notification' data-id="<?=$notification['idNotificacao'];?>" data-link="<?= $relativePublicPath . $notification['linkNotificacao'] ?>">
                                    <?= renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $userPhoto, $username, false) ?>
                                    <div class="notificationContent">
                                        <strong class='username'><?= $username ?></strong> <?= $action ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }

                    if (!$foundNotification) {
                        echo "Nenhuma notificação encontrada.";
                    }
                ?>
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

<footer class="navMobile">
    <a class="homePageLink pageLink" id="homePageLink" href="<?= $relativePublicPath; ?>/home.php">
        <img class="homePageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/home_off.png" alt="Ícone da página inicial">
        <?php $postType = "Postagem";?>
    </a>

    <a class="reportPageLink pageLink" id="reportPageLink" href="<?= $relativePublicPath; ?>/home/relatos.php">
        <img class="reportPageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
        <?php $postType = "Relato";?>
    </a>

    <a class="helpPageLink pageLink" id="helpPageLink" href="<?= $relativePublicPath; ?>/home/auxilios.php">
        <img class="helpPageIcon headerIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
    </a>
</footer>

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
            <p><span>Relatos</span> podem ser publicados sem a necessidade de identificação. Logo, 
                suas informações <span>não serão vinculadas</span> à publicação e nenhum usuário poderá acessar seu perfil a partir dela.
            </p>
        </div>

        <div class="Ho-postBottom">
            <div class="Ho-postAttachments">
                <div class="Ho-imageInput Ho-postInputLabel">
                    <input type="file" id="Ho-imageSelector" name="linkAnexoEnvio" accept="image/png, image/jpeg" onchange="addPost();">
                    <label for="Ho-imageSelector">
                        <i class="bi bi-images Ho-iconLabel"></i>
                        <p> Imagem </p>
                    </label>
                </div>
                
                <div class="Ho-showPixKey Ho-postInputLabel">
                    <div class="Ho-postInputLabel" style="pointer-events: <?= empty($currentUserData['chavePix']) ? 'none' : 'all' ?>;">
                        <img src="<?= $relativeAssetsPath . "/imagens/icons/pix_icon.png" ?>" class="<?= empty($currentUserData['chavePix']) ? 'noPix' : '' ?>" alt="Ícone do Pix">
                        <label for="showPixKeyCheckbox" class="<?= empty($currentUserData['chavePix']) ? 'noPix' : '' ?>">Chave Pix</label>
                        <input type="checkbox" id="showPixKeyCheckbox" name="showPixKey">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                    
                    <div class="Ho-showPixKeyModal close">
                        <?php if (!empty($currentUserData['chavePix'])) { ?>
                            <p>Você pode anexar uma chave Pix à publicação caso sua requisição de <span style="color: var(--thirdColor)">Auxílio</span> seja financeira.</p>
                            <p><span>Sua chave Pix:</span> <?php echo $currentUserData['chavePix']; ?></p>
                        <?php } else { ?>
                            <p>Você não possui uma chave Pix cadastrada!</p>
                            <p>Você pode adicioná-la na página de configurações.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <button type="submit" value="submit" name="postPostModal" class="Ho-submitPost confirmBtn close"> Postar </button>
        </div>

        <div class="Ho-imagePreview">
            <span class="Ho-preview"></span>
        </div>
    </form>
</modal> 

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.querySelector('.notificationsModal');
        
        const observer = new MutationObserver(function (mutationsList) {
            for (const mutation of mutationsList) {
                if (mutation.type === 'attributes' && !modal.classList.contains('close')) {
                    // A classe 'close' foi removida, ou seja, o modal foi aberto
                    const notifications = document.querySelectorAll('.notification');
                    
                    notifications.forEach(notification => {
                        const notificationId = notification.getAttribute('data-id');
                        
                        // Fazendo a requisição ao servidor para marcar a notificação como lida
                        fetch('<?= $_SERVER['PHP_SELF']?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `notificationId=${notificationId}`
                        })
                        .then(response => response.json())  // Converte automaticamente para JSON
                        .then(data => {
                            console.log('Dados recebidos do servidor:', data);
                            if (data.success) {
                                console.log('Notificação marcada como lida.');
                            } else {
                                console.log('Falha ao marcar a notificação:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao marcar notificação como lida:', error);
                        });
                    });
                }
            }
        });

        observer.observe(modal, { attributes: true });
    });

    const headerHome = document.querySelector('.headerHome');

    function configurePostModal(modal) {
        const postLink = modal.getAttribute('post-link');
        const postIdField = document.querySelector('#postIdField');
        
        if (postLink === 'postNestedComentarioModal') {
            postIdField.name = 'idComentario';
        } else {
            postIdField.name = 'idPublicacao';
        }
    }
    function openModalHeader(modal) { 
        configurePostModal(modal);
        const modalSections = document.querySelectorAll('.modalSection');
        const submitPostBtn = document.querySelector('.Ho-submitPost');
        const btnClicked = modal.getAttribute("data-type");
        const postLink = modal.getAttribute('post-link');

        const postTitleContainer = document.querySelector('#postTitleContainer');
        postTitleContainer.style.display = (btnClicked === 'postSomething' && modal.id === '') ? 'none' : 'flex';

        // Ajusta o texto do botão com base no `post-link`
        let buttonText = 'Postar'; // Texto padrão
        if (postLink === 'postComentarioModal' || postLink === 'postNestedComentarioModal') {
            buttonText = 'Comentar';
        } else if (postLink === 'postAuxilioModal') {
            buttonText = 'Pedir';
        } else if (postLink === 'postRelatoModal') {
            buttonText = 'Relatar';
        }

        submitPostBtn.textContent = buttonText;

        submitPostBtn.setAttribute('name', postLink);

        const identifyMyself = document.querySelector('.Ho-identifyMyself');
        const imageInput = document.querySelector('.Ho-imageInput');
        const showPixKey = document.querySelector('.Ho-showPixKey');

        if (postLink === "postRelatoModal") {
            identifyMyself.style.display = 'flex';  
        } else {
            identifyMyself.style.display = 'none';  
        }

        if (postLink === "postComentarioModal" || postLink === "postNestedComentarioModal") {
            imageInput.style.display = 'none'; 
        } else {
            imageInput.style.display = 'flex';
        }

        if (postLink === "postAuxilioModal") {
            showPixKey.style.display = 'flex';
        } else {
            showPixKey.style.display = 'none';
        }
        
        toggleModal(modal);

        // Adiciona o idPublicacao na postagem de comentários
        const postId = modal.getAttribute("data-post-id");
        if (btnClicked === 'postSomething' && postId) {
            const postIdField = document.querySelector('#postIdField');
            if (postIdField) {
                postIdField.value = postId;
            }
        }

        // Fecha o modal
        const closeModalBtns = document.querySelectorAll('.closeModal');  
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
            closeTimeout = setTimeout(closeAllModals, 10000);
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

    function redirectFromNotification() {
        document.addEventListener("DOMContentLoaded", function() {
            const notificationItems = document.querySelectorAll('.notification');

            notificationItems.forEach(notification => {
                notification.addEventListener('click', function() {
                    const link = this.getAttribute('data-link');
                    window.location.href = link; 
                });
            });
        });
    }

    document.querySelector('.Ho-identifyMyself').addEventListener('click', () => {
        document.querySelector('.Ho-identifyMyselfModal').classList.toggle('close');
    });

    document.querySelector('.Ho-showPixKey').addEventListener('click', () => {
        document.querySelector('.Ho-showPixKeyModal').classList.toggle('close');
    });

    dropdownHeaderSections();
    toggleSelectedPage();
    redirectFromNotification();
    
</script>

