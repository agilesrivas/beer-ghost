<?php namespace BaseDatos;

use PDOException;
use BaseDatos\RolBD as RolBD;
    use Modelo\Rol as Rol;

class RolBD extends SingletonDao implements DaosCollection
{
  public function ultimoIDCargado($array)
  {

  }	
  public function getRoles()
  {
  	$Roles=array();
  	try
  	{
  		$modelo=new Conexion();
  		$conexion=$modelo->get_Conexion();
  		$sql='SELECT * FROM roles';
  	$statement=$conexion->prepare($sql);
			$statement->execute();

			while($row=$statement->fetch())
			{
				$objetoRol=new Envio($row['id_Rol'],$row['descripcion']);
				$objetoRol->setID($row['id_Rol']);
				array_push($Roles,$objetoRol);
			}
		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
		
			return $Roles;
	}
	public function update($id)
	{

	}
	public function insert($rol)
	{
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();
			$sql='INSERT INTO roles (descripcion) VALUES (:tipo)';
			$statement=$conexion->prepare($sql);
			
			$estado=$rol->getDescripcion();
			$statement->bindParam(':tipo',$estado);
			$statement->execute();
		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
	}
	public function buscarPorTipo($estado)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM roles WHERE descripcion=:descrip';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":descrip",$estado);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new Rol($row['id_Rol'],$row['descripcion']);
			
			return $objeto;
		}
		else
		{
			throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}
		

	}
	public function buscar($idRol)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM roles WHERE id_Rol=:idRol';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idRol",$idRol);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new Rol($row['id_Rol'],$row['descripcion']);
			
			return $objeto;
		}
		else
		{
			throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}
		

	}
	public function delete($idRol)
	{	
	
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql='DELETE FROM roles WHERE id_Rol=:idRol';
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idRol",$idRol);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}
		
	}
}

 ?>