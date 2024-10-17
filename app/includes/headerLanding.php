<?php
    include_once __DIR__ . "/../services/helpers/paths.php";
?>

<i class="bi bi-list La-toggleHeader"></i>

<header class="headerLanding">
    <a href="<?php echo $relativeRootPath; ?>/index.php"><img src="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães"></a>
    <div class="A-headerLinks">
        <h4><a href="<?php echo $relativeRootPath; ?>/index.php#La-articleEquip">Equipe</a></h4>
        <h4><a href="<?php echo $relativeRootPath; ?>/index.php#La-contactSection">Contato</a></h4>
        <h4><a href="#">Direitos</a></h4>
    </div>
    <div class="A-signButtons">
        <a href="<?php echo $relativePublicPath; ?>/registrar.php"><h4 class="A-signUp">Cadastrar</h4></a>
        <a href="<?php echo $relativePublicPath; ?>/login.php"><h4 class="A-signIn">Login</h4></a>
    </div>
</header>

<script>
    const headerLanding = document.querySelector('.headerLanding');
    const toggleHeader = document.querySelector('.La-toggleHeader');
    const body = document.querySelector('body');

    toggleHeader.addEventListener('click', () => {
        headerLanding.classList.toggle('active');
        toggleHeader.style.backgroundColor = headerLanding.classList.contains('active') ? "#80808030" : "";
    });

    /*
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                headerLanding.classList.remove('active');
                toggleHeader.style.display = 'none';
            } else {
                toggleHeader.style.display = 'flex';
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth >= 768) {
                toggleHeader.style.display = 'none';
            } else {
                toggleHeader.style.display = 'flex';
            }
        });
    */

</script>

