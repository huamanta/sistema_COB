<?php
$action = $_GET['action'];
require_once '../controller/antecedente.php';

$antecedente = new Antecedentes();

switch ($action) {
  case 'listar':
    // code...
    echo $antecedente->listarAntecedentes();
    break;
  case 'eliminarAnte':
    // code...
      $id_antecedente = $_POST['id_ant_patologico'];
    echo $antecedente-> eliminarAntecedente($id_antecedente);
    break;
    case 'guardar':
      // code...
          $nombre_antecedente = $_POST['nombre'];
          $descripcion_antecedente= $_POST['descripcion'];
          if(!isset($_POST['id_ant_patologico'])){
            echo $antecedente->guardarAntecedente($nombre_antecedente, $descripcion_antecedente);
          }else{
            $id_antecedente = $_POST['id_ant_patologico'];
            echo $antecedente->actualizarAntecedente($id_antecedente, $nombre_antecedente, $descripcion_antecedente);
          }
      break;
      case 'verData':
        // code...
        $id_antecedente = $_POST['id_ant_patologico'];
        echo $antecedente->verDataAntecedente($id_antecedente);
        break;

  default:
    // code...
    break;
}

 ?>
