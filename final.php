<!DOCTYPE html>
 
<html lang="es">
 
<head>
<title>Fractales</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- On line 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
-->
<!-- local -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

<link rel="stylesheet" href="css/estilos.css"  >


</head>
<?php
$datos = array( 1294.3,
                1294.2,
                1294.1,
                1293.8,
                1293.7,
                1293.7,
                1293.8,
                1293.7,
                1293.5,
                1293.3,
                1293,
                1292.7,
                1292.4,
                1291.9,
                1291.7,
                1291.9,
                1292.3,
                1292.6,
                1293.4,
                1294.8,
                1296.2,
                1296.5,
                1296.1,
                1295,
                1294.2,
                1293.6,
                1293.4,
                1293.2,
                1292.6,
                1292.4,
                1293.1,
                1294.1,
                1294.8,
                1294.5,
                1293.9,
                1293.7,
                1293.6,
                1293.8,
                1293.8,
                1293.8,
                1293.9,
                1293.9,
                1294,
                1293.7,
                1293.3,
                1293,
                1293,
                1293,
                1293.4,
                1293.7,
                1294.2,
                1294.3,
                1294.5,
                1294.9,
                1295.2,
                1295.4,
                1295.4,
                1295.2,
                1294.9,
                1294.4,
                1294.1,
                1293.9,
                1294.1,
                1294.8,
                1295.6,
                1295,
                1294.1,
                1292.8,
                1292.4,
                1292.2,
                1292.5,
                1292.6,
                1292.6,
                1292.7,
                1292.6,
                1292.5,
                1292.4,
                1292.4,
                1292.8,
                1293.3,
                1293.7,
                1293.8,
                1293.6,
                1293.4,
                1293.4,
                1293.6,
                1293.8,
                1294.1,
                1294.2,
                1294.3,
                1294.4,
                1294.6,
                1294.6,
                1294.3,
                1294.1,
                1293.8,
                1293.5,
                1293.4,
                1293.7,
                1294.1
          );

//ojo con los índices de los arrays
function higuchi($serie,$m,$k){
    $serieXmk = array();
    $longitudLmk = array();
    for ($i=1;$i==$k;$i++){
        $serieXmk[] = constructXmk($serie,$i,$k);
        $longitudLmk[]= calculoLmk($serieXk[$i-1],$i,$k);
    }
}

function constructXmk($serie,$m,$k){
    $n = count($serie);
    $tope = $m+($n - $m)/$k*$k;  // para mi esto no tiene sentido, es igual a n...
    $serieX = array();
    for ($i=$m-1;$i<$n){
        $serieX[] = $serie[$i];
        $i+= $k;
    }
    
}


?> 
<body>
  <div class="container">  
    <header>
       <h1>Fractales</h1>
    </header>
    <section id="julia-mandelbrot">
       <article>
       <h2>Higuchi Fractal Dimension</h2>
       </article>
    </section>
  </div>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/fractalesFinalManager.js"></script>
</body>
</html>