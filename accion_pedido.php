<?php
	$idp=$_POST["idpedi"];
if(isset($_POST["elim"]))
{	
	include('abrirConexion.php');
	$db=Conectar();

	$query = $db->prepare("DELETE FROM pedido WHERE id=".$idp);
				
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
	$query2 = $db->prepare("DELETE FROM producto_pedido WHERE id_pedido=".$idp);
				
			try {
				$query2->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}

			echo '<script type="text/javascript">
						
						window.location.assign("registrar_pago.php?elim=si");
						</script>';
}
else
{
	if(isset($_POST["continuar"]))
	{
		header('Location:pago.php?idp='.$idp);
	}

}
	

?>