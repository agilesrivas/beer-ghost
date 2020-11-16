<?php namespace BaseDatos;

	use PDOException;
	use Exception;
	use Modelo\Usuario as Usuario;
	use Modelo\Cuenta as Cuenta;
	use BaseDatos\UsuarioBD as UsuarioBD;
	use BaseDatos\RolBD as RolBD;
	use Modelo\Rol as Rol;

class CuentaBD extends SingletonDao implements DaosCollection
{
	function __construct()
	{
		
	}
	
	public function traerTodos()
	{
		$listUsuarios=array();
		$mensaje='';
		try
		{

			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();
			$rol=RolBD::getInstance();
			$sql='SELECT * FROM cuentas';

			$statement=$conexion->prepare($sql);
			$statement->execute();

			while($row=$statement->fetch())
			{
				$value=new Cuenta($row['id_cuenta'],$row['nombre'],$row['email'],$row['pass'],$row['estado'],$row['id_Rol']);
				$Role=$rol->buscar($row['id_Rol']);
				$value->setRol($Role);
				array_push($listUsuarios, $value);
			}
		}
		catch (PDOException $e)
		{
			$mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
		}
		return $listUsuarios;
	}
	public function insert($value)
	{
		$rta=0;
		try
		{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();

		$sql='INSERT INTO cuentas (nombre,email,pass,estado,id_Rol) VALUES (:nombre,:email,:password,:estado,:id_Rol)';
			

		$statement=$conexion->prepare($sql);
		$email=$value->getEmail();
		$nombreUsuario=$value->getUsuario();
		$password=$value->getPassword();
		$rol=$value->getRol();
		$idRol=$rol->getID();
		$estado=$value->getEstado();

		$statement->bindParam(':nombre',$nombreUsuario);
		$statement->bindParam(':email',$email);
		$statement->bindParam(':password',$password);
		$statement->bindParam(':estado',$estado);
		$statement->bindParam(':id_Rol',$idRol);
		$statement->execute();
		$rta=$conexion->lastInsertId();
		

		}
		catch (PDOException $e)
		{
			throw new MyDatabaseException($e->getMessage(),$e->getCode());
		}
		return $rta;
	}
	public function buscar($id)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM cuentas WHERE id_cuenta=:idcuenta';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idcuenta",$id);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
						$rol=RolBD::getInstance();

			$objeto=new Cuenta($row['id_cuenta'],$row['nombre'],$row['email'],$row['pass'],$row['estado'],$row['id_Rol']);
			$Role=$rol->buscar($row['id_Rol']);
				$objeto->setRol($Role);

			return $objeto;
		}
		else
		{
			throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}

	}
	public function buscarPorNombre($value)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM cuentas WHERE nombre=:name';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":name",$value);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new Cuenta($row['id_cuenta'],$row['nombre'],$row['email'],$row['pass'],$row['estado'],$row['id_Rol']);
			return $objeto;
		}
		else
		{
			throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}

	}
	public function buscarPorEmail($valueEmail)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM cuentas WHERE email=:email';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":email",$valueEmail);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$objeto=new Cuenta($row['id_cuenta'],$row['nombre'],$row['email'],$row['pass'],$row['estado'],$row['id_Rol']);
			return $objeto;
		}
		else
		{
			throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}

	}
	public function delete($id)
	{
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql='DELETE FROM cuentas WHERE id_cuenta=:idcuenta';
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idcuenta",$id);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			throw new MyDatabaseException($E->getMessage(),$E->getCode());
		
		}

	}
	public function update($newValue)
	{
		try
		{
		//Preparo toda la conexion
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql2='UPDATE cuentas SET nombre=:nombre,email=:email,pass=:password,estado=:estado,id_Rol=:idRol WHERE id_cuenta=:id_viejo';

		$statement=$conexion->prepare($sql2);
		$ID=$newValue->getID();
		$email=$newValue->getEmail();
		$nombreUsuario=$newValue->getUsuario();
		$password=$newValue->getPassword();
		$rol=$newValue->getRol();
		$id_Rol=$rol->getID();
		$estado=$newValue->getEstado();
		$statement->bindParam(":id_viejo",$ID);
		$statement->bindParam(":email",$email);
		$statement->bindParam(":nombre",$nombreUsuario);
		$statement->bindParam(":password",$password);
		$statement->bindParam(":estado",$estado);
		$statement->bindParam(":idRol",$id_Rol);
		
		$statement->execute();
		}
		catch(PDOException $E)
		{
			throw new MyDatabaseException($E->getMessage(),$E->getCode());
					}
		

	}
	
}
