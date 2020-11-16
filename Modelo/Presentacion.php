<?php namespace Modelo;

class Presentacion {

  private $id;
  private $descripEnvase;
  private $factor;
  private $litrosDeEnvasado;
  private $recarga;
  private $imagen;
  private $estado;


 function __construct($id,$descrip,$fact,$litros,$recarBool,$imagen,$estado)
 {
    $this->setID($id);
    $this->setDescripEnvase($descrip);
    $this->setFactor($fact);
    $this->setLitrosDeEnvasado($litros);
    $this->setRecarga($recarBool);
    $this->setImagen($imagen);
    $this->setEstado($estado);

 }
    public function setEstado($value)
    {
        $this->estado=$value;
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
 
    public function setID($value)
    {
        $this->id=$value;
    }
    public function getID()
    {
      return $this->id;
    }
    public function getDescripEnvase()
    {
        return $this->descripEnvase;
    }
    public function setDescripEnvase($descripEnvase)
    {
        $this->descripEnvase = $descripEnvase;
        return $this;
    }
    public function getFactor()
    {
        return $this->factor;
    }
    public function setFactor($factor)
    {
        $this->factor = $factor;
        return $this;
    }
    public function getLitrosDeEnvasado()
    {
        return $this->litrosDeEnvasado;
    }
    public function setLitrosDeEnvasado($litrosDeEnvasado)
    {
        $this->litrosDeEnvasado = $litrosDeEnvasado;
        return $this;
    }
    public function getRecarga()
    {
        return $this->recarga;
    }
    public function setRecarga($recarga)
    {
        $this->recarga = $recarga;

        return $this;
    }
}









  ?>