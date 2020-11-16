<?php namespace Controladoras;

use BaseDatos\RolBD as RolBD;
use Modelo\Rol as Rol;
use Exception;
use PDOException;

class ControladoraRol
{
	private $roles;

	function __construct()
	{
		$this->roles=RolBD::getInstance();
	}
	public function index()
	{   
		require(ROOT.'Vistas/Administrador.php');
	}
    
		public function nuevoRol($id,$estado) 
        { 
            $mensaje="";
            try
            {
            $objectRol=new Rol($id,$estado) ;
            $this->roles->insert($objectRol);
            }
            catch(Exception $e)
            {
                $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }
            finally
            {
				//instruccion que debe hacerse;
			}   
                 
        }

        public function buscarRol($id)
        {
            $mensaje="";
            try
            {
                $_SESSION['RolEncontrado']=$this->roles->buscar($id);
            }
            catch(Exception $e)
            {
                $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }
            finally
            {
                if(!empty($mensaje))
                {
                    echo '<<script lenguaje="javascript">alert("'.$mensaje.'");</script>';
                }
            }
        }
         public function modificarRol($id,$estado)
        {
            $mensaje="";
            var_dump($estado);
            try
            {
                $rol=new Rol($id,$estado);
                echo '<pre>';
                $this->roles->update($rol);
                echo '</pre>';
            }
            catch(Exception $e)
            {
               $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }
            finally
            {

                if(!empty($mensaje)){
                    echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
                }
                $this->index();
            }
        }
        public function eliminarRol($id)
        {
            try
            {

                $this->roles->delete($id);
            }
           catch(Exception $e)
            {
               $mensaje=$e->getMessage();
            }
            catch(PDOException $error)
            {
                $mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
            }
            finally
            {
                
                if(!empty($mensaje)){
                    echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
                }
            }

        }

}
 ?>