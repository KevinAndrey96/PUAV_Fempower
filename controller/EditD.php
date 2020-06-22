<?php
session_start();
require_once "../lib/PDO.php";

$NAME=$_POST["NAME"];
$NIT=$_POST["NIT"];
$LEGAL=$_POST["LEGAL"];
$CIIU=$_POST["CIIU"];
$ADDRESS=$_POST["ADDRESS"];
$PHONE=$_POST["PHONE"];
$CELL=$_POST["CELL"];
$TOWN=$_POST["TOWN"];
$WEB=$_POST["WEB"];


$USER=$_SESSION["UserName"];
$Q="SELECT * from usuarios where username='$USER'";
  foreach ($db->query($Q) as $Row) {
  	$USERID=$Row["id"];
  }

$Q="UPDATE demandantes_bi SET razon_social='$NAME', nit=$NIT, representante_legal='$LEGAL', ciiu=$CIIU, telefono='$PHONE', celular='$CELL', direccion='$ADDRESS', municipioCodigo=$TOWN, url_web='$WEB' where idUsuario=$USERID";

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