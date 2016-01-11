<?php include('encabezado.php'); ?>
	
	<script type="text/javascript">
		function insertarCarrito ( idCliente,idProducto, cantidad ) {
			var xmlhttp;
			if ( window.XMLHttpRequest ){
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function (){
				if ( xmlhttp.readyState ==4 && xmlhttp.status==200 ){
					document.getElementById('carrito').innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","insertCarrito.php?idc="+idCliente+"&idp="+idProducto+"&n="+cantidad, true);
			xmlhttp.send();
		}
	</script>

<?php
	$id = $_GET['id'];
	$db = Conectar();

	$query = "select producto.id, imagen.nombre, producto.nombre, producto.descripcion, producto.precio, producto.marca, subcategoria.nombre, subcategoria.id from imagen, producto, subcategoria where producto.id=imagen.id_producto and imagen.id_producto=".$id." and subcategoria.id=producto.id_subcategoria;";
	$res = $db->query($query);


	echo '<div class="contenido">';

		foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
			echo '<div class="desc-imagen">
				<img style="width:100%; height:100%;" src="'.$row[1].'">
			</div>';

			echo '<div class="desc-texto">';
			echo'	<h3><center>'.$row[2].'</center></h3>
				<!-- <div style="color:green; text-align:center;"> Disponible  : 50</div> -->
				<p class="texto-descripcion">'.nl2br(/*htmlentities(*/$row[3])/*))*/.'</p>';

			echo '<table class="describe">
				<tr><td>Precio:</td><td> $'.$row[4].' </td></tr>
				<tr><td>Marca:</td><td> '.$row[5].' </td></tr>';

				$cat = $db->query("select categoria.nombre from categoria,subcategoria where categoria.id=subcategoria.idcategoria and subcategoria.id=".$row[7]." limit 1;");
				foreach ($cat-> fetchAll(PDO::FETCH_NUM) as $row1 )
					echo '	<tr><td>Categoria:</td><td> '.$row1[0].' </td></tr>';
			echo '	<tr><td>Subcategoria:</td><td> '.$row[6].' </td></tr>
			</table>';

			echo '</div>';
        }

?>
	<div class="desc-agregar">
		<div class="d-cantidad">
			<fieldset class="field">
			<!-- <form> -->
			<label style="position:relative; height:25%; padding:4%; float:left; width:42%;">
				Cantidad:</label>
			<input id="num" name="cantidad" value="1" style=" position:relative; float:left; width:50%" type="number" class="form-control" min="1">
			
			<?php
				//echo "<input href=\"#\" onClick=\"insertarCarrito(1,".$id.",1); type=\"submit\" class=\"btn grande desc-carrito\" value=\"Agregar al Carrito\">";
			printf ("<a href=\"#\" onClick=\"insertarCarrito(1,".$id.",num.value);\"><img class=\"add_car\" src=\"Iconos/agregar.png\"></a>");
			?>

		<!-- </form> -->
		</fieldset>
		</div>

	</div>

</div>
<?php include('pie_pagina.php'); ?>


