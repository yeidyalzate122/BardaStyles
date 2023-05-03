<?php 

	class CategoriasModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}	
		public $intIdcategoria;
		public $strCategoria;
		public $strNombre;
		public $strDescripcion;
		public $intStatus;
		public $strPortada;
		public $strRuta;

		public function inserCategoria(
			string $nombre, 
			string $descripcion, 
			 int $status){

			$return = 0;
			$this->strCategoria = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intStatus = $status;

			$sql = "SELECT * FROM tipo_servicio WHERE nombre = '{$this->strCategoria}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tipo_servicio (nombre, descripcion, status) VALUES (?, ?, ?);
				";
	        	$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 	
								 $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}
		public function updateCategoria(int $idcategoria, string $categoria, string $descripcion,  int $status){
			$this->intIdcategoria = $idcategoria;
			$this->strCategoria = $categoria;
			$this->strDescripcion = $descripcion;
	
			$this->intStatus = $status;

			$sql = "SELECT * FROM tipo_servicio WHERE nombre = '{$this->strCategoria}' AND idtiposervicio != $this->intIdcategoria";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tipo_servicio SET nombre = ?, descripcion = ?, status = ?  WHERE idtiposervicio = $this->intIdcategoria ";
				$arrData = array($this->strCategoria, 
								 $this->strDescripcion, 
								 $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = 0;
			}
		    return $request;			
		}

		public function deleteCategoria(int $idcategoria)
		{
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM producto WHERE idtiposervicio = $this->intIdcategoria";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE tipo_servicio SET status = ? WHERE idtiposervicio = $this->intIdcategoria ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
        public function selectCategorias()
		{
			$sql = "SELECT * FROM tipo_servicio
					WHERE status != 0 ";
			$request = $this->select_all($sql);
			return $request;
		}


        public function selectCategoria(int $idcategoria){
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM tipo_servicio
					WHERE idtiposervicio = $this->intIdcategoria";
			$request = $this->select($sql);
			return $request;
		}
	}
 ?>