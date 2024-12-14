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

        if (isset($currentUserData) && isset($_POST['followFromProfile'])) {
            $toFollowId = (int) $_POST['idFromProfile'];
        
            if ($toFollowId !== $currentUserData['idUsuario'] && $toFollowId !== 1) {
                followUser($conn, $currentUserData['idUsuario'], $toFollowId);
            }
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
                                <input type="hidden" name="idFromProfile" value="<?= $profileData['idUsuario']; ?>">

                                <button name="followFromProfile" class="Pe-followUser confirmBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
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
                            $tipoPublicacao = '';
                            $userId = isset($profileData['idUsuario']) ? $profileData['idUsuario'] : null;
                            $publicacoes = queryPostsAndUserData($conn, '', $userId);
                            include __DIR__ . "/../../app/includes/posts.php";
                        ?>
                    </section>

                    <section class="Pe-postsRelatos Pe-allPosts">
                        <?php
                            $tipoPublicacao = 'Relato';
                            $userId = isset($profileData['idUsuario']) ? $profileData['idUsuario'] : null;
                            $publicacoes = queryPostsAndUserData($conn, $tipoPublicacao, $userId);
                            include __DIR__ . "/../../app/includes/posts.php";
                        ?>
                    </section>

                    <section class="Pe-postsAuxilios Au-allAuxilios Pe-allPosts">
                        <?php
                            $tipoPublicacao = 'Auxilio';
                            $userId = isset($profileData['idUsuario']) ? $profileData['idUsuario'] : null;
                            $publicacoes = queryPostsAndUserData($conn, $tipoPublicacao, $userId);
                            include __DIR__ . "/../../app/includes/posts.php";
                        ?>
                    </section>
                </section>
            </section>

            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>

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