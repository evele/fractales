function FractalesManager(){
	var self = this;
	this.k_minimo = 0;
	this.k_maximo = 0;
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
		console.log($('#file-to-upload').val());
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
			k_maximo: self.k_maximo
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
				self.generarTabla(response.mediciones);
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
			$('#table-body').append(fila_html);
		});
	}

	this.generarFila = function(paso,medicion){
		var fila_html = "<tr><td>"+paso+"</td><td>"+medicion+"</td></tr>";
		return fila_html;
	}

}



var _FM_ = new FractalesManager();
$(document).ready(_FM_.init);