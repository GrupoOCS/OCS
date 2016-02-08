
<?php
	session_start();
?>
<html> 
<?php 
$codigo = $_GET['codigo']; 

include_once('../db/DB.php');

?>
<head> 
<title>Confirmar registro</title> 
</head> 
<body> 
<div style="background:#48D1CC;text-align:center;width:50%;margin-left:25%;font-size:25px;font-family:verdana;color:white;border-radius:8px;height:400px;line-height:150px;">
<?php /*
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
	}*/

		$db=conectar();
		if($db!=null)
		{
			$prepared = array(
				'codigo' => $codigo
				);

			$query = $db->prepare("SELECT id,id_cliente FROM codigo WHERE codigo=:codigo");
		    $query ->execute($prepared);

			if( $row=($query->fetch(PDO::FETCH_ASSOC)) )
			{
				$query2 = $db->prepare("DELETE FROM codigo WHERE id=:id AND id_cliente=:id_cliente");
		        $query2->execute($row);
				//echo $row['id_cliente'];
		        verificarusuario2($row['id_cliente']);
				echo "Tu  cuenta ha  sido verificada correctamente.";
				echo "<span id='mensaje'style='font-size:12px'><br>Te redigiremos a la pagina de inicio de sesion en 5 segundos.</span>";
			?>      
			<script type="text/javascript">
			var N=5;
			setInterval(redireccionar,1000);


			function redireccionar()
			{
			if(N>0){
			document.getElementById("mensaje").innerHTML = "<br>Te redigiremos a la pagina de inicio de sesion en"+N+" segundos.";
		     	   }else{
		     	   	location.href="../index.php";
		     	   }
		     	N--;
			}

</script>


			<?php 




		}
			else{ echo "Codigo de verificacion  incorrecto";
				echo "<span id='mensaje' style='font-size:14px;'><br>Te redigiremos a la pagina de inicio de sesion en 5 segundos.</span>";
				}


		}
		else
			echo  "ERROR:No se pudo conectar a la base de datos";

		
?> 
</div>
</body> 
</html> 

