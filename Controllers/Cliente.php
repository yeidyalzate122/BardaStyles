<?php

class Cliente extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(3);
	}

	public function Cliente()
	{
		if (empty($_SESSION['permisos'][3]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Clientes";
		$data['page_title'] = "Clientes";
		$data['page_name'] = "Clientes";
		$data['page_functions_js'] = "functions_cliente.js";
		$this->views->getView($this, "cliente", $data);
	}



	public function setClienteM()
	{
		if ($_POST) {
		
			if (empty($_POST['txtIdentificacionA'])) {
				$arrResponse = array("status" => false, "msg" => "Datos incorrectos");
			} else {

				$strIdcliente = strClean($_POST['idClienteA']);
				$strIdentificacion = strClean($_POST['txtIdentificacionA']);
				$strTipo = intval(strClean($_POST['listTipoA']));
				$strNombre = ucwords(strClean($_POST['txtNombreA']));
				$strPrimerApellido = ucwords(strClean($_POST['txtPrimerApellidoA']));
				$strSegundoApellido = ucwords(strClean($_POST['txtSegundoApellidoA']));
				$strTelefono = intval(strClean($_POST['txtTelefonoA']));
				$strFecha = strClean($_POST['txtFechaA']);
				$strCorreo = strClean($_POST['txtCorreoA']);
				//contrasena
				//hash() encripta la contraseña
				$strContrasena =  empty($_POST['txtContrasenaA']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtContrasenaA']);

				$request_user = $this->model->updateCliente(
					$strIdcliente,
					$strIdentificacion,
					$strTipo,
					$strNombre,
					$strPrimerApellido,
					$strSegundoApellido,
					$strTelefono,
					$strFecha,
					$strCorreo,
					$strContrasena
				);

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


	public function setCliente()
	{
		if ($_POST) {



			if (empty($_POST['txtIdentificacion'])) {
				$arrResponse = array("status" => false, "msg" => "Datos incorrectos");
			} else {

				$strIdentificacion = strClean($_POST['txtIdentificacion']);
				$strTipo = intval(strClean($_POST['listTipo']));
				$strNombre = ucwords(strClean($_POST['txtNombre']));
				$strPrimerApellido = ucwords(strClean($_POST['txtPrimerApellido']));
				$strSegundoApellido = ucwords(strClean($_POST['txtSegundoApellido']));
				$strTelefono = intval(strClean($_POST['txtTelefono']));
				$strFecha = strClean($_POST['txtFecha']);
				$strCorreo = strClean($_POST['txtCorreo']);
				//contrasena
				$strStatus = intval(strClean($_POST['txtStatus']));
				$strRolid = intval(strClean($_POST['listRolid'])); //el rol cliente debe de ser 4
				//hash() encripta la contraseña

				$strContrasena =  empty($_POST['txtContrasena']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtContrasena']);


				//acudiente

				$strParentesco = ucwords(strClean($_POST['listParentesco']));
				$strNumeroP = intval(strClean($_POST['txtNumeroP']));
				$strTelefonoP = intval(strClean($_POST['txtTelefonoP']));
				$strNombreP = ucwords(strClean($_POST['txtNombreP']));
				$strPrimerApellidoP	 = ucwords(strClean($_POST['txtPrimerApellidoP']));
				$strSegundoApellidoP = ucwords(strClean($_POST['txtSegundoApellidoP']));
				$strTelefonoP = intval(strClean($_POST['txtTelefonoP']));
				$strCorreoP = strClean($_POST['txtCorreoP']);

				$request_user = $this->model->insertCliente(
					$strIdentificacion,
					$strTipo,
					$strNombre,
					$strPrimerApellido,
					$strSegundoApellido,
					$strTelefono,
					$strFecha,
					$strCorreo,
					$strContrasena,
					$strStatus,
					$strRolid,
					$strParentesco,
					$strNumeroP,
					$strNombreP,
					$strPrimerApellidoP,
					$strSegundoApellidoP,
					$strTelefonoP,
					$strCorreoP
				);

				if ($request_user == 0) {
					$arrResponse = array("status" => true, "msg" => "Datos guardasos correctamente. :D");
				} else if ($request_user == 1) {
					$arrResponse = array("status" => false, "msg" => "¡Atención! el email, teléfono o la identificación ya existe, ingrese otro.");
				} else {
					$arrResponse = array("status" => false, "msg" => "No es posible almacenar los datos. ");
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}


		die();
	}


	public function getClientes()
	{
		$arrData = $this->model->selectClientes();

		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';
			if ($_SESSION['permisosMod']['r']) {
				$btnView = '	<button class="btn btn-secondary btn-sm btnViewCliente" onClick="ftnViewCliente(' . $arrData[$i]['idcliente'] . ',' . $arrData[$i]['idcliente'] . ')" title="ver Cliente"><i class="far fa-eye"></i>Ver</button>
			';
			}

			if ($_SESSION['permisosMod']['u']) {

				$btnEdit = '<button class="btn btn-primary btn-sm btnEditCliente" onClick="ftnEditCliente(' . $arrData[$i]['idcliente'] . ')" title="Editar Cliente"><i class="fas fa-pencil-alt"></i>Editar</button>
			';
			}

			if ($_SESSION['permisosMod']['d']) {

				$btnDelete = '<button class="btn btn-danger btn-sm btnDelCliente" onClick="fntDelCliente(' . $arrData[$i]['idcliente'] . ' )" title="Eliminar Cliente"><i class="far fa-trash-alt"></i>Eliminar</button>';
			}
			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . '' . $btnEdit . '' . $btnDelete . '</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}



	public function getCliente(int $idCliente)
	{

		$idpersona = intval($idCliente);
		if ($idpersona > 0) {
			$arrData = $this->model->selectDatosCliente($idpersona);

			if (empty($arrData)) {
				$arrResponse = array("status" => false, "msg" => "Datos no encontrados.");
			} else {
				$arrResponse = array("status" => true, "data" => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function delCliente()
	{
		if ($_POST) {
			$intCliente = intval($_POST['idCliente']);
			$requestDelete = $this->model->deleteCliente($intCliente);
			if ($requestDelete == 'ok') {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el empleado');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el empleado.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	public function getSelectTipo()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectTipo();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idtipodocumento'] . '">' . $arrData[$i]['descripcion'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
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
}



