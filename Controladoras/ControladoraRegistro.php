<?php namespace Controladoras; 

	use PDOException;
	use Exception;
	use Modelo\Usuario as Usuario;
	use Modelo\Cuenta as Cuenta;
	use Modelo\Rol as Rol;
	use BaseDatos\UsuarioBD as UsuarioBD;
	use BaseDatos\CuentaBD as CuentaBD;
	use BaseDatos\RolBD as RolBD;

class ControladoraRegistro
{
	private $bdUsers;
	private $bdCuenta;
	private $bdRol;
	function __construct()
	{
		
		$this->bdCuenta=CuentaBD::getInstance();
		$this->bdUsers=UsuarioBD::getInstance();
				$this->bdRol=RolBD::getInstance();

		

	}
	public function index()
	{
       if(isset($_SESSION['CarritoVirtual']))
		{
			$lista=$_SESSION['CarritoVirtual'];
			require(ROOT.'Vistas/pag-principal.php');

		}
		else
		{	
			
			$_SESSION['CarritoVirtual']=array();
			$lista=$_SESSION['CarritoVirtual'];
			require(ROOT.'Vistas/pag-principal.php');
		}
	}
	public function vistaAdministrador()
	{  
	    $listado=$this->bdCuenta->traerTodos();
		require(ROOT.'Vistas/administrador.php');
		require(ROOT.'Vistas/cuentasAdmin.php');
	}
	public function setearModifRol($id,$estado)
	{
		$cuenta=$this->bdCuenta->buscar($id);
		$rol=$this->bdRol->buscarPorTipo($estado);
		$cuenta->setRol($rol);
		$this->bdCuenta->update($cuenta);
		$this->vistaAdministrador();

	}
	public function registrarUsuario($id,$idcuenta,$nombreUser,$nombre,$apellido,$direccion,$direccionEnvio,$email,$passUser)
	{
		$mensaje='';
		try
		{
			//VERIFICAR SI TODO LOS DATOS ESTAN EN LO CORRECTO SINO VOLVER AL REGISTRO! Lanzando error! 
			$rol=new Rol('1','Usuario');
			$cuenta=new Cuenta($idcuenta,$nombreUser,$email,$passUser,"Activo",$rol);
			$usuario=new Usuario($id,$nombre,$apellido,$direccionEnvio,$direccion,"asd","Activo",$cuenta);
			$ultimoid=$this->bdCuenta->insert($cuenta);	
			$cuenta->setID($ultimoid);
			//$cc=$this->bdUsers->buscarCuenta($cuenta->getID());			

			$usuario->setCuenta($ultimoid);
			$this->bdUsers->insert($usuario);
			$_SESSION['CuentaLogueada']=$cuenta;
			$_SESSION['CarritoVirtual']=array();

			$this->index();


		}
		catch(PDOException $error)
		{
			$mensaje=MyDatabaseException($error->getMessage(),$error->getCode());
		}
	}
	public function eliminarCuenta($id)
	{
		try
		{
				$this->bdUsers->deleteUsuarioPorCuenta($id);
				$this->bdCuenta->delete($id);
			$this->vistaAdministrador();

		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
	}

	public function verificarRegistro()
	{

	}

}
?>
