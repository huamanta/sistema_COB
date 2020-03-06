<?php
/**
 *
 */
class RolesPermisos
{
  private $conn;
  function __construct()
  {
    require_once 'connection.php';
    $db = new DbConnect();
    $this->conn = $db->connect();
  }

  public function listarRoles()
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM rol WHERE deleted_at IS NULL");
      $stm->execute();
      $data = Array();
      $count = 1;
      foreach ($stm as $result) {
        $data[] = array(
          '0' => $count++,
          '1' => date("Y-m-d", strtotime($result['created_at'])),
          '2' => $result['nombre'],
          '3' => $result['abreviacion'],
          '4' => ($result['estado']) ? '<span class="badge badge-primary badge-pill">Activo</span>' : '<span class="badge badge-primary badge-pill">Inactivo</span>',
          '5' => '<center>
                      <button type="button" name="button" class="btn btn-sm btn-info" onclick="agregarPermisoRol('.$result['id_rol'].')"><i class="fa fa-cog"></i></button>
                      <button type="button" name="button" class="btn btn-sm btn-success" onclick="editarRol('.$result['id_rol'].')"><i class="fa fa-pencil"></i></button>
                      <button type="button" name="button" class="btn btn-sm btn-danger" onclick="eliminarRol('.$result['id_rol'].')"><i class="fa fa-trash"></i></button>
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

  public function listarDataRol($id_rol)
  {
    try {
      $stm = $this->conn->prepare("SELECT * FROM rol WHERE id_rol = ? AND deleted_at IS NULL");
      $stm->execute(array($id_rol));
      $data = Array();
      foreach ($stm as $result) {
        $data[] = array(
          'id_rol' => $result['id_rol'],
          'nombre' => $result['nombre'],
          'abreviacion' => $result['abreviacion'],
        );
      }
      return json_encode($data);
    } catch (\Exception $e) {
      die($e->getMessage());
    }

  }

  public function listarRutasAll($id_rol)
  {
    try {
      $stm = $this->conn->prepare("SELECT id_ruta, nombre FROM ruta WHERE nivel = ? AND deleted_at IS NULL");
      $stm->execute(array('1'));
      $data = Array();
      foreach ($stm as $result) {
        $stm1 = $this->conn->prepare("SELECT id_ruta, nombre FROM ruta WHERE nivel = ? AND id_parent = ? AND deleted_at IS NULL");
        $stm1->execute(array('2', $result['id_ruta']));
        $data1 = Array();
        foreach ($stm1 as $result1) {
          $data1[] = array(
            'nombre' => $result1['nombre'],
            'action' => $this->validarExistenciaPermiso($result1['id_ruta'], $id_rol),
          );
        }
        $data[] = array(
          'nombre' => $result['nombre'],
          'action' => $this->validarExistenciaPermiso($result['id_ruta'], $id_rol),
          'children' => $data1,
        );
      }

      return json_encode($data);
    } catch (\Exception $e) {
      die($e->getMessage());
    }

  }

  public function validarExistenciaPermiso($id_ruta, $id_rol)
  {
    $stm = $this->conn->prepare("SELECT * FROM permiso WHERE id_ruta = ?");
    $stm->execute(array($id_ruta));
    $result = $stm->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return 'checked onclick="eliminarExistencia('.$id_ruta.', '.$id_rol.')"';
    }else {
      return 'onclick="agregarExistencia('.$id_ruta.', '.$id_rol.')"';
    }
  }

  public function listarRutasRol($id_rol)
  {
    try {
      $stm = $this->conn->prepare("SELECT r.id_ruta, r.nombre FROM ruta r, permiso p WHERE p.id_ruta = r.id_ruta AND r.nivel = ? AND p.id_rol = ? AND r.deleted_at IS NULL");
      $stm->execute(array('1', $id_rol));
      $data = Array();
      foreach ($stm as $result) {
        $stm1 = $this->conn->prepare("SELECT r.id_ruta, r.nombre FROM ruta r, permiso p WHERE p.id_ruta = r.id_ruta AND r.nivel = ? AND p.id_rol = ? AND r.id_parent = ? AND r.deleted_at IS NULL");
        $stm1->execute(array('2', $id_rol, $result['id_ruta']));
        $data1 = Array();
        foreach ($stm1 as $result1) {
          $data1[] = array(
            'nombre' => $result1['nombre'],
          );
        }
        $data[] = array(
          'nombre' => $result['nombre'],
          'children' => $data1,
        );
      }

      return json_encode($data);
    } catch (\Exception $e) {
      die($e->getMessage());
    }
  }

}

?>
