function FractalesManager(){
	var self = this;

	this.init = function(){

	}

	this.bind_handler =  function(){

	}

	this.pintarPX = function(xi,yi){
      var x = document.getElementById("lienzo");
      var c = x.getContext("2d");
      c.fillStyle = "orange";
      c.fillRect(xi,yi,1,1);
      //alert(xi);
     };
}

var _FM_ = new FractalesManager();
$(document).ready(_FM_.init);