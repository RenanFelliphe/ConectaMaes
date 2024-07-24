<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    require_once "../app/services/crud/userFunctions.php"; 
    require_once "../app/services/crud/postFunctions.php";
    require_once '../app/services/helpers/dateChecker.php';
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
        <title>ConectaMães - Home</title>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">

        <?php include_once ("../app/includes/headerHome.php");?>

        <main class="Ho-Main mainSystem">
            <section class="asideLeft">
                <img src="" class="backCells cellsLeft">
            </section>

            <section class="timeline">
                <form class="Ho-postSomething" method="post" enctype="multipart/form-data">
                    <div class="Ho-postTop">
                        <a class="Ho-userProfileImage" href="<?php echo $relativePublicPath; ?>/home/perfil.php">
                            <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$currentUserData['linkFotoPerfil'];?>">
                        </a>

                        <div class="Ho-postText">
                            <textarea name="conteudoEnvio" id="postText" cols="65" rows="3" class="Ho-postTextContent" placeholder="Como você está se sentindo?" oninput="postCharLimiter()"></textarea>
                            <div class="Ho-characters">
                                <span class="Ho-charactersNumber">0</span>/<span class="Ho-maxCharacters">200</span>
                            </div>
                        </div>
                    </div>

                    <div class="Ho-postBottom">
                        <div class="Ho-extraInputs">
                            <div class="Ho-imageInput">
                                <input type="file" id="Ho-imageSelector" name="linkAnexoEnvio" accept="image/*" onchange="addPost()">
                                <label for="Ho-imageSelector">
                                    <i class="bi bi-images Ho-iconLabel"></i>
                                    <p> Imagem </p>
                                </label>
                            </div>
                        </div>

                        <button type="submit" value="submit" name="postPostagem" class="Ho-submitBtn confirmBtn">Postar</button>
                    </div>

                    <div class="Ho-postAttachments">
                        <span class="Ho-preview"></span>
                    </div>
                    <?php
                        if(isset($_POST['postPostagem'])){
                            sendPost($conn,"Postagem", $currentUserData['idUsuario']);
                        }
                    ?>
                </form>

                <?php
                    $publicacoes = queryPostsAndUserData($conn,'');
                    if (count($publicacoes) > 0) {
                        $count = 0;

                        // Otimização do processamento de likes
                        if ($likedPost = array_keys($_POST, 'like', true)) {
                            $postId = str_replace('like_', '', $likedPost[0]); // Extrai o ID da publicação
                            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId); // Lida com o like
                        }

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
                                                    $firstAndLastNameOwner = $firstNameOwner . " " . $lastNameOwner; // Concatena a primeira e a última palavra separadas por um espaço
                                                    echo htmlspecialchars($firstAndLastNameOwner); 
                                                ?>
                                            </p>
                                            <p class="postOwnerUser">
                                                <?php echo '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?>
                                            </p>
                                        </div>
                    
                                        <div class="postInfo">
                                            <ul class="postDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul>
                                            <div class="bi bi-three-dots postMoreButton"></div>
                                        </div>
                                    </div>
                    
                                    <div class="postTitles">  
                                        <p class="postTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                        <p class="textPost"><?php echo htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                                    </div>
                    
                                    <form class="postTimelineBottom" method='post'>
                                        <button class="postLikes" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?> " value="like">
                                            <i class="bi bi-heart-fill <?= queryUserLike($conn,$currentUserData['idUsuario'],$dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>"></i>
                                            <p><?php echo htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                        </button>
                                        <button class="postComments"type ="submit" name="comment">
                                            <i class="bi bi-chat-fill"></i>
                                            <p>0</p>
                                        </button>
                                    </form>
                                </div>
                            </article>
                            <?php
                            $count++;
                            // A cada 50 publicações, mostrar "sugestões"
                            /* if ($count % 50 == 0) {
                                echo "Sugestões<br><br>";
                            } */
                        }
                        echo "FIM...<br>";
                    } else {
                        echo "Nenhuma publicação encontrada<br>";
                    }      
                    ?>
            </section>

            <section class="asideRight">
                <div class="searchBar">
                    <i class="bi bi-search"></i>
                    <input type="search" class="searchBarInput" placeholder="Pesquisar">
                </div>

                <div class="asideRightFooter">
                    <a href="<?php echo $relativeRootPath."/index.php"?>">Sobre o ConectaMães</a>
                    <a href="<?php echo $relativePublicPath."/suporte.php"?>">Suporte</a>
                    <a href="">Termos de Privacidade</a>
                    <a href="">CEFET-MG</a>
                    <h4>ConectaMães do CEFET-MG | 2024</h4>
                </div>
            </section>
        </main>

        <?php include_once ("../app/includes/modais.php");?>
        
        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>        
            toggleTheme();
        </script>
    </body>
</html>
