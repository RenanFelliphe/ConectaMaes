function addChild(){
    const addChildBox = document.querySelector('.Re-addChildBox');
    const addChildStart = document.querySelector('.Re-addChild');
    const registerNext = document.querySelectorAll('.Re-registerNext');
    
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
            if(!addChildBox.classList.contains('close')){
                registerNext.forEach(Next => {
                    Next.style.backgroundColor = "#A8A8A8";
                    Next.style.pointerEvents = "none";
                });
            } else {
                registerNext.forEach(Next => {
                    Next.style.backgroundColor = 'var(--middleYellowColor)';
                    Next.style.pointerEvents = "all";
                });
            }
        }
    }
    
    function toggleChildSex() {
        const childSex = document.querySelectorAll('.Re-childSex');
    
        childSex.forEach(childSexOption => {
            childSexOption.addEventListener('click', () => {

                if(childSexOption.style.opacity != '1'){
                    childSex.forEach(option => {
                        option.style.opacity = '0.5';
                    });

                    childSexOption.style.opacity = '1';

                } else if (childSexOption.style.opacity === '1'){
                    childSex.forEach(option => {
                        option.style.opacity = '0.5';
                    });
                }
            });
        });
    }

    openCloseAddChild();
    toggleChildSex();
}

addChild();


function getLocation() {
    // Verifica se o navegador suporta geolocalização
    if (navigator.geolocation) {
      // Obtém a localização do usuário
      navigator.geolocation.getCurrentPosition(function(position) {
        // Obtém as coordenadas de latitude e longitude
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
      // Navegador não suporta geolocalização
      console.log('Geolocalização não suportada pelo navegador.');
    }
  }

  getLocation();
  