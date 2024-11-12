<?php
include_once(__DIR__ . '/../helpers/upload.php');
include_once(__DIR__ . '/../helpers/dateChecker.php');
include_once(__DIR__ . '/../helpers/conn.php');

// Função para registrar um novo usuário
function signUp($conn) {
    $err = array();

    $nomeRegistro = $_POST['nomeUsuarioRegistro'];
    $emailRegistro = $_POST['emailRegistro'];
    $userRegistro = $_POST['userRegistro'];
    $senhaRegistro = password_hash($_POST['senhaRegistro'], PASSWORD_DEFAULT);
    $dataNascimentoRegistro = $_POST['dataNascimentoRegistro'];
    $telefoneRegistro = !empty(trim($_POST['telefoneRegistro'])) ? trim($_POST['telefoneRegistro']) : NULL;
    $biografiaUsuarioRegistro = $_POST['biografiaUsuarioRegistro'];
    $temaRegistro = $_POST['temaRegistro'];
    $localizacaoRegistro = $_POST['localizacaoRegistro'];
    $linkFotoPerfilRegistro = 'default.png';
    $isAdminRegistro = false;

    // Consulta única para verificar e-mail, nome de usuário e telefone
    $query = "SELECT email, nomeDeUsuario, telefone FROM Usuario WHERE email = ? OR nomeDeUsuario = ? OR telefone = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $emailRegistro, $userRegistro, $telefoneRegistro);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] === $emailRegistro) {
            $err[] = "E-mail já registrado!";
        }
        if ($row['nomeDeUsuario'] === $userRegistro) {
            $err[] = "Nome de usuário já registrado!";
        }
        if (!empty($telefoneRegistro) && $row['telefone'] === $telefoneRegistro) {
            $err[] = "Telefone já registrado!";
        }
    }

    if (empty($err)) {
        $insertNewUser = "INSERT INTO Usuario (nomeCompleto, email, senha, dataNascimentoUsuario, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin, tema, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertNewUser);
        mysqli_stmt_bind_param($stmt, 'sssssssssss', $nomeRegistro, $emailRegistro, $senhaRegistro, $dataNascimentoRegistro, $telefoneRegistro, $linkFotoPerfilRegistro, $biografiaUsuarioRegistro, $userRegistro, $isAdminRegistro, $temaRegistro, $localizacaoRegistro);
        
        if (mysqli_stmt_execute($stmt)) {
            $userId = mysqli_insert_id($conn);
            echo "Usuário registrado com sucesso!<br>";
            uploadPFP($conn, $userId, $userRegistro);
        } else {
            echo "Erro ao registrar usuário: " . mysqli_error($conn) . "!";
        }
    } else {
        foreach ($err as $e) {
            echo "<p>$e</p>";
        }
    }
}

// USER QUERY FUNCTIONS - READ
function queryUserData($conn, $table, $id) {
    $sUQuery = "SELECT * FROM $table WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $sUQuery);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $sUExec = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($sUExec);
}

function queryMultipleUsersData($conn, $table, $where = 1, $order = "") {
    if (!empty($order)) {
        $order = "ORDER BY $order";
    }

    $gQuery = "SELECT * FROM $table WHERE $where $order";
    $gExec = mysqli_query($conn, $gQuery);
    return mysqli_fetch_all($gExec, MYSQLI_ASSOC);
}

// EDIT ACCOUNT - UPDATE
function editProfile($conn, $userId) {
    $err = array();
    $nome = !empty($_POST['nomeEdit']) ? $_POST['nomeEdit'] : null;
    $user = !empty($_POST['userEdit']) ? $_POST['userEdit'] : null;
    $telefone = !empty($_POST['telefoneEdit']) ? $_POST['telefoneEdit'] : null;
    $localizacao = !empty($_POST['localizacaoEdit']) ? $_POST['localizacaoEdit'] : null;
    $biografiaUsuario = !empty($_POST['biografiaUsuarioEdit']) ? $_POST['biografiaUsuarioEdit'] : null;
    $tema = !empty($_POST['temaEdit']) ? $_POST['temaEdit'] : null;
    $linkFotoPerfil = updatePFP($conn, $userId, $user);

    if ($telefone) {
        $queryTelefone = "SELECT telefone FROM Usuario WHERE telefone = ? AND idUsuario != ?";
        $stmt = mysqli_prepare($conn, $queryTelefone);
        mysqli_stmt_bind_param($stmt, 'si', $telefone, $userId);
        mysqli_stmt_execute($stmt);
        $searchTelefone = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($searchTelefone)) {
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
                $setFields[] = "$field = ?";
            }
            $setFieldsStr = implode(", ", $setFields);
            $updateUser = "UPDATE Usuario SET $setFieldsStr WHERE idUsuario = ?";
            $stmt = mysqli_prepare($conn, $updateUser);
            $values = array_values($fields);
            $values[] = $userId;
            $types = str_repeat('s', count($values) - 1) . 'i'; // tipos para bind_param
            mysqli_stmt_bind_param($stmt, $types, ...$values);

            if (!mysqli_stmt_execute($stmt)) {
                echo "Erro ao atualizar perfil: " . mysqli_error($conn) . "!";
            }
        }
    } else {
        foreach ($err as $e) {
            echo "<p>$e</p>";
        }
    }
}

