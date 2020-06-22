<?php

include 'credenciales.php';
include 'TBL_menus.php';

class DAO_menus {

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

  public function getMenuById($id) {
    $sql = "SELECT * FROM menus where id = " . $id;
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_array($result)) {
      $rpta = $row;
    }
    $result->close();
    return $rpta;
  }

  public function getMenuByUsername($username) {
    $sql = "SELECT * FROM menus where username = '" . $username . "'";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_assoc($result)) {
      $rpta = $row;
    }
    $result->close();
    return $rpta;
  }

  public function getMenuByRol($rol) {
    $sql = "SELECT m.etiqueta, m.url, m.target FROM menus m JOIN rel_menusByRol rmr ON m.id = rmr.idMenu WHERE rmr.idRol = " . $rol . " ORDER BY rmr.orden asc, m.etiqueta asc";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_assoc($result)) {
      $rpta[] = $row;
    }
    $result->close();
    return $rpta;
  }

  public function inserta($obj) {
    $rpta = false;
    $myObj = new menus();
    $myObj = $obj;
    $sql = "INSERT INTO menus(tipo_doc,  tipo_usuario,  tratamiento_datos,  fecha_registro,  username,  password,  email,  confirmcode) "
            . "values (" . $myObj->getTipo_doc() . ",  " . $myObj->getTipo_usuario() . ",  " . $myObj->getTratamiento_datos() . ",  CURRENT_TIMESTAMP,  '" . $myObj->getUsername() . "',  '" . $myObj->getPassword() . "',  '" . $myObj->getEmail() . "',  '" . $myObj->getConfirmcode() . "')";
    $this->conectar();
    if ($this->con->query($sql)) {
      $rpta = true;
    }
    $this->desconectar();
    return $rpta;
  }

}
