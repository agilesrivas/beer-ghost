<?php namespace Daos; 
use Exception;
 /**;
 * 
 */

	 class DaoListaCerveza extends SingletonDao implements DaosCollection
	 {
	 	 private $listaCerveza;
	 

	 	function __construct()
	 	{
	 		$listaCerveza=array();
	 		
	 	}
	 	public function ultimoIDCargado($array)
	 	{
	 		$tam=sizeof($array);
	 		if($tam===0)
	 		{
	 			$id=1;
	 		}
	 		else
	 		{
	 			$id=$tam+1;
	 		}
	 		return $id;
	 	}
	 	public function insert($objetoCerveza)
	 	{
	 		$msj='inserto correctamente';
	 		try
	 		{
	 			$this->listaCerveza = $this->getListaCerveza();
	 			$id=$this->ultimoIDCargado($this->listaCerveza);
	 			$this->buscar($objetoCerveza->getNombreCerveza());
	 			$objetoCerveza->setID($id);
				array_push($this->listaCerveza, $objetoCerveza);
				$this->setListaCerveza($this->listaCerveza);
	 		}
	 		catch(Exception $e)
	 		{
	 		  $msj=$e->getMessage();
	 		}	
	 		finally
	 		{
	 			
                 if(!empty($msj)){
                    echo '<script language="javascript">alert("' . $msj . '");</script>'; 
                }
	 		} 	
	 	}
		public function buscar($ID)
		{
			$this->listaCerveza = $this->getListaCerveza();
	       foreach ($this->listaCerveza as $key => $value) {
	       	if($value->getID()!=$ID)
	       	{
	       		throw new Exception("No existe la Cerveza", 1);

	       	}
	       	else
	       	{
				return $this->listaCerveza[$key];
	       	}
	 	}
	 }
		 public function delete($id)
		 {
		 	try
		 	{
		 		$this->listaCerveza = $this->getListaCerveza();	
		 		$pos=$this->getPosTipoCerveza($id);
		 		unset($this->listaCerveza[$pos]);
		    	$this->setListaCerveza($this->listaCerveza);
		 	}
		 	catch(Exception $e)
		 	{
		 		$e->getMessage();
		 	}
		 	
		 }
		 public function update($objetoCervezanuevo)
		 {
		 	$this->listaCerveza = $this->getListaCerveza();
		 	foreach ($this->listaCerveza as $key => $value) {
	       	  	if($this->listaCerveza[$key]->getID()==$objetoCervezanuevo->getID())
	       	  	{
	       	  		$this->listaCerveza[$key]->setID($objetoCervezanuevo->getID());
					$this->listaCerveza[$key]->setNombreCerveza($objetoCervezanuevo->getNombreCerveza());
					$this->listaCerveza[$key]->setPrecioLitro($objetoCervezanuevo->getPrecioLitro());
					$this->listaCerveza[$key]->setDescripcion($objetoCervezanuevo->getDescripcion()); 
					$this->listaCerveza[$key]->setImagen($objetoCervezanuevo->getImagen());
				}
		 	}
	   		$this->setListaCerveza($this->listaCerveza);
		 }
	 	public function getListaCerveza()
	 	{
	 		//unset($_SESSION['TipoCerveza']);
	 		if(!isset($_SESSION['TipoCerveza']))
	 		{
		 		$_SESSION['TipoCerveza']=array();
	 		}
	 		return $_SESSION['TipoCerveza'];
	 	}
	 	public function setListaCerveza($value) {
	 		$_SESSION['TipoCerveza'] = $value;
	 	}
	 	
	 
	public function getPosTipoCerveza($id)
	{
		$pos=0;
		 	$this->listaCerveza = $this->getListaCerveza();
		 	//echo sizeof($this->listaCerveza);	
			foreach ($this->listaCerveza as $key => $value) {
									

				if($value->getID()==$id)
				{
					echo $key;
					return $key;
				}
			}

		throw new Exception("No existe el Tipo de Cerveza '" . $id . "'.");


	}
}
	 ?>	
