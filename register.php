<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles/variable.css">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="icon" href="assets/Logos/Final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Apresentação</title>
    </head>

    <body>
        <?php include_once ("php/includes/header.php");?>

        <main class="Re-register">
            <img src="assets/Imagens/Cells.png" class="backgroundGeometricForms">
            <img src="assets/Imagens/Cells.png" class="backgroundGeometricForms cellsLeft">

            <form class="Re-registerForm">
                <div class="Re-formHeader">
                    <h1 class="Re-registerTitle"> Registro </h1>
                    <p>Venha logo fazer parte desta comunidade!</p>
                </div>                  
                
                <div class="Re-inputsContainer">
                    <div class="Re-input">
                        <input type="text" id="nomeCompleto" required>
                        <label class="Re-fakePlaceholder" for="nomeCompleto">Nome Completo
                            <span></span>
                        </label>
                    </div>
                    <div class="Re-input">
                        <input type="text" id="dataNascimento" required>
                        <label class="Re-fakePlaceholder" for="dataNascimento">Data de Nascimento</label>
                    </div>
                    <div class="Re-input">
                        <input type="text" id="telefone" required>
                        <label class="Re-fakePlaceholder" for="telefone">Telefone</label>
                    </div>
                    <div class="Re-input">
                        <input type="text" id="cep" required>
                        <label class="Re-fakePlaceholder" for="cep">CEP</label>
                    </div>
                    <div class="Re-input">
                        <input type="text" id="email" required>
                        <label class="Re-fakePlaceholder" for="email">Email</label>
                    </div>
                    <div class="Re-input">
                        <input type="email" id="confirmarEmail" required>
                        <label class="Re-fakePlaceholder" for="confirmarEmail">Confirmar Email</label>
                    </div>
                    <div class="Re-input">
                        <input type="password" id="senha" required>
                        <label class="Re-fakePlaceholder" for="senha">Senha</label>
                    </div>
                    <div class="Re-input">
                        <input type="password" id="confirmarSenha" required>
                        <label class="Re-fakePlaceholder" for="confirmarSenha">Confirmar Senha</label>
                    </div>
                </div>
                    
                <button class="Re-registerNext"> Próximo </button>
                <p class="Re-goLogin"> Já possui uma conta? <a href="login.php"> Entre </a></p>
            </form>
        </main>

        <?php include_once ("php/includes/footer.php");?>

    </body>

    <script></script>
</html>
