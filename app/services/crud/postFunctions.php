<?php
    include_once(__DIR__ .'/../helpers/conn.php');

    // SEND POSTS - CREATE
        function sendPost($conn, $postType, $currentUserId) {
            if(!empty($_POST['conteudoEnvio'])){
                $err = array();
                $tipoPublicacaoEnvio = mysqli_real_escape_string($conn, $postType);
                $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
                $tituloEnvio = isset($_POST['tituloEnvio']) ? mysqli_real_escape_string($conn, $_POST['tituloEnvio']) : null;
                $isConcluido = isset($_POST['isConcluidoEnvio']) ? mysqli_real_escape_string($conn, $_POST['isConcluidoEnvio']) : 0;
                $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);
                $linkAnexoEnvio = '';
                
                if(empty($err)){
                    $insertNewPost = "INSERT INTO Publicacao (tipoPublicacao, conteudo, linkAnexo, titulo, isConcluido, idUsuario) VALUES ('$tipoPublicacaoEnvio','$conteudoEnvio','$linkAnexoEnvio','$tituloEnvio','$isConcluido','$idUsuarioQuePostou')";
                    $executeSendPost = mysqli_query($conn, $insertNewPost);

                    if(!$executeSendPost){
                        echo "<p>Erro ao enviar publicação: " . mysqli_error($conn) . "!<p>";
                    }
                }     
            }
        }

    // SEARCH POSTS - READ
        function specificPostQuery($conn, $data, $where, $order){
            $sUQuery = "SELECT $data FROM Publicacao WHERE $where $order";
            $sUExec = mysqli_query($conn, $sUQuery);
        
            return $sUExec;
        }
        function queryPostsAndUserData($conn, $postType) {
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
                    (SELECT COUNT(*) FROM curtirPublicacao c WHERE c.idPublicacao = p.idPublicacao) as totalLikes
                FROM 
                    Publicacao p
                JOIN 
                    Usuario u ON p.idUsuario = u.idUsuario
            ";

            // Ajusta a cláusula WHERE de acordo com o tipo de publicação
            $whereClause = ($postType === '') ? "p.tipoPublicacao <> 'Auxilio'" : "p.tipoPublicacao = '$postType'";
            
            // Combina a query base com a cláusula WHERE
            $finalQuery = $baseQuery . " WHERE " . $whereClause . " ORDER BY p.dataCriacaoPublicacao DESC";
            
            $result = mysqli_query($conn, $finalQuery);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        function queryUserLike($conn, $idUser, $idPost){
            $queryLike = "SELECT * FROM curtirPublicacao WHERE idPublicacao = $idPost AND idUsuario = $idUser";
            $execQuery = mysqli_query($conn, $queryLike);
            $returnExec = mysqli_fetch_assoc($execQuery);

            return $returnExec;
        }

    // DELETE POST - DELETE
        function deletePost($conn, $id){
            if(!empty($id)){         
                $dQuery = "DELETE FROM Publicacao WHERE idPublicacao = ". (int) $id;
                $dExec = mysqli_query($conn, $dQuery);

                if(!$dExec){
                    echo "Algo deu errado, tente novamente mais tarde!";
                }
            }    
        }

    // LIKES
        function handlePostLike($conn, $idUser, $idPost) {
            $userLike = queryUserLike($conn, $idUser, $idPost);
            if(!$userLike) {
                $insertLike = "INSERT INTO curtirPublicacao (idPublicacao, idUsuario) VALUES ($idPost , $idUser)";
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
