<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location:/ConectaMaesProject/public/login.php");
    require_once "../app/services/crud/userFunctions.php"; 
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
    <title>ConectaMães - Home</title>
</head>

<body>
    <?php include_once ("../app/includes/headerHome.php");?>

    <main class="Ho-Main">
        <section class="asideLeft">
            <img src="../app/assets/imagens/figuras/cells_standart_full_pink.png<?php echo $currentUserData['tema'];?>.png" class="cellsInSystem">
        </section>

        <section class="timeline">
            <form class="Ho-postSomething">
                <div class="Ho-postLeft">
                    <a class="Ho-userProfileImage" href="profile.php">
                        <img src="/ConectaMaesProject/app/assets/imagens/fotos/<?php echo $currentUserData['linkFotoPerfil']; ?>"
                            alt="Foto de perfil do usuário">
                    </a>
                    <span class="H-characters"><span class="H-charactersNumber">0</span>/<span
                            class="H-maxCharacters">200</span></span>
                </div>

                <div class="Ho-postCenter">
                    <input type="text" class="postTextContent"
                        placeholder="Como você está se sentindo? Compartilhe sua experiência!"
                        oninput="postCharLimiter()">
                </div>

                <div class="imageInput">
                    <input type="file" id="imageSelector" accept="image/*">
                    <label for="imageSelector">
                        <img src="/ConectaMaesProject/app/assets/imagens/icons/icons8-adicionar-imagem-96.png" alt="">
                        <p> Adicionar Imagem </p>
                    </label>
                    <span class="preview"></span>
                </div>

                <div class="tagsInput">
                    <img src="" alt="Ícone de Etiqueta">
                    <input type="search" id="" placeholder="Tags">
                </div>

                <div class="dropdown">
                    <button class="dropbtn">Postar</button>
                    <div class="dropdown-content">
                        <a href="#">Postar</a>
                        <a href="#">Relatar</a>
                        <a href="#">Pedir</a>
                    </div>
                </div>
                <span class="sensivel"><input type="checkbox" name="sensivel" class="checkboxSensivel">Conteúdo
                    sensível</span>
            </form>

            <article class="post"></article>
        </section>

        <section class="asideRight">
            <div class="searchBar">
                <i class="bi bi-search"></i>
                <input type="search" class="searchBarInput" placeholder="Pesquisar">
            </div>

            <div class="followSuggestion">
                <h1>Sugestões</h1>
                <div class="suggestionContainer">
                    <div class="suggestedFollower">
                        <div class="suggestedUserInfo">
                            <h3>
                                <?php
                                    echo "Nome Usuário Sugerido 1";
                                ?>
                            </h3>
                            <small>
                                <?php
                                    echo "@"."Usuário Sugerido 1";
                                ?>
                            </small>
                        </div>
                        <button class="followSuggestedButton">Seguir</button>
                    </div>

                    <div class="suggestedFollower">
                        <div class="suggestedUserInfo">
                            <h3>
                                <?php
                                    echo "Nome Usuário Sugerido 2";
                                ?>
                            </h3>
                            <small>
                                <?php
                                    echo "@"."Usuário Sugerido 2";
                                ?>
                            </small>
                        </div>
                        <button class="followSuggestedButton">Seguir</button>
                    </div>

                    <div class="suggestedFollower">
                        <div class="suggestedUserInfo">
                            <h3>
                                <?php
                                    echo "Nome Usuário Sugerido 3";
                                ?>
                            </h3>
                            <small>
                                <?php
                                    echo "@"."Usuário Sugerido 3";
                                ?>
                            </small>
                        </div>
                        <button class="followSuggestedButton">Seguir</button>
                    </div>
                </div>
            </div>

            <div class="asideRightFooter">
                <a href="">Sobre o ConectaMães</a>
                <a href="">Suporte</a>
                <a href="">Termos de Privacidade</a>
                <a href="">CEFET-MG</a>
                <h5>© 2024 ConectaMães do CEFET-MG</h5>
            </div>
        </section>
    </main>

    <script src="/ConectaMaesProject/app/assets/js/home.js"></script>

</html>