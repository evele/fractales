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
      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Julia Mandelbrot</a></li>
      </ul>
    </div>
    <div class="container">  
        <header>
           <h1>Fractales</h1>
        </header>
        <section id="julia-mandelbrot">
           <article>
              <div class="row">
                <div class ="col-xs-12">
                   <h2>Julia - Mandelbrot</h2>
                <!--
                <svg width="100" height="100">
                  <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
                </svg>
              -->
                  <div class="form-group">
                    <label class="col-xs-4">ingrese la cantidad de iteraciones: </label>
                    <label> n = </label><input id="JM-iteraciones" type="number" step="1">
                  </div>
                  <div class="form-group">
                    <label class="col-xs-4">ingrese el valor del complejo C (cx,cy) : </label>
                    <label>cx = </label><input id="JM-cx" type="number" step="0.001">
                    <label>cy = </label><input id="JM-cy" type="number" step="0.001"> 
                  </div>                  
                  <button id="JM-btn-calcular" type="button" class="btn btn-primary">Calcular</button>
                  <hr>
                 </div>
              </div>
                <div class="row">
                  <div class="col-xs-12">
                    <div id="JM-lienzo">
                    
                    </div>
                  </div>
                </div>
           </article>
        </section>
      </div>
    <script type="text/javascript" src="js/d3.v3.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/fractalesManager.js"></script>
</body>
</html>