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
                            <input class="Re-userInput validate blank" type="text" id="nomeUsuario" name="userRegistro" oninput="validateName()" onclick="validateName()" required autofocus>
                            <label class="Re-fakePlaceholder" for="nomeUsuario">Usuário</label>
                            <span class="userArroba">@</span>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputEmail">
                            <input class="Re-userInput validate blank" type="email" id="email" name="emailRegistro" autocomplete="email" oninput="validateEmail()" required>
                            <label class="Re-fakePlaceholder" for="email">E-mail</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputPassword">
                            <input class="Re-userInput validate blank" type="password" id="senha" name="senhaRegistro" oninput="validatePassword()" required>
                            <label class="Re-fakePlaceholder" for="senha">Senha</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputConfirmPassword">
                            <input class="Re-userInput validate blank" type="password" id="confirmarSenha" name="senhaRegistroConfirma" oninput="validateConfirmPassword()" required>
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
                            <input class="Re-userInput validate blank" type="text" id="nomeCompleto" name="nomeUsuarioRegistro" oninput="validateFullName()" required>
                            <label class="Re-fakePlaceholder" for="nomeCompleto">Nome Completo</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>
                        <div class="Re-input inputCell">
                            <input class="Re-userInput validate" type="number" id="telefone" name="telefoneRegistro" oninput="validatePhone()"/>
                            <label class="Re-fakePlaceholder" for="telefone">Telefone</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>
                        <div class="Re-input inputDataNasc">
                            <input class="Re-userInput validate blank" type="date" id="dataNascimento" name="dataNascimentoRegistro" onchange="validateBornDate()" required>
                            <label class="Re-fakePlaceholder notEmpty" for="dataNascimento">Data de Nascimento</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>
                        <div class="Re-input inputLocal">
                            <select class="Re-userInput validate blank" name="localizacaoRegistro" id="localizacao" onchange="validateLocal()" required>
                                <option value=""></option>
                                <option value="Não Informar"> Não Informar</option>
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
                            <label class="Re-fakePlaceholder" for="localizacao" style="pointer-events: none;">Localização</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>
                        <div class="Re-input input-full inputBio">
                            <textarea class="Re-userInput validate" name="biografiaUsuarioRegistro" id="biografiaUsuario" style="resize: none;" oninput="validateBio()"></textarea>                        
                            <label class="Re-fakePlaceholder" for="biografiaUsuario">Biografia</label>
                            <div class="Re-charactersCounter">
                                <span class="Re-charactersNumber">0</span>/<span class="Re-maxCharacters">257</span>
                            </div>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>
                    </div>

                    <div class="Re-registerResult Re-registerSections close">
                        <div class="Re-addImageProfile">
                            <input type="file" class="validate" id="imagesSelector" name="fotoPerfilRegistro" input="validateImageProfile();" accept="image/png, image/jpeg">
                            <label for="imagesSelector" class="Re-userImageProfile">
                                <div>
                                    <img src="../app/assets/imagens/icons/user_no_profile_image.png" class="Re-userImage">
                                </div>
                                <i class="bi bi-camera-fill Re-addImageIcon"></i>                    
                            </label>
                        </div>

                        <div class="Re-userInfoContainer">
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel infoName">Nome:</p>
                                <p class="Re-userInfo" id="infoNomeCompleto"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel infoUser">Usuário:</p>
                                <p class="Re-userInfo" id="infoNomeUsuario"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel infoEmail">E-mail:</p>
                                <p class="Re-userInfo" id="infoEmail"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel infoPhone">Telefone:</p>
                                <p class="Re-userInfo" id="infoTelefone"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel infoDate">Data de Nascimento:</p>
                                <p class="Re-userInfo" id="infoDataNascimento"></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel infoLocal">Localização:</p>
                                <p class="Re-userInfo" id="infoLocalizacao"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="Re-registerTerms close">
                    <div class="Re-termsHeader">
                        <h4 class="Re-termsType Re-usingTerms active" onclick="toggleTermsType(this)">Termos de Uso</h4>
                        <h4 class="Re-termsType Re-privacyTerms" onclick="toggleTermsType(this)">Políticas de Privacidade</h4>
                        <span class="Re-termsSelector"></span>
                    </div>
                    
                    <div class="Re-termsPDF">
                        <div class="Re-usingTermsPDF"></div>
                        <div class="Re-privacyTermsPDF"></div>
                    </div>

                    <div class="Re-termsCheckboxes">
                        <div class="Re-termsCheckbox">
                            <input type="checkbox" id="usingTermsCheckbox" required>
                            <label for="usingTermsCheckbox">Eu li e concordo com os <a href="../documents\termos_de_uso_ConectaMaes.pdf" target="_blank">termos de uso</a>.</label>
                        </div>
                        <div class="Re-termsCheckbox">
                            <input type="checkbox" id="privacyTermsCheckbox" required>
                            <label for="privacyTermsCheckbox">Eu li e concordo com as <a href="../documents\politicas_de_privacidade_ConectaMaes.pdf" target="_blank">políticas de privacidade</a>.</label>
                        </div>
                    </div>

                    <div class="Re-termsButtons">
                        <h1 class="Re-denyTermsBtn confirmBtn">Cancelar</h1>
                        <button class="Re-registerSubmit confirmBtn" type="submit" name="registrar">Confirmar</button>                    
                    </div>
                </div>

                <div class="Re-registerBottom">
                    <button class="Re-registerNext confirmBtn" name="proximo" type="button">Próximo</button>
                    <p class="Re-goLogin">Já possui uma conta? <a id="Re-goLoginLink" href="login.php">Entre</a></p>
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

                var maxChar = 0;

                function setError(index, message){
                    inputContainers[index].style.border = "2px solid var(--redColor)";
                    placeholders[index].style.color = "var(--redColor)";
                    errorMessageContent[index].innerHTML = `<i class="bi bi-x-circle-fill mainError"></i><span class="errorMessage">${message}</span>`;
                    errorMessageContent[index].style.display = "flex";
                    errorIcon[index].style.display = "block";

                    validateInputs[index].classList.add('wEror');

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

                    validateInputs[index].classList.remove('wEror');
                    validateInputs[index].classList.remove('blank');
                }

                function checkEmptyInput(index){
                    if(validateInputs[index].value !== ""){
                        placeholders[index].classList.add('notEmpty');
                        inputContainers[index].style.opacity = "1";
                    } else {
                        placeholders[index].classList.remove('notEmpty');
                        inputContainers[index].style.opacity = "0.5";
                        inputContainers[index].style.border = "2px solid transparent";
                        placeholders[index].style.color = "var(--secondColor)";
                        errorMessageContent[index].innerHTML = '';
                        errorIcon[index].style.display = "none";                    }
                }

                function validateName(){
                    const username = validateInputs[0].value;
                    maxChar = 50;

                    checkEmptyInput(0);
                    if(username.length === 0){
                        checkEmptyInput(0);
                    } else if(username.length <= 3){
                        setError(0, "O nome de usuário deve ter mais de <span class='mainError'>3 caracteres.</span>");
                    } else if(username.length > maxChar){
                        setError(0, "O nome de usuário é <span class='mainError'>longo demais.</span>");
                        username = username.slice(0, maxChar);
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
                    maxChar = 256;

                    checkEmptyInput(1);

                    if(email.length === 0){
                        checkEmptyInput(1);
                    } else if (email.length > maxChar) {
                        setError(1, "O e-mail é <span class='mainError'>longo demais.</span>");
                        email = email.slice(0, maxChar);
                    } else if (!emailRegex.test(email)) {
                        setError(1, "Insira um <span class='mainError'>e-mail válido.</span>");
                    } else {
                        removeError(1);
                    }
                }    

                function validatePassword() {
                    const password = validateInputs[2].value;
                    const hasUpperCase = /[A-Z]/.test(password);
                    const hasLowerCase = /[a-z]/.test(password);
                    const hasDigit = /\d/.test(password);
                    maxChar = 100;
                    
                    checkEmptyInput(2);
                    validateConfirmPassword();

                    if(password.length === 0){
                        checkEmptyInput(2);
                    } else if (password.length < 8) {
                        setError(2, "A senha deve ter mais de <span class='mainError'>8 caracteres.</span>");
                    } else if (password.length > maxChar) {
                        setError(2, "A senha é <span class='mainError'>longa demais.</span>");
                        password = password.slice(0, maxChar);
                    } else if (!hasUpperCase) {
                        setError(2, "A senha deve conter <span class='mainError'>letras maiúsculas.</span>");
                    } else if (!hasLowerCase) {
                        setError(2, "A senha deve conter <span class='mainError'>letras minúsculas.</span>");
                    } else if (!hasDigit) {
                        setError(2, "A senha deve conter <span class='mainError'>números.</span>");
                    } else {
                        removeError(2);
                    }
                }

                function validateConfirmPassword(){
                    const confirmPassword = validateInputs[3].value;
                    const password = validateInputs[2].value;

                    checkEmptyInput(3);
                    if(confirmPassword.length === 0){
                        checkEmptyInput(3);
                    } else if(password !== confirmPassword){
                        setError(3, "As senhas <span class='mainError'>não coincidem.</span>");
                    } else{
                        removeError(3);
                    }
                }
                
                function validateFullName() {
                    const fullName = validateInputs[4].value;
                    maxChar = 100;

                    checkEmptyInput(4);

                    const nameRegex = /^[a-zA-ZÀ-ÖØ-ÿ' -]+$/;

                    if (fullName.length === 0) {
                        checkEmptyInput(4);
                    } else if (fullName.length > maxChar) {
                        setError(4, "O nome é <span class='mainError'>longo demais.</span>");
                    } else if (/\d/.test(fullName)) {
                        setError(4, "O nome não pode possuir <span class='mainError'>números.</span>");
                    } else if (!nameRegex.test(fullName)) {
                        setError(4, "O nome pode conter apenas <span class='mainError'>letras, espaços, acentos, hífens, cedilhas e apóstrofos.</span>");
                    } else if (!/^(\w+\s\w+.*)$/.test(fullName)) {
                        setError(4, "Insira o seu <span class='mainError'>nome completo.</span>");
                    } else {
                        removeError(4);
                    }
                }

                function validatePhone() {
                    const validDDDs = [
                        '61', '62', '64', '65', '66', '67', // Centro-Oeste
                        '82', '71', '73', '74', '75', '77', // Nordeste
                        '85', '88', '98', '99', '83', '81', '87', '86', '89', '84', '79', // Nordeste
                        '68', '96', '92', '97', '91', '93', '94', '69', '95', '63', // Norte
                        '27', '28', '31', '32', '33', '34', '35', '37', '38', // Sudeste
                        '21', '22', '24', '11', '12', '13', '14', '15', '16', '17', '18', '19', // Sudeste
                        '41', '42', '43', '44', '45', '46', // Sul
                        '51', '53', '54', '55', '47', '48', '49' // Sul
                    ];

                    const phone = validateInputs[5].value;
                    const ddd = phone.substring(0, 2); // Extrai os primeiros dois dígitos como DDD
                    const phoneRegex = /^\d{10,11}$/;

                    maxChar = 11;

                    checkEmptyInput(5);
                    if (phone.length === 0) {
                        checkEmptyInput(5);
                    } else if (phone.length > maxChar) {
                        setError(5, "O número de telefone é <span class='mainError'>longo demais.</span>");
                    } else if (!phoneRegex.test(phone)) {
                        setError(5, "Insira um <span class='mainError'>telefone válido.</span>");
                    } else if (!validDDDs.includes(ddd)) {
                        setError(5, "Insira um <span class='mainError'>DDD válido.</span>");
                    } else {
                        removeError(5);
                    }
                }

                function validateBornDate() {
                    const birthDate = new Date(validateInputs[6].value);
                    const today = new Date();
                    const hundredYearsAgo = new Date(today.setFullYear(today.getFullYear() - 100));
                    
                    checkEmptyInput(6);

                    if (validateInputs[6].value === "") {
                        checkEmptyInput(6);
                        placeholders[6].classList.add('notEmpty');
                    } else if (birthDate > new Date()) {
                        setError(6, "A data de nascimento não pode ser uma <span class='mainError'>data futura.</span>");
                    } else if (birthDate < hundredYearsAgo) {
                        setError(6, "A data de nascimento é <span class='mainError'>muito antiga.</span>");
                    } else {
                        removeError(6);
                    }
                }

                function validateLocal() {
                    const localizacao = validateInputs[7].value;

                    checkEmptyInput(7);

                    if (localizacao == "") {
                        inputContainers[7].style.opacity = '1';
                        setError(7, "Selecione ao menos <span class='mainError'>uma opção.</span>");
                    } else {
                        removeError(7);
                    }
                }

                function validateBio() {
                    const bioInput = document.querySelector('.Re-userInput.validate');
                    const characters = document.querySelector('.Re-charactersCounter');
                    const charactersNumber = document.querySelector('.Re-charactersNumber');
                    const maxCharacters = document.querySelector('.Re-maxCharacters');
                    const biography = validateInputs[8].value;
                    
                    charactersNumber.textContent = biography.length;
                    maxChar = 257;

                    checkEmptyInput(8);

                    if (biography.length === 0) {
                        validateInputs[8].style.color = "";
                        checkEmptyInput(8);
                    } else if (biography.length > maxChar) {
                        validateInputs[8].style.color = "var(--redColor)";
                        setError(8, "A biografia é <span class='mainError'>muito longa.</span>");
                    } else {
                        characters.style.color = "";
                        validateInputs[8].style.color = "";
                        removeError(8);
                    }
                }
                
                function validateImageProfile() {
                    const input = document.getElementById("imagesSelector");
                    const preview = document.querySelector(".Re-userImage");

                    input.addEventListener("change", function () {
                        const file = input.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                preview.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }

                validateInputs[0].addEventListener('input', validateName);
                validateInputs[1].addEventListener('input', validateEmail);
                validateInputs[2].addEventListener('input', validatePassword);
                validateInputs[3].addEventListener('input', validateConfirmPassword);
                validateInputs[4].addEventListener('input', validateFullName);
                validateInputs[5].addEventListener('input', validatePhone);
                validateInputs[6].addEventListener('change', validateBornDate);
                validateInputs[7].addEventListener('change', validateLocal);
                validateInputs[8].addEventListener('input', validateBio);
                validateInputs[9].addEventListener('input', validateImageProfile);
            }

            function toggleRegisterSections() {
                const sections = document.querySelectorAll('.Re-registerSections');
                const nextButton = document.querySelector('.Re-registerNext');
                const backButton = document.querySelector('.Re-backButton');

                const termsSection = document.querySelector('.Re-registerTerms');
                const denyTermsBtn = document.querySelector('.Re-denyTermsBtn');

                let currentIndex = 0;

                const showSection = (index) => {
                    sections[currentIndex].classList.add('close');
                    sections[index].classList.remove('close');
                    currentIndex = index;
                    backButton.classList.toggle('close', currentIndex === 0);
                };

                const validateSection = (index) => {
                    return Array.from(sections[index].querySelectorAll('.validate')).every(input =>
                        !input.hasAttribute('required') || (!input.classList.contains('wEror') && !input.classList.contains('blank') && input.value.trim() !== '')
                    );
                };

                nextButton.addEventListener('click', () => {
                    if (currentIndex === sections.length - 1) {
                        if (validateSection(currentIndex)) {
                            termsSection.classList.remove('close');
                            registerTerms();
                        }
                    } else {
                        if (validateSection(currentIndex)) {
                            if (currentIndex < sections.length - 1) showSection(currentIndex + 1);
                        } else {
                            alert("Preencha todos os campos corretamente antes de prosseguir");
                        }
                    }
                });

                backButton.addEventListener('click', () => {
                    if (currentIndex > 0) showSection(currentIndex - 1);
                });

                function registerTerms() {
                    denyTermsBtn.addEventListener('click', () => {
                        termsSection.classList.add('close');
                        registerTerms();
                    });

                    function toggleTermsType(clicked) {
                        const termsType = document.querySelectorAll('.Re-termsType');
                        const termsSelector = document.querySelector('.Re-termsSelector');

                        termsType.forEach(termType => {
                            termType.classList.remove('active');
                        });

                        clicked.classList.add('active');

                        if (clicked.classList.contains('Re-usingTerms')) {
                            termsSelector.style.transform = 'translateX(0)';
                        } else if (clicked.classList.contains('Re-privacyTerms')) {
                            termsSelector.style.transform = 'translateX(100%)';
                        }
                    }

                    document.querySelectorAll('.Re-termsType').forEach(termType => {
                        termType.addEventListener('click', () => {
                            toggleTermsType(termType);
                        });
                    });

                    function validateSubmit() {
                        const privacyTermsCheckbox = document.querySelector('#privacyTermsCheckbox');
                        const usingTermsCheckbox = document.querySelector('#usingTermsCheckbox');
                        const submitButton = document.querySelector('.Re-registerSubmit');

                        submitButton.addEventListener('click', (event) => {
                            if (!privacyTermsCheckbox.checked || !usingTermsCheckbox.checked) {
                                event.preventDefault();
                                alert("Você deve ler e concordar com os termos de uso e as políticas de privacidade antes de completar o registro!");
                            }
                        });
                    }


                    if (!termsSection.classList.contains('close')) {
                        backButton.style.pointerEvents = 'none';
                        backButton.style.color = 'var(--grayColor)';

                        nextButton.style.pointerEvents = 'none';
                        nextButton.style.backgroundColor = 'var(--grayColor)';
                    } else {
                        backButton.style.pointerEvents = 'all';
                        backButton.style.color = '';

                        nextButton.style.pointerEvents = 'all';
                        nextButton.style.backgroundColor = '';
                    }

                    validateSubmit();
                }
            }

            userValidations();
            toggleRegisterSections();
        </script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </body>
</html>
