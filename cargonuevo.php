<?php 
	$cargo=$_POST['cargo'];
	$funcion=$_POST['funcion'];
	$id=$_POST['id'];
	
	$titulo='Listado de Cargos';
	
	include 'piedepagina.php';
	
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
			secs = 1
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
	";
	
	include "head-basico.php";
	include "datos.php";
	
	echo "
		<body ONLOAD='InitializeTimer();startTime();'>
			<!-- Este formulario permite regresar a la página de registro -->
			<form name='actualizar' action='listacargos.php'>
				<input type='hidden' name='nada' value='0'>
			</form>
	";
	$BDConn=mysqli_connect($servidor,$usuario,$pword,$baseD);
	if (mysqli_connect_errno($BDConn)){
		echo 'Fallo al conectar a MySQL: ' . mysqli_connect_error();
		}
	else {
		echo "BD OK!!!";
	}
	
	if ($funcion=="guardar"){
		$consulta= mysqli_query($BDConn,"INSERT INTO cargos(id,cargo) values(NULL,'$cargo')");
		echo "
		<div class='importante'>
			Se ha creado con éxito el nuevo cargo <b>$cargo</b>
		</div>
		";
	}
	
	if ($funcion=="borrar"){
		$consulta=mysqli_query($BDConn,"DELETE FROM cargos WHERE id='$id'");
	}
	
	
	mysqli_close($BDConn);
	echo "
		<div id='volver'>
				<a href='index.php'>
					Volver al Men&uacute; Principal
				</a>
			</div>			
			</body>
		";
	
?>	