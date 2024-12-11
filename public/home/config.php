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
                            <input type="file" id="imagesSelector" name="fotoPerfilEdit" accept="image/*">
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
                        <?php 
                            if(isset($updateProfile_messages) and !empty($updateProfile_messages)){
                                // Exibe as mensagens de resultado (se houver)
                                foreach ($updateProfile_messages as $upm) {
                                    echo "$upm";
                                }
                            }
                        ?>
                        <button class="Se-accountEdit confirmBtn" type="submit" id="editProfile" name="editarPerfil" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Editar conta</button>
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
                                <div class="Se-childInput childNameEditor">
                                    <p> Nome: </p>
                                    <input type="text" class="Re-childName" id="editChildNameInput" name="editChildName" placeholder="Nome Completo" value="<?= $f['nomeFilho'];?>"required>
                                </div>
                                <div class="errorMessageContainer">
                                    <div class="editChildErrorContent"></div>
                                </div>

                                <div class="Se-childInput childSexEditor">
                                    <p> Sexo: </p>
                                    <div class="sexOptions">
                                        <?php
                                            $sexOptions = ['nullSex' => 'Não Informar', 'boy' => 'Masculino', 'girl' => 'Feminino'];

                                            foreach ($sexOptions as $value => $label) {
                                                $checked = ($f['sexo'] === $value) ? 'checked' : '';
                                                echo "<input type='radio' name='editChildSex' value='$value' id='child{$value}Sex' $checked>";
                                                echo "<label for='child{$value}Sex'> $label </label>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="Se-childInput childBirthEditor">
                                    <label for="dataNascFilho">Data de Nascimento</label>
                                    <input type="date" id="editChildDateInput" name="editChildBirthDate" value="<?= date('Y-m-d', strtotime($f['dataNascimentoFilho'])); ?>" required>
                                </div>
                                <div class="errorMessageContainer">
                                    <div class="editChildErrorContent"></div>
                                </div>
                                <div class="Se-childInput childDisabilityEditor">
                                    <label for="deficiencia">Deficiência</label>
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
                                    <button type="submit" id="editChild" name="confirmarEditarFilho" <?= $currentUserData['idUsuario'] == 1 ? 'disabled' : ''; ?>>Salvar alterações</button>
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
                                    <label class="Re-fakePlaceholder" for="editTelephone">Telefone</label>
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
                        <p>Sexo: </p>
                        <div class="Re-sexOptions">
                            <input type="radio" name="addChildSex" value="nullSex" id="Re-childNullSex" checked>
                            <label for="Re-childNullSex">Não Informar</label>
                            <input type="radio" name="addChildSex" value="boy" id="Re-childBoySex">
                            <label for="Re-childBoySex">Masculino</label>
                            <input type="radio" name="addChildSex" value="girl" id="Re-childGirlSex">
                            <label for="Re-childGirlSex">Feminino</label>
                        </div>
                    </div>

                    <div class="Se-childInput">
                        <input type="text" id="newChildNameInput" name="addChildName">
                        <label class="Re-fakePlaceholder" for="newChildNameInput">Nome Completo</label>
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                    </div>
                    <div class="errorMessageContainer">
                        <div class="childErrorMessageContent"></div>
                    </div>

                    <div class="Se-childInput">
                        <input type="date" id="newChildDateInput" name="addChildBirthDate">
                        <label class="Re-fakePlaceholder" for="newChildDateInput">Data de Nascimento</label>
                    </div>
                    <div class="errorMessageContainer">
                        <div class="childErrorMessageContent"></div>
                    </div>

                    <div class="Se-childInput">
                        <select id="newChildDisabilityInput" name="addChildDisability">
                            <option value="N/a">Não informar</option>
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

                <button class="Se-modalSubmit" id="insertChild" type="submit" name="enviarFilho">Confirmar adição</button>
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

            function editUserValidations(){
                const validateUserInputs = [
                    document.getElementById('nomeCompletoUsuario'),
                    document.getElementById('biografiaUsuario'),
                    document.getElementById('localizacaoUsuario')
                ];

                function setUserError(inputIndex, message) {
                    const inputElement = validateUserInputs[inputIndex];
                    const errorMessageContainer = inputElement.closest('.Se-userInput').nextElementSibling.querySelector('.errorMessageContent');
                    errorMessageContainer.innerHTML = message;
                    inputElement.classList.add('error');
                }

                function removeUserError(inputIndex) {
                    const inputElement = validateUserInputs[inputIndex];
                    const errorMessageContainer = inputElement.closest('.Se-userInput').nextElementSibling.querySelector('.errorMessageContent');
                    errorMessageContainer.innerHTML = '';
                    inputElement.classList.remove('error');
                }

                function validateEditProfileForm() {
                    const errorMessages = document.querySelectorAll('.errorMessageContent');
                    
                    for (let errorMessage of errorMessages) {
                        if (errorMessage.innerHTML !== '') {
                            return false;  // Impede o envio do formulário
                        }
                    }
                    return true;  // Permite o envio do formulário se não houver erros
                }

                function validateFullName() {
                    const fullName = validateUserInputs[0].value;  // Valor do campo 'Nome Completo'
                    const maxChar = 100;  // Número máximo de caracteres permitidos

                    checkEmptyInput(0);  // Verifica se o campo está vazio
                    const nameRegex = /^([a-zA-ZÀ-ÖØ-ÿÇç'-]+(\s[a-zA-ZÀ-ÖØ-ÿÇç'-]+)*)$/;  // Expressão regular para nome completo válido

                    // Verifica as condições e exibe erros
                    if (fullName.length === 0) {
                        setUserError(0, "O nome completo é <span class='mainError'>obrigatório.</span>");
                    } else if (fullName.length > maxChar) {
                        setUserError(0, "O nome é <span class='mainError'>muito longo.</span>");
                    } else if (/\d/.test(fullName)) {
                        setUserError(0, "O nome não pode possuir <span class='mainError'>números.</span>");
                    } else if (!nameRegex.test(fullName)) {
                        setUserError(0, "O nome pode conter apenas <span class='mainError'>letras, espaços, acentos, hífens, cedilhas e apóstrofos.</span>");
                    } else if (!/^([a-zA-ZÀ-ÖØ-ÿ'-]+\s[a-zA-ZÀ-ÖØ-ÿ'-]+.*)$/.test(fullName)) {
                        setUserError(0, "Insira o seu <span class='mainError'>nome completo.</span>");
                    } else {
                        removeUserError(0);  // Remove o erro se estiver tudo certo
                    }
                }

                async function fetchCepData(cep) {
                    try {
                        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                        if (!response.ok) {
                            throw new Error("Erro ao consultar o CEP.");
                        }

                        const data = await response.json();
                        if (data.erro) {
                            throw new Error("O CEP informado não foi encontrado.");
                        }
                        return data; // Retorna o objeto com os dados do CEP
                    } catch (error) {
                        console.warn(error.message);
                        throw error; // Lança o erro para ser tratado na função chamadora
                    }
                }

                async function validateLocal() {
                    const cep = validateUserInputs[2].value.trim(); // Remove espaços em branco
                    const cepMustBeLength = 8;

                    checkEmptyInput(2);  // Verifica se o campo do CEP está vazio

                    if (cep === "") {
                        setUserError(2, "O campo CEP é <span class='mainError'>obrigatório.</span>");
                        return;
                    }

                    if (cep.length !== cepMustBeLength) {
                        setUserError(2, "O CEP deve ter <span class='mainError'>8 dígitos.</span>");
                        return;
                    }

                    if (!/^\d{8}$/.test(cep)) {
                        setUserError(2, "Insira um <span class='mainError'>CEP válido.</span>");
                        return;
                    }

                    try {
                        const data = await fetchCepData(cep);
                        if (data.uf !== "MG") {
                            setUserError(2, "O CEP não pertence ao estado de <span class='mainError'>Minas Gerais (MG).</span>");
                            return;
                        }

                        // Remove erro caso o CEP seja válido
                        removeUserError(2);
                    } catch (error) {
                        setUserError(2, error.message);
                    }
                }

                function validateBio() {
                    const bioInput = validateUserInputs[1];
                    const bioValue = bioInput.value;
                    const maxChar = 255;

                    checkEmptyInput(1);  // Verifica se o campo de biografia está vazio

                    if (bioValue.length === 0) {
                        removeUserError(1);
                    } else if (bioValue.length > maxChar) {
                        setUserError(1, "A biografia é <span class='mainError'>muito longa.</span>");
                    } else {
                        removeUserError(1);
                    }
                }

                function checkEmptyInput(inputIndex) {
                    const inputElement = validateUserInputs[inputIndex];
                    if (inputElement.value.trim() === "") {
                        setUserError(inputIndex, "Este campo é <span class='mainError'>obrigatório.</span>");
                    }
                }

                const submitEditUserButton = document.getElementById('editProfile'); 

                submitEditUserButton.addEventListener('click', function(event) {
                    // Valida todos os campos antes de permitir o envio
                    validateFullName();
                    validateBio();
                    validateLocal();

                    // Se houver algum erro, impede o envio
                    if (!validateEditProfileForm()) {
                        event.preventDefault();  // Impede o envio do formulário
                        alert("Por favor, corrija os erros antes de enviar o formulário.");
                    }
                });

                validateUserInputs[0].addEventListener('input', validateFullName);
                validateUserInputs[1].addEventListener('input', validateBio);
                validateUserInputs[2].addEventListener('input', validateLocal);
            }

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

            function addChildValidations(){
                const validateChildInputs = [
                    document.getElementById('newChildNameInput'),
                    document.getElementById('newChildDateInput')
                ];

                function setChildError(inputIndex, message) {
                    const inputElement = validateChildInputs[inputIndex];
                    const errorMessageContainer = inputElement.closest('.Se-childInput').nextElementSibling.querySelector('.childErrorMessageContent');
                    if (errorMessageContainer && errorMessageContainer.classList.contains('childErrorMessageContent')) {
                        errorMessageContainer.innerHTML = message;  // Set the error message
                        inputElement.classList.add('error');        // Add the error class to the input
                    }
                }

                function removeChildError(inputIndex) {
                    const inputElement = validateChildInputs[inputIndex];
                    const errorMessageContainer = inputElement.closest('.Se-childInput').nextElementSibling.querySelector('.childErrorMessageContent');
                    if (errorMessageContainer && errorMessageContainer.classList.contains('childErrorMessageContent')) {                
                        errorMessageContainer.innerHTML = '';
                        inputElement.classList.remove('error');
                    }
                }

                function validateAddChildForm() {
                    const errorMessages = document.querySelectorAll('.childErrorMessageContent');
                    
                    for (let e of errorMessages) {
                        if (e.innerHTML !== '') {
                            return false;  // Impede o envio do formulário
                        }
                    }
                    return true;  // Permite o envio do formulário se não houver erros
                }

                function validateChildName() {
                    const childName = validateChildInputs[0].value;  // Valor do campo 'Nome Completo'
                    const minChar = 3, maxChar = 100;
                    checkEmptyChildInput(0);  // Verifica se o campo está vazio
                    const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿÇç' -]{3,}$/;  
                    const letterCount = (childName.match(/[A-Za-zÀ-ÖØ-öø-ÿÇç]/g) || []).length;
                    
                    if (letterCount < minChar) {  // Verifica se o nome tem pelo menos 3 letras
                        setChildError(0, "O nome do filho deve conter pelo menos <span class='mainError'>3 letras.</span>");
                    } else if (childName.length > maxChar) {
                        setChildError(0, "O nome do filho é <span class='mainError'>muito longo.</span>");
                    } else if (/\d/.test(childName)) {
                        setChildError(0, "O nome do filho não pode possuir <span class='mainError'>números.</span>");
                    } else if (!nameRegex.test(childName)) {
                        setChildError(0, "O nome do filho pode conter apenas <span class='mainError'>letras, espaços, acentos, hífens, cedilhas e apóstrofos.</span>");
                    } else {
                        removeChildError(0);  // Remove o erro se estiver tudo certo
                    }
                }

                function validateChildBirthDate() {
                    const childBirthDate = new Date(validateChildInputs[1].value);  
                    const today = new Date();  
                    const userBirthDate = new Date("<?= $currentUserData['dataNascimentoUsuario'] ?>"); 
                    checkEmptyChildInput(1);  
                    if (validateChildInputs[1].value === "") {
                        setChildError(1, "A data de nascimento é <span class='mainError'>obrigatória.</span>");
                    }
                    else if (childBirthDate > today) {
                        setChildError(1, "A data de nascimento não pode ser uma <span class='mainError'>data futura.</span>");
                    }
                    else if (childBirthDate < userBirthDate) {
                        setChildError(1, "O filho não pode nascer antes do responsável.");
                    } else {
                        removeChildError(1);  
                    }
                }
                
                function checkEmptyChildInput(inputIndex) {
                    const inputElement = validateChildInputs[inputIndex];
                    if (inputElement.value.trim() === "") {
                        setChildError(inputIndex, "Este campo é <span class='mainError'>obrigatório.</span>");
                    }
                }

                const submitAddChildButton = document.getElementById('insertChild');  
                        
                submitAddChildButton.addEventListener('click', function(event) {
                    validateChildName();
                    validateChildBirthDate();
                    
                    if (!validateAddChildForm()) {
                        event.preventDefault(); 
                        alert("Por favor, corrija os erros antes de enviar o formulário.");
                    }
                });

                validateChildInputs[0].addEventListener('input', validateChildName);
                validateChildInputs[1].addEventListener('input', validateChildBirthDate);
            }
            
            function editChildValidations(){
                const validateEditChildInputs = [
                    document.getElementById('editChildNameInput'),
                    document.getElementById('editChildDateInput')
                ];

                function setChildError(inputIndex, message) {
                    const inputElement = validateEditChildInputs[inputIndex];
                    const errorMessageContainer = inputElement.closest('.Se-childInput').nextElementSibling.querySelector('.editChildErrorContent');
                    if (errorMessageContainer && errorMessageContainer.classList.contains('editChildErrorContent')) {
                        errorMessageContainer.innerHTML = message;  // Set the error message
                        inputElement.classList.add('error');        // Add the error class to the input
                    }
                }

                function removeChildError(inputIndex) {
                    const inputElement = validateEditChildInputs[inputIndex];
                    const errorMessageContainer = inputElement.closest('.Se-childInput').nextElementSibling.querySelector('.editChildErrorContent');
                    if (errorMessageContainer && errorMessageContainer.classList.contains('editChildErrorContent')) {                
                        errorMessageContainer.innerHTML = '';
                        inputElement.classList.remove('error');
                    }
                }

                function validateEditChildForm() {
                    const errorMessages = document.querySelectorAll('.editChildErrorContent');
                    
                    for (let e of errorMessages) {
                        if (e.innerHTML !== '') {
                            return false;  // Impede o envio do formulário
                        }
                    }
                    return true;  // Permite o envio do formulário se não houver erros
                }

                function validateChildName() {
                    const childName = validateEditChildInputs[0].value;  // Valor do campo 'Nome Completo'
                    const minChar = 3, maxChar = 100;
                    checkEmptyChildInput(0);  // Verifica se o campo está vazio
                    const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿÇç' -]{3,}$/;  
                    const letterCount = (childName.match(/[A-Za-zÀ-ÖØ-öø-ÿÇç]/g) || []).length;
                    
                    if (letterCount < minChar) {  // Verifica se o nome tem pelo menos 3 letras
                        setChildError(0, "O nome do filho deve conter pelo menos <span class='mainError'>3 letras.</span>");
                    } else if (childName.length > maxChar) {
                        setChildError(0, "O nome do filho é <span class='mainError'>muito longo.</span>");
                    } else if (/\d/.test(childName)) {
                        setChildError(0, "O nome do filho não pode possuir <span class='mainError'>números.</span>");
                    } else if (!nameRegex.test(childName)) {
                        setChildError(0, "O nome do filho pode conter apenas <span class='mainError'>letras, espaços, acentos, hífens, cedilhas e apóstrofos.</span>");
                    } else {
                        removeChildError(0);  // Remove o erro se estiver tudo certo
                    }
                }

                function validateChildBirthDate() {
                    const childBirthDate = new Date(validateEditChildInputs[1].value);  
                    const today = new Date();  
                    const userBirthDate = new Date("<?= $currentUserData['dataNascimentoUsuario'] ?>"); 
                    checkEmptyChildInput(1);  
                    if (validateEditChildInputs[1].value === "") {
                        setChildError(1, "A data de nascimento é <span class='mainError'>obrigatória.</span>");
                    }
                    else if (childBirthDate > today) {
                        setChildError(1, "A data de nascimento não pode ser uma <span class='mainError'>data futura.</span>");
                    }
                    else if (childBirthDate < userBirthDate) {
                        setChildError(1, "O filho não pode nascer antes do responsável.");
                    } else {
                        removeChildError(1);  
                    }
                }
                
                function checkEmptyChildInput(inputIndex) {
                    const inputElement = validateEditChildInputs[inputIndex];
                    if (inputElement.value.trim() === "") {
                        setChildError(inputIndex, "Este campo é <span class='mainError'>obrigatório.</span>");
                    }
                }

                const submitEditChildButton = document.getElementById('editChild');  
                        
                submitEditChildButton.addEventListener('click', function(event) {
                    validateChildName();
                    validateChildBirthDate();
                    
                    if (!validateEditChildForm()) {
                        event.preventDefault(); 
                        alert("Por favor, corrija os erros antes de enviar o formulário.");
                    }
                });
                validateEditChildInputs[0].addEventListener('input', validateChildName);
                validateEditChildInputs[1].addEventListener('input', validateChildBirthDate);
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

            editUserValidations();
            addChildValidations();
            editChildValidations();
        </script>
    </body>
</html>
