<?php
  include("bd.php");
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();
  $host  = $_SERVER['HTTP_HOST'];
  $extra =  ($_SERVER['HTTP_REFERER']);
  $variables = [];
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    $id = (int)$_POST['idPelicula'];
    $visibilidad = $_POST['visibilidad'];
    cambiarVisibilidadEvento($id,$visibilidad);
    header("Location: $extra?pelicula=$idPelicula ");
    exit;
  }

  if(isset($_SESSION['username']))
  {
    $variables['usuario'] = cargarUsuario($_SESSION['username']);
  }

  $variables['eventos'] = cargarEventos($_SESSION['id']);
  
  echo $twig->render('lista_eventos.html', $variables);
?>