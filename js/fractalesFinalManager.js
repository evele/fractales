function FractalesManager(){
	var self = this;
	this.k_minimo = 0;
	this.k_maximo = 0;
	this.absoluto = 1;
	//this.base_url = ''; 

	this.init = function(){
		console.log("estoy andando");
		self.bind_handler();
	}

	this.bind_handler =  function(){
		$(document).on('click','#btn-higuchi',self.higuchi);
		
	}

	this.higuchi = function(){
		console.log('calculando higuchi');
		//console.log($('#file-to-upload').val());
		if($('#file-to-upload').val()!=''){
			self.upload_file();
		} else {
			alert('no hay ningun archivo seleccionado');
		}
	}

	this.upload_file = function(){
		var formData = new FormData();
		formData.append('file-to-upload', $('#file-to-upload')[0].files[0]);
		self.k_minimo = $('#k-minimo').val();
		self.k_maximo = $('#k-maximo').val();
		/*
		if ($('#valor-absoluto').prop( "checked" )){
			self.absoluto = 1;
		} else {
			self.absoluto = 0;
		}
		*/
		//var datatosubmit = {};
		var ws = {
			type: 'POST',
			dataType: 'json',
			data: formData,
			cache: false,
    		contentType: false,
    		processData: false,
			//url: base_url + "lib/upload.php",
			url: "lib/upload.php",
			complete: self.upload_file_complete
		};

		$.ajax(ws);
	}

	this.upload_file_complete = function(data){
		var response = data['responseText'];
		try {
			response = $.parseJSON(response);
		} catch(e){
			//self.show_notification("Hubo un error", "danger");
			console.log('Error: Not JSON object on response');
			return false;
		}
		if (response.result != null && response.result =='ok'){
				console.log("archivo subido correctamente");
				self.calcular_higuchi();
		} else {
			//self.show_notification("Hubo un error", "danger");
			console.log(response.message);
		}	
	}
	

	this.calcular_higuchi = function(){
		var datatosubmit = {
			k_minimo: self.k_minimo,
			k_maximo: self.k_maximo,
			absoluto: self.absoluto
		};
		var ws = {
				type: 'POST',
				dataType: 'json',
				data: datatosubmit,
				url:"lib/ajax_higuchi.php",
				complete: self.calcular_higuchi_complete
		}

		$.ajax(ws);
	}

	this.calcular_higuchi_complete = function(data){
		var response = data['responseText'];
		try {
			response = $.parseJSON(response);
		} catch(e){
			//self.show_notification("Hubo un error", "danger");
			console.log('Error: Not JSON object on response');
			return false;
		}
		if (response.result != null && response.result =='ok'){
				console.log("todo ok");
				//console.log(response.mediciones);
			//	var mediciones = self.invertir_array(response.mediciones);
				//console.log(response.mediciones[15]);
				self.generarTabla(response.mediciones);
				self.generar_svg(response.mediciones,response.k_maximo,response.k_minimo);
		} else {
			//self.show_notification("Hubo un error", "danger");
			console.log(response.message);
		}	
	}


	this.generarTabla = function(mediciones){
		var fila_html = "";
		$('#table-body').empty();
		$.each( mediciones, function(paso,medicion) {
			fila_html = self.generarFila(paso,medicion);
			$('#table-body').prepend(fila_html);
		});
	}

	this.generarFila = function(paso,medicion){
		var fila_html = "<tr><td>"+paso+"</td><td>"+medicion+"</td></tr>";
		return fila_html;
	}

	this.generar_svg =function(mediciones,k_maximo,k_minimo){
		$('#grafico-container').empty();
		var dataset = self.generar_dataset(mediciones,k_maximo,k_minimo);
		self.calcular_recta_que_mejor_se_ajusta(dataset);
		//console.log(dataset);

		var dataset2 = [
                  [ 5,     20 ],
                  [ 480,   90 ],
                  [ 250,   50 ],
                  [ 100,   33 ],
                  [ 330,   95 ],
                  [ 410,   12 ],
                  [ 475,   44 ],
                  [ 25,    67 ],
                  [ 85,    21 ],
                  [ 220,   88 ],
                  [600, 150]
              ];

        //console.log(dataset2);

		var w = 1000;
    	var h = 800;
        //var padding = 20;
        var paddingX =20;
        var paddingY =20;


                //Create SVG element
        var svg = d3.select("#grafico-container")
                    .append("svg")
                    .attr("width", w)
                    .attr("height", h);

        /*
        var xScale = d3.scale.linear()
                     .domain([0, d3.max(dataset2, function(d) { return (d[0]); })])
                     .range([paddingX, w - paddingX]);
       */ 

        //var xScale = d3.scale.log()
        var xScale = d3.scale.linear()
                     .domain([d3.min(dataset, function(d) { return (d[0]); }), d3.max(dataset, function(d) { return (d[0]); })])
                     //.domain([-5, 0])
                     .range([paddingX, w - paddingX]);
                    

        var xAxis = d3.svg.axis()
                  .scale(xScale)
                  .orient("bottom")
                  .ticks(5);

        svg.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(0," + (h - paddingX) + ")")  //Assign "axis" class
            .call(xAxis);

        /*      
        var yScale = d3.scale.linear()
                     .domain([0, d3.max(dataset2, function(d) { return (d[1]); })])
                     .range([h - paddingY, paddingY]);
        */
        
        if (self.absoluto==1){
        var yScale = d3.scale.log()
                     .domain([d3.min(dataset, function(d) { return (d[1]); }), d3.max(dataset, function(d) { return (d[1]); })])
                     .range([h - paddingY, paddingY]);        	
       	
        } else {
	        var yScale = d3.scale.linear()
	                     .domain([d3.min(dataset, function(d) { return (d[1]); }), d3.max(dataset, function(d) { return (d[1]); })])
	                     .range([h - paddingY, paddingY]);
        }
        
        //Define Y axis
        var yAxis = d3.svg.axis()
                  .scale(yScale)
                  .orient("left")
                  .ticks(5);

    
            //Create Y axis
        svg.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(" + paddingY + ",0)")
            .call(yAxis);
    
        svg.selectAll("circle")
                   .data(dataset)
                   .enter()
                   .append("circle")
                   .attr("cx", function(d) {
                        return xScale(d[0]);
                   })
                   .attr("cy", function(d) {
                        return yScale(d[1]);
                   })
                   .attr("r", 2);


	}

	this.calcular_recta_que_mejor_se_ajusta = function(dataset){
		//debo calcular sumatoria de X, de Y, sumatoria de X^2 y de Y^2
		var sumX = 0;
		var sumY = 0;
		var sumXX = 0;
		var sumXY = 0;
		var count = 0;
		$.each( dataset, function( key, value ) {
  			//console.log(value);
  			sumX += value[0];
  			sumY += value[1];
  			sumXX += value[0]*value[0];
  			sumXY += value[0]*value[1];
  			count++;
		});
		var pendiente = (sumXY-((sumX*sumY)/count))/(sumXX-((sumX*sumX)/count)); 
		$('#pendiente-recta').text('La pendiente de la recta es: '+pendiente);
		console.log('la pendiente de la recta es: '+pendiente);

	}

	this.generar_dataset = function(mediciones,k_maximo,k_minimo){
		var dataset = new Array();
        var element =new Array();
        for (i = k_maximo; i >k_minimo-1 ; i--) {
            //var element = [Math.log(1/value[0]),Math.log(value[1])]; 
           // console.log(mediciones);
            element = [Math.log(1/i),Math.log(mediciones[i])]; 
            console.log(element);
            dataset.push(element);
        }; 
        return dataset;
	}

	this.invertir_array = function(objeto){
		//console.log(objeto);
		var arreglo = $.makeArray( objeto );
		var arreglo_invertido = new Array();
		//console.log(arreglo.length); 
		/*
		for (i = arreglo.length-1; i >-1 ; i--) {
			console.log("hola");
    		arreglo_invertido.push(arreglo[i]);
		}
		*/
		console.log("hola");
		var arreglo_invertido = arreglo.reverse();
		//console.log(arreglo_invertido);
		return arreglo_invertido;

	}

}



var _FM_ = new FractalesManager();
$(document).ready(_FM_.init);