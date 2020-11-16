<?php namespace Daos;

class DaosPedidos
{

 	private $listapedidos;

 	function __construct()
 	{

 	}

public function insertDato($objetoPedido)
 	{
 		
 		$this->listapedidos = $this->getListaCerveza();
       array_push($this->listapedidos, $objetoPedido);
      $this->setListaCerveza($this->listapedidos);
 	}
	public function buscarDato($objetoPedido)
 	{
       foreach ($this->listapedidos as $key => $value){
       	  
   		}
 	}
	 public function borrarDato($objetoPedido)
	 {
	 	$this->listapedidos = $this->getListaCerveza();

	 }
	 public function updateDato($pedidoViejo,$pedidoNuevo)
	 {
	 	$this->listapedidos = $this->getListaCerveza();
	 	
	 }
 	public function getSessionForLista()
 	{

 		if(!isset($_SESSION['Pedidos']))
 		{
	 		$_SESSION['Pedidos']=array();
 		}
 		return $_SESSION['Pedidos'];
 	}
 	public function setListaCerveza($value) {
 		$_SESSION['Pedidos'] = $value;
 	}




}




 ?>