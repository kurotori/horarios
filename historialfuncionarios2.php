<html>
	<head>
  		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="utu-listados.css">


<?php
$hoy = date("d/m/y");
session_start();

$enlace = mysql_connect("127.0.0.1","root","root")
   or die("No pudo conectarse : " . mysql_error());

mysql_select_db("horarios") or die("No pudo seleccionarse la BD.".mysql_error());


/* Realizar una consulta SQL */

$clave = ($_POST["clave"]);

$fecha_ini=($_POST["fecha_ini"]);
$fecha_fin=($_POST["fecha_fin"]);

$fecha_ini_v=preg_split("/-/",$fecha_ini);
$fecha_fin_v=preg_split("/-/",$fecha_fin);

$ano1=$fecha_ini_v[0];
$mes1=$fecha_ini_v[1];
$dia1=$fecha_ini_v[2];
$ano2=$fecha_fin_v[0];
$mes2=$fecha_fin_v[1];
$dia2=$fecha_fin_v[2];

echo "
	<title>Listado de Ingresos y Salidas de Fucionarios desde el $dia1-$mes1-$ano1 hasta el $dia2-$mes2-$ano2</title>
	</head>
	<body>
	";

/* 
 */


if ($clave!="admin"){
	echo("Clave incorrecta");
	exit;
};


$consulta_usuarios="select cedula,nombre1,nombre2,apellido1,apellido2,tipocargo from usuarios order by apellido1,apellido2,nombre1";

$consulta_registros= "select cedula,fecha,horaent,horasal from registro where fecha>='$ano1-$mes1-$dia1' and fecha<='$ano2-$mes2-$dia2' order by fecha,horaent";

$resultado_usuarios=mysql_query($consulta_usuarios) or die("La consulta de usuarios fall&oacute;: " . mysql_error());
$resultado_registros=mysql_query($consulta_registros) or die("La consulta de registros fall&oacute;: " . mysql_error());

$lista_usuarios=[];
while($row_u = mysql_fetch_array($resultado_usuarios)){
	$lista_usuarios[]=$row_u;
}
$num_usuarios=count($lista_usuarios);

$lista_registros=[];
while($row_r = mysql_fetch_array($resultado_registros)){
	$lista_registros[]=$row_r;
}
$num_registros=count($lista_registros);

echo "
<div id='cuerpo'>
	<div id='encabezado'>
		<span class='fechaDoc'>$hoy</span>
		<p class='titulo' style='text-align:center;width:100%;'>Escuela Técnica de Melo - UTU/CETP</p>
		<p class='subtitulo' style='text-align:center;width:100%;'>Listado de Ingresos y Salidas de Fucionarios desde el $dia1-$mes1-$ano1 hasta el $dia2-$mes2-$ano2</p> 
	</div>
	<div id='resultados'>
";


for($i=0;$i<$num_usuarios;$i++){
	$subTotalH=0;
	$subTotalM=0;
	$totalH=0;
	/*
	Primer Recorrido de la lista de resultados: Este recorrido obtiene los datos de cada funcionario desde la lista de resultados
	y los muestra en un sub-encabezado de la tabla
	
	Las variables $subTotalH y $subTotalM almacenarán el total de horas y minutos trabajados para luego realizar el cálculo 
	correspondiente y almacenar el resultado final de horas trabajadas en $totalH;
	*/
	echo "
	<div class='datosFunc'>
		<table style='width:100%;border-collapse:collapse;'>
		<tr><td colspan='2' style='width:25%;background-color:#ccc;border-bottom:solid black 1px;'>
		<b>Nombre: </b>".$lista_usuarios[$i][3]." ".$lista_usuarios[$i][4].", ".$lista_usuarios[$i][1]." ".$lista_usuarios[$i][2].
		"</td>
		<td style='width:25%;text-align:center;background-color:#ccc;border-bottom:solid black 1px;'>
		<b>CI: </b>".$lista_usuarios[$i][0].
		"</td>
		<td style='text-align:center;background-color:#ccc;border-bottom:solid black 1px;'>
		<b>Cargo: </b>".$lista_usuarios[$i][5].
		"</td>
		</tr>
		<tr>
		<td style='font-size:14px;width:25%;border-right:solid grey 1px;border-bottom:solid grey 1px;text-align:center;'><b>
		Fecha (Año-Mes-D&iacute;a)
		</b></td>
		<td style='font-size:14px;width:25%;border-right:solid grey 1px;border-bottom:solid grey 1px;text-align:center;'><b>Hora de Entrada</b></td>
		<td style='font-size:14px;width:25%;border-right:solid grey 1px;border-bottom:solid grey 1px;text-align:center;'><b>Hora de Salida</b></td>
		<td style='font-size:14px;width:25%;border-bottom:solid grey 1px;text-align:center;'><b>Horas Registradas</b></td>
		</tr>
		";	
	for($j=0;$j<$num_registros;$j++){
	/*
	Segundo recorrido de los resultados: Este recorrido obtiene los datos de ingreso de cada funcionario y compara la CI con la
	obtenida para el sub-encabezado, mostrando solo los datos del funcionario correspondiente al sub-encabezado
	*/
		
		
		
	
		if($lista_registros[$j][0]==$lista_usuarios[$i][0]){
		
			$horaIni=new DateTime($lista_registros[$j][2]);
			$horaFin=new DateTime($lista_registros[$j][3]);
			
			$subTotal=$horaFin->diff($horaIni);
			
			$subTotalH=$subTotal->format("%h");
			$subTotalM=$subTotal->format("%i");
			$subTotalD=$subTotalH+($subTotalM/60);
			echo "
			<tr>
			<td style='font-family:Courier;font-size:14px;width:25%;border-right:dotted grey 1px;border-bottom:dotted grey 1px;text-align:center;'>".
			$lista_registros[$j][1]
			."</td>
			<td style='font-family:Courier;font-size:14px;width:25%;border-right:dotted grey 1px;border-bottom:dotted grey 1px;text-align:center;'>".
			$lista_registros[$j][2]
			."</td>
			<td style='font-family:Courier;font-size:14px;width:25%;border-bottom:dotted grey 1px;text-align:center;'>".
			$lista_registros[$j][3]
			."</td>
			<td style='font-family:Courier;font-size:14px;width:25%;border-left:dotted grey 1px;border-bottom:dotted grey 1px;text-align:center;'>";
			printf("%.2f",$subTotalD);
			echo "</td>
			</tr>
			";
		}
		$totalH=$totalH+($subTotalH+($subTotalM/60));
	}
	echo "
	<tr>
	<td colspan='3' style='font-size:14px;width:33%;border-right:solid grey 1px;border-bottom:solid grey 1px;border-top:solid grey 1px;text-align:right;'>
	<b>Total de Horas Registradas:&nbsp;&nbsp;&nbsp;&nbsp;</b>
	</td>
	<td style='font-family:Courier;font-size:14px;width:33%;border-right:solid grey 1px;border-bottom:solid grey 1px;border-top:solid grey 1px;text-align:center;'>
	<b>
	";
	printf("%.2f",$totalH);
	echo "</b></td>
	</tr>";
	
}

echo("</table>
	<p style='text-align:center;width:100%;font-weight:bold;'>-- Fin del Listado --</p>
	</div>
</div>
</body>
</html>
	");


/* Liberar conjunto de resultados */
mysql_free_result($resultado_usuarios);
mysql_free_result($resultado_registros);

/* Cerrar la conexion */
mysql_close($enlace);
?>
