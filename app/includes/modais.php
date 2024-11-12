<?php
    include_once __DIR__ . "/../services/helpers/paths.php";
    include_once __DIR__ . "/../services/crud/disabilityFunctions.php";
?>

<modal class="modalSection close" data-type="addChild">
    <form class="Se-addNewChildModal pageModal">
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
                <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
            </div>
            <div class="Se-childInput">
                <input type="date" id="newChildDateInput" name="newChildDate">
                <label class="Re-fakePlaceholder" for="newChildDateInput">Data de Nascimento</label>
            </div>
            <div class="Se-childInput">
                <select id="newChildDisabilityInput" name="newChildDisability">
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
        <button class="Se-modalSubmit" type="submit" name="enviarFilho">Confirmar</button>
    </form>
</modal>

<modal class="modalSection close" data-type="deleAccount">
    <form class="Se-deleteAccountModal pageModal">
        <div class="modalHeader">  
            <i class="bi bi-arrow-left-circle closeModal"></i>
            <h1>Deletar Conta</h1>
        </div>

        <div class="Se-deleteInputs">
            <ul><li>Tem certeza que deseja deletar a conta?</li></ul>
            <div class="Se-deleteInput">
                <input type="text" id="confirmDelete" name="confirmDeleteText" placeholder="AS-x5s}wRRc2;a">
                <label class="Re-fakePlaceholder" for="confirmDelete">
                    <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/conectamaes_icon_black.png"></img>  
                </label>
            </div>
            <div class="Se-deleteInput">
                <input type="text" id="confirmDeleteInput" name="deleteTextInput">
                <label class="Re-fakePlaceholder" for="confirmDeleteInput">Reescreva o texto acima para confirmar</label>
            </div>
        </div>
        <button class="Se-modalSubmit" type="submit" name="deleteAccountSubmit confirmBtn">Confirmar</button>
    </form>
</modal>