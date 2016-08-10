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
              <svg>
              <?php
              $iteraciones = 0;
              $i =5;
              // esto lo obtenemos de c
              $cr = 0;
              $ci = 0;
              $si = true;
              for ($i=0; $i < 400 ; $i++) {
                $i++; 
                for ($j=0; $j < 400 ; $j++) { 
                $j++;
                  # code...
                    
                  if (perteneceMandelbrot($iteraciones,$i,$j,$cr,$ci)) { 
                ?>
                     <!-- <circle cx=<?php echo $i ?> cy=<?php echo $y ?> r="0.5" stroke="green" stroke-width="1" fill="yellow" />  
                      -->
                      <line x1=<?php echo $i ?> y1=<?php echo $j ?> x2=<?php echo $i ?> y2=<?php echo $j+1 ?> style="stroke:rgb(255,0,0);stroke-width:1" />
                   
                    <?php
                   // $si = !$si;
                  } else {
                ?>
                   <!--   <circle cx=<?php echo $i ?> cy=<?php echo $y ?> r="0.5" stroke="red" stroke-width="1" fill="yellow" /> -->
                <?php
                   // $si = !$si;
                  }
                }
              }
              ?>
              </svg>
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
<?php
  function perteneceMandelbrot($n,$x,$yi,$a,$bi){
    //tengo que iterar n veces siempre y cuando el módulo sea menor que 2 o 4.. no me acuerdo
    //acá reordeno las coordenadas. el px (0,0) es en realidad el (200,200)
    //$x = $x+200; esto pensarlo mejor
    //$yi = $yi+200;
    // z = x + yi
    // c = a + bi
    // z(n+1) = z(n)^2+c  -> (x + yi)(n+1) = (x +yi)(n)^2 + a + bi = x^2 + 2xyi - yi^2 + a + bi
    //                                                  parte real = x(n+1) = x(n)^2 - y(n)^2 + a
    //                                            parte imaginaria = y(n+1) = 2x(n)yi(n) + bi(n)
    //  if sqrrt(x^2+y^2)>2 then "El punto (a,b) no pertenece al Fractal"

    $parteReal = $x * $x - $yi * $yi + $a;
    $parteImaginaria = 2*$x*$yi + $bi;

    if (sqrt($parteReal*$parteReal+$parteImaginaria*$parteImaginaria)>2){
        return false;
    } else {
        return true;
    }
  }
?>
</html>