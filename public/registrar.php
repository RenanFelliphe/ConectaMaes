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
                            <input class="Re-userInput validate blank"  type="number" name="localizacaoRegistro" id="localizacao" oninput="validateLocal()" required></input>
                            <label class="Re-fakePlaceholder" for="localizacao" style="pointer-events: none;">CEP</label>
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
                    infoElement.textContent = event.target.value;
                };

                input.addEventListener('input', updateInfo);
            });

            function userValidations() {
                const validateInputs = document.querySelectorAll('.validate');
                const inputContainers = document.querySelectorAll('.Re-input');
                const placeholders = document.querySelectorAll('.Re-fakePlaceholder');
                const errorMessageContainers = document.querySelectorAll('.errorMessageContainer');
                const errorMessageContent = document.querySelectorAll('.errorMessageContent');
                const errorIcon = document.querySelectorAll('.errorIcon');

                function setErrors(index, errors) {
                    inputContainers[index].style.border = "2px solid var(--redColor)";
                    placeholders[index].style.color = "var(--redColor)";
                    validateInputs[index].classList.add('wEror');

                    const errorHTML = errors.map(err => `<i class="bi bi-x-circle-fill mainError">${err}</i>`).join('<br>');
                    errorMessageContent[index].innerHTML = errorHTML;
                    errorMessageContent[index].style.display = "flex";
                    errorIcon[index].style.display = "block";

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
                    validateInputs[index].classList.remove('blank');

                    errorMessageContent[index].innerHTML = '';
                    errorIcon[index].style.display = "none";
                }

                function checkEmptyInput() {
                    validateInputs.forEach((input, index) => {
                        if (input.value !== "") {
                            placeholders[index].classList.add('notEmpty');
                            inputContainers[index].style.opacity = "1";
                        } else {
                            placeholders[index].classList.remove('notEmpty');
                            inputContainers[index].style.opacity = "0.5";
                            inputContainers[index].style.border = "2px solid transparent";
                            placeholders[index].style.color = "var(--secondColor)";
                            errorMessageContent[index].innerHTML = '';
                            errorIcon[index].style.display = "none";
                        }
                    });
                }

                function validateName() {
                    const username = validateInputs[0].value;
                    const errors = [];
                    const maxChar = 50;

                    if (!username) {
                        errors.push("O nome de usuário é obrigatório.");
                    } else {
                        if (username.length <= 3) errors.push("O nome de usuário deve ter mais de 3 caracteres.");
                        if (username.length > maxChar) errors.push("O nome de usuário é longo demais.");
                        if (/[áàâãäéèêëíìîïóòôõöúùûüç]/i.test(username)) errors.push("O nome de usuário não pode ter acentos ou cedilhas.");
                        if (/[-]/.test(username)) errors.push("O nome de usuário não pode ter hífens.");
                        if (/\s/.test(username)) errors.push("O nome de usuário não pode ter espaços.");
                        if (/[^a-zA-Z0-9_]/.test(username)) errors.push("Apenas letras, números e underscore (_) são permitidos.");
                    }

                    errors.length ? setErrors(0, errors) : removeErrors(0);
                }

                function validateEmail() {
                    const email = validateInputs[1].value;
                    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
                    const errors = [];
                    const maxChar = 256;

                    if (!email) {
                        errors.push("O e-mail é obrigatório.");
                    } else {
                        if (email.length > maxChar) errors.push("O e-mail é longo demais.");
                        if (!emailRegex.test(email)) errors.push("Insira um e-mail válido.");
                    }

                    errors.length ? setErrors(1, errors) : removeErrors(1);
                }

                function validatePassword() {
                    const password = validateInputs[2].value;
                    const errors = [];
                    const maxChar = 100;

                    if (!password) {
                        errors.push("A senha é obrigatória.");
                    } else {
                        if (password.length < 8) errors.push("A senha deve ter mais de 8 caracteres.");
                        if (password.length > maxChar) errors.push("A senha é longa demais.");
                        if (!/[A-Z]/.test(password)) errors.push("A senha deve conter ao menos uma letra maiúscula.");
                        if (!/[a-z]/.test(password)) errors.push("A senha deve conter ao menos uma letra minúscula.");
                        if (!/\d/.test(password)) errors.push("A senha deve conter ao menos um número.");
                    }

                    errors.length ? setErrors(2, errors) : removeErrors(2);
                }

                function validateConfirmPassword() {
                    const confirmPassword = validateInputs[3].value;
                    const password = validateInputs[2].value;
                    const errors = [];

                    if (!confirmPassword) {
                        errors.push("A confirmação de senha é obrigatória.");
                    } else if (confirmPassword !== password) {
                        errors.push("As senhas não coincidem.");
                    }

                    errors.length ? setErrors(3, errors) : removeErrors(3);
                }

                function validateFullName() {
                    const fullName = validateInputs[4].value;
                    const errors = [];
                    const maxChar = 100;

                    if (!fullName) {
                        errors.push("O nome completo é obrigatório.");
                    } else {
                        if (fullName.length > maxChar) errors.push("O nome é longo demais.");
                        if (/\d/.test(fullName)) errors.push("O nome não pode conter números.");
                        if (!/^([a-zA-ZÀ-ÖØ-öø-ÿ'’\-\s]+)$/.test(fullName)) errors.push("Apenas letras, espaços, acentos, hífens e apóstrofos são permitidos.");
                    }

                    errors.length ? setErrors(4, errors) : removeErrors(4);
                }

                function validatePhone() {
                    const phone = validateInputs[5].value;
                    const errors = [];
                    const phoneRegex = /^\d{10,11}$/;

                    if (!phone) {
                        errors.push("O telefone é obrigatório.");
                    } else {
                        if (!phoneRegex.test(phone)) errors.push("O telefone deve conter 10 ou 11 dígitos.");
                    }

                    errors.length ? setErrors(5, errors) : removeErrors(5);
                }

                function validateBornDate() {
                    const birthDate = new Date(validateInputs[6].value);
                    const today = new Date();
                    const hundredYearsAgo = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());
                    const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
                    const errors = [];

                    if (!validateInputs[6].value) {
                        errors.push("A data de nascimento é obrigatória.");
                    } else {
                        if (birthDate > today) errors.push("A data de nascimento não pode ser uma data futura.");
                        if (birthDate < hundredYearsAgo) errors.push("A data de nascimento é muito antiga.");
                        if (birthDate > eighteenYearsAgo) errors.push("Você precisa ser maior de 18 anos.");
                    }

                    errors.length ? setErrors(6, errors) : removeErrors(6);
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
                    const errors = [];

                    if (!cep) {
                        errors.push("O campo CEP é obrigatório.");
                    } else {
                        if (!/^\d{8}$/.test(cep)) errors.push("Insira um CEP válido.");
                    }

                    if (errors.length) {
                        setErrors(7, errors);
                        return;
                    }

                    try {
                        const data = await fetchCepData(cep);
                        if (data.uf !== "MG") {
                            setErrors(7, ["O CEP não pertence ao estado de Minas Gerais (MG)."]);
                            return;
                        }

                        const infoLocalizacao = document.getElementById('infoLocalizacao');
                        infoLocalizacao.textContent = `${data.localidade}, ${data.uf}`;
                        removeErrors(7);
                    } catch (error) {
                        setErrors(7, [error.message]);
                    }
                }

                function validateBio() {
                    const biography = validateInputs[8].value.trim();
                    const charactersNumber = document.querySelector('.Re-charactersNumber');
                    const maxCharacters = 255;
                    const errors = [];

                    charactersNumber.textContent = biography.length;

                    if (!biography) {
                        errors.push("A biografia é obrigatória.");
                    } else {
                        if (biography.length > maxCharacters) {
                            errors.push("A biografia é longa demais.");
                        }
                    }

                    errors.length ? setErrors(8, errors) : removeErrors(8);
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

                validateInputs.forEach((input, index) => {
                    input.addEventListener('input', () => {
                        switch (index) {
                            case 0:
                                validateName();
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
