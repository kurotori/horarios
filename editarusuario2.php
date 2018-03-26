<!DOCTYPE HTML>
<html>
<head>
<title>
Edición de Funcionarios
</title>
</head>

<body bgcolor="#ccccff">

<form name="actualizar" action="editarusuario3.php">

<input type="hidden" name="nada" value="0">

</form>


<?

$conectar_base=mysql_connect("127.0.0.1","root","root") or die("Imposible Conectar");
mysql_select_db ("horarios", $conectar_base) or die ("Imposible Seleccionar base de datos");

$cedula =($_POST["cedula"]);

$consultarusuario=mysql_query("select count(*) from usuarios where cedula='$cedula'") or die("Imposible encontrar los datos solicitados en la tabla usuarios".mysql_error());

while(list($contarcasosusuario)=mysql_fetch_row($consultarusuario)){
if ($contarcasosusuario==0) {echo("La c&eacute;dula de Identidad ingresada es incorrecta <a href='ing_egr1.php'>Volver</a>");exit;};

 };

$conspers=mysql_query("select * from usuarios where cedula='$cedula'") or die("Imposible encontrar los datos solicitados en la tabla usuarios".mysql_error());


while(list($v1,$v2,$v3,$v4,$v5,$v6)=mysql_fetch_row($conspers))

{$apellido1=$v2;$apellido2=$v3;$nombre1=$v4;$nombre2=$v5;$tipocargo=$v6;


$ano=substr ("$fechayhora", 0, 4);
$mes=substr ("$fechayhora", 4, 4);
$dia=substr ("$fechayhora", 8, 9);


$fechayhora="$dia$mes$ano";

if ($tipocargo=="Docente") {$tipocargo="Docente";} else {$tipocargo="Básico";};
 };

?>

<form name="edicion_usuario" action="editarusuario3.php" method="post">

<center><br><br><br><br><table border='10' bordercolor='black' cellspacing='10' cellpadding='5' bgcolor='#aaaaaa'><tr><td bgcolor='#77dd77'><font face='verdana' size='2'>Funcionario<td bgcolor='#ccffcc'><font face='verdana' size='2'>Apellido <input type="text" name="apellido1" value="<?echo($apellido1);?>"> Nombre <input type="text" name="nombre1" value="<?echo($nombre1);?>">
<tr border='5'><td bgcolor='#77dd77'><font face='verdana' size='2'> Tipo de cargo<td bgcolor='#ccffcc'><font face='verdana' size='2'> <Select name="tipocargo">
<option>Básico</option>
<option>Docente</option>
<option>Polic&iacute;a</option>
</select>
<tr><td bgcolor='#77dd77'><font face='verdana' size='2'>Documento<td bgcolor='#ccffcc'><font color='red' face='verdana' size ='2'><b><input type="text" size="7" maxlength="8" name="cedulanueva" value="<?echo($cedula);?>"></b></font>
<input type="hidden" name="cedula" value="<?echo($cedula);?>">
<input type="submit" value="Guardar datos">
</table><br><br><a href='index.php'>MENU</a>

<?

mysql_close($conectar_base);

?>
