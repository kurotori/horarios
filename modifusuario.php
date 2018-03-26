<?php
	$cedula=$_GET['cedula'];
	
	include "datos.php";
	$scriptJS="
		function volver() {
			window.history.back()
		}
	";
	$titulo="Modificar Funcionario Registrado";
	include "head-basico.php";
	
	include "piedepagina.php";
	
	$nombre1="";
	$nombre2="";
	$apellido1="";
	$apellido2="";
	$tipocargo="";
	$valorcargo="";
	
	$BDConn=mysqli_connect($servidor,$usuario,$pword,$baseD);
	if (mysqli_connect_errno($BDConn)){
		echo "Fallo al conectar al servidor MySQL en $servidor: ".mysqli_connect_error();
		}
	else {
		echo "BD OK!!!";
	}
	
	$consulta= mysqli_query($BDConn,"SELECT nombre1, nombre2, apellido1, apellido2, tipocargo FROM usuarios WHERE cedula='$cedula'");
	$consCargos=mysqli_query($BDConn,"SELECT cargo FROM cargos"); 
	while ($fila = mysqli_fetch_assoc($consulta)) {
		
		$nombre1=$fila['nombre1'];
		$nombre2=$fila['nombre2'];
		$apellido1=$fila['apellido1'];
		$apellido2=$fila['apellido2'];
		$tipocargo=$fila['tipocargo'];
	}
	
	echo "
	<body ONLOAD='startTime();'>
	<div id='GUI_Ingreso' class='bordes' style='width:650px;height:auto;text-align:center;'>
		<b>Modificar Usuario</b>
		<br><br>
		<form name='registrodeusuarios' method='post' action='modifusuario2.php'>
			<input name='cedulaVieja' type='hidden' value='$cedula'>
			<table class='tg'>
			  <tr>
				<td></td>
				<td style='width:30%;'>
					<b>Datos Actuales</b>
				</td>
				<td>
					<b>Datos Nuevos</b>
				</td>
			  </tr>
			  
			  <tr>
				<td class='tg-031e'><b>CI:</b> </td>
				<td class='datosact'>$cedula</td>
				<td class='tg-031e' >
					<input type='text' name='cedula' size='8' maxlength='8' style='font-size:20px' value='$cedula'>
				</td>
			  </tr>
			  
			  <tr>
				<td class='tg-031e'><b>Primer Nombre:</b></td>
				<td class='datosact'>$nombre1</td>
				<td class='tg-031e'>
					<input type='text' name='nombre1' size='25' maxlength='50' style='font-size:20px' value='$nombre1'>
				</td>
			  </tr>
			  
			  <tr>
				<td class='tg-031e'><b>Segundo Nombre:</b></td>
				<td class='datosact'>$nombre2</td>
				<td class='tg-031e'>
					<input type='text' name='nombre2' size='25' maxlength='50' style='font-size:20px' value='$nombre2'>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'><b>Primer Apellido:</b></td>
				<td class='datosact'>$apellido1</td>
				<td class='tg-031e'>
					<input type='text' name='apellido1' size='25' maxlength='50' style='font-size:20px' value='$apellido1'>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'><b>Segundo Apellido:</b></td>
				<td class='datosact'>$apellido2</td>
				<td class='tg-031e'>
					<input type='text' name='apellido2' size='25' maxlength='50' style='font-size:20px' value='$apellido2'>
				</td>
			  </tr>
			  <tr>
				<td class='tg-031e'><b>Tipo de Cargo:</b></td>
				<td class='datosact'>$tipocargo</td>
				<td class='tg-031e'>
					<Select name='tipodecargo' style='font-size:20px'>";
				while($fila2 = mysqli_fetch_assoc($consCargos)){
					$cargo=$fila2['cargo'];
					echo "<option>$cargo</option>";
				}
				echo "</select>
				</td>
			  </tr>
			  
			  <tr>
				<td class='tg-031e' colspan=3>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
			  </tr>
			  
			  <tr>
				<td class='tg-031e' style='text-align:center;' colspan=3>
					<input type='submit' value='Modificar Usuario' class='boton ui-button'>
					<input type='button' value='Cancelar' class='boton ui-button' onClick='volver()'>
				</td>
			  </tr>
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