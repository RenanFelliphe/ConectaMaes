document.addEventListener('DOMContentLoaded', function() {
    toggleTheme();
    openModal();
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

        function toggleErrorModal(index, show) {
            errorMessageContainers[index].style.display = show ? 'flex' : 'none';
        }
    
        errorIcon.forEach((icon, index) => {
            icon.addEventListener('mouseover', () => {
                toggleErrorModal(index, true);
            });
    
            icon.addEventListener('mouseout', () => {
                toggleErrorModal(index, false);
            });
        });
    }

    function removeError(index){
        inputContainers[index].style.border = "2px solid transparent";
        placeholders[index].style.color = "var(--secondColor)";
        errorMessageContent[index].innerHTML = '';
        errorIcon[index].style.display = "none";
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
        checkEmptyInput(0);
        if(validateInputs[0].value.length === 0){
            removeError(0);
        } else if(validateInputs[0].value.length <= 3){
            setError(0, "O nome de usuário deve ter mais de <span class='mainError'>3 caracteres.</span>");
        } else if(validateInputs[0].value.length > 50){
            setError(0, "O nome de usuário deve ter menos de <span class='mainError'>50 caracteres.</span>");
            validateInputs[0].value = validateInputs[0].value.slice(0, 50);
        } else {
            removeError(0);
        }
    }

    function validateEmail() {
        const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

        checkEmptyInput(1);

        if(validateInputs[1].value.length === 0){
            removeError(1);
        } else if (!emailRegex.test(validateInputs[1].value)) {
            setError(1, "Insira um endereço de <span class='mainError'>e-mail válido.</span>");
        } else if (validateInputs[1].value.length > 50) {
            setError(1, "O endereço de e-mail é <span class='mainError'>muito longo.</span>");
            validateInputs[1].value = validateInputs[1].value.slice(0, 50);
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
        } else {
            removeError(2);
        }
    }

    function validateConfirmPassword(){
        checkEmptyInput(3);
        if(validateInputs[3].value.length === 0){
            removeError(3);
        } else if(validateInputs[2].value !== validateInputs[3].value){
            setError(3, "As senhas <span class='mainError'>não coincidem.</span>");
        } else{
            removeError(3);
        }
    }

    window.validateName = validateName;
    window.validateEmail = validateEmail;
    window.validatePassword = validatePassword;
    window.validateConfirmPassword = validateConfirmPassword;
}

function headerFunctions() {
    function toggleModals() {
        const modals = document.querySelectorAll('.headerModal');
        const makeAPostButton = document.querySelector('.makeAPost');
        let closeTimeout;

        function closeAllModals() {
            modals.forEach(modal => modal.classList.add('close'));
            makeAPostButton.classList.remove('active');
        }

        function toggleModal(modal, button = null) {
            const isClosed = modal.classList.contains('close');
            closeAllModals();
            if (isClosed) {
                modal.classList.remove('close');
                if (button) {
                    button.classList.add('active');
                }
            }
        }

        document.querySelector('.userAccount').addEventListener('click', () => {
            toggleModal(document.querySelector('.userFunctionsModal'));
        });

        makeAPostButton.addEventListener('click', () => {
            toggleModal(document.querySelector('.makeAPostModal'), makeAPostButton);
        });

        modals.forEach(modal => {
            modal.addEventListener('mouseleave', () => {
                closeTimeout = setTimeout(closeAllModals, 400);
            });
            modal.addEventListener('mouseenter', () => {
                clearTimeout(closeTimeout);
            });
        });
    }

    function togglePages() {
        const homePageLink = document.getElementById('homePageLink');
        const reportPageLink = document.getElementById('reportPageLink');
        const helpPageLink = document.getElementById('helpPageLink');
        const currentUrl = window.location.href;

        if (currentUrl.includes('/public/home.php')) {
            homePageLink.classList.add('active');
        } else if (currentUrl.includes('/public/home/relatos.php')) {
            reportPageLink.classList.add('active');
        } else if (currentUrl.includes('/public/home/pedidos.php')) {
            helpPageLink.classList.add('active');
        }
    }

    toggleModals();
    togglePages();
}

