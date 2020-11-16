<?php namespace BaseDatos;

use BaseDatos\CervezasBD as Cerveza;
use BaseDatos\PresentacionBD as Envase;
use Modelo\LineaPedido as LineaPedido;
class LineaPedidoBD extends SingletonDao implements DaosCollection 
{
	private $mensaje;
	private $cerveza;
	private $envase;

	function __construct()
	{
		$this->cerveza=Cerveza::getInstance();
		$this->envase=Envase::getInstance();

 	}
 	public function getLineasPedidoPorUsuario($id)
 	{
 		 		$listado=array();

			$modelo= new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='SELECT * FROM productos where id_pedido=:id';

			$statement=$conexion->prepare($sql);
			$statement->bindParam(':id',$id);
			$statement->execute();
			
				while($row=$statement->fetch())
				{
				$linea=new LineaPedido($row['id_producto'],$row['id_cerveza'],$row['id_envase'],$row['cantidad'],$row['importe'],$row['id_pedido']);
				$linea->setTipoCerveza($this->cerveza->buscar($linea->getTipoCerveza()));
					$linea->setPresentacion($this->envase->buscar($linea->getPresentacion()));
				array_push($listado,$linea);
				}
				return $listado;
 	}
 	public function getLineasPedido()
 	{
 		$listado=array();
		try
		{
			$modelo= new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='SELECT * FROM productos';

			$statement=$conexion->prepare($sql);
			//$statement->bindParam(':id',$id);
			$statement->execute();
			
				while($row=$statement->fetch())
				{
				$linea=new LineaPedido($row['id_producto'],$row['id_cerveza'],$row['id_envase'],$row['cantidad'],$row['importe']);
				$linea->setTipoCerveza($this->cerveza->buscar($linea->getTipoCerveza()));
					$linea->setPresentacion($this->envase->buscar($linea->getPresentacion()));
				array_push($listado,$linea);
				}
			
			
		}
		catch(PDOException $e)
		{
			 $this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
			 return $this->mensaje;
		}
		
			return $listado;
 	}
 	public function insertarIDPEDIDOlineas($id)
 	{
 		try
 		{
 			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='UPDATE FROM productos SET id_pedido=:id';

			$statement=$conexion->prepare($sql);
			$statement->bindParam(':id',$id);
			$statement->execute();

 		}
 		catch(PDOException $e)
 		{
 		}
 	}
	public function insert($value)
	{
		try
		{

			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='INSERT INTO productos (id_cerveza,id_envase,cantidad,importe,id_pedido) VALUES (:id_cer,:id_envase,:cantidad,:importe,:id_pedido)';
			$statemente=$conexion->prepare($sql);
			$Cerveza=$value->getTipoCerveza();
			$id_cer=$Cerveza->getID();
			$Envase=$value->getPresentacion();
			$id_env=$Envase->getID();
			$cantidad=$value->getCantidad();
			$impo=$value->getImporte();
			$id_pedido=$value->getIDpedido();

			$statemente->bindParam(':id_cer',$id_cer);
			$statemente->bindParam(':id_envase',$id_env);
			$statemente->bindParam(':cantidad',$cantidad);
			$statemente->bindParam(':importe',$impo);
			$statemente->bindParam(':id_pedido',$id_pedido);

			$statemente->execute();
			$rta=$conexion->lastInsertId();


		}
		catch(PDOException $e)
		{

		}
 return $rta;
	}
	public function buscar($id)
	{
		$modelo=new Conexion();
		$conexion=$modelo->get_Conexion();
		//Escribo la consulta
		$sql='SELECT * FROM productos WHERE id_producto=:id';
		//Preparo la Consulta
		$statement=$conexion->prepare($sql);
		$statement->bindParam(":id",$id);
		//Ejecuto la consulta
		$statement->execute();

		if($row=$statement->fetch())
		{
			$cervezita=$this->cerveza->buscar($row['id_cerveza']);
			$envasito=$this->envase->buscar($row['id_envase']);
			$objeto=new LineaPedido($row['id_producto'],$cervezita,$envasito,$row['cantidad'],$row['importe']);
			return $objeto;
		}
		else
		{
			//throw new PDOException("No se encuentra el objeto buscado", 1);
			
		}
		

	}
	public function update($valueNew)
	{
		try
		{

			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();

			$sql='UPDATE FROM  productos SET id_cerveza=:id_cer,id_envase=,:id_envase,cantidad=:cantidad,importe=:importe)';
			$statemente=$conexion->prepare($sql);
			$Cerveza=$value->getCerveza();
			$id_cer=$Cerveza->getID();
			$Envase=$value->getID();
			$id_env=$Envase->getID();
			$cantidad=$value->getCantidad();
			$impo=$value->getImporte();

			$statemente->bindParam(':id_cer',$id_cer);
			$statemente->bindParam(':id_envase',$id_env);
			$statemente->bindParam(':cantidad',$cantidad);
			$statemente->bindParam(':importe',$impo);

			$statemente->execute();

		}
		catch(PDOException $e)
		{

		}
	}
	public function delete($id)
	{
		try
		{
			$modelo=new Conexion();
			$conexion=$modelo->get_Conexion();
			$sql='DELETE FROM productos WHERE id_producto=:id';
			$statement=$conexion->prepare($sql);
			$statement->bindParam(":id",$id);
			$statement->execute();
		}
		catch(PDOException $E)
		{
			$this->mensaje=MyDatabaseException($e->getMessage(),$e->getCode());
			 return $this->mensaje;
		}

	}
	
	
}
 ?>