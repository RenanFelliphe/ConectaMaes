<?php
include_once(__DIR__ . '/../helpers/conn.php');

// SEND POSTS - CREATE
function sendPost($conn, $postType, $currentUserId) {
    if (!empty($_POST['conteudoEnvio'])) {
        $err = array();
        $tipoPublicacaoEnvio = mysqli_real_escape_string($conn, $postType);
        $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
        $tituloEnvio = isset($_POST['tituloEnvio']) ? mysqli_real_escape_string($conn, $_POST['tituloEnvio']) : null;
        $isConcluido = isset($_POST['isConcluidoEnvio']) ? mysqli_real_escape_string($conn, $_POST['isConcluidoEnvio']) : 0;
        $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);
        $linkAnexoEnvio = '';

        if (empty($err)) {
            $insertNewPost = "INSERT INTO Publicacao (tipoPublicacao, conteudo, linkAnexo, titulo, isConcluido, idUsuario) VALUES ('$tipoPublicacaoEnvio', '$conteudoEnvio', '$linkAnexoEnvio', '$tituloEnvio', '$isConcluido', '$idUsuarioQuePostou')";
            $executeSendPost = mysqli_query($conn, $insertNewPost);

            if (!$executeSendPost) {
                echo "<p>Erro ao enviar publicação: " . mysqli_error($conn) . "!<p>";
            }
        }
    }
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
            p.dataCriacaoPublicacao, 
            u.idUsuario, 
            u.nomeCompleto, 
            u.nomeDeUsuario, 
            u.linkFotoPerfil,
            u.estado,
            COUNT(c.idPublicacao) as totalLikes
        FROM 
            Publicacao p
        JOIN 
            Usuario u ON p.idUsuario = u.idUsuario
        LEFT JOIN 
            curtirPublicacao c ON c.idPublicacao = p.idPublicacao
    ";

    if ($postId !== null) {
        $finalQuery = $baseQuery . " WHERE p.idPublicacao = " . intval($postId) . " GROUP BY p.idPublicacao LIMIT 1";
    } else {
        $whereClause = ($postType === '') ? "p.tipoPublicacao <> 'Auxilio'" : "p.tipoPublicacao = '$postType'";
        
        $finalQuery = $baseQuery . " WHERE " . $whereClause . " GROUP BY p.idPublicacao ORDER BY p.dataCriacaoPublicacao DESC LIMIT $limit OFFSET $offset";
    }

    $result = mysqli_query($conn, $finalQuery);

    if (!$result) {
        echo "<p class='error'>Erro na consulta: " . mysqli_error($conn) . "</p>";
        return false;
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function queryUserLike($conn, $idUser, $idPost) {
    $queryLike = "SELECT * FROM curtirPublicacao WHERE idPublicacao = $idPost AND idUsuario = $idUser";
    $execQuery = mysqli_query($conn, $queryLike);
    $returnExec = mysqli_fetch_assoc($execQuery);

    return $returnExec;
}

// DELETE POST - DELETE
function deletePost($conn, $id) {
    if (!empty($id)) {
        $dQuery = "DELETE FROM Publicacao WHERE idPublicacao = " . (int)$id;
        $dExec = mysqli_query($conn, $dQuery);

        if (!$dExec) {
            echo "Algo deu errado, tente novamente mais tarde!";
        }
    }
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
    $query = "
        SELECT 
            c.idComentario,
            c.conteudo AS comentarioConteudo,
            c.dataCriacaoComentario,
            u.idUsuario,
            u.nomeCompleto,
            u.nomeDeUsuario,
            u.linkFotoPerfil,
            u.estado
        FROM 
            Comentario c
        JOIN 
            Usuario u ON c.idUsuario = u.idUsuario
        WHERE 
            c.idPublicacao = " . intval($postId) . "
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
