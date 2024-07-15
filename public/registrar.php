<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../app/assets/styles/style.css">
        <link rel="icon" href="../app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Registro</title>
    </head>

    <body class="<?php if(isset( $currentUserData['tema'])) echo $currentUserData['tema'];?>">
        <?php 
            include_once ("../app/includes/headerLanding.php");
            include_once ("../app/services/crud/userFunctions.php");
        ?>

        <main class="Re-register">
            <img src="" class="backCells">
            <img src="" class="backCells cellsLeft">

            <form class="Re-registerForm" id="registerForm" method="post" enctype="multipart/form-data">
                <div class="Re-registerHeader">
                    <i class="bi bi-arrow-left-circle Re-backButton close"></i>
                    <h1 class="Re-registerTitle"> Registro </h1>
                    <p>Venha logo fazer parte desta comunidade!</p>
                </div>

                <div class="Re-registerCenter">
                    <div class="Re-accountInformations Re-registerSections">
                        <div class="Re-input">
                            <input class="Re-userInput validate" type="text" id="nomeUsuario" name="userRegistro" oninput="validateName()">
                            <label class="Re-fakePlaceholder" for="nomeUsuario">Usuário</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent">
                                    <i class="bi bi-x-circle-fill"></i>
                                    <span class="errorMessage">Tem erro aí!</span>
                                </div>
                            </div>
                            </div>

                        <div class="Re-input">
                            <input class="Re-userInput validate" type="email" id="email" name="emailRegistro" autocomplete="email" oninput="validateEmail()">
                            <label class="Re-fakePlaceholder" for="email">E-mail</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                        </div>

                        <div class="Re-input">
                            <input class="Re-userInput validate" type="password" id="senha" name="senhaRegistro" oninput="validatePassword()">
                            <label class="Re-fakePlaceholder" for="senha">Senha</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                        </div>

                        <div class="Re-input">
                            <input class="Re-userInput validate" type="password" id="confirmarSenha" name="senhaRegistroConfirma" oninput="validatePassword()">
                            <label class="Re-fakePlaceholder" for="confirmarSenha">Confirmar Senha</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                        </div>

                        <div class="Re-themeInfo">
                            <p> Tema </p>
                            <div class="Re-themeOptions">
                                <input type="radio" name="temaRegistro" value="Y-theme" id="Re-yellowTheme" onclick="registerTheme('Y-theme')" checked>
                                <label for="Re-yellowTheme"> Amarelo </label>
                                <input type="radio" name="temaRegistro" value="B-theme" id="Re-blueTheme" onclick="registerTheme('B-theme')">
                                <label for="Re-blueTheme"> Azul </label>
                                <input type="radio" name="temaRegistro" value="P-theme" id="Re-pinkTheme" onclick="registerTheme('P-theme')">
                                <label for="Re-pinkTheme"> Rosa </label>
                            </div>
                        </div>
                    </div>

                    <div class="Re-userInformations Re-registerSections close">
                        <div class="Re-input inputName">
                            <input class="Re-userInput" type="text" id="nomeCompleto" name="nomeUsuarioRegistro" required>
                            <label class="Re-fakePlaceholder" for="nomeCompleto">Nome Completo</label>
                        </div>
                        <div class="Re-input inputCell">
                            <input class="Re-userInput" type="text" id="telefone" name="telefoneRegistro" required />
                            <label class="Re-fakePlaceholder" for="telefone">Telefone</label>
                        </div>
                        <div class="Re-input inputDataNasc">
                            <input class="Re-userInput" type="date" id="dataNascimento" name="dataNascimentoRegistro">
                            <label class="Re-fakePlaceholder notEmpty" id="dataNascPlaceholder" for="dataNascimento">Data de Nascimento</label>
                        </div>
                        <div class="Re-input inputLocal">
                            <select class="Re-userInput" name="localizacaoRegistro" id="localizacao" >
                                <option value="">- - - - - -</option>
                                <option value="Acre"> AC | Acre</option>
                                <option value="Alagoas"> AL | Alagoas</option>
                                <option value="Amapá"> AP | Amapá</option>
                                <option value="Amazonas"> AM | Amazonas</option>
                                <option value="Bahia"> BA | Bahia</option>
                                <option value="Ceará"> CE | Ceará</option>
                                <option value="Distrito Federal"> DF | Distrito Federal</option>
                                <option value="Espírito Santo"> ES | Espírito Santo</option>
                                <option value="Goiás"> GO | Goiás</option>
                                <option value="Maranhão"> MA | Maranhão</option>
                                <option value="Mato Grosso"> MT | Mato Grosso</option>
                                <option value="Mato Grosso do Sul"> MS | Mato Grosso do Sul</option>
                                <option value="Minas Gerais"> MG | Minas Gerais</option>
                                <option value="Pará"> PA | Pará</option>
                                <option value="Paraíba"> PB | Paraíba</option>
                                <option value="Paraná"> PR | Paraná</option>
                                <option value="Pernambuco"> PE | Pernambuco</option>
                                <option value="Piauí"> PI | Piauí</option>
                                <option value="Rio de Janeiro"> RJ | Rio de Janeiro</option>
                                <option value="Rio Grande do Norte"> RN | Rio Grande do Norte</option>
                                <option value="Rio Grande do Sul"> RS | Rio Grande do Sul</option>
                                <option value="Rondônia"> RO | Rondônia</option>
                                <option value="Roraima"> RR | Roraima</option>
                                <option value="Santa Catarina"> SC | Santa Catarina</option>
                                <option value="São Paulo"> SP | São Paulo</option>
                                <option value="Sergipe"> SE | Sergipe</option>
                                <option value="Tocantins"> TO | Tocantins</option>                 
                            </select>
                            <label class="Re-fakePlaceholder notEmpty" for="localizacao" style="pointer-events: none;">Localização</label>
                        </div>
                        <div class="Re-input input-full inputBio">
                            <textarea class="Re-userInput" name="biografiaUsuarioRegistro" id="biografiaUsuario" cols="54" rows="4"></textarea>                        
                            <label class="Re-fakePlaceholder" for="biografiaUsuario">Biografia</label>
                        </div>
                    </div>

                    <div class="Re-registerResult Re-registerSections close">
                        <div class="Re-addImageProfile">
                            <div class="Re-userImageProfile">
                                <img src="../app/assets/imagens/icons/user_no_profile_image.png" alt="" class="Re-userImage">
                            </div>

                            <input type="file" id="imagesSelector" name="fotoPerfilRegistro" accept="image/png, image/jpeg">
                            <label for="imagesSelector" class="Re-addImageIcon">                        
                                <i class="bi bi-camera-fill"></i>                    
                            </label>
                        </div>

                        <div class="Re-userInfoContainer">
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Nome:</p>
                                <p class="Re-userInfo" id="infoNomeCompleto"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Usuário:</p>
                                <p class="Re-userInfo" id="infoNomeUsuario"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">E-mail:</p>
                                <p class="Re-userInfo" id="infoEmail"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Telefone:</p>
                                <p class="Re-userInfo" id="infoTelefone"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Data de Nascimento:</p>
                                <p class="Re-userInfo" id="infoDataNascimento"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Localização:</p>
                                <p class="Re-userInfo" id="infoLocalizacao"></p>
                            </div>
                        </div>

                        <div class="Re-termsBox">
                            <input type="checkbox" id="Re-terms">
                            <label for="Re-terms">Eu li e concordo com os Termos e Condições</label>
                        </div>
                    </div>
                </div>
                
                <div class="Re-registerBottom">
                    <button class="Re-registerNext confirmBtn" name="proximo" type="button">Próximo</button>
                    <button class="Re-registerSubmit confirmBtn close" type="submit" name="registrar">Registrar</button>
                    <p class="Re-goLogin">Já possui uma conta? <a href="login.php">Entre</a></p>
                </div>
                <?php
                    if(isset($_POST['registrar'])){
                        signUp($conn);
                    }
                ?>
            </form>    
        </main>

        <?php 
            include_once ("../app/includes/footer.php");
        ?>

        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
        <script>        
            document.querySelectorAll('.Re-userInput').forEach(input => {
                const updateInfo = (event) => {
                    const inputId = event.target.id;
                    const infoElement = document.getElementById('info' + inputId.charAt(0).toUpperCase() + inputId.slice(1));
                    infoElement.textContent = event.target.value;
                };

                input.addEventListener('input', updateInfo);

                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', updateInfo);
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                registerUser();
                userValidations();
            });
        </script>
    </body>
</html>