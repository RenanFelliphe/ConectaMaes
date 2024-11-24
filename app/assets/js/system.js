document.addEventListener('DOMContentLoaded', function() {
    toggleTheme();
});

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
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

function toggleTheme() {
    const body = document.querySelector("body");
    const main = document.querySelector("main");
    const cells = document.querySelectorAll('.backCells');
    const currentUrl = window.location.href;

    const theme = body.classList.contains("B-theme") ? "blue" :
                  body.classList.contains("P-theme") ? "pink" :
                  body.classList.contains("Y-theme") ? "yellow" : null;

    if (!theme) {
        body.classList.add("Y-theme");
        toggleTheme();
        return;
    }

    const pathPrefix = main.classList.contains("Lo-Login") || main.classList.contains("Re-register")
        ? '../app/assets/imagens/figuras/cells_standart_first_'
        : main.classList.contains("mainSystem") && currentUrl.includes('/public/home.php')
        ? '../app/assets/imagens/figuras/cells_standart_full_'
        : '../../app/assets/imagens/figuras/cells_standart_full_';

    cells.forEach(cell => {
        cell.src = `${pathPrefix}${theme}.png`;
    });
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

function toggleModal(modal) {
    const modalSections = document.querySelectorAll('.modalSection');
    
    modalSections.forEach(modalSection => {
        modalSection.classList.add('close');
    });

    modalSections.forEach(modalSection => {
        if (modalSection.getAttribute("data-type") === modal.getAttribute("data-type") && modalSection.getAttribute("data-id") === modal.getAttribute("data-id")) {
            modalSection.classList.remove('close');
        }
    });

    document.querySelectorAll('.closeModal').forEach(closeModalBtn => {
        closeModalBtn.addEventListener('click', (event) => {
            event.stopPropagation();
            const parentModal = closeModalBtn.closest('.modalSection');
            if (parentModal) {
                parentModal.classList.add('close');
            }
        });
    });
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
