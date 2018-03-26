<?php
$cedula=$_POST['cedula'];
$apellido1=$_POST['apellido1'];
$apellido2=$_POST['apellido2'];
$nombre1=$_POST['nombre1'];
$nombre2=$_POST['nombre2'];
$cargo=$_POST['cargo'];

$titulo="Modificar Usuario";
$scriptJS="
	
";

include "head-basico.php";

echo "
	<body>
		<div id='telon'></div>
		<div class='importante bordes' style='width:70%;'>
			<b>Modificar los Datos de un Usuario</b><br/><br/>
			<form name='modusuario' id='modusuario' method='post' action='modusuario2.php'>
				<table style='border:none;width:95%;font-size:24px;'>
					<tr>
						<td>CI:</td>
						<td>
						$cedula
						</td>
					</tr>
					<tr>
						<td>Primer Nombre:</td>
						<td>$nombre1</td>
					</tr>
					<tr>
						<td>Segundo Nombre:</td>
						<td>$nombre2</td>
					</tr>
					<tr>
						<td>Primer Apellido:</td>
						<td>$apellido1</td>
					</tr>
					<tr>
						<td>Segundo Apellido:</td>
						<td>$apellido2</td>
					</tr>
					<tr>
						<td>Cargo:</td>
						<td>$cargo</td>
					</tr>
					<tr>
						<td colspan='2'>
							<input type='submit' value='Guardar los Cambios' class='boton ui-button'>
							<input type='button' value='Descartar los Cambios' class='boton ui-button'>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>	
</html>		
";

?>