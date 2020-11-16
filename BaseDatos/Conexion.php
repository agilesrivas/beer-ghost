<?php namespace BaseDatos;

/**
* 
*/

class Conexion 
{
	public function get_Conexion()
	{
			try
			{
				$conexion=new\PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS);
			}
			catch(PDOException $e)
			{
				echo "ERROR:".$e->getMessage();
			}
			 return $conexion;
	}
}

 ?>