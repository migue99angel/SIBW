<?php
    include("bd.php");
    $host  = $_SERVER['HTTP_HOST'];
    $extra =  ($_SERVER['HTTP_REFERER']);
    $idPelicula = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $idComentario = (int)$_POST['idComentario'];
        $idPelicula = (int)$_POST['idPelicula'];
        eliminarComentario($idComentario,$idPelicula);
    }

    header("Location: $extra?pelicula=$idPelicula ");
    exit;

?>