<?php

class Calendario extends Controllers
{
	public function __construct()
	{
		parent::__construct();


		session_start();
		if (empty($_SESSION['login'])) {
			header('Location: ' . base_url() . '/home');
		}
		//este es el id del modulo
		getPermisos(5);
	}

	public function Calendario()
	{
		if (empty($_SESSION['permisos'][5]['r'])) {
			header('Location: ' . base_url() . '/dashboard');
		}
		$data['page_tag'] = "Calendario ";
		$data['page_title'] = "Calendario ";
		$data['page_name'] = "Calendario";
		$data['page_functions_js'] = "functions_Agendar.js";
		$this->views->getView($this, "agendarCitas", $data);
	}






}
