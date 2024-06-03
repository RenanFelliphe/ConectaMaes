
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

        //input.classList.add("characterBlocked"); (ESTOU TESTANDO O CÓDIGO SEM ESSES 2 EVENTOS)
        //characteres.classList.add("characterBlocked"); (ESTOU TESTANDO O CÓDIGO SEM ESSES 2 EVENTOS)
        postTitle.classList.add("characterBlocked")
        setTimeout(() => {
            //input.classList.remove("characterBlocked"); (ESTOU TESTANDO O CÓDIGO SEM ESSES 2 EVENTOS)
            //characteres.classList.remove("characterBlocked"); (ESTOU TESTANDO O CÓDIGO SEM ESSES 2 EVENTOS)
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

function toggleTheme(){
    const body = document.querySelector("body");
    const main = document.querySelector("main");
    const cells = document.querySelectorAll('.backCells');

    if(main.classList.contains("Lo-login") || main.classList.contains("Re-register")){
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
    } else if (main.classList.contains("mainSystem")){
        if(body.classList.contains("B-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_full_blue.png';
            });
        } else if(body.classList.contains("P-theme")){
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_full_pink.png';
            });
        } else {
            cells.forEach(cell => {
                cell.src = '../app/assets/imagens/figuras/cells_standart_full_yellow.png';
            });
        }
    }
    
}

toggleTheme();
addPost();