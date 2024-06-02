
function addPost(){
    function showPreviewImage(){
        const input = document.getElementById("imageSelector");
        const preview = document.querySelector(".preview");

        document.addEventListener("DOMContentLoaded", function () {
            input.style.opacity = 0;
        
            input.addEventListener("change", function () {
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

        preview.addEventListener('click',()  => {
            preview.classList.toggle('maximize');

            preview.addEventListener('mouseout',()  => {
                preview.classList.remove('maximize');
            })
        })
    }

    
    showPreviewImage();
}

function postCharLimiter() {
    const maxCharacters = Number(document.querySelector(".H-maxCharacters").textContent.trim());
    const input = document.querySelector(".postTextContent");
    const inputContent = input.value;
    const numberOFCharacters = document.querySelector(".H-charactersNumber");
    const characteres = document.querySelector(".H-characters");

    numberOFCharacters.textContent = inputContent.length;

    if (inputContent.length >= maxCharacters) {
        input.value = inputContent.slice(0, maxCharacters);
        numberOFCharacters.textContent = "MAX";
        numberOFCharacters.style.color = "red";

        input.classList.add("characterBlocked");
        characteres.classList.add("characterBlocked");
        setTimeout(() => {
            input.classList.remove("characterBlocked");
            characteres.classList.remove("characterBlocked");
        }, 700);

    } else if (inputContent.length >= (maxCharacters * 0.75)) {
        numberOFCharacters.style.color = "darkorange";
    
    } else if (inputContent.length >= (maxCharacters * 0.5)) {
        numberOFCharacters.style.color = "yellow";

    } else if (inputContent.length <= 0){
        numberOFCharacters.style.color = "black";
    }

    else {
        numberOFCharacters.style.color = "lime";
    }
}

addPost();