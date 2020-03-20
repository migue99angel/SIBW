<?php

function conexionBD()
{
    $mysqli = new mysqli("mysql","miguelAngel","practicasSIBW","SIBW");
    if($mysqli->connect_errno)
    {
        echo("Fallo al conectar: ". $mysqli->connect_error);
    }

    return  $mysqli;
}

function cargarEvento($idPelicula)
{

    $mysqli = conexionBD();
    
    $res = $mysqli->query("SELECT nombre, director, fecha, review, enlace FROM eventos WHERE idPelicula =" . $idPelicula);
    if($res->num_rows > 0)
    {
        $row = $res->fetch_assoc();
        $pelicula = $row['nombre'];
        $director = $row['director'];
        $fecha = $row['fecha'];
        $review = $row['review'];
        $enlace = $row['enlace'];
    }

    $res = $mysqli->query("SELECT premio FROM premios WHERE idPelicula =" . $idPelicula);
    $i = 0;

    if($res->num_rows > 0)
    {
        /* obtener un array asociativo */
        while ($fila = $res->fetch_assoc()) {
        $premios[$i] = $fila['premio'];
        $i = $i + 1;
        }
    }


    $res = $mysqli->query("SELECT redactor,critica FROM criticas WHERE idPelicula =" . $idPelicula);
    $i = 0;
    
    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
        $criticas[$i] = [ $fila['redactor'], $fila['critica'] ];
        $i = $i + 1;
        }
    }

    $res = $mysqli->query("SELECT escena,descripcion FROM escenas WHERE idPelicula =" . $idPelicula);
    $i = 0;
    
    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
        $escenas[$i] = [ $fila['escena'], $fila['descripcion'] ];
        $i = $i + 1;
        }
    }

    /*$idRecomen = $mysqli->query("SELECT recomendada FROM recomendaciones WHERE idPelicula = '1' ");
    $res = $mysqli->query("SELECT portada, nombre FROM eventos WHERE idPelicula = '1' ");
    $i = 0;
    
    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
        $recomendaciones[$i] = [ $fila['portada'], $fila['nombre'] ];
        $i = $i + 1;
        }
    }*/

    $evento = array('pelicula' => $pelicula, 'director' => $director, 'fecha' =>$fecha, 'review' => $review, 'enlace' => $enlace, 'premios' => $premios, 'criticas' => $criticas, 'escenas' => $escenas);
    return $evento;

}






?>