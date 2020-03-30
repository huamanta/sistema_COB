<?php

/**
 *
 */
class Historias
{
  private $conn;
  function __construct()
  {
    // code...
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

  public function listarHistorias()
  {
    try {
      $stm = $this->conn->prepare("SELECT h.id_historia_clinica, h.id_paciente, h.created_at, h.diagnostico, h.estado, pa.id_paciente, p.id_persona, p.primer_nombre, p.segundo_nombre, p.primer_apellido, p.segundo_apellido
         FROM historia_clinica AS h, paciente AS pa, persona AS p
          WHERE h.id_paciente = h.id_paciente AND pa.id_paciente=p.id_persona AND h.deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date('d-m-Y', strtotime($result['created_at'])),
          '2' => $result['primer_nombre'].' '.$result['segundo_nombre'].' '.$result['primer_apellido'].' '.$result['segundo_apellido'],
          '3' => $result['diagnostico'],
          '4' => ($result['estado']) ? '<span class="badge badge-primary badge-pill">Activo</span>' : '<span class="badge badge-primary badge-pill">Inactivo</span>',
          '5' => '<button class="btn btn-danger" onclick="verdetalle()"><i class="fa fa-eye"></i></button>',
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
