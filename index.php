<?php
  include("bd.php");
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();
  $variables = [];
  $busqueda = false;
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    if(isset($_POST['consulta']) && $_POST['consulta'] != "")
    {
      $variables['eventos'] = buscarEventoPorPalabra($_POST['consulta']);
      $busqueda = true;
    }else
    {
      $busqueda = false;
    }
  }

  if(isset($_GET['error']))
  {
    $variables['error'] = (int) $_GET['error'];
  }

  if(isset($_SESSION['username']))
  {
    $variables['usuario'] = cargarUsuario($_SESSION['username']);
  }

  if($busqueda == false)
  {
    $variables['eventos'] = cargarEventos();
  }
    

  
  echo $twig->render('index.html', $variables);
?>