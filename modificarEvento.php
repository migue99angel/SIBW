<?php
    include("bd.php");
    $host  = $_SERVER['HTTP_HOST'];
    $extra =  ($_SERVER['HTTP_REFERER']);
    $idPelicula = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        session_start();
        $idPelicula = (int)$_POST['idPelicula'];
        $eliminar = (int)$_POST['eliminar'];
        if($eliminar == 1)
            deleteEvento($idPelicula);
        else
        {
            if($eliminar == 0)
            {
                if(isset($_POST['name']) && isset($_POST['director']) && isset($_POST['fecha']) && isset($_POST['review']) && isset($_POST['enlace']))
                {
                    actualizarDatosEvento($_POST['name'],$_POST['director'],$_POST['fecha'],$_POST['review'],$_POST['enlace'],$idPelicula);
                }

                if(isset($_POST['premio']) && strlen($_POST['premio']) > 0)
                {
                    addPremio($idPelicula,$_POST['premio']);
                }

                if(isset($_POST['critica']) && isset($_POST['nombreCritico']) && strlen($_POST['critica']) > 0  && strlen($_POST['nombreCritico']) > 0)
                {
                    addCritica($idPelicula,$_POST['nombreCritico'],$_POST['critica']);
                }

                if(isset($_FILES['escena']) && isset($_POST['pieEscena']))
                { 
                    $errors = [];
                    $file_name = $_FILES['escena']['name'];
                    $file_size = $_FILES['escena']['size'];
                    $file_tmp = $_FILES['escena']['tmp_name'];
                    $file_type = $_FILES['escena']['type'];
                    $file_ext = strtolower(end(explode('.',$_FILES['escena']['name'])));
                    
                    $extensions= array("jpeg","jpg","png");
         
                  if (in_array($file_ext,$extensions) === false){
                    $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
                  }
        
                  if ($file_size > 2097152){
                      $errors[] = 'Tamaño del fichero demasiado grande';
                  }
                  
                  if (empty($errors)==true) {
                      move_uploaded_file($file_tmp, "imagenesSubidas/" . $file_name);
                      
                      $escena = "imagenesSubidas/" . $file_name;
                  }
                  
                  if (sizeof($errors) == 0) {
                    addEscena($idPelicula,$escena,$_POST['pieEscena']);
                  }
        
                  
              }

              if(isset($_FILES['portada']))
              { 
                  $errors = [];
                  $file_name = $_FILES['portada']['name'];
                  $file_size = $_FILES['portada']['size'];
                  $file_tmp = $_FILES['portada']['tmp_name'];
                  $file_type = $_FILES['portada']['type'];
                  $file_ext = strtolower(end(explode('.',$_FILES['portada']['name'])));
                  
                  $extensions= array("jpeg","jpg","png");
       
                if (in_array($file_ext,$extensions) === false){
                  $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
                }
      
                if ($file_size > 2097152){
                    $errors[] = 'Tamaño del fichero demasiado grande';
                }
                
                if (empty($errors)==true) {
                    move_uploaded_file($file_tmp, "imagenesSubidas/" . $file_name);
                    
                    $portada = "imagenesSubidas/" . $file_name;
                }
                
                if (sizeof($errors) == 0) {
                    actualizarPortada($idPelicula,$portada);
                }
      
                
            }
            }
        }

    }

    header("Location: $extra?pelicula=$idPelicula ");
    exit;

?>