<?php
    include("bd.php");

    $idPelicula = (int)$_POST['idPelicula'];
    $idUsuario =(int) $_POST['idComentario'];
    $comentario = $_POST['contenido'];


    updateComent($idPelicula,$idUsuario,$comentario);

    /* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
    $host  = $_SERVER['HTTP_HOST'];
    $extra = 'evento.php';
    
    header("Location: $extra?pelicula=$idPelicula ");
    exit;

?>