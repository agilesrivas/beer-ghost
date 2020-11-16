<?php namespace Controladoras;

//use Daos\DaoListaSucursales as ListaSucursales;
use BaseDatos\SucursalesBD as ListaSucursales;
use Modelo\Sucursal as Sucursal;
use Exception;
use PDOException;

class ControladoraSucursales
{
	private $Sucursales;

	function __construct()
	{
		$this->Sucursales=ListaSucursales::getInstance();
	}
	public function index()
    {
            $listado=$this->Sucursales->getListaSucursales();
            require(ROOT.'Vistas/administrador.php');
            Require(ROOT.'Vistas/sucursalAdmin.php');
    }
    public function vistaMapa()
    {
        require(ROOT.'Vistas/sucursalesmaps.php');
    }

		public function nuevaSucursal($id,$nombre,$direccion,$longitud,$latitud,$estado) 
        { 
            $mensaje="";
            try
            {
            $objetoSucursal=new Sucursal($id,$nombre,$direccion,$longitud,$latitud,$estado) ;
            $this->Sucursales->insert($objetoSucursal);
            $this->index();
            }
            catch(Exception $e)
            {
                $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }
            
                 
        }

        public function buscarSucursal($id)
        {
            $mensaje="";
            try
            {
                $_SESSION['SucursalEncontrada']=$this->Sucursales->buscar($id);
            }
            catch(Exception $e)
            {
                $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }
            
        }
         public function modificarSucursal($id,$nombre,$direccion,$longitud,$latitud,$estado)
        {
            $mensaje="";
            try
            {
                $sucursal=new Sucursal($id,$nombre,$direccion,$longitud,$latitud,$estado);
                $this->Sucursales->update($sucursal);
                $this->index();
            }
            catch(Exception $e)
            {
               $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }
            
        }
        public function eliminarSucursal($id)
        {
            try
            {

                $this->Sucursales->delete($id);
                $this->index();
            }
           catch(Exception $e)
            {
               $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }

        }

}
 ?>