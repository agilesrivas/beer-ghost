1<?php namespace Controladoras;

use BaseDatos\EnvioDB as EnvioDB;
use Modelo\Envio as Envio;
use Exception;
use PDOException;

class ControladoraEnvio
{
	private $envios;

	function __construct()
	{
		$this->envios=EnvioDB::getInstance();
	}
	public function index()
	{
		//vista principal
	}
		public function nuevoEnvio($id,$estado) 
        { 
            $mensaje="";
            try
            {
            $objetEnv=new Envio($id,$estado) ;
            $this->envios->insert($objetEnv);
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

        public function buscarEnvio($id)
        {
            $mensaje="";
            try
            {
                $_SESSION['EnvioEncontrado']=$this->envios->buscar($id);
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
         public function modificarEnvio($id,$estado)
        {
            $mensaje="";
            try
            {
                $envio=new Envio($id,$estado);
                $envio->setID($id);
                $this->envios->update($envio);
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
               // $this->index();
            }
        }
        public function eliminarEnvio($id)
        {
            try
            {

                $this->envios->delete($id);
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