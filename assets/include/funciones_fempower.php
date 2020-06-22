<?php

/**
 * MISE 20200216
 * Funciones que interactúan con BD
 * */
function conectar() {
  $servername = "localhost";
  $username = "appuser";
  $password = "-,r!UEsi-o2*";
  $dbname = "puav_produccion";

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $conn->set_charset("utf8");
  if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
  } else {
    return $conn;
  }
}

function salida_segura($arreglo_sesion) {
  try {
    $con = conectar();
    $sql = "UPDATE log_in SET date_logoff = CURRENT_TIMESTAMP where idUsuario = '" . $arreglo_sesion['idUsuario'] . "' and id = (" . get_last_login($arreglo_sesion['idUsuario']) . ");";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    session_destroy();
    header("Location: /");
  } catch (Exception $e) {
    echo $e;
  }
}

function genera_session($arreglo_usuario) {
  $con = conectar();
  $sql = "SELECT id, password, tipo_usuario TipoUsuario, email, estado FROM usuarios where username = '" . $arreglo_usuario['username'] . "'";
  $query = $con->query($sql);
  if ($query->num_rows == 0) {
    $row = null;
  } else {
    $row = $query->fetch_array(MYSQLI_ASSOC);
  }
  if (!empty($row)) {
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $arreglo_usuario['username'];
    $_SESSION['idUsuario'] = $row['id'];
    $_SESSION['id_usuario'] = $row['id'];
    $_SESSION['TipoUsuario'] = $row['TipoUsuario'];
    $_SESSION['email'] = $row['email'];
  }
}

