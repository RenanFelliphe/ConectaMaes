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
                
                <div class="Re-userSection">
                    <div class="Re-input">
                        <input type="text" id="nomeCompleto" required>
                        <label class="Re-fakePlaceholder" for="nomeCompleto">Nome Completo</label>
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

            <form class="Re-registerForm">
                <div class="Re-formHeader">
                    <h1 class="Re-registerTitle"> Registro </h1>
                    <p>Venha logo fazer parte desta comunidade!</p>
                </div>                  
                    
                <div class="Re-termsBox">
                    <input type="checkbox" id="Re-terms">
                    <label for="Re-terms"> Eu li e concordo com os Termos e Condições </label>
                </div>

                <div class="Re-childSection open">
                    <div class="Re-childInfo">
                        <label class="Re-addChild"> Adicionar filho +</label>
                        <div class="Re-haveNoChildBox">
                            <input type="checkbox" id="Re-haveNoChild">
                            <label for="Re-haveNoChild"> Não tenho filho</label>
                        </div>

                        <div class="Re-addChildBox">
                            <div class="Re-childBoxHeader">
                                <i class="bi bi-gender-male"></i>
                                <span class="Re-childName"> Nome Completo </span>
                            </div>

                            <div class="Re-childBoxSex">
                                <span class="Re-childGirl"> Menina</span>
                                <span class="Re-childBoy"> Menino </span>
                                <span class="Re-childOther"> Não Informar </span>
                            </div>

                            <div class="Re-childBoxInputs">
                                <div class="Re-input">
                                    <input type="text" id="dataNascFilho" placeholder="dd/mm/yyyy" required>
                                    <label for="telefone">Data de Nascimento</label>
                                    <i class="bi bi-calendar"></i>
                                </div>
                                <div class="Re-input">
                                    <input type="text" id="deficiencia" placeholder="--------" required>
                                    <label for="telefone">Deficiência</label>
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            
                            <div class="Re-childBoxButtons">
                                <button> Cancelar </button>
                                <button type="submit"> Confirmar </button>
                            </div>
                        </div>
                    </div>

                    <div class="Re-themeInfo">
                        <h3> Tema </h3>
                        <div class="Re-themeOptions">
                            <div>
                                <input type="radio" id="Re-yellowTheme">
                                <label for="Re-yellowTheme"> Amarelo </label>
                            </div>
                            <div>
                                <input type="radio" id="Re-blueTheme">
                                <label for="Re-blueTheme"> Azul </label>
                            </div>
                            <div>
                                <input type="radio" id="Re-pinkTheme">
                                <label for="Re-pinkTheme"> Rosa </label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="Re-registerNext"> Próximo </button>
            </form>
        </main>

        <?php include_once ("php/includes/footer.php");?>

    </body>

    <script></script>
</html>
