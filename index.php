<html>
  <head>
  		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="utu.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">

		
		</script>
<?php
	$titulo="Sistema de Control de Asistencias de Funcionarios";
	$scriptJS="
		$(document).ready(function(){
			$('.listOpLk').click(
				function(){
					$(this).find('.listOp').slideToggle();
				}
			);
		});";
	include "head-basico.php";
?>		

  <body ONLOAD="startTime();">
<div id="GUI_Ingreso" class="bordes" style="height:auto;text-align:center;">

<b>Opciones Del Sistema:</b><BR/><BR/>

<A HREF="ing_egr1.php">Ventana de Registro de Ingresos</a>
<br/><br/>
<span class="listOpLk">
	<A  HREF="#">Gestión del Sistema</a>
	<span class="listOp">
		<ul>
			<li><A HREF="registrarusuario1.php">Ingresar Usuarios al Sistema</a></li>
			<li><a href="listausuarios.php?usuario=">Administración de Usuarios</a></li>
			<li><A HREF="listacargos.php">Modificar Listado de Cargos Disponibles</a></li>
			<li><A HREF="registroadmin.php">Crear Usuario Administrativo</a></li>
			
		</ul>
	</span>
</span>	
<br/><br/>
<span class="listOpLk">
	<A  HREF="#">Generar Listados de Control de Asistencias</a>
	<span class="listOp">
			<ul>
				<li><a href="historialfuncionarios1.php">Listado para Impresi&oacute;n y/o Registro</a></li>
				<li><a href="historialfuncionarios3.php">Listado con Im&aacute;genes de Ingreso y Salida</a></li>
				<li><A HREF="funcionariospresentes.php">Listado de Funcionarios Presentes</a></li>
			</ul>
	</span>
</span>
<br/><br/>

<?php include "piedepagina.php"; ?>
  </body>
</html>
