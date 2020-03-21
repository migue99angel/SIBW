<?php
    include("bd.php");

    $idPelicula = (int)$_POST['pelicula'];
    $nombre = $_POST['name'];
    $correo = $_POST['email'];
    $comentario = $_POST['comentario'];

    newComent($idPelicula,$nombre,$correo,$comentario );
    /* Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición */
    $host  = $_SERVER['HTTP_HOST'];
    $extra = 'evento.php';
    header("Location: http://localhost/$extra?pelicula=$idPelicula ");
    exit;

?>