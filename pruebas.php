<?php
$conectar_base=mysql_connect("localhost","pruebas","pruebas") or die("Imposible Conectar");

mysql_select_db ("horarios", $conectar_base) 
or die ("Imposible Seleccionar base de datos");

$imagen=($_POST["imagen"]);
$cedula =($_POST["cedula"]);

echo("<img src=$imagen> $cedula");

$sql = "insert into img(img_data,CI,fechaHora,ext) values('$imagen','$cedula','00000000-0000','jpg')";

mysql_query($sql) or die('Bad Query at 12');

echo "Success! You have inserted your picture!";



?>