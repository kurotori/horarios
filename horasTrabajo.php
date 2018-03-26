<?php
	
	
	$CIusuario="12345678";
	
	function horasTrabajo($CIusuario){
		$totalH=0;
		$totalM=0;
		$total=0;
		$usuario="escuela";
		$pword="LBNmVQAsd5GjPQ69";
		$baseD="horarios";
		
		$enlace = mysql_connect("127.0.0.1",$usuario,$pword)
		or die("No pudo conectarse : " . mysql_error());
		
		mysql_select_db("horarios") or die("No pudo seleccionarse la BD. ".mysql_error());
		
		$consulta="select horaent, horasal from registro where cedula='$CIusuario'";
		$resConsulta=mysql_query($consulta) or die("La consulta de usuarios fall&oacute;: " . mysql_error());
		
		$listaHoras=[];
		
		while($fila_res=mysql_fetch_array($resConsulta)){
			$listaHoras[]=$fila_res;
		}
		
		$num_registros=count($listaHoras);
			
		for($i=0;$i<$num_registros;$i++){
			$hora1=new DateTime($listaHoras[$i][0]);
			$hora2=new DateTime($listaHoras[$i][1]);
			
			$subtotal=$hora2->diff($hora1);
			$subH=$subtotal->format("%h");
			$subM=$subtotal->format("%i");
			$totalH=$totalH+$subH+($subM/60);
			
			echo $listaHoras[$i][1]." - ".$listaHoras[$i][0]."||".$subH.":".$subM."<br/>";
		}
		
		echo "<hr/>".$totalH."<br/>";
		
	}
	
	horasTrabajo($CIusuario);

?>