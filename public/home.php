<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../app/services/helpers/paths.php";

    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");

    require_once "../app/services/crud/userFunctions.php"; 
    require_once "../app/services/crud/childFunctions.php";
    require_once "../app/services/crud/postFunctions.php";
    require_once '../app/services/helpers/dateChecker.php';

    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($likedPost = array_keys($_POST, 'like', true)) {
            $postId = str_replace('like_', '', $likedPost[0]);
            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId);
        }
    }

    $publicacoes = queryPostsAndUserData($conn,'');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?= $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?= $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Home</title>
    </head>

    <body class="<?= $currentUserData['tema'];?>">

        <?php include_once ("../app/includes/headerHome.php");?>

        <main class="Ho-Main mainSystem">
            <?php include_once ("../app/includes/asideLeft.php");?>

            <section class="timeline">
                <!-- <section class="Ho-postFilter">
                    <h1 class="Ho-postRecent Ho-mainFilters active" onclick="toggleAuxilioFilter(this);">Recentes</h1>
                    <h1 class="Ho-postMain Ho-mainFilters" onclick="toggleAuxilioFilter(this);">Principais</h1>
                </section> -->

                <?php 
                    $tipoPublicacao = '';
                    include_once ("../app/includes/posts.php");
                ?>
            </section>

            <?php include_once ("../app/includes/asideRight.php");?>

            <!--<div class="modalBack">
                <div class="Re-registerChild" id="addChildModal">
                    <i class="bi bi-x closeChildModal" onclick="registerChildModal()"></i>
                    <p class="Re-addChildBtn toggleAddChildModal"> Adicionar filho +</p>
                    <?php
                        $filhos = queryMultipleChildrenData($conn, $where = "idUsuario = " . $currentUserData['idUsuario'], $order = "nomeFilho");
                        foreach($filhos as $f){
                    ?>
                    <form class="Re-addChildBox close" method="POST">
                        <div class="Re-childBoxHeader">
                            <i class="bi bi-balloon Re-childIcon"></i>
                            <input type="text" class="Re-childName" id="nomeFilho" name="nomeFilho" placeholder="Nome Completo" required>
                            <i class="bi bi-x toggleAddChildModal"></i>
                        </div>

                        <div class="Re-childBoxSex">
                            <p> Sexo: </p>
                            <div class="Re-sexOptions" >
                                <input type="radio" name="sexoFilho" value="boy" id="Re-childBoySex" required>
                                <label for="Re-childBoySex"> Menino </label>
                                <input type="radio" name="sexoFilho" value="girl" id="Re-childGirlSex">
                                <label for="Re-childGirlSex"> Menina </label>
                                <input type="radio" name="sexoFilho" value="nullSex" id="Re-childNullSex">
                                <label for="Re-childNullSex"> Não Informar </label>
                            </div>
                        </div>

                        <div class="Re-childBoxInputs">
                            <div class="Re-input">
                                <input type="date" id="dataNascFilho" name="dataNascimentoFilho" placeholder="dd/mm/yyyy" required>
                                <label for="dataNascFilho">Data de Nascimento</label>
                            </div>
                            <div class="Re-input">
                                <select name="deficienciaFilho" id="deficiencia" >
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
                                <label for="deficiencia">Deficiência</label>
                            </div>
                        </div>

                        <button type="submit" class="Re-confirmAddChild confirmBtn" name="enviarFilho"> Confirmar </button>
                    </form>

                    <form class="Re-myChildBtn" method="POST">
                        <input type="hidden" name="childIdentifier" value="<?= $f['idFilho']; ?>">
                        <img src="<?= $relativeAssetsPath; ?>/imagens/icons/<?= $f['sexo'] === 'boy' ? 'boy_icon' : ($f['sexo'] === 'girl' ? 'girl_icon' : 'pram_icon'); ?>.png" class="pageIcon" alt="Ícone do Filho">
                        <p><?= $f['nomeFilho']; ?></p>
                        <button type="submit" class=" deleteChildButton" name="deletarFilho"><i class="bi bi-x"></i></button>
                        <form class="childData" method="post">
                            <div class="childSpecificData">
                                <span>Sexo: </span> 
                                <p>
                                    <?php 
                                        switch($f['sexo']){
                                            case 'girl': echo  "Menina"; break;
                                            case 'boy': echo "Menino"; break;
                                            case 'nullSex': echo "Não especializado"; break;
                                            default: echo 'N/a';
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="childSpecificData">
                                <span>Data de Nascimento: </span> 
                                <p>
                                    <?php 
                                        $data = new DateTime($f['dataNascimentoFilho']);                                          
                                        $dataFormatadaFilho = $data->format('d/m/Y');
                                        echo $dataFormatadaFilho; 
                                    ?>
                                </p>
                            </div>
                            <div class="childSpecificData">
                                <span>Deficiência: </span> <p><?= $f['deficiencias'] ;?></p>
                            </div>
                            <button type="submit" class="editarFilho" name="editarFilho">Editar</button>
                        </form>
                    </form>
                    <?php 
                        } 
                    ?>

                    

                    <?php 
                        if(isset($_POST['enviarFilho'])){
                            addChild($conn, $currentUserData['idUsuario']);
                        }
                        if(isset($_POST['deletarFilho'])){
                            $childId = $_POST['childIdentifier'];
                            deleteChild($conn, $childId);
                        }
                    ?>
                </div>
            </div>-->

        </main>

        <?php include_once ("../app/includes/modais.php");?>
        
        <script src="<?= $relativeAssetsPath; ?>/js/system.js"></script>
        <script>
            function registerChildModal() {
                const addChildModal = document.querySelector('.modalBack');
                const closeModalBtn = document.querySelector('.closeChildModal');
                const addChildBox = document.querySelector('.Re-addChildBox');
                const toggleAddChildModal = document.querySelectorAll('.toggleAddChildModal');

                closeModalBtn.addEventListener('click', () => {
                    addChildModal.classList.toggle('close');
                });
                
                toggleAddChildModal.forEach(toggleAddChildBtn => {
                    toggleAddChildBtn.addEventListener('click', () => {
                        addChildBox.classList.toggle('close');
                    });
                });
            }
            
            registerChildModal();
        </script>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
    </body>
</html>
