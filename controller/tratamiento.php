<?php
/**
 *
 */
class Tratamiento
{
  private $conn;
  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }


  public function listarTratamientos()
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM tratamiento WHERE deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date("Y-m-d", strtotime($result['created'])),
          '2' => $result['nombre'],
          '3' => 'S/. '.$result['costo'],
          '4' => '<center>
                      <button type="button" name="button" class="btn btn-sm btn-success" onclick="verDataTratamiento('.$result['id_tratamiento'].')"><i class="fa fa-pencil"></i></button>
                      <button type="button" name="button" class="btn btn-sm btn-danger" onclick="eliminarTratamiento('.$result['id_tratamiento'].')"><i class="fa fa-trash"></i></button>
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

  public function eliminarTratamiento( $id_tratamiento)
  {
    // code...
    $fecha_delete = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("UPDATE tratamiento SET deleted_at=? WHERE id_tratamiento=?");
    $stm->execute(array($fecha_delete,  $id_tratamiento));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
      return json_encode(array('success' => '0'));
    }else{
      return json_encode(array('success' => '1'));
    }
  }

  public function guardarTratamiento($nombre_tratamiento, $costo_tratamiento, $descripcion_tratamiento)
  {
    // code...
    $fecha_update = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("INSERT INTO tratamiento(updated,  nombre, costo, descripcion ) VALUES (?, ?, ?, ?)");
    $stm->execute(array($fecha_update, $nombre_tratamiento, $costo_tratamiento, $descripcion_tratamiento));
    $stm->fetch(PDO::FETCH_OBJ);
      if(!$stm){
        return json_encode(array('success' => '0'));
      }else {
        return json_encode(array('success' => '1'));
      }
  }

  public function verDataTratamiento($id_tratamiento)
  {

    $stm = $this->conn->prepare("SELECT * FROM tratamiento WHERE id_tratamiento=? AND deleted_at IS NULL");
    $stm->execute(array($id_tratamiento));
    foreach ($stm as $stm) {
      return json_encode($stm);
  }

  }

  public function actualizarTratamiento($id_tratamiento, $nombre_tratamiento, $costo_tratamiento, $descripcion_tratamiento)
  {
    // code...
    $stm = $this->conn->prepare("UPDATE tratamiento SET nombre=?, costo=?,  descripcion=? WHERE id_tratamiento=?");
    $stm ->execute(array($nombre_tratamiento, $costo_tratamiento, $descripcion_tratamiento, $id_tratamiento));
    $stm->fetch(PDO::FETCH_OBJ);
    if (!$stm) {
      return json_encode(array('success' => '0'));
    }else{
      return json_encode(array('success' => '1'));
    }
  }

}


 ?>
