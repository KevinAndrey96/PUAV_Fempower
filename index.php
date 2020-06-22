<?php
session_start();
if($_SESSION["Active"]==true)
{
  ?>
  <script type="text/javascript">
    window.location.href="welcome.php";
  </script>
  <?php
}
include_once 'assets/include/funciones_fempower.php';
$tipo = (isset($_POST['Enviar'])) ? $_POST['Enviar'] : $_GET['TipoUsuario'];
$exito = "";
$error = "";

if ($_REQUEST['termina'] == 'Ingresar') {
  include 'assets/include/DAO_usuarios.php';
  include 'assets/include/DAO_log_in.php';

  $objUsuario = new DAO_usuarios();
  $addObjUsuario = new usuarios();
  $objLog_in = new DAO_log_in();
  $addObjLog_in = new log_in();

  $rpta = $objUsuario->getUsuarioByUsernameNtipo($_POST["username"], $_POST["BtnTipoU"]);
  $_SESSION = $objUsuario->validaUsuario($_POST["username"], $_POST["password"], $_POST["BtnTipoU"]);
  if (isset($_SESSION)) {
    $addObjLog_in->setIdUsuario($rpta["id"]);
    $addObjLog_in->setUsername($rpta["username"]);
    $rpta = $objLog_in->insertaAcceso($addObjLog_in);
  }
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Acceso PUAV</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="assets/css/general.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
      .radio-toolbar input[type="radio"] {
        opacity: 0;
        position: fixed;
        width: 0;
      }
      .radio-toolbar label {
        display: inline-block;
        background-color: #295ba7;
        padding: 10px 20px;
        font-family: sans-serif, Arial;
        font-size: 16px;
        border: 4px solid white;
        border-radius: 5px;
        color: white;
      }
      .radio-toolbar input[type="radio"]:checked + label {
        background-color:blue;
        border-color: blue;
        font-size: 18px;
      }
      .radio-toolbar input[type="radio"]:focus + label {
        border: 2px solid #3361ff;
      }
      .radio-toolbar label:hover {
        background-color: blue;
      }
    </style>
  </head>
  <body>
    <?php
    $titulo = 'Acceso PUAV';
    $subtitulo = 'Pioneros en Colombia para quienes buscan crear oportunidades de trabajo decente y para quienes buscan trabajo.';
    echo agrega_titulos($titulo, $subtitulo);
    if ($rpta == true) {
      $action = "main.php";
    } else {
      $action = "#";
    }
    if (isset($_GET['error'])) {
      switch ($_GET['error']) {
        case '1':
          $exito = "Su clave no coincide con la registrada.";
          break;
        case '2':
          $exito = "Su usuario está bloqueado comuníquese con consulta@fempower.com.co.";
          break;
        case '3':
          $exito = 'No tiene una cuenta, registrese haciendo clic <a href="registro.php?TipoUsuario=' . $tipo . '">AQUI</a>';
          break;
        default:
          break;
      }
    }
    if (isset($_GET['accion'])) {
      switch ($_GET['accion']) {
        case '1':
          $error = "Su usuario ha sido activado exitosamente ingrese con su información a completar su registro.";
          break;
        default:
          break;
      }
    }
    ?>
    <div class="container">
      <div class="card">
        <article class="card-body">
          <a href="registro.php" class="float-right btn btn-outline-primary">Regístrese aquí</a>
          <h4 class="card-title text-center mb-4 mt-1">Acceso</h4>
          <hr>
          <p class="text-success text-center"><?php echo $exito; ?></p>
          <p class="text-danger text-center"><?php echo $error; ?></p>
          <form id="login" name="login" action="controller/Login.php" method="post" >
            <div class="form-group">
              <div class="text-center mb-4 mt-1">
                <div class="btn-group radio-toolbar" data-toggle="buttons">
                  <input type="hidden" name="tipoU" value="<?php echo $_POST['BtnTipoU']; ?>">
                  <input type="radio" class="btn btn-outline-primary" name="BtnTipoU" value="1" id="radioEmpresa" required /> <label for="radioEmpresa">Empresa</label>
                  <input type="radio" class="btn btn-outline-primary" name="BtnTipoU" value="3" id="radioPersona" /> <label for="radioPersona">Persona</label>
                </div>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                </div>
                <input name="username" class="form-control" placeholder="Documento de identidad" type="text" value="<?php echo $_POST['username']; ?>" required />
              </div> <!-- input-group.// -->
            </div> <!-- form-group// -->
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                </div>
                <input class="form-control" placeholder="******" type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>" required />
              </div> <!-- input-group.// -->
            </div> <!-- form-group// -->
            <div class="form-group">
              <button type="submit" name="termina" class="btn btn-primary btn-block" value="Ingresar"> Ingresa  </button>
            </div> <!-- form-group// -->
            <p class="text-center"><a href="recuperar_contrasena.php" class="btn btn-outline-primary">Recupera tu contraseña</a></p>
          </form>
        </article>
      </div>
    </div>
  </body>
  <?php if ($rpta == true) { ?>
    <script>
      document.getElementById('login').submit();
    </script>
  <?php } ?>
</html>