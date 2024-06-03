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
    
toggleTheme();
