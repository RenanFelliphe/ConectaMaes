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
    $postResult = queryPostsAndUserData($conn, "", $_GET['post'], 1);

    if (!$postResult || count($postResult) === 0) {
        echo "<p class='error'>Postagem não encontrada!</p>";
        exit;
    }
    $dadosPublicacao = $postResult[0];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($likedPost = array_keys($_POST, 'like', true)) {
            $postId = str_replace('like_', '', $likedPost[0]);
            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId);
        }

        if (isset($_POST['deletarPost'])) {
            deletePost($conn, $_POST['postDeleterId']);
        }

        if ($likedComment = array_keys($_POST, 'like', true)) {
            $commentId = str_replace('commentLike_', '', $likedComment[0]);
            handleCommentLike($conn, $currentUserData['idUsuario'], (int)$commentId); 
        }
    
        // Verifica se foi enviado para deletar algum comentário
        if (isset($_POST['deletarComentario'])) {
            deleteComment($conn, $_POST['deleterCommentId']);
        }
    }
    

    $allComentarios = queryCommentsData($conn, $dadosPublicacao['idPublicacao']);
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Comentários</title>
    </head>

    <body class="<?php echo htmlspecialchars($currentUserData['tema']); ?>">
        <?php include_once ("../../app/includes/headerHome.php"); ?>

        <main class="Ho-Main Co-Main mainSystem">
            <?php include_once ("../../app/includes/asideLeft.php"); ?>

            <section class="timeline">
                <div class="Co-mainPost">
                    <div class="Co-timelineHeader">  
                        <a href="../home.php"><i class="bi bi-arrow-left-circle"></i></a>
                        <h1>Post</h1>
                    </div>

                    <?php
                        $tipoPublicacao = '';
                        include("../../app/includes/posts.php");
                    ?>

                    <button type="submit" class="commentBtnn confirmBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>> Comentar </button>
                </div>
                <div class="Co-allComents">
                    <?php                      
                        if ($allComentarios && count($allComentarios) > 0) {
                            foreach ($allComentarios as $comentario) {
                                $commentProfileImage = !empty($comentario['linkFotoPerfil']) ? $comentario['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                                $commentData = postDateMessage($comentario["dataCriacaoComentario"]);
                                ?>
                                
                                <article class="Ho-post">
                                    <ul class="postDate"><li><?php echo htmlspecialchars($commentData); ?></li></ul>

                                    <div class="postOwnerImage">
                                        <img src="<?php echo $relativeAssetsPath . "/imagens/fotos/perfil/" . htmlspecialchars($commentProfileImage); ?>">
                                    </div>

                                    <div class="postContent">
                                        <div class="postTimelineTop">
                                            <div class="postUserNames">
                                                <p class="postOwnerName">
                                                    <?php 
                                                        $nomeCompletoComentario = explode(" ", $comentario['nomeCompleto']);
                                                        $firstNameComentario = $nomeCompletoComentario[0];
                                                        $lastNameComentario = $nomeCompletoComentario[count($nomeCompletoComentario) - 1];
                                                        $nomeFinalComentario = $firstNameComentario . " " . $lastNameComentario;
                                                        echo htmlspecialchars($nomeFinalComentario); 
                                                    ?>
                                                </p>
                                                <p class="postOwnerUser">
                                                    <?php echo '@' . htmlspecialchars($comentario['nomeDeUsuario']); ?>
                                                </p>
                                            </div>

                                            <div class="postInfo" >
                                                <?php if($currentUserData['idUsuario'] == $comentario['idUsuario']){ ?>
                                                    <div class="bi bi-three-dots postMoreButton">
                                                        <form class="postFunctionsModal close" method="POST">
                                                            <!-- <button class="reportPostButton bi bi-megaphone-fill pageIcon" name="denunciarComentario"> Denunciar Comentário </button> -->
                                                            <?php if ($currentUserData['idUsuario'] == $comentario['idUsuario']) { ?>
                                                                <input type="hidden" name="deleterCommentId" value="<?= $comentario['idComentario']; ?>">
                                                                <button class="deletePostButton bi bi-trash3-fill pageIcon" name="deletarComentario" type="submit"> Deletar Comentário</button>
                                                            <?php } ?>
                                                        </form>
                                                    
                                                        <?php
                                                            if (isset($_POST['deletarPost'])) {
                                                                deletePost($conn, $_POST['deleterId']);
                                                            }
                                                        ?>                                     
                                                    </div>
                                                <?php } ?>                         
                                            </div>
                                        </div>

                                        <div class="postTexts">  
                                            <p class="postFullText"><?= htmlspecialchars($comentario['comentarioConteudo']); ?></p>
                                        </div>

                                        <form class="postTimelineBottom" method="POST">
                                            <button class="postLikes <?= queryUserCommentLike($conn, $currentUserData['idUsuario'], $comentario['idComentario']) ? 'postLiked' : 'postNotLiked'; ?>" 
                                                    type="submit" 
                                                    name="commentLike_<?= htmlspecialchars($comentario['idComentario']); ?>" 
                                                    value="like">
                                                <i class="bi bi-heart-fill"></i>
                                                <p><?= htmlspecialchars($comentario['totalCommentLikes']); ?></p>
                                            </button>
                                        </form>

                                    </div>
                                </article>
                                <?php
                            }
                        }
                    ?>
                </div>
            </section>

            <?php include_once ("../../app/includes/asideRight.php"); ?>
        </main>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => {
                b.querySelector('.postFunctionsModal').classList.toggle('close');
            });
        </script>
    </body>
</html>
