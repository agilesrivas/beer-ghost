<?php namespace BaseDatos;

	use PDOException;
	use Exception;
	    use BaseDatos\UsuarioBD as UsuarioBD;

	use BaseDatos\Conexion as Conexion;
	use Modelo\Usuario as Usuario;
	use Modelo\Cuenta as Cuenta;
	use Modelo\Rol as Rol;
	use BaseDatos\RolBD as RolBD;

class UsuarioBD extends SingletonDao implements DaosCollection
{
	private $rol;
	function __construct()
	{
		$this->rol=RolBD::getInstance();
	}
	public function insert($value)
	{
		$mensaje='';
			
		
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='INSERT INTO usuarios (nombre,apellido,direccion_envio,domicilio,imagen,estado,id_cuenta) VALUES (:nombre,:apellido,:direccionDefault,:direccionHogar,:imagen,:estado,:id_cuenta)';

			$statement=$conexion->prepare($sql);
			
			$nombre=$value->getNombre();
			$apellido=$value->getApellido();
			$direccionDefault=$value->getDireccionEnvio();
			$imagen=$value->getImagen();
			$direccionHogar=$value->getDireccionHogar();
			$id_cuenta=$value->getCuenta();
			$estado=$value->getEstado();

			$statement->bindParam(':nombre',$nombre);
			$statement->bindParam(':apellido',$apellido);
			$statement->bindParam(':direccionDefault',$direccionDefault);
			$statement->bindParam(':direccionHogar',$direccionHogar);
			$statement->bindParam(':imagen',$imagen);
			$statement->bindParam(':estado',$estado);
			$statement->bindParam(':id_cuenta',$id_cuenta);
			$statement->execute();

		}
		catch(PDOException $e)
		{
			$mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
			
		}
		
	}
	public function buscar($id)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM usuarios WHERE id_usuario=:idUser';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idUser",$id);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			//CUENTA CREAR UN OBJETO TRAYENDOLO POR EL ID!
			$objeto=new TipoCerveza($row['id_usuario'],$row['nombre'],$row['apellido'],$row['direccionDefault'],$row['direccionHogar'],$row['cuenta'],$row['estado']);
			$objeto->setID($row['id_usuario']);
			return $objeto;
		}
		else
		{
			throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}

	}
	public function buscarCuenta($id)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM usuarios WHERE id_cuenta=:idCuenta';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":idCuenta",$id);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			//CUENTA CREAR UN OBJETO TRAYENDOLO POR EL ID!
			$objeto=new Usuario($row['id_usuario'],$row['nombre'],$row['apellido'],$row['direccion_envio'],$row['domicilio'],$row['imagen'],$row['cuenta'],$row['estado']);
			return $objeto;
		}
		else
		{
			//throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}

	}
	public function delete($id)
	{
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql='DELETE FROM usuarios WHERE id_usuario=:id_user';
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":id_user",$id);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}

	}
	public function deleteUsuarioPorCuenta($id)
	{
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql='DELETE FROM usuarios WHERE id_cuenta=:id_user';
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":id_user",$id);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}

	}
	public function update($objetoNew)
	{
		try
		{
		//Preparo toda la conexion
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql2='UPDATE usuarios SET nombre=:nombre,apellido=:apellido,direccionDefault=:direccionDefault,direccionHogar=:direccionHogar,id_cuenta=:cuenta,estado=:estado WHERE id_usuario=:id_viejo';

		$statement=$conexion->prepare($sql2);
		$ID=$objetoNew->getID();
		$nombre=$objetoNew->getNombre();
		$apellido=$objetoNew->getApellido();
		$direccionDefault=$objetoNew->getDireccionDefault();
		$direccionHogar=$objetoNew->getDireccionHogar();
		$cuenta=$objetoNew->getCuenta();
		$estado=$objetoNew->getEstado();
		$statement->bindParam(":id_viejo",$ID);
		$statement->bindParam(":nombre",$nombre);
		$statement->bindParam(":apellido",$apellido);
		$statement->bindParam(":direccionDefault",$direccionDefault);
		$statement->bindParam(":direccionHogar",$direccionHogar);
		$statement->bindParam(":cuenta",$cuenta);

		$statement->bindParam(":estado",$estado);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}


	}
	public function getSession()
	 	{
	 		//unset($_SESSION['TipoCerveza']);
	 		if(!isset($_SESSION['CuentaLogueada']))
	 		{
		 		$_SESSION['CuentaLogueada']=array();
	 		}
	 		return $_SESSION['CuentaLogueada'];
	 	}
	 	public function setSession($value) {
	 		$_SESSION['CuentaLogueada'] = $value;
	 	}

	public function traerTodos()
	{
		$listUsuarios=array();
		$mensaje='';
		try
		{

			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='SELECT * FROM usuarios';

			$statement=$conexion->prepare($sql);
			$statement->execute();

			while($row=$statement->fetch())
			{
				$value=new Usuario($row['id_usuario'],$row['nombre'],$row['apellido'],$row['direccionDefault'],$row['direccionHogar'],$row['id_cuenta'],$row['estado']);
				array_push($listUsuarios, $value);
			}
		}
		catch (PDOException $e)
		{
			$mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
		}
		
		return $mensaje;
	}
}

 ?>