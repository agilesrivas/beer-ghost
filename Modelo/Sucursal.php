<?php namespace Modelo;

class Sucursal {

    private $id;
    private $nombre;
	private $domicilio;
	private $latitud;
	private $longitud;
    private $estado;


function __construct($id,$nombre,$domicilio,$latitud,$longitud,$estado)
{
    $this->setID($id);
    $this->setNombre($nombre);
    $this->setDomicilio($domicilio);
    $this->setLatitud($latitud);
    $this->setLongitud($longitud);
    $this->setEstado($estado);
}
public function setNombre($value)
{
    $this->nombre=$value;
}
public function getNombre()
{
   return $this->nombre;
}
public function setEstado($estado)
{
    $this->estado=$estado;
}
public function getEstado()
{
    return $this->estado;
}
public function setID($value)
{
    $this->id=$value;
}
public function getID()
{
    return $this->id;
}


    
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

   
    public function getLatitud()
    {
        return $this->latitud;
    }

    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

   
    public function getLongitud()
    {
        return $this->longitud;
    }

   
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }
}









  ?>