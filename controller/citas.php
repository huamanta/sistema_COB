<?php 
 /**
 * 
 */
 class Citas
 {

 	private $conn;

 	function __construct()
 	{
 		require_once 'connection.php';
    	$db = new DbConnect();
    	$this->conn = $db->connect();
 	}

 	public function listarCitasCalendar()
 	{
 		try {
 			$stm = $this->conn->prepare("SELECT * FROM cita WHERE deleted_at IS NULL");
      		$stm->execute();
      		$data = Array();
      		foreach ($stm as $result) {
        		$data[] = array(
                '_id' => $result['id_cita'],
          			'title' => $result['titulo'],
          			'start' => $this->validarHoraStart($result['date_start'], $result['hour_start']),
          			'end' => $this->validarHoraEnd($result['date_end'], $result['hour_end']),
          			'color' => $result['color'],
        		);
      		}
              
            return json_encode($data);

 		} catch (Exception $e) {
 			die($e->getMessage());
 		}
 	}

  public function listarCitasTabla()
  {
    try {
        $stm = $this->conn->prepare("SELECT * FROM cita WHERE deleted_at IS NULL");
        $stm->execute();
        $data = Array();
        $count = 1;
        foreach ($stm as $result) {
          $data[] = array(
              '0' => $count++,
              '1' => $result['titulo'],
              '2' => $result['descripcion'],
              '3' => $this->validarHoraStart($result['date_start'], $result['hour_start']),
              '4' => $this->validarHoraEnd($result['date_end'], $result['hour_end']),
              '5' => '<p style="background: '.$result['color'].'; color: white; padding: 5px">'.$result['color'].'</p>',
              '6' => '<a class="btn btn-info" onclick="verDataCita('.$result['id_cita'].')"><i class="fa fa-pencil"></i></a>
                      <button class="btn btn-danger" onclick="eliminarcita('.$result['id_cita'].')"><i class="fa fa-trash"></i></button>',
           );
        }
            
        $results = array(
              "sEcho"=>1, //Información para el datatables
              "iTotalRecords"=>count($data), //enviamos el total registros al datatable
              "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
              "aaData"=>$data);
              
        return json_encode($results);

    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function validarHoraStart($date_start, $hour_start)
  {
    if ($hour_start != null) {
      return $date_start.'T'.$hour_start;
    }else{
      return $date_start;
    }

  }

  public function validarHoraEnd($date_end, $hour_end)
  {
    if ($hour_end != null) {
      return $date_end.'T'.$hour_end;
    }else{
      return $date_end;
    }
  }

  public function listarCitaData($id_cita)
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM cita WHERE id_cita = ? AND deleted_at IS NULL");
          $stm->execute(array($id_cita));
          $data = Array();
          foreach ($stm as $result) {
            $data[] = array(
                'id' => $result['id_cita'],
                'title' => $result['titulo'],
                'descripcion' => $result['descripcion'],
                'date_start' => $result['date_start'],
                'hour_start' => $result['hour_start'],
                'date_end' => $result['date_end'],
                'hour_end' => $result['hour_end'],
                'color' => $result['color'],
            );
          }
          return json_encode($data);

    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function guardarCita($nombre, $descripcion, $date_start, $hour_start, $date_end, $hour_end, $color)
  {
    // code...
    $fecha_update = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("INSERT INTO cita(updated_at, titulo, descripcion, date_start, hour_start, date_end, hour_end, color) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stm->execute(array($fecha_update, $nombre, $descripcion, $date_start, $hour_start, $date_end, $hour_end, $color));
    $stm->fetch(PDO::FETCH_OBJ);
    if(!$stm){
      return json_encode(array('success' => '0'));
    }else {
      return json_encode(array('success' => '1'));
    }
  }

  public function actualizarCita($id_cita, $nombre, $descripcion, $date_start, $hour_start, $date_end, $hour_end, $color)
  {
    $fecha_update = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("UPDATE cita SET updated_at = ?, titulo = ?, descripcion = ?, date_start = ?, hour_start = ?, date_end = ?, hour_end = ?, color = ? WHERE id_cita = ?");
    $stm->execute(array($fecha_update, $nombre, $descripcion, $date_start, $hour_start, $date_end, $hour_end, $color, $id_cita));
    $stm->fetch(PDO::FETCH_OBJ);
    if(!$stm){
      return json_encode(array('success' => '0'));
    }else {
      return json_encode(array('success' => '1'));
    }
  }

  public function eliminarCita($id_cita)
  {
    $fecha_delete = date('Y-m-d H:i:s');
    $stm = $this->conn->prepare("UPDATE cita SET deleted_at = ? WHERE id_cita = ?");
    $stm->execute(array($fecha_delete, $id_cita));
    $stm->fetch(PDO::FETCH_OBJ);
    if(!$stm){
      return json_encode(array('success' => '0'));
    }else {
      return json_encode(array('success' => '1'));
    }
  }


  public function searchDataPaciente($data)
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM persona pe, paciente pa WHERE pe.id_persona = pa.id_persona AND pe.primer_nombre LIKE '%$data%' AND pa.deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      foreach ($stm as $result) {
        $data[] = $result['primer_nombre'].' '.$result['segundo_nombre'].' '.$result['primer_apellido'].' '.$result['segundo_apellido'];
      }
      return json_encode($data);

    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

 }
?>