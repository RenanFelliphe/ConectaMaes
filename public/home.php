<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once __DIR__ . "/../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");
    require_once "../app/services/crud/userFunctions.php"; 
    require_once "../app/services/crud/postFunctions.php";
    require_once '../app/services/helpers/dateChecker.php';
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);
    
    // Processar $_POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($likedPost = array_keys($_POST, 'like', true)) {
            $postId = str_replace('like_', '', $likedPost[0]); // Extrai o ID da publicação
            handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId); // Lida com o like
        }

        if (isset($_POST['postPostagem'])) {
            sendPost($conn, "Postagem", $currentUserData['idUsuario']);
        }
    }

    // Obter todas as publicações após o processamento dos likes
    $publicacoes = queryPostsAndUserData($conn,'');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="<?php echo $relativeAssetsPath; ?>/styles/style.css">
        <link rel="icon" href="<?php echo $relativeAssetsPath; ?>/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
        <title>ConectaMães - Home</title>
    </head>

    <body class="<?php echo $currentUserData['tema'];?>">

        <?php include_once ("../app/includes/headerHome.php");?>

        <main class="Ho-Main mainSystem">
            <section class="asideLeft">
                <img src="" class="backCells cellsLeft">
            </section>

            <section class="timeline">
                <form class="Ho-postSomething" method="post" enctype="multipart/form-data">
                    <div class="Ho-postTop">
                        <a class="Ho-userProfileImage" href="<?php echo $relativePublicPath; ?>/home/perfil.php">
                            <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$currentUserData['linkFotoPerfil'];?>">
                        </a>

                        <div class="Ho-postText">
                            <textarea name="conteudoEnvio" id="postText" cols="65" rows="3" class="Ho-postTextContent" placeholder="Como você está se sentindo?" oninput="postCharLimiter()"></textarea>
                            <div class="Ho-characters">
                                <span class="Ho-charactersNumber">0</span>/<span class="Ho-maxCharacters">200</span>
                            </div>
                        </div>
                    </div>

                    <div class="Ho-postBottom">
                        <div class="Ho-extraInputs">
                            <div class="Ho-imageInput">
                                <input type="file" id="Ho-imageSelector" name="linkAnexoEnvio" accept="image/*" onchange="addPost()">
                                <label for="Ho-imageSelector">
                                    <i class="bi bi-images Ho-iconLabel"></i>
                                    <p> Imagem </p>
                                </label>
                            </div>
                        </div>

                        <button type="submit" value="submit" name="postPostagem" class="Ho-submitBtn confirmBtn">Postar</button>
                    </div>

                    <div class="Ho-postAttachments">
                        <span class="Ho-preview"></span>
                    </div>
                </form>

                <?php
                    if (count($publicacoes) > 0) {
                        $count = 0;

                        foreach ($publicacoes as $dadosPublicacao) {
                            // Verificar se o link da foto de perfil está presente
                            $profileImage = !empty($dadosPublicacao['linkFotoPerfil']) ? $dadosPublicacao['linkFotoPerfil'] : 'caminho/padrao/para/imagem.png';
                    
                            // Formatar a data da publicação utilizando a função do arquivo dateChecker.php
                            $mensagemData = postDateMessage($dadosPublicacao["dataCriacaoPublicacao"]);
                            ?>
                            <article class="Ho-post">
                                <div class="postOwnerImage">
                                    <img src="<?php echo $relativeAssetsPath."/imagens/fotos/perfil/".$dadosPublicacao['linkFotoPerfil'];?>">
                                </div>
                    
                                <div class="postContent">
                                    <div class="postTimelineTop">
                                        <div class="postUserNames">
                                            <p class="postOwnerName">
                                                <?php 
                                                    $partesDoNomeCompletoOwner = explode(" ", $dadosPublicacao['nomeCompleto']);
                                                    $firstNameOwner = $partesDoNomeCompletoOwner[0];
                                                    $lastNameOwner = $partesDoNomeCompletoOwner[count($partesDoNomeCompletoOwner) - 1];
                                                    $firstAndLastNameOwner = $firstNameOwner . " " . $lastNameOwner; // Concatena a primeira e a última palavra separadas por um espaço
                                                    echo htmlspecialchars($firstAndLastNameOwner); 
                                                ?>
                                            </p>
                                            <p class="postOwnerUser">
                                                <?php echo '@' . htmlspecialchars($dadosPublicacao['nomeDeUsuario']); ?>
                                            </p>
                                        </div>
                    
                                        <div class="postInfo">
                                            <ul class="postDate"><li><?php echo htmlspecialchars($mensagemData); ?></li></ul>
                                            <div class="bi bi-three-dots postMoreButton"></div>
                                        </div>
                                    </div>
                    
                                    <div class="postTitles">  
                                        <p class="postTitle"><?php echo htmlspecialchars($dadosPublicacao['titulo']); ?></p>
                                        <p class="textPost"><?php echo htmlspecialchars($dadosPublicacao['conteudo']); ?></p>
                                    </div>
                    
                                    <form class="postTimelineBottom" method='post'>
                                        <button class="postLikes" type="submit" name="like_<?= $dadosPublicacao['idPublicacao']; ?>" value="like">
                                            <i class="bi bi-heart-fill <?= queryUserLike($conn,$currentUserData['idUsuario'],$dadosPublicacao['idPublicacao']) ? 'postLiked' : 'postNotLiked'; ?>"></i>
                                            <p><?php echo htmlspecialchars($dadosPublicacao['totalLikes']); ?></p>
                                        </button>
                                        <button class="postComments" type="submit" name="comment">
                                            <i class="bi bi-chat-fill"></i>
                                            <p>0</p>
                                        </button>
                                    </form>
                                </div>
                            </article>
                            <?php
                            $count++;
                            // A cada 50 publicações, mostrar "sugestões"
                            /* if ($count % 50 == 0) {
                                echo "Sugestões<br><br>";
                            } */
                        }
                        ?><p class="endTimeline">Seu feed acabou!</p>
                        <?php
                    } else {
                        ?>
                            <p class="noPublicationsOnHome">Nenhuma publicação encontrada!</p>
                        <?php
                    }      
                    ?>
            </section>

            <section class="asideRight">
                <div class="searchBar">
                    <i class="bi bi-search"></i>
                    <input type="search" class="searchBarInput" placeholder="Pesquisar">
                </div>

                <div class="asideRightFooter">
                    <a href="<?php echo $relativeRootPath."/index.php"?>">Sobre o ConectaMães</a>
                    <a href="<?php echo $relativePublicPath."/suporte.php"?>">Suporte</a>
                    <a href="">Termos de Privacidade</a>
                    <a href="">CEFET-MG</a>
                    <h4>ConectaMães do CEFET-MG | 2024</h4>
                </div>
            </section>

            <div class="modalBack">
                <div class="Re-registerChild">
                    <i class="bi bi-x closeChildModal" onclick="registerChildModal()"></i>
                    <div class="Re-addChildBtn toggleAddChildModal"> Adicionar filho +</div>
                    <div class="Re-myChildBtn">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/boy_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p>Nome da Criança</p>
                        <i class="bi bi-x deleteChild"></i>
                    </div>
                    <div class="Re-myChildBtn">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/girl_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>
                        <i class="bi bi-x deleteChild"></i>
                    </div>

                    <div class="Re-myChildBtn">
                        <img src="<?php echo $relativeAssetsPath; ?>/imagens/icons/pram_icon.png" class="pageIcon" alt="Ícone de usuário">
                        <p>AAAAA</p>
                        <i class="bi bi-x deleteChild"></i>
                    </div>

                    <form class="Re-addChildBox close">
                        <div class="Re-childBoxHeader">
                            <i class="bi bi-balloon Re-childIcon"></i>
                            <input type="text" class="Re-childName" id="nomeFilho" name="nomeFilho" placeholder="Nome Completo" required>
                            <i class="bi bi-x toggleAddChildModal"></i>
                        </div>

                        <div class="Re-childBoxSex">
                            <p> Sexo: </p>
                            <div class="Re-sexOptions" >
                                <input type="radio" name="childSex" value="boy" id="Re-childBoySex" required>
                                <label for="Re-childBoySex"> Menino </label>
                                <input type="radio" name="childSex" value="girl" id="Re-childGirlSex">
                                <label for="Re-childGirlSex"> Menina </label>
                                <input type="radio" name="childSex" value="nullSex" id="Re-childNullSex">
                                <label for="Re-childNullSex"> Não Informar </label>
                            </div>
                        </div>

                        <div class="Re-childBoxInputs">
                            <div class="Re-input">
                                <input type="date" id="dataNascFilho" name="dataNascimentoFilho" placeholder="dd/mm/yyyy" required>
                                <label for="dataNascFilho">Data de Nascimento</label>
                            </div>
                            <div class="Re-input">
                                <select name="deficienciaSelect" id="deficiencia" >
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

                        <button type="submit" class="Re-confirmAddChild confirmBtn"> Confirmar </button>
                    </form>
                </div>
            </div>
               
        </main>

        <?php include_once ("../app/includes/modais.php");?>
        
        <script src="<?php echo $relativeAssetsPath; ?>/js/system.js"></script>
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
    </body>
</html>