function postCharLimiter() {
    const maxCharacters = Number(document.querySelector(".Ho-maxCharacters").textContent.trim());
    const input = document.querySelector(".Ho-postTextContent");
    const inputContent = input.value;
    const numberOFCharacters = document.querySelector(".Ho-charactersNumber");
    const characteres = document.querySelector(".Ho-characters");

    numberOFCharacters.textContent = inputContent.length;

    if (inputContent.length >= maxCharacters) {
        input.value = inputContent.slice(0, maxCharacters);
        numberOFCharacters.textContent = "Max";
        numberOFCharacters.style.color = "var(--redColor)";
        characteres.style.color = "var(--redColor)";
        characteres.style.fontWeight = "bolder";

        input.classList.add("characterBlocked");
        characteres.classList.add("characterBlocked");
        setTimeout(() => {
            input.classList.remove("characterBlocked");
            characteres.classList.remove("characterBlocked");
        }, 700);

    } else if (inputContent.length >= (maxCharacters * 0.75)) {
        numberOFCharacters.style.color = "var(--middlePinkColor)";
        characteres.style.fontWeight = "normal";
    } else if (inputContent.length >= (maxCharacters * 0.5)) {
        numberOFCharacters.style.color = "var(--middleYellowColor)";
        characteres.style.fontWeight = "normal";
    } else if (inputContent.length <= 0){
        numberOFCharacters.style.color = "var(--grayColor)";
        characteres.style.fontWeight = "normal";
    } else {
        numberOFCharacters.style.color = "var(--middleBlueColor)";
        characteres.style.fontWeight = "normal";
    }
}

function postTitleCharLimiter() {
    const maxCharacters = Number(document.querySelector(".Ho-maxTitleCharacters").textContent.trim());
    const input = document.querySelector(".Ho-postTitleInput");
    const inputContent = input.value;
    const numberOFCharacters = document.querySelector(".Ho-titleCharactersNumber");
    const characteres = document.querySelector(".Ho-titleCharacters");
    const postTitle = document.querySelector('.Ho-postTitle');

    numberOFCharacters.textContent = inputContent.length;

    if (inputContent.length >= maxCharacters) {
        input.value = inputContent.slice(0, maxCharacters);
        numberOFCharacters.textContent = "Max";
        numberOFCharacters.style.color = "var(--redColor)";
        characteres.style.color = "var(--redColor)";
        characteres.style.fontWeight = "bolder";

        postTitle.classList.add("characterBlocked")
        setTimeout(() => {
            postTitle.classList.remove("characterBlocked")
        }, 700);

    } else if (inputContent.length >= (maxCharacters * 0.75)) {
        numberOFCharacters.style.color = "var(--middlePinkColor)";
        characteres.style.fontWeight = "normal";
    } else if (inputContent.length >= (maxCharacters * 0.5)) {
        numberOFCharacters.style.color = "var(--middleYellowColor)";
        characteres.style.fontWeight = "normal";
    } else if (inputContent.length <= 0){
        numberOFCharacters.style.color = "var(--grayColor)";
        characteres.style.fontWeight = "normal";
    } else {
        numberOFCharacters.style.color = "var(--middleBlueColor)";
        characteres.style.fontWeight = "normal";
    }
}

