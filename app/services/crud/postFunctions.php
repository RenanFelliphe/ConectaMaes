<?php
include_once(__DIR__ . '/../helpers/conn.php');
include_once(__DIR__ . '/../helpers/upload.php');

// SEND POSTS - CREATE
function sendPost($conn, $postType, $currentUserId) {
    $messages = array();  // Array para armazenar as mensagens

    if (!empty($_POST['conteudoEnvio'])) {
        $tipoPublicacaoEnvio = mysqli_real_escape_string($conn, $postType);
        $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
        $linkAnexoEnvio = ''; 
        $tituloEnvio = isset($_POST['tituloEnvio']) ? mysqli_real_escape_string($conn, $_POST['tituloEnvio']) : null;
        $isConcluido = 0; 
        $isAnonima = isset($_POST['meIdentificar']) && $_POST['meIdentificar'] == 'on' ? 0 : 1; 
        $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);

        if (isset($_POST['showPixKey']) && $_POST['showPixKey'] == 'on') {
            $sqlChavePix = "SELECT chavePix FROM Usuario WHERE idUsuario = '$idUsuarioQuePostou'";
            $resultChavePix = mysqli_query($conn, $sqlChavePix);

            if ($resultChavePix && mysqli_num_rows($resultChavePix) > 0) {
                $user = mysqli_fetch_assoc($resultChavePix);
                $chavePix = $user['chavePix'];
            } else {
                $chavePix = 'N/a';
            }
        } else {
            $chavePix = 'N/a';
        }

        // Inserir o post na tabela 'Publicacao'
        $insertNewPost = "INSERT INTO Publicacao (tipoPublicacao, conteudo, linkAnexo, titulo, isConcluido, isAnonima, idUsuario, chavePix) 
                          VALUES ('$tipoPublicacaoEnvio', '$conteudoEnvio', '$linkAnexoEnvio', '$tituloEnvio', '$isConcluido', '$isAnonima', '$idUsuarioQuePostou', '$chavePix')";
        $executeSendPost = mysqli_query($conn, $insertNewPost);

        if (!$executeSendPost) {
            $messages[] = "Erro ao enviar publicação: " . mysqli_error($conn);
        } else {
            $idPost = mysqli_insert_id($conn);
            uploadAnexo($conn, $idPost);
        }
    }

    return $messages; // Retorna as mensagens
}

// SEND COMMENT - CREATE
function sendComment($conn, $idPublicacao, $currentUserId) {
    $messages = array();  // Array para armazenar as mensagens

    if (!empty($_POST['conteudoEnvio'])) {
        $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
        $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);

        $insertNewComment = "INSERT INTO Comentario (conteudo, idUsuario, idPublicacao) VALUES ('$conteudoEnvio', '$idUsuarioQuePostou', '$idPublicacao')";
        $executeSendComment = mysqli_query($conn, $insertNewComment);

        if (!$executeSendComment) {
            $messages[] = "Erro ao enviar comentário: " . mysqli_error($conn);
        }
    }

    return $messages;
}
function sendNestedComment($conn, $idComentarioAcima, $currentUserId) {
    $messages = array(); // Array para armazenar as mensagens

    if (!empty($_POST['conteudoEnvio'])) {
        $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
        $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);
        $insertNewComment = "INSERT INTO Comentario (conteudo, idUsuario, idPublicacao) VALUES ('$conteudoEnvio', '$idUsuarioQuePostou', NULL)";
        $executeSendComment = mysqli_query($conn, $insertNewComment);
        if ($executeSendComment) {
            $idComentarioAbaixo = mysqli_insert_id($conn);
            $insertRelation = "INSERT INTO comentarioComentario (idComentarioAcima, idComentarioAbaixo) VALUES ('$idComentarioAcima', '$idComentarioAbaixo')";
            $executeRelation = mysqli_query($conn, $insertRelation);
            if (!$executeRelation) {
                $messages[] = "Erro ao relacionar comentários: " . mysqli_error($conn);
            }
        } else {
            $messages[] = "Erro ao enviar comentário: " . mysqli_error($conn);
        }
    }

    return $messages;
}

