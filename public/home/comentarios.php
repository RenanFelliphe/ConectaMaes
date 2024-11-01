<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    $post = isset($_GET['post']) ? true : header("Location:". $relativeRootPath."/notFound.php");

    require_once "../../app/services/crud/userFunctions.php"; 
    require_once "../../app/services/crud/postFunctions.php";
    require_once '../../app/services/helpers/dateChecker.php';

    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);  

    $postResult = specificPostQuery($conn, "idPublicacao, tipoPublicacao, conteudo, linkAnexo, titulo, isAnonima, isConcluido, dataCriacaoPublicacao, idUsuario, nomeCompleto, nomeDeUsuario, linkFotoPerfil, totalLikes", "idPublicacao = " . intval($_GET['post']), "");

    /*if (!$postResult || mysqli_num_rows($postResult) === 0) {
        if ($postResult === false) {
            echo "<p class='error'>Erro na consulta: " . mysqli_error($conn) . "</p>";
        }
        header("Location:" . $relativeRootPath . "/notFound.php");
        exit;
    }*/

    // Processar $_POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($likedPost = array_keys($_POST, 'like', true)) {
            $postId = str_replace('like_', '', $likedPost[0]); // Extrai o ID da publicação
            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId); // Lida com o like
        }

        if (isset($_POST['deletarPost'])) {
            deletePost($conn, $_POST['deleterId']);
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
        <title>ConectaMães - Relatos</title>
    </head>

    <body class="<?php echo htmlspecialchars($currentUserData['tema']); ?>">
        <?php include_once ("../../app/includes/headerHome.php"); ?>

        <main class="Ho-Main Co-Main mainSystem">
            <?php include_once ("../../app/includes/asideLeft.php"); ?>

            <section class="timeline">
                <section class="Ho-postFilter">
                    <h1 class="Ho-postRecent Ho-mainFilters active" onclick="toggleAuxilioFilter(this);">Postagem Específica</h1>
                </section>

                <?php
                    $dadosPublicacao = mysqli_fetch_assoc($postResult);
                    if ($dadosPublicacao) {
                        $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                        $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                        ?>
                        <article class="Ho-post">
                            <div class="postOwnerImage">
                                <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$profileImage; ?>">
                            </div>

                            <div class="postContent">
                                <div class="postTimelineTop">
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

                                    <div class="postInfo">
                                        <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
                                        <div class="bi bi-three-dots postMoreButton">
                                            <form class="postFunctionsModal close" method="POST">
                                                <button class="reportPostButton bi bi-megaphone-fill pageIcon" name="denunciarPost"> Denunciar Postagem</button>
                                                <?php if ($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario']) { ?>
                                                    <input type="hidden" name="deleterId" value="<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>">
                                                    <button class="deletePostButton bi bi-trash3-fill pageIcon" name="deletarPost" type="submit"> Deletar Postagem</button>
                                                <?php } ?>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="postTitles">
                                        <p class="postTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                        <p class="textPost"><?php echo htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                                    </div>

                                    <form class="postTimelineBottom" method='post'>
                                        <button class="postLikes" type="submit" name="like_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>" value="like">
                                            <i class="bi bi-heart-fill <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>"></i>
                                            <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                        </button>
                                        <div class="postComments">
                                            <i class="bi bi-chat-fill"></i>
                                            <p>0</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </article>
                        <?php
                    } else {
                        ?><p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p><?php
                    }
                ?>
            </section>

            <?php include_once ("../../app/includes/asideRight.php"); ?>
        </main>

        <?php include_once ("../../app/includes/modais.php"); ?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </body>
</html>
