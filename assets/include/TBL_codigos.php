<?php

class codigos {

  private $id;
  private $id_padre;
  private $orden;
  private $estado;
  private $descripcion;
  private $codigo_oficial;

  public function codigos() {

  }

  public function getId() {
    return $this->id;
  }

  public function getId_padre() {
    return $this->id_padre;
  }

  public function getOrden() {
    return $this->orden;
  }

  public function getEstado() {
    return $this->estado;
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function getCodigo_oficial() {
    return $this->codigo_oficial;
  }

  public function setId($val) {
    $this->id = $val;
  }

  public function setId_padre($val) {
    $this->id_padre = $val;
  }

  public function setOrden($val) {
    $this->orden = $val;
  }

  public function setEstado($val) {
    $this->estado = $val;
  }

  public function setDescripcion($val) {
    $this->descripcion = $val;
  }

  public function setCodigo_oficial($val) {
    $this->codigo_oficial = $val;
  }

}
