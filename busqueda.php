<?php
  include("bd.php");

  session_start();
  header('Content-Type: application/json');
  
  $eventos = buscarEventoPorPalabra(htmlspecialchars($_GET['consulta']),$_SESSION['id']);
  
  echo(json_encode($eventos));
  return json_encode($eventos);
?>