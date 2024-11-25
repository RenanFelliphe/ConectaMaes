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
    $currentUserData = queryUserData($conn, "Usuario", $_SESSION['idUsuario']);  

    include_once __DIR__ . "/../../app/services/crud/postFunctions.php";
    $publicacoes = queryPostsAndUserData($conn, '', null, 10, 0);
?>