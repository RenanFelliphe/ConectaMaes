<?php
    if (isset($tipoPublicacao)) {
        $publicacoes = queryPostsAndUserData($conn, $tipoPublicacao);
    } else {
        $publicacoes = queryPostsAndUserData($conn, '');
    }

    if (count($publicacoes) > 0) {
        $count = 0;
        
        foreach ($publicacoes as $dadosPublicacao) {
            $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
            ?>
            
            <article class="Ho-post <?php if($tipoPublicacao == 'Auxilio') echo 'Ho-auxilioCard'?>">
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
                        <button class="postComments">
                            <i class="bi bi-chat-fill"></i>
                            <p>0</p>
                        </button>
                        <?php 
                            if ($tipoPublicacao == 'Auxilio') { 
                                echo '<button name="openAuxilio" class="Au-openAuxilio confirmBtn">Auxiliar</button>'; 
                            } 
                        ?>
                    </form>
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
    document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => b.querySelector('.postFunctionsModal').classList.toggle('close'));

    /*
    <?php
    $auxilios = queryPostsAndUserData($conn, 'Auxilio');
    if (count($auxilios) > 0) {
        $count = 0;
        foreach ($auxilios as $dadosPublicacao) {
            // Verificar se o link da foto de perfil está presente
            $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';

            // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
            ?>
            <article class="Ho-post Ho-auxilioCard" onclick="openAuxilioModal();">
                <ul class="postDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul>
                <div class="postTimelineTop">
                    <div class="postOwnerImage">
                        <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                    </div>

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
                </div>

                <p class="postTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>

                <form class="postTimelineBottom"  method='post'>
                    <button class="postLikes <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?>" value="like">
                        <i class="bi bi-heart-fill"></i>
                        <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                    </button>
                    <button class="postComments">
                        <i class="bi bi-chat-fill"></i>
                        <p>0</p>
                    </button>
                    <button name="openAuxilio" class="Au-openAuxilio confirmBtn">Auxiliar</button>
                </form>
            </article>
            <?php
        }
        ?><p class="endTimeline">...</p>
    <?php
    } else {
        ?>
        <p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p>
<?php
}   
?>





<section class="Au-auxilioModalBack close">
    <article class="Au-auxilioModal">
        <div class="Au-modalHeader">
            <ul class="auxilioDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul> 
            <p class="auxilioTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>
            <i class="bi bi-x Au-closeModal" onclick="openAuxilioModal()"></i>
        </div>

        <div class="Au-auxilioUser">
            <div class="postOwnerImage">
                <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
            </div>

            <div class="postUserNames">
                <p class="postOwnerName"><?php echo htmlspecialchars($dadosPublicacao['nomeCompleto']); ?></p>
                <p class="postOwnerUser"><?php echo htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?></p>
            </div>

            <button name="followUser" class="Au-follow confirmBtn">Seguir</button>
        </div>

        <p class="Au-textPost"><?php echo htmlspecialchars($dadosPublicacao['conteudo']); ?></p>

        <div class="Au-childPostSection">
            <div class="Au-childrenName">
                <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageImageIcon active" alt="Ícone de Criança">
                <p class="Au-childName">Nome da Criança</p>
            </div>

            <div class="postsImages">
                <p>+</p>
            </div>

            <div class="Au-postExtraInfos">
                <div class="Au-extraInfos">
                    <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/local_icon.png" class="pageImageIcon active" alt="Ícone de Local">
                    <p><?php echo htmlspecialchars($dadosPublicacao['estado']); ?></p>
                </div>
                <div class="Au-extraInfos">
                    <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pix_icon.png" class="pageImageIcon active" alt="Ícone de Pix">
                    <p>N/a</p>
                </div>
            </div>
            <button name="helpUser" class="Au-help confirmBtn">Auxiliar</button>
        </div>

        <form class="postInteractions"  method='post'>
            <span></span>
            <button class="postLikes <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?>" value="like">
                <i class="bi bi-heart-fill"></i>
                <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
            </button>

            <h3>Comentários</h3>

            <span></span>

            <div class="postComments">
                <i class="bi bi-heart-fill"></i>
                <p>0</p>
            </div>
            <span></span>
        </form>
    </article>
</section>
    */
</script>