<?php
  include("bd.php");
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();
  $variables = [];

  if(isset($_SESSION['username']))
  {
    $variables['usuario'] = cargarUsuario($_SESSION['username']);
  }

  $variables['comentarios'] = cargarComentarios();
  
  echo $twig->render('moderar_comentarios.html', $variables);
?>