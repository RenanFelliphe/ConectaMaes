<header class="headerHome">
    <a href="/ConectaMaesProject/public/index.php">
        <img src="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Black.png" class="A-headerLogo" alt="Logo do ConectaMães">
    </a>

    <div class="headerPageLinks">
        <a class="homePageLink pageLink" id="homePageLink" href="/ConectaMaesProject/public/home.php">
            <img class="homePageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/home_off.png" alt="Ícone da página inicial">
            <p>Home</p>
            <span class="pageSelector"></span>
        </a>

        <a class="reportPageLink pageLink" id="reportPageLink" href="/ConectaMaesProject/public/home/relatos.php">
            <img class="reportPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
            <p>Relatos</p>
            <span class="pageSelector"></span>
        </a>

        <a class="helpPageLink pageLink" id="helpPageLink" href="/ConectaMaesProject/public/home/pedidos.php">
            <img class="helpPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
            <p>Pedidos</p>
            <span class="pageSelector"></span>
        </a>
    </div>

    <div class="userContainer">
        <img class="notificationsModalIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/notifications_off.png" alt="Ícone do modal de notificações">
        
        <div class="makeAPost">
            <button name ="postPostagem" class="makeAPostBtn">Postar</button>

            <div class="postStyle">
                <i class="bi bi-caret-down-fill pageIcon"></i>
            </div>
        </div>

        <div class="makeAPostModal headerModal close">
            <div class="modalHeader">
                <h1>Publicação</h1>
                <i class="bi bi-three-dots pageIcon"></i>
            </div>

            <div class="postStyleSummary">
                <div class="postStyleTitle">
                    <span></span>
                    <img class="homePageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/home_off.png" alt="Ícone da página inicial">
                    <h4>Post</h4>
                    <span></span>
                </div>
                <p>Faça uma publicação para compartilhar momentos
                    do seu dia a dia, novidades, fotos ou qualquer outra coisa
                    que queira dividir com a comunidade. <span>É a forma padrão
                    de se conectar e interagir com outras mães<span>.</p>
                <button name ="postPostagem" class="postBtn postagemBtn">Postar</button>
            </div>

            <div class="postStyleSummary">
                <div class="postStyleTitle">
                    <span></span>
                    <img class="reportPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/reports_off.png" alt="Ícone da página de relatos">
                    <h4>Relato</h4>
                    <span></span>
                </div>
                <p>Compartilhe suas experiências pessoais. <span>Conte sobre
                    momentos importantes, dificuldades superadas,
                    alegrias ou tristezas da sua vida</span>. Seus relatos podem
                    inspirar e confortar outras mães na comunidade.</p>
                <button name ="postPostagem" class="postBtn relatoBtn">Postar</button>
            </div>

            <div class="postStyleSummary">
                <div class="postStyleTitle">
                    <span></span>
                    <img class="helpPageIcon headerIcon" src="/ConectaMaesProject/app/assets/imagens/icons/helps_off.png" alt="Ícone da página de pedidos">
                    <h4>Auxílio</h4>
                    <span></span>
                </div>
                <p>Precisa de ajuda? <span>Descreva uma dificuldade que está
                    enfrentando no momento e consiga apoio da
                    comunidade</span>. Outras mães estão aqui para oferecer
                    suporte baseado em suas próprias experiências.</p>
                <button name ="postPostagem" class="postBtn pedidosBtn">Postar</button>
            </div>
        </div>

        <div class="userInformations">
            <span class="userRealName">
                <?php 
                    $partesDoNomeCompleto = explode(" ", $currentUserData['nomeCompleto']);
                    $firstName = $partesDoNomeCompleto[0];
                    $lastName = $partesDoNomeCompleto[count($partesDoNomeCompleto) - 1];
                    
                    // Concatena a primeira e a última palavra separadas por um espaço
                    $firstAndLastName = $firstName . " " . $lastName;
                    
                    echo $firstAndLastName;
                ?>
            </span>
            <span class="userNickname">
                <?php 
                    echo "@" . $currentUserData['nomeDeUsuario']; 
                ?>
            </span>
        </div>

        <div class="userAccount">
            <div class="userProfileImage">
                <img src="">
            </div>
            <i class="bi bi-chevron-down"></i>
        </div>
    </div>

    <div class="userFunctionsModal headerModal close">
        <a href="/ConectaMaesProject/public/home/perfil.php" class="userFunctions">
            <i class="bi bi-person-fill pageIcon"></i>
            <p>Perfil</p>
        </a>
        <a href="/ConectaMaesProject/public/admin.php" class="userFunctions">
            <i class="bi bi-key-fill pageIcon"></i>
            <p>Administração</p>
        </a>
        <a href="/ConectaMaesProject/public/home/config.php" class="userFunctions">
            <i class="bi bi-gear-fill pageIcon"></i>
            <p>Configurações</p>
        </a>
        <span></span>
        <a href="/ConectaMaesProject/app/services/helpers/logOut.php" class="userFunctions">
            <i class="bi bi-arrow-left-circle pageIcon"></i>
            <p>Sair</p>
        </a>
        <span></span>
    </div>

