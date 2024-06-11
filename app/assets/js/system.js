function registerUser() {
    const registerNext = document.querySelector('.Re-registerNext');
    const backButton = document.querySelector('.Re-backButton');
    const termsCheckbox = document.querySelector('.Re-termsBox');
    const accountInformations = document.querySelector('.Re-accountInformations');
    const userInformations = document.querySelector('.Re-userInformations');
    const childInformations = document.querySelector('.Re-childInformations');
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
            backButton.classList.remove('close');

            if (!accountInformations.classList.contains('close')) {
                if (areAllFieldsFilled(accountInformations)) {
                    accountInformations.classList.toggle('close');
                    userInformations.classList.toggle('close');
                } else {
                    alert("Por favor, preencha todos os campos obrigatórios.");
                }
            } else if (!userInformations.classList.contains('close')) {
                if (areAllFieldsFilled(userInformations)) {
                    userInformations.classList.toggle('close');
                    childInformations.classList.toggle('close');
                } else {
                    alert("Por favor, preencha todos os campos obrigatórios.");
                }
            } else if (!childInformations.classList.contains('close')) {
                childInformations.classList.toggle('close');
                registerResult.classList.toggle('close');
                submitButton.classList.toggle('close');
                registerNext.classList.toggle('close');
                termsCheckbox.classList.toggle('close');
            }
        });

        backButton.addEventListener('click', () => {
            if (!userInformations.classList.contains('close')) {
                accountInformations.classList.toggle('close');
                userInformations.classList.toggle('close');
                backButton.classList.toggle('close');
            } else if (!childInformations.classList.contains('close')) {
                userInformations.classList.toggle('close');
                childInformations.classList.toggle('close');
            } else if (!registerResult.classList.contains('close')) {
                childInformations.classList.toggle('close');
                registerResult.classList.toggle('close');
                termsCheckbox.classList.toggle('close');
                submitButton.classList.toggle('close');
                registerNext.classList.toggle('close');
            }
        });
    }

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
    addChild();
    showUserImageProfile();
    validateSubmit();
}

function addPost(){
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.querySelector("#Ho-imageSelector");
        const preview = document.querySelector(".Ho-preview");
    
        input.addEventListener("change", function() {
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
        });
    });
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
 
function registerTheme(){
    const body = document.querySelector("body");
    const yellowTheme = document.querySelector("#Re-yellowTheme");
    const blueTheme = document.querySelector("#Re-blueTheme");
    const pinkTheme = document.querySelector("#Re-pinkTheme");
    
    yellowTheme.addEventListener("click", () => {
        body.classList.add("Y-theme");
        body.classList.remove("B-theme");
        body.classList.remove("P-theme");
        toggleTheme();
    });
    
    blueTheme.addEventListener("click", () => {
        body.classList.add("B-theme");
        body.classList.remove("P-theme");
        body.classList.remove("Y-theme");
        toggleTheme();
    });
    
    pinkTheme.addEventListener("click", () => {
        body.classList.add("P-theme");
        body.classList.remove("B-theme");
        body.classList.remove("Y-theme");
        toggleTheme();
    }); 
}  

function toggleTheme(){
    const body = document.querySelector("body");
    const main = document.querySelector("main");
    const cells = document.querySelectorAll('.backCells');

    if(main.classList.contains("Lo-Login") || main.classList.contains("Re-register")){
        if(body.classList.contains("B-theme")){
            cells.forEach(cell => {
                cell.src = '/ConectaMaesProject/app/assets/imagens/figuras/cells_standart_first_blue.png';
            });
        } else if(body.classList.contains("P-theme")){
            cells.forEach(cell => {
                cell.src = '/ConectaMaesProject/app/assets/imagens/figuras/cells_standart_first_pink.png';
            });
        } else {
            cells.forEach(cell => {
                cell.src = '/ConectaMaesProject/app/assets/imagens/figuras/cells_standart_first_yellow.png';
            });
        }
    } else if (main.classList.contains("mainSystem")){
        if(body.classList.contains("B-theme")){
            cells.forEach(cell => {
                cell.src = '/ConectaMaesProject/app/assets/imagens/figuras/cells_standart_full_blue.png';
            });
        } else if(body.classList.contains("P-theme")){
            cells.forEach(cell => {
                cell.src = '/ConectaMaesProject/app/assets/imagens/figuras/cells_standart_full_pink.png';
            });
        } else {
            cells.forEach(cell => {
                cell.src = '/ConectaMaesProject/app/assets/imagens/figuras/cells_standart_full_yellow.png';
            });
        }
    }
    
}

registerUser();
registerTheme();
toggleTheme();
addPost();
toggleConfigSection();
