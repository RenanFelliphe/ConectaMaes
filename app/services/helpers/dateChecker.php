<?php
    function validateDate($data, &$err) {
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $data, $matches)) {// Verifica se a data está no formato dd/mm/yyyy usando uma expressão regular
            $diaDataUser = $matches[1];// Extrai o dia, mês e ano da data
            $mesDataUser = $matches[2];
            $anoDataUser = $matches[3];
            $anoAtual = date("Y");
            $anoMinimo = $anoAtual - 100;
            $anoMaximo = $anoAtual;

            if (!checkdate($mesDataUser, $diaDataUser, $anoDataUser)) {// Verifica se a data é válida (considerando meses de 1 a 12 e dias válidos para cada mês)
                $err[] = "Data inválida: o dia, mês ou ano não é válido.";
                return false;
            }
            if ($anoDataUser < $anoMinimo) {// Verifica se o ano está dentro do intervalo permitido
                $err[] = "Ano inválido: o ano deve ser maior que " . ($anoMinimo - 1);
                return false;
            } elseif ($anoDataUser > $anoMaximo) {
                $err[] = "Ano inválido: o ano deve ser menor que " . ($anoMaximo);
                return false;
            }

            return $anoDataUser . '-' . $mesDataUser . '-' . $diaDataUser;// Retorna a data no formato yyyy-mm-dd
        }else{
            $err[] = "Formato de data inválido. Lembre-se de usar dd/mm/yyyy.";
            return false;
        }
    }
    
    function postDateMessage($dataCriacaoPublicacao) {
        $dataPost = new DateTime($dataCriacaoPublicacao, new DateTimeZone('America/Sao_Paulo'));// Converter a data de criação da publicação em um objeto DateTime com o fuso horário correto
        $dataAtual = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));// Data e hora atual com o fuso horário correto
        $diffTime = $dataAtual->diff($dataPost);// Calcula a diferença entre as datas
        
        if ($diffTime->y > 0) {// Formatação da diferença
            return $dataPost->format('d/m/Y');// Mais de um ano atrás
        } elseif ($diffTime->m > 0) {
            return $dataPost->format('d/m/Y');// Mais de um mês atrás
        } elseif ($diffTime->d >= 7) {
            $semanas = floor($diffTime->d / 7);// Mais de uma semana atrás
            return "há $semanas semana" . ($semanas > 1 ? "s" : "");
        } elseif ($diffTime->d > 0) {
            return "há {$diffTime->d} dia" . ($diffTime->d > 1 ? "s" : "");// Mais de um dia atrás
        } elseif ($diffTime->h > 0) {
            return "há {$diffTime->h} hora" . ($diffTime->h > 1 ? "s" : "");// Mais de uma hora atrás
        } elseif ($diffTime->i > 0) {
            return "há {$diffTime->i} minuto" . ($diffTime->i > 1 ? "s" : "");// Mais de um minuto atrás
        } elseif ($diffTime->s > 0) {
            return "há {$diffTime->s} segundo" . ($diffTime->s > 1 ? "s" : "");// Mais de um segundo atrás
        } else {
            return "agora";// Exatamente agora
        }
    }

