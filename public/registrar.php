<?php     
    require_once "../app/services/helpers/authUser.php";
    validateRememberedCookie($conn, "home.php");
?>

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
                    <div class="Re-accountInformations Re-registerSections ">
                        <div class="Re-input inputUserName">
                            <input class="Re-userInput validate" type="text" id="nomeUsuario" name="userRegistro" required autofocus>
                            <label class="Re-fakePlaceholder" for="nomeUsuario">Usuário</label>
                            <span class="userArroba">@</span>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputEmail">
                            <input class="Re-userInput validate" type="email" id="email" name="emailRegistro" autocomplete="email" required>
                            <label class="Re-fakePlaceholder" for="email">E-mail</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputPassword">
                            <input class="Re-userInput validate" type="password" id="senha" name="senhaRegistro" required>
                            <label class="Re-fakePlaceholder" for="senha">Senha</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputConfirmPassword">
                            <input class="Re-userInput validate" type="password" id="confirmarSenha" name="senhaRegistroConfirma" required>
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
                            <input class="Re-userInput validate" type="text" id="nomeCompleto" name="nomeUsuarioRegistro" required>
                            <label class="Re-fakePlaceholder" for="nomeCompleto">Nome Completo</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputCell">
                            <input class="Re-userInput validate" type="text" id="telefone" name="telefoneRegistro" pattern="^\d{10,11}$"/>
                            <label class="Re-fakePlaceholder" for="telefone">Telefone</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputDataNasc">
                            <input class="Re-userInput validate" type="date" id="dataNascimento" name="dataNascimentoRegistro" required>
                            <label class="Re-fakePlaceholder notEmpty" for="dataNascimento">Data de Nascimento</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-input inputLocal">
                            <input class="Re-userInput validate" type="text" name="localizacaoRegistro" id="localizacao" pattern="^\d{8}$" required>
                            <label class="Re-fakePlaceholder" for="localizacao">CEP</label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                            <p class="CEPResult"></p>
                        </div>

                        <div class="Re-input input-full inputBio">
                            <textarea class="Re-userInput validate" name="biografiaUsuarioRegistro" id="biografiaUsuario"></textarea>                        
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
                        <div class="Re-input Re-addImageProfile">
                            <input type="file" class="validate" id="imagesSelector" name="fotoPerfilRegistro" input="validateImageProfile();" accept="image/png, image/jpeg">
                            <label for="imagesSelector" class="Re-imageProfileLabel">
                                <div>
                                    <img src="../app/assets/imagens/icons/user_no_profile_image.png" class="Re-userImage" alt="Imagem do perfil padrão">
                                </div>
                                <i class="bi bi-camera-fill Re-addImageIcon"></i>                    
                            </label>
                            <i class="bi bi-info-circle-fill errorIcon"></i>
                            <div class="errorMessageContainer">
                                <div class="errorMessageContent"></div>
                            </div>
                        </div>

                        <div class="Re-userInfoContainer">
                            <div class="Re-userInformations">
                                <p class="Re-userInfo" id="infoNomeCompleto">
                                    <span class="Re-resultLable">Nome: </span><span class="Re-userData"></span>
                                </p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-userInfo" id="infoNomeUsuario">
                                    <span class="Re-resultLable">Nome de usuário: </span><span class="Re-userData"></span>
                                </p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-userInfo" id="infoEmail">
                                    <span class="Re-resultLable">E-mail: </span><span class="Re-userData"></span>
                                </p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-userInfo" id="infoTelefone">
                                    <span class="Re-resultLable">Telefone: </span><span class="Re-userData"></span>
                                </p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-userInfo" id="infoDataNascimento">
                                    <span class="Re-resultLable">Data de Nasc.: </span><span class="Re-userData"></span>
                                </p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-userInfo" id="infoLocalizacao">
                                    <span class="Re-resultLable">CEP: </span><span class="Re-userData"></span><span class="CEPResult"></span>
                                </p>
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
                        <div class="Re-usingTermsPDF">
                            <embed src="<?=$relativeRootPath."/documents/termos_de_uso_ConectaMaes.pdf"?>" width="100%" height="auto" style="overflow: hidden;" type="application/pdf">
                        </div>
                        <div class="Re-privacyTermsPDF" style="display: none;">
                            <embed src="<?=$relativeRootPath ."/documents/politicas_de_privacidade_ConectaMaes.pdf"?>" width="500" height="auto" style="overflow: hidden;" type="application/pdf">
                        </div>
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
        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
        <script>  
            document.querySelectorAll('.Re-userInput').forEach(input => {
                const updateInfo = (event) => {
                        const inputId = event.target.id;
                        const infoElement = document.getElementById('info' + inputId.charAt(0).toUpperCase() + inputId.slice(1));

                        // Verifica se o elemento infoElement existe
                        if (!infoElement) return;
                        
                        const userDataElement = infoElement.querySelector('.Re-userData'); // Elemento que conterá o dado inserido
                        let value = event.target.value;

                        // Formatação do telefone
                        if (inputId === 'telefone') {
                            value = value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
                            if (value.length === 11) {
                                value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
                            } else if (value.length === 10) {
                                value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
                            }
                        }

                        // Formatação do CEP
                        if (inputId === 'localizacao') {
                            value = value.replace(/\D/g, ''); // Remove qualquer caractere não numérico
                            if (value.length === 8) {
                                value = value.replace(/^(\d{5})(\d{3})$/, '$1-$2');
                            }
                        }

                        // Formatação da data de nascimento
                        if (inputId === 'dataNascimento') {
                            const dateParts = value.split('-');
                            if (dateParts.length === 3) {
                                value = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
                            }
                        }

                        // Atualiza o conteúdo do elemento de exibição
                        if (userDataElement) {
                            userDataElement.textContent = value; // Apenas o dado é alterado, mantendo o estilo do label
                        }
                    };

                input.addEventListener('input', updateInfo);

                document.getElementById("telefone").addEventListener("input", function(e) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, ''); // Remove qualquer caractere que não seja número
                });

                document.getElementById("localizacao").addEventListener("input", function(e) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, ''); // Remove qualquer caractere que não seja número
                });
            }); 
            

            /*
            document.getElementById("telefone").addEventListener("input", function(event) {
                // Obtém o valor do input, mas sem formatação
                let rawValue = event.target.value.replace(/\D/g, '');

                // Mantenha o valor real sem formatação (que será utilizado no banco de dados)
                event.target.dataset.rawValue = rawValue;

                // Formatação do telefone para visualização
                if (rawValue.length <= 11) {
                    // Formato para telefone celular: (XX) XXXXX-XXXX
                    event.target.value = rawValue.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
                } else if (rawValue.length <= 10) {
                    // Formato para telefone fixo: (XX) XXXX-XXXX
                    event.target.value = rawValue.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
                } else {
                    // Se houver mais de 11 dígitos, apenas aplica a máscara até o número permitido
                    event.target.value = rawValue.substring(0, 11).replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
                }
            });

            // Quando for necessário obter o valor real, utilize `dataset.rawValue`
            */

            function userValidations() {
                const validateInputs = document.querySelectorAll('.validate');
                const inputContainers = document.querySelectorAll('.Re-input');
                const placeholders = document.querySelectorAll('.Re-fakePlaceholder');
                const errorMessageContainers = document.querySelectorAll('.errorMessageContainer');
                const errorMessageContent = document.querySelectorAll('.errorMessageContent');
                const errorIcon = document.querySelectorAll('.errorIcon');

                function setErrors(index, errors) {
                    inputContainers[index].style.borderColor = "var(--redColor)";
                    placeholders[index].style.color = "var(--redColor)";
                    validateInputs[index].classList.remove('correct');
                    validateInputs[index].classList.add('wEror');

                    errorIcon[index].className = "bi bi-x-circle-fill errorIcon";
                    errorIcon[index].style.display = "block";
                    errorIcon[index].style.color = "var(--redColor)";
                    errorIcon[index].style.pointerEvents = "all";

                    const errorHTML = errors.map(err => `<i class="bi bi-x-circle-fill">${err}</i>`).join('<br>');
                    errorMessageContent[index].innerHTML = errorHTML;
                    errorMessageContent[index].style.display = "flex";

                    errorIcon[index].addEventListener('click', () => {
                        errorMessageContainers[index].style.display =
                            errorMessageContainers[index].style.display === 'flex' ? 'none' : 'flex';
                    });

                    errorIcon[index].addEventListener('mouseover', () => {
                        errorMessageContainers[index].style.display = 'flex';
                    });

                    errorIcon[index].addEventListener('mouseout', () => {
                        errorMessageContainers[index].style.display = 'none';
                    });
                }

                function removeErrors(index) {
                    inputContainers[index].style.border = "2px solid transparent";
                    placeholders[index].style.color = "var(--secondColor)";
                    validateInputs[index].classList.remove('wEror');

                    errorMessageContent[index].innerHTML = '';
                    errorIcon[index].style.display = "none";
                }

                function checkEmptyInput() {
                    validateInputs.forEach((input, index) => {
                        const placeholder = placeholders[index];
                        const inputContainer = inputContainers[index];
                        const errorMessage = errorMessageContent[index];
                        const errorIconElement = errorIcon[index];

                        // Verifica se os elementos existem antes de acessar suas propriedades
                        if (!placeholder || !inputContainer || !errorMessage || !errorIconElement) {
                            return; // Ignora índices inválidos
                        }

                        if (input.value !== "") {
                            placeholder.classList.add('notEmpty');
                            inputContainer.style.opacity = "1";
                        } else {
                            if (index !== 9) { // Preserva a opacidade para o índice 9
                                inputContainer.style.opacity = "0.5";
                            }
                            inputContainer.style.border = "2px solid transparent";
                            errorMessage.innerHTML = '';
                            errorIconElement.style.display = "none";

                            // Evita alterações específicas no índice 6
                            if (index !== 6) {
                                placeholder.classList.remove('notEmpty');
                                placeholder.style.color = "var(--secondColor)";
                            }
                        }
                    });
                }

                function setCorrectInput(index) {
                    inputContainers[index].style.border = "2px solid var(--secondColor)";
                    placeholders[index].style.color = "var(--thirdColor)";
                    validateInputs[index].classList.remove('wEror');
                    validateInputs[index].classList.add('correct');
                    
                    errorIcon[index].className = "bi bi-check-circle-fill errorIcon";
                    errorIcon[index].style.display = "block";
                    errorIcon[index].style.color = "var(--secondColor)";
                    errorIcon[index].style.pointerEvents = "none";

                    errorMessageContainers[index].style.display = "none";
                }

                function checkError(indexInput, errors) {
                    if (errors.length) {
                        setErrors(indexInput, errors);
                    } else {
                        removeErrors(indexInput);
                        setCorrectInput(indexInput);
                    }
                }

                function limitMaxCharactersInput(input, maxChar) {
                    input.addEventListener("keydown", (event) => {
                        // Permitir teclas especiais como Backspace, Tab, Delete, setas de navegação, etc.
                        const allowedKeys = [
                            "Backspace",
                            "Tab",
                            "ArrowLeft",
                            "ArrowRight",
                            "ArrowUp",
                            "ArrowDown",
                            "Delete"
                        ];

                        // Impedir inserção se o valor atual já atingiu o limite e a tecla pressionada não for uma tecla especial
                        if (input.value.length >= maxChar && !allowedKeys.includes(event.key)) {
                            event.preventDefault(); // Bloqueia a inserção adicional
                        }
                    });

                    // Limita o valor atual para o máximo permitido, caso já esteja acima
                    input.addEventListener("input", () => {
                        if (input.value.length > maxChar) {
                            input.value = input.value.substring(0, maxChar); // Trunca o valor
                        }
                    });
                }

                async function checkIfExists(field, value) {
                    try {
                        const response = await fetch('<?= $_SERVER['PHP_SELF']?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `registerField=${field}&registerValue=${encodeURIComponent(value)}`
                        });
                        const result = await response.json();
                        return result.exists;
                    } catch (error) {
                        console.error('Erro ao verificar o campo:', error);
                        return false;
                    }
                }

                async function validateUsername() {
                    const username = validateInputs[0].value.trim();
                    const indexInput = 0;
                    const errors = [];
                    const maxChar = 50;

                    limitMaxCharactersInput(validateInputs[indexInput], maxChar);
                    if (username.length >= maxChar) errors.push("O nome de usuário é longo demais.");
                    if (username.length <= 3) errors.push("O nome de usuário deve ter mais de 3 caracteres.");
                    if (/[^a-zA-Z0-9_]/.test(username)) errors.push("Apenas letras, números e underscore '_' são permitidos.");

                    const exists = await checkIfExists('nomeDeUsuario', username);
                    if (exists) errors.push("Nome de usuário já em uso.");

                    checkError(indexInput, errors);
                }

                async function validateEmail() {
                    const email = validateInputs[1].value.trim();
                    const indexInput = 1;
                    const errors = [];
                    const maxChar = 256;

                    limitMaxCharactersInput(validateInputs[indexInput], maxChar);
                    if (email.length >= maxChar) errors.push("O e-mail é longo demais.");
                    if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) errors.push("Insira um e-mail válido.");

                    const exists = await checkIfExists('email', email);
                    if (exists) errors.push("E-mail já cadastrado.");
                    
                    checkError(indexInput, errors);
                }

                async function validatePhone() {
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
                    const indexInput = 5;
                    const errors = [];
                    const maxChar = 11 + 1; //Limite de caracteres do input +1 para a validação

                    limitMaxCharactersInput(validateInputs[indexInput], maxChar);
                    
                    if (phone.length >= maxChar) errors.push("O telefone é longo demais.");
                        else if (!validDDDs.includes(ddd)) errors.push("Insira um DDD válido.");
                        else if (phone.length != 10 && phone.length != 11) errors.push("Insira um telefone válido.");
    
                    checkError(indexInput, errors);               
                }

                function validatePassword() {                    
                    const password = validateInputs[2].value;
                    const indexInput = 2;
                    const errors = [];
                    const maxChar = 100 + 1; //Limite de caracteres do input +1 para a validação

                    limitMaxCharactersInput(validateInputs[indexInput], maxChar);

                    if (password.length >= maxChar) errors.push("A senha é longa demais.");
                    if (password.length < 8) errors.push("A senha deve ter mais de 8 caracteres.");
                    if (!/[A-Z]/.test(password)) errors.push("A senha deve conter ao menos uma letra maiúscula.");
                    if (!/[a-z]/.test(password)) errors.push("A senha deve conter ao menos uma letra minúscula.");
                    if (!/\d/.test(password)) errors.push("A senha deve conter ao menos um número.");

                    checkError(indexInput, errors);               
                }

                function validateConfirmPassword() {
                    const confirmPassword = validateInputs[3].value;
                    const indexInput = 3;
                    const password = validateInputs[2].value;
                    const errors = [];

                    if (confirmPassword !== password) errors.push("As senhas não coincidem.");

                    checkError(indexInput, errors);               
                }

                function validateFullName() {
                    const fullName = validateInputs[4].value;
                    const indexInput = 4;
                    const errors = [];
                    const maxChar = 100 + 1; //Limite de caracteres do input +1 para a validação

                    limitMaxCharactersInput(validateInputs[indexInput], maxChar);

                    if (fullName.length >= maxChar) errors.push("O nome é longo demais.");
                    if (/\d/.test(fullName)) errors.push("O nome não pode conter números.");
                        else if (!/^([a-zA-ZÀ-ÖØ-öø-ÿ'’\-\s]+)$/.test(fullName)) errors.push("Apenas letras, acentos, hífens e apóstrofos são permitidos.");

                    checkError(indexInput, errors);               
                }

                function validateBornDate() {
                    const birthDate = new Date(validateInputs[6].value);
                    const indexInput = 6;
                    const today = new Date();
                    const hundredYearsAgo = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());
                    const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
                    const errors = [];

                    if (birthDate > today) errors.push("A data de nascimento não pode ser uma data futura.");
                        else if (birthDate < hundredYearsAgo) errors.push("A data de nascimento é muito antiga.");
                        else if (birthDate > eighteenYearsAgo) errors.push("Você precisa ser maior de 18 anos.");

                    checkError(indexInput, errors);   
                }

                async function fetchCepData(cep) {
                    try {
                        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                        if (!response.ok) {
                            throw new Error("Erro ao consultar o CEP.");
                        }

                        const data = await response.json();
                        if (data.erro) {
                            throw new Error("O CEP informado não foi encontrado.");
                        }

                        return data;
                    } catch (error) {
                        console.error(error.message);
                        throw error;
                    }
                }

                async function validateLocal() {
                    const cep = validateInputs[7].value.trim();
                    const indexInput = 7;
                    const errors = [];
                    const maxChar = 8 + 1; //Limite de caracteres do input +1 para a validação

                    limitMaxCharactersInput(validateInputs[indexInput], maxChar);

                    if (cep.length >= maxChar) errors.push("O CEP é longo demais.");
                        else if (!/^\d{8}$/.test(cep)) errors.push("Insira um CEP válido."); // Verifica se são 8 dígitos numéricos

                    checkError(indexInput, errors);

                    const cepResultElement = document.querySelector(".CEPResult");
                    cepResultElement.textContent = ""; 

                    try {
                        const data = await fetchCepData(cep);
    
                        cepResultElement.textContent = `${data.localidade}, ${data.uf}`;

                        checkError(indexInput, []);
                    } catch (error) {
                        /*checkError(indexInput, [error.message]);*/
                            //"FAILED TO FETCH" = Comentado para evitar o erro por enquanto
                    }
                }

                function validateBio() {
                    const biography = validateInputs[8].value.trim();
                    const indexInput = 8;
                    const charactersNumber = document.querySelector('.Re-charactersNumber');
                    const errors = [];
                    const maxChar = 256 + 1; //Limite de caracteres do input +1 para a validação

                    limitMaxCharactersInput(validateInputs[indexInput], maxChar);
                    charactersNumber.textContent = biography.length;

                    if (biography.length >= maxChar) errors.push("A biografia é longa demais.");

                    checkError(indexInput, errors);               
                }

                function validateImageProfile() {
                    const imageProfile = validateInputs[9];
                    const preview = document.querySelector(".Re-userImage");
                    const indexInput = 9;
                    const errors = [];

                    if (imageProfile.files && imageProfile.files[0]) {
                        const file = imageProfile.files[0];
                        if (!["image/jpeg", "image/png"].includes(file.type)) {
                            errors.push("Apenas imagens PNG ou JPEG são permitidas.");
                        }
                        if (file.size > 2 * 1024 * 1024) { // 2MB
                            errors.push("A imagem não pode exceder 2MB.");
                        }

                        if (!errors.length) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                preview.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    }

                    checkError(indexInput, errors);
                }

                validateInputs.forEach((input, index) => {
                    input.addEventListener('input', () => {
                        switch (index) {
                            case 0:
                                validateUsername();
                                break;
                            case 1:
                                validateEmail();
                                break;
                            case 2:
                                validatePassword();
                                break;
                            case 3:
                                validateConfirmPassword();
                                break;
                            case 4:
                                validateFullName();
                                break;
                            case 5:
                                validatePhone();
                                break;
                            case 6:
                                validateBornDate();
                                break;
                            case 7:
                                validateLocal();
                                break;
                            case 8:
                                validateBio();
                                break;
                            case 9:
                                validateImageProfile();
                                break;
                        }

                        checkEmptyInput();
                    });
                });
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
                        !input.hasAttribute('required') || (!input.classList.contains('wEror') && input.value.trim() !== '')
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
                            alert("Preencha todos os campos antes de prosseguir. Caso existam, corrija os erros.");
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
                        const usingTermsPDF = document.querySelector('.Re-usingTermsPDF');
                        const privacyTermsPDF = document.querySelector('.Re-privacyTermsPDF');
                        privacyTermsPDF.style.display = 'none'; // Oculta o PDF de privacidade
                        termsType.forEach(termType => {
                            termType.classList.remove('active');
                        });

                        clicked.classList.add('active');

                        // Alterna entre os PDFs com base no botão clicado
                        if (clicked.classList.contains('Re-usingTerms')) {
                            termsSelector.style.transform = 'translateX(0)';  // Move o seletor para o lado dos termos de uso
                            usingTermsPDF.style.display = 'flex';  // Exibe o PDF de termos de uso
                            privacyTermsPDF.style.display = 'none'; // Oculta o PDF de privacidade
                        } else if (clicked.classList.contains('Re-privacyTerms')) {
                            termsSelector.style.transform = 'translateX(100%)'; // Move o seletor para o lado da privacidade
                            usingTermsPDF.style.display = 'none'; // Oculta o PDF de termos de uso
                            privacyTermsPDF.style.display = 'flex'; // Exibe o PDF de políticas de privacidade
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
    </body>
</html>
