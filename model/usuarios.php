<?php
$action = $_GET['action'];
require_once '../controller/usuarios.php';
$usuarios = new Usuarios();
switch ($action) {
  case 'listar_usuarios':
    echo $usuarios->listarUsuarios();
    break;
  case 'guardar_usuario':
    $tipo_doc = $_POST['tipo_doc'];
    $numero_documento = $_POST['numero_documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $ocupacion = $_POST['ocupacion'];
    $ubigeo = $_POST['ubigeo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $estado_civil = $_POST['estado_civil'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    if (!isset($_POST['id_usuario']) && !isset($_POST['id_persona'])) {
      $id_rol = $_POST['id_rol'];
      $usuario = $_POST['usuario'];
      $password = md5($_POST['password_confirm']);
      echo $usuarios->guardarUsuario($tipo_doc, $numero_documento, $nombres, $apellidos, $ocupacion, $ubigeo, $fecha_nacimiento, $genero, $estado_civil, $email, $telefono, $direccion, $id_rol, $usuario, $password);
    }else {
      $id_usuario = $_POST['id_usuario'];
      $id_persona = $_POST['id_persona'];
      echo $usuarios->actualizarUsuario($id_persona, $id_usuario, $tipo_doc, $numero_documento, $nombres, $apellidos, $ocupacion, $ubigeo, $fecha_nacimiento, $genero, $estado_civil, $email, $telefono, $direccion);
    }
    break;

  case 'listar_data_usuario':
    $id_usuario = $_POST['id_usuario'];
    $id_persona = $_POST['id_persona'];
    echo $usuarios->listarDataUsuario($id_usuario, $id_persona);
    break;

  case 'listar_data_credenciales':
    $id_usuario = $_POST['id_usuario'];
    echo $usuarios->listarDataCredenciales($id_usuario);
    break;

  case 'actualizar_user_credenciales':
    $id_usuario = $_POST['id_user_edit'];
    $id_rol = $_POST['id_rol_edit'];
    $usuario = $_POST['usuario_edit'];
    $password = md5($_POST['password_edit']);
    if(empty($_POST['password_edit'])){
      echo $usuarios->actualizarUserCredenciales($id_usuario, $id_rol, $usuario);
    }else {
      echo $usuarios->actualizarUserCredencialesPassword($id_usuario, $id_rol, $usuario, $password);
    }
    break;

  case 'eliminar_usuario':
    $id_usuario = $_POST['id_usuario'];
    echo $usuarios->eliminarUsuario($id_usuario);
    break;

  default:
    // code...
    break;
}
?>
