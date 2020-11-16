<?php namespace Controladoras;

 

    use Daos\DaoListaCerveza as ListaCerveza;
    use BaseDatos\CervezasBD as Cervezas;
    use Modelo\TipoCerveza as TipoCerveza;
    use Exception;



	class ControladoraTipoCerveza 
	{
	  
        private $daoListaCerveza;
        protected $mensaje;


        public function __construct ()
        {
          // $this->daoListaCerveza=ListaCerveza::getInstance();
           $this->daoListaCerveza=Cervezas::getInstance();
        }
       
        public function index ()
        {
            $id= $this->daoListaCerveza->ultimoIDCargado($this->daoListaCerveza);
            $listado=$this->daoListaCerveza->getListaCerveza();
              if(!empty($this->mensaje)){
                    echo '<script language="javascript">alert("' . $this->mensaje . '");</script>'; 
                }
            require(ROOT.'Vistas/administrador.php');
            Require(ROOT.'Vistas/cervezaAdmin.php');
        }
         public function guardarImagen($directorio,$urlImg)
    {
          
   if(isset($_FILES)) {
        $imageDirectory = 'directorio/';

    if(!file_exists($imageDirectory))
        mkdir($imageDirectory);

    if((isset($_FILES['imagen'])) && ($_FILES['imagen']['name'] != '')){

        $nombreArchivo= basename($_FILES['imagen']['name']);

        $file = $imageDirectory . $nombreArchivo;   

        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);


            if(!file_exists($file)){
                
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)){  
  
                        $imagen = str_replace("../", "", $file);

                    }
                    else
                        echo 'No se pudo subir el archivo.';
            }
            else
                echo 'el archivo ya existe.';

    }
} 
    }
        public function nuevaCerveza($id,$nombre,$precio,$estado,$img,$descripcion) 
        { 
            
            try
            {
               

                $objetoCerveza=new TipoCerveza($id,$nombre,$precio,$descripcion,$img,$estado);
                $this->daoListaCerveza->insert($objetoCerveza);
                $this->index();
            }
            catch (PDOException $e)
            {
                $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
                $this->index();
            }
            catch(Exception $e)
            {
                $this->mensaje=$e->getMessage();
            }      
                 
        }
        public function buscarCerveza($id)
        {   
           
            try
            {

               $_SESSION['ObjetosEncontrados']=$this->daoListaCerveza->buscar($id);
           }
            catch (Exception $e)
            {
                $this->mensaje=$e->getMessage();
            }
            catch(PDOException $e)
            {
                $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());

            }
        }
        public function modificarCerveza($id,$nombre,$precio_litro,$estado,$imagen,$descripcion)
        {
            
            try
            {
                $CervezaModif=new TipoCerveza($id,$nombre,$precio_litro,$descripcion,$imagen,$estado);
                $this->daoListaCerveza->buscar($nombre);
                $this->daoListaCerveza->update($CervezaModif);
                $this->index();
            }
            catch(Exception $e)
            {
               $mensaje=$e->getMessage();
            }
            catch(PDOException $e)
            {
                $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());

            }
        }
        public function eliminarCerveza($id)
        {
            try
            {
                $this->daoListaCerveza->delete($id);
                $this->index();
            }
           catch(Exception $e)
            {
               $mensaje=$e->getMessage();
            }
            catch(PDOException $e)
            {
                $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
            }

        }





	}

?>