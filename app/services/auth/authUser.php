<?php
    include_once(__DIR__ .'/../helpers/conn.php');

    // LOG IN AND OUT FUNCTIONS
    function logIn($conn){
        if(isset($_POST['logar']) AND !empty($_POST['email']) AND !empty($_POST['senha'])){
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $senha = md5($_POST['senha']);
            $query = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha' ";
            $execute = mysqli_query($conn,$query);
            $return = mysqli_fetch_assoc($execute);

            if(!empty($return['email'])){
                session_start();
                $_SESSION['idUsuario'] = $return['idUsuario'];
                $_SESSION['active'] = true;
                header('Location: home.php');
                exit();
            }else{
                echo "Usuário ou senha não encontrados!";
            }
        }
    }
    
    function logOut() {
        session_start();
        session_unset();
        session_destroy();
    
        // Caminho relativo ao arquivo login.php na pasta public
        include_once "../helpers/paths.php";
        
        header("Location:" . $relativePublicPath ."/login.php");
        exit();
    }