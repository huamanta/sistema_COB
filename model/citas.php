<?php
$action = $_GET['action'];
require_once '../controller/citas.php';

$citas = new Citas();

switch ($action) {
	case 'listar_citas_calendar':
		echo $citas->listarCitasCalendar();
		break;

	case 'guardar_cita':
		$id_paciente = $_POST['id_paciente'];
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$date_start= ($_POST['date_start']) ? $_POST['date_start'] : NULL;
		$hour_start = ($_POST['hour_start']) ? $_POST['hour_start'] : NULL;
		$date_end = ($_POST['date_end']) ? $_POST['date_end'] : NULL;
		$hour_end = ($_POST['hour_end']) ? $_POST['hour_end'] : NULL;
		$color = $_POST['color'];
		if (!isset($_POST['id_cita'])) {
			echo $citas->guardarCita($id_paciente, $nombre, $descripcion, $date_start, $hour_start, $date_end, $hour_end, $color);
		}else{
			$id_cita = $_POST['id_cita'];
			echo $citas->actualizarCita($id_paciente, $id_cita, $nombre, $descripcion, $date_start, $hour_start, $date_end, $hour_end, $color);
		}

		break;

	case 'listar_cita_data':
		$id_cita = $_POST['id_cita'];
		echo $citas->listarCitaData($id_cita);
		break;

	case 'listar_citas_tabla':
		echo $citas->listarCitasTabla();
		break;

	case 'eliminar_cita':
		$id_cita = $_POST['id_cita'];
		echo $citas->eliminarCita($id_cita);
		break;

	case 'search_data_paciente':
		$data = $_POST['query'];
		echo $citas->searchDataPaciente($data);
		break;

	default:
		# code...
		break;
}
?>
