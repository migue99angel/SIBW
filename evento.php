<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  if(isset($_GET['pelicula']))
  {
    $idPelicula = (int) $_GET['pelicula'];
  }
  else
  {
    $idPelicula = 1;
  }

  session_start();
  $usuario = [];

  if(isset($_SESSION['username']))
  {
    $usuario = cargarUsuario($_SESSION['username']);
  }


  $evento = cargarEvento($idPelicula);

  echo $twig->render('evento.html', ['evento' => $evento, 'usuario' => $usuario]);
?>