function crea_usuario($arreglo_usuario) {
  $con = conectar();
  if ($arreglo_usuario['password'] == $arreglo_usuario['confirma_password']) {
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
      header('Location: registro.php?error=2&TipoUsuario=' . $arreglo_usuario['TipoUsuario']);
    }
    $email = $arreglo_usuario['email'];
    $doc_usuario = $arreglo_usuario['doc_usuario'];
    $password = password_hash($arreglo_usuario['password'], PASSWORD_DEFAULT);
    $TipoUsuario = ($arreglo_usuario['TipoUsuario'] == "Empresa") ? 1 : 3;
    $TipoDocumento = $arreglo_usuario['TipoDocumento'];
    $Autorizacion = $arreglo_usuario['Autorizacion'];
    $length = 8;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/*-.!@#$%^&*()_=-{}|[];:,.<>/?`~';
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $sql = "INSERT INTO usuarios (username, email, password, tipo_usuario, confirmcode, tratamiento_datos) VALUES ('$doc_usuario', '$email', '$password', '$TipoUsuario', '$randomString', $Autorizacion)";
    $query = $con->query($sql);
    if ($query === TRUE) {
      $to_email = $email;
      $subject = 'Registro (F)EMPOWER';
      switch ($arreglo_usuario['TipoUsuario']) {
        case 'Persona':
          $message = '
								<!DOCTYPE html>
								<html>
									<meta charset="UTF-8">
									<link rel="stylesheet" type="text/css" href="https://www.fempower.com.co/puav/assets/css/general.css">
									<body>
										<hr>
										<p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p>
										<p>¡Gracias por registrarte! Desde hoy haces parte de la familia (F)EMPOWER, una compañía dispuesta a trabajar arduamente para que encuentres el trabajo de tus sueños en el sector de la construcción, el cuidado inmobiliario y de plantas físicas.</p>
										<br>
										<p>De ahora en adelante haremos la tarea más fácil para ti, solo debes crear tu hoja de vida en nuestro portal y el sistema PUAV buscará por ti las mejores oportunidades de trabajo decente que se encuentran en nuestro país.</p>
										<br>
										<p>Una vez contemos con las mejores opciones laborales para ti, te contactaremos.</p>
										<br>
										<br>
										<p>Atentamente,</p>
										<br>
										<br>
										<img src="https://www.fempower.com.co/images/NGO_FIRMA.png" width="10%">
										<p>Directora General</p>
										<br>
										<p align="center">Para activar tu usuario y completar el registro haz clic <a href="http://www.fempower.com.co/puav/activar.php?username=' . $doc_usuario . '&confirmcode=' . $randomString . '">AQUI</a></p>
									</body>
								</html>';
          break;

        case 'Empresa':
          $message = '
								<!DOCTYPE html>
								<html>
									<meta charset="UTF-8">
									<link rel="stylesheet" type="text/css" href="https://www.fempower.com.co/puav/assets/css/general.css">
									<body>
										<hr>
										<p align="center"><img src="https://www.fempower.com.co/images/logo_Color.png" width="30%"></p>
										<h1>Estimado empresario:</h1>
										<p>¡Gracias por registrarse! Desde hoy (F)EMPOWER será su compañía aliada en la búsqueda del mejor talento humano.</p>
										<br>
										<p>Como especialistas en el sector de la construcción, el cuidado inmobiliario y de plantas físicas, tenemos claro que las personas más cualificadas, honestas y de gran actitud, son fundamentales para el logro de sus objetivos.  Para hacerlo posible, contamos con un sistema de algoritmos que facilita el proceso de preselección y que se adapta según los requerimientos que su empresa necesita.</p>
										<br>
										<p>Por tanto, le invitamos a ingresar al portal web y darnos la oportunidad de acompañarle en el importante proceso de encontrar el talento humano  comprometido con su sueño empresarial.</p>
										<br>
										<br>
										<p>Atentamente,</p>
										<br>
										<br>
										<img src="https://www.fempower.com.co/images/NGO_FIRMA.png" width="10%">
										<p>Directora General</p>
										<br>
										<p align="center">Para activar su usuario y completar el registro haga clic <a href="http://www.fempower.com.co/puav/activar.php?username=' . $doc_usuario . '&confirmcode=' . $randomString . '">AQUI</a></p>
									</body>
								</html>';
          break;

        default:
          # code...
          break;
      }
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // More headers
      $headers .= 'From: SOPORTE (F)EMPOWER <soporte@fempower.com.co>' . "\r\n";
      $headers .= 'Bcc: soporte@fempower.com.co, msancheze@outlook.com' . "\r\n";
      mail($to_email, $subject, $message, $headers);
      header('Location: registro.php?accion=1');
    } else {
      header('Location: registro.php?accion=2');
    }
  } else {
    header('Location: registro.php?error=1&TipoUsuario=' . $arreglo_usuario['TipoUsuario']);
  }
}

function activa_usuario($arreglo) {
  $con = conectar();
  $username = $arreglo['username'];
  $confirmcode = $arreglo['confirmcode'];
  $sql = "SELECT id, confirmcode FROM usuarios WHERE username = " . $username;
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  //echo $row['confirmcode']."==$confirmcode";
  if ($row['confirmcode'] == $confirmcode) {
    $sql = "UPDATE usuarios SET estado = 1 WHERE id = " . $row['id'];
    $query = $con->query($sql);
    if ($query === TRUE) {
      header('Location: Login.php?accion=1');
    } else {
      header('Location: registro.php?accion=2');
    }
  } else {
    header('Location: registro.php?error=3');
  }
}

function get_municipio_id($municipio) {
  $con = conectar();
  $sql = "
			  SELECT     t3.id AS id
				FROM     codigos AS t1
				         LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id
				         LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id
				WHERE    t1.descripcion = 'departamento' AND t3.estado = 1 AND concat(t2.descripcion, ', ', t3.descripcion) = '" . $municipio . "'";
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['id'];
}

function get_municipio_name($municipio) {
  //echo "<script>alert('Entra a get_municipio_name: ".$municipio."');</script>";
  $con = conectar();
  $sql = "SELECT t3.id AS id, concat(t2.descripcion, ', ', t3.descripcion) AS municipio
			  FROM codigos AS t1 LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id
			 WHERE t1.descripcion = 'departamento' AND t2.estado = 1 AND t3.id = " . $municipio;
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['municipio'];
}

function get_ciiu_id($ciiu) {
  $con = conectar();
  $sql = "
			  SELECT     t3.id AS id
				FROM     codigos AS t1
				         LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id
				         LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id
				WHERE    t1.descripcion = 'CIIU' AND t3.estado = 1 AND concat(t2.descripcion, ', ', t3.descripcion) = '" . $ciiu . "'";
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['id'];
}

function get_ciiu_name($ciiu) {
  //echo "<script>alert('Entra a get_ciiu_name: ".$ciiu."');</script>";
  $con = conectar();
  $sql = "SELECT t3.id AS id, concat(t2.descripcion, ', ', t3.descripcion) AS ciiu
			  FROM codigos AS t1 LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id
			 WHERE t1.descripcion = 'CIIU' AND t2.estado = 1 AND t3.id = " . $ciiu;
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['ciiu'];
}

function get_hierarchical_code_id($categoria, $divisor, $descripcion) {
  //echo "<script>alert('Entra get_hierarchical_code_id: $descripcion')</script>";
  $con = conectar();
  $sql = "  SELECT     t3.id AS id
				FROM     codigos AS t1
				         LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id
				         LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id
				WHERE    t1.descripcion = '" . $categoria . "' AND t3.estado = 1
				  AND    concat(t2.descripcion, '" . $divisor . "', t3.descripcion) = '" . $descripcion . "'";
  //echo "<!-- Entra a get_ciiu_hierarchical_code_id: ".$sql." -->";
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['id'];
}

function get_hierarchical_code_name($categoria, $divisor, $id) {
  //echo "<script>alert('Entra a get_ciiu_hierarchical_code_name: $id, $categoria, $divisor');</script>";
  $con = conectar();
  $sql = "SELECT t3.id AS id, concat(t2.descripcion, '$divisor', t3.descripcion) AS descripcion
			  FROM codigos AS t1 LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id
			 WHERE t1.descripcion = '$categoria' AND t2.estado = 1 AND t3.id = " . $id;
  //echo "<!-- Entra a get_ciiu_hierarchical_code_name: ".$sql." -->";
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['descripcion'];
}

function get_hierarchical_code($categoria, $divisor, $text = NULL) {
  //echo "<script>alert('Entra a get_hierarchical_code: $categoria, $text');</script>";
  $data = array();
  $con = conectar();
  $sql = "  SELECT     t3.id AS id, concat(t2.descripcion, '$divisor', t3.descripcion) AS descripcion
				FROM     codigos AS t1
				         LEFT JOIN codigos AS t2 ON t2.id_padre = t1.id
				         LEFT JOIN codigos AS t3 ON t3.id_padre = t2.id
				WHERE    t1.descripcion = '$categoria'
				  AND    concat(t2.descripcion, '$divisor', t3.descripcion) LIKE '%" . $text . "%'
			 ORDER BY    2 ASC";
  $query = $con->query($sql);
  if ($query->num_rows > 0) {
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
      $data[] = $row['descripcion'];
    }
  }
  return $data;
}

function agrega_titulos($titulo, $subtitulo) {
  $rpta = '<div class="container">'
          . '<div class="table row">'
          . ' <div class="col-md-3">'
          . '   <img class="logo" src="../images/logo_fempower.png">'
          . ' </div>'
          . ' <div class="col-md-9 titulo">'
          . '   <h1>';
  $rpta .= $titulo;
  $rpta .= '    </h1>'
          . '   <br>';
  $rpta .= $subtitulo;
  $rpta .= '  </div>'
          . '</div>'
          . '</div>';
  echo $rpta;
}

function get_zero($var) {
  if (isset($var)) {
    if ($var == 1) {
      return 1;
    } else {
      return 0;
    }
  } else {
    return 0;
  }
}

function get_last_login($idUsuario) {
  $con = conectar();
  $sql = "select max(id) id from log_in where idUsuario = '" . $idUsuario . "'";
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['id'];
}

/* OFERENTES */

function confirma_oferente($idUsuario) {
  $con = conectar();
  $sql = "SELECT count(*) registros FROM puav_produccion.oferentes_bi WHERE idUsuario = " . $idUsuario;
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['registros'];
}

function get_oferente_bi($idUsuario) {
  //echo "<script>alert('Entra get_oferente_bi: $idUsuario')</script>";
  $con = conectar();
  $sql = "SELECT u.id, u.username, u.tipo_usuario, o.id, o.nombre1, o.nombre2, o.apellido1, o.apellido2,
			       o.fechaNacimiento, o.telefono1, o.telefono2, o.municipioNacimientoCodigo, o.generoCodigo,
			       o.sexoCodigo, o.direccion, o.municipioViviendaCodigo, o.estadoCivilCodigo, o.extranjeroCodigo,
			       o.paisCodigo, o.libretaMilitar, o.etnia, o.discapacidad, o.discapacidadFisica,
			       o.discapacidadVisual, o.discapacidadAuditiva, o.discapacidadVerbal, o.discapacidadIntelectual, o.discapacidadPsicosocial,
			       o.victimaConflicto, o.orientacionOcupacional, o.personasCargo
			  FROM usuarios AS u LEFT JOIN oferentes_bi AS o ON (u.id = o.idUsuario)
			 WHERE u.estado = 1 and u.id = " . $idUsuario;
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row;
}

function set_oferente_bi($data) {
  $con = conectar();
  $sql = "INSERT INTO puav_produccion.oferentes_bi(idUsuario, nombre1, nombre2, apellido1, apellido2, fechaNacimiento, telefono1, telefono2,
						municipioNacimientoCodigo, generoCodigo, sexoCodigo, direccion, municipioViviendaCodigo, estadoCivilCodigo, extranjeroCodigo,
						paisCodigo, libretaMilitar, etnia, discapacidad, discapacidadFisica, discapacidadVisual, discapacidadAuditiva, discapacidadVerbal,
						discapacidadIntelectual, discapacidadPsicosocial, victimaConflicto, orientacionOcupacional, personasCargo)
			VALUES      (" . $data['idUsuario'] . ", '" . $data['nombre1'] . "', '" . $data['nombre2'] . "', '" . $data['apellido1'] . "', '" . $data['apellido2'] . "',
			             '" . $data['fechaNacimiento'] . "', '" . $data['telefono1'] . "', '" . $data['telefono2'] . "', '" . get_municipio_id($data['municipioNacimientoCodigo']) . "',
			             " . $data['generoCodigo'] . ", " . get_zero($data['sexoCodigo']) . ", '" . $data['direccion'] . "', " . get_municipio_id($data['municipioViviendaCodigo']) . ",
			             " . $data['estadoCivilCodigo'] . ", " . get_zero($data['extranjeroCodigo']) . ", " . get_zero($data['paisCodigo']) . ",
			             " . get_zero($data['libretaMilitar']) . ", " . $data['etnia'] . ", " . get_zero($data['discapacidad']) . ", " . get_zero($data['discapacidadFisica']) . ",
			             " . get_zero($data['discapacidadVisual']) . ", " . get_zero($data['discapacidadAuditiva']) . ", " . get_zero($data['discapacidadVerbal']) . ",
			             " . get_zero($data['discapacidadIntelectual']) . ", " . get_zero($data['discapacidadPsicosocial']) . ", " . get_zero($data['victimaConflicto']) . ",
			             " . get_zero($data['orientacionOcupacional']) . ", " . get_zero($data['personasCargo']) . ");";
  $query = $con->query($sql);
  if ($query === TRUE) {
    return true;
  } else {
    return false;
  }
}

