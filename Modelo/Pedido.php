<?php namespace Modelo;

class Pedido {
 
 private $id;
 private $id_cuenta;
  private $envio;
  private $domicilio;
  private $metodo;
  private $linea;
  private $fecha;
  private $total;
  private $nombreEmpresa;



function __construct($id='',$id_cuenta,$envio,$domicilio,$metodo,$fecha='',$total,$nombre)
{
    $this->setID($id);
    $this->setCuenta($id_cuenta);
    $this->setEnvio($envio);
    $this->setDomicilioSucu($domicilio);
    $this->setMetodo($metodo);
    $this->linea=array();
    $this->setFecha($fecha);
    $this->setTotal($total);
    $this->setNombreEmpresa($nombre);

}
public function setCuenta($value)
{
    $this->id_cuenta=$value;
}
public function getCuenta()
{
    return $this->id_cuenta;
}
public function getDomicilioSucu()
{
    return $this->domicilio;
}
public function setDomicilioSucu($value)
{
    $this->domicilio=$value;
}
public function getMetodo()
{
    return $this->metodo;
}
public function setMetodo($value)
{
    $this->metodo=$value;
}
public function setID($value)
{
    $this->id=$value;
}
public function getID()
{
    return $this->id;
}


    public function getEnvio()
    {
        return $this->envio;
    }
    public function setEnvio($envio)
    {
        $this->envio = $envio;
    }
    public function getLinea()
    {
        return $this->linea;
    }
    public function setLinea($linea)
    {
        $this->linea = $linea;

        return $this;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
    public function getTotal()
    {
        return $this->total;
    }
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }
}









  ?>