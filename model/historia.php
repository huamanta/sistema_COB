<?php
$action = $_GET['action'];
require_once '../controller/historia.php';
$historia_paciente = new Historia();
switch ($action) {
  case 'listar_antecedentes_for_selected':
    echo $historia_paciente->listarAntecedentesForSelected();
    break;

  case 'listar_tratamiento_table':
    echo $historia_paciente->listarTratamientoTable();
    break;

  case 'buscar_paciente':
    $nombre_paciente = $_POST['nombre_paciente'];
    echo $historia_paciente->buscarPaciente($nombre_paciente);
    break;

  default:
    // code...
    break;
}
 ?>
