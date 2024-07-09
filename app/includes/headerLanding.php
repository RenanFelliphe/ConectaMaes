<?php
    include_once __DIR__ . "/../services/helpers/paths.php";
?>

<header class="headerLanding">
    <a href="<?php echo $relativeRootPath; ?>/index.php"><img src="<?php echo $relativeAssetsPath; ?>/imagens/logos/Final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães"></a>
    <div class="A-headerLinks">
        <h4><a href="<?php echo $relativeRootPath; ?>/index.php#La-articleEquip">Equipe</a></h4>
        <h4><a href="#">Contato</a></h4>
        <h4><a href="#">Direitos</a></h4>
    </div>
    <div class="A-searchBar">
        <i class="bi bi-search"></i>
        <input type="search" class="A-searchBarInput" name="pesquisar" placeholder="Pesquisar">
    </div>
    <div class="A-signButtons">
        <a href="<?php echo $relativePublicPath; ?>/registrar.php"><h4 class="A-signUp">Cadastrar</h4></a>
        <a href="<?php echo $relativePublicPath; ?>/login.php"><h4 class="A-signIn">Login</h4></a>
    </div>
</header>


