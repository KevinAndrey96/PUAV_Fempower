<?php
session_start();
require_once "../lib/PDO.php";
if($_POST["username"])
{
  $USER=$_POST["username"];
  $PASS=$_POST["password"];
  $TIPO=$_POST["BtnTipoU"];//3 para persona y 1 para empresa

  $Q="SELECT * from usuarios where username='$USER' and tipo_usuario='$TIPO' and estado=1";
  foreach ($db->query($Q) as $Row) {
    $PASS_HASH=$Row["password"];
    if(password_verify($PASS, $PASS_HASH))
    {
      $_SESSION["Active"]=true;
      $_SESSION["UserName"]=$USER;
      $_SESSION["Rol"]=$Row["tipo_usuario"];
      ?>
      <script type="text/javascript">window.location.href = "../welcome.php"</script>
      <?php
    }else
    {
      ?>
      <script type="text/javascript">
        window.alert("Usuario ó contraseña incorrectos");
        window.location.href="../index.php";
      </script>
      <?php
    }
  }

}
?>
<script type="text/javascript">
  window.alert("Usuario o contraseña incorrecto");
  window.location.href="../index.php";
</script>