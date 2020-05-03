<?php
    include("bd.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $newUserName = $_POST['username'];
        $newMail = $_POST['email'];
        $newPhoneNumber = $_POST['phone_number'];
        actualizarUsuario($_SESSION['id'],$newUserName,$newMail,$newPhoneNumber);
    }

    header("Location: http://localhost/");
    exit;

?>