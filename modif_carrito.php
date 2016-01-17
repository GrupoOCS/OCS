<?php
	$cantidad=$_POST["cantidad_modif"];
	$id_cliente=$_POST["id_c"];

	$id_producto=$_POST["id_p"];

	include 'abrirConexion.php';
	$db = Conectar();
	if($db!=null)
		{
			$prepared = array(
				'cantidad' => $cantidad,
				'id_producto' => $id_producto,
				'id_cliente' => $id_cliente
				
				);
			
			$query = $db->prepare("UPDATE carrito SET cantidad=:cantidad WHERE id_producto=:id_producto and id_cliente=:id_cliente");
			try {
				$query->execute($prepared);
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}
		else
			//echo "ERROR:No se pudo conectar a la base de datos<BR>";

		
	

?>
		


	
