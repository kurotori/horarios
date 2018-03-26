<?php
	$titulo="Registro de Usuarios Administrativos";
	$scriptJS="
		jQuery.validator.setDefaults({
			  debug: false,
			  success:'valid'
			});
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
					});
				
				var validar=$('#nuevoadmin').validate({
					lang: 'es_AR',
					rules: {
						cedula: {
							required: true,
							minlength: 8
						},
						contras: {
							required: true,
							minlength: 8
						},
						contras2: {
							required: true,
							equalTo: '#contras'
						}
					},
					messages: {
						contras: {
							required: 'Escriba una contraseña',
							minlength: jQuery.validator.format('Escriba por lo menos {0} caracteres')
						},
						contras2: {
							equalTo: 'No es igual a la contraseña ingresada'
						}
					}
				});
				
				$('#contras').valid();
				
				$('#enviar').click(
					function(){
						$('#test').html(validar);
					}
				);
			}
		);
	";
	include "head.php";

?>
	<body onload="startTime();">
		<div id="test"></div>
		<div id="atencion" class="alerta bordes">
			<b style="font-size:24px;">¡NOTA IMPORTANTE!</b><br/><br/>
			Esta página permite crear usuarios<br/>
			capaces de <b>acceder a los datos<br/>
			de asistencia de <u>todos</u> los<br/>
			funcionarios.</b><br/><br/>
			<b style="font-size:22px;">Use esta función con responsabilidad</b><br/><br/>
			<input id="ok" type="button" value="Entiendo Los Riesgos" class='boton ui-button'>
		</div>
		<div id="registro" class="importante bordes" style="display:none;width:600px;">
			<style type="text/css">
				.tg  {
				width:100%;
				border-collapse:collapse;
				border-spacing:0;
				text-align:center;
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
			<form id="nuevoadmin" name="nuevoadmin" method="post" action="registroadmin2.php"> 
			<table class="tg">
			  <tr>
				<th class="tg-031e" colspan="2"><b>Crear Nuevo Usuario Administrativo</b><br/><br/>
				</th>
			  </tr>
			  <tr>	
				<td class="tg-031e"><b>CI:</b></td>
				<td class="tg-031e">
					<input type="text" id="cedula" name="cedula" size="8" maxlength="8" style="font-size:24px">
				</td>
			  </tr>
			  <tr>
				<td class="tg-031e" colspan="2" style="font-size:14px;text-align:left;">
					<b>IMPORTANTE:</b> El usuario <u>ya debe pertenecer</u> al sistema para poder registrarlo
					como usuario administrativo.
				</td>
			  </tr>
			  <tr>
				<td class="tg-031e"><b>Contraseña:</b></td>
				<td class="tg-031e">
				<input type="password" class="password" id="contras" name="contras" size="20" maxlength="20" style="font-size:24px">
				</td>
			  </tr>
			  <tr>
				<td class="tg-031e" colspan="2" style="font-size:14px;text-align:left;">
					<b>IMPORTANTE:</b> No menos de 8 caracteres y no más de 20
				</td>
			  </tr>
			  <tr>
				<td class="tg-031e"><b>Repita la Contraseña:</b></td>
				<td class="tg-031e"><input type="password" id="contras2" name="contras2" size="20" maxlength="20" style="font-size:24px">
				</td>
			  </tr>
			</table>
			<br/>
			<input type="submit" value="Crear Usuario" id="enviar" class="boton ui-button">
			</form>
		</div>
		<?php include "piedepagina.php"; ?>
		<div id="volver">
			<a href='index.php'>
				Volver al Men&uacute; Principal
			</a>
		</div>
	</body>
</html>