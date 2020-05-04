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
         FROM historia_clinica h, paciente pa, persona p
          WHERE h.id_paciente = pa.id_paciente AND pa.id_persona=p.id_persona AND h.deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date('d-m-Y', strtotime($result['created_at'])),
          '2' => $result['primer_nombre'].' '.$result['segundo_nombre'].' '.$result['primer_apellido'].' '.$result['segundo_apellido'],
          '3' => $result['diagnostico'],
          '4' => ($result['estado']) ? '<span class="badge badge-success badge-pill" style="background: green">Activo</span>' : '<span class="badge badge-primary badge-pill" style="background: red">Inactivo</span>',
          '5' => '<button class="btn btn-success" onclick="verdetalle('.$result['id_historia_clinica'].')"><i class="fa fa-eye"></i></button><button style="margin-left: 5px" class="btn btn-danger"><i class="fa fa-trash"></i></button>',
          );
      }
      $results = array(
              "sEcho"=>1, //Información para el datatables
              "iTotalRecords"=>count($data), //enviamos el total registros al datatable
              "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
              "aaData"=>$data
              );
              return json_encode($results);
    } catch (\Exception $e) {
      die($e->getMessage());
    }
  }

  public function getDataPaciente($id_historia_clinica)
  {
    try {
       $stm = $this->conn->prepare("SELECT  hc.id_historia_clinica, hc.created_at, pe.primer_apellido, pe.segundo_apellido, pe.primer_nombre, pe.segundo_nombre, pe.fecha_nacimiento, pe.id_genero, pe.id_estado_civil, pe.ubigeo, pe.ocupacion, pe.telefono, pe.direccion, pe.email, pa.nombre_apoderado, pa.telefono_apoderado, hc.diagnostico, hc.observaciones FROM historia_clinica hc, paciente pa, persona pe WHERE hc.id_paciente = pa.id_paciente AND pa.id_persona = pe.id_persona AND hc.id_historia_clinica = ?");
      $stm->execute(array($id_historia_clinica));
      $data = Array();
      foreach ($stm as $result) {
        $data[] = array(
                'id_historia_clinica' => $result['id_historia_clinica'],
                'created_at' => date("Y-m-d", strtotime($result['created_at'])),
                'nombre' => $result['primer_apellido'].' '.$result['segundo_apellido'].' '.$result['primer_nombre'].' '.$result['segundo_nombre'],
                'fecha_nacimiento' => $result['fecha_nacimiento'],
                'id_genero'=>$result['id_genero'],
                'id_estado_civil'=>$result['id_estado_civil'],
                'ubigeo'=>$result['ubigeo'],
                'ocupacion'=>$result['ocupacion'],
                'telefono'=>$result['telefono'],
                'direccion'=>$result['direccion'],
                'email'=>$result['email'],
                'nombre_apoderado'=>$result['nombre_apoderado'],
                'telefono_apoderado'=>$result['telefono_apoderado'],
                'diagnostico'=>$result['diagnostico'],
                'observaciones'=>$result['observaciones'],
                );
      }
      return json_encode($data);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function getAntecedentesPaciente($id_historia_clinica)
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM ant_patologico WHERE deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      foreach ($stm as $result) {
        $data[] = array(
        'id_ant_patologico' => $result['id_ant_patologico'],
        'nombre' => $result['nombre'],
        'action' =>$this->validarActionAntecedente($id_historia_clinica, $result['id_ant_patologico']),
      );
      }
      return json_encode($data);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function validarActionAntecedente($id_historia_clinica, $id_ant_patologico)
  {
    $stm = $this->conn->prepare("SELECT * FROM historia_clinica hc, detalle_historia dh, ant_patologico ap WHERE hc.id_historia_clinica = dh.id_historia_clinica AND dh.id_ant_patologico = ap.id_ant_patologico AND hc.id_historia_clinica = ? AND ap.id_ant_patologico = ?");
    $stm->execute(array($id_historia_clinica, $id_ant_patologico));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return '<img src="img/cuadro2.png" alt="" width="25"/>';
    }else {
      return '<img src="img/cuadro.png" alt="" width="25"/>';
    }
  }

  public function listarDientesBloque1($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 1 AND 8 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque2($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 9 AND 13 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque3($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 14 AND 21 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque4($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 22 AND 26 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque5($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 27 AND 31 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque6($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 32 AND 39 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque7($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 40 AND 44 AND deleted IS NULL LIMIT 5");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function listarDientesBloque8($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM diente WHERE id_diente BETWEEN 45 AND 52 AND deleted IS NULL LIMIT 8");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_diente' => $result['id_diente'],
        'numero' => $result['numero'],
        'action' => $this->validarActionOdontograma($id_historia_clinica, $result['id_diente']),
      );
    }
    return json_encode($data);
  }

  public function validarActionOdontograma($id_historia_clinica, $id_diente)
  {
    $stm = $this->conn->prepare("SELECT * FROM historia_clinica hc, detalle_historia dh, diente di WHERE hc.id_historia_clinica = dh.id_historia_clinica AND dh.id_diente = di.id_diente AND hc.id_historia_clinica = ? AND di.id_diente = ?");
    $stm->execute(array($id_historia_clinica, $id_diente));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return '<img src="img/muela - copia.png" alt="" onclick="eliminarDienteHistoria('.$id_diente.')" style="width: 80%">';
    }else {
      return '<img src="img/muela.png" alt=""  onclick="agregarDienteHistoria('.$id_diente.')" style="width: 80%">';
    }
  }

  public function listarTratamientoPaciente($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM tratamiento WHERE deleted_at IS NULL");
    $stm->execute();
    $data = Array();
    foreach ($stm as $result) {
      $data[] = array(
        'id_tratamiento' => $result['id_tratamiento'],
        'nombre' => $result['nombre'],
        'precio' => $this->validarCosto($result['id_tratamiento'], $result['costo'], $id_historia_clinica),
        'cantidad' => $this->validarCantidad($result['id_tratamiento'], $id_historia_clinica),
        'total' => $this->validarTotal($result['id_tratamiento'], $id_historia_clinica),
        'total_servicio' => $this->validarTotalTratamiento($id_historia_clinica),
      );
    }
    return json_encode($data);
  }

  public function validarTotalTratamiento($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT SUM(total) as total_servicio FROM detalle_historia WHERE id_historia_clinica = ?");
    $stm->execute(array($id_historia_clinica));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->total_servicio;
    }else {
      return '';
    }
  }

  public function validarCosto($id_tratamiento, $costo, $id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_tratamiento = ? AND id_historia_clinica = ?");
    $stm->execute(array($id_tratamiento, $id_historia_clinica));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->precio;
    }else {
      return $costo;
    }
  }

  public function validarCantidad($id_tratamiento, $id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_tratamiento = ? AND id_historia_clinica = ?");
    $stm->execute(array($id_tratamiento, $id_historia_clinica));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->cantidad;
    }else {
      return '';
    }
  }

  public function validarTotal($id_tratamiento, $id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM detalle_historia WHERE id_tratamiento = ? AND id_historia_clinica = ?");
    $stm->execute(array($id_tratamiento, $id_historia_clinica));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result->total;
    }else {
      return '';
    }
  }

  public function listarPagoTratamiento($id_historia_clinica)
  {
    $stm = $this->conn->prepare("SELECT * FROM pago WHERE id_historia_clinica = ?");
    $stm->execute(array($id_historia_clinica));
    $data = '';
    foreach ($stm as $result) {
      $data .= '<tr  style="border: hidden">
      <td>
        <div class="dropdown">
          <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid"  class="form-control" data-toggle="dropdown" id="eliminar_registro_'.$result['id_tratamiento'].'" aria-haspopup="true" aria-expanded="false" value="'.$this->obtenerNombreTratamiento($result['id_tratamiento']).'">
          <div class="dropdown-menu hidden" aria-labelledby="search_tratamient">
          </div>
        </div>
      </td>
      <td>
        <input type="date" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" id="fecha_registro'.$result['id_tratamiento'].'" value="'.date('Y-m-d', strtotime($result['fecha_pago'])).'">
      </td>
      <td>
        <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control"  id="cuenta_add'.$result['id_tratamiento'].'" value="'.$result['a_cuenta'].'">
      </td>
      <td>
        <input type="text" style="border-left: 1px #5d6e92 solid; border-bottom: 1px #5d6e92 solid" class="form-control" name="" value="'.$result['saldo'].'">
      </td>
    </tr><br/>';
    }
    return $data;
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

}


 ?>
