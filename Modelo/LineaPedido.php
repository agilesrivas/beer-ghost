<?php namespace Modelo;

class LineaPedido {

    private $id;
  private $presentacion;
  private $tipoCerveza;
  private $cantidad;
  private $importe;
  private $id_pedido;


	
function __construct($id='',$tipoCerveza,$presentacion,$cantidad,$importe,$id_pedido)
{
    $this->setID($id);
    $this->setTipoCerveza($tipoCerveza); 
    $this->setPresentacion($presentacion);
    
    $this->setCantidad($cantidad);
    $this->setImporte($importe);
    $this->setIDpedido($id_pedido);

}


public function setIDpedido($setPedido)
{
    $this->id_pedido=$setPedido;
}
public function getIDpedido()
{
    return $this->id_pedido;
}
public function setID($value)
{
    $this->id=$value;
}
public function getID()
{
    return $this->id;
}

 
    public function getPresentacion()
    {
        return $this->presentacion;
    }

   
    public function setPresentacion($presentacion)
    {
        $this->presentacion = $presentacion;

    }

   
    public function getTipoCerveza()
    {
        return $this->tipoCerveza;
    }

    
    public function setTipoCerveza($tipoCerveza)
    {
        $this->tipoCerveza = $tipoCerveza;

    }

  
    public function getCantidad()
    {
        return $this->cantidad;
    }

 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

    }

   
    public function getImporte()
    {
        return $this->importe;
    }

   
    public function setImporte($importe)
    {
        $this->importe = $importe;

    }
}









  ?>