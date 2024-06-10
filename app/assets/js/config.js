function registerTheme(){
    const body = document.querySelector("body");
    const yellowTheme = document.querySelector("#Se-yellowTheme");
    const blueTheme = document.querySelector("#Se-blueTheme");
    const pinkTheme = document.querySelector("#Se-pinkTheme");
    
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

registerTheme();
toggleConfigSection();
toggleTheme();
