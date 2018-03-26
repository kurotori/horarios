<?php
include "datos.php";
	$scriptJS="
		function volver() {
			window.history.back()
		}
	";
	$titulo="Listado de Cargos";
	include "head-basico.php";
	
	include "piedepagina.php";
	
	$BDConn=mysqli_connect($servidor,$usuario,$pword,$baseD);
	if (mysqli_connect_errno($BDConn)){
		echo "Fallo al conectar al servidor MySQL en $servidor: ".mysqli_connect_error();
		}
	else {
		echo "BD OK!!!";
	}
	
	$consulta= mysqli_query($BDConn,"SELECT cargo,id FROM cargos");
	
	echo "
		<body ONLOAD='startTime();'>
			<div id='GUI_Ingreso' class='bordes' style='width:650px;height:auto;text-align:center;'>
			
			<table class='tabla'>
				<th>Cargos Definidos en el Sistema<br/><br/></th>
		";
	
	while ($fila = mysqli_fetch_assoc($consulta)) {
		$cargo=$fila['cargo'];
		$id=$fila['id'];
		echo "
			<tr><form method='post' action='cargonuevo.php'>
				
				<td>
						<input type=hidden name='id' value='$id'>
						<input type=hidden name='cargo' value='$cargo'>
						<input type=hidden name='funcion' value='borrar'>
						<input type=submit value='Eliminar'>
					
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$cargo</td>
				</form>
			</tr> 	
			";
	}			
		echo "
					<tr >
						<td colspan=2>
							<hr>
						</td>
					</tr>
					<tr>
						<form name='cargonuevo' method='post' action='cargonuevo.php'>
						<td>
						
							Agregar un nuevo cargo:<input type='text' name='cargo' size='20' maxlength='30' style='font-size:20px'>
							<input type='hidden' name='funcion' value='guardar'>
							<input type=hidden name='id' value='NULL'>
						</td>
						<td>
							<input type='submit' value='Agregar'>
						</td>
						</form>
					</tr>
					<tr>
						<td colspan=2>
						<br/><br/>
						<b>Nota:</b> Eliminar un cargo del sistema NO MODIFICA los usuarios que se hayan creado con dicho cargo.
						</td>
					</tr>
				</table>
				
			</div>
		<div id='volver'>
			<a href='index.php'>
				Volver al Men&uacute; Principal
			</a>
		</div>			
		</body>
		";
		mysqli_close($BDConn);
?>