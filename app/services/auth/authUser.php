<?php
    include_once(__DIR__ .'/../helpers/conn.php');

    // LOG IN FUNCTION
    function logIn($conn){
        if(isset($_POST['logar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $senha = md5($_POST['senha']);
            $query = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha' ";
            $execute = mysqli_query($conn, $query);
            $return = mysqli_fetch_assoc($execute);

            if(!empty($return['email'])){
                if(session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['idUsuario'] = $return['idUsuario'];
                $_SESSION['active'] = true;
                include_once("../helpers/paths.php");
                header("Location: " . $relativePublicPath . "/home.php");
                exit(); // Adicione exit() após o redirecionamento para garantir que o script seja interrompido
            } else {
                echo "Usuário ou senha não encontrados!";
            }
        }
    }

    // LOG OUT FUNCTION
    function logOut() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        include_once("../helpers/paths.php");
        header("Location: " . $relativePublicPath . "/login.php");
        exit(); // Adicione exit() após o redirecionamento para garantir que o script seja interrompido
    }

    // DESTROY SESSION FUNCTION
    function destroySession() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        include_once("../helpers/paths.php");
        header("Location: " . $relativeRootPath . "/index.php");
        exit(); // Adicione exit() após o redirecionamento para garantir que o script seja interrompido
    }
?>
