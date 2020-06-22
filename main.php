<?php
if (strpos($_SERVER['HTTP_REFERER'], "Login.php") <> 0) {
  session_start();
  include 'assets/include/DAO_usuarios.php';
  $objUsuario = new DAO_usuarios();
  $addObjUsuario = new usuarios();
  include 'assets/include/DAO_codigos.php';
  $objCodigo = new DAO_codigos();
  $addObjCodigo = new codigos();
  $result = $objUsuario->getUsuarioByUsernameNtipo($_POST["username"], $_POST["tipoU"]);
  $_SESSION['loggedin'] = TRUE;
  $_SESSION['name'] = $_POST['username'];
  $_SESSION['idUsuario'] = $result['id'];
  $_SESSION['id_usuario'] = $result['id'];
  $_SESSION['TipoUsuario'] = $result['tipo_usuario'];
  $_SESSION['email'] = $result['email'];
  $_SESSION['created'] = time();
}
?>
<!DOCTYPE html>
<html lang="es">
  <?php
  include_once("assets/include/tool_header.php");
  ?>
  <body>
    <?php
    include_once("assets/include/tool_menu.php");
    ?>
    <br>
    DE PRIMERAS
    <br>
    MAIN
    <?php
    include_once("assets/include/tool_footer.php");
    ?>
  </body>
</html>