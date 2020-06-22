<?php

class usuarios {

  private $id;
  private $tipo_doc;
  private $username;
  private $password;
  private $email;
  private $confirmcode;
  private $estado;
  private $tipo_usuario;
  private $tratamiento_datos;
  private $fecha_registro;

  public function __construct() {

  }

  public function getId() {
    return $this->id;
  }

  public function getTipo_doc() {
    return $this->tipo_doc;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getConfirmcode() {
    return $this->confirmcode;
  }

  public function getEstado() {
    return $this->estado;
  }

  public function getTipo_usuario() {
    return $this->tipo_usuario;
  }

  public function getTratamiento_datos() {
    return $this->tratamiento_datos;
  }

  public function getFecha_registro() {
    return $this->fecha_registro;
  }

  public function setId($val) {
    $this->id = $val;
  }

  public function setTipo_doc($val) {
    $this->tipo_doc = $val;
  }

  public function setUsername($val) {
    $this->username = $val;
  }

  public function setPassword($val) {
    $this->password = $val;
  }

  public function setEmail($val) {
    $this->email = $val;
  }

  public function setConfirmcode($val) {
    $this->confirmcode = $val;
  }

  public function setEstado($val) {
    $this->estado = $val;
  }

  public function setTipo_usuario($val) {
    $this->tipo_usuario = $val;
  }

  public function setTratamiento_datos($val) {
    $this->tratamiento_datos = $val;
  }

  public function setFecha_registro($val) {
    $this->fecha_registro = $val;
  }

}
