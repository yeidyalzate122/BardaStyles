<?php

class Acudiente extends Controllers
{
	public function __construct()
	{
		parent::__construct();
		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(11);
	}

	public function acudiente()
	{
		if (empty($_SESSION['permisos'][11]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Acudiente";
		$data['page_title'] = "Acudiente";
		$data['page_name'] = "Acudiente";
		$data['page_functions_js'] = "function_acudiente.js";
		//function_acudiente
		$this->views->getView($this, "acudiente", $data);
	}
	public function getAcudiente(int $idAcudiente)
	{

		$idpersona = intval($idAcudiente);
		if ($idpersona > 0) {
			$arrData = $this->model->selectDatosAcudiente($idpersona);

			if (empty($arrData)) {
				$arrResponse = array("status" => false, "msg" => "Datos no encontrados.");
			} else {
				$arrResponse = array("status" => true, "data" => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getAcudientes()
	{
		$arrData = $this->model->selectAcudientes();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';
		

			if ($_SESSION['permisosMod']['u']) {

				$btnEdit = '<button class="btn btn-primary btn-sm btnEditAcudiente" onClick="ftnEditAcudiente(' . $arrData[$i]['idacudiente'] . ')" title="Editar Acudiente"><i class="fas fa-pencil-alt"></i>Editar</button>
			';
			}

	
			$arrData[$i]['options'] = '<div class="text-center">' . $btnEdit . '</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}



	public function getSelectParentesco()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectParentesco();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idparentesco'] . '">' . $arrData[$i]['descrip'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function setAcudienteM()
	{
		if ($_POST) {
		
			if (empty($_POST['idnumero'])) {
				$arrResponse = array("status" => false, "msg" => "Datos incorrectos");
			} else {

				$strId = strClean($_POST['idacudiente']);
				$strIdentificacion = strClean($_POST['idnumero']);
				$strParentesco = intval(strClean($_POST['listParentesco']));
				$strNombre = ucwords(strClean($_POST['txtNombre']));
				$strPrimerApellido = ucwords(strClean($_POST['txtPrimerApellido']));
				$strSegundoApellido = ucwords(strClean($_POST['txtSegundoApellido']));
				$strTelefono = intval(strClean($_POST['txtTelefono']));
				$strCorreo = strClean($_POST['txtCorreo']);
				//contrasena
				//hash() encripta la contraseña
			
				$request_user = $this->model->updateAcudiente(
					$strId ,				
					$strIdentificacion,
					$strNombre,
					$strPrimerApellido,
					$strSegundoApellido,
					$strTelefono,
					$strCorreo,
					$strParentesco );

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



}
