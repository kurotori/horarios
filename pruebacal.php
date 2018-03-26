<?php

	$usuario="escuela";
	$pword="LBNmVQAsd5GjPQ69";
	$baseD="horarios";
	
	include "calendar.php";
	
	date_default_timezone_set("America/Montevideo");
	
	$anio=date("Y");
	$esBis=date("L",$anio);
	echo $anio." - ".$esBis;
	echo date("z")."<br/>";
	/*
	mktime(hora,minuto,segundo,mes,dia,año)
	
	*/
	$totalDias=(date("z",mktime(0,0,0,12,31,$anio)))+1;
	echo $totalDias."<br/>";
	
	for($i=1;$i<=$totalDias;$i++){
		if (date("N",mktime(0,0,0,1,$i,$anio))==1){
			for($j=$i;$j<=($i+5);$j++){
				echo date("d-m-Y",mktime(0,0,0,1,$j,$anio))." || ";
			}
			echo "<br/>";
		}
	}
	
	
	/*
	$diaIni=date(
	$diaFin=
	
	
	$calendario= new Calendar('2014');
	
	for($s=1;$s<=5;$s++){
		echo $calendario->getWeekHTML($s, false, false, 0);
	}
    */


?>