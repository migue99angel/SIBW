<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  if($_GET['x'] == 1){
    $pelicula = 'Película por defecto';
    $director = 'Director por defecto';
    $fecha = 'Fecha por defecto'; 
    $review = 'Review por defecto';
    $enlace = 'https://www.google.es/';
    $premios[0] = 'Premio 1';
    $premios[1] = 'Premio 2';
    $premios[2] = 'Premio 3';
    $criticas[0] = ['Nombre','Comentario por defecto'];
    $criticas[1] = ['Nombre','Comentario por defecto'];
    $escenas[0] = ['img/escena1.jpg','Pie de foto por defecto'];
    $escenas[1] = ['img/escena1.jpg','Pie de foto por defecto'];
    $recomendaciones[0] = ['img/dark.jpg','Recomendación por defecto'];
    $recomendaciones[1] = ['img/dark.jpg','Recomendación por defecto'];
  }else{
    $pelicula = 'Pulp fiction';
    $director = 'Quentin Tarantino';
    $fecha = '14/10/1994'; 
    $review = 'Jules y Vincent, dos asesinos a sueldo con no demasiadas luces,
              trabajan para el gángster Marsellus Wallace. Vincent le confiesa a Jules que
              Marsellus le ha pedido que cuide de Mia, su atractiva mujer. Jules le recomienda prudencia 
              porque es muy peligroso sobrepasarse con la novia del jefe. Cuando llega la hora de trabajar
              ,ambos deben ponerse "manos a la obra". Su misión: recuperar un misterioso maletín.';
    $enlace =  'https://www.filmaffinity.com/es/film160882.html';
    $premios[0] = '1994: Oscar: Mejor guión original. 7 nominaciones, incluyendo Mejor película';
    $premios[1] = '1994: Globo de Oro: Mejor guión. 6 nominaciones';
    $premios[2] = '1994: Festival de Cannes: Palma de Oro';       
    $premios[3] = '1994: 2 Premios BAFTA: Mejor actor sec. (Samuel L. Jackson) y guión. 9 nom.';
    $premios[4] = '1994: Premios Cesar: Nominada a Mejor película extranjera';
    $premios[5] = '1994: Premios David di Donatello: Mejor film y actor extranjero (Travolta). 3 nom.';
    $criticas[0] = ['Emilio García','Sin lugar a dudas, la mejor película de Quentin Tarantino. La mezcla entre humor negro, y la violencia característica de este director, forman un trabajo excepcional. Debo recalcar que esta inusual forma de contar una historia (no lineal), hace que se vuelva muy dinámica y entretenida, sin caer en lo absurdo. Es una de las mejores películas de la historia, ya que fue un hito en la cultura popular y significó gran inspiración para el cine de Hollywood y el resto del mundo.'];
    $criticas[1] = ['Maria Martín','La película tiene toques de humor bastante bien elaborados, los diálogos son bien presentados y en ningún momento tiene escenas lentas o aburridas, la historia tiene un ritmo bastante bueno y en general hacen un estupendo trabajo al formarla, más que la acción la película nos cuenta una verdadera historia con partes que hacen sentir intrigados y con ganas de ver más, una obra maestra.'];  
    $escenas[0] = ['img/escena1.jpg','Escena de John Travolta y Samuel L Jackson'];
    $escenas[1] = ['img/escena2.png','Famosa escena de baile entre John Travolta y Uma Thurman'];
    $recomendaciones[0] = ['img/unodelosnuestros.jpg','Goodfellas'];
    $recomendaciones[1] = ['img/padrino.jpg','El padrino'];
  }

  
  echo $twig->render('evento.html', ['pelicula' => $pelicula, 'director'=>$director ,'fecha' => $fecha, 'review' => $review, 'enlace' => $enlace, 'premios' => $premios,'criticas' => $criticas,'escenas' => $escenas, 'recomendaciones' => $recomendaciones]);
?>