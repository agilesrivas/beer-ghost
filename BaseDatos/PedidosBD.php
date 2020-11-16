<?php namespace BaseDatos;
 use BaseDatos\SucursalesBD as Sucursales;
 use BaseDatos\LineaPedidoBD as Lineas;
 use BaseDatos\CuentaBD as Cuentas;
 use Modelo\Pedido as Pedido;
  use BaseDatos\UsuarioBD as Usuarios;

class PedidosBD extends SingletonDao implements DaosCollection
{
	private $lineas;
	private $cuentas;
	private $usuarios;
	function __construct()
	{
		$this->lineas=Lineas::getInstance();
		$this->cuentas=Cuentas::getInstance();
		$this->usuarios=Usuarios::getInstance();

	}
	public function ConsultarEstadoPedidos($idUser)
	{
		$listado=array();
		$modelo= new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='SELECT * FROM pedidos where id_cuenta=:idUser';

			$statement=$conexion->prepare($sql);
			$statement->bindParam(':idUser',$idUser);
			$statement->execute();
			
				while($row=$statement->fetch())
				{
				$pedido=new Pedido($row['id_pedido'],$row['id_cuenta'],$row['estado'],$row['domicilioSucu'],$row['metodo'],$row['fecha'],$row['total'],$row['nombreSucursal']);
				$pedido->setCuenta($this->cuentas->buscar($row['id_cuenta']));
				array_push($listado,$pedido);
				}

					return $listado;
	}
	public function getListaPedidos()
	{
		$listado=array();
		try
		{
			$modelo= new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='SELECT * FROM pedidos';

			$statement=$conexion->prepare($sql);
			$statement->execute();
			
				while($row=$statement->fetch())
				{
				$pedido=new Pedido($row['id_pedido'],$row['id_cuenta'],$row['estado'],$row['domicilioSucu'],$row['metodo'],$row['fecha'],$row['total'],$row['nombreSucursal']);
				$pedido->setCuenta($this->cuentas->buscar($row['id_cuenta']));
				array_push($listado,$pedido);
				}
			
			
		}
		catch(PDOException $e)
		{
			 $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
			 return $this->mensaje;
		}
		
		return $listado;
	}
	public function insert($value)
	{
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='INSERT INTO pedidos (id_cuenta,fecha,estado,metodo,nombreSucursal,domicilioSucu,total) VALUES (:id_cuenta,:fecha,:estado,:metodo,:nombreSucursal,:domicilioSucu,:total)';



			$statement=$conexion->prepare($sql);

			$id_cuenta=$value->getCuenta();
			$fecha=$value->getFecha();
			$estado=$value->getEnvio();
			$metodo=$value->getMetodo();
			$nombreSucursal=$value->getNombreEmpresa();
			$domicilioSucu=$value->getDomicilioSucu();
			$total=$value->getTotal();



			$statement->bindParam(':id_cuenta',$id_cuenta);
			$statement->bindParam(':fecha',$fecha);
			$statement->bindParam(':estado',$estado);
			$statement->bindParam(':metodo',$metodo);
			$statement->bindParam(':nombreSucursal',$nombreSucursal);
			$statement->bindParam(':domicilioSucu',$domicilioSucu);
			$statement->bindParam(':total',$total);
			$statement->execute();
			$idForLineas=$conexion->lastInsertId();
			
			$this->lineas->insertarIDPEDIDOlineas($idForLineas);


			}
		catch(PDOException $e)
		{

		}
		return $idForLineas;

	}
	public function buscarPorCliente($email)
	{		$listado=array();
		try
		{
			$objetoCuenta=$this->cuentas->buscarPorEmail($email);
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM pedidos WHERE id_cuenta=:id';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$id=$objetoCuenta->getID();
		$statement->bindParam(":id",$id);
		//Ejecuto la consulta
		$statement->execute();

		
				while($row=$statement->fetch())
				{
				$pedido=new Pedido($row['id_pedido'],$row['id_cuenta'],$row['estado'],$row['domicilioSucu'],$row['metodo'],$row['fecha'],$row['total'],$row['nombreSucursal']);
				$pedido->setCuenta($this->cuentas->buscar($row['id_cuenta']));
				array_push($listado,$pedido);
				}
			
		}
		catch(PDOException $e)
		{

		}
		return $listado;
	}
	public function update($newVal)
	{
		try
		{
		//Preparo toda la conexion
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		$sql2='UPDATE pedidos SET id_cuenta=:id_cuenta,fecha=:fecha,estado=:estado,metodo=:metodo,nombreSucursal=:nombreSucursal,domicilioSucu=:domicilioSucu ,total=:total WHERE id_pedido=:id_viejo';

		$statement=$conexion->prepare($sql2);
		$ID=$newVal->getID();
		$id_cuenta=$newVal->getCuenta()->getID();
		$fecha=$newVal->getFecha();
		$estado=$newVal->getEnvio();
		$metodo=$newVal->getMetodo();
		$nombreSucu=$newVal->getNombreEmpresa();
		$domicilio=$newVal->getDomicilioSucu();
		$total=$newVal->getTotal();
		$statement->bindParam(":id_viejo",$ID);
		$statement->bindParam(":id_cuenta",$id_cuenta);
	    $statement->bindParam(":estado",$estado);
		$statement->bindParam(":fecha",$fecha);
		$statement->bindParam(":metodo",$metodo);
		$statement->bindParam(":nombreSucursal",$nombreSucu);
		$statement->bindParam(":domicilioSucu",$domicilio);
		$statement->bindParam(":total",$total);
		$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
					}
	}
	public function buscarPorFecha($fecha)
	{
		{		$listado=array();
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM pedidos WHERE fecha=:fecha';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":fecha",$fecha);
		//Ejecuto la consulta
		$statement->execute();

		
				while($row=$statement->fetch())
				{
				$pedido=new Pedido($row['id_pedido'],$row['id_cuenta'],$row['estado'],$row['domicilioSucu'],$row['metodo'],$row['fecha'],$row['total'],$row['nombreSucursal']);
				$pedido->setCuenta($this->cuentas->buscar($row['id_cuenta']));
				array_push($listado,$pedido);
				}
			
		}
		catch(PDOException $e)
		{

		}
		return $listado;
	}

	}
	public function buscarPorSucursal($sucursal)
	{
		{		$listado=array();
		try
		{
			$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM pedidos WHERE nombreSucursal=:nombreSucursal';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":nombreSucursal",$sucursal);
		//Ejecuto la consulta
		$statement->execute();

		
				while($row=$statement->fetch())
				{
				$pedido=new Pedido($row['id_pedido'],$row['id_cuenta'],$row['estado'],$row['domicilioSucu'],$row['metodo'],$row['fecha'],$row['total'],$row['nombreSucursal']);
				$pedido->setCuenta($this->cuentas->buscar($row['id_cuenta']));
				array_push($listado,$pedido);
				}
			
		}
		catch(PDOException $e)
		{

		}
		return $listado;
	}
	}
	public function traerEntreFechas($fecha,$nombre)
	{

	}
	public function buscar($id)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM pedidos WHERE id_pedido=:id';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":id",$id);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
		$pedido=new Pedido($row['id_pedido'],$row['id_cuenta'],$row['estado'],$row['domicilioSucu'],$row['metodo'],$row['fecha'],$row['total'],$row['nombreSucursal']);
				$pedido->setCuenta($this->cuentas->buscar($row['id_cuenta']));
			return $pedido;
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
			$sql='DELETE FROM pedidos WHERE id_pedido=:id';
			$statement=$conexion->prepare($sql);
			$statement->bindParam(":id",$id);
			$statement->execute();
		}
		catch(PDOException $E)
		{
			MyDatabaseException($E->getMessage(),$E->getCode());
		}
		
	}

}

 ?>