function set_oferente_bi_historico($id) {
  $con = conectar();
  $sql = "INSERT INTO puav_produccion.oferentes_bi_historico
			(id, idUsuario, nombre1, nombre2, apellido1, apellido2, fechaNacimiento, telefono1, telefono2,
			municipioNacimientoCodigo, generoCodigo, sexoCodigo, direccion, municipioViviendaCodigo, estadoCivilCodigo,
			extranjeroCodigo, paisCodigo, libretaMilitar, etnia, discapacidad, discapacidadFisica, discapacidadVisual,
			discapacidadAuditiva, discapacidadVerbal, discapacidadIntelectual, discapacidadPsicosocial, victimaConflicto,
			orientacionOcupacional, personasCargo)
			SELECT id, idUsuario, nombre1, nombre2, apellido1, apellido2, fechaNacimiento, telefono1, telefono2,
			municipioNacimientoCodigo, generoCodigo, sexoCodigo, direccion, municipioViviendaCodigo, estadoCivilCodigo,
			extranjeroCodigo, paisCodigo, libretaMilitar, etnia, discapacidad, discapacidadFisica, discapacidadVisual,
			discapacidadAuditiva, discapacidadVerbal, discapacidadIntelectual, discapacidadPsicosocial, victimaConflicto,
			orientacionOcupacional, personasCargo FROM puav_produccion.oferentes_bi WHERE ID = " . $id . ";";
  $query = $con->query($sql);
  if ($query === TRUE) {
    return true;
  } else {
    return false;
  }
}

