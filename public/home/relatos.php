<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location:/ConectaMaesProject/public/login.php");
    require_once "../../app/services/crud/userFunctions.php"; 
    require_once "../../app/services/crud/postFunctions.php";
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);   
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/style.css">
    <link rel="icon" href="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
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
            <form class="Ho-postSomething" method="post">
                <div class="Ho-postTop">
                    <a class="Ho-userProfileImage" href="/ConectaMaesProject/public/home/perfil.php">
                        <img src="">
                    </a>
    
                    <div class="Ho-postText">
                        <div class="Ho-postTitle">
                            <label for="Ho-postTitleInput">Título:</label>
                            <input type="text" id="Ho-postTitleInput" name="tituloEnvio" class="Ho-postTitleInput" oninput="postTitleCharLimiter()">
                            <div class="Ho-titleCharacters">
                                <span class="Ho-titleCharactersNumber">0</span>/<span class="Ho-maxTitleCharacters">50</span>
                            </div>
                        </div>

                        <textarea name="conteudoEnvio" id="" cols="62" rows="3" class="Ho-postTextContent" placeholder="Compartilhe sua experiência!" oninput="postCharLimiter()"></textarea>
                        <div class="Ho-characters">
                            <span class="Ho-charactersNumber">0</span>/<span class="Ho-maxCharacters">200</span>
                        </div>
                    </div>
                </div>

                <div class="Ho-postBottom">
                    <div class="Ho-extraInputs">
                        <div class="Ho-imageInput">
                            <input type="file" id="Ho-imageSelector" name="linkAnexoEnvio" accept="image/*">
                            <label for="Ho-imageSelector">
                                <i class="bi bi-images Ho-iconLabel"></i>
                                <p> Imagem </p>
                            </label>
                        </div>
                    </div>
    
                    <div class="Ho-submitArea">
                        <div class="Ho-submitPost">
                            <button type="submit" value="submit" name ="postRelato" class="Ho-submitBtn">Postar</button>
    
                            <div class="Ho-postStyle">
                                <i class="bi bi-caret-down-fill"></i>
                            </div>
                        </div>
        
                        <div class="Ho-sensitiveContent">
                            <input type="checkbox" name="sensitiveContent" id="sensitiveContent" class="Ho-sensitiveCheckbox">
                            <label for="sensitiveContent">Conteúdo sensível</label>
                        </div>
                    </div>
                </div>

                <div class="Ho-postAttachments">
                    <span class="Ho-preview"></span>
                </div>
                <?php
                if(isset($_POST['postRelato'])){
                    sendPost($conn,"Relato", $currentUserData['idUsuario']);
                }
                ?>
            </form>
            <?php
                $count = 0;
                $id = 1;

                // Loop para mostrar publicações
                while (true) {
                    $stmt = $conn->prepare("SELECT * FROM Publicacao WHERE idPublicacao = ? AND tipoPublicacao = 'Relato'");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Exibir a publicação
                        $dadosPublicacao = $result->fetch_assoc();
                        $postOwner = queryUserData($conn, "Usuario", $dadosPublicacao["idUsuario"]);
                        ?>
                            <article class="Ho-relato">
                                <div class="postTimelineTop">
                                    <div class="postOwnerInfo">
                                        <div class="postOwnerImage"></div>
                                        <div class="postOwnerName"><?php echo $postOwner['nomeCompleto'];?></div>
                                        <div class="postOwnerUser"><?php echo $postOwner['nomeDeUsuario'];?></div>
                                    </div>
                                    
                                    <div class="postMoreButton"></div>
                                </div>
                                <div class="postTimelineContent">
                                    <h3 class="postTitle"><?php echo $dadosPublicacao['titulo'];?></h3>
                                    <p class="textPost"><?php echo $dadosPublicacao['conteudo']?></p>
                                </div>
                                <div class="postTimelineBottom">
                                    <div class="postLikes"></div>
                                    <div class="postComments"></div>
                                </div>
                                
                            </article>
                        <?php
                        $count++;

                        // A cada 50 publicações, mostrar "sugestões"
                        if ($count % 50 == 0) {
                            echo "Sugestões<br><br>";
                        }
                    }

                    $id++;

                    // Verificar se existem mais publicações
                    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM Publicacao WHERE idPublicacao >= ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $totalRestante = $row['total'];

                    if ($totalRestante == 0) {
                        echo "Seu feed acabou<br>";
                        break;
                    }
                }
            ?>
        </section>

        <section class="asideRight">
            <div class="searchBar">
                <i class="bi bi-search"></i>
                <input type="search" class="searchBarInput" placeholder="Pesquisar">
            </div>

            <div class="asideRightFooter">
                <a href="">Sobre o ConectaMães</a>
                <a href="">Suporte</a>
                <a href="">Termos de Privacidade</a>
                <a href="">CEFET-MG</a>
                <h4>© 2024 ConectaMães do CEFET-MG</h4>
            </div>
        </section>
    </main>

    <script src="/ConectaMaesProject/app/assets/js/system.js"></script>
    <script>        
        toggleTheme();
    </script>
</body>

</html>