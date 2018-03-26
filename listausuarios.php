<?php
	$consultaUsers="";
	$nombreTabla="";
	$usuario=utf8_encode($_GET['usuario']);
	
	if($usuario==null){
		$consultaUsers="SELECT cedula,nombre1, nombre2, apellido1, apellido2, tipocargo from usuarios order by apellido1,apellido2,nombre2,nombre1";
		$nombreTabla="Listado completo de usuarios";
	}
	else{
		$consultaUsers="SELECT cedula,nombre1, nombre2, apellido1, apellido2, tipocargo from usuarios where cedula REGEXP '$usuario' OR nombre1 like _utf8 '%$usuario%' COLLATE utf8_general_ci OR nombre2 like _utf8 '%$usuario%' COLLATE utf8_general_ci OR apellido1 like _utf8 '%$usuario%' COLLATE utf8_general_ci OR apellido2 like _utf8 '%$usuario%' COLLATE utf8_general_ci order by apellido1,apellido2,nombre2,nombre1";
		$usuarioM=utf8_decode($usuario);
		$nombreTabla="Listado de usuarios cuyos datos coincidan con <b>$usuarioM</b>";
	}
	
	include "datos.php";
	$scriptJS="";
	$titulo="Listado de Funcionarios Registrados";
	include "head-basico.php";
	
	include "piedepagina.php"; 

	$BDConn=mysqli_connect($servidor,$usuario,$pword,$baseD);
	if (mysqli_connect_errno($BDConn)){
		echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
		}
	else {
		echo "BD OK!!!";
		}
	
	$nombre1="";
	$nombre2="";
	$apellido1="";
	$apellido2="";
	$tipocargo="";
	
	$consulta= mysqli_query($BDConn,$consultaUsers);
	echo "
	<body ONLOAD='startTime();'>
		<div id='borrar' class='borraruser alerta'>
		</div>
		<div id='GUI_Ingreso' class='bordes' style='height:auto;text-align:center;width:700px;'>
			<b>Listado de Funcionarios Registrados en el Sistema</b><br/><br/>
			
			
			<form name='buscarUser' method='get' action='listausuarios.php'>
					<span style='font-size:15px;font-weight:bold;'>Buscar Funcionario:</span> <input type='text' name='usuario'>
					<p style='font-size:small;'>
						Para la búsqueda puede indicar cédulas, nombres o apellidos completos o incompletos.
					</p>
			</form>
			<p style='font-size:medium;'>$nombreTabla</p>
			<table id='listadoAsistFoto'>
			<tr>
				<td style='height:2em;'><b>Funcionario</b></td>
				<td style='height:auto;'><b>Cédula</b></td>
				<td style='height:auto;'><b>Cargo</b></td>
				<td style='height:auto;width:33%;'><b>Opciones</b></td>
			</tr>";
			
	while ($fila = mysqli_fetch_assoc($consulta)) {
		
		$cedula=$fila['cedula'];
		$nombre1=$fila['nombre1'];
		$nombre2=$fila['nombre2'];
		$apellido1=$fila['apellido1'];
		$apellido2=$fila['apellido2'];
		$tipocargo=$fila['tipocargo'];
		
		$mensaje="Esta a punto de eliminar al usuario:<br/> <b>$nombre1 $nombre2 $apellido1 $apellido2</b><br/>Esta acción <b>NO SE PUEDE DESHACER</b><br/>Este usuario:<ul><li>No podrá realizar más ingresos en el sistema</li>			<li>No aparecerá más en los listados de usuarios</li></ul>Esta acción <b>NO ELIMINARÁ LOS REGISTROS REALIZADOS</b> por el usuario.";
		echo "
			<tr>
				<td style='height:auto;'>$nombre1 $nombre2 $apellido1 $apellido2</td>
				<td style='height:auto;'>&nbsp;&nbsp;$cedula&nbsp;&nbsp;</td>
				<td style='height:auto;'>$tipocargo</td>
				<td style='height:auto;'>
					<a href='modifusuario.php?cedula=$cedula'>
						<button class='boton_modif ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only' role='button'>
							<span class='ui-button-text'>Modificar</span>
						</button>
					</a>
					<button id='b$cedula' class='boton_peligro ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only' role='button'>
						<span class='ui-button-text'>Eliminar</span>
					</button>
					<script LANGUAGE = 'JavaScript'>
						$('#b$cedula').click(
							function(){
								$('.borraruser').fadeOut();
								$('#borrar').html('$mensaje');
								$('#borrar').fadeIn();
							}
						);
					</script>
				</td>
			</tr>";
	}
	
	echo "
			</table>
		</div>
		<div id='volver'>
			<a href='index.php'>
				Volver al Men&uacute; Principal
			</a>
		</div>
		";
		
	mysqli_close($BDConn);
?>
  </body>
</html>
	

