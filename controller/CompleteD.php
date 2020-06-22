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

$Q="INSERT INTO demandantes_bi(idUsuario, razon_social,nit,representante_legal,ciiu,telefono,celular,direccion,municipioCodigo,url_web) values($USERID,'$NAME',$NIT,'$LEGAL',$CIIU,'$PHONE','$CELL','$ADDRESS',$TOWN,'$WEB')";
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