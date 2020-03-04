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

  case 'listar_dientes_bloque1':
    echo $historia_paciente->listarDientesBloque1();
    break;

  case 'listar_dientes_bloque2':
    echo $historia_paciente->listarDientesBloque2();
    break;

  case 'listar_dientes_bloque3':
    echo $historia_paciente->listarDientesBloque3();
    break;

  case 'listar_dientes_bloque4':
    echo $historia_paciente->listarDientesBloque4();
    break;

  case 'listar_dientes_bloque5':
    echo $historia_paciente->listarDientesBloque5();
    break;

  case 'listar_dientes_bloque6':
    echo $historia_paciente->listarDientesBloque6();
    break;

  case 'listar_dientes_bloque7':
    echo $historia_paciente->listarDientesBloque7();
    break;

  case 'listar_dientes_bloque8':
    echo $historia_paciente->listarDientesBloque8();
    break;

  case 'agregar_diente_historia':
    //$id_diente = $_POST['id_diente'];
    $id_diente = $_POST['id_diente'];
    echo $historia_paciente->agregarDienteHistoria($id_diente);
    break;

  case 'eliminar_diente_historia':
    //$id_diente = $_POST['id_diente'];
    $id_detalle_historia = $_POST['id_detalle_historia'];
    echo $historia_paciente->eliminarDienteHistoria($id_detalle_historia);
    break;

  case 'agregar_antecedente_historia':
    //$id_diente = $_POST['id_diente'];
    $id_ant_patologico = $_POST['id_ant_patologico'];
    echo $historia_paciente->agregarAntecedenteHistoria($id_ant_patologico);
    break;

  case 'eliminar_antecedente_historia':
    //$id_diente = $_POST['id_diente'];
    $id_detalle_historia = $_POST['id_detalle_historia'];
    echo $historia_paciente->eliminarAntecedenteHistoria($id_detalle_historia);
    break;

  case 'agregar_tratamiento_table':
    //$id_diente = $_POST['id_diente'];
    $id_tratamiento = $_POST['id_tratamiento'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $total = $precio*$cantidad;
    echo $historia_paciente->agregarTratamientoHistoria($id_tratamiento, $precio, $cantidad, $total);
    break;

  case 'eliminar_tratamiento_table':
    //$id_diente = $_POST['id_diente'];
    $id_tratamiento = $_POST['id_tratamiento'];
    echo $historia_paciente->eliminarTratamientoHistoria($id_tratamiento);
    break;

  default:
    // code...
    break;
}
 ?>
