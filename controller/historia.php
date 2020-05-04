<?php
/**
 *
 */
session_start();
class Historia
{
  private $conn;
  private $token;
  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
    $this->token = md5($_SESSION['username']);
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
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE id_ant_patologico = ? AND token = ?");
    $stm->execute(array($id_ant_patologico, $this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return '<img src="img/cuadro2.png" alt="" width="25" onclick="eliminarAntecedenteHistoria('.$id_ant_patologico.')">';
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
    $stm = $this->conn->prepare("SELECT SUM(total) as total_servicio FROM detalle_historia_temp WHERE token = ?");
    $stm->execute(array($this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->total_servicio;
    }else {
      return '';
    }
  }

  public function validarCosto($id_tratamiento, $costo)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE id_tratamiento = ? AND token = ?");
    $stm->execute(array($id_tratamiento, $this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->precio;
    }else {
      return $costo;
    }
  }

  public function validarCantidad($id_tratamiento)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE id_tratamiento = ? AND token = ?");
    $stm->execute(array($id_tratamiento, $this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->cantidad;
    }else {
      return '';
    }
  }

  public function validarTotal($id_tratamiento)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE id_tratamiento = ? AND token = ?");
    $stm->execute(array($id_tratamiento, $this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->total;
    }else {
      return '';
    }
  }

  public function buscarPaciente($nombre_paciente)
  {
    $stm = $this->conn->prepare("SELECT * FROM persona AS p, paciente AS pc WHERE p.id_persona = pc.id_persona AND p.numero_documento = ? AND pc.deleted_at IS NULL");
    $stm->execute(array($nombre_paciente));
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_persona' => $result['id_persona'],
        'id_paciente' => $result['id_paciente'],
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
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE id_diente = ? AND token = ?");
    $stm->execute(array($id_diente, $this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return '<img src="img/muela - copia.png" alt="" onclick="eliminarDienteHistoria('.$id_diente.')" style="width: 80%">';
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
    $stm = $this->conn->prepare("INSERT INTO detalle_historia_temp (token, id_diente) VALUES (?, ?)");
    $stm->execute(array($this->token, $id_diente));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function eliminarDienteHistoria($id_diente)
  {
    $stm = $this->conn->prepare("DELETE FROM detalle_historia_temp WHERE id_diente = ? AND token = ?");
    $stm->execute(array($id_diente, $this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function agregarAntecedenteHistoria($id_ant_patologico)
  {
    $stm = $this->conn->prepare("INSERT INTO detalle_historia_temp (token, id_ant_patologico) VALUES (?, ?)");
    $stm->execute(array($this->token, $id_ant_patologico));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function eliminarAntecedenteHistoria($id_ant_patologico)
  {
    $stm = $this->conn->prepare("DELETE FROM detalle_historia_temp WHERE token =? AND id_ant_patologico = ?");
    $stm->execute(array($this->token, $id_ant_patologico));
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
    if($response != 1){
      $stm = $this->conn->prepare("INSERT INTO detalle_historia_temp (token, id_tratamiento, cantidad, precio, total) VALUES (?, ?, ?, ?, ?)");
      $stm->execute(array($this->token, $id_tratamiento, $cantidad, $precio, $total));
      $result = $stm->fetch(PDO::FETCH_OBJ);
      if (!$result) {
        return json_encode(array('success' => 1));
      }else {
        return json_encode(array('success' => 0));
      }
    }else {
      $stm = $this->conn->prepare("UPDATE detalle_historia_temp SET cantidad = ?, precio = ?, total = ? WHERE token = ? AND id_tratamiento = ?");
      $stm->execute(array($cantidad, $precio, $total, $this->token, $id_tratamiento));
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
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE id_tratamiento = ? AND token = ?");
    $stm->execute(array($id_tratamiento, $this->token));
    $result = $stm->rowCount();
    if ($result > 0) {
     return 1;
    }else {
     return 0;
    }
  }

  public function eliminarTratamientoHistoria($id_tratamiento)
  {
    $stm = $this->conn->prepare("DELETE FROM detalle_historia_temp WHERE id_tratamiento =? AND token = ?");
    $stm->execute(array($id_tratamiento, $this->token));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function procesarHistoriaClinica($id_paciente, $diagnostico, $observaciones)
  {
    $id_usuario = $_SESSION['id_usuario'];
    $fecha_update = date('Y-m-d H:i:s');
    $temp_verify = $this->verificarTablaTemp();
    if ($temp_verify != false) {
      $stm = $this->conn->prepare("INSERT INTO historia_clinica (updated_at, diagnostico, observaciones, id_paciente, id_usuario) VALUES (?, ?, ?, ?, ?)");
      $stm->execute(array($fecha_update, $diagnostico, $observaciones, $id_paciente, $id_usuario));
      $result = $stm->fetch(PDO::FETCH_OBJ);
      $id_insert = $this->conn->lastInsertId();
      if (!$result) {
        $stm1 = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE token = ?");
        $stm1->execute(array($this->token));
        foreach ($stm1 as $stm1) {
          $stm2 = $this->conn->prepare("INSERT INTO detalle_historia (id_historia_clinica, id_tratamiento, id_diente, id_ant_patologico, cantidad, precio, total) VALUES (?, ?, ?, ?, ?, ? ,?)");
          $stm2->execute(array($id_insert, $stm1['id_tratamiento'], $stm1['id_diente'], $stm1['id_ant_patologico'], $stm1['cantidad'], $stm1['precio'], $stm1['total']));
        }
        $sql_select_pago = $this->conn->prepare("SELECT * FROM pago_temp WHERE token = ?");
        $sql_select_pago->execute(array($this->token));
        foreach ($sql_select_pago as $pago_temp) {
          $sql_insert_pago = $this->conn->prepare("INSERT INTO pago (fecha_pago, a_cuenta, saldo, id_historia_clinica, id_tratamiento) VALUES (?, ?, ?, ?, ?)");
          $sql_insert_pago->execute(array($pago_temp['fecha_pago'], $pago_temp['a_cuenta'], $pago_temp['saldo'], $id_insert, $pago_temp['id_tratamiento']));
        }
        $stm3 = $this->conn->prepare("DELETE FROM detalle_historia_temp WHERE token = ?");
        $stm3->execute(array($this->token));
        $delete_pago_temp = $this->conn->prepare("DELETE FROM pago_temp WHERE token = ?");
        $delete_pago_temp->execute(array($this->token));
        return json_encode(array('success' => 1));
      }else {
        return json_encode(array('success' => 0));
      }
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function eliminarHistoriaClinica()
  {
    $delete_detalle_historia_temp = $this->conn->prepare("DELETE FROM detalle_historia_temp WHERE token = ?");
    $delete_detalle_historia_temp->execute(array($this->token));
    $delete_pago_temp = $this->conn->prepare("DELETE FROM pago_temp WHERE token = ?");
    $delete_pago_temp->execute(array($this->token));
    if ($delete_pago_temp) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function verificarTablaTemp()
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp");
    $stm->execute(array());
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return true;
    }else {
      return false;
    }
  }

  public function listarPagoTratamiento()
  {
    $stm1 = $this->conn->prepare("SELECT * FROM pago_temp WHERE token = ?");
    $stm1->execute(array($this->token));
    $r = $stm1->fetch(PDO::FETCH_OBJ);
    if ($r) {
      $stm = $this->conn->prepare("SELECT * FROM pago_temp WHERE token = ?");
      $stm->execute(array($this->token));
      $data = '';
      foreach ($stm as $result) {
        $data .= '<tr  style="border: hidden">
        <td>
          <div class="dropdown">
            <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" data-toggle="dropdown" onkeyup="deletePagoTratamiento('.$result['id_tratamiento'].')" id="eliminar_registro_'.$result['id_tratamiento'].'" aria-haspopup="true" aria-expanded="false" value="'.$this->obtenerNombreTratamiento($result['id_tratamiento']).'">
            <div class="dropdown-menu hidden" aria-labelledby="search_tratamient">
            </div>
          </div>
        </td>
        <td>
          <input type="date" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" onchange="cambiarFechaRegistro('.$result['id_tratamiento'].')" id="fecha_registro'.$result['id_tratamiento'].'" value="'.date('Y-m-d', strtotime($result['fecha_pago'])).'">
        </td>
        <td>
          <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" onkeyup="updateCuenta('.$result['id_tratamiento'].')"  id="cuenta_add'.$result['id_tratamiento'].'" value="'.$result['a_cuenta'].'">
        </td>
        <td>
          <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="'.$result['saldo'].'">
        </td>
      </tr><br/>';
      }
      $data .= '<tr style="border: hidden">
      <td>
        <div class="dropdown">
          <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" onkeyup="searchTratamiento()" name="search_tratamiento" id="search_tratamiento" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="dropdown-menu hidden" id="data_list" aria-labelledby="search_tratamiento">
          </div>
        </div>
      </td>
      <td>
        <input type="date" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
      </td>
      <td>
        <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
      </td>
      <td>
        <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
      </td>
    </tr>';
      return $data;
    }else {
      return '<tr  style="border: hidden">
      <td>
        <div class="dropdown">
          <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" onkeyup="searchTratamiento()" name="search_tratamiento" id="search_tratamiento" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="dropdown-menu hidden" id="data_list" aria-labelledby="search_tratamiento">
          </div>
        </div>
      </td>
      <td>
        <input type="date" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
      </td>
      <td>
        <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
      </td>
      <td>
        <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="">
      </td>
    </tr>';
    }
  }

  public function obtenerNombreTratamiento($id_tratamiento)
  {
    $stm = $this->conn->prepare("SELECT * FROM tratamiento WHERE id_tratamiento = ? AND deleted_at IS NULL");
    $stm->execute(array($id_tratamiento));
    $data = Array();
    foreach ($stm as $result) {
      return $result['nombre'];
    }
  }

  public function searchTratamiento($data)
  {
    $stm = $this->conn->prepare("SELECT * FROM tratamiento WHERE nombre LIKE ? AND deleted_at IS NULL");
    $stm->execute(array('%'.$data.'%'));
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_tratamiento' => $result['id_tratamiento'],
        'nombre' => $result['nombre'],
      );
    }
    return json_encode($data);
  }

  public function addTratamientoPago($id_tratamiento)
  {
    $fecha_actual = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("INSERT INTO pago_temp (token, fecha_pago, a_cuenta, saldo, id_tratamiento) VALUES (?, ?, ?, ?, ?)");
    $stm->execute(array($this->token, $fecha_actual, '0', '0', $id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if (!$result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function updateCuenta($id_tratamiento, $data)
  {
    $cuenta = $this->obtenerCuentaTratamiento($id_tratamiento);
    if ($data>$cuenta) {
      return json_encode(array('success' => 0));
    }
    $saldo = $cuenta-$data;
    $stm = $this->conn->prepare("UPDATE pago_temp SET a_cuenta = ?, saldo = ? WHERE token = ? AND id_tratamiento = ?");
    $stm->execute(array($data, $saldo, $this->token, $id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if (!$result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function obtenerCuentaTratamiento($id_tratamiento)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia_temp WHERE id_tratamiento = ? AND token = ?");
    $stm->execute(array($id_tratamiento,  $this->token));
    foreach ($stm as $result) {
      return $result['total'];
    }
  }

  public function updateFechaRegistro($id_tratamiento, $fecha_registro)
  {
    $stm = $this->conn->prepare("UPDATE pago_temp SET fecha_pago = ? WHERE token = ? AND id_tratamiento = ?");
    $stm->execute(array($fecha_registro,  $this->token, $id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if (!$result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }

  public function deleteTrataiento($id_tratamiento)
  {
    $stm = $this->conn->prepare("DELETE FROM pago_temp WHERE token = ? AND id_tratamiento = ?");
    $stm->execute(array($this->token, $id_tratamiento));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if (!$result) {
      return json_encode(array('success' => 1));
    }else {
      return json_encode(array('success' => 0));
    }
  }
}

 ?>
