<?php namespace  Controladoras; 

    use Modelo\LineaPedido as Linea;
    use Modelo\Cliente as Cliente;
    use BaseDatos\LineaPedidoBD as LineaPedidoBD;
    use BaseDatos\CervezasBD as Cervezas;
    //use Daos\DaoListaCerveza as Cervezas;
    use BaseDatos\PresentacionBD as Envase;
    use BaseDatos\SucursalesBD as Sucursal;
    use BaseDatos\UsuarioBD as Usuario;


class ControladoraLineaPedido
{
	private $lineas;
	private $cerveza;
	private $envase;
    private $cliente;
    private $carritoVirtual;
    private $sucursal;

	function __construct()
	{
		$this->lineas=LineaPedidoBD::getInstance();
		$this->cerveza=Cervezas::getInstance();
		$this->envase=Envase::getInstance();
        $this->sucursal=Sucursal::getInstance();
    

	}
		public function index()
		{
        $lista=$_SESSION['CarritoVirtual'];
			 require(ROOT.'Vistas/pag-principal.php');
		}
        public function paginaCerveza()
        {
            $lista=$_SESSION['CarritoVirtual'];
             require(ROOT.'Vistas/listacervezas.php');
        }
        public function enviarNavPedidoPrevio()
        {

        }
        public function obtenerImporteProducto($importe,$cantidad,$factor)
        {
            $valorNumerico=($importe*$cantidad)*$factor;

            return $valorNumerico;

        }
        public function eliminarLineaDeSession($id)
        {
                $session = $_SESSION['CarritoVirtual']; 
                $pos=$this->getLineas($id);
                unset($session[$pos]);
                $_SESSION['CarritoVirtual']=$session;
                $this->index();

        }
            public function getLineas($id)
    {
        $pos=0;
            $session =$_SESSION['CarritoVirtual'];
            foreach ($session as $key => $value) {
                                    

                if($value->getID()==$id)
                {
                    return $key;
                }
            }

        throw new Exception("No existe el Tipo de Cerveza '" . $id . "'.");


    }

		public function nuevaLinea($idCerveza,$idEnvase,$cantidad) 
        { 
            $idd='';
            try
            {
               $objectoCerveza= $this->cerveza->buscar($idCerveza);
                $objetoEnvase=$this->envase->buscar($idEnvase);
                $importe=$this->obtenerImporteProducto($objectoCerveza->getPrecioLitro(),$cantidad,$objetoEnvase->getFactor());
                $lineaPedido=new Linea($idd,$objectoCerveza,$objetoEnvase,$cantidad,$importe,0);
               $idd= $this->lineas->insert($lineaPedido);
               $lineaPedido->setID($idd);
            }
            catch(PDOException $e)
            {
                MyDatabaseException($e->getMensagge(),$e->getCode());  
            }    
        }
     public function nuevaLineaMetodoSecundario($idCerveza,$idEnvase,$cantidad) 
        { 
            $idd='';
            $lista=array();
            try
            {
               $objectoCerveza= $this->cerveza->buscar($idCerveza);
                $objetoEnvase=$this->envase->buscar($idEnvase);
                $importe=$this->obtenerImporteProducto($objectoCerveza->getPrecioLitro(),$cantidad,$objetoEnvase->getFactor());
                $lineaPedido=new Linea($idd,$objectoCerveza,$objetoEnvase,$cantidad,$importe,0);
                array_push($_SESSION['CarritoVirtual'],$lineaPedido);
                $this->paginaCerveza();
            }
            catch(PDOException $e)
            {
                MyDatabaseException($e->getMensagge(),$e->getCode());  
            }    
        }
        public function buscarLinea($id)
        {
            try
            {
                $this->lineas->buscar($id);

            }
            catch(PDOException $e)
            {
                 MyDatabaseException($e->getMensagge(),$e->getCode()); 
            }
        }
        public function eliminarLinea($id)
        {
             try
            {
                    $this->lineas->delete($id);
            }
            catch(PDOException $e)
            {
                 MyDatabaseException($e->getMensagge(),$e->getCode()); 
            }
           

        }
        public function modificarLinea($id,$cerveza,$envase,$cantidad,$importe)
        {
             try
            {
                    $new=new LineaPedido($id,$cerveza,$envase,$cantidad,$importe);
                    $this->update($new);
            }
            catch(PDOException $e)
            {
                MyDatabaseException($e->getMensagge(),$e->getCode());     
                    }
                
        }
         public function modificarLineaSession($linea)
         {
            $session = $_SESSION['CarritoVirtual'];
            foreach ($session as $key => $value) {
                if($session[$key]->getID()==$linea->getID())
                {
                    
                    $session[$key]->setID($linea->getID());
                    $session[$key]->setNombreCerveza($linea->getNombreCerveza());
                    $session[$key]->setPrecioLitro($linea->getPrecioLitro());
                    $session[$key]->setDescripcion($linea->getDescripcion()); 
                    $session[$key]->setImagen($linea->getImagen());
                    $session[$key]->setImagen($linea->getImagen());

                }
            }
            $_SESSION['CarritoVirtual']=$session;
            $this->index();
         }
        
    }
?>