<?php
	include 'datos.php';
	
	$BDConn=mysqli_connect($servidor,$usuario,$pword,$baseD);
	if (mysqli_connect_errno($BDConn)){
		echo 'Fallo al conectar a MySQL: ' . mysqli_connect_error();
		}
	else {
		echo "BD OK!!!";
	}
	
	$consCargos=mysqli_query($BDConn,"SELECT cargo FROM cargos"); 

echo "<html>
  <head>
  		<meta http-equiv='Content-type' content='text/html;charset=UTF-8'>
		<link rel='stylesheet' href='utu.css'>
		<link href='js/jquery-ui.css' rel='stylesheet'>
		<style type='text/css'>
			.tg  {
				border:none;
				border-collapse:collapse;
				border-spacing:0;
				font-size:24px;
				color:inherit;
				width:100%;
				}
			.tg td {
				overflow:hidden;
				word-break:normal;
				}
			.tg th{
				overflow:hidden;
				word-break:normal;
				}
		</style>
		<script type='text/javascript' src='js/jquery.js'></script>
		<script type='text/javascript'>
			function startTime() {
				var today=new Date();
				var h=today.getHours();
				var m=today.getMinutes();
				var s=today.getSeconds();
				m = checkTime(m);
				s = checkTime(s);
				document.getElementById('reloj').innerHTML = h+':'+m+':'+s;
				var t = setTimeout(function(){startTime()},500);
			}

			function checkTime(i) {
				if (i<10) {i = '0' + i};  // add zero in front of numbers < 10
				return i;
			}
			
		$(document).ready(function(){
			
			});
		</script>
		<TITLE>Sistema de Control de Asistencias de Funcionarios - Registro de Usuarios</TITLE>

	</HEAD>

	<BODY ONLOAD='startTime();'>
		<div id='GUI_Ingreso' class='bordes' style='height:auto;text-align:center;'>
		
		<b>Registrar Nuevo Usuario del Sistema</b>
		<br><br>
		
		<form name='registrodeusuarios' method='post' action='registrarusuario2.php'>
			<table class='tg'>
			  <tr>
				<td class='tg-031e'>CI:</td>
				<td class='tg-031e'><input type='text' name='cedula' size='8' maxlength='8' style='font-size:24px'></td>
			  </tr>
			  <tr>
				<td class='tg-031e' colspan='2'>
					<span style='font-size:14px'>
					<br/>
					(Digite la c&eacute;dula sin puntos ni guiones. 
							Ej.: la CI 1.234.567-8 se escribe 12345678)</span>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e' colspan='2'>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'>Primer Nombre:</td>
				<td class='tg-031e'>
					<input type='text' name='nombre1' size='30' maxlength='50' style='font-size:24px'>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'>Segundo Nombre:</td>
				<td class='tg-031e'>
					<input type='text' name='nombre2' size='30' maxlength='50' style='font-size:24px'>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'>Primer Apellido:</td>
				<td class='tg-031e'>
					<input type='text' name='apellido1' size='30' maxlength='50' style='font-size:24px'>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'>Segundo Apellido:</td>
				<td class='tg-031e'>
					<input type='text' name='apellido2' size='30' maxlength='50' style='font-size:24px'>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'>Tipo de Cargo:</td>
				<td class='tg-031e'>
					<Select name='tipodecargo' style='font-size:24px'>";
				
				while($fila2 = mysqli_fetch_assoc($consCargos)){
					$cargo=$fila2['cargo'];
					echo "<option>$cargo</option>";
				}		
				
				echo"</select>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e' colspan='2'>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e' colspan='2' style='text-align:center;'>
					<input type='submit' value='Registrar Usuario' class='boton ui-button'>
				</td>
			  </tr>
			</table>
		
		</div>";
		include 'piedepagina.php'; 
		mysqli_close($BDConn);
?>
		<div id='volver'>
			<a href='index.php'>
				Volver al Men&uacute; Principal
			</a>
		</div>
	</BODY>

</HTML>