<?php
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
		//session_start();
		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'usuario' => $datos['usuario'],
				'contra' => $datos['contra']
				);
			$query = $db->prepare("SELECT nombre,usuario FROM administrador WHERE usuario=:usuario AND contrasena=:contra");
		    $query->execute($prepared);
			if( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				$_SESSION['nom_usu']=$row[0];
				$_SESSION['usu']=$row[1];
				return "true";
			}
			return "Usuario y/o contraseña incorrectos";
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

	function getCategorias()
	{
		$db=conectar();
		if($db!=null)
		{
			$query = $db->prepare("SELECT * FROM categoria");
		    $query->execute();
			while( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				echo $row[0]."-"-$row[1]."<BR>";
			}
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

?>