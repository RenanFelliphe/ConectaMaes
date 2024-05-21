<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles/variable.css">
        <link rel="stylesheet" href="styles/include.css">
    </head>
    <body>
        <header class="headerHome">
            <a href="index.php"><img src="assets/Logos/Final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães"></a>

            <div class="headerPageLinks">
                <a class="homePageLink pageLink active" id="homePageLink" href="home.php">
                    <img class="homePageIcon headerIcon" src="assets/Icons/home_on.png" alt="Ícone da página inicial">
                    <label for="homePageLink">Home</label>
                    <span class="pageSelector"></span>
                </a>

                <a class="reportPageLink pageLink" id="reportPageLink" href="reports.php">
                    <img class="reportPageIcon headerIcon" src="assets/Icons/reports_off.png" alt="Ícone da página de relatos">
                    <label for="homePageLink">Relatos</label>
                    <span class="pageSelector"></span>
                </a>

                <a class="helpPageLink pageLink" id="helpPageLink" href="helps.php">
                    <img class="helpPageIcon headerIcon" src="assets/Icons/helps_off.png" alt="Ícone da página de pedidos">
                    <label for="homePageLink">Pedidos</label>
                    <span class="pageSelector"></span>
                </a>
            </div>


            <div class="userContainer">
                <img class="notificationsModalIcon headerIcon" src="assets/Icons/notifications_off.png" alt="Ícone do modal de notificações">

                <div class="userInformations">
                    <span class="userRealName"> Renan Felliphe</span>
                    <span class="userNickname"> @renanfelliphe9</span>
                </div>
                <div class="userAccount">
                    <a href="profile.php" class="userProfileImage">
                        <img src="assets/Fotos/Renan-Moura.png" alt="Foto de perfil do usuário">
                    </a>    
                    <i class="bi bi-chevron-down"></i>
                </div>
            </div>
        </header>
    </body>
</html>
