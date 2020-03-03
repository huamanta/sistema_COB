<?php
/**
 *
 */
class Historia
{
  private $conn;
  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

  public function listarAntecedentesForSelected()
  {
    $stm = $this->conn->prepare("SELECT * FROM ant_patologico WHERE deleted_at IS NULL");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_ant_patologico' => $result['id_ant_patologico'],
        'nombre' => $result['nombre'],
      );
    }
    return json_encode($data);
  }

  public function listarTratamientoTable()
  {
    $stm = $this->conn->prepare("SELECT * FROM tratamiento WHERE deleted_at IS NULL");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_tratamiento' => $result['id_tratamiento'],
        'nombre' => $result['nombre'],
      );
    }
    return json_encode($data);
  }

  public function buscarPaciente($nombre_paciente)
  {
    $stm = $this->conn->prepare("SELECT * FROM persona WHERE primer_nombre = ? AND deleted_at IS NULL");
    $stm->execute(array($nombre_paciente));
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_persona' => $result['id_persona'],
        'primer_nombre' => $result['primer_nombre'],
        'fecha_nacimiento' => $result['fecha_nacimiento'],
        'edad' => $this->calculateAgePatient($result['fecha_nacimiento']),
        'id_genero' => $result['id_genero'],
        'id_estado_civil' => $result['id_estado_civil'],
        'ocupacion' => $result['ocupacion'],
        'ubigeo' => $result['ubigeo'],
        'telefono' => $result['telefono'],
        'direccion' => $result['direccion'],
        'email' => $result['email'],
      );
    }
    return json_encode($data);
  }

  public function calculateAgePatient($fecha_nacimiento)
  {
    list($Y,$m,$d) = explode("-",$fecha_nacimiento);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
  }
}

 ?>
