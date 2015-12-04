<?php
	//conectar();
	error_reporting(0);
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
				'correo' => $datos['correo'],
				'contra' => $datos['contrasena']
				);
			$query = $db->prepare("SELECT nombre,email FROM cliente WHERE email=:correo AND contrasena=:contra");
		    $query->execute($prepared);
			while( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				$_SESSION['nom_usu']=$row[0];
				$_SESSION['email']=$row[1];
				return "true";
			}
			return "Usuario y/o contraseña incorrectos";
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}


	function agregaUsuario($valores)
	{

		$db=conectar();
		if($db!=null)
		{
			$agregar = array(
				'nombre' => $valores['nombre'],
				'correo' => $valores['correo'],
				'contrasena' => $valores['contrasena'],);


			try {
				$query = $db->prepare("INSERT INTO cliente (nombre,email,contrasena) VALUES (:nombre,:correo,:contrasena)");
			    $query->execute($agregar);

			    $agregar2 = array(
			    		'idcliente' => $db->lastInsertId(),
						'calle' => $valores['calle'],
						'colonia' => $valores['colonia'],
						'municipio' => $valores['municipio'],
						'ciudad' => $valores['ciudad'],
						'edo' => $valores['estado'],
						'telefono' => $valores['telefono'],
						'codigoP' => $valores['codigo'],
					    'destino' =>$valores['nombre']
					);

			    $query2 = $db->prepare("INSERT INTO direccion (id_cliente,calle,colonia,municipio,ciudad,id_estado,telefono,cp,destinatario) VALUES (:idcliente,:calle,:colonia,:municipio,:ciudad,:edo,:telefono,:codigoP,:destino)");
			    $query2->execute($agregar2);
			    return "true";
			} catch (PDOException $e) {
				return "intentelo mas  tardesito";
			}
			

		}	
		else
			return "ERROR:No se pudo conectar a la base de datos";
	
	}
?>