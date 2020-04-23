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

	case 'add_imagen_prefil':
		if(!empty($_FILES["file-1"]["type"])){
				$foto_perfil = '';
				$fileName = time().'_'.$_FILES['file-1']['name'];
				$valid_extensions = array("jpeg", "jpg", "png");
				$temporary = explode(".", $_FILES["file-1"]["name"]);
				$file_extension = end($temporary);
				if((($_FILES["file-1"]["type"] == "image/png") || ($_FILES["file-1"]["type"] == "image/jpg") || ($_FILES["file-1"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
						$sourcePath = $_FILES['file-1']['tmp_name'];
						$targetPath = "../vistas/img/profile/".$fileName;
						if(move_uploaded_file($sourcePath,$targetPath)){
								$foto_perfil = $fileName;
								echo $perfil -> guardarFooto($foto_perfil);
							}
				}
			}
		break;

	default:
		# code...
		break;
}
?>
