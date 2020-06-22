<?php
session_start();
require_once "../lib/PDO.php";

$ID = $_POST["ID"];

$USER=$_SESSION["UserName"];
$Q="SELECT * from usuarios where username='$USER'";
  foreach ($db->query($Q) as $Row) {
  	$USERID=$Row["id"];
  }
$Q="SELECT * from demandantes_bi where idUsuario='$USERID'";
  foreach ($db->query($Q) as $Row) {
  	$USERID=$Row["id"];
  }

$Q0="SELECT * from demandantes_vacantes where idDemandante=$USERID and id=$ID";
$Row0=$db->query($Q0);
$Row0=$Row0->fetch();
$Ar=$Row0["idArchivo"];
if($Ar!="")
{
  $Q4="SELECT * from archivos where id=$Ar";
  $Row4=$db->query($Q4);
  $Row4=$Row4->fetch();
  unlink("../files/".$Row4["nombre"]);
  
}

$Q="DELETE from demandantes_vacantes where idDemandante=$USERID and id=$ID";
try
{
	$db->query($Q);
}catch(Exception $e)
{
	echo "Error: ".$e;
}

$Q6="DELETE from archivos where id=$Ar";
  
  try
{
  $db->query($Q6);
}catch(Exception $e)
{
  echo "Error: ".$e;
}

?>
<script type="text/javascript">
	window.alert("Datos eliminados con éxito");
	window.location.href="../welcome.php";
</script>