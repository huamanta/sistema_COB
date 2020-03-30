<?php
/**
 *
 */
session_start();
class SeguridadApp
{
  private $conn;
  private $rol;
  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
    $this->rol = '1';
  }

  public function sessionApp()
  {
    if (isset($_SESSION['username'])) {
      return true;
    }else {
      return false;
    }
  }

  public function premisosRolesPermisos()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '9'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
    }else {
     return false;
    }
  }

  public function premisosUsuarios()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '10'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosDientes()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '14'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosAntecedentes()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '13'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosTratamientos()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '15'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosCitas()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '11'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosListarPacientes()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '5'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosNuevoPacientes()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '6'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosNuevaHistoria()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '3'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }

  public function premisosRegistrosHistorias()
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_rol = ? AND id_ruta = ?");
    $stm->execute(array($this->rol, '16'));
    $r = $stm->fetch(PDO::FETCH_OBJ);
    if ($r) {
     return true;
   }else {
     return false;
   }
  }
}

?>
