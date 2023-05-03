<?php

class AgendarCitasModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }



    public  $idCitaAA;
    public   $strCedula;
    public $strFecha;
    public $intHora;
    public  $strEmpleado;
    public  $intServicios;
    public  $strEstado;
    public  $intTotal;


    public function selectCliente()
    {
        //EXTRAE el tipo de documento
        $sql = "SELECT * FROM cliente";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectEmpleado()
    {
        //EXTRAE el tipo de documento
        $sql = "SELECT * FROM empleado";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectEstado()
    {
        //EXTRAE el tipo de documento
        $sql = "SELECT * FROM estado_cita";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectServicios()
    {
        //EXTRAE el tipo de documento
        $sql = "SELECT * FROM producto where idclasificacion =1";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectHora()
    {
        //EXTRAE el tipo de documento
        $sql = "SELECT * FROM hora";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCitas()
    {
        $sql = "SELECT c.idcita, c.fecha, c.idhora, h.descripcion, h.idhora,
        c.total_servicio, c.idcliente,cl.idcliente, cl.numero_documento_cliente,cl.nombre as nombreCli, cl.apellido_uno as apellidoCli,
        cl.apellido_dos as apellidoCliDos, c.idempleado, e.idempleado, e.numero_documento_empleado, e.nombre as nombreEm, e.apellido_uno as apellidoEm, e.apellido_dos as apellidoEmDos, 
        c.id_estado_cita, ec.id_estado_cita, ec.estado
                FROM cita c
               
                       inner join hora h on c.idhora =  h.idhora
                       inner join cliente cl on c.idcliente = cl.idcliente
                       inner join empleado e on c.idempleado = e.idempleado
                       inner join estado_cita ec on  c.id_estado_cita = ec.id_estado_cita;";
        $request = $this->select_all($sql);
        return $request;
    }



    public function insertAgenda(
        int $cedula,
        string $fecha,
        int $hora,
        int $empleado,
        array $servicio,
        int $estado,
        int  $total
    ) {

        $this->strCedula = $cedula;
        $this->strFecha = $fecha;
        $this->intHora = $hora;
        $this->strEmpleado = $empleado;
        $this->intServicios =  $servicio;
        $this->strEstado = $estado;
        $this->intTotal = $total;
        $return = 0;
        $cofirmar = 1;


        //print_r($this->strFecha . "  " . $this->intHora . "  " . $this->strEmpleado);



        $sql = "SELECT   idcita FROM cita where 
        fecha=$this->strFecha
        and idhora=$this->intHora
        and idempleado= $this->strEmpleado";

        $request = $this->select($sql);


        $id = intval(date('dym') . $this->intHora . $this->strEmpleado);
        $this->idCitaAA = $id;


        if (empty($request)) {

        
            $query_insert  = "INSERT INTO `cita` (`idcita`, `fecha`, `idhora`, `total_servicio`, 
                `idcliente`, `idempleado`, `id_estado_cita`,`confirmar`) 
                VALUES (?,?,?,?,?,?,?,?)";

            $arrData = array(
                $this->idCitaAA,
                $this->strFecha,
                $this->intHora,
                $this->intTotal,
                $this->strCedula,
                $this->strEmpleado,
                $this->strEstado,
                $cofirmar
            );
            $request_insert = $this->insert($query_insert, $arrData);

            foreach ($this->intServicios as $producto) {
                $arrData2 = array(

                    $this->intTotal,
                    $this->strFecha,
                    $producto,
                    $this->idCitaAA
                );

                $query_insert2  = "INSERT INTO `detalle_producto` (
                 `precio`, `fecha`, `idproducto`, `idcita`)
                VALUES (?,?,?,?)";


                $request_insert2 = $this->insert($query_insert2, $arrData2);
                $return =  $request_insert2;
            }
        } else {
            $return = 1;
        }
        return $return;
    }

    public function deleteCita(int $idproducto)
    {


        $this->intIdProducto = $idproducto;
        $sql = "call sp_eliminarCita ($this->intIdProducto)  ";
        $arrayData = array($this->intIdProducto);
        $request = $this->delete($sql, $arrayData);

        return $request;
    }


    public function selectDatosCita(int $idempleado)
    {
        $this->intIdEmpleado = $idempleado;



        $sql = " SELECT c.idcita, c.fecha, c.idhora, h.descripcion, h.idhora,
        c.total_servicio, c.idcliente,cl.idcliente, cl.numero_documento_cliente,cl.nombre as nombreCli, cl.apellido_uno as apellidoCli,
        cl.apellido_dos as apellidoCliDos, c.idempleado, e.idempleado, e.numero_documento_empleado, e.nombre as nombreEm, e.apellido_uno as apellidoEm, e.apellido_dos as apellidoEmDos, 
        c.id_estado_cita, ec.id_estado_cita, ec.estado, dp.id_detalle_producto,dp.idproducto, dp.idcita,p.nombre  
                FROM cita c
       
       
                inner join detalle_producto dp on c.idcita = dp.idcita
                       inner join hora h on c.idhora =  h.idhora
                       inner join cliente cl on c.idcliente = cl.idcliente
                       inner join empleado e on c.idempleado = e.idempleado
                       inner join estado_cita ec on  c.id_estado_cita = ec.id_estado_cita
                     inner join producto p on dp.idproducto = p.idproducto where c.idcita =$this->intIdEmpleado";





        $request = $this->select($sql);
        return $request;
    }
}
