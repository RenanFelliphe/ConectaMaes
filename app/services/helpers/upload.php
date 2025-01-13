<?php
    function uploadPFP($conn, $userId, $nomeDeUsuario) {
        $diretorioPfP =  __DIR__ . '/../../assets/imagens/fotos/perfil/';
        $maxImgSize = 5 * 1024 * 1024; //5MB
        if (isset($_FILES['fotoPerfilRegistro']) && $_FILES['fotoPerfilRegistro']['name'] != '') {
            if ($_FILES['fotoPerfilRegistro']['error'] != UPLOAD_ERR_OK) {
                echo "Erro no envio do arquivo.<br>";
                exit; 
            }
            if($_FILES['fotoPerfilRegistro']['size']>$maxImgSize){
                echo "Arquivo muito grande. Tamanho máximo: 5MB.<br>";
                exit;
            }
        }

        if (isset($_FILES['fotoPerfilRegistro']) && $_FILES['fotoPerfilRegistro']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['fotoPerfilRegistro']['tmp_name'];
            $imgNomeOriginal = $_FILES['fotoPerfilRegistro']['name'];
            $imgExtensao = strtolower(pathinfo($imgNomeOriginal, PATHINFO_EXTENSION));
    
            // Verifica se a extensão é permitida (.png ou .jpeg)
            if (in_array($imgExtensao, ["jpg", "jpeg", "png", "bmp", "webp"])) {
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
        $maxImgSize = 5 * 1024 * 1024; //5MB
        $mensagens = []; // Array para armazenar as mensagens
        
        if (isset($_FILES['fotoPerfilEdit']) && $_FILES['fotoPerfilEdit']['name'] != '') {
            if ($_FILES['fotoPerfilEdit']['error'] != UPLOAD_ERR_OK) {
                $mensagens[] =  "Erro no envio do arquivo.<br>";
                return $mensagens;
            }
            if($_FILES['fotoPerfilEdit']['size']>$maxImgSize){
                $mensagens[] = "Arquivo muito grande. Tamanho máximo: 5MB.<br>";
                return $mensagens;
            }
        }
    
        if (!$nomeDeUsuario) {
            $query = "SELECT nomeDeUsuario FROM Usuario WHERE idUsuario = '$userId'";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $userData = mysqli_fetch_assoc($result);
                $nomeDeUsuario = $userData['nomeDeUsuario'];
            } else {
                $mensagens[] = "Erro ao obter o nome de usuário do banco de dados."; // Armazena mensagem de erro
                return $mensagens; // Retorna as mensagens de erro
            }
        }
    
        if (isset($_FILES['fotoPerfilEdit']) && $_FILES['fotoPerfilEdit']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['fotoPerfilEdit']['tmp_name'];
            $imgNomeOriginal = $_FILES['fotoPerfilEdit']['name'];
            $imgExtensao = strtolower(pathinfo($imgNomeOriginal, PATHINFO_EXTENSION));
    
            if (in_array($imgExtensao, ['png', 'jpeg', 'jpg'])) {
                $query = "SELECT linkFotoPerfil FROM Usuario WHERE idUsuario = '$userId'";
                $result = mysqli_query($conn, $query);
                $userData = mysqli_fetch_assoc($result);
                $linkFotoPerfilAtual = $userData['linkFotoPerfil'];
                $imgNomeUnico = $nomeDeUsuario . "." . $imgExtensao;
                $caminhoDestino = $diretorioPfP . $imgNomeUnico;
                $caminhoArquivoAtual = $diretorioPfP . $linkFotoPerfilAtual;
    
                if (!empty($linkFotoPerfilAtual) && file_exists($caminhoArquivoAtual)) {
                    unlink($caminhoArquivoAtual);
                }
    
                if (move_uploaded_file($imgTemp, $caminhoDestino)) {
                    $linkFotoPerfil = $imgNomeUnico; // Atualiza o link da foto de perfil
                    $queryUpdate = "UPDATE Usuario SET linkFotoPerfil = '$linkFotoPerfil' WHERE idUsuario = '$userId'";
    
                    if (!mysqli_query($conn, $queryUpdate)) {
                        $mensagens[] = "Erro ao atualizar o banco de dados: " . mysqli_error($conn); // Mensagem de erro ao atualizar no banco
                    } else {
                        $mensagens[] = "Foto de perfil atualizada com sucesso."; // Mensagem de sucesso ao atualizar a foto
                    }
                } else {
                    $mensagens[] = "Erro ao mover o arquivo para o diretório de destino."; // Mensagem de erro ao mover arquivo
                }
            } else {
                $mensagens[] = "Formato de imagem não suportado. Apenas .png, .jpg, .jpeg, .bmp, .webp são permitidos."; // Mensagem de erro para formato inválido
            }
        }
    
        return [
            'linkFotoPerfil' => $linkFotoPerfil,
            'mensagens' => $mensagens
        ];
    }
     
    function uploadAnexo($conn, $idPost){
        $diretorioAnexo = __DIR__ . "/../../assets/imagens/fotos/anexos/";
        $maxImgSize = 5 * 1024 * 1024; //5MB

        if (isset($_FILES['linkAnexoEnvio']) && $_FILES['linkAnexoEnvio']['name'] != '') {
            if ($_FILES['linkAnexoEnvio']['error'] != UPLOAD_ERR_OK) {
                echo "Erro no envio do arquivo.<br>";
                exit; 
            }
            if($_FILES['linkAnexoEnvio']['size']>$maxImgSize){
                echo "Arquivo muito grande. Tamanho máximo: 5MB.<br>";
                exit;
            }
        }

        if (isset($_FILES['linkAnexoEnvio']) && $_FILES['linkAnexoEnvio']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['linkAnexoEnvio']['tmp_name'];
            $imgNomeOriginal = $_FILES['linkAnexoEnvio']['name'];
            $imgExtensao = strtolower(pathinfo($imgNomeOriginal, PATHINFO_EXTENSION));
            
            if (in_array($imgExtensao, ["jpg", "jpeg", "png", "bmp", "webp"])) { 
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
                echo "Formato de imagem não suportado. Apenas .png, .jpg, .jpeg, .bmp, .webp são permitidos.<br>";
            }  
        }
    }
