<?php 
    session_start();
    $verify = isset($_SESSION['active']) ? true : header("Location:/ConectaMaesProject/public/login.php");
    require_once "../../app/services/crud/userFunctions.php"; 
    $currentUserData = unitQuery($conn, "Usuario", $_SESSION['idUsuario']);   
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/variable.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/style.css">
    <link rel="stylesheet" href="/ConectaMaesProject/app/assets/styles/include.css">
    <link rel="icon" href="/ConectaMaesProject/app/assets/imagens/logos/final/Conecta_Mães_Logo_Icon.png">
    <title>ConectaMães - Relatos</title>
    </meta>
</head>

<body>
    <?php include_once ("../../app/includes/headerHome.php");?>

    <main class="Ho-Main">
        <section class="asideLeft">
            <img src="/ConectaMaesProject/app/assets/imagens/figuras/CellsFull<?php echo $currentUserData['tema'];?>.png"
                class="cellsHome">
        </section>

        <section class="middle">
            <div class="confCenterTop">
                <button class="voltar"><img src="" alt="Ícone de voltar"></button>
                <h1>Configurações</h1>
            </div>
            <div class="confSectionsContainer">
                    <div class="ConfSection">
                        <img src="" alt="Ícone de Usuário">
                        <h3>Informações da conta</h3>
                        <img src="" alt="Ícone de Seta">
                    </div>
                    <div class="ConfSection">
                        <img src="" alt="Íconde de Carrinho de Bebê">
                        <h3>Informações dos filhos</h3>
                        <img src="" alt="Ícone de Seta">
                    </div>
                    <div class="ConfSection">
                        <img src="" alt="Ícone de Conversa">
                        <h3>Interação com outros usuários</h3>
                        <img src="" alt="Ícone de Seta">
                    </div>
                    <div class="ConfSection">
                        <img src="" alt="Ícone de Sino">
                        <h3>Notificações</h3>
                        <img src="" alt="Ícone de Seta">
                    </div>
                    <div class="ConfSection">
                        <img src="" alt="Ícone do ConectaMães">
                        <h3>Sobre o ConectaMães</h3>
                        <img src="" alt="Ícone de Redirecionamento">
                    </div>
                    <div class="ConfSection">
                        <img src="" alt="Ícone de Suporte">
                        <h3>Suporte</h3>
                        <img src="" alt="Ícone de Redirecionamento">
                    </div>
                </div>
        </section>

        <section class="asideRight infoAccount">
            <div class="asideConfHeader">
                <img src="" alt="Ícone de Usuário">
                <h1>Informações da conta</h1>
            </div>
            <div class="userDataConf">
                <div class="userPhotoConf">
                    <img src="" alt="Foto do Usuário">
                    <button>
                        <img src="" alt="Ícone de Câmera">
                    </button>
                </div>
                <div class="userDataShow">
                    <div class="userDataPiece">
                        <span>Nome:</span><?php echo $currentUserData['nome'];?>
                    </div>
                    <div class="userDataPiece">
                        <span>Usuário:</span><?php echo "@".$currentUserData['user'];?>
                    </div>
                    <div class="userDataPiece">
                        <span>Email:</span><?php echo $currentUserData['email'];?>
                    </div>
                    <div class="userDataPiece">
                        <span>Telefone:</span><?php echo $currentUserData['telefone'];?>
                    </div>
                    <div class="userDataPiece">
                        <span>Data de Nascimento:</span><?php echo $currentUserData['dataNascimento'];?>
                    </div>
                </div>
                <div class="userEditInputs">
                        <form class="editProfileForm" method="POST" action="">
                            <!--input type="hidden" name="editId" value="--><?php //echo $_SESSION['editId']; ?><!--" /-->

                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" value="<?php echo $currentUserData['nome']; ?>" />

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $currentUserData['email']; ?>" />

                            <label for="user">Username:</label>
                            <input type="text" id="user" name="user" value="<?php echo $currentUserData['user']; ?>" />

                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha"
                                placeholder="Deixe em branco para manter a mesma senha" />

                            <label for="dataNascimento">Data de Nascimento:</label>
                            <input type="date" id="dataNascimento" name="dataNascimento"
                                value="<?php echo $currentUserData['dataNascimento']; ?>" />

                            <label for="telefone">Número de Celular:</label>
                            <input type="text" id="telefone" name="telefone" value="<?php echo $currentUserData['telefone']; ?>" />

                            <!--label for="Localização">Localização:</label>
                            <input type="text" id="localização" name="localização" value=""-->

                            <label for="linkFotoPerfil">Link da Foto de Perfil:</label>
                            <input type="text" id="linkFotoPerfil" name="linkFotoPerfil"
                                value="<?php echo $currentUserData['linkFotoPerfil']; ?>" />

                            <label for="biografiaUsuario">Biografia:</label>
                            <textarea id="biografiaUsuario"
                                name="biografiaUsuario"><?php echo $currentUserData['biografiaUsuario']; ?></textarea>

                        </form>        
                </div>
            </div>
            <div class="asideConfFooter">
                <div class="whenCreatedAccount">
                    <h3>Criado em: <span><?php echo $currentUserData['dataCriacaoConta'];?></span></h3>
                </div>
                <div class="deleteAccount">
                    <a href="./config.php?account=true&deleterId=<?php echo $currentUserData['idUsuario'];?>&nomeUsuario=<?php echo $currentUserData['user'];?>"><input type="submit" name="deletarConta" value="Excluir conta"> </a>
                </div>
                <?php
                    //Abre Formulário de deleção para a conta
                    if(isset($_GET['account']))
                    {
                        ?>
                        <div class="">
                            <h2>Tem certeza que deseja deletar sua conta?</h2>
                            <form class="deleteProfileForm"action="" method="post">
                                <input type="hidden" name="deleterId" value=<?php echo $_GET['deleterId']?>>
                                <input type="text" placeholder="<?php echo "delete/".$_GET['deleterId']."/".$_GET['nomeUsuario']?>"
                                    name="confirmaTexto">
                                <button id="cancelCrudForm">CANCELAR</button>

                                
                            </form>
                        </div> 
                        <?php 
                    }
                ?>
            </div>
        </section>
    </main>
    <script src="/ConectaMaesProject/app/assets/js/home.js"></script>
</body>

</html>