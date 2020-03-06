<?php
/**
 *
 */
class Usuarios
{

  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

  public function listarUsuarios()
  {
    try {
      $stm = $this->conn->prepare("SELECT pc.id_usuario, pc.id_persona, pc.username, r.nombre, p.created_at, p.primer_nombre, p.segundo_nombre,p.primer_apellido,p.segundo_apellido,p.numero_documento,p.email,p.telefono,p.ubigeo
        FROM persona AS p, usuario AS pc, rol r
        WHERE p.id_persona = pc.id_persona AND pc.id_rol = r.id_rol AND pc.deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date('d-m-Y', strtotime($result['created_at'])),
          '2' => $result['primer_nombre'].' '.$result['segundo_nombre'].' '.$result['primer_apellido'].' '.$result['segundo_apellido'],
          '3' => $result['telefono'],
          '4' => $result['email'],
          '5' => $result['username'],
          '6' => $result['nombre'],
          '7' => '<button class="btn btn-info" onclick="actualizarCredenciales('.$result['id_usuario'].')"><i class="fa fa-cog"></i></button>
                  <a style="color: white" href="javascript:Redirect('."'".$result['id_usuario']."'".','."'".$result['id_persona']."'".')" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                  <button class="btn btn-danger" onclick="eliminarUsuario('.$result['id_usuario'].')"><i class="fa fa-trash"></i></button>',
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

  public function guardarUsuario($tipo_doc, $numero_documento, $nombres, $apellidos, $ocupacion, $ubigeo, $fecha_nacimiento, $genero, $estado_civil, $email, $telefono, $direccion, $id_rol, $usuario, $password)
  {
    $segundo_nombre = '';
    $segundo_apellido = '';
    $fecha_update = date('Y-m-d H:i:s');
    if (strlen($numero_documento) == 8) {
      $nombres = explode(" ", $nombres);
      $primer_nombre = $nombres[0];
      if (!empty($nombres[1])) {
          $segundo_nombre = $nombres[1];
      }
      $apellidos = explode(" ", $apellidos);
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
    $stm =  $this->conn->prepare("INSERT INTO persona(updated_at, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nacimiento, numero_documento, email, telefono, ubigeo, direccion, ocupacion,  id_tipo_documento, id_estado_civil, id_genero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stm->execute(array($fecha_update, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $newDate, $numero_documento, $email, $telefono, $ubigeo, $direccion, $ocupacion, $tipo_doc, $estado_civil, $genero));
    $stm->fetch(PDO::FETCH_OBJ);
    $id_insert = $this->conn->lastInsertId();
    if (!$stm) {
      return json_encode(array('success' => '0'));
    }else{
      $stm1 = $this->conn->prepare("INSERT INTO usuario (updated_at, username, password, id_persona, id_rol) VALUES (?, ?, ?, ?, ?)");
      $stm1->execute(array($fecha_update, $usuario, $password, $id_insert, $id_rol));
      $stm1->fetch(PDO::FETCH_OBJ);
      if (!$stm1) {
        return json_encode(array('success' => '0'));
      }else{
        return json_encode(array('success' => '1'));
      }
    }
  }

  public function actualizarUsuario($id_persona, $id_usuario, $tipo_doc, $numero_documento, $nombres, $apellidos, $ocupacion, $ubigeo, $fecha_nacimiento, $genero, $estado_civil, $email, $telefono, $direccion)
  {
    $segundo_nombre = '';
    $segundo_apellido = '';
    $fecha_update = date('Y-m-d H:i:s');
    if (strlen($numero_documento) == 8) {
      $nombres = explode(" ", $nombres);
      $primer_nombre = $nombres[0];
      if (!empty($nombres[1])) {
          $segundo_nombre = $nombres[1];
      }
      $apellidos = explode(" ", $apellidos);
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
      $stm ->execute(array($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $newDate, $numero_documento, $email, $telefono, $ubigeo, $direccion, $ocupacion, $tipo_doc, $estado_civil, $genero, $id_persona));
      $stm->fetch(PDO::FETCH_OBJ);
      if (!$stm) {
          return json_encode(array('success' => '0'));
      }else{
          return json_encode(array('success' => '1'));
      }
  }

  public function listarDataUsuario($id_usuario, $id_persona)
  {
    try {
      $stm = $this->conn->prepare("SELECT pc.id_usuario, pc.id_persona, p.id_tipo_documento, p.primer_nombre, p.segundo_nombre, p.primer_apellido, p.segundo_apellido, p.numero_documento, p.ocupacion, p.ubigeo, p.fecha_nacimiento, p.id_genero, p.id_estado_civil, p.email, p.telefono, p.direccion
        FROM persona AS p, usuario AS pc
        WHERE p.id_persona = pc.id_persona  AND pc.id_usuario = ? AND pc.id_persona = ? AND  pc.deleted_at IS NULL");
      $stm->execute(array($id_usuario, $id_persona));
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          'id_tipo_documento' => $result['id_tipo_documento'],
          'numero_documento' => $result['numero_documento'],
          'nombres' => $result['primer_nombre'].' '.$result['segundo_nombre'],
          'apellidos' => $result['primer_apellido'].' '.$result['segundo_apellido'],
          'ocupacion' => $result['ocupacion'],
          'ubigeo' => $result['ubigeo'],
          'fecha_nacimiento' => $result['fecha_nacimiento'],
          'id_genero' => $result['id_genero'],
          'id_estado_civil' => $result['id_estado_civil'],
          'email' => $result['email'],
          'telefono' => $result['telefono'],
          'direccion' => $result['direccion'],
          );
      }
      return json_encode($data);
    } catch (\Exception $e) {
      die($e->getMessage());
    }

  }

  public function listarDataCredenciales($id_usuario)
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM usuario WHERE id_usuario = ? AND  deleted_at IS NULL");
      $stm->execute(array($id_usuario));
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          'id_rol' => $result['id_rol'],
          'id_usuario' => $result['id_usuario'],
          'username' => $result['username'],
          );
      }
      return json_encode($data);
    } catch (\Exception $e) {
      die($e->getMessage());
    }

  }

  public function actualizarUserCredenciales($id_usuario, $id_rol, $usuario)
  {
    try {
      $fecha_update = date('Y-m-d H:i:s');
      $stm = $this->conn->prepare("UPDATE usuario SET updated_at = ?, id_rol = ?, username = ? WHERE id_usuario = ?");
      $stm->execute(array($fecha_update, $id_rol, $usuario, $id_usuario));
      $stm->fetch(PDO::FETCH_OBJ);
      if ($stm) {
        return json_encode(array('success' => '1'));
      }else{
        return json_encode(array('success' => '0'));
      }
    } catch (\Exception $e) {
      die($e->getMessage());
    }

  }

  public function actualizarUserCredencialesPassword($id_usuario, $id_rol, $usuario, $password)
  {
    try {
      $fecha_update = date('Y-m-d H:i:s');
      $stm = $this->conn->prepare("UPDATE usuario SET updated_at = ?, id_rol = ?, username = ?, password = ? WHERE id_usuario = ?");
      $stm->execute(array($fecha_update, $id_rol, $usuario, $password, $id_usuario));
      $stm->fetch(PDO::FETCH_OBJ);
      if ($stm) {
        return json_encode(array('success' => '1'));
      }else{
        return json_encode(array('success' => '0'));
      }
    } catch (\Exception $e) {
      die($e->getMessage());
    }
  }


  public function eliminarUsuario($id_usuario)
  {
    try {
      $fecha_delete = date('Y-m-d H:i:s');
      $stm = $this->conn->prepare("UPDATE usuario SET deleted_at = ?, estado = ? WHERE id_usuario = ?");
      $stm->execute(array($fecha_delete, '0', $id_usuario));
      $stm->fetch(PDO::FETCH_OBJ);
      if ($stm) {
        return json_encode(array('success' => '1'));
      }else{
        return json_encode(array('success' => '0'));
      }
    } catch (\Exception $e) {
      die($e->getMessage());
    }
  }

}

?>
