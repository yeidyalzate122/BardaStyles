<?php

class Producto extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(10);
	}

	public function Producto()
	{
		if (empty($_SESSION['permisos'][10]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Productos";
		$data['page_title'] = "Productos";
		$data['page_name'] = "Productos";
		$data['page_functions_js'] = "functions_Producto.js";
		$this->views->getView($this, "Producto", $data);
	}




	public function getProducto($idproducto){
		if($_SESSION['permisosMod']['r']){
			$idproducto = intval($idproducto);
			if($idproducto > 0){
				$arrData = $this->model->selectProducto($idproducto);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				} else {
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}





	public function getProductos()
	{
		if ($_SESSION['permisosMod']['r']) {
			$arrData = $this->model->selectProductos();
			for ($i = 0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				if ($arrData[$i]['status'] == 1) {
					$arrData[$i]['status'] = '<span class="badge badge-success">Buen estado</span>';
				} else if($arrData[$i]['status'] == 2) {
					$arrData[$i]['status'] = '<span class="badge badge-danger">Mal estado</span>';
				}

				// if ($_SESSION['permisosMod']['r']) {
				// 	$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idproducto'] . ')" title="Ver categoría"><i class="far fa-eye"></i></button>';
				// }
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

	public function delProducto()
	{
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdcategoria = intval($_POST['idproducto']);
				$requestDelete = $this->model->deleteProducto($intIdcategoria);
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






	public function setProducto()
	{
		if ($_POST) {
		
			if (empty($_POST['txtNombre']) || empty($_POST['listCategoria']) ||  empty($_POST['listStatus'])) {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			} else {

				$idProducto = intval($_POST['idProducto']);
				$strNombre = strClean($_POST['txtNombre']);
				$strDescripcion = strClean($_POST['txtDescripcion']);
				//$strCodigo = strClean($_POST['txtCodigo']);
				$intCategoriaId = intval($_POST['listCategoria']);
				$intMarca = strClean($_POST['listMarca']);
				$intProveedor = intval($_POST['listProveedor']);
				$intMedida = intval($_POST['txtMedida']);
				$intUmedida = intval($_POST['listMedida']);
				$intCantidad = intval($_POST['txtCantidad']);
				
				$intClasificacion = intval($_POST['listClasificacion']);
				$intStatus = intval($_POST['listStatus']);

				$request_producto = "";

				if ($idProducto == 0) {
					$option = 1;
					if ($_SESSION['permisosMod']['w']) {
						$request_producto = $this->model->insertProducto(
							$strNombre,
							$strDescripcion,			
							$intMarca,
							$intProveedor,
							$intCantidad,
							$intMedida,
							$intUmedida,
							$intCategoriaId,
							$intClasificacion,
							$intStatus
						);
					}
				} else {
					$option = 2;
					if ($_SESSION['permisosMod']['u']) {
						$request_producto = $this->model->updateProducto(
							$idProducto,
							$strNombre,
							$strDescripcion,			
							$intMarca,
							$intProveedor,
							$intCantidad,
							$intMedida,
							$intUmedida,
							$intCategoriaId,
							$intClasificacion,
							$intStatus
						);
					}
				}
				if ($request_producto > 0) {
					if ($option == 1) {
						$arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
					} else {
						$arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
					}
				} else if ($request_producto == 0) {
					$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');
				} else {
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
