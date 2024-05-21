<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/variable.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" href="assets/Logos/Final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Home</title>
</head>
<body>
    <?php include_once ("php/includes/headerHome.php");?>

    <main class="Ho-Main">
        <section class="asideLeft"></section>

        <section class="timeline">
            <form class="Ho-postSomething">
                <a class="Ho-userProfileImage" href="profile.php">
                    <img src="assets/Fotos/Renan-Moura.png" alt="Foto de Perfil do Usuário">
                </a>
                <input type="text" class="postTextContent" placeholder="Como você está se sentindo? Compartilhe sua experiência!">
                
                <div class="imageInput">
                    <input type="file" id="imageSelector" accept="image/*">
                    <label for="imageSelector">
                        <img src="assets/Icons/icons8-adicionar-imagem-96.png" alt="">
                        <p> Adicionar Imagem </p>
                    </label>
                    
                    <span class="preview"></span>
                </div>

                <button type="submit" value="submit">Postar</button>
            </form>
        </section>

        <section class="asideRight"></section>
    </main>

    <script src="js/home.js"></script>
</html>