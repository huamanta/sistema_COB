<?php
$action = $_GET['action'];
require_once '../controller/registros.php';
$registros = new Historias();
switch ($action) {
  case 'listar':
    // code...
    echo $registros->listarHistorias();
    break;

  default:
    // code...
    break;
}

 ?>
