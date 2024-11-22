<section class="asideRight">
    <?php 
        $resultAuxilios = specificPostQuery($conn, "titulo, isConcluido", "tipoPublicacao = 'Auxilio' AND idUsuario = '".$currentUserData['idUsuario']."'", "ORDER BY dataCriacaoPublicacao DESC");
        $totalAuxilios = mysqli_num_rows($resultAuxilios); // Contar o total de auxílios
        $qa = 0;

        $resultPeople = queryNotFollowed($conn, $currentUserData['idUsuario'], $order = "ORDER BY dataCriacaoUsuario DESC LIMIT 3");
    ?>
    
    <!--
    <div class="searchBar">
        <i class="bi bi-search"></i>
        <input type="search" class="searchBarInput" placeholder="Pesquisar">
    </div>
    -->

    <div class="myAuxilios">
        <h2 class="myAuxTitle">Meus Auxílios</h2>
        <?php if($totalAuxilios > 3){?>
            <p id="verTodosBtn">Ver todos</p>    
        <?php }?>
        
        <ul class="auxiliosAside">
            <?php
                // Itera sobre os resultados e exibe cada auxílio
                while ($row = mysqli_fetch_assoc($resultAuxilios)) {
                    $qa++;
            ?>
                <li class="auxilioListItem <?= $q > 3 ? 'hidden' : ''; ?>" id="auxilioAside<?= $q;?>">
                    <div class="comentarios">
                        <i class="bi bi-chat-fill"></i>
                        <span class="quantComentarios">0</span>
                    </div>
                    <div class="titulo"><?= $row['titulo']; ?></div>
                    <span class="estado">
                        <?php 
                            if($row['isConcluido'] == 0){
                                echo "Aberto";
                            } else {
                                echo "Concluído";
                            }
                        ?>
                    </span>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>

    <div class="mySuggestions">
        <h2 class="mySuggestionsTitle">Sugestões</h2>
        
        <div class="sugesttionsAside">
            <?php
                foreach($resultPeople as $userSuggestion) {
                    if (!isUserFollowingProfile($conn, $currentUserData['idUsuario'], $userSuggestion['idUsuario'])) {
            ?>
            <form method="post" class="suggestionListItem" id="suggestionAside<?= $userSuggestion['idUsuario']; ?>" >
                <div class="suggestionInfos">
                    <div class="suggestionImageProfile">
                        <?php 
                            echo renderProfileLink($relativePublicPath, $relativeAssetsPath . "/imagens/fotos/perfil/" . $profileImage, $userSuggestion['nomeDeUsuario'], $isRelatoAnonimo);
                        ?>
                    </div>
                    <input type="hidden" name="toFollowId" value="<?= $userSuggestion['idUsuario']; ?>"> 
                    <div class="suggestUserNames">
                        <p class="userName"><?= $userSuggestion['nomeCompleto']?></p>
                        <p class="userNick"><?= '@' . $userSuggestion['nomeDeUsuario']?></p>
                    </div>
                </div>
                <button type="submit" class="followSuggestion confirmBtn" name="followSuggestedProfile">Seguir</button>
            </form>
            <?php
                    }
                }
            ?>
        </div>
    </div>

    
    <div class="asideRightFooter">
        <div>
            <a href="<?= $relativeRootPath."/index.php"?>">Sobre o ConectaMães</a>
            <a href="<?= $relativePublicPath."/suporte.php"?>">Suporte</a>
            <a href="">Termos de Privacidade</a>
            <a href="">CEFET-MG</a>
        </div>
        <h4>ConectaMães do CEFET-MG | 2024</h4>
    </div>
</section>

<script>
document.getElementById('verTodosBtn').addEventListener('click', function(e) {
    e.preventDefault();

    var btn = e.target;
    var hiddenItems = document.querySelectorAll('.myAuxilios .auxilioListItem.hidden');
    var allItems = document.querySelectorAll('.myAuxilios .auxilioListItem');

    if (btn.textContent === 'Ver todos') {
        hiddenItems.forEach(function(item) {
            item.classList.remove('hidden');
        });
        btn.textContent = 'Ver menos';
    } else {
        allItems.forEach(function(item, index) {
            if (index >= 3) {
                item.classList.add('hidden');
            }
        });
        btn.textContent = 'Ver todos';
    }
});

</script>