function upd_oferente_bi($data, $id) {
  $con = conectar();
  //$sql = "UPDATE puav_produccion.oferentes_bi SET idUsuario=" . $data['idUsuario'] . ", nombre1='" . $data['nombre1'] . "', nombre2='" . $data['nombre2'] . "', apellido1='" . $data['apellido1'] . "', apellido2='" . $data['apellido2'] . "', fechaNacimiento='" . $data['fechaNacimiento'] . "', telefono1='" . $data['telefono1'] . "', telefono2='" . $data['telefono2'] . "', municipioNacimientoCodigo='" . get_municipio_id($data['municipioNacimientoCodigo']) . "', generoCodigo=" . $data['generoCodigo'] . ", sexoCodigo=" . get_zero($data['sexoCodigo']) . ", direccion='" . $data['direccion'] . "', municipioViviendaCodigo=" . get_municipio_id($data['municipioViviendaCodigo']) . ", estadoCivilCodigo=" . $data['estadoCivilCodigo'] . ", extranjeroCodigo=" . get_zero($data['extranjeroCodigo']) . ", paisCodigo=" . get_zero($data['paisCodigo']) . ", libretaMilitar=" . get_zero($data['libretaMilitar']) . ", etnia=" . $data['etnia'] . ", discapacidad=" . get_zero($data['discapacidad']) . ", discapacidadFisica=" . get_zero($data['discapacidadFisica']) . ", discapacidadVisual=" . get_zero($data['discapacidadVisual']) . ", discapacidadAuditiva=" . get_zero($data['discapacidadAuditiva']) . ", discapacidadVerbal=" . get_zero($data['discapacidadVerbal']) . ", discapacidadIntelectual=" . get_zero($data['discapacidadIntelectual']) . ", discapacidadPsicosocial=" . get_zero($data['discapacidadPsicosocial']) . ", victimaConflicto=" . get_zero($data['victimaConflicto']) . ", orientacionOcupacional=" . get_zero($data['orientacionOcupacional']) . ", personasCargo=" . get_zero($data['personasCargo']) . " WHERE id = " . $id . ";";
  if ($data['idUsuario'] !== "") {
    $sqlPart1 .= "idUsuario = " . $data['idUsuario'];
  }
  if ($sqlPart1 !== "" && $data['fechaNacimiento'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['fechaNacimiento'] !== "") {
    $sqlPart1 .= "fechaNacimiento = '" . $data['fechaNacimiento'] . "'";
  }
  if ($sqlPart1 !== "" && $data['generoCodigo'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['generoCodigo'] !== "") {
    $sqlPart1 .= "generoCodigo = " . $data['generoCodigo'];
  }
  if ($sqlPart1 !== "" && $data['municipioViviendaCodigo'] !== "") {
    $sqlPart1 .= ", ";
  }
  if (get_municipio_id($data['municipioViviendaCodigo']) !== "") {
    $sqlPart1 .= "municipioViviendaCodigo = " . get_municipio_id($data['municipioViviendaCodigo']);
  }
  if ($sqlPart1 !== "" && $data['estadoCivilCodigo'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['estadoCivilCodigo'] !== "") {
    $sqlPart1 .= "estadoCivilCodigo = " . $data['estadoCivilCodigo'];
  }
  if ($sqlPart1 !== "" && $data['extranjeroCodigo'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['extranjeroCodigo'] !== "") {
    $sqlPart1 .= "extranjeroCodigo = " . $data['extranjeroCodigo'];
  }
  if ($sqlPart1 !== "" && $data['paisCodigo'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['paisCodigo'] !== "") {
    $sqlPart1 .= "paisCodigo = " . $data['paisCodigo'];
  }
  if ($sqlPart1 !== "" && $data['libretaMilitar'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['libretaMilitar'] !== "") {
    $sqlPart1 .= "libretaMilitar = " . $data['libretaMilitar'];
  }
  if ($sqlPart1 !== "" && $data['etnia'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['etnia'] !== "") {
    $sqlPart1 .= "etnia = " . $data['etnia'];
  }
  if ($sqlPart1 !== "") {
    $sqlPart1 .= ", ";
  }
  $sqlPart1 .= "discapacidad = " . (($data['discapacidad'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "discapacidadFisica = " . (($data['discapacidadFisica'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "discapacidadVisual = " . (($data['discapacidadVisual'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "discapacidadAuditiva = " . (($data['discapacidadAuditiva'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "discapacidadVerbal = " . (($data['discapacidadVerbal'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "discapacidadIntelectual = " . (($data['discapacidadIntelectual'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "discapacidadPsicosocial = " . (($data['discapacidadPsicosocial'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "victimaConflicto = " . (($data['victimaConflicto'] == 1) ? 1 : 0);
  $sqlPart1 .= ", ";
  $sqlPart1 .= "orientacionOcupacional = " . (($data['orientacionOcupacional'] == 1) ? 1 : 0);
  if ($sqlPart1 !== "" && $data['personasCargo'] !== "") {
    $sqlPart1 .= ", ";
  }
  $sqlPart1 .= "personasCargo = " . (($data['personasCargo'] !== "") ? $data['personasCargo'] : "0");
  if ($sqlPart1 !== "" && $data['nombre1'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['nombre1'] !== "") {
    $sqlPart1 .= "nombre1 = '" . $data['nombre1'] . "'";
  }
  if ($sqlPart1 !== "" && $data['nombre2'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['nombre2'] !== "") {
    $sqlPart1 .= "nombre2 = '" . $data['nombre2'] . "'";
  }
  if ($sqlPart1 !== "" && $data['apellido1'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['apellido1'] !== "") {
    $sqlPart1 .= "apellido1 = '" . $data['apellido1'] . "'";
  }
  if ($sqlPart1 !== "" && $data['apellido2'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['apellido2'] !== "") {
    $sqlPart1 .= "apellido2 = '" . $data['apellido2'] . "'";
  }
  if ($sqlPart1 !== "" && $data['telefono1'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['telefono1'] !== "") {
    $sqlPart1 .= "telefono1 = '" . $data['telefono1'] . "'";
  }
  if ($sqlPart1 !== "" && $data['telefono2'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['telefono2'] !== "") {
    $sqlPart1 .= "telefono2 = '" . $data['telefono2'] . "'";
  }
  if ($sqlPart1 !== "" && $data['municipioNacimientoCodigo'] !== "") {
    $sqlPart1 .= ", ";
  }
  if (get_municipio_id($data['municipioNacimientoCodigo']) !== "") {
    $sqlPart1 .= "municipioNacimientoCodigo = " . get_municipio_id($data['municipioNacimientoCodigo']);
  }
  if ($sqlPart1 !== "" && $data['direccion'] !== "") {
    $sqlPart1 .= ", ";
  }
  if ($data['direccion'] !== "") {
    $sqlPart1 .= "direccion = '" . $data['direccion'] . "'";
  } $query = $con->query($sql);
  $sql = "UPDATE puav_produccion.oferentes_bi SET " . $sqlPart1 . " WHERE id = " . $id;
  echo $sql;
  $query = $con->query($sql);
  $rpta = ($query === TRUE) ? true : false;
  return $rpta;
}

function get_experiencia($idUsuario) {
  $data = array();
  $con = conectar();
  $sql = "  SELECT oexp.id, id_usuario, empresa, telefono, c.descripcion municipio, pasantia, fecha_ingreso,
					 empleo_actual, fecha_salida, c1.descripcion ocupacion, cargo, logros, id_archivo
				FROM oferentes_experiencia oexp JOIN codigos c
				  ON oexp.municipio = c.id JOIN codigos c1
				  ON oexp.ocupacion = c1.id
			   WHERE id_usuario = " . $idUsuario . "
			ORDER BY 7 ASC, 9 ASC";
  $registro = 0;
  $query = $con->query($sql);
  if ($query->num_rows > 0) {
    while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
      foreach ($row as $key => $value) {
        $data[$registro][$key] = $value;
      }
      $registro++;
    }
  }
  return $data;
}

function set_experiencia($data) {
  $data = [];
  $con = conectar();
  $sql = "  INSERT INTO puav_produccion.oferentes_experiencia (id_usuario, empresa, telefono, municipio, pasantia, fecha_ingreso, empleo_actual, fecha_salida, ocupacion, cargo, logros, id_archivo)
              VALUES (" . $data['id_usuario'] . ", '" . $data['empresa'] . "', '" . $data['telefono'] . "', " . get_municipio_id($data['municipio']) . ", " . $data['pasantia'] . ", '" . $data['fecha_ingreso'] . "', " . $data['empleo_actual'] . ", '" . $data['fecha_salida'] . "', " . get_ocupacion_id($data['ocupacion']) . ", '" . $data['cargo'] . "', '" . $data['logros'] . "', " . $data['id_archivo'] . ");";
  $query = $con->query($sql);
  $rpta = ($query === TRUE) ? true : false;
  return $rpta;
}

/* DEMANDANTES */

function confirma_demandante($idUsuario) {
  $con = conectar();
  $sql = "SELECT count(*) registros FROM puav_produccion.demandantes_bi WHERE idUsuario = " . $idUsuario;
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row['registros'];
}

function get_demandante_bi($id) {
  //echo "<script>alert('Entra get_demandante_bi: $id')</script>";
  $con = conectar();
  $sql = "SELECT u.id, u.username, u.tipo_usuario, d.id, d.nit, d.ciiu, d.razon_social,
			       d.representante_legal, d.telefono, d.celular, d.direccion, d.municipioCodigo, d.url_web
			FROM   usuarios AS u LEFT JOIN demandantes_bi AS d ON (u.id = d.idUsuario)
			WHERE  u.estado = 1 AND u.id = " . $id;
  //echo "<!-- Entra get_demandante_bi: $sql -->";
  $query = $con->query($sql);
  $row = $query->fetch_array(MYSQLI_ASSOC);
  return $row;
}

function set_demandante_bi($data) {
  //echo "<script>alert('Entra set_demandante_bi')</script>";
  $con = conectar();
  $sql = "INSERT INTO puav_produccion.demandantes_bi(idUsuario, nit, ciiu, razon_social, representante_legal,
						telefono, celular, direccion, municipioCodigo, url_web)
			VALUES      (" . $data['idUsuario'] . ", " . $data['nit'] . ", " . get_hierarchical_code_id('CIIU', '; ', $data['ciiu']) . ",
						'" . $data['razon_social'] . "', '" . $data['representante_legal'] . "', '" . $data['telefono'] . "', '" . $data['celular'] . "',
						'" . $data['direccion'] . "', " . get_hierarchical_code_id('departamento', ', ', $data['municipioCodigo']) . ", '" . $data['url_web'] . "');";
  //echo "<!-- $sql -->";
  $query = $con->query($sql);
  if ($query === TRUE) {
    return true;
  } else {
    return false;
  }
}

function set_demandante_bi_historico($id) {
  //echo "<script>alert('Entra a set_demandante_bi_historico: ".$id."');</script>";
  $con = conectar();
  $sql = "INSERT INTO puav_produccion.demandantes_bi_historico
			(id, idUsuario, nit, ciiu, razon_social, representante_legal, telefono, celular, direccion, municipioCodigo, url_web)
			SELECT id, idUsuario, nit, ciiu, razon_social, representante_legal, telefono, celular, direccion, municipioCodigo, url_web
			FROM puav_produccion.demandantes_bi WHERE id = " . $id . ";";
  //echo "<!-- ".$sql." -->";
  $query = $con->query($sql);
  if ($query === TRUE) {
    return true;
  } else {
    return false;
  }
}

function upd_demandante_bi($data) {
  //echo "<script>alert('Entra a upd_demandante_bi');</script>";
  $con = conectar();
  $sql = "UPDATE puav_produccion.demandantes_bi SET
			idUsuario=" . $data['idUsuario'] . ", nit=" . $data['nit'] . ", ciiu=" . get_hierarchical_code_id('CIIU', '; ', $data['ciiu']) . ", razon_social='" . $data['razon_social'] . "',
			representante_legal='" . $data['representante_legal'] . "', telefono='" . $data['telefono'] . "', celular='" . $data['celular'] . "',
			direccion='" . $data['direccion'] . "', municipioCodigo=" . get_municipio_id($data['municipioCodigo']) . ",
			url_web='" . $data['url_web'] . "' WHERE id = " . $data['id'] . ";";
  //echo "<!-- Entra a upd_demandante_bi: ".$sql." -->";
  $query = $con->query($sql);
  if ($query === TRUE) {
    return true;
  } else {
    return false;
  }
}

/* FUNCIONES USUARIOS */

//function valida_usuario($arreglo_usuario) {
//  //echo "<script>alert('valida_usuario: ".$arreglo_usuario['username'].".');</script>";
//  $con = conectar();
//  if (!isset($arreglo_usuario['username'], $arreglo_usuario['password'])) {
//    // Could not get the data that should have been sent.
//    die('Por favor diligencie ambos campos el de usuario y el de contraseña!');
//  } else {
//    try {
//      $sql = "SELECT id, password, tipo_usuario TipoUsuario, email, estado FROM usuarios where username = '" . $arreglo_usuario['username'] . "'";
//      //echo "<script>alert('valida_usuario: $sql.');</script>";
//      $query = $con->query($sql);
//      if ($query->num_rows == 0) {
//        $row = null;
//      } else {
//        $row = $query->fetch_array(MYSQLI_ASSOC);
//      }
//      if (!empty($row)) {
//        if ($row['estado'] == 1) {
//          //echo "<script>alert('valida_usuario: Estado activo.');</script>";
//          // Account exists, now we verify the password.
//          // Note: remember to use password_hash in your registration file to store the hashed passwords.
//          if (password_verify($arreglo_usuario['password'], $row['password'])) {
//            //echo "<script>alert('valida_usuario: clave válida.');</script>";
//            // Verification success! User has loggedin!
//            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
//            session_regenerate_id();
//            $_SESSION['loggedin'] = TRUE;
//            $_SESSION['name'] = $arreglo_usuario['username'];
//            $_SESSION['idUsuario'] = $row['id'];
//            $_SESSION['id_usuario'] = $row['id'];
//            $_SESSION['TipoUsuario'] = $row['TipoUsuario'];
//            $_SESSION['email'] = $row['email'];
//            //echo "<script>alert('valida_usuario: ".$_SESSION['loggedin']."/".$_SESSION['name']."/".$_SESSION['idUsuario']."/".$_SESSION['TipoUsuario']."/".$_SESSION['email'].".');</script>";
//            $stmt = $con->prepare("INSERT INTO log_in (idUsuario, username) VALUES (" . $_SESSION['idUsuario'] . ", '" . $arreglo_usuario['username'] . "');");
//            $stmt->execute();
//            return true;
//          } else {
//            header("Location: Login.php?error=1&TipoUsuario=" . $arreglo_usuario['TipoUsuario']);
//          }
//        } else {
//          header("Location: Login.php?error=2&TipoUsuario=" . $arreglo_usuario['TipoUsuario']);
//        }
//      } else {
//        header("Location: Login.php?error=3&TipoUsuario=" . $arreglo_usuario['TipoUsuario']);
//      }
//    } catch (Exception $e) {
//      echo $e;
//    }
//  }
//}
/* FUNCIONES GENERALES */

//function select_codigos($categoria, $nombre, $firstopt, $required = false, $seleccionado = NULL) {
//  $con = conectar();
//  $sql = "SELECT id, descripcion FROM codigos WHERE estado = 1 AND id_padre = " . $categoria;
//  $query = $con->query($sql);
//  $i = 0;
//  $sel = '';
//  $obj = '<select class="form-control" name="' . $nombre . '" id="' . $nombre . '"';
//  $obj .= ($required) ? " required='true'" : "";
//  $obj .= '>';
//  $obj .= '<option value="">Seleccionar ' . $firstopt . '...</option>';
//  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
//    if ($row['id'] == $seleccionado) {
//      $sel = 'selected';
//    }
//    $obj .= '<option value="' . $row['id'] . '" ' . $sel . '>' . $row['descripcion'] . '</option>';
//    $sel = '';
//    $i = $i + 1;
//  }
//  $obj .= '</select>';
//  return $obj;
//}
?>