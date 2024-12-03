 <?php
include_once(__DIR__ . '/../helpers/upload.php');
include_once(__DIR__ . '/../helpers/dateChecker.php');
include_once(__DIR__ . '/../helpers/conn.php');
include_once(__DIR__ . '/../helpers/paths.php');


// Função para registrar um novo usuário
function signUp($conn) {
    $err = array();

    $nomeRegistro = $_POST['nomeUsuarioRegistro'];
    $emailRegistro = $_POST['emailRegistro'];
    $userRegistro = $_POST['userRegistro'];
    $senhaRegistro = md5($_POST['senhaRegistro']);
    $dataNascimentoRegistro = $_POST['dataNascimentoRegistro'];
    $telefoneRegistro = !empty(trim($_POST['telefoneRegistro'])) ? trim($_POST['telefoneRegistro']) : NULL;
    $biografiaUsuarioRegistro = $_POST['biografiaUsuarioRegistro'];
    $temaRegistro = $_POST['temaRegistro']; 
    $localizacaoRegistro = $_POST['localizacaoRegistro'];
    $linkFotoPerfilRegistro = 'default.png';
    $isAdminRegistro = false;

    $queryConfig = "SELECT idConfiguracao FROM Configuracoes WHERE tema = '$temaRegistro' AND desativouNotificacao = 0 LIMIT 1";
    $resultConfig = mysqli_query($conn, $queryConfig);
    $configRow = mysqli_fetch_assoc($resultConfig);
    $idConfiguracao = $configRow['idConfiguracao'];

    // Verificar e-mail, nome de usuário e telefone
    $queryValid = "SELECT email, nomeDeUsuario, telefone FROM Usuario WHERE email = '$emailRegistro' OR nomeDeUsuario = '$userRegistro' OR telefone = '$telefoneRegistro'";
    $resultValid = mysqli_query($conn, $queryValid);

    while ($row = mysqli_fetch_assoc($resultValid)) {
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
        $insertNewUser = "INSERT INTO Usuario (nomeCompleto, email, senha, dataNascimentoUsuario, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin, idConfiguracao, estado) 
                          VALUES ('$nomeRegistro', '$emailRegistro', '$senhaRegistro', '$dataNascimentoRegistro', '$telefoneRegistro', '$linkFotoPerfilRegistro', '$biografiaUsuarioRegistro', '$userRegistro', '$isAdminRegistro', '$idConfiguracao', '$localizacaoRegistro')";
        if (mysqli_query($conn, $insertNewUser)) {
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
function queryUserData($conn, $userId) {
    $query = "
        SELECT 
            u.*,         
            c.tema, c.desativouNotificacao 
        FROM Usuario u
        JOIN Configuracoes c ON u.idConfiguracao = c.idConfiguracao
        WHERE u.idUsuario = $userId";

    $result = mysqli_query($conn, $query);

    if ($result) {
        return mysqli_fetch_assoc($result);
    } 
}

function getUserProfile($conn, $nomeDeUsuario) {
    $nomeDeUsuarioEscaped = mysqli_real_escape_string($conn, $nomeDeUsuario);

    $profileQuery = "SELECT idUsuario, nomeCompleto, telefone, linkFotoPerfil, biografia, nomeDeUsuario, isAdmin 
                        FROM Usuario 
                        WHERE nomeDeUsuario = '$nomeDeUsuarioEscaped'";

    $profileResult = mysqli_query($conn, $profileQuery);
    
    if ($profileResult && mysqli_num_rows($profileResult) > 0) {
        return mysqli_fetch_assoc($profileResult);
    } else {
        return null;
    }
}

function queryMultipleUsersData($conn, $table, $where = 1, $order = "") {
    if (!empty($order)) {
        $order = "ORDER BY $order";
    }

    $gQuery = "SELECT * FROM $table WHERE $where $order";
    $gExec = mysqli_query($conn, $gQuery);
    return mysqli_fetch_all($gExec, MYSQLI_ASSOC);
}

function suggestUsers($conn, $id_usuario) {
    // A consulta que seleciona os usuários que o id_usuario não segue
    $naoSeguidosQuery = "
        SELECT idUsuario, nomeCompleto, nomeDeUsuario, linkFotoPerfil,
               (SELECT COUNT(*) FROM seguirUsuario s 
                WHERE s.idUsuarioSeguidor = $id_usuario 
                AND s.idUsuarioSeguindo = u.idUsuario) AS sugestaoFoiSeguida
        FROM Usuario u
        WHERE u.idUsuario <> $id_usuario 
        AND u.idUsuario <> 1
        AND NOT EXISTS (
            SELECT 1
            FROM seguirUsuario s
            WHERE s.idUsuarioSeguidor = $id_usuario
            AND s.idUsuarioSeguindo = u.idUsuario
        ) 
        ORDER BY RAND() 
        LIMIT 3
    ";

    $naoSeguidosExec = mysqli_query($conn, $naoSeguidosQuery);
    $naoSeguidos = mysqli_fetch_all($naoSeguidosExec, MYSQLI_ASSOC);

    // Se a quantidade de resultados for menor que 3, consulta usuários seguidos
    if (count($naoSeguidos) < 3) {
        $needed = 3 - count($naoSeguidos);

        $seguidosQuery = "
            SELECT idUsuario, nomeCompleto, nomeDeUsuario, linkFotoPerfil,
                   (SELECT COUNT(*) FROM seguirUsuario s 
                    WHERE s.idUsuarioSeguidor = $id_usuario 
                    AND s.idUsuarioSeguindo = u.idUsuario) AS sugestaoFoiSeguida
            FROM Usuario u
            WHERE u.idUsuario <> $id_usuario 
            AND u.idUsuario <> 1
            AND EXISTS (
                SELECT 1
                FROM seguirUsuario s
                WHERE s.idUsuarioSeguidor = $id_usuario
                AND s.idUsuarioSeguindo = u.idUsuario
            ) 
            ORDER BY RAND() 
            LIMIT $needed
        ";

        $seguidosExec = mysqli_query($conn, $seguidosQuery);
        $seguidos = mysqli_fetch_all($seguidosExec, MYSQLI_ASSOC);

        // Combina os resultados
        $resultados = array_merge($naoSeguidos, $seguidos);
    } else {
        // Se já temos 3 ou mais resultados, apenas retorna os não seguidos
        $resultados = $naoSeguidos;
    }

    // Randomiza a ordem dos resultados finais
    shuffle($resultados);
    return $resultados;
}

function getFirstAndLastName($fullName) {
    $partesDoNomeCompleto = explode(" ", $fullName);
    $firstName = $partesDoNomeCompleto[0];
    $lastName = $partesDoNomeCompleto[count($partesDoNomeCompleto) - 1];
    return $firstName . " " . $lastName;
}

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

function getProfileCounts($conn, $profileData) {
    if (isset($profileData)) {
        $followerCount = getFollowerCount($conn, $profileData['idUsuario']);
        $followingCount = getFollowingCount($conn, $profileData['idUsuario']);
        $postsCount = getPostsCount($conn, $profileData['idUsuario']);

        return [
            'followers' => $followerCount,
            'following' => $followingCount,
            'posts' => $postsCount
        ];
    } else {
        return "Erro: Dados do perfil não encontrados.";
    }
}

// EDIT ACCOUNT - UPDATE
function editProfile($conn, $userId) {
    $err = array();
    $nome = !empty($_POST['nomeEdit']) ? mysqli_real_escape_string($conn, $_POST['nomeEdit']) : null;
    $user = !empty($_POST['userEdit']) ? mysqli_real_escape_string($conn, $_POST['userEdit']) : null;
    $localizacao = !empty($_POST['localizacaoEdit']) ? mysqli_real_escape_string($conn, $_POST['localizacaoEdit']) : null;
    $biografiaUsuario = !empty($_POST['biografiaUsuarioEdit']) ? mysqli_real_escape_string($conn, $_POST['biografiaUsuarioEdit']) : null;
    $tema = !empty($_POST['temaEdit']) ? mysqli_real_escape_string($conn, $_POST['temaEdit']) : null;
    $linkFotoPerfil = updatePFP($conn, $userId, $user);

    if (empty($err)) {
        $fields = [];
        if ($nome) $fields[] = "nomeCompleto = '$nome'";
        if ($localizacao) $fields[] = "estado = '$localizacao'";
        if ($biografiaUsuario) $fields[] = "biografia = '$biografiaUsuario'";
        if ($linkFotoPerfil) $fields[] = "linkFotoPerfil = '$linkFotoPerfil'";

        if ($tema) {
            // Obter o valor atual de desativouNotificacao do usuário
            $queryCurrentConfig = "
                SELECT c.desativouNotificacao 
                FROM Usuario u 
                JOIN Configuracoes c ON u.idConfiguracao = c.idConfiguracao 
                WHERE u.idUsuario = $userId";
            $resultNotif = mysqli_query($conn, $queryCurrentConfig);

            if ($currentConfig = mysqli_fetch_assoc($resultNotif)) {
                $currentNotificationSetting = $currentConfig['desativouNotificacao'];

                // Buscar o idConfiguracao correspondente ao tema e desativouNotificacao atual
                $queryConfig = "
                    SELECT idConfiguracao 
                    FROM Configuracoes 
                    WHERE tema = '$tema' AND desativouNotificacao = $currentNotificationSetting";
                $resultConfig = mysqli_query($conn, $queryConfig);

                if ($config = mysqli_fetch_assoc($resultConfig)) {
                    $fields[] = "idConfiguracao = " . $config['idConfiguracao'];
                } else {
                    $err[] = "Configuração correspondente ao tema e notificações não encontrada!";
                }
            } else {
                $err[] = "Configuração atual do usuário não encontrada!";
            }
        }

        if (!empty($fields)) {
            $setFieldsStr = implode(", ", $fields);
            $updateUser = "UPDATE Usuario SET $setFieldsStr WHERE idUsuario = $userId";
            if (!mysqli_query($conn, $updateUser)) {
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
    $messages = array();  // Array para armazenar mensagens de erro e sucesso

    if (isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'])) {
        $currentPassword = htmlspecialchars($_POST['currentPassword']);
        $newPassword = htmlspecialchars($_POST['newPassword']);
        $confirmPassword = htmlspecialchars($_POST['confirmNewPassword']);

        // Busca a senha atual do usuário no banco de dados
        $searchUserPassword = "SELECT senha FROM Usuario WHERE idUsuario = $userId";
        $result = mysqli_query($conn, $searchUserPassword);
        $row = mysqli_fetch_assoc($result);

        if (md5($currentPassword) === $row['senha']) {
            if ($newPassword === $confirmPassword) {
                $updateSenha = "UPDATE Usuario SET senha = '" . md5($newPassword) . "' WHERE idUsuario = $userId";

                if (mysqli_query($conn, $updateSenha)) {
                    $messages[] = "<p class='success-message'>Senha alterada com sucesso!</p>";
                } else {
                    $messages[] = "<p class='error-message'>Erro ao atualizar a senha: " . mysqli_error($conn) . "</p>";
                }
            } else {
                $messages[] = "<p class='error-message'>Senha nova não confirmada corretamente.</p>";
            }
        } else {
            $messages[] = "<p class='error-message'>Senha atual não confere.</p>";
        }
    } else {
        $messages[] = "<p class='error-message'>Por favor, preencha todos os campos corretamente.</p>";
    }

    return $messages;  // Retorna todas as mensagens (erro ou sucesso)
}
    if (isset($_POST['editPasswordSubmit'])) {
        $password_messages = editPassword($conn, $_POST['updaterId']);
    }
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
        $phone_messages = editTelephone($conn, $_POST['updaterId']);
    }

// DELETE ACCOUNT - DELETE
function deleteAccount($conn, $id) {
    $messages = []; 
    if (!empty($id)) {
        $query = "SELECT nomeDeUsuario FROM Usuario WHERE idUsuario = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $nomeUsuario = $row['nomeDeUsuario'];
            if ($nomeUsuario) {
                $validExtensions = ["jpg", "jpeg", "png", "gif", "bmp", "webp"];
                
                foreach ($validExtensions as $ext) {
                    $filePath = __DIR__ . "/../../assets/imagens/fotos/perfil/" . $nomeUsuario . "." . $ext;
                    var_dump($filePath);
                    if (file_exists($filePath)) {
                        if (unlink($filePath)) {
                            break;
                        } else {
                            $messages[] = "Erro ao excluir a foto do usuário ($filePath).";
                            break;
                        }
                    }
                }

                if (!isset($messages[0])) {
                    $messages[] = "Arquivo de foto não encontrado para o usuário.";
                }
            }

            $dQuery = "DELETE FROM Usuario WHERE idUsuario = $id";
            $dResult = mysqli_query($conn, $dQuery);

            if ($dResult) {
                session_unset();
                session_destroy();
                header("Location: ../../public/registrar.php");
                exit();
            } else {
                $messages[] = "Não foi possível deletar a conta!";
            }
        } else {
            $messages[] = "Erro ao consultar o usuário no banco de dados.";
        }
        mysqli_free_result($result);
    }

    return $messages; 
}

function generateRandomCode() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!()';
    $code = '';
    $length = 12;

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $code .= $characters[$randomIndex];
    }

    return $code;
}

    if (isset($_POST['deleteAccountSubmit'])) {
        $userId = $_POST['deleteUserId'];
        if ($_POST['deleteTextInput'] == $_POST['confirmDeleteText']) {
            $deleteUser_messages = deleteAccount($conn, $userId);
        } else {
            $deleteUser_messages[] = "<p>Código de verificação incorreto!</p>";
        }
    }

// Função para seguir um usuário

function followUser($conn, $followerId, $followedId) {
    $checkFollowQuery = "SELECT * FROM seguirUsuario WHERE idUsuarioSeguidor = $followerId AND idUsuarioSeguindo = $followedId";
    $result = mysqli_query($conn, $checkFollowQuery);

    if (mysqli_num_rows($result) === 0) { 
        $insertFollowQuery = "INSERT INTO seguirUsuario (idUsuarioSeguidor, idUsuarioSeguindo) VALUES ($followerId, $followedId)";
        mysqli_query($conn, $insertFollowQuery);
    } else { 
        $deleteFollowQuery = "DELETE FROM seguirUsuario WHERE idUsuarioSeguidor = $followerId AND idUsuarioSeguindo = $followedId";
        mysqli_query($conn, $deleteFollowQuery);
    }
}
    if(isset($currentUserData)){
        if (isset($_POST['followProfile'])) {
            var_dump($_POST);
            followUser($conn, $currentUserData['idUsuario'], $profileUserId);
        }
    }

    if(isset($currentUserData) && $_SERVER['REQUEST_METHOD'] === 'POST'){
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'followSuggestedProfile') === 0) {
                $followedId = $_POST['toFollowId'];
                followUser($conn, $currentUserData['idUsuario'], $followedId);
            }
        }
    }
