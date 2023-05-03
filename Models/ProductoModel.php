<?php
	class ProductoModel extends Mysql
	{
	
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCodigo;
		private $intCategoriaId;
		private $intPrecio;
		private $intU;
		private $intStatus;
		private $strImagen;
		private  $intDuracion;
		private $intMarca;
		private $intClasificacion;
		private  $intProveedor;
		private  $intCantidad;
		private  $intMedida;
		private  $intUMedida;


		public function __construct()
		{
			parent::__construct();
		}



		public function selectProducto(int $idproducto)
		{
			$this->intIdProducto = $idproducto;

			$sql = "  SELECT p.idproducto,
			p.nombre,
			p.cantidad,
			p.idtipoproducto,
			p.idtiposervicio,
			p.idclasificacion,
            p.idmarca,
            p.descripcion,
			p.medida,
			p.idunidadmedida,
			p.descripcion as unidad,
			p.status,		
			s.idtiposervicio,
			s.nombre as tipoSer,
			c.idclasificacion,
			c.descripcion as clasificacion,  
			u.idunidadmedida,
			u.descripcion as unidad,
            o.idproveedor,
 			o.descripcion as proveedor,
            m.idmarca,
            m.marca
			FROM producto p
		 
         inner join marca m on p.idmarca =  m.idmarca
		   inner join tipo_servicio s on p.idtiposervicio =  s.idtiposervicio
		   inner join clasificacion c on  p.idclasificacion =  c.idclasificacion
		   inner join unidad_medida u on p.idunidadmedida =  u.idunidadmedida
           inner join proveedor o on p.idproveedor =  o.idproveedor
		   WHERE p.status != 0 and  p.idclasificacion = 2 and p.idproducto= $this->intIdProducto";
			$request = $this->select($sql);
			return $request;
		}


		public function selectProductos()
		{
			$sql = "  SELECT p.idproducto,
			p.nombre,
			p.cantidad,
			p.idtipoproducto,
			p.idtiposervicio,
			p.idclasificacion,
			p.medida,
			p.idunidadmedida,
			p.descripcion as unidad,
			p.status,		
			s.idtiposervicio,
			s.nombre as tipoSer,
			c.idclasificacion,
			c.descripcion as clasificacion,  
			u.idunidadmedida,
			u.descripcion as unidad,
            o.idproveedor,
 			o.descripcion as proveedor
			FROM producto p
		 
		   inner join tipo_servicio s on p.idtiposervicio =  s.idtiposervicio
		   inner join clasificacion c on  p.idclasificacion =  c.idclasificacion
		   inner join unidad_medida u on p.idunidadmedida =  u.idunidadmedida
           inner join proveedor o on p.idproveedor =  o.idproveedor
		   WHERE p.status != 0 and  p.idclasificacion = 2";
			$request = $this->select_all($sql);
			return $request;
		}

		public function insertProducto(
			
			string $nombre,
			string $descripcion,
			int $marca,
			int $proveedor,
			int $cantidad,
			int $medida,
			int $umedida,
			int $categoriaid,
			int $clasificacion,
			int $status
		) {
	
		
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intMarca = $marca;
			$this->intProveedor = $proveedor;
			$this->intCantidad=$cantidad;
			$this->intMedida=$medida;
			$this->intUMedida=$umedida;
			$this->intCategoriaId = $categoriaid;
			$this->intClasificacion = $clasificacion;
			$this->intStatus = $status;
			$return = 0;

			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}'";

			$request = $this->select_all($sql);
			if (empty($request)) {
				$query_insert  = "    INSERT INTO producto(nombre,
				descripcion,
				idmarca,
				idproveedor,
				cantidad,
				medida,	
				idunidadmedida,					
				idtiposervicio,
				idclasificacion,
				status) 
				VALUES(?,?,?,?,?,?,?,?,?,?)";
				$arrData = array(
	
					$this->strNombre,
					$this->strDescripcion,
					$this->intMarca ,
					$this->intProveedor,
					$this->intCantidad,
					$this->intMedida,
					$this->intUMedida,
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
	

		
		public function updateProducto(
			int $idproducto,
			string $nombre,
			string $descripcion,
			int $marca,
			int $proveedor,
			int $cantidad,
			int $medida,
			int $umedida,
			int $categoriaid,
			int $clasificacion,
			int $status
		) {
	
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intMarca = $marca;
			$this->intProveedor = $proveedor;
			$this->intCantidad=$cantidad;
			$this->intMedida=$medida;
			$this->intUMedida=$umedida;
			$this->intCategoriaId = $categoriaid;
			$this->intClasificacion = $clasificacion;
			$this->intStatus = $status;
			$return = 0;
	
			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}' AND idproducto != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if (empty($request)) {
				$sql = " UPDATE producto set nombre =?,
				descripcion=?,
				idmarca=?,
				idproveedor=?,
				cantidad=?,
				medida=?,	
				idunidadmedida=?,					
				idtiposervicio=?,
				idclasificacion=?,
				status=?
				WHERE idproducto =$this->intIdProducto ";
				$arrData = array(
					$this->strNombre,
					$this->strDescripcion ,
					$this->intMarca,
					$this->intProveedor ,
					$this->intCantidad,
					$this->intMedida,
					$this->intUMedida,
					$this->intCategoriaId ,
					$this->intClasificacion ,
					$this->intStatus
				);
	
				$request = $this->update($sql, $arrData);
				$return = $request;
			} else {
				$return = "exist";
			}
			return $return;
		}
		public function deleteProducto(int $idproducto){


			$this->intIdProducto = $idproducto;
			$sql = "DELETE FROM producto WHERE idproducto = $this->intIdProducto "; 
			$arrayData = array($this->intIdProducto);
			$request = $this->delete($sql, $arrayData);
	
			return $request;
		}
    }



	
?>