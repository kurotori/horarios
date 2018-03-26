
	<?php
	
	/*
	Página de registro de ingresos y egresos
	*/
	
	$titulo="Ingreso y Egreso de Funcionarios";
	/* Agregados al javascript de la página */
	$scriptJS="
		</script>
		<script type='text/javascript' src='ing_egr.js'></script>
		<script type='text/javascript'>
	";
	include "head.php";
	
	?>
	
	<!-- La sección body establece el enfoque en el campo cédula del formulario y arranca el script del reloj visible en la página -->
	<BODY ONLOAD="document.ingresofuncionarios.cedula.focus();startTime();">
		
		<!-- El div camara es donde se muestra la imágen de la cámara -->
		<div id="camara" class="bordes"></div>
		
		<!-- El div GUI_ingreso es el usado para mostrar el contenido principal de la página -->
		<div id="GUI_Ingreso" class="bordes">
			<p style="width:100%;text-align:center;top:5px;margin-top: 1px;margin-bottom: 1px;">
				<B>Sistema de Registro De Asistencias</B>
			</p>
			<form name="ingresofuncionarios" id="ingresofuncionarios" method="post" action="ing_egr2-v3.php" onsubmit="enviar();">
				<BR/>
				CI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="cedula" name="cedula" size="8" maxlength="8">
				<BR/>
				<span class="detalle">(Digite la c&eacute;dula sin puntos ni guiones <br/>
				Ej.: la CI 1.234.567-8 se escribe 12345678)</span>
				<br/><br/>
				<!-- Este campo oculto es donde se agregan los datos de imágen desde la cámara-->
				<input type="hidden" id="imagen" name="imagen">
				<input type="button" id="boton_R" value="Firmar" onclick="enviar();">
			</form>
		</div>	
		<div id="espere" class="bordes">
			<img width="10%" src="loading.gif"><br/>
		Espere un momento.<br/>
		El sistema esta procesando su registro.
		</div>
	<?php 
		/* 
		piedepagina.php contiene algunos detalles que complementan la apariencia de la página
		como ser el banner con el nombre de la escuela y el reloj.
		*/
		
		include "piedepagina.php"; 
	?>
	</BODY>
</HTML>
