<?php

class CitasBarberos extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(8);
	}

	public function CitasBarberos()
	{
		if (empty($_SESSION['permisos'][8]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Agenda del barbero";
		$data['page_title'] = "Agenda del barbero ";
		$data['page_name'] = "Agenda del barbero";
		$data['page_functions_js'] = "function_citasBarbero.js";
		$this->views->getView($this, "citasbarberos", $data);
	}



	public function getCitasBarbero($idempleado)
	{
		if ($_SESSION['permisosMod']['r']) {
			$intCitaBarbero = $idempleado;
			$arrData = $this->model->selectCitaBarbe($idempleado);
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfoBar(' . $arrData[$i]['idcita'] . ')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}
			
				$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setCitaBarberoM()
	{
		if ($_POST) {
		
			if (empty($_POST['idCita'])) {
				$arrResponse = array("status" => false, "msg" => "Datos incorrectos");
			} else {

				$intId = strClean($_POST['idCita']);
				$intEstado = intval(strClean($_POST['listEstadoE']));
				$intAsistencia = intval(strClean($_POST['listConfirmar']));
			
				//contrasena
				//hash() encripta la contraseña
			
				$request_user = $this->model->updateCitaBarbero(
					$intId ,
					$intEstado,
					$intAsistencia);

				if ($request_user > 0) {
					$arrResponse = array("status" => true, "msg" => "Datos guardasos correctamente. :D");
				} else if ($request_user == 0) {
					$arrResponse = array("status" => false, "msg" => "¡Atención! el email, teléfono o la identificación ya existe, ingrese otro.");
				} else {
					$arrResponse = array("status" => false, "msg" => "No es posible almacenar los datos. ");
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}


		die();
	}


	

	public function getSelectEstado()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectEstado();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['id_estado_cita'] . '">' . $arrData[$i]['estado'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}


	public function getSelectAsistencia()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectAsistencia();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idasistencia'] . '">' . $arrData[$i]['asistencia'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function getCitaBarbero(int $idCita)
	{

		
		$idcita=intval($idCita);

		if ($idCita > 0) {
			$arrData = $this->model->selectDatosCita($idcita);

			if (empty($arrData)) {
				$arrResponse = array("status" => false, "msg" => "Datos no encontrados.");
			} else {
				$arrResponse = array("status" => true, "data" => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
