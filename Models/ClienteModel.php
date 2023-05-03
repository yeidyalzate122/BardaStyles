<?php

class ClienteModel extends Mysql
{
	public function __construct()
	{
		parent::__construct();
	}


	private $intIdCliente;
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
	private $strStatus;
	private $strRolid;
	private $strToken;

	private $strIdacudiente;
	private $strParentesco;
	private $strNombreP;
	private $strPrimerApellidoP;
	private $strSegundoApellidoP;
	private $strTelefonoP;
	private $strFechaP;
	private $strCorreoP;

	public function selectTipo()
	{
		//EXTRAE el tipo de documento
		$sql = "SELECT * FROM tipo_documento";
		$request = $this->select_all($sql);
		return $request;
	}



	public function selectParentesco()
	{
		//EXTRAE el tipo de documento
		$sql = "SELECT * FROM parentesco";
		$request = $this->select_all($sql);
		return $request;
	}


	public function insertCliente(
		string $Identificacion,
		int $Tipo,
		string $Nombre,
		string $PrimerApellido,
		string $SegundoApellido,
		int $Telefono,
		string $Fecha,
		string $Correo,
		string $Contrasena,
		int $Status,
		int $Rolid,
		int $Parentesco,
		int $idAcudiente,
		String $NombreP,
		String $PrimerApellidoP,
		String $SegundoApellidoP,
		int $TelefonoP,
		String $CorreoP
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
		$this->strStatus = $Status;
		$this->strRolid = $Rolid;
		//datos del caudiente 
		$this->strParentesco = $Parentesco;
		$this->strIdacudiente = $idAcudiente;
		$this->strNombreP = $NombreP;
		$this->strPrimerApellidoP = $PrimerApellidoP;
		$this->strSegundoApellidoP = $SegundoApellidoP;
		$this->strTelefonoP = $TelefonoP;
		$this->strCorreoP = $CorreoP;

		$return = 1;

		$sql = "SELECT * FROM cliente  WHERE correo ='{$this->strCorreo}'
		 or  numero_documento_cliente = {$this->strIdentificacion}
		  or telefono = {$this->strTelefono} ";

		$request = $this->select_all($sql);

		if (empty($request)) {
			if ($this->strIdacudiente != "") {


				$query_insert = "call sp_guardarCliente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,? , ?, ?, ?,? , ?, ?)";


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
					$this->strStatus,
					$this->strRolid,
					//datos del caudiente 

					$this->strIdacudiente,
					$this->strNombreP,
					$this->strPrimerApellidoP, 
					$this->strSegundoApellidoP,
					$this->strTelefonoP,
					$this->strCorreoP,
					$this->strParentesco
				);
			} else {


				$query_insert = "INSERT INTO `cliente` (`
				numero_documento_cliente`, 
				`nombre`,
				 `apellido_uno`, 
				 `telefono`,
				  `fechanacimiento`,
				   `correo`, 
				   `contrasena`, 
				   `idtipodocumento`, 
				    `status`,
					 `rolid`) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?)";


				$arrayData = array(
					$this->strIdentificacion,
					$this->strNombre,
					$this->strPrimerApellido,
					$this->strSegundoApellido,
					$this->strTelefono,
					$this->strFecha,
					$this->strCorreo,
					$this->strContrasena,
					$this->strTipo,
					$this->strStatus,
					$this->strRolid
				);
			}



			$request_insert = $this->insert($query_insert, $arrayData);
			$return = $request_insert;
		} else {
			$return = 1;
		}
		return $return;
	}

	public function selectClientes()
	{ //idUserCl

		$sql = "SELECT e.idcliente,e.numero_documento_cliente, t.descripcion as tipo_documento, e.nombre, e.apellido_uno, e.apellido_dos, 
				  e.telefono, e.fechanacimiento, e.correo,e.idacudiente,  r.nombrerol as cargo FROM cliente e
				  inner join rol r on e.rolid = r.idrol
				  inner join tipo_documento t on e.idtipodocumento = t.idtipodocumento
				  where e.idcliente !=0	  ";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectDatosCliente(int $idempleado)
	{
		$this->intIdEmpleado = $idempleado;



		$sql = " SELECT e.idcliente,  e.numero_documento_cliente,  e.idtipodocumento   ,t.descripcion as tipo_documento, e.nombre, e.apellido_uno, e.apellido_dos, 
				e.telefono, e.fechanacimiento, e.correo, e.idacudiente, e.rolid,r.nombrerol as cargo
				 FROM cliente e
			
				inner join rol r on e.rolid = r.idrol
				inner join tipo_documento t on e.idtipodocumento = t.idtipodocumento
				where e.idcliente = $this->intIdEmpleado";





		$request = $this->select($sql);
		return $request;
	}




	public function updateCliente(
		int $Idcliente,
		string $Identificacion,
		int $Tipo,
		string $Nombre,
		string $PrimerApellido,
		string $SegundoApellido,
		int $Telefono,
		string $Fecha,
		string $Correo,
		string $Contrasena
	) {
		$this->intIdCliente = $Idcliente;
		$this->strIdentificacion = $Identificacion;
		$this->strTipo = $Tipo;
		$this->strNombre = $Nombre;
		$this->strPrimerApellido = $PrimerApellido;
		$this->strSegundoApellido = $SegundoApellido;
		$this->strTelefono = $Telefono;
		$this->strFecha = $Fecha;
		$this->strCorreo = $Correo;
		$this->strContrasena = $Contrasena;

	//	$sql = "SELECT * FROM cliente  WHERE correo ='{$this->strCorreo}' or  numero_documento_cliente = '{$this->strIdentificacion}' or telefono = '{$this->strTelefono}' or idcliente = {$this->intIdCliente} ";
		//$request = $this->select_all($sql);

		if (empty($request)) {

			if ($this->strContrasena  != "") {

				$sql = "UPDATE cliente SET  numero_documento_cliente = ?, nombre = ?,
				 apellido_uno = ?, apellido_dos = ?, telefono = ?,
				  fechanacimiento = ?, correo=?,contrasena = ?, idtipodocumento = ? WHERE idcliente = $this->intIdCliente";

				$arrayData = array(
					$this->strIdentificacion,
					$this->strNombre,
					$this->strPrimerApellido,
					$this->strSegundoApellido,
					$this->strTelefono,
					$this->strFecha,
					$this->strCorreo,
					$this->strContrasena,
					$this->strTipo);
			} else {

				$arrayData = array(

					$this->strIdentificacion,
					$this->strNombre,
					$this->strPrimerApellido,
					$this->strSegundoApellido,
					$this->strTelefono,
					$this->strFecha,
					$this->strCorreo,
					$this->strTipo
				);
			}
			$request = $this->update($sql, $arrayData);
		} else {
			$request = 0;
		}
		return $request;
	}


	public function deleteCliente(int $intIdCliente)
	{
		$this->intIdCliente = $intIdCliente;
		$sql = "call sp_eliminarCliente ($this->intIdCliente)"; 
		$arrayData = array($this->intIdCliente);
		$request = $this->delete($sql, $arrayData);

		return $request;
	}

}
