<?php
    $hostname = '162.240.17.101';
    $username = 'projetos_nlessa';
    $password = 'Gc&sgY74PK$}';
    $database = 'projetos_INF2023_G10';

    $conn = mysqli_connect($hostname, $username, $password, $database);

    // LOG IN AND OUT FUNCTIONS
    function logIn($conn)
    {
        if(isset($_POST['logar']) AND !empty($_POST['email']) AND !empty($_POST['senha']))
        {
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $senha = md5($_POST['senha']);

            $query = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha' ";

            $execute = mysqli_query($conn,$query);

            $return = mysqli_fetch_assoc($execute);

            if(!empty($return['email']))
            {
                session_start();
                $_SESSION['idUsuario'] = $return['idUsuario'];
                $_SESSION['active'] = true;
                header('Location: home.php');
            }
            else
            {
                echo "Usuário ou senha não encontrados!";
            }
        }
    }

    function logInFromRegister($conn)
    {
        $email = filter_input(INPUT_POST, "emailRegistro", FILTER_VALIDATE_EMAIL);
        $senha = md5($_POST['senhaRegistro']);

        $query = "SELECT * FROM Usuario WHERE email = '$email' AND senha = '$senha' ";

        $execute = mysqli_query($conn,$query);

        $return = mysqli_fetch_assoc($execute);

        if(!empty($return['email']))
        {
            session_start();
            $_SESSION['idUsuario'] = $return['idUsuario'];
            $_SESSION['active'] = true;
            echo '<script">'.'window.location.href="home.php";'.'</script>';
            exit();
        }
    }

    function logOut()
    {
        session_start();
        session_unset();
        session_destroy();

        header("Location: /ConectaMaesProject/public/login.php");
    }