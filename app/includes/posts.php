<?php
    if (isset($tipoPublicacao)) {
        $publicacoes = queryPostsAndUserData($conn, $tipoPublicacao);    
    } else {
        $publicacoes = queryPostsAndUserData($conn, '');    
    }

    if (count($publicacoes) > 0) {        
        foreach ($publicacoes as $dadosPublicacao) {
            $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);

            // Definir o link para comentários caso o tipo não seja 'Auxilio'
            $postLink = ($tipoPublicacao != 'Auxilio') 
                ? $relativePublicPath . "/home/comentarios.php?post=" . $dadosPublicacao['idPublicacao'] ."&type=".$dadosPublicacao['tipoPublicacao']
                : '#';  // Manter um link vazio se for 'Auxilio'
            ?>
            
            <!-- Se o tipo de publicação não for 'Auxilio', o article se torna um link (a) -->
            <?php if ($tipoPublicacao != 'Auxilio'): ?>
                <a href="<?= htmlspecialchars($postLink); ?>" class="Ho-post <?= ($tipoPublicacao == 'Auxilio') ? 'Ho-auxilioCard' : ''; ?>">
            <?php else: ?>
                <article class="Ho-post <?= ($tipoPublicacao == 'Auxilio') ? 'Ho-auxilioCard' : ''; ?>">
            <?php endif; ?>

                <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
                <?php 
                    if ($tipoPublicacao != 'Auxilio') {
                        echo '<a class="postOwnerImage" href="' . htmlspecialchars($relativePublicPath . "/home/perfil.php?user=" . urlencode($dadosPublicacao['nomeDeUsuario'])) . '">
                                <img src="' . htmlspecialchars($relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage) . '">
                            </a>';
                    }
                ?>
                <div class="postContent">
                    <div class="postTimelineTop">
                        <?php 
                            if ($tipoPublicacao == 'Auxilio') {
                                echo '<a class="postOwnerImage" href="' . htmlspecialchars($relativePublicPath . "/home/perfil.php?user=" . urlencode($dadosPublicacao['nomeDeUsuario'])) . '">
                                        <img src="' . htmlspecialchars($relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage) . '">
                                    </a>';
                            }
                        ?>
                        <a class="postUserNames" href="<?= htmlspecialchars($relativePublicPath . "/home/perfil.php?user=" . urlencode($dadosPublicacao['nomeDeUsuario'])); ?>">
                            <p class="postOwnerName">
                                <?php 
                                    $partesDoNomeCompletoOwner = explode(" ", $dadosPublicacao['nomeCompleto']);
                                    $firstNameOwner = $partesDoNomeCompletoOwner[0];
                                    $lastNameOwner = $partesDoNomeCompletoOwner[count($partesDoNomeCompletoOwner) - 1];
                                    $firstAndLastNameOwner = $firstNameOwner . " " . $lastNameOwner;
                                    echo htmlspecialchars($firstAndLastNameOwner); 
                                ?>
                            </p>
                            <p class="postOwnerUser"><?= '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?></p>
                        </a>

                        <div class="postInfo" >
                            <div class="bi bi-three-dots postMoreButton">
                                <form class="postFunctionsModal close" method="POST">
                                    <button class="reportPostButton bi bi-megaphone-fill pageIcon" name="denunciarPost"> Denunciar Postagem</button>
                                    <?php if($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario']) { ?>
                                        <input type="hidden" name="deleterId" value="<?= $dadosPublicacao['idPublicacao']; ?>">
                                        <button class="deletePostButton bi bi-trash3-fill pageIcon" name="deletarPost" type="submit"> Deletar Postagem</button>
                                    <?php } ?>
                                </form>       
                                <?php
                                    if (isset($_POST['deletarPost'])) {
                                        deletePost($conn, $_POST['deleterId']);
                                    }
                                ?>                                     
                            </div>                         
                        </div>
                    </div>

                    <div class="postTexts">  
                        <p class="postTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                        <?php 
                            if ($tipoPublicacao <> 'Auxilio') { 
                                echo '<p class="postFullText">' . htmlspecialchars($dadosPublicacao['conteudo']) . '</p>'; 
                            } 
                        ?>

                    </div>

                    <form class="postTimelineBottom" method="POST">
                        <button class="postLikes <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?>" value="like">
                            <i class="bi bi-heart-fill"></i>
                            <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                        </button>

                        <?php 
                            if ($tipoPublicacao == 'Auxilio') { 
                                echo '<button name="openAuxilio" class="Au-openAuxilio confirmBtn">Auxiliar</button>'; 
                            } 
                        ?>
                    </form>
                </div>
            <?php if ($tipoPublicacao != 'Auxilio'): ?>
                </a> <!-- Fechar o link (a) se o tipo não for 'Auxilio' -->
            <?php else: ?>
                </article> <!-- Fechar o article se for 'Auxilio' -->
            <?php endif; ?>
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
    document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => b.querySelector('.postFunctionsModal').classList.toggle('close'));
</script>
