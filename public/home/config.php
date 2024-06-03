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

<body class="Y-theme">
    <?php include_once ("../../app/includes/headerHome.php");?>

    <main class="Ho-Main Se-main mainSystem">
        <section class="Se-asideLeft">
            <img src="" class="backCells cellsLeft">
        </section>

        <section class="Se-settingsCenter">
            <div class="Se-centerHeader">  
                <i class="bi bi-arrow-left-circle"></i>
                <h1>Configurações</h1>
            </div>
            <div class="Se-centerSections">
                <div class="Se-sectionTitle active">
                    <div>
                        <img src="../../app/assets/imagens/icons/user_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p> Informações da Conta</p>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>

                <div class="Se-sectionTitle">
                    <div>
                        <img src="../../app/assets/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p> Informações dos Filhos</p>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>

                <div class="Se-sectionTitle">
                    <div>
                        <img src="../../app/assets/imagens/icons/chat_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p> Interações com outros usuários</p>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>

                <div class="Se-sectionTitle">
                    <div>
                        <img src="../../app/assets/imagens/icons/notifications_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p> Notificações</p>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>

                <div class="Se-sectionTitle">
                    <div>
                        <img src="../../app/assets/imagens/icons/conectamaes_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p> Sobre o ConectaMães</p>
                    </div>
                    <i class="bi bi-box-arrow-up-right"></i>
                </div>

                <div class="Se-sectionTitle">
                    <div>
                        <img src="../../app/assets/imagens/icons/support_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p> Suporte</p>
                    </div>
                    <i class="bi bi-box-arrow-up-right"></i>
                </div>
            </div>

        </section>

        <section class="Se-asideRight infoAccount">
            <div class="Se-accountInformations">
                <div class="Se-sectionHeader">
                    <i class="bi bi-person-fill pageIcon"></i>                    
                    <h1>Informações da Conta</h1>
                </div>
                <div class="Se-userInfo">
                    <div class="Re-addImageProfile">
                        <div class="Re-userImageProfile">
                            <img src="/ConectaMaesProject/app/assets/imagens/fotos/perfil/<?php echo $currentUserData['user'] . '-' . $currentUserData['dataNascimento'] . '-perfil.'."png";?>" alt="" class="Re-userImage">
                        </div>

                        <input type="file" id="imagesSelector" name="linkFotoPerfilRegistro" accept="image/*">
                        <label for="imagesSelector" class="Re-addImageIcon">                        
                            <i class="bi bi-camera-fill"></i>                    
                        </label>
                    </div>

                    <div class="Re-userInfoContainer">
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Nome:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Usuário:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Email:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Telefone:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Data de Nascimento:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                    </div>
                </div>

                <form class="Se-editInfo">
                    <div class="Se-userInput full-width">
                        <input type="text" id="nomeUsuario" name="userRegistro" required>
                        <label class="Re-fakePlaceholder" for="nomeUsuario">Nome Completo</label>
                        <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                    </div>
                    <div class="Se-userInput full-width">
                        <textarea name="biografiaUsuarioRegistro" id="biografiaUsuario" cols="54" rows="4" required></textarea>                        
                        <label class="Re-fakePlaceholder" for="biografiaUsuario">Biografia</label>
                        <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                    </div>
                    <div class="Se-userInput full-width">
                        <input type="text" id="nomeUsuario" name="userRegistro" required>
                        <label class="Re-fakePlaceholder" for="nomeUsuario">Localização</label>
                        <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                    </div>
                    <div class="Se-userInput side-by-side">
                        <input type="text" id="nomeUsuario" name="userRegistro" required>
                        <label class="Re-fakePlaceholder" for="nomeUsuario">Nome de Usuário</label>
                        <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                    </div>
                    <div class="Se-userInput side-by-side">
                        <input type="text" id="nomeUsuario" name="userRegistro" required>
                        <label class="Re-fakePlaceholder" for="nomeUsuario">Email</label>
                        <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                    </div>
                    <div class="Se-userInput side-by-side">
                        <input type="text" id="nomeUsuario" name="userRegistro" required>
                        <label class="Re-fakePlaceholder" for="nomeUsuario">Senha</label>
                        <i class="bi bi-pencil-fill Se-editIcon pageIcon "></i>                    
                    </div>
                    <div class="Se-userInput side-by-side">
                        <input type="text" id="nomeUsuario" name="userRegistro" required>
                        <label class="Re-fakePlaceholder" for="nomeUsuario">Telefone</label>
                        <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                    </div>

                    <div class="Se-themeInfo">
                        <p> Tema: </p>
                        <div class="Se-themeOptions">
                            <input type="radio" name="temaRegistro" value="Amarelo" id="Se-yellowTheme">
                            <label for="Se-yellowTheme"> Amarelo </label>
                            <input type="radio" name="temaRegistro" value="Azul" id="Se-blueTheme">
                            <label for="Se-blueTheme"> Azul </label>
                            <input type="radio" name="temaRegistro" value="Rosa" id="Se-pinkTheme">
                            <label for="Se-pinkTheme"> Rosa </label>
                        </div>
                    </div>
                </form>

                <div class="Se-accountBottom">
                    <span class="Se-dateCriation"> Criado em: <span class="Se-accountDate">28/05/2024</span></span>
                    <button class="Se-accountDelete">Excluir conta</button>
                </div>
            </div>
        </section>
    </main>

    <script src="/ConectaMaesProject/app/assets/js/config.js"></script>
    <script>       
        toggleTheme();
    </script>
</body>

</html>