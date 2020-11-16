<?php namespace Controladoras;
use BaseDatos\CervezasBD as CervezasBD;
class ControladoraAdministrador
{
	private $bdCer;
		function __construct()
		{
			$this->bdCer=CervezasBD::getInstance();

		}
		public function index()
		{
			require(ROOT.'Vistas/administrador.php');
		}
		public function vistaUser()
		{
			require(ROOT.'Vistas/pag-principal.php');
		}
}







 ?>