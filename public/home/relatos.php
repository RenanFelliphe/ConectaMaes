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
            <title>ConectaMães - Relatos</title>
        </meta>
    </head>

    <body>
        <?php include_once ("../../app/includes/headerHome.php");?>

        <main class="Ho-Main">
            <section class="asideLeft">
                <img src="/ConectaMaesProject/app/assets/imagens/figuras/CellsFull<?php echo $currentUserData['tema'];?>.png" class= "cellsHome">
            </section>

                <section class="timeline">
                    <form class="Ho-postSomething">
                        <div class="Ho-postLeft">
                            <a class="Ho-userProfileImage" href="profile.php">
                                <img src="/ConectaMaesProject/app/assets/imagens/fotos/Renan-Moura.png" alt="Foto de Perfil do Usuário">
                            </a>
                            <span class="H-characters"><span class="H-charactersNumber">0</span>/<span class="H-maxCharacters">20</span></span>
                        </div>

                        <div class="Ho-postCenter">
                            <select name="postStyleSelect" id="postStyle" class="postStyle">
                                <option value="">Padrão</option>
                                <option value="" selected>Relato</option>
                            </select>

                            <input type="text" class="postTextContent" placeholder="Como você está se sentindo? Compartilhe sua experiência!" oninput="postCharLimiter()">
                        </div>
                        
                        <div class="imageInput">
                            <input type="file" id="imageSelector" accept="image/*">
                            <label for="imageSelector">
                                <img src="/ConectaMaesProject/app/assets/imagens/icons/icons8-adicionar-imagem-96.png" alt="">
                                <p> Adicionar Imagem </p>
                            </label>
                            <span class="preview"></span>
                        </div>

                        <button type="submit" value="submit">Postar</button>
                    </form>
                </section>

                <section class="asideRight">
            <div class="searchBar">
                <img src="/ConectaMaesProject/app/assets/imagens/icons/search.png" alt="Símbolo de Lupa">
                <input class="input" type="search" placeholder="Pesquisar"/>
            </div>

            <div class="followSuggestion">
                <h1>Sugestões</h1>
                <div class="suggestionContainer">
                    <div class="suggestedFollower">
                        <h3>
                            <?php
                                echo "Nome de Usuário Sugerido 1";
                            ?>
                        </h3>
                        <button>Seguir</button>
                    </div>

                    <div class="suggestedFollower">
                        <h3>
                            <?php
                                echo "Nome de Usuário Sugerido 2";
                            ?>
                        </h3>
                        <button>Seguir</button>
                    </div>

                    <div class="suggestedFollower">
                        <h3>
                            <?php
                                echo "Nome de Usuário Sugerido 3";
                            ?>
                        </h3>
                        <button>Seguir</button>
                    </div>
                </div>
            </div>
        </section>
        </main>
    </body>
</html>