<?php
    include("bd.php");
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];


    if (checkLogin($user, $pass)) {
        session_start();
        
        $_SESSION['username'] = $user; 

    }

    header("Location: index.php");
    
    exit();
    
    }else{
        echo $twig->render('index.html', []); 
    }

?>