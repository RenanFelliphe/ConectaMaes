<?php                                 
    $allComentarios = queryCommentsData($conn, $dadosPublicacao['idPublicacao']);
                 
    if ($allComentarios && count($allComentarios) > 0) {
        foreach ($allComentarios as $comentario) {
            $commentProfileImage = !empty($comentario['linkFotoPerfil']) ? $comentario['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
            $commentData = postDateMessage($comentario["dataCriacaoComentario"]);
            ?>
            
            <article class="Ho-post">
                <ul class="postDate"><li><?= htmlspecialchars($commentData); ?></li></ul>

                <div class="postOwnerImage">
                    <img src="<?= $relativeAssetsPath . "/imagens/fotos/perfil/" . htmlspecialchars($commentProfileImage); ?>">
                </div>

                <div class="postContent">
                    <div class="postTimelineTop">
                        <div class="postUserNames">
                            <p class="postOwnerName">
                                <?= getFirstAndLastName($comentario['nomeCompleto']);?>
                            </p>
                            <p class="postOwnerUser">
                                <?= '@' . htmlspecialchars($comentario['nomeDeUsuario']); ?>
                            </p>
                        </div>

                        <div class="postInfo" >
                            <?php if($currentUserData['idUsuario'] == $comentario['idUsuario'] || $currentUserData['isAdmin']){ ?>
                                <div class="bi bi-three-dots postMoreButton">
                                    <form class="postFunctionsModal close" method="POST">
                                        <!-- <button class="reportPostButton bi bi-megaphone-fill pageIcon" name="denunciarComentario"> Denunciar Comentário </button> -->
                                        <?php if ($currentUserData['idUsuario'] == $comentario['idUsuario'] || $currentUserData['isAdmin']) { ?>
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
        }
    }
?>