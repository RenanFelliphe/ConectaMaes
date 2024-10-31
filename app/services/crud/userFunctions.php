<?php
    include_once(__DIR__ .'/../helpers/upload.php');
    include_once(__DIR__ .'/../helpers/dateChecker.php');
    include_once(__DIR__ .'/../helpers/validateUserInput.php');
    include_once(__DIR__ .'/../helpers/conn.php');
    
    // Função para registrar um novo usuário
        function signUp($conn){
            $err = array();
            $nomeRegistro = mysqli_real_escape_string($conn, $_POST['nomeUsuarioRegistro']);
            $emailRegistro = $_POST['emailRegistro'];
            $userRegistro = mysqli_real_escape_string($conn, $_POST['userRegistro']);
            $senhaRegistro = md5($_POST['senhaRegistro']);
            $dataNascimentoRegistro = mysqli_real_escape_string($conn,$_POST['dataNascimentoRegistro']);
            $telefoneRegistro = (isset($_POST['telefoneRegistro']) && !empty(trim($_POST['telefoneRegistro']))) ? trim(mysqli_real_escape_string($conn, $_POST['telefoneRegistro'])) : NULL;
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

            if(!empty($telefoneRegistro)){
                $queryTel = "SELECT telefone FROM Usuario WHERE telefone = $telefoneRegistro ";
                $searchTel = mysqli_query($conn, $queryTel);
                $verifyRowNumTel = mysqli_num_rows($searchTel);
                if (!empty($verifyRowNumTel)) {
                    $err[] = "Telefone já registrado!";
                }
            }

            if (empty($err)) {
                $insertNewUser = "INSERT INTO Usuario (nomeCompleto, email, senha, dataNascimentoUsuario, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin, tema, estado) VALUES ('$nomeRegistro','$emailRegistro','$senhaRegistro','$dataNascimentoRegistro','$telefoneRegistro','$linkFotoPerfilRegistro','$biografiaUsuarioRegistro','$userRegistro','$isAdminRegistro','$temaRegistro','$localizacaoRegistro')";
                $executeSignUp = mysqli_query($conn, $insertNewUser);

                if ($executeSignUp) {
                    $userId = mysqli_insert_id($conn);
                    echo "Usuário registrado com sucesso!<br>";

                    // Chama a função uploadPFP para fazer o upload da foto de perfil
                    uploadPFP($conn, $userId, $userRegistro);
                } else {
                    $mysqli_error = "Erro ao registrar usuário: " . mysqli_error($conn) . "!";
                }
            } else {
                foreach($err as $e){
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
            $telefone = !empty($_POST['telefoneEdit']) ? mysqli_real_escape_string($conn, $_POST['telefoneEdit']) : null;
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
                //salvar error em variaveis pra imprimir no html
                foreach($err as $e){
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

            if($currentPassword == $row['senha']){
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
                echo "<p>Senha alterada com sucesso!</p>";
                if (!$executeUpdate){
                    echo "Erro ao atualizar senha: " . mysqli_error($conn) . "!";
                }
            }else{
                //salvar error em variaveis pra imprimir no html
                foreach($err as $e){
                    echo "<p>$e</p>";
                }
            }
        } 
            
    // EDIT TELEPHONE
        function editTelephone($conn, $userId) {
            $err = array();
            
            if (isset($_POST['editTelephoneNumber']) && !empty($_POST['editTelephoneNumber'])) {
                $newPhoneNumber = htmlspecialchars($_POST['editTelephoneNumber']);
                
                if (preg_match('/^\d{10,15}$/', $newPhoneNumber)) { 
                    $updatePhone = "UPDATE Usuario SET telefone = ? WHERE idUsuario = ?";
                    
                    if ($stmt = $conn->prepare($updatePhone)) {
                        $stmt->bind_param("si", $newPhoneNumber, $userId);
                        
                        if ($stmt->execute()) {
                            echo "<p>Número de telefone atualizado com sucesso!</p>";
                        } else {
                            echo "Erro ao atualizar o número de telefone: " . $stmt->error;
                        }
                        
                        $stmt->close();
                    } else {
                        echo "Erro ao preparar a consulta: " . $conn->error;
                    }
                } else {
                    $err[] = "O número de telefone deve conter entre 10 e 15 dígitos.";
                }
            } else {
                $err[] = "Por favor, insira um número de telefone válido.";
            }
        
            if (!empty($err)) {
                foreach ($err as $e) {
                    echo "<p>$e</p>";
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
    // Função para seguir um usuário
        // Função para seguir ou deixar de seguir um usuário
        function followUser($conn, $followerId, $followedId) {
            // Verifica se o seguidor já está seguindo o usuário
            $checkFollowQuery = "SELECT * FROM seguirUsuario WHERE idUsuarioSeguidor = ? AND idUsuarioSeguindo = ?";
            $stmt = mysqli_prepare($conn, $checkFollowQuery);
            mysqli_stmt_bind_param($stmt, "ii", $followerId, $followedId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        
            if (mysqli_num_rows($result) === 0) { 
                // Se não está seguindo, insere uma nova relação
                $insertFollowQuery = "INSERT INTO seguirUsuario (idUsuarioSeguidor, idUsuarioSeguindo) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $insertFollowQuery);
                mysqli_stmt_bind_param($stmt, "ii", $followerId, $followedId);
                mysqli_stmt_execute($stmt); // Executa a query de seguir
            } else { 
                // Se já está seguindo, remove a relação
                $deleteFollowQuery = "DELETE FROM seguirUsuario WHERE idUsuarioSeguidor = ? AND idUsuarioSeguindo = ?";
                $stmt = mysqli_prepare($conn, $deleteFollowQuery);
                mysqli_stmt_bind_param($stmt, "ii", $followerId, $followedId);
                mysqli_stmt_execute($stmt); // Executa a query de deixar de seguir
            }
        }
        
    // Função para contar o número de seguidores
        function getFollowerCount($conn, $userId) {
            $query = "SELECT COUNT(*) as total FROM seguirUsuario  WHERE idUsuarioSeguindo  = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_assoc($result);
            
            return $data['total'];
        }

    // Função para contar o número de pessoas que o usuário está seguindo
        function getFollowingCount($conn, $userId) {
            $query = "SELECT COUNT(*) as total FROM seguirUsuario  WHERE idUsuarioSeguidor  = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_assoc($result);
            
            return $data['total'];
        }

        function getPostsCount($conn, $userId) {
            $query = "SELECT COUNT(*) as total FROM Publicacao  WHERE idUsuario  = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_assoc($result);
            
            return $data['total'];
        }
