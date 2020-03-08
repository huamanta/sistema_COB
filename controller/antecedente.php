<?php

/**
 *
 */
class Antecedentes
{
  private $conn;
  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }



  public function listarAntecedentes()
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM ant_patologico WHERE deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date("Y-m-d", strtotime($result['created_at'])),
          '2' => $result['nombre'],
          '3' => ($result['estado']) ? '<span class="badge badge-primary badge-pill">Activo</span>' : '<span class="badge badge-primary badge-pill">Inactivo</span>',
          '4' => '<center>
                      <button type="button" name="button" class="btn btn-sm btn-success" onclick="verDataAntecedente('.$result['id_ant_patologico'].')"><i class="fa fa-pencil"></i></button>
                      <button type="button" name="button" class="btn btn-sm btn-danger" onclick="eliminarAntecedente('.$result['id_ant_patologico'].')"><i class="fa fa-trash"></i></button>
                  </center>'
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


  public function eliminarAntecedente( $id_antecedente)
  {
    // code...
    $fecha_delete = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("UPDATE ant_patologico SET deleted_at=? WHERE id_ant_patologico=?");
    $stm->execute(array($fecha_delete,  $id_antecedente));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
      return json_encode(array('success' => '0'));
    }else{
      return json_encode(array('success' => '1'));
    }
  }

  public function guardarAntecedente($nombre_antecedente, $descripcion_antecedente)
  {
    // code...
    $fecha_update = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("INSERT INTO ant_patologico(updated_at, nombre, descripcion) VALUES (?, ?, ? )");
    $stm->execute(array($fecha_update, $nombre_antecedente, $descripcion_antecedente));
    $stm->fetch(PDO::FETCH_OBJ);
      if(!$stm){
        return json_encode(array('success' => '0'));
      }else {
        return json_encode(array('success' => '1'));
      }
  }

  public function verDataAntecedente($id_antecedente)
  {

    $stm = $this->conn->prepare("SELECT * FROM ant_patologico WHERE id_ant_patologico=? AND deleted_at IS NULL");
    $stm->execute(array($id_antecedente));
    foreach ($stm as $stm) {
      return json_encode($stm);
  }

  }

  public function actualizarAntecedente($id_antecedente, $nombre_antecedente, $descripcion_antecedente)
  {
    // code...
    $stm = $this->conn->prepare("UPDATE ant_patologico SET nombre=?, descripcion=? WHERE id_ant_patologico=?");
    $stm ->execute(array($nombre_antecedente, $descripcion_antecedente, $id_antecedente));
    $stm->fetch(PDO::FETCH_OBJ);
    if (!$stm) {
      return json_encode(array('success' => '0'));
    }else{
      return json_encode(array('success' => '1'));
    }
  }





}


 ?>
