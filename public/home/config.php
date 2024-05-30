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

<body>
    <?php include_once ("../../app/includes/headerHome.php");?>

    <main class="Ho-Main">
        <section class="asideLeft">
            <img src="/ConectaMaesProject/app/assets/imagens/figuras/CellsFull<?php echo $currentUserData['tema'];?>.png"
                class="cellsHome">
        </section>

        <section class="middle">

        </section>

        <section class="asideRight">
            <div>
                <img src="" alt="">
                <h1>Informações da conta</h1>
            </div>
            <div class="userDataConf">
                <div>
                    <div class="userPhotoConf">
                        <img src="" alt="">
                        <button></button>
                    </div>
                    <div class="userDataShow">
                        <div class="userDataPiece">
                            <span>Nome:</span><?php echo $currentUserData['nome'];?>
                        </div>
                        <div class="userDataPiece">
                            <span>Usuário:</span><?php echo $currentUserData['user'];?>
                        </div>
                        <div class="userDataPiece">
                            <span>Email:</span><?php echo $currentUserData['email'];?>
                        </div>
                        <div class="userDataPiece">
                            <span>Telefone:</span><?php echo $currentUserData['telefone'];?>
                        </div>
                        <div class="userDataPiece">
                            <span>Data de Nascimento:</span><?php echo $currentUserData['dataNascimento'];?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>