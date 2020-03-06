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
  default:
    // code...
    break;
}
?>
