<?php
    if (isset($_FILES['linkFotoPerfilRegistro']) && isset($_POST['nomeUsuarioRegistro']) && isset($_POST['dataNascimentoRegistro'])) {
        $nomeUsuarioRegistro = $_POST['nomeUsuarioRegistro'];
        $dataNascimentoRegistro = $tempoAtual = date('Y-m-d H:i:s');
        $extensaoDoArquivo = strtolower(pathinfo($_FILES["linkFotoPerfilRegistro"]["name"], PATHINFO_EXTENSION));
        $target_dir = "/ConectaMaes/app/assets/imagens/fotos/perfil/";
        $target_file = $target_dir . basename($_FILES["linkFotoPerfilRegistro"]["name"]);
        $uploadOk = 1;

        $check = getimagesize($_FILES["linkFotoPerfilRegistro"]["tmp_name"]);
        if ($check !== false) {
            echo "O arquivo é uma imagem - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "O arquivo não é uma imagem.";
            $uploadOk = 0;
        }
        $novoNomeDoArquivo = $nomeUsuarioRegistro . '-' . $dataNascimentoRegistro . '-perfil.' . $extensaoDoArquivo;

        $target_file = $target_dir . $novoNomeDoArquivo;
        $uploadOk = 1;

        if (file_exists($target_file)) {
            echo "O arquivo já existe. Utilizando o arquivo existente.";
            $uploadOk = 0; // Define $uploadOk como 0 para impedir o upload
        }

        if ($_FILES["linkFotoPerfilRegistro"]["size"] > 500000) { // 500KB
            echo "Desculpe, o seu arquivo é muito grande.";
            $uploadOk = 0;
        }

        // Verifica se $uploadOk está definido como 0 por um erro
        if ($uploadOk == 0) {
            echo " O arquivo não foi enviado.";
        } else {
            // Movimenta o arquivo apenas se ele não existir
            if (move_uploaded_file($_FILES["linkFotoPerfilRegistro"]["tmp_name"], $target_file)) {
                echo "O arquivo ". htmlspecialchars($novoNomeDoArquivo) . " foi enviado.";
            } else {
                echo "Desculpe, houve um erro ao enviar seu arquivo.";
            }
        }
    }



