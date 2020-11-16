<?php namespace BaseDatos;
use PDOException;
use BaseDatos\PresentacionBD as PresentacionBD;
    use Modelo\Presentacion as Presentacion;


class PresentacionBD extends SingletonDao implements DaosCollection 
{
	function __construct()
	{

	}
	public function ultimoIDCargado($array)
	{

	}
	public function getListaPresentaciones()
	{
		$presentaciones=array();
	try
		{
			$modelo= new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='SELECT * FROM envases';

			$statement=$conexion->prepare($sql);
			$statement->execute();

			while($row=$statement->fetch())
			{
				$envase=new Presentacion($row['id_envase'],$row['descripcion'],$row['factor'],$row['capacidad'],$row['recarga'],$row['imagen'],$row['estado']);
				array_push($presentaciones,$envase);
			}
		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
		
			return $presentaciones;
	}

	public function insert($objetoPresent)
	{	
		
		try
		{
		//tomo los datos de la conexion de la instancia del pdo
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Preparo la sentencia sql para su preparacion 
		//Luego en el values asigno los nombres para luego con la funcion evitar el sql injection 
		$sql='INSERT INTO envases (descripcion,factor,capacidad,recarga,imagen,estado) VALUES (:descripcion,:factor,:capacidad,:recarga,:imagen,:estado)';
		//Debo preparar la consulta aun no esta siendo enviada a la base de datos devuelve un objeto statemetn 
		$statement=$conexion->prepare($sql);
		$descripcion=$objetoPresent->getDescripEnvase();
		$factor=$objetoPresent->getFactor();
		$capacidad=$objetoPresent->getLitrosDeEnvasado();
		$recarga=$objetoPresent->getRecarga();
		$imagen=$objetoPresent->getImagen();
		$estado=$objetoPresent->getEstado();

		//remplazo los marcadores por los valores reales utilizando el metodo bindParam
		
		$statement->bindParam(':descripcion',$descripcion);
		$statement->bindParam(':factor',$factor);
		$statement->bindParam(':capacidad',$capacidad);
		$statement->bindParam(':recarga',$recarga);
		$statement->bindParam(':imagen',$imagen);
		$statement->bindParam(':estado',$estado);


		//Ejecuto la sentencia sql que prepare
		$this->buscarCapacidad($capacidad);
		$statement->execute();
		}
		catch(PDOException $e)
		{
            MyDatabaseException($e->getMessage(),$e->getCode());
		}
	}
	public function buscarCapacidad($capacidad)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM envases WHERE capacidad=:capacidad';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":capacidad",$capacidad);
		//Ejecuto la consulta
		$statement->execute();

		if(!empty($statement->fetch()))
		{
			//throw new PDOException(" Se encuentra el objeto buscado", 1);
		}
	}
	public function buscar($idEnvase)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM envases WHERE id_envase=:idEnvase';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idEnvase",$idEnvase);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new Presentacion($row['id_envase'],$row['descripcion'],$row['factor'],$row['capacidad'],$row['recarga'],$row['imagen'],$row['estado']);
			
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
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql2='UPDATE envases SET descripcion=:descripcion,factor=:factor,capacidad=:capacidad,recarga=:recarga,imagen=:imagen,estado=:estado WHERE id_envase=:id_viejo';
		$statement=$conexion->prepare($sql2);
		$ID=$objetoNew->getID();
		$descripcion=$objetoNew->getDescripEnvase();
		$factor=$objetoNew->getFactor();
		$capacidad=$objetoNew->getLitrosDeEnvasado();
		$recarga=$objetoNew->getRecarga();
		$imagen=$objetoNew->getImagen();
		$estado=$objetoNew->getEstado();
		$statement->bindParam(":id_viejo",$ID);
		$statement->bindParam(":descripcion",$descripcion);
		$statement->bindParam(":factor",$factor);
		$statement->bindParam(":capacidad",$capacidad);
		$statement->bindParam(":recarga",$recarga);
		$statement->bindParam(":imagen",$imagen);
		$statement->bindParam(":estado",$estado);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
		}
	}
	public function delete($idEnvase)
	{	
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();
			$sql='DELETE FROM envases WHERE id_envase=:id_envase';
			$statement=$conexion->prepare($sql);
			$statement->bindParam(":id_envase",$idEnvase);
			$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
		}
		
	}
	
}

 ?>