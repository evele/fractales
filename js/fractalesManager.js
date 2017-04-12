function FractalesManager(){
	var self = this;
	this.canvas ="";
	this.color = d3.scale.category20c();
	this.escala = 1;
	this.offsetX = 0;
	this.offsetY =0;

	this.init = function(){
		console.log('funciona');
		self.crearLienzo()
		self.bind_handler();
	}

	this.bind_handler =  function(){
		$(document).on('click','#JM-btn-calcular',self.calcular_julia_mandelbrot);
		//$('#JM-lienzo').bind('mousewheel',self.zoom);
		$(document).on('mousewheel','#JM-lienzo',self.zoom);
	}

	this.zoom =function(event){
		var parentOffset = $(this).parent().offset(); 
	   //or $(this).offset(); if you really just want the current element's offset
	   self.offsetX = event.pageX - parentOffset.left;
	   self.offsetY = event.pageY - parentOffset.top;
	    if(event.originalEvent.wheelDelta /120 > 0) {
	        //in
	        self.escala = self.escala *1.1;
	    } else {
	    	//out
	    	if (self.escala != 1){
	        	self.escala = self.escala /1.1;
	    	}
	    }
	    console.log(self.escala);
	    console.log(self.offsetX);
	    console.log(self.offsetY);
	    self.calcular_julia_mandelbrot();
	}

	this.calcular_julia_mandelbrot = function(){
		self.eliminarLienzo();
		self.crearLienzo();
		var iteraciones = parseInt($('#JM-iteraciones').val());
		var cx= parseFloat($('#JM-cx').val());
		var cy= parseFloat($('#JM-cy').val());

		//recorrer el lienzo punto por punto y definir dependiendo de
		// si pertenece o no a JM pintarlo.
		//rango del plano (-2,2) 800px x 800px. 1px, = 0.005
		console.log('calculando JM');
		//self.mandelbrot(x1,y1,x2,y2,iteraciones);
		
		for (var i=0; i<800; i++){
			for (var j=0; j<800; j++){
				//if (self.perteneceJM(i,j,iteraciones,cx,cy)){
				self.perteneceMandelbrot(iteraciones,i,j,cx,cy)
				/*
				if (self.perteneceMandelbrot(iteraciones,i,j,cx,cy)){
					//aca podria actualizar el exit, y pintar igual
					self.canvas.fillStyle = self.color(0);
					self.pintarPX(i,j);
				}
				*/      
			}
		}
		        
		console.log('fin de calculo JM');
	}

	/*
	this.pintarPX = function(xi,yi){
      var x = document.getElementById("lienzo");
      var c = x.getContext("2d");
      c.fillStyle = "orange";
      c.fillRect(xi,yi,1,1);
      //alert(xi);
     };
	*/

    this.crearLienzo = function(){
     	var w = 800;
    	var h = 800;
        //var padding = 20;
        //var paddingX =20;
        //var paddingY =20;


        //Create SVG element
        /*
        var svg = d3.select("#JM-lienzo")
                    .append("svg")
                    .attr("width", w)
                    .attr("height", h);
     	*/
 		self.canvas = d3.select("#JM-lienzo")
		    .append("canvas")
		    .attr({width: w, height: h})
		    .on("click", self.zoom)	    
		    .node().getContext("2d");
    }

    this.eliminarLienzo = function(){
    	$('#JM-lienzo').empty();
    }

    this.pintarPX = function(i,j){
    	self.canvas.fillRect(i, j,1,1);
    }

    this.perteneceJM = function(i,j,iteraciones,cr,ci){
    	return true;
    }

    this.perteneceMandelbrot = function(n,x,yi,a,bi){
	    //tengo que iterar n veces siempre y cuando el módulo sea menor que 2 o 4.. no me acuerdo
	    //acá reordeno las coordenadas. el px (0,0) es en realidad el (400,400)
	    var xpx = x;
	    var ypx = yi;

	    x = x-400 + self.offsetX; //esto pensarlo mejor
	    yi =400-(yi + self.offsetY);
	    x = x/(200 * self.escala);
	    yi = yi/(200 * self.escala);

	    /*
	    $a = $x;
	    $bi = $yi;
	    */
	    // z = x + yi
	    // c = a + bi
	    // z(n+1) = z(n)^2+c  -> (x + yi)(n+1) = (x +yi)(n)^2 + a + bi = x^2 + 2xyi - yi^2 + a + bi
	    //                                                  parte real = x(n+1) = x(n)^2 - y(n)^2 + a
	    //                                            parte imaginaria = y(n+1) = 2x(n)yi(n) + bi(n)
	    //  if sqrrt(x^2+y^2)>2 then "El punto (a,b) no pertenece al Fractal"
	    var znReal = self.znreal(x,yi,a); 
	    //console.log(znReal);
	    var znImaginaria = self.znimaginaria(x,yi,bi);
	    //console.log(znImaginaria);
	    //var esc =0;
	    var z = { re: znReal, im: znImaginaria };
	    for (var i=1; i < n; i++){ 
	      //$parteReal = $x * $x - $yi * $yi + $a;
	      //$parteImaginaria = 2*$x*$yi + $bi;
	      if (Math.sqrt((z.re*z.re)+(z.im*z.im))>2){
	          self.canvas.fillStyle = self.color(i);
			  self.pintarPX(xpx,ypx);
	          return false;
	      } 
	      znReal = self.znreal(z.re,z.im,a);
	      znImaginaria = self.znimaginaria(z.re,z.im,bi);
	      z.re =znReal;
	      z.im =znImaginaria;
	    
	    }
		
	    return true;
  }

  this.znreal = function($x,$yi,$a){
        return((($x * $x) - ($yi * $yi)) + $a);
  }

  this.znimaginaria =function($x,$yi,$bi){
        return((2*$x*$yi) + $bi);
  }

}

var _FM_ = new FractalesManager();
$(document).ready(_FM_.init);