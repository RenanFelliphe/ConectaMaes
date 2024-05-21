
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

addPost();