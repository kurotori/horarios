<html>
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
	<link rel="stylesheet" href="utu.css">
	<link href="js/jquery-ui.css" rel="stylesheet">
	<title>Control de Asistencias</title>
	<script src="js/external/jquery/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script language="JavaScript" type="text/javascript">
			var fechaOut="";
			var fechaIn="";
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
			
			
			
			$(function() {
			 $( "#fecha_ini" ).datepicker({
			 		dateFormat: 'yy-mm-dd',
			 		dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
			 		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			 		onClose: function( selectedDate ) {
	                			$( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );}
			 		});
			 		
			$( "#fecha_fin" ).datepicker({
					minDate:fechaIn,
					dateFormat: 'yy-mm-dd',
					dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
					monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']
			 		});
				
				});
		
		});
		
	</script>
</head>
<body ONLOAD="startTime();">
<?php
echo("
<div id='GUI_Ingreso' class='bordes' style='height:auto;text-align:center;'>
<b>Generador de Listados de Asistencias</b><br/><br/>
<form action='historialfuncionarios4.php' method='post'>

<table border='0' style='font-size:inherit;color:inherit;width:100%;'>
	<tr>
		<td>Fecha Inicial:</td>
		<td><input type='text' id='fecha_ini' name='fecha_ini' size=12 class='campoTexto'></td>
	</tr>
	<tr>
		<td>Fecha Final:</td>
		<td><input type='text' id='fecha_fin' name='fecha_fin' size=12 class='campoTexto'></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Clave Administrativa:</td>
		<td><INPUT TYPE='password' name='clave' method='post' size='20' value='' class='campoTexto'></td>
	</tr>
	
</table>
	<br/><br/><br/>
	<input class='boton ui-button' type='button' value='Crear listado' onclick='submit(this.form);'>
</form>
");
include "piedepagina.php";

?>
	<div id="volver">
		<a href='index.php'>
			Volver al Menú Principal
		</a>
	</div>
</body>
</html>