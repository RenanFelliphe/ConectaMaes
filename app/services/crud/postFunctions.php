<?php
include_once(__DIR__ . '/../helpers/conn.php');

// SEND POSTS - CREATE
function sendPost($conn, $postType, $currentUserId) {
    if (!empty($_POST['conteudoEnvio'])) {
        $err = array();
        $tipoPublicacaoEnvio = mysqli_real_escape_string($conn, $postType);
        $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
        $linkAnexoEnvio = '';
        $tituloEnvio = isset($_POST['tituloEnvio']) ? mysqli_real_escape_string($conn, $_POST['tituloEnvio']) : null;
        $isConcluido = isset($_POST['isConcluidoEnvio']) ? mysqli_real_escape_string($conn, $_POST['isConcluidoEnvio']) : 0;
        $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);

        if (empty($err)) {
            $insertNewPost = "INSERT INTO Publicacao (tipoPublicacao, conteudo, linkAnexo, titulo, isConcluido, idUsuario) VALUES ('$tipoPublicacaoEnvio', '$conteudoEnvio', '$linkAnexoEnvio', '$tituloEnvio', '$isConcluido', '$idUsuarioQuePostou')";
            $executeSendPost = mysqli_query($conn, $insertNewPost);

            if (!$executeSendPost) {
                echo "<p>Erro ao enviar publicação: " . mysqli_error($conn) . "!<p>";
            }
        }
    }
}

// SEND COMMENT - CREATE
function sendComment($conn, $idPublicacao, $currentUserId) {
    if (!empty($_POST['conteudoEnvio'])) {
        $err = array();
        $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
        $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);

        if (empty($err)) {
            $insertNewPost = "INSERT INTO Comentario (conteudo, idUsuario, idPublicacao) VALUES ('$conteudoEnvio', '$idUsuarioQuePostou', '$idPublicacao')";
            $executeSendPost = mysqli_query($conn, $insertNewPost);

            if (!$executeSendPost) {
                echo "<p>Erro ao enviar comentário: " . mysqli_error($conn) . "!<p>";
            } else {
                echo "<p>Comentário enviado com sucesso!<p>";
            }
        }
    }
}

/*
CREATE TABLE Comentario (
idComentario BIGINT PRIMARY KEY AUTO_INCREMENT,
conteudo VARCHAR(256),
dataCriacaoComentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
idUsuario BIGINT,
idPublicacao BIGINT,
CONSTRAINT FK_Comentario_Usuario FOREIGN KEY (idUsuario) REFERENCES Usuario (idUsuario) ON DELETE NO ACTION ON UPDATE CASCADE,
CONSTRAINT FK_Comentario_Publicacao FOREIGN KEY (idPublicacao) REFERENCES Publicacao (idPublicacao) ON DELETE NO ACTION ON UPDATE CASCADE
);
*/

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

function renderProfileLink($relativePublicPath, $profileImage, $nomeDeUsuario) {
    return '<a class="postOwnerImage" href="' . htmlspecialchars($relativePublicPath . "/home/perfil.php?user=" . urlencode($nomeDeUsuario)) . '">
                <img src="' . htmlspecialchars($profileImage) . '">
            </a>';
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