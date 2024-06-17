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
            <section>

            </section>
            <section class="Au-allAuxilios">
                <?php
                    $count = 0;

                    // Consulta inicial para obter todas as publicações usando a função fornecida
                    $auxilios = queryMultiplePosts($conn, "Publicacao", "tipoPublicacao = 'Auxilio'", "dataCriacaoPublicacao DESC");

                    if (count($auxilios) > 0) {
                        // Loop para mostrar publicações
                        foreach ($auxilios as $dadosPublicacao) {
                            $postOwner = queryUserData($conn, "Usuario", $dadosPublicacao["idUsuario"]);
                            // Verificar se o link da foto de perfil está presente
                            $profileImage = !empty($postOwner['linkFotoPerfil']) ? $postOwner['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                            ?>
                            <article class="Au-auxilioCard">
                                <ul class="postDate"><li><?php echo htmlspecialchars($dadosPublicacao["dataCriacaoPublicacao"]); ?></li></ul>

                                <div class="postTimelineTop">
                                    <div class="postOwnerImage">
                                        <img src="<?php echo htmlspecialchars($profileImage); ?>">
                                    </div>

                                    <div class="postUserNames">
                                        <p class="postOwnerName"><?php echo htmlspecialchars($postOwner['nomeCompleto']); ?></p>
                                        <p class="postOwnerUser"><?php echo htmlspecialchars($postOwner['nomeDeUsuario']); ?></p>
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

                                    <button name ="openAuxilio" class="Au-openAuxilio">Auxiliar</button>
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

                        //criar html para 
                        echo "FIM...<br>";
                    } else {
                        //criar html para 
                        echo "Nenhuma publicação encontrada<br>";
                    }
                ?>
            </section>
            
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
    </main>

    <?php include_once ("../../app/includes/modais.php");?>

    <script src="/ConectaMaesProject/app/assets/js/system.js"></script>
    <script>        
        toggleTheme();
    </script>
</body>

</html>