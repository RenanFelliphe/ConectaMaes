<?php 
    include_once __DIR__ . "/../../app/includes/globalIncludes.php";
    $post = isset($_GET['post']) ? true : header("Location:". $relativeRootPath."/notFound.php");
    $postResult = queryPostsAndUserData($conn, "", $_GET['post'], 1);
    if (!$postResult || count($postResult) === 0) {
        echo "<p class='error'>Postagem não encontrada!</p>";
        exit;
    }
    $dadosPublicacao = $postResult[0];
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
                        <h1>Post</h1>
                    </div>

                    <?php
                        $tipoPublicacao = '';
                        include("../../app/includes/posts.php");
                    ?>

                <button type="submit" class="commentBtnn confirmBtn" 
                    data-type="postSomething" data-post-id="<?= $dadosPublicacao['idPublicacao']; ?>" 
                    post-link="postComentarioModal" onclick="openModalHeader(this);"
                    <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                    Comentar
                </button>
                
                </div>
                <div class="Co-allComents">
                    <?php include ("../../app/includes/comments.php"); ?>
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
