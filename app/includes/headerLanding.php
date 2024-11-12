<?php
    include_once __DIR__ . "/../services/helpers/paths.php";
?>

<i class="bi bi-list La-toggleHeader"></i>

<header class="headerLanding">
    <a href="<?= $relativeRootPath; ?>/index.php"><img src="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães"></a>
    <div class="A-headerLinks">
        <h4><a href="<?= $relativeRootPath; ?>/index.php#La-contactFAQ">FAQ</a></h4>    
        <h4><a href="<?= $relativeRootPath; ?>/index.php#La-contactSection">Contato</a></h4>
        <h4><a href="<?= $relativeRootPath; ?>/index.php#La-articleEquip">Equipe</a></h4>
    </div>
    <div class="A-signButtons">
        <a href="<?= $relativePublicPath; ?>/registrar.php"><h4 class="A-signUp">Cadastrar</h4></a>
        <a href="<?= $relativePublicPath; ?>/login.php"><h4 class="A-signIn">Login</h4></a>
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

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            window.scrollTo({
                top: target.offsetTop - document.querySelector('header').offsetHeight,
                behavior: 'smooth'
            });
        });
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

