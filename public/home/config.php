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

<body class="B-theme">
    <?php include_once ("../../app/includes/headerHome.php");?>

    <main class="Ho-Main mainSystem">
        <section class="asideLeftConfig">
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
                    <i class="bi bi-chevron-right"></i>
                </div>

                <div class="Se-sectionTitle">
                    <div>
                        <img src="../../app/assets/imagens/icons/support_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p> Suporte</p>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>

        </section>

        <section class="asideRightConfig infoAccount"></section>
    </main>

    <script src="/ConectaMaesProject/app/assets/js/config.js"></script>
</body>

</html>