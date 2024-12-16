<?php
require_once 'conn.php';

// LOG IN AND OUT FUNCTIONS
function logIn($conn){
    if(isset($_POST['logar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){
        $email = mysqli_escape_string($conn,filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
        $senha = mysqli_escape_string($conn,md5($_POST['senha']));
        $query = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha' ";
        $execute = mysqli_query($conn,$query);
        $return = mysqli_fetch_assoc($execute);

        $remember = mysqli_escape_string($conn,$_POST['rememberMe']) ?? null;
        if($remember) {
            $expires = time() + (60 * 60 * 24 * 7);
            $salt = "*&conectamaes#@";
            $token_key = hash('md5', (time() . $salt));
            $token_value = hash('md5', ('remembered' . $salt));

            setcookie('remembered_cookie', $token_key . ':' . $token_value, $expires, '/'); // Cookie válido em todo o domínio

            $id = $return['idUsuario'];
            $rememberMeQuery = "UPDATE Usuario 
                                SET remember_token_key = '$token_key', 
                                    remember_token_value = '$token_value' 
                                WHERE idUsuario = '$id' LIMIT 1";
            mysqli_query($conn, $rememberMeQuery);
        }

        if(!empty($return['email'])){
            if(session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['idUsuario'] = $return['idUsuario'];
            $_SESSION['active'] = true;
            header("Location: home.php");
            exit();
        }
    }
}

function validateRememberedCookie($conn, $redirectPath) {
    if (isset($_COOKIE['remembered_cookie'])) {
        // Divide o cookie em chave e valor
        list($token_key, $token_value) = explode(':', $_COOKIE['remembered_cookie']);

        // Consulta o banco para validar os tokens
        $query = "SELECT * FROM Usuario WHERE remember_token_key = '$token_key' AND remember_token_value = '$token_value' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        // Se os tokens são válidos, autentica o usuário
        if (!empty($user)) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['idUsuario'] = $user['idUsuario'];
            $_SESSION['active'] = true;

            // Redireciona para o caminho fornecido
            header("Location:" . $redirectPath);
            exit();
        }
    }
}

function logInTest($conn){
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['idUsuario'] = 1;
    $_SESSION['active'] = true;

    require_once "paths.php";
    header("Location: public/home.php");
    exit();
}

function logOut($conn) {
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_COOKIE['remembered_cookie'])) {
        setcookie('remembered_cookie', '', time() - 3600, '/'); // Expira o cookie imediatamente
    }

    if(isset($_SESSION['idUsuario'])) {
        $id = $_SESSION['idUsuario'];
        $clearTokenQuery = "UPDATE Usuario 
                            SET remember_token_key = NULL, 
                                remember_token_value = NULL 
                            WHERE idUsuario = '$id' LIMIT 1";
        mysqli_query($conn, $clearTokenQuery);
    }

    session_unset();
    session_destroy();

    require_once "paths.php";
    header("Location:" . $relativePublicPath . "/login.php");
    exit(); 
}
