<?php

class Empleados extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		getPermisos(12);
	}

	public function Empleados()
	{
		if (empty($_SESSION['permisos'][12]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Empleados";
		$data['page_title'] = "Empleados";
		$data['page_name'] = "empleados";
		$data['page_functions_js'] = "functions_empleados.js";
		$this->views->getView($this, "empleados", $data);
	}


	public function getSelectTipoEstudio()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectTipoEstudio();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idtipoestudio'] . '">' . $arrData[$i]['descripcion'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
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

	public function getSelectEps()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectEps();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['ideps'] . '">' . $arrData[$i]['descripcion'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}


	public function getSelectEmpleado()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectEmpleado();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idempleado'] . '">  ' . $arrData[$i]['idempleado'] . '  ' . $arrData[$i]['nombre'] .  '  ' . $arrData[$i]['apellido_uno'] .  ' </option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}



public function getSelectEstado()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectEstado();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idestado'] . '">  ' . $arrData[$i]['idestado'] . ' ' . $arrData[$i]['des'] . ' </option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}




	public function setEmpleadoHistorial()
	{

		if (empty($_POST['listEmpleado'])) {
			$arrResponse = array("status" => false, "msg" => "Datos incorrectos");
		} else {
			#estudio
			$strlistEmpleado = intval(strClean($_POST['listEmpleado']));
			$strTitulacion = ucwords(strClean($_POST['txtTitulacion']));
			$strInstitucion = ucwords(strClean($_POST['txInstitucion']));
			$strTiempo = ucwords(strClean($_POST['txtTiempo']));
			$strCertificacion = strClean($_POST['listCerAA']);
			$strTipo = intval(strClean($_POST['txtTipo']));

			

			#experiencia aboral
			$strNombreEmpresa = ucwords(strClean($_POST['txtNombreEmpresa']));
			$strFechaInicio = strClean($_POST['txtFechaInicio']);
			$strFechaFinal = strClean($_POST['txtFechaFinal']);
			$strDescripcion = ucwords(strClean($_POST['txtDescripcion']));


			$request_user = $this->model->insertHistorial(
				$strlistEmpleado,
				$strTitulacion,
				$strInstitucion,
				$strTiempo,
				$strCertificacion,
				$strTipo,
				$strNombreEmpresa,
				$strFechaInicio,
				$strFechaFinal,
				$strDescripcion
			);


			if ($request_user == 0) {
				$arrResponse = array("status" => true, "msg" => "Datos guardasos correctamente. :D");
			} else if ($request_user == 1) {
				$arrResponse = array("status" => false, "msg" => "¡Atención! el historial del empleado  ya existe, ingrese otro.");
			} else {
				$arrResponse = array("status" => false, "msg" => "No es posible almacenar los datos. ");
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}




	public function setEmpleado()
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
				$strEps = intval(strClean($_POST['listEps']));
				$strRolid = intval(strClean($_POST['listRolid']));

				$certificadoBio=ucwords(strClean($_POST['listCer']));
				$strStatus = intval(strClean($_POST['txtStatus']));
			
				//hash() encripta la contraseña
		

					$strContrasena =  empty($_POST['txtContrasena']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtContrasena']);

				$request_user = $this->model->insertEmpleado(
					$strIdentificacion,
					$strTipo,
					$strNombre,
					$strPrimerApellido,
					$strSegundoApellido,
					$strTelefono,
					$strFecha,
					$strCorreo,
					$strContrasena,
					$strEps,
					$strRolid,
					$certificadoBio,
					$strStatus
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





	public function setEmpleadoM()
	{
		if ($_POST) {


			if (empty($_POST['txtIdentificacionA'])) {
				$arrResponse = array("status" => false, "msg" => "Datos incorrectos");
			} else {

				$strIdempleado = intval(strClean($_POST['idEmpleadoA']));
				$strIdentificacion = strClean($_POST['txtIdentificacionA']);
				$strTipo = intval(strClean($_POST['listTipoA']));
				$strNombre = ucwords(strClean($_POST['txtNombreA']));
				$strPrimerApellido = ucwords(strClean($_POST['txtPrimerApellidoA']));
				$strSegundoApellido = ucwords(strClean($_POST['txtSegundoApellidoA']));
				$strTelefono = intval(strClean($_POST['txtTelefonoA']));
				$strFecha = strClean($_POST['txtFechaA']);
				$strCorreo = strClean($_POST['txtCorreoA']);
				//contrasena
				$strEps = intval(strClean($_POST['listEpsA']));
				$strRolid = intval(strClean($_POST['listRolidA']));
				$strCertificadoBio=strClean($_POST['listCerA']);

				//hash() encripta la contraseña
				$strContrasena = empty($_POST['txtContrasenaA']) ? "" : hash("SHA256", $_POST['txtContrasenaA']);

				$strTitulacion = ucwords(strClean($_POST['txtTitulacionA']));
				$strInstitucion = ucwords(strClean($_POST['txInstitucionA']));;
				$strTiempo = ucwords(strClean($_POST['txtTiempoA']));;
				$strTipoEs = strClean($_POST['txtTipoA']);;
				$strCertificadoEstudio = strClean($_POST['listCerH']);
				$strNombreEmpresa = ucwords(strClean($_POST['txtNombreEmpresaA']));;
				$strFechaInicio = strClean($_POST['txtFechaInicioA']);;
				$strFechaFinal = strClean($_POST['txtFechaFinalA']);;
				$strDescripcion = ucwords(strClean($_POST['txtDescripcionA']));;



				$request_user = $this->model->updateEmpleado(
					$strIdempleado,
					$strIdentificacion,
					$strTipo,
					$strNombre,
					$strPrimerApellido,
					$strSegundoApellido,
					$strTelefono,
					$strFecha,
					$strCorreo,
					$strContrasena,
					$strEps,
					$strRolid,
					$strCertificadoBio,
					$strTitulacion,
					$strInstitucion,
					$strTiempo,
					$strTipoEs,
					$strCertificadoEstudio,
					$strNombreEmpresa,
					$strFechaInicio,
					$strFechaFinal,
					$strDescripcion
				);

				if ($request_user > 0) {
					$arrResponse = array("status" => true, "msg" => "Datos actualizado correctamente. :D");
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



	public function getEmpleados()
	{
		$arrData = $this->model->selectEmpleados();
		for ($i = 0; $i < count($arrData); $i++) {

			$btnView = '';
			$btnEdit = '';
			$btnDelete = '';
			if ($_SESSION['permisosMod']['r']) {
				$btnView = '	<button class="btn btn-secondary btn-sm btnViewEmpleado" onClick="ftnViewEmpleado(' . $arrData[$i]['idempleado'] . ')" title="ver empleado"><i class="far fa-eye"></i></button>
				';
			}


			if ($_SESSION['permisosMod']['u']) {

				$btnEdit = '<button class="btn btn-primary btn-sm btnEditEmpleado" onClick="ftnEditEmpleado(' . $arrData[$i]['idempleado'] . ')" title="Editar empleado"><i class="fas fa-pencil-alt"></i></button>
				';
			}

			if ($_SESSION['permisosMod']['d']) {

				$btnDelete = '<button class="btn btn-danger btn-sm btnDelEmpleado" onClick="fntDelEmpleado(' . $arrData[$i]['idempleado'] . ')" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>';
			}
			$arrData[$i]['options'] = '<div class="text-center">' . $btnView . '' . $btnEdit . '' . $btnDelete . '</div>';
		}
		echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		die();
	}




	public function getEmpleado(int $idEmpleado)
	{

		$idpersona = intval($idEmpleado);
		if ($idpersona > 0) {
			$arrData = $this->model->selectDatosEmpleados($idpersona);

			if (empty($arrData)) {
				$arrResponse = array("status" => false, "msg" => "Datos no encontrados.");
			} else {
				$arrResponse = array("status" => true, "data" => $arrData);
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}




	public function delEmpleado()
	{
		if ($_POST) {
			$intEmpleado = intval($_POST['idEmpleado']);
			$requestDelete = $this->model->deleteEmpleado($intEmpleado);
			if ($requestDelete == 'ok') {
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el empleado');
			} else {
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el empleado.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}



	public function perfil()
	{
		$data['page_tag'] = "Perfil";
		$data['page_title'] = "Perfil de usuario";
		$data['page_name'] = "Perfil de usuario";
		$data['page_functions_js'] = "functions_empleados.js";
		$this->views->getView($this, "perfil", $data);
	}

	public function putPerfil()
	{

		if ($_POST) {
			if (empty($_POST['txtApellidoDos']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$idUsuario = $_SESSION['idUserCl'];
				$strtxtApellidoDos = strClean($_POST['txtApellidoDos']);
				$strNombre = strClean($_POST['txtNombre']);
				$strApellido = strClean($_POST['txtApellido']);
				$intTelefono = intval(strClean($_POST['txtTelefono']));
				$strCorreo = strClean($_POST['txtEmail']);
				$strPassword = "";
				if (!empty($_POST['txtPassword'])) {
					$strPassword = hash("SHA256", $_POST['txtPassword']);
				}
				$request_user = $this->model->updatePerfilCli(
					$idUsuario,	
					$strNombre,
					$strApellido,
					$strtxtApellidoDos,
					$intTelefono,
					$strCorreo,
					$strPassword
				);
				if ($request_user) {
					sessionUser($_SESSION['idUserCl']);
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				} else {

					$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

}
