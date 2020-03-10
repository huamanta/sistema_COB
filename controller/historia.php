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
        'action' =>$this->validarActionAntecedente($result['id_ant_patologico']),
      );
    }
    return json_encode($data);
  }

  public function validarActionAntecedente($id_ant_patologico)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_ant_patologico = ?");
    $stm->execute(array($id_ant_patologico));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return '<img src="img/cuadro2.png" alt="" width="25" onclick="eliminarAntecedenteHistoria('.$result->id_detalle_historia.')">';
    }else {
      return '<img src="img/cuadro.png" alt="" width="25" onclick="agregarAntecedenteHistoria('.$id_ant_patologico.')"/>';
    }
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
        'precio' => $this->validarCosto($result['id_tratamiento'], $result['costo']),
        'cantidad' => $this->validarCantidad($result['id_tratamiento']),
        'total' => $this->validarTotal($result['id_tratamiento']),
        'total_servicio' => $this->validarTotalTratamiento(),
      );
    }
    return json_encode($data);
  }

  public function validarTotalTratamiento()
  {
    $stm = $this->conn->prepare("SELECT SUM(total) as total_servicio FROM detalle_historia WHERE id_historia_clinica = ?");
    $stm->execute(array('1'));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->total_servicio;
    }else {
      return '';
    }
  }

  public function validarCosto($id_tratamiento, $costo)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_tratamiento = ?");
    $stm->execute(array($id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->precio;
    }else {
      return $costo;
    }
  }

  public function validarCantidad($id_tratamiento)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_tratamiento = ?");
    $stm->execute(array($id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->cantidad;
    }else {
      return '';
    }
  }

  public function validarTotal($id_tratamiento)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_tratamiento = ?");
    $stm->execute(array($id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->total;
    }else {
      return '';
    }
  }

  public function buscarPaciente($nombre_paciente)
  {
    $stm = $this->conn->prepare("SELECT * FROM persona pe INNER JOIN paciente pa ON pe.id_persona = pa.id_paciente WHERE pe.primer_nombre = ? AND pa.deleted_at is null");
    $stm->execute(array($nombre_paciente));
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_persona' => $result['id_persona'],
        'primer_nombre' => $result['primer_nombre'],
        'segundo_nombre' => $result['segundo_nombre'],
        'primer_apellido' => $result['primer_apellido'],
        'segundo_apellido' => $result['segundo_apellido'],
        'fecha_nacimiento' => date('m/d/Y', strtotime($result['fecha_nacimiento'])),
        'edad' => $this->calculateAgePatient($result['fecha_nacimiento']),
        'id_genero' => $result['id_genero'],
        'id_estado_civil' => $result['id_estado_civil'],
        'ocupacion' => $result['ocupacion'],
        'ubigeo' => $result['ubigeo'],
        'telefono' => $result['telefono'],
        'direccion' => $result['direccion'],
        'email' => $result['email'],
        'nombre_apoderado' => $result['nombre_apoderado'],
        'telefono_apoderado' => $result['telefono_apoderado'],
      );
    }
    return json_encode($data);
  }

  public function calculateAgePatient($fecha_nacimiento)
  {
    list($Y,$m,$d) = explode("-",$fecha_nacimiento);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
  }

    public function validarActionOdontograma($id_diente)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_diente = ?");
    $stm->execute(array($id_diente));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return '<img src="img/muela - copia.png" alt="" onclick="eliminarDienteHistoria('.$result->id_detalle_historia.')" style="width: 80%">';
    }else {
      return '<img src="img/muela.png" alt=""  onclick="agregarDienteHistoria('.$id_diente.')" style="width: 80%">';
    }
  }

  public function listarDientesBloque1()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 1 AND 8 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque2()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 9 AND 13 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque3()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 14 AND 21 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque4()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 22 AND 26 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque5()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 27 AND 31 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque6()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 32 AND 39 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque7()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 40 AND 44 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque8()
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 45 AND 52 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function agregarDienteHistoria($id_diente)
  {
    $stm = $this->conn->prepare("INSERT INTO detalle_historia (id_historia_clinica, id_diente) VALUES (?, ?)");
    $stm->execute(array('1', $id_diente));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function eliminarDienteHistoria($id_detalle_historia)
  {
    $stm = $this->conn->prepare("DELETE FROM detalle_historia WHERE id_detalle_historia =? AND id_historia_clinica = ?");
    $stm->execute(array($id_detalle_historia, '1'));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function agregarAntecedenteHistoria($id_ant_patologico)
  {
    $stm = $this->conn->prepare("INSERT INTO detalle_historia (id_historia_clinica, id_ant_patologico) VALUES (?, ?)");
    $stm->execute(array('1', $id_ant_patologico));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function eliminarAntecedenteHistoria($id_detalle_historia)
  {
    $stm = $this->conn->prepare("DELETE FROM detalle_historia WHERE id_detalle_historia =? AND id_historia_clinica = ?");
    $stm->execute(array($id_detalle_historia, '1'));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function agregarTratamientoHistoria($id_tratamiento, $precio, $cantidad, $total)
  {
    $response = $this->validarExistenciaTratamientoHistoria($id_tratamiento);
    if(!$response){
      $stm = $this->conn->prepare("INSERT INTO detalle_historia (id_historia_clinica, id_tratamiento, cantidad, precio, total) VALUES (?, ?, ?, ?, ?)");
      $stm->execute(array('1', $id_tratamiento, $cantidad, $precio, $total));
      $result = $stm->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return json_encode(array('success' => 1));
      }else {
        return json_encode(array('success' => 0));
      }
    }else {
      $stm = $this->conn->prepare("UPDATE detalle_historia SET cantidad = ?, precio = ?, total = ? WHERE id_historia_clinica = ? AND id_tratamiento = ?");
      $stm->execute(array($cantidad, $precio, $total, '1', $id_tratamiento));
      $result = $stm->fetch(PDO::FETCH_OBJ);
      if ($result) {
        return json_encode(array('success' => 1));
      }else {
        return json_encode(array('success' => 0));
      }
    }
  }

  public function validarExistenciaTratamientoHistoria($id_tratamiento)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_tratamiento = ?");
    $stm->execute(array($id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    return $result;
  }

  public function eliminarTratamientoHistoria($id_tratamiento)
  {
    $stm = $this->conn->prepare("DELETE FROM detalle_historia WHERE id_tratamiento =? AND id_historia_clinica = ?");
    $stm->execute(array($id_tratamiento, '1'));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

}

 ?>
