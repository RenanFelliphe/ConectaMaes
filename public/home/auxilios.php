<?php 
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    require_once "../../app/services/crud/userFunctions.php"; 
    require_once "../../app/services/crud/postFunctions.php";
    require_once '../../app/services/helpers/dateChecker.php';
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);   
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Auxílios</title>
        </meta>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main Au-main mainSystem">
            <section class="asideLeft">
                <img src="" class="backCells cellsLeft">
            </section>

            <section class="timeline">
                <section class="Ho-postFilter">
                    <h1 class="Ho-postRecent Ho-mainFilters active" onclick="toggleAuxilioFilter(this);">Recentes</h1>
                    <h1 class="Ho-postMain Ho-mainFilters" onclick="toggleAuxilioFilter(this);">Principais</h1>
                </section>

                <section class="Au-allAuxilios container container-products row">
                    <?php
                    $auxilios = queryPostsAndUserData($conn, 'Auxilio');
                    if (count($auxilios) > 0) {
                        $count = 0;
                        foreach ($auxilios as $dadosPublicacao) {
                            // Verificar se o link da foto de perfil está presente
                            $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';

                            // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                            ?>
                            <article class="Au-auxilioCard col-12 col-sm-6 col-md-4 col-lg-3" onclick="openAuxilioModal();"> <!-- Coloquei as classes de colunas -->
                                <ul class="postDate">
                                    <li><?php echo htmlspecialchars($mensagemData); ?></li>
                                </ul>

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

                                <div class="postTimelineBottom">
                                    <div class="postInteractions">
                                        <div class="postLikes">
                                            <i class="bi bi-heart-fill"></i>
                                            <p>0</p>
                                        </div>
                                        <div class="postComments">
                                            <i class="bi bi-chat-fill"></i>
                                            <p>0</p>
                                        </div>
                                    </div>

                                    <button name="openAuxilio" class="Au-openAuxilio confirmBtn">Auxiliar</button>
                                </div>

                                <section class="Au-auxilioModalBack close">
                                    <article class="Au-auxilioModal">
                                        <div class="Au-modalHeader">
                                            <ul class="auxilioDate">
                                                <li><?php echo htmlspecialchars($mensagemData); ?></li>
                                            </ul>
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

                                        <div class="postInteractions">
                                            <span></span>
                                            <div class="postLikes">
                                                <i class="bi bi-chat-fill"></i>
                                                <p>0</p>
                                            </div>

                                            <h3>Comentários</h3>

                                            <span></span>

                                            <div class="postComments">
                                                <i class="bi bi-heart-fill"></i>
                                                <p>0</p>
                                            </div>
                                            <span></span>
                                        </div>
                                    </article>
                                </section>
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
                </section>
            </section>

            <section class="asideRight">
                <div class="searchBar">
                    <i class="bi bi-search"></i>
                    <input type="search" class="searchBarInput" placeholder="Pesquisar">
                </div>

                <div class="myAuxilios">
                    <h2 class="myAuxTitle">Meus Auxílios</h2>
                    <ul class="auxiliosAside">
                        <?php
                            // Chama a função para obter todos os auxílios (sem limite aqui)
                            $result = specificPostQuery($conn, "titulo, isConcluido", "tipoPublicacao = 'Auxilio' AND idUsuario = '".$currentUserData['idUsuario']."'", "ORDER BY dataCriacaoPublicacao DESC");
                            $q = 0;

                            // Itera sobre os resultados e exibe cada auxílio
                            while ($row = mysqli_fetch_assoc($result)) {
                                $q++;
                        ?>
                            <li class="auxilioListItem <?php echo $q > 3 ? 'hidden' : ''; ?>" id="auxilioAside<?= $q;?>">
                                <div class="comentarios">
                                    <i class="bi bi-chat-fill"></i>
                                    <span class="quantComentarios">0</span>
                                </div>
                                <div class="titulo"><?php echo $row['titulo']; ?></div>
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
                    <div class="verMaisAuxilios">
                        <a href="#" id="verTodosBtn">Ver todos</a>
                    </div>
                </div>
                
                <div class="asideRightFooter">
                    <div>
                        <a href="<?php echo $relativeRootPath."/index.php"?>">Sobre o ConectaMães</a>
                        <a href="<?php echo $relativePublicPath."/suporte.php"?>">Suporte</a>
                        <a href="">Termos de Privacidade</a>
                        <a href="">CEFET-MG</a>
                    </div>
                    <h4>ConectaMães do CEFET-MG | 2024</h4>
                </div>
            </section>
        </main>

        <?php include_once ("../../app/includes/modais.php");?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>        
            document.addEventListener('DOMContentLoaded', function() {
                openAuxilioModal();
            });    

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
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </body>
</html>