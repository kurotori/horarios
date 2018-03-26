<html>
	<head>
<?php
include "encabezado.php";
echo "</head>
		<body onload='startTime()'>";
		
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


if ($clave!="admin") {echo("Clave incorrecta");exit;};


$consulta3= "select tipocargo,apellido1,usuarios.cedula,fecha,horaent,horasal,imgdata_ent,imgdata_sal,usuarios.nombre1 from registro,usuarios where usuarios.cedula=registro.cedula and fecha>='$ano1-$mes1-$dia1' and fecha<='$ano2-$mes2-$dia2' order by fecha,horaent";

$resultado2 = mysql_query($consulta3) or die("La consulta fall&oacute;: " . mysql_error());

/* Impresion de resultados en HTML */

echo "
<div id='GUI_Ingreso' class='bordes' style='height:auto;width:65%;text-align:center;'>
<b>Listado de Ingresos y Salidas desde el $dia1-$mes1-$ano1 hasta el $dia2-$mes2-$ano2</b><br/><br/>	
	<table id='listadoAsistFoto'>
		<tr>
			<td style='height:auto;'><b>Cargo</b></td>
			<td style='height:auto;'><b>Funcionario</b></td>
			<td style='height:auto;'><b>Fecha</b></td>
			<td style='height:auto;'><b>Entrada</b></td>
			<td style='height:auto;'><b>Salida</b></td>
		</tr>
		\n
";

while(list($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9)=mysql_fetch_row($resultado2)) {
   echo "\t
   <tr>\n 
		<td>$v1</td>
		<td>$v2, $v9<br/>CI: $v3</td>
		<td>$v4</td>
		<td>$v5<br/><img src=$v7 height='50%'></td>
		<td>$v6<br/><img src=$v8 height='50%'></td>
</tr>

   ";
};

echo("</table></div>");


/* Liberar conjunto de resultados */
mysql_free_result($resultado2);

/* Cerrar la conexion */
mysql_close($enlace);
include "piedepagina.php";
?>
		<div id="volver">
			<a href='index.php'>
				Volver al Menú Principal
			</a>
		</div>
</body>
</html>
