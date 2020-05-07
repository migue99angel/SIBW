<?php
    include("bd.php");
    $host  = $_SERVER['HTTP_HOST'];
    $extra =  ($_SERVER['HTTP_REFERER']);
    $idPelicula = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $idPremio = (int)$_POST['idPremio'];
        $idPelicula = (int)$_POST['idPelicula'];
        eliminarPremio($idPremio,$idPelicula);
    }

    header("Location: $extra?pelicula=$idPelicula ");
    exit;

?>