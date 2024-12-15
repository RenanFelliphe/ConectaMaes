<?php 
    include_once __DIR__ . "/../../app/includes/globalIncludes.php";

    if (isset($_GET['post'])) {
        $postResult = queryPostsAndUserData($conn, "", $_GET['post'], null, 1);
        if (!$postResult || count($postResult) === 0) {
            header("Location:". $relativeRootPath."/notFound.php?subject=post");
            exit;
        }
        $dadosConteudoComentado = $postResult[0];
        $tipoConteudo = 'Publicação';
    } else if (isset($_GET['comment'])) {
        $commentResult  = queryCommentsData($conn, "", $_GET['comment'], 1);  // Ou o que for adequado para buscar por comentário
        if (!$commentResult || count($commentResult) === 0) {
            header("Location:". $relativeRootPath."/notFound.php?subject=comment");
            exit;
        }
        $dadosConteudoComentado = $commentResult[0];
        $tipoConteudo = 'Comentário';
    } else {
        header("Location:". $relativeRootPath."/notFound.php");
        exit;
    } 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Comentários</title>
    </head>

    <body class="<?= htmlspecialchars($currentUserData['tema']); ?>">
        <?php include_once ("../../app/includes/headerHome.php"); ?>

        <main class="Ho-Main Co-Main mainSystem">
            <?php include_once ("../../app/includes/asideLeft.php"); ?>

            <section class="timeline">
                <div class="Co-mainPost">
                    <div class="Co-timelineHeader">  
                        <a href="javascript:window.history.back();"><i class="bi bi-arrow-left-circle"></i></a>
                        <h1><?= $tipoConteudo === 'Comentário' ? 'Comentário' : 'Publicação'; ?></h1>
                    </div>

                    <?php
                        if ($tipoConteudo === 'Publicação') {
                            $tipoPublicacao = '';
                            $publicacoes[0] = $dadosConteudoComentado;
                            include("../../app/includes/posts.php"); // Carrega a publicação
                        } else {
                            $showReplies = isset($dadosComentario);  // Apenas mostrar respostas se já estivermos em um comentário específico
                            $dadosComentario = $dadosConteudoComentado;
                            if (!isset($wasMainCommentDisplayed)) {
                                include("../../app/includes/comments.php");
                                $wasMainCommentDisplayed = true;
                            }
                        }
                    ?>

                <?php 
                    $postLink = $tipoConteudo === 'Publicação' ? 'postComentarioModal' : 'postNestedComentarioModal';
                    $dataPostId = $tipoConteudo === 'Publicação' ? $dadosPublicacao['idPublicacao'] : $dadosComentario['idComentario'];
                ?>
                <button type="submit" class="commentBtnn confirmBtn" 
                    data-type="postSomething" 
                    data-post-id="<?= $dataPostId; ?>" 
                    post-link="<?= $postLink; ?>" 
                    onclick="openModalHeader(this);"
                    <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                    Comentar
                </button>
                </div>
                <div class="Co-allComents">
                    <?php
                        $showReplies = true;
                        include ("../../app/includes/comments.php"); 
                    ?>
                </div>
            </section>

            <?php include_once ("../../app/includes/asideRight.php"); ?>
        </main>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => {
                b.querySelector('.postFunctionsModal').classList.toggle('close');
            });
        </script>
    </body>
</html>