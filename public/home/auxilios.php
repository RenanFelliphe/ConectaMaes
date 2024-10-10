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
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

                <section class="Au-allAuxilios container">
    <div class="row justify-content-evenly">
        <?php
        $auxilios = queryPostsAndUserData($conn, 'Auxilio');
        if (count($auxilios) > 0) {
            foreach ($auxilios as $dadosPublicacao) {
                $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                ?>
                <article class="Au-auxilioCard col-12 col-sm-6 col-md-4 col-lg-3">
                    <!-- Conteúdo do Card -->
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
                            <p class="postOwnerUser"><?php echo '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?></p>
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
                </article>
                <?php
            }
            ?>
            <p class="endTimeline">...</p>
        <?php
        } else {
            ?>
            <p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p>
        <?php
        }
        ?>
    </div>
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
    </body>
</html>