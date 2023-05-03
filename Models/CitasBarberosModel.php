<?php

class CitasBarberosModel extends Mysql
{
	public function __construct()
	{
		parent::__construct();
	}

	private $intEstado;
	private $intIdCita;
	
	private $intAsistecia;


	public function selectCitaBarbe(int $idEmpleado)
	{ //me trae todad las citas de cada cliente
		$this->intIdEmpleado = $idEmpleado;
		$sql = "SELECT c.idcita, c.fecha, c.idhora, h.descripcion, h.idhora,
            c.total_servicio, c.idcliente,cl.idcliente, cl.numero_documento_cliente,cl.nombre as nombreCli, cl.apellido_uno as apellidoCli,
            cl.apellido_dos as apellidoCliDos, c.idempleado, e.idempleado, e.numero_documento_empleado, e.nombre as nombreEm, e.apellido_uno as apellidoEm,
			 e.apellido_dos as apellidoEmDos, 
            c.id_estado_cita, ec.id_estado_cita, ec.estado
                    FROM cita c
           
                           inner join hora h on c.idhora =  h.idhora
                           inner join cliente cl on c.idcliente = cl.idcliente
                           inner join empleado e on c.idempleado = e.idempleado
                           inner join estado_cita ec on  c.id_estado_cita = ec.id_estado_cita
                         where c.idempleado=$idEmpleado";
		$request = $this->select_all($sql);
		return $request;
	}


	public function selectEstado()
    {
      
        $sql = "SELECT * FROM estado_cita";
        $request = $this->select_all($sql);
        return $request;
    }


	public function selectAsistencia()
    {
      
        $sql = "SELECT * FROM asistencia";
        $request = $this->select_all($sql);
        return $request;
    }

	public function updateCitaBarbero(
		int $id,
		int $estado,
		int  $asistencia
	
	) {
		$this->intIdCita = $id;
		$this->intEstado = $estado;		
		$this->intAsistecia =  $asistencia;



		//$sql = "SELECT * FROM acudiente WHERE 	idacudiente = $this->strIdacudiente AND telefono != $this->strTelefonoP AND correo = '{$this->strCorreoP}'";
		//$request = $this->select_all($sql);

		if (empty($request)) {
			$sql = "UPDATE `cita` SET `id_estado_cita` = ?, `confirmar` = ? WHERE (`idcita` = $this->intIdCita)";
			$arrData = array(
				$this->intEstado,
				$this->intAsistecia
			);


			$request = $this->update($sql, $arrData);
		} else {
			$request = 0;
		}
		return $request;
	}


	public function selectDatosCita(int $idcita)
	{

		$this->intIdCita = $idcita;

		$sql = "SELECT c.idcita, c.fecha, c.idhora, h.descripcion, h.idhora,
        c.total_servicio, c.idcliente,cl.idcliente, cl.numero_documento_cliente,cl.nombre as nombreCli, cl.apellido_uno as apellidoCli,
        cl.apellido_dos as apellidoCliDos, c.idempleado, e.idempleado,c.confirmar,s.idasistencia, s.asistencia, e.numero_documento_empleado, e.nombre as nombreEm, e.apellido_uno as apellidoEm, e.apellido_dos as apellidoEmDos, 
        c.id_estado_cita, ec.id_estado_cita, ec.estado, dp.id_detalle_producto,dp.idproducto, dp.idcita,p.nombre  
                FROM cita c
       
       
                inner join detalle_producto dp on c.idcita = dp.idcita
                  inner join asistencia s on c.confirmar =  s.idasistencia
                       inner join hora h on c.idhora =  h.idhora
                       inner join cliente cl on c.idcliente = cl.idcliente
                       inner join empleado e on c.idempleado = e.idempleado
                       inner join estado_cita ec on  c.id_estado_cita = ec.id_estado_cita
                     inner join producto p on dp.idproducto = p.idproducto where c.idcita=$this->intIdCita";

		$request = $this->select($sql);
		return $request;
	}
}
