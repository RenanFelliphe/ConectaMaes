<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location: ./login.php");
    require_once "../app/services/crud/userFunctions.php"; 
    $currentUserData = unitQuery($conn, "Usuario", $_SESSION['idUsuario']);   
?>
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
    <title>ConectaMães - Home</title>
</head>
<body>
    <?php include_once ("../app/includes/headerHome.php");?>

    <main class="Ho-Main">
        <section class="asideLeft"></section>

        <section class="timeline">
            <form class="Ho-postSomething">
                <div class="Ho-postLeft">
                    <a class="Ho-userProfileImage" href="profile.php">
                        <img src="../app/assets/imagens/fotos/Renan-Moura.png" alt="Foto de Perfil do Usuário">
                    </a>
                    <span class="H-characters"><span class="H-charactersNumber">0</span>/<span class="H-maxCharacters">20</span></span>
                </div>

                <div class="Ho-postCenter">
                    <select name="postStyleSelect" id="postStyle" class="postStyle">
                        <option value="" selected>Padrão</option>
                        <option value="">Relato</option>
                    </select>

                    <input type="text" class="postTextContent" placeholder="Como você está se sentindo? Compartilhe sua experiência!" oninput="postCharLimiter()">
                </div>
                
                <div class="imageInput">
                    <input type="file" id="imageSelector" accept="image/*">
                    <label for="imageSelector">
                        <img src="../app/assets/imagens/icons/icons8-adicionar-imagem-96.png" alt="">
                        <p> Adicionar Imagem </p>
                    </label>
                    <span class="preview"></span>
                </div>

                <button type="submit" value="submit">Postar</button>
            </form>
        </section>
        
        <section class="userArea">
        <?php
                $table = "Usuario";

                if($verify)
                {
                    setPreferences($conn);
            ?>  
                    <h1>Home</h1>
                    <h3><?php echo  "Olá, " . $_SESSION['user'] . "!"; ?></h3><br>
                    
                    <a href="../app/services/helpers/logOut.php">SAIR</a><br><br>
                    <a href="./home.php?editId=<?php echo $_SESSION['idUsuario']?>">EDITAR PERFIL</a>
                    <a href="./home.php?deleteId=<?php echo $_SESSION['idUsuario'];?>&n=<?php echo $_SESSION['user'];?>">EXCLUIR CONTA</a>
                    <br><br>
            <?php
                }
                
                //Abre Formulário de deleção para a conta
                if(isset($_GET['deleteId']))
                {
                    ?>
                        <h2>Tem certeza que deseja deletar sua conta?</h2>
                        <form action="" method="post">
                            <input type="hidden" name = "idDeleter" value = <?php echo $_GET['deleteId']?>>
                            <input type="text" placeholder="<?php echo "delete/".$_GET['deleteId']."/".$_GET['n']?>" name="confirmaTexto"><br><br>
                            
                            <input type="submit" name="deletar" value="Excluir conta">
                        </form>
                    <?php
                }

                //Abre Formulário para edição dos dados do perfil
                if(isset($_GET['editId'])) {
                    ?>
                    <form class="editProfileForm" method="POST" action="">
                        <input type="hidden" name="editId" value="<?php echo $_GET['editId']; ?>" />
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $currentUserData['nome']; ?>" />
                
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $currentUserData['email']; ?>" />
                
                        <label for="user">Username:</label>
                        <input type="text" id="user" name="user" value="<?php echo $currentUserData['user']; ?>" />
                
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="Deixe em branco para manter a mesma senha" />
                
                        <label for="dtNasc">Data de Nascimento:</label>
                        <input type="date" id="dtNasc" name="dtNasc" value="<?php echo $currentUserData['dtNasc']; ?>" />
                
                        <label for="nCelular">Número de Celular:</label>
                        <input type="text" id="nCelular" name="nCelular" value="<?php echo $currentUserData['nCelular']; ?>" />
                
                        <label for="CEP">CEP:</label>
                        <input type="text" id="CEP" name="CEP" value="<?php echo $currentUserData['CEP']; ?>" />
                
                        <label for="linkFtPerfil">Link da Foto de Perfil:</label>
                        <input type="text" id="linkFtPerfil" name="linkFtPerfil" value="<?php echo $currentUserData['linkFtPerfil']; ?>" />
                
                        <label for="biografiaUsuario">Biografia:</label>
                        <textarea id="biografiaUsuario" name="biografiaUsuario"><?php echo $currentUserData['biografiaUsuario']; ?></textarea>
                
                        <button type="submit" name="editar">Atualizar Perfil</button>
                        <button type="submit" name="voltarEditar" id="voltarEditar">VOLTAR</button>
                    </form>
                    <?php
                }

            ?>
            <?php
                if(isset($_POST['editar'])) {   
                    if($_POST['editId'] === $_GET['editId']) {
                        editProfile($conn, $_POST['editId']);
                    } else {
                        echo "Algo deu errado!";
            ?>
                        <a href="./home.php">
                            <button id="cancelarUpdate">CANCELAR</button>
                        </a>
            <?php
                    }
                }
                //Deleta efetivamente a conta 
                if(isset($_POST['deletar']))
                {
                    if($_POST['confirmaTexto'] === ("delete/".$_GET['deleteId']."/".$_GET['n']))
                    {
                        deleteAccount($conn, $table, $_POST['idDeleter']);
                    }
                    else
                    {
                        echo "Insira o texto corretamente!";
                        ?>
                            <a href="./home.php"><button id="cancelarDelete">CANCELAR</button></a>
                        <?php
                    }
                }

            ?>
        </section>

        <section class="asideRight"></section>
    </main>

    <script src="../app/assets/js/home.js"></script>
</html>