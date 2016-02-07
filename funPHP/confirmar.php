<?php 
$codigo = $_GET['codigo']; 
?> 
<html> 
<head> 
<title>Confirmar registro</title> 
</head> 
<body> 
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

		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'codigo' => $codigo
				);

			$query = $db->prepare("SELECT id FROM codigo WHERE codigo=:codigo");
		    $query ->execute($prepared);

			if( $row=($query->fetch(PDO::FETCH_ASSOC)) )
			{
				$query2 = $db->prepare("DELETE FROM codigo WHERE id=:id");
		        $query2->execute($row);
				
				echo "Tu  cuenta ha  sido verificada correctamente.";
	
			}
			else echo "Codigo de verificacion  incorrecto";
		}
		else
			echo  "ERROR:No se pudo conectar a la base de datos";

		
?> 
</body> 
</html> 
