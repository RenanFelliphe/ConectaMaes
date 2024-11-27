<?php
    function uploadPFP($conn, $userId, $nomeDeUsuario) {
        $diretorioPfP =  __DIR__ . '/../../assets/imagens/fotos/perfil/';
        
        if (isset($_FILES['fotoPerfilRegistro']) && $_FILES['fotoPerfilRegistro']['name'] != '') {
            if ($_FILES['fotoPerfilRegistro']['error'] != UPLOAD_ERR_OK) {
                echo "Erro no envio do arquivo.<br>";
                exit; 
            }
        }

        if (isset($_FILES['fotoPerfilRegistro']) && $_FILES['fotoPerfilRegistro']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['fotoPerfilRegistro']['tmp_name'];
            $imgNomeOriginal = $_FILES['fotoPerfilRegistro']['name'];
            $imgExtensao = strtolower(pathinfo($imgNomeOriginal, PATHINFO_EXTENSION));
    
            // Verifica se a extensão é permitida (.png ou .jpeg)
            if (in_array($imgExtensao, ['png', 'jpeg', 'jpg'])) {
                $imgNomeUnico = $nomeDeUsuario . "." . $imgExtensao;
                $caminhoDestino = $diretorioPfP . $imgNomeUnico;
    
                // Move o arquivo para o diretório de destino
                if (move_uploaded_file($imgTemp, $caminhoDestino)) {
                    $imgNomeUnicoDb = mysqli_real_escape_string($conn, $imgNomeUnico);
    
                    // Atualiza o link da foto de perfil no banco de dados do usuário
                    $queryUpdate = "UPDATE Usuario SET linkFotoPerfil = '$imgNomeUnicoDb' WHERE idUsuario = $userId";
    
                    if (!mysqli_query($conn, $queryUpdate)) {
                        echo "Erro ao atualizar o banco de dados: " . mysqli_error($conn) . "<br>";
                    }
                } else {
                    echo "Erro ao mover o arquivo para o diretório de destino.<br>";
                }
            } else {
                echo "Formato de imagem não suportado. Apenas .png e .jpeg são permitidos.<br>";
            }
        }
    }    
    
    function updatePFP($conn, $userId, $nomeDeUsuario = null) {
        $diretorioPfP = __DIR__ . '/../../assets/imagens/fotos/perfil/';
        $linkFotoPerfil = null; // Inicializa com null para manter o valor existente se não houver upload
        
        if (!$nomeDeUsuario) {// Busca o nome de usuário do banco de dados se não for fornecido
            $query = "SELECT nomeDeUsuario FROM Usuario WHERE idUsuario = '$userId'";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $userData = mysqli_fetch_assoc($result);
                $nomeDeUsuario = $userData['nomeDeUsuario'];
            } else {
                echo "Erro ao obter o nome de usuário do banco de dados.<br>";
                return null;
            }
        }
        if (isset($_FILES['fotoPerfilEdit']) && $_FILES['fotoPerfilEdit']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['fotoPerfilEdit']['tmp_name'];
            $imgNomeOriginal = $_FILES['fotoPerfilEdit']['name'];
            $imgExtensao = strtolower(pathinfo($imgNomeOriginal, PATHINFO_EXTENSION));
    
            if (in_array($imgExtensao, ['png', 'jpeg', 'jpg'])) {// Verifica se a extensão é permitida (.png ou .jpeg)
                $query = "SELECT linkFotoPerfil FROM Usuario WHERE idUsuario = '$userId'";// Obtém o nome atual da foto de perfil do banco de dados
                $result = mysqli_query($conn, $query);
                $userData = mysqli_fetch_assoc($result);
                $linkFotoPerfilAtual = $userData['linkFotoPerfil'];
                $imgNomeUnico = $nomeDeUsuario . "." . $imgExtensao;// Define o nome único para a nova imagem
                $caminhoDestino = $diretorioPfP . $imgNomeUnico;
                $caminhoArquivoAtual = $diretorioPfP . $linkFotoPerfilAtual;// Define o caminho completo para o arquivo atual
                
                if (!empty($linkFotoPerfilAtual) && file_exists($caminhoArquivoAtual)) {// Remove o arquivo atual se existir
                    unlink($caminhoArquivoAtual);
                }
                if (move_uploaded_file($imgTemp, $caminhoDestino)) {// Move o novo arquivo para o diretório de destino
                    $linkFotoPerfil = $imgNomeUnico; // Define o link da nova foto para atualização no banco de dados
                    $queryUpdate = "UPDATE Usuario SET linkFotoPerfil = '$linkFotoPerfil' WHERE idUsuario = '$userId'";// Atualiza o link da foto de perfil no banco de dados
                    if (!mysqli_query($conn, $queryUpdate)) {
                        echo "Erro ao atualizar o banco de dados: " . mysqli_error($conn) . "<br>";
                    }
                } else {
                    echo "Erro ao mover o arquivo para o diretório de destino.<br>";
                }
            } else {
                echo "Formato de imagem não suportado. Apenas .png e .jpeg são permitidos.<br>";
            }
        }
        return $linkFotoPerfil;
    }
     
    function uploadAnexo($conn, $idPost){
        $diretorioAnexo = __DIR__ . "/../../assets/imagens/fotos/anexos/";

        if (isset($_FILES['linkAnexoEnvio']) && $_FILES['linkAnexoEnvio']['name'] != '') {
            if ($_FILES['linkAnexoEnvio']['error'] != UPLOAD_ERR_OK) {
                echo "Erro no envio do arquivo.<br>";
                exit; 
            }
        }

        if (isset($_FILES['linkAnexoEnvio']) && $_FILES['linkAnexoEnvio']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['linkAnexoEnvio']['tmp_name'];
            $imgNomeOriginal = $_FILES['linkAnexoEnvio']['name'];
            $imgExtensao = strtolower(pathinfo($imgNomeOriginal, PATHINFO_EXTENSION));
            
            if (in_array($imgExtensao, ['png', 'jpeg', 'jpg'])) { 
                $imgNomeUnico =  $idPost. "." . $imgExtensao;
                $caminhoDestino = $diretorioAnexo . $imgNomeUnico;

                if(move_uploaded_file($imgTemp, $caminhoDestino)){
                    $imgNomeUnicoDb = mysqli_real_escape_string($conn, $imgNomeUnico);
                    $queryUpdate = "UPDATE Publicacao SET linkAnexo = '$imgNomeUnicoDb' WHERE idPublicacao = $idPost";

                    if (!mysqli_query($conn, $queryUpdate)) {
                        echo "Erro ao atualizar o banco de dados: " . mysqli_error($conn) . "<br>";
                    }
                } else {
                    echo "Erro (". $_FILES['linkAnexoEnvio']['error']. ") ao mover o arquivo para o diretório de destino.<br>";
                }
            } else {
                echo "Formato de imagem não suportado. Apenas .png e .jpeg são permitidos.<br>";
            }  
        }
    }
