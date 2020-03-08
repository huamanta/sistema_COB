<?php
$action = $_GET['action'];
require_once '../controller/dientes.php';

$dientes = new Dientes();

switch ($action) {
  case 'listar':
    // code...
    echo  $dientes->listarDientes();
    break;
    case 'actualizar':
      // code...
      $nombre_diente = $_POST['nombre'];
      $numero_diente= $_POST['numero'];
      if(isset($_POST['id_diente'])){
        $id_diente = $_POST['id_diente'];
        echo $dientes->actualizarDiente($id_diente, $nombre_diente, $numero_diente);
      }
      break;
      case 'verData':
        // code...
        $id_diente = $_POST['id_diente'];
        echo $dientes->verDataDiente($id_diente);

        break;
        case 'eliminar':
          // code...
          $id_diente = $_POST['id_diente'];
        echo $dientes-> eliminarDiente($id_diente);
        break;
        case 'listarEliminados':
            // code...
            echo  $dientes->listarDientesEliminados();
            break;
        case 'recuperar':
              // code...
              $id_diente = $_POST['id_diente'];
            echo $dientes-> recuperarDiente($id_diente);
       break;

  default:
    // code...
    break;
}


 ?>