function registerUser() {
    const registerNext = document.querySelector('.Re-registerNext');
    const backButton = document.querySelector('.Re-backButton');
    const termsCheckbox = document.querySelector('.Re-termsBox');
    const accountInformations = document.querySelector('.Re-accountInformations');
    const userInformations = document.querySelector('.Re-userInformations');
    const registerResult = document.querySelector('.Re-registerResult');
    const submitButton = document.querySelector('.Re-registerSubmit');
    const termsCheckboxInput = document.querySelector('#Re-terms');

    function areAllFieldsFilled(section) {
        const inputs = section.querySelectorAll('input[required]');
        for (let input of inputs) {
            if (!input.value) {
                return false;
            }
        }
        return true;
    }

    function toggleRegisterSection() {
        registerNext.addEventListener('click', () => {

            if (!accountInformations.classList.contains('close')) {
                if (areAllFieldsFilled(accountInformations)) {
                    accountInformations.classList.toggle('close');
                    userInformations.classList.toggle('close');
                    backButton.classList.remove('close');
                } else {
                    alert("Por favor, preencha todos os campos obrigatórios.");
                }
            } else if (!userInformations.classList.contains('close')) {
                if (areAllFieldsFilled(userInformations)) {
                    userInformations.classList.toggle('close');
                    registerResult.classList.toggle('close');
                    submitButton.classList.toggle('close');
                    registerNext.classList.toggle('close');
                } else {
                    alert("Por favor, preencha todos os campos obrigatórios.");
                }
            }
        });

        backButton.addEventListener('click', () => {
            if (!userInformations.classList.contains('close')) {
                accountInformations.classList.toggle('close');
                userInformations.classList.toggle('close');
                backButton.classList.toggle('close');
            } else if (!registerResult.classList.contains('close')) {
                userInformations.classList.toggle('close');
                registerResult.classList.toggle('close');
                submitButton.classList.toggle('close');
                registerNext.classList.toggle('close');
            }
        });
    }

    function showUserImageProfile() {
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

    function validateSubmit() {
        submitButton.addEventListener('click', (event) => {
            if (!termsCheckboxInput.checked) {
                event.preventDefault();
                alert("Você deve ler e concordar com os termos e condições antes de completar o registro!");
            }
        });
    }

    toggleRegisterSection();
    showUserImageProfile();
    validateSubmit();
}

function addPost() {
    const input = document.querySelector("#Ho-imageSelector");
    const preview = document.querySelector(".Ho-preview");

    while (preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }

    const files = input.files;
    if (files.length > 0) {
        for (const file of files) {
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.alt = file.name;
            preview.appendChild(img);
        }
    }
}

function registerTheme(theme) {
    const body = document.querySelector("body");
    
    if (theme === 'Y-theme') {
        body.classList.add("Y-theme");
        body.classList.remove("B-theme");
        body.classList.remove("P-theme");
    } else if (theme === 'B-theme') {
        body.classList.add("B-theme");
        body.classList.remove("P-theme");
        body.classList.remove("Y-theme");
    } else if (theme === 'P-theme') {
        body.classList.add("P-theme");
        body.classList.remove("B-theme");
        body.classList.remove("Y-theme");
    }

    toggleTheme();
}

function toggleTheme(){
    const body = document.querySelector("body");
    const main = document.querySelector("main");
    const cells = document.querySelectorAll('.backCells');

    if(main.classList.contains("Lo-Login") || main.classList.contains("Re-register")){
        if(body.classList.contains("B-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_first_blue.png';
            });
        } else if(body.classList.contains("P-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_first_pink.png';
            });
        } else if(body.classList.contains("Y-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_first_yellow.png';
            });
        } else{
            body.classList.add("Y-theme");
            toggleTheme();
        }
    } else if (main.classList.contains("mainSystem")){
        if(body.classList.contains("B-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_full_blue.png';
            });
        } else if(body.classList.contains("P-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_full_pink.png';
            });
        } else if(body.classList.contains("Y-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_full_yellow.png';
            });
        } else{
            body.classList.add("Y-theme");
            toggleTheme();
        }
    }
    
}

function toggleConfigSection() {
    const sectionTitles = document.querySelectorAll('.Se-sectionTitle');
    const subSections = document.querySelectorAll('.Se-subSection');

    sectionTitles.forEach((title, index) => {
        title.addEventListener('click', () => {
            sectionTitles.forEach(title => title.classList.remove('active'));
            subSections.forEach(subSection => subSection.classList.remove('active'));

            if (sectionTitles[index] && subSections[index]) {
                sectionTitles[index].classList.add('active');
                subSections[index].classList.add('active');
            }
        });
    });
}

