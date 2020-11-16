<?php namespace BaseDatos;
use PDOException;
use BaseDatos\CervezasBD as CervezasBD;
    use Modelo\TipoCerveza as TipoCerveza;


class CervezasBD extends SingletonDao implements DaosCollection
{
	protected $mensaje;
	
	function __construct()
	{
		$this->mensaje='';
	}
	public function ultimoIDCargado($array)
	{
		
	}
	public function getListaCerveza()
	{
		$listado=array();
		try
		{
			$modelo= new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='SELECT * FROM cervezas';

			$statement=$conexion->prepare($sql);
			$statement->execute();
			
				while($row=$statement->fetch())
				{
				$objetoCerveza=new TipoCerveza($row['id_Cerveza'],$row['nombre'],$row['precio_litro'],$row['descripcion'],$row['imagen'],$row['estado']);
				array_push($listado,$objetoCerveza);
				}
			
			
		}
		catch(PDOException $e)
		{
			 $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
			 return $this->mensaje;
		}
		
			return $listado;
	}
	public function insert($objetoCerveza)
	{	
		try
		{
		//tomo los datos de la conexion de la instancia del pdo
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Preparo la sentencia sql para su preparacion 
		//Luego en el values asigno los nombres para luego con la funcion evitar el sql injection 
		$sql='INSERT INTO cervezas (nombre,precio_litro,descripcion,imagen,estado) VALUES (:nombre,:precio_litro,:descripcion,:imagen,:estado)';
		//Debo preparar la consulta aun no esta siendo enviada a la base de datos devuelve un objeto statemetn 
		$statement=$conexion->prepare($sql);
		$nombre=$objetoCerveza->getNombreCerveza();
		$precio=$objetoCerveza->getPrecioLitro();
		$descripcion=$objetoCerveza->getDescripcion();
		$imagen=$objetoCerveza->getImagen();
		$estado=$objetoCerveza->getEstado();

		//remplazo los marcadores por los valores reales utilizando el metodo bindParam
		
		$statement->bindParam(':nombre',$nombre);
		$statement->bindParam(':precio_litro',$precio);
		$statement->bindParam(':descripcion',$descripcion);
		$statement->bindParam(':imagen',$imagen);
		$statement->bindParam(':estado',$estado);

		//Ejecuto la sentencia sql que prepare
		$this->buscarNombre($nombre);
		
		$statement->execute();
		
		
		}
		catch(PDOException $e)
		{
          $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
          
          
		}
		return $this->mensaje;
	}
	public function buscarNombre($nombre)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM cervezas WHERE nombre=:NombreRep';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":NombreRep",$nombre);
		//Ejecuto la consulta
		$statement->execute();

		if(!empty($statement->fetch()))
		{
			throw new PDOException(" Se encuentra el objeto buscado", 1);
		}
	}
	public function buscar($idCerveza)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM cervezas WHERE id_Cerveza=:idCerveza';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idCerveza",$idCerveza);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new TipoCerveza($row['id_Cerveza'],$row['nombre'],$row['precio_litro'],$row['descripcion'],$row['imagen'],$row['estado']);
			return $objeto;
		}
		else
		{
			//throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}
		

	}
	public function update($objetoNew)
	{
		try
		{
		//Preparo toda la conexion
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql2='UPDATE cervezas SET nombre=:nombre,descripcion=:descripcion,precio_litro=:precio_litro,imagen=:imagen,estado=:estado WHERE id_Cerveza=:id_viejo';
 
		$statement=$conexion->prepare($sql2);
		$ID=$objetoNew->getID();
		$nombre=$objetoNew->getNombreCerveza();
		$precio=$objetoNew->getPrecioLitro();
		$descripcion=$objetoNew->getDescripcion();
		$imagen=$objetoNew->getImagen();
		$estado=$objetoNew->getEstado();
		$statement->bindParam(":id_viejo",$ID);
		$statement->bindParam(":nombre",$nombre);
		$statement->bindParam(":descripcion",$descripcion);
		$statement->bindParam(":precio_litro",$precio);
		$statement->bindParam(":imagen",$imagen);
		$statement->bindParam(":estado",$estado);
		$statement->execute();
		}
		catch(PDOException $E)
		{
		
			$this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
			
			 return $this->mensaje;
		}
		
	}
	public function delete($idCerveza)
	{	
		
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();
			$sql='DELETE FROM cervezas WHERE id_Cerveza=:id_cerveza';
			$statement=$conexion->prepare($sql);
			$statement->bindParam(":id_cerveza",$idCerveza);
			$statement->execute();
		}
		catch(PDOException $E)
		{
			$this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
			 return $this->mensaje;
		}
		
	}
	

	}