<?php
include_once(__DIR__ . '/../helpers/conn.php');

// SEND POSTS - CREATE
function sendPost($conn, $postType, $currentUserId) {
    $messages = array();  // Array para armazenar as mensagens

    if (!empty($_POST['conteudoEnvio'])) {
        $tipoPublicacaoEnvio = mysqli_real_escape_string($conn, $postType);
        $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
        $linkAnexoEnvio = '';
        $tituloEnvio = isset($_POST['tituloEnvio']) ? mysqli_real_escape_string($conn, $_POST['tituloEnvio']) : null;
        $isConcluido = isset($_POST['isConcluidoEnvio']) ? (int) $_POST['isConcluidoEnvio'] : 0; 
        $isAnonima = isset($_POST['meIdentificar']) && $_POST['meIdentificar'] == 'on' ? 0 : 1; 
        $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);

        $insertNewPost = "INSERT INTO Publicacao (tipoPublicacao, conteudo, linkAnexo, titulo, isConcluido, isAnonima, idUsuario) VALUES ('$tipoPublicacaoEnvio', '$conteudoEnvio', '$linkAnexoEnvio', '$tituloEnvio', '$isConcluido', '$isAnonima', '$idUsuarioQuePostou')";
        $executeSendPost = mysqli_query($conn, $insertNewPost);

        if (!$executeSendPost) {
            $messages[] = "Erro ao enviar publicação: " . mysqli_error($conn);
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

if (isset($_POST['postAuxilioModal'])) {
    $messages = sendPost($conn, 'Auxilio', $currentUserData['idUsuario']);
} else if (isset($_POST['postRelatoModal'])) {
    $messages = sendPost($conn, 'Relato', $currentUserData['idUsuario']);
} else if (isset($_POST['postComentarioModal'])) {
    $postId = $_POST['idPublicacao'] ?? null;

    if (!empty($postId)) {
        $messages = sendComment($conn, $postId, $currentUserData['idUsuario']);
    } else {
        $messages[] = "<p class='error'>Erro: Não foi possível comentar nesta publicação.</p>";
    }
} else {
    $messages = sendPost($conn, '', $currentUserData['idUsuario']);
}
// SEARCH POSTS - READ
function specificPostQuery($conn, $data, $where, $order) {
    $sUQuery = "SELECT $data FROM Publicacao WHERE $where $order";
    $sUExec = mysqli_query($conn, $sUQuery);
    
    return $sUExec;
}

function queryPostsAndUserData($conn, $postType = '', $postId = null, $limit = 10, $offset = 0) {
    $baseQuery = "
        SELECT 
            p.idPublicacao, 
            p.tipoPublicacao, 
            p.conteudo, 
            p.titulo, 
            p.isAnonima,
            p.dataCriacaoPublicacao,
            u.idUsuario, 
            u.nomeCompleto, 
            u.nomeDeUsuario, 
            u.linkFotoPerfil,
            u.estado,
            -- Subquery para contar likes
            (SELECT COUNT(*) FROM curtirPublicacao c WHERE c.idPublicacao = p.idPublicacao) AS totalLikes,
            -- Subquery para contar comentários
            (SELECT COUNT(*) FROM Comentario cm WHERE cm.idPublicacao = p.idPublicacao) AS totalComments
        FROM 
            Publicacao p
        JOIN 
            Usuario u ON p.idUsuario = u.idUsuario
    ";

    if ($postId !== null) {
        $finalQuery = $baseQuery . " WHERE p.idPublicacao = " . intval($postId) . " ORDER BY p.dataCriacaoPublicacao DESC LIMIT 1";
    } else {
        $whereClause = ($postType === '') ? "p.tipoPublicacao <> 'Auxilio'" : "p.tipoPublicacao = '$postType'";
        
        $finalQuery = $baseQuery . " WHERE " . $whereClause . " ORDER BY p.dataCriacaoPublicacao DESC LIMIT $limit OFFSET $offset";
    }

    $result = mysqli_query($conn, $finalQuery);

    if (!$result) {
        echo "<p class='error'>Erro na consulta: " . mysqli_error($conn) . "</p>";
        return false;
    }
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
        $dQuery = "DELETE FROM Publicacao WHERE idPublicacao = " . (int)$id;
        $dExec = mysqli_query($conn, $dQuery);
        if (!$dExec) {
            echo "Algo deu errado, tente novamente mais tarde!";
        }
        echo "<script>window.location.href = window.location.href;</script>";
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
function queryCommentsData($conn, $postId, $limit = 10, $offset = 0) {
    $baseQuery = "
        SELECT 
            c.idComentario,
            c.conteudo AS comentarioConteudo,
            c.dataCriacaoComentario,
            u.idUsuario,
            u.nomeCompleto,
            u.nomeDeUsuario,
            u.linkFotoPerfil,
            u.estado,
            COUNT(lp.idComentario) AS totalCommentLikes
        FROM 
            Comentario c
        JOIN 
            Usuario u ON c.idUsuario = u.idUsuario
        LEFT JOIN 
            curtirComentario lp ON lp.idComentario = c.idComentario
    ";

    $whereClause = "WHERE c.idPublicacao = " . intval($postId);

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($likedPost = array_keys($_POST, 'like', true)) {
        $postId = str_replace('like_', '', $likedPost[0]);
        handlePostLike($conn, $currentUserData['idUsuario'], (int)$postId);
    }

    if (isset($_POST['deletarPost'])) {
        deletePost($conn, $_POST['postDeleterId']);
    }

    if ($likedComment = array_keys($_POST, 'like', true)) {
        $commentId = str_replace('commentLike_', '', $likedComment[0]);
        handleCommentLike($conn, $currentUserData['idUsuario'], (int)$commentId); 
    }

    // Verifica se foi enviado para deletar algum comentário
    if (isset($_POST['deletarComentario'])) {
        deleteComment($conn, $_POST['deleterCommentId']);
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
    $anonIdentification_message = editAnonIdentification($conn, $_POST['anonymousReportIdentifier']);
}
