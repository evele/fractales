<?php
include("../lib/higuchi.php");

function readCSVFile($path,$filename){
	$row = 1;
	if (($handle = fopen($path.$filename, "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        $num = count($data);
	        //$result['message'][]= "<p> $num fields in line $row: <br /></p>\n";
	        $row++;
	        for ($c=0; $c < $num; $c++) {
	            //$result['message'][] = $data[$c];
	    		$arrayOfData[] =$data[$c];;
	        }
	    }
	    fclose($handle);
	}
	$result['result'] = 'ok';
	//echo json_encode($result);
	return $arrayOfData;
}

function calcularHiguchi($serie,$m,$k){
	$higuchi = new Higuchi($serie);

	$longitudLmk = array();
	$N = count($serie);
	for ($i=1;$i<$k+1;$i++){
	    //$serieXmk[] = constructXmk($serie,$i,$k,$N);
	    $longitudesLmk[]= $higuchi->calculoLmk($i,$k,$N);
	}
	//var_dump($longitudesLmk);
	$longitudLk = $higuchi->calculoLk($longitudesLmk,$k); 
	//$result['longitudes_lmk'] = $longitudesLmk;
	//$result['longitud_LK'] = $longitudLk;
	//$result['result'] = 'ok';
	//return $result;
	return $longitudLk
}

function realizarMediciones($serie,$m,$k_min,$k_max){
	$mediciones = array();
	for ($i=$k_max;$i>$k_min;$i--){
		$mediciones[$i] = calcularHiguchi($serie,)
	}
}


$path = "../uploads/";
$filename = "sampleToTest.csv";;
$serie = readCSVFile($path,$filename);
$k = 2;
$m = 1;
//var_dump("</br>");
//var_dump("</br>");
//var_dump("longitudLK = ".$longitudLk);
realizarMediciones($serie,$m,$k_min,$k_max);


$result =  calcularHiguchi($serie,$m,$k);

echo json_encode($result);

