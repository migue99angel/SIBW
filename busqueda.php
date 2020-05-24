<?php
  include("bd.php");

  session_start();
  header('Content-Type: application/json');
  
  $eventos = buscarEventoPorPalabra(htmlspecialchars($_GET['consulta']));
  
  echo(json_encode($eventos));
  return json_encode($eventos);
?>