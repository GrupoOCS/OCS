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
			$query = $db->prepare("SELECT id,nombre,email FROM cliente WHERE email=:correo AND contrasena=:contra");
		    $query->execute($prepared);
			while( $row=($query->fetch(PDO::FETCH_NUM)) )
			{
				$_SESSION['id_usu']=$row[0];
				$_SESSION['nom_usu']=$row[1];
				$_SESSION['email']=$row[2];
				return "true";
			}
			return "Usuario y/o contraseña incorrectos";
		}
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

	function verificacodigo($datos){
		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'idcliente' => $datos['idcliente'],
				'codigo' => $datos['codigo']
				);

			$query = $db->prepare("SELECT id FROM codigo WHERE id_cliente=:idcliente AND codigo=:codigo");
		    $query ->execute($prepared);

			if( $row=($query->fetch(PDO::FETCH_ASSOC)) )
			{
				$query2 = $db->prepare("DELETE FROM codigo WHERE id=:id");
		        $query2->execute($row);
				
				return "true";
	
			}
			return "Codigo de verificacion  incorrecto";
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
			$cmails=$agregar['correo'];


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

			    //crear codigo  de  verificacion  e  insertarlo a   la  base  de   datos
			    $code = substr(md5(uniqid(rand())), 0,6);
			    $codig=$code;
			    $query3 = $db->prepare("INSERT INTO codigo(id_cliente,codigo) VALUES (:idcliente,:codigo)");
			    $query3->execute(array('idcliente' => $agregar2['idcliente'],'codigo' => $code));
			 	 enviarmail($cmails,$codig); 
			    $_SESSION['nom_usu']=$row[0];
				$_SESSION['email']=$row[1];
			    echo (" 
			    	<form onSubmit='return verificacodigo(".$agregar2['idcliente'].");'>
			    	<div  id='error'></div>
				    </form>
				    ");
			} catch (PDOException $e) {
				return "intentelo mas  tardesito";
			}
		}	
		else
			return "ERROR:No se pudo conectar a la base de datos";
	}

	function enviarmail($cmails,$codig)
	{	
		$headers = "Content-Type: text/html; charset=UTF-8"."\r\n";
	    $headers.= "From: onlineCSutm@gmail.com"."\r\n";
        $headers.= "Usted solicitó un registro en Online Computer  Shop."."\r\n";
        $headers.=" Para confirmarlo debe hacer click en el siguiente enlace:"."\r\n".phpversion();  
		$message.="http://ocs.net/funPHP/confirmar.php?codigo=".$codig."\r\n";
		 if (!@mail($cmails,"Confirmacion de registro en Online  Computer  Shop",$message,$headers)) die ("No se pudo enviar el email de confirmacion.");
		 echo "Tu cuenta ha sido registrada, sin embargo, esta requiere que la confirmes desde el correo  electronico  que ingresaste en el registro.";	
	}

?>