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

        $res = $mysqli->query("SELECT idPremio,premio FROM premios WHERE idPelicula =" . $idPelicula);
        $i = 0;

        if($res->num_rows > 0)
        {
            /* obtener un array asociativo */
            while ($fila = $res->fetch_assoc()) {
                $premios[$i] = [$fila['premio'],$fila['idPremio']];
                $i = $i + 1;
            }
        }

        $res = $mysqli->query("SELECT idCritica,redactor,critica FROM criticas WHERE idPelicula =" . $idPelicula);
        $i = 0;
        
        if($res->num_rows > 0)
        {
            while ($fila = $res->fetch_assoc()) {
                $criticas[$i] = [ $fila['redactor'], $fila['critica'],$fila['idCritica'] ];
                $i = $i + 1;
            }
        }

        $res = $mysqli->query("SELECT idEscena,escena,descripcion FROM escenas WHERE idPelicula =" . $idPelicula);
        $i = 0;
        
        if($res->num_rows > 0)
        {
            while ($fila = $res->fetch_assoc()) {
                $escenas[$i] = [ $fila['escena'], $fila['descripcion'],$fila['idEscena'] ];
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

        $res = $mysqli->query("SELECT etiqueta FROM etiquetas WHERE idPelicula = " . $idPelicula);
        $i = 0;
        
        if($res->num_rows > 0)
        {
            while ($fila = $res->fetch_assoc()) {
                $etiquetas[$i] = $fila['etiqueta'];
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

    $evento = array('idPelicula'=>$idPelicula, 'pelicula' => $pelicula, 'director' => $director, 'fecha' =>$fecha, 'review' => $review, 'enlace' => $enlace, 'premios' => $premios, 'criticas' => $criticas, 'escenas' => $escenas, 'portada' => $portada, 'comentarios' => $comentarios,'ban' => $ban,'actores'=>$actores, 'etiquetas'=>$etiquetas);
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

    $mysqli->close();
    return $comentarios;
}

function cargarEventos()
{
    $mysqli = conexionBD();
    $res = $mysqli->query("SELECT idPelicula,nombre,portada FROM eventos");
        
    $i = 0;
    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
            $eventos[$i] = [$fila['idPelicula'], $fila['nombre'], $fila['portada']];
            $i = $i + 1;
        }
    }
    $mysqli->close();
    return $eventos;
}

function addEvento($name, $director, $fecha, $review, $enlace, $portada)
{
    $mysqli = conexionBD();
    $name = $mysqli->real_escape_string($name);
    $director = $mysqli->real_escape_string($director);
    $fecha = $mysqli->real_escape_string($fecha);
    $review = $mysqli->real_escape_string($review);
    $enlace = $mysqli->real_escape_string($enlace);
    $portada = $mysqli->real_escape_string($portada);

    $res = $mysqli->query("INSERT INTO eventos (nombre,director,fecha,review,portada,enlace) VALUES ('$name','$director','$fecha','$review','$portada','$enlace')" ) ;

    $con = $mysqli->query("SELECT idPelicula FROM eventos WHERE nombre='$name' AND director='$director'");
    
    $id = -1;

    if($con->num_rows > 0)
    {
        $result = $con->fetch_assoc();
        $id = (int)$result['idPelicula'];
    }

    $mysqli->close();    

    return  $id;
}

function addPremio($idPelicula,$premio)
{
    $mysqli = conexionBD();
    $premio = $mysqli->real_escape_string($premio); 
    $idPelicula = (int) $idPelicula;

    $res = $mysqli->query("SELECT  * FROM premios WHERE idPelicula =" . $idPelicula);

    $idPremio = $res->num_rows+1;

    $res = $mysqli->query("INSERT INTO premios (idPelicula,idPremio,premio) VALUES ('$idPelicula','$idPremio','$premio')" ) ;
}

function addCritica($idPelicula, $nombreCritico, $critica)
{
    $mysqli = conexionBD();
    $nombreCritico = $mysqli->real_escape_string($nombreCritico); 
    $critica = $mysqli->real_escape_string($critica); 
    $idPelicula = (int) $idPelicula; 

    $res = $mysqli->query("SELECT  * FROM criticas WHERE idPelicula =" . $idPelicula);
    
    $idCritica = $res->num_rows+ 1;

    $res = $mysqli->query("INSERT INTO criticas (idPelicula,idCritica,redactor,critica) VALUES ('$idPelicula','$idCritica','$nombreCritico','$critica')" ) ;
}

function addEscena($idPelicula, $escena, $descripcion)
{
    $mysqli = conexionBD();
    $escena = $mysqli->real_escape_string($escena); 
    $descripcion = $mysqli->real_escape_string($descripcion); 
    $idPelicula = (int) $idPelicula;   

    $res = $mysqli->query("SELECT  * FROM escenas WHERE idPelicula =" . $idPelicula);
    $idEscena = $res->num_rows +2;

    $res = $mysqli->query("INSERT INTO escenas (idPelicula,idEscena,escena,descripcion) VALUES ('$idPelicula','$idEscena','$escena','$descripcion')" ) ;
    $mysqli->close(); 
}

function deleteEvento($idPelicula)
{
    $mysqli = conexionBD();

    $res = $mysqli->query("DELETE FROM eventos WHERE idPelicula =" . $idPelicula);
    $res = $mysqli->query("DELETE FROM premios WHERE idPelicula =" . $idPelicula);
    $res = $mysqli->query("DELETE FROM criticas WHERE idPelicula =" . $idPelicula);
    $res = $mysqli->query("DELETE FROM eventos WHERE idPelicula =" . $idPelicula);

}

function actualizarDatosEvento($name, $director, $fecha, $review, $enlace,$idPelicula)
{
    $mysqli = conexionBD();
    $name = $mysqli->real_escape_string($name);
    $director = $mysqli->real_escape_string($director);
    $fecha = $mysqli->real_escape_string($fecha);
    $review = $mysqli->real_escape_string($review);
    $enlace = $mysqli->real_escape_string($enlace);

    $res = $mysqli->query("UPDATE eventos SET  nombre='$name', director='$director',fecha='$fecha',review='$review', enlace='$enlace' WHERE idPelicula='$idPelicula' ");
    $mysqli->close();
}

function actualizarPortada($idPelicula,$portada)
{
    $mysqli = conexionBD();
    $portada = $mysqli->real_escape_string($portada);
    $res = $mysqli->query("UPDATE eventos SET  portada='$portada' WHERE idPelicula='$idPelicula' ");
    $mysqli->close();


}

function eliminarEscena($idEscena,$idPelicula)
{
    if(is_int($idEscena) && is_int($idPelicula))
    {
        $mysqli = conexionBD();
        $res = $mysqli->query("DELETE from escenas WHERE idEscena='$idEscena'AND idPelicula='$idPelicula'");
        $mysqli->close();

    }
}

function eliminarCritica($idCritica,$idPelicula)
{
    if(is_int($idCritica) && is_int($idPelicula))
    {
        $mysqli = conexionBD();
        $res = $mysqli->query("DELETE from criticas WHERE idCritica='$idCritica'AND idPelicula='$idPelicula'");
        $mysqli->close();

    }
}

function eliminarPremio($idPremio,$idPelicula)
{
    if(is_int($idPremio) && is_int($idPelicula))
    {
        $mysqli = conexionBD();
        $res = $mysqli->query("DELETE from premios WHERE idPremio='$idPremio'AND idPelicula='$idPelicula'");
        $mysqli->close();

    }
}

function cargarListaUsuarios()
{
    $mysqli = conexionBD();
    $res = $mysqli->query("SELECT * FROM usuarios");
          
    $i = 0;
    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
            $usuarios[$i] = ['id' => $fila['idUsuario'],'user' => $fila['user'], 'email' => $fila['email'], 'phone' => $fila['phone'], 'rol' =>$fila['rol']];
            $i = $i + 1;
        }
    }

    $mysqli->close();
    return $usuarios;
}

