<?php

include 'credenciales.php';
include 'TBL_codigos.php';

class DAO_codigos {

  private $con;

  public function DAO_codigos() {

  }

  public function conectar() {
    try {
      $this->con = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME) or die("Error de conexión a la base de datos");
      $this->con->set_charset("utf8");
    } catch (Exception $exc) {
      echo $exc->getTraceAsString();
    }
  }

  public function desconectar() {
    $this->con->close();
  }

  public function getTablaForDatatable() {
    $rpta = array('data' => array());
    $sql = "SELECT * FROM codigos";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_assoc($result)) {
      $actionBtn = "<a href=\"javascript:seleccionarCodigo('" . $row["id"] . "','" . $row["id_padre"] . "','" . $row["orden"] . "','" . $row["estado"] . "','" . $row["descripcion"] . "','" . $row["codigo_oficial"] . "')\" title='seleccionar' ><span class='fa fa-hand-point-left'></span></a>";
      $rpta['data'][] = array($row["id"], $row["id_padre"], $row["orden"], $row["estado"], $row["descripcion"], $row["codigo_oficial"], $actionBtn);
    }
    $result->close();

    return json_encode($rpta);
  }

  public function getCodigoById($id) {
    $sql = "SELECT * FROM codigos WHERE id = " . $id;
    echo "$sql";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_array($result)) {
      echo 'Entra';
      $rpta = $row;
    }
    $result->close();
    return $rpta;
  }

  public function getCodigoByDescripcion($descripcion) {
    $sql = "SELECT * FROM codigos WHERE descripcion = '" . $descripcion . "'";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    while ($row = mysqli_fetch_assoc($result)) {
      $rpta = $row;
    }
    $result->close();
    return $rpta;
  }

  public function getSelectByCategory($categoria, $selectName, $opcionUno = "Seleccione", $required = false, $seleccionado = NULL) {
    $sql = "SELECT id, descripcion FROM codigos WHERE estado = 1 AND id_padre = " . $categoria . " ORDER BY orden ASC, descripcion ASC";
    $this->conectar();
    $result = $this->con->query($sql);
    $this->desconectar();
    $rpta = '<select class="form-control" name="' . $selectName . '" id="' . $selectName . '"';
    $rpta .= ($required) ? " required >" : " >";
    $rpta .= '<option value="">Seleccionar ' . $opcionUno . '...</option>';
    //echo "$rpta";
    while ($row = mysqli_fetch_assoc($result)) {
      $rpta .= '<option value="' . $row['id'] . '" ';
      $rpta .= ($row['id'] == $seleccionado) ? "selected >" : " >";
      $rpta .= $row['descripcion'] . '</option>';
    }
    $rpta .= '</select>';
    $result->close();
    return $rpta;
  }

}
