<?php namespace Controladoras;
use Daos\DaoPedidos as Pedidos;
    use Modelo\Pedido as Pedido;
    use BaseDatos\PedidosBD as PedidosBD;
    use BaseDatos\Conexion as Conexion;
    use BaseDatos\CuentaBD as Cuentas;
    use BaseDatos\LineaPedidoBD as Lineas;
    use Modelo\Envio as Envio;

class ControladoraPedidos
{
	private $pedidos;
    private $mensaje;
    private $listado;

	function __construct()
	{
		$this->pedidos=PedidosBD::getInstance();
        $this->listado=array();
	}

    public function DescargarPdf()
    {
        require(ROOT.'Vistas/facturapdf.php');
    }
	public function index ()
        {
            
            $listado=$this->pedidos->getListaPedidos();
            require(ROOT.'Vistas/administrador.php');
            Require(ROOT.'Vistas/pedidosAdmin.php');
        }
        public function buscarPorFecha($fecha)
        {
            $listado=$this->pedidos->buscarPorFecha($fecha);
            require(ROOT.'Vistas/administrador.php');
            Require(ROOT.'Vistas/pedidosAdmin.php');
        }
        public function buscarPorSucursal($sucursal)
        {
            $listado=$this->pedidos->buscarPorSucursal($sucursal);
            require(ROOT.'Vistas/administrador.php');
            Require(ROOT.'Vistas/pedidosAdmin.php');
        }
        public function buscarPorCliente($email)
        {
            $listado=$this->pedidos->buscarPorCliente($email);
            require(ROOT.'Vistas/administrador.php');
            Require(ROOT.'Vistas/pedidosAdmin.php');
        }
        public function index2()
        {   
        $lista=$_SESSION['CuentaLogueada'];
            $lineas=$_SESSION['CarritoVirtual'];
            require(ROOT.'Vistas/pag-principal.php');
            
        }
        public function verFactura($id)
        {
            $objeto=$this->pedidos->buscar($id);
            $usuarioCuenta=Cuentas::getInstance();
            $lineasPed=Lineas::getInstance();
            $pedidoOK=$objeto;
            $cuenta=$usuarioCuenta->buscar($objeto->getCuenta()->getID());
            $lineas=$lineasPed->getLineasPedidoPorUsuario($pedidoOK->getID());//$_SESSION['CarritoVirtual'];
           require(ROOT.'Vistas/factura.php');


        }
        public function MensajeError()
        {
            $msj='No hay un pedido Tramitado';
             echo '<script language="javascript">alert("' . $msj . '");</script>';
             $this->index2();

        }

        public function consultarLitros($fecha1,$fecha2,$nombreCerveza)
        {
            try
            {
                $objetoPedido=new Pedido();
               
            }
            catch(PDOException $e)
            {
                
            }

        }
       
        public function setNuevoEstado($id,$estado)
        {
            $pedido=$this->pedidos->buscar($id);
        
        $pedido->setEnvio($estado);
        $this->pedidos->update($pedido);
                     $this->index();

        }
        public function setNuevoMetodo($id,$metodo)
        {
            $pedido=$this->pedidos->buscar($id);
            $pedido->setMetodo($metodo);
            $this->pedidos->update($pedido);
             $this->index();
        }
       
		public function nuevoPedido($id_cuenta,$nombreSucu,$DomicilioSucu,$Metodo) 
        { 
            try
            {
                $envio="recibido";
                $fecha=date("d/m/Y");
                $id='';
                $total='0';
                $objetoPedido=new Pedido($id,$id_cuenta,$envio,$DomicilioSucu,$Metodo,$fecha,$total,$nombreSucu);
               $idd= $this->pedidos->insert($objetoPedido);
                $objetoPedido->setID($idd);
                $_SESSION['PedidoEnSession']=$objetoPedido;
                            $lineasPed=Lineas::getInstance();
                            $idLinea=0;
                foreach ($_SESSION['CarritoVirtual'] as $key => $value) {
                    $value->setIDpedido($idd);
                    $idLinea=$lineasPed->insert($value);
                    $value->setID($idLinea);
                }
                foreach ($_SESSION['CarritoVirtual'] as $key => $value) {
                                    unset($value);
                                }
                $msj='Gracias por su Compra';
                 echo '<script language="javascript">alert("' . $msj . '");</script>';
                $user=$_SESSION['CuentaLogueada'];
                require(ROOT.'Vistas/pag-principal.php');

            }
            catch(PDOException $e)
            {   

            }     
        }
        public function buscarPedido()
        {
            try
            {

            }
            catch(PDOException $e)
            {

            }
            finally
            {

            }

        }
     
}
 ?>