<?php

class LonginclienteModel extends Mysql
{
    private $intIdUsuario;
    private $strUsuario;
    private $strUsuarioCo;
    private $strPassword;
    private $strUsuarioCli;
    private $strPasswordCli;
    private $strToken;

    public function __construct()
    {
        parent::__construct();
    }




    public function loginuserCli(string $usuarioCli, string $passwordCli)
    {
        $this->strUsuarioCli = $usuarioCli;
        $this->strPasswordCli = $passwordCli;

        $sql = "SELECT idcliente, status FROM cliente where numero_documento_cliente=
        $this->strUsuarioCli  and  contrasena ='$this->strPasswordCli' and status != 0";

        $request = $this->select($sql);
        return $request;
    }



    public function sessionLogin(int $iduser)
    {
        $this->intIdUsuario = $iduser;
        //BUSCAR ROLE 
        $sql = " SELECT a.nombre, a.numero_documento_cliente, a.apellido_uno, a.apellido_dos,a.correo,a.telefono, a.status,r.idrol, r.nombrerol  FROM cliente a INNER JOIN rol r
        ON a.rolid = r.idrol
        WHERE a.idcliente= $this->intIdUsuario";
        $request = $this->select($sql);
        $_SESSION['userData'] = $request;
        return $request;
    }


    //del cliente
    public function getUserEmailC(string $strEmail)
    {
        $this->strUsuarioC = $strEmail;
        // $sql = "call sp_BuscarCorreo('$this->strUsuario')";
        $sql = " SELECT idcliente,nombre,apellido_uno,apellido_dos,status FROM cliente where correo ='$this->strUsuarioC' and status = 1";
        $request = $this->select($sql);
        return $request;
    }
    //del cliente
    public function setTokenUserC(int $idpersona, string $token)
    {
        $this->intIdUsuario = $idpersona;
        $this->strToken = $token;
        $sql = "UPDATE cliente SET token = ? WHERE idcliente = '$this->intIdUsuario' ";
        $arrData = array($this->strToken);
        $request = $this->update($sql, $arrData);
        return $request;
    }


    public function getUsuarioC(string $email, string $token)
    {
        $this->strUsuario = $email;
        $this->strToken = $token;
        $sql = "SELECT idcliente FROM cliente WHERE 
					correo = '$this->strUsuario' and 
					token = '$this->strToken' and 					
					status = 1 ";
        $request = $this->select($sql);
        return $request;
    }

    public function insertPassword(int $idPersona, string $password)
    {
        $this->intIdUsuario = $idPersona;
        $this->strPassword = $password;
        $sql = "UPDATE cliente  SET contrasena = ?, token = ? WHERE idcliente = $this->intIdUsuario ";
        $arrData = array($this->strPassword, "");
        $request = $this->update($sql, $arrData);
        return $request;
    }


    //cliente
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


				$query_insert = "INSERT INTO `barberia`.`cliente` (`numero_documento_cliente`, `nombre`, `apellido_uno`, `telefono`, `fechanacimiento`, `correo`, `contrasena`, `idtipodocumento`, `idacudiente`, `status`, `rolid`) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?)";


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
					$this->strParentesco,
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
}
