<?php

class AgendarCitas extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(5);
	}


	public function AgendarCitas()
	{
		if (empty($_SESSION['permisos'][5]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "AgendarCitas ";
		$data['page_title'] = "AgendarCitas ";
		$data['page_name'] = "AgendarCitas";
		$data['page_functions_js'] = "functions_Agendar.js";
		$this->views->getView($this, "agendarCitas", $data);
	}




	public function getCitas()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectCitas();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';



				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfoAgen(' . $arrData[$i]['idcita'] . ')" title="Ver "><i class="far fa-eye"></i></button>';
				}

				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idcita'] . ')" title="Eliminar "><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}



	public function getSelectCliente()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectCliente();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idcliente'] . '"> Número de documento: ' . $arrData[$i]['numero_documento_cliente'] . ' Nombre y Apellido: ' . $arrData[$i]['nombre'] . '  ' . $arrData[$i]['apellido_uno'] . '</option>';
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
					$htmlOptions .= '<option value="' . $arrData[$i]['idempleado'] . '">' . $arrData[$i]['nombre'] . ' ' . $arrData[$i]['apellido_uno'] . '</option>';
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
					$htmlOptions .= '<option value="' . $arrData[$i]['id_estado_cita'] . '">' . $arrData[$i]['estado'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function getSelectHora()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectHora();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idhora'] . '">' . $arrData[$i]['descripcion'] . ' ' . $arrData[$i]['apellido_uno'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}
	public function getSelectServicios()
	{
		$htmlOptions = "";
		$arrData = $this->model->selectServicios();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]) {

					$htmlOptions .= '<input name="checkbox[]" class="form-check-input" type="checkbox" value="' . $arrData[$i]['idproducto'] . '" id="' . $arrData[$i]['idproducto'] . '" onChange="cambioCheckBox(this, ' . $arrData[$i]['precio'] . ')"><label for="' . $arrData[$i]['idproducto'] . '" class="label-text"> 
					<span class="label-text">' . $arrData[$i]['nombre'] . '<b> - Precio:</b> $' . $arrData[$i]['precio'] . '</span></label><br>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	public function setCita()
	{
		if ($_POST) {

			if (empty($_POST['txtTotal'])) {
				$arrResponse = array("status" => false, "msg" => "Datos incorrectos");
			} else {
				$strCedula = $_POST['listCedula'];
				$strFecha = $_POST['txtFecha'];
				$intHora = $_POST['listHora'];
				$strEmpleado = $_POST['listEmpleado'];
				$intServicios = isset($_POST['checkbox']) ? $_POST['checkbox'] : [];
				$strEstado = $_POST['listEstado'];
				$intTotal = $_POST['txtTotal'];

				$contador = count($intServicios);

				if ( $contador > 2) {
					//Crear
					
						$request_cita = $this->model->insertAgenda(
							$strCedula,
							$strFecha,
							$intHora,
							$strEmpleado,
							$intServicios,
							$strEstado,
							$intTotal
						);

					if ($request_cita > 0) {
						$arrResponse = array("status" => true, "msg" => "Datos guardasos correctamente. :D");
					} else if ($request_cita == 1) {
						$arrResponse = array("status" => false, "msg" => "¡Atención! el email, teléfono o la identificación ya existe, ingrese otro.");
					} else {
						$arrResponse = array("status" => false, "msg" => "No es posible almacenar los datos. ");
					}
				}else{
					$arrResponse = array("status" => false, "msg" => 'Solo se permite dos servicios.');
				}
			}

				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


	
public function delCita()
{
	if($_POST){
		if($_SESSION['permisosMod']['d']){
			$intIdcategoria = intval($_POST['idcita']);
			$requestDelete = $this->model->deleteCita($intIdcategoria);
			if($requestDelete == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
			}else if($requestDelete == 'exist'){
				$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el productocon productos asociados.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
	}
	die();
}

public function getCita(int $idCliente)
	{

		$idpersona = intval($idCliente);
		if ($idpersona > 0) {
			$arrData = $this->model->selectDatosCita($idpersona);

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
