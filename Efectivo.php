


<?php  

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



		$dsn='mysql:host=localhost;dbname=ocs';
		$username='root';
		$password='';
		$db=new PDO($dsn,$username,$password);

		$res=$db->prepare("INSERT INTO imagen(nombre) VALUES (?)");
		$res->execute(array($destino));
		//$id=$db->lastInsertId();
		
	}
?>




<div class="contenido">
	<form action="index.php" method="post" enctype="multipart/form-data">
  <table align="center" border="2">
  	<tr><th><label>Imagen añadida al directorio </label></th></tr>
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
		<td>Direccion de Imagen:</td>
		<td><?php echo "".$destino?></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" class="btn grande" value="Continuar"></td>
	</tr>
  </table>


</div>




