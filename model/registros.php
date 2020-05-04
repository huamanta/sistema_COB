<?php
$action = $_GET['action'];
require_once '../controller/registros.php';
$registros = new Historias();
switch ($action) {
  case 'listar':
    // code...
    echo $registros->listarHistorias();
    break;

  case 'get_data_paciente':
  	$id_historia_clinica = $_POST['id_historia_clinica'];
  	echo $registros->getDataPaciente($id_historia_clinica);
  	break;

  case 'get_antecedentes_paciente':
  	$id_historia_clinica = $_POST['id_historia_clinica'];
  	echo $registros->getAntecedentesPaciente($id_historia_clinica);
  	break;

  case 'listar_dientes_bloque1':
  	$id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque1($id_historia_clinica);
    break;

  case 'listar_dientes_bloque2':
  	$id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque2($id_historia_clinica);
    break;

  case 'listar_dientes_bloque3':
  	$id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque3($id_historia_clinica);
    break;

  case 'listar_dientes_bloque4':
  	$id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque4($id_historia_clinica);
    break;

  case 'listar_dientes_bloque5':
  	$id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque5($id_historia_clinica);
    break;

  case 'listar_dientes_bloque6':
  	$id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque6($id_historia_clinica);
    break;

  case 'listar_dientes_bloque7':
  	$id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque7($id_historia_clinica);
    break;

  case 'listar_dientes_bloque8':
    $id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarDientesBloque8($id_historia_clinica);
    break;

  case 'listar_tratamiento_paciente':
    $id_historia_clinica = $_GET['id_historia_clinica'];
    echo $registros->listarTratamientoPaciente($id_historia_clinica);
    break;

  case 'listar_pago_tratamiento':
    $id_historia_clinica = $_POST['id_historia_clinica'];
    echo $registros->listarPagoTratamiento($id_historia_clinica);
    break;

  default:
    // code...
    break;
}

 ?>
