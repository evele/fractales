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
<body>
  <div class="container">  
    <header>
       <h1>Fractales</h1>
    </header>
    <section id="julia-mandelbrot">
       <article>
       <h2>Higuchi Fractal Dimension</h2>
<?php

/*Buen día Claudio,

me surgió un trabajito extra que no pude rechazar así que arranqué un toque más tarde de lo ideal.

En definitiva me compliqué con Higuchi, te cuento lo que fuí haciendo y dónde se me complicó.

Parto de una serie de 10 elementos N=10,

                                X(N) =X(1), X(2), X(3), X(4), X(5), X(6), X(7), X(8), X(9), X(10).

                                         = (1294.3, 1294.2, 1294.1, 1293.8, 1293.7, 1293.7, 1293.8, 1293.7, 1293.5, 1293.3)

Tomo por ejemplo un k = 3, por lo que genero 3 nuevas subseries


                              Xmk = X 13 = X(1), X(4), X(7), X(10)  = (1294.3, 1293.8, 1293.8, 1293.3)                                       // y acá las primeras dudas.. yo entiendo que las sub series tienen 4,3 y 3 elementos correspondientemente.

                             Xmk = X 23 = X(2), X(5), X(8)              = (1294.2, 1293.7, 1293.7)                                                     // y que se componen como lo indiqué por el elemento X(i) de la serie original.   
                             Xmk = X 33 = X(3), X(6), X(9)              = (1294.1, 1293.7, 1293.5)


Luego trato de calcular las curvas de cada Xmk , Lm (k).  Y acá tengo 2 dudas más. La primera es el tope de la sumatoria. Según la fórmula es desde i=1, hasta (N-m)/k.

                          Para X 13  tenemos (10 - 1) / 3 = 3.

                          Tengo que calcular |X(m+ik) - X(m+(i-1)k)|, en la tercera iteración por ejemplo  |X(m+ik) - X(m+(i-1)k)| = |X(1 + 3*3) - X(1 + (1-3) * 3) | = X(10) - X(7)


 


*/


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
    $N = count($serie);
    for ($i=1;$i<$k+1;$i++){
        $serieXmk[] = constructXmk($serie,$i,$k,$N);
        $longitudesLmk[]= calculoLmk($serie,$i,$k,$N);
    }
    //var_dump($longitudesLmk);
    $longitudLk = calculoLk($longitudesLmk,$k); 
    var_dump("</br>");
    var_dump("</br>");
    var_dump("longitudLK = ".$longitudLk);
}

function constructXmk($serie,$m,$k,$N){
    //$n = count($serie);
    $tope = $m+($N - $m)/$k*$k;  // para mi esto no tiene sentido, es igual a n...
    $serieX = array();
    for ($i=$m-1;$i<$N;){
        $serieX[] = $serie[$i];
        $i+= $k;
    }
    
    return($serieX);
    
}

function calculoLmk($serie,$m,$k,$N){
    $tope = intdiv(($N - $m),$k) ; 
    $longitudL = 0;
    $producto =  ($N - 1) / (intdiv(($N - $m),$k) * $k); 
    //var_dump("producto 1: ".$producto);
    //var_dump("</br>");
   
    //var_dump($tope);
    for ($i=1;$i<$tope+1;$i++){
        $longitudL += dentroSumatoriaA($serie,$m,$k,$i); 
    }
    $longitudL = $longitudL * $producto / $k;
    var_dump("Longitud L(".$m.",".$k.")=");
    var_dump($longitudL);
    var_dump("</br>");
    return($longitudL);
}

function dentroSumatoriaA($serie,$m,$k,$i){
    // le resto 1 a los subíndices para corregir le hecho de que arrancan en 02
    return ($serie[($m+($i*$k))-1] - $serie[($m + ($i-1)*$k)-1]);
};

function calculoLk($serie,$k){
    $longitudLk = 0;
    foreach ($serie as $longitudLmk) {
        $longitudLk += $longitudLmk; 
    }
    $longitudLk = $longitudLk / $k;
    return($longitudLk);
}




//var_dump($datos);
higuchi($datos,1,4);


?> 
       </article>
    </section>
  </div>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/fractalesFinalManager.js"></script>
</body>
</html>