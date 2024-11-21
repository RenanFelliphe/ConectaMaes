<?php
    function getRelativePath($target) {
        // Caminho absoluto para o diretório raiz do projeto
        $rootPath = realpath(__DIR__ . '/../../..');
        
        // Obtendo o caminho relativo a partir do DOCUMENT_ROOT
        $relativePath = str_replace(realpath($_SERVER['DOCUMENT_ROOT']), '', realpath($rootPath . '/' . $target));
        
        return $relativePath;
    }

    // Caminhos
    $relativeRootPath = getRelativePath('');
    $relativeAssetsPath = getRelativePath('app/assets');
    $relativeServicesPath = getRelativePath('app/services');
    $relativePublicPath = getRelativePath('public');
    $relativeSupportPath = getRelativePath('public/suporte');