</header>

<section class="modalSection close">
    <form class="Se-editPasswordModal pageModal close" method="post" id="formPassword">
        <div class="modalHeader">  
            <i class="bi bi-arrow-left-circle closeModal"></i>
            <h1>Alterar a Senha</h1>
        </div>

        <div class="Se-passwordInputs">
            <div class="Se-passInput">
                <input type="text" id="currentPassword" name="currentPassword">
                <label class="Re-fakePlaceholder" for="currentPassword">Senha Atual</label>
                <p class="Se-forgotPassword">Esqueceu a senha?</p>
            </div>
            <div class="Se-passInput">
                <input type="text" id="newPassword" name="newPassword">
                <label class="Re-fakePlaceholder" for="newPassword">Senha Nova</label>
            </div>
            <div class="Se-passInput">
                <input type="text" id="confirmNewPassword" name="confirmNewPassword">
                <label class="Re-fakePlaceholder" for="confirmNewPassword">Confirmar Senha Nova</label>
            </div>
        </div>

        <button class="Se-modalSubmit" type="submit" name="editPasswordSubmit">Confirmar</button>
    </form>

    <form class="Se-addNewChildModal pageModal close">
        <div class="modalHeader">  
            <i class="bi bi-arrow-left-circle closeModal"></i>
            <h1>Adicionar Filho(a)</h1>
        </div>

        <div class="Se-childInputs">
            <div class="Re-childBoxSex">
                <p> Sexo: </p>
                <div class="Re-sexOptions">
                    <input type="radio" name="childSex" value="boy" id="Re-childBoySex">
                    <label for="Re-childBoySex"> Menino </label>
                    <input type="radio" name="childSex" value="girl" id="Re-childGirlSex">
                    <label for="Re-childGirlSex"> Menina </label>
                    <input type="radio" name="childSex" value="nullSex" id="Re-childNullSex">
                    <label for="Re-childNullSex"> Não Informar </label>
                </div>
            </div>
            <div class="Se-childInput">
                <input type="text" id="newChildNameInput" name="newChildName" placeholder="- - - - - - - - - - - -">
                <label class="Re-fakePlaceholder" for="newChildNameInput">Nome Completo</label>
                <img src="/ConectaMaesProject/app/assets/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
            </div>
            <div class="Se-childInput">
                <input type="date" id="newChildDateInput" name="newChildDate">
                <label class="Re-fakePlaceholder" for="newChildDateInput">Data de Nascimento</label>
            </div>
            <div class="Se-childInput">
                <select id="newChildDeficiencyInput" name="newChildDeficiency">
                    <option value="N/a">- - - - Nenhuma - - - -</option>
                    <optgroup label="Deficiência Físicas">
                        <option value="G80">G80 — Paralisia cerebral</option>
                        <option value="G80.0">G80.0 — Paralisia cerebral quadriplégica espástica</option>
                        <option value="G80.1">G80.1 — Paralisia cerebral diplégica espástica</option>
                        <option value="G80.2">G80.2 — Paralisia cerebral hemiplégica espástica</option>
                        <option value="G80.3">G80.3 — Paralisia cerebral discinética</option>
                        <option value="G80.4">G80.4 — Paralisia cerebral atáxica</option>
                        <option value="G80.8">G80.8 — Outras formas de paralisia cerebral</option>
                        <option value="G80.9">G80.9 — Paralisia cerebral não especificada</option>
                        <option value="G81">G81 — Hemiplegia</option>
                        <option value="G81.0">G81.0 — Hemiplegia flácida</option>
                        <option value="G81.1">G81.1 — Hemiplegia espástica</option>
                        <option value="G81.9">G81.9 — Hemiplegia não especificada</option>
                        <option value="G82">G82 — Paraplegia e tetraplegia</option>
                        <option value="G82.0">G82.0 — Paraplegia flácida</option>
                        <option value="G82.1">G82.1 — Paraplegia espástica</option>
                        <option value="G82.2">G82.2 — Paraplegia não especificada</option>
                        <option value="G82.3">G82.3 — Tetraplegia flácida</option>
                        <option value="G82.4">G82.4 — Tetraplegia espástica</option>
                        <option value="G82.5">G82.5 — Tetraplegia não especificada</option>
                        <option value="G83.1">G83.1 — Monoplegia do membro inferior</option>
                        <option value="G83.4">G83.4 — Síndrome da cauda equina</option>
                        <option value="R26.0">R26.0 — Marcha atáxica</option>
                        <option value="R26.1">R26.1 — Marcha paralítica</option>
                        <option value="R26.2">R26.2 — Dificuldade para andar não classificada em outra parte</option>
                    </optgroup>
                    <optgroup label="Deficiência Neurológicas">
                        <option value="G04">G04 — Encefalite, mielite e encefalomielite</option>
                        <option value="G04.0">G04.0 — Encefalite aguda disseminada</option>
                        <option value="G04.1">G04.1 — Paraplegia espástica tropical</option>
                        <option value="G04.8">G04.8 — Outras encefalites, mielites e encefalomielites</option>
                        <option value="G04.9">G04.9 — Encefalite, mielite e encefalomielite não especificada</option>
                        <option value="G11">G11 — Ataxia hereditária</option>
                        <option value="G11.0">G11.0 — Ataxia congênita não-progressiva</option>
                        <option value="G11.1">G11.1 — Ataxia cerebelar de início precoce</option>
                        <option value="G11.2">G11.2 — Ataxia cerebelar de início tardio</option>
                        <option value="G11.3">G11.3 — Ataxia cerebelar com déficit na reparação do DNA</option>
                        <option value="G11.4">G11.4 — Paraplegia espástica hereditária</option>
                        <option value="G11.8">G11.8 — Outras ataxias hereditárias</option>
                        <option value="G11.9">G11.9 — Ataxia hereditária não especificada</option>
                        <option value="G20">G20 — Doença de Parkinson</option>
                        <option value="G30">G30 — Doença de Alzheimer</option>
                        <option value="G30.0">G30.0 — Doença de Alzheimer de início precoce</option>
                        <option value="G30.1">G30.1 — Doença de Alzheimer de início tardio</option>
                        <option value="G30.8">G30.8 — Outras formas de doença de Alzheimer</option>
                        <option value="G30.9">G30.9 — Doença de Alzheimer não especificada</option>
                        <option value="G35">G35 — Esclerose múltipla</option>
                    </optgroup>
                    <optgroup label="Deficiência Visuais">
                        <option value="H54">H54 — Cegueira visão subnormal</option>
                        <option value="H54.0">H54.0 — Cegueira, ambos os olhos</option>
                        <option value="H54.1">H54.1 — Cegueira em um olho e visão subnormal em outro</option>
                        <option value="H54.2">H54.2 — Visão subnormal de ambos os olhos</option>
                        <option value="H54.3">H54.3 — Perda não qualificada da visão em ambos os olhos</option>
                        <option value="H54.4">H54.4 — Cegueira em um olho</option>
                        <option value="H54.5">H54.5 — Visão subnormal em um olho</option>
                        <option value="H54.6">H54.6 — Perda não qualificada da visão em um olho</option>
                        <option value="H54.7">H54.7 — Perda não especificada da visão</option>
                    </optgroup>
                    <optgroup label="Deficiência Auditivas">
                        <option value="H80">H80 — Otosclerose</option>
                        <option value="H80.0">H80.0 — Otosclerose que compromete a janela oval, não-obliterante</option>
                        <option value="H80.1">H80.1 — Otosclerose que compromete a janela oval, obliterante</option>
                        <option value="H80.2">H80.2 — Otosclerose da cóclea</option>
                        <option value="H80.8">H80.8 — Outras otoscleroses</option>
                        <option value="H80.9">H80.9 — Otosclerose não especificada</option>
                        <option value="H90.0">H90.0 — Perda de audição bilateral devida a transtorno de condução</option>
                        <option value="H90.1">H90.1 — Perda de audição unilateral por transtorno de condução, sem restrição de audição contralateral</option>
                        <option value="H90.2">H90.2 — Perda não especificada de audição devida a transtorno de condução Surdez de condução SOE</option>
                        <option value="H90.3">H90.3 — Perda de audição bilateral neuro-sensorial</option>
                        <option value="H90.4">H90.4 — Perda de audição unilateral neuro-sensorial, sem restrição de audição contralateral</option>
                        <option value="H90.5">H90.5 — Perda de audição neuro-sensorial não especificada</option>
                        <option value="H90.6">H90.6 — Perda de audição bilateral mista, de condução e neuro-sensorial</option>
                        <option value="H90.7">H90.7 — Perda de audição unilateral mista, de condução e neuro-sensorial, sem restrição de audição contralateral</option>
                        <option value="H90.8">H90.8 — Perda de audição mista, de condução e neuro-sensorial, não especificada</option>
                        <option value="H91.0">H91.0 — Perda de audição ototóxica</option>
                        <option value="H91.1">H91.1 — Presbiacusia</option>
                        <option value="H91.2">H91.2 — Perda de audição súbita idiopática</option>
                        <option value="H91.3">H91.3 — Surdo-mudez não classificada em outra parte</option>
                        <option value="H91.8">H91.8 — Outras perdas de audição especificadas</option>
                        <option value="H91.9">H91.9 — Perda não especificada de audição</option>
                    </optgroup>
                    <optgroup label="Deficiência Intelectuais">
                        <option value="F84.0">F84.0 — Autismo infantil</option>
                        <option value="F84.1">F84.1 — Autismo atípico</option>
                        <option value="F84.5">F84.5 — Síndrome de Asperger</option>
                    </optgroup>
                </select>
                <label for="newChildDeficiencyInput">Deficiência</label>
            </div>
        </div>
        <button class="Se-modalSubmit" type="submit" name="editPasswordSubmit">Confirmar</button>
    </form>

    <form class="Se-deleteAccountModal pageModal close">
        <div class="modalHeader">  
            <i class="bi bi-arrow-left-circle closeModal"></i>
            <h1>Deletar Conta</h1>
        </div>

        <div class="Se-deleteInputs">
            <ul><li>Tem certeza que deseja deletar a conta?</li></ul>
            <div class="Se-deleteInput">
                <input type="text" id="confirmDelete" name="confirmDeleteText" placeholder="AS-x5s}wRRc2;a">
                <label class="Re-fakePlaceholder" for="confirmDelete">
                    <img src="/ConectaMaesProject/app/assets/imagens/icons/conectamaes_icon_black.png"></img>  
                </label>
            </div>
            <div class="Se-deleteInput">
                <input type="text" id="confirmDeleteInput" name="deleteTextInput">
                <label class="Re-fakePlaceholder" for="confirmDeleteInput">Reescreva o texto acima para confirmar</label>
            </div>
        </div>

        <button class="Se-modalSubmit" type="submit" name="deleteAccountSubmit">Confirmar</button>
    </form>
