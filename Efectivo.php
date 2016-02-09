<?php  
session_start();
$id=$_SESSION["id_usu"];
print'<html>
<head class="reporte_final"> <title> Reporte De compra</title><meta charset="utf-8"></head>
<body class="body_final">';
if(isset($_POST["ciudad"]) && isset($_POST["calle"]) && isset($_POST["tel"]) && isset($_POST["col"]) && isset($_POST["mun"]) && isset($_POST["est"]) && isset($_POST["cp"]) && isset($_POST["dest"]))
{	
	$calle=$_POST["calle"];
	$tel=$_POST["tel"];
	$col=$_POST["col"];
	$mun=$_POST["mun"];
	$dest=$_POST["dest"];
	$cp=$_POST["cp"];
	$est=$_POST["est"];
	$ciudad=$_POST["ciudad"];

}

	$archivoImagen=$_FILES['imagen']['tmp_name'];
	//print $archivoImagen;
	$nombreImagen=$_FILES['imagen']['name'];
    $autorizacion=$_POST['autorizacion'];
    $referencia=$_POST['referencia'];
	//$descripcion=$_POST['description'];
	if($nombreImagen!=''){
		$prefijo=substr(md5(uniqid(rand())), 0,6);

		$destino="img/comprobantes/".$prefijo."_".$nombreImagen;


	}
	if (copy($archivoImagen,$destino)){  


		include('abrirConexion.php');
		$db = Conectar();

		$res=$db->prepare("INSERT INTO imagen(nombre) VALUES (?)");
		$res->execute(array($destino));
		//$id=$db->lastInsertId();
		
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

		$query = $db->prepare("select carrito.id_producto,carrito.cantidad,producto.precio,producto.nombre FROM carrito,producto WHERE carrito.id_cliente=".$id." and producto.id=carrito.id_producto");
			
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
			print'<table>
			<tr><td> Nombre </td> <td> Cantidad </td><td> Precio unitario </td><td> Precio total </td></tr>';
		foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row2) {
			 print'<tr>
				<td>'.$row2["nombre"].'</td><td>'.$row2["cantidad"].'</td><td>'.$row2["precio"].'</td><td>'.$row2["precio"]*$row2["cantidad"].'</td>
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

print'</table>';
	}

			$query = $db->prepare("DELETE FROM carrito WHERE id_cliente=".$id);
				
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}


?>




<div class="contenido">
	<form action="index.php" method="post" enctype="multipart/form-data">
  <table class="carrito dir">
  	<tr><th><label><h3> Tú compra ha sido finalizada </h3> </label></th></tr>
	<tr>
		<td>Autorizacion: </td>
		<td>
			<?php echo "".$autorizacion ?>
		</td>
	</tr>
								
	<tr>
		<td>Referencia: </td>
		<td>
			<?php echo "".$referencia ?>
		</td>
	</tr>
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




