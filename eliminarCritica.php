<?php
    include("bd.php");
    $host  = $_SERVER['HTTP_HOST'];
    $extra =  ($_SERVER['HTTP_REFERER']);
    $idPelicula = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $idCritica = (int)$_POST['idCritica'];
        $idPelicula = (int)$_POST['idPelicula'];
        eliminarCritica($idCritica,$idPelicula);
    }

    header("Location: $extra?pelicula=$idPelicula ");
    exit;

?>