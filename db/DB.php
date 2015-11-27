<?php
	//conectar();
	function conectar()
	{ 
		$dsn='mysql:host=localhost;dbname=ocs';
		$username='root';
		$passsword='';
		try
		{
			$db=new PDO($dsn,$username, $passsword);
			return $db;	
		} 
		catch (PDOException $e) {
			//echo $e->getMessage();
    		return null;
		}		
	}
	
	function verificausuario($datos)
	{
		$db=conectar();
		if($db!=null)
		{
			$query="SELECT nombre,usuario,contrasena FROM administrador WHERE usuario='".$datos['usuario']."' and contrasena='".$datos['contra']."'";
			$res=$db->$query($query);
			if($res->rowCount()>0)
				return "true";
			return "Usuario y/o contraseña incorrectos";
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

?>