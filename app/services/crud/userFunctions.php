<?php

    $hostname = '162.240.17.101';
    $username = 'projetos_nlessa';
    $password = 'Gc&sgY74PK$}';
    $database = 'projetos_INF2023_G10';

    // Create a database connection
    $conn = mysqli_connect($hostname, $username, $password, $database);

    function setPreferences($conn)
    {
    }

    // CRUD FUNCTIONS - CREATE
    function signUp($conn) {
        if(isset($_POST['registrar']) AND !empty($_POST['emailRegistro']) AND !empty($_POST['senhaRegistro'])){
            $err = array();
    
            $nomeRegistro = mysqli_real_escape_string($conn, $_POST['nomeUsuarioRegistro']);
            $emailRegistro = filter_input(INPUT_POST, "emailRegistro", FILTER_VALIDATE_EMAIL);
            $userRegistro = mysqli_real_escape_string($conn, $_POST['userRegistro']);
            $senhaRegistro = md5($_POST['senhaRegistro']);
            $dataNascimentoRegistro = mysqli_real_escape_string($conn, $_POST['dataNascimentoRegistro']);
            $telefoneRegistro = mysqli_real_escape_string($conn, $_POST['telefoneRegistro']);
            $latitudeRegistro = mysqli_real_escape_string($conn, $_POST['latitudeRegistro']);
            $longitudeRegistro = mysqli_real_escape_string($conn, $_POST['longitudeRegistro']);
            $linkFotoPerfilRegistro = mysqli_real_escape_string($conn, $_POST['linkFotoPerfilRegistro']);
            $biografiaUsuarioRegistro = mysqli_real_escape_string($conn, $_POST['biografiaUsuarioRegistro']);
            $isAdminRegistro = false;
            $temaRegistro = mysqli_real_escape_string($conn, $_POST['temaRegistro']);
                
            if($_POST['senhaRegistro'] != $_POST['senhaRegistroConfirma']){
                $err[] = "Senhas não conferem!";
            }
    
            $queryEmail = "SELECT email FROM Usuario WHERE email = '$emailRegistro' ";
            $searchEmail = mysqli_query($conn, $queryEmail);
            $verifyRowNum = mysqli_num_rows($searchEmail);
    
            if(!empty($verifyRowNum)){
                $err[] = "Email já registrado!";
            }
    
            if(empty($err)){
                $insertNewUser = "INSERT INTO Usuario (nomeUsuario, email, senha, dataNascimento, telefone, linkFotoPerfil, biografiaUsuario, user, isAdmin, tema, latitude, longitude) VALUES ('$nomeRegistro','$emailRegistro','$senhaRegistro','$dataNascimentoRegistro','$telefoneRegistro','$linkFotoPerfilRegistro','$biografiaUsuarioRegistro','$userRegistro','$isAdminRegistro','$temaRegistro','$latitudeRegistro','$longitudeRegistro')";
                $executeSignUp = mysqli_query($conn, $insertNewUser);
    
                if($executeSignUp){
                    echo "Usuário registrado com sucesso!";
                }
                else{
                    echo "Erro ao registrar usuário: " . mysqli_error($conn) . "!";
                }
            }
            else{
                foreach($err as $e){
                    echo "<p>$e</p>";
                }
            }      
        }
    }

        // QUERY FUNCTIONS - READ
        function unitQuery($conn, $table, $id){
            $sUQuery = "SELECT * FROM $table WHERE idUsuario =" . (int) $id;

            $sUExec = mysqli_query($conn, $sUQuery);
            $sUReturn = mysqli_fetch_assoc($sUExec);

            return $sUReturn;
        }
        function generalQuery($conn, $table, $where = 1, $order = ""){
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
        if(isset($_POST['editar'])) {
            $err = array();
    
            $nome = !empty($_POST['nome']) ? mysqli_real_escape_string($conn, $_POST['nome']) : null;
            $email = !empty($_POST['email']) ? filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) : null;
            $user = !empty($_POST['user']) ? mysqli_real_escape_string($conn, $_POST['user']) : null;
            $senha = !empty($_POST['senha']) ? md5($_POST['senha']) : null;
            $dataNascimento = !empty($_POST['dataNascimento']) ? mysqli_real_escape_string($conn, $_POST['dataNascimento']) : null;
            $telefone = !empty($_POST['telefone']) ? mysqli_real_escape_string($conn, $_POST['telefone']) : null;
            $CEP = !empty($_POST['CEP']) ? mysqli_real_escape_string($conn, $_POST['CEP']) : null;
            $linkFotoPerfil = !empty($_POST['linkFotoPerfil']) ? mysqli_real_escape_string($conn, $_POST['linkFotoPerfil']) : null;
            $biografiaUsuario = !empty($_POST['biografiaUsuario']) ? mysqli_real_escape_string($conn, $_POST['biografiaUsuario']) : null;
    
            // Verificação de email duplicado
            if($email) {
                $queryEmail = "SELECT email FROM Usuario WHERE email = '$email' AND idUsuario != '$userId'";
                $searchEmail = mysqli_query($conn, $queryEmail);
                $verifyEmailRowNum = mysqli_num_rows($searchEmail);
    
                if(!empty($verifyEmailRowNum)){
                    $err[] = "Email já registrado!";
                }
            }
    
            // Verificação de username duplicado
            if($user) {
                $queryUser = "SELECT user FROM Usuario WHERE user = '$user' AND idUsuario != '$userId'";
                $searchUser = mysqli_query($conn, $queryUser);
                $verifyUserRowNum = mysqli_num_rows($searchUser);
    
                if(!empty($verifyUserRowNum)){
                    $err[] = "Username já registrado!";
                }
            }
    
            if(empty($err)){
                $fields = [];
                if($nome) $fields["nome"] = $nome;
                if($email) $fields["email"] = $email;
                if($user) $fields["user"] = $user;
                if($senha) $fields["senha"] = $senha;
                if($dataNascimento) $fields["dataNascimento"] = $dataNascimento;
                if($telefone) $fields["telefone"] = $telefone;
                if($CEP) $fields["CEP"] = $CEP;
                if($linkFotoPerfil) $fields["linkFtPerfil"] = $linkFotoPerfil;
                if($biografiaUsuario) $fields["biografiaUsuario"] = $biografiaUsuario;
    
                if(!empty($fields)) {
                    $setFields = [];
                    foreach ($fields as $field => $value) {
                        $setFields[] = "$field = '$value'";
                    }
    
                    $setFieldsStr = implode(", ", $setFields);
                    $updateUser = "UPDATE Usuario SET $setFieldsStr WHERE idUsuario = '$userId'";
                    $executeUpdate = mysqli_query($conn, $updateUser);
    
                    if($executeUpdate){
                        echo "Perfil atualizado com sucesso!";
                    } else {
                        echo "Erro ao atualizar perfil: " . mysqli_error($conn) . "!";
                    }
                } else {
                    echo "Nenhuma alteração foi realizada.";
                }
            } else {
                foreach($err as $e){
                    echo "<p>$e</p>";
                }
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
                session_start();
                session_unset();
                session_destroy();
                
                header("Location: login.php");
            }
            else
            {
                echo "Não foi possível deletar a conta!";
            }
        }    
    }
