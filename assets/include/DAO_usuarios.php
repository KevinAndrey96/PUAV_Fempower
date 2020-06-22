<?php

include 'credenciales.php';
include 'TBL_usuarios.php';

class DAO_usuarios {

  private $con;

  public function __construct() {

  }

  public function conectar() {
    try {
      $this->con = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME) or die("Error de conexión a la base de datos");
      $this->con->set_charset("utf8");
    } catch (Exception $ex) {
      echo $ex->getTraceAsString();
    }
  }

  public function desconectar() {
    $this->con->close();
  }

  public function getUsuarioById($id) {
    $sql = "SELECT * FROM usuarios where id = " . $id;
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_array($result)) {
      $rpta = $row;
    }
    $result->close();
    return $rpta;
  }

  public function getUsuarioByUsername($username) {
    $sql = "SELECT * FROM usuarios where username = '" . $username . "'";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_assoc($result)) {
      $rpta = $row;
    }
    return $rpta;
  }

  public function getUsuarioByUsernameNtipo($username, $tipo) {
    $sql = "SELECT * FROM usuarios WHERE username = '" . $username . "' AND tipo_usuario = " . $tipo;
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_assoc($result)) {
      $rpta = $row;
    }
    return $rpta;
  }

  public function getUsuarioByCod_UN($username, $codigo) {
    $sql = "SELECT * FROM usuarios where username = '" . $username . "' AND confirmcode = '" . $codigo . "'";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_assoc($result)) {
      $rpta = $row;
    }
    return $rpta;
  }

  public function validaUsuario($username, $password, $tipoUsuario) {
    $result = $this->getUsuarioByUsernameNtipo($username, $tipoUsuario);
    if (!empty($result)) {
      if ($result['estado'] == 1) {
        if (password_verify($password, $result['password'])) {
          $rpta['loggedin'] = true;
          $rpta['name'] = $username;
          $rpta['idUsuario'] = $result['id'];
          $rpta['id_usuario'] = $result['id'];
          $rpta['TipoUsuario'] = $result['TipoUsuario'];
          $rpta['email'] = $result['email'];
        } else {
          header("Location: Login.php?error=1");
        }
      } else {
        header("Location: Login.php?error=2");
      }
    } else {
      header("Location: Login.php?error=3");
    }
    return $rpta;
  }

  public function inserta($obj) {
    $rpta = false;
    $myObj = new usuarios();
    $myObj = $obj;
    $sql = "INSERT INTO usuarios(tipo_doc,  tipo_usuario,  tratamiento_datos,  fecha_registro,  username,  password,  email,  confirmcode) "
            . "values (" . $myObj->getTipo_doc() . ",  " . $myObj->getTipo_usuario() . ",  " . $myObj->getTratamiento_datos() . ",  CURRENT_TIMESTAMP,  '" . $myObj->getUsername() . "',  '" . $myObj->getPassword() . "',  '" . $myObj->getEmail() . "',  '" . $myObj->getConfirmcode() . "')";
    $this->conectar();
    if ($this->con->query($sql)) {
      $rpta = true;
    }
    $this->desconectar();
    return $rpta;
  }

  public function ActivaUsuario($username, $codigo) {
    $rpta = false;
    $result = $this->getUsuarioByCod_UN($username, $codigo);
    if ($result['confirmcode'] == $codigo) {
      $sql = "UPDATE usuarios SET estado = 1 WHERE id = " . $result['id'];
      $this->conectar();
      if ($this->con->query($sql)) {
        $rpta = true;
      }
      return $rpta;
    }
  }

}
