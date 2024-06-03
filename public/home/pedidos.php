<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location:/ConectaMaesProject/public/login.php");
    require_once "../../app/services/crud/userFunctions.php"; 
    $currentUserData = unitQuery($conn, "Usuario", $_SESSION['idUsuario']);   
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/variable.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/style.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/include.css">
    <link rel="icon" href="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Pedidos</title>
    </meta>
</head>

<body class="B-theme">

    <?php include_once ("../../app/includes/headerHome.php");?>

    <main class="Ho-Main mainSystem">
        <section class="asideLeft">
            <img src="" class="backCells cellsLeft">
        </section>

        <section class="timeline">
            <form class="Ho-postSomething">
                <div class="Ho-postTop">
                    <a class="Ho-userProfileImage" href="profile.php">
                        <img src="/ConectaMaesProject/app/assets/imagens/fotos/perfil/<?php echo $currentUserData['user'] . '-' . $currentUserData['dataNascimento'] . '-perfil.'."png";?>" alt="Foto de perfil do usuário">
                    </a>
    
                    <div class="Ho-postText">
                        <div class="Ho-postTitle">
                            <label for="Ho-postTitleInput">Título:</label>
                            <input type="text" id="Ho-postTitleInput" class="Ho-postTitleInput" oninput="postTitleCharLimiter()">
                            <div class="Ho-titleCharacters">
                                <span class="Ho-titleCharactersNumber">0</span>/<span class="Ho-maxTitleCharacters">20</span>
                            </div>
                        </div>
                        
                        <textarea name="" id="" cols="62" rows="3" class="Ho-postTextContent" placeholder="Encontrou uma dificuldade? Peça ajuda!" oninput="postCharLimiter()"></textarea>
                        <div class="Ho-characters">
                            <span class="Ho-charactersNumber">0</span>/<span class="Ho-maxCharacters">20</span>
                        </div>
                    </div>
                </div>

                <div class="Ho-postBottom">
                    <div class="Ho-extraInputs">
                        <div class="Ho-imageInput">
                            <input type="file" id="Ho-imageSelector" accept="image/*">
                            <label for="Ho-imageSelector">
                                <i class="bi bi-images Ho-iconLabel"></i>
                                <p> Imagem </p>
                            </label>
                        </div>
        
                        <div class="Ho-maxColabsInput">
                            <label for="Ho-maxColabsInput"><i class="bi bi-chat-heart-fill Ho-iconLabel"></i></label>
                            <input type="number" id="Ho-maxColabsInput" min="0" placeholder="Colaboradores">
                        </div>

                        <div class="Ho-tagInput">
                            <label for="tagInput"><i class="bi bi-tags-fill Ho-iconLabel"></i></label>
                            <input type="text" id="tagInput" placeholder="Tags">
                        </div>
                    </div>
    
                    <div class="Ho-submitArea">
                        <div class="Ho-submitPost">
                            <button type="submit" value="submit" class="Ho-submitBtn">Pedir</button>
    
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
            </form>
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

    <script src="/ConectaMaesProject/app/assets/js/pedidos.js"></script>
    <script>        
        toggleTheme();
    </script>
</body>

</html>