</section>

<script>
    function headerFunctions() {
        function toggleModals() {
            const modals = document.querySelectorAll('.headerModal');
            const makeAPostButton = document.querySelector('.makeAPost');
            let closeTimeout;

            function closeAllModals() {
                modals.forEach(modal => modal.classList.add('close'));
                makeAPostButton.classList.remove('active');
            }

            function toggleModal(modal, button = null) {
                const isClosed = modal.classList.contains('close');
                closeAllModals();
                if (isClosed) {
                    modal.classList.remove('close');
                    if (button) {
                        button.classList.add('active');
                    }
                }
            }

            document.querySelector('.userAccount').addEventListener('click', () => {
                toggleModal(document.querySelector('.userFunctionsModal'));
            });

            makeAPostButton.addEventListener('click', () => {
                toggleModal(document.querySelector('.makeAPostModal'), makeAPostButton);
            });

            modals.forEach(modal => {
                modal.addEventListener('mouseleave', () => {
                    closeTimeout = setTimeout(closeAllModals, 400);
                });
                modal.addEventListener('mouseenter', () => {
                    clearTimeout(closeTimeout);
                });
            });
        }

        function togglePages() {
            const homePageLink = document.getElementById('homePageLink');
            const reportPageLink = document.getElementById('reportPageLink');
            const helpPageLink = document.getElementById('helpPageLink');
            const currentUrl = window.location.href;

            if (currentUrl.includes('/ConectaMaesProject/public/home.php')) {
                homePageLink.classList.add('active');
            } else if (currentUrl.includes('/ConectaMaesProject/public/home/relatos.php')) {
                reportPageLink.classList.add('active');
            } else if (currentUrl.includes('/ConectaMaesProject/public/home/pedidos.php')) {
                helpPageLink.classList.add('active');
            }
        }

        toggleModals();
        togglePages();
    }

    function openModal() {
        const modalSection = document.querySelector('.modalSection');
        const closeModalBtns = document.querySelectorAll('.closeModal');
        const pageModals = document.querySelectorAll('.pageModal');

        function toggleModal(modalBtnSelector, modalSelector) {
            const modalBtn = document.querySelector(modalBtnSelector);
            const modal = document.querySelector(modalSelector);

            modalBtn.addEventListener('click', () => {
                modal.classList.toggle('close');
                modalSection.classList.toggle('close');
            });
        }

        closeModalBtns.forEach(closeModalBtn => {
            closeModalBtn.addEventListener('click', () => {
                pageModals.forEach(pageModal => {
                    pageModal.classList.add('close');
                });
                modalSection.classList.add('close');
            });
        });

        toggleModal('.Se-addNewChild', '.Se-addNewChildModal');
        toggleModal('.editPasswordInput', '.Se-editPasswordModal');
        toggleModal('.Se-accountDelete', '.Se-deleteAccountModal');
    }

    openModal();
    headerFunctions();
</script>

