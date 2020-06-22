<?php

include 'assets/include/DAO_usuarios.php';
$ObjUsuario = new DAO_usuarios();
$addObjUsuario = new usuarios();
if ($ObjUsuario->ActivaUsuario($_GET["username"], $_GET["confirmcode"])) {
  header('Location: index.php?accion=1');
} else {
  header('Location: registro.php?accion=2');
}