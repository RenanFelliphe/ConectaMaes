<?php
    function uploadPFP($conn, $userId){
        $diretorioPfP =  __DIR__ . '/../../assets/imagens/fotos/perfil/';
    
        if (isset($_FILES['fotoPerfilRegistro']) && $_FILES['fotoPerfilRegistro']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['fotoPerfilRegistro']['tmp_name'];
            $imgNomeOriginal = $_FILES['fotoPerfilRegistro']['name'];
            $imgExtensao = strtolower(pathinfo($imgNomeOriginal, PATHINFO_EXTENSION));
        
            // Verifica se a extensão é permitida (.png ou .jpeg)
            if (in_array($imgExtensao, ['png', 'jpeg', 'jpg'])) {
                $imgNomeUnico = uniqid() . "." . $imgExtensao;
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
        } else {
            echo "Nenhuma imagem enviada ou erro no upload.<br>";
        }
    }

    function updatePFP(){}

    function uploadAnexo(){
        $diretorioAnexo = "/app/assets/imagens/fotos/anexos/";

        if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
            $imgTemp = $_FILES['img']['tmp_name'];
            $imgNomeOriginal = $_FILES['img']['name'];
            
            // Gera um nome único para a img usando uniqid() e preserva a extensão original
            $extensao = pathinfo($imgNomeOriginal, PATHINFO_EXTENSION);
            $imgNomeUnico = uniqid() . "." . $extensao;
            
            // Caminho completo para onde a img será movida
            $caminhoDestino = $diretorioAnexo . $imgNomeUnico;
            
            // Move a img para o diretório de destino
            if (move_uploaded_file($imgTemp, $caminhoDestino)) {
                echo "img enviada com sucesso! Nome único: " . $imgNomeUnico;
            } else {
                echo "Erro ao mover a img.";
            }
        } else {
            echo "Nenhuma img enviada ou erro no upload.";
        }
    }


    

