<?php

class LoginModel extends Mysql
{
    private $intIdUsuario;
    private $intIdUsuarioC;
    private $strUsuario;
    private $strUsuarioC;
    private $strPassword;
    private $strUsuarioCli;
    private $strPasswordCli;
    private $strToken;

    public function __construct()
    {
        parent::__construct();
    }


    public function loginUser(string $usuario, string $password)
    {
        $this->strUsuario = $usuario;
        $this->strPassword = $password;
      
    
         $sql = "SELECT idempleado, status FROM empleado where numero_documento_empleado=
         $this->strUsuario  and  contrasena ='$this->strPassword' and status != 0";
       
        $request = $this->select($sql);
        return $request;
    
    }



    public function sessionLogin(int $iduser)
    {
        $this->intIdUsuario = $iduser;
        //BUSCAR ROLE 
        $sql = "SELECT b.idempleado, b.numero_documento_empleado,b.nombre, b.apellido_uno,b.apellido_dos, b.apellido_dos, b.correo,b.telefono, r.idrol, r.nombrerol, b.status FROM empleado b INNER JOIN rol r
        ON b.rolid = r.idrol WHERE b.idempleado =  $this->intIdUsuario";
        $request = $this->select($sql);
        $_SESSION['userData'] = $request;
        return $request;
    }


    public function sessionLoginCli(int $iduser)
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
    
    public function getUserEmail(string $strEmail)
    {
        $this->strUsuario = $strEmail;
       // $sql = "call sp_BuscarCorreo('$this->strUsuario')";
        $sql="    SELECT idempleado,nombre,apellido_uno,apellido_dos,status FROM
         empleado where correo ='$this->strUsuario' and status = 1;
        ";
        $request = $this->select($sql);
        return $request;
    }


    public function setTokenUser(int $idpersona, string $token)
    {
        $this->intIdUsuario = $idpersona;
        $this->strToken = $token;
        $sql = "UPDATE empleado SET token = ? WHERE idempleado = '$this->intIdUsuario' ";
        $arrData = array($this->strToken);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function getUsuario(string $email, string $token)
    {
        $this->strUsuario = $email;
        $this->strToken = $token;
        $sql = "SELECT idempleado FROM empleado WHERE 
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
        $sql = "UPDATE empleado SET contrasena = ?, token = ? WHERE idempleado = $this->intIdUsuario ";
        $arrData = array($this->strPassword, "");
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
