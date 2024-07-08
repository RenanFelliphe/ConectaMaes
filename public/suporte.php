<?php include_once __DIR__ . "/../app/services/helpers/paths.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/Logos/Final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Suporte</title>
    </head>

    <body>
        <?php include_once ("../app/includes/headerLanding.php");?>

        <main class="Su-suporte">
        </main>

        <?php 
            include_once ("../app/includes/footer.php");
        ?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>
