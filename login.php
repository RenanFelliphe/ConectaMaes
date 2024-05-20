<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles/variable.css">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="icon" href="assets/Logos/Final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Login</title>
    </head>

    <body>
        <?php include_once ("php/includes/headerLanding.php");?>

        <main class="Lo-Login">
            <img src="assets/Imagens/Cells.png" class="backgroundGeometricForms">
            <img src="assets/Imagens/Cells.png" class="backgroundGeometricForms cellsLeft">

            <form class="Lo-loginForm">
                <div class="Lo-formHeader">
                    <h1 class="Lo-loginTitle"> Login </h1>
                    <p>Seja bem-vindo novamente!</p>
                </div>    
            
                <div class="Lo-userSection">
                    <div class="Lo-input">
                        <input type="email" id="email" required autofocus>
                        <label class="Lo-fakePlaceholder" for="email">Email</label>
                    </div>
                    <div class="Lo-input">
                        <input type="password" id="senha" required>
                        <label class="Lo-fakePlaceholder" for="senha">Senha</label>
                    </div>

                    <div class="Lo-input">
                        <span class="Lo-rememberMe"><input type="checkbox"> Lembrar de mim</span>
                        <a href="" class="Lo-forgetPassword">Esqueceu sua senha?</a>
                    </div>
                </div>

                <input class="Lo-loginSubmit" type="submit" value="Entrar">
                <span class="Lo-goRegister"> Não possui uma conta? <a href="register.php">Registre-se</a></span>
            </form>
        </main>

        <?php include_once ("php/includes/footer.php");?>
    </body>

    <script></script>
</html>
