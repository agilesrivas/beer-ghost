<?php  namespace Controladoras;
	use PDOException;
	use Exception;
	use Modelo\Usuario as Usuario;
	use Modelo\Cuenta as Cuenta;
	use BaseDatos\UsuarioBD as UsuarioBD;
		use BaseDatos\CuentaBD as CuentaBD;
				use BaseDatos\RolBD as RolBD;
				use BaseDatos\CervezasBD as Cerveza;
				use BaseDatos\PresentacionBD as Envase;
				use BaseDatos\SucursalesBD as Sucursales;



class ControladoraLoguin
{
	private $cuenta;
	private $usuarios;
	private $rol;
	private $cerveza;
	private $envase;
	private $sucu;
	function __construct()
	{
		$this->cuenta=CuentaBD::getInstance();
		$this->usuarios=UsuarioBD::getInstance();
		$this->rol=RolBD::getInstance();
		$this->cerveza=Cerveza::getInstance();
		$this->envase=Envase::getInstance();
		$this->sucu=Sucursales::getInstance();
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

	public function iniciarSession($value,$password)
	{
		
		try
		{
			$cuenta=$this->cuenta->buscarPorEmail($value);
			$contraseñaRegistrada=$cuenta->getPassword();
				if($password===$contraseñaRegistrada)
				{
						$objetoUsuario=$this->usuarios->buscarCuenta($cuenta->getID());
						$cuenta->setRol($this->rol->buscar($cuenta->getRol()));
						$objetoUsuario->setCuenta($cuenta);

						$_SESSION['CuentaLogueada']=$objetoUsuario->getCuenta();
						$_SESSION['CarritoVirtual']=array();
						$this->index(); 

				    
				}
				else {
					$msj="Revise los datos ingresados";
					
					                    echo '<script language="javascript">alert("' . $msj . '");</script>'; 

					$this->index();
				}


		}
		catch(PDOException $e)
		{
			MyDatabaseException($e->getMessage(),$e->getCode());
		}
	}
	public function iniciarCnFacebook()
	{

	}
	public function CerrarSession()
	{
		unset($_SESSION['CuentaLogueada']);
		unset($_SESSION['CarritoVirtual']);
		unset($_SESSION['PedidoEnSession']);
		$this->index();
	}
	
}

?>