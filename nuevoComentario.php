<?php
    include("bd.php");

    $idPelicula = (int)$_POST['pelicula'];
    $name = $_POST['name'];
    $idUsuario =(int) $_POST['idUsuario'];
    $comentario = $_POST['comentario'];
    newComent($idPelicula,$idUsuario,$name,$comentario );
    /* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
    $host  = $_SERVER['HTTP_HOST'];
    $extra = 'evento.php';
    
    header("Location: http://localhost/$extra?pelicula=$idPelicula ");
    exit;

?>