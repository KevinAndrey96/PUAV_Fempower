<?php
session_start();
require_once "../lib/PDO.php";
if($_POST["NAME"])
{
  $ID=$_POST["ID"];
  $NAME=$_POST["NAME"];
  $DESCRIPTION=$_POST["DESCRIPTION"];
  $SALARY=$_POST["SALARY"];
  $EXPERIENCE=$_POST["EXPERIENCE"];
  $INIT=$_POST["INIT"];
  $CLOSE=$_POST["CLOSE"];
  $VACANT=$_POST["VACANT"];
  $LOCATION=$_POST["LOCATION"];
  $FUNCTIONS=$_POST["FUNCTIONS"];
  $CONTRACT=$_POST["CONTRACT"];
  $USER=$_SESSION["UserName"];

  $Q="SELECT * from usuarios where username='$USER'";
  foreach ($db->query($Q) as $Row) {
  	$USERID=$Row["id"];
  }
  $Q="SELECT * from demandantes_bi where idUsuario ='$USERID'";
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
    $Q="UPDATE demandantes_vacantes SET nombreCargo='$NAME', descripcion='$DESCRIPTION', salario=$SALARY, tipoContratoCodigo=$CONTRACT, mpioUbicacionCodigo=$LOCATION,numeroVacantes=$VACANT, funciones='$FUNCTIONS', experienciaRequerida='$EXPERIENCE', fechaPublicacion='$INIT', fechaCierre='$CLOSE', idArchivo=$Archivo where id=$ID";
} else {
    $Q="UPDATE demandantes_vacantes SET nombreCargo='$NAME', descripcion='$DESCRIPTION', salario=$SALARY, tipoContratoCodigo=$CONTRACT, mpioUbicacionCodigo=$LOCATION,numeroVacantes=$VACANT, funciones='$FUNCTIONS', experienciaRequerida='$EXPERIENCE', fechaPublicacion='$INIT', fechaCierre='$CLOSE' where id=$ID";
}


  try {
  	$db->query($Q);
  } catch (Exception $e) {
  	//echo "Error: ".$e;
  	?>
  	<script type="text/javascript">
	  window.alert("Ocurrió un error en el proceso");
	  window.location.href="../welcome.php";
	</script>
  	<?php
  }
  

}
?>
<script type="text/javascript">
  window.alert("Vacante publicada con éxito");
  window.location.href="../welcome.php";
</script>