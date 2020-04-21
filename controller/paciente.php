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

  public function listarGenero()
  {
    // code...
    $stm = $this->conn->prepare("SELECT * FROM genero WHERE deleted_at IS NULL");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_genero' => $result['id_genero'],
        'nombre' => $result['nombre'],
        'abreviacion' => $result['abreviacion'],
        );
    }
    return json_encode($data);
  }

  public function listarEstadoCivil()
  {
    // code...
    $stm = $this->conn->prepare("SELECT * FROM estado_civil WHERE deleted_at IS NULL");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_estado_civil' => $result['id_estado_civil'],
        'nombre' => $result['nombre'],
        'abreviacion' => $result['abreviacion'],
        );
    }
    return json_encode($data);
  }

  public function listarTipoDocumento()
  {
    // code...
    $stm = $this->conn->prepare("SELECT * FROM tipo_documento WHERE deleted_at IS NULL");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_tipo_documento' => $result['id_tipo_documento'],
        'nombre' => $result['nombre'],
        'abreviacion' => $result['abreviacion'],
        );
    }
    return json_encode($data);
  }

  public function verDataPaciente($id_paciente)
  {
    // code...
    $stm = $this->conn->prepare("SELECT pc.id_paciente, pc.created_at, pc.nombre_apoderado, pc.telefono_apoderado, pc.id_persona, p.id_estado_civil, p.id_tipo_documento , p.id_genero , p.primer_nombre, p.segundo_nombre, p.primer_apellido,
       p.segundo_apellido, p.fecha_nacimiento, p.numero_documento, p.email, p.telefono, p.ubigeo, p.direccion, p.ocupacion
       FROM persona AS p, paciente AS pc
     WHERE p.id_persona = pc.id_persona AND pc.id_paciente = ? AND pc.deleted_at IS NULL");
    $stm->execute(array($id_paciente));
    foreach ($stm as $stm) {
      return json_encode($stm);
  }
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
public function actualizarPaciente($id_paciente, $id_persona,  $tipo_doc_paciente, $numero_documento, $nombres_paciente, $apellidos_paciente, $fecha_nacimiento, $ocupacion_paciente, $genero_paciente, $estado_civil, $email_paciente, $direccion_paciente,  $ubigeo_paciente, $telefono_paciente, $nombre_apoderado, $telefono_apoderado)
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
            $stm = $this->conn->prepare("UPDATE persona SET primer_nombre=?, segundo_nombre=?, primer_apellido=?, segundo_apellido=?, fecha_nacimiento=?, numero_documento=?, email=?, telefono=?, ubigeo=?, direccion=?, ocupacion=?,  id_tipo_documento=?, id_estado_civil=?, id_genero=? WHERE id_persona=?");
              $stm ->execute(array($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $newDate, $numero_documento, $email_paciente, $telefono_paciente, $ubigeo_paciente, $direccion_paciente, $ocupacion_paciente, $tipo_doc_paciente, $estado_civil, $genero_paciente, $id_persona));
              $stm->fetch(PDO::FETCH_OBJ);
              if (!$stm) {
                      return json_encode(array('success' => '0'));
                    }else{
                      $stm1 =  $this->conn->prepare("UPDATE paciente SET nombre_apoderado=?, telefono_apoderado=? WHERE id_paciente=?");
                      $stm1->execute(array( $nombre_apoderado, $telefono_apoderado, $id_paciente));
                      $stm->fetch(PDO::FETCH_OBJ);
                      return json_encode(array('success' => '1'));
                    }
          }


public function listarPacientes()
{
  try {
    $stm = $this->conn->prepare("SELECT pc.id_paciente ,pc.id_persona , p.created_at, p.primer_nombre, p.segundo_nombre,p.primer_apellido,p.segundo_apellido,p.numero_documento,p.email,p.telefono,p.ubigeo
      FROM persona AS p, paciente AS pc
      WHERE p.id_persona = pc.id_persona AND pc.deleted_at IS NULL");
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
        '7' => '<button class="btn btn-danger" onclick="eliminarPaciente('.$result['id_paciente'].')"><i class="fa fa-trash"></i></button><a href="" class="btn btn-success"><i class="fa fa-eye"></i></a><a href="javascript:Redirect('."'".$result['id_paciente']."'".','."'".$result['id_persona']."'".')" class="btn btn-info"><i class="fa fa-pencil"></i></a>',
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



public function eliminarPaciente( $id_paciente)
{
  // code...
  $fecha_delete = date('Y-m-d H:i:s');
  $stm = $this->conn->prepare("UPDATE paciente SET deleted_at=? WHERE id_paciente=?");
  $stm->execute(array($fecha_delete,  $id_paciente));
  $r = $stm->fetch(PDO::FETCH_OBJ);
  if ($r) {
    return json_encode(array('success' => '0'));
  }else{
    return json_encode(array('success' => '1'));
  }
}

}


 ?>
