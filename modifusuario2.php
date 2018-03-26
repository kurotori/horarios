<?php
	
	$cedulaVieja=$_POST['cedulaVieja'];
	$cedula=$_POST['cedula'];
	$nombre1=$_POST['nombre1'];
	$nombre2=$_POST['nombre2'];
	$apellido1=$_POST['apellido1'];
	$apellido2=$_POST['apellido2'];
	$tipocargo=$_POST['tipodecargo'];
	
	include "datos.php";
	$scriptJS="
	</script>
	<!-- Este script sirve para regresar a la página de registro de forma automática -->
	<SCRIPT LANGUAGE = 'JavaScript'>
		var secs
		var timerID = null
		var timerRunning = false
		var delay = 1000

		function InitializeTimer()
		{
			// Set the length of the timer, in seconds
			secs = 3
			StopTheClock()
			StartTheTimer()
		}

		function StopTheClock()
		{
			if(timerRunning)
				clearTimeout(timerID)
			timerRunning = false
		}

		function StartTheTimer()
		{
			if (secs==0)
			{
				StopTheClock()
				// Here's where you put something useful that's
				// supposed to happen after the allotted time.
				// For example, you could display a message:
				document.actualizar.submit();
			}
			else
			{
				self.status = secs
				secs = secs - 1
				timerRunning = true
				timerID = self.setTimeout('StartTheTimer()', delay)
			}
		}
	
		function volver() {
			window.history.back()
		}
	";
	
	$titulo="Modificar Funcionario Registrado";
	include "head-basico.php";
	
	include "piedepagina.php";
	$BDConn=mysqli_connect($servidor,$usuario,$pword,$baseD);
	if (mysqli_connect_errno($BDConn)){
		echo "Fallo al conectar al servidor MySQL en $servidor: ".mysqli_connect_error();
		}
	else {
		echo "BD OK!!!";
	}

	
	$consulta= mysqli_query($BDConn,"UPDATE usuarios SET cedula='$cedula',nombre1='$nombre1',nombre2='$nombre2',apellido1='$apellido1',apellido2='$apellido2',tipocargo='$tipocargo' WHERE cedula='$cedulaVieja'");
	
	
	echo "
	<body ONLOAD='InitializeTimer();startTime();'>
				<!--  Este formulario permite regresar a la página de registro -->
			<form name='actualizar' action='listausuarios.php'>
				<input type='hidden' name='usuario' value=''>
			</form>
	";
	
	echo " <div style='font-weight:normal;' class='importante'> 
				Se han modificado con éxito los datos del funcionario <br/>
				<b>$nombre1 $nombre2 $apellido1 $apellido2</b>
			</div>
			<div id='volver'>
				<a href='index.php'>
					Volver al Men&uacute; Principal
				</a>
			</div>
			";
	
	
	
	mysqli_close($BDConn);
?>