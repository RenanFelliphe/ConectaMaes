<?php
    require_once("../app/services/auth/authUser.php");
    require_once("../app/services/helpers/conn.php");
    require_once("../app/services/helpers/paths.php");

    if(isset($_POST['logar'])) {
        logIn($conn);
        if(empty($return['email'])){
            $loginErrorMsg = "Usuário ou senha não encontrados!";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../app/assets/styles/style.css">
        <link rel="icon" href="../app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Login</title>
    </head>

    <body class="Y-theme">
        <?php 
            include_once("../app/includes/headerLanding.php");
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
                        <div class="Re-input input-full">
                            <input class="Re-userInput" type="email" id="email" name="email" oninput="checkEmptyInputLogin(0)" required autofocus>
                            <label class="Re-fakePlaceholder" for="email">E-mail</label>
                        </div>
                        <div class="Re-input input-full">
                            <input class="Re-userInput" type="password" id="senha" name="senha" oninput="checkEmptyInputLogin(1)" required>
                            <label class="Re-fakePlaceholder" for="senha">Senha</label>
                        </div>

                        <div class="Re-input Lo-loginAssistants">
                            <div class="Lo-rememberMe" style="cursor: pointer">
                                <input type="checkbox" name="lembrar" id="rememberMeCheckbox" style="cursor: pointer"> 
                                <label for="rememberMeCheckbox" style="cursor: pointer;"> Lembrar de mim?</label>
                            </div>
                            <a href="" class="Lo-forgetPassword">Esqueceu sua senha?</a>
                        </div>
                    </div>
                </div>

                <div class="Lo-loginBottom">
                    <button type="submit" class="Lo-loginSubmit confirmBtn" name="logar">Entrar</button>
                    <span class="Lo-goRegister"> Não possui uma conta? <a href="registrar.php">Registre-se</a></span>
                </div>
                <?php if(isset($loginErrorMsg)){?>
                <div class="Lo-errorMessage">
                    <?php echo $loginErrorMsg;}?>
                </div>
            </form> 
        </main>

        <?php 
            include_once("../app/includes/footer.php");
        ?>
        
        <script src="../app/assets/js/system.js"></script>
        <script>  
            function checkEmptyInputLogin(index) {
                const loginInputs = document.querySelectorAll('.Lo-loginForm .Re-userInput');
                const loginContainers = document.querySelectorAll('.Lo-loginForm .Re-input');
                const loginPlaceholders = document.querySelectorAll('.Lo-loginForm .Re-fakePlaceholder');
                
                if (loginInputs[index].value !== "") {
                    loginPlaceholders[index].classList.add('notEmpty');
                    loginContainers[index].style.opacity = "1";
                } else {
                    loginPlaceholders[index].classList.remove('notEmpty');
                    loginContainers[index].style.opacity = "0.5";
                }
            }            
        </script>
    </body>
</html>
