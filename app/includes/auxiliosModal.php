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
                                <input type="hidden" name="identifierId" value="<?= $dadosPublicacao['idPublicacao']; ?>">
                                <button class="deletePostButton pageIcon" name="deletarPost" type="submit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                                    <i class="bi bi-trash3-fill"></i>
                                    <p>Deletar Postagem</p>
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
            <?= renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage, $dadosPublicacao['nomeDeUsuario']);
            ?>

            <div class="postOwner">
                <div class="postOwnerName">
                    <?= htmlspecialchars(getFirstAndLastName($dadosPublicacao['nomeCompleto'])); ?>
                    <p class="postOwnerUser"><?= '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?></p>
                </div>    
                <div class="followersNumber">
                    <span class="followers"><?= getFollowingCount($conn, $dadosPublicacao['idUsuario']); ?></span>
                    <p>Seguidores</p>
                </div>                        
            </div>

            <?php if($currentUserData['idUsuario'] != $dadosPublicacao['idUsuario']) {?>
                <form method="POST">
                    <button name="followProfile" class="Au-follow confirmBtn" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                        <p>Seguir</p>
                    </button>
                </form>                    
            <?php } ?>

        </div>

        <p class="auxilioTitle"><?= htmlspecialchars($dadosPublicacao['titulo']); ?></p>
        <p class="Au-textPost"><?= htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
        
        <div class="Au-postExtraInfos">
            <div class="Au-extraInfos">
                <img src="<?= $relativeAssetsPath; ?>/imagens/icons/local_icon.png" class="pageImageIcon active" alt="Ícone de Local">
                <p id="localizacaoDisplay"></p>
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
                        <img src="<?= $relativeAssetsPath . "/imagens/fotos/anexos/" . $dadosPublicacao['linkAnexo'];?>" alt="Anexo da Publicação <?=$dadosPublicacao['idPublicacao'];?>">
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
                    <input type="hidden" name="idPublicacao" id="postIdField" value="">
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
                        <button type="submit" value="submit" name="postComentarioModalAuxilio" class="confirmBtn"> Comentar </button>
                    </div>
                    <?php
                        if(isset($_POST['postComentarioModalAuxilio'])){
                            sendComment($conn, $dadosPublicacao['idPublicacao'], $currentUserData['idUsuario']);
                        }
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
    const cep = "<?= htmlspecialchars($dadosPublicacao['estado']); ?>";  // O valor do CEP
    const localizacaoElement = document.getElementById('localizacaoDisplay');

    // Função para buscar os dados de CEP na API do ViaCEP
    async function buscarLocalizacao(cep) {
        try {
            // Fazendo a requisição para a API do ViaCEP
            const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
            
            // Verifica se a resposta é válida
            if (!response.ok) {
                throw new Error("Erro ao consultar o CEP.");
            }

            // Parse da resposta JSON
            const data = await response.json();

            // Verifica se a API retornou erro (CEP não encontrado)
            if (data.erro) {
                localizacaoElement.innerHTML = "CEP não encontrado.";
            } else {
                // Exibe a cidade e o estado no formato 'Cidade, UF'
                localizacaoElement.innerHTML = `${data.localidade}, ${data.uf}`;
            }
        } catch (error) {
            // Caso ocorra algum erro, exibe uma mensagem
            localizacaoElement.innerHTML = "Erro ao buscar a localização.";
            console.error(error);
        }
    }

    // Chama a função passando o CEP
    buscarLocalizacao(cep);
</script>
