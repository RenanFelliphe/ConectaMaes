<?php
    include_once ("../../app/includes/globalIncludes.php");
    require_once "../../app/services/crud/disabilityFunctions.php";
    $relatosAnonimosUsuario = queryPostsAndUserData($conn, 'Relato')
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

    <body class="<?= $currentUserData['tema'];?>">
        <?php 
            include_once ("../../app/includes/headerHome.php");
        ?>
        
        <main class="Ho-Main Se-main mainSystem">
            <?php include_once "../../app/includes/asideLeft.php";?>
            <section class="Se-settingsCenter">
                <div class="Se-centerHeader">  
                    <a href="../home.php"><i class="bi bi-arrow-left-circle"></i></a>
                    <h1>Configurações</h1>
                </div>
                <div class="Se-centerSections">
                    <a class="Se-sectionTitle active" onclick="toggleConfigSection();">
                        <div>
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/user_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Informações da Conta</p>
                        </div>
                        <i class="bi bi-chevron-right" onclick="toggleConfigSection();"></i>
                    </a>

                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Informações dos Filhos</p>
                        </div>
                        <i class="bi bi-chevron-right" onclick="toggleConfigSection();"></i>
                    </a>
                    
                    <!-- -->
                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/chat_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Interações com outros usuários</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/lock_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Segurança e Privacidade</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <!-- -->
                    <a class="Se-sectionTitle">
                        <div>
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/notifications_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Notificações</p>
                        </div>
                        <i class="bi bi-chevron-right"></i>
                    </a>

                    <a class="Se-sectionTitle" href="../../index.php">
                        <div>
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/conectamaes_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Sobre o ConectaMães</p>
                        </div>
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>

                    <a class="Se-sectionTitle" href="../suporte.php">
                        <div>
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/support_icon.png" class="pageIcon" alt="Ícone de usuário">
                            <p> Suporte</p>
                        </div>
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </section>

            <section class="Se-asideRight infoAccount">
                <form class="Se-accountInformations Se-subSection active" method="post" enctype="multipart/form-data">
                    <div class="Se-sectionHeader">
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/user_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Informações da Conta</h1>
                    </div>
                    <div class="Se-userInfo">
                        <div class="Re-addImageProfile">
                            <div class="Re-userImageProfile">
                                <img src="<?= $relativeAssetsPath; ?>/imagens/fotos/perfil/<?= $currentUserData['linkFotoPerfil']; ?>" alt="" class="Re-userImage">
                            </div>
                            <input type="file" id="imagesSelector" name="fotoPerfilEdit" accept="image/png, image/jpeg">
                            <label for="imagesSelector" class="Re-addImageIcon">                        
                                <i class="bi bi-camera-fill"></i>                    
                            </label>
                        </div>
                        <div class="Re-userInfoContainer">
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Usuário:</p>
                                <p class="Re-userInfo"><?= $currentUserData['nomeDeUsuario'];?></p>
                            </div>
                            <div class="Re-userInformations">
                                <p class="Re-infoLabel">Email:</p>
                                <p class="Re-userInfo"><?= $currentUserData['email'];?></p>
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
                        <input type="hidden" class="updaterIdHiddenInput" name="updaterId" value="<?= $currentUserData['idUsuario']; ?>">    
                        <div class="Se-userInput full-width">
                            <input type="text" id="nomeCompletoUsuario" name="nomeEdit" value="<?= $currentUserData['nomeCompleto'];?>">
                            <label class="Re-fakePlaceholder" for="nomeCompletoUsuario">Nome Completo</label>
                            <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>
                        </div>
                        <div class="errorMessageContainer">
                            <div class="errorMessageContent"></div>
                        </div>

                        <div class="Se-userInput full-width">
                            <textarea name="biografiaUsuarioEdit" id="biografiaUsuario" cols="54" rows="3"><?= $currentUserData['biografia']; ?></textarea>
                            <label class="Re-fakePlaceholder" for="biografiaUsuario">Biografia</label>
                            <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>
                        </div>
                        <div class="errorMessageContainer">
                            <div class="errorMessageContent"></div>
                        </div>

                        <div class="Se-userInput full-width">
                            <input type="number" id="localizacaoUsuario" name="localizacaoEdit" value="<?= $currentUserData['estado']; ?>">
                            <label class="Re-fakePlaceholder" for="localizacaoUsuario" style="pointer-events: none;">Código de Endereçamento Postal (CEP)</label>
                        </div>
                        <div class="errorMessageContainer">
                            <div class="errorMessageContent"></div>
                        </div>

                        <div class="Re-themeInfo">
                            <p> Tema </p>
                            <div class="Re-themeOptions">
                                <input type="radio" name="temaEdit" value="Y-theme" id="Re-yellowTheme" <?= ($currentUserData['tema'] === 'Y-theme') ? 'checked' : ''; ?>>
                                <label for="Re-yellowTheme"> Amarelo </label>
                                <input type="radio" name="temaEdit" value="B-theme" id="Re-blueTheme" <?= ($currentUserData['tema'] === 'B-theme') ? 'checked' : ''; ?>>
                                <label for="Re-blueTheme"> Azul </label>
                                <input type="radio" name="temaEdit" value="P-theme" id="Re-pinkTheme" <?= ($currentUserData['tema'] === 'P-theme') ? 'checked' : ''; ?>>
                                <label for="Re-pinkTheme"> Rosa </label>
                            </div>
                        </div>
                        <button class="Se-accountEdit confirmBtn" type="submit" name="editarPerfil" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Editar conta</button>
                    </div>

                    <span class="Se-dateCriation"> Criado em: 
                        <span class="Se-accountDate">
                            <?= dateMessage($currentUserData['dataCriacaoUsuario']);
                            ?>
                        </span>
                    </span>
                </form>

                <div class="Se-childInformations Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Informações dos Filhos</h1>
                    </div>
                    <?php
                        $filhos = queryMultipleChildrenData($conn, $where = "idUsuario = " . $currentUserData['idUsuario'], $order = "nomeFilho");
                        foreach($filhos as $f){
                    ?>
                        <div class="Se-myChildBtn">
                            <form class="childHeader" method="POST" onclick="toggleChildData(this);">
                                <input type="hidden" name="childIdentifier" value="<?= $f['idFilho']; ?>">
                                <img class ="childIcon" src="<?= $relativeAssetsPath; ?>/imagens/icons/<?= $f['sexo'] === 'boy' ? 'boy_icon' : ($f['sexo'] === 'girl' ? 'girl_icon' : 'pram_icon'); ?>.png" class="pageIcon" alt="Ícone do Filho">
                                <p class="childName"><?= $f['nomeFilho']; ?></p>
                                <button type="submit" class=" deleteChildButton" name="deletarFilho" <?php if($currentUserData['idUsuario'] == 1){echo "disabled";}?>><i class="bi bi-x" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>></i></button> 
                            </form>

                            <form class="childData" method="post">
                                <input type="hidden" name="childIdentifier" value="<?= $f['idFilho']; ?>">
                                <div class="childSpecificData">
                                    <span><strong>Sexo:</strong>  
                                        <?php 
                                            switch($f['sexo']){
                                                case 'girl': echo  "Feminino"; break;
                                                case 'boy': echo "Masculino"; break;
                                                case 'nullSex': echo "Não informado"; break;
                                                default: echo 'N/a';
                                            }
                                        ?>
                                    </span>
                                </div>
                                <div class="childSpecificData">
                                    <span><strong>Data de Nascimento:</strong>
                                        <?php 
                                            $data = new DateTime($f['dataNascimentoFilho']);                                          
                                            $dataFormatadaFilho = $data->format('d/m/Y');
                                            echo $dataFormatadaFilho; 
                                        ?>
                                     </span> 
                                </div>
                                <div class="childSpecificData">
                                    <span><strong>Deficiência:</strong>  <?= $f['deficiencias'] ;?></span>
                                </div>
                                <div class="editarFilho" name="editarFilho" onclick="toggleEditChildForm(this);">Editar Filho(a)</div>
                            </form>

                            <form method="post" class="editChildForm">
                                <input type="hidden" name="childEditIdentifier" value="<?= $f['idFilho']; ?>">
                                <div class="childNameEditor">
                                    <p> Nome: </p>
                                    <input type="text" class="Re-childName" id="nomeFilho" name="editChildName" placeholder="Nome Completo" value="<?= $f['nomeFilho'];?>"required>
                                </div>
                                <div class="childSexEditor">
                                    <p> Sexo: </p>
                                    <div class="sexOptions">
                                        <?php
                                            $sexOptions = ['boy' => 'Masculino', 'girl' => 'Feminino', 'nullSex' => 'Não Informar'];

                                            foreach ($sexOptions as $value => $label) {
                                                $checked = ($f['sexo'] === $value) ? 'checked' : '';
                                                echo "<input type='radio' name='editChildSex' value='$value' id='child{$value}Sex' $checked>";
                                                echo "<label for='child{$value}Sex'> $label </label>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="childBirthEditor">
                                    <label for="dataNascFilho">Data de Nascimento</label>
                                    <input type="date" id="dataNascFilho" name="editChildBirthDate" value="<?= date('Y-m-d', strtotime($f['dataNascimentoFilho'])); ?>" required>
                                </div>
                                <div class="childDisabilityEditor">
                                    <label for="editChildDisability">Deficiência</label>
                                    <div class="input">
                                        <?php $childDisability = queryChildDisability($conn, $f['idFilho'])[0]; ?>
                                        <select name="editChildDisability" id="deficiencia">
                                            <option value="N/a" <?= ($childDisability['categoriaCID'] == 'N/a') ? 'selected' : '' ?>> Não informar </option>
                                            <optgroup label="Deficiência Físicas">
                                                <?php 
                                                    $physical_defs = queryMultipleDefData($conn, "categoriaCID LIKE 'G8%' OR categoriaCID LIKE 'R2%'", "categoriaCID ASC"); 
                                                    foreach($physical_defs as $pd){
                                                ?>
                                                    <option value="<?=$pd['categoriaCID']?>" <?= ($childDisability['categoriaCID'] == $pd['categoriaCID']) ? 'selected' : '' ?>><?= $pd['categoriaCID'] . " - " . $pd['nomeDeficiencia']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </optgroup>
                                            <optgroup label="Deficiência Neurológicas">
                                                <?php 
                                                    $neural_des = queryMultipleDefData($conn, "categoriaCID LIKE 'G0%' OR categoriaCID LIKE 'G1%' OR categoriaCID LIKE 'G2%' OR categoriaCID LIKE 'G3%'", "categoriaCID ASC"); 
                                                    foreach($neural_des as $nd){
                                                ?>
                                                    <option value="<?=$nd['categoriaCID']?>" <?= ($childDisability['categoriaCID'] == $nd['categoriaCID']) ? 'selected' : '' ?>><?= $nd['categoriaCID'] . " - " . $nd['nomeDeficiencia']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </optgroup>
                                            <optgroup label="Deficiência Visuais">
                                                <?php 
                                                    $visual_des = queryMultipleDefData($conn, "categoriaCID LIKE 'H5%'", "categoriaCID ASC"); 
                                                    foreach($visual_des as $vd){
                                                ?>
                                                    <option value="<?=$vd['categoriaCID']?>" <?= ($childDisability['categoriaCID'] == $vd['categoriaCID']) ? 'selected' : '' ?>><?= $vd['categoriaCID'] . " - " . $vd['nomeDeficiencia']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </optgroup>
                                            <optgroup label="Deficiência Auditivas">
                                                <?php 
                                                    $aud_des = queryMultipleDefData($conn, "categoriaCID LIKE 'H8%' OR categoriaCID LIKE 'H9%'", "categoriaCID ASC"); 
                                                    foreach($aud_des as $ad){
                                                ?>
                                                    <option value="<?=$ad['categoriaCID']?>" <?= ($childDisability['categoriaCID'] == $ad['categoriaCID']) ? 'selected' : '' ?>><?= $ad['categoriaCID'] . " - " . $ad['nomeDeficiencia']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </optgroup>
                                            <optgroup label="Deficiência Intelectuais">
                                                <?php 
                                                    $int_des = queryMultipleDefData($conn, "categoriaCID LIKE 'F%'", "categoriaCID ASC"); 
                                                    foreach($int_des as $id){
                                                ?>
                                                    <option value="<?=$id['categoriaCID']?>" <?= ($childDisability['categoriaCID'] == $id['categoriaCID']) ? 'selected' : '' ?>><?= $id['categoriaCID'] . " - " . $id['nomeDeficiencia']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="childButtons">
                                    <div name="voltar" onclick="toggleEditChildForm(this);">Cancelar Edição</div>
                                    <button type="submit" name="confirmarEditarFilho" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Salvar alterações</button>
                                </div>
                            </form> 
                        </div>
                    <?php  
                        } 
                    ?>
                    <?php
                        if (isset($add_child_messages) && !empty($add_child_messages)){
                            foreach ($add_child_messages as $a_c_m) {
                                echo $a_c_m;
                            }
                        }   
                    ?>
                    <button class="Se-addNewChild confirmBtn" data-type="addChild" onclick="toggleModal(this);" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Adicionar Filho(a)</button>
                </div>

                <div class="Se-otherUsersInteractions Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/chat_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Interações com outros usuários</h1>
                    </div>
                </div>

                <div class="Se-security Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/lock_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Segurança</h1>
                    </div>

                    <ul>
                        <li>
                            <form class="Se-editPassword" method="post" id="formPassword">
                                <h4> Senha </h4>
                                <input type="hidden" class="updaterIdHiddenInput" name="updaterId" value="<?= $currentUserData['idUsuario']; ?>">   
                                <div class="Se-passwordInputs">
                                    <div class="Se-passInput">
                                        <input type="text" id="currentPassword" name="currentPassword">
                                        <label class="Re-fakePlaceholder" for="currentPassword">Senha Atual</label>
                                        <!-- <p class="Se-forgotPassword">Esqueceu a senha?</p> -->
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
                                <button class="Se-editSubmit confirmBtn" type="submit" name="editPasswordSubmit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Confirmar</button>
                                <?php
                                    if (isset($password_messages) && !empty($password_messages)) {
                                        foreach ($password_messages as $p_m) {
                                            echo $p_m;
                                        }
                                    }
                                ?>
                            </form>
                        </li>

                        <li>
                            <form class="Se-editPhoneNumber" method="post" id="formTelephone">
                                <input type="hidden" class="updaterIdHiddenInput" name="updaterId" value="<?= $currentUserData['idUsuario']; ?>">    
                                <h4> Número de Telefone </h4>
                                <div class="Se-phoneInput">
                                    <input type="text" id="editTelephone" name="editTelephoneNumber">
                                    <label class="Re-fakePlaceholder" for="telephoneNumber">Telefone</label>
                                    <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                                </div>
                                <button class="Se-editSubmit confirmBtn" type="submit" name="editTelephoneSubmit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Confirmar</button>
                                <?php
                                    if (isset($phone_messages) && !empty($phone_messages)) {
                                        foreach ($phone_messages as $p_m) {
                                            echo $p_m;
                                        }
                                    }
                                ?>
                            </form>
                        </li>
                        <li>
                            <form class="Se-editPixKey" method="post" id="formPixKey">
                                <input type="hidden" class="updaterIdHiddenInput" name="updaterId" value="<?= $currentUserData['idUsuario']; ?>">    
                                <?php $hasPixKey = isset($currentUserData['chavePix']) && !in_array($currentUserData['chavePix'], ['N/a', NULL, '']); ?>
                                <h4> <?= $hasPixKey ? 'Editar chave Pix' : 'Adicionar chave Pix'; ?> </h4>

                                <div class="Se-pixInput">
                                    <input type="text" id="editPixKey" name="editPixKey" value="">
                                    <label class="Re-fakePlaceholder" for="editPixKey">Chave Pix</label>
                                    <i class="bi bi-pencil-fill Se-editIcon pageIcon"></i>                    
                                </div>

                                <button class="Se-editSubmit confirmBtn" type="submit" name="editPixSubmit" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>
                                    <?= $hasPixKey ? 'Editar' : 'Adicionar'; ?>
                                </button>

                                <?php
                                    if (isset($pix_messages) && !empty($pix_messages)) {
                                        foreach ($pix_messages as $p_m) {
                                            echo $p_m;
                                        }
                                    }
                                ?>
                            </form>
                        </li>


                    </ul>
                    <div class="Se-sectionHeader">
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/lock_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Privacidade</h1>
                    </div>

                    <ul>
                        <li>
                            <div class="Se-reportPrivacy" method="post" id="formAnonymous">
                                <h4>Relatos Anônimos</h4>
                                <?php
                                    if (isset($anonIdentification_message)) {
                                        ?><div class='feedbackMessage'><?=$anonIdentification_message?></div><?php
                                    }
                                ?>
                                <?php 
                                    $encontrouAnonimo = false; // Variável de controle para verificar se algum relato anônimo foi encontrado.

                                    foreach($relatosAnonimosUsuario as $ra){
                                        if($ra['isAnonima']){
                                ?>
                                    <form class="relatoAnonimo" method="post">
                                        <div class="raHeader">
                                            <input type="hidden" name="anonymousReportIdentifier" class="anonymousReportUpdater" value="<?= $ra['idPublicacao'];?>">
                                            <div class="raTitle">Título: <?= $ra['titulo'];?></div>
                                            <div class="raIdentify">
                                                <label for="meIdentificarCheckboxEdit">
                                                    <input type="checkbox" id="meIdentificarCheckboxEdit" name="meIdentificarEdit">
                                                    Me identificar
                                                </label>
                                                <i class="bi bi-info-circle-fill" id="infoIcon"></i>
                                            </div>
                                        </div>
                                        <div class="raContentContainer">
                                            <div class="raContent">Conteúdo: <?= $ra['conteudo'];?></div>
                                        </div>
                                        <button type="submit" class="confirmReportIdentification confirmBtn" name="confirmReportIdentification"> Confirmar identificação</button>
                                    </form>
                                <?php
                                        } 
                                    }

                                    if (!$encontrouAnonimo) {
                                    ?>
                                        <div class="anonNotFound"><?= "Nenhum relato anônimo encontrado." ?></div>
                                    <?php
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>

                    <button class="Se-accountDelete confirmBtn" data-type="deleteAccount" onclick="toggleModal(this);" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Excluir conta</button> <!--name="deletar" href="./config.php?deletar=true-->
                </div>

                <div class="Se-notifications Se-subSection">
                    <div class="Se-sectionHeader">
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/notifications_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <h1>Notificações</h1>
                    </div>

                    <form id="notificacaoForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="valorBinario" name="valorBinario" value="0">
                        <input type="hidden" name="updaterId" value='<?= $currentUserData['idUsuario']?>'>

                        <label><input type="checkbox" id="curtidas" value="1" <?php if($currentUserData['idUsuario'] == 1){echo "disabled";}?>> Desativar notificações de curtidas</label><br>
                        <label><input type="checkbox" id="comentarios" value="2" <?php if($currentUserData['idUsuario'] == 1){echo "disabled";}?>> Desativar notificações de comentários</label><br>
                        <label><input type="checkbox" id="seguidores" value="3" <?php if($currentUserData['idUsuario'] == 1){echo "disabled";}?>> Desativar notificações de seguidores</label><br>

                        <button type="submit" value="submit" name="desativarNotificacoesEnvio" <?php if($currentUserData['idUsuario'] == 1){echo "disabled";}?>>Salvar</button>
                    </form>
                </div>

            </section>
        </main>

        <modal class="modalSection close" data-type="addChild">
            <form class="Se-addNewChildModal pageModal" method="post">
                <div class="modalHeader">  
                    <i class="bi bi-arrow-left-circle closeModal"></i>
                    <h1>Adicionar Filho(a)</h1>
                    <input type="hidden" name="parentIdToAddChild" value="<?= $currentUserData['idUsuario'];?>">
                </div>

                <div class="Se-childInputs">
                    <div class="Re-childBoxSex">
                        <p> Sexo: </p>
                        <div class="Re-sexOptions">
                            <input type="radio" name="addChildSex" value="boy" id="Re-childBoySex">
                            <label for="Re-childBoySex"> Masculino </label>
                            <input type="radio" name="addChildSex" value="girl" id="Re-childGirlSex">
                            <label for="Re-childGirlSex"> Feminino </label>
                            <input type="radio" name="addChildSex" value="nullSex" id="Re-childNullSex">
                            <label for="Re-childNullSex"> Não Informar </label>
                        </div>
                    </div>
                    <div class="Se-childInput">
                        <input type="text" id="newChildNameInput" name="addChildName">
                        <label class="Re-fakePlaceholder" for="newChildNameInput">Nome Completo</label>
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                    </div>
                    <div class="Se-childInput">
                        <input type="date" id="newChildDateInput" name="addChildBirthDate">
                        <label class="Re-fakePlaceholder" for="newChildDateInput">Data de Nascimento</label>
                    </div>
                    <div class="Se-childInput">
                        <select id="newChildDisabilityInput" name="addChildDisability">
                            <option value="N/a"> Não informar </option>
                            <optgroup label="Deficiência Físicas">
                                <?php 
                                    $physical_defs = queryMultipleDefData($conn, "categoriaCID LIKE 'G8%' OR categoriaCID LIKE 'R2%'", "categoriaCID ASC"); 
                                    foreach($physical_defs as $pd){
                                ?>
                                    <option value="<?=$pd['categoriaCID']?>"><?= $pd['categoriaCID'] . " - " . $pd['nomeDeficiencia']?></option>
                                <?php
                                    }
                                ?>
                            </optgroup>
                            <optgroup label="Deficiência Neurológicas">
                                <?php 
                                    $neural_des = queryMultipleDefData($conn, "categoriaCID LIKE 'G0%' OR categoriaCID LIKE 'G1%' OR categoriaCID LIKE 'G2%' OR categoriaCID LIKE 'G3%'", "categoriaCID ASC"); 
                                    foreach($neural_des as $nd){
                                ?>
                                    <option value="<?=$nd['categoriaCID']?>"><?= $nd['categoriaCID'] . " - " . $nd['nomeDeficiencia']?></option>
                                <?php
                                    }
                                ?>
                            </optgroup>
                            <optgroup label="Deficiência Visuais">
                                <?php 
                                    $visual_des = queryMultipleDefData($conn, "categoriaCID LIKE 'H5%'", "categoriaCID ASC"); 
                                    foreach($visual_des as $vd){
                                ?>
                                    <option value="<?=$vd['categoriaCID']?>"><?= $vd['categoriaCID'] . " - " . $vd['nomeDeficiencia']?></option>
                                <?php
                                    }
                                ?>
                            </optgroup>
                            <optgroup label="Deficiência Auditivas">
                                <?php 
                                    $aud_des = queryMultipleDefData($conn, "categoriaCID LIKE 'H8%' OR categoriaCID LIKE 'H9%'", "categoriaCID ASC"); 
                                    foreach($aud_des as $ad){
                                ?>
                                    <option value="<?=$ad['categoriaCID']?>"><?= $ad['categoriaCID'] . " - " . $ad['nomeDeficiencia']?></option>
                                <?php
                                    }
                                ?>
                            </optgroup>
                            <optgroup label="Deficiência Intelectuais">
                                <?php 
                                    $int_des = queryMultipleDefData($conn, "categoriaCID LIKE 'F%'", "categoriaCID ASC"); 
                                    foreach($int_des as $id){
                                ?>
                                    <option value="<?=$id['categoriaCID']?>"><?= $id['categoriaCID'] . " - " . $id['nomeDeficiencia']?></option>
                                <?php
                                    }
                                ?>
                            </optgroup>
                        </select>
                        <label for="newChildDisabilityInput">Deficiência</label>
                    </div>
                </div>
                <button class="Se-modalSubmit" type="submit" name="enviarFilho">Confirmar adição</button>
            </form>
        </modal>

        <modal class="modalSection close" data-type="deleteAccount">
            <form class="Se-deleteAccountModal pageModal" method="post">
                <div class="modalHeader">  
                    <i class="bi bi-arrow-left-circle closeModal"></i>
                    <h1>Deletar Conta</h1>
                    <input type="hidden" name="deleteUserId" value="<?= $currentUserData['idUsuario'];?>">
                </div>

                <div class="Se-deleteInputs">
                    <ul><li>Tem certeza que deseja deletar a conta?</li></ul>
                    <div class="Se-deleteInput">
                        <?php $genCode = generateRandomCode(); ?>
                        <input type="text" id="confirmDelete" name="confirmDeleteText" value="<?= $genCode;?>" placeholder=".">
                        <label class="Re-fakePlaceholder" for="confirmDelete">
                            <img src="<?= $relativeAssetsPath; ?>/imagens/icons/conectamaes_icon_black.png"></img>  
                        </label>
                    </div>
                    <div class="Se-deleteInput">
                        <input type="text" id="confirmDeleteInput" name="deleteTextInput">
                        <label class="Re-fakePlaceholder" for="confirmDeleteInput">Reescreva o texto acima para confirmar</label>
                    </div>
                </div>
                <button class="Se-modalSubmit confirmBtn" type="submit" name="deleteAccountSubmit">Confirmar deleção</button>
                <?php
                    if (isset($deleteUser_messages) && !empty($deleteUser_messages)) {
                        foreach ($deleteUser_messages as $d_m) {
                            echo $d_m;
                        }
                    }
                ?>
            </form>
        </modal>

        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            toggleConfigSection();

            const validateInputs = [
                document.getElementById('nomeCompletoUsuario'),
                document.getElementById('biografiaUsuario'),
                document.getElementById('localizacaoUsuario')
            ];

            function setError(inputIndex, message) {
                const inputElement = validateInputs[inputIndex];
                // Agora, pegamos o .errorMessageContainer fora de .Se-userInput
                const errorMessageContainer = inputElement.closest('.Se-userInput').nextElementSibling.querySelector('.errorMessageContent');
                errorMessageContainer.innerHTML = message;
                inputElement.classList.add('error');
            }

            function removeError(inputIndex) {
                const inputElement = validateInputs[inputIndex];
                // Agora, pegamos o .errorMessageContainer fora de .Se-userInput
                const errorMessageContainer = inputElement.closest('.Se-userInput').nextElementSibling.querySelector('.errorMessageContent');
                errorMessageContainer.innerHTML = '';
                inputElement.classList.remove('error');
            }

            // Função que verifica se há erros no formulário
            // Função que verifica se há erros no formulário
            function validateForm() {
                const errorMessages = document.querySelectorAll('.errorMessageContent');
                
                // Se qualquer campo de erro não estiver vazio, o formulário não será enviado
                for (let errorMessage of errorMessages) {
                    if (errorMessage.innerHTML !== '') {
                        return false;  // Impede o envio do formulário
                    }
                }
                return true;  // Permite o envio do formulário se não houver erros
            }

            // Função de validação do nome completo
            function validateFullName() {
                const fullName = validateInputs[0].value;  // Valor do campo 'Nome Completo'
                const maxChar = 100;  // Número máximo de caracteres permitidos

                checkEmptyInput(0);  // Verifica se o campo está vazio
                const nameRegex = /^([a-zA-ZÀ-ÖØ-ÿ'-]+(\s[a-zA-ZÀ-ÖØ-ÿ'-]+)*)$/;  // Expressão regular para nome completo válido

                // Verifica as condições e exibe erros
                if (fullName.length === 0) {
                    setError(0, "O nome completo é <span class='mainError'>obrigatório.</span>");
                } else if (fullName.length > maxChar) {
                    setError(0, "O nome é <span class='mainError'>muito longo.</span>");
                } else if (/\d/.test(fullName)) {
                    setError(0, "O nome não pode possuir <span class='mainError'>números.</span>");
                } else if (!nameRegex.test(fullName)) {
                    setError(0, "O nome pode conter apenas <span class='mainError'>letras, espaços, acentos, hífens, cedilhas e apóstrofos.</span>");
                } else if (!/^([a-zA-ZÀ-ÖØ-ÿ'-]+\s[a-zA-ZÀ-ÖØ-ÿ'-]+.*)$/.test(fullName)) {
                    setError(0, "Insira o seu <span class='mainError'>nome completo.</span>");
                } else {
                    removeError(0);  // Remove o erro se estiver tudo certo
                }
            }

            // Função de validação do CEP
            async function validateLocal() {
                const cep = validateInputs[2].value.trim(); // Remove espaços em branco
                const maxChar = 8;

                checkEmptyInput(2);  // Verifica se o campo do CEP está vazio

                if (cep === "") {
                    setError(2, "O campo CEP é <span class='mainError'>obrigatório.</span>");
                    return;
                }

                if (cep.length !== maxChar) {
                    setError(2, "O CEP deve ter <span class='mainError'>8 dígitos.</span>");
                    return;
                }

                if (!/^\d{8}$/.test(cep)) {
                    setError(2, "Insira um <span class='mainError'>CEP válido.</span>");
                    return;
                }

                try {
                    const data = await fetchCepData(cep);
                    if (data.uf !== "MG") {
                        setError(2, "O CEP não pertence ao estado de <span class='mainError'>Minas Gerais (MG).</span>");
                        return;
                    }

                    // Remove erro caso o CEP seja válido
                    removeError(2);
                } catch (error) {
                    setError(2, error.message);
                }
            }

            // Função de validação da biografia
            function validateBio() {
                const bioInput = validateInputs[1];
                const bioValue = bioInput.value;
                const maxChar = 255;

                checkEmptyInput(1);  // Verifica se o campo de biografia está vazio

                if (bioValue.length === 0) {
                    removeError(1);
                } else if (bioValue.length > maxChar) {
                    setError(1, "A biografia é <span class='mainError'>muito longa.</span>");
                } else {
                    removeError(1);
                }
            }

            // Função para verificar se algum campo está vazio
            function checkEmptyInput(inputIndex) {
                const inputElement = validateInputs[inputIndex];
                if (inputElement.value.trim() === "") {
                    setError(inputIndex, "Este campo é <span class='mainError'>obrigatório.</span>");
                }
            }

            // Impede o envio do formulário se houver erro
            const form = document.querySelector('form');  // Certifique-se de selecionar o formulário corretamente

            form.addEventListener('submit', function(event) {
                // Valida todos os campos antes de permitir o envio
                validateFullName();
                validateBio();
                validateLocal();

                // Se houver algum erro, impede o envio
                if (!validateForm()) {
                    event.preventDefault();  // Impede o envio do formulário
                    alert("Por favor, corrija os erros antes de enviar o formulário.");
                }
            });

            // Adiciona listeners de input para validar enquanto o usuário digita
            validateInputs[0].addEventListener('input', validateFullName);
            validateInputs[1].addEventListener('input', validateBio);
            validateInputs[2].addEventListener('input', validateLocal);

            function toggleChildData(header) {
                const container = header.parentElement;
                container.classList.toggle('expanded');
            }

            function toggleEditChildForm(button) {
                var childData = button.closest('.Se-myChildBtn').querySelector('.childData');
                var editChildForm = button.closest('.Se-myChildBtn').querySelector('.editChildForm');
                childData.classList.toggle('closed');
                editChildForm.classList.toggle('open');
            }

            document.getElementById('confirmDelete').addEventListener('copy', function(e) {
                e.preventDefault();
            });

            document.getElementById("notificacaoForm").addEventListener("change", function() {
                let valor = 0;

                const curtidas = document.getElementById("curtidas");
                const comentarios = document.getElementById("comentarios");
                const seguidores = document.getElementById("seguidores");

                if (curtidas.checked) valor += 1;
                if (comentarios.checked) valor += 2;
                if (seguidores.checked) valor += 4;

                document.getElementById("valorBinario").value =  valor;
            });

            document.getElementById("notificacaoForm").addEventListener("submit", function(event) {
                let valorFinal = 0;

                const curtidas = document.getElementById("curtidas");
                const comentarios = document.getElementById("comentarios");
                const seguidores = document.getElementById("seguidores");

                if (curtidas.checked) valorFinal += 1;
                if (comentarios.checked) valorFinal += 2;
                if (seguidores.checked) valorFinal += 3;
            });
        </script>
    </body>
</html>
