<?php namespace Controladoras;
 
 //use Daos\DaoListaEnvases as ListaEnvases;
 use BaseDatos\PresentacionBD as ListaEnvases;
     use Modelo\Presentacion as Presentacion;

class ControladoraTipoEnvase
{
	private $tiposDeEnvase;

	public function __construct()
	{
		$this->tiposDeEnvase=ListaEnvases::getInstance();
	}

	public function index()
	{
		$id= $this->tiposDeEnvase->ultimoIDCargado($this->tiposDeEnvase);
            $listado=$this->tiposDeEnvase->getListaPresentaciones();
              if(!empty($this->mensaje)){
                    echo '<script language="javascript">alert("' . $this->mensaje . '");</script>'; 
                }
            require(ROOT.'Vistas/administrador.php');
            Require(ROOT.'Vistas/envaseAdmi.php');
	}
    
    public function guardarImagen($directorio,$urlImg)
    {
            $imageDirectory = $directorio.'/';

            if(!file_exists($imageDirectory))
                 mkdir($imageDirectory);

    if((isset($_FILES['fileToUpload'])) && ($_FILES['fileToUpload']['name'] != '')){
        
        $extensionesPermitidas= array('png', 'jpg', 'gif');
        $tamanioMaximo= 5000000;
        $nombreArchivo= basename($_FILES['fileToUpload']['name']);

        $file = $imageDirectory . $nombreArchivo;   //la direccion del archivo      

        //Obtenemos la extensión del archivo. No sirve para comprobar el verdadero tipo del archivo
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        if(in_array($fileExtension, $extensionesPermitidas)){

            if(!file_exists($file)){

                if($_FILES['fileToUpload']['size'] < $tamanioMaximo){ //Menor a 5 MB
                
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)){    //guarda el archivo subido en el directorio 'images/' tomando true si lo subio, y false si no lo hizo

                        echo 'el archivo '. $nombreArchivo .' fue subido correctamente.';

                        echo '<img src="'. $file .'" border="0" title="'.$nombreArchivo.'" alt="Imagen"/>';
                    }
                    else
                        echo 'No se pudo subir el archivo.';
                }
                else
                    echo 'el archivo es demasiado grande.';
            }
            else
                echo 'el archivo ya existe.';
        }
        else
            echo 'no es imagen.';
    }
    }
	public function nuevoEnvase($id,$tipo,$factor,$capacidad,$recarga,$imagen,$estado) 
    { 
        $mensaje="";
        try
        {
            $objetoEnvase=new Presentacion($id,$tipo,$factor,$capacidad,$recarga,$imagen,$estado);
            $this->tiposDeEnvase->insert($objetoEnvase);
            $this->guardarImagen('ImgEnvases',$imagen);
        }
        catch(Exception $e)
        {
                $mensaje=$e->getMessage();
        }
        finally
        {
           if(!empty($mensaje))
           {
                    echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
            }
             $this->index();
        }        
    }
    public function buscarEnvase($id)
    {
        $mensaje="";
        try
        {
            $_SESSION['Envase']=$this->tiposDeEnvase->buscar($id);
        }
        catch(PDOException $error)
        {
            $mensaje=$error->getMessage();
        }
        finally
        {
            if(!empty($mensaje))
            {
                echo '<script lenguaje="javascript">alert("'.$mensaje.'");</script>';
            }
            $this->index();
        }
    }
    public function modificarEnvase($id,$tipo,$factor,$capacidad,$recarga,$imagen,$estado) 
    {
        $mensaje="";
        try
        {
            $envaseModif=new Presentacion($id,$tipo,$factor,$capacidad,$recarga,$imagen,$estado);
            $this->tiposDeEnvase->buscarCapacidad($capacidad);
            $this->tiposDeEnvase->update($envaseModif);
        }
        catch(PDOException $e)
        {
         $mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
        }
        catch(Exception $ee)
        {
                $mensaje=$ee->getMessage();
        }
        finally
        {
            if(!empty($mensaje))
            {
             echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
            }
             $this->index();
        }
    }
    public function eliminarEnvase($id)
    {
        try
        {
            $this->tiposDeEnvase->delete($id);
        }
        catch(PDOException $e)
        {
         $mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
        }
        catch(Exception $e)
        {
               $mensaje=$e->getMessage();
        }
        finally
        {         
         if(!empty($mensaje))
         {
            echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
         }
            $this->index();
        }

    }
}

 ?>
