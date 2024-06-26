<?php
    function validateUser($user, &$err) {
        // Nome de usuário deve ter mais que 3 caracteres e pode conter apenas letras, números e _
        if(mb_strlen($user, 'UTF-8')<4){
            $err[] = "Nome de usuário deve ter mais de 3 caracteres!";
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
        if (filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
            return $verifyEmail;
        } else {
            $err[] = "E-mail inválido. Utilize o formato example@email.com";
        }
        return false;
    }

    function validateSenha($senha, $confirma, &$err) {
        if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $senha)) {
            if ($senha == $confirma) {
                return md5($senha);
            }else{
                $err[] = "Senhas não conferem!";
            }
        } else{
            if(strlen($senha)<8){
                $err[] = "Senha deve conter pelo menos 8 caracteres!";
            }
            if(!preg_match('/[A-Za-z]/', $senha)){
                $err[] = "Senha deve conter letras também!";
            }
            if(!preg_match('/\d/', $senha)){
                $err[] = "Senha deve conter números também!";
            }
            if (preg_match('/[^A-Za-z\d]/', $senha)) {
                $err[] = "Senha deve conter apenas letras e números!";
            }
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
                            $err[] = "Nome inválido!";
                            return false;
                        }
                    }
                    return capitalizeString($nome);
                }
        $err[] = "Insira seu nome completo!";
        return false;
    }

    function validateTelefone($telefoneInput, &$err) {
        // Remove qualquer caractere que não seja um dígito
        $telefone = preg_replace('/\D/', '', $telefoneInput);
        
        // Lista de DDDs válidos
        $valid_ddds = [
            '11', '12', '13', '14', '15', '16', '17', '18', '19',
            '21', '22',       '24',             '27', '28',
            '31', '32', '33', '34', '35',       '37', '38',
            '41', '42', '43', '44', '45', '46', '47', '48', '49',
            '51',       '53', '54', '55',
            '61', '62', '63', '64', '65', '66', '67', '68', '69',
            '71',       '73', '74', '75',       '77',       '79',
            '81', '82', '83', '84', '85', '86', '87', '88', '89',
            '91', '92', '93', '94', '95', '96', '97', '98', '99'
        ];
        
        // Verifica o comprimento do telefone e extrai o DDD
        if (strlen($telefone) == 10) {
            $ddd = substr($telefone, 0, 2);
            if (!in_array($ddd, $valid_ddds)) {
                $err[] = "DDD inválido.";
                return false;
            }
            // Retorna o número completo sem formatação
            return $telefone;
        } elseif (strlen($telefone) == 11 && $telefone[2] == '9') {
            $ddd = substr($telefone, 0, 2);
            if (!in_array($ddd, $valid_ddds)) {
                $err[] = "DDD inválido.";
                return false;
            }
            // Retorna o número completo sem formatação
            return $telefone;
        } else {
            $err[] = "Telefone inválido. Utilize o formato correto!";
            return false;
        }
    }
    
