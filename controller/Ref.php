<?php
session_start();
require_once "../lib/PDO.php";

$NAME = $_POST["NAME"];
$TYPE = $_POST["TYPE"];
$PHONE = $_POST["PHONE"];
$CELL = $_POST["CELL"];
$ADDRESS = $_POST["ADDRESS"];
$OCUPATION = $_POST["OCUPATION"];


$USER=$_SESSION["UserName"];
$Q="SELECT * from usuarios where username='$USER'";
  foreach ($db->query($Q) as $Row) {
  	$USERID=$Row["id"];
  }
 $Q="SELECT * from oferentes_bi where idUsuario ='$USERID'";
  foreach ($db->query($Q) as $Row) {
  	$USERID=$Row["id"];
  }
 


$dir_subida = '../files/';
$fichero_subido = $dir_subida . basename($_FILES['FILE']['name']);

$N=basename($_FILES['FILE']['name']);
$info = new SplFileInfo($N);
$T=$info->getExtension();

if (move_uploaded_file($_FILES['FILE']['tmp_name'], $fichero_subido)) {
    $Q="INSERT INTO archivos (nombre, descripcion, contenido, tipo) VALUES ('$N','','','$T')";
    $db->query($Q);
    $Archivo=$db->lastInsertId();
} else {
    echo "ERROR EN ARCHIVOS";
}


$Q="INSERT INTO oferentes_referencias (idOferente,nombre, tipoReferencia,telefono,celular,direccion,ocupacion,idArchivo) values ($USERID,'$NAME',$TYPE,'$PHONE','$CELL','$ADDRESS', '$OCUPATION',$Archivo)";
try
{
	$db->query($Q);
}catch(Exception $e)
{
	echo "Error1: ".$e;
}/*
$Q="INSERT INTO oferentes_educacion(idOferente,capacitacionTrabajo,formal,titulo,institucion,presencialVirtual,anoFinalizacion,mesFinalizacion,termino,mesesEstudio) values ($USERID,$CAPACITATION,$FORMAL,'$TITLE','$INSTITUTION','$MODALITY',$YEAR,$MONTH,$FINISHED,$MONTHS)";
try
{
	$db->query($Q);
}catch(Exception $e)
{
	echo "Error2: ".$e;
}
*/
?>
<script type="text/javascript">
	window.alert("Datos completados con éxito");
	window.location.href="../welcome.php";
</script>