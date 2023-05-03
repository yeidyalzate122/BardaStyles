
	<?php

	class EmpleadosModel extends Mysql
	{

		private $intIdEmpleado;
		private $strIdentificacion;
		private $strTipo;
		private $strNombre;
		private $strPrimerApellido;
		private $strSegundoApellido;
		private $strTelefono;
		private $strFecha;
		private $strCorreo;
		private $strContrasena;
		private $strEps;
		private $strRolid;
		private $strCertificado;
		private $strStatus;
		private $strToken;


		private $strlistEmpleado;
		private $strTitulacion;
		private $strInstitucion;
		private $strTiempo;
		private $strTipoT;
		private $strCertificadoEstudio;

		private $strNombreEmpresa;
		private $strFechaInicio;
		private $strFechaFinal;
		private $strDescripcion;

		public function __construct()
		{
			parent::__construct();
		}

		//LISTO
		public function insertHistorial(
			int $listEmpleado,
			string $titulacion,
			string $institucion,
			string $tiempo,
			string $certificado,
			int $tipoT,
			string $nombreEmpresa,
			string $fechaInicio,
			string  $fechaFinal,
			string $descripcion
		) {
			$this->strlistEmpleado = $listEmpleado;
			$this->strTitulacion = $titulacion;
			$this->strInstitucion = $institucion;
			$this->strTiempo = $tiempo;
			$this->strCertificado = $certificado;
			$this->strTipoT = $tipoT;
			$this->strNombreEmpresa = $nombreEmpresa;
			$this->strFechaInicio = $fechaInicio;
			$this->strFechaFinal = $fechaFinal;
			$this->strDescripcion = $descripcion;
			$return = 1;

			//call ps_buscar_empleado('{$this->strlistEmpleado}')
			//	$sql = "SELECT * FROM  estudio where idempleado = '{$this->strlistEmpleado}'";

			$sql = "call ps_buscar_empleado('{$this->strlistEmpleado}')";
			$request = $this->select_all($sql);

			if (empty($request)) {
				//certificado          
				$query_insert = "call ps_historial_empleado(?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
				//falta el certificado
				$arrayData = array(
					$this->strlistEmpleado,
					$this->strTitulacion,
					$this->strInstitucion,
					$this->strTiempo,
					$this->strCertificado,
					$this->strTipoT,
					$this->strNombreEmpresa,
					$this->strFechaInicio,
					$this->strFechaFinal,
					$this->strDescripcion,
				);
				$request_insert = $this->insert($query_insert, $arrayData);
				$return = $request_insert;
			} else {
				$return = 1;
			}
			return $return;
		}

		//insertEmpleado

		//LISTO
		public function insertEmpleado(
			string $Identificacion,
			int $Tipo,
			string $Nombre,
			string $PrimerApellido,
			string $SegundoApellido,
			int $Telefono,
			string $Fecha,
			string $Correo,
			string $Contrasena,
			int $Eps,
			int $Rolid,
			string $certificado,
			int $Status
		) {
			$this->strIdentificacion = $Identificacion;
			$this->strTipo = $Tipo;
			$this->strNombre = $Nombre;
			$this->strPrimerApellido = $PrimerApellido;
			$this->strSegundoApellido = $SegundoApellido;
			$this->strTelefono = $Telefono;
			$this->strFecha = $Fecha;
			$this->strCorreo = $Correo;
			$this->strContrasena = $Contrasena;
			$this->strEps = $Eps;
			$this->strRolid = $Rolid;
			$this->strCertificado = $certificado;
			$this->strStatus = $Status;
			$return = 0;

			$sql = "SELECT * FROM empleado  WHERE correo ='{$this->strCorreo}' or  numero_documento_empleado = '{$this->strIdentificacion}' or telefono = '{$this->strTelefono}' ";
			$request = $this->select_all($sql);

			if (empty($request)) {
				$query_insert = "INSERT INTO `empleado` (`numero_documento_empleado`, `idtipodocumento`, `nombre`, `apellido_uno`, `apellido_dos`, `telefono`, `fecha_nacimiento`, `correo`, `contrasena`, `ideps`, `rolid`, `urlcertificado_bioseguridad`, `status`)
				 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

				$arrayData = array(
					$this->strIdentificacion,
					$this->strTipo,
					$this->strNombre,
					$this->strPrimerApellido,
					$this->strSegundoApellido,
					$this->strTelefono,
					$this->strFecha,
					$this->strCorreo,
					$this->strContrasena,
					$this->strEps,
					$this->strRolid,
					$this->strCertificado,
					$this->strStatus
				);

				$request_insert = $this->insert($query_insert, $arrayData);
				$return = $request_insert;
			} else {
				$return = 0;
			}
			return $return;
		}


		//LISTO
		public function selectEmpleados()
		{ //idUserCl
			$whereAdmin = "";
			if ($_SESSION['idUser'] != 1) {
				$whereAdmin = " and e.idempleado != 1 ";
			}
			$sql = "SELECT e.idempleado,e.numero_documento_empleado, t.descripcion as tipo_documento, e.nombre, e.apellido_uno, e.apellido_dos, 
						e.telefono, e.fecha_nacimiento, e.correo, p.descripcion as eps, r.nombrerol as cargo FROM empleado e
						inner join rol r on e.rolid = r.idrol
						inner join tipo_documento t on e.idtipodocumento = t.idtipodocumento
						inner join eps p on e.ideps = p.ideps
						where e.idempleado !=0;
						" . $whereAdmin;
			$request = $this->select_all($sql);
			return $request;
		}


		//LISTO
		public function selectDatosEmpleados(int $idempleado)
		{
			$this->intIdEmpleado = $idempleado;
			$sql = "SELECT e.idempleado,  e.numero_documento_empleado,  e.idtipodocumento   ,t.descripcion as tipo_documento, e.nombre, e.apellido_uno, e.apellido_dos, 
			e.telefono, e.fecha_nacimiento, e.correo,  e.ideps  , p.descripcion as eps, e.rolid,e.urlcertificado_bioseguridad,r.nombrerol as cargo, s.titulacion, s.institucion,
			s.tiempo_estudio, s.url_certificado,  s.idtipoestudio  ,o.descripcion as tipo_estudio, x.nombre_empresa, x.fecha_inicio, x.fecha_final, x.descripcion as funciones 
			 FROM empleado e
			 inner join experiencia_laboral x on x.idempleado = e.idempleado
			 inner join estudio s on s.idempleado = e.idempleado
			 inner join tipo_estudio o on s.idtipoestudio = o.idtipoestudio
			inner join rol r on e.rolid = r.idrol
			inner join tipo_documento t on e.idtipodocumento = t.idtipodocumento
			inner join eps p on e.ideps = p.ideps
			where e.idempleado = $this->intIdEmpleado";

			$request = $this->select($sql);
			return $request;
		}

		public function updateEmpleado(
			int $idEmpleado,
			string $Identificacion,
			int $Tipo,
			string $Nombre,
			string $PrimerApellido,
			string $SegundoApellido,
			int $Telefono,
			string $Fecha,
			string $Correo,
			string $Contrasena,
			int $Eps,
			int $Rolid,
			string $certificado,
			string $titulacion,
			string $institucion,
			string $tiempo,
			int $tipoT,
			String $CertificadoEstudio,
			string $nombreEmpresa,
			string $fechaInicio,
			string  $fechaFinal,
			string $descripcion
		) {

			$this->intIdEmpleado = $idEmpleado;
			$this->strIdentificacion = $Identificacion;
			$this->strTipo = $Tipo;
			$this->strNombre = $Nombre;
			$this->strPrimerApellido = $PrimerApellido;
			$this->strSegundoApellido = $SegundoApellido;
			$this->strTelefono = $Telefono;
			$this->strFecha = $Fecha;
			$this->strCorreo = $Correo;
			$this->strContrasena = $Contrasena;
			$this->strEps = $Eps;
			$this->strRolid = $Rolid;
			$this->strCertificado = $certificado;
			$this->strTitulacion = $titulacion;
			$this->strInstitucion = $institucion;
			$this->strTiempo = $tiempo;
			$this->strTipoT = $tipoT;
			$this->strCertificadoEstudio = $CertificadoEstudio;
			$this->strNombreEmpresa = $nombreEmpresa;
			$this->strFechaInicio = $fechaInicio;
			$this->strFechaFinal = $fechaFinal;
			$this->strDescripcion = $descripcion;


			//	$sql = "SELECT * FROM empleado  WHERE correo ='{$this->strCorreo}' or  numero_documento_empleado = '{$this->strIdentificacion}' or telefono = '{$this->strTelefono}' or idempleado = {$this->intIdEmpleado} ";
			//$request = $this->select_all($sql);

			if (empty($request)) {
				if ($this->strContrasena  != "") {
					$sql = "call SP_actualizarEm($this->intIdEmpleado,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				
					$arrayData = array(
						$this->strIdentificacion,
						$this->strTipo,
						$this->strNombre,
						$this->strPrimerApellido,
						$this->strSegundoApellido,
						$this->strTelefono,
						$this->strFecha,
						$this->strCorreo,
						$this->strContrasena,
						$this->strEps,
						$this->strRolid,
						$this->strCertificado,
						$this->strTitulacion,
						$this->strInstitucion,
						$this->strTiempo,
						$this->strCertificadoEstudio,
						$this->strTipoT,
						$this->strNombreEmpresa,
						$this->strFechaInicio,
						$this->strFechaFinal,
						$this->strDescripcion
					);
				} else {
					$sql = "call SP_actualizarMSC($this->intIdEmpleado,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					
					$arrayData = array(
					
						$this->strIdentificacion,
						$this->strTipo,
						$this->strNombre,
						$this->strPrimerApellido,
						$this->strSegundoApellido,
						$this->strTelefono,
						$this->strFecha,
						$this->strCorreo,
						$this->strEps,
						$this->strRolid,
						$this->strCertificado,
						$this->strTitulacion,
						$this->strInstitucion,
						$this->strTiempo,
						$this->strCertificadoEstudio,
						$this->strTipoT,
						$this->strNombreEmpresa,	
						$this->strFechaInicio,
						$this->strFechaFinal,
						$this->strDescripcion

					);
				}
				$request = $this->update($sql, $arrayData);
			} else {
				$request = 0;
			}
			return $request;
		}


		public function selectTipoEstudio()
		{
			//EXTRAE el tipo de documento
			$sql = "SELECT * FROM tipo_estudio";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectTipo()
		{
			//EXTRAE el tipo de documento
			$sql = "SELECT * FROM tipo_documento";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectEps()
		{
			//EXTRAE la eps
			$sql = "SELECT * FROM eps";
			$request = $this->select_all($sql);
			return $request;
		}



		//selectEmpleado

		public function selectEmpleado()
		{
			//EXTRAE la eps
			$sql = "SELECT * FROM empleado";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectEstado()
		{
			
			$sql = "SELECT * FROM estado";
			$request = $this->select_all($sql);
			return $request;
		}


		public function selectEstados()
		{
			
			$sql = "SELECT * FROM estado";
			$request = $this->select_all($sql);
			return $request;
		}
		//lISTO
		public function deleteEmpleado(int $intIdEmpleado)
		{
			$this->intIdEmpleado = $intIdEmpleado;
			$sql = "call sp_eliminar_empleado($this->intIdEmpleado)"; // el registro 3 debe de ser el cliente
			$arrayData = array($this->intIdEmpleado);
			$request = $this->delete($sql, $arrayData);

			return $request;
		}


		public function updatePerfil(int $idUsuario, string $nombre, string $apellido, $apellidodos, int $telefono, string $correo, string $password)
		{
			$this->intIdUsuario = $idUsuario;
			$this->strSegundoApellido = $apellidodos;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strCorreo = $correo;
			$this->strPassword = $password;

			if ($this->strPassword != "") {
				$sql = "UPDATE empleado SET  nombre=?, apellido_uno=?, apellido_dos=?, telefono=?,correo=?, contrasena=? 
				WHERE idempleado = $this->intIdUsuario ";
				$arrData = array(
					$this->strNombre,
					$this->strApellido,
					$this->strSegundoApellido,
					$this->intTelefono,
					$this->strCorreo,
					$this->strPassword
				);
			} else {
				$sql = "UPDATE empleado SET  nombre=?, apellido_uno=?, apellido_dos=?, telefono=?,correo=?
					WHERE idempleado = $this->intIdUsuario ";
				$arrData = array(
					$this->strNombre,
					$this->strApellido,
					$this->strSegundoApellido,
					$this->intTelefono,
					$this->strCorreo
				);
			}
			$request = $this->update($sql, $arrData);
			return $request;
		}

		public function updatePerfilCli(int $idUsuario, string $nombre, string $apellido, $apellidodos, int $telefono, string $correo, string $password)
		{
			$this->intIdUsuario = $idUsuario;
			$this->strSegundoApellido = $apellidodos;
			$this->strNombre = $nombre;
			$this->strApellido = $apellido;
			$this->intTelefono = $telefono;
			$this->strCorreo = $correo;
			$this->strPassword = $password;

			if ($this->strPassword != "") {
				$sql = "UPDATE cliente SET  nombre=?, apellido_uno=?, apellido_dos=?, telefono=?,correo=?, contrasena=? 
				WHERE idcliente = $this->intIdUsuario ";
				$arrData = array(
					$this->strNombre,
					$this->strApellido,
					$this->strSegundoApellido,
					$this->intTelefono,
					$this->strCorreo,
					$this->strPassword
				);
			} else {
				$sql = "UPDATE cliente SET  nombre=?, apellido_uno=?, apellido_dos=?, telefono=?,correo=?
					WHERE idcliente = $this->intIdUsuario ";
				$arrData = array(
					$this->strNombre,
					$this->strApellido,
					$this->strSegundoApellido,
					$this->intTelefono,
					$this->strCorreo
				);
			}
			$request = $this->update($sql, $arrData);
			return $request;
		}
	}
	?>