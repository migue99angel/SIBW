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
    if(is_int($idPelicula))
    {
        $res = $mysqli->query("SELECT nombre, director, fecha, review, enlace, portada FROM eventos WHERE idPelicula =" . $idPelicula);
        if($res->num_rows > 0)
        {
            $row = $res->fetch_assoc();
            $pelicula = $row['nombre'];
            $director = $row['director'];
            $fecha = $row['fecha'];
            $review = $row['review'];
            $enlace = $row['enlace'];
            $portada = $row['portada'];
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


        $res = $mysqli->query("SELECT nombre,comentario,fecha FROM comentarios WHERE idPelicula =" . $idPelicula);
        $i = 0;
        
        if($res->num_rows > 0)
        {
            while ($fila = $res->fetch_assoc()) {
                $comentarios[$i] = [ $fila['nombre'], $fila['comentario'],$fila['fecha'] ];
                $i = $i + 1;
            }
        }

        $res = $mysqli->query("SELECT palabra FROM censura");
        $i = 0;
        
        if($res->num_rows > 0)
        {
            while ($fila = $res->fetch_assoc()) {
                $ban[$i] = $fila['palabra'];
                $i = $i + 1;
            }
        }

        $res = $mysqli->query("SELECT fotoActor,nombreActor FROM actores WHERE idPelicula =" . $idPelicula);
        $i = 0;
        
        if($res->num_rows > 0)
        {
            while ($fila = $res->fetch_assoc()) {
                $actores[$i] = [ $fila['fotoActor'], $fila['nombreActor'] ];
                $i = $i + 1;
            }
        }else
            $actores = false;
    }


    $mysqli->close();

    $evento = array('idPelicula'=>$idPelicula, 'pelicula' => $pelicula, 'director' => $director, 'fecha' =>$fecha, 'review' => $review, 'enlace' => $enlace, 'premios' => $premios, 'criticas' => $criticas, 'escenas' => $escenas, 'portada' => $portada, 'comentarios' => $comentarios,'ban' => $ban,'actores'=>$actores);
    return $evento;

}

function newComent($idPelicula,$nombre,$correo,$comentario)
{
    $mysqli = conexionBD();

    if(is_int($idPelicula) && is_string($nombre) && is_string($correo) && is_string($comentario))
    {

        $res = $mysqli->query("SELECT idComentario FROM comentarios WHERE idPelicula =" . $idPelicula);


        if($res->num_rows > 0)
        {

            while ($fila = $res->fetch_assoc()) {
                $nComentario = $fila['idComentario'];
            }
        }

        $nComentario = $nComentario + 1;


        $fecha = date('Y-m-d'); 
        $res = $mysqli->query("INSERT INTO comentarios VALUES ('$idPelicula','$nComentario','$nombre','$comentario','$fecha')" ) ;

        $mysqli->close();

    }
}

function newUser($user, $pass, $email, $phone)
{
    $mysqli = conexionBD();

    if(is_string($user) && is_string($pass) && is_string($email) && is_int($phone))
    {
        //Con el auto_increment se pone el id correspondiente pero hay que poner algo en esa parte de la consulta para que no de error
        $res = $mysqli->query("INSERT INTO usuarios VALUES ('0','$user','$pass','$email','$phone','standard')" ) ;

    }

    $mysqli->close();
}


function checkLogin($user,$pass)
{
    $mysqli = conexionBD();
    $res = $mysqli->query("SELECT * FROM usuarios WHERE user ='$user'");
    echo "veamos si hay resultados";
    if($res->num_rows > 0)
    {
        echo "vamos a validar";
        $row = $res->fetch_assoc();
        var_dump($row['pass']);
        if (password_verify($pass, $row['pass'] ))
        {
            echo "bien";
            return true;
        }
        else
        {
            echo "mal";
            return false;
        }
    }

}


function cargarUsuario($user)
{
    $mysqli = conexionBD();
    $res = $mysqli->query("SELECT * FROM usuarios WHERE user ='$user'");
    $row = $res->fetch_assoc();
    $usuario = ['user' => $row['user'], 'email' => $row['email'], 'phone' => $row['phone'], 'rol' =>$row['rol']];
    
    return $usuario;

}


?>