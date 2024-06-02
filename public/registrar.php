<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../app/assets/styles/variable.css">
    <link rel="stylesheet" href="../app/assets/styles/style.css">
    <link rel="stylesheet" href="../app/assets/styles/include.css">
    <link rel="icon" href="../app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Registro</title>
</head>

<body>
    <?php 
            include_once ("../app/includes/headerLanding.php");
            include_once ("../app/services/crud/userFunctions.php");
        ?>

    <main class="Re-register">
        <img src="" class="backCells">
        <img src="" class="backCells cellsLeft">

        <form class="Re-registerForm">
            <div class="Re-registerHeader">
                <i class="bi bi-arrow-left-circle Re-backButton close"></i>
                <h1 class="Re-registerTitle"> Registro </h1>
                <p>Venha logo fazer parte desta comunidade!</p>
            </div>

            <div class="Re-registerCenter">
                <div class="Re-accountInformations Re-registerSections ">
                    <div class="Re-input">
                        <input type="text" id="nomeUsuario" name="userRegistro" required autofocus>
                        <label class="Re-fakePlaceholder" for="nomeUsuario">Usuário</label>
                    </div>
                    <div class="Re-input">
                        <input type="text" id="email" name="emailRegistro" required>
                        <label class="Re-fakePlaceholder" for="email">Email</label>
                    </div>
                    <div class="Re-input">
                        <input type="password" id="senha" name="senhaRegistro" required>
                        <label class="Re-fakePlaceholder" for="senha">Senha</label>
                    </div>
                    <div class="Re-input">
                        <input type="password" id="confirmarSenha" name="senhaRegistroConfirma" required>
                        <label class="Re-fakePlaceholder" for="confirmarSenha">Confirmar Senha</label>
                    </div>

                    <div class="Re-themeInfo">
                        <p> Tema </p>
                        <div class="Re-themeOptions">
                            <input type="radio" name="temaRegistro" value="Amarelo" id="Re-yellowTheme" checked>
                            <label for="Re-yellowTheme"> Amarelo </label>
                            <input type="radio" name="temaRegistro" value="Azul" id="Re-blueTheme">
                            <label for="Re-blueTheme"> Azul </label>
                            <input type="radio" name="temaRegistro" value="Rosa" id="Re-pinkTheme">
                            <label for="Re-pinkTheme"> Rosa </label>
                        </div>
                    </div>
                </div>

                <div class="Re-userInformations Re-registerSections close">
                    <div class="Re-input">
                        <input type="text" id="nomeCompleto" name="nomeUsuarioRegistro" required autofocus>
                        <label class="Re-fakePlaceholder" for="nomeCompleto">Nome Completo</label>
                    </div>
                    <div class="Re-input">
                        <input type="text" id="telefone" name="telefoneRegistro" required>
                        <label class="Re-fakePlaceholder" for="telefone">Telefone</label>
                    </div>
                    <div class="Re-input">
                        <input type="text" id="dataNascimento" name="dataNascimentoRegistro" required>
                        <label class="Re-fakePlaceholder" for="dataNascimento">Data de Nascimento</label>
                    </div>
                    <div class="Re-input">
                        <input type="hidden" name="latitudeRegistro" id="latitude" value="">
                        <input type="hidden" name="longitudeRegistro" id="longitude" value="">
                        <input type="text" id="localizacao" name="localizacaoRegistro" value="" required readonly>
                        <label class="Re-fakePlaceholder" for="localizacao">Localização</label>
                    </div>
                    <div class="Re-input">
                        <textarea name="biografiaUsuario" id="biografiaUsuario" cols="54" rows="4" required></textarea>                        
                        <label class="Re-fakePlaceholder" for="biografiaUsuario">Biografia</label>
                    </div>
                </div>

                <div class="Re-childInformations Re-registerSections close">
                    <div class="Re-childInfo">
                        <label class="Re-addChild"> Adicionar filho +</label>
                        <div class="Re-haveNoChildBox">
                            <input type="checkbox" id="Re-haveNoChild">
                            <label for="Re-haveNoChild"> Não tenho filho</label>
                        </div>
                    </div>

                    <div class="Re-addChildBox close">
                        <div class="Re-childBoxHeader">
                            <i class="bi bi-balloon Re-childIcon"></i>
                            <input type="text" class="Re-childName" placeholder="Nome Completo" required>
                        </div>

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

                        <div class="Re-childBoxInputs">
                            <div class="Re-input">
                                <input type="date" id="dataNascFilho" placeholder="dd/mm/yyyy" required>
                                <label for="dataNascFilho">Data de Nascimento</label>
                            </div>
                            <div class="Re-input">
                                <select name="deficienciaSelect" id="deficiencia" required>
                                    <option value="valor0">- - - - Nenhuma - - - -</option>
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
                                <label for="deficiencia">Deficiência</label>
                            </div>
                        </div>

                        <div class="Re-childBoxButtons">
                            <button class="Re-cancelAddChild"> Cancelar </button>
                            <button> Confirmar </button>
                        </div>
                    </div>
                </div>

                <div class="Re-registerResult Re-registerSections close">
                    <div class="Re-addImageProfile">
                        <div class="Re-userImageProfile">
                            <img src="../app/assets/imagens/icons/user_no_profile_image.png" alt="" class="Re-userImage">
                        </div>

                        <input type="file" id="imagesSelector" accept="image/*">
                        <label for="imagesSelector" class="Re-addImageIcon">                        
                            <i class="bi bi-camera-fill"></i>                    
                        </label>
                    </div>

                    <div class="Re-userInfoContainer">
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Nome:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Usuário:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Email:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Telefone:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Data de Nascimento:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                        <div class="Re-userInformations">
                            <p class="Re-infoLabel">Localização:</p>
                            <p class="Re-userInfo"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Re-registerBottom">
                <div class="Re-termsBox close">
                    <input type="checkbox" id="Re-terms">
                    <label for="Re-terms">Eu li e concordo com os Termos e Condições</label>
                </div>
                <button class="Re-registerNext" type="button">Próximo</button>
                <button class="Re-registerSubmit close" type="submit" name="registrar">Registrar</button>
                <p class="Re-goLogin">Já possui uma conta? <a href="login.php">Entre</a></p>
            </div>
        </form>

        <?php
            signUp($conn);
        ?>
    </main>

    <?php include_once ("../app/includes/footer.php");?>

</body>

<script src="../app/assets/js/loginRegister.js"></script>

</html>