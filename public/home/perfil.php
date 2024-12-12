<?php 
    include_once ("../../app/includes/globalIncludes.php");

    // Verificar se o perfil de usuário foi especificado
    if (!isset($_GET['user'])) {
        header("Location: " . $relativeRootPath . "/notFound.php");
        exit;
    }

    $profileData = getUserProfile($conn, $_GET['user']);

    // Processar $_POST para curtir e seguir
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Curtir postagem
        if ($likedPost = array_keys($_POST, 'like', true)) {
            $postId = str_replace('like_', '', $likedPost[0]);
            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId);
        }

        // Verificar e processar solicitação de seguir
        if (isset($_POST['followProfile']) && $currentUserData['idUsuario'] != $profileData['idUsuario']) {
            followUser($conn, $currentUserData['idUsuario'], $profileData['idUsuario']);
        }
    }

    $profileCounts = getProfileCounts($conn, $profileData);

    $isFollowing = isUserFollowingProfile($conn, $currentUserData['idUsuario'], $profileData['idUsuario']);
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Perfil</title>
    </head>

    <body class="<?= $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main Pe-main mainSystem">
            <?php include_once ("../../app/includes/asideLeft.php");?>

            <section class="timeline">
                <section class="Pe-userProfileSection">
                    <a href="../home.php"><i class="bi bi-arrow-left-circle"></i></a>

                    <div class="Pe-userInformations">
                        <div class="Pe-userImage">
                            <div class="Pe-userProfileImage"><img src="<?= $relativeAssetsPath . "/imagens/fotos/perfil/". $profileData['linkFotoPerfil'];?>"></div>
                        </div>

                        <div class="Pe-userTextInformations">
                            <div class="Pe-userChildren">
                                <?php
                                    $filhos = queryMultipleChildrenData($conn, $where = "idUsuario = " . $profileData['idUsuario']);
                                    foreach($filhos as $f){
                                ?>
                                <div class="Pe-childPortrait"><img src="<?= $relativeAssetsPath; ?>/imagens/icons/<?= $f['sexo'] === 'boy' ? 'boy_icon' : ($f['sexo'] === 'girl' ? 'girl_icon' : 'pram_icon'); ?>.png" class="Pe-childIcon pageIcon" alt="Ícone do Filho"></div>
                                <?php
                                    }
                                ?>
                            </div>

                            <div class="Pe-userNames">
                                <div class="Pe-userRealName">
                                    <?= getFirstAndLastName($profileData['nomeCompleto']);
                                    ?>
                                </div>
                                <div class="Pe-userNickname"><?= "@" . $profileData['nomeDeUsuario']; ?></div>
                            </div>
                            
                            <div class="Pe-userNumbers">
                                <div class="Pe-followingNumbers">
                                    <span class="Pe-following"><?= $profileCounts['following']; ?></span>
                                    <p>Seguindo</p>
                                </div>
                                <div class="Pe-postsNumber">
                                    <span class="Pe-posts"><?= $profileCounts['posts']; ?></span>
                                    <p>Posts</p>
                                </div>
                                <div class="Pe-followersNumber">
                                    <span class="Pe-followers"><?= $profileCounts['followers']; ?></span>
                                    <p>Seguidores</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Pe-sectionBottom">
                        <div class="Pe-userBiography">
                            <p>Biografia</p>
                            <span><?= $profileData['biografia']; ?></span>
                        </div>
                        <?php if($currentUserData['idUsuario'] == $profileData['idUsuario']) { ?>
                            <button name="editProfile" class="Pe-editAccount confirmBtn" data-link="<?= $relativePublicPath . "/home/config.php"?>">
                                <p>Editar Perfil</p><i class="bi bi-pencil-fill"></i>
                            </button>
                        <?php } else { ?>
                            <form method="POST">
                                <button name="followProfile" class="Pe-followUser confirmBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                                    <p><?= $isFollowing ? 'Deixar de Seguir' : 'Seguir'; ?></p><i class="bi bi-person-<?= $isFollowing ? 'dash' : 'add'; ?>"></i>
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                    
                </section>

                <section class="Pe-profilePostType">
                    <!--<div class="Pe-searchBar close">
                        <label class="bi bi-search" for="Pe-searchBarInput"></label>
                        <input type="search" class="Pe-searchBarInput" id="Pe-searchBarInput" placeholder="Pesquisar neste perfil...">
                        <i class="bi bi-arrow-counterclockwise Pe-backSearchBar"></i>                    
                    </div>-->
                    
                    <div class="Pe-postType active" data-target="Pe-postsPostagens">
                        <img class="postsIcon Pe-postTypeIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/home_off.png" alt="Ícone da página inicial">
                        <p class="Pe-postTypeTitle">Postagem</p>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="Pe-postTypeSelector"></span>
                    </div>
                    <div class="Pe-postType" data-target="Pe-postsRelatos">
                        <img class="reportsIcon Pe-postTypeIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
                        <p class="Pe-postTypeTitle">Relato</p>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="Pe-postTypeSelector"></span>
                    </div>
                    <div class="Pe-postType" data-target="Pe-postsAuxilios">
                        <img class="helpsIcon Pe-postTypeIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/helps_off.png" alt="Ícone da página de auxílios">
                        <p class="Pe-postTypeTitle">Auxílio</p>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="Pe-postTypeSelector"></span>
                    </div>
                    
                </section>

                <section class="Pe-userProfilePosts">
                    <section class="Pe-postsPostagens Pe-allPosts active">
                        <?php
                        if (count($publicacoes) > 0) {
                            $count = 0;

                            foreach ($publicacoes as $dadosPublicacao) {
                                if ($dadosPublicacao['idUsuario'] == $profileData['idUsuario']) {

                                    // Verificar se o link da foto de perfil está presente
                                    $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                            
                                    // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                                    $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                                    ?>
                                    <article class="Ho-post">
                                        <a class="postOwnerImage" href="<?= $relativePublicPath . "/home/perfil.php?user=" . urlencode($dadosPublicacao['nomeDeUsuario']);?>">
                                            <img src="<?= $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                        </a>
                            
                                        <div class="postContent">
                                            <div class="postTimelineTop">
                                                <div class="postUserNames">
                                                    <p class="postOwnerName">
                                                        <?= getFirstAndLastName($dadosPublicacao['nomeCompleto'])?>
                                                    </p>
                                                    <p class="postOwnerUser">
                                                        <?= '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?>
                                                    </p>
                                                </div>
                            
                                                <div class="postInfo">
                                                    <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
                                                    <div class="bi bi-three-dots postMoreButton">
                                                        <form class="postFunctionsModal close" method = "POST">
                                                        <button class="reportPostButton bi bi-megaphone-fill pageIcon" name = "denunciarPost" onclick=""> Denunciar Postagem</button>
                                                            <?php if($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario']){?>
                                                                <input type="hidden" name = "deleterId" value="<?= $dadosPublicacao['idPublicacao']?>">
                                                                <button class="deletePostButton bi bi-trash3-fill pageIcon" name = "deletarPost" type = "submit"> Deletar Postagem</button>
                                                            <?php } ?>
                                                        </form>       
                                                        <?php
                                                            if(isset($_POST['deletarPost'])){
                                                                deletePost($conn, $_POST['deleterId']);
                                                            }
                                                        ?>                                     
                                                    </div>                         
                                                </div>
                                            </div>
                            
                                            <div class="postTitles">  
                                                <p class="postTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                                <p class="textPost"><?= htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                                            </div>
                            
                                            <form class="postTimelineBottom" method='POST'>
                                                <button class="postLikes" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?>" value="like">
                                                    <i class="bi bi-heart-fill <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>"></i>
                                                    <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                                </button>
                                                <button class="postComments" type="submit" name="comment">
                                                    <i class="bi bi-chat-fill"></i>
                                                    <p>0</p>
                                                </button>
                                            </form>
                                        </div>
                                    </article>
                                    <?php
                                    $count++;
                                    // A cada 50 publicações, mostrar "sugestões"
                                    /* if ($count % 50 == 0) {
                                        echo "Sugestões<br><br>";
                                    } */
                                }
                            }
                            ?><p class="endTimeline">...</p>
                            <?php
                        } else {
                            ?>
                                <p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p>
                            <?php
                        }      
                        ?>
                    </section>

                    <section class="Pe-postsRelatos Pe-allPosts">
                        <?php
                            $publicacoes = queryPostsAndUserData($conn, 'Relato');
                            if (count($publicacoes) > 0) {
                                $count = 0;
                                foreach ($publicacoes as $dadosPublicacao) {
                                    if ($dadosPublicacao['idUsuario'] == $profileData['idUsuario']) {
                                        // Verificar se o link da foto de perfil está presente
                                        $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                                
                                        // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                                        $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                                        ?>
                                        <article class="Ho-post">
                                            <div class="postOwnerImage">
                                                <img src="<?= $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                            </div>
                                
                                            <div class="postContent">
                                                <div class="postTimelineTop">
                                                    <div class="postUserNames">
                                                        <p class="postOwnerName">
                                                        <?= getFirstAndLastName($dadosPublicacao['nomeCompleto'])?>
                                                        </p>
                                                        <p class="postOwnerUser">
                                                            <?= '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?>
                                                        </p>
                                                    </div>
                                
                                                    <div class="postInfo">
                                                        <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
                                                        <div class="bi bi-three-dots postMoreButton">
                                                            <form class="postFunctionsModal close" method = "POST">
                                                            <button class="reportPostButton bi bi-megaphone-fill pageIcon" name = "denunciarPost" onclick=""> Denunciar Postagem</button>
                                                                <?php if($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario']){?>
                                                                    <input type="hidden" name = "deleterId" value="<?= $dadosPublicacao['idPublicacao']?>">
                                                                    <button class="deletePostButton bi bi-trash3-fill pageIcon" name = "deletarPost" type = "submit"> Deletar Postagem</button>
                                                                <?php } ?>
                                                            </form>       
                                                            <?php
                                                                if(isset($_POST['deletarPost'])){
                                                                    deletePost($conn, $_POST['deleterId']);
                                                                }
                                                            ?>                                     
                                                        </div>                         
                                                    </div>
                                                </div>
                                
                                                <div class="postTitles">  
                                                    <strong class="postTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></strong>
                                                    <p class="textPost"><?= htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                                                </div>
                                
                                                <form class="postTimelineBottom"  method='post'>
                                                    <button class="postLikes" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?>" value="like">
                                                        <i class="bi bi-heart-fill <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>"></i>
                                                        <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                                    </button>
                                                    <div class="postComments">
                                                        <i class="bi bi-chat-fill"></i>
                                                        <p>0</p>
                                                    </div>
                                                </form>
                                            </div>
                                        </article>
                                
                                        <?php
                                        $count++;
                                
                                        /* A cada 50 publicações, mostrar "sugestões"
                                            if ($count % 50 == 0) {
                                                echo "Sugestões<br><br>";
                                            }
                                        */
                                    }
                                }
                                ?><p class="endTimeline">...</p>
                                <?php
                            } else {
                                ?>
                                    <p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p>
                                <?php
                            }   
                        ?>
                    </section>

                    <section class="Pe-postsAuxilios Pe-allPosts">
                        <?php
                        $auxilios = queryPostsAndUserData($conn, 'Auxilio');
                        if (count($auxilios) > 0) {
                            $count = 0;
                            foreach ($auxilios as $dadosPublicacao) {
                                if ($dadosPublicacao['idUsuario'] == $profileData['idUsuario']) {
                                    // Verificar se o link da foto de perfil está presente
                                    $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';

                                    // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                                    $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                                    ?>
                                    <article class="Au-auxilioCard" onclick="openAuxilioModal();">
                                        <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
                                        <div class="postTimelineTop">
                                            <div class="postOwnerImage">
                                                <img src="<?= $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                            </div>

                                            <div class="postUserNames">
                                                <p class="postOwnerName">
                                                <?= getFirstAndLastName($dadosPublicacao['nomeCompleto'])?>
                                                </p>
                                                <p class="postOwnerUser">
                                                    <?= '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?>
                                                </p>
                                            </div>
                                        </div>

                                        <p class="postTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>

                                        <div class="postTimelineBottom">
                                            <div class="postInteractions">
                                                <div class="postLikes">
                                                    <i class="bi bi-heart-fill"></i>
                                                    <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                                </div>
                                                <div class="postComments">
                                                    <i class="bi bi-chat-fill"></i>
                                                    <p>0</p>
                                                </div>
                                            </div>

                                            <button name="openAuxilio" class="Au-openAuxilio confirmBtn">Auxiliar</button>
                                        </div>

                                        <section class="Au-auxilioModalBack close">
                                            <article class="Au-auxilioModal">
                                                <div class="Au-modalHeader">
                                                    <ul class="auxilioDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul> 
                                                    <p class="auxilioTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                                    <i class="bi bi-x Au-closeModal" onclick="openAuxilioModal()"></i>
                                                </div>

                                                <div class="Au-auxilioUser">
                                                    <div class="postOwnerImage">
                                                        <img src="<?= $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                                    </div>

                                                    <div class="postUserNames">
                                                        <p class="postOwnerName"><?= htmlspecialchars($dadosPublicacao['nomeCompleto']); ?></p>
                                                        <p class="postOwnerUser"><?= htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?></p>
                                                    </div>

                                                    <button name="followUser" class="Au-follow confirmBtn">Seguir</button>
                                                </div>

                                                <p class="Au-textPost"><?= htmlspecialchars($dadosPublicacao['conteudo']); ?></p>

                                                <div class="Au-childPostSection">
                                                    <div class="Au-childrenName">
                                                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageImageIcon active" alt="Ícone de Criança">
                                                        <p class="Au-childName">Nome da Criança</p>
                                                    </div>

                                                    <div class="postsImages">
                                                        <p>+</p>
                                                    </div>

                                                    <div class="Au-postExtraInfos">
                                                        <div class="Au-extraInfos">
                                                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/local_icon.png" class="pageImageIcon active" alt="Ícone de Local">
                                                            <p><?= htmlspecialchars($dadosPublicacao['estado']); ?></p>
                                                        </div>
                                                        <div class="Au-extraInfos">
                                                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/pix_icon.png" class="pageImageIcon active" alt="Ícone de Pix">
                                                            <p>N/a</p>
                                                        </div>
                                                    </div>
                                                    <button name="helpUser" class="Au-help confirmBtn">Auxiliar</button>
                                                </div>

                                                <form class="postInteractions"  method='post'>
                                                    <span></span>
                                                    <button class="postLikes" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?>" value="like">
                                                        <i class="bi bi-heart-fill <?= queryUserLike($conn,$currentUserData['idUsuario'],$dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>"></i>
                                                        <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                                    </button>

                                                    <h3>Comentários</h3>

                                                    <span></span>

                                                    <div class="postComments">
                                                        <i class="bi bi-heart-fill"></i>
                                                        <p>0</p>
                                                    </div>
                                                    <span></span>
                                                </form>
                                            </article>
                                        </section>
                                    </article>
                                    <?php
                                }
                            }
                            ?><p class="endTimeline">...</p>
                        <?php
                        } else {
                            ?>
                            <p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p>
                        <?php
                        }   
                        ?>
                    </section>
                </section>
            </section>
            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>

        <?php //include_once ("../../app/includes/modais.php");?>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => b.querySelector('.postFunctionsModal').classList.toggle('close'));

            //const searchBar = document.querySelector('.Pe-searchBar');
            //const backSearchBar = document.querySelector('.Pe-backSearchBar');
            const allPostTypes = document.querySelectorAll('.Pe-postType');

            /*searchBar.onclick = function () {
                if (searchBar.classList.contains('close')) {
                    searchBar.classList.remove('close');
                    allPostTypes.forEach(postType => {
                        postType.style.display = "none";
                    });
                }
            };

            backSearchBar.onclick = function (event) {
                event.stopPropagation();
                searchBar.classList.add('close');
                allPostTypes.forEach(postType => {
                    postType.style.display = "flex";
                });
            };*/
            
            const postTypes = document.querySelectorAll('.Pe-postType');
            const allPostsSections = document.querySelectorAll('.Pe-allPosts');

            postTypes.forEach(postType => {
                postType.addEventListener('click', () => {
                    postTypes.forEach(pt => pt.classList.remove('active'));
                    allPostsSections.forEach(section => section.classList.remove('active'));

                    postType.classList.add('active');

                    const targetSection = document.querySelector(`.${postType.getAttribute('data-target')}`);
                    targetSection.classList.add('active');
                });
            });

            function redirectToEditProfile(buttonSelector) {
                const button = document.querySelector(buttonSelector);
                button.addEventListener('click', function() {
                    const link = this.getAttribute('data-link');
                    window.location.href = link;
                });
            }

            // Chama a função para o botão com a classe "Pe-editAccount"
            redirectToEditProfile('.Pe-editAccount');

        </script>
    </body>
</html>