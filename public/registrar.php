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
                <i class="bi bi-arrow-left-circle Re-backButton close"></i>

                <div class="Re-registerHeader">
                    <h1 class="Re-registerTitle"> Registro </h1>
                    <p>Venha logo fazer parte desta comunidade!</p>
                </div>

                <div class="Re-registerCenter">
                    <div class="Re-accountInformations Re-registerSections">
                        <div class="Re-input inputUserName">
                            <input class="Re-userInput validate" type="text" id="nomeUsuario" name="userRegistro" oninput="validateName()" onclick="validateName()" required autofocus>
                            <label class="Re-fakePlaceholder" for="nomeUsuario">Usuário</label>
                            <span class="userArroba">@</span>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputeMAIL">
                            <input class="Re-userInput validate" type="email" id="email" name="emailRegistro" autocomplete="email" oninput="validateEmail()" required>
                            <label class="Re-fakePlaceholder" for="email">E-mail</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputPassword">
                            <input class="Re-userInput validate" type="password" id="senha" name="senhaRegistro" oninput="validatePassword()" required>
                            <label class="Re-fakePlaceholder" for="senha">Senha</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputConfirmPassword">
                            <input class="Re-userInput validate" type="password" id="confirmarSenha" name="senhaRegistroConfirma" oninput="validateConfirmPassword()" required>
                            <label class="Re-fakePlaceholder" for="confirmarSenha">Confirmar Senha</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
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
                            <input class="Re-userInput validate" type="text" id="nomeCompleto" name="nomeUsuarioRegistro" oninput="validateFullName()" required>
                            <label class="Re-fakePlaceholder" for="nomeCompleto">Nome Completo</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>
                        <div class="Re-input inputCell">
                            <input class="Re-userInput validate" type="number" id="telefone" name="telefoneRegistro" oninput="validatePhone()" required />
                            <label class="Re-fakePlaceholder" for="telefone">Telefone</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>
                        <div class="Re-input inputDataNasc">
                            <input class="Re-userInput validate" type="date" id="dataNascimento" name="dataNascimentoRegistro">
                            <label class="Re-fakePlaceholder notEmpty" id="dataNascPlaceholder" for="dataNascimento">Data de Nascimento</label>
                        </div>
                        <div class="Re-input inputLocal">
                            <select class="Re-userInput" name="localizacaoRegistro" id="localizacao">
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

            

            function userValidations(){
                const validateInputs = document.querySelectorAll('.validate');
                const inputContainers = document.querySelectorAll('.Re-input');
                const placeholders = document.querySelectorAll('.Re-fakePlaceholder');
                const errorMessageContainers = document.querySelectorAll('.errorMessageContainer');
                const errorMessageContent = document.querySelectorAll('.errorMessageContent');
                const errorIcon = document.querySelectorAll('.errorIcon');

                function setError(index, message){
                    inputContainers[index].style.border = "2px solid var(--redColor)";
                    placeholders[index].style.color = "var(--redColor)";
                    errorMessageContent[index].innerHTML = `<i class="bi bi-x-circle-fill mainError"></i><span class="errorMessage">${message}</span>`;
                    errorMessageContent[index].style.display = "flex";
                    errorIcon[index].style.display = "block";

                    inputContainers[index].classList.add('withError');

                    function toggleErrorModal(index, show) {
                        errorMessageContainers[index].style.display = show ? 'flex' : 'none';
                    }

                    errorIcon.forEach((icon, idx) => {
                        if (idx === index) {
                            icon.addEventListener('mouseover', () => {
                                toggleErrorModal(index, true);
                            });

                            icon.addEventListener('mouseout', () => {
                                toggleErrorModal(index, false);
                            });
                        }
                    });
                }

                function removeError(index){
                    inputContainers[index].style.border = "2px solid transparent";
                    placeholders[index].style.color = "var(--secondColor)";
                    errorMessageContent[index].innerHTML = '';
                    errorIcon[index].style.display = "none";

                    inputContainers[index].classList.remove('withError');
                }

                function checkEmptyInput(index){
                    if(validateInputs[index].value !== ""){
                        placeholders[index].classList.add('notEmpty');
                        inputContainers[index].style.opacity = "1";
                    } else {
                        placeholders[index].classList.remove('notEmpty');
                        inputContainers[index].style.opacity = "0.5";
                        removeError(index);
                    }
                }

                function validateName(){
                    const username = validateInputs[0].value;

                    checkEmptyInput(0);
                    if(username.length === 0){
                        removeError(0);
                    } else if(username.length <= 3){
                        setError(0, "O nome de usuário deve ter mais de <span class='mainError'>3 caracteres.</span>");
                    } else if(username.length > 50){
                        setError(0, "O nome de usuário é <span class='mainError'>longo demais.</span>");
                        username = username.slice(0, 50);
                    } else if(/[áàâãäéèêëíìîïóòôõöúùûü]/i.test(username)){
                        setError(0, "O nome de usuário não pode ter <span class='mainError'>acentos.</span>");
                    } else if(/[ç]/i.test(username)){
                        setError(0, "O nome de usuário não pode ter <span class='mainError'>cedilha.</span>");
                    } else if(/[-]/.test(username)){
                        setError(0, "O nome de usuário não pode ter <span class='mainError'>hífens.</span>");
                    } else if(/\s/.test(username)){
                        setError(0, "O nome de usuário não pode ter <span class='mainError'>espaços.</span>");
                    } else if(/[^a-zA-Z0-9_]/.test(username)){
                        setError(0, "O nome de usuário não pode ter <span class='mainError'>caracteres especiais exceto underline (_).</span>");
                    } else {
                        removeError(0);
                    }
                }

                function validateEmail() {
                    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                    const email = validateInputs[1].value;
                    checkEmptyInput(1);

                    if(email.length === 0){
                        removeError(1);
                    } else if (!emailRegex.test(email)) {
                        setError(1, "Insira um <span class='mainError'>e-mail válido.</span>");
                    } else if (email.length > 256) {
                        setError(1, "O e-mail é <span class='mainError'>longo demais.</span>");
                        email = email.slice(0, 256);
                    } else {
                        removeError(1);
                    }
                }    

                function validatePassword() {
                    const password = validateInputs[2].value;
                    const hasUpperCase = /[A-Z]/.test(password);
                    const hasLowerCase = /[a-z]/.test(password);
                    const hasDigit = /\d/.test(password);
                    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

                    checkEmptyInput(2);
                    validateConfirmPassword();

                    if(password.length === 0){
                        removeError(2);
                    } else if (password.length < 8) {
                        setError(2, "A senha deve ter mais de <span class='mainError'>8 caracteres.</span>");
                    } else if (!hasUpperCase) {
                        setError(2, "A senha deve conter <span class='mainError'>letras maiúsculas.</span>");
                    } else if (!hasLowerCase) {
                        setError(2, "A senha deve conter <span class='mainError'>letras minúsculas.</span>");
                    } else if (!hasDigit) {
                        setError(2, "A senha deve conter <span class='mainError'>números.</span>");
                    } else if (!hasSpecialChar) {
                        setError(2, "A senha deve conter caracteres especiais <span class='mainError'>(!@#$%^&*).</span>");
                    } else if (password.length > 100) {
                        setError(2, "A senha é <span class='mainError'>longa demais.</span>");
                        password = password.slice(0, 100);
                    } else {
                        removeError(2);
                    }
                }

                function validateConfirmPassword(){
                    const confirmPassword = validateInputs[3].value;
                    const password = validateInputs[2].value;

                    checkEmptyInput(3);
                    if(confirmPassword.length === 0){
                        removeError(3);
                    } else if(password !== confirmPassword){
                        setError(3, "As senhas <span class='mainError'>não coincidem.</span>");
                    } else{
                        removeError(3);
                    }
                }
                
                function validateFullName() {
                    const fullName = validateInputs[4].value;
                
                    checkEmptyInput(4);
                    if (fullName.length === 0) {
                        removeError(4);
                    } else if (/\d/.test(fullName)) {
                        setError(4, "O nome completo não pode possuir <span class='mainError'>números.</span>");
                    } else if (/[^a-zA-Z\s]/.test(fullName)) {
                        setError(4, "O nome completo não pode conter <span class='mainError'>caracteres especiais.</span>");
                    } else if (!/^(\w+\s\w+.*)$/.test(fullName)) {
                        setError(4, "Insira o <span class='mainError'>nome completo.</span> (pelo menos 2 palavras separadas por espaço)");
                    } else if (fullName.length > 100) {
                        setError(4, "O nome completo é <span class='mainError'>longo demais.</span>");
                    } else {
                        removeError(4);
                    }
                }

                function validatePhone() {
                    const phone = validateInputs[5].value;
                    const phoneRegex = /^\d{10,11}$/;

                    checkEmptyInput(5);
                    if (phone.length === 0) {
                        removeError(5);
                    } else if (!phoneRegex.test(phone)) {
                        setError(5, "Insira um <span class='mainError'>telefone válido.</span>");
                    } else {
                        removeError(5);
                    }
                }

                validateInputs[0].addEventListener('input', validateName);
                validateInputs[1].addEventListener('input', validateEmail);
                validateInputs[2].addEventListener('input', validatePassword);
                validateInputs[3].addEventListener('input', validateConfirmPassword);
                validateInputs[4].addEventListener('input', validateFullName);
                validateInputs[5].addEventListener('input', validatePhone);
            }

            function toggleRegisterSections() {
                const registerSections = document.querySelectorAll('.Re-registerSections');
                const nextButton = document.querySelector('.Re-registerNext');
                const backButton = document.querySelector('.Re-backButton');
                const submitButton = document.querySelector('.Re-registerSubmit');

                let currentSectionIndex = 0;

                function updateButtonVisibility() {
                    backButton.classList.toggle('close', currentSectionIndex === 0);
                    nextButton.classList.toggle('close', currentSectionIndex === registerSections.length - 1);
                    submitButton.classList.toggle('close', currentSectionIndex !== registerSections.length - 1);
                }

                function showSection(index) {
                    registerSections[currentSectionIndex].classList.add('close');
                    registerSections[index].classList.remove('close');
                    currentSectionIndex = index;
                    updateButtonVisibility();
                }


                nextButton.addEventListener('click', () => {
                    if (currentSectionIndex < registerSections.length - 1) {
                        showSection(currentSectionIndex + 1);
                    }
                });

                backButton.addEventListener('click', () => {
                    if (currentSectionIndex > 0) {
                        showSection(currentSectionIndex - 1);
                    }
                });
            }

            userValidations();
            toggleRegisterSections();
        </script>
    </body>
</html>