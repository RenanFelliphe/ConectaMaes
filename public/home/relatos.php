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
</head>
<body>
<?php include_once ("../../app/includes/headerHome.php");?>

<main class="Ho-Main">
        <section class="asideLeft"></section>

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

        <section class="asideRight"></section>
    </main>
</html>