<?php namespace Controladoras;

       use BaseDatos\PresentacionBD as envase;
       use BaseDatos\CervezasBD as cerveza;
       use BaseDatos\SucursalesBD as Sucu;
 class ControladoraPaginaPrincipal
 {
 	private $Todosenvases;
 	private $Todascervezas;
 	private $TodasSucu;
 	function __construct()
 	{
 		$this->Todosenvases=envase::getInstance();
 		$this->Todascervezas=cerveza::getInstance();
 		$this->TodasSucu=Sucu::getInstance();
 	}
 	 public function verCervezas()
        {
             		$lista=$_SESSION['CarritoVirtual'];
             		$listaSucu=$this->TodasSucu->getListaSucursales();
             		$listaTotalEnvase=$this->Todosenvases->getListaPresentaciones();
             		$listaCerveza=$this->Todascervezas->getListaCerveza();
            require(ROOT.'Vistas/listacervezas.php');
        }
 	public function index()
 	{
 		$lista=$_SESSION['CarritoVirtual'];
 	    require(ROOT.'Vistas/pag-principal.php');

 	}
 	
 	public function irPrincipal()
    {
        unset($_SESSION['CarritoVirtual']);
        $_SESSION['CarritoVirtual']=array();
        unset($_SESSION['PedidoEnSession']);
        $this->index();
    }
 }

 ?>