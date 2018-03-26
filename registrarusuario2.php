<HTML>

	<HEAD>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="utu.css">
		<link href="js/jquery-ui.css" rel="stylesheet">
		<TITLE>REGISTRO DE USUARIOS</TITLE>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
			function startTime() {
				var today=new Date();
				var h=today.getHours();
				var m=today.getMinutes();
				var s=today.getSeconds();
				m = checkTime(m);
				s = checkTime(s);
				document.getElementById('reloj').innerHTML = h+":"+m+":"+s;
				var t = setTimeout(function(){startTime()},500);
			}

			function checkTime(i) {
				if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
				return i;
			}
			
			$(document).ready(function(){
			
			});
		</script>

	</HEAD>

	<BODY ONLOAD="startTime();">
<?php
include "piedepagina.php";
echo "
	<div id='volver'>
		<a href='index.php'>
			Volver al Men&uacute; Principal
		</a>
	</div>
";
$conexion=mysql_connect("127.0.0.1","root","root") or die("Imposible Conectar");
mysql_select_db ("horarios", $conexion) or die ("Imposible Seleccionar base de datos");

$cedula = ($_POST["cedula"]);
$nombre1 = ($_POST["nombre1"]);
$nombre2 = ($_POST["nombre2"]);
$apellido1 = ($_POST["apellido1"]);
$apellido2 = ($_POST["apellido2"]);
$tipodecargo =($_POST["tipodecargo"]);

mysql_query("INSERT INTO usuarios VALUES('$cedula','$apellido1','$apellido2','$nombre1','$nombre2','$tipodecargo')", $conexion)
or die("
		<div class='bordes alerta'>
			<img src='alerta.png'>
			<br/><br/>
			Sucediò un error al intentar guardar los datos solicitados<br/>
			Detalles del Error:<br/>".
			mysql_error().
			"</div>");

echo(

"<div id='GUI_Ingreso' class='bordes' style='height:auto;text-align:center;'>
	Se ingresaron correctamente los datos del usuario<br/>
	<b>$nombre1 $nombre2  $apellido1 $apellido2</b><br/>
	<span style='text-align:left;'>
	<b>CI:</b> $cedula <br/>
	<b>Cargo:</b> $tipodecargo <br/>
	</span>
</div>
");

mysql_close($conexion);

?>
	
</BODY>

</HTML>

