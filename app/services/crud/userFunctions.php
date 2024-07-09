<?php
    include_once(__DIR__ .'/../helpers/upload.php');
    include_once(__DIR__ .'/../helpers/dateChecker.php');
    include_once(__DIR__ .'/../helpers/validateUserInput.php');
    include_once(__DIR__ .'/../helpers/conn.php');
    
    // Função para registrar um novo usuário
        function signUp($conn){
            $err = array();
            $nomeRegistro = validateNome(mysqli_real_escape_string($conn, $_POST['nomeUsuarioRegistro']), $err);
            $emailRegistro = validateEmail($_POST['emailRegistro'], $err);
            $userRegistro = validateUser(mysqli_real_escape_string($conn, $_POST['userRegistro']),$err);
            $senhaRegistro = validateSenha($_POST['senhaRegistro'], $_POST['senhaRegistroConfirma'], $err);
            $dataNascimentoRegistro = validateDate(mysqli_real_escape_string($conn,$_POST['dataNascimentoRegistro']), $err);
            $telefoneRegistro = validateTelefone(mysqli_real_escape_string($conn, $_POST['telefoneRegistro']), $err);
            $biografiaUsuarioRegistro = mysqli_real_escape_string($conn, $_POST['biografiaUsuarioRegistro']);
            $temaRegistro = mysqli_real_escape_string($conn, $_POST['temaRegistro']);
            $localizacaoRegistro = mysqli_real_escape_string($conn, $_POST['localizacaoRegistro']);
            $linkFotoPerfilRegistro = 'default.png'; // Inicialmente default.png
            $isAdminRegistro = false; // Não é possível definir a administração durante o registro
            $queryEmail = "SELECT email FROM Usuario WHERE email = '$emailRegistro' ";
            $searchEmail = mysqli_query($conn, $queryEmail);
            $verifyRowNumEmail = mysqli_num_rows($searchEmail);
                if (!empty($verifyRowNumEmail)) {
                    $err[] = "E-mail já registrado!";
                }
            $queryUser = "SELECT nomeDeUsuario FROM Usuario WHERE nomeDeUsuario = '$userRegistro' ";
            $searchUser = mysqli_query($conn, $queryUser);
            $verifyRowNumUser = mysqli_num_rows($searchUser);
                if (!empty($verifyRowNumUser)) {
                    $err[] = "Nome de usuário já registrado!";
                }
            $queryTel = "SELECT telefone FROM Usuario WHERE telefone = '$telefoneRegistro' ";
            $searchTel = mysqli_query($conn, $queryTel);
            $verifyRowNumTel = mysqli_num_rows($searchTel);
                if (!empty($verifyRowNumTel)) {
                    $err[] = "Telefone já registrado!";
                }

            if (empty($err)) {
                $insertNewUser = "INSERT INTO Usuario (nomeCompleto, email, senha, dataNascimentoUsuario, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin, tema, estado) VALUES ('$nomeRegistro','$emailRegistro','$senhaRegistro','$dataNascimentoRegistro','$telefoneRegistro','$linkFotoPerfilRegistro','$biografiaUsuarioRegistro','$userRegistro','$isAdminRegistro','$temaRegistro','$localizacaoRegistro')";
                $executeSignUp = mysqli_query($conn, $insertNewUser);

                if ($executeSignUp) {
                    $userId = mysqli_insert_id($conn); // Obtém o ID do novo usuário inserido
                    echo "<p>Usuário registrado com sucesso!</p><br>";

                    // Chama a função uploadPFP para fazer o upload da foto de perfil
                    uploadPFP($conn, $userId, $userRegistro);
                } else {
                    echo "<p>Erro ao registrar usuário: " . mysqli_error($conn) . "!<p>";
                }
            } else {
                foreach ($err as $e) {
                    echo "<p>$e</p>";
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
                if(!empty($order)){
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
            $user = !empty($_POST['userEdit']) ? mysqli_real_escape_string($conn, $_POST['userEdit']) : null;
            $telefone = !empty($_POST['telefoneEdit']) ? validateTelefone(mysqli_real_escape_string($conn, $_POST['telefoneEdit']), $err) : null;
            $localizacao = !empty($_POST['localizacaoEdit']) ? mysqli_real_escape_string($conn, $_POST['localizacaoEdit']) : null;
            $biografiaUsuario = !empty($_POST['biografiaUsuarioEdit']) ? mysqli_real_escape_string($conn, $_POST['biografiaUsuarioEdit']) : null;
            $tema = !empty($_POST['temaEdit']) ? mysqli_real_escape_string($conn, $_POST['temaEdit']) : null;
            $linkFotoPerfil = updatePFP($conn, $userId, $user);// Chamando a função updatePFP para lidar com o upload da foto de perfil
            
            if ($telefone) {// Verificação de email duplicado
                $queryTelefone = "SELECT telefone FROM Usuario WHERE telefone = '$telefone' AND idUsuario != '$userId'";
                $searchTelefone = mysqli_query($conn, $queryTelefone);
                $verifytelefoneRowNum = mysqli_num_rows($searchTelefone);
        
                if (!empty($verifytelefoneRowNum)) {
                    $err[] = "Telefone já registrado!";
                }
            }
            if (empty($err)) {
                $fields = [];
                if ($nome) $fields["nomeCompleto"] = $nome;
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
                }else{
                    foreach ($err as $e) {
                        echo "<p>$e</p><br>";
                    }
                }
            }    
    // DELETE ACCOUNT - DELETE
        function deleteAccount($conn, $table, $id){
            if(!empty($id)){         
                $dQuery = "DELETE FROM $table WHERE idUsuario = ". (int) $id;
                $dExec = mysqli_query($conn, $dQuery);

                if($dExec){
                    session_unset();
                    session_destroy();
                }else{
                    echo "Não foi possível deletar a conta!";
                }
            }    
        }