if (isset($_POST['postAuxilioModal'])) {
    $messages = sendPost($conn, 'Auxilio', $currentUserData['idUsuario']);
} else if (isset($_POST['postRelatoModal'])) {
    $messages = sendPost($conn, 'Relato', $currentUserData['idUsuario']);
} else if (isset($_POST['postComentarioModal'])) {
    $postId = intval($_POST['idPublicacao']) ?? null;

    if (!empty($postId)) {
        $messages = sendComment($conn, $postId, $currentUserData['idUsuario']);
    } else {
        $messages[] = "<p class='error'>Erro: Não foi possível comentar nesta publicação.</p>";
    }
} else if(isset($_POST['postNestedComentarioModal'])){
    $commentId = intval($_POST['idComentario']) ?? null;
    if (!empty($commentId)) {
        $messages = sendNestedComment($conn, $commentId, $currentUserData['idUsuario']);
    } else {
        $messages[] = "<p class='error'>Erro: Não foi possível comentar este comentário.</p>";
    }
} else if(isset($_POST['postComentarioModalAuxilio'])){
    $postId = intval($_POST['idPublicacao']);
    if (!empty($postId)) {
        $messages = sendComment($conn, $postId, $currentUserData['idUsuario']);
    }
}else{
    $messages = sendPost($conn, '', $currentUserData['idUsuario']);
}

// SEARCH POSTS - READ
function specificPostQuery($conn, $data, $where, $order) {
    $sUQuery = "SELECT $data FROM Publicacao WHERE $where $order";
    $sUExec = mysqli_query($conn, $sUQuery);
    
    return $sUExec;
}

function queryPostsAndUserData($conn, $postType = '', $postId = null, $userId = null, $limit = 10, $offset = 0, $showAnon = true) {
    $baseQuery = "
        SELECT 
            p.idPublicacao, 
            p.tipoPublicacao, 
            p.conteudo,
            p.linkAnexo, 
            p.titulo, 
            p.isAnonima,
            p.isConcluido,
            p.dataCriacaoPublicacao,
            u.idUsuario, 
            u.nomeCompleto, 
            u.nomeDeUsuario, 
            u.linkFotoPerfil,
            u.estado,
            IF(p.chavePix = 'N/a', 'N/a', u.chavePix) AS chavePix,
            (SELECT COUNT(*) FROM curtirPublicacao c WHERE c.idPublicacao = p.idPublicacao) AS totalLikes,
            (SELECT COUNT(*) FROM Comentario cm WHERE cm.idPublicacao = p.idPublicacao) AS totalComments
        FROM 
            Publicacao p
        JOIN 
            Usuario u ON p.idUsuario = u.idUsuario
    ";

    if ($postId !== null) {
        $whereClause = "p.idPublicacao = " . intval($postId);
    } elseif ($userId !== null) {
        if ($postType === '') {
            $whereClause = "u.idUsuario = " . intval($userId) . " AND p.tipoPublicacao <> 'Auxilio'";
        } else {
            $whereClause = "u.idUsuario = " . intval($userId) . " AND p.tipoPublicacao = '$postType'";
        }

        // Adicionar lógica para exibir ou não publicações anônimas conforme $showAnon
        if (!$showAnon) {
            $whereClause .= " AND p.isAnonima <> 1";
        }
    } else {
        $whereClause = ($postType === '') ? "p.tipoPublicacao <> 'Auxilio'" : "p.tipoPublicacao = '$postType'";
    }

    // Para casos em que $userId seja null, adicionar $showAnon logicamente
    if ($userId === null && !$showAnon) {
        $whereClause .= " AND p.isAnonima <> 1";
    }

    $finalQuery = $baseQuery . " WHERE " . $whereClause . " ORDER BY p.dataCriacaoPublicacao DESC LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $finalQuery);

    if (!$result) {
        echo "<p class='error'>Erro na consulta: " . mysqli_error($conn) . "</p>";
        return false;
    }
    //echo $finalQuery; //pra debugar
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function renderProfileLink($relativePublicPath, $profileImage, $nomeDeUsuario, $isRelatoAnonimo = false) {
    if ($isRelatoAnonimo) {
        return '<a class="postOwnerImage" href="#" onclick="return false;">
                    <img src="' . htmlspecialchars($profileImage) . '">
                </a>';
    } else {
        return '<a class="postOwnerImage" href="' . htmlspecialchars($relativePublicPath . "/home/perfil.php?user=" . urlencode($nomeDeUsuario)) . '">
                    <img src="' . htmlspecialchars($profileImage) . '">
                </a>';
    }
}

function queryUserLike($conn, $idUser, $idPost) {
    $queryLike = "SELECT * FROM curtirPublicacao WHERE idPublicacao = $idPost AND idUsuario = $idUser";
    $execQuery = mysqli_query($conn, $queryLike);
    $returnExec = mysqli_fetch_assoc($execQuery);

    return $returnExec;
}

function queryUserCommentLike($conn, $idUser, $idComment) {
    $queryLike = "SELECT * FROM curtirComentario WHERE idComentario = $idComment AND idUsuario = $idUser";
    $execQuery = mysqli_query($conn, $queryLike);

    if (!$execQuery) {
        echo "<p class='error'>Erro na consulta: " . mysqli_error($conn) . "</p>";
        return false;
    }

    $returnExec = mysqli_fetch_assoc($execQuery);

    return $returnExec ? true : false;
}

// DELETE POST - DELETE
function deletePost($conn, $id) {
    if (!empty($id)) {
        $query = "SELECT linkAnexo FROM Publicacao WHERE idPublicacao = " . (int)$id;
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $linkAnexo = $row['linkAnexo'];

            if (!empty($linkAnexo)) {
                $filePath = __DIR__ . "/../../assets/imagens/fotos/anexos/" . $linkAnexo;

                if (file_exists($filePath)) {
                    if (!unlink($filePath)) {
                        echo "Erro ao excluir o arquivo de imagem associado à publicação ($filePath).";
                    }
                }
            }
        }

        $dQuery = "DELETE FROM Publicacao WHERE idPublicacao = " . (int)$id;
        $dExec = mysqli_query($conn, $dQuery);

        if (!$dExec) {
            echo "Algo deu errado, tente novamente mais tarde!";
        } else {
            echo "<script>window.location.href = window.location.href;</script>";
        }

        exit; 
    }
}

