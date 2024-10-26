<?php 
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    require_once "../../app/services/crud/userFunctions.php"; 
    require_once "../../app/services/crud/postFunctions.php";
    require_once '../../app/services/helpers/dateChecker.php';

    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);  

    // Processar $_POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($likedPost = array_keys($_POST, 'like', true)) {
            $postId = str_replace('like_', '', $likedPost[0]); // Extrai o ID da publicação
            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId); // Lida com o like
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Auxílios</title>
        </meta>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main Au-main mainSystem">
            <section class="asideLeft">
                <img src="" class="backCells cellsLeft">
            </section>

            <section class="timeline">
                <section class="Ho-postFilter">
                    <h1 class="Ho-postRecent Ho-mainFilters active" onclick="toggleAuxilioFilter(this);">Recentes</h1>
                    <h1 class="Ho-postMain Ho-mainFilters" onclick="toggleAuxilioFilter(this);">Principais</h1>
                </section>

                <section class="Au-allAuxilios">
                    <?php
                    $auxilios = queryPostsAndUserData($conn, 'Auxilio');
                    if (count($auxilios) > 0) {
                        $count = 0;
                        foreach ($auxilios as $dadosPublicacao) {
                            // Verificar se o link da foto de perfil está presente
                            $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';

                            // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                            ?>
                            <article class="Au-auxilioCard" onclick="openAuxilioModal();">
                                <ul class="postDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul>
                                <div class="postTimelineTop">
                                    <div class="postOwnerImage">
                                        <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                    </div>

                                    <div class="postUserNames">
                                        <p class="postOwnerName">
                                            <?php 
                                            $partesDoNomeCompletoOwner = explode(" ", $dadosPublicacao['nomeCompleto']);
                                            $firstNameOwner = $partesDoNomeCompletoOwner[0];
                                            $lastNameOwner = $partesDoNomeCompletoOwner[count($partesDoNomeCompletoOwner) - 1];
                                            $firstAndLastNameOwner = $firstNameOwner . " " . $lastNameOwner;
                                            echo htmlspecialchars($firstAndLastNameOwner); 
                                            ?>
                                        </p>
                                        <p class="postOwnerUser">
                                            <?php echo '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?>
                                        </p>
                                    </div>
                                </div>

                                <p class="postTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>

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
                                            <ul class="auxilioDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul> 
                                            <p class="auxilioTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                            <i class="bi bi-x Au-closeModal" onclick="openAuxilioModal()"></i>
                                        </div>

                                        <div class="Au-auxilioUser">
                                            <div class="postOwnerImage">
                                                <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                            </div>

                                            <div class="postUserNames">
                                                <p class="postOwnerName"><?php echo htmlspecialchars($dadosPublicacao['nomeCompleto']); ?></p>
                                                <p class="postOwnerUser"><?php echo htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?></p>
                                            </div>

                                            <button name="followUser" class="Au-follow confirmBtn">Seguir</button>
                                        </div>

                                        <p class="Au-textPost"><?php echo htmlspecialchars($dadosPublicacao['conteudo']); ?></p>

                                        <div class="Au-childPostSection">
                                            <div class="Au-childrenName">
                                                <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageImageIcon active" alt="Ícone de Criança">
                                                <p class="Au-childName">Nome da Criança</p>
                                            </div>

                                            <div class="postsImages">
                                                <p>+</p>
                                            </div>

                                            <div class="Au-postExtraInfos">
                                                <div class="Au-extraInfos">
                                                    <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/local_icon.png" class="pageImageIcon active" alt="Ícone de Local">
                                                    <p><?php echo htmlspecialchars($dadosPublicacao['estado']); ?></p>
                                                </div>
                                                <div class="Au-extraInfos">
                                                    <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pix_icon.png" class="pageImageIcon active" alt="Ícone de Pix">
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

            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>

        <?php include_once ("../../app/includes/modais.php");?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>        
            document.addEventListener('DOMContentLoaded', function() {
                openAuxilioModal();
            });    

            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }

            document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => b.querySelector('.postFunctionsModal').classList.toggle('close'));

        </script>   
    </body>
</html>