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
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Relatos</title>
        </meta>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main mainSystem">
            <section class="asideLeft">
                <img src="" class="backCells cellsLeft">
            </section>

            <section class="timeline">
                <section class="Ho-postFilter">
                    <h1 class="Ho-postRecent Ho-mainFilters active" onclick="toggleAuxilioFilter(this);">Recentes</h1>
                    <h1 class="Ho-postMain Ho-mainFilters" onclick="toggleAuxilioFilter(this);">Principais</h1>
                </section>

                <?php
                    $publicacoes = queryPostsAndUserData($conn, 'Relato');
                    if (count($publicacoes) > 0) {
                        $count = 0;
                        foreach ($publicacoes as $dadosPublicacao) {
                            // Verificar se o link da foto de perfil está presente
                            $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                    
                            // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                            ?>
                            <article class="Ho-post">
                                <div class="postOwnerImage">
                                    <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                </div>
                    
                                <div class="postContent">
                                    <div class="postTimelineTop">
                                        <div class="postUserNames">
                                            <p class="postOwnerName">
                                                <?php 
                                                    $partesDoNomeCompletoOwner = explode(" ", $dadosPublicacao['nomeCompleto']);
                                                    $firstNameOwner = $partesDoNomeCompletoOwner[0];
                                                    $lastNameOwner = $partesDoNomeCompletoOwner[count($partesDoNomeCompletoOwner) - 1];
                                                    
                                                    // Concatena a primeira e a última palavra separadas por um espaço
                                                    $firstAndLastNameOwner = $firstNameOwner . " " . $lastNameOwner;
                    
                                                    echo htmlspecialchars( $firstAndLastNameOwner); 
                                                ?>
                                            </p>
                                            <p class="postOwnerUser">
                                                <?php echo '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?>
                                            </p>
                                        </div>
                    
                                        <div class="postInfo">
                                            <ul class="postDate"><li><?= htmlspecialchars($mensagemData); ?></li></ul>
                                            <div class="bi bi-three-dots postMoreButton">
                                                <form class="postFunctionsModal close" method = "POST">
                                                <button class="reportPostButton bi bi-megaphone-fill pageIcon" name = "denunciarPost" onclick=""> Denunciar Postagem</button>
                                                    <?php if($currentUserData['idUsuario'] == $dadosPublicacao['idUsuario']){?>
                                                        <input type="hidden" name = "deleterId" value="<?= $dadosPublicacao['idPublicacao']?>">
                                                        <button class="deletePostButton bi bi-trash3-fill pageIcon" name = "deletarPost" type = "submit"> Deletar Postagem</button>
                                                    <?php } ?>
                                                </form>       
                                                <?php
                                                    if(isset($_POST['deletarPost'])){
                                                        deletePost($conn, $_POST['deleterId']);
                                                    }
                                                ?>                                     
                                            </div>                         
                                        </div>
                                    </div>
                    
                                    <div class="postTitles">  
                                        <p class="postTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                        <p class="textPost"><?php echo htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                                    </div>
                    
                                    <div class="postTimelineBottom">
                                        <div class="postLikes">
                                            <i class="bi bi-heart-fill"></i>
                                            <p><?php echo htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                        </div>
                                        <div class="postComments">
                                            <i class="bi bi-chat-fill"></i>
                                            <p>0</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                    
                            <?php
                            $count++;
                    
                            /* A cada 50 publicações, mostrar "sugestões"
                                if ($count % 50 == 0) {
                                    echo "Sugestões<br><br>";
                                }
                            */
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

            <?php include_once ("../../app/includes/asideRight.php");?>
        </main>

        <?php include_once ("../../app/includes/modais.php");?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            //Abre as funções de um post
            document.querySelectorAll('.postMoreButton').forEach(b => b.onclick = () => b.querySelector('.postFunctionsModal').classList.toggle('close'));

            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </body>
</html>