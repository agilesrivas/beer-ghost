<?php namespace BaseDatos;
use PDOException;
use BaseDatos\SucursalesBD as SucursalesBD;
    use Modelo\Sucursal as Sucursal;

class SucursalesBD extends SingletonDao implements DaosCollection
{
  public function ultimoIDCargado($array)
  {

  }	
  public function getListaSucursales()
  {
  	$sucursales=array();
  	try
  	{
  		$modelo=new Conexion();
  		$conexion=$modelo->get_Conexion();
  		$sql='SELECT * FROM sucursales';
  	$statement=$conexion->prepare($sql);
			$statement->execute();

			while($row=$statement->fetch())
			{
				$objetoSucursal=new Sucursal($row['id_sucursal'],$row['nombre'],$row['domicilio'],$row['latitud'],$row['longitud'],$row['estado']);
				$objetoSucursal->setID($row['id_sucursal']);
				array_push($sucursales,$objetoSucursal);
			}
		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
		
			return $sucursales;
	}
	public function insert($Sucursal)
	{
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();
			$sql='INSERT INTO sucursales (nombre,domicilio,latitud,longitud,estado) VALUES (:nombre,:domicilio,:latitud,:longitud,:estado)';
			$statement=$conexion->prepare($sql);
			$nombre=$Sucursal->getNombre();
			$domicilio=$Sucursal->getDomicilio();
			$latitud=$Sucursal->getLatitud();
			$longitud=$Sucursal->getLongitud();
			$estado=$Sucursal->getEstado();
			$statement->bindParam(':nombre',$nombre);
			$statement->bindParam(':domicilio',$domicilio);
			$statement->bindParam(':latitud',$latitud);
			$statement->bindParam(':longitud',$longitud);
			$statement->bindParam(':estado',$estado);
			$statement->execute();
		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
	}
	public function buscar($idSucursal)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM sucursales WHERE id_sucursal=:idsucursal';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idsucursal",$idSucursal);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new TipoCerveza($row['id_sucursal'],$row['nombre'],$row['domicilio'],$row['latitud'],$row['longitud'],$row['estado']);
			$objeto->setID($row['id_sucursal']);
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
		$sql2='UPDATE sucursales SET nombre=:nombre,domicilio=:domicilio,latitud=:latitud,longitud=:longitud,estado=:estado WHERE id_sucursal=:id_viejo';

		$statement=$conexion->prepare($sql2);
		$ID=$objetoNew->getID();
		$nombre=$objetoNew->getNombre();
		$domicilio=$objetoNew->getDomicilio();
		$latitud=$objetoNew->getLatitud();
		$longitud=$objetoNew->getLongitud();
		$estado=$objetoNew->getEstado();
		$statement->bindParam(":id_viejo",$ID);
		$statement->bindParam(":nombre",$nombre);
		$statement->bindParam(":domicilio",$domicilio);
		$statement->bindParam(":latitud",$latitud);
		$statement->bindParam(":longitud",$longitud);
		$statement->bindParam(":estado",$estado);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}
		
	}
	public function delete($idsucursal)
	{	
	
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql='DELETE FROM sucursales WHERE id_sucursal=:id_sucu';
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":id_sucu",$idsucursal);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}
		
	}
}

 ?>