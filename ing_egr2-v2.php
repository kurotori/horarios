<?php	
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
			secs = 5
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
	include "piedepagina.php";
?>
<body onload="InitializeTimer();startTime();">

<!-- Este formulario permite regresar a la página de registro -->
	<form name="actualizar" action="ing_egr1.php">
		<input type="hidden" name="nada" value="0">
	</form>

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

/* -------- CONEXION A LA BASE DE DATOS -------- */	
	/* Datos de acceso a la base de datos */
	include "datos.php";
	
	/* Conexión al servidor */
	$conectar_base=mysql_connect($servidor,$usuario,$pword)
	or die("
			<div class='bordes alerta'>
				<img src='alerta.png'>
				<br/><br/>
				No se pudo establecer una conexi&oacute;n con el servidor MySQL<br/>
				Detalles del error: ".
				mysql_error().
			"</div>"
			);
	
	/* Selección de la base de datos */
	mysql_select_db ($baseD, $conectar_base) 
	or die ("
			<div class='bordes alerta'>
				<img src='alerta.png'>
				<br/><br/>
				No se pudo acceder a la Base de Datos<br/>
				Detalles del error: ".
				mysql_error().
			"</div>"
			);
	
/* --------	-------- -------- -------- -------- */

/* -------- 1) CONSULTA DE USUARIO -------- */	
/* Consulta para asegurar que el usuario esta registrado en el sistema y ya obtener sus datos y la fecha y hora actual del sistema*/
	$consultarUsuario=mysql_query("select current_time,current_date,nombre1,nombre2,apellido1,apellido2 from usuarios where cedula='$cedula'") 
	or die("
			<div class='bordes alerta'>
				<img src='alerta.png'>
				<br/><br/>
				No se pudo realizar la consulta de usuarios en el sistema<br/>
				Detalles del error: ".
				mysql_error().
			"</div>"	
			);
	
	/*
	RECORDATORIO: No hace falta un chequeo de existencia de datos en el array row_u, ya que de no haber datos
	(lo que implica una consulta de funcionarios vacía) sencillamente el programa no entra en el while
	*/
	while($row_u = mysql_fetch_array($consultarUsuario)){
		$contarcasosusuario[]=$row_u;
		
			if( count($contarcasosusuario[])==0 ){
				echo("<div class='bordes alerta'>
					<img src='alerta.png'>
					<br/><br/>
					La C&eacute;dula de Identidad ingresada<br/> no se encuentra en el sistema<br/>
					</div>
					");
				exit;
			}
			else{
		/*
		Asignación de datos de la consulta
		*/
		$hora=$row_u[0];
		$fecha=$row_u[1];
		$nombre1=$row_u[2];
		$nombre2=$row_u[3];
		$apellido1=$row_u[4];
		$apellido2=$row_u[5];
		
		/*
		Chequeo de Ingreso: el sistema chequea si el usuario tiene una entrada "abierta" el mismo día. Para ello chequea que la existencia de un registro del usuario que tenga como hora de salida las 23:59:00, una hora de salida asignada de forma automática a todos los
		registros cuando el usuario registra una entrada.
		*/
		
		$consultaIngreso=mysql_query("select count(*) from registro where cedula='$cedula' and fecha='$fecha' and horasal='23:59:00.000000'") 
		or die ("
			<div class='bordes alerta'>
				<img src='alerta.png'>
				<br/><br/>
				No se pudo realizar la consulta de registros en el sistema<br/>
				Detalles del error: ".
				mysql_error().
			"</div>"
		);	
		while( $row_ing=mysql_fetch_array($consultaIngreso) ){
			$cuenta_ing=$row_ing[0];
			
			/*
			$cuenta_ing almacena el valor obtenido en la consulta $consultaIngreso, que es un conteo de los registros "abiertos". Si el conteo es 0, no hay registros abiertos y se genera uno nuevo, de lo contrario, se debe "cerrar" el registro abierto.
			*/
			
			if($cuenta_ing==0){
				/*Generación de un REGISTRO ABIERTO*/
				mysql_query("INSERT INTO registro(`cedula`, `fecha`, `horaent`, `horasal`, `imgdata_ent`, `imgdata_sal`) VALUES('$cedula','$fecha','$hora','23:59:00.000000','$imagen','$vacio')")
				or die ("
					<div class='bordes alerta'>
						<img src='alerta.png'>
						<br/><br/>
						No se pudo realizar el registro de su ingreso en el sistema<br/>
						ESTO ES UN ERROR GRAVE<br/>
						CONTACTE AL ADMINISTRADOR DE INMEDIATO<br/>
						Detalles del error: ".
						mysql_error().
					"</div>"
				);
				
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
				/*Generacion del CIERRE DE UN REGISTRO*/
			else{
				mysql_query("update registro set horasal=current_time(),imgdata_sal='$imagen' where cedula='$cedula' and fecha='$fecha' and horasal='23:59:00.000000'")
				or die ("
					<div class='bordes alerta'>
						<img src='alerta.png'>
						<br/><br/>
						No se pudo realizar el registro de su salida en el sistema<br/>
						ESTO ES UN ERROR GRAVE<br/>
						CONTACTE AL ADMINISTRADOR DE INMEDIATO<br/>
						Detalles del error: ".
						mysql_error().
					"</div>"
				);
				
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
	}
	mysql_close($conectar_base);
?>