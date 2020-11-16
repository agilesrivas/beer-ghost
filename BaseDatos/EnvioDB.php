<?php namespace BaseDatos;
use PDOException;
use BaseDatos\EnvioDB as EnvioDB;
    use Modelo\Envio as Envio;

class EnvioDB extends SingletonDao implements DaosCollection
{
  public function ultimoIDCargado($array)
  {

  }	
  public function getListaEnvios()
  {
  	$estadosEnvio=array();
  	try
  	{
  		$modelo=new Conexion();
  		$conexion=$modelo->get_Conexion();
  		$sql='SELECT * FROM envios';
  	$statement=$conexion->prepare($sql);
			$statement->execute();

			while($row=$statement->fetch())
			{
				$objetoEnvio=new Envio($row['id_Envio'],$row['estado']);
				$objetoEnvio->setID($row['id_Envio']);
				array_push($estadosEnvio,$objetoEnvio);
			}
		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
		
			return $estadosEnvio;
	}
	public function insert($Envio)
	{
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();
			$sql='INSERT INTO envios (estado) VALUES (:estado)';
			$statement=$conexion->prepare($sql);
			
			$estado=$Envio->getEstado();
			$statement->bindParam(':estado',$estado);
			$statement->execute();
		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
	}
	public function buscar($idEnvio)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM envios WHERE id_Envio=:idEnvio';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idEnvio",$idEnvio);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new Envio($row['id_Envio'],$row['estado']);
			$objeto->setID($row['id_Envio']);
			return $objeto;
		}
		else
		{
			throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}
		

	}
	public function update($objetoNew)
	{
		try
		{
		//Preparo toda la conexion
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql2='UPDATE envios SET estado=:estado WHERE id_Envio=:id_viejo';

		$statement=$conexion->prepare($sql2);
		$ID=$objetoNew->getID();
		$estado=$objetoNew->getEstado();
		$statement->bindParam(":id_viejo",$ID);
		$statement->bindParam(":estado",$estado);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}
		
	}
	public function delete($idEnvio)
	{	
	
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql='DELETE FROM envios WHERE id_Envio=:id_Envio';
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":id_Envio",$id_Envio);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}
		
	}
}

 ?>