<?php

class Longincliente extends Controllers
{




	public function __construct()
	{
		session_start();
		parent::__construct();
	}

	public function Longincliente()
	{

		$data['page_tag'] = "Inicio de sesión";
		$data['page_title'] = "Inicio de sesión- cliente";
		$data['page_name'] = "Login cliente";
		$data['page_functions_js'] = "function_loginCli.js";
		$this->views->getView($this, "longincliente", $data);
	}




	public function loginUserClie()
	{
		//dep($_POST);

//txtEmail

		if ($_POST) {
			if (empty($_POST['txtIdentidadClie']) || empty($_POST['txtPasswordClie'])) {
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			} else {
				$strUsuarioCli  =  strClean($_POST['txtIdentidadClie']);
				$strPasswordCli = hash("SHA256", $_POST['txtPasswordClie']);
				$requestUser = $this->model->loginuserCli($strUsuarioCli, $strPasswordCli);
				if (empty($requestUser)) {
					$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
				} else {
					$arrData = $requestUser;
					if ($arrData['status'] == 1) {
						$_SESSION['idUserCl'] = $arrData['idcliente'];
						$_SESSION['login'] = true;

						$arrData = $this->model->sessionLogin($_SESSION['idUserCl']);
						sessionUser($_SESSION['idUserCl']);
						$_SESSION['userData'] = $arrData;
						
						$arrResponse = array('status' => true, 'msg' => 'okkkk');
					} else {
						$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo');
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}

	



		die();
	}

	
	public function resetPass()
	{
		if ($_POST) {


			if (empty($_POST['txtEmailResetC'])) {
				$arrResponse = array('status' => false, 'msg' => 'Error de datos');
			} else {
				$token = token();
				$strEmail  =  strtolower(strClean($_POST['txtEmailResetC']));
				$arrData = $this->model->getUserEmailC($strEmail);

				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Usuario no existente.');
				} else {
					$idcliente= $arrData['idcliente'];
					$nombreUsuario= $arrData['nombre'].''.$arrData['apellido_uno'];

					$url_recovery = base_url().'/longincliente/confirmUser/'.$strEmail.'/'.$token;
					
					$requestUpdate= $this->model->setTokenUserC($idcliente,$token);


					
					$dataUsuario = array('nombreUsuario' => $nombreUsuario,	'email' => $strEmail,
					'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE,'url_recovery' => $url_recovery);
					
					
					if($requestUpdate){

						$sendEmail = sendEmail($dataUsuario,'email_cambioPassword');

						if ($sendEmail) {
							$arrResponse = array('status' => true, 
							'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
						}else{
							$arrResponse = array('status' => false, 
										 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
						}
						
					}else{
						$arrResponse = array('status' => false, 
										 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	public function confirmUser(string $params){

		if(empty($params)){
			header('Location: '.base_url());
		}else{
			$arrParams = explode(',',$params);
			$strEmail = strClean($arrParams[0]);
			$strToken = strClean($arrParams[1]);
			$arrResponse = $this->model->getUsuarioC($strEmail,$strToken);
			if(empty($arrResponse)){
				header("Location: ".base_url());
			}else{
				$data['page_tag'] = "Cambiar contraseña";
				$data['page_name'] = "cambiar_contrasenia";
				$data['page_title'] = "Cambiar Contraseña";
				$data['correo'] = $strEmail;
				$data['token'] = $strToken;
				$data['idcliente'] = $arrResponse['idcliente'];
			$data['page_functions_js'] = "function_loginCli.js";
				$this->views->getView($this,"cambiar_contrasenaCli",$data);
			}
		}
		die();
	}

	public function setPassword(){

		if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])){

				$arrResponse = array('status' => false, 
									 'msg' => 'Error de datos' );
			}else{
				$intIdpersona = intval($_POST['idUsuario']);
				$strPassword = $_POST['txtPassword'];
				$strPasswordConfirm = $_POST['txtPasswordConfirm'];
				$strEmail = strClean($_POST['txtEmail']);
				$strToken = strClean($_POST['txtToken']);

				if($strPassword != $strPasswordConfirm){
					$arrResponse = array('status' => false, 
										 'msg' => 'Las contraseñas no son iguales.' );
				}else{
					$arrResponseUser = $this->model->getUsuarioC($strEmail,$strToken);
					if(empty($arrResponseUser)){
						$arrResponse = array('status' => false, 
										 'msg' => 'Erro de datos.' );
					}else{
						$strPassword = hash("SHA256",$strPassword);
						$requestPass = $this->model->insertPassword($intIdpersona,$strPassword);

						if($requestPass){
							$arrResponse = array('status' => true, 
												 'msg' => 'Contraseña actualizada con éxito.');
						}else{
							$arrResponse = array('status' => false, 
												 'msg' => 'No es posible realizar el proceso, intente más tarde.');
						}
					}
				}
			}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}


//cliente
	
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
			$strRolid = intval(strClean($_POST['listRolid']));//el rol cliente debe de ser 4
			//hash() encripta la contraseña

			$strContrasena =  empty($_POST['txtContrasena']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtContrasena']);


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


public function getSelectParentesco ()
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
