<?php

class Servicios extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(13);
	}

	public function Servicios()
	{
		if (empty($_SESSION['permisos'][13]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Servicios";
		$data['page_title'] = "Servicios";
		$data['page_name'] = "Servicios";
		$data['page_functions_js'] = "functions_servicios.js";
		$this->views->getView($this, "servicios", $data);
	}

	public function getSelectMarca(){
	
		$htmlOptions = "";
		$arrData = $this->model->selectMarca();
		if (count($arrData) > 0) {
			for ($i = 0; $i < count($arrData); $i++) {
				if ($arrData[$i]['idmarca'] != 0) {
					$htmlOptions .= '<option value="' . $arrData[$i]['idmarca'] . '">' . $arrData[$i]['marca'] . '</option>';
				}
			}
		}
		echo $htmlOptions;
		die();
	}

	/*public function getSelectClasificacion(){
		$htmlOptions = "";
		$arrData = $this->model->selectClasificacion();
		if(count($arrData) > 0 ){
			for ($i=0; $i < count($arrData); $i++) { 
				if ($arrData[$i]['idclasificacion'] != 0) {
				$htmlOptions .= '<option value="'.$arrData[$i]['idclasificacion'].'">'.$arrData[$i]['descripcion'].'</option>';
				}
			}
		}
		echo $htmlOptions;
		die();	
	}*/


	public function getProducto($idproducto){
		if($_SESSION['permisosMod']['r']){
			$idproducto = intval($idproducto);
			if($idproducto > 0){
				$arrData = $this->model->selectProducto($idproducto);
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrImg = $this->model->selectImages($idproducto);
					if(count($arrImg) > 0){
						for ($i=0; $i < count($arrImg); $i++) { 
							$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
						}
					}
					$arrData['images'] = $arrImg;
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}



	public function setImage(){
		
		if($_POST){
			if(empty($_POST['idproducto'])){
				$arrResponse = array('status' => false, 'msg' => 'Error de dato.');
			}else{
				$idProducto = intval($_POST['idproducto']);
				
				$foto      = $_FILES['foto'];
				$imgNombre = 'pro_'.md5(date('d-m-Y H:m:s')).'.jpg';
				$request_image = $this->model->insertImage($idProducto,$imgNombre);
				if($request_image){
					$uploadImage = uploadImage($foto,$imgNombre);
					$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
				}
			}
			
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getSelectUnidad(){
		$htmlOptions = "";
		$arrData = $this->model->selectUnidad();
		if(count($arrData) > 0 ){
			for ($i=0; $i < count($arrData); $i++) { 
				if ($arrData[$i]['idunidadmedida'] != 0) {
				$htmlOptions .= '<option value="'.$arrData[$i]['idunidadmedida'].'">'.$arrData[$i]['descripcion'].'</option>';
				}
			}
		}
		echo $htmlOptions;
		die();	
	}
	public function getSelectProveedor(){
		$htmlOptions = "";
		$arrData = $this->model->selectProveedor();
		if(count($arrData) > 0 ){
			for ($i=0; $i < count($arrData); $i++) { 
				if ($arrData[$i]['idproveedor'] != 0) {
				$htmlOptions .= '<option value="'.$arrData[$i]['idproveedor'].'">'.$arrData[$i]['descripcion'].'</option>';
				}
			}
		}
		echo $htmlOptions;
		die();	
	}
	public function getServicios()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectServicios();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				} else {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

			/*	if ($_SESSION['permisosMod']['r']) {
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idproducto'] . ')" title="Ver categoría"><i class="far fa-eye"></i></button>';
				}*/
				if ($_SESSION['permisosMod']['u']) {
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,' . $arrData[$i]['idproducto'] . ')" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';
				}
				if ($_SESSION['permisosMod']['d']) {
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idproducto'] . ')" title="Eliminar categoría"><i class="far fa-trash-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
		}
		die();
	}


 public function setServicios()
 {
	if($_POST){
	
	
		if(empty($_POST['txtNombre']) ||  empty($_POST['listCategoria']) || empty($_POST['txtPrecio']) || empty($_POST['listStatus']) )
		{
			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
		}else{
			
			$idProducto = intval($_POST['idProducto']);
			$strNombre = strClean($_POST['txtNombre']);
			$strDescripcion = strClean($_POST['txtDescripcion']);
			//$strCodigo = strClean($_POST['txtCodigo']);
			$intCategoriaId = intval($_POST['listCategoria']);
			$strPrecio = strClean($_POST['txtPrecio']);
			$intDuracion = intval($_POST['txtDuracion']);
			$intMarca = intval($_POST['listMarca']);
			$intClasificacion = intval($_POST['listClasificacion']);

			$intStatus = intval($_POST['listStatus']);
			
			$request_producto = "";

			if($idProducto == 0)
			{
				$option = 1;
				if($_SESSION['permisosMod']['w']){
					$request_producto = $this->model->insertServicio($strNombre, 
																$strDescripcion,									
																$strPrecio, 
																$intDuracion, 
																$intMarca,
																$intCategoriaId,
																$intClasificacion,
																$intStatus );
				}
			}else{
				$option = 2;
				if($_SESSION['permisosMod']['u']){
					$request_producto = $this->model->updateServicio($idProducto,
																$strNombre, 
																$strDescripcion,
																$strPrecio, 
																$intDuracion, 
																$intMarca,
																$intCategoriaId,
																$intClasificacion,
																$intStatus);
				}
			}
			if($request_producto > 0 )
			{
				if($option == 1){
					$arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_producto == 0){
				$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el nombre Ingresado.');		
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
	die();
 }




 
 public function delFile(){
	if($_POST){
		if(empty($_POST['idproducto']) || empty($_POST['file'])){
			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
		}else{
			//Eliminar de la DB
			$idProducto = intval($_POST['idproducto']);
			$imgNombre  = strClean($_POST['file']);
			$request_image = $this->model->deleteImage($idProducto,$imgNombre);

			if($request_image){
				$deleteFile =  deleteFile($imgNombre);
				$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
	die();
}




public function delProducto(){
	if($_POST){
		if($_SESSION['permisosMod']['d']){
			$intIdproducto = intval($_POST['idProducto']);
			$requestDelete = $this->model->deleteProducto($intIdproducto);
			if($requestDelete)
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
	}
	die();
}



}
