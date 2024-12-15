<?php     
    include_once __DIR__ . "/app/services/helpers/paths.php";
    if(isset($_GET['subject'])){
        $subject = $_GET['subject'];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Apresentação</title>
    </head>

    <body class="Y-theme">
        <?php include_once ("./app/includes/headerLanding.php");?>

        <main class="Su-suporte" style="height: 82vh;">
            <img src="<?= $relativeAssetsPath?>/imagens/figuras/cells_standart_first_blue.png" class="backCells">
            <img src="<?= $relativeAssetsPath?>/imagens/figuras/cells_standart_first_blue.png" class="backCells cellsLeft">

            <div style="position: absolute;
                        left: 50%; top: 40%;
                        transform: translate(-50%);
                        display: flex; flex-direction:
                        column; cursor: pointer;">
                        
                <h1><?= isset($subject) ? ($subject == "post" ? "PUBLICAÇÃO NÃO ENCONTRADA" : ($subject == "comment" ? "COMENTÁRIO NÃO ENCONTRADO" : "PÁGINA NÃO ENCONTRADA")) : ""; ?></h1>
                <a class="" href="javascript:window.history.back();"> Voltar de onde parou</a>
            </div>
            
        </main>

        <?php 
            include_once ("./app/includes/footer.php");
        ?>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
    </body>
</html>