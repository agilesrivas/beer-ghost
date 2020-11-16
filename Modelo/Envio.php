<?php namespace Modelo;

class Envio {

    private $id;
	private $estado;

	function __construct($id,$estado)
    {
        $this->setID($id);
        $this->setEstado($estado);
        
    }

public function setID($value)
{
    $this->id=$value;
}
public function getID()
{
    return $this->id;
}
   
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}









  ?>