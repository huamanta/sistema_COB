<?php
$action = $_GET['action'];
require_once '../controller/tratamiento.php';

$tratamiento = new Tratamiento();

switch ($action) {
  case 'listar':
    // code...
    echo $tratamiento->listarTratamientos();
    break;
  case 'eliminar':
    // code...
      $id_tratamiento = $_POST['id_tratamiento'];
    echo $tratamiento-> eliminarTratamiento($id_tratamiento);
    break;
    case 'guardar':
      // code...
          $nombre_tratamiento = $_POST['nombre'];
          $costo_tratamiento = $_POST['costo'];
          $descripcion_tratamiento = $_POST['descripcion'];
          if(!isset($_POST['id_tratamiento'])){
            echo $tratamiento->guardarTratamiento($nombre_tratamiento, $costo_tratamiento, $descripcion_tratamiento);
          }else{
            $id_tratamiento = $_POST['id_tratamiento'];
            echo $tratamiento->actualizarTratamiento($id_tratamiento, $nombre_tratamiento, $costo_tratamiento, $descripcion_tratamiento);
          }
      break;
      case 'verData':
        // code...
        $id_tratamiento = $_POST['id_tratamiento'];
        echo $tratamiento->verDataTratamiento($id_tratamiento);
        break;

  default:
    // code...
    break;
}

 ?>
