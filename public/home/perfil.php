<?php 
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../../app/services/helpers/paths.php";

    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    $user = isset($_GET['user']) ? true : header("Location:". $relativeRootPath."/notFound.php");
    
    require_once "../../app/services/crud/userFunctions.php";
    require_once "../../app/services/crud/childFunctions.php"; 
    require_once "../../app/services/crud/postFunctions.php";
    require_once '../../app/services/helpers/dateChecker.php';
    
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);   

    $profileQuery = "SELECT idUsuario, nomeCompleto, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin FROM Usuario WHERE nomeDeUsuario = '" . mysqli_real_escape_string($conn, $_GET['user']) . "'";
    $profileResult = mysqli_query($conn, $profileQuery);

    if (!$profileResult || mysqli_num_rows($profileResult) === 0) {
        header("Location:" . $relativeRootPath . "/notFound.php");
        exit;
    }

    $profileData = mysqli_fetch_assoc($profileResult);
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
                                    <span class="Pe-following">0</span>
                                    <p>Seguindo</p>
                                </div>
                                <div class="Pe-postsNumber">
                                    <span class="Pe-posts">0</span>
                                    <p>Posts</p>
                                </div>
                                <div class="Pe-followersNumber">
                                    <span class="Pe-followers">0</span>
                                    <p>Seguidores</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Pe-sectionBottom">
                        <div class="Pe-userBiography">
                            <p>Biografia</p>
                            <span><?php echo $profileData['biografia'];?></span>
                        </div>
                        <?php if($currentUserData['idUsuario'] == $profileData['idUsuario']){?>
                            <button name="editProfile" class="Pe-editAccount confirmBtn"><p>Editar Perfil</p><i class="bi bi-pencil-fill"></i></button>

                        <?php } else {?>
                            <button name="followProfile" class="Pe-editAccount confirmBtn"><p>Seguir</p><i class="bi bi-person-add"></i></button>
                        <?php }?>
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
                        POSTAGENS
                    </section>
                    <section class="Pe-postsRelatos Pe-allPosts">
                        RELATOS
                    </section>
                    <section class="Pe-postsAuxilios Pe-allPosts">
                        AUXÍLIOS
                    </section>
                </section>
            </section>
            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>

        <?php include_once ("../../app/includes/modais.php");?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }

            document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => b.querySelector('.postFunctionsModal').classList.toggle('close'));

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
                    // Remove a classe 'active' de todos os indicadores e seções
                    postTypes.forEach(pt => pt.classList.remove('active'));
                    allPostsSections.forEach(section => section.classList.remove('active'));

                    // Adiciona a classe 'active' ao indicador clicado
                    postType.classList.add('active');

                    // Seleciona a seção correspondente com base no 'data-target' do indicador
                    const targetSection = document.querySelector(`.${postType.getAttribute('data-target')}`);
                    targetSection.classList.add('active');
                });
            });

        </script>
    </body>
</html>