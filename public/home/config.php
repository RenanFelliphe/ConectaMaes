<?php
    session_start();
    include_once __DIR__ . "/../../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:" . $relativePublicPath . "/login.php");
    require_once "../../app/services/crud/userFunctions.php"; 
    $table = "Usuario";
    $currentUserData = queryUserData($conn, $table, $_SESSION['idUsuario']);   
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../../app/assets/styles/style.css">
        <link rel="icon" href="../../app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Configurações</title>
        </meta>
    </head>
    <body class="<?php echo $currentUserData['tema'];?>">
        <?php include_once ("../../app/includes/headerHome.php");?>
        <main class="Ho-Main Se-main mainSystem">
            <section class="Se-asideLeft">
                <img src="" class="backCells cellsLeft">
            </section>

            <section class="Se-settingsCenter">
                <div class="Se-centerHeader">  
                    <a href="../home.php"><i class="bi bi-arrow-left-circle"></i></a>
                    <h1>Configurações</h1>
                </div>
                <div class="Se-centerSections">
                    <a class="Se-sectionTitle active" onclick="toggleConfigSection();">
                        <div>
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/user_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Informações da Conta</p>
                        </div>
                        <i class="bi bi-chevron-right" onclick="toggleConfigSection();"></i>
                    </a>

                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Informações dos Filhos</p>
                        </div>
                        <i class="bi bi-chevron-right" onclick="toggleConfigSection();"></i>
                    </a>

                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/chat_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Interações com outros usuários</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/lock_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Segurança</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/notifications_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Notificações</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a class="Se-sectionTitle" href="../../index.php">
                        <div>
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/conectamaes_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Sobre o ConectaMães</p>
                        </div>
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>

                    <a class="Se-sectionTitle" href="../suporte.php">
                        <div>
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/support_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Suporte</p>
                        </div>
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </section>

            <section class="Se-asideRight infoAccount">
                <form class="Se-accountInformations Se-subSection active" method="post" enctype="multipart/form-data">
                    <div class="Se-sectionHeader">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/user_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Informações da Conta</h1>
                    </div>
                    <div class="Se-userInfo">
                        <div class="Re-addImageProfile">
                            <div class="Re-userImageProfile">
                                <img src="<?php echo $relativeAssetsPath; ?>/imagens/fotos/perfil/<?php echo $currentUserData['linkFotoPerfil']; ?>" alt="" class="Re-userImage">
                            </div>
                            <input type="file" id="imagesSelector" name="fotoPerfilEdit" accept="image/png, image/jpeg">
                            <label for="imagesSelector" class="Re-addImageIcon">                        
                                <i class="bi bi-camera-fill"></i>                    
                            </label>
                        </div>
                        <div class="Re-userInfoContainer">
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Usuário:</p>
                                <p class="Re-userInfo"><?php echo $currentUserData['nomeDeUsuario'];?></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Email:</p>
                                <p class="Re-userInfo"><?php echo $currentUserData['email'];?></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Data de Nascimento:</p>
                                <p class="Re-userInfo">
                                    <?php 
                                        $data = new DateTime($currentUserData['dataNascimentoUsuario']);                                          
                                        $dataFormatada = $data->format('d/m/Y');
                                        echo $dataFormatada; 
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="Se-editInfo">
                        <input type="hidden" class="updaterIdHiddenInput" name="updaterId" value="<?php echo $currentUserData['idUsuario']; ?>">    
                        <div class="Se-userInput full-width">
                            <input type="text" id="nomeCompletoUsuario" name="nomeEdit" value="<?php echo $currentUserData['nomeCompleto'];?>">
                            <label class="Re-fakePlaceholder" for="nomeCompletoUsuario">Nome Completo</label>
                            <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                        </div>
                        <div class="Se-userInput full-width">
                            <textarea name="biografiaUsuarioEdit" id="biografiaUsuario" cols="54" rows="3"><?php echo $currentUserData['biografia'];?></textarea>                        
                            <label class="Re-fakePlaceholder" for="biografiaUsuario">Biografia</label>
                            <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                        </div>
                        <div class="Se-userInput side-by-side">
                            <select id="localizacaoUsuario" name="localizacaoEdit">
                                <option value="">- - - - - -</option>
                                <option value="Acre"> AC | Acre</option>
                                <option value="Alagoas"> AL | Alagoas</option>
                                <option value="Amapá"> AP | Amapá</option>
                                <option value="Amazonas"> AM | Amazonas</option>
                                <option value="Bahia"> BA | Bahia</option>
                                <option value="Ceará"> CE | Ceará</option>
                                <option value="Distrito Federal"> DF | Distrito Federal</option>
                                <option value="Espírito Santo"> ES | Espírito Santo</option>
                                <option value="Goiás"> GO | Goiás</option>
                                <option value="Maranhão"> MA | Maranhão</option>
                                <option value="Mato Grosso"> MT | Mato Grosso</option>
                                <option value="Mato Grosso do Sul"> MS | Mato Grosso do Sul</option>
                                <option value="Minas Gerais"> MG | Minas Gerais</option>
                                <option value="Pará"> PA | Pará</option>
                                <option value="Paraíba"> PB | Paraíba</option>
                                <option value="Paraná"> PR | Paraná</option>
                                <option value="Pernambuco"> PE | Pernambuco</option>
                                <option value="Piauí"> PI | Piauí</option>
                                <option value="Rio de Janeiro"> RJ | Rio de Janeiro</option>
                                <option value="Rio Grande do Norte"> RN | Rio Grande do Norte</option>
                                <option value="Rio Grande do Sul"> RS | Rio Grande do Sul</option>
                                <option value="Rondônia"> RO | Rondônia</option>
                                <option value="Roraima"> RR | Roraima</option>
                                <option value="Santa Catarina"> SC | Santa Catarina</option>
                                <option value="São Paulo"> SP | São Paulo</option>
                                <option value="Sergipe"> SE | Sergipe</option>
                                <option value="Tocantins"> TO | Tocantins</option>                 
                            </select>
                            <label class="Re-fakePlaceholder" for="localizacao" style="pointer-events: none;">Localização</label>
                        </div>
                        
                        <div class="Se-userInput side-by-side">
                            <input type="text" id="telefoneUsuario" name="telefoneEdit" value="<?php echo $currentUserData['telefone'];?>">
                            <label class="Re-fakePlaceholder" for="telefoneUsuario">Telefone</label>
                            <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                        </div>
                        <div class="Re-themeInfo">
                            <p> Tema </p>
                            <div class="Re-themeOptions">
                                <input type="radio" name="temaEdit" value="Y-theme" id="Re-yellowTheme" <?php echo ($currentUserData['tema'] === 'Y-theme') ? 'checked' : ''; ?>>
                                <label for="Re-yellowTheme"> Amarelo </label>
                                <input type="radio" name="temaEdit" value="B-theme" id="Re-blueTheme" <?php echo ($currentUserData['tema'] === 'B-theme') ? 'checked' : ''; ?>>
                                <label for="Re-blueTheme"> Azul </label>
                                <input type="radio" name="temaEdit" value="P-theme" id="Re-pinkTheme" <?php echo ($currentUserData['tema'] === 'P-theme') ? 'checked' : ''; ?>>
                                <label for="Re-pinkTheme"> Rosa </label>
                            </div>
                        </div>
                        <button class="Se-accountEdit confirmBtn" type="submit" name="editar">Editar conta</button>
                    </div>

                    <?php
                        if(isset($_POST['editar'])) {   
                            if($_POST['updaterId'] === $currentUserData['idUsuario']) {
                                editProfile($conn, $_POST['updaterId']);
                            } else {
                                echo "Algo deu errado!";
                            }
                        }
                    ?>
                            
                    <div class="Se-accountBottom">
                        <span class="Se-dateCriation"> Criado em: <span class="Se-accountDate">28/05/2024</span></span>
                        <button class="Se-accountDelete confirmBtn" onclick="openModal();">Excluir conta</button> <!--name="deletar" href="./config.php?deletar=true-->
                    </div>
                </form>

                <div class="Se-childInformations Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Informações dos Filhos</h1>
                    </div>
                    <form class="Se-userChild" method="post">
                        <div class="Se-childHeader">
                            <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/boy_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <input type="text" value="Nome do filho">
                            <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                        </div>
                        <div class="Se-childInputs">
                            <div class="Se-childInfoContainer">
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
                            <div class="Se-childInfoContainer">
                                <p class="Se-infoLabel">Data de Nascimento:</p>
                                <p class="Se-childInfo">dd/mm/yyyy</p>
                            </div>
                            <div class="Se-childInfoContainer">
                                <p class="Se-infoLabel">Deficiência:</p>
                                <p class="Se-childInfo">
                                    <select name="showDeficienciaSelect" id="showDeficienciaSelect" >
                                        <option value="N/a">N/a</option>
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
                                </p>
                            </div>
                        </div>
                        <div class="Se-childBottom">
                            <p class="Se-deleteChild">Excluir Filho(a)</p>
                            <button class="Se-editSubmit confirmBtn" type="submit" name="editChildSubmit">Confirmar</button>
                        </div>
                    </form>
                    <button class="Se-addNewChild confirmBtn" onclick="openModal();">Adicionar Filho(a)</button>
                </div>

                <div class="Se-otherUsersInteractions Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/chat_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Interações com outros usuários</h1>
                    </div>
                </div>

                <div class="Se-security Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/lock_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Segurança</h1>
                    </div>

                    <ul>
                        <li><form class="Se-editPassword" method="post" id="formPassword">
                                <h4> Senha </h4>
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

                                <button class="Se-editSubmit confirmBtn" type="submit" name="editPasswordSubmit">Confirmar</button>
                        </form></li>

                        <li><form class="Se-editPhoneNumber">
                                <h4> Número de Telefone </h4>
                                <div class="Se-phoneInput">
                                    <input type="text" id="editTelephone" name="editTelephoneNumber">
                                    <label class="Re-fakePlaceholder" for="telephoneNumber">Telefone</label>
                                    <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                                </div>
                                <button class="Se-editSubmit confirmBtn" type="submit" name="editTelephone Submit">Confirmar</button>
                        </form></li>

                        <li><div class="Se-accountType">
                                <h4> Tipo de Conta </h4>
                                <div class="Se-accountOptions">
                                    <div>
                                        <input type="radio" name="accountType" value="padrao" id="Se-standartAccount" <?php /*echo ($currentUserData['isAnonimo'] === 'false') ? 'checked' : '';*/?>>
                                        <label for="Se-standartAccount"> Padrão </label>
                                        <i class="bi bi-info-circle-fill pageIcon"></i>                    
                                    </div>
                                    <div>
                                        <input type="radio" name="accountType" value="anonima" id="Se-anonymousAccount" <?php /*echo ($currentUserData['isAnonimo'] === 'true') ? 'checked' : '';*/?>>
                                        <label for="Se-anonymousAccount"> Anônima </label>
                                        <i class="bi bi-info-circle-fill pageIcon"></i>                    
                                    </div>
                                </div>
                        </div></li>
                    </ul>
                </div>

                <div class="Se-notifications Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/notifications_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Notificações</h1>
                    </div>
                </div>
            </section>
            <?php 
                if(isset($_GET['deletar'])){ 
                ?>
                    <modal class="Se-accountDeleteModal">
                        <h2>Tem certeza que deseja deletar sua conta?</h2>
                        <form class="Se-accountDeleteModalForm" method="post">
                            <input type="hidden" name="deleterId" value=<?php echo $currentUserData['idUsuario'];?>>
                            <input type="text" placeholder="<?php echo "delete/".$currentUserData['idUsuario']."/".$currentUserData['nomeDeUsuario'];?>"
                                name="confirmaTextoDelete">
                            <button type="submit" id="Se-submitAccountDeleteModalForm">ENVIAR</button>
                            <button id="Se-cancelAccountDelete">CANCELAR</button>
                        <?php
                            if(isset($_POST['confirmaTextoDelete'])){
                                if($_POST['confirmaTextoDelete'] === ("delete/".$currentUserData['idUsuario']."/".$currentUserData['nomeDeUsuario']))
                                {
                                    deleteAccount($conn, $table, $_POST['deleterId']);
                                }
                                else
                                {
                                    echo "Insira o texto corretamente!";
                                }
                            }
                            
                        ?>
                        </form>
                    </modal>
            <?php
                }
            ?>
        </main>

    <?php include_once ("../../app/includes/modais.php");?>

    <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toggleConfigSection();
        });
    </script>
    </body>
</html>