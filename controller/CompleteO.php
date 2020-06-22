<?php
session_start();
require_once "../lib/PDO.php";

$FIRSTNAME = $_POST["FIRSTNAME"];
$SECONDNAME = $_POST["SECONDNAME"];
$LASTNAME1 = $_POST["LASTNAME1"];
$LASTNAME2 = $_POST["LASTNAME2"];
$BIRTHDATE = $_POST["BIRTHDATE"];
$PHONE1 = $_POST["PHONE1"];
$PHONE2 = $_POST["PHONE2"];
$TOWN = $_POST["TOWN"];
$GENDER = $_POST["GENDER"];
$ADDRESS = $_POST["ADDRESS"];
$TOWN2 = $_POST["TOWN2"];
$MARITAL = $_POST["MARITAL"];
$FOREIGNER = $_POST["FOREIGNER"];
$COUNTRY = $_POST["COUNTRY"];
$MILITARY = $_POST["MILITARY"];
$ETHNICITY = $_POST["ETHNICITY"];
$DISABILITY = $_POST["DISABILITY"];
if($FOREIGNER==2201)//No
{
	$COUNTRY=4552;
}
if($GENDER==19)//FEM
{
	$MILITARY=2201;
}
if($DISABILITY=="")
{
	$DISABILITY=0;
}else
{
	$DISABILITY=1;
}
//echo $DISABILITY;
$DISABILITYF = $_POST["DISABILITYF"];
if($DISABILITYF=="")
{
	$DISABILITYF=0;
}else
{
	$DISABILITYF=1;
}
//echo $DISABILITYF;
$DISABILITYV = $_POST["DISABILITYV"];
if($DISABILITYV=="")
{
	$DISABILITYV=0;
}else
{
	$DISABILITYV=1;
}
//echo $DISABILITYV;
$DISABILITYA = $_POST["DISABILITYA"];
if($DISABILITYA=="")
{
	$DISABILITYA=0;
}else
{
	$DISABILITYA=1;
}
//echo $DISABILITYA;
$DISABILITYVE = $_POST["DISABILITYVE"];
if($DISABILITYVE=="")
{
	$DISABILITYVE=0;
}else
{
	$DISABILITYVE=1;
}
//echo $DISABILITYVE;
$DISABILITYI = $_POST["DISABILITYI"];
if($DISABILITYI=="")
{
	$DISABILITYI=0;
}else
{
	$DISABILITYI=1;
}
//echo $DISABILITYI;
$DISABILITYP = $_POST["DISABILITYP"];
if($DISABILITYP=="")
{
	$DISABILITYP=0;
}else
{
	$DISABILITYP=1;
}
//echo $DISABILITYP;
$VICTIM = $_POST["VICTIM"];
if($VICTIM=="")
{
	$VICTIM=2201;
}else
{
	$VICTIM=2200;
}

//$ORIENTATION = $_POST["ORIENTATION"];

$PEOPLE = $_POST["PEOPLE"];
$ZONE = $_POST["ZONE"];
$STRATUM = $_POST["STRATUM"];
$TIME = $_POST["TIME"];
$SALARY = $_POST["SALARY"];
$ORIENTATION=2201;

$USER=$_SESSION["UserName"];
$Q="SELECT * from usuarios where username='$USER'";
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

$Q="INSERT into oferentes_bi(idUsuario,nombre1,nombre2,apellido1,apellido2,fechaNacimiento,telefono1,telefono2,municipioNacimientoCodigo,generoCodigo,direccion,municipioViviendaCodigo,estadoCivilCodigo,extranjeroCodigo,paisCodigo,libretaMilitar,etnia,discapacidad,discapacidadFisica, discapacidadVisual,discapacidadAuditiva,discapacidadVerbal,discapacidadIntelectual, discapacidadPsicosocial,victimaConflicto,personasCargo,zonaCodigo,estratoCodigo,tiempoBuscandoTrabajo,rangoSueldoCodigo,orientacionOcupacional,idArchivo) values ($USERID,'$FIRSTNAME','$SECONDNAME','$LASTNAME1','$LASTNAME2','$BIRTHDATE','$PHONE1','$PHONE2',$TOWN,$GENDER,'$ADDRESS',$TOWN2,$MARITAL,$FOREIGNER,$COUNTRY,$MILITARY,$ETHNICITY,$DISABILITY,$DISABILITYF,$DISABILITYV,$DISABILITYA,$DISABILITYVE,$DISABILITYI,$DISABILITYP,$VICTIM,$PEOPLE,$ZONE,'$STRATUM',$TIME,$SALARY,$ORIENTATION,$Archivo)";

} else {
    
$Q="INSERT into oferentes_bi(idUsuario,nombre1,nombre2,apellido1,apellido2,fechaNacimiento,telefono1,telefono2,municipioNacimientoCodigo,generoCodigo,direccion,municipioViviendaCodigo,estadoCivilCodigo,extranjeroCodigo,paisCodigo,libretaMilitar,etnia,discapacidad,discapacidadFisica, discapacidadVisual,discapacidadAuditiva,discapacidadVerbal,discapacidadIntelectual, discapacidadPsicosocial,victimaConflicto,personasCargo,zonaCodigo,estratoCodigo,tiempoBuscandoTrabajo,rangoSueldoCodigo,orientacionOcupacional) values ($USERID,'$FIRSTNAME','$SECONDNAME','$LASTNAME1','$LASTNAME2','$BIRTHDATE','$PHONE1','$PHONE2',$TOWN,$GENDER,'$ADDRESS',$TOWN2,$MARITAL,$FOREIGNER,$COUNTRY,$MILITARY,$ETHNICITY,$DISABILITY,$DISABILITYF,$DISABILITYV,$DISABILITYA,$DISABILITYVE,$DISABILITYI,$DISABILITYP,$VICTIM,$PEOPLE,$ZONE,'$STRATUM',$TIME,$SALARY,$ORIENTATION)";
}


try
{
	$db->query($Q);
}catch(Exception $e)
{
	echo "Error: ".$e;
}

?>
<script type="text/javascript">
	window.alert("Datos completados con éxito");
	window.location.href="../welcome.php";
</script>