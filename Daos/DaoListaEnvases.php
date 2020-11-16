<?php namespace Daos;
 
 /**
 * 
 */
 class DaoListaEnvases extends SingletonDao implements DaosCollection
 {
 	 private $listaenvases;
 	function __construct()
 	{
 		$listaenvases=array();
 	}
      public function ultimoIDCargado($array)
            {
                  $tam=sizeof($array);
                  $ultimoObjeto=$array[$tam-1];
                  print_r($ultimoObjeto->getID());
                  return $ultimoObjeto->getID();
            }
 	public function insert($objetoEnvase)
 	{
 	    $this->listaenvases=getSessionForLista();
          $id=$this->ultimoIDCargado($this->listaenvases);
          $dada=$this->buscar($objetoEnvase->getID());
          $objetoEnvase->setID($id+1);
          array_push($this->listaenvases, $objetoEnvase);
          $this->setSessionForLista($this->listaenvases);

 	}
 	 public function buscar($id)
 	 {
        
 	 }
       public function delete($id)
       {

       }
       public function update($envaseNuevo)
       {
       	 	
       }
 	 public function getSessionForLista()
	 {
	     if(!isset($_SESSION['TiposEnvases']))
		{
            $_SESSION['TiposEnvases']=array();
		}

	   return $_SESSION['TiposEnvases'];
	 }
	  public function setSessionForLista($lista)
	  {
		$_SESSION['TiposEnvases']=$lista;
	  }

}

 ?>