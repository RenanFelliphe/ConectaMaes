<?php
if (isset($dadosPublicacao)) {
    $allComentarios = queryCommentsData($conn, $dadosPublicacao['idPublicacao'], null);
} else if (isset($dadosComentario)) {
    $allComentarios = queryCommentsData($conn, null, $dadosComentario['idComentario'], 1); 
    $commentsReplies = queryCommentReplies($conn, $dadosComentario['idComentario']); // Carrega as respostas
}

if ($allComentarios && count($allComentarios) > 0) {
    foreach ($allComentarios as $comentario) {
        $commentProfileImage = !empty($comentario['linkFotoPerfil']) ? $comentario['linkFotoPerfil'] : 'default.png';
        $commentData = postDateMessage($comentario["dataCriacaoComentario"]); // Formata a data do comentário

        ?>
        <article class="Ho-post" data-link="<?= $relativePublicPath . "/home/comentarios.php?user=" . $comentario['nomeDeUsuario'] . "&comment=" . $comentario['idComentario']; ?>">
            <ul class="postDate">
                <li><?= htmlspecialchars($commentData); ?></li>
            </ul>

            <div class="postOwnerImage">
                <img src="<?= $relativeAssetsPath . "/imagens/fotos/perfil/" . htmlspecialchars($commentProfileImage); ?>" alt="Imagem de perfil">
            </div>

            <div class="postContent">
                <div class="postTimelineTop">
                    <div class="postUserNames">
                        <p class="postOwnerName"><?= getFirstAndLastName($comentario['nomeCompleto']);?></p>
                        <p class="postOwnerUser"><?= '@' . htmlspecialchars($comentario['nomeDeUsuario']); ?></p>
                    </div>

                    <div class="postInfo">
                        <?php if($currentUserData['idUsuario'] == $comentario['idUsuario'] || $currentUserData['isAdmin']){ ?>
                            <div class="bi bi-three-dots postMoreButton">
                                <form class="postFunctionsModal close" method="POST">
                                    <input type="hidden" name="deleterCommentId" value="<?= $comentario['idComentario']; ?>">
                                    <button class="deletePostButton bi bi-trash3-fill pageIcon" name="deletarComentario" type="submit"> Deletar Comentário</button>
                                </form>
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
                            value="like"
                            <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>
                            >
                        <i class="bi bi-heart-fill"></i>
                        <p><?= htmlspecialchars($comentario['totalCommentLikes']); ?></p>
                    </button>
                </form>
            </div>
        </article>
        <?php

        // Exibe as respostas, se estamos visualizando um comentário específico e se houver respostas
        if (isset($dadosComentario) && $showReplies && isset($commentsReplies) && count($commentsReplies) > 0) {
            echo "<strong>MOSTRANDO RESPOSTAS AGORA!!!</strong>";
            foreach ($commentsReplies as $reply) {
                ?>
                <article class="Ho-post reply" data-link="<?= $relativePublicPath . "/home/comentarios.php?user=" . $reply['nomeDeUsuario'] . "&comment=" . $reply['idComentario']; ?>">
                    <ul class="postDate">
                        <li><?= htmlspecialchars(postDateMessage($reply["dataCriacaoComentario"])); ?></li>
                    </ul>
                    <div class="postOwnerImage">
                        <img src ="<?= $relativeAssetsPath . "/imagens/fotos/perfil/" . htmlspecialchars($reply['linkFotoPerfil']); ?>" alt="Imagem de perfil">
                    </div>
        
                    <div class="postContent">
                        <div class="postTimelineTop">
                            <div class="postUserNames">
                                <p class="postOwnerName"><?= getFirstAndLastName($reply['nomeCompleto']); ?></p>
                                <p class="postOwnerUser"><?= '@' . htmlspecialchars($reply['nomeDeUsuario']); ?></p>
                            </div>
        
                            <div class="postInfo">
                                <?php if ($currentUserData['idUsuario'] == $reply['idUsuario'] || $currentUserData['isAdmin']) { ?>
                                    <div class="bi bi-three-dots postMoreButton">
                                        <form class="postFunctionsModal close" method="POST">
                                            <input type="hidden" name="deleterReplyId" value="<?= $reply['idComentario']; ?>">
                                            <button class="deletePostButton bi bi-trash3-fill pageIcon" name="deletarResposta" type="submit"> Deletar Resposta</button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
        
                        <div class="postTexts">
                            <p class="postFullText"><?= htmlspecialchars($reply['comentarioConteudo']); ?></p>
                        </div>
        
                        <form class="postTimelineBottom" method="POST">
                            <button class="postLikes <?= queryUserCommentLike($conn, $currentUserData['idUsuario'], $reply['idComentario']) ? 'postLiked' : 'postNotLiked'; ?>"
                                    type="submit"
                                    name="commentLike_<?= htmlspecialchars($reply['idComentario']); ?>"
                                    value="like"
                                    <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                                <i class="bi bi-heart-fill"></i>
                                <p><?= htmlspecialchars($reply['totalCommentLikes']); ?></p>
                            </button>
                        </form>
                    </div>
                </article>
                <?php
            }
        }
    }
} else {
    echo "<p>Nenhum comentário encontrado.</p>";
}

?>
<script> 
    function redirectToComment(selector) { document.querySelectorAll(selector).forEach(comment => { 
        comment.addEventListener('click', function() { 
            var link = comment.getAttribute('data-link'); 
            if (link) { 
                window.location.href = link; 
            } 
        }); 
    }); 
} 
    redirectToComment('.Ho-post'); 
</script>
