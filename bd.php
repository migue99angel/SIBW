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


        $res = $mysqli->query("SELECT  idComentario,nombre,comentario,fecha,moderado FROM comentarios WHERE idPelicula =" . $idPelicula);
        
        $i = 0;
        
        if($res->num_rows > 0)
        {
            while ($fila = $res->fetch_assoc()) {
                $comentarios[$i] = [ $fila['idComentario'], $fila['nombre'], $fila['comentario'],$fila['fecha'],$fila['moderado']];
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

function newComent($idPelicula,$idUsuario,$nombre,$comentario)
{
    

    if(is_int($idPelicula) && is_string($nombre) && is_int($idUsuario) && is_string($comentario))
    {
        $mysqli = conexionBD();
        $fecha = date('Y-m-d'); 
        $res = $mysqli->query("SELECT idComentario FROM comentarios WHERE idPelicula =" . $idPelicula);


        if($res->num_rows > 0)
        {

            while ($fila = $res->fetch_assoc()) {
                $nComentario = $fila['idComentario'];
            }
        }

        $nComentario = $nComentario + 1;

        $res = $mysqli->query("INSERT INTO comentarios (idPelicula,idComentario,idUsuario,nombre,comentario,fecha,moderado) VALUES ('$idPelicula','$nComentario','$idUsuario','$nombre','$comentario','$fecha',0)" ) ;

        $mysqli->close();

    }
}

function newUser($user, $pass, $email, $phone)
{
    $mysqli = conexionBD();

    if(is_string($user) && is_string($pass) && is_string($email) && is_int($phone))
    {
        $res = $mysqli->query("INSERT INTO usuarios (user,pass,email,phone,rol) VALUES ('$user','$pass','$email','$phone','standard')" ) ;
    }

    $mysqli->close();
}


    function checkLogin($user,$pass)
    {
        $mysqli = conexionBD();
        $res = $mysqli->query("SELECT * FROM usuarios WHERE user ='$user'");
        if($res->num_rows > 0)
        {

            $row = $res->fetch_assoc();
            $id = -1;
            if (password_verify($pass,$row['pass']))
            {
                $id = $row['idUsuario'];
                return $id;
            }
            else
            {
                return $id;
            }
        }

    }


function cargarUsuario($user)
{
    $mysqli = conexionBD();
    $res = $mysqli->query("SELECT * FROM usuarios WHERE user ='$user'");
    $row = $res->fetch_assoc();
    $usuario = ['id' => $row['idUsuario'],'user' => $row['user'], 'email' => $row['email'], 'phone' => $row['phone'], 'rol' =>$row['rol']];
    $mysqli->close();

    return $usuario;

}

function actualizarUsuario($id,$username,$email,$phone)
{
    $mysqli = conexionBD();
    $res = $mysqli->query("UPDATE usuarios SET user='$username', email='$email', phone='$phone' WHERE idUsuario='$id'");
    $mysqli->close();
}

function eliminarComentario($idComen, $idEvento)
{
    if(is_int($idComen) && is_int($idEvento))
    {
        $mysqli = conexionBD();
        $res = $mysqli->query("DELETE from comentarios WHERE idComentario='$idComen'AND idPelicula='$idEvento'");
        $mysqli->close();

    }
}

function updateComent($idPelicula,$idUsuario,$comentario)
{
    if(is_int($idPelicula) && is_int($idUsuario) && is_string($comentario))
    {
        $mysqli = conexionBD();
        $res = $mysqli->query("UPDATE comentarios SET  comentario='$comentario', moderado=1 WHERE idPelicula='$idPelicula' AND idComentario='$idUsuario'");
        $mysqli->close();
    }
}

function cargarComentarios()
{
    $mysqli = conexionBD();
    $res = $mysqli->query("SELECT  idComentario,idPelicula,nombre,comentario,fecha,moderado FROM comentarios");
        
    $i = 0;
    
    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
            $comentarios[$i] = [ $fila['idComentario'], $fila['nombre'], $fila['comentario'],$fila['fecha'],$fila['moderado'], $fila['idPelicula']];
            $i = $i + 1;
        }
    }
    echo "Hola Buenas tardes";
    $mysqli->close();
    return $comentarios;
}


?>