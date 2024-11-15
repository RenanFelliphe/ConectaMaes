<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once __DIR__ . "/../../app/services/helpers/paths.php";
    require_once "../../app/services/crud/userFunctions.php";
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);  
    require_once "../../app/services/crud/childFunctions.php"; 
    require_once "../../app/services/crud/postFunctions.php";
    require_once "../../app/services/helpers/dateChecker.php";

    if (!isset($_SESSION['active'])) {
        header("Location: " . $relativePublicPath . "/login.php");
        exit;
    }

    if (!isset($_GET['user'])) {
        header("Location: " . $relativeRootPath . "/notFound.php");
        exit;
    }

    $profileQuery = "SELECT idUsuario, nomeCompleto, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin 
                    FROM Usuario 
                    WHERE nomeDeUsuario = '" . mysqli_real_escape_string($conn, $_GET['user']) . "'";
    $profileResult = mysqli_query($conn, $profileQuery);
    $profileData = mysqli_fetch_assoc($profileResult);

    if (!$profileResult || mysqli_num_rows($profileResult) === 0) {
        header("Location: " . $relativeRootPath . "/notFound.php");
        exit;
    }

    if (isset($profileData)) {
        $followerCount = getFollowerCount($conn, $profileData['idUsuario']);
        $followingCount = getFollowingCount($conn, $profileData['idUsuario']);
        $postsCount = getPostsCount($conn, $profileData['idUsuario']);
    } else {
        echo "Erro: Dados do perfil não encontrados.";
    }

    $isFollowingQuery = "SELECT * FROM seguirUsuario WHERE idUsuarioSeguidor = ? AND idUsuarioSeguindo = ?";
    $stmt = mysqli_prepare($conn, $isFollowingQuery);
    mysqli_stmt_bind_param($stmt, "ii", $currentUserData['idUsuario'], $profileData['idUsuario']);
    mysqli_stmt_execute($stmt);
    $isFollowingResult = mysqli_stmt_get_result($stmt);
    $isFollowing = mysqli_num_rows($isFollowingResult) > 0;

    $publicacoes = queryPostsAndUserData($conn, '');

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
                    <!-- <ul><li class="Pe-lastTimeOnline">Visto por último: <span>a 2 horas atrás</span></li></ul> -->

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
                                    <?php 
                                        $partesDoNomeCompleto = explode(" ", $profileData['nomeCompleto']);
                                        $firstName = $partesDoNomeCompleto[0];
                                        $lastName = $partesDoNomeCompleto[count($partesDoNomeCompleto) - 1];
                                        $firstAndLastName = $firstName . " " . $lastName;
                                        
                                        echo $firstAndLastName;
                                    ?>
                                </div>
                                <div class="Pe-userNickname"><?= "@" . $profileData['nomeDeUsuario']; ?></div>
                            </div>
                            
                            <div class="Pe-userNumbers">
                                <div class="Pe-followingNumbers">
                                    <span class="Pe-following"><?= $followingCount; ?></span>
                                    <p>Seguindo</p>
                                </div>
                                <div class="Pe-postsNumber">
                                    <span class="Pe-posts"><?= $postsCount; ?></span>
                                    <p>Posts</p>
                                </div>
                                <div class="Pe-followersNumber">
                                    <span class="Pe-followers"><?= $followerCount; ?></span>
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
                            <button name="editProfile" class="Pe-editAccount confirmBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
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
                    <!--
                    <div class="Pe-searchBar close">
                        <label class="bi bi-search" for="Pe-searchBarInput"></label>
                        <input type="search" class="Pe-searchBarInput" id="Pe-searchBarInput" placeholder="Pesquisar neste perfil...">
                        <i class="bi bi-arrow-counterclockwise Pe-backSearchBar"></i>                    
                    </div>
                    -->
                    
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
                                include ("../../app/includes/posts.php");
                            ?>
                    </section>

                    <section class="Pe-postsRelatos Pe-allPosts">
                            <?php
                                $tipoPublicacao = 'Relato';
                                include ("../../app/includes/posts.php");
                            ?>
                    </section>

                    <section class="Pe-postsAuxilios Pe-allPosts">
                            <?php
                                $tipoPublicacao = 'Auxilio';
                                include ("../../app/includes/posts.php");
                            ?>
                    </section>
                </section>
            </section>
            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState(null, null, window.location.href );
            }

            /*const searchBar = document.querySelector('.Pe-searchBar');
            const backSearchBar = document.querySelector('.Pe-backSearchBar');
            const allPostTypes = document.querySelectorAll('.Pe-postType');

            searchBar.onclick = function () {
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
        </script>
    </body>
</html>