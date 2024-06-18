<?php
    function postDateMessage($dataCriacaoPublicacao) {
        // Converter a data de criação da publicação em um objeto DateTime com o fuso horário correto
        $dataPost = new DateTime($dataCriacaoPublicacao, new DateTimeZone('America/Sao_Paulo'));
        
        // Data e hora atual com o fuso horário correto
        $dataAtual = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

        // Calcula a diferença entre as datas
        $diffTime = $dataAtual->diff($dataPost);

        // Formatação da diferença
        if ($diffTime->y > 0) {
            // Mais de um ano atrás
            return $dataPost->format('d/m/Y');
        } elseif ($diffTime->m > 0) {
            // Mais de um mês atrás
            return $dataPost->format('d/m/Y');
        } elseif ($diffTime->d >= 7) {
            // Mais de uma semana atrás
            $semanas = floor($diffTime->d / 7);
            return "há $semanas semana" . ($semanas > 1 ? "s" : "");
        } elseif ($diffTime->d > 0) {
            // Mais de um dia atrás
            return "há {$diffTime->d} dia" . ($diffTime->d > 1 ? "s" : "");
        } elseif ($diffTime->h > 0) {
            // Mais de uma hora atrás
            return "há {$diffTime->h} hora" . ($diffTime->h > 1 ? "s" : "");
        } elseif ($diffTime->i > 0) {
            // Mais de um minuto atrás
            return "há {$diffTime->i} minuto" . ($diffTime->i > 1 ? "s" : "");
        } elseif ($diffTime->s > 0) {
            // Mais de um segundo atrás
            return "há {$diffTime->s} segundo" . ($diffTime->s > 1 ? "s" : "");
        } else {
            // Exatamente agora
            return "agora";
        }
    }