if (isset($_POST['deletarPost'])) {
    deletePost($conn, $_POST['deleterId']);
}

// LIKES
function handlePostLike($conn, $idUser, $idPost) {
    $userLike = queryUserLike($conn, $idUser, $idPost);
    if (!$userLike) {
        $insertLike = "INSERT INTO curtirPublicacao (idPublicacao, idUsuario) VALUES ($idPost, $idUser)";
        $execQuery = mysqli_query($conn, $insertLike);
        
        if (!$execQuery) {
            die("Erro ao curtir: " . mysqli_error($conn));
        }
    } else {
        $deleteLike = "DELETE FROM curtirPublicacao WHERE idPublicacao = $idPost AND idUsuario = $idUser";
        $execQuery = mysqli_query($conn, $deleteLike);
        
        if (!$execQuery) {
            die("Erro ao remover curtida: " . mysqli_error($conn));
        }
    }
}

// COMMENTS
function queryCommentsData($conn, $postId = null, $commentId = null, $limit = 10, $offset = 0) {
    $baseQuery = "
        SELECT 
            c.idComentario,
            c.conteudo AS comentarioConteudo,
            c.dataCriacaoComentario,
            c.idPublicacao,
            u.idUsuario,
            u.nomeCompleto,
            u.nomeDeUsuario,
            u.linkFotoPerfil,
            COUNT(lp.idComentario) AS totalCommentLikes
        FROM 
            Comentario c
        JOIN 
            Usuario u ON c.idUsuario = u.idUsuario
        LEFT JOIN 
            curtirComentario lp ON lp.idComentario = c.idComentario
    ";

    $whereClause = '';
    if ($commentId !== null) {
        $commentId = intval($commentId); 
        $whereClause = "WHERE c.idComentario = $commentId";
    } else if ($postId !== null) {
        $postId = intval($postId); 
        $whereClause = "WHERE c.idPublicacao = $postId";
    }

    $finalQuery = $baseQuery . " " . $whereClause . " 
        GROUP BY c.idComentario
        ORDER BY c.dataCriacaoComentario ASC
        LIMIT $limit OFFSET $offset";
    $result = mysqli_query($conn, $finalQuery);

    if (!$result) {
        echo "<p class='error'>Erro na consulta: " . mysqli_error($conn) . "</p>";
        return false;
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function handleCommentLike($conn, $idUser, $idComment) {
    $userLike = queryUserCommentLike($conn, $idUser, $idComment);
    if (!$userLike) {
        $insertLike = "INSERT INTO curtirComentario (idComentario, idUsuario) VALUES ($idComment, $idUser)";
        $execQuery = mysqli_query($conn, $insertLike);
        
        if (!$execQuery) {
            die("Erro ao curtir: " . mysqli_error($conn));
        }
    } else {
        $deleteLike = "DELETE FROM curtirComentario WHERE idComentario = $idComment AND idUsuario = $idUser";
        $execQuery = mysqli_query($conn, $deleteLike);
        
        if (!$execQuery) {
            die("Erro ao remover curtida: " . mysqli_error($conn));
        }
    }
}

function deleteComment($conn, $id) {
    if (!empty($id)) {
        $dQuery = "DELETE FROM Comentario WHERE idComentario = " . (int)$id;
        $dExec = mysqli_query($conn, $dQuery);
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
        if (!$dExec) {
            echo "Algo deu errado, tente novamente mais tarde!";
        }
    }
}

function queryCommentReplies($conn, $idComentarioAcima, $limit = 10, $offset = 0) {
    $query = "
        SELECT 
            c.idComentario, 
            c.conteudo AS comentarioConteudo, 
            c.dataCriacaoComentario, 
            c.idUsuario, 
            c.idPublicacao, 
            u.nomeCompleto, 
            u.nomeDeUsuario, 
            u.linkFotoPerfil, 
            (SELECT COUNT(*) FROM curtirComentario lp WHERE lp.idComentario = c.idComentario) AS totalCommentLikes
        FROM 
            comentarioComentario cc
        JOIN 
            Comentario c ON cc.idComentarioAbaixo = c.idComentario
        JOIN 
            Usuario u ON c.idUsuario = u.idUsuario
        WHERE 
            cc.idComentarioAcima = " . intval($idComentarioAcima) . "
        ORDER BY 
            c.dataCriacaoComentario ASC
        LIMIT $limit OFFSET $offset
    ";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<p class='error'>Erro na consulta: " . mysqli_error($conn) . "</p>";
        return false;
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($likedPost = array_keys($_POST, 'like', true)) {
        $postId = filter_var(mysqli_escape_string($conn, str_replace('like_', '', $likedPost[0])), FILTER_SANITIZE_NUMBER_INT);
        handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId);
    }

    if ($likedComment = array_keys($_POST, 'likeComment', true)) {
        $commentId = filter_var(mysqli_escape_string($conn, str_replace('commentLike_', '', $likedComment[0])), FILTER_SANITIZE_NUMBER_INT);
        handleCommentLike($conn, $currentUserData['idUsuario'], (int)$commentId); 
    } 

    if (isset($_POST['deletarComentario'])) {
        deleteComment($conn, filter_var(mysqli_escape_string($conn,$_POST['deleterCommentId']), FILTER_SANITIZE_NUMBER_INT));
    }

    if (isset($_POST['deletarResposta'])) {
        deleteComment($conn, filter_var(mysqli_escape_string($conn,$_POST['deleterCommentId']), FILTER_SANITIZE_NUMBER_INT));
    }
}

//RELATO ANÔNIMO
function anonUsername($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);

    $query = "SELECT idUsuario FROM Usuario WHERE nomeDeUsuario = '$username' LIMIT 1";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['idUsuario'];
        $n = 5 * $id + 4;

        return sprintf("%07X", $n);
    } else {
        return null;
    }
}
function getAnonUserId($n){
    $id = (hexdec($n) - 4) / 5;
    return $id;
}
function editAnonIdentification($conn, $id) {
    
    $meIdentificarEdit = $_POST['meIdentificarEdit'];

    $queryTitulo = "SELECT titulo FROM Publicacao WHERE idPublicacao = " . (int)$id;
    $resultadoTitulo = mysqli_query($conn, $queryTitulo);

    if ($resultadoTitulo && mysqli_num_rows($resultadoTitulo) > 0) {
        $row = mysqli_fetch_assoc($resultadoTitulo);
        $tituloPublicacao = $row['titulo'];
    }

    if (isset($meIdentificarEdit) && $meIdentificarEdit == 'on') {
        $query = "UPDATE Publicacao SET isAnonima = 0 WHERE idPublicacao = " . (int)$id;
        $resultado = mysqli_query($conn, $query);
        if ($resultado) {
            $mensagem = "Você se identificou no relato: \"" . $tituloPublicacao . "\".";
        } else {
            $mensagem = "Erro (". mysqli_error($conn) .") ao se identificar no relato: \"" . $tituloPublicacao . "\". ";
        }
    }

    return $mensagem;
}
if(isset($_POST['confirmReportIdentification']) && isset($_POST['meIdentificarEdit'])){
    $anonIdentification_message = editAnonIdentification($conn, filter_var(mysqli_escape_string($conn,$_POST['anonymousReportIdentifier']), FILTER_SANITIZE_NUMBER_INT));
}

//AUXILIOS
function endAuxilio($conn, $postId) {
    $message = "";
    $query = "UPDATE Publicacao SET isConcluido = 1 WHERE idPublicacao = $postId";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_affected_rows($conn) > 0) {
        $message = "Auxílio concluído com sucesso!";
    } else {
        $message = "Erro ao concluir o auxílio. Tente novamente mais tarde.";
    }
    return $message;
}

if(isset($_POST['concludePost'])){
    $conclude_message = endAuxilio($conn, filter_var(mysqli_escape_string($conn,$_POST['identifierId']), FILTER_SANITIZE_NUMBER_INT));
}