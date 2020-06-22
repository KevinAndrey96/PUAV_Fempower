<?php

class log_in {

  private $id;
  private $idUsuario;
  private $username;
  private $date_login;
  private $date_logoff;

  public function log_in() {

  }

  public function getId() {
    return $this->id;
  }

  public function getIdUsuario() {
    return $this->idUsuario;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getDate_login() {
    return $this->date_login;
  }

  public function getDate_logoff() {
    return $this->date_logoff;
  }

  public function setId($val) {
    $this->id = $val;
  }

  public function setIdUsuario($val) {
    $this->idUsuario = $val;
  }

  public function setUsername($val) {
    $this->username = $val;
  }

  public function setDate_login($val) {
    $this->date_login = $val;
  }

  public function setDate_logoff($val) {
    $this->date_logoff = $val;
  }

}

?>
