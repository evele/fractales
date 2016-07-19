<!DOCTYPE html>
 
<html lang="es">
 
<head>
<title>Titulo de la web</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<link rel="stylesheet" href="css/estilos.css"  >

<!-- Latest compiled and minified JavaScript -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
 
<body>
    
    <div class="container">
      <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="#">Julia Mandelbrot</a></li>
      <li role="presentation"><a href="practico-2.php">Pr&aacute;ctico 2</a></li>
      <li role="presentation"><a href="practico-3.php">Pr&aacute;ctico 3</a></li>
    </ul>
    <header>
       <h1>Mi sitio web</h1>
       <p>Mi sitio web creado en html5</p>
    </header>
    <section>
       <article>
            <h2>Julia - Mandelbrot<h2>
            <p>  </p>
            <svg width="100" height="100">
              <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
            </svg>
            <form action="#" method="post">
              <label>ingrese la cantidad de iteraciones: </label>
              <input type="number" step="1">
              <label>ingrese el valor del complejo C (cx,cy) : </label><br>
              <label>cx = </label><input type="number" step="0.001">
              <label>cy = </label><input type="number" step="0.001"> 
              <button action="submit">Calcular</button>
            </form>
            <div class="JM-lienzo">
              <?php
              $si = true;
              for ($i=0; $i < 400 ; $i+1) { 
                if ($si) {
                ?>
                  <svg height="400" width="400">
                    <line x1="0" y1=<?php echo $i ?> x2="200" y2="200" style="stroke:rgb(255,0,0);stroke-width:1" />
                  </svg> 
                  <?php
                  $si = !$si;
                }
              }
              ?>
            </div>
       </article>
    </section>
    <aside>
       <h3>Titulo de contenido</h3>
           <p>contenido</p>
    </aside>
    <footer>
        un footercin
    </footer>
    </div>
</body>
</html>