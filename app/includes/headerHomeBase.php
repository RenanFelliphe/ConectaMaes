<?php 
    $currentUserData = unitQuery($conn, "Usuario", $_SESSION['idUsuario']);   

    // Get the current URL path
    $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Define the image based on the URL path
    $imageHome = 'nada-encontrado.png';
    $imageRelatos = 'nada-encontrado.png';
    $imagePedidos = 'nada-encontrado.png';
    $imageAdmin = 'nada-encontrado.png';

    switch ($url_path) {
        case '/ConectaMaesProject/public/home.php':
            $imageHome = 'home_on.png';
            $imageRelatos = 'reports_off.png';
            $imagePedidos = 'helps_off.png';
            $imageAdmin = 'admin_off.png';
            break;
        case '/ConectaMaesProject/public/home/relatos.php':
            $imageHome = 'home_off.png';
            $imageRelatos = 'reports_on.png';
            $imagePedidos = 'helps_off.png';
            $imageAdmin = 'admin_off.png';
            break;
        case '/ConectaMaesProject/public/home/pedidos.php':
            $imageHome = 'home_off.png';
            $imageRelatos = 'reports_off.png';
            $imagePedidos = 'helps_on.png';
            $imageAdmin = 'admin_off.png';
            break;
        case '/ConectaMaesProject/public/admin.php':
            $imageHome = 'home_off.png';
            $imageRelatos = 'reports_off.png';
            $imagePedidos = 'helps_off.png';
            $imageAdmin = 'admin_on.png';
            break;
        // Add more cases as needed
        default:
            $imageHome = 'home_off.png';
            $imageRelatos = 'reports_off.png';
            $imagePedidos = 'helps_off.png';
            $imageAdmin = 'admin_off.png';
            break;
    }
?>
<header class="headerHome">
    <a href="/ConectaMaesProject/public/index.php"><img src="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães"></a>

    <div class="headerPageLinks">
        <a class="homePageLink pageLink active" id="homePageLink" href="/ConectaMaesProject/public/home.php">
            <img class="homePageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/<?php echo $imageHome; ?>" alt="Ícone da página inicial">
            <label for="homePageLink">Home</label>
            <span class="pageSelector"></span>
        </a>

        <a class="reportPageLink pageLink" id="reportPageLink" href="/ConectaMaesProject/public/home/relatos.php">
            <img class="reportPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/<?php echo $imageRelatos; ?>" alt="Ícone da página de relatos">
            <label for="homePageLink">Relatos</label>
            <span class="pageSelector"></span>
        </a>

        <a class="helpPageLink pageLink" id="helpPageLink" href="/ConectaMaesProject/public/home/pedidos.php">
            <img class="helpPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/<?php echo $imagePedidos; ?>" alt="Ícone da página de pedidos">
            <label for="homePageLink">Pedidos</label>
            <span class="pageSelector"></span>
        </a>
        
        <?php 
            if($currentUserData['isAdmin']){
            ?>
                <a class="adminPageLink pageLink" id="adminPageLink" href="/ConectaMaesProject/public/admin.php">
                    <img class="adminPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/<?php echo $imageAdmin; ?>" alt="Ícone da página de administração">
                    <label for="adminPageLink">Administração</label>
                    <span class="pageSelector"></span>
                </a>
        <?php
            }
        ?>
        
    </div>


    <div class="userContainer">
        <img class="notificationsModalIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/notifications_off.png" alt="Ícone do modal de notificações">
        <modal class="nots">
            <div class="notsHeader">
                <div class="notsBar">
                    <div>Todas</div>
                    <div>Pedidos</div>
                </div>   
                <div class="dropdown">
                    <button class="dropbtn">
                        <img src="" alt="Ícone de Engrenagem">
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Marcar como Lido</a>
                        <a href="#">Desativar notificações</a>
                        <a href="#">Configurações</a>
                    </div>
                </div>
            </div>
            <div class="notsBody">
            </div>
        </modal>
        <div class="userInformations">
            <span class="userRealName"> <?php echo $currentUserData['nome']; ?></span>
            <span class="userNickname"> <?php echo "@".$currentUserData['user']; ?></span>
        </div>
        <div class="userAccount">
            <a href="/ConectaMaesProject/public/home/perfil.php" class="userProfileImage">
                <img src="/ConectaMaesProject/app/assets/imagens/fotos/<?php echo $currentUserData['linkFotoPerfil']; ?>" alt="Foto de perfil do usuário">
            </a>    
            <i class="bi bi-chevron-down"></i>
        </div>
        <modal class="userOptions">
            <a href="/ConectaMaesProject/public/home/perfil.php">
                <div class="config">Perfil</div>
            </a>

            <?php if($currentUserData['isAdmin']){
            ?>
                <a href="/ConectaMaesProject/public/admin.php">
                    <div class="admin">Admin</div>
                </a>
            <?php
                }
            ?>

            <a href="/ConectaMaesProject/public/home/config.php">
                <div class="config">Config</div>
            </a>
                
            <span class="userModalDivision"></span>
                
            <a href="/ConectaMaesProject/app/services/helpers/logOut.php">   
                <div class="sair">Sair</div>  
            </a>
                
            
            
        </modal>
    </div>
</header>
