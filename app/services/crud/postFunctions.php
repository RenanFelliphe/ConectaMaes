<?php
    $hostname = '162.240.17.101';
    $username = 'projetos_nlessa';
    $password = 'Gc&sgY74PK$}';
    $database = 'projetos_INF2023_G10';

    $conn = mysqli_connect($hostname, $username, $password, $database);

    // SEND POSTS - CREATE
    function sendPost($conn, $postType, $currentUserId) {
        if(!empty($_POST['conteudoEnvio'])){
            $err = array();
            
            $tipoPublicacaoEnvio = mysqli_real_escape_string($conn, $postType);
            $conteudoEnvio = mysqli_real_escape_string($conn, $_POST['conteudoEnvio']);
            $tituloEnvio = isset($_POST['tituloEnvio']) ? mysqli_real_escape_string($conn, $_POST['tituloEnvio']) : null;
            $isSensivelEnvio = isset($_POST['sensitiveContent']) ? mysqli_real_escape_string($conn, $_POST['sensitiveContent']) : 0;
            $isConcluido = isset($_POST['isConcluidoEnvio']) ? mysqli_real_escape_string($conn, $_POST['isConcluidoEnvio']) : 0;
            $idUsuarioQuePostou = mysqli_real_escape_string($conn, $currentUserId);
            $linkAnexoEnvio = '';
            
            if(empty($err)){
                $insertNewPost = "INSERT INTO Publicacao (tipoPublicacao, conteudo, linkAnexo, titulo, isSensivel, isConcluido, idUsuario) VALUES ('$tipoPublicacaoEnvio','$conteudoEnvio','$linkAnexoEnvio','$tituloEnvio','$isSensivelEnvio','$isConcluido','$idUsuarioQuePostou')";
                $executeSendPost = mysqli_query($conn, $insertNewPost);

                if(!$executeSendPost){
                    echo "<p>Erro ao enviar publicação: " . mysqli_error($conn) . "!<p>";
                }
            }     
        }
    }
    

    // SEARCH POSTS - READ
        function querySpecificPost($conn, $id){
            $sUQuery = "SELECT * FROM Publicacao WHERE idPublicacao =" . (int) $id;

            $sUExec = mysqli_query($conn, $sUQuery);
            $sUReturn = mysqli_fetch_assoc($sUExec);

            return $sUReturn;
        }
        function queryMultiplePosts($conn, $where = 1, $order = ""){
            if(!empty($order))
            {
                $order = "ORDER BY $order";
            }

            $gQuery = "SELECT * FROM Publicacao WHERE $where $order ";

            $gExec = mysqli_query($conn,$gQuery);
            $gReturn = mysqli_fetch_all($gExec, MYSQLI_ASSOC);

            return $gReturn;
        }

    // DELETE POST - DELETE
        function deletePost($conn, $id)
        {
            if(!empty($id)){         
                $dQuery = "DELETE FROM Publicacao WHERE idPublicacao = ". (int) $id;
                $dExec = mysqli_query($conn, $dQuery);

                if(!$dExec){
                    echo "Algo deu errado, tente novamente mais tarde!";
                }
            }    
        }
