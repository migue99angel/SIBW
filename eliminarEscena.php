<?php
    include("bd.php");
    $host  = $_SERVER['HTTP_HOST'];
    $extra =  ($_SERVER['HTTP_REFERER']);
    $idPelicula = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $idEscena = (int)$_POST['idEscena'];
        $idPelicula = (int)$_POST['idPelicula'];
        eliminarEscena($idEscena,$idPelicula);
    }

    header("Location: $extra?pelicula=$idPelicula ");
    exit;

?>