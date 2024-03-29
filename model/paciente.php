<?php
$action = $_GET['action'];
require_once '../controller/paciente.php';
$paciente = new Paciente();
switch ($action) {

  case 'listar_genero':
    echo $paciente->listarGenero();
    break;

  case 'listar_estado_civil':
    echo $paciente->listarEstadoCivil();
    break;

  case 'listar_tipo_documento':
    echo $paciente->listarTipoDocumento();
    break;

  case 'guardar':
    // code...
  $tipo_doc_paciente = $_POST['tipo_doc'];
  $numero_documento = $_POST['numero_documento'];
  $nombres_paciente = $_POST['nombres'];
  $apellidos_paciente = $_POST['apellidos'];
  $fecha_nacimiento = $_POST['fecha_nacimiento'];
  $ocupacion_paciente = $_POST['ocupacion'];
  $genero_paciente = $_POST['genero'];
  $estado_civil = $_POST['estado_civil'];
  $email_paciente = $_POST['email'];
  $direccion_paciente = $_POST['direccion'];
  $ubigeo_paciente = trim($_POST['ubigeo']);
  $telefono_paciente = $_POST['telefono'];
  $nombre_apoderado = $_POST['nombre_apoderado'];
  $telefono_apoderado = $_POST['telefono_apoderado'];
  if (!isset($_POST['id_persona'])) {
    // code...
  echo $paciente->guardarPaciente($tipo_doc_paciente, $numero_documento, $nombres_paciente, $apellidos_paciente, $fecha_nacimiento, $ocupacion_paciente, $genero_paciente, $estado_civil, $email_paciente, $direccion_paciente,  $ubigeo_paciente, $telefono_paciente, $nombre_apoderado, $telefono_apoderado);
  }else {
          $id_persona = $_POST['id_persona'];
          $id_paciente = $_POST['id_paciente'];
      echo $paciente->actualizarPaciente($id_paciente, $id_persona, $tipo_doc_paciente, $numero_documento, $nombres_paciente, $apellidos_paciente, $fecha_nacimiento, $ocupacion_paciente, $genero_paciente, $estado_civil, $email_paciente, $direccion_paciente,  $ubigeo_paciente, $telefono_paciente,$nombre_apoderado, $telefono_apoderado);
    }
    break;
    case 'listar':
      // code...
      echo $paciente->listarPacientes();

    break;
    case 'eliminarPaciente':
        // code...
        $id_paciente = $_POST['id_paciente'];
        echo $paciente-> eliminarPaciente($id_paciente);
    break;
    case 'dataPaciente':
          // code...
          $id_paciente = $_POST['id_paciente'];
          echo $paciente->verDataPaciente($id_paciente);
    break;
  default:
    // code...
    break;
}

 ?>
