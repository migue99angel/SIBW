<?php
    include("bd.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $idComentario = $_POST['username'];
        $idPelicula = $_POST['email'];

        eliminarComentario($idComentario,$idPelicula);
    }

    header("Location: evento.php");
    exit;

?>