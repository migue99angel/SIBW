<?php
    include("bd.php");

    if($_POST['password'] == $_POST['confirm_password'])
    {
        $pass = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $user = $_POST['username'];
        $email = $_POST['email'];
        $phone = (int)$_POST['phone_number'];
        newUser($user,$pass,$email,$phone);


    }
    header("Location: http://localhost/");
    exit;

?>