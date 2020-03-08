<?php

/**
 *
 */
class Dientes
{
  private $conn;
  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }


  public function listarDientes()
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM diente WHERE deleted IS NULL");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date("Y-m-d", strtotime($result['created_at'])),
          '2' => $result['nombre'],
          '3' => '<i class="fa fa-life-ring" style="font-size: 25px; color: #354a77"></i>'.'<label for style="font-size: 24px; color: #354a77">'.'-'.$result['numero'].'</label>',
          '4' => '<center>
                      <button type="button" name="button" class="btn btn-sm btn-success" onclick="verDataDiente('.$result['id_diente'].')"><i class="fa fa-pencil"></i></button>
                      <button type="button" name="button" class="btn btn-sm btn-danger" onclick="eliminarDiente('.$result['id_diente'].')"><i class="fa fa-trash"></i></button>
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

  public function listarDientesEliminados()
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM diente WHERE deleted is not null");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date("Y-m-d", strtotime($result['created_at'])),
          '2' => $result['nombre'],
          '3' => '<i class="fa fa-life-ring" style="font-size: 25px; color: #354a77"></i>'.'<label for style="font-size: 24px; color: #354a77">'.'-'.$result['numero'].'</label>',
          '4' => '<center>
                      <button type="button" name="button" class="btn btn-sm btn-info" onclick="recuperarDiente('.$result['id_diente'].')"><i class="fa fa-cog"></i></button>
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

  /*public function guardarDiente($nombre_diente, $numero_diente)
  {
    // code...
    $fecha_update = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("INSERT INTO diente(updated_at, nombre, numero) VALUES (?, ?, ? )");
    $stm->execute(array($fecha_update, $nombre_diente, $numero_diente));
    $stm->fetch(PDO::FETCH_OBJ);
      if(!$stm){
        return json_encode(array('success' => '0'));
      }else {
        return json_encode(array('success' => '1'));
      }
  }*/


  public function verDataDiente($id_diente)
  {

    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente=? AND deleted IS NULL");
    $stm->execute(array($id_diente));
    foreach ($stm as $stm) {
      return json_encode($stm);
  }

  }

  public function actualizarDiente($id_diente, $nombre_diente, $numero_diente)
  {
    // code...
    $stm = $this->conn->prepare("UPDATE diente SET nombre=?, numero=? WHERE id_diente=?");
    $stm ->execute(array($nombre_diente, $numero_diente, $id_diente));
    $stm->fetch(PDO::FETCH_OBJ);
    if (!$stm) {
      return json_encode(array('success' => '0'));
    }else{
      return json_encode(array('success' => '1'));
    }
  }


  public function eliminarDiente( $id_diente)
  {
    // code...
    $fecha_delete = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("UPDATE diente SET deleted=? WHERE id_diente=?");
    $stm->execute(array($fecha_delete,  $id_diente));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
      return json_encode(array('success' => '0'));
    }else{
      return json_encode(array('success' => '1'));
    }
  }


  public function recuperarDiente($id_diente)
  {
    // code...

    $stm = $this->conn->prepare("UPDATE diente SET deleted=? WHERE id_diente=?");
    $stm->execute(array(null,  $id_diente));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
      return json_encode(array('success' => '0'));
    }else{
      return json_encode(array('success' => '1'));
    }
  }


}


 ?>
