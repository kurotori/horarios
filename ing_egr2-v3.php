<?php

	/* Selección de zona horaria para asegurar que la hora correcta es almacenada en el registro */
	date_default_timezone_set("America/Montevideo");
	
	/*
	Recepción de los datos del formulario de la página de registro y declaración de variables globales
	*/
	$imagen=($_POST["imagen"]);
	$cedula =($_POST["cedula"]);
	$vacio='&quot;vacio.png&quot;';
	$fecha="";
	$hora="";
	
	$titulo="Registro de Funcionarios";
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
	";
	include "datos.php";
	include "head-basico.php";
	include "piedepagina.php";
	
	echo "
		<body ONLOAD='InitializeTimer();startTime();'>
			<!--  Este formulario permite regresar a la página de registro -->
			<form name='actualizar' action='ing_egr1.php'>
				<input type='hidden' name='nada' value='0'>
			</form>
	";
	/* -------- CONEXION A LA BASE DE DATOS -------- */	
	
	$BDConn=mysqli_connect($servidor,$usuario,$pword,$baseD);
	
	
	$BDStatus="";
	
	if (mysqli_connect_errno($BDConn)){
		echo 'Fallo al conectar a MySQL: ' . mysqli_connect_error();
		}
	else {
		
		echo "<script>console.log('BD OK!!!')</script>";
	}
	
	
	
	$consulta=mysqli_query($BDConn,"select current_time,current_date,nombre1,nombre2,apellido1,apellido2 from usuarios where cedula='$cedula'");
	
	$fila=mysqli_fetch_assoc($consulta);
	
	if(count($fila)==0){
		echo("<div class='bordes alerta'>
				<img src='alerta.png'>
				<br/><br/>
				La C&eacute;dula de Identidad ingresada<br/> no se encuentra en el sistema<br/>
				</div>
			");
		exit;
		}
	else{
		echo "else OK";
				$hora=$fila['current_time'];
				$fecha=$fila['current_date'];
				$nombre1=$fila['nombre1'];
				$nombre2=$fila['nombre2'];
				$apellido1=$fila['apellido1'];
				$apellido2=$fila['apellido2'];
				echo $hora;
				$consultaIngreso=mysqli_query($BDConn, "select count(*) from registro where cedula='$cedula' and fecha='$fecha' and horasal='23:59:00.000000'");
				
				while($row_ing=$consultaIngreso->fetch_array(MYSQLI_NUM)){
					$cuenta_ing=$row_ing[0];
					
					if($cuenta_ing==0){
					/*Generación de un REGISTRO ABIERTO*/
						mysqli_query($BDConn, "INSERT INTO registro(`cedula`, `fecha`, `horaent`, `horasal`, `imgdata_ent`, `imgdata_sal`) VALUES('$cedula','$fecha','$hora','23:59:00.000000','$imagen','$vacio')");
						echo("
							<br/>
							<div id='camara'>
								<img src=$imagen>
							</div>
							<div id='GUI_Ingreso' class='bordes' style='height:auto;'>
								<center>
									Hola, <b>$nombre1 $nombre2 $apellido1</b><br/><br/>
									Se registr&oacute; tu <b>Entrada</b><br/>
									A las <b>$hora</b> del <b>$fecha</b>
								</center>
							</div>
						");
					}
					else{
						mysqli_query($BDConn, "update registro set horasal=current_time(),imgdata_sal='$imagen' where cedula='$cedula' and fecha='$fecha' and horasal='23:59:00.000000'");
						echo("
							<br/>
							<div id='camara'>
								<img src=$imagen>
							</div>
							<div id='GUI_Ingreso' class='bordes' style='height:auto;'>
								<center>
									Hola, <b>$nombre1 $nombre2 $apellido1</b><br/><br/>
									Se registr&oacute; tu <b>Salida</b><br/>
									A las <b>$hora</b> del <b>$fecha</b>
								</center>
							</div>
						");
					}
				}
			
				
		}
	
	
	
	mysqli_close($BDConn);
?>