<?php

class Categorias extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(6);
	}

	public function Categorias()
	{
		if (empty($_SESSION['permisos'][6]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Categorías ";
		$data['page_title'] = "Categorías ";
		$data['page_name'] = "Categorías  para los servicios";
		$data['page_functions_js'] = "functions_Categorias.js";
		$this->views->getView($this, "categorias", $data);
	}
	public function getCategoria($idcategoria)
	{
		if ($_SESSION['permisosMod']['r']) {
			$intIdcategoria = intval($idcategoria);
			if ($intIdcategoria > 0) {
				$arrData = $this->model->selectCategoria($intIdcategoria);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {

					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}


	public function getCategorias()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectCategorias();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idtiposervicio'] . ')" title="Ver categoría"><i class="far fa-eye"></i></button>';
				}
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idtiposervicio'] . ')" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';
				}
				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idtiposervicio'] . ')" title="Eliminar categoría"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setCategoria()
	{
		if ($_POST) {
			if (empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {

				$intIdcategoria = intval($_POST['idTipoServicio']);
				$strCategoria =  strClean($_POST['txtNombre']);
				$strDescipcion = strClean($_POST['txtDescripcion']);
				$intStatus = intval($_POST['listStatus']);


				if ($intIdcategoria == 0) {
					//Crear
					if ($_SESSION['permisosMod']['w']) {
						$request_cateria = $this->model->inserCategoria($strCategoria, $strDescipcion, $intStatus);
						$option = 1;
					}

					if ($request_cateria > 0) {
						if ($option == 1) {
							$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						}
					} else if ($request_cateria == 'exist') {
						$arrResponse = array('status' => false, 'msg' => '¡Atención! La categoría ya existe.');
					} else {
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function setCategoriaM()
	{
		if ($_POST) {
			if (empty($_POST['txtNombreM']) || empty($_POST['txtDescripcionM']) || empty($_POST['listStatusM'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {
				$intIdcategoria = intval($_POST['idTipoServicioM']);
				$strCategoria =  strClean($_POST['txtNombreM']);
				$strDescipcion = strClean($_POST['txtDescripcionM']);
				$intStatus = intval($_POST['listStatusM']);
				
				$request_cateria = $this->model->updateCategoria(
					$intIdcategoria,
					$strCategoria, 
					$strDescipcion,
					$intStatus);
					if ($request_cateria > 0) {
						$arrResponse = array("status" => true, "msg" => "Datos actualizados correctamente. :D");
					} else if ($request_cateria == 0) {
						$arrResponse = array("status" => false, "msg" => "¡Atención! nombre de la categoría ya existe, ingrese otro.");
					} else {
						$arrResponse = array("status" => false, "msg" => "No es posible almacenar los datos. ");
					}
					echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		
			}
			
		}
		die();
	}

	
	public function delCategoria()
	{
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdcategoria = intval($_POST['idtiposervicio']);
				$requestDelete = $this->model->deleteCategoria($intIdcategoria);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function getSelectCategorias(){
		$htmlOptions = "";
		$arrData = $this->model->selectCategorias();
		if(count($arrData) > 0 ){
			for ($i=0; $i < count($arrData); $i++) { 
				if($arrData[$i]['status'] == 1 ){
				$htmlOptions .= '<option value="'.$arrData[$i]['idtiposervicio'].'">'.$arrData[$i]['nombre'].'</option>';
				}
			}
		}
		echo $htmlOptions;
		die();	
	}





}
