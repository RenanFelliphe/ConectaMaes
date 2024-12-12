<?php 
    include_once __DIR__ . "/../../app/includes/globalIncludes.php";

    if (isset($_GET['post'])) {
        $postResult = queryPostsAndUserData($conn, "", $_GET['post'], 1);
        if (!$postResult || count($postResult) === 0) {
            echo "<p class='error'>Postagem não encontrada!</p>";
            exit;
        }
        $dadosConteudoComentado = $postResult[0];
        $tipoConteudo = 'Publicação';
    } else if (isset($_GET['comment'])) {
        $commentResult  = queryCommentsData($conn, "", $_GET['comment'], 1);  // Ou o que for adequado para buscar por comentário
        if (!$commentResult || count($commentResult) === 0) {
            echo "<p class='error'>Postagem não encontrada!</p>";
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
                        <a href="../home.php"><i class="bi bi-arrow-left-circle"></i></a>
                        <h1><?= $tipoConteudo === 'Comentário' ? 'Comentário' : 'Publicação'; ?></h1>
                    </div>

                    <?php
                        if ($tipoConteudo === 'Publicação') {
                            $tipoPublicacao = '';
                            $dadosPublicacao = $dadosConteudoComentado;
                            include("../../app/includes/posts.php"); // Carrega a publicação
                        } else {
                            $showReplies = false;
                            $dadosComentario = $dadosConteudoComentado;
                            include("../../app/includes/comments.php"); // Carrega o comentário
                        }
                    ?>

                    <button type="submit" class="commentBtnn confirmBtn" 
                        data-type="postSomething" data-post-id="<?= $dadosPublicacao['idPublicacao']; ?>" 
                        post-link="postComentarioModal" onclick="openModalHeader(this);"
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