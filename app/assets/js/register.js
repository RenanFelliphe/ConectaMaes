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