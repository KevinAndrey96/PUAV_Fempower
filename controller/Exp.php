<?php
session_start();
require_once "../lib/PDO.php";
/*
$CAPACITATION = $_POST["CAPACITATION"];
$FORMAL = $_POST["FORMAL"];
$TITLE = $_POST["TITLE"];
$INSTITUTION = $_POST["INSTITUTION"];
$MODALITY = $_POST["MODALITY"];
$YEAR = $_POST["YEAR"];
$MONTH = $_POST["MONTH"];
$FINISHED = $_POST["FINISHED"];
$MONTHS = $_POST["MONTHS"];
*/
$COMPANY = $_POST["COMPANY"];
$PHONE = $_POST["PHONE"];
$TOWN = $_POST["TOWN"];
$INTERNSHIP = $_POST["INTERNSHIP"];
$DATE1 = $_POST["DATE1"];
$WORK = $_POST["WORK"];
$DATE2 = $_POST["DATE2"];
$OCUPATION = $_POST["OCUPATION"];
$POSITION = $_POST["POSITION"];
$AWARDS = $_POST["AWARDS"];


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


$Q="INSERT INTO oferentes_experiencia (idOferente,empresa,telefono,municipio,pasantia,fechaIngreso,empleoActual,fechaSalida,ocupacion,cargo,logros,idArchivo) values ($USERID,'$COMPANY','$PHONE',$TOWN,$INTERNSHIP, '$DATE1',$WORK,'$DATE2',$OCUPATION,'$POSITION','$AWARDS',$Archivo)";
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