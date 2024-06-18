<?php
    include_once(__DIR__ .'/../helpers/upload.php');

    $hostname = '162.240.17.101';
    $username = 'projetos_nlessa';
    $password = 'Gc&sgY74PK$}';
    $database = 'projetos_INF2023_G10';

    $conn = mysqli_connect($hostname, $username, $password, $database);

        // Função para registrar um novo usuário
        function signUp($conn){
            $err = array();

            $nomeRegistro = mysqli_real_escape_string($conn, $_POST['nomeUsuarioRegistro']);
            $emailRegistro = filter_input(INPUT_POST, "emailRegistro", FILTER_VALIDATE_EMAIL);
            $userRegistro = mysqli_real_escape_string($conn, $_POST['userRegistro']);
            $senhaRegistro = md5($_POST['senhaRegistro']);
            $dataNascimentoRegistro = mysqli_real_escape_string($conn, $_POST['dataNascimentoRegistro']);
            $telefoneRegistro = mysqli_real_escape_string($conn, $_POST['telefoneRegistro']);
            $biografiaUsuarioRegistro = mysqli_real_escape_string($conn, $_POST['biografiaUsuarioRegistro']);
            $temaRegistro = mysqli_real_escape_string($conn, $_POST['temaRegistro']);
            $localizacaoRegistro = mysqli_real_escape_string($conn, $_POST['localizacaoRegistro']);
            $linkFotoPerfilRegistro = ''; // Inicialmente vazio
            $isAdminRegistro = false; // Não é possível definir a administração durante o registro

            if ($_POST['senhaRegistro'] != $_POST['senhaRegistroConfirma']) {
                $err[] = "Senhas não conferem!";
            }

            $queryEmail = "SELECT email FROM Usuario WHERE email = '$emailRegistro' ";
            $searchEmail = mysqli_query($conn, $queryEmail);
            $verifyRowNum = mysqli_num_rows($searchEmail);

            if (!empty($verifyRowNum)) {
                $err[] = "Email já registrado!";
            }

            if (empty($err)) {
                $insertNewUser = "INSERT INTO Usuario (nomeCompleto, email, senha, dataNascimentoUsuario, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin, tema, estado) VALUES ('$nomeRegistro','$emailRegistro','$senhaRegistro','$dataNascimentoRegistro','$telefoneRegistro','$linkFotoPerfilRegistro','$biografiaUsuarioRegistro','$userRegistro','$isAdminRegistro','$temaRegistro','$localizacaoRegistro')";
                $executeSignUp = mysqli_query($conn, $insertNewUser);

                if ($executeSignUp) {
                    $userId = mysqli_insert_id($conn); // Obtém o ID do novo usuário inserido
                    echo "Usuário registrado com sucesso!<br>";

                    // Chama a função uploadPFP para fazer o upload da foto de perfil
                    uploadPFP($conn, $userId);
                } else {
                    echo "<p>Erro ao registrar usuário: " . mysqli_error($conn) . "!<p>";
                }
            } else {
                foreach ($err as $e) {
                    echo "<p>$e</p><br>";
                }
            }
            
        }


        // USER QUERY FUNCTIONS - READ
            function queryUserData($conn, $table, $id){
                $sUQuery = "SELECT * FROM $table WHERE idUsuario =" . (int) $id;

                $sUExec = mysqli_query($conn, $sUQuery);
                $sUReturn = mysqli_fetch_assoc($sUExec);

                return $sUReturn;
            }
            function queryMultipleUsersData($conn, $table, $where = 1, $order = ""){
                if(!empty($order))
                {
                    $order = "ORDER BY $order";
                }

                $gQuery = "SELECT * FROM $table WHERE $where $order ";

                $gExec = mysqli_query($conn,$gQuery);
                $gReturn = mysqli_fetch_all($gExec, MYSQLI_ASSOC);

                return $gReturn;
            }

        // EDIT ACCOUNT - UPDATE
        function editProfile($conn, $userId) {
            $err = array();
        
            $nome = !empty($_POST['nomeEdit']) ? mysqli_real_escape_string($conn, $_POST['nomeEdit']) : null;
            $email = !empty($_POST['emailEdit']) ? filter_input(INPUT_POST, "emailEdit", FILTER_VALIDATE_EMAIL) : null;
            $user = !empty($_POST['userEdit']) ? mysqli_real_escape_string($conn, $_POST['userEdit']) : null;
            $dataNascimento = !empty($_POST['dataNascimentoEdit']) ? mysqli_real_escape_string($conn, $_POST['dataNascimentoEdit']) : null;
            $telefone = !empty($_POST['telefoneEdit']) ? mysqli_real_escape_string($conn, $_POST['telefoneEdit']) : null;
            $localizacao = !empty($_POST['localizacaoEdit']) ? mysqli_real_escape_string($conn, $_POST['localizacaoEdit']) : null;
            $biografiaUsuario = !empty($_POST['biografiaUsuarioEdit']) ? mysqli_real_escape_string($conn, $_POST['biografiaUsuarioEdit']) : null;
            $tema = !empty($_POST['temaEdit']) ? mysqli_real_escape_string($conn, $_POST['temaEdit']) : null;
        
            // Chamando a função updatePFP para lidar com o upload da foto de perfil
            $linkFotoPerfil = updatePFP($conn, $userId);
        
            // Verificação de email duplicado
            if ($email) {
                $queryEmail = "SELECT email FROM Usuario WHERE email = '$email' AND idUsuario != '$userId'";
                $searchEmail = mysqli_query($conn, $queryEmail);
                $verifyEmailRowNum = mysqli_num_rows($searchEmail);
        
                if (!empty($verifyEmailRowNum)) {
                    $err[] = "Email já registrado!";
                }
            }
        
            // Verificação de username duplicado
            if ($user) {
                $queryUser = "SELECT nomeDeUsuario FROM Usuario WHERE nomeDeUsuario = '$user' AND idUsuario != '$userId'";
                $searchUser = mysqli_query($conn, $queryUser);
                $verifyUserRowNum = mysqli_num_rows($searchUser);
        
                if (!empty($verifyUserRowNum)) {
                    $err[] = "Usuário já registrado!";
                }
            }
        
            if (empty($err)) {
                $fields = [];
                if ($nome) $fields["nomeCompleto"] = $nome;
                if ($email) $fields["email"] = $email;
                if ($user) $fields["nomeDeUsuario"] = $user;
                if ($dataNascimento) $fields["dataNascimentoUsuario"] = $dataNascimento;
                if ($telefone) $fields["telefone"] = $telefone;
                if ($localizacao) $fields["estado"] = $localizacao;
                if ($biografiaUsuario) $fields["biografia"] = $biografiaUsuario;
                if ($tema) $fields["tema"] = $tema;
                if ($linkFotoPerfil) $fields["linkFotoPerfil"] = $linkFotoPerfil;
        
                if (!empty($fields)) {
                    $setFields = [];
                    foreach ($fields as $field => $value) {
                        $setFields[] = "$field = '$value'";
                    }
        
                    $setFieldsStr = implode(", ", $setFields);
                    $updateUser = "UPDATE Usuario SET $setFieldsStr WHERE idUsuario = '$userId'";
                    $executeUpdate = mysqli_query($conn, $updateUser);
                    if (!$executeUpdate) {
                        echo "Erro ao atualizar perfil: " . mysqli_error($conn) . "!";
                    }
                }
            } else {
                foreach ($err as $e) {
                    echo "<p>$e</p>";
                }
            }
        }
            function editPassword($conn, $userId){
                $err = array();

                $currentPassword = md5($_POST['currentPassword']);
                $newPassword = md5($_POST['newPassword']);
                $confirmPassword = md5($_POST['confirmNewPassword']);
                
                $searchUserPassword = "SELECT senha FROM Usuario WHERE idUsuario = $userId";
                $result = mysqli_query($conn, $searchUserPassword);
                $row = $result->fetch_assoc();

                if($currentPassword == $row){
                    if($newPassword == $confirmPassword){
                        $updateSenha = "UPDATE Usuario SET senha = '$newPassword' WHERE idUsuario = $userId";
                    }else{
                        $err[] = "Senha nova não confirmada corretamente.";
                    }
                }else{
                    $err[] = "Senha atual não confere.";
                }
                    
                if (empty($err)) {
                    $executeUpdate = mysqli_query($conn, $updateSenha);
                    if (!$executeUpdate){
                        echo "Erro ao atualizar senha: " . mysqli_error($conn) . "!";
                    }
                }else {
                    foreach ($err as $e) {
                        echo "<p>$e</p><br>";
                    }
                }
            }

            
        // DELETE ACCOUNT - DELETE
            function deleteAccount($conn, $table, $id)
            {
                if(!empty($id))
                {         
                    $dQuery = "DELETE FROM $table WHERE idUsuario = ". (int) $id;
                    $dExec = mysqli_query($conn, $dQuery);

                    if($dExec)
                    {
                        session_unset();
                        session_destroy();
                    }
                    else
                    {
                        echo "Não foi possível deletar a conta!";
                    }
                }    
            }
