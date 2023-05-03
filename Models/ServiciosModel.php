<?php

class ServiciosModel extends Mysql
{
	private $intIdProducto;
	private $strNombre;
	private $strDescripcion;

	private $intCategoriaId;
	private $intPrecio;
	
	private $intStatus;
	private $strImagen;
	private  $intDuracion;
	private $intMarca;
	private $intClasificacion;

	public function __construct()
	{
		parent::__construct();
	}

	public function selectProveedor()
	{


		$sql = "SELECT * FROM proveedor";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectTipoServicio()
	{

		$sql = "SELECT * FROM tipo_servicio";
		$request = $this->select($sql);
		return $request;
	}




	public function selectMarca()
	{

		$sql = "SELECT * FROM marca";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectClasificacion()
	{

		$sql = "SELECT * FROM clasificacion";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectUnidad()
	{

		$sql = "SELECT * FROM unidad_medida";
		$request = $this->select_all($sql);
		return $request;
	}

	/////

	public function selectServicios()
	{
		$sql = "SELECT p.idproducto,
		p.nombre,
		p.precio,
		p.cantidad,
		p.idtiposervicio,
		p.idclasificacion,
		p.status,
		p.descripcion,
		s.idtiposervicio,
		s.nombre as tipoSer,
		c.idclasificacion,
		c.descripcion as clasificacion  
		FROM producto p

	   inner join tipo_servicio s on p.idtiposervicio =  s.idtiposervicio
	   inner join clasificacion c on  p.idclasificacion =  c.idclasificacion
	   WHERE p.status != 0 and  p.idclasificacion = 1  ";
		$request = $this->select_all($sql);
		return $request;
	}


	public function insertServicio(
		string $nombre,
		string $descripcion,
		int $precio,
		int $duracion,
		int $marca,
		int $categoriaid,
		int $clasificacion,
		int $status
	) {


		$this->strNombre = $nombre;
		$this->strDescripcion = $descripcion;

		$this->intCategoriaId = $categoriaid;
		$this->strPrecio = $precio;
		$this->intDuracion = $duracion;
		$this->intMarca = $marca;
		$this->intClasificacion = $clasificacion;
		$this->intStatus = $status;
		$return = 0;

		$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}'";

		$request = $this->select_all($sql);

		if (empty($request)) {
			$query_insert  = "INSERT INTO producto(nombre,
													descripcion,
													precio,
													duracion_servicio,
													idmarca,
													idtiposervicio,
													idclasificacion,
													status) 
													VALUES(?,?,?,?,?,?,?,?)";
			$arrData = array(

				$this->strNombre,
				$this->strDescripcion,
				$this->strPrecio,
				$this->intDuracion,
				$this->intMarca,
				$this->intCategoriaId,
				$this->intClasificacion,
				$this->intStatus
			);
			$request_insert = $this->insert($query_insert, $arrData);
			$return = $request_insert;
		} else {
			$return = 0;
		}
		return $return;
	}

	//no se ha terminado
	public function updateServicio(
		$idproducto,
		$nombre, 
		$descripcion,
		$precio, 
		$duracion, 
		$marca,
		$categoriaid,
		$clasificacion,
		$status
	) {

		$this->intIdProducto = $idproducto;
		$this->strNombre = $nombre;
		$this->strDescripcion = $descripcion;
		
		
		$this->strPrecio = $precio;
		$this->intDuracion = $duracion;
		$this->intMarca = $marca;

		$this->intCategoriaId = $categoriaid;
		$this->intClasificacion = $clasificacion;
		$this->intStatus = $status;
		$return = 0;

		$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}' AND idproducto != $this->intIdProducto ";
		$request = $this->select_all($sql);
		if (empty($request)) {
			$sql = "	UPDATE producto 
						SET 					
						nombre=?,
						descripcion=?,
						precio=?,
						duracion_servicio=?,
						idmarca=?,
					     idtiposervicio=?,
						idclasificacion=?,
						status=? 
						WHERE idproducto =$this->intIdProducto ";
			$arrData = array(
				
				$this->strNombre,
				$this->strDescripcion,
				$this->strPrecio,
				$this->intDuracion,
				$this->intMarca ,
				$this->intCategoriaId ,
				$this->intClasificacion,
				$this->intStatus 
			);

			$request = $this->update($sql, $arrData);
			$return = $request;
		} else {
			$return = 0;
		}
		return $return;
	}

	public function deleteProducto(int $idproducto){
		$this->intIdProducto = $idproducto;
		$sql = "UPDATE producto SET status = ? WHERE idproducto = $this->intIdProducto ";
		$arrData = array(0);
		$request = $this->update($sql,$arrData);
		return $request;
	}

	public function selectProducto(int $idproducto)
	{
		$this->intIdProducto = $idproducto;
		$sql = "SELECT p.idproducto,
		p.nombre,
		p.precio,
		p.cantidad,
		p.duracion_servicio,
		p.idtiposervicio,
		p.idclasificacion,
		p.status,
        p.idmarca,
		p.descripcion,
		s.idtiposervicio,
		s.nombre as tipoSer,
		c.idclasificacion,
		c.descripcion as clasificacion ,
        m.idmarca,
        m.marca as marca
        
		FROM producto p

		inner join marca m on p.idmarca =  m.idmarca
	   inner join tipo_servicio s on p.idtiposervicio =  s.idtiposervicio
	   inner join clasificacion c on  p.idclasificacion =  c.idclasificacion
	   WHERE p.status != 0 and  p.idclasificacion =1 and p.idproducto= $this->intIdProducto";
		$request = $this->select($sql);
		return $request;
	}




	public function insertImage(int $idproducto, string $imagen)
	{
		$this->intIdProducto = $idproducto;
		$this->strImagen = $imagen;
		$query_insert  = "INSERT INTO imagen(idproducto,img) VALUES(?,?)";
		$arrData = array(
			$this->intIdProducto,
			$this->strImagen
		);
		$request_insert = $this->insert($query_insert, $arrData);
		return $request_insert;
	}

	public function selectImages(int $idproducto)
	{
		$this->intIdProducto = $idproducto;
		$sql = "SELECT idproducto,img
				FROM imagen
				WHERE idproducto = $this->intIdProducto";
		$request = $this->select_all($sql);
		return $request;
	}

	public function deleteImage(int $idproducto, string $imagen)
	{
		$this->intIdProducto = $idproducto;
		$this->strImagen = $imagen;
		$query  = "DELETE FROM imagen 
					WHERE idproducto = $this->intIdProducto 
					AND img = '{$this->strImagen}'";
		$request_delete = $this->delete($query);
		return $request_delete;
	}
}
