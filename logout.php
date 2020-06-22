<?php

session_start();

include 'assets/include/DAO_usuarios.php';
include 'assets/include/DAO_log_in.php';

$objUsuario = new DAO_usuarios();
$addObjUsuario = new usuarios();
$objLog_in = new DAO_log_in();
$addObjLog_in = new log_in();

try {
  if (isset($_SESSION)) {
    $LastLog_in = $this->$objLog_in->getLastLog_inByUsername($_SESSION["idUsuario"]);
    if (!empty($LastLog_in)) {
      $rpta = $this->$objLog_in->RegistraSalida($LastLog_in["id"]);
    }
  }
  header("Location: index.php");
} catch (Exception $exc) {
  echo $exc->getTraceAsString();
}
?>