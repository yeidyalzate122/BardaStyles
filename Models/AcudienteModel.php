<?php

class AcudienteModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }


    private $strIdacudiente;
    private $strParentesco;
    private $strNombreP;
    private $strPrimerApellidoP;
    private $strSegundoApellidoP;
    private $strTelefonoP;
    private $strIdentificacion;
    private $strCorreoP;


    public function selectAcudientes()
    { //idUserCl

        $sql = "SELECT a.idacudiente,a.nombre,a.apellido_uno,a.apellido_dos,a.telefono,a.correo,
            a.idparentesco, 
            p.descrip as parentesco FROM acudiente a
           inner join parentesco p on a.idparentesco = p.idparentesco
            where a.idparentesco != 1 ";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectDatosAcudiente(int $idacudiente)
    {
        $this->strIdacudiente = $idacudiente;

        $sql = " SELECT a.idacudiente, a.nombre, a.apellido_uno, a.apellido_dos, a.telefono, a.correo, a.idparentesco, p.idparentesco, p.descrip as descipcion FROM acudiente a
            inner join parentesco p on a.idparentesco = p.idparentesco
            
            where idacudiente=  $this->strIdacudiente";

        $request = $this->select($sql);
        return $request;
    }

    public function selectParentesco()
    {
        $whereAdmin = "";
        if($_SESSION['idUser'] != 1 && $_SESSION['idUser'] == 1 ){
            $whereAdmin = " and idparentesco = 1 ";
        }
        $sql = "SELECT * FROM parentesco".$whereAdmin;
        $request = $this->select_all($sql);
        return $request;
    }
    //UPDATE `barberia`.`acudiente` SET `idacudiente` = '34342', `nombre` = 'Andreaa', `apellido_uno` = 'Mesas', `apellido_dos` = 'Castros', `telefono` = '59268w', `correo` = 'MARIsCastro@gmail.com', `idparentesco` = '1' WHERE (`idacudiente` = '3434');
    //hay que terminarlo
    public function updateAcudiente(
        int $id,
        int $identificacion,
        string  $nombre,
        string  $primerApellido,
        string  $segundoApellido,
        int $telefono,
        string  $correo,
        int $parentesco
    ) {
        $this->strIdentificacion=$identificacion;
        $this->strIdacudiente = $id;
        $this->strNombreP =  $nombre;
        $this->strPrimerApellidoP = $primerApellido;
        $this->strSegundoApellidoP =  $segundoApellido;
        $this->strTelefonoP = $telefono;
        $this->strCorreoP =  $correo;
        $this->strParentesco = $parentesco;


        $sql = "SELECT * FROM acudiente WHERE 	idacudiente = $this->strIdacudiente AND telefono != $this->strTelefonoP AND correo = '{$this->strCorreoP}'";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "call sp_actualizarAcudiente(?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strIdacudiente,
                $this->strIdentificacion,
                $this->strNombreP,
                $this->strPrimerApellidoP,
                $this->strSegundoApellidoP,
                $this->strTelefonoP,
                $this->strCorreoP,
                $this->strParentesco
            );


            $request = $this->update($sql, $arrData);
        } else {
            $request = 0;
        }
        return $request;
    }
}
