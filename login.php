<?php
    include("bd.php");

  

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $id = -1;
        $id = checkLogin($user, $pass);
        if ($id != -1) {
            session_start();

            $_SESSION['username'] = $user;
            $_SESSION['id'] = $id;

            header("Location: index.php");
        
            exit();

        }
        else
        {
            $error = 2;
            header("Location: http://localhost/?error=$error");
            exit;
        }



    
    }

?>