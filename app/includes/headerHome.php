<?php 
    $currentUserData = unitQuery($conn, "Usuario", $_SESSION['idUsuario']);   
?>
<header class="headerHome">
    <a href="/ConectaMaesProject/public/index.php"><img src="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães"></a>

    <div class="headerPageLinks">
        <a class="homePageLink pageLink active" id="homePageLink" href="/ConectaMaesProject/public/home.php">
            <img class="homePageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/home_on.png" alt="Ícone da página inicial">
            <label for="homePageLink">Home</label>
            <span class="pageSelector"></span>
        </a>

        <a class="reportPageLink pageLink" id="reportPageLink" href="/ConectaMaesProject/public/home/relatos.php">
            <img class="reportPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
            <label for="homePageLink">Relatos</label>
            <span class="pageSelector"></span>
        </a>

        <a class="helpPageLink pageLink" id="helpPageLink" href="/ConectaMaesProject/public/home/pedidos.php">
            <img class="helpPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
            <label for="homePageLink">Pedidos</label>
            <span class="pageSelector"></span>
        </a>
        <?php 
            if($currentUserData['isAdmin']){
            ?>
                <a class="adminPageLink pageLink" id="adminPageLink" href="/ConectaMaesProject/public/admin.php">
                    <img class="adminPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/admin_off.png" alt="Ícone da página de administração">
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
            <div class="abrirPerfil">Perfil</div>
            <?php if($currentUserData['isAdmin']){
            ?>
                <a href="/ConectaMaesProject/public/admin.php">
                    <div class="admin">Admin</div>
                </a>
            <?php
                }
            ?>
            <a href="/ConectaMaesProject/public/admin.php">
                <div class="config">Config</div>
                </a>
                <span class="userModalDivision"></span>
                <a href="/ConectaMaesProject/public/admin.php">
                <div class="sair">Sair</div>
                </a>
            
            
        </modal>
    </div>
</header>