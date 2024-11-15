<?php
// Verifica se dados de uma publicação específica foram passados ou faz a consulta de todas as publicações
if (isset($dadosPublicacao)) {
    $publicacoes = [$dadosPublicacao]; // Transforma em array para manter a estrutura do foreach
} else {
    $tipoPublicacao = $tipoPublicacao ?? '';
    $publicacoes = queryPostsAndUserData($conn, $tipoPublicacao);    
}

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
            $postLink = ($tipoPublicacao != 'Auxilio') 
                ? $relativePublicPath . "/home/comentarios.php?user=" . $dadosPublicacao['nomeDeUsuario'] ."&post=".$dadosPublicacao['idPublicacao']
                : '#';
        }
        ?>
        <article class="Ho-post <?= $tipoPublicacao == 'Auxilio' ? 'Ho-auxilioCard' : '' ?>" data-link="<?= htmlspecialchars($postLink); ?>">
            <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
            <?php 
                if ($tipoPublicacao != 'Auxilio') 
                    echo renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage, $dadosPublicacao['nomeDeUsuario'], $isRelatoAnonimo);
            ?>
            <div class="postContent">
                <div class="postTimelineTop">
                    <?php 
                        if ($tipoPublicacao == 'Auxilio') 
                            echo renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage, $dadosPublicacao['nomeDeUsuario']);
                    ?>
                    <a class="postUserNames" href="<?= $isRelatoAnonimo ? '#' : htmlspecialchars($relativePublicPath . "/home/perfil.php?user=" . urlencode($dadosPublicacao['nomeDeUsuario'])); ?>">
                        <p class="postOwnerName">
                            <?php 
                                if ($isRelatoAnonimo) {
                                    echo "Usuário Anônimo " . htmlspecialchars(anonUsername($conn, $dadosPublicacao['nomeDeUsuario']));
                                } else {
                                    $partesDoNomeCompletoOwner = explode(" ", $dadosPublicacao['nomeCompleto']);
                                    $firstAndLastNameOwner = $partesDoNomeCompletoOwner[0] . " " . end($partesDoNomeCompletoOwner);
                                    echo htmlspecialchars($firstAndLastNameOwner); 
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
                    </a>

                    <div class="postInfo" >
                        <?php if($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario']){ ?>
                            <div class="bi bi-three-dots postMoreButton">
                                <form class="postFunctionsModal close" method="POST">
                                    <!-- <button class="reportPostButton bi bi-megaphone-fill pageIcon" name="denunciarPost"> Denunciar Postagem </button> -->
                                    <?php if ($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario']) { ?>
                                        <input type="hidden" name="deleterId" value="<?= $dadosPublicacao['idPublicacao']; ?>">
                                        <button class="deletePostButton bi bi-trash3-fill pageIcon" name="deletarPost" type="submit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>> Deletar Postagem</button>
                                    <?php } ?>
                                </form>                                      
                            </div>
                        <?php } ?>                         
                    </div>
                </div>

                <div class="postTexts">  
                    <p class="postTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                    <?php if ($tipoPublicacao !== 'Auxilio') { ?>
                        <p class="postFullText"><?= htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
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
                        data-type="postSomething" 
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
            if (event.target.closest('.postMoreButton') || event.target.closest('.postFunctionsModal')) {
                event.stopPropagation();
            } else if(event.target.closest('.postComment')){
                event.stopPropagation();
            } else {
                window.location.href = article.getAttribute('data-link');
            }
        });
    });

    document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => {
        b.querySelector('.postFunctionsModal').classList.toggle('close');
    });

</script>
