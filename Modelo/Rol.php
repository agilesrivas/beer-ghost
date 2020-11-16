<?php namespace Modelo;

class Rol {
    
    private $id;
	private $descripcion;

   


   function __construct($id='',$descripcion)
   {
    $this->setID($id); 
    $this->setDescripcion($descripcion);

   }

   
public function setID($value)
{
    $this->id=$value;
}
public function getID()
{
    return $this->id;
}

    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}









  ?>