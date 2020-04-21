<?php 
$action = $_GET['action'];
require_once '../controller/perfil.php';

$perfil = new Perfil();

switch ($action) {
	case 'listar_data_login':
		echo $perfil->listarDataLogin();
		break;

	case 'mostrar_foto_user':
		echo $perfil->mostartFotoUser();
		break;

	case 'listar_data_user':
		echo $perfil->listarDataUser();
		break;

	case 'foto_perfil_user':
		echo $perfil->fotoPerfilUser();
		break;

	case 'list_data_foto_perfil':
		$id_foto_perfil = $_POST['id_foto_perfil'];
		echo $perfil->listDataFotoPerfil($id_foto_perfil);
		break;

	case 'eliminar_foto_usuario':
		$id_foto_perfil = $_POST['id_foto_perfil'];
		echo $perfil->eliminarFotoUsuario($id_foto_perfil);
		break;
	
	default:
		# code...
		break;
}
?>