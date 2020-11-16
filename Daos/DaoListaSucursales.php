<?php namespace Daos;
 
 /**
 * 
 */
 class DaoListaSucursales extends SingletonDao implements DaosCollection
 {
 	 private $listaSucursales;
 	function __construct()
 	{
 		$listaSucursales=array();
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
 	public function insert($Sucursal)
 	{
 		$mensaje='Inserto Sucursal Correctamente';
 		try
 		{
 		$this->listaSucursales=$this->getSessionForLista();
 		$id=$this->ultimoIDCargado($this->listaSucursales);
 		$this->buscar($Sucursal->getID());
 		$Sucursal->setID($id);
      	array_push($this->listaSucursales, $objetoSucursal);
       	$this->setSessionForLista($this->listaSucursales);
 		}
 		catch(Exception $e)
 		{
 			$mensaje=$e->getMessage();
 		}
 		finally
 		{
 			 if(!empty($mensaje)){
                    echo '<script language="javascript">alert("' . $mensaje . '");</script>'; 
                }
 		}

 	}
 	 public function buscar($id)
 	 {
 		$this->listaSucursales=$this->getSessionForLista();
 		foreach ($this->listaSucursales as $key => $value) {
 			if($value->getID()==$id)
 			{
 				return $this->listaSucursales[$key];
 			}
 			else
 			{
 				throw new Exception("Sucursal Inexistente", 1);
 			}
 		}
              
	 }

	 public function delete($id)
     {
     	try
		 	{
		 		$this->listaSucursales = $this->getSessionForLista();	
		 		$pos=$this->getPosTipoSucursal($id);
		 		unset($this->listaSucursales[$pos]);
		    	$this->setListaCerveza($this->listaSucursales);
		 	}
		 	catch(Exception $e)
		 	{
		 		$e->getMessage();
		 	}

	 }
       
	public function update($newSuc)
	{
		$this->listaSucursales = $this->getSessionForLista();
		 	foreach ($this->listaSucursales as $key => $value) {
	       	  	if($this->listaSucursales[$key]->getID()==$newSuc->getID())
	       	  	{
	       	  		$this->listaSucursales[$key]->setID($newSuc->getID());
					$this->listaSucursales[$key]->setNombreCerveza($newSuc->getNombreCerveza());
					$this->listaSucursales[$key]->setPrecioLitro($newSuc->getPrecioLitro());
					$this->listaSucursales[$key]->setDescripcion($newSuc->getDescripcion()); 
					$this->listaSucursales[$key]->setImagen($newSuc->getImagen());
				}
		 	}
	   		$this->setListaCerveza($this->listaSucursales);
		 }
       	 	
       }
 	public function getSessionForLista()
 	{
 		//unset($_SESSION['TiposSucursal']);
 		if(!isset($_SESSION['TiposSucursal']))
 		{
	 		$_SESSION['TiposSucursal']=array();
 		}
 		return $_SESSION['TiposSucursal'];
 	}
 	public function setSessionForLista($value) {
 		$_SESSION['TiposSucursal'] = $value;
 	}

 	public function getPosTipoSucursal($id)
	{
		$pos=0;
		 	$this->listaSucursales = $this->getSessionForLista();
		 	//echo sizeof($this->listaCerveza);	
			foreach ($this->listaSucursales as $key => $value) {
									

				if($value->getID()==$id)
				{
					return $key;
				}
			}

		throw new Exception("No existe el Tipo de Cerveza '" . $id . "'.");


	}



 }



 ?>