<?php
    include("bd.php");
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
  

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $id = checkLogin($user, $pass);
        if ($id != -1) {
            session_start();

            $_SESSION['username'] = $user;
            $_SESSION['id'] = $id;
            

        }

        header("Location: index.php");
        
        exit();
    
    }else{
        echo $twig->render('index.html', []); 
    }

?>