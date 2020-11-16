<?php namespace Modelo;

class Usuario {

    private $id;
	
	private $nombre;
    private $apellido;
	private $direccionDefault;
	private $direccionHogar;
    private $imagen;
    private $cuenta;
    private $estado;

	function __construct($id,$nombre,$apellido,$direccionDefault,$direccionHogar,$imagen,$estado,$cuenta)
    {
        $this->setID($id);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setDireccionEnvio($direccionDefault);
        $this->setDireccionHogar($direccionHogar);
        $this->setImagen($imagen);
        $this->setEstado($estado);
        $this->setCuenta($cuenta);
        

    }
    public function setImagen($value)
    {
        $this->imagen=$value;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function setEstado($value)
    {
        $this->estado=$value;
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
 public function setCuenta($value)
 {
    $this->cuenta=$value;

 }
 public function getCuenta()
 {
    return $this->cuenta;
 }
    public function getApellido()
    {
        return $this->apellido;
    }

    
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

   
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    
    public function getDireccionEnvio()
    {
        return $this->direccionDefault;
    }

    
    public function setDireccionEnvio($direccionDefault)
    {
        $this->direccionDefault = $direccionDefault;
    }
    public function getDireccionHogar()
    {
        return $this->direccionHogar;
    }
    public function setDireccionHogar($direccionHogar)
    {
        $this->direccionHogar = $direccionHogar;
    }
}









  ?>