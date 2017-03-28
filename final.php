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
    <section id="higuchi">
       <article>
       <h2>Higuchi Fractal Dimension</h2>
       <div class="row">
            <div class="col-xs-12">
                <form id="form-to-upload" method="post" enctype="multipart/form-data">
    Select image to upload:
                    <div class="form-group">
                                            
                        <input class="" type="file" name="file-to-upload" id="file-to-upload">
                        <p class="help-block">Upload only CSV files.</p>
                    </div>
                    <div class="form-group">
                        <label>Seleccionar el K mínimo</label>
                        <input type="text" name="k-minimo" id="k-minimo"> 
                    </div>
                    <div class="form-group">
                        <label>Seleccionar el K máximo</label>
                        <input type="text" name="k-maximo" id="k-maximo">
                    </div>
                    <div>
                        <input class="btn btn-success" type="button" value="Calcular Higuchi" id="btn-higuchi" name="btn-higuchi">
                    </div>
                </form>
            </div>           
       </div>
<?php
/*
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
     //   $serieXmk[] = constructXmk($serie,$i,$k,$N);
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
    //$tope = intdiv(($N - $m),$k) ; php 7
    $tope = floor(($N - $m)/$k) ; 
    $longitudL = 0;
    //$producto =  ($N - 1) / (intdiv(($N - $m),$k) * $k); php 7
    $producto =  ($N - 1) / (floor(($N - $m)/$k) * $k); 
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
    // le resto 1 a los subíndices para corregir el hecho de que arrancan en 0
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

*/
?> 
       </article>
    </section>
    <section id="mediciones">
       <article>
           <h3>Mediciones</h3>
           <div class="row">
                <div class="col-xs-6">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>K</td>
                                <td>L</td>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </article>
    </section>
  </div>
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/fractalesFinalManager.js"></script>
</body>
</html>