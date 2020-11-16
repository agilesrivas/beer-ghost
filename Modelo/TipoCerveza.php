<?php namespace Modelo;



class TipoCerveza 
{
      private $id;
      private $nombreCerveza;
      private $descripcion;
      private $imagen;
      private $precio_litro;
      private $estado;

    function __construct($id,$nombre,$precio,$descrip,$imagen,$estado)
    {
    $this->setID($id);
    $this->setNombreCerveza($nombre);
    $this->setPrecioLitro($precio);
    $this->setDescripcion($descrip);
    $this->setImagen($imagen);
    $this->setEstado($estado);
    }
    public function setEstado($estado)
    {
        $this->estado=$estado;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setImagen($imagen)
    {
        $this->imagen=$imagen;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($value)
    {
        $this->descripcion=$value;
    }
    public function getID()
    {
        return $this->id;
    }
    public function setID($value)
    {
        $this->id=$value;
    }
    public function getNombreCerveza()
    {
        return $this->nombreCerveza;
    }
    public function setNombreCerveza($nombreCerveza)
    {
        $this->nombreCerveza = $nombreCerveza;

        return $this;
    }
    public function getPrecioLitro()
    {
        return $this->precio_litro;
    }
    public function setPrecioLitro($precio_litro)
    {
        $this->precio_litro = $precio_litro;

        return $this;
    }
}












  ?>