if(isset($_POST['editarPerfil'])) {   
    editProfile($conn, $_POST['updaterId']);
}

function editPassword($conn, $userId) {
    $err = array();
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmNewPassword'];

    $searchUserPassword = "SELECT senha FROM Usuario WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $searchUserPassword);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (password_verify($currentPassword, $row['senha'])) {
        if ($newPassword === $confirmPassword) {
            $updateSenha = "UPDATE Usuario SET senha = ? WHERE idUsuario = ?";
            $stmt = mysqli_prepare($conn, $updateSenha);
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, 'si', $hashedPassword, $userId);
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Senha alterada com sucesso!</p>";
            } else {
                echo "Erro ao atualizar senha: " . mysqli_error($conn) . "!";
            }
        } else {
            $err[] = "Senha nova não confirmada corretamente.";
        }
    } else {
        $err[] = "Senha atual não confere.";
    }

    if (!empty($err)) {
        foreach ($err as $e) {
            echo "<p>$e</p>";
        }
    }
}

// EDIT TELEPHONE
function editTelephone($conn, $userId) {
    $messages = array();  // Array para armazenar mensagens de erro e sucesso

    if (isset($_POST['editTelephoneNumber']) && !empty($_POST['editTelephoneNumber'])) {
        $newPhoneNumber = htmlspecialchars($_POST['editTelephoneNumber']);
        
        // Validação do número de telefone
        if (preg_match('/^\d{10,15}$/', $newPhoneNumber)) { 
            $updatePhone = "UPDATE Usuario SET telefone = ? WHERE idUsuario = ?";
            $stmt = mysqli_prepare($conn, $updatePhone);
            mysqli_stmt_bind_param($stmt, "si", $newPhoneNumber, $userId);
            
            if (mysqli_stmt_execute($stmt)) {
                // Se a atualização for bem-sucedida, adiciona a mensagem de sucesso
                $messages[] = "<p class='success-message'>Número de telefone atualizado com sucesso!</p>";
            } else {
                $messages[] = "<p class='error-message'>Erro ao atualizar o número de telefone: " . mysqli_stmt_error($stmt) . "</p>";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            $messages[] = "<p class='error-message'>O número de telefone deve conter entre 10 e 15 dígitos.</p>";
        }
    } else {
        $messages[] = "<p class='error-message'>Por favor, insira um número de telefone válido.</p>";
    }

    return $messages;  // Retorna todas as mensagens (erro ou sucesso)
}

if (isset($_POST['editTelephoneSubmit'])) {   
    $messages = editTelephone($conn, $_POST['updaterId']);
}


// DELETE ACCOUNT - DELETE
function deleteAccount($conn, $table, $id) {
    if (!empty($id)) {         
        $dQuery = "DELETE FROM $table WHERE idUsuario = ?";
        $stmt = mysqli_prepare($conn, $dQuery);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if (mysqli_stmt_execute($stmt)) {
            session_unset();
            session_destroy();
        } else {
            echo "Não foi possível deletar a conta!";
        }
        mysqli_stmt_close($stmt);
    }    
}

// Função para seguir um usuário
function followUser($conn, $followerId, $followedId) {
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
        mysqli_stmt_execute($stmt);
    } else { 
        // Se já está seguindo, remove a relação
        $deleteFollowQuery = "DELETE FROM seguirUsuario WHERE idUsuarioSeguidor = ? AND idUsuarioSeguindo = ?";
        $stmt = mysqli_prepare($conn, $deleteFollowQuery);
        mysqli_stmt_bind_param($stmt, "ii", $followerId, $followedId);
        mysqli_stmt_execute($stmt);
    }
}

// Função para contar o número de seguidores
function getFollowerCount($conn, $userId) {
    $query = "SELECT COUNT(*) as total FROM seguirUsuario WHERE idUsuarioSeguindo = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    
    return $data['total'];
}

// Função para contar o número de pessoas que o usuário está seguindo
function getFollowingCount($conn, $userId) {
    $query = "SELECT COUNT(*) as total FROM seguirUsuario WHERE idUsuarioSeguidor = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    
    return $data['total'];
}

// Função para contar o número de postagens
function getPostsCount($conn, $userId) {
    $query = "SELECT COUNT(*) as total FROM Publicacao WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    
    return $data['total'];
}