function actualizarPermisosUsuario($idUsuario, $newRol)
{
    $mysqli = conexionBD();
    $newRol = $mysqli->real_escape_string($newRol);
    $res = $mysqli->query("UPDATE usuarios SET  rol='$newRol' WHERE idUsuario='$idUsuario' ");
    $mysqli->close();
}

function addEtiqueta($idPelicula,$newTag)
{
    $mysqli = conexionBD();
    $newTag = $mysqli->real_escape_string($newTag); 
    $idPelicula = (int) $idPelicula;
    $res = $mysqli->query("INSERT INTO etiquetas (idPelicula,etiqueta) VALUES ('$idPelicula','$newTag')" ) ;
    $mysqli->close();
}

function buscarEventoPorPalabra($busqueda)
{
    $mysqli = conexionBD();
    $busqueda = $mysqli->real_escape_string($busqueda); 
    $res = $mysqli->query("SELECT * from eventos WHERE review LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR director LIKE '%$busqueda%'" ) ;
    $i = 0;

    $eventos = [];

    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
            $eventos[$i] = [$fila['idPelicula'], $fila['nombre'], $fila['portada']];
            $i = $i + 1;
        }
    }

    $mysqli->close();
    return $eventos;

}

function buscarComentarioPorPalabra($busqueda)
{
    $mysqli = conexionBD();
    $busqueda = $mysqli->real_escape_string($busqueda); 

    $res = $mysqli->query("SELECT  idComentario,idPelicula,nombre,comentario,fecha,moderado FROM comentarios WHERE comentario LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%'");
        
    $i = 0;
    
    if($res->num_rows > 0)
    {
        while ($fila = $res->fetch_assoc()) {
            $comentarios[$i] = [ $fila['idComentario'], $fila['nombre'], $fila['comentario'],$fila['fecha'],$fila['moderado'], $fila['idPelicula']];
            $i = $i + 1;
        }
    }

    $mysqli->close();
    return $comentarios;
}

?>