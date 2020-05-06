<?php
    include("bd.php");
    $host  = $_SERVER['HTTP_HOST'];
    $extra =  ($_SERVER['HTTP_REFERER']);
    $idPelicula = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $idPelicula = (int)$_POST['idPelicula'];
        $eliminar = (int)$_POST['eliminar'];
        if($eliminar == 1)
            deleteEvento($idPelicula);

    }

    header("Location: http://localhost/");
    exit;

?>