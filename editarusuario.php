<?php
	$titulo="Editar la Lista de Usuarios Registrados";
	$scriptJS="
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
		$(document).ready(
			function(){
				$('#ok').click(
					function(){
						$('#registro').delay(500).slideDown('slow');
						$('#atencion').slideUp('slow');
					}
				);
			}
		);
	";
	include "head.php";
	
?>

	<body onload="startTime();">
		<div id="atencion" class="alerta bordes">
			<u>ATENCI&Oacute;N</u><br/><br/>
		Este sistema permite modificar los datos
		de un usuario existente en el sistema.
		Si se usa de forma irresponsable es posible
		que dicho usuario tenga problemas para registrar
		sus entradas y salidas.<br/>
		<u>&Uacute;SELO CON PRECAUCI&Oacute;N</u><br/><br/>
		<input id="ok" type="button" value="Entiendo Los Riesgos" class='boton ui-button'>
		</div>
		
		<div id="registro" class="importante bordes" style="display:none;width:600px;font-weight:normal;">
		<b>B&uacute;squeda de Usuarios</b><br/><br/>
		<style type="text/css">
				.tg  {
				width:100%;
				border-collapse:collapse;
				border-spacing:0;
				text-align:left;
				}
				.tg td {
				font-family:Arial, sans-serif;
				font-size:24px;
				padding:5px 5px 5px 5px;
				border:none;
				overflow:hidden;
				word-break:normal;
				}
				.tg th {
				font-family:Arial, 
				sans-serif;font-size:24px;
				font-weight:normal;
				padding:5px 5px 5px 5px;
				border:none;
				overflow:hidden;
				word-break:normal;
				}
			</style>
			<form id="buscaruser" name="buscaruser" method="post" action="editarusuarioB.php"> 
			<table class="tg">
			  <tr>	
				<td class="tg-031e"><b>CI:</b></td>
				<td class="tg-031e">
					<input type="text" id="cedula" name="cedula" size="8" maxlength="8" style="font-size:24px">
				</td>
			  </tr>
			 </table>
			<br/>
			<input type="submit" value="Buscar" id="enviar" class="boton ui-button">
			</form>
		
		
		</div>
	
	
	
		<?php include "piedepagina.php"; ?>
		<div id="volver">
			<a href='index.php'>
				Volver al Men&uacute; Principal
			</a>
		</div>
	
	</body>