<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . "/../../app/services/helpers/paths.php";
require_once "../../app/services/crud/userFunctions.php";
require_once "../../app/services/crud/childFunctions.php"; 
require_once "../../app/services/crud/postFunctions.php";
require_once "../../app/services/helpers/dateChecker.php";

// Verificar se o usuário está logado
if (!isset($_SESSION['active'])) {
    header("Location: " . $relativePublicPath . "/login.php");
    exit;
}

// Verificar se o perfil de usuário foi especificado
if (!isset($_GET['user'])) {
    header("Location: " . $relativeRootPath . "/notFound.php");
    exit;
}

// Carregar dados do usuário logado
$currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);   

// Carregar dados do perfil do usuário visitado
$profileQuery = "SELECT idUsuario, nomeCompleto, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin 
                 FROM Usuario 
                 WHERE nomeDeUsuario = '" . mysqli_real_escape_string($conn, $_GET['user']) . "'";
$profileResult = mysqli_query($conn, $profileQuery);
$profileData = mysqli_fetch_assoc($profileResult);

if (!$profileResult || mysqli_num_rows($profileResult) === 0) {
    header("Location: " . $relativeRootPath . "/notFound.php");
    exit;
}

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
    } elseif ($currentUserData['idUsuario'] == $profileData['idUsuario']) {
        echo "Você não pode seguir a si mesmo.";
    }
}

// Obter o número de seguidores e de pessoas que o usuário está seguindo
if (isset($profileData)) {
    $followerCount = getFollowerCount($conn, $profileData['idUsuario']);
    $followingCount = getFollowingCount($conn, $profileData['idUsuario']);
    $postsCount = getPostsCount($conn, $profileData['idUsuario']);
} else {
    echo "Erro: Dados do perfil não encontrados.";
}

// Verificar se o usuário logado já segue o perfil visitado
$isFollowingQuery = "SELECT * FROM seguirUsuario WHERE idUsuarioSeguidor = ? AND idUsuarioSeguindo = ?";
$stmt = mysqli_prepare($conn, $isFollowingQuery);
mysqli_stmt_bind_param($stmt, "ii", $currentUserData['idUsuario'], $profileData['idUsuario']);
mysqli_stmt_execute($stmt);
$isFollowingResult = mysqli_stmt_get_result($stmt);
$isFollowing = mysqli_num_rows($isFollowingResult) > 0;

// Consultar as publicações do usuário
$publicacoes = queryPostsAndUserData($conn, '');

?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Perfil</title>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main Pe-main mainSystem">
            <?php include_once ("../../app/includes/asideLeft.php");?>

            <section class="timeline">
                <section class="Pe-userProfileSection">
                    <a href="../home.php"><i class="bi bi-arrow-left-circle"></i></a>
                    <ul><li class="Pe-lastTimeOnline">Visto por último: <span>a 2 horas atrás</span></li></ul> 

                    <div class="Pe-userInformations">
                        <div class="Pe-userImage">
                            <div class="Pe-userProfileImage"><img src="<?php echo $relativeAssetsPath . "/imagens/fotos/perfil/". $profileData['linkFotoPerfil'];?>"></div>
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
                                <div class="Pe-userNickname"><?php echo "@" . $profileData['nomeDeUsuario']; ?></div>
                            </div>
                            
                            <div class="Pe-userNumbers">
                                <div class="Pe-followingNumbers">
                                    <span class="Pe-following"><?php echo $followingCount; ?></span>
                                    <p>Seguindo</p>
                                </div>
                                <div class="Pe-postsNumber">
                                    <span class="Pe-posts"><?php echo $postsCount; ?></span>
                                    <p>Posts</p>
                                </div>
                                <div class="Pe-followersNumber">
                                    <span class="Pe-followers"><?php echo $followerCount; ?></span>
                                    <p>Seguidores</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Pe-sectionBottom">
                        <div class="Pe-userBiography">
                            <p>Biografia</p>
                            <span><?php echo $profileData['biografia']; ?></span>
                        </div>
                        <?php if($currentUserData['idUsuario'] == $profileData['idUsuario']) { ?>
                            <button name="editProfile" class="Pe-editAccount confirmBtn">
                                <p>Editar Perfil</p><i class="bi bi-pencil-fill"></i>
                            </button>
                        <?php } else { ?>
                            <form method="POST">
                                <button name="followProfile" class="Pe-followUser confirmBtn">
                                    <p><?php echo $isFollowing ? 'Deixar de Seguir' : 'Seguir'; ?></p><i class="bi bi-person-<?php echo $isFollowing ? 'dash' : 'add'; ?>"></i>
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                    
                </section>

                <section class="Pe-profilePostType">
                    <div class="Pe-searchBar close">
                        <label class="bi bi-search" for="Pe-searchBarInput"></label>
                        <input type="search" class="Pe-searchBarInput" id="Pe-searchBarInput" placeholder="Pesquisar neste perfil...">
                        <i class="bi bi-arrow-counterclockwise Pe-backSearchBar"></i>                    
                    </div>
                    
                    <div class="Pe-postType active" data-target="Pe-postsPostagens">
                        <img class="postsIcon Pe-postTypeIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/home_off.png" alt="Ícone da página inicial">
                        <p class="Pe-postTypeTitle">Postagem</p>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="Pe-postTypeSelector"></span>
                    </div>
                    <div class="Pe-postType" data-target="Pe-postsRelatos">
                        <img class="reportsIcon Pe-postTypeIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
                        <p class="Pe-postTypeTitle">Relato</p>
                        <i class="bi bi-info-circle-fill"></i>
                        <span class="Pe-postTypeSelector"></span>
                    </div>
                    <div class="Pe-postType" data-target="Pe-postsAuxilios">
                        <img class="helpsIcon Pe-postTypeIcon" src="<?php echo $relativeAssetsPath; ?>/imagens/icons/helps_off.png" alt="Ícone da página de auxílios">
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

        <?php include_once ("../../app/includes/modais.php");?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState(null, null, window.location.href );
            }

            const searchBar = document.querySelector('.Pe-searchBar');
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
            };
            
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