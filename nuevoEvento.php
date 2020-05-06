<?php
  include("bd.php");
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();
  $variables = [];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['name']) && isset($_POST['director']) && isset($_POST['fecha']) && isset($_POST['review']) && isset($_POST['enlace']) && isset($_FILES['portada']))
    {
        $errors= array();
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
        
        if (sizeof($errors) > 0) {
            $varsParaTwig['errores'] = $errors;
        }

        $id = -1;
        $id = addEvento($_POST['name'],$_POST['director'],$_POST['fecha'],$_POST['review'],$_POST['enlace'],$portada);

        if(isset($_POST['premio']) && is_string($_POST['premio']))
        {
          addPremio($id,$_POST['premio']);
        }


        if(isset($_POST['nombreCritico']) && is_string($_POST['critica']))
        {
          addCritica($id,$_POST['nombreCritico'],$_POST['critica']);
        }

        if(isset($_FILES['escena']) && isset($_POST['pieEscena']))
        { 
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
          
          if (sizeof($errors) > 0) {
              $varsParaTwig['errores'] = $errors;
          }

          addEscena($id,$escena,$_POST['pieEscena']);
      }

    }

  }



  if(isset($_SESSION['username']))
  {
    $variables['usuario'] = cargarUsuario($_SESSION['username']);
  }


  
  echo $twig->render('nuevo_evento.html', $variables);
?>