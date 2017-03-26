<?php 
class Higuchi {

	public $serie = array();

	public function __construct($serieP){
		$this->serie = $serieP;
		
	}

	//ojo con los índices de los arrays
	function higuchi($serie,$m,$k){
	    $serieXmk = array();
	    $longitudLmk = array();
	    $N = count($serie);
	    for ($i=1;$i<$k+1;$i++){
	        //$serieXmk[] = constructXmk($serie,$i,$k,$N);
	        $longitudesLmk[]= calculoLmk($serie,$i,$k,$N);
	    }
	    //var_dump($longitudesLmk);
	    $longitudLk = calculoLk($longitudesLmk,$k); 
	    //var_dump("</br>");
	    //var_dump("</br>");
	    //var_dump("longitudLK = ".$longitudLk);
	}

	/*

	public function constructXmk($serie,$m,$k,$N){
	    //$n = count($serie);
	    $tope = $m+($N - $m)/$k*$k;  // para mi esto no tiene sentido, es igual a n...
	    $serieX = array();
	    for ($i=$m-1;$i<$N;){
	        $serieX[] = $serie[$i];
	        $i+= $k;
	    }
	    
	    return($serieX);
	    
	}
	*/

	public function calculoLmk($m,$k,$N){
	    //$tope = intdiv(($N - $m),$k) ; php 7
	    $tope = floor(($N - $m)/$k) ; 
	    $longitudL = 0;
	    //$producto =  ($N - 1) / (intdiv(($N - $m),$k) * $k); php 7
	    $producto =  ($N - 1) / (floor(($N - $m)/$k) * $k); 
	    //var_dump("producto 1: ".$producto);
	    //var_dump("</br>");
	   
	    //var_dump($tope);
	    for ($i=1;$i<$tope+1;$i++){
	        $longitudL += $this->dentroSumatoriaA($m,$k,$i); 
	    }
	    $longitudL = $longitudL * $producto / $k;
	    //var_dump("Longitud L(".$m.",".$k.")=");
	    //var_dump($longitudL);
	    //var_dump("</br>");
	    return($longitudL);
	}

	public function dentroSumatoriaA($m,$k,$i){
	    // le resto 1 a los subíndices para corregir le hecho de que arrancan en 02
	    return ($this->serie[($m+($i*$k))-1] - $this->serie[($m + ($i-1)*$k)-1]);
	}

	public function calculoLk($serie,$k){
	    $longitudLk = 0;
	    foreach ($serie as $longitudLmk) {
	        $longitudLk += $longitudLmk; 
	    }
	    $longitudLk = $longitudLk / $k;
	    return($longitudLk);
	}


	
}