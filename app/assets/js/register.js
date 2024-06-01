function registerUser(){
    const registerNext = document.querySelector('.Re-registerNext');
    const backButton = document.querySelector('.Re-backButton');
    const termsCheckbox = document.querySelector('.Re-termsBox');
    const accountInformations = document.querySelector('.Re-accountInformations');
    const userInformations = document.querySelector('.Re-userInformations');
    const childInformations = document.querySelector('.Re-childInformations');
    const registerResult = document.querySelector('.Re-registerResult'); 

    function toggleRegisterSection(){       
        
        registerNext.addEventListener('click', () => {
            backButton.classList.remove('close');
    
            if(!accountInformations.classList.contains('closed')){
                accountInformations.classList.toggle('closed');
                userInformations.classList.toggle('closed');
                
            } else if(!userInformations.classList.contains('closed')){
                userInformations.classList.toggle('closed');
                childInformations.classList.toggle('closed');
    
            } else if(!childInformations.classList.contains('closed')){
                childInformations.classList.toggle('closed');
                registerResult.classList.toggle('closed');
                termsCheckbox.classList.toggle('close');
            }
    
        });
    
        backButton.addEventListener('click', () => {
            if(!userInformations.classList.contains('closed')){
                accountInformations.classList.toggle('closed');
                userInformations.classList.toggle('closed');
                backButton.classList.toggle('close');
                
            } else if(!childInformations.classList.contains('closed')){
                userInformations.classList.toggle('closed');
                childInformations.classList.toggle('closed');
    
            } else if(!registerResult.classList.contains('closed')){
                childInformations.classList.toggle('closed');
                registerResult.classList.toggle('closed');
                termsCheckbox.classList.toggle('close');
            }
        });
    }
    
    function chooseTheme(){
        const body = document.querySelector("body");
        const yellowTheme = document.querySelector("#Re-yellowTheme");
        const blueTheme = document.querySelector("#Re-blueTheme");
        const pinkTheme = document.querySelector("#Re-pinkTheme");
    
        yellowTheme.addEventListener("click", () => {
            body.classList.add("Y-theme");
            body.classList.remove("B-theme");
            body.classList.remove("P-theme");
        });
        
        blueTheme.addEventListener("click", () => {
            body.classList.add("B-theme");
            body.classList.remove("P-theme");
            body.classList.remove("Y-theme");
        });
        
        pinkTheme.addEventListener("click", () => {
            body.classList.add("P-theme");
            body.classList.remove("B-theme");
            body.classList.remove("Y-theme");
        });        
    }
    

    function addChild(){
        const addChildBox = document.querySelector('.Re-addChildBox');
        const addChildStart = document.querySelector('.Re-addChild');
    
        function openCloseAddChild(){
            const addChildCancel = document.querySelector('.Re-cancelAddChild');
    
            addChildStart.addEventListener('click', () => {
                addChildBox.classList.remove('close');
                blockRegisterNext();
            });
    
            addChildCancel.addEventListener('click', () => {
                addChildBox.classList.add('close');
                blockRegisterNext();
            });
    
            function blockRegisterNext(){
                if (!addChildBox.classList.contains('close')) {
                    registerNext.style.backgroundColor = "#808080";
                    registerNext.style.pointerEvents = "none";
    
                    backButton.src = "../app/assets/imagens/icons/back_arrow_disabled.png";
                    backButton.style.pointerEvents = "none";
                } else {
                    registerNext.style.backgroundColor = 'var(--secondColor)';
                    registerNext.style.pointerEvents = "all";
    
                    backButton.src = "../app/assets/imagens/icons/back_arrow.png";
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
        
    toggleRegisterSection();
    chooseTheme();
    addChild();
    showUserImageProfile();
}

registerUser();

function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
  
        // Faz uma requisição para a API de geolocalização reversa
        var url = 'https://nominatim.openstreetmap.org/reverse?format=json&lat=' + latitude + '&lon=' + longitude;
  
        // Faz uma requisição Axios
        axios.get(url)
          .then(response => {
            var data = response.data;
            // Extrai a cidade e o estado da resposta
            var cidade = data.address.city;
            var estado = data.address.state;
  
            // Exibe a cidade e o estado
            console.log(cidade + ', ' + estado);
          })
          .catch(error => console.log('Erro na requisição:', error));
      });
    } else {
      console.log('Geolocalização não suportada pelo navegador.');
    }
}

getLocation();
  