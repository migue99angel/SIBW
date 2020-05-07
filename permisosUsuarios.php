<?php
  include("bd.php");
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();
  $variables = [];

  $idPelicula = 0;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    $idUsuario = (int)$_POST['idUsuario'];
    $newRol = $_POST['newRol'];
    actualizarPermisosUsuario($idUsuario,$newRol);
  }

  if(isset($_SESSION['username']))
  {
    $variables['usuario'] = cargarUsuario($_SESSION['username']);
  }

  $variables['usuarios'] = cargarListaUsuarios();

  
  echo $twig->render('permisos_usuarios.html', $variables);
?>