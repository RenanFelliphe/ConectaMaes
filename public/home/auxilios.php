<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location:/ConectaMaesProject/public/login.php");
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
        <section class="Au-auxilioFilter">
            <h1 class="Au-auxilioRecent Au-auxilioMainFilter active" onclick="toggleAuxilioFilter(this);">Recentes</h1>
            <h1 class="Au-auxilioMain Au-auxilioMainFilter" onclick="toggleAuxilioFilter(this);">Principais</h1>
            <span></span>
        </section>


            <section class="Au-allAuxilios">
                <?php
                    $count = 0;

                    // Consulta inicial para obter todas as publicações usando a função fornecida
                    $auxilios = queryMultiplePosts($conn, "tipoPublicacao = 'Auxilio'", "dataCriacaoPublicacao DESC");

                    if (count($auxilios) > 0) {
                        // Loop para mostrar publicações
                        foreach ($auxilios as $dadosPublicacao) {
                            $postOwner = queryUserData($conn, "Usuario", $dadosPublicacao["idUsuario"]);
                            
                            // Verificar se o link da foto de perfil está presente
                            $profileImage = !empty($postOwner['linkFotoPerfil']) ? $postOwner['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                            
                            // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                            ?>
                            <article class="Au-auxilioCard" onclick="openAuxilioModal();">
                                <ul class="postDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul>

                                <div class="postTimelineTop">
                                    <div class="postOwnerImage">
                                        <img src="<?php echo "/ConectaMaesProject/app/assets/imagens/fotos/perfil/".$postOwner['linkFotoPerfil'];?>">
                                    </div>

                                    <div class="postUserNames">
                                        <p class="postOwnerName">
                                            <?php 
                                                $partesDoNomeCompletoOwner = explode(" ", $postOwner['nomeCompleto']);
                                                $firstNameOwner = $partesDoNomeCompletoOwner[0];
                                                $lastNameOwner = $partesDoNomeCompletoOwner[count($partesDoNomeCompletoOwner) - 1];
                                                
                                                // Concatena a primeira e a última palavra separadas por um espaço
                                                $firstAndLastNameOwner = $firstNameOwner . " " . $lastNameOwner;

                                                echo htmlspecialchars( $firstAndLastNameOwner); 
                                            ?>
                                        </p>
                                        <p class="postOwnerUser">
                                            <?php echo '@' . htmlspecialchars($postOwner['nomeDeUsuario']); ?>
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

                                    <button name ="openAuxilio" class="Au-openAuxilio confirmBtn">Auxiliar</button>
                                </div>

                                <section class="Au-auxilioModalBack close">
                                    <article class="Au-auxilioModal">
                                        <div class="Au-modalHeader">
                                            <ul class="auxilioDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul>
                                            <p class="auxilioTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                            <i class="bi bi-x Au-closeModal" onclick="openAuxilioModal()"></i>
                                        </div>

                                        <div class="Au-auxilioUser">
                                            <div class="postOwnerImage">
                                                <img src="<?php echo "/ConectaMaesProject/app/assets/imagens/fotos/perfil/".$postOwner['linkFotoPerfil'];?>">
                                            </div>

                                            <div class="postUserNames">
                                                <p class="postOwnerName"><?php echo htmlspecialchars($postOwner['nomeCompleto']); ?></p>
                                                <p class="postOwnerUser"><?php echo htmlspecialchars($postOwner['nomeDeUsuario']); ?></p>
                                            </div>

                                            <button name="followUser" class="Au-follow confirmBtn">Seguir</button>
                                        </div>

                                        <p class="Au-textPost"><?php echo htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                                        
                                        <div class="Au-childPostSection">
                                            <div class="Au-childrenName">
                                                <img src="/ConectaMaesProject/app/assets/imagens/icons/pram_icon.png" class="pageImageIcon active" alt="Ícone de Criança">
                                                <p class="Au-childName">Nome da Criança</p>
                                            </div>

                                            <div class="postsImages">
                                                <p>+</p>
                                            </div>

                                            <div class="Au-postExtraInfos">
                                                <div class="Au-extraInfos">
                                                    <img src="/ConectaMaesProject/app/assets/imagens/icons/local_icon.png" class="pageImageIcon active" alt="Ícone de Local">
                                                    <p><?php echo htmlspecialchars($postOwner['estado']); ?></p>
                                                </div>
                                                <div class="Au-extraInfos">
                                                    <img src="/ConectaMaesProject/app/assets/imagens/icons/pix_icon.png" class="pageImageIcon active" alt="Ícone de Pix">
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
        document.addEventListener('DOMContentLoaded', function() {
            openAuxilioModal();
        });    
    </script>   
</body>

</html>