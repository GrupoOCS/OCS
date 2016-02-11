<?php  
include('encabezado.php');


if(isset($_GET["idp"]))
{
	$idp=$_GET["idp"];
}



$id=$_SESSION["id_usu"];



	



$db = Conectar();
$query = "SELECT calle,colonia,id_estado,municipio,ciudad,telefono,cp,destinatario FROM direccion_temp where id_pedido=".$idp;
$res = $db->query($query);
if($res->rowCount()>0)
{
	foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row){	
	$calle=$row["calle"];
	$tel=$row["telefono"];
	$col=$row["colonia"];
	$mun=$row["municipio"];
	$dest=$row["destinatario"];
	$cp=$row["cp"];
	$est=$row["id_estado"];
	$ciudad=$row["ciudad"];
	
			   		
	
}

}
else{

	$query = "SELECT calle,colonia,id_estado,municipio,ciudad,telefono,cp,destinatario FROM direccion where id_cliente=".$id;
	$res = $db->query($query);
	foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row){	
	$calle=$row["calle"];
	$tel=$row["telefono"];
	$col=$row["colonia"];
	$mun=$row["municipio"];
	$dest=$row["destinatario"];
	$est=$row["id_estado"];
	$cp=$row["cp"];
	$ciudad=$row["ciudad"];
}
}
		
		
		$query = $db->prepare("SELECT nombre FROM estados WHERE id=".$est);
			
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}

		foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
			$est=$row["nombre"];
		}


		$query = $db->prepare("select producto_pedido.id_producto,producto_pedido.cantidad,producto.precio,producto.nombre FROM producto_pedido,producto WHERE producto_pedido.id_pedido=".$idp." and producto.id=producto_pedido.id_producto");
			
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
			print'<div class="contenido"><table class="carrito dir">
			<tr> <td colspan="4"><h3> Tú compra ha sido finalizada </h3></td> </tr>
			<tr><td style="font-weight: bold; text-align: center;" width="30%"> Nombre </td> <td style="font-weight: bold; text-align: center;" width="15%"> Cantidad </td><td style="font-weight: bold; text-align: center;" width="30%"> Precio unitario </td><td style="font-weight: bold; text-align: center;" width="20%"> Precio total </td></tr>';
		foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row2) {
			 print'<tr>
				<td style="font-weight: bold; text-align: center;" width="30%"><label>'.$row2["nombre"].'</label></td><td style="font-weight: bold; text-align: center;" width="15%"><label>'.$row2["cantidad"].'</label></td><td style="font-weight: bold; text-align: center;" width="30%"><label>'.$row2["precio"].'</label></td><td style="font-weight: bold; text-align: center;" width="20%"><label>'.$row2["precio"]*$row2["cantidad"].'</label></td>
				</tr>';

				
				$query = $db->prepare("UPDATE producto SET cantidad=cantidad-".$row2["cantidad"]." WHERE id=".$row2["id_producto"]);
				
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}

		}

			$query = $db->prepare("DELETE FROM pedido WHERE id=".$idp);
				
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
print'</table>';
	

			


?>





<div class="carrito_dir">
	<form action="index.php" method="post" enctype="multipart/form-data">
  <table class="carrito dir">
  	<tr><th><label></label></th></tr>
	
								
	
	<tr>
		<td colspan="2">Dirección de envío</td>
		
	</tr>
	<tr>
		 <td align="right">Calle:</td>                         
         <td><label for="calle"><?php echo " ".$calle;  ?> </label></td>
	</tr>
	<tr>
		 <td align="right">Colonia:</td>                         
         <td><label for="colonia"><?php echo " ".$col;  ?> </label></td>
	</tr>
	<tr>
		 <td align="right">Municipio:</td>                         
         <td><label for="municipio"><?php echo " ".$mun;  ?> </label></td>
	</tr>
	<tr>
		 <td align="right">Ciudad:</td>                         
         <td><label for="ciudad"><?php echo " ".$ciudad;  ?> </label></td>
	</tr>
	<tr>
		 <td align="right">Estado:</td>                         
         <td><label for="estado"><?php echo " ".$est;  ?> </label></td>
	</tr>
	<tr>
		 <td align="right">Teléfono:</td>                         
         <td><label for="tel"><?php echo " ".$tel;  ?> </label></td>
	</tr>
	<tr>
		 <td align="right">Código Postal:</td>                         
         <td><label for="cp"><?php echo " ".$cp;  ?> </label></td>
	</tr>
	<tr>
		 <td align="right">Destinatario:</td>                         
         <td><label for="dest"><?php echo " ".$dest;  ?> </label></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" class="btn grande" value="Continuar"></td>
	</tr>
  </table>


</div>

</div>


