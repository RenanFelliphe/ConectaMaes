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
    <title>ConectaMães - Registro</title>
</head>

<body>
    <?php 
            include_once ("../app/includes/headerLanding.php");
            include_once ("../app/services/crud/userFunctions.php");
        ?>

    <main class="Re-register">
        <img src="../app/assets/imagens/figuras/Cells.png" class="backgroundGeometricForms">
        <img src="../app/assets/imagens/figuras/Cells.png" class="backgroundGeometricForms cellsLeft">

        <form class="Re-registerForm">
            <div class="Re-formHeader">
                <h1 class="Re-registerTitle"> Registro </h1>
                <p>Venha logo fazer parte desta comunidade!</p>
            </div>

            <div class="Re-userSection">
                <div class="Re-input">
                    <input type="text" id="nomeCompleto" required autofocus>
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

            <div class="Re-childSection">
                <div class="Re-childInfo">
                    <label class="Re-addChild"> Adicionar filho +</label>
                    <div class="Re-haveNoChildBox">
                        <input type="checkbox" id="Re-haveNoChild">
                        <label for="Re-haveNoChild"> Não tenho filho</label>
                    </div>

                    <div class="Re-addChildBox close">
                        <div class="Re-childBoxHeader">
                            <img src="../app/assets/imagens/icons/icons8-child-icon-90.png" alt="Icone de Criança"
                                width="35px" class="Re-child-icon">
                            <input type="text" class="Re-childName" placeholder="Nome Completo" required>
                        </div>

                        <div class="Re-childBoxSex">
                            <span class="Re-childGirl Re-childSex"> Menina</span>
                            <span class="Re-childBoy Re-childSex"> Menino </span>
                            <span class="Re-childOther Re-childSex"> Não Informar </span>
                        </div>

                        <div class="Re-childBoxInputs">
                            <div class="Re-input">
                                <input type="date" id="dataNascFilho" placeholder="dd/mm/yyyy" required>
                                <label for="dataNascFilho">Data de Nascimento</label>
                            </div>
                            <div class="Re-input">
                                <select name="deficienciaSelect" id="deficiencia">
                                    <option value="valor0">--------</option>
                                    <optgroup label="Deficiência Físicas">
                                        <option value="valor1">H81 — Hemiplegia</option>
                                        <option value="valor2">H81.1 — Paraplegia espástica</option>
                                        <option value="valor3">H82.3 — Tetraplegia flágida</option>
                                    </optgroup>
                                    <optgroup label="Deficiência Neurológicas">
                                        <option value="valor4">G04.0 — Encefalite agura disseminada</option>
                                        <option value="valor5">G20 — Doença de Parkinson</option>
                                        <option value="valor6">G30 — Alzheimer</option>
                                        <option value="valor7">G35 — Esclerose múltipla</option>
                                    </optgroup>
                                    <optgroup label="Deficiência Visuais">
                                        <option value="valor8">H54 — Cegueira visão subnormal</option>
                                        <option value="valor9">H54.0 — Cegueira, ambos os olhos</option>
                                        <option value="valor10">H54.1 — Cegueira em um olho e visão subnormal em outro
                                        </option>
                                    </optgroup>
                                    <optgroup label="Deficiência Auditivas">
                                        <option value="valor11">H80 — Otosclerose</option>
                                        <option value="valor12">H91.1 — Presbiacusia</option>
                                        <option value="valor13">H91.3 — Surdo-mudez não classificada em outra parte
                                        </option>
                                    </optgroup>
                                    <optgroup label="Deficiência Intelectuais">
                                        <option value="valor7">F84.0 — Autismo infantil</option>
                                        <option value="valor8">F84.1 — Autismo atípico</option>
                                        <option value="valor9">F84.5 — Síndrome de Asperger</option>
                                    </optgroup>
                                </select>
                                <label for="deficiencia">Deficiência</label>
                            </div>

                        </div>

                        <div class="Re-childBoxButtons">
                            <button type="reset" value="reset" class="Re-cancelAddChild"> Cancelar </button>
                            <button type="submit" value="submit"> Confirmar </button>
                        </div>
                    </div>
                </div>

                <div class="Re-themeInfo">
                    <h3> Tema </h3>
                    <div class="Re-themeOptions">
                        <input type="radio" name="tema" value="Amarelo" id="Re-yellowTheme">
                        <label for="Re-yellowTheme"> Amarelo </label>
                        <input type="radio" name="tema" value="Azul" id="Re-blueTheme">
                        <label for="Re-blueTheme"> Azul </label>
                        <input type="radio" name="tema" value="Rosa" id="Re-pinkTheme">
                        <label for="Re-pinkTheme"> Rosa </label>
                    </div>
                </div>
            </div>

            <div class="Re-termsBox">
                <input type="checkbox" id="Re-terms">
                <label for="Re-terms"> Eu li e concordo com os Termos e Condições </label>
            </div>
            <button class="Re-registerNext" type="submit" value="submit"> Próximo </button>
            <p class="Re-goLogin"> Já possui uma conta? <a href="login.php"> Entre </a></p>
        </form>
        <?php signUp($conn);?>
    </main>

    <?php include_once ("../app/includes/footer.php");?>

</body>

<script src="../app/assets/js/register.js"></script>

</html>