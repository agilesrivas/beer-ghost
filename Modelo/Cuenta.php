<?php namespace Modelo;

class Cuenta {
    private $id;
	private $email;
	private $usuario;
	private $password;
    private $Rol;
    private $estado;




	function __construct($id,$usuario,$email,$password,$estado,$rol)
    {
        $this->setID($id);
        
        $this->setUsuario($usuario);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setEstado($estado);
        $this->setRol($rol);
    }
    public function setRol($value)
    {
        $this->Rol=$value;
    }

    public function getRol()
    {
        return $this->Rol;
    }
    public function setEstado($value)
    {
        $this->estado=$value;
    }
    public function getEstado()
    {
        return $this->estado;
    }
public function setID($value)
{
    $this->id=$value;
}
public function getID()
{
    return $this->id;
}

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
}









  ?>