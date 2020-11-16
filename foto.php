<?php 

if(isset($_FILES)) {
        $imageDirectory = 'directorio/';

    if(!file_exists($imageDirectory))
        mkdir($imageDirectory);

    if((isset($_FILES['imagen'])) && ($_FILES['imagen']['name'] != '')){

        $nombreArchivo= basename($_FILES['imagen']['name']);

        $file = $imageDirectory . $nombreArchivo;   

        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);


            if(!file_exists($file)){
                
                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $file)){  
  
                        //$imagen = str_replace("../", "", $file);

                    }
                    else
                        echo 'No se pudo subir el archivo.';
            }
            else
                echo 'el archivo ya existe.';

    }
}  ?>