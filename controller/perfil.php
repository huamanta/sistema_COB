<?php
	/**
	*
	*/
	session_start();
	class Perfil
	{
		private $conn;
    private $id_usuario;
    private $fecha_delete;
    private $fecha_update;

    function __construct()
    {
      require_once 'connection.php';
        $db = new DbConnect();
        $this->conn = $db->connect();
        $this->id_usuario = $_SESSION['id_usuario'];
        $this->fecha_delete =  date('Y-m-d H:i:s');
        $this->fecha_update =  date('Y-m-d H:i:s');
    }

		public function listarDataLogin()
		{
			$stm = $this->conn->prepare("SELECT p.primer_nombre, p.primer_apellido, fp.nombre FROM persona p, usuario u, rol r, foto_perfil fp WHERE u.id_persona = p.id_persona AND r.id_rol = u.id_rol AND u.id_usuario = fp.id_usuario AND u.id_usuario = ? AND u.deleted_at IS NULL");
    		$stm->execute(array($this->id_usuario));
    		$data = Array();
    		foreach ($stm as $result) {
      			$data[] = array(
        		'nombre' => $result['primer_nombre'].' '.$result['primer_apellido'],
      			);
    		}
    		return json_encode($data);
		}

    public function mostartFotoUser()
    {
      $stm = $this->conn->prepare("SELECT p.primer_nombre, p.primer_apellido, fp.nombre FROM persona p, usuario u, rol r, foto_perfil fp WHERE u.id_persona = p.id_persona AND r.id_rol = u.id_rol AND u.id_usuario = fp.id_usuario AND u.id_usuario = ? AND fp.estado = 1 AND fp.tipo_foto = 1 AND fp.deleted_at IS NULL AND u.deleted_at IS NULL");
        $stm->execute(array($this->id_usuario));
        $data = Array();
        foreach ($stm as $result) {
            $data[] = array(
            'foto_perfil' => $result['nombre'],
            );
        }
        return json_encode($data);
    }

		public function listarDataUser()
		{
			$stm = $this->conn->prepare("SELECT * FROM persona p, usuario u, rol r WHERE u.id_persona = p.id_persona AND r.id_rol = u.id_rol AND u.id_usuario = ? AND u.deleted_at IS NULL");
    		$stm->execute(array($this->id_usuario));
    		$data = Array();
    		foreach ($stm as $result) {
      			$data[] = array(
        		'nombre' => $result['primer_nombre'].' '.$result['segundo_nombre'].' '.$result['primer_apellido'].' '.$result['segundo_apellido'],
        		'rol' => $result['nombre'],
      			);
    		}
    		return json_encode($data);
		}

		public function fotoPerfilUser()
		{
			$stm = $this->conn->prepare("SELECT * FROM usuario u, foto_perfil fp WHERE  u.id_usuario = fp.id_usuario AND u.id_usuario = ? AND fp.tipo_foto = ? AND fp.estado = ? AND fp.deleted_at IS NULL");
    		$stm->execute(array($this->id_usuario, '1', '1'));
    		$data = Array();
    		foreach ($stm as $result) {
      			$data[] = array(
      				'id_foto_perfil' => $result['id_foto_perfil'],
      				'nombre' => $result['nombre'],
      				'estado' => $result['estado'],
      				);
    		}
    		return json_encode($data);
		}

    public function listDataFotoPerfil($id_foto_perfil)
    {
      $stm = $this->conn->prepare("SELECT * FROM foto_perfil WHERE id_foto_perfil = ? AND tipo_foto = ? AND estado = ?  AND deleted_at IS NULL");
      $stm->execute(array($id_foto_perfil, '1', '1'));
      $data = Array();
      foreach ($stm as $result) {
          $data[] = array(
            'id_foto_perfil' => $result['id_foto_perfil'],
            'nombre' => $result['nombre'],
            'estado' => $result['estado'],
          );
      }
      return json_encode($data);
    }

    public function eliminarFotoUsuario($id_foto_perfil)
    {
      $stm = $this->conn->prepare("UPDATE foto_perfil SET deleted_at = ?, estado = ? WHERE id_foto_perfil = ?");
      $stm->execute(array($this->fecha_delete, '0', $id_foto_perfil));
      $stm->fetch(PDO::FETCH_OBJ);
      if (!$stm) {
        return json_encode(array('success' => '0'));
      }else{
        return json_encode(array('success' => '1'));
      }
    }

		public function guardarFoto($foto_perfil, $id_foto)
		{
			$stm = $this->conn->prepare("INSERT INTO foto_perfil (nombre, tipo_foto, estado, id_usuario) VALUES (?, ?, ?, ?)");
      $stm->execute(array($foto_perfil, '1', '1', $this->id_usuario));
      $stm->fetch(PDO::FETCH_OBJ);
      if ($stm) {
				$stm1 = $this->conn->prepare("UPDATE foto_perfil SET deleted_at = ?, estado = ? WHERE id_foto_perfil = ?");
	      $stm1->execute(array($this->fecha_delete, '0', $id_foto));
	      $stm1->fetch(PDO::FETCH_OBJ);
	      if (!$stm1) {
	        return json_encode(array('success' => '0'));
	      }else{
	        return json_encode(array('success' => '1'));
	      }
      }else{
        return json_encode(array('success' => '0'));
      }
		}
	}
 ?>
