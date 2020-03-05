<?php
/**
 *
 */
class Paciente
{
private $conn;
  function __construct()
  {
    // code...
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

public function guardarPaciente($tipo_doc_paciente, $numero_documento, $nombres_paciente, $apellidos_paciente, $fecha_nacimiento, $ocupacion_paciente, $genero_paciente, $estado_civil, $email_paciente, $direccion_paciente,  $ubigeo_paciente, $telefono_paciente, $nombre_apoderado, $telefono_apoderado)
{
  // code...
        $segundo_nombre = '';
        $segundo_apellido = '';
        $fecha_update = date('Y-m-d H:i:s');
        if (strlen($numero_documento) == 8 || strlen($numero_documento) == 1) {
          $nombres = explode(" ", $nombres_paciente);
          $primer_nombre = $nombres[0];
          if (!empty($nombres[1])) {
              $segundo_nombre = $nombres[1];
          }
          $apellidos = explode(" ", $apellidos_paciente);
          $primer_apellido = $apellidos[0];
          if (!empty($apellidos[1])) {
              $segundo_apellido = $apellidos[1];
          }
        }else if (strlen($numero_documento) == 11) {
          // code...
          $primer_nombre = $nombres_paciente;
          $segundo_nombre = '';
          $primer_apellido = '';
          $segundo_apellido = '';
        }

        $newDate = date("Y-m-d", strtotime($fecha_nacimiento));

      $stm =  $this->conn->prepare("INSERT INTO persona(updated_at, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, numero_documento, email, telefono, ubigeo, direccion, ocupacion,  id_tipo_documento, id_estado_civil, id_genero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
      $stm->execute(array($fecha_update, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $newDate, $numero_documento, $email_paciente, $telefono_paciente, $ubigeo_paciente, $direccion_paciente, $ocupacion_paciente, $tipo_doc_paciente, $estado_civil, $genero_paciente));
      $stm->fetch(PDO::FETCH_OBJ);
      $id_insert = $this->conn->lastInsertId();
      if (!$stm) {
        return json_encode(array('success' => '0'));
      }else{
        $stm1 = $this->conn->prepare("INSERT INTO paciente (updated_at, nombre_apoderado, telefono_apoderado, id_persona) VALUES (?, ?, ?, ?)");
        $stm1->execute(array($fecha_update, $nombre_apoderado, $telefono_apoderado, $id_insert));
        $stm1->fetch(PDO::FETCH_OBJ);
        if (!$stm1) {
          return json_encode(array('success' => '0'));
        }else{
          return json_encode(array('success' => '1'));
        }
      }

}

public function listarPacientes()
{
  try {
    $stm = $this->conn->prepare("SELECT * FROM persona pe, paciente pa WHERE pe.id_persona = pa.id_persona AND pa.deleted_at IS NULL");
    $stm->execute();
    $data = Array();
    $count = 1;
    foreach ($stm as $result) {
      $data[] = array(
        '0' => $count++,
        '1' => date('d-m-Y', strtotime($result['created_at'])),
        '2' => $result['primer_nombre'].' '.$result['segundo_nombre'].' '.$result['primer_apellido'].' '.$result['segundo_apellido'],
        '3' => $result['numero_documento'],
        '4' => $result['email'],
        '5' => $result['telefono'],
        '6' => $result['ubigeo'],
      );
    }
    $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
            return json_encode($results);
  } catch (\Exception $e) {
    die($e->getMessage());
  }
}

}


 ?>
