<?php
include_once 'assets/include/funciones_fempower.php';
if (isset($_REQUEST["btnRegistrar"])) {
  include 'assets/include/DAO_usuarios.php';
  $ObjUsuario = new DAO_usuarios();
  $addObjUsuario = new usuarios();
  if ($_REQUEST['password'] === $_REQUEST['confirma_password']) {
    if (strlen($_REQUEST['password']) > 20 || strlen($_REQUEST['password']) < 5) {
      header('Location: registro.php?error=2&tipoU=' . $_REQUEST['tipoU']);
    }
    $addObjUsuario->setEmail($_REQUEST["email"]);
    $addObjUsuario->setPassword(password_hash($_REQUEST["password"], PASSWORD_DEFAULT));
    $addObjUsuario->setTipo_doc($_REQUEST["TipoDocumento"]);
    $addObjUsuario->setUsername($_REQUEST["doc_usuario"]);
    $addObjUsuario->setTipo_usuario($_REQUEST["BtnTipoU"]);
    $addObjUsuario->setTratamiento_datos($_REQUEST["Autorizacion"]);
    $length = 8;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/*-.!@#$%^&*()_=-{}|[];:,.<>/?`~';
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $addObjUsuario->setConfirmcode($randomString);
    $rpta = $ObjUsuario->getUsuarioById(2);
    if ($ObjUsuario->inserta($addObjUsuario)) {
      $to_email = $_REQUEST["email"];
      $subject = 'Registro (F)EMPOWER';
      switch ($_REQUEST["BtnTipoU"]) {
        case 3:
          $message = '<!DOCTYPE html> <html> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="https://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/assets/css/general.css"> <body> <hr> <p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p> <p>¡Gracias por registrarte! Desde hoy haces parte de la familia (F)EMPOWER, una compañía dispuesta a trabajar arduamente para que encuentres el trabajo de tus sueños en el sector de la construcción, el cuidado inmobiliario y de plantas físicas.</p> <br> <p>De ahora en adelante haremos la tarea más fácil para ti, solo debes crear tu hoja de vida en nuestro portal y el sistema PUAV buscará por ti las mejores oportunidades de trabajo decente que se encuentran en nuestro país.</p> <br> <p>Una vez contemos con las mejores opciones laborales para ti, te contactaremos.</p> <br> <br> <p>Atentamente,</p> <br> <br> <img src="https://www.fempower.com.co/images/NGO_FIRMA.png" width="10%"> <p>Directora General</p> <br> <p align="center">Para activar tu usuario y completar el registro haz clic <a href="http://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/activar.php?username=' . $_REQUEST["doc_usuario"] . '&confirmcode=' . $randomString . '">AQUI</a></p> </body> </html>';
          $message = '<!DOCTYPE html> <html> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="https://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/assets/css/general.css"> <body> <hr> <p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p> <p>¡Gracias por registrarte! Desde hoy haces parte de la familia (F)EMPOWER, una compañía dispuesta a trabajar arduamente para que encuentres el trabajo de tus sueños en el sector de la construcción, el cuidado inmobiliario y de plantas físicas.</p> <br> <p>De ahora en adelante haremos la tarea más fácil para ti, solo debes crear tu hoja de vida en nuestro portal y el sistema PUAV buscará por ti las mejores oportunidades de trabajo decente que se encuentran en nuestro país.</p> <br> <p>Una vez contemos con las mejores opciones laborales para ti, te contactaremos.</p> <br> <br> <p>Atentamente,</p> <br> <p>El equipo de trabajo de (F)EMPOWER</p> <br> <p align="center">Tu usuario se activa en 24 horas, una vez esté activo te llegará un correo con el enlace de acceso que te permitirá continuar con tu proceso.</p> </body> </html>';
          $message = '<!DOCTYPE html> <html> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="https://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/assets/css/general.css"> <body> <hr> <p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p> <p>¡Gracias por registrarte! Desde hoy haces parte de la familia (F)EMPOWER, una compañía dispuesta a trabajar arduamente para que encuentres el trabajo de tus sueños en el sector de la construcción, el cuidado inmobiliario y de plantas físicas.</p> <br> <p>De ahora en adelante haremos la tarea más fácil para ti, solo debes crear tu hoja de vida en nuestro portal y el sistema PUAV buscará por ti las mejores oportunidades de trabajo decente que se encuentran en nuestro país.</p> <br> <p>Una vez contemos con las mejores opciones laborales para ti, te contactaremos.</p> <br> <br> <p>Atentamente,</p> <br> <p>El equipo de trabajo de (F)EMPOWER</p> <br> <p align="center">Para activar tu usuario y completar el registro haz clic <a href="http://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/activar.php?username=' . $_REQUEST["doc_usuario"] . '&confirmcode=' . $randomString . '">AQUI</a></p> </body> </html>';
          break;
        case 1:
          $message = '<!DOCTYPE html> <html> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="https://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/assets/css/general.css"> <body> <hr> <p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p> <h1>Estimado empresario:</h1> <p>¡Gracias por registrarse! Desde hoy (F)EMPOWER será su compañía aliada en la búsqueda del mejor talento humano.</p> <br> <p>Como especialistas en el sector de la construcción, el cuidado inmobiliario y de plantas físicas, tenemos claro que las personas más cualificadas, honestas y de gran actitud, son fundamentales para el logro de sus objetivos.  Para hacerlo posible, contamos con un sistema de algoritmos que facilita el proceso de preselección y que se adapta según los requerimientos que su empresa necesita.</p> <br> <p>Por tanto, le invitamos a ingresar al portal web y darnos la oportunidad de acompañarle en el importante proceso de encontrar el talento humano  comprometido con su sueño empresarial.</p> <br> <br> <p>Atentamente,</p> <br> <br> <img src="https://www.fempower.com.co/images/NGO_FIRMA.png" width="10%"> <p>Directora General</p> <br> <p align="center">Para activar su usuario y completar el registro haga clic <a href="http://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/activar.php?username=' . $_REQUEST["doc_usuario"] . '&confirmcode=' . $randomString . '">AQUI</a></p> </body> </html>';
          $message = '<!DOCTYPE html> <html> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="https://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/assets/css/general.css"> <body> <hr> <p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p> <h1>Estimado empresario:</h1> <p>¡Gracias por registrarse! Desde hoy (F)EMPOWER será su compañía aliada en la búsqueda del mejor talento humano.</p> <br> <p>Como especialistas en el sector de la construcción, el cuidado inmobiliario y de plantas físicas, tenemos claro que las personas más cualificadas, honestas y de gran actitud, son fundamentales para el logro de sus objetivos.  Para hacerlo posible, contamos con un sistema de algoritmos que facilita el proceso de preselección y que se adapta según los requerimientos que su empresa necesita.</p> <br> <p>Por tanto, le invitamos a ingresar al portal web y darnos la oportunidad de acompañarle en el importante proceso de encontrar el talento humano  comprometido con su sueño empresarial.</p> <br> <br> <p>Atentamente,</p> <br> <p>El equipo de trabajo de (F)EMPOWER</p><br> <p align="center">Su usuario se activará en 24 horas, una vez esté activo le llegará un correo con el enlace de acceso que le permitirá continuar con su proceso.</p> </body> </html>';
          $message = '<!DOCTYPE html> <html> <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="https://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/assets/css/general.css"> <body> <hr> <p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p> <h1>Estimado empresario:</h1> <p>¡Gracias por registrarse! Desde hoy (F)EMPOWER será su compañía aliada en la búsqueda del mejor talento humano.</p> <br> <p>Como especialistas en el sector de la construcción, el cuidado inmobiliario y de plantas físicas, tenemos claro que las personas más cualificadas, honestas y de gran actitud, son fundamentales para el logro de sus objetivos.  Para hacerlo posible, contamos con un sistema de algoritmos que facilita el proceso de preselección y que se adapta según los requerimientos que su empresa necesita.</p> <br> <p>Por tanto, le invitamos a ingresar al portal web y darnos la oportunidad de acompañarle en el importante proceso de encontrar el talento humano  comprometido con su sueño empresarial.</p> <br> <br> <p>Atentamente,</p> <br> <p>El equipo de trabajo de (F)EMPOWER</p><br> <p align="center">Para activar su usuario y completar el registro haga clic <a href="http://www.fempower.com.co' . dirname($_SERVER['PHP_SELF']) . '/activar.php?username=' . $_REQUEST["doc_usuario"] . '&confirmcode=' . $randomString . '">AQUI</a></p> </body> </html>';
          break;
      }
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: SOPORTE (F)EMPOWER <soporte@fempower.com.co>' . "\r\n";
      $headers .= 'Bcc: soporte@fempower.com.co, msancheze@outlook.com' . "\r\n";
      mail($to_email, $subject, $message, $headers);
      header('Location: registro.php?accion=1');
    } else {
      header('Location: registro.php?accion=2');
    }
  } else {
    header('Location: registro.php?error=1&tipoU=' . $_REQUEST['BtnTipoU']);
  }
}


include 'assets/include/DAO_codigos.php';
$Obj = new DAO_codigos();
$addObj = new codigos();
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <title>(F)EMPOWER</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Inteligencia para el trabajo">
    <meta name="author" content="(F)EMPOWER">
    <meta name="date" content="<?php echo date("Y-m-d"); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index, follow"/>
    <meta name="revisit-after" content="5 days"/>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icono1.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="assets/css/general.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
    <?php
    $titulo = 'Inicie su registro';
    $subtitulo = 'Pioneros en Colombia para quienes buscan crear oportunidades de trabajo decente y quienes desean emplearse en trabajos decentes.<br>Diligencie el siguiente formulario para iniciar su registro como <h1>' . $_REQUEST['tipoU'] . '</h1>';
    echo agrega_titulos($titulo, $subtitulo);
    $tipo = (isset($_POST['Enviar'])) ? $_POST['Enviar'] : $_GET['tipoU'];
    if (isset($_GET['error'])) {
      ?>
      <div class="container error1">
        <p>
          <?php
          switch ($_GET['error']) {
            case '1':
              echo "Las contraseñas digitadas no concuerdan, inténtelo nuevamente.";
              break;
            case '2':
              echo "La clave debe tener entre 5 y 20 caracteres de longitud!";
              break;
            case '3':
              echo 'Ha surgido un problema inesperado en su registro contáctenos en <a href="mailto:consulta@fempower.com.co">consulta@fempower.com.co</a> para ayudarle.';
              break;
            default:
              break;
          }
          ?>
        </p>
      </div>
      <?php
    }
    if (isset($_GET['accion'])) {
      ?>
      <div class="container accion1">
        <p>
          <?php
          switch ($_GET['accion']) {
            case '1':
              echo "Su registro fué exitoso, revise su correo electrónico para activar su usuario. El mensaje debe llegar durante los próximos 10 minutos, en caso de que no sea así por favor revise su carpeta de correos no deseados.";
              break;
            case '2':
              echo 'Ha surgido un problema inesperado en su registro contáctenos en <a href="mailto:consulta@fempower.com.co">consulta@fempower.com.co</a> para ayudarle.';
              break;
            default:
              break;
          }
          ?>
        </p>
      </div>
      <?php
    }
    if (isset($_GET['accion'])) {
      echo "";
    } else {
      ?>
      <div class="container">
        <form name="registro" action="#" method="POST">
          <!--input type="hidden" name="tipoU" value="<?= $tipo ?>"-->
          <div class="text-center mb-4 mt-1">
            <div class="btn-group radio-toolbar" data-toggle="buttons">
              <input type="hidden" name="tipoU" value="<?php echo $_POST['BtnTipoU']; ?>">
              <input type="radio" class="btn btn-outline-primary" name="BtnTipoU" value="1" id="radioEmpresa" required /> <label for="radioEmpresa">Empresa</label>
              <input type="radio" class="btn btn-outline-primary" name="BtnTipoU" value="3" id="radioPersona" /> <label for="radioPersona">Persona</label>
            </div>
          </div>
          <div class="row messages"></div>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10"><input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required></div>
            <div class="col-sm-1"></div>
          </div>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <?php
              echo $Obj->getSelectByCategory(21, 'TipoDocumento', 'tipo de documento', true);
              ?>
            </div>
            <div class="col-sm-1"></div>
          </div>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10"><input type="text" class="form-control" id="doc_usuario" name="doc_usuario" placeholder="Documento de Identidad" required></div>
            <div class="col-sm-1"></div>
          </div>
          <div class="row espacio-10"></div>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-9"><input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" onkeyup="CheckPasswordStrength(this.value)" required></div>
            <div class="col-sm-1"><span id="password_strength" style="color: black;">Clave vacía</span></div>
            <div class="col-sm-1"></div>
          </div>
          <div class="row espacio-10"></div>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-9"><input type="password" class="form-control" id="confirma_password" name="confirma_password" placeholder="Confirme Contraseña" required></div>
            <div class="col-sm-1"></div>
            <div class="col-sm-1"></div>
          </div>
          <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <p style="text-align: left;">
                <input type="checkbox" name="Autorizacion" value="1" required>
                seleccionando este recuadro usted autoriza expresamente a (F)EMPOWER, a tratar sus datos personales de acuerdo con lo definido en las Políticas de Tratamiento de datos. Recuerde que puede ejercer sus derechos a través del canal de atención: <a href="mailto:consulta@fempower.com.co">consulta@fempower.com.co</a>
              </p>
              Consulte <a href="http://pruebas.fempower.com.co/wp-content/uploads/2020/02/FEMPOWER-PoliticaTratamiento-de-Datos.pdf" target="_blank">AQUI</a> la política y procedimiento para el tratamiento de datos personales de (F)EMPOWER.
            </div>
            <div class="col-sm-1"></div>
          </div>
          <div class="titulo">
            <button type="submit" class="btn btn-primary" name="btnRegistrar">Registrarme</button>
          </div>
        </form>
      </div>
      <script type="text/javascript">
        function CheckPasswordStrength(password)
        {
          var password_strength = document.getElementById("password").value;
          var pwd1 = document.getElementById("password").value;
          //TextBox left blank.
          if (password.length == 0) {
            password_strength.innerHTML = "";
            return;
          }

          //Regular Expressions.
          var regex = new Array();
          regex.push("[A-Z]"); //Uppercase Alphabet.
          regex.push("[a-z]"); //Lowercase Alphabet.
          regex.push("[0-9]"); //Digit.
          regex.push("[$@$!%*#?&]"); //Special Character.

          var passed = 0;

          //Validate for each Regular Expression.
          for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(pwd1)) {
              passed++;
            }
          }

          //Validate for length of Password.
          if (passed > 2 && password.length >= 10) {
            passed++;
          } else if (passed > 2 && password.length >= 8) {
            passed = 3;
          } else if (passed > 2) {
            passed = 1;
          }

          //Display status.
          var color = "";
          var strength = "";
          switch (passed) {
            case 0:
              strength = "Fragil";
              color = "red";
              break;
            case 1:
              strength = "Fragil";
              color = "red";
              break;
            case 2:
              strength = "Fragil";
              color = "red";
              break;
            case 3:
              strength = "Buena";
              color = "darkorange";
              break;
            case 4:
              strength = "Fuerte";
              color = "green";
              break;
            case 5:
              strength = "Muy fuerte";
              color = "darkgreen";
              break;
          }
          document.getElementById("password_strength").innerHTML = strength;
          document.getElementById("password_strength").style.color = color;

        }
      </script>
      <?php
    }
    include_once("assets/include/tool_footer.php");
    ?>
  </body>
</html>