function isUserFollowingProfile($conn, $currentUserId, $profileUserId) {
    $isFollowingQuery = "SELECT * FROM seguirUsuario WHERE idUsuarioSeguidor = $currentUserId AND idUsuarioSeguindo = $profileUserId";
    $isFollowingResult = mysqli_query($conn, $isFollowingQuery);
    return mysqli_num_rows($isFollowingResult) > 0;
}

//notificações
function getUserNotifications($conn, $userId) {
    $userId = (int)$userId;

    $query = "
        SELECT 
            n.*, 
            u.nomeDeUsuario AS usernameUsuarioGerou, 
            u.linkFotoPerfil AS fotoUsuarioGerou
        FROM 
            Notificacoes n
        LEFT JOIN 
            Usuario u ON n.idUsuarioGerou = u.idUsuario
        WHERE 
            n.idUsuarioRecebeu = $userId
        ORDER BY 
            n.dataNotificacao DESC
    ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $notifications = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Processa informações relacionadas à publicação, se aplicável
                if (strpos($row['tipoNotificacao'], 'Publicacao') !== false) {
                    // Extrai o ID da publicação do link
                    $urlComponents = parse_url($row['linkNotificacao']);
                    $queryParams = [];
                    if (isset($urlComponents['query'])) {
                        parse_str($urlComponents['query'], $queryParams);
                    }

                    $idPublicacao = $queryParams['post'] ?? null;

                    if ($idPublicacao) {
                        // Busca título ou conteúdo da publicação diretamente pelo ID
                        $pubQuery = "
                            SELECT titulo, conteudo 
                            FROM Publicacao 
                            WHERE idPublicacao = $idPublicacao
                        ";
                        $pubResult = mysqli_query($conn, $pubQuery);
                        $publicacao = mysqli_fetch_assoc($pubResult);

                        $row['descricaoPublicacao'] = $publicacao['titulo'] 
                            ? $publicacao['titulo'] 
                            : $publicacao['conteudo'];
                    } else {
                        $row['descricaoPublicacao'] = null;
                    }
                } else {
                    $row['descricaoPublicacao'] = null;
                }

                $notifications[] = $row;
            }
            return $notifications;
        } else {
            return [];
        }
    } else {
        return false;
    }
}
function desativarNotificacoes($conn, $userId) {
    $mensagem = '';
    $valorBinario = isset($_POST['valorBinario']) ? intval($_POST['valorBinario']) : 0;
    $queryConfigAtual = "
        SELECT c.tema, c.desativouNotificacao
        FROM Usuario u
        JOIN Configuracoes c ON u.idConfiguracao = c.idConfiguracao
        WHERE u.idUsuario = $userId";
    $resultConfigAtual = mysqli_query($conn, $queryConfigAtual);

    if ($configAtual = mysqli_fetch_assoc($resultConfigAtual)) {
        $temaAtual = $configAtual['tema'];
        $queryNovaConfig = "
            SELECT idConfiguracao
            FROM Configuracoes
            WHERE tema = '$temaAtual' AND desativouNotificacao = $valorBinario";
        $resultNovaConfig = mysqli_query($conn, $queryNovaConfig);

        if ($novaConfig = mysqli_fetch_assoc($resultNovaConfig)) {
            $novoIdConfiguracao = $novaConfig['idConfiguracao'];
            $sqlUpdate = "UPDATE Usuario SET idConfiguracao = $novoIdConfiguracao WHERE idUsuario = $userId";

            if (mysqli_query($conn, $sqlUpdate)) {
                $mensagem = "As configurações de notificações foram atualizadas com sucesso!";
            } else {
                $mensagem = "Erro ao atualizar configurações de notificações: " . mysqli_error($conn);
            }
        }
    }
    return $mensagem;
}

    if (isset($_POST['desativarNotificacoesEnvio'])) {
        $notif_message = desativarNotificacoes($conn, $_POST['updaterId']);
    }