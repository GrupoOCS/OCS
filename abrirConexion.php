<?php

	function Conectar(){
		$dsn='mysql:host=localhost;dbname=ocs';
		$username='root';
		$password='';

		//try{
			$db=new PDO($dsn,$username,$password);
			if (is_null($db)){
				echo "Error al conectar la base de datos.";
			} 
			return $db;
		//}
	}

 ?>