<?php
	//echo "Esta página aún esta en desarrollo";
	//exit;
	
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
			secs = 4
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
	$ingreso=0;
	$contarCasosUsuario=[];
	$datosusuario

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
		
	/* Consultas para asegurar que el usuario esta registrado en el sistema y ya obtener sus datos*/
	$consultarusuario=mysql_query("select nombre1,nombre2,apellido1,apellido2 from usuarios where cedula='$cedula'") 
	or die("
			<div class='bordes alerta'>
				<img src='alerta.png'>
				<br/><br/>
				No se pudo realizar la consulta de usuarios en el sistema<br/>
				Detalles del error: ".
				mysql_error().
			"</div>"	
			);
	/*Primer Bucle: chequea que la consulta anterior devuelva algún usuario,
		de lo contrario termina el proceso y muestra un mensaje de error.
	*/
	
	
	while($row_u = mysql_fetch_array($resultado_registros)){
		$contarcasosusuario[]=$row_u;
		
	}
	
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
		/* Consulta de ingreso, esta consulta confirma si el usuario ya realizó un registro de entrada ese día
			mas temprano y determina si es una entrada o una salida. Por más detalles sobre el método de registro
			de asistencias ver más abajo.
		*/
		$consultaIng=mysql_query("select count(*) from registro where cedula='$cedula' and fecha=current_date() and horasal='23:59:00'") 
		or die("
				<div class='bordes alerta'>
					<img src='alerta.png'>
					<br/><br/>
					Ocurrió un error al realizar la consulta de ingresos<br/>
					Detalles del error: ".
					mysql_error().
				"</div>"
				);

		/*
		El método list() permite asignar los valores contenidos en un array a un conjunto de variables (los
		valores se asignan en el orden del array). En este caso se le asigna el valor del array de la primera
		fila obtenida mediante la consulta especificada en $consultaIng. Esta consulta devuelve	un resultado 
		cuyos únicos posibles valores deberían ser 1 ó 0, así que list() lo asigna a la variable $contarcasos
		cuyo valor se usa para evaluar el tipo de ingreso.
		*/
		while( list($contarcasos)=mysql_fetch_row($consultaIng) ){
			/*
			$consultaUsuario obtiene los datos del usuario mas los valores current_time (la hora actual) y
			current_date (la fecha actual) para almacenarlos luego en el registro.
			*/
			$consultaUsuario=mysql_query("select current_time,current_date,nombre1,nombre2,apellido1 from usuarios where cedula='$cedula'") 
			or die("Imposible encontrar los datos solicitados en la tabla usuarios".mysql_error());
			
			while( list($hora,$fecha,$nombre1,$nombre2,$apellido)=mysql_fetch_row($consultaUsuario) ){
				if ($contarcasos==0){
					/*
					Si $contarcasos es 0, entonces el usuario no tiene ingresos "abiertos" ese día, se debe
					generar uno				
					*/
					mysql_query("insert into registro ")
					
					
					$ingreso=0;
				} 
				else{
					$ingreso=1;
				}
			}
		}
	
	
	}
	
	
	
	
	
	
	while(list($contarcasosusuario)=mysql_fetch_row($consultarusuario)){
		if ($contarcasosusuario==0) {
			echo("<div class='bordes alerta'>
					<img src='alerta.png'>
					<br/><br/>
					La C&eacute;dula de Identidad ingresada<br/> no se encuentra en el sistema<br/>
					</div>
				");
			exit;
		};
	};

	

	while(list($contarcasos)=mysql_fetch_row($consulta)){
		if ($contarcasos==0){$ingreso=0;} 
		else {$ingreso=1;};
	};

	$conspers=mysql_query("select current_time,current_date,nombre1,apellido1,tipocargo from usuarios where cedula='$cedula'") 
	or die("Imposible encontrar los datos solicitados en la tabla usuarios".mysql_error());


	while(list($vt,$v0,$v1,$v2,$v3)=mysql_fetch_row($conspers)){
		$hora=$vt;$fechayhora=$v0;$nombre1=$v1;$apellido1=$v2;$tipocargo=$v3;

		$ano=substr ("$fechayhora", 0, 4);
		$mes=substr ("$fechayhora", 4, 4);
		$dia=substr ("$fechayhora", 8, 9);

		$fechayhora="$dia$mes$ano";

		if ($tipocargo=="Docente"){
			$tipocargo="Docente";
		} 
		else{
			$tipocargo="Básico";
		};
	 };



	if ($ingreso==0){
		mysql_query("INSERT INTO registro(`cedula`, `fecha`, `horaent`, `horasal`, `imgdata_ent`, `imgdata_sal`) VALUES('$cedula',now(),now(),'23:59:00.000000','$imagen','$vacio');") 
		or die("Imposible INSERTAR los datos solicitados en la tabla registro arriba".mysql_error());
	
		echo("
			<br/>
			<div id='camara'>
				<img src=$imagen>
			</div>
			<div id='GUI_Ingreso' class='bordes' style='height:auto;'>
				<center>
					Hola, <b>$nombre1 $apellido1</b><br/><br/>
					Se registr&oacute; tu <b>Entrada</b><br/>
					A las <b>$hora</b> del <b>$fechayhora</b>
				</center>
			</div>
			");
	} 
	else{
		mysql_query("update registro set horasal=current_time(),imgdata_sal='$imagen' where cedula='$cedula' and fecha=current_date() and horasal='23:59:00.000000'") 
		or die("Imposible INSERTAR los datos solicitados en la tabla registro abajo".mysql_error());

		echo("
			<div id='camara'>
				<img src=$imagen>
			</div>
			<div id='GUI_Ingreso' class='bordes'>
				<center>
				Nos vemos, <b>$nombre1 $apellido1</b><br/><br/>
				Se registr&oacute; tu <b>Salida</b><br/>
				A las <b>$hora</b> del <b>$fechayhora</b></center>
			</div>
		");

	};

	mysql_close($conectar_base);

	
	/*
		APENDICE
		+++ SOBRE EL MÉTODO DE REGISTRO DE ASISTENCIAS +++
		El sistema asume que en cualquier caso de ingreso la última hora posible de salida es
		a la hora que la escuela cierra sus puertas, a las 00:00, por lo que todo ingreso en el
		sistema se registra "ya cerrado", o sea, con la última hora de salida posible ya incluida 
		en el registro. Cuando el usuario desea registrar su salida, el sistema busca la existencia
		de otro registro del mismo día donde la hora de salida sea la hora de cierre. Si existe un
		registro con esos datos, el sistema reemplaza la hora de salida con la hora actual en el mismo.
		De lo contrario se trata de un ingreso y el sistema procede como se mencionó más arriba.
		Eso es en la teoría.
		Un inconveniente de usar 00:00 como última hora posible de salida es que la hora 00:00 corresponde
		con la primera hora del día actual, lo cual provocaría errores a la hora de calcular las horas de 
		trabajo registradas por cada usuario. Por ese motivo el sistema registra la hora 23:59:59 en su lugar,
		lo cual permite realizar el cálculo de horas correctamente, pero también implica que en caso de que
		usuario deba retirarse a las 00:00 o más tarde (como suele ser el caso de administrativos y auxiliares de
		servicio) EL USUARIO NO DEBE REGISTRAR SU SALIDA, la cual, si es posterior a las 00:00 ya fue tenida en 
		cuenta en su ingreso, de lo contrario el sistema lo interpretará como un nuevo ingreso en el día siguiente.
		*/
	
?>
	</body>
</html>