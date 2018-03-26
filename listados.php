<html>
  <head>
  		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="utu.css">
		<script type="text/javascript" src="../webcam.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
			function startTime() {
				var today=new Date();
				var h=today.getHours();
				var m=today.getMinutes();
				var s=today.getSeconds();
				m = checkTime(m);
				s = checkTime(s);
				document.getElementById('reloj').innerHTML = h+":"+m+":"+s;
				var t = setTimeout(function(){startTime()},500);
			}

			function checkTime(i) {
				if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
				return i;
			}
		</script>
		
    <title>Sistema de Control de Asistencias de Funcionarios</title>
	</head>
	<body ONLOAD="startTime();">
		<div id="GUI_Ingreso" class="bordes" style="height:auto;text-align:center;">
			<b>Seleccione el Tipo de Listado</b><br/><br/>
			<a href="">Listado para Impresión y/o Registro</a><br/>
			<a href="">Listado con Imágenes de Ingreso y Salida</a><br/>
		</div>
		<div id="volver">
			<a href='index.php'>
				Volver al Menú Principal
			</a>
		</div>
		<?php include "piedepagina.php"; ?>
	</body>
</html>