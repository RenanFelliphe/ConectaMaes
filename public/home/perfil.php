<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location:/ConectaMaesProject/public/login.php");
    require_once "../../app/services/crud/userFunctions.php"; 
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);   
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/style.css">
    <link rel="icon" href="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Perfil</title>
</head>

<body class="<?php echo $currentUserData['tema'];?>">
    <?php include_once ("../../app/includes/headerHome.php");?>

    <main class="mainSystem">
        <section class="asideLeft"></section>

        <section class="asideRight"></section>
    </main>



    <?php include_once ("../../app/includes/modais.php");?>

    <script src="/ConectaMaesProject/app/assets/js/system.js"></script>
    <script>        
        toggleTheme();
    </script>
</body>

</html>