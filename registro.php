<?php
    include("bd.php");
    $error = 0;
    if($_POST['password'] == $_POST['confirm_password'])
    {
        $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $user = $_POST['username'];
        $email = $_POST['email'];
        $phone = (int)$_POST['phone_number'];
        newUser($user,$pass,$email,$phone);

    }
    else
    {
        $error = 1;
    }
    header("Location: http://localhost/?error=$error");
    exit;

?>