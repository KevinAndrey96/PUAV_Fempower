<?php

class menus {

  private $id;
  private $estado;
  private $etiqueta;
  private $url;
  private $librerias;
  private $estilos;
  private $target;

  public function __construct() {

  }

  public function getId() {
    return $this->id;
  }

  public function getEstado() {
    return $this->estado;
  }

  public function getEtiqueta() {
    return $this->etiqueta;
  }

  public function getUrl() {
    return $this->url;
  }

  public function getLibrerias() {
    return $this->librerias;
  }

  public function getEstilos() {
    return $this->estilos;
  }

  public function getTarget() {
    return $this->target;
  }

  public function setId($val) {
    $this->id = $val;
  }

  public function setEstado($val) {
    $this->estado = $val;
  }

  public function setEtiqueta($val) {
    $this->etiqueta = $val;
  }

  public function setUrl($val) {
    $this->url = $val;
  }

  public function setLibrerias($val) {
    $this->librerias = $val;
  }

  public function setEstilos($val) {
    $this->estilos = $val;
  }

  public function setTarget($val) {
    $this->target = $val;
  }

}