function openModal() {
    const modalSection = document.querySelector('.modalSection');
    const closeModalBtns = document.querySelectorAll('.closeModal');
    const pageModals = document.querySelectorAll('.pageModal');
    
    function postModal(){
        const postPostBtn = document.querySelector('.postPostBtn');
        const postRelatoBtn = document.querySelector('.postRelatoBtn');
        const postAuxilioBtn = document.querySelector('.postAuxilioBtn');

        const postPostModal = document.querySelector('.postPostModal');
        const postRelatosModal = document.querySelector('.postRelatosModal');
        const postAuxilioModal = document.querySelector('.postAuxilioModal');

        postPostBtn.addEventListener('click', () => {
            postPostModal.classList.toggle('close');
            modalSection.classList.toggle('close');
        });

        postRelatoBtn.addEventListener('click', () => {
            postRelatosModal.classList.toggle('close');
            modalSection.classList.toggle('close');
        });

        postAuxilioBtn.addEventListener('click', () => {
            postAuxilioModal.classList.toggle('close');
            modalSection.classList.toggle('close');
        });
    }

    function openAddChildModal() {
        const addChildModalBtn = document.querySelector('.Se-addNewChild');
        const addChildModal = document.querySelector('.Se-addNewChildModal');

        addChildModalBtn.addEventListener('click', () => {
            addChildModal.classList.toggle('close');
            modalSection.classList.toggle('close');
        });
    }

    function openEditPasswordModal() {
        const editPasswordModal = document.querySelector('.Se-editPasswordModal');
        const editPasswordBtn = document.querySelector('.editPasswordInput');

        editPasswordBtn.addEventListener('click', () => {
            editPasswordModal.classList.toggle('close');
            modalSection.classList.toggle('close');
        });
    }

    function openDeleteAccountModal() {
        const deleteAccountModal = document.querySelector('.Se-deleteAccountModal');
        const deleteAccountBtn = document.querySelector('.Se-accountDelete');

        deleteAccountBtn.addEventListener('click', () => {
            deleteAccountModal.classList.toggle('close');
            modalSection.classList.toggle('close');
        });
    }

    closeModalBtns.forEach(closeModalBtn => {
        closeModalBtn.addEventListener('click', () => {
            pageModals.forEach(pageModal => {
                pageModal.classList.add('close');
                modalSection.classList.add('close');
            });
        });
    });

    postModal();
    openAddChildModal();
    openEditPasswordModal();
    openDeleteAccountModal();
}

function sendPassword(){
    const formElements = document.getElementById('formPassword');

    formElements.addEventListener('submit', event =>{
        event.preventDefault();
        const formData = new FormData(formElements);
        const data = Object.fromEntries(formData);
        console.log(data);
    })
}

function toggleAuxilioFilter(clickedFilter) {
    const auxilioMainFilters = document.querySelectorAll('.Au-auxilioMainFilter');

    auxilioMainFilters.forEach(filter => {
        filter.classList.remove('active');
    });

    clickedFilter.classList.add('active');

    const auxilioMainFiltersSelector = document.querySelector('.Au-auxilioFilter span');

    if (clickedFilter.classList.contains('Au-auxilioMain')) {
        auxilioMainFiltersSelector.style.transform = 'translateX(18.5rem)';
    } else {
        auxilioMainFiltersSelector.style.transform = 'translateX(0)';
    }
}

function openAuxilioModal() {
    const auxilioCards = document.querySelectorAll('.Au-auxilioCard');

    auxilioCards.forEach(auxilioCard => {
        auxilioCard.addEventListener('click', () => {
            const auxilioModalBack = auxilioCard.querySelector('.Au-auxilioModalBack');
            if (auxilioModalBack) {
                auxilioModalBack.classList.remove('close');
            }
        });

        const closeModal = auxilioCard.querySelector('.Au-closeModal');
        if (closeModal) {
            closeModal.addEventListener('click', (event) => {
                event.stopPropagation(); // Impede a propagação do evento de clique para o card
                const auxilioModalBack = auxilioCard.querySelector('.Au-auxilioModalBack');
                if (auxilioModalBack) {
                    auxilioModalBack.classList.add('close');
                }
            });
        }
    });
}

/* FUNÇÃO ANTIGA PARA ADICIONAR FILHO NO REGISTRO
function addChild() {
    const addChildBox = document.querySelector('.Re-addChildBox');
    const addChildStart = document.querySelector('.Re-addChild');

    function openCloseAddChild() {
        const addChildCancel = document.querySelector('.Re-cancelAddChild');

        addChildStart.addEventListener('click', () => {
            addChildBox.classList.remove('close');
            blockRegisterNext();
        });

        addChildCancel.addEventListener('click', () => {
            addChildBox.classList.add('close');
            blockRegisterNext();
        });

        function blockRegisterNext() {
            if (!addChildBox.classList.contains('close')) {
                registerNext.style.backgroundColor = "#808080";
                registerNext.style.pointerEvents = "none";

                backButton.style.color = "#808080";
                backButton.style.pointerEvents = "none";
            } else {
                registerNext.style.backgroundColor = 'var(--secondColor)';
                registerNext.style.pointerEvents = "all";

                backButton.style.color = 'var(--secondColor)';
                backButton.style.pointerEvents = "all";
            }
        }
    }

    openCloseAddChild();
}
*/