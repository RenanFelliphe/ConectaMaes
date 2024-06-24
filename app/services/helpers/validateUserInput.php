<?php
    function validateUser($user, &$err) {
        // Nome de usuário deve ter mais que 3 caracteres e pode conter apenas letras, números e _
        if(mb_strlen($user, 'UTF-8')<4){
            $err[] = "Nome de usuário tem que ter no mínimo 4 caracteres";
        }
        
        if (preg_match('/^[a-zA-Z0-9_]{4,}$/', $user)) {
            return $user;
        }else{
            $err[] = "Nome de usuário pode conter apenas letras, números e _";
        }
        
        return false;
    }

    function validateEmail($emailInput, &$err) {
        // Valida e sanitiza o email
        $verifyEmail = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        if (!filter_var($verifyEmail, FILTER_VALIDATE_EMAIL)) {
            $err[] = "E-mail inválido. Utilize o formato example@email.com";
        } else {
            return $verifyEmail;
        }
    }

    function validateSenha($senha, $confirma, &$err) {
        // Senha deve ter pelo menos 8 caracteres, incluir letras e números
        if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $senha)) {
            return $senha;
        } else{
            $err[] = "Senha deve conter letras e números";
        }
        if ($senha != $confirma) {
            $err[] = "Senhas não conferem!";
        }
        return false;
    }

    function validateNome($nome, &$err) {
        function capitalizeString($str) {
            // Converter todas as palavras para minúsculas
            $str = strtolower($str);
                $palavras = explode(' ', $str);
            $palavras_capitalizadas = [];
                foreach ($palavras as $p) {
                    // Capitalizar a primeira letra da palavra, se ela tiver 3 ou mais caracteres
                    if (strlen($p) >= 4) {
                        $p = ucfirst($p);
                    } else {
                        $p = strtolower($p);
                    }
                    $palavras_capitalizadas[] = $p;
                }
            return implode(' ', $palavras_capitalizadas);
        }
        
        // Nome deve ter pelo menos duas palavras, sem caracteres especiais
        $nome = filter_var($nome, FILTER_SANITIZE_STRING);
            $partes_nome = explode(' ', $nome);
                if (count($partes_nome) >= 2) {
                    foreach ($partes_nome as $pn) {
                        if (!preg_match('/^[\p{L}]+$/u', $pn)) {
                            $err[] = "Nome inválido";
                            return false;
                        }
                    }
                    return capitalizeString($nome);
                }
        $err[] = "Insira seu nome completo.";
        return false;
    }

    function validateTelefone($telefone, &$err) {
        // Valida um formato de telefone (xx) xxxxx-xxxx
        if (preg_match('/^\(\d{2}\) \d{4,5}-\d{4}$/', $telefone)) {
            return $telefone;
        } else {
            $err[] = "Telefone inválido. Utilize o formato: (xx) xxxxx-xxxx";
        }
        return false;
    }

