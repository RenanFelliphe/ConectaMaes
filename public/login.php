<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../app/assets/styles/variable.css">
    <link rel="stylesheet" href="../app/assets/styles/style.css">
    <link rel="stylesheet" href="../app/assets/styles/include.css">
    <link rel="icon" href="../app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Login</title>
</head>

<body>
    <?php 
        include_once ("../app/includes/headerLanding.php");
        include_once ("../app/services/auth/authUser.php");
    ?>

    <main class="Lo-Login">
        <img src="" class="backCells">
        <img src="" class="backCells cellsLeft">

        <form class="Lo-loginForm" method="post">
            <div class="Lo-loginHeader">
                <i class="bi bi-arrow-left-circle Lo-backButton close"></i>
                <h1 class="Lo-loginTitle"> Login </h1>
                <p>Seja bem-vindo novamente!</p>
            </div>

            <div class="Lo-loginCenter">
                <div class="Lo-userSection Lo-loginSections">
                    <div class="Lo-input">
                        <input type="email" id="email" name="email" required autofocus>
                        <label class="Lo-fakePlaceholder" for="email">Email</label>
                    </div>
                    <div class="Lo-input">
                        <input type="password" id="senha" name="senha" required>
                        <label class="Lo-fakePlaceholder" for="senha">Senha</label>
                    </div>

                    <div class="Lo-input Lo-loginAssistants">
                        <span class="Lo-rememberMe"><input type="checkbox" name="lembrar"> Lembrar de mim</span>
                        <a href="" class="Lo-forgetPassword">Esqueceu sua senha?</a>
                    </div>
                </div>
            </div>

            <div class="Lo-loginBottom">
                <input class="Lo-loginSubmit" type="submit" name="logar" value="Entrar">
                <span class="Lo-goRegister"> Não possui uma conta? <a href="registrar.php">Registre-se</a></span>
            </div>
        </form>

        <?php
            if(isset($_POST['logar']))
            {
                logIn($conn);
            }
        ?>
    </main>

    <?php include_once ("../app/includes/footer.php");?>
</body>

<script src="../app/assets/js/loginRegister.js"></script>

</html>