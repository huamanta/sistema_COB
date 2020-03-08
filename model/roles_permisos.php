<?php
$action = $_GET['action'];
require_once '../controller/roles_permisos.php';
$roles_permisos = new RolesPermisos();
switch ($action) {
  case 'listar_roles':
    echo $roles_permisos->listarRoles();
    break;

  case 'listar_data_rol':
    $id_rol = $_POST['id_rol'];
    echo $roles_permisos->listarDataRol($id_rol);
    break;

  case 'listar_rutas_all':
    $id_rol = $_POST['id_rol'];
    echo $roles_permisos->listarRutasAll($id_rol);
    break;

  case 'listar_rutas_rol':
    $id_rol = $_POST['id_rol'];
    echo $roles_permisos->listarRutasRol($id_rol);
    break;

  case 'agregar_rol':
    $nombre_rol = $_POST['nombre_rol'];
    $abreviacion_rol = $_POST['abreviacion_rol'];
    if (!isset($_POST['id_rol'])) {
      echo $roles_permisos->guardarNuevoRol($nombre_rol, $abreviacion_rol);
    }else {
      $id_rol = $_POST['id_rol'];
      echo $roles_permisos->actualizarRol($nombre_rol, $abreviacion_rol, $id_rol);
    }
    break;

  case 'eliminar_rol':
    $id_rol = $_POST['id_rol'];
    echo $roles_permisos->eliminarRol($id_rol);
    break;

  case 'agregar_existencia_rol':
    $id_rol = $_POST['id_rol'];
    $id_ruta = $_POST['id_ruta'];
    echo $roles_permisos->agregarExistencia($id_rol, $id_ruta);
    break;

  case 'eliminar_existencia_rol':
    $id_rol = $_POST['id_rol'];
    $id_ruta = $_POST['id_ruta'];
    echo $roles_permisos->eliminarExistencia($id_rol, $id_ruta);
    break;

  default:
    // code...
    break;
}
?>
