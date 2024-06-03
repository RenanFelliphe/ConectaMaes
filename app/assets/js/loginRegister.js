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
    var cells = document.querySelectorAll('.backCells');

    if(body.classList.contains("B-theme")){
        cells.forEach(cell => {
            cell.src = '../app/assets/imagens/figuras/cells_standart_first_blue.png';
        });
    } else if(body.classList.contains("P-theme")){
        cells.forEach(cell => {
            cell.src = '../app/assets/imagens/figuras/cells_standart_first_pink.png';
        });
    } else {
        cells.forEach(cell => {
            cell.src = '../app/assets/imagens/figuras/cells_standart_first_yellow.png';
        });
    }
}

let inputLatitude = document.getElementById("latitude");
let inputLongitude = document.getElementById("longitude");
let inputLocalizacao = document.getElementById("localizacao");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Define a latitude e longitude nos inputs ocultos
            inputLatitude.value = latitude;
            inputLongitude.value = longitude;

            // Faz uma requisição para a API de geolocalização reversa
            var url = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + latitude + '&lon=' + longitude;

            // Faz uma requisição usando fetch
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Extrai a cidade e o estado da resposta
                    var cidade = data.address.city;
                    var estado = data.address.state;

                    // Define a cidade e o estado no input de localização
                    inputLocalizacao.value = cidade + ', ' + estado;
                })
                .catch(error => console.log('Erro na requisição:', error));
        });
    } else {
        inputLocalizacao.value = "Não definida";
        console.log('Geolocalização não suportada pelo navegador.');
    }
}


toggleTheme();
registerUser();
getLocation();