<?php namespace Daos;
 
 /**
 * 
 */
 class DaoListaUsuarios extends SingletonDao implements DaosCollection
 {
 	 private $listaUsuarios;
 	function __construct()
 	{
 		$listaUsuarios=array();
 	}
 	public function insertDato(Usuario $objetoUsuario)
 	{
       array_push($getListaUsuario(), $objetoCerveza);

 	}
 	 public function buscarDato($id)
 	 	{
        
 	 	}
       	 public function borrarDato($dato,$id)
       	 {

       	 }
       	 public function updateDato($usuarioviejo,$usuarioNuevo)
       	 {
       	 	
       	 }
 	public function getListaUsuario()
 	{
 		return $this->$listaUsuarios;
 	}


 }



 ?>