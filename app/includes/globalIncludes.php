<?php 
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once __DIR__ . "/../../app/services/helpers/paths.php";
    $verify = isset($_SESSION['active']) ? true : header("Location:".$relativePublicPath."/login.php");

    include_once __DIR__ . "/../../app/services/crud/childFunctions.php";
    include_once __DIR__ . "/../../app/services/helpers/dateChecker.php";
    include_once __DIR__ . "/../../app/services/helpers/authUser.php";
    include_once __DIR__ . "/../../app/services/crud/userFunctions.php"; 
    $currentUserData = queryUserData($conn, $_SESSION['idUsuario']);  

    include_once __DIR__ . "/../../app/services/crud/postFunctions.php";
    date_default_timezone_set('America/Sao_Paulo');    
?>