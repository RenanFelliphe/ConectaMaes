<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($currentUserData) && isset($_POST['followFromAuxilio'])) {
            $toFollowId = (int) $_POST['idFromAuxilio'];
        
            if ($toFollowId !== $currentUserData['idUsuario'] && $toFollowId !== 1) {
                followUser($conn, $currentUserData['idUsuario'], $toFollowId);
            }
        }
    }
?>

<modal data-id="<?= $dadosPublicacao['idPublicacao']?>" class="modalSection close" data-type="auxilioModal">
    <article class="Au-auxilioModal pageModal">
        <div class="Au-modalHeader">
            <ul class="auxilioDate">
                <li><?= htmlspecialchars($mensagemData); ?></li>
            </ul>
            
            <div class="postInfo" >
                <?php if($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario'] || $currentUserData['isAdmin']){ ?>
                    <div class="bi bi-three-dots postMoreButton">
                        <form class="postFunctionsModal close" method="POST">
                            <!-- <button class="reportPostButton  pageIcon" name="denunciarPost">
                                <i class="bi bi-megaphone-fill"></i>
                                <p>Denunciar Postagem</p>
                            </button> -->
                            <?php 
                                if ($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario'] || $currentUserData['isAdmin']) { 
                            ?>
                                <input type="hidden" name="deleterId" value="<?= $dadosPublicacao['idPublicacao']; ?>">
                                <button class="deletePostButton pageIcon" name="deletarPost" type="submit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                                    <i class="bi bi-trash3-fill"></i>
                                    <p>Deletar Auxílio</p>
                                </button>
                                <?php 
                                    if ($dadosPublicacao['tipoPublicacao'] == "Auxilio" && !$dadosPublicacao['isConcluido']) { 
                                ?>
                                    <button class="concludeAuxilio pageIcon" name="concludePost" type="submit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                                        <i class="bi bi-check-all"></i>
                                        <p>Concluir auxilio</p>
                                    </button>
                            <?php 
                                    } 
                                } 
                            ?>
                        </form>                                      
                    </div>
                <?php } ?>  
                <i class="bi bi-x closeModal" onclick="toggleModal(this)"></i>                       
            </div>
        </div>

        <div class="Au-auxilioUser">
            <?=
                renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage, $dadosPublicacao['nomeDeUsuario']);
            ?>

            <div class="postOwner">
                <div class="postOwnerName">
                    <?= htmlspecialchars(getFirstAndLastName($dadosPublicacao['nomeCompleto'])); ?>
                    <p class="postOwnerUser"><?= '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?></p>
                </div>    
                <div class="followersNumber">
                    <span class="followers"><?= getFollowerCount($conn, $dadosPublicacao['idUsuario']); ?></span>
                    <p>Seguidores</p>
                </div>                        
            </div>


            <?php if($currentUserData['idUsuario'] != $dadosPublicacao['idUsuario']) {
                    $isFollowingAuxilio = isUserFollowingProfile($conn, $currentUserData['idUsuario'], $dadosPublicacao['idUsuario']);
                ?>
                <form method="POST">
                    <input type="hidden" name="idFromAuxilio" value="<?= $dadosPublicacao['idUsuario']; ?>">

                    <button type="submit" name="followFromAuxilio" class="Au-follow confirmBtn <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>">
                        <p><?= $isFollowingAuxilio ? 'Seguindo' : 'Seguir'; ?></p>
                    </button>  
                </form>   
            <?php 
                } 
            ?>         
        </div>

        <p class="auxilioTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>
        <p class="Au-textPost"><?= htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
        
        <div class="Au-postExtraInfos">
            <div class="Au-extraInfos">
                <img src="<?= $relativeAssetsPath; ?>/imagens/icons/local_icon.png" class="pageImageIcon active" alt="Ícone de Local">
                <p id="localizacaoDisplay_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>"></p>
            </div>
            <div class="Au-extraInfos">
                <img src="<?= $relativeAssetsPath; ?>/imagens/icons/pix_icon.png" class="pageImageIcon active" alt="Ícone de Pix">
                <p id="pixKeyDisplay"><?= $dadosPublicacao['chavePix']?></p>
            </div>
        </div>

        <?php
            if($dadosPublicacao['linkAnexo']!=''){
                ?>
                    <div class="postsImages">
                        <div class="auxilioImg">
                            <img src="<?= $relativeAssetsPath . "/imagens/fotos/anexos/" . $dadosPublicacao['linkAnexo'];?>" alt="Anexo da Publicação <?=$dadosPublicacao['idPublicacao'];?>">
                        </div>
                    </div>
                <?php
            }
        ?>
        
        <form class="postInteractions" method="POST">
            <span></span>
            <button class="postComment" type="button" name="comment_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>" value="comment" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                <i class="bi bi-chat-fill"></i>
                <p><?= htmlspecialchars($dadosPublicacao['totalComments']); ?></p>
            </button>

            <h3>Comentários</h3>

            <span></span>
            <button class="postLikes <?= queryUserLike($conn, $currentUserData['idUsuario'], $dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked';
            ?>" type="submit" name="like_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>" value="like" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?> >
                <i class="bi bi-heart-fill"></i>
                <p><?= htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
            </button>
            <span></span>
        </form>

        <div class="Ho-auxiliosComments">
            <?php if(!$dadosPublicacao['isConcluido']){?>
                <form class="Ho-postSomething postAuxilioComent" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idPublicacao" value="<?=$dadosPublicacao['idPublicacao']?>">
                    <div class="Ho-postTop">
                        <a class="Ho-userProfileImage" href="<?= $relativePublicPath; ?>/home/perfil.php">
                            <img src="<?= $relativeAssetsPath . "/imagens/fotos/perfil/" . $currentUserData['linkFotoPerfil'];?>">
                        </a>

                        <div class="Ho-postText">
                            <div class="Ho-postTitle" id="postTitleContainer" style="display: none;">
                                <label for="Ho-postTitleInput">Título:</label>
                                <input type="text" id="Ho-postTitleInput" name="tituloEnvio" class="Ho-postTitleInput" oninput="postTitleCharLimiter()">
                                <div class="Ho-titleCharacters">
                                    <span class="Ho-titleCharactersNumber">0</span>/<span class="Ho-maxTitleCharacters">50</span>
                                </div>
                            </div>
                            
                            <div class="Ho-postMainContent">
                                <textarea name="conteudoEnvio" id="postText" cols="62" rows="3" class="Ho-postTextContent" placeholder="Como você está se sentindo?" style="resize: none;" oninput="postCharLimiter()"></textarea>
                                <div class="Ho-characters">
                                    <span class="Ho-charactersNumber">0</span>/<span class="Ho-maxCharacters">200</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Ho-postBottom">
                        <button type="submit" value="submit" name="postComentarioModalAuxilio" class="confirmBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>> Comentar </button>
                    </div>
                    <?php
                        
                    ?>  
                </form>
            <?php } ?>

            <?php
                include ("../../app/includes/comments.php");
            ?>    
        </div>
    </article>
</modal>
<script>
    const cep_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?> = "<?= htmlspecialchars($dadosPublicacao['estado']); ?>";  // O valor do CEP
    const modalId_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?> = "<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>";  // ID único para cada modal
    const localizacaoElement_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?> = document.getElementById(`localizacaoDisplay_${modalId_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>}`);

    async function buscarLocalizacao(cep_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>, modalId_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>}/json/`);
            if (!response.ok) {
                throw new Error("Erro ao consultar o CEP.");
            }
            const data = await response.json();
            const localizacaoElement_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?> = document.getElementById(`localizacaoDisplay_${modalId_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>}`);
            if (data.erro) {
                localizacaoElement_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>.innerHTML = "CEP não encontrado.";
            } else {
                localizacaoElement_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>.innerHTML = `${data.localidade}, ${data.uf}`;
            }
        } catch (error) {
            const localizacaoElement_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?> = document.getElementById(`localizacaoDisplay_${modalId_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>}`);
            localizacaoElement_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>.innerHTML = "Erro ao buscar a localização.";
            console.error(error);
        }
    }
    buscarLocalizacao(cep_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>, modalId_<?= htmlspecialchars($dadosPublicacao['idPublicacao']); ?>);
</script>
