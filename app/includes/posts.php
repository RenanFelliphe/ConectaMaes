<?php
if (count($publicacoes) > 0) {        
    foreach ($publicacoes as $dadosPublicacao) {
        $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'default.png';
        $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);

        $isRelatoAnonimo = ($dadosPublicacao['tipoPublicacao'] == "Relato" && $dadosPublicacao['isAnonima'] == 1);
        
        if ($isRelatoAnonimo && $currentUserData['idUsuario'] == 1) {
            continue;
        }
        
        if ($isRelatoAnonimo) {
            $profileImage = 'anonymous.png';
            $postLink = $relativePublicPath . "/home/comentarios.php?anonUser=" . anonUsername($conn, $dadosPublicacao['nomeDeUsuario']) ."&post=".$dadosPublicacao['idPublicacao'];
        } else {
            $postLink = ($dadosPublicacao['tipoPublicacao'] != 'Auxilio') 
                ? $relativePublicPath . "/home/comentarios.php?user=" . $dadosPublicacao['nomeDeUsuario'] ."&post=".$dadosPublicacao['idPublicacao']
                : null;
        }
        ?>
        <article data-id="<?= $dadosPublicacao['idPublicacao'] ?>" class="Ho-post <?= $dadosPublicacao['tipoPublicacao'] == 'Auxilio' ? 'Ho-auxilioCard' : '' ?>"  <?= $postLink ? 'data-link="' . htmlspecialchars($postLink) . '"' : '' ?>  <?= $dadosPublicacao['tipoPublicacao'] == 'Auxilio' ? 'data-type="auxilioModal" onclick="toggleModal(this);"' : '' ?>>
            <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
            <?php 
                if ($dadosPublicacao['tipoPublicacao'] != 'Auxilio') 
                    echo renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage, $dadosPublicacao['nomeDeUsuario'], $isRelatoAnonimo);
            ?>
            <div class="postContent">
                <div class="postTimelineTop">
                    <?php 
                        if ($dadosPublicacao['tipoPublicacao'] == 'Auxilio') 
                            echo renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage, $dadosPublicacao['nomeDeUsuario']);
                    ?>
                    <div class="postUserNames" href="<?= $isRelatoAnonimo ? '#' : htmlspecialchars($relativePublicPath . "/home/perfil.php?user=" . urlencode($dadosPublicacao['nomeDeUsuario'])); ?>">
                        <p class="postOwnerName">
                            <?php 
                                if ($isRelatoAnonimo) {
                                    echo "Usuário Anônimo " . htmlspecialchars(anonUsername($conn, $dadosPublicacao['nomeDeUsuario']));
                                } else {
                                    echo htmlspecialchars(getFirstAndLastName($dadosPublicacao['nomeCompleto'])); 
                                }
                            ?>
                        </p>
                        <p class="postOwnerUser">
                            <?php 
                                if ($isRelatoAnonimo) {
                                    echo '@anonUser' . htmlspecialchars(anonUsername($conn, $dadosPublicacao['nomeDeUsuario']));
                                } else {
                                    echo '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); 
                                }
                            ?>
                        </p>
                    </div>

                    <div class="postInfo" >
                        <?php if(($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario'] || $currentUserData['isAdmin']) && $dadosPublicacao['tipoPublicacao'] != "Auxilio"){ ?>
                            <div class="bi bi-three-dots postMoreButton">
                                <form class="postFunctionsModal close" method="POST">
                                    <!-- <button class="reportPostButton  pageIcon" name="denunciarPost">
                                        <i class="bi bi-megaphone-fill"></i>
                                        <p>Denunciar Postagem</p>
                                    </button> -->
                                    <?php if ($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario'] || $currentUserData['isAdmin']) { ?>
                                        <input type="hidden" name="deleterId" value="<?= $dadosPublicacao['idPublicacao']; ?>">
                                        <button class="deletePostButton pageIcon" name="deletarPost" type="submit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                                            <i class="bi bi-trash3-fill"></i>
                                            <p>Deletar Postagem</p>
                                        </button>
                                    <?php } ?>
                                </form>                                      
                            </div>
                        <?php } ?>                         
                    </div>
                </div>

                <div class="postTexts">  
                    <p class="postTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                    <?php if ($dadosPublicacao['tipoPublicacao'] !== 'Auxilio') { ?>
                        <p class="postFullText"><?= htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                        <?php if($dadosPublicacao['linkAnexo'] != ''){?>
                                <div class="postImageContainer">
                                    <img src="<?= $relativeAssetsPath."/imagens/fotos/anexos/".$dadosPublicacao['linkAnexo'];?>" alt="Anexo da Publicação <?=$dadosPublicacao['idPublicacao'];?>" class="postImage">
                                </div>
                        <?php }?>
                    <?php } ?>
                </div>

                <div class="postTimelineBottom">
                    <form method="POST">
                        <button class="postLikes <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked';
                        ?>" type="submit" name="like_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>" value="like" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?> >
                            <i class="bi bi-heart-fill"></i>
                            <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                        </button>
                    </form>
                    <button class="postComment" type="button" post-link="postComentarioModal" data-post-id="<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>" 
                        data-type="postSomething" onclick="openModalHeader(this);"                         
                        name="comment_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>" 
                        value="comment"  
                        onclick="openModalHeader(this);"
                        <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>
                        >
                        <i class="bi bi-chat-fill"></i>
                        <p><?= htmlspecialchars($dadosPublicacao['totalComments']); ?></p>
                    </button>
                </div>
            </div>

            <?php include __DIR__ . "/../includes/auxiliosModal.php";?>
        </article>
        <?php
    }
    ?>
    <p class="endTimeline">...</p>

    <?php
} else {
    ?><p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p><?php
}
?>
                                
<script>
    document.querySelectorAll('article[data-link]').forEach(article => {
        article.addEventListener('click', function(event) {
            if (event.target.closest('.postMoreButton') || 
                event.target.closest('.postFunctionsModal') || 
                event.target.closest('.postComment')){
                event.stopPropagation();
            } else {
                window.location.href = article.getAttribute('data-link');
            }
        });
    });

    document.querySelectorAll('.postMoreButton').forEach(b => {
        b.onclick = (event) => {
            event.stopPropagation();
            b.querySelector('.postFunctionsModal').classList.toggle('close');
        };
    });

    document.querySelectorAll('.postComment').forEach(commentButton => {
        commentButton.addEventListener('click', (event) => {
            event.stopPropagation();
        });
    });

</script>
