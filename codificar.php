<?php
	function codificar($entrada){
		$salida=hash("sha256", $entrada);
	
		return $salida;
	}
	
	/*
	
	LBNmVQAsd5GjPQ69
	
	echo (codificar("BuenosDías")."<br/>");
	echo (codificar("Seba"));
	*/
	
